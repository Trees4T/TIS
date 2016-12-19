<?php 
error_reporting(0);
session_start();

ob_start();
include '../koneksi/koneksi.php';

date_default_timezone_set('Asia/Jakarta');
if ($_POST['no_order']) {
	


$kode=$_SESSION['kode'];
$no_order=$_POST['no_order'];
$company=$_POST['comp'];
$type_prod=$_POST['type_prod'];
$tags=$_POST['tags'];
$destination=$_POST['destination'];
$pic=$_POST['pic'];
$tanggal=date("Y-m-d");
$tanggal_indo=date("d/m/Y H:i:s");
$last_wins=mysql_fetch_array(mysql_query("SELECT FLOOR(wins) as win FROM t4t_wins where bl!='' and no_shipment!=''  order by win desc limit 1"));
$last=$last_wins[0];

$wins1=$last+1;
$wins2=$last+$tags;

//update t4t_order
// # - no order - id comp - tipe prod - jml wins - kota tujuan - wkt order - # - # - wins1 - wins2 - quantity - #
// mysql_query("insert into t4t_order 
// (no,no_order,id_comp,tipe_prod,jml_wins,kota_tujuan,wkt_order,acc,acc2,wins1,wins2,quantity) 
// values ('','$no_order','$kode','$type_prod','$tags','$destination','$tanggal','','','','','$tags')");
mysql_query("update t4t_order set tipe_prod='$type_prod',jml_wins='$tags',quantity='$tags' where no_order='$no_order'");

echo mysql_error();
//insert t4t_orderphn
// no - no order - no phnen2
$jumlah = count($_POST['item']);

//delete old
	mysql_query("delete from t4t_orderphn where no_order='$no_order'");

for($i=0; $i < $jumlah; $i++)
{
   echo $pohon=$_POST['item'][$i];
   mysql_query("insert into t4t_orderphn (no,no_order,no_phnen2) values ('','$no_order','$pohon')");  
}


//insert t4t_orderrequest
	#delete old
	mysql_query("delete from t4t_orderrequest where no_order='$no_order'");

//no - no order - no req - jml
$jml_req=mysql_fetch_array(mysql_query("select count(no) from t4t_req"));
$jml_req[0];
for ($i=1; $i <= $jml_req[0] ; $i++) { 
	$req=$_POST['req'.$i];
	mysql_query("insert into t4t_orderrequest (no,no_order,no_req,jml) values ('','$no_order','$i','$req')");

}

//insert t4t_container
	#delete old
	mysql_query("delete from t4t_ordercontainer where no_order='$no_order'");
$jml_input=$_POST['forinput'];
echo $jml_input;
for($i=1;$i<=$jml_input;$i++)
{

echo $cont20 =$_POST['n20'.$i];
$cont40 =$_POST['n40'.$i];
$cont40hc =$_POST['n40hc'.$i];
$cont45	=$_POST['n45'.$i];
$cont60 =$_POST['n60'.$i];
$tgl 	=$_POST['tgl'.$i];

$tgl2=explode("-", $tgl);
$get_tgl=$tgl2[2]."-".$tgl2[1]."-".$tgl2[0];

	if ($tgl=="") {
		# 
	}elseif ($cont20!="") {
		mysql_query("insert into t4t_ordercontainer (no,no_order,no_cont,jml,tgl_stuf) values ('','$no_order','1','$cont20','$get_tgl')");
	}else{
		mysql_query("insert into t4t_ordercontainer (no,no_order,no_cont,jml,tgl_stuf) values ('','$no_order','1','0','$get_tgl')");
	}

	if ($tgl=="") {
		# 
	}elseif ($cont40!="") {
		mysql_query("insert into t4t_ordercontainer (no,no_order,no_cont,jml,tgl_stuf) values ('','$no_order','2','$cont40','$get_tgl')");
	}else{
		mysql_query("insert into t4t_ordercontainer (no,no_order,no_cont,jml,tgl_stuf) values ('','$no_order','2','0','$get_tgl')");
	}

	if ($tgl=="") {
		# 
	}elseif ($cont40hc!="") {
		mysql_query("insert into t4t_ordercontainer (no,no_order,no_cont,jml,tgl_stuf) values ('','$no_order','3','$cont40hc','$get_tgl')");
	}else{
		mysql_query("insert into t4t_ordercontainer (no,no_order,no_cont,jml,tgl_stuf) values ('','$no_order','3','0','$get_tgl')");
	}

	if ($tgl=="") {
		# 
	}elseif ($cont45!="") {
		mysql_query("insert into t4t_ordercontainer (no,no_order,no_cont,jml,tgl_stuf) values ('','$no_order','4','$cont45','$get_tgl')");
	}else{
		mysql_query("insert into t4t_ordercontainer (no,no_order,no_cont,jml,tgl_stuf) values ('','$no_order','4','0','$get_tgl')");
	}

	if ($tgl=="") {
		# 
	}elseif ($cont60!="") {
		mysql_query("insert into t4t_ordercontainer (no,no_order,no_cont,jml,tgl_stuf) values ('','$no_order','5','$cont60','$get_tgl')");
	}else{
		mysql_query("insert into t4t_ordercontainer (no,no_order,no_cont,jml,tgl_stuf) values ('','$no_order','5','0','$get_tgl')");
	}
	
	//insert t4t_orderwkt
	if ($tgl=="") {
		#
	}else{
		mysql_query("insert into t4t_orderwkt (no,no_order,wkt_kirim) values ('','$no_order','$get_tgl')");
	}

}

################email##############
require '../assets/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
include 'mail/system-mail.php';

$mail->Subject = 'Order Update';
$mail->Body    = '
<table align="center" width="600">

 <tr>
   <td bgcolor="#0b6454" align="center">
     <br><br><h2><font color="white">Order Update! </font></h2> 
   </td>
 </tr>
 <tr align="center">         
  <td bgcolor="#fff">
   <table align="center" class="table">                        
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr> 
                  <tr>
                    <td><b>Order No.</td>
                    <td>:</td>
                    <td>'.$no_order.'</td>
                  </tr>
                  <tr>
                    <td><b>Member</td>
                    <td>:</td>
                    <td>'.$company.'</td>
                  </tr>                                                                              
                  <tr class="active" >
                    <td><b>Porduct Type</td>
                    <td>:</td>
                    <td>'. $type_prod.'</td>
                  </tr>
                  <tr>
                    <td><b>WINS Qty</td>
                    <td>:</td>
                    <td>'. $tags.'</td>
                  </tr>  
                  <tr class="active" >
                    <td><b>Update Time</td>
                    <td>:</td>
                    <td>'. $tanggal_indo.'</td>
                  </tr>
                  <tr>
                    <td><b>Quantity</td>
                    <td>:</td>
                    <td>'. $tags.'</td>
                  </tr>  
                 
                  <br>               
              </table>
              <br><br>
  </td>
 </tr>
 <tr>
  <td bgcolor="#0b6454" align="center">
  <br>
  <font color="#fff" size="0.5">&copy; 2016 Trees4Trees&trade; </font>
  <br><br>
  </td>
 </tr>
</table>
';
$mail->AltBody = '';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
###############end mail############


$_SESSION['success']=1;
header("location:../dashboard/member.php?0a00deda25fea44b15316334aaed9df28453fce541e00b9edf1bfd40aa8d9776");
$_SESSION['order']=$no_order;

}else{
	header("location:../error/403.php");
}

 ?>