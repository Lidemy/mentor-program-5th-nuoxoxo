<?php

session_start();

require_once("conn.php");
require_once("utils.php");

if (empty($_POST["username"]) || empty($_POST["password"])) {
    header("Location: login.php");
    die();
}

$username = $_POST["username"];
$password = $_POST["password"];

$sql_login = "SELECT * FROM users WHERE username =  '$username' AND password = '$password'";
$result = $conn->query($sql_login);

if (!$result) {
    die($conn->errno);
}

if ($result->num_rows) {
    $_SESSION["username"] = $username;
    header("Location: index.php");
} else {
    $message = "帳號或密碼輸入錯誤";
    echo "
    <script>window.location.href='login.php';
    alert('$message');
    </script>"; // 不知如何跳轉的同時顯示 alert  
}

?>