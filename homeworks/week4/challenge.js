var https = require('https')
var argv = process.argv

// Prepare cases

var host = 'https://lidemy-book-store.herokuapp.com'

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
    console.log('Usage: node hw2.js command')
    console.log('Available commands: list, read, delete, create and update')
}



// 'list' & 'read': both use the default GET method

function listBooks() {  
  let url = `${host}/books?_limit=30` 
  https.get(url, res => {
    let body = ''
    res.on('data', chunk => {
      body += chunk
    })
    res.on('end', () => {
      let d
      body = JSON.parse(body)
      d = 30 < body.length ? 30 : body.length
      for (let i = 0; i < d; i++) {
        console.log(`${body[i].id}: ${body[i].name}`)
      }
    })
  }).on('error', err => {
    console.log(err.message)
  })
}


function readBooks(id) {
  let url = `${host}/books/${id}`
  https.get(url, res => {
    let body = ''
    res.on('data', chunk => {
      body += chunk
    })
    res.on('end', () => {
      body = JSON.parse(body)
      if (body.name == undefined) {
        return console.log(`沒有這本書，你可以試試其他數字`)
      }
      console.log(body.name)
    })
  }).on('error', err => {
    console.log(err.message)
  })
}



// 'create': add a book with POST

function createBooks(name) {
  let url = 'lidemy-book-store.herokuapp.com'
  const data = JSON.stringify({
    name: name,
  })
  
  const options = {
    hostname: url,
    path: '/books',
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Content-Length': data.length,
    },
  }

  let req = https.request(options, res => {
    res.on('data', (d) => {
      let body = JSON.parse(d)
      console.log(`已新增一本名為 ${body.name} 的書，ID: ${body.id}`)
    })
  })

  req.on("error", error => {
    console.error(error)
  })

  req.write(data)
  req.end()
}



// 'delete': pop a book with DELETE

function deleteBooks(id) {
  let url = 'lidemy-book-store.herokuapp.com'
  const options = {
    hostname: url,
    path: `/books/${id}`,
    method: 'DELETE',
  }

  let req = https.request(options, res => {
    if (res.statusCode >= 200 && res.statusCode < 300){
      console.log(`已刪除 id 為 ${id} 的書籍`)
    } else {
      console.log(`刪除失敗`)
    }
  })

  req.on("error", error => {
    console.error(error)
  })

  req.end()
}



// 'update': modify a key:value pair with PATCHi

function updateBooks(id, name) {
  let url = 'lidemy-book-store.herokuapp.com' 
  let data = JSON.stringify({
    name: name
  })

  let options = {
    hostname: url,
    path: `/books/${id}`,
    method: 'PATCH',
    headers: {
      'Content-Type': 'application/json',
      'Content-Length': data.length,
    },
  }

  let req = https.request(options, res => {
    console.log(`statusCode: ${res.statusCode}`)
    res.on('data', (d) => {
      if (res.statusCode >= 200 && res.statusCode < 300){
        let body = JSON.parse(d)
        console.log(`已將 id 為 ${body.id} 的書更名為 ${body.name}`)
      } else {
        console.log("更新失敗")
      }
    })
  })

  req.on("error", error => {
    console.error(error)
  })

  req.write(data)
  req.end()
}
