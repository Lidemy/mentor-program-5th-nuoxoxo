<?php

session_start();
require_once("conn.php");
require_once("utils.php");

$username = NULL;

if (!empty($_SESSION["username"])) {
  $username = $_SESSION["username"];
  $user = getUserFromSession($username);
}

if ((empty($_GET["page"])) or $_GET["page"] == 0){
  $page = 1;
} else {
  $page = $_GET["page"];
}

$sql_load = 
"SELECT bbs.id as id, 
bbs.content as content, 
bbs.created_at as created_at, 
bbs.is_deleted as is_deleted, 
users.nickname as nickname, 
users.username as username 
FROM a_bbs as bbs 
LEFT JOIN a_users AS users ON bbs.username = users.username 
WHERE is_deleted IS NULL ORDER BY created_at DESC LIMIT ? OFFSET ? ";

$limit = 10;
$offset = $limit * ($page - 1);
$stmt = $conn->prepare($sql_load);
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
      <?} else {?>
        <a href="handle_logout.php" class="board__btn">登出</a>
        <span class="board__btn update-nickname">改名</span>
        <? if ($user["role"] === "ADMIN") {?>
          
          <a href="admin.php"class="board__btn handle-admin">管理</a>
        <?}?> 
        <form id="form__update-user" method="POST" action="handle_update_user.php" class="hide board__nickname-form board__new-comment-form" value="update_nickname">
          <div class="board__nickname" style="display: inline-block;">
            <span>新的暱稱：</span>
            <input type="text" name="nickname" />
          </div>
          <input class="update-nickname-btn" type="submit" value="確認"/>
        </form>
        <h4 style="margin:12px 0 12px 0;font-weight:normal;">歡迎回來，<p style="display:inline;color:#5c9edc;"><?= $user["nickname"]; ?></p> ！</h4>
      <?}?>
    </div>
    <form class="board__new-comment-form" method="POST" action="handle_add_comment.php">
      <div class="board__content">
        <textarea id="content" name="content" rows="4" placeholder="您的留言" autocomplete="off"></textarea>
      </div>
      <?php if ($username) { 
        if ($user["role"] === "BANNED") { ?>
          <header class="warning">抱歉，你已被停權</header>
        <?} else {?>
          <input class="board__submit-btn" type="submit" value="發表"/>
        <? }
      } else { ?>
        <h3>請登入發布留言</h3>
      <?}?>
    </form>

    <div class="hr"></div>
    
    <section>
      <?php while ($row = $result->fetch_assoc()) { ?>
      <div class="card">
        <div class="card__avatar"></div>
        <div class="card__body">
          <div class="card__info noselect">
            <span class="card__author">
              <?= escape($row["nickname"])  ?>
              (@<?= escape($row["username"]) ?>)
            </span>
            <span class="card__time"><?= escape($row["created_at"]) ?></span>
            <?php if (!empty($_SESSION["username"])) { 
              if ($user["role"] === "BANNED") { ?>
                <a class="disabled-btn">回覆</a>
              <?} else {?>
                <a class="reply-comment edit-btn ">回覆</a>
              <? } 
            } ?>
            <?php if ($row["username"] === $username) { 
              if (!$user["role"] === "BANNED") { ?>
                <a class="disabled-btn ">編輯</a>
                <a class="disabled-btn ">刪除</a>
              <?} else {?>
              <a class="update-comment edit-btn ">編輯</a>
              <a class="delete-comment edit-btn " method="POST" href="handle_del_comment.php?id=<?= $row['id'] ?>">刪除</a>
              <? } 
            } ?>
          </div>          
          <p class="card__content"><?= escape($row["content"]) ?></p>
          <form id="form__update-comment" method="POST" action="handle_update_comment.php?id=<?= $row['id'] ?>" class="hide /*board__new-comment-form*/">
            <div class="board__nickname" style="margin-bottom:0px;">
              <textarea name="updated_comment" rows="4" autocomplete="off"><?= escape($row["content"]) ?></textarea>
            </div>
            <input class="update-comment-btn" type="submit" value="提交" />
          </form>
        </div>
      </div>
      <?}?>
    </section>
    
    <div class="hr"></div>

    <!-- Pagination -->
    <?php 

    $sql_info = "SELECT COUNT(id) as count FROM a_bbs WHERE is_deleted IS NULL";
    $stmt = $conn->prepare($sql_info);
    $result = $stmt->execute();
    if (!$result) {die("Error: " . $conn->error);}
    
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $row["count"];
    $page_total = ceil($count / $limit);
    
    ?>

    <div class="page">
      <div class="pagecount">
        <span>共 <?= $count ?> 條留言</span><br>
        <span>頁數：<?= $page ?> / <?= $page_total ?></span>
      </div>
      <div class="pagination">
        <?php if ($page == 1 or $page == 0) { ?>
          <a href="index.php?page=<?= $page + 1 ?>" class="page-btn">下一頁</a>
        <? } else if ($page < $page_total and $page > 1) { ?>
          <a href="index.php" class="page-btn">回到首頁</a>
          <a href="index.php?page=<?= $page - 1 ?>" class="page-btn">上一頁</a>
          <a href="index.php?page=<?= $page + 1 ?>" class="page-btn">下一頁</a>
          <a href="index.php?page=<?= $page_total ?>" class="page-btn">最後一頁</a>
        <? } else if ($page == $page_total) { ?>
          <a href="index.php" class="page-btn">回到首頁</a>
          <a href="index.php?page=<?= $page - 1 ?>" class="page-btn">上一頁</a>
        <? } else if ($page > $page_total) { header("Location: index.php"); } ?>
      </div>
    </div>

  </main>
</body>
<script type="text/javascript" src="utils.js"></script>
</html>