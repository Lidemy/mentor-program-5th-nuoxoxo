 /* 測跳轉 */
 /*window.location.assign("./page-lottery-prize.html")
 console.log("hi")*/

 const BASE = "https://dvwhnbka7d.execute-api.us-east-1.amazonaws.com/default/lottery"

 document.querySelector(".lottery__info__btn").addEventListener("click", () => {
     let errorMsg = "系統不穩定，請再試一次"

     let xhr = new XMLHttpRequest()
     xhr.open("GET", BASE, true)

     xhr.onload = () => {
         if (xhr.status >= 200 && xhr.status < 400) {
             let data
             try {
                 data = JSON.parse(xhr.response)
             } catch (err) {
                 alert(errorMsg)
                 console.log(err)
                 return
             }

             if (!data.prize) {
                 // render fail page
                 alert(errorMsg)
                 return
             }

             switch (data.prize) {
                 case "NONE":
                     window.location.assign("./page-prize0.html")
                     break;
                 case "FIRST":
                     window.location.assign("./page-prize1.html")
                     break;
                 case "SECOND":
                     window.location.assign("./page-prize2.html")
                     break;
                 case "THIRD":
                     window.location.assign("./page-prize3.html")
                     break;
             }
         }
     }
     xhr.onerror = () => {
         alert(errorMsg)
     }
     xhr.send()
 })


