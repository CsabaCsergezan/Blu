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

<div id="prod_edit">
<h2 style="margin-left: 8px; padding-top: 6px;">Product edit</h2>
</div>

<?php
//validate product id
$is_valid_id = true;
$product = array();

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
      mysqli_query($link_to_db, "SELECT id, name, picture, about, android_link FROM `products` WHERE id=$id");

    if ($product_result) {
      $product_row = mysqli_fetch_row($product_result);

      if ($product_row) {
        $product['id'] = (int)$product_row[0];
        $product['name'] = $product_row[1];
        $product['picture'] = $product_row[2];
        $product['about'] = $product_row[3];
        $product['android_link'] = $product_row[4];
      } else {
        $is_valid_id = false;
      }
    } else {
      $is_valid_id = false;
    }
  }
}



if (false === $is_valid_id): ?>
  <h1>Invalid product id</h1>
  <a href="index.php">Home</a>
  <a href="product_administration.php">Back to the product list</a>
<?php return; endif; ?>


<?php
// update logic
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $picture = $_POST['picture'];
  $about = $_POST['about'];
  $android_link = $_POST['android_link'];


  require_once 'db.php';
  $link_to_db = get_db();

  $update_query = "UPDATE `products` SET `name` = '$name', `picture` = '$picture', `about` = '$about', `android_link` = '$android_link', `modified_time` = CURRENT_TIME() WHERE `products`.`id` = $id;";
  $result = mysqli_query($link_to_db, $update_query) or die(mysqli_error($link_to_db));

  if ($result) {
    echo '<h2>Product ' . $name . ' successfully updated!</h2>';

    $product_result =
      mysqli_query($link_to_db, "SELECT id, name, picture, about, android_link FROM `products` WHERE id=$id");
    if ($product_result) {
      $product_row = mysqli_fetch_row($product_result);
      if ($product_row) {
        $product['id'] = (int)$product_row[0];
        $product['name'] = $product_row[1];
        $product['picture'] = $product_row[2];
        $product['about'] = $product_row[3];
        $product['android_link'] = $product_row[4];
      }
    }
  }
}
?>

<div class="admin" style="width: 230px">
  <ul>
    <li><a href="product_administration.php">Back to the product list</a></li>
  </ul>
</div>

<center>
<form method="post">
  <input type="hidden" name="id" value="<?=$product['id'];?>" />
  <p>Enter name</p>
  <input type="text" placeholder="Product name" value="<?=$product['name'];?>" name="name" />
  <p>Picture URL</p>
  <input type="text" placeholder="Porduct picture URL" value="<?=$product['picture'];?>" name="picture" />
  <p>About</p>
  <textarea placeholder="Product about" name="about"><?=$product['about'];?></textarea>
  <p>Playstore URL</p>
  <input type="text" placeholder="Porduct playstore URL" value="<?=$product['android_link'];?>" name="android_link" />
  <p />
  <button type="submit">Submit</button>
</form>
</center>
