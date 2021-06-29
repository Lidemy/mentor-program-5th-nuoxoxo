<?php

session_start();

require_once("conn.php");
require_once("utils.php");

// Set nickname
$user = getUserFromSession($_SESSION["username"]);
$nickname = $user["nickname"];

// Set content
if (empty($_POST['content'])) {
  header("Location: index.php"); //不一樣的做法 but it works
  die('資料不齊全');
}

$content = mysqli_real_escape_string($conn, $_POST["content"]);

// Insert SQL
// Update: Binding query
$sql_query = "INSERT INTO a_bbs (nickname, content) VALUES (?, ?)";
$stmt = $conn->prepare($sql_query);
$stmt->bind_param("ss", $nickname, $content);
$result = $stmt->execute();

if (!$result) {
    die($conn->error);
}

header("Location: index.php");

?>