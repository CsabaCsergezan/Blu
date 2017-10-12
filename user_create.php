<?php
session_start();
$isadmin = false;
if(isset($_SESSION['user'])) {
  $isadmin = $_SESSION['user']['admin'] === 1;
}
if (!$isadmin) {
  header('Location: index.php');
  die();
}
?>

<?php require_once 'header.php'; ?>

<div id="user_creation">
<h2 style="margin-left: 8px; padding-top: 6px;">User creation</h2>
</div>

<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = sha1($_POST['password']);

  require_once 'db.php';
  $link_to_db = get_db();


  $insert_query = "INSERT INTO users (`username`, `password`) VALUES ('$username', '$password');";
  $result = mysqli_query($link_to_db, $insert_query) or die(mysqli_error($link_to_db));

  if ($result) {
    echo '<h2>User ' . $username . ' successfully created!</h2>';
  }
}
?>

<div class="admin" style="width: 200px;">
  <ul>
    <li><a href="user_list.php">Back to the user list</a></li>
  </ul>
</div>

<form method="post">
  <p>Enter username</p>
  <input type="text" placeholder="Username" value="" name="username" />
  <p>Enter user password</p>
  <input type="password" placeholder="Password" value="" name="password" />
  <p />
  <button type="submit">Submit</button>
</form>
