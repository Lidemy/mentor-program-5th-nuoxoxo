<?php

session_start();
require_once("conn.php");
require_once("utils.php");

$username = NULL;
$message1 = "操作超出權限";
$message2 = "你已被停權";

if (!empty($_SESSION["username"])) {
  $username = $_SESSION["username"];
  $user = getUserFromSession($username);
} else {
  echo "
  <script>window.location.href='index.php';
  alert('$message1');</script>";
  exit;
}

if ($user["role"] == "BANNED") {
  echo "
  <script>window.location.href='index.php';
  alert('$message2');
  </script>";
  exit;
}

if (empty($_GET["id"])) {
  header("Location: index.php");
  exit;
}

$id = $_GET["id"];
$temp = getContentFromId($id);

if (
  ($temp["username"] !== $user["username"]) 
  && $user["role"] !== "ADMIN"
  ) {
  echo "
  <script>window.location.href='index.php';
  alert('$message1');</script>";
  exit;
}

if (empty($_POST["updated_comment"])) {
  header("Location: index.php");
  exit;
}

$content = $_POST["updated_comment"];

$sql_update = "UPDATE a_bbs SET content = ? WHERE id = ?";

$stmt = $conn->prepare($sql_update);
$stmt->bind_param("si", $content, $id);
$result = $stmt->execute();

if (!$result) {
    exit($conn->error);
}

header("Location: index.php");

?>