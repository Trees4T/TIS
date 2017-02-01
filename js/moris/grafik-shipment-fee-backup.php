 {
              label: "Fee",
              backgroundColor: "rgba(38,185,49,0.47)",
              borderColor: "rgba(38,185,49,0.47)",
              pointBorderColor: "rgba(44,97,48,0.83)",
              pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
              pointHoverBackgroundColor: "#fff",
              pointHoverBorderColor: "rgba(58,140,54,1)",
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
                  
                  $fee=mysql_query("select sum(fee) from t4t_shipment where wkt_shipment like '%-$i-%' and id_comp='$kode' and wkt_shipment like '%$tahun%' and acc_paid=1");
                  $fee2=mysql_fetch_row($fee);
                  if ($fee2[0]=="") {
                    echo "0,";
                  }else{
                  echo json_encode($fee2[0]).",";
                  //echo "0,";
                  }
              ?>

              <?php } ?>
              ]
            },