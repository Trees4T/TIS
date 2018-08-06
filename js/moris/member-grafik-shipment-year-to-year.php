 <?php
 session_start();
 include '../../koneksi/koneksi.php';
    $kode=$_SESSION['kode'];
    $tahun=date("Y");
    $bulan=date("m");

    if ($tahun==$_SESSION['ship_act_year'] or $_SESSION['ship_act_year']=="") {
      $tahun=date("Y");
      $bulan=date("m");
    }else{
      $tahun=$_SESSION['ship_act_year'];
      $bulan="12";
    }




    $query_wkt_shipment=$conn->query("select wkt_shipment from t4t_shipment where id_comp='$kode'");
    $wkt_shipment=$query_wkt_shipment->fetch();

    ?>

      // Line chart
      var ctx = document.getElementById("this_year_shipment");
      var this_year_shipment = new Chart(ctx, {
        type: 'line',
        data: {

          labels:
          [
          <?php for ($i=1; $i <= $bulan ; $i++) {
           ?>
          "<?php
              $i;
              if($i==1){
                echo "January";
              }
              if($i==2){
                echo "February";
              }
              if($i==3){
                echo "March";
              }
              if($i==4){
                echo "April";
              }
              if($i==5){
                echo "May";
              }
              if($i==6){
                echo "June";
              }
              if($i==7){
                echo "July";
              }
              if($i==8){
                echo "August";
              }
              if($i==9){
                echo "September";
              }
              if($i==10){
                echo "October";
              }
              if($i==11){
                echo "November";
              }
              if($i==12){
                echo "December";
              }
           ?>",
          <?php
          } ?>
          ],

          datasets: [

            {
              label: "Shipment",
              backgroundColor: "rgba(38, 185, 154, 0.31)",
              borderColor: "rgba(38, 185, 154, 0.7)",
              pointBorderColor: "rgba(38, 185, 154, 0.7)",
              pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
              pointHoverBackgroundColor: "#fff",
              pointHoverBorderColor: "rgba(220,220,220,1)",
              pointBorderWidth: 1,
              data: [
              <?php for ($i=1; $i <= $bulan ; $i++) { ?>

              <?php
                  if($i==1){
                    $i="01";
                  }
                  if($i==2){
                    $i="02";
                  }
                  if($i==3){
                    $i="03";
                  }
                  if($i==4){
                    $i="04";
                  }
                  if($i==5){
                    $i="05";
                  }
                  if($i==6){
                    $i="06";
                  }
                  if($i==7){
                    $i="07";
                  }
                  if($i==8){
                    $i="08";
                  }
                  if($i==9){
                    $i="09";
                  }

                  $ship=$conn->query("select count(no_shipment) from t4t_shipment where wkt_shipment like '%-$i-%' and id_comp='$kode' and wkt_shipment like '%$tahun%' and acc_paid=1");
                  $ship2=$ship->fetch();
                  echo json_encode($ship2[0]).",";

              ?>

              <?php } ?>
              ]
            },
           <!-- fee -->
            {
              label: "Item Qty",
              backgroundColor: "rgba(3, 88, 106, 0.3)",
              borderColor: "rgba(3, 88, 106, 0.70)",
              pointBorderColor: "rgba(3, 88, 106, 0.70)",
              pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
              pointHoverBackgroundColor: "#fff",
              pointHoverBorderColor: "rgba(151,187,205,1)",
              pointBorderWidth: 1,
              data:
              [
              <?php for ($i=1; $i <= $bulan ; $i++) { ?>

              <?php
                  if($i==1){
                    $i="01";
                  }
                  if($i==2){
                    $i="02";
                  }
                  if($i==3){
                    $i="03";
                  }
                  if($i==4){
                    $i="04";
                  }
                  if($i==5){
                    $i="05";
                  }
                  if($i==6){
                    $i="06";
                  }
                  if($i==7){
                    $i="07";
                  }
                  if($i==8){
                    $i="08";
                  }
                  if($i==9){
                    $i="09";
                  }

                  $item=$conn->query("select sum(item_qty) from t4t_shipment where wkt_shipment like '%-$i-%' and id_comp='$kode' and wkt_shipment like '%$tahun%' and acc_paid=1");
                  $item2=$item->fetch();
                  if ($item2[0]=="") {
                    echo "0,";
                  }else{
                  echo json_encode($item2[0]).",";
                  //echo "0,";
                  }
              ?>

              <?php } ?>
              ]
            }

          ]
        },
      });


      
