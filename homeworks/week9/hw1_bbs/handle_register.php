<?php

session_start();
require_once("conn.php");

if (
    empty($_POST["nickname"]) || 
    empty($_POST["username"]) ||
    empty($_POST["password"])
) {
    header("Location: register.php");
    die();
}

$nickname = $_POST["nickname"];
$username = $_POST["username"];
// $password = $_POST["password"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

$sql_query = "INSERT INTO a_users (nickname, username, password) VALUES ('$nickname', '$username', '$password')";

$result = $conn->query($sql_query);

if (!$result) {
    $code = $conn->errno;
    echo "$code";
    if ($code === 1062) {
        $message = "帳戶已被註冊";
        echo "<script>window.location.href='register.php';alert('$message');</script>"; 
    }
    die();
}

$_SESSION["username"] = $username;
// header("Location: login.php"); 
header("Location: index.php"); 

?>
