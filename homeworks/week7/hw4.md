## 什麼是 DOM？

DOM 是 Document Object Model 的縮寫，即「文檔對象模型」

可以把 DOM 理解成一個「界面」(interface)，這個界面會將 HTML 文件的樹狀邏輯表現出來。表現形式往往是一個巨大的(有多大視乎內容有多少)物件，便於我們修改和操作網頁的功能。除了 HTML ，DOM 還可以處理 XML 頁面

使用 JavaScript 可以動態操作 DOM 的內容。MDN 上說 `API (web 或 XML 页面) = DOM + JS (脚本语言)`，沒錯應該是這樣


## 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？

假設我們在一個根節點加上一個名為 e 的 DOM 事件，「e」事件會從它祖先根節點出發，向下順藤摸瓜，一直傳遞到事件發生的現場 `e.target` 本身。這個過程是捕獲階段 ( capturing phase )

若沒有其他限制，例如 `e.preventDefault()`，「e」在到達 target 的瞬間就會循原路浮上來，這是 ( bubbling phase ) 冒泡階段，是捕獲階段的反過程

內建函式 eTarget.addEventListener() 有 3 個 parameters：除了 type (事件類型) 和 listerner function (監聽行動函式) 外，第 3 個是布林參數 useCapture 

這個參數一般不會寫出來是因為他默認為 false 。初級玩家只需要記住事件的傳遞順序的兩個原則：
- 先捕獲，再冒泡
- 當事件傳到 target 本身，沒有分捕獲跟冒泡


## 什麼是 event delegation，為什麼我們需要它？

我理解的 event delegation 的意思是：

例如一個 parent-element 下面有好多個 li 或好幾個 button 。為了監聽每一個 li 或按鈕，最好的做法 ( 不是監聽每個 element 本身，而是 ) 監聽他們的 parent-element 並且將任務「分配」(delegate) 下去。例如作業裡我們監聽 form 或 todo-list ，進入函式後用 if 條件將不同的事件「delegate」到不同的 handler functions


## event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？

event.stopPropagation() 顧名思義是「停止傳播」，他的作用是中止事件傳遞，執行順序上排在他後面的 listener 無法再監聽到任何事件。注意，同一個節點上如果有其他 listerner 的話，仍然會執行

event.preventDefault() 意為「防止默認」，作用是取消預設行為。像作業中對 form 添加監聽事件，listener on click ( submit 的 click ) ，監聽函式中的 e.preventDefault 會阻止 form 的「送出表單」這個預設行動。阻止超連結，是 event.preventDefault() 最常見的用途




