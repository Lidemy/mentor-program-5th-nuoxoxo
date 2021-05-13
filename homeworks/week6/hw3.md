## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。

好像比較主要的都提到了。我覺得比較好用而好像[FE101]比較少提到的是：

1. `<textarea></textarea>`
多行文字域。適用於當 input 是「留言」「請留下您的意見」這種多行的（相對於名字、email、手機號碼等等這種單行的）。在 css 可進一步為 textarea 設定 width 和 height 。textarea 也可以像單行 input 那樣設定 placeholder 這個 attribute 。作業中有用到

2. `<br>`
插入 single linebreak 。他沒有像 `</>`那樣的 closing tag ，所以嚴格來說也許不是「標籤」。但對我而言，他是最好用的 tags 僅次於 comment

3. `<!-- -->` 
註解，comment，超級常用。一直以來我都這樣寫註解: 
`<!-- <a href="#">Google</a> -->`
直到最近才知道 `!--` 可以直接包在 `< >` 裡面，即這樣寫:
`<!--a href="#">Google</a-->`


## 請問什麼是盒模型（box model）

所有的 HTML 元素都可以看成一個個 box ，而一個 box 外面往往還有更大的 box 將他抱(包)著。CSS 盒模型就是這樣從內到外將元素們按順序裝起來的機制

```
|-------------------------|
|         Margin          |
| |---------------------| |
| |       Border        | |
| | |-----------------| | |
| | |     Padding     | | |
| | | |-------------| | | |
| | | |   Content   | | | |
| | | |-------------| | | |
| | |-----------------| | |
| |---------------------| |
|-------------------------|

```

基本的盒模型由裡到外分別是: 
- Content 
  - 元素本身的內容
- Padding 
  - 內容和框線之間的空間
  - 隨著數值增大 padding 往內擴張
- Border 
  - 框線
  - 很多時候不僅僅是框線，他可以像 padding 那樣變很厚
- Margin 
  - 最外層的空間
  - Margin 的相對位置包裹以上三者，隨著數值增大會往外擴張


## 請問 display: inline, block 跟 inline-block 的差別是什麼？

#### `display: inline` 
顧名思義是「同列」。被這樣框定的元素會排同一列，前後不會換行，直到排滿或 viewport 縮小到頁面作出適應為止

這意味著，在`display: inline`作用下的元素，其寬高只取決於元素中內容的字體大小、行高等自身因素。對 inline 元素設寬高是無效的

```
display: inline;
width: 768px; /*這樣寫肯
height: 768px;  定沒反應*/
```

就連 padding 和 margin 也只對水平方向（左右邊距）起作用，上下 (像 padding-top, padding-bottom, margin-top, margin-bottom 這些通通) 無效。想設定寬高的話，可以改成 inline-block 

一些元素/標籤是默認 inline 的，例如 `a` 和 `img` ，但要注意 `img` 擁有預設的內置寬高，也可以任意設寬高。也就說雖然 `img` 的 display 默認是 inline ，實際上會作出 `display:inline-block` 的行為

#### `display: inline-block` 

可以理解成：inline，但可以設寬高

#### `display: block` 

block 和 inline 的根本區別是「級別」不一樣

按照 HTML 的排版邏輯，inline 和 br, input, textarea, label, a 等等，屬於同一層級，這些元素默認顯示於在同一列；而 block 則是與 h1~h6, p, div, ul 等等同屬「塊級」，每一塊獨佔一列，也可以設寬高、margin、padding 等。block element 的默認寬度將沿襲上一級的寬度

不過，排版是相對而言。`display: ` 就是用來改變排版級別的


## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？

#### 分類

可以將 position: static, relative, absolute, fixed 分成兩大組：跳脫組 && 不跳脫組

#### 跳脫排版流: absolute 和 fixed
「跳脫」是指元素脫離了他所在的佈局流。absolute 和 fixed 最主要的區別在於：
- absolute 原點是一個特定元素，例如相對於他的母元素來定位，一般情況下，absolute 會往上找最接近他的「relative」元素來做原點
- fixed 原點是我們看到的視窗本身
&nbsp;
- absolute 還是會動（當你向下滑，他也向下滑）
- fixed 會完全釘住不動。早期那些打開網頁撲面而來的惡意垃圾廣告彈窗，基本就是 fixed 定位元素

#### 不跳脫排版流
static 和 relative 的定位不會脫離他的排版處境
- static 和另外 3 種定位的最大區別是，因為他是默認的，所以很少會特意去設他 `position: static` 
- static 意味著「offset 無效」，即 `left` `top` `right` `bottom` 不會對 static 元素產生作用
&nbsp;
- `position: relative` 是最經常用到的定位，與 static 的「不用設」剛好相反
- relative 和 static 最明顯區別：static 之所以是默認，因為他會跟隨 HTML 佈局流；而 relative 則在 HTML 佈局流的基礎上，讓我們設置「offset」，例如 `position: relatvie; left 60px` (左邊留出 20px 空間)