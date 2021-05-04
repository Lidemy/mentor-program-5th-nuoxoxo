# w4hw5

#### 請以自己的話解釋 API 是什麼
API 是軟體和軟體之間的溝通方法。API 總是準備好了一系列的工具，如協定、模塊、物件、方法等等，令主體變得更「工程師 friendly」。

API 不單只有一種，但在今日的網路時代，當我們說 API 通常指的是 Web API ，查天氣、查關鍵字、PO 文等等，其實都在使用 API 。

#### 請找出三個課程沒教的 HTTP status code 並簡單介紹

408 (Request Timeout)
請求超時。原因可能是：
1）Client 未能在 Server 規定的「限時」內完成 request 的發送；
2）Client 已登陸 app 或網頁，然後什麼都不做，處於「IDLE」狀態，這個狀態如果超出限時 Server 就有可能送出 408 先斷掉，Client 須重新登錄

304 (Not Modified)
未改動。Server 告訴 browser 用 cache 或本地副本就好，Server 不會再發送。假設用戶 a 去[這個網站](https://nssdc.gsfc.nasa.gov/photo_gallery/photogallery-astro-nebula.html)看高清大圖，因為他不是第一次看了，而 tiff 格式的原圖又很大，所以網站回覆 304 給 browser。用戶 a 很可能只是在看收在自己本地 cache 的文件

500 (Internal Server Error)
伺服器因未知原因而無法處理請求。大概率因為網頁後端 code 有 bug

#### 假設你現在是個餐廳平台，需要提供 API 給別人串接並提供基本的 CRUD 功能，包括：回傳所有餐廳資料、回傳單一餐廳資料、刪除餐廳、新增餐廳、更改餐廳，你的 API 會長什麼樣子？請提供一份 API 文件。

##### 一些事前準備和原則
- 將平台看成是「單頁應用程式」，但它可以擁有若干個 routes / endpoints
- routes 都用 CRUD 動詞
- 使用 JSON 來儲存、讀取、傳送 data；JSON 目的是將 JavaScript 物件表現為字串，從 JSON 中讀取資料時 JSON 是物件；當要跨網路傳送 JSON 時，則是字串
- 準備 query string 格式，儘量簡明
- 要求用戶登陸，減少被濫用或攻擊的風險

##### LOGIN
- '/login'
- method=['GET', 'POST']
- 沒註冊先註冊
- 不管連線成功或失敗都是 302

###### SEARCH
- '/search'
- method=['GET''POST']
- 如果 request 的 method 是 POST
    - 搜索用戶輸入的餐廳/區域關鍵字
    - 庫中找不到的話，回傳 err 狀況碼
    - 找到則回傳 '名字' '貴不貴' '地址' 等資料
- 如果 request 的 method 是 GET
    - 將所有餐廳(或用戶「保存」的餐廳)資料列出來/回傳

###### DELETE
- '/delete'
- method=['GET', 'POST']
- 刪除用戶保存餐廳名單中符合關鍵字的餐廳

###### ADD
- '/add'
- method=['GET', 'POST']
- 將某餐廳加入表單

###### UPDATE
- '/patch'
- method=['GET', 'POST']
- 更新餐廳資料

###### HANDLE ERROR
- 伺服器一旦發生錯誤（Internal Server Error），回傳錯誤名稱(name)和狀態碼(code)
