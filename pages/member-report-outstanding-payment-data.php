<?php 
error_reporting(0);
session_start();

ob_start();
include '../koneksi/koneksi.php';

date_default_timezone_set('Asia/Jakarta');
$kode=$_SESSION['kode']; 

  $tanggal=$_POST['range_tanggal'];
        $exp_tanggal=explode("-", $tanggal);
        $tanggal_awal=$exp_tanggal[0];
        $tanggal_akhir=$exp_tanggal[1];
            
            $exp_t_awal=explode("/", $tanggal_awal);
            $nilai_t_awal=trim($exp_t_awal[2])."-".$exp_t_awal[1]."-".$exp_t_awal[0];
            
            $exp_t_akhir=explode("/", $tanggal_akhir);
            $nilai_t_akhir=trim($exp_t_akhir[2])."-".$exp_t_akhir[1]."-".trim($exp_t_akhir[0]);

        $status=$_POST['status'];

        if ($status=="null") {
           echo '<META HTTP-EQUIV="Refresh" Content="0; URL=member.php?a66fedde1bcb88d81db5be1cf4a4b873cf3c9c33710cada6ca0b583e68404bd74d7a522c94fb56feb9d632ffbb8f9017">'; 
           $_SESSION['message']=2;
        }
 ?>

 <!-- page content -->
            <div class="" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Report
                    <small>
                       
                    </small>
                </h3>
                        </div>

                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><!-- List of Outstanding Payment Report -->
                                    Payment Status
                                   </h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content"> 
                                <table>
                                    <tr>
                                        <td>Company Name</td>
                                        <td>:</td>
                                        <td class="font-hijau"><?php 
                                        $comp_name=mysql_fetch_array(mysql_query("select nama from t4t_partisipan where id='$kode'"));
                                        echo $comp_name[0]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Period</td>
                                        <td>:</td>
                                        <td class="font-hijau"><?php echo $tanggal ?></td>
                                    </tr>
                                    <tr>
                                        <td>Payment Status</td>
                                        <td>:</td>
                                        <td class="font-hijau"> 
                                        <?php if ($status==2) {
                                          echo "All";
                                        }elseif ($status==1) {
                                          echo "Paid";
                                        }else{
                                          echo "Unpaid";
                                        } ?></td>
                                    </tr>
                                   
                                </table>

                                <div align="center">
                                
                                <form method="post" action="../action/report/excel-out-report.php">
                                <a href="?<?php echo paramEncrypt('hal=member-report-outstanding-payment')?>" class="btn btn-info"><i class="fa fa-hand-o-left"></i> Back</a>
                                <input type="hidden" name="status" value="<?php echo $status ?>">
                                <input type="hidden" name="awal" value="<?php echo $nilai_t_awal ?>">
                                <input type="hidden" name="akhir" value="<?php echo $nilai_t_akhir ?>">
                                <button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export to Excel</button>
                                </form>
                                </div>
                                    <table id="example" class="table table-striped responsive-utilities jambo_table" border="1">
                                        <thead>
                                            <tr class="headings">
                                                <th rowspan="2"><center>Shipment Date</center> </th>
                                                <th rowspan="2"><center>Shipment</center> </th>
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
                              bl_tgl BETWEEN '$nilai_t_awal' and '$nilai_t_akhir' 
                              order by substr(wkt_shipment,1,4) desc");
                            }else{
                              $out_payment=mysql_query("select substr(wkt_shipment,1,4) as th_ship,
                              substr(wkt_shipment,6,2) as bln_ship,
                              substr(wkt_shipment,9,2) as dt_ship,
                              bl,fee,diskon,no_shipment,no_order,
                              wins_used,tgl_paid,acc_paid from t4t_shipment where id_comp='$kode' and
                              bl_tgl BETWEEN '$nilai_t_awal' and '$nilai_t_akhir' 
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
                                    <td class=" "><?php echo $data['no_shipment'] ?></td>
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

                                       if ($ex_order[0]!="") {
                                           $ordr1=$ex_order[0];
                                       }elseif($ex_order[1]!=""){
                                           $ordr1=$ex_order[1];
                                       }elseif($ex_order[2]!=""){
                                           $ordr1=$ex_order[2];
                                       }elseif($ex_order[3]!=""){
                                           $ordr1=$ex_order[3];
                                       }elseif($ex_order[4]!=""){
                                           $ordr1=$ex_order[4];
                                       }elseif($ex_order[5]!=""){
                                           $ordr1=$ex_order[5];
                                       }elseif($ex_order[6]!=""){
                                           $ordr1=$ex_order[6];
                                       }elseif($ex_order[7]!=""){
                                           $ordr1=$ex_order[7];
                                       }elseif($ex_order[8]!=""){
                                           $ordr1=$ex_order[8];
                                       }elseif($ex_order[9]!=""){
                                           $ordr1=$ex_order[9];
                                       }elseif($ex_order[10]!=""){
                                           $ordr1=$ex_order[10];
                                       }elseif($ex_order[11]!=""){
                                           $ordr1=$ex_order[11];
                                       }elseif($ex_order[12]!=""){
                                           $ordr1=$ex_order[12];
                                       }elseif($ex_order[13]!=""){
                                           $ordr1=$ex_order[13];
                                       }elseif($ex_order[14]!=""){
                                           $ordr1=$ex_order[14];
                                       }
                                       

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
                                        echo "<i class='fa fa-check-square-o'></i>";
                                       }
                                       ?>
                                        </td>
                                    
                                </tr>
                                          
                            <?php 
                              $no++;  

                              $total_contrib[]=$data['fee'];
                            }
                             ?>    
                             <tfoot>  
                                <tr class="font-hijau">
                                    <td colspan="9">TOTAL</td>
                                    <td align="right" class="font-hijau"><b><?php echo $tot_contrib=number_format(array_sum($total_contrib),2) ?></b></td>
                                    <td colspan="2"></td>
                           <?php $_SESSION['tot_contrib']=$tot_contrib ?>         
                                </tr>
                            </tfoot>
                                        </tbody>

                                    </table>

                                
                            </div>
                        </div>

                        <br />
                        <br />
                        <br />

                    </div>
                </div>

                    
                </div>
                <!-- /page content -->
            </div>

        </div>

        <div id="custom_notifications" class="custom-notifications dsp_none">
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
            </ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications"></div>
        </div>

        <script src="../js/bootstrap.min.js"></script>

        <!-- chart js -->
        <script src="../js/chartjs/chart.min.js"></script>
        <!-- bootstrap progress js -->
        <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
        <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
        <!-- icheck -->
        <script src="../js/icheck/icheck.min.js"></script>

        <script src="../js/custom.js"></script>
        
        <!-- pace -->
        <script src="../js/pace/pace.min.js"></script>

        <!-- Datatables -->

        <script src="../js/datatables/js/jquery.dataTables.js"></script>
        <script src="../js/datatables/tools/js/dataTables.tableTools.js"></script>

        <script>
          $(function() {
              $('#example').DataTable( {
                        // "bJQueryUI":true,
                      "bPaginate":true,
                      "sPaginationType": "full_numbers",
                      "iDisplayLength":10
              } );

          } );
        </script>
</body>

</html>