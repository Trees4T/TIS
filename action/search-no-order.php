<?php
ob_start();
include '../koneksi/koneksi.php';
session_start();

$shipment = $_POST['no_ship'];

if ($_SESSION['level']=='mkt') {
  $link = 'marketing';
}else{
  $link = 'admin-office';
}

function multiexplode ($delimiters,$string) {

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

$cek_shipment = $conn->query("SELECT wins_used,id_comp from t4t_shipment where no_shipment='$shipment'")->fetch();

if ($cek_shipment[0]== false) {
  echo $_SESSION['shipment']=$shipment;
  echo $_SESSION['kosong']=1;
  header("location:../dashboard/$link.php?cc341787c9dc94e264c6b37728243c42fe9932ba1b1d0d2b903b588d7fd2fb85");
}else{
  if (isset($shipment)) {

    ## loop t4t_shipment
    $ship = $conn->query("SELECT wins_used,id_comp from t4t_shipment where no_shipment='$shipment'");
    while ($a = $ship->fetch(PDO::FETCH_OBJ)) {
      echo $id_comp = $a->id_comp;
      echo "<br><br>";

      $wins_used = $a->wins_used;
      $wins_ex = multiexplode(array(",","-"), $wins_used);
      $jml_pecah = count($wins_ex);

      for ($i=0; $i < $jml_pecah ; $i++) {

         $wins = $wins_ex[$i];

            ## t4t_order
            $order = $conn->query("SELECT no_order from t4t_order where id_comp='$id_comp'");
              $b = $order->fetch(PDO::FETCH_OBJ);
              $b->no_order;

               $no_order = $conn->query("SELECT no_order,wins1,wins2,id_comp from t4t_order where id_comp='$id_comp' and wins1 <= '$wins' and wins2 >= '$wins' or wins1='$wins' and wins2='$wins'");

               $get_no_order = $no_order->fetch(PDO::FETCH_OBJ);

              // $$all_no_order=array();
               echo $all_no_order=$get_no_order->no_order;
               echo "<br>";
               $_SESSION['no_order'.$i]=$all_no_order;
               $_SESSION['jml']=$jml_pecah;
               $_SESSION['shipment']=$shipment;

      }//end for
  header("location:../dashboard/$link.php?cc341787c9dc94e264c6b37728243c42fe9932ba1b1d0d2b903b588d7fd2fb85");
    }//end while
  }
}//end if kosong atau tdk kosong shipmentnya



?>
