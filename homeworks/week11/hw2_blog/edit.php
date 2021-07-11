<?php 
session_start();
require_once("conn.php");
require_once("utils.php");
require_once("handle_check_permission.php");

if (empty($_GET["id"])) {
  header("Location: admin.php");
  die(); 
}

$id = $_GET["id"];
$query_load = "SELECT title, content FROM a_blog_posts WHERE id = ?";
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
  <?php include_once("template_header.php") ?>
  <div class="container-wrapper">
    <div class="container">
      <div class="edit-post">
        <form action="handle_post_edit.php?id=<?=$id?>" method="POST">
          <div class="edit-post__title">編輯文章：</div>
          <div class="edit-post__input-wrapper">
            <input name="updated_title" class="edit-post__input" value="<?=$row['title']?>" autocomplete="off"/>
          </div>
          <div class="edit-post__input-wrapper">
            <textarea name="updated_content" rows="20" class="edit-post__content"><?=$row['content']?></textarea>
          </div>
          <div class="edit-post__btn-wrapper">
            <button type="sumbit" class="edit-post__btn" style="user-select:none">送出</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php include("template_footer.php") ?>
</body>

</html>