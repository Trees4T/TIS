<?php

session_start();
require_once '../../action/function/class.backdoor.php';
$backdoor = new backdoor();

for ($i='1394858'; $i <= '1394871' ; $i++) {
  echo $wins = $i; echo "-";
  echo $order = $_GET['order']; echo "-";
  echo $bl = $_GET['bl'] ; echo "-";
  echo $id_part = $_GET['id_part'] ; echo "-";
  echo $shipment = $_GET['ship'] ; echo "-";
  echo $time = $_GET['time'] ; echo "-";
  echo $user = $_GET['user'] ; echo "-";
  echo $type = $_GET['type'] ; echo "-";
  echo $relation = $_GET['relation'] ; echo "-";
  echo $id_ret = $_GET['id_ret'];
  echo "<br>";

  $backdoor->wins_insert($wins,$order,$bl,$id_part,$shipment,$time,$user,$type,$relation,$id_ret);

}
?>
