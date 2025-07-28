<p>こんにちは、<strong><?= htmlspecialchars($oshi_name) ?></strong> さん！</p>
<p><a href="<?= dirname(get_base_url()) ?>/logout.php">名前を変える</a></p>

<form action="" method="post" enctype="multipart/form-data">
  <p>コメント：<textarea name="comment" rows="4" cols="40"></textarea></p>
  <p>写真を追加：<input type="file" name="image" id="imageInput"></p>
  <p><img id="preview" src="#" alt="プレビュー画像" style="display:none; max-width:300px; margin-top:10px;"></p>
  <p><input type="submit" value="投稿" /></p>
</form>

<hr />

<div id="posts">
  <?php if (!empty($posts)): ?>
    <?php foreach ($posts as $post): ?>
      <div id="post<?= (int)$post['id'] ?>" style="margin-bottom: 20px">
        <p><strong><?= str2html($post['name']) ?></strong> さん</p>
        <p><?= nl2br(str2html($post['comment'])) ?></p>
        <?php if (!empty($post['image_path'])): ?>
          <p>
            <img src="<?= dirname(get_base_url()) ?>/storage/images/<?= htmlspecialchars($post['image_path']) ?>" alt="投稿画像" style="max-width:300px;">
          </p>
        <?php endif; ?>
        <p><small><?= str2html($post['created_at']) ?></small></p>
        <p>
          <!-- いいね -->
          <a href="#" class="reaction-button like-button" data-id="<?= (int)$post['id'] ?>" data-type="like">
            <i class="fa-regular fa-heart" data-id="<?= (int)$post['id'] ?>"></i>
          </a>
          <span class="reaction-count like-count" data-id="<?= (int)$post['id'] ?>"><?= (int)($post['likes'] ?? 0) ?></span> 件

          <!-- スター -->
          <a href="#" class="reaction-button star-button" data-id="<?= (int)$post['id'] ?>" data-type="star" style="margin-left: 15px;">
            <i class="fa-regular fa-star" data-id="<?= (int)$post['id'] ?>"></i>
          </a>
          <span class="reaction-count star-count" data-id="<?= (int)$post['id'] ?>"><?= (int)($post['stars'] ?? 0) ?></span> 件

          <!-- 尊い -->
          <a href="#" class="reaction-button precious-button" data-id="<?= (int)$post['id'] ?>" data-type="precious" style="margin-left: 15px;">
            <i class="fa-regular fa-gem" data-id="<?= (int)$post['id'] ?>"></i>
          </a>
          <span class="reaction-count precious-count" data-id="<?= (int)$post['id'] ?>"><?= (int)($post['precious'] ?? 0) ?></span> 件
        </p>
        <form class="delete-form" data-id="<?= (int)$post['id'] ?>" method="post">
          <input type="hidden" name="delete_id" value="<?= (int)$post['id'] ?>">
          <button type="button" class="delete-btn">削除</button>
        </form>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>投稿はまだありません。</p>
  <?php endif; ?>
</div>

<div id="modal-overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:999;"></div>
<div id="delete-modal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%);
  background:#fff; padding:20px; border-radius:10px; box-shadow:0 4px 8px rgba(0,0,0,0.3); z-index:1000; text-align:center;">
  <p style="margin-bottom: 1em;">本当に削除しますか？</p>
  <button id="confirm-delete" style="margin-right: 1em;">はい</button>
  <button id="cancel-delete">キャンセル</button>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const reactionTypes = ['like', 'star', 'precious'];

    // Cookieからリアクション済み投稿IDを取得
    const getReactions = (type) => {
      const cookie = document.cookie.split('; ').find(row => row.startsWith(`${type}_posts=`));
      if (!cookie) return [];
      try {
        return JSON.parse(decodeURIComponent(cookie.split('=')[1]));
      } catch {
        return [];
      }
    };

    // Cookieにリアクション投稿IDを保存
    const setReactions = (type, ids) => {
      document.cookie = `${type}_posts=${encodeURIComponent(JSON.stringify(ids))}; path=/; max-age=31536000`;
    };

    // 他のリアクションボタンも全部無効化する関数
    function disableOtherButtons(postId) {
      reactionTypes.forEach(t => {
        document.querySelectorAll(`.${t}-button[data-id='${postId}']`).forEach(btn => {
          disableButton(btn);
        });
      });
    }

    // ボタンを押せなくする＆見た目変える関数
    function disableButton(button) {
      button.style.pointerEvents = 'none';
    }

    // ボタンを塗りつぶしにする関数
    function setButtonActive(button) {
      const icon = button.querySelector('i');
      icon.classList.remove('fa-regular');
      icon.classList.add('fa-solid');
    }

    reactionTypes.forEach(type => {
      let reactedPosts = getReactions(type);

      document.querySelectorAll(`.${type}-button`).forEach(button => {
        const postId = button.dataset.id;

        // すでにリアクション済みなら無効化＆色変更
        if (reactedPosts.includes(postId)) {
          setButtonActive(button);
          disableButton(button);
          disableOtherButtons(postId);
        }

        button.addEventListener('click', e => {
          e.preventDefault();

          if (reactedPosts.includes(postId)) {
            alert('もうリアクション済みだよ〜！');
            return;
          }

          // 他のボタンも全部無効化
          disableOtherButtons(postId);

          fetch(`?${type}_id=${postId}`, {
              method: 'GET'
            })
            .then(response => response.ok ? response.text() : Promise.reject())
            .then(() => {
              // カウントアップ
              const countSpan = document.querySelector(`.${type}-count[data-id='${postId}']`);
              const current = parseInt(countSpan.textContent);
              countSpan.textContent = current + 1;

              // 押したボタンをアクティブ化＆無効化
              setButtonActive(button);
              disableButton(button);

              // Cookieに保存
              reactedPosts.push(postId);
              setReactions(type, reactedPosts);
            })
            .catch(() => {
              alert('リアクションに失敗しちゃった💦');
            });
        });
      });
    });

    // 消去 & モーダル
    const deleteForms = document.querySelectorAll('.delete-form');
    const modal = document.getElementById('delete-modal');
    const overlay = document.getElementById('modal-overlay');
    const confirmBtn = document.getElementById('confirm-delete');
    const cancelBtn = document.getElementById('cancel-delete');

    let currentForm = null;

    deleteForms.forEach(form => {
      const btn = form.querySelector('.delete-btn');
      btn.addEventListener('click', () => {
        currentForm = form;
        modal.style.display = 'block';
        overlay.style.display = 'block';
      });
    });

    confirmBtn.addEventListener('click', () => {
      if (currentForm) currentForm.submit();
    });

    cancelBtn.addEventListener('click', () => {
      modal.style.display = 'none';
      overlay.style.display = 'none';
      currentForm = null;
    });

    overlay.addEventListener('click', () => {
      modal.style.display = 'none';
      overlay.style.display = 'none';
      currentForm = null;
    });

    // プレビュー画像表示
    const imageInput = document.getElementById('imageInput');
    const preview = document.getElementById('preview');

    imageInput.addEventListener('change', function() {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
      } else {
        preview.style.display = 'none';
        preview.src = '#';
      }
    });
  });
</script>