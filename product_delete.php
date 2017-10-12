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

<div id="prod_delete">
<h2 style="margin-left: 8px; padding-top: 6px;">Porduct delete</h2>
</div>

<?php
//validate product id
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

    $product_result =
      mysqli_query($link_to_db,"DELETE FROM `products` WHERE `products`.`id` = $id");

    if ($product_result) {
      echo '<h1>Product with id ' . $id . ' deleted!</h1>';
    }
  }
}



if (false === $is_valid_id): ?>
  <h1>Invalid product id</h1>
  <a href="index.php">Home</a>
  <a href="product_administration.php">Back to the product list</a>
<?php return; endif; ?>

<div class="admin" style="width: 230px">
  <ul>
    <li><a href="product_administration.php">Back to the product list</a></li>
  </ul>
</div>
