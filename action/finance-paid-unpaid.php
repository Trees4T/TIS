<?php 
error_reporting(0);
session_start();

ob_start();
include '../koneksi/koneksi.php';

unset($_SESSION['email_member']);

$btn_save_paid   =$_POST['btn_save_paid'];
$btn_save_unpaid =$_POST['btn_save_unpaid'];
$link            =$_POST['link'];
$bl              =$_POST['bl'];
$shipment        =$_POST['shipment'];
$comp            =$_POST['comp'];
$wins_used       =$_POST['wins_used'];
$order           =$_POST['order'];
$item            =$_POST['item'];
$id_member       =$_POST['id_member'];
$btn_save_fee    =$_POST['btn_save_fee'];
$fee             =$_POST['fee'];

$email_member =mysql_fetch_row(mysql_query("select email from t4t_partisipan where id='$id_member'"));

date_default_timezone_set('Asia/Jakarta');
$tahun=date("Y");
$tanggal_indo =date("d/m/Y H:i:s");
$tanggal = date("Y-m-d");

$wkt_shipment=mysql_fetch_row(mysql_query("select wkt_shipment from t4t_shipment where bl='$bl'"));
$data_wkt_ship=$wkt_shipment[0];

if(isset($btn_save_unpaid)) {

  $update_acc1=mysql_fetch_row(mysql_query("update t4t_shipment set acc_paid='0',tgl_paid='',wkt_shipment='$data_wkt_ship' where bl='$bl'"));
  echo $error_acc1=mysql_error();

  if ($error_acc1==false) {
    $_SESSION['success']=3;  // success
    $_SESSION['bl']=$bl;
    header("location:../dashboard/finance-office.php?$link");
  }else{
    $_SESSION['success']=4;  // error
    $_SESSION['bl']=$bl;
    header("location:../dashboard/finance-office.php?$link");
  }

}elseif(isset($btn_save_paid)) {

  $update_acc0=mysql_fetch_row(mysql_query("update t4t_shipment set acc_paid='1',tgl_paid='$tanggal',wkt_shipment='$data_wkt_ship' where bl='$bl'"));
  $error_acc0=mysql_error();
  $_SESSION['email_member']=$email_member[0];
  $_SESSION['company_name']=$comp;
  
  if ($error_acc0==false) {
    $_SESSION['success']=5;  // success
    $_SESSION['bl']=$bl;
     ################email##############
      require '../assets/PHPMailer/PHPMailerAutoload.php';

      $mail = new PHPMailer;
      include 'mail/system-mail.php';


      $mail->Subject = 'Shipment Confirmation';
      $mail->Body    = '
      <table align="center" width="600">

       <tr>
         <td bgcolor="#0b6454" align="center">
           <br><br><h2><font color="white">Shipment Confirmation! </font></h2> 
         </td>
       </tr>
       <tr align="center">         
        <td bgcolor="#fff">
                <br>
                
         <table align="center" class="table">                        
                        <tr>
                          <td >&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr> 
                        <tr>
                          <td ><b>Status</td>
                          <td>:</td>
                          <td><b><font color="green">PAID &#9745;</font></b></td>
                        </tr>
                        <tr>
                          <td ><b>Shipment No.</td>
                          <td>:</td>
                          <td>'.$shipment.'</td>
                        </tr>
                        <tr>
                          <td ><b>Company Name</td>
                          <td>:</td>
                          <td>'.$comp.'</td>
                        </tr>                                                                              
                        <tr class="active" >
                          <td ><b>BL No.</td>
                          <td>:</td>
                          <td>'. $bl.'</td>
                        </tr>
                        <tr>
                          <td ><b>WINS Used</td>
                          <td>:</td>
                          <td>'. $wins_used.'</td>
                        </tr>  
                        <tr class="active" >
                          <td ><b>Processed Time</td>
                          <td>:</td>
                          <td>'. $tanggal_indo.'</td>
                        </tr>
                        <tr>
                          <td ><b>Order No.</td>
                          <td>:</td>
                          <td>'. $order.'</td>
                        </tr> 
                        <tr>
                          <td ><b>Item Qty</td>
                          <td>:</td>
                          <td>'. $item.'</td>
                        </tr>  
                       
                        <br>               
                    </table>
                    <br>
                    <br>
        </td>
       </tr>
       <tr>
        <td bgcolor="#0b6454" align="center">
        <br>
        <font color="#fff" size="0.5">&copy; '.$tahun.' Trees4Trees&trade; </font>
        <br><br>
        </td>
       </tr>
      </table>
      ';
      $mail->AltBody = '';

      if(!$mail->send()) {
          echo 'Message could not be sent.';
          echo 'Mailer Error: ' . $mail->ErrorInfo;
          $_SESSION['mail']=0;
      } else {
          echo 'Message has been sent';
          $_SESSION['mail']=1;
      }
      ###############end mail############
    

    header("location:../dashboard/finance-office.php?$link");
  }else{
    $_SESSION['success']=6;  // error
    $_SESSION['bl']=$bl;
    header("location:../dashboard/finance-office.php?$link");
  }

}elseif(isset($btn_save_fee)) {

  $update_fee=mysql_fetch_row(mysql_query("update t4t_shipment set fee='$fee',wkt_shipment='$data_wkt_ship' where bl='$bl'"));
  echo $error=mysql_error();

  if ($error==false) {
    $_SESSION['success']=7;  // success fee
    $_SESSION['bl']=$bl;
    $_SESSION['fee']=$fee;
    $_SESSION['id_member']=$id_member;
    $_SESSION['link']=$link;
    include 'report/excel-invoice.php';
   
  }else{
    $_SESSION['success']=8;  // error fee
    $_SESSION['bl']=$bl;
    header("location:../dashboard/finance-office.php?$link");
  }

}else{
	header("location:../error/403.php");
}

 ?>