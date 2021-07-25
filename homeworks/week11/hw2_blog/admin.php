<?php
session_start();

require_once "conn.php";
require_once "utils.php";
require_once "handle_check_permission.php";

$sql_load = 
"SELECT id, title, content, created_at
FROM a_blog_posts WHERE is_deleted IS NULL 
ORDER BY created_at DESC";

$stmt = $conn->prepare($sql_load);
$result = $stmt->execute();

if (!$result) {
  die("Error: " . $conn->error);
}

$result = $stmt->get_result();
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
  <!-- <section class="banner">
    <div class="banner__wrapper">
      <h1>存放技術之地</h1>
      <div>Welcome to my blog</div>
    </div>
  </section> -->
  <div class="container-wrapper">
    <div class="container">
      <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="admin-posts">
          <div class="admin-post">
            <a method="POST" href="edit.php?id=<?= escape($row["id"]) ?>" class="admin-post__title" style="text-decoration:none;">
              <?= escape($row["title"]) ?>
            </a>
            <div class="admin-post__info">
              <div class="admin-post__created-at">
                <?= escape($row["created_at"]) ?>
              </div>
              <a class="admin-post__btn" method="POST" href="edit.php?id=<?= escape($row["id"]) ?>">編輯</a>
              <a class="admin-post__btn" method="POST" href="handle_post_del.php?id=<?= escape($row["id"]) ?>">刪除</a>
            </div>
          </div>
        </div><? } ?>
    </div>
  </div>
  <?php include "template_footer.php"?>
</body>
</html>