var request = require('request')

const ID = '0f06js4qwmeaueubws1lyx6uqgd7ue'
const ROUTE = 'https://api.twitch.tv/kraken/games/top'
const LIMIT = 10


// Prepare game options

var options = {
  method: 'GET',
  url: ROUTE,
  headers: {
    'Accept': 'application/vnd.twitchtv.v5+json',
    'Client-ID': ID
  }
}


// GET

request(options, (err, res, body) => {
  if (err) {
    return console.log(err);
  }
  let data = JSON.parse(body)
  for (let i = 0; i < LIMIT; i++) {
    console.log(`${data.top[i].viewers} ${data.top[i].game.name}`)
  }
})
