<?php

require_once "conn.php";

// Get User
function getUserFromSession($username) {
  global $conn;
  $user_sql = $conn->query(
    "SELECT * FROM a_users WHERE username = '$username'"
  );
  $user = $user_sql->fetch_assoc();
  return $user;
}

// text formatting against xss
function escape($str) {
  return htmlspecialchars($str, ENT_QUOTES);
}

?>