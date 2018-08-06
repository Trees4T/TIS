<?php
error_reporting(0);
session_start();
require_once '../../action/function/class.backdoor.php';
$backdoor = new backdoor();

$lihat = $backdoor->qty_trees_and_families('MF004');


  echo $lihat->qty_trees;
  echo '<br>';
  echo $lihat->qty_families;

?>
