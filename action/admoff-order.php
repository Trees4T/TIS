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
$order        =$_POST['order'];
$comp         =$_POST['comp'];
$type         =$_POST['type'];
$tags         =$_POST['tags'];

$email_member =$conn->query("select email from t4t_partisipan where id='$id_member'")->fetch();

date_default_timezone_set('Asia/Jakarta');
$tahun=date("Y");
$tanggal_indo =date("d/m/Y H:i:s");

if (isset($btn_save_win)) {

  $wins1 = $_POST['wins1'];
  $wins2 = $_POST['wins2'];
  
  try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $update_win=$conn->query("update t4t_order set wins1='$wins1', wins2='$wins2' where no_order='$order' ");
  } catch (PDOException $e) {
    $error_win = $e->getMessage();
  }
  
  

  if ($error_win==false) {
    $_SESSION['success']=1;  //wins success
    $_SESSION['order']=$order;
    header("location:../dashboard/admin-office.php?$link");
  }else{
    $_SESSION['success']=2; //wins error
    $_SESSION['order']=$order;
    header("location:../dashboard/admin-office.php?$link");
  }

}elseif(isset($btn_save_acc1)) {
  try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $update_acc1=$conn->query("update t4t_order set acc='0' where no_order='$order'");
  } catch (PDOException $e) {
    $error_acc1 = $e->getMessage();
  }
 

  if ($error_acc1==false) {
    $_SESSION['success']=3;  //acc1 success
    $_SESSION['order']=$order;
    header("location:../dashboard/admin-office.php?$link");
  }else{
    $_SESSION['success']=4;  //acc1 error
    $_SESSION['order']=$order;
    header("location:../dashboard/admin-office.php?$link");
  }

}elseif(isset($btn_save_acc0)) {
  try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $update_acc0=$conn->query("update t4t_order set acc='1' where no_order='$order'");
  } catch (PDOException $e) {
    $error_acc0= $e->getMessage();
  }
  
  
  $_SESSION['email_member']=$email_member[0];
  $_SESSION['company_name']=$comp;

  if ($error_acc0==false) {
    $_SESSION['success']=5;  //acc0 success
    $_SESSION['order']=$order;
    

    ################email##############
    require '../assets/PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;
    include 'mail/system-mail.php';

    $mail->Subject = 'Order Confirmation';
    $mail->Body    = '
    <table align="center" width="600">

     <tr>
       <td bgcolor="#0b6454" align="center">
         <br><br><h2><font color="white">Order Confirmation! </font></h2> 
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
                        <td>'.$order.'</td>
                      </tr>
                      <tr>
                        <td><b>Company Name</td>
                        <td>:</td>
                        <td>'.$comp.'</td>
                      </tr>                                                                              
                      <tr class="active" >
                        <td><b>Porduct Type</td>
                        <td>:</td>
                        <td>'. $type.'</td>
                      </tr>
                      <tr>
                        <td><b>WINS Qty</td>
                        <td>:</td>
                        <td>'. $tags.'</td>
                      </tr>  
                      <tr class="active" >
                        <td><b>Processed Time</td>
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
    $_SESSION['order']=$order;
    header("location:../dashboard/admin-office.php?$link");
  }

}else{
	header("location:../error/403.php");
}

 ?>