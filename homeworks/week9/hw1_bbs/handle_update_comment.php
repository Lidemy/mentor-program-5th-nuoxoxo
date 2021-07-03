<?php

session_start();
require_once("conn.php");
require_once("utils.php");

if (empty($_POST["updated_comment"])) {
    header("Location: index.php");
    die();
}

$id = $_POST["id"];
$content = $_POST["updated_comment"];

$sql_update = "UPDATE a_bbs SET content = ? WHERE id = ?";

$stmt = $conn->prepare($sql_update);
$stmt->bind_param("si", $content, $id);
$result = $stmt->execute();

if (!$result) {
    die($conn->error);
}

header("Location: index.php");

?>