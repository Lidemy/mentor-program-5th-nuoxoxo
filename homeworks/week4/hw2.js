var request = require('request')
var argv = process.argv

// Prepare cases

var route = 'https://lidemy-book-store.herokuapp.com/books'

switch(argv[2]){
  case 'update':
    updateBooks(argv[3], argv[4])
    break
  case 'create':
    createBooks(argv[3])
    break
  case 'delete':
    deleteBooks(argv[3])
    break
  case 'read':
    readBooks(argv[3])
    break
  case 'list':
    listBooks()
    break
  default:
    console.log('Usage: node hw2.js command\nAvailable commands: list, read, delete, create and update')
}


// 'list' & 'read': both use the default GET method

function listBooks() {
  
  let q = '?_limit=50'
  let path = route + q
  
  request(path, (err, res, body) => {
    if (err) {
      return console.log(err)
    }
    let data = JSON.parse(body)
    for (let i = 0; i < data.length; i++){
      console.log(`${data[i].id} ${data[i].name}`)
    }
    return
  })

}

function readBooks(id) {
  
  let path = route + '/' + id
  
  request(path, (err, res, body) => {
    if (err) {
      return console.log(err)
    }
    let data = JSON.parse(body)
    return console.log(data.name)
  })

}


// 'delete': pop a book with DELETE

function deleteBooks(id) {
  
  let path = route + '/' + id
  
  request.delete(path, (err, res) => {
    if (err) {
      return console.log(err)
    }
    return console.log(`已刪除 id 為 ${id} 的書籍`)
  })

}


// 'create': add a book with POST

function createBooks(name) {
  
  let data = {
    url: route,
    form: {
      name
    }
  }
  
  request.post(data, (err, res) => {
    if (err) {
      return console.log(err)
    }
    return console.log(`已新增一本名為 ${name} 的書`)
  })

}


// 'update': modify a key:value pair with PATCH

function updateBooks(id, name) {
  
  let path = route + '/' + id
  let data = {
    url: path,
    form: {
      name
    }
  }

  request.patch(data, (err, res) => {
    if (err) {
      return console.log(err)
    }
    return console.log(`已更新 id 為 ${id} 的書名為 ${name}`)
  })

}
