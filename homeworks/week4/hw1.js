var request = require('request')

var hostName = 'https://lidemy-book-store.herokuapp.com'
var pathName = '/books'
var queryStr = '?_limit=10'

request(hostName + pathName + queryStr, (err, res, body) => {
  if (err) return console.log(err)
  let lines = JSON.parse(body)
  for (let i = 0; i < lines.length; i++){
    console.log(`${lines[i].id} ${lines[i].name}`)
  }
})
