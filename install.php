<?php
session_start();
foreach ($_SESSION as $key => $value) {
  unset($_SESSION[$key]);
}
echo '<p>Cleaning up session data!</p>';

require_once 'db.php';
$link_to_db = get_db();

// setup user table
$users_drop_sql = "DROP TABLE IF EXISTS `users`;";

$users_create_sql = "CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$users_insert_sql = "INSERT INTO `users` (`id`, `username`, `password`, `admin`, `created_time`, `modified_time`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, '2017-04-01 20:02:29', NULL),
(2, 'user', '12dea96fec20593566ab75692c9949596833adc9', 0, '2017-04-01 20:02:29', NULL);";

$users_drop_result = mysqli_query($link_to_db, $users_drop_sql);
if ($users_drop_result) {
  echo '<p>User table successfully dropped!</p>';
}

$users_create_result = mysqli_query($link_to_db, $users_create_sql);
if ($users_create_result) {
  echo '<p>User table successfully created!</p>';
}

$users_insert_result = mysqli_query($link_to_db, $users_insert_sql);
if ($users_insert_result) {
  echo '<p>User table successfully populated!</p>';
}


//setup product table
$product_drop_sql = "DROP TABLE IF EXISTS `products`";

$product_create_sql = "CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `picture` varchar(250) NULL DEFAULT NULL,
  `about` text NOT NULL,
  `android_link` varchar(250) NULL DEFAULT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$product_insert_sql = "INSERT INTO `products` (`id`, `name`, `picture`, `about`, `android_link`, `created_time`, `modified_time`) VALUES
(1, 'Dizzy Ball', 'https://lh3.googleusercontent.com/miSS9pG-0NJlAdKBwOH3S2g1bnFg0QHd1Xa-94wvMyz-nhPh9U7dA5w_iFPwJodkLTQ=w300-rw',
   'Never let the kingdom of spiky shapes deceive you, they can change their mood and color at every moment so a little glimpse of an eye could end everything you was fighting for. Collect keys to unlock a secret magic that can make you survive even longer. Paint your round hero however you want with the power of the stars.',
   'https://play.google.com/store/apps/details?id=com.BLU.DizzyBall&hl=en', '2017-07-07 10:04:26', NULL),
(2, 'Tap Tap Clash', 'https://lh3.googleusercontent.com/DZo5Q95l1fNHCJHrF_A7PcSJo9UX6dQge4On-9jd7cu8zW9xGclmj_rsPzgRcq6DaA=w300-rw',
   'Are you ready for a simple , yet hard game which really tests your reflexes and timing ? Well , here it is! This game is all about tapping the screen . Sounds easy, you might say , until you give it a try . All the different types of levels will make your finger sweat and your mind hesitate whether it is the right time to tap or not , but be aware, your time is ticking.',
    'https://play.google.com/store/apps/details?id=comBLU.TapnSlide', '2017-07-07 10:04:26', NULL),
(3, 'Tic Tac Toe Beach', 'https://lh6.ggpht.com/HCfhIxmXb3kR027Tiv9hvEfbq-rjWYHUVIjlvDNOcTGqeWxR6umtFAbzKi3lxOpE5yM=w300-rw',
   'Hi everyone.This is a Tic Tac Toe with unique beach style which gives you a holiday feeling even while playing in school. That is my first Android app, i hope you like it.',
    'https://play.google.com/store/apps/details?id=com.Katrinecz.TicTacToeBeach', '2017-07-07 10:04:48', NULL);";

$product_drop_result = mysqli_query($link_to_db, $product_drop_sql);
if ($product_drop_result) {
  echo '<p>Product table successfully dropped!</p>';
}

$product_create_result = mysqli_query($link_to_db, $product_create_sql);
if ($product_create_result) {
  echo '<p>Product table successfully created!</p>';
}

$product_insert_result = mysqli_query($link_to_db, $product_insert_sql);
if ($product_insert_result) {
  echo '<p>Product table successfully populated!</p>';
}

?>

<a href="index.php">Home</a>
