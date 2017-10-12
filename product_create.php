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

<div id="prod_creation">
<h2 style="margin-left: 8px; padding-top: 6px;">Product creation</h2>
</div>

<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $picture = $_POST['picture'];
  $about = $_POST['about'];
  $android_link = $_POST['android_link'];

  require_once 'db.php';
  $link_to_db = get_db();


  $insert_query = "INSERT INTO products (`name`, `picture`, `about`, `android_link`) VALUES ('$name', '$picture', '$about', '$android_link');";
  $result = mysqli_query($link_to_db, $insert_query) or die(mysqli_error($link_to_db));

  if ($result) {
    echo '<h2>Product ' . $name . ' successfully created!</h2>';
  }
}
?>

<div class="admin" style="width: 230px;">
  <ul>
    <li><a href="product_administration.php">Back to the product list</a></li>
  </ul>
</div>

<center>
<form method="post">
  <p>Enter product name</p>
  <input type="text" placeholder="Product name" value="" name="name" />
  <p>Enter picture URL</p>
  <input type="text" placeholder="Porduct picture URL" value="" name="picture" />
  <p>Enter product about</p>
  <textarea placeholder="Product about" name="about"></textarea>
  <p>Enter playstore URL</p>
  <input type="text" placeholder="Porduct playstore URL" value="" name="android_link" />
  <p />
  <button type="submit">Submit</button>
</form>
</center>
