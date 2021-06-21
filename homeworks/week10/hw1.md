# 六到十週心得

跟一位寫 teradata 的前輩聊了一下，聽說 PHP 是很多非程序工程師在學校學過的語言，關於 PHP 的詬病和話梗也很多。這讓一些人看不起 PHP ，但我沒有，反而很想學 PHP 

不巧的是，把第9週作業( Lidemy 時間第 7 週)交上去後，心態整個 burned out 了。自己一直有做開兼職(小孩子 workshop) + 前一陣子又接了一份小工來做，二度燒乾。想家，心情最低。燃燒週期在學新語言的節點完結，不知要等多久

本週進入 week 11。昨晚交了 PHP/SQL 作業和寫好遊戲心得後，才覺得狀態有在恢復

半年後再約前輩，兩人都胖了。接著要重啟 Lidemy 的遠征 + 減肥計畫

# Game #1 - 綜合能力測驗

空白。

第一步打開 chrome 偉大好用的 devtool。老實說不知還能幹什麼除了打開 devtool 。`<body>`是一段 php ，開頭 require conn.php 然後用到 sql query 。所以，第一時間想到打開 XAMPP 想去連連看 ⋯⋯ 

經驗不足才會想去連他。解題關鍵是 isset() 中用 GET 去 get 一個值，過程中 htmlspecialchars() 會將特殊字符搓成 HTML 匹配的樣子。另一個 isset() 同理。`norestriction` 不等於任何 value，留下等號也可以 

Solution:
`?mode=start&norestriction=`

雖然頁面只出現了提示 #1-2，但只要 devtool 一直開著，就可以提前看見 hint #3-5 ，也可以勾消 .hidden 

Solution:
```
.hidden {
  display: none;
} ---> uncheck

//連帶把 input type submit 也勾消

input {
  display: none;
} ---> uncheck
```

按下按鈕被提示漏掉了什麼。根據 hint #4 查閱後台的 game/script.js 腳本，很熟悉的 request 。data 部分表示會查證 myMissingNumberToSetToMakeTheRequest 的值

這樣做，
`index.php?mode=start&norestriction=1?myMissingNumberToSetToMakeTheRequest=`
是沒有用，應該用 console 直接跟他溝通

Solution:
`myMissingNumberToSetToMakeTheRequest = 0` 
提示「數字錯誤」，進一步提示是一串不知道什麼

此處卡關很長時間（怎麼會聯想到 SHA-1 decrypt）

答案 56 。Huli 大大似乎鍾情這個數字，在第五週複習 HTTP GAME 中見過

# Game #2 - r3:0 Challenge

「異世界」是我第一次用 PHP 寫這種非實用性的題。Week 5 HTTP Challenge 用的是 node.js 

lv1-9 都沒有多大問題
lv10 需要花點心思。我的做法是寫 js 算法，把可能的字符組合列出來。雖然存在大量合格的組合，但亂猜是不太可能

最小的 int 通關 token 是
`/lv10.php?token=00000201`

從 a 開始用最少不同字母的是
`/lv10.php?token=aaacadab`

只用`[`和`]`應該是不行，但若帶上一個`_`就可以
`/lv10.php?token=[[[][_[[`

純波浪(8條)不可以。改成 7 條可以
`/lv10.php?token=~~~~~}~~`

同樣地，這些都行：
```
/lv10.php?token=~~~~}~}~
/lv10.php?token=~~~~}~~}
/lv10.php?token=~~~~}~~{
```

這種括號`{`、`}`配合波浪其實組合也是超多例如
```
/lv10.php?token=~}{{{}{~
/lv10.php?token=~{}{{}{~
```
最喜歡的是顏文字：
```
/lv10.php?token=^^^`^_^b
/lv10.php?token=^^^`_`^b
/lv10.php?token=^_^`^_^b
/lv10.php?token=^_^`__`b
```

第一次玩的時候，那個 glacier app 是404
後來修好了換到 `https://r30-api.herokuapp.com/api.php` 

有了 week 5 經驗，遇到 request 我都會轉到 terminal 使用 curl。所以 lv12 也不難
`curl Request URL: http://r30challenge.herokuapp.com/news_api.php\?id\=888888`

真正的難題是 lv 14 要在 network 試出唯一一組4位數。這一關是我唯一 consult 網上攻略，實在沒辦法（截稿的此刻我都沒想出來靠譜的做法）

真正的難題不應該在 lv 15，但他也是很難
一開始，打算把 token 用「窮盡法」試出來：
```php
function genStr($len) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $randStr = "";
    for ($i = 0; $i < $len; $i++) {
        $randStr .= $chars[rand(0, strlen($chars) - 1)];
    }
    return $randStr;
}
$test = genStr(8); 
```
很快就發現這樣做實在天真

最終設計好的程式碼是這樣：
```php
// 沒有辦法中的辦法
<?php function isTokenValid($token) {
    $h = date('H');
    $m = date('i'); 
    $a = $h * $m + 42;
    $count = 0;
    for($i = 0; $i < 8; $i++) {
        $count += ord($token[$i]) - 65;
    }
    if ($count <= 100) {
        return false;
    }
    return $a % $count === 0;
}
?>

<?php

// $a
$token = "";
$a = (date("H") + 6) * date("i") + 42;
echo "a = " . $a . "<br>";

// $count
$count = 0;
for ($c = 1; $c < $a; $c++) {
    if ($a % $c === 0) {
        $count = $c;
    }
}

// SUM of all ord(token[i])
$sum = (65 * 8) + $count;
echo "count: " . $count . "<br>" . "sum: " . $sum . "<br>";

// O (79)  ^ (94)  ~ (126)  x (120)  i (105)  s (115)  y (121)  
$ascii = 94;

// Left side of the string
$num_L = floor($sum / $ascii);
echo "Number of slots on the LEFT: " . $num_L . "<br>";
$str_L = "";
for ($i = 0; $i < $num_L; $i++) {
    $str_L .= chr($ascii);
}

// Right side
$tmp = $sum - (($num_L) * $ascii);
echo $tmp . "<br>";

$str_R = "";
if ($num_L == 6) {
    for ($i = 0; $i = 2; $i++){
        $str_R .= chr($tmp / 2);
    }
} else if ($num_L == 7) {
    $str_R = chr($tmp);
}
echo "L : " . $str_L . "<br>" . "R : " . $str_R . "<br>" . $str_L . $str_R . "<br>";
?>
```

算出來了，答案是對的！但 token 是錯的... 

沒想到最重要一點：時差


