<?php
function get_db() {
  $link_to_db = mysqli_connect("localhost", "root", "root", "katrinecz");

  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }

  return $link_to_db;
}
