<?php
session_start();
if ($_POST['ret']=='' && $_POST['owner']==1) {
  echo $error = '<span class="red"><i class="fa fa-minus-circle"></i> Please select <b>Customer Code</b> if <b>WIN Owner</b> is for Customer. </span>';
  $_SESSION['eror_owner']=1;
}else{
  unset($_SESSION['eror_owner']);
}

?>
