<?php
require_once($backurl . 'config/conn.php');
require_once($backurl . 'config/function.php');
$df['home'] = $df['host'] . 'admin/';
kicked("admin");

$setSidebar = array(
  'dashboard' => array('fas fa-tachometer-alt', $df['home'], true, 'bg-red'),
  'Clearance In' => array('fas fa-sign-in-alt', $df['home'] . 'ci/'),
  'Clearance Out' => array('fas fa-sign-out-alt', $df['home'] . 'co/'),
  'Pelabuhan' => array('fas fa-place-of-worship', $df['home'] . 'pelabuhan/'),
  'Kapal' => array('fas fa-ship', $df['home'] . 'kapal/'),
  'User' => array('fas fa-users', $df['home'] . 'user/'),
);
