<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
    .btn {width:128px}
    .btns {margin:12px auto}
    .card {margin:12px auto; max-width:600px}
    .card-title {color:grey}
    .card-text {font-size:16px}
    .container {margin-top:32px; margin-bottom:32px;max-width:600px}
    .form-control {min-height:160px;font-size:18px}
    .form-control-file {border: 1px solid #ced4da;border-radius: .25rem}
    .noselect {user-select:none;}
    .rainbow {background-image: linear-gradient(to left, green, gold, orange, red);margin-bottom:1em}
  </style>
  <title>留言板 API</title>
</head>

<body>
  <div class="container">
    <form id="new-post">
      <div class="form-group">
        <label>留言板</label>
        <!-- <h1>留 言 板 ！</h1> -->
        <div class="rainbow noselect">&nbsp;</div>
        <div class="form-group">
          <input name="form-nickname" class="form-control-file" id="form-nickname" placeholder=" Nickname" autocomplete="off">
        </div>
        <textarea class="form-control" id="form-content" name="form-content" rows="3" placeholder="Write something."></textarea>
        <small class="form-text text-muted">A Better Life, A Better World</small>
        <small class="form-text text-muted">Panasonic</small>
      </div>
      <button type="submit" class="btn btn-success">Submit</button>
    </form>
  </div>
</body>
<script>

  const site_key = "nxu"
  const loadMoreBtn = `<div class="btns"><button id="totop" class="btn btn-info">Back to Top</button> <button id="load" class="load btn btn-warning">Load More</button></div>`
  let before = null
  let end = false

  function esc(s){
    return s.replace(/\&/g, '&amp;')
    .replace(/\</g, '&lt;')
    .replace(/\>/g, '&gt;')
    .replace(/\"/g, '&quot;')
    .replace(/\'/g, '&#x27')
    .replace(/\//g, '&#x2F')
  }  

  function getStuff(site_key, before, callback) {
    let url = `bbs_api.php?site_key=${site_key}`
    if (before) {
      url += "&before=" + before
    }
    $.ajax({
      url,
    }).done(function(data) {
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

  function totop() {
    document.body.scrollTop = 0; 
    document.documentElement.scrollTop = 0; 
  }

  $(document).ready(function() {
    // Get initial posts
    getStuff(site_key, null, data => {
      if (!data.good) {
        alert(data.msg)
        return
      }
      
      const posts = data.posts
      if (posts.length == 0){
        return
      } else {
        for (let post of posts) {
          loadStuff(post)
        }
        $(".container").append(loadMoreBtn)
        // before = posts[posts.length - 1].created_at
        before = posts[posts.length - 1].id
      }
    })

    // Click load more button
    $(".container").on("click", "#load", function(){
      getStuff(site_key, before, data => {
        if (!data.good) {
          alert(data.msg)
          return
        }
        
        const posts = data.posts

        if (posts.length == 0) {
          end = true
          $("#load").remove()
          $("#totop").removeClass("btn-warning").addClass("btn-success").html("(o > .< )o ")
          return
        }

        for (let post of posts) {
          loadStuff(post)
        }

        $(".container").append(loadMoreBtn)
        // before = posts[posts.length - 1].created_at
        before = posts[posts.length - 1].id
      })
    })

    $(".container").on("click", "#totop", function(){
      totop()
    })

    // Add new
    $("#new-post").submit(function(e) {
      e.preventDefault()
      $.ajax({
        type: "POST", 
        url: "bbs_api_send.php",
        data: {
          site_key: site_key,
          nickname: $("input#form-nickname").val(),
          content: $("textarea#form-content").val()
        }
      }).done(function(data){
        if (!data.good){
          console.log(data.msg)
          alert(data.msg)
          return
        }
        location.reload()
      })
    })
  })

</script>
</html>