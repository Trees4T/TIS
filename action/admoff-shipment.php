<?php 
error_reporting(0);
session_start();

ob_start();
include '../koneksi/koneksi.php';

unset($_SESSION['email_member']);

$btn_save_win =$_POST['btn_save_win'];
$btn_save_acc1=$_POST['btn_save_acc1'];
$btn_save_acc0=$_POST['btn_save_acc0'];
$link         =$_POST['link'];
$bl           =$_POST['bl'];
$shipment     =$_POST['shipment'];
$comp         =$_POST['comp'];
$wins_used    =$_POST['wins_used'];
$order        =$_POST['order'];
$item         =$_POST['item'];
$id_member    =$_POST['id_member'];

$email_member =$conn->query("select email from t4t_partisipan where id='$id_member'")->fetch();

date_default_timezone_set('Asia/Jakarta');
$tahun=date("Y");
$tanggal_indo =date("d/m/Y H:i:s");

$wkt_shipment=$conn->query("select wkt_shipment from t4t_shipment where bl='$bl'")->fetch();
$data_wkt_ship=$wkt_shipment[0];

if (isset($btn_save_win)) {

  $wins = $_POST['wins'];
  try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $update_win=$conn->query("update t4t_shipment set wins_used='$wins', wkt_shipment='$data_wkt_ship' where bl='$bl' ");
  } catch (PDOException $e) {
    $error_win = $e->getMessage();
  }

  if ($error_win==false) {
    $_SESSION['success']=1;  //wins success
    $_SESSION['bl']=$bl;
    header("location:../dashboard/admin-office.php?$link");
  }else{
    $_SESSION['success']=2; //wins error
    $_SESSION['bl']=$bl;
    header("location:../dashboard/admin-office.php?$link");
  }

}elseif(isset($btn_save_acc1)) {
  try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $update_acc1=$conn->query("update t4t_shipment set acc='0', wkt_shipment='$data_wkt_ship' where bl='$bl'");
  } catch (PDOException $e) {
    $error_acc1= $e->getMessage();
  }
  
  

  if ($error_acc1==false) {
    $_SESSION['success']=3;  //acc1 success
    $_SESSION['bl']=$bl;
    header("location:../dashboard/admin-office.php?$link");
  }else{
    $_SESSION['success']=4;  //acc1 error
    $_SESSION['bl']=$bl;
    header("location:../dashboard/admin-office.php?$link");
  }

}elseif(isset($btn_save_acc0)) {
  try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $update_acc0=$conn->query("update t4t_shipment set acc='1', wkt_shipment='$data_wkt_ship' where bl='$bl'");
  } catch (PDOException $e) {
    $error_acc0=$e->getMessage();
  }
  
  
  $_SESSION['email_member']=$email_member[0];
  $_SESSION['company_name']=$comp;
  
  if ($error_acc0==false) {
    $_SESSION['success']=5;  //acc0 success
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
                <div align="center">
                    <font color="red"><b><i>Already processed, please make a payment.</i></b></font>
                </div>
         <table align="center" class="table">                        
                        <tr>
                          <td >&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
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
    

    header("location:../dashboard/admin-office.php?$link");
  }else{
    $_SESSION['success']=6;  //acc0 error
    $_SESSION['bl']=$bl;
    header("location:../dashboard/admin-office.php?$link");
  }

}else{
	header("location:../error/403.php");
}

 ?>