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
            <h2><i class="fa fa-folder-open"></i> List of Participants <small></small></h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
        <table class="table table-striped responsive-utilities jambo_table" border="1" id="orderlist">
          <thead>
            <tr>
              <th width="5%">No.</th>
              <th>Participant Name</th>
              <th>Type</th>
              <th>Address</th>
              <th>Phone</th>
              <th>E-mail</th>
              <!-- <th>Joined Date</th> -->
            </tr>
          </thead>

          <tbody>
          <?php
          $no=1;
          $member=$conn->query("select no, nama, id, tipe, alamat, email, tlp, wkt_isi from t4t_partisipan order by no desc");
          while ($data_member=$member->fetch()) {
            $id_part = $data_member[2];
            $tipe    = $data_member[3];
          ?>
            <tr>
              <td align="center"><?php echo $no ?></td>
              <td><a href="?<?php echo paramEncrypt('hal=marketing-member-input&id='.$id_part.'&up=1&tipe='.$tipe.'') ?>"><?php echo $data_member[1].' ['.$data_member['id'].']'; ?></a></td>
              <td><?php echo $data_member['tipe'] ?></td>
              <td><?php echo $data_member['alamat'] ?></td>
              <td><?php echo $data_member['tlp'] ?></td>
              <td><?php echo $data_member['email'] ?></td>
              <!-- <td><?php $tgl=$data_member['wkt_isi'];  ?></td>               -->
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
