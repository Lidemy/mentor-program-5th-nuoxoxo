<?php

session_start();

require_once("conn.php");
require_once("utils.php");

$username = $_SESSION["username"];

if (empty($_POST['content'])) {
  header("Location: index.php"); 
  die('資料不齊全');
}

$content = mysqli_real_escape_string($conn, $_POST["content"]);

$sql_query = "INSERT INTO a_bbs (username, content) VALUES (?, ?)";
$stmt = $conn->prepare($sql_query);
$stmt->bind_param("ss", $username, $content);
$result = $stmt->execute();

if (!$result) {
    die($conn->error);
}

header("Location: index.php");

?>