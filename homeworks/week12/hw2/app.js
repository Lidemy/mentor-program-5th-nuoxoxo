// define ui vars

var id = 1
var todoTotal = 0
var todoChecked = 0
var todoUnfinished
var searchParams = new URLSearchParams(window.location.search)
var user_id = searchParams.get("user_id")


if (user_id) {
  $.getJSON("todo_api_get.php?user_id=" + user_id, (data) => {
    const todos = JSON.parse(data.data.todos)
    loadStuff(todos)
  })
}

function loadStuff(todos) {
  if (todos.length == 0) return

  id = parseInt(todos[todos.length - 1].id) + 1

  for (let i = 0; i < todos.length; i++) {
    let todo = todos[i]
    if (todo.isChecked) {
      $(".todos").prepend(`<div class="todo list-group-item list-group-item-action d-flex justify-content-between align-items-center checked">
        <div class="todo__content-wrapper custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="todo-${todo.id}">
          <label class="todo__content custom-control-label" for="todo-${todo.id}">${esc(todo.todo)}</label>
        </div>
        <div class="input-group-append">
          <button type="button" class="btn-delete btn btn-danger">刪除</button>
        </div>
      </div>`)
      $("#todo-" + todo.id).prop("checked", true)
      todoChecked++
    } else {
      $(".todos").prepend(`<div class="todo list-group-item list-group-item-action d-flex justify-content-between align-items-center">
      <div class="todo__content-wrapper custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="todo-${todo.id}">
        <label class="todo__content custom-control-label" for="todo-${todo.id}">${esc(todo.todo)}</label>
      </div>
      <div class="input-group-append">
        <button type="button" class="btn-delete btn btn-danger">刪除</button>
      </div>
    </div>`)
    }
    todoTotal++
  }
  updateCounter()
  debugCounter()
}

// Add new
$(".btn-add").click(e => {
  e.preventDefault()
  addNew(e)
})

// Delete tasks
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

// Update checkboxes
$(".todos").on("change", "input:checkbox", e => {
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

  // Mark all toggle
  $(".mark-all").click( () => {
  console.log(todoUnfinished, $(".todo").length)
  if (todoUnfinished == $(".todo").length) {
    $(".todo").each(( i, el ) => {
      let box = $(el).find("input[type=checkbox]")
      $(box).prop("checked", true)
      el.classList.add("checked")
      todoChecked++
    })
    updateCounter()
  } else if (todoUnfinished == 0) {
    $(".todo").each(( i, el ) => {
      let box = $(el).find("input[type=checkbox]")
      $(box).prop("checked", false)
      el.classList.remove("checked")
      todoChecked--
    })
    updateCounter()
  } else {
    $(".todo").each(( i, el ) => {
      let box = $(el).find("input[type=checkbox]")
      if ($(el).hasClass("checked") == false) {
        $(box).prop("checked", true)
        el.classList.add("checked")
        todoChecked++
      }
    })
    updateCounter()
  }
})

// Clear all done tasks
$(".clear-all").click((e) => {
  $(".checked").each((i, el) => {
    $(el).remove()
    todoChecked--
    todoTotal--
    id--
  })
  updateCounter()
  debugCounter()
})

// Listen on filters
$(".options").on("click", "div", e => {
  // let filter = $(e.target).prop("filter")
  let tag = $(e.target).attr("filter")
  switch (tag) {
    case "unfinished":
      removeActive(e)
      // $(".active").each(( i, el ) => {
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

// Functions

function removeActive(e) {
  $(".active").each((i, el) => {
    if (el.classList.contains("active")) {
      $(el).removeClass("active")
    }
  })
  e.target.classList.add("active")
}

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
  console.log(`total: ${todoTotal};\n未完成: ${todoUnfinished};\n已完成: ${todoChecked}`)}

$(".btn-save").click(() => {
  let todos = []
  $(".todo").each((i, el) => {
    let input = $(el).find("input[type=checkbox]")
    let label = $(el).find("label")
    todos.push({
      id: input.attr("id").replace("todo-", ""),
      todo: label.text(),
      isChecked: $(el).hasClass("checked")
    })
  })
  todos = JSON.stringify(todos)
  // console.log(todos)
  $.ajax({
    type: "POST",
    url: "todo_api_add.php",
    data: {
      todos: todos
    },
    success: (res) => {
      let user_id = res.user_id
      window.location = "index.html?user_id=" + user_id
    },
    error: (res) => {
      console.log(res)
    }
  })
})

function esc(s) {
  return s.replace(/\&/g, '&amp;')
    .replace(/\</g, '&lt;')
    .replace(/\>/g, '&gt;')
    .replace(/\"/g, '&quot;')
    .replace(/\'/g, '&#x27')
    .replace(/\//g, '&#x2F')
}

// Show ".btn-delete" for Tab key 

// $(".todos").on( "keyup", ".btn-delete", e =>  {
//   let item = e.target
//   if (e.keyCode == 9) {
//     if ($(item).css("opacity") == 1){$(item).animate({"opacity":0})}
//     else
//     {$(item).animate({"opacity":1})}
//   }
// })

// Hide ".btn-delete" when Tab leaves
/// unfinished

// $(".todos").on("change", e =>  {
//   console.log(e.target)
// })