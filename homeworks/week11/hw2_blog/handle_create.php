<?php

session_start();
require_once("conn.php");
require_once("utils.php");

if (empty($_POST["content"]) || empty($_POST["title"])) {
  $message = "資料不齊";
  echo "<script>alert('$message');</script>"; 
  header("Location: create.php");
  die(); 
}

$username = $_SESSION["username"];
// $user = getUserFromSession($username);
// $content = mysqli_real_escape_string($conn, $_POST["content"]);
$content = $_POST["content"];
$title = $_POST["title"];

$sql_query = "INSERT INTO a_blog_posts (username, title, content) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql_query);
$stmt->bind_param("sss", $username, $title, $content);
$result = $stmt->execute();

if (!$result) {
  echo "$username" . "$title" . "$content";
  die($conn->error);
}

header("Location: admin.php");

?>