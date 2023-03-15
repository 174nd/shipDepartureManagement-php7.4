<?php
$db = array(
  'host'   => 'localhost',
  'user'   => 'root',
  'pass'   => '',
  'db'   => 'db_kur'
);

$host = 'http://localhost/TAKur/';

$df = array(
  'host'          => $host,
  'head'          => 'PT. Indotama Laut Lestari',
  'favicon'       => $host . 'dist/img/logo.png',
  'user-image'    => $host . 'dist/img/user.png',
  'brand-image'   => $host . 'dist/img/logo.png',
);

// Create connection
$conn = mysqli_connect($db['host'], $db['user'], $db['pass'], $db['db']);
date_default_timezone_set("Asia/Jakarta");
// Check connection
if (mysqli_connect_errno()) {
  echo "Koneksi database gagal : " . mysqli_connect_error();
}
