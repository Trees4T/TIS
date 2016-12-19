<?php
error_reporting(0);
session_start();
include '../koneksi/koneksi.php';
$waktu=date("Y-m-d H:i:s");

$username = mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string($_POST['password']);
//$group 	  = mysql_real_escape_string($_POST['group']);
$password = md5($password);
// query untuk mendapatkan record dari username
$query = "SELECT * FROM otenuser WHERE uname = '$username' and status='AKTIF'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
// cek kesesuaian password
//echo $data['passwd'];
if ($password == $data['passwd'])
{
echo "<div align='center'>
  <font color='green'><strong>Success!</strong></font> Login Successful.
  </div>";
    // menyimpan username dan level ke dalam session
    $_SESSION['level'] = $data['id_grup'];
    $_SESSION['username'] = $data['uname'];
    $_SESSION['kode'] = $data['kode'];

    $username=$data['uname'];
    $hitlogin=mysql_fetch_row(mysql_query("select hitlogin from otenuser where uname='$username'"));
    $plus_hitlogin=$hitlogin[0]+1;

    mysql_query("update otenuser set hitlogin='$plus_hitlogin',lastlogin='$waktu' where uname='$username'");

    if ($_SESSION['level']=="fc") {
        $kode_fc=$data['kode'];
        $ta=mysql_fetch_array(mysql_query("select * from t4t_tamaster where kode_fc='$kode_fc'")); 
        $_SESSION['ta'] = $ta['kd_ta'];
    }
    if ($_SESSION['level']=="part") {
        $kode_part=$data['kode'];
        $id_part=mysql_fetch_array(mysql_query("select no,nama from t4t_partisipan where id='$kode_part'"));
        $_SESSION['id_part']=$id_part[0];
        $_SESSION['nama_part']=$id_part[1];

    }
    
    //Penggunaan Meta Header HTTP
    if ($_SESSION['level']=="adm") {
    	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../dashboard/admin.php?48dc24ef35cdda7f7a2fad8b82b663e1">'; 
    }elseif ($_SESSION['level']=="fc") {
    	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../dashboard/fc.php?6deceb77fb286ef25a51ff7ab3efe0cc">'; 
    }elseif ($_SESSION['level']=="part") {
    	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../dashboard/member.php?bdf39ed9a84403ae14eda12a24f83767">'; 
    }
      
	exit;
}
else 
echo '<div align="center"><font color="red"><strong>Warning!</strong></font> Login Unsuccessful.<br>Please check your username or your password.</div>';

 echo '<META HTTP-EQUIV="Refresh" Content="2; URL=../login/">';


?>
