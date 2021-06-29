LOG - prepared statement 
#SQLinjecttion


# handle_add_comment:
$sql_query = "INSERT INTO a_bbs (nickname, content) VALUES ('$nickname', '$content')";
$result = $conn->query($sql_query);
---->
$sql_query = "INSERT INTO a_bbs (nickname, content) VALUES (?, ?)";
$stmt = $conn->prepare($sql_query);
$stmt->bind_param("ss", $nickname, $content);
$result = $stmt->execute();


# handle_register: 
$nickname = $_POST["nickname"];
$username = $_POST["username"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
$sql_query = "INSERT INTO a_users (nickname, username, password) VALUES ('$nickname', '$username', '$password')";
$result = $conn->query($sql_query);
---->
$sql_query = "INSERT INTO a_users (nickname, username, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql_query);
$stmt->bind_param("sss", $nickname, $username, $password);
$result = $stmt->execute();


handle_login: 
$username = $_POST["username"];
$sql_login = "SELECT * FROM a_users WHERE username =  '$username'";
$result = $conn->query($sql_login);
----> 
$sql_login = "SELECT * FROM a_users WHERE username = ?";
$stmt = $conn->prepare($sql_login);
$stmt->bind_param("s", $username);
$result = $stmt->execute();
...
$result = $stmt->get_result();


# index: 
$result = $conn->query("SELECT * FROM a_bbs ORDER BY created_at DESC");
----> 
$sql_load = "SELECT * FROM a_bbs ORDER BY created_at DESC";
$stmt = $conn->prepare($sql_load);
$result = $stmt-> execute()
...
$result = $stmt->get_result();
