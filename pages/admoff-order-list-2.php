<?php
$kode=$id_member;
?>
<div class="">
<div class="page-title">
            <div class="title_left">
              <h3>Order<small></small></h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

              </div>
            </div>
          </div>
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-folder-open"></i> Order List <small></small></h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
        <table class="table table-striped responsive-utilities jambo_table" border="1" id="orderlist">
          <thead>
            <tr>
              <th width="5%">No.</th>
              <th>Years</th>
            </tr>
          </thead>

          <tbody>
          <?php
          $no=1;
          $member=$conn->query("SELECT substr(wkt_order,1,4) as th, id_comp from t4t_order where id_comp='$kode' group by th order by th desc");
          while ($data_meber=$member->fetch()) {
            $id_part=$data_meber[1];
            $pil_th =$data_meber[0];
          ?>
            <tr>
              <td align="center"><?php echo $no ?></td>
              <td><a href="?<?php echo paramEncrypt('hal=admoff-order-list-detail&id_member='.$id_part.'&pilih_tahun='.$pil_th.'') ?>"><?php echo $data_meber[0] ?></a></td>
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
