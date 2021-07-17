<?php

session_start();
require_once "conn.php";
require_once "utils.php";
require_once "handle_check_permission.php";

if (empty($_POST["updated_content"]) || empty($_POST["updated_title"]) || empty($_POST["id"]) ) {
  // $message = "資料不齊";
  // echo "<script>alert('$message');</script>"; 
  header("Location: " . $_SERVER["HTTP_REFERER"]);
  exit; 
}

$content = $_POST["updated_content"];
$title = $_POST["updated_title"];
$page= $_POST["page"];
$id = $_POST["id"];

$query_edit = "UPDATE a_blog_posts SET title = ?, content = ? WHERE id = ?";

$stmt = $conn->prepare($query_edit);
$stmt->bind_param("ssi", $title, $content, $id);
$result = $stmt->execute();

if (!$result) {
  exit($conn->error);
}

header("Location: " . $page);

?>