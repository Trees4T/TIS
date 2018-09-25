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

      <!-- notifications     -->
      <?php
      if ($_SESSION['success']==1) {
        $alert = "alert-success";
        $icon  = "check-circle";
        $status= "Success";
        $pesan = "'".$_SESSION['message']."' has been accepted";
      }elseif ($_SESSION['success']==2) {
        $alert = "alert-success";
        $icon  = "check-circle";
        $status= "Success";
        $pesan = "'".$_SESSION['message']."' has been rejected";
      }

      if ($_SESSION['message']!='') {
      ?>
      <div class="alert <?php echo $alert ?> alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <strong><i class="fa fa-<?php echo $icon ?>"></i> <?php echo $status ?>!</strong> <?php echo $pesan ?>.
      </div>
      <?php
      }

      unset($_SESSION['success']);
      unset($_SESSION['message']);
      ?>
      <!-- notifications     -->
        <table class="table table-striped responsive-utilities jambo_table" border="1" id="orderlist">
          <thead>
            <tr>
              <th width="5%">No.</th>
              <th width="20%">Participant Name</th>
              <th width="20%">Buyer Name</th>
              <th width="20%">Buyer Code</th>
              <th width="20%">Buyer Address</th>
              <th width="20%">Buyer E-mail</th>
              <th width="20%">Register</th>
              <th width="20%">Status</th>
              <th width="10%">Action</th>
            </tr>
          </thead>

          <tbody>
          <?php
          $no=1;
          $member = $office->data_ret_acc_list();
          foreach ($member as $buyers) {

            $id_part = $buyers->id_part;
            $tipe    = $buyers->type;
          ?>
            <tr>
              <td align="center"><?php echo $no ?></td>
              <td><?php $partisipan = $office->data_member($id_part); echo $partisipan->name; ?></td>
              <td><?php echo $buyers->name ?></td>
              <td><?php echo $buyers->ret_code ?></td>
              <td><?php echo $buyers->address ?></td>
              <td><?php echo $buyers->email ?></td>
              <td><?php echo $buyers->date_register ?></td>
              <td><?php $status = $buyers->status;
                  if ($status==0) {
                    echo "<p class='label label-warning'>Pending</p>";
                  }elseif ($status==1) {
                    echo "<p class='label label-success'>Accepted</p>";
                  }elseif ($status==2) {
                    echo "<p class='label label-danger'>Rejected</p>";
                  }
               ?></td>
               <td>
                 <form class="" action="../action/mkt-approval-retailer.php" method="post">
                   <input type="hidden" name="id_request" value="<?php echo $buyers->no ?>">

                   <button type="submit" name="acc" class="label label-success"> acc</button>
                   <button type="submit" name="reject" class="label label-danger"> reject</button>
                 </form>
               </td>
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
