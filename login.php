<?php
session_start();
if (isset($_SESSION['user'])) {
  header('Location: index.php');
  die();
}
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = sha1($_POST['password']);

  require_once 'db.php';
  $link_to_db = get_db();

  $user_auth_query = "SELECT username, admin FROM users WHERE username = '$username' AND password = '$password'";
  $result = mysqli_query($link_to_db, $user_auth_query) or die(mysqli_error($link_to_db));

  if ($result) {
    $user_row = mysqli_fetch_row($result);

    if ($user_row) {
      $_SESSION['user'] = array(
        'username' => $user_row[0],
        'admin' => (int)$user_row[1],
      );
      header('Location: index.php');
      die();
    }
  }
  echo "Invalid username or password";
}
?>

<?php require_once 'header.php'; ?>
<br />

<center>
<form method="post">
  <p>Enter username</p>
  <input type="text" placeholder="Username" value="" name="username" />
  <p>Enter password</p>
  <input type="password" placeholder="Password" value="" name="password" />
  <p />
  <button type="submit">Login</button>
</form>
</center>
