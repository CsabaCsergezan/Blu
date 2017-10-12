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

  require_once 'db.php';
  $link_to_db = get_db();

  $result =
    mysqli_query($link_to_db, "SELECT id, username, admin FROM `users`");

  $users = array();

  if ($result) {
    while ($user_row = mysqli_fetch_row($result)) {
        $users[] = array(
          'id' => (int)$user_row[0],
          'username' => $user_row[1],
          'admin' => (int)$user_row[2],
        );
    }
  }
?>

<?php require_once 'header.php'; ?>
<div id="user_list">
<h2 style="margin-left: 8px; padding-top: 6px;">Users administration</h2>
</div>
<div class="admin" style="width: 280px;">
  <ul>
    <li><a href="product_administration.php">Product list</a></li>
    <li><a href="user_create.php">Create new user</a></li>
  </ul>
</div>
<br />

<?php if (count($users) === 0): ?>
  <h2>No users in DB</h2>
<?php else: ?>
  <center>
  <table border="1">
    <thead>
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Admin</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
        <tr>
          <td><?=$user['id']; ?></td>
          <td><?=$user['username']; ?></td>
          <td><?=$user['admin'] === 1 ? 'true' : 'false' ; ?></td>
          <td>
            <a href="user_edit.php?id=<?=$user['id']; ?>">Edit</a>
            <a href="user_delete.php?id=<?=$user['id']; ?>">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</center>
<?php endif; ?>
