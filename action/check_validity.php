<?php
session_start();

ob_start();
include '../koneksi/koneksi.php';

function multiexplode ($delimiters,$string) {

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}
$comp = $_POST['comp'];

$no_order = array();
$no_order = $_POST['order'];

$order_ex = explode(",", $no_order);
$order_count = count($order_ex);

// for ($i=0; $i < $order_count ; $i++) {
//   echo $order = $order_ex[$i]."<br>";
// }


$wins_used = $_POST['wins_used'];
$wins_used = str_replace(' ', '', $wins_used);

if(!empty($wins_used)) {


  $wins_ex = multiexplode(array(",","-"), $wins_used);
  $jml_pecah = count($wins_ex);

  for ($i=0; $i < $jml_pecah ; $i++) {

    ### FOR DEBUG
    $wins = $wins_ex[$i]."<br>";

    ########### no order ################
     $get_order = $conn->query("SELECT no_order from t4t_order where id_comp='$comp' and wins1 <= '$wins' and wins2 >= '$wins' OR wins1='$wins' AND wins2='$wins'")->fetch();

     ### FOR DEBUG
     //echo $get_order[0]."<br>";

     if ($get_order[0]!="") {

       //jika kosong dan <> sesuai dengan no order yang dipilih maka hasil eror plus muncul no wins yang bersangkutan, "Please check again your Hang Tag Numbers Used"
       if ( $order_ex[0]!="null" ) {

         if ( $get_order[0]==$order_ex[0] ) { //#1
           $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
         }elseif ( $get_order[0]==$order_ex[1] ) {
           $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
         }elseif ( $get_order[0]==$order_ex[2] ) {
           $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
         }elseif ( $get_order[0]==$order_ex[3] ) {
           $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
         }elseif ( $get_order[0]==$order_ex[4] ) {
           $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
         }elseif ( $get_order[0]==$order_ex[5] ) {
           $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
         }elseif ( $get_order[0]==$order_ex[6] ) {
           $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
         }elseif ( $get_order[0]==$order_ex[7] ) {
           $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
         }elseif ( $get_order[0]==$order_ex[8] ) {
           $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
         }elseif ( $get_order[0]==$order_ex[9] ) {
           $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
         }elseif ( $get_order[0]==$order_ex[10] ) {
           $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
         }elseif ( $get_order[0]==$order_ex[11] ) {
           $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
         }elseif ( $get_order[0]==$order_ex[12] ) {
           $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
         }elseif ( $get_order[0]==$order_ex[13] ) {
           $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
         }elseif ( $get_order[0]==$order_ex[14] ) {
           $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
         }elseif ( $get_order[0]==$order_ex[15] ) {
           $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
         }elseif ( $get_order[0]==$order_ex[16] ) {
           $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
         }elseif ( $get_order[0]==$order_ex[17] ) {
           $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
         }elseif ( $get_order[0]==$order_ex[18] ) {
           $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
         }elseif ( $get_order[0]==$order_ex[19] ) {
           $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
         }


         else{
           $eror2 = "<span class='red'><i class='fa fa-minus-circle'></i> Please check the <b>Order No.</b> and <b>Hang Tag Numbers Used</b>.</span>";
         }

         if ( $order_ex[1]!="null" ){ //#2
           if ( $get_order[0]==$order_ex[0] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[1] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[2] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[3] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[4] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[5] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[6] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[7] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[8] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[9] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[10] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[11] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[12] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[13] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[14] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[15] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[16] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[17] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[18] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[19] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }
         }else{
           $eror2 = "<span class='red'><i class='fa fa-minus-circle'></i> Please check the <b>Order No.</b> and <b>Hang Tag Numbers Used</b>.</span>";
         }

         if ( $order_ex[2]!="null" ){ //#3
           if ( $get_order[0]==$order_ex[0] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[1] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[2] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[3] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[4] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[5] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[6] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[7] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[8] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[9] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[10] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[11] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[12] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[13] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[14] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[15] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[16] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[17] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[18] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[19] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }
         }else{
           $eror2 = "<span class='red'><i class='fa fa-minus-circle'></i> Please check the <b>Order No.</b> and <b>Hang Tag Numbers Used</b>.</span>";
         }

         if ( $order_ex[3]!="null" ){ //#4
           if ( $get_order[0]==$order_ex[0] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[1] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[2] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[3] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[4] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[5] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[6] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[7] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[8] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[9] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[10] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[11] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[12] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[13] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[14] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[15] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[16] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[17] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[18] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[19] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }
         }else{
           $eror2 = "<span class='red'><i class='fa fa-minus-circle'></i> Please check the <b>Order No.</b> and <b>Hang Tag Numbers Used</b>.</span>";
         }

         if ( $order_ex[4]!="null" ){ //#5
           if ( $get_order[0]==$order_ex[0] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[1] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[2] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[3] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[4] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[5] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[6] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[7] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[8] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[9] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[10] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[11] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[12] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[13] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[14] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[15] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[16] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[17] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[18] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[19] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }
         }else{
           $eror2 = "<span class='red'><i class='fa fa-minus-circle'></i> Please check the <b>Order No.</b> and <b>Hang Tag Numbers Used</b>.</span>";
         }

         if ( $order_ex[5]!="null" ){ //#6
           if ( $get_order[0]==$order_ex[0] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[1] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[2] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[3] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[4] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[5] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[6] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[7] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[8] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[9] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[10] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[11] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[12] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[13] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[14] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[15] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[16] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[17] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[18] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[19] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }
         }else{
           $eror2 = "<span class='red'><i class='fa fa-minus-circle'></i> Please check the <b>Order No.</b> and <b>Hang Tag Numbers Used</b>.</span>";
         }

         if ( $order_ex[6]!="null" ){ //#7
           if ( $get_order[0]==$order_ex[0] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[1] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[2] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[3] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[4] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[5] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[6] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[7] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[8] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[9] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[10] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[11] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[12] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[13] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[14] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[15] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[16] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[17] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[18] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[19] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }
         }else{
           $eror2 = "<span class='red'><i class='fa fa-minus-circle'></i> Please check the <b>Order No.</b> and <b>Hang Tag Numbers Used</b>.</span>";
         }

         if ( $order_ex[7]!="null" ){ //#8
           if ( $get_order[0]==$order_ex[0] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[1] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[2] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[3] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[4] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[5] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[6] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[7] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[8] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[9] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[10] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[11] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[12] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[13] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[14] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[15] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[16] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[17] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[18] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[19] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }
         }else{
           $eror2 = "<span class='red'><i class='fa fa-minus-circle'></i> Please check the <b>Order No.</b> and <b>Hang Tag Numbers Used</b>.</span>";
         }

         if ( $order_ex[8]!="null" ){ //#9
           if ( $get_order[0]==$order_ex[0] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[1] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[2] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[3] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[4] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[5] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[6] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[7] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[8] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[9] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[10] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[11] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[12] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[13] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[14] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[15] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[16] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[17] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[18] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[19] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }
         }else{
           $eror2 = "<span class='red'><i class='fa fa-minus-circle'></i> Please check the <b>Order No.</b> and <b>Hang Tag Numbers Used</b>.</span>";
         }

         if ( $order_ex[9]!="null" ){ //#10
           if ( $get_order[0]==$order_ex[0] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[1] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[2] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[3] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[4] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[5] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[6] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[7] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[8] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[9] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[10] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[11] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[12] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[13] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[14] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[15] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[16] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[17] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[18] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[19] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }
         }else{
           $eror2 = "<span class='red'><i class='fa fa-minus-circle'></i> Please check the <b>Order No.</b> and <b>Hang Tag Numbers Used</b>.</span>";
         }

         if ( $order_ex[10]!="null" ){ //#11
           if ( $get_order[0]==$order_ex[0] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[1] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[2] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[3] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[4] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[5] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[6] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[7] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[8] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[9] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[10] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[11] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[12] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[13] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[14] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[15] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[16] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[17] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[18] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[19] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }
         }else{
           $eror2 = "<span class='red'><i class='fa fa-minus-circle'></i> Please check the <b>Order No.</b> and <b>Hang Tag Numbers Used</b>.</span>";
         }

         if ( $order_ex[11]!="null" ){ //#12
           if ( $get_order[0]==$order_ex[0] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[1] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[2] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[3] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[4] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[5] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[6] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[7] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[8] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[9] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[10] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[11] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[12] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[13] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[14] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[15] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[16] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[17] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[18] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[19] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }
         }else{
           $eror2 = "<span class='red'><i class='fa fa-minus-circle'></i> Please check the <b>Order No.</b> and <b>Hang Tag Numbers Used</b>.</span>";
         }

         if ( $order_ex[12]!="null" ){ //#13
           if ( $get_order[0]==$order_ex[0] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[1] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[2] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[3] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[4] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[5] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[6] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[7] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[8] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[9] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[10] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[11] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[12] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[13] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[14] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[15] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[16] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[17] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[18] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[19] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }
         }else{
           $eror2 = "<span class='red'><i class='fa fa-minus-circle'></i> Please check the <b>Order No.</b> and <b>Hang Tag Numbers Used</b>.</span>";
         }

         if ( $order_ex[13]!="null" ){ //#14
           if ( $get_order[0]==$order_ex[0] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[1] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[2] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[3] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[4] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[5] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[6] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[7] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[8] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[9] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[10] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[11] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[12] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[13] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[14] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[15] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[16] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[17] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[18] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[19] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }
         }else{
           $eror2 = "<span class='red'><i class='fa fa-minus-circle'></i> Please check the <b>Order No.</b> and <b>Hang Tag Numbers Used</b>.</span>";
         }

         if ( $order_ex[14]!="null" ){ //#15
           if ( $get_order[0]==$order_ex[0] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[1] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[2] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[3] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[4] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[5] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[6] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[7] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[8] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[9] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[10] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[11] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[12] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[13] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[14] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[15] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[16] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[17] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[18] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[19] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }
         }else{
           $eror2 = "<span class='red'><i class='fa fa-minus-circle'></i> Please check the <b>Order No.</b> and <b>Hang Tag Numbers Used</b>.</span>";
         }

         if ( $order_ex[15]!="null" ){ //#16
           if ( $get_order[0]==$order_ex[0] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[1] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[2] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[3] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[4] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[5] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[6] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[7] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[8] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[9] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[10] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[11] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[12] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[13] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[14] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[15] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[16] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[17] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[18] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[19] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }
         }else{
           $eror2 = "<span class='red'><i class='fa fa-minus-circle'></i> Please check the <b>Order No.</b> and <b>Hang Tag Numbers Used</b>.</span>";
         }

         if ( $order_ex[16]!="null" ){ //#17
           if ( $get_order[0]==$order_ex[0] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[1] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[2] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[3] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[4] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[5] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[6] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[7] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[8] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[9] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[10] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[11] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[12] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[13] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[14] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[15] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[16] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[17] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[18] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[19] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }
         }else{
           $eror2 = "<span class='red'><i class='fa fa-minus-circle'></i> Please check the <b>Order No.</b> and <b>Hang Tag Numbers Used</b>.</span>";
         }

         if ( $order_ex[17]!="null" ){ //#18
           if ( $get_order[0]==$order_ex[0] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[1] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[2] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[3] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[4] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[5] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[6] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[7] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[8] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[9] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[10] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[11] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[12] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[13] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[14] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[15] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[16] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[17] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[18] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[19] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }
         }else{
           $eror2 = "<span class='red'><i class='fa fa-minus-circle'></i> Please check the <b>Order No.</b> and <b>Hang Tag Numbers Used</b>.</span>";
         }

         if ( $order_ex[18]!="null" ){ //#19
           if ( $get_order[0]==$order_ex[0] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[1] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[2] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[3] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[4] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[5] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[6] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[7] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[8] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[9] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[10] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[11] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[12] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[13] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[14] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[15] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[16] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[17] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[18] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[19] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }
         }else{
           $eror2 = "<span class='red'><i class='fa fa-minus-circle'></i> Please check the <b>Order No.</b> and <b>Hang Tag Numbers Used</b>.</span>";
         }

         if ( $order_ex[19]!="null" ){ //#20
           if ( $get_order[0]==$order_ex[0] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[1] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[2] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[3] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[4] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[5] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[6] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[7] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[8] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[9] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[10] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[11] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[12] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[13] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[14] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[15] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[16] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[17] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[18] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }elseif ( $get_order[0]==$order_ex[19] ) {
             $eror = "<span class='green'><i class='fa fa-check-circle'></i> OK.</span>";
           }
         }else{
           $eror2 = "<span class='red'><i class='fa fa-minus-circle'></i> Please check the <b>Order No.</b> and <b>Hang Tag Numbers Used</b>.</span>";
         }

       }else{
         $eror = "<span class='red'><i class='fa fa-minus-circle'></i> Please select <b>Order No.</b> first.</span>";
       }

    }else{
      $eror2 = "<span class='red'>'".$wins_ex[$i]."' not match with selected Order No.<br><i class='fa fa-minus-circle'></i> Please check the <b>Order No.</b> and <b>Hang Tag Numbers Used</b>.</span>";
    }


  }
  if ($eror2!="") {
    echo $eror2;
    $_SESSION['eror']=1;
  }elseif($eror=="<span class='green'><i class='fa fa-check-circle'></i> OK.</span>"){
    echo $eror;
    $_SESSION['eror']=0;
  }else{
    echo $eror;
    $_SESSION['eror']=1;
  }



}//end
?>
