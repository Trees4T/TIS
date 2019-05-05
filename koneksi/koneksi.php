<?php
$version="Ver. 1.3";
error_reporting(0);
######## LOCAL ########
// $host 		= 'localhost';
// $user		= 'root';
// $pass 		= '';
// $database   = 't4t_t4t';
######## LIVE ########
$host 		= '';
$user			= '';
$pass 		= '';
$database = '';
$port 		= '';




######### PDO #########
if ($_SESSION['level']=='fc' or $_SESSION['level']=='' or $_SESSION['level']=='part' or $_SESSION['level']=='admoff' or $_SESSION['level']=='fin' or $_SESSION['level']=='mkt') {
	try{
	$conn = new PDO ("mysql:host=$host;port=$port;dbname=$database", $user, $pass);

		//echo "Connected!";
	}catch(PDOException $e){
		echo $e->getMessage();
	}

}else{
	#### OLD ####
	$con = mysql_connect("$host","$user","$pass");
	if (!$con) {
		die('Cannot Connect'.mysql_error());
	}
	mysql_select_db("$database");
}




date_default_timezone_set('Asia/Jakarta');

?>
