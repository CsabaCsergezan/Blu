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
    mysqli_query($link_to_db, "SELECT id, name, picture, about, android_link FROM `products`");

  $products = array();

  if ($result) {
    while ($product_row = mysqli_fetch_row($result)) {
        $products[] = array(
          'id' => (int)$product_row[0],
          'name' => $product_row[1],
          'picture' => $product_row[2],
          'about' => $product_row[3],
          'android_link' => $product_row[4],
        );
    }
  }
?>

<?php require_once 'header.php'; ?>

<div id="prod_admin">
<h2 style="margin-left: 8px; padding-top: 6px;">Product administration</h2>
</div>
<div class="admin" style="width: 280px;">
  <ul>
    <li><a href="user_list.php">User list</a></li>
    <li><a href="product_create.php">Create new product</a></li>
  </ul>
</div>
<p />

<?php if (count($products) === 0): ?>
  <h2>No product in DB</h2>
<?php else: ?>
<center>
  <table border="1">
    <thead>
      <tr>
        <th>Picture</th>
        <th>ID</th>
        <th>Name</th>
        <th>About</th>
        <th>Android link</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $product): ?>
        <tr>
          <td><img height="80" width="75" src="<?=$product['picture']; ?>" /></td>
          <td><?=$product['id']; ?></td>
          <td><?=$product['name']; ?></td>
          <td><?=$product['about']; ?></td>
          <td><?=$product['android_link']; ?></td>
          <td>
            <a href="product_edit.php?id=<?=$product['id']; ?>">Edit</a>
            <a href="product_delete.php?id=<?=$product['id']; ?>">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</center>
<?php endif; ?>
