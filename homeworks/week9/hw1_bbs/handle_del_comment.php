<?php

session_start();
require_once("conn.php");
require_once("utils.php");

if (empty($_GET["id"])) {
    header("Location: index.php");
    die();
}

$id = $_GET["id"];
$content = $_POST["updated_comment"];

$sql_update = "UPDATE a_bbs SET is_deleted = 1 WHERE id = ?";

$stmt = $conn->prepare($sql_update);
$stmt->bind_param("i", $id);
$result = $stmt->execute();

if (!$result) {
    die($conn->error);
}

header("Location: index.php");

?>