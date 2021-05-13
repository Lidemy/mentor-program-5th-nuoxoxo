var request = require('request')

const BASE = 'https://api.twitch.tv/kraken/streams/?game='
const CLIENT_ID = '0f06js4qwmeaueubws1lyx6uqgd7ue'
const ACCEPT = 'application/vnd.twitchtv.v5+json'

const GAME = process.argv[2]
const LIMIT = '&limit='
const NUM = '100' 
const OFFSET = '&offset='
const OFF = '99'

let options_first = {
  url: BASE + GAME + LIMIT + NUM,
  headers: {
    'Accept': ACCEPT,
    'Client-ID': CLIENT_ID
  }
}

let options_after = {
  url: BASE + GAME + OFFSET + OFF + LIMIT + NUM,
  headers: {
    'Accept': ACCEPT,
    'Client-ID': CLIENT_ID
  }
}

request (options_first, (err, res, body) => {
  if (err) {
    return console.log(err)
  }
  
  let data = JSON.parse(body)
  let n = Number(NUM)

  let len = ( n <= data.streams.length ) ? n : data.streams.length
  if (len === 0) {
    return console.log(`GAME '${GAME} NOT FOUND'.`)
  }
  
  for (let i = 0; i < len; i++){
    console.log(`${i + 1}: ${data.streams[i]._id} ${data.streams[i].channel.display_name}`)
  }

  request (options_after, (err, res, body) => {
    if (err){
      return console.log(err)
    }
    data = JSON.parse(body)
    len = ( n <= data.streams.length ) ? n : data.streams.length
    for (let i = 0; i < len; i++){
      console.log(`${i + 101}: ${data.streams[i]._id} ${data.streams[i].channel.display_name}`)
    }
  })

  return
})
    
