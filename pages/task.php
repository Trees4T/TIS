<?php
include '../koneksi/koneksi.php';
session_start();
ob_start();
unset($_SESSION['ketemu']);
$win = $_POST['win'];
//$win = 534760;


$order = $conn->query("SELECT id_comp from t4t_order where wins1 < '$win' and wins2 > '$win'");
while ($load_order = $order->fetch()) {
  $comp=$load_order['id_comp'];
      $bl = $conn->query("SELECT bl from t4t_shipment where id_comp='$comp'");
      //$jml= $conn->query("SELECT count(*) from t4t_shipment where id_comp='MF024'")->fetch();
      while ($load_bl = $bl->fetch()) {

          $cek_bl = $load_bl['bl'];
              $ambil_bl = $conn->query("SELECT wins_used from t4t_shipment where bl='$cek_bl'")->fetch();
              //echo str_replace(' ','',$ambil_bl[0])."<br><br>";
              echo str_replace(' ','',$ambil_bl[0])."<br><br>";

              $pecah = explode(",", $ambil_bl[0]);
              $jml_pecah = count($pecah);


              for ($i=0; $i < $jml_pecah ; $i++) {
                $pecah[$i]."<br>";
                $pecah_2 = explode("-", $pecah[$i]);

                if (isset($pecah_2[1])) {

                  for ($j=$pecah_2[0]; $j <= $pecah_2[1] ; $j++) {
                     echo $n = $j." ";
                     if ($j==$win) {
                       echo "string";
                       $_SESSION['ketemu']=$cek_bl;
                     }
                  }

                }else{
                   echo $n = $pecah_2[0];
                   if ($n==$win) {
                      echo "string";
                      $_SESSION['ketemu']=$cek_bl;
                   }
                }

              }


      }
}//end while order

      // $ketemu=$_SESSION['ketemu'];
      // if (isset($ketemu)) {
      //   header("location:../dashboard/admin-office.php?cc341787c9dc94e264c6b37728243c42fe9932ba1b1d0d2b903b588d7fd2fb85");
      // }


?>
