<?php
include '../../koneksi/koneksi.php';
session_start();
error_reporting(0);

header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
$fileName = "testUserssdasdsa";
header("Content-Disposition: attachment; filename=".$fileName.".xls");

// Fungsi header dengan mengirimkan raw data excel
//header("Content-type: application/vnd-ms-excel");
$tanggal=date("Ymd");

$awal =$_POST['awal'];
$akhir=$_POST['akhir']; 
$status=$_POST['status']; 
$kode=$_SESSION['kode']; 
// Mendefinisikan nama file ekspor "hasil-export.xls"
// header("Content-Disposition: attachment; filename=$awal-to-$akhir-outstanding-payment-report.xls");
// header("Content-Type: application/xls");     
header("Pragma: no-cache"); 
header("Expires: 0");


// Tambahkan table
?>
<table id="example" class="table table-striped responsive-utilities jambo_table" border="1">
            <thead>
                <tr class="headings">
                    <th rowspan="2"><center>Shipment Date</center> </th>
                    <th rowspan="2"><center>BL</center></th>
                    <th colspan="5"><center>Container Size </th>
                    <!-- <th rowspan="2"><center>Qty WIN </th> -->
                    <th rowspan="2" width="10%"><center>Product Type </th>
                    <th rowspan="2" width="5%"><center>Contribution Fee (USD $)</th>
                    <!-- <th rowspan="2" width="5%"><center>Discount (%)</th>
                    <th rowspan="2" width="5%"><center>Total Contribution Fee (USD $)</th> -->
                    <th rowspan="2"><center>Payment Date</th>
                    <th rowspan="2" width="5%"><center>Status</th>
                </tr>
                <tr>
            
                        <th width="5%"><center>20'</center></th>
                        <th width="5%"><center>40'</center></th>
                        <th width="5%"><center>40' HC</center></th>
                        <th width="5%"><center>45'</center></th>
                        <th width="5%"><center>60'</center></th>
                  
                </tr>
            </thead>

            <tbody>
<?php


$no=1;
if ($status==2) {
  $out_payment=mysql_query("select substr(wkt_shipment,1,4) as th_ship,
  substr(wkt_shipment,6,2) as bln_ship,
  substr(wkt_shipment,9,2) as dt_ship,
  bl,fee,diskon,no_shipment,no_order,
  wins_used,tgl_paid,acc_paid from t4t_shipment where id_comp='$kode' and
  bl_tgl BETWEEN '$awal' and '$akhir' 
  order by substr(wkt_shipment,1,4) desc");
}else{
  $out_payment=mysql_query("select substr(wkt_shipment,1,4) as th_ship,
  substr(wkt_shipment,6,2) as bln_ship,
  substr(wkt_shipment,9,2) as dt_ship,
  bl,fee,diskon,no_shipment,no_order,
  wins_used,tgl_paid,acc_paid from t4t_shipment where id_comp='$kode' and
  bl_tgl BETWEEN '$awal' and '$akhir' 
  and acc_paid='$status' order by substr(wkt_shipment,1,4) desc");
}
while ($data=mysql_fetch_array($out_payment)) {
    

 ?>

    <tr class="even pointer">
        <td class=" " align="center"><?php 
        date_default_timezone_set('Asia/Jakarta'); 
        $th_ship=$data['th_ship'];
        $bln_ship=$data['bln_ship'];
        $dt_ship=$data['dt_ship'];
        $wkt_shipment=$dt_ship."/".$bln_ship."/".$th_ship;
        echo $wkt_shipment;
         ?></td>
        <td class=" "><?php echo $data['bl'] ?></td>
        <?php 
$no_ship=$data['no_shipment'];
$cont1=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_ship' and no_cont=1"));
$cont2=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_ship' and no_cont=2"));
$cont3=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_ship' and no_cont=3"));
$cont4=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_ship' and no_cont=4"));
$cont5=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_ship' and no_cont=5"));

$no_order=$data['no_order'];
$tipe_prod=mysql_fetch_array(mysql_query("select tipe_prod from t4t_order where no_order='$no_order'"));

         ?>

        <td class=" " align="center"><?php echo $cont1[0] ?></td>
        <td class=" " align="center"><?php echo $cont2[0] ?></td>
        <td class=" " align="center"><?php echo $cont3[0] ?></td>
        <td class=" " align="center"><?php echo $cont4[0] ?></td>
        <td class=" " align="center"><?php echo $cont5[0] ?></td>
        <!-- <td class=" ">
         <?php 
         $zz=$data['no'];//variable pembeda n

         $win_num=$data['wins_used'];
         $ex_win=explode(",", $win_num);
         $ex_win2=count($ex_win);
         //echo $ex_win2;
         $n=array();
         if ($ex_win2==1) {
             $ex_sd=explode("-", $win_num);
             $start=$ex_sd[0];
             //echo $start;
             if (!$ex_sd[1]) {
                 $end=$ex_sd[0];
             }else{
                $end=$ex_sd[1];
             }
        
             //echo $end;
             $n=($end-$start)+1;
             echo $n."<br>";
         }else{
            for ($i=0; $i < $ex_win2; $i++) { 
                //echo $ex_win[$i]."<br>";
                
                $ex_sd=explode("-", $ex_win[$i]);
                //echo $ex_sd[0]."<br>";
                if (!$ex_sd[1]) {
                    $n=1;
                    //echo $n."<br>";
                }else{
                    $start=$ex_sd[0];
                    //echo $start;
                    if (!$ex_sd[1]) {
                        $end=$ex_sd[0];
                    }else{
                       $end=$ex_sd[1];
                    }
                
                    //echo $end;
                    $n=($end-$start)+1;
                    //echo $n."<br>";
                }
             //    echo $n."<br>";
               // echo array_sum(array($n);
                 $jml=array($n);


            }



         }


//echo array_sum($jml);

          ?></td> -->
        <td class=" "><?php
           $no_ordr=$data['no_order'];
           $ex_order=explode(",", $no_ordr);
           $ordr1=$ex_order[0];

           $tipe=mysql_fetch_row(mysql_query("select tipe_prod from t4t_order where no_order='$ordr1'"));
           echo strtoupper($tipe[0]);
           ?></td>

        <td class=" " align="right"><?php echo $data['fee'] ?></td>

        <!-- <td class=" " align="right"><?php echo $data['diskon'] ?></td>
        <td class=" " align="right"><?php 
        $diskon=($data['diskon']/100)*$data['fee'];
        $total=$data['fee']-$diskon;
        echo $total;
         ?></td> -->

         <td align="center"><?php 
           if ($data['tgl_paid']=='0000-00-00') {
             echo "-";
           }else{
           $ex_wkt_paid=explode("-", $data['tgl_paid']);
           echo $ex_wkt_paid[2].'/'.$ex_wkt_paid[1].'/'.$ex_wkt_paid[0]; 
           }
           ?></td>

         <td align="center">
           <?php 
           if ($data['acc_paid']==0) {
             echo "&empty;";
           }else{
            echo "&#9745;";
           }
           ?>
            </td>
        
    </tr>
              
<?php 
  $no++;  }
 ?>      
                
            </tbody>

        </table>