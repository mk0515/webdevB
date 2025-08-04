<div class="top_bg">
  <div class="top_index">
    <div class="inner">
      <p class="hello">こんにちは、<strong><?= htmlspecialchars($oshi_name) ?></strong> さん！</p>
      <p class="change_link"><a href="<?= dirname(get_base_url()) ?>/logout.php">名前を変える</a></p>
      <form action="" method="post" enctype="multipart/form-data">
        <p class="comment"><img src="./image/comment.svg" alt="コメント"><textarea name="comment" rows="4" cols="40" class="comment_area"></textarea></p>
        <p class="pic"><img src="./image/pic.svg" alt="写真を追加"><input type="file" name="image" id="imageInput" class="file_input"></p>
        <p><img id="preview" src="#" alt="プレビュー画像" style="display:none; max-width:300px; margin-top:10px;"></p>
        <p class="post_button"><input type="submit" value="投稿" class="submit_btn" /></p>
      </form>
    </div>
  </div>

  <div id="posts">
    <div class="inner">
      <?php if (!empty($posts)): ?>
        <?php foreach ($posts as $post): ?>
          <div id="post<?= (int)$post['id'] ?>" style="margin-bottom: 100px">
            <p class="name"><strong><?= str2html($post['name']) ?></strong> さん</p>
            <p class="comment_toukou"><?= nl2br(str2html($post['comment'])) ?></p>
            <?php if (!empty($post['image_path'])): ?>
              <p>
                <img src="<?= dirname(get_base_url()) ?>/storage/images/<?= htmlspecialchars($post['image_path']) ?>" alt="投稿画像" style="max-width:300px;">
              </p>
            <?php endif; ?>
            <p><small><?= str2html($post['created_at']) ?></small></p>
            <p class="btn">
              <!-- いいね -->
              <a href="#" class="reaction-button like-button" data-id="<?= (int)$post['id'] ?>" data-type="like">
                <img src="<?= dirname(get_base_url()) ?>/svg/heart_line.svg"
                  data-filled="<?= dirname(get_base_url()) ?>/svg/heart.svg"
                  data-empty="<?= dirname(get_base_url()) ?>/svg/heart_line.svg"
                  class="reaction-icon"
                  alt="いいね"
                  data-id="<?= (int)$post['id'] ?>"
                  style="width:40px;" />
                <span class="like-count" data-id="<?= (int)$post['id'] ?>">
                  <?= isset($post['likes']) ? (int)$post['likes'] : 0 ?>
                </span>
              </a>
              <!-- スター -->
              <a href="#" class="reaction-button star-button" data-id="<?= (int)$post['id'] ?>" data-type="star" style="margin-left: 15px;">
                <img src="<?= dirname(get_base_url()) ?>/svg/star_line.svg"
                  data-filled="<?= dirname(get_base_url()) ?>/svg/star.svg"
                  data-empty="<?= dirname(get_base_url()) ?>/svg/star_line.svg"
                  class="reaction-icon"
                  alt="最高"
                  data-id="<?= (int)$post['id'] ?>"
                  style="width:40px;" />
                <span class="star-count" data-id="<?= (int)$post['id'] ?>">
                  <?= isset($post['star']) ? (int)$post['star'] : 0 ?>
                </span>
              </a>
              <!-- 尊い -->
              <a href="#" class="reaction-button precious-button" data-id="<?= (int)$post['id'] ?>" data-type="precious" style="margin-left: 15px;">
                <img src="<?= dirname(get_base_url()) ?>/svg/precious_line.svg"
                  data-filled="<?= dirname(get_base_url()) ?>/svg/precious.svg"
                  data-empty="<?= dirname(get_base_url()) ?>/svg/precious_line.svg"
                  class="reaction-icon"
                  alt="尊い"
                  data-id="<?= (int)$post['id'] ?>"
                  style="width:40px;" />
                <span class="precious-count" data-id="<?= (int)$post['id'] ?>">
                  <?= isset($post['precious']) ? (int)$post['precious'] : 0 ?>
                </span>
              </a>
            </p>
            <form class="delete-form" data-id="<?= (int)$post['id'] ?>" method="post">
              <input type="hidden" name="delete_id" value="<?= (int)$post['id'] ?>">
              <button type="button" class="delete-btn"><img src="./image/delete.png" alt="消去"></button>
            </form>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>投稿はまだありません。</p>
      <?php endif; ?>
    </div>
  </div>
</div>
</div>

<div id="modal-overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:999;"></div>
<div id="delete-modal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%);
  background:#fff; padding:50px; border-radius:10px; box-shadow:0 4px 8px rgba(0,0,0,0.3); z-index:1000; text-align:center;">
  <p class="delete" style="margin-bottom: 1em;">本当に削除しますか？</p>
  <button id="confirm-delete" style="margin-right: 1em;">はい</button>
  <button id="cancel-delete">キャンセル</button>
</div>

<script>
  // Cookie取得関数
  function getCookie(name) {
    const cookies = document.cookie.split(';');
    for (const cookie of cookies) {
      const [key, value] = cookie.trim().split('=');
      if (key === name) return value;
    }
    return null;
  }

  // Cookie設定関数（有効期限days日）
  function setCookie(name, value, days) {
    const expires = new Date();
    expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
    document.cookie = `${name}=${value}; expires=${expires.toUTCString()}; path=/`;
  }

  document.addEventListener('DOMContentLoaded', () => {
    const reactionTypes = ['like', 'star', 'precious'];

    reactionTypes.forEach(type => {
      document.querySelectorAll(`.${type}-button`).forEach(button => {
        const postId = button.dataset.id;
        const cookieKey = `reaction_${postId}_${type}`;

        // ページ読み込み時にCookie確認して、塗りつぶしにする
        if (getCookie(cookieKey) === '1') {
          const img = button.querySelector('img');
          if (img && img.dataset.filled) {
            img.src = img.dataset.filled;
          }
        }

        button.addEventListener('click', e => {
          e.preventDefault();

          fetch(`?${type}_id=${postId}`, {
              method: 'GET'
            })
            .then(response => response.ok ? response.text() : Promise.reject())
            .then(() => {
              // カウントアップ
              const countSpan = document.querySelector(`.${type}-count[data-id='${postId}']`);
              const current = parseInt(countSpan.textContent) || 0;
              countSpan.textContent = current + 1;

              // アイコンを塗りつぶしに変更＆Cookieに保存
              const img = button.querySelector('img');
              if (img && img.dataset.filled) {
                img.src = img.dataset.filled;
                setCookie(cookieKey, '1', 30); // 30日間保存
              }
            })
            .catch(() => {
              alert(`${type}のリアクションに失敗しちゃった💦`);
            });
        });
      });
    });

    // ======= 投稿削除モーダルまわりの処理 =======
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

    // ======= 投稿画像プレビュー処理 =======
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