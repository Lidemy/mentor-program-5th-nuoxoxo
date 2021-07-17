<?php

session_start();
require_once("conn.php");
require_once("utils.php");

$username = NULL;

if (empty($_SESSION["username"])) {
  $username = $_SESSION["username"];
  $user = getUserFromSession($username);
}

if ($user["role"] == "BANNED") {
  $message = "你已被停權";
  echo "<script>window.location.href='index.php';
  alert('$message');
  </script>";
  exit;
}

if (empty($_POST["content"])) {
  header("Location: index.php"); 
  exit('資料不齊全');
}

$content = mysqli_real_escape_string($conn, $_POST["content"]);

$sql_query = "INSERT INTO a_bbs (username, content) VALUES (?, ?)";
$stmt = $conn->prepare($sql_query);
$stmt->bind_param("ss", $username, $content);
$result = $stmt->execute();

if (!$result) {
    exit($conn->error);
}

header("Location: index.php");

?>