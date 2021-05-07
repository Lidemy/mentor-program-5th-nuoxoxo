# 心得 1：前四週心得與解題心得

### 搞清楚狀況

前四週還算順利吧，一開始還滿曲折的

第一週就找不到 **[MTR05]**。本來就是訂閱方案的用戶了。課程表單中有第一期，卻沒有第五期，以為是正常的，直到發現好像哪裡怪怪的。問 Huli 大大，原來自己沒有透過連結加入，囧

然後找不到 **Classroom** 。Classroom 是 Github 造福人類的用來組建訓練營的平台，之前在 CS50 已經熟悉其用法（事實上 CS50 沒有用 Classroom）。只好找 Huli 大人求救，手動加進去，冏

然後找不到 **學 習 系 統**，這意味著我將失去第一週的進度報告。學習系統指的應該是 learning.lidemy.com 這邊吧，為什麼學習系統一片空白? 郵件說「加入之後沒有東西是正常」，因此一直以為是正常 (汗) 。直到又發現，好像哪裡怪怪的。找 Huli 大大，手動加進去，OTZ

（電腦白痴哇.. 汗）

Lesson learned：有問題，找 Huli

### 最大的收穫：Git

烏龍過後，鼓舞的事陸續發生

CS50 最後一週 Problem Set 趕在 MTR05 開學前 submit 。這意味著不用兼顧兩遍，專注在 Lidemy 深度耕耘就好了。CS50 有要求交 final project 我非常希望到時能用上在 Lidemy 所學，幹票大的 :)

前四週的 究 極 收 穫，我覺得是 Git 

第二期師兄 Tom 的[畢業心得](https://github.com/Lidemy/mentor-program-2nd/issues/12)下有這樣一句：「交作業的流程，其實就跟多人協作的團隊 git 操作差不多」

不諱言，一直以來 git 對我來說就是 Desktop GitHub ，實在太方便了。推、拉、提交，全自動，只要不是太複雜的操作，就算不了解 branch 或 head 也能玩 git(hub) .... 

直到在命令列上使用 git，才體會到其工作原理

不只工作原理。Git 更是一種工作風格和團隊協作的態度，一切體現在流程中

每一次 commit 都面對評審（review）。雖然在 Classroom 上可以「自己 Pull 自己 Merge」但你還是需要得到某種更權威的審閱和訂正

又例如發起 PR ，Merge 以後 Pull 回來，同步本地的文件，這樣一個階段的工作才算里程碑式告一段落

這時可以 git branch -d 了
要開展新工作，checkout -b 
有條不紊，如明亮陽光

關於 git ，遇到過兩句很有意思的話，至今還經常在腦海中出現。第一句出自 freecodecamp [forum](https://www.freecodecamp.org/news/how-to-undo-changes-in-git-e1da7930afdb/)
>「一旦文件已經推出去了，想悔件就難了。所以本地的工作，如果還未到很確定的地步，就先別 push 」

>![](https://i.imgur.com/0mfTloM.png "This is a Title")

第二句源自 git 的文件指南 [Git SCM](https://git-scm.com/book/zh-tw/v2/%E4%BD%BF%E7%94%A8-Git-%E5%88%86%E6%94%AF-%E7%B0%A1%E8%BF%B0%E5%88%86%E6%94%AF#rdivergent_history)

> 時光不會讓你回到過去，因為你根本無法乾淨地回到過去

>![](https://i.imgur.com/ltqFsjz.png)


### Debug

~~寫到這裡可能已經沒有人在看~~

另一個大收穫是學到串接 **API** ，但很難一下子解釋清楚它是什麼。難入門難精通的 API ，暫時只是摸到表面，我還在海綿般吸收中

此外，這個課程另一個很好的地方，是讓你看見「Live coding, live debugging」的部分

像 Tom ([第一期師兄](https://github.com/Lidemy/mentor-program-2nd/issues/12)) 所說的，「...(debug)很難靠純自學累積。」

相信飽受 OJ 無情拒絕的學生 (包括我) 都很想看 Huli 如何做一道題，看他會不會在自己 WA 的那一題 WA 甚至出現超時爆炸什麼的

事實上，火球術和 ALG 101 就充滿著老師的卡關體驗，一旦卡關，他就開始支線任務：debugging 。這就是，對我來說，最寶貴的部分

對待 bug 的觀念、如何測試、帶著上一題的經驗、審題讀出下一題暗含的對資料描述等等。每週的 LIVE 有相同的效果


### MEMO

MEMO = Minimum efforts, maximum output

MEMO 是我從一位叫 Tina 的 data scientist 學到的，基本上就是：

|| 把問題切成小塊，每次只針對一小塊，理解這一小塊後，做題、做一個小專案、try it out，千萬別急著 move on 到下一個小塊 ||

例如學做迴圈，for loop，當你明白 for loop 的概念之後，下一步不是「遞迴」，而是嘗試印出 123456 ，印出 24681012，再嘗試印出星星，印出 n 層星星⋯⋯



以前我是「筆記型」學生，除了上課就是記筆記，筆記在不知不覺中壓榨了實作的時間。當時不明白。其實投身題海才是效率最高的方法

這讓我重新認識題海戰術：題海，不在乎題的數量，而在於要「立刻跳到海里，游泳」

Trial and error 

每次學到的新東西必須要「少」，少到確保腦部完全消化。然後，立刻做題 ( 立刻犯錯-修正-犯錯-修正 )，花最少時間，出最大成果

重複這個過程，漸漸會發現做夢也在解題，醒來打開電腦無縫銜接，這樣就上正軌了


### 其他難忘的作業

- 全加器（不可思議）
- 大數相乘 🌳🍊
- 圖書館一日店員挑戰


# 心得 2：Lidemy HTTP Challenge

「 Lidemy 圖書館一日店員」

## 方法
1. url
2. curl

## 回顧
所有錯誤、重複、盲試都被機器紀錄在案。用 history 打開，一行一行回溯就記得經歷過什麼。

![](https://i.imgur.com/QG6aky4.jpg)

旅程開始於 #9776 

結束於 #9968 

![](https://i.imgur.com/ECcT81W.jpg)


## 館務檢討

沒什麼攻略，就是不斷 trial and error\
錯 10 次對 1 次已經偷笑

有點像密室逃脫！

以下是賽後檢討的部分


###### lv 2

第 2 關，這樣是錯的
```
curl \
--header "Content-Type: application/x-www-form-urlencoded" \
--request POST --data '{"name":"大腦", "ISBN":"2021"}' \
https://.../books
```

- 首先 `{"name":"大腦","ISBN":"2021"}` 的型態是 json 不是 urlencoded
- `--request` 可簡單寫成 -X
- `--data` → -d
- `--header` → -H
- 然後方法已經是 POST 可去掉 -X
- 程式已經明顯 (explicitly) 在用 POST (-d 加上要送出的資料，這一表達足夠短和清楚) 所以可以把 POST 也去掉

好一點的做法：
```
curl -d 'name="大腦"&ISBN=2021' https://.../books
```



###### lv 4

第 4 關，query string 找「世界」能找到 4 本書，找「村上」卻一本都找不到


###### lv 8

進入 api/v2 ，query string 不接中文字符了⋯ 真就不能了嗎? 

其他站 (試了 google) 試一試，「我」這個字基於 utf-8 的 URL 編碼是 `%E6%88%91` 

貼上去吧貼上去吧


###### lv 11

這樣不對
`-H "Host: lidemy.com" https:...`
改成：
`-H "Origin: lidemy.com" https:...`

此處卡夠久

###### lv 11

據說 token 已經回傳，🧐在哪裡呢到底。原來就這麼簡單: 
`--header` 或 `-I`

（現在回頭看，header 是重點）

###### lv 13

像第九關那樣 "X-Library-Number: 20" 帶上去，要考玩家 header (同 lv11)

###### lv 14

從第八關開始，每一關都需要認真查 Documentation 。文件寫得好、通俗，真的很重要

[ curl ](https://curl.se/)的文件就給人清晰的感覺! 
[ git-scm ](https://git-scm.com/) 也是!

「案內人」也很重要。如果文件寫得晦澀難懂 (也就是 80% 以上的情況)，那就轉向 how to 一類的文章

其實更多的時候，自己更樂意直接找非文件性的資源。都是熟路的帶路人，沒什麼比他們更適合了

最好的例子是 lv 14 

[這裡 ](https://www.searchenginejournal.com/change-user-agent/368448/#close)的寫法簡單有力! ( browser 的部分同 lv9) 。果斷照搬。當然了，真正的 Googlebot 比這複雜多


## 總結

遊戲的樂趣，是卡關⋯⋯⋯後的突破所帶來的滿足感

對我來說幾乎每一關都卡關，正如 2019 的一條留言
「熟悉 curl 指令的人可以橫著走」

我是巨蟹座，但不懂橫著走 XD 
最適合的總結是，多嘗試幾次就好

還是那句，trial and error 

# 心得 3：LIOJ 題目：1016, 1017 以及 1018

如果按照測資來分類，LIOJ 的題有兩大類：
a) 測資為單行 / 單一字串
b) 測資用空格或空行分隔

這 3 題屬於第二類

## LIOJ 1018

```json=
                 -------
                 |
            ------
            |
   |---------
---|


(i love ascii art)
```

求「大平台」長度，換句話說，求最長重複組合 (就像用 DNA 資料偵察犯人那樣) 之長度

資料的核心在第 2 行，即 lines[1]，第一時間處理他

`lines[1].split(' ').map(Number)`

如果想第一步就把陣列的 elements 轉換數字
可以這樣做 `.map(x => +x)` 
這樣也可以 `.map(x => parseInt(x, 10))` 
最直觀的是 .map(Number) 

但沒必要轉類，字串可以直接比

下一步進入 loop ，每一次都用 temp 接住目前最長的 length 

temp 同時像個 counter ( 個人理解是這樣 )，當目前位置的數字/字串與下一位置相同時才會 temp++ 否則 temp = 1 重新算


## LIOJ 1017

在進度報告中曾寫
> 看了其他同學對 OJ 的反省，我也更加注意輸入條件中的規定

Huli 回復
> LIOJ 上的測資條件，就是代表測資絕對不會有超過條件的 case，所以其實是完全不忽略需要加上限制

印象中，這一題發生了相反的情況：要將題目對測資的規定加入到 if 中才能 AC ，否則會爆炸

汲取教訓，我把其他沒有通過的題也用同樣的方法改寫。函式該有限制的地方，我都加進了限制條件，例如陣列 length 的區間什麼的

這一做法不一定完全爭取

有些題 (在加進限制條件後) pass 了，例如看上去有點簡單卻卡很久的 1016 和 1034 (後者一直沒 AC 就是因為缺少對陣列 length 的限制)

一些題卻需要刪掉所有限制才會過。例如 1050 和 1035 ，重溫火球術，才發現限制條件，不僅可以不加，而且不加才能過

LIOJ 有 3 頁，最大編號 53 (為什麼有的師兄師姐做到 55+ 還有分數)

目前我已做完 53 題中的 52 題，最大的心得就是以上👆這段關於測資的感想了

## LIOJ 1016

記得這題卡過，爆炸起因是最煩的~~系統潮濕~~系統超時，但重點不是這裡。我覺得重點在 edge case：當吃飯和吃麵的票數不同，但還是和為貴 PEACE 的情況



