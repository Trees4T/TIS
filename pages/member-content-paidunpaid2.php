<?php
$kode=$id_member;
$nama_member=$conn->query("select name from t4t_participant where id='$kode'")->fetch();

$actual_link0 = "$_SERVER[REQUEST_URI]";
$actual_link1 = explode("?", $actual_link0);
$actual_link  = $actual_link1[1];
if ($sts_paid==1) {
  $nm_sts_paid = "Paid";
}else{
  $nm_sts_paid = "Unpaid";
}

?>
          <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3><?php echo $nm_sts_paid ?> <span class='badge bg-green'><font color='white'> <?php echo $pil_th ?></font></span>
                <br>
                <small>
                <a href="?<?php echo paramEncrypt('hal=member-paid-unpaid&id_member='.$kode.'') ?>" data-toggle="tooltip" data-placement="bottom" title="Go to <?php echo $nama_member[0] ?> Paid & Unpaid list">
                  <br>
                <i class="fa fa-arrow-circle-left"></i> Back</a></small>

              </h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

              </div>
            </div>
          </div>


    <div class="x_panel">

          <div class="x_content">

          <!-- tabel -->
          <table class="table table-striped responsive-utilities jambo_table" border="1" id="list">
              <thead>
                  <tr>
                      <th rowspan="2" width="10%"><center>BL Date<center></th>
                      <th rowspan="2"><center>BL</center></th>
                      <th rowspan="2"><center>Shipment No.</center></th>
                      <th rowspan="2"><center>Order No.</center></th>
                      <th colspan="5"><center>Container Size</center></th>
                      <th rowspan="2"><center>Dest. City</center></th>
                      <th rowspan="2"><center>Paid</center></th>
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
              $th=$load_tahun['th'];

              $shipment=$conn->query("select * from t4t_shipment where bl_tgl like '%$pil_th%' and id_comp='$kode' and acc_paid='$sts_paid' order by bl_tgl desc");
              while ($load_shipment=$shipment->fetch()) {


              ?>
                  <tr>
                      <td align="center" width="100px"><?php echo $load_shipment['bl_tgl'] ?></td>
                      <td align="center"><a href="#" data-toggle="modal" data-target="#myModal<?php echo $load_shipment['no'] ?>"><?php echo $load_shipment['bl'] ?></a></td>
                      <td align="center"><?php echo $load_shipment['no_shipment'] ?></td>
                      <td align="">
                        <?php
                        if ($load_shipment['no_order']) {
                          echo $load_shipment['no_order'];
                        }else{
                          echo "-";
                        }

                        ?>
                      </td>
                      <td align="center">
                          <?php
                          $no_shipment=$load_shipment['no_shipment']; //definisi no shipment
                          $a=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='1'")->fetch();
                          if ($a[0]==true) {
                            echo $a[0];
                          }else{
                            echo "0";
                          }
                          ?>
                      </td>
                      <td align="center">
                          <?php
                          $b=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='2'")->fetch();
                          if ($b[0]==true) {
                            echo $b[0];
                          }else{
                            echo "0";
                          }
                          ?>
                      </td>
                      <td align="center">
                          <?php
                          $c=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='3'")->fetch();
                          if ($c[0]==true) {
                            echo $c[0];
                          }else{
                            echo "0";
                          }
                          ?>
                      </td>
                      <td align="center">
                          <?php
                          $d=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='4'")->fetch();
                          if ($d[0]==true) {
                            echo $d[0];
                          }else{
                            echo "0";
                          }
                          ?>
                      </td>
                      <td align="center">
                          <?php
                          $e=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='5'")->fetch();
                          if ($e[0]==true) {
                            echo $e[0];
                          }else{
                            echo "0";
                          }
                          ?>
                      </td>
                      <td align="center"><?php echo $load_shipment['kota_tujuan'] ?></td>
                      <td align="center">
                          <?php
                          $approve=$conn->query("select acc_paid from t4t_shipment where no_shipment='$no_shipment'")->fetch();
                          if ($approve[0]=="1") {
                              ?>
                              <i class="fa fa-check-square-o"></i>
                              <?php
                          }else{
                              ?>
                              <div class="font-15 red">&empty;</div>
                              <?php
                          }

                          ?>
                      </td>
                  </tr>
      <?php
      //modal
      include 'modal/member-bl-detail.php';

      }
      ?>
              </tbody>

          </table>
          <!-- tabel -->



            </div>

    </div>
</div>

<!-- js -->
                  </div>

    </div>
    <!-- Datatables -->
    <script src="../js/datatables/js/jquery.dataTables.js"></script>
    <script src="../js/datatables/tools/js/dataTables.tableTools.js"></script>

     <script>
      $(function() {
          $('#list').DataTable( {
                    // "bJQueryUI":true,
                  "bPaginate":true,
                  "sPaginationType": "full_numbers",
                  "iDisplayLength":10
          } );

      } );
    </script>
    <!-- end datatable -->
    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="../js/bootstrap.min.js"></script>
        <!-- bootstrap progress js -->
    <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="../js/icheck/icheck.min.js"></script>
    <script src="../js/custom.js"></script>

    <!-- pace -->
    <script src="../js/pace/pace.min.js"></script>

</body>

</html>
