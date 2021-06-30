<?php
session_start();
require_once("conn.php");
require_once("utils.php");

$username = NULL;
if (!empty($_SESSION["username"])) {
  $username = $_SESSION["username"];
  $user = getUserFromSession($username);
}

$sql_load = "SELECT * FROM a_bbs ORDER BY created_at DESC";
$stmt = $conn->prepare($sql_load);
$result = $stmt-> execute();

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
    <header class="warning">注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。</header><h1 class="board__title">留言板</h1>
    <div>
      <?php if (!$username) { ?>
        <a href="register.php" class="board__btn">註冊</a>
        <a href="login.php" class="board__btn">登入</a>
      <?php } else { ?>
        <a href="handle_logout.php" class="board__btn">登出</a>
        <span class="board__btn update-nickname noselect">改名</span>
        <form method="POST" action="update_user.php" class="hide board__nickname-form board__new-comment-form">
          <div class="board__nickname" style="display: inline-block;">
            <span>新的暱稱：</span>
            <input type="text" name="nickname" />
          </div>
          <input class="update-nickname-btn" type="submit" value="確認" />
        </form>
        <h4 style="margin:12px 0 12px 0;font-weight:normal;">歡迎回來，<p style="display:inline;color:#5c9edc;"><?php echo strtoupper($user["nickname"]
      ); ?></p> ！</h4>
      <?php } ?>
    </div>
    <form class="board__new-comment-form" method="POST" action="handle_add_comment.php">
      <div class="board__content">
        <textarea id="content" name="content" rows="4" placeholder="您的留言" autocomplete="off"></textarea>
      </div>
      <?php if ($username) { ?>
        <input class="board__submit-btn" type="submit" value="發表" onClick="return isEmpty()"/>
      <?php } else { ?>
        <h3>請登入發布留言</h3>
      <?php } ?>
    </form>
    <div class="board__hr"></div>
    <section>
      <?php while ($row = $result->fetch_assoc()) { ?>
      <div class="card">
        <div class="card__avatar">
        </div>
        <div class="card__body">
          <div class="card__info">
            <span class="card__author"><?= escape($row["nickname"])  ?></span>
            <span class="card__time"><?= $row["created_at"] ?></span>
          </div>
          <p class="card__content">
            <?= escape($row["content"]) ?>
          </p>
        </div>
      </div>
      <?php } ?>
    </section>
  </main>
</body>
<script>
var btn = document.querySelector(".update-nickname")

if (btn !== null) {
  btn.addEventListener("click", function() {
    var form = document.querySelector(".board__nickname-form")
    form.classList.toggle("hide")
  })
}

function isEmpty() {
  if (!document.getElementById("content").value) {
    alert("留言內容為空白");
    return false;
  }
}
</script>
</html>