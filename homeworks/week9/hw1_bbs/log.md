UPDATED: 

# enable nickname edit

update_user.php

# add prepared stmt

handle_add_comment:
```r
$sql_query = "INSERT INTO a_bbs (nickname, content) VALUES ('$nickname', '$content')";
$result = $conn->query($sql_query);
```
---->
```r
$sql_query = "INSERT INTO a_bbs (nickname, content) VALUES (?, ?)";
$stmt = $conn->prepare($sql_query);
$stmt->bind_param("ss", $nickname, $content);
$result = $stmt->execute();
```

# text formatting

utils:
```r
function escape($str) {
  return htmlspecialchars($str, ENT_QUOTES);
}
```
index:
`$row["nickname"]` ----> `escape($row["nickname"])`
`$row["content"]` ----> `escape($row["content"])`
