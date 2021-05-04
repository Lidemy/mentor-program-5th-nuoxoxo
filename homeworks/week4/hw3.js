var request = require('request')

var query = process.argv[2]
var route = 'https://restcountries.eu/rest/v2/name/'

if (query !== undefined) {  
  lookup(query)
}

function lookup(q) {
  let path = route + q
  request(path, (err, res, body) => {
    if (err){
      return console.log(err)
    }
    let data = JSON.parse(body)
    if (data.status === 404) {
      return console.log('找不到國家資訊')
    } else {
      for (let i = 0; i < data.length; i++){
        let co = data[i].name
        let ca = data[i].capital
        let cu = data[i].currencies[0].code
        let cc = data[i].callingCodes[0]
        console.log(`============\n國家：${co}\n首都：${ca}\n貨幣：${cu}\n國碼：${cc}`)
      }
    }
  })
}
