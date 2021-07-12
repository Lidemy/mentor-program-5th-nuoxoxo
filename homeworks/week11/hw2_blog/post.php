<?php 
session_start();
require_once "conn.php";
require_once "utils.php";

if (empty($_GET["id"])) {
  header("Location: index.php");
  die(); 
}

$id = $_GET["id"];
$query_load = "SELECT title, content, created_at FROM a_blog_posts WHERE id = ?";
$stmt = $conn->prepare($query_load);
$stmt->bind_param("i", $id);
$result = $stmt->execute();

if (!$result) {
  die("Error: " . $conn->error);
}

$result = $stmt->get_result();
$row = $result->fetch_assoc()
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
  <nav class="navbar">
  <?php include_once "template_header.php" ?>
  <div class="container-wrapper">
    <div class="posts">
      <article class="post">
        <div class="post__header">
          <div><?=escape($row["title"])?></div>
          <div class="post__actions">
            <a class="post__action" href="edit.php?id=<?=$id?>">編輯</a>
          </div>
        </div>
        <div class="post__info">
        <?=escape($row["created_at"])?>
        </div>
        <div class="post__content">
        <?=escape($row["content"])?>
        </div>
      </article>
    </div>
  </div>
  <?php include "template_footer.php" ?>
</body>

</html>