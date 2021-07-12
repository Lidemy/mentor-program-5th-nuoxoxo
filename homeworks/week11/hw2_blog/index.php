<?php 
session_start();

require_once "conn.php";
require_once "utils.php";

$sql_load = 
"SELECT blog.id as id,
blog.title as title,
blog.content as content, 
blog.created_at as created_at
FROM a_blog_posts as blog
WHERE is_deleted IS NULL
ORDER BY created_at DESC";

$stmt = $conn->prepare($sql_load);
$result = $stmt->execute();

if (!$result) {
  die();
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
  <div class="container-wrapper">
    <div class="posts">
      <?php while ($row = $result->fetch_assoc()) { ?>
      <article class="post">
        <div class="post__header">
          <div><?=escape($row["title"])?></div>
          <? if (!empty($_SESSION["username"])) { ?>
            <div class="post__actions">
              <a class="post__action" href="edit.php?id=<?=escape($row["id"])?>">編輯</a>
            </div>
          <?}?>
        </div>
        <div class="post__info"><?=escape($row["created_at"])?></div>
        <div class="post__content"><?=escape($row["content"])?>
        </div>
        <a class="btn-read-more" method="POST" href="post.php?id=<?=escape($row["id"])?>">READ MORE</a>
      </article>
      <?}?>
    </div>
  </div>
  <?php include_once "template_footer.php" ?>
</body>

</html>