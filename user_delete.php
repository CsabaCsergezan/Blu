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

<div id="user_delete">
<h2 style="margin-left: 8px; padding-top: 6px;">User delete</h2>
</div>

<?php
//validate user id
$is_valid_id = true;

if (false === array_key_exists('id', $_GET)) {
  $is_valid_id = false;
} else {
  $id = (int)$_GET['id'];

  if ($id === 0) {
    $is_valid_id = false;
  } else {
    require_once 'db.php';
    $link_to_db = get_db();

    $user_result =
      mysqli_query($link_to_db,"DELETE FROM `users` WHERE `users`.`id` = $id");

    if ($user_result) {
      echo '<h1>User with id ' . $id . ' deleted!</h1>';
    }
  }
}



if (false === $is_valid_id): ?>
  <h1>Invalid user id</h1>
  <a href="index.php">Home</a>
  <a href="user_list.php">Back to the user list</a>
<?php return; endif; ?>

<div class="admin" style="width: 200px;">
  <ul>
    <li><a href="user_list.php">Back to the user list</a></li>
  </ul>
</div>
