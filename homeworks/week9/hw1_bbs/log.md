UPDATED: 

# 1NF

```php
$sql_load = "SELECT bbs.content as content, bbs.created_at as created_at, users.nickname as nickname, users.username as username FROM a_bbs as bbs LEFT JOIN a_users AS users on bbs.username = users.username ORDER BY created_at DESC";
$stmt = $conn->prepare($sql_load);
$result = $stmt-> execute();
if (!$result) {die("Error: " . $conn->error);}
$result = $stmt->get_result();
```

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
