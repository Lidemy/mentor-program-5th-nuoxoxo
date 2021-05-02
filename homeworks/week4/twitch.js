var request = require('request')

const BASE = 'https://api.twitch.tv/kraken/streams/?game='
const CLIENT_ID = '0f06js4qwmeaueubws1lyx6uqgd7ue'
const ACCEPT = 'application/vnd.twitchtv.v5+json'
const GAME = process.argv[2]

const LIMIT = 20 /* 200 */

let options = {
  url: BASE + GAME,
  headers: {
    'Accept': ACCEPT,
    'Client-ID': CLIENT_ID
  }
}

request (options, (err, res, body) => {
  if (err) {
    return console.log(err)
  }
  
  let data = JSON.parse(body)
  let len = ( LIMIT <= data.streams.length ) ? LIMIT : data.streams.length
  
  if (len === 0) {
    return console.log(`GAME '${GAME} NOT FOUND'.`)
  }
  
  for (let i = 0; i < len; i++){
    console.log(`${data.streams[i]._id} ${data.streams[i].channel.display_name}`)
  }

  return
})
    
