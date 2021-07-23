<?php

require_once("conn.php");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");

if (
  empty($_POST["content"]) ||
  empty($_POST["nickname"]) ||
  empty($_POST["site_key"])
) 
{
  $json = array(
    "good" => false,
    "msg" => "Missing input."
  );
  $response = json_encode($json);
  echo $response;
  exit;
}

$nickname = $_POST["nickname"];
$site_key = $_POST["site_key"];
$content = $_POST["content"];

$sql_query = "INSERT INTO a_discussions (site_key, nickname, content) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql_query);
$stmt->bind_param("sss", $site_key, $nickname, $content);
$result = $stmt->execute();

if (!$result) {
  $json = array(
    "good" => false,
    "msg" => "Error."
  );
  $response = json_encode($json);
  echo $response;
  exit;
} else {
  $json = array(
    "good" => true,
    "msg" => "Posted successfully!"
  );
  $response = json_encode($json);
  echo $response;
}


/* TEST

curl -H "Content-type: application/x-www-form-urlencoded" -X POST -d "site_key=nxu&nickname=nuo&content=helloworld" http://localhost:8080/bbs_api/api.php

curl -H "Content-type: application/x-www-form-urlencoded" -X POST -d "site_key=mal&nickname=malco&content=fuss" http://localhost:8080/bbs_api/api.php

*/


?>

