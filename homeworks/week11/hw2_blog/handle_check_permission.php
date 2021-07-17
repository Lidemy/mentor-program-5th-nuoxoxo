<?php 
if (empty($_SESSION["logon_name"])) {
  $message = "你在嘗試超越，請不要超越";
  echo "
    <script>window.location.href='login.php';
    alert('$message');
    </script>
  ";
  exit;
}
?>