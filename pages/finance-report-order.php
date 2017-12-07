<div class="">
<div class="page-title">
            <div class="title_left">
              <h3>Order Report<small></small></h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

              </div>
            </div>
          </div>
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-folder-open"></i> Order Report List <small></small></h2>


            <div class="clearfix"></div>
        </div>

        <form method="post">
        <div class="col-md-4">
          <?php
          $th = date("Y");
          $waktu_order = $office->wkt_order();
          $th_awal     = $office->explode_wkt_order($waktu_order->wkt_order);
          $jarak_th    = $th-$th_awal;

          $select_year =$_REQUEST['select_year'];
          ?>
          <select class="form-control " onchange="this.form.submit()" name="select_year">
              <option><?php
                          if ($select_year=="") {
                              echo "This Year (".$th.")";
                          }else{
                              echo $select_year;
                          }
                      ?>
              </option>
              <option>------------------------------</option>
          <?php for ($i=0; $i <= $jarak_th ; $i++) {
              $tahun_select=$th-$i;
          ?>
              <option value="<?php echo $tahun_select ?>"><?php echo $tahun_select ?></option>
          <?php
          } ?>
          </select>
          <noscript><input type="submit" value='select_year'></noscript>
        </div>
        </form>

        <div class="x_content">
        <table class="table table-striped responsive-utilities jambo_table" border="1" id="orderlist">
          <thead>
            <tr>
              <th width="5%">No.</th>
              <th>Participant Name</th>
              <th>No Order</th>
              <th><center> Time </center></th>
              <th><center> Order Approved </center></th>
              <th><center> Shipment No. </center></th>
            </tr>
          </thead>

          <tbody>
          <?php
          $no=1;
          if (Empty($select_year)) {
            $th_search = $th;
          }else{
            $th_search = $select_year;
          }

          //$member=$conn->query("select no, nama, id from t4t_partisipan order by nama");
          $data = $office->no_order_shipment_yet_list($th_search);

          foreach ($data as $load) {
            $cek_no_order = $office->cek_no_order_shipment_yet($load->no_order);
            $nama_part =  $office->data_member($load->id_comp);
          //while ($data_meber=$member->fetch()) {
          //  $id_part=$data_meber[2];

          ?>
            <tr>
              <td align="center"><?php echo $no ?></td>
              <td align=""><?php echo $nama_part->name ?></td>
              <td align=""><?php echo $load->no_order ?></td>
              <td align="center"><?php echo $load->wkt_order ?></td>
              <td align="center">
                <?php

                if ($load->acc=="1") {
                    ?>
                    <i class="fa fa-check-square-o"></i>
                    <?php
                }else{
                    ?>
                    <i class="fa fa-square-o"></i>
                    <?php
                }
                ?>
              </td>
              <td align="center">
                <textarea readonly><?php if ($cek_no_order==true) {

                  $shipment = $conn->query("SELECT * from t4t_shipment where no_order like '$load->no_order%' or no_order like '%, $load->no_order%'");
                  foreach ($shipment as $load_ship) {
                    echo $load_ship['no_shipment'].", ";
                  }

                }else{
                  echo "-";
                } ?></textarea></td>
            </tr>
          <?php
          $no++;
          } ?>
          </tbody>

        </table>

        </div>
    </div>


<!-- js -->
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
              $('#orderlist').DataTable( {
                        // "bJQueryUI":true,
                      "bPaginate":true,
                      "sPaginationType": "full_numbers",
                      "iDisplayLength":10
              } );

          } );
        </script>
        <!-- end datatable -->

</body>

</html>
