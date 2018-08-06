<?php
error_reporting(0);
session_start();
include '../koneksi/koneksi.php';
$waktu=date("Y-m-d H:i:s");

$username = $_POST['username'];

$password = $_POST['password'];

$password = md5($password);
// query untuk mendapatkan record dari username
$query = $conn->prepare("SELECT * FROM otenuser WHERE uname = '$username' and status='AKTIF'");
$query->execute();

$data = $query->fetch();

// cek kesesuaian password

//echo $data['passwd'];

 if ($data['id_grup']=='fc') {
   echo "<div align='center'>
     <font color='red'>Sorry the System for Field Coordinator is under construction.
     </div>";
   echo '<META HTTP-EQUIV="Refresh" Content="3; URL=../login/logout.php">';
 }else{
     if ($password == $data['passwd'])

{

echo "<div align='center'>

  <font color='green'><strong>Success!</strong></font> Login Successful.

  </div>";

    // menyimpan username dan level ke dalam session

    $_SESSION['level']    = $data['id_grup'];

    $_SESSION['username'] = $data['uname'];

    $_SESSION['kode']     = $data['kode'];

    $username=$data['uname'];


    $level_array = array("fc","part","admoff","fin","mkt");
    foreach ($level_array as $lev_arr) {
      if ($_SESSION['level']==$lev_arr) {
        $hitlogin=$conn->query("SELECT hitlogin from otenuser where uname='$username'")->fetch();
        $plus_hitlogin=$hitlogin[0]+1;

        $up_hitlogin= $conn->query("update otenuser set hitlogin='$plus_hitlogin',lastlogin='$waktu' where uname='$username'")->fetch();
      }
    }




    if ($_SESSION['level']=="fc") {
        $kode_fc=$data['kode'];

        $ta=$conn->query("SELECT * from t4t_tamaster where kode_fc='$kode_fc'")->fetch();

        $_SESSION['ta'] = $ta['kd_ta'];

    }

    if ($_SESSION['level']=="part") {
        $kode_part=$data['kode'];

        $id_part=$conn->query("SELECT no,name from t4t_participant where id='$kode_part'")->fetch();

        $_SESSION['id_part']=$id_part[0];

        $_SESSION['nama_part']=$id_part[1];

    }

    if ($_SESSION['level']=="admoff" or $_SESSION['level']=="fin" or $_SESSION['level']=="mkt") {

        $kode_part=$data['kode'];

    }

    // if ($_SESSION['level']=="fin") {
    //     $kode_part=$data['kode'];
    // }

    //Penggunaan Meta Header HTTP
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

    }elseif ($_SESSION['level']=="mkt") {

        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../dashboard/marketing.php?e0e5ffbe8899949dca88b021319030b3c2da5ecf98f8bf0898e8ee0251ad56d0">';

    }else{

          header("location:../login/logout.php");

    }

    exit;

    }
    else
    echo '<div align="center"><font color="red"><strong>Warning!</strong></font> Login Unsuccessful.<br>Please check your username or your password.</div>';
     echo '<META HTTP-EQUIV="Refresh" Content="2; URL=../login/">';
 }



?>