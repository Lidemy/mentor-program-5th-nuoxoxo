<?php
$uri = $_SERVER["REQUEST_URI"];
$isPathAdmin = (strpos($uri, "admin.php") == false);
?>

<nav class="navbar">
  <div class="wrapper navbar__wrapper">
    <div class="navbar__site-name">
      <a href='index.php'>BLOGSPOT</a>
    </div>
    <ul class="navbar__list">
      <div>
        <!-- <li><a href="index.php">主頁</a></li> -->
        <!-- <li><a href="#">文章列表</a></li>
        <li><a href="#">分類專區</a></li>
        <li><a href="#">關於我</a></li> -->
      </div>
      <div>
        <?php if (!empty($_SESSION["username"])) { ?>
          <? if ($isPathAdmin) { ?>
            <li><a onclick="goBack()">返回</a></li>
            <li><a href="admin.php">管理後台</a></li>
          <? } else { ?>
            <li><a onclick="goBack()">返回</a></li>
          <? } ?>
          <li><a href="create.php">寫新 PO 文</a></li>
          <li><a href="handle_logout.php">登出</a></li>
        <? } else { ?>
          <li><a href="login.php">登入</a></li>
        <? } ?>
      </div>
    </ul>
  </div>
</nav>
<section class="banner">
  <div class="banner__wrapper">
    <h1><?php $n = rand(1, 7);
        if ($n == 1) {
          echo "(=^ェ^=)";
        } elseif ($n == 2) {
          echo "(ᵔᴥᵔ)";
        } elseif ($n == 3) {
          echo "昭和十大部落格";
        } elseif ($n == 4) {
          echo "♪♪♪♫•*¨*•.¸¸♪";
        } elseif ($n == 5) {
          echo "肉";
        } elseif ($n == 6) {
          echo "(・_・ヾ";
        } elseif ($n == 7) {
          echo "( ͡° ʖ̯ ͡°)";
        } ?></h1>
    <div><?php $n = rand(1, 7);
          if ($n == 1) {
            echo "( ͡° ͜ʖ ͡°)";
          } elseif ($n == 2) {
            echo "很好";
          } elseif ($n == 3) {
            echo "愛自由";
          } elseif ($n == 4) {
            echo "大自然";
          } elseif ($n == 5) {
            echo "古代";
          } elseif ($n == 6) {
            echo "昭和十大部落格";
          } elseif ($n == 7) {
            echo "有一種感覺";
          } ?></div>
  </div>
</section>
<script>
  function goBack() {
    window.history.back();
  }
</script>