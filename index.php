<?php
  session_start();
  $username = null;
  $isadmin = false;
  if(isset($_SESSION['user'])) {
    $username = $_SESSION['user']['username'];
    $isadmin = $_SESSION['user']['admin'] === 1;
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
<br />
<br />

<h2>
  <?php if ($username): ?>
  <div id="welcome">
    Welcome <?=$username; ?>!
    <a href="log_out.php">Log out</a>
  </div>
  <?php endif; ?>
</h2>


<?php if ($isadmin): ?>
  <div class="admin">
    <ul>
      <li><a  href="product_administration.php">Product list</a></li>
      <li><a  href="user_list.php">User list</a></li>
    </ul>
  </div>
<?php endif; ?>
<p />

<div id="container">
  <img class="slides" src="dizzy_ball.png" />
  <img class="slides" src="tap-tap-clash.png" />

  <button class="btn" onclick="plusIndex(-1)" id="btn1">&#10094;</button>
  <button class="btn" onclick="plusIndex(1)" id="btn2">&#10095;</button>
</div>

<script>
	var index = 1;

	function plusIndex(n) {
	index = index + n;
	showImage(index);
	}
	showImage(0);
	function showImage(n) {
		var i;
		var x = document.getElementsByClassName("slides");

		if(n > x.length) {
			index = 1;
		}
		if(n < 1) {
			index = x.length;
		}
		for(i=0;i<x.length;i++) {
			x[i].style.display = "none";
		}
		x[index-1].style.display = "block";
	}

	autoSlide();

	function autoSlide() {
		var i;
		var x = document.getElementsByClassName("slides");

		for(i=0;i<x.length;i++) {
			x[i].style.display = "none";
		}
		index++;
		if(index > x.length) {
			index = 1
		}
		x[index-1].style.display = "block";
		setTimeout(autoSlide,3000);
	}
</script>
<br />
<br />
<br />
<hr>
<br />


<?php if (count($products) === 0): ?>
  <h2>No product in DB</h2>
<?php else: ?>
  <div id="table_prod">
    <table>
      <tbody>
        <tr>
        <?php
          $counter = 1;
          foreach ($products as $product): ?>
          <td>
            <div class="prod_name">
              <center><h2><?=$product['name']; ?></h2></center>
            </div>
            <div class="prod_picture">
              <img height="175" width="200" src="<?=$product['picture']; ?>" />
            </div>
            <div class="prod_about">
              <p><?=$product['about']; ?></p>
            </div>
            <br />
            <div class="prod_link">
              <center><a href="<?=$product['android_link']; ?>">
                <img src="android-logo.png"
              width="30px;" height="30px;"></a></center>
            </div>
          </td>
          <?php
            if ($counter % 3 == 0) {
            echo '</tr><tr>';
          }
            $counter++;
          ?>
        <?php endforeach; ?>
        </tr>
      </tbody>
    </table>
  </div>
<?php endif; ?>
<br />
<hr>
<p style="text-align: center;"> Copyright &#169 BLU. , all rights reserved.</P>
