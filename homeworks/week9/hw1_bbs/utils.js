// Load selectors
var btn_update_nickname = document.querySelector(".update-nickname")
var btn_update_comment = document.querySelectorAll(".update-comment")
var btn_reply = document.querySelectorAll(".reply-comment")
var forms = document.querySelectorAll("form")
var check_updated_comment = document.getElementById("form__update-comment")

// Show nickname edit field
if (btn_update_nickname !== null) {
  btn_update_nickname.addEventListener("click", function() {
  var form = document.querySelector(".board__nickname-form")
  form.classList.toggle("hide")
  })
}

// Show comment edit field
for (let i = 0; i < btn_update_comment.length; i++) {
  btn_update_comment[i].addEventListener("click", function() {
    var form = btn_update_comment[i].parentElement.parentElement.lastElementChild
    form.classList.toggle("hide")
  })
}

// Load pre-formatted text
for (let i = 0; i < btn_reply.length; i++) {
  btn_reply[i].addEventListener("click", function() {
    let area = document.getElementById("content")
    let user = btn_reply[i]
    .parentElement.querySelector(".card__author").innerText
    let text = btn_reply[i]
      .parentElement
      .parentElement
      .getElementsByTagName("p")[0].innerText
    area.innerHTML = `Reply to: ${user}
    | ${text}`
  })
}
// if (btn_reply_comment !== null) {
//   btn_reply_comment.addEventListener("click", function() {
//     var textarea = document.getElementById("content")
//     console.log(textarea.innerText)
//   })
// }

// Check if empty
for (let i = 0; i < forms.length; i++) {
  forms[i].onsubmit = function() {
    if (!forms[i].firstElementChild.lastElementChild.value) {
      alert("提交內容為空白")
      return false
    }
  }
}

// Check unedited text
if (check_updated_comment !== null) {
  check_updated_comment.onsubmit = function() {
    let valueOld = check_updated_comment
      .parentElement
      .getElementsByTagName("p")[0].innerText
    let valueNew = check_updated_comment
      .getElementsByTagName("div")[0]
      .getElementsByTagName("textarea")[0].value
    // console.log(valueOld); console.log(valueNew); 
    if (valueOld === valueNew) {
      alert("提交內容為重複")
      return false
    }
  }
}