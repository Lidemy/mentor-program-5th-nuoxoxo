<?php

session_start();
require_once("conn.php");
require_once("utils.php");

if (empty($_POST["nickname"])) {
    header("Location: index.php");
    die();
}

$username = $_SESSION["username"];
$nickname = $_POST["nickname"];

// look for duplicated nickname
// $sql_lookup = "SELECT * FROM a_users WHERE nickname = ?";
// $stmt = $conn->prepare($sql_lookup);
// $stmt->bind_param("s", $nickname);
// $result = $stmt->execute();

// echo $result;
// if ($result) {
//     $message = "暱稱已存在，請選擇不同的暱稱";
//     echo "<script>window.location.href='index.php';alert('$message');</script>"; 
//     die($conn->error);
// }

$sql_edit = "UPDATE a_users SET nickname = ? WHERE username = ?";
$stmt = $conn->prepare($sql_edit);
$stmt->bind_param("ss", $nickname, $username);
$result = $stmt->execute();

if ($conn->errno === 1062) {
    $message = "暱稱已存在，請選擇不同的暱稱";
    echo "<script>window.location.href='index.php';alert('$message');</script>"; 
    // print_r($conn->errno);
    die();
    // die($conn->error);
}

header("Location: index.php")

?>