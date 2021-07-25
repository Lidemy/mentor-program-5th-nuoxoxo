<?php 
  session_start();
  require_once "conn.php";
  require_once "utils.php";
  require_once "handle_check_permission.php";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>部落格</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="normalize.css" />
  <link rel="stylesheet" href="styles.css" />
</head>

<body>
  <?php include_once "template_header.php" ?>
  <div class="container-wrapper">
    <div class="container">
      <div class="edit-post">
        <form action="handle_create.php" method="POST">
          <div class="edit-post__title">
            發表文章：
          </div>
          <div class="edit-post__input-wrapper">
            <input name="title" class="edit-post__input" placeholder="請輸入文章標題" autocomplete="off"/>
          </div>
          <div class="edit-post__input-wrapper">
            <textarea name="content" rows="20" class="edit-post__content"></textarea>
          </div>
          <div class="edit-post__btn-wrapper">
            <button type="sumbit" class="edit-post__btn" style="user-select: none">送出</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php include "template_footer.php" ?>
</body>

</html>