<?php
ob_start();
require_once '../action/function/class.office.php';
$office = new office();

if (isset($_POST['btn-generate'])){

	header("Cache-Control: no-cache, no-store, must-revalidate");
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=winURL.xls");

	$winawal=$_POST['winawal'];
	$jmlwin=$_POST['jmlwin'];
	echo "<table border='1'><tr><td align='center'><b>WIN</b></td><td align='center'><b>URL</b></td></tr>";
	for ($win = $winawal; $win<$winawal+$jmlwin; $win++){
	$crypted =  $office->encryptWIN($win);
	$url = "http://t4tr.org/".urlencode($crypted);
	echo"<tr><td>".$win."</td><td>".$url."</td></tr>";
	//$decrypted = decryptWIN($crypted);
	}
	echo"</table>";

}
?>
