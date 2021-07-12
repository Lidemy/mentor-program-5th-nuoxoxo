<?php

session_start();
require_once("conn.php");
require_once("utils.php");

$username = NULL;

if (!empty($_SESSION["username"])) {
  $username = $_SESSION["username"];
  $user = getUserFromSession($username);
}

if ($user["role"] !== "ADMIN") {
  header("Location: index.php");
  exit;
}

if ((empty($_GET["page"])) || $_GET["page"] == 0){
  $page = 1;
} else {
  $page = $_GET["page"];
}

$sql_admin = "SELECT id, role, nickname, username, created_at FROM a_users ORDER BY created_at DESC LIMIT ? OFFSET ? ";

$limit = 20;
$offset = $limit * ($page - 1);
$stmt = $conn->prepare($sql_admin);
$stmt->bind_param("ii", $limit, $offset);
$result = $stmt->execute();

if (!$result) {
  die("Error: " . $conn->error);
}

$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>留言板</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <main class="board">
    <header class="warning">注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。</header>
    <h1 class="board__title">留言板</h1>
    <div class="btn__visit noselect">
      <?php if (!$username) { ?>
        <a href="register.php" class="board__btn">註冊</a>
        <a href="login.php" class="board__btn">登入</a>
      <? } else { ?>
        <a href="handle_logout.php" class="board__btn">登出</a>
        <span class="board__btn update-nickname">改名</span>
        <? if ($user["role"] === "ADMIN") {?>
          <a href="index.php"class="board__btn">返回</a>
        <? } ?> 
        <form id="form__update-user" method="POST" action="handle_update_user.php" class="hide board__nickname-form board__new-comment-form" value="update_nickname">
          <div class="board__nickname" style="display: inline-block;">
            <span>新的暱稱：</span>
            <input type="text" name="nickname" />
          </div>
          <input class="update-nickname-btn" type="submit" value="確認"/>
        </form>
        <h4 style="margin:12px 0 12px 0;font-weight:normal;">歡迎回來，<p style="display:inline;color:#5c9edc;"><?=escape($user["nickname"])?></p> ！</h4>
      <? } ?>
    </div>

    <div class="hr"></div>

    <session>
      <table class="admin-table noselect">
        <tr>
          <th>ID</th>
          <th>權限</th>
          <th>暱稱</th>
          <th>用戶名</th>
          <th>改身分</th>
        </tr>
        <?php while($row = $result->fetch_assoc()){ ?>
        <tr>
          <td><?=escape($row["id"]) ?></td>
          <?if ($row["role"] === "BANNED") {?>
            <td style="color:red"><?=escape($row["role"]) ?></td> 
          <?} else if ($row["role"] === "ADMIN") {
            if ($row["username"] === $username) {?>
            <td style="color:#04AA6D">你本人</td>
            <?}else {?>
            <td style="color:#04AA6D"><?=escape($row["role"]) ?></td> 
            <?}
          } else {?>
            <td><?=escape($row["role"]) ?></td>
          <?}?>
          <td><?=escape($row["nickname"]) ?></td>
          <td><?=escape($row["username"]) ?></td>
          <td>
            <a class="edit-btn" href="handle_update_role.php?role=ADMIN&id=<?=escape($row['id']);?>">管理者</a> / 
            <a class="edit-btn" href="handle_update_role.php?role=NORMAL&id=<?=escape($row['id']);?>">一般人</a> / 
            <a class="edit-btn" href="handle_update_role.php?role=BANNED&id=<?=escape($row['id']);?>">停權</a>
          </td>
        </tr>
      <?}?>
      </table>
      
    </session>

    <div class="hr" style="margin-top:32px"></div>

    <?php 

    $sql_users = "SELECT COUNT(id) as count FROM a_users";
    $stmt = $conn->prepare($sql_users);
    $result = $stmt->execute();
    if (!$result) {die("Error: " . $conn->error);}
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $row["count"];
    $page_total = ceil($count / $limit);
    
    ?>

    <div class="page">
      <div class="pagecount">
        <span>共 <?= escape($count) ?> 個用戶</span><br>
        <span>頁數：<?= $page ?> / <?= $page_total ?></span>
      </div>
      <div class="pagination">
        <?php if ($page == 1 || $page == 0) { ?>
          <a href="admin.php?page=<?= escape($page) + 1 ?>" class="page-btn">下一頁</a>
        <? } else if ($page < $page_total and $page > 1) { ?>
          <a href="admin.php" class="page-btn">回到首頁</a>
          <a href="admin.php?page=<?= escape($page) - 1 ?>" class="page-btn">上一頁</a>
          <a href="admin.php?page=<?= escape($page) + 1 ?>" class="page-btn">下一頁</a>
          <a href="admin.php?page=<?= escape($page_total) ?>" class="page-btn">最後一頁</a>
        <? } else if ($page == $page_total) { ?>
          <a href="admin.php" class="page-btn">回到首頁</a>
          <a href="admin.php?page=<?= escape($page) - 1 ?>" class="page-btn">上一頁</a>
        <? } else if ($page > $page_total) { header("Location: admin.php"); } ?>
      </div>
    </div>

  </main>
</body>
<script type="text/javascript" src="utils.js"></script>
</html>