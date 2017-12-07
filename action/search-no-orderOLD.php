<?php
ob_start();
include '../koneksi/koneksi.php';
session_start();

$shipment = $_POST['no_ship'];

if (isset($shipment)) {

  ## loop t4t_shipment
  $ship = $conn->query("SELECT wins_used,id_comp from t4t_shipment where no_shipment='$shipment'");
  while ($a = $ship->fetch(PDO::FETCH_OBJ)) {
    echo $id_comp = $a->id_comp;
    echo "<br><br>";

    $wins_used = $a->wins_used;
    $wins_ex = explode(",", $wins_used);
    $jml_pecah = count($wins_ex);

    for ($i=0; $i < $jml_pecah ; $i++) {
      // echo $i;
      // echo "<br>";
      ## menampilkan wins yg di depan saja
      $wins_depan_ex = explode("-", $wins_ex[$i]);
      if (isset($wins_depan_ex[1])) {
        $wins=$wins_depan_ex[0];
        //echo "<br>";
      }else{
        $wins=$wins_ex[$i];
        //echo "<br>";
      }

    //  echo "<br>";
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
header("location:../dashboard/admin-office.php?cc341787c9dc94e264c6b37728243c42fe9932ba1b1d0d2b903b588d7fd2fb85");
  }//end while
}

// for ($i=0; $i < count($all_no_order); $i++) {
//     $i=>"$all_no_order[$i]",
//   // echo $all_no_order[$i];
//   //echo "<br>";
// }
//echo $all_no_order[];
// $order_array = array(
//   "1","1","1","2","3",
// );
// $unique = array_unique($order_array);
// print_r($unique);
//
// // $warna = array("orange", "merah", "hijau", "merah","orange","blue");
// // $warna2 = array_unique($warna);
// // print_r($warna2);
//
// //print_r $hasil = array_unique($order_array);
// echo $jml_pecah;


        //header("location:../dashboard/admin-office.php?cc341787c9dc94e264c6b37728243c42fe9932ba1b1d0d2b903b588d7fd2fb85");



?>
