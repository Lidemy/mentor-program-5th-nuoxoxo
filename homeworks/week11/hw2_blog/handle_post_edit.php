<?php

session_start();
require_once("conn.php");
require_once("utils.php");

if (empty($_POST["updated_content"]) or empty($_POST["updated_title"])) {
  $message = "資料不齊";
  echo "<script>alert('$message');</script>"; 
  header("Location: edit.php");
  die(); 
}

$content = $_POST["updated_content"];
$title = $_POST["updated_title"];
$id = $_GET["id"];

$query_edit = "UPDATE a_blog_posts SET title = ?, content = ? WHERE id = ?";

$stmt = $conn->prepare($query_edit);
$stmt->bind_param("ssi", $title, $content, $id);
$result = $stmt->execute();

if (!$result) {
  echo "$id" . "$title" . "$content";
  die($conn->error);
}

header("Location: admin.php");

?>