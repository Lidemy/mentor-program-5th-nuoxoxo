const URL = "https://api.twitch.tv/kraken"
const ID = "0f06js4qwmeaueubws1lyx6uqgd7ue"
const ACCEPT = "application/vnd.twitchtv.v5+json"

var template = `
<a href="$link"><div class="stream-box" title="CLICK ME 👋">
    <img class="preview-img" src="$preview" />
    <div class="stream-data">
        <div class="avatar">
            <img class="avatar-logo"src="$logo">
        </div>
        <div class="desc">
            <div class="title">$title</div>
            <div class="channel">
                $channel
            </div>
        </div>
    </div>
</div></a>`

function getStreams(name, callback) {
    let xhr = new XMLHttpRequest()
    xhr.open("GET", URL + "/streams?game=" + encodeURIComponent(name))
    xhr.setRequestHeader("Accept", ACCEPT)
    xhr.setRequestHeader("Client-ID", ID)
    xhr.onload = function() {
        if (this.status >= 200 && this.status < 400) {
            callback(JSON.parse(this.response))
        }
    }
    xhr.send()
}

function appendStreams(streams) {
    streams.forEach((stream) => {
        let element = document.createElement("div")
        let content = template
            .replace("$link", stream.channel.url)
            .replace("$preview", stream.preview.large)
            .replace("$logo", stream.channel.logo)
            .replace("$title", stream.channel.status)
            .replace("$channel", stream.channel.name)
        document.querySelector(".main").appendChild(element)
        element.outerHTML = content
    });
}

function changeActive(e) {
    var items = document.querySelectorAll("li")
    for (item of items) {
        if (item.classList.contains("active")) {
            item.classList.remove("active")
        }
    }
    e.target.classList.add("active");
}

document
    .querySelector(".topnav")
    .addEventListener("click", (e) => {
        if (e.target.tagName.toLowerCase() == "li") {
            changeActive(e)
            let gameName = e.target.innerText 
            document.querySelector(".main").innerHTML = "" 
            getStreams(gameName, (data) => {
                appendStreams(data.streams)
            })
        }
    })