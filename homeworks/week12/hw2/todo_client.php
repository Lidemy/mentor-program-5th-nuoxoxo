<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
    .rainbow{background-image: linear-gradient(to left, green, gold, orange, red)}
    .container{margin-top:32px; margin-bottom:32px;max-width:520px}
    .unfinished {color:orange}
    .btn-add{min-width: 120px}
    .btn-delete{opacity: 0;min-width: 120px; border-top-left-radius:0;border-bottom-left-radius:0}
    .btn:focus {outline: none;box-shadow: none;}
    .input-group{margin: 1.1em auto}
    .todo:hover .btn-delete{opacity: 1}
    .todo__content-wrapper{flex: 1 1 auto}
    .list-group-item{padding: 0; padding-left: 10px}
    .options div, .clear-all, .mark-all{cursor: pointer;border-radius: 6px;padding: 4px;border: 2px solid transparent}
    .mt-1, .my-1 {margin: 1.25rem auto!important}
    .options div.active{border-color:rgba(255, 0, 0, 0.3)}
    .options div:hover{border-color:rgba(255, 0, 0, 0.5)}
    .hide {display: none!important}
    .noselect{user-select:none}
    input[type=checkbox]:checked ~ label {text-decoration: line-through;color: rgba(0,0,0,0.3)}
  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>TODO LiST</title>
</head>

<body>
  <div class="container">
    <div class="rainbow noselect">&nbsp;</div>
    <form class="input-group mb-3">
      <input class="input-todo form-control" placeholder="做點什麼     ----> console 裡有 debugger" autofocus>
      <!-- <input type="submit" class="input-todo form-control" placeholder="todo"> -->
      <div class="input-group-append">
        <!-- <button type="button" class="btn btn-add btn-primary">新增</button> -->
        <button type="submit" class="btn btn-add btn-primary">新增</button>
      </div>
    </form>
    
    <div class="info mt-1 d-flex justify-content-around align-items-center noselect">
      <div> <span class="unfinished">都可以做做看哦</span></div>
      <div class="options d-flex">
        <div class="ml-2" filter="unfinished">未完成</div>
        <div class="ml-2" filter="done">已完成</div>
        <div class="ml-2" filter="total">所有事</div>
      </div>
      <!-- <div class="mark-all">一切變完成</div> -->
      <button class="clear-all btn btn-light">清空已完成的事項</button>
    </div>

    <div class="todos list-group ">
      <div class="todo list-group-item list-group-item-action d-flex justify-content-between align-items-center">
        <div class="todo__content-wrapper custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="todo-1">
          <label class="todo__content custom-control-label" for="todo-1">可以點來看看哦</label>
        </div>
        <div class="input-group-append">
          <button type="button" class="btn-delete btn btn-danger">刪除</button>
        </div>
      </div>
      <div class="todo list-group-item list-group-item-action d-flex justify-content-between align-items-center">
        <div class="todo__content-wrapper custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="todo-2">
          <label class="todo__content custom-control-label" for="todo-2">刪刪看哦</label>
        </div>
        <div class="input-group-append">
          <button type="button" class="btn-delete btn btn-danger">刪除</button>
        </div>
      </div>
      <div class="todo list-group-item list-group-item-action d-flex justify-content-between align-items-center">
        <div class="todo__content-wrapper custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="todo-3">
          <label class="todo__content custom-control-label" for="todo-3">洗衣服</label>
        </div>
        <div class="input-group-append">
          <button type="button" class="btn-delete btn btn-danger">刪除</button>
        </div>
      </div>
      <div class="todo list-group-item list-group-item-action d-flex justify-content-between align-items-center">
        <div class="todo__content-wrapper custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="todo-4">
          <label class="todo__content custom-control-label" for="todo-4">洗碗</label>
        </div>
        <div class="input-group-append">
          <button type="button" class="btn-delete btn btn-danger">刪除</button>
        </div>
      </div>
      <div class="todo list-group-item list-group-item-action d-flex justify-content-between align-items-center">
        <div class="todo__content-wrapper custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="todo-5">
          <label class="todo__content custom-control-label" for="todo-5">喝水</label>
        </div>
        <div class="input-group-append">
          <button type="button" class="btn-delete btn btn-danger">刪除</button>
        </div>
      </div>

    </div>
    
    <div class="info mt-1 d-flex noselect">
      <button type="button" class="btn btn-save btn-primary">儲存</button>
  </div>
    
  </div>
  
</body>

<script>

// define ui vars

let id = 6
let todoTotal = 5
let todoChecked = 0
let todoUnfinished

// Load listeners

$(".todos").on("click", ".btn-delete", e => {
  let item = e.target.closest(".todo")
  let check = $(item).find("input:checkbox")
  if (check.is(":checked")) {
    todoChecked--
  } 
  item.remove()
  todoTotal--
  id--
  updateCounter()
  debugCounter()
})


$(".todos").on( "change", "input:checkbox", e =>  {
  let todo = e.target.closest(".todo")
  if (e.target.checked) {
    todo.classList.add("checked")
    todoChecked++
  } else {
    todo.classList.remove("checked")
    todoChecked--
  }
  updateCounter()
  debugCounter()
})

$(".btn-add").click(e => {
    e.preventDefault()
    addNew(e)
  }
)

$(".options").on("click", "div", e => {
  // let filter = $(e.target).prop("filter")
  let tag = $(e.target).attr("filter")
  switch(tag) {
    case "unfinished": 
      removeActive(e) 
      // $(".active").each((i, el) => {
      //   if (el.classList.contains("active")) {
      //     $(el).removeClass("active")}
      // })
      e.target.classList.add("active")
      $(".todo").each((i, el) => {
        if (el.classList.contains("checked")) {
          el.classList.add("hide")
        } else {
          el.classList.remove("hide")
        }
        // CAN I USE "TOGGLE":   
        // el.classList.toggle("hide")
      })
      break;
    case "done": 
      removeActive(e) 
      // $(".active").each((i, el) => {
      //   if (el.classList.contains("active")) {
      //     $(el).removeClass("active")}
      // })
      e.target.classList.add("active")
      $(".todo").each((i, el) => {
        if (el.classList.contains("checked")) {
          el.classList.remove("hide")
        } else {
          el.classList.add("hide")
        }
      })
      break;
    case "total": 
      removeActive(e) 
      // $(".active").each((i, el) => {
      //   if (el.classList.contains("active")) {
      //     $(el).removeClass("active")}
      // })
      // e.target.classList.add("active")
      $(".todo").each((i, el) => {
        if (el.classList.contains("hide")) {
          el.classList.remove("hide")
        }
      })
      break;
    default: 
      $(".todo").each((i, el) => {
        if (el.classList.contains("hide")) {
          el.classList.remove("hide")
        }
      })
      break;
  }
})

function removeActive(e) {
  $(".active").each((i, el) => {
    if (el.classList.contains("active")) {
      $(el).removeClass("active")}
    })
  e.target.classList.add("active")
} 

$(".clear-all").click(
  function ( e ) {
    $(".checked").each((i, el) => {
      $(el).remove()
      todoTotal--
      todoChecked--
      id--
    })
    updateCounter() 
    debugCounter()
  }
)

//  Add new task - jQ

function addNew(e) {
  let value = $(".input-todo").val()
  if (!value) return
  $(".todos").append(`<div class="todo list-group-item list-group-item-action d-flex justify-content-between align-items-center">
      <div class="todo__content-wrapper custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="todo-${id}">
        <label class="todo__content custom-control-label" for="todo-${id}">${esc(value)}</label>
      </div>
      <div class="input-group-append">
        <button type="button" class="btn-delete btn btn-danger">刪除</button>
      </div>
    </div>`)
  e.preventDefault()
  $(".input-todo").val("")
  // todoUnfinished++
  todoTotal++
  id++

  updateCounter()
  debugCounter()
}

function updateCounter() {
  todoUnfinished = todoTotal - todoChecked
  $(".unfinished").text(todoUnfinished + " 個未完成")
}

function debugCounter() {
  console.log(
  `total: ${todoTotal};\n未完成: ${todoUnfinished};\n已完成: ${todoChecked};\n下一個 id 會是: ${id}`)
}

// Escape function

function esc(s){
  return s.replace(/\&/g, '&amp;')
  .replace(/\</g, '&lt;')
  .replace(/\>/g, '&gt;')
  .replace(/\"/g, '&quot;')
  .replace(/\'/g, '&#x27')
  .replace(/\//g, '&#x2F')
}


// Mark all finished

/// TODO


// Show ".btn-delete" for Tab key - // NOT SURE IF I NEED IT

// $(".todos").on( "keyup", ".btn-delete", e =>  {
//   let item = e.target
//   if (e.keyCode == 9) {
//     if ($(item).css("opacity") == 1){$(item).animate({"opacity":0})}
//     else
//     {$(item).animate({"opacity":1})}
//   }
// })
  
//Hide ".btn-delete" when Tab leaves
// unfinished

// $(".todos").on("change", e =>  {
//   console.log(e.target)
// })

</script>
</html>