<?php 
session_start();
error_reporting(0);
if ($_SESSION['level']=="adm") {
	//echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../dashboard/admin.php?48dc24ef35cdda7f7a2fad8b82b663e1">';
	header("location:../login/logout.php");
}elseif ($_SESSION['level']=="fc") {
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../dashboard/fc.php?6deceb77fb286ef25a51ff7ab3efe0cc">'; 
}elseif ($_SESSION['level']=="part") {
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../dashboard/member.php?bdf39ed9a84403ae14eda12a24f83767">';
}elseif ($_SESSION['level']=="admoff") {
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../dashboard/admin-office.php?dcb6309a5e101c4834be5bfa0aa100be">';
}elseif ($_SESSION['level']=="fin") {
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../dashboard/finance-office.php?28f29b60dc8d0763f92a9864de362cf2">';
}else{
	header("location:../login/");
}
 ?>