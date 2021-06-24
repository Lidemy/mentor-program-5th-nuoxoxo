# 六到十週心得

跟一位寫 teradata 的跑步前輩聊天，聽說很多非程序專業人士都在學校學過 PHP 。詬病 PHP 的話梗也很多。這可能讓不少人看不起 PHP ，但我沒有，反而很想學 

不巧的是，在交了第9週作業( Lidemy 時間第 7 週)後，學習心態整個 burned out 了。加上一直有做開兼職(帶小孩子 workshop) + 前一陣子又接了份小工，二度燒乾。想家++，心情最低

燃燒週期在學新語言的節點完結，不知又要等多久

本週進入 week 11。昨晚把 PHP/SQL 作業交完、寫好遊戲心得後，才覺得狀態有在恢復

半年後再約前輩，我們都胖了。鬥志重燃。是時候重啟 Lidemy 的遠征 + 減磅計畫

# Game #1 - 綜合能力測驗

頁面一片空白，第一時間打開偉大好用的 devtool。老實說除了打開 devtool 不知還能幹什麼。Source code 一開始就接入了 `conn.php` ，`<body>`是一段被 comment out 的 php ，往下還用到了 sql query 。很自然地，第一時間想到打開 XAMPP 想去連連看⋯⋯ 

經驗不足才會想去連連看 {汗.}

仔細檢查發現 isset() 中用 GET 試圖獲取一個值。這是解答關鍵。而且在 GET 過程中 htmlspecialchars() 會將特殊字符搓成能夠匹配 HTML 的模樣

另一個 isset() 同理。用 query string 將二者帶上去。`norestriction` 不等於任何 value 只留下等號的話也可以 ：

`?mode=start&norestriction=`

之後頁面出現提示 #1-2

這時只要 devtool 開著，那麼連 hint #3-5 也逃不過你的眼睛。做得細緻一點的話，可以在 devtool 中將所有 `display: none` 的 css 都勾消 ： 

```
.hidden {
  display: none;
} ---> uncheck

//連帶把 input type submit 也勾消

input {
  display: none;
} ---> uncheck
```

按鈕出現。按下後會被提示漏掉了什麼

根據 hint #4 查閱後台的腳本 game/script.js ，發現是很熟悉的 request 

看到 data 部分，程式碼查證 myMissingNumberToSetToMakeTheRequest 的賦值

如果這樣做(像我)：
`index.php?mode=start&norestriction=1?myMissingNumberToSetToMakeTheRequest=`
是沒用的

正確的做法是在 console 直接跟他溝通(對方畢竟是電腦/script/網絡)：
`myMissingNumberToSetToMakeTheRequest = 0` 

然後提示「數字錯誤」。這時我有預感已經接近尾聲，可是進一步提示是一串不知道什麼
`54ceb91256e8190e474aa752a6e0650a2df5ba37`

而且誰會那麼聰明聯想到 SHA-1 Decrypt ??
此處卡關很長時間(坦白說為了過關我找了幫手)

答案 56 。Huli 大大似乎鍾情這個數字，第5週複習 HTTP GAME 中已經見識大大對 56 的愛

# Game #2 - r3:0 Challenge

異世界，是我第一次用 PHP 寫這種非實用性的題
第 5 週 HTTP Challenge 用的是 node.js，相映成趣 

「實用」是指「現實世界問題」，像 BBS 留言板這樣；「非實用」則是像 AOC 那樣的純解題、數學 heavy 那種


lv1-9 都沒有多大問題
lv10 需要花點心思。我的做法是寫 js 算法，把可能的字符組合列出來。合格的組合雖然是海量，但亂猜仍是不太可能。這一關最小的 integer token 是
`/lv10.php?token=00000201`

使用最少不同字母(從 a 開始)的是:
`/lv10.php?token=aaacadab`

只用`[`和`]`應該是不行，若帶上一個`_`就可以:
`/lv10.php?token=[[[][_[[`

純波浪(8條)不可以。改成 7 條 + 一個其他字符才行
`/lv10.php?token=~~~~~}~~`

同理，這些都行：
```
/lv10.php?token=~~~~}~}~
/lv10.php?token=~~~~}~~}
/lv10.php?token=~~~~}~~{
```

括號`{`、`}`配合波浪其實組合也滿多的
```
/lv10.php?token=~}{{{}{~
/lv10.php?token=~{}{{}{~
```
不甘寂寞的顏文字(們)：
```
/lv10.php?token=^^^`^_^b
/lv10.php?token=^^^`_`^b
/lv10.php?token=^_^`^_^b
/lv10.php?token=^_^`__`b
```

lv11 ：第一次玩的時候，那個 glacier-app 總是 404
後來修好，換到 `https://r30-api.herokuapp.com/api.php` 沒多大問題

lv12 ：受過 week 5 洗禮，遇到 request 我都轉用 terminal 並 curl。所以也不難
`$ curl http://r30challenge.herokuapp.com/news_api.php\?id\=888888`
`$ 能看到這則留言的你，想必就是天選之人吧！ {fakeituntilyoumakeit} 拯救這個世界吧！%`

lv14 ：真正難的是 lv14 ，要求在 network 試出唯一一組4位數。自首：實在無計可施的情況下 consult 網上攻略（直到截稿的此刻，都沒想出可行的做法）

lv15 ：難題不應該在 lv 15，但也算很難
一開始曾打算把 token 用「窮盡法」試出來，以下是測試用的 php code ：
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
很快就發現這樣做實在天真，路明顯走錯
最終設計好的程式是直接把 token 接出來(寫出來才發現是可以做到)：
```php
<?php

// 找出 $a
$token = "";
$a = (date("H") + 6) * date("i") + 42;
echo "a = " . $a . "<br>";

// 求得 $count
$count = 0;
for ($c = 1; $c < $a; $c++) {
    if ($a % $c === 0) {
        $count = $c;
    }
}

// 計算所有 ord(token[i]) 的總和
$sum = (65 * 8) + $count;
echo "count: " . $count . "<br>" . "sum: " . $sum . "<br>";

// O (79)  ^ (94)  ~ (126)  x (120)  i (105)  s (115)  y (121)  
$ascii = 94; // 測試用的字符的 ord

// L
$num_L = floor($sum / $ascii);
echo "Number of slots on the LEFT: " . $num_L . "<br>";
$str_L = "";
for ($i = 0; $i < $num_L; $i++) {
    $str_L .= chr($ascii);
}

// R
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

算出來答案是對的，但 token 是錯的... 因為沒想到最重要一點：時差

最終答案：OOOOOOOP
一個20秒後失效的答案
