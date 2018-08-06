<?php
ob_start();
session_start();
error_reporting(0);
require_once '../action/function/class.office.php';
$office = new Office();
date_default_timezone_set('Asia/Jakarta');

$id_request = $_POST['id_request'];
$data_req = $office->data_ret_acc($id_request);
$cur_date = date("Y-m-d H:i:s");
//var_dump($data_req);

if (isset($_POST['acc'])) {
  //CEK $id_comp
  $id_comp = $office->cek_id_comp("RT");
  $id = $id_comp->nomor+1;
  $id_part = "RT".$id;

  //add Participant
    $office->insert_member2(
      $id_part,
      'Retailer',
      $data_req->name,
      $data_req->address,
      $data_req->phone,
      $data_req->fax,
      $data_req->email,
      '',
      '',
      $data_req->website,
      $data_req->director,
      $data_req->pic,
      $data_req->material,
      '',
      '',
      $data_req->outlet_qty,
      $cur_date,
      $data_req->product);

  //add buyer
  $related_part = "RT".$id;
  $office->marketing_link_add($data_req->id_part,$related_part,$data_req->ret_code);

  //delete t4t_retailer_acc

  $_SESSION['success']=1;
  $_SESSION['message']=$data_req->name;

  $office->del_ret_acc($data_req->no);
  $office->log_system($_SESSION['username'],'Linking Participant','Accepted');
  header("location:../dashboard/marketing.php?a899039200951b0b831432aa7693da6c482d168c6e05b7e1d0eac3b11b3697a790d4ceb7d83b136c12ee04ccd1f8b8e5");
}elseif(isset($_POST['reject'])){
  $_SESSION['success']=2;
  $_SESSION['message']=$data_req->name;
  //update status
  $office->update_status_ret_acc($data_req->no,'reject');
  $office->log_system($_SESSION['username'],'Linking Participant','Rejected');
  header("location:../dashboard/marketing.php?a899039200951b0b831432aa7693da6c482d168c6e05b7e1d0eac3b11b3697a790d4ceb7d83b136c12ee04ccd1f8b8e5");

}else {
  echo "fail";
}

?>
