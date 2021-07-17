<?php

session_start();
require_once "conn.php";
require_once "utils.php";

if (empty($_POST["username"]) || empty($_POST["password"])) {
    header("Location: login.php");
    exit;
}

$username = $_POST["username"];
$password = $_POST["password"];

$sql_login = "SELECT * FROM a_blog_users WHERE username = ?";
$stmt = $conn->prepare($sql_login);
$stmt->bind_param("s", $username);
$result = $stmt->execute();

if (!$result) {
    exit($conn->errno);
}

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $message = "帳號輸入錯誤";
    echo "
    <script>window.location.href='login.php';
    alert('$message');
    </script>";
    exit;
}

$row = $result->fetch_assoc();

if (password_verify($password, $row["password"])) {
    $_SESSION["logon_name"] = $username;
    header("Location: index.php");
} else {
    $message = "密碼輸入錯誤";
    echo "
    <script>window.location.href='login.php';
    alert('$message');
    </script>"; 
}

?>