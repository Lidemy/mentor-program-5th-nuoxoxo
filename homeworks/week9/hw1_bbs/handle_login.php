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

<<<<<<< HEAD
// $sql_login = "SELECT * FROM users WHERE username =  '$username' AND password = '$password'";
$sql_login = "SELECT * FROM a_users WHERE username =  '$username'";

=======
$sql_login = "SELECT * FROM a_users WHERE username =  '$username' AND password = '$password'";
>>>>>>> 3a47f948bbc81039e59d6dd8405c9c6ebf1b2c08
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
    </script>"; // 不知如何跳轉的同時顯示 alert  
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