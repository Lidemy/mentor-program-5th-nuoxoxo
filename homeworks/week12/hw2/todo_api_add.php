<?php

require_once("conn.php");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");

if (empty($_POST["todos"])) {
  $json = array(
    "valid" => false,
    "msg" => "Missing input."
  );
  $response = json_encode($json);
  echo $response;
  exit;
}

$todos = $_POST["todos"];

$sql_query = "INSERT INTO a_todos (todos) VALUES (?)";
$stmt = $conn->prepare($sql_query);
$stmt->bind_param("s", $todos);
$result = $stmt->execute();

if (!$result){
  $json = array(
    "valid" => false,
    "msg" => $conn->error
  );
  $response = json_encode($json);
  echo $response;
  exit;
} 

$json = array(
  "valid" => true,
  "msg" => "Posted successfully!",
  "user_id" => $conn->insert_id
);
$response = json_encode($json);
echo $response;

?>

