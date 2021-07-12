<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>留言板：登入</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <main class="board">

    <header class="warning">注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。</header>
    <h1 class="board__title">登入頁面</h1>
    <div>
      <a href="index.php" class="board__btn">返回</a>
      <a href="register.php" class="board__btn">註冊</a>
    </div>
    <form class="board__new-comment-form" method="POST" action="handle_login.php">
      <div class="board__nickname">
        <span>帳號</span>
        <input id="username" type="text" name="username" autocomplete="off">
      </div>
      <div class="board__nickname">
        <span>密碼</span>
        <input id="password" type="password" name="password" autocomplete="off">
      </div>
      <input class="board__submit-btn" type="submit" value="登入" onClick="return isEmpty()" />
    </form>
  </main>
</body>
<script>
  function isEmpty() {
    if (!document.getElementById("username").value || !document.getElementById("password").value) {
      alert("資料不齊全");
      return false;
    }
  }
</script>

</html>