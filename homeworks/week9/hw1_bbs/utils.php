<?php

require_once("conn.php");

// Get User
function getUserFromSession($username) {
  global $conn;
  $user_sql = $conn->query(
    "SELECT * FROM a_users WHERE username = '$username'"
  );
  $user = $user_sql->fetch_assoc();
  return $user;
}

// Generate token
function genToken() {
  $str = "";
  for ($i = 0; $i < 16; $i++) {
    $str .= chr(rand(65, 90));      
  }
  return $str;
}

?>