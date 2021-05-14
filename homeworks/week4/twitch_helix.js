var request = require('request')

const BASE = 'https://api.twitch.tv/helix'
const CLIENT_ID = '0f06js4qwmeaueubws1lyx6uqgd7ue'
const CLIENT_TOKEN = 'sde4kpdi9bafhvgpl32rvnbvsmppkn'
const GAME = process.argv[2]

let cursor

let all_names = []

request ({
  url: `${BASE}/games?name=${GAME}`,
  headers: {'Client-ID': CLIENT_ID, 'Authorization': `Bearer ${CLIENT_TOKEN}`}
}, 
  (err, res, body) => {
    let data, game_id
    if (err) {
      return console.log(err)
    }
    try {
      data = JSON.parse(body)
      game_id = data.data[0].id
    } catch (e) {
      return console.log(err)
    }
    request ({
      url: `${BASE}/streams?game_id=${game_id}&first=100`,
      headers: {'Client-ID': CLIENT_ID, 'Authorization': `Bearer ${CLIENT_TOKEN}`}
    }, 
      (err, res, body) => {
        if (err) {
          return console.log(err)
        }
        try {
          data = JSON.parse(body)
          cursor = data.pagination.cursor
          for (let i = 0; i < data.data.length; i++){
            all_names.push(data.data[i].user_name)
          }
        } catch (err) {
          return console.log(err)
        }
        request ({
          url: `${BASE}/streams?game_id=${game_id}&first=100&after=${cursor}`,
          headers: {'Client-ID': CLIENT_ID, 'Authorization': `Bearer ${CLIENT_TOKEN}`}
        }, 
          (err, res, body) => {
            if (err) {
              return console.log(err)
            }
            try {
              data = JSON.parse(body)
              for (let i = 0; i < data.data.length; i++){
                all_names.push(data.data[i].user_name)
              }
            } catch (err) {
              console.log(err)
            }
            request ({
              url: `${BASE}/streams?game_id=${game_id}&first=5&after=${cursor}`,
              headers: {'Client-ID': CLIENT_ID, 'Authorization': `Bearer ${CLIENT_TOKEN}`}
            }, 
              (err, res, body) => {
                if (err) {
                  return
                }
                try {
                  data = JSON.parse(body)
                  for (let i = 0; i < data.data.length; i++) {
                    all_names.push(data.data[i].user_name)
                  }
                } catch (err) {
                  console.log(err)
                }
                for (let i = 0; i < 200; i++) {
                  if (i + 1 < 10) { 
                    console.log(`00${i + 1} ${all_names[i]}`)
                  } else if (i + 1 < 100 && i + 1 >= 10) {
                    console.log(`0${i + 1} ${all_names[i]}`)
                  } else {
                    console.log(`${i + 1} ${all_names[i]}`)
                  }
                }
              }
            )
          }
        )
      }
    )
  }
)

