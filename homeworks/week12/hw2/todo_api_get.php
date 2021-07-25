<?php

require_once("conn.php");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");

if (empty($_GET["user_id"])){
  $json = array(
    "valid" => false, 
    "msg" => "Missing todo id."
  );
  $response = json_encode($json);
  echo $response;
  exit;
}

$user_id = intval($_GET["user_id"]);
$sql_query = "SELECT user_id, todos FROM a_todos WHERE user_id = ?";
$stmt = $conn->prepare($sql_query);
$stmt->bind_param("i", $user_id);
$result = $stmt->execute();

if (!$result){
  $json = array(
    "valid" => false, 
    "msg" => "Something's wrong."
  );
  $response = json_encode($json);
  echo $response;
  exit;
}

$result = $stmt->get_result();
$row = $result->fetch_assoc();
$json = array(
  "data" => array(
    "user_id" => $row["user_id"],
    "todos" => $row["todos"],
  ),
  "valid" => true,
);

$response = json_encode($json);
echo $response;

?>


