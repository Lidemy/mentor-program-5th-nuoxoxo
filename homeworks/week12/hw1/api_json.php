<?php

require_once("conn.php");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");

if (empty($_GET["site_key"])) {
  $json = array("good" => false, "msg" => "Missing site key.");
  $response = json_encode($json);
  echo $response;
  exit;
}

$site_key = $_GET["site_key"];

// $before = $_GET["before"];

$sql_query = "SELECT id, nickname as ni, content as co, created_at as cr FROM a_discussions WHERE site_key = ? AND del IS NULL "
.
// (empty($_GET["before"]) ? "" : " AND cr < ? ")
(empty($_GET["before"]) ? "" : " AND id < ? ")
.
"ORDER BY cr DESC LIMIT 10";

$stmt = $conn->prepare($sql_query);

if (empty($_GET["before"])) {
  $stmt->bind_param("s", $site_key);
} else {
  $stmt->bind_param("si", $site_key, $_GET["before"]);
}

$result = $stmt->execute();

if (!$result) {
  $json = array("good" => false, "msg" => "Something's wrong.");
  $response = json_encode($json);
  echo $response;
  exit;
}

$result = $stmt->get_result();
$posts = array();

while ($row = $result->fetch_assoc()) {
  array_push($posts, array(
    "id" => $row["id"],
    "nickname" => $row["ni"], 
    "content" => $row["co"],
    "created_at" => $row["cr"]
  ));
}

$json = array("good" => true, "posts" => $posts);
$response = json_encode($json);
echo $response;



// 嘗試應該怎樣把 created_at 通過 query string 傳給 SQL

// CONVERT(datetime, '2017-08-25')

// SELECT id as id, nickname as ni, content as co, created_at as cr FROM a_discussions WHERE site_key = nxu AND cr > CONVERT(datetime, '2021-07-19 20:48:18') ORDER BY id DESC LIMIT 3


?>


