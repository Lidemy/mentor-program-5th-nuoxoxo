<?php

session_start();
require_once("conn.php");
require_once("utils.php");

if (empty($_POST["nickname"])) {
    header("Location: index.php");
    exit;
}

if (!empty($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $user = getUserFromSession($username);
} 
else {
    $message = "操作超出權限";
    echo "
    <script>window.location.href='index.php';
    alert('$message');
    </script>";
    exit;
}

$username = $_SESSION["username"];
$nickname = $_POST["nickname"];

$sql_update = "UPDATE a_users SET nickname = ? WHERE username = ?";

$stmt = $conn->prepare($sql_update);
$stmt->bind_param("ss", $nickname, $username);
$result = $stmt->execute();

if ($conn->errno === 1062) {
    $message = "暱稱已存在，請選擇不同的暱稱";
    echo "<script>window.location.href='index.php';alert('$message');</script>"; 
    exit;
}

header("Location: " . $_SERVER["HTTP_REFERER"]);

?>