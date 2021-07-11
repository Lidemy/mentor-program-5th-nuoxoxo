<?php
session_start();
require_once("conn.php");
require_once("utils.php");

if (!$_GET["id"] or !$_GET["role"]) {
    header("Location: admin.php"); die();
}

$id=$_GET["id"];
$role=$_GET["role"];

$username = NULL;
$user = NULL;

if (!empty($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $user = getUserFromSession($username);
}

if (!$user or $user["role"] !== "ADMIN") {
    header("Location: admin.php"); 
    // die();
    exit;
}

$sql_update = "UPDATE a_users SET role = ? WHERE id = ?";
$stmt = $conn->prepare($sql_update);
$stmt->bind_param("si", $role, $id);
$result = $stmt->execute();

header("Location: admin.php")

?>