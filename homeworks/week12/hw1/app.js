const site_key = "nxu"
const loadMoreBtn =
    `<div class="btns"><button id="totop" class="btn btn-info">Back to Top</button> <button id="load" class="load btn btn-warning">Load More</button></div>`
let before = null
let end = false

$(document).ready(function () {
    // Get initial posts
    getStuff(site_key, null, data => {
        getStuffCallback(data)
    })

    // Click "Load More" button
    $(".container").on("click", "#load", data => {
        getStuff(site_key, before, data => {
            getStuffCallbackOnLoad(data)
        })
    })

    // Click Back to the Top button
    $(".container").on("click", "#totop", () => {
        totop()
    })

    // Add new
    $("#new-post").submit(e => {
        e.preventDefault()
        $.ajax({
            type: "POST",
            url: "bbs_api_send.php",
            data: {
                site_key: site_key,
                nickname: $("input#form-nickname").val(),
                content: $("textarea#form-content").val()
            }
        }).done(function (data) {
            if (!data.good) {
                console.log(data.msg)
                alert(data.msg)
                return
            }
            location.reload()
        })
    })
})

function getStuff(site_key, before, callback) {
    let url = `bbs_api.php?site_key=${site_key}`
    if (before) {
        url += "&before=" + before
    }
    $.ajax({
        url,
    }).done(data => {
        callback(data)
    })
}

function loadStuff(post) {
    if (end) {
        return
    }
    // $("#load").hide()
    $("#load").remove()
    $("#totop").remove()
    $(".container").append(
        `<div class="card">
        <div class="card-body">
          <h6 class="card-title">${esc(post.nickname)}</h6>
          <p class="card-text">${esc(post.content)}</p>
          <small class="form-text text-muted">${post.created_at}</small>
        </div>
      </div>`
    )
}

function getStuffCallback(data) {
    if (!data.good) {
        alert(data.msg)
        return
    }
    const posts = data.posts
    if (posts.length == 0) {
        return
    } else {
        for (let post of posts) {
            loadStuff(post)
        }
        $(".container").append(loadMoreBtn)
        // before = posts[posts.length - 1].created_at
        before = posts[posts.length - 1].id
    }
}

function getStuffCallbackOnLoad(data) {
    if (!data.good) {
        alert(data.msg)
        return
    }

    const posts = data.posts

    if (posts.length == 0) {
        end = true
        $("#load").remove()
        $("#totop").removeClass("btn-warning").addClass("btn-success").html(
            "(o > .< )o ")
        return
    }

    for (let post of posts) {
        loadStuff(post)
    }

    $(".container").append(loadMoreBtn)
    before = posts[posts.length - 1].id
}

function totop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

function esc(s) {
    return s.replace(/\&/g, '&amp;')
        .replace(/\</g, '&lt;')
        .replace(/\>/g, '&gt;')
        .replace(/\"/g, '&quot;')
        .replace(/\'/g, '&#x27')
        .replace(/\//g, '&#x2F')
}