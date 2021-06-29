<?php

session_start();

require_once("conn.php");
require_once("utils.php");

// 

if (empty($_POST["username"]) || empty($_POST["password"])) {
    header("Location: login.php");
    die();
}

$username = $_POST["username"];
$password = $_POST["password"];

$sql_login = "SELECT * FROM a_users WHERE username =  '$username'";

$result = $conn->query($sql_login);

// check $result AND $result->num_rows

if (!$result) {
    die($conn->errno);
}

if ($result->num_rows === 0) {
    $message = "帳號輸入錯誤";
    echo "
    <script>window.location.href='login.php';
    alert('$message');
    </script>";
    exit();
}

$row = $result->fetch_assoc();

if (password_verify($password, $row["password"])) {
    $_SESSION["username"] = $username;
    header("Location: index.php");
} else {
    $message = "密碼輸入錯誤";
    echo "
    <script>window.location.href='login.php';
    alert('$message');
    </script>"; 
}
?>