var btn_update_nickname = document.querySelector(".update-nickname")
var btn_update_comment = document.querySelectorAll(".update-comment")
var forms = document.querySelectorAll("form")
var check_updated_comment = document.getElementById("form__update-comment")

// Update nickname
if (btn_update_nickname !== null) {
  btn_update_nickname.addEventListener("click", function() {
  var form = document.querySelector(".board__nickname-form")
  form.classList.toggle("hide")
  })
}

// Update comment
for (let i = 0; i < btn_update_comment.length; i++) {
  btn_update_comment[i].addEventListener("click", function() {
    var form = btn_update_comment[i].parentElement.parentElement.lastElementChild
    form.classList.toggle("hide")
  })
}

// Check if empty
for (let i = 0; i < forms.length; i++) {
  forms[i].onsubmit = function() {
    if (!forms[i].firstElementChild.lastElementChild.value) {
      alert("提交內容為空白");
      return false;
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
      alert("提交內容為重複");
      return false;
    }
  }
}