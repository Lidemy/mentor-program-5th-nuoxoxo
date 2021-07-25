<?php

session_start();
require_once "conn.php";
require_once "utils.php";
require_once "handle_check_permission.php";

if (empty($_GET["id"])) {
  header("Location: dashboard.php");
  exit; 
}

$id = $_GET["id"];

// $username = $_SESSION["logon_name"];
// $content = $_POST["content"];
// $title = $_POST["title"];

$query_del = "UPDATE a_blog_posts SET is_deleted = 1 WHERE id = ?";
$stmt = $conn->prepare($query_del);
$stmt->bind_param("i", $id);
$result = $stmt->execute();

if (!$result) {
  exit($conn->error);
}

header("Location: dashboard.php");

?>