<div class="">
<div class="page-title">
            <div class="title_left">
              <h3><small></small></h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

              </div>
            </div>
          </div>
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-folder-open"></i> Approval of Changes Linked Participants <small></small></h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
        <table class="table table-striped responsive-utilities jambo_table" border="1" id="orderlist">
          <thead>
            <tr>
              <th width="5%">No.</th>
              <th width="20%">Participant Name</th>
              <th width="20%">Buyer Name</th>
              <th width="20%">Address</th>
              <th width="20%">Phone</th>
              <th width="20%">E-mail</th>
              <th width="20%">Director</th>
              <th width="10%">Action</th>
            </tr>
          </thead>

          <tbody>
          <?php
          $no=1;
          $member = $office->data_ret_acc_list();
          foreach ($member as $members) {

            $id_part = $members->id;
            $tipe    = $members->type;
          ?>
            <tr>
              <td align="center"><?php echo $no ?></td>
              <td><a href="?<?php echo paramEncrypt('hal=marketing-member-input&id='.$id_part.'&up=1&tipe='.$tipe.'') ?>"><?php echo $members->name.' ['.$members->id.']'; ?></a></td>
              <td><?php
                $retailer = $office->retailer_list2($id_part);
                foreach ($retailer as $retailers) {
                  $nama_buyer = $office->nama_relation_buyer($id_part,$retailers->repeat_id);
                  ?>
                  <a href="#">
                  <?php
                  echo $nama_buyer->name;echo ' ['.$retailers->repeat_id.']';
                  ?>
                  </a>
                  <?php
                  echo "<br>";
                }
               ?></td>
               <td align="center"> <button type="button" name="button" class="btn btn-success btn-round"> <i class="fa fa-plus-circle"></i></button> </td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
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
