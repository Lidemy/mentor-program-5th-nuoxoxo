<?php

session_start();
require_once("conn.php");
require_once("utils.php");

if (empty($_GET["id"])) {
  header("Location: admin.php");
  die(); 
}

$id = $_GET["id"];

// $username = $_SESSION["username"];
// $content = $_POST["content"];
// $title = $_POST["title"];

$query_del = "UPDATE a_blog_posts SET is_deleted = 1 WHERE id = ?";
$stmt = $conn->prepare($query_del);
$stmt->bind_param("i", $id);
$result = $stmt->execute();

if (!$result) {
  die($conn->error);
}

header("Location: admin.php");

?>