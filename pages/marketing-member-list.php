<?php

$label= 'label label-success';

  if ($sts=='') {
    $label1 = $label;
    $title_page = 'All Participant';
    $descript = 'all participants including active and inactive participants';
  }elseif ($sts=='active') {
    $label2 = $label;
    $title_page = 'Active Participant';
    $descript = 'has an user authentication and is <b>active</b> status';
  }elseif ($sts=='not active with oten') {
    $label3 = $label;
    $title_page = 'Inactive Participant With Auth';
    $descript = 'has an user authentication and is <b>inactive</b> status';
  }elseif ($sts=='not active without oten') {
    $label4 = $label;
    $title_page = 'Inactive Participant Without Auth';
    $descript = 'does not have user authentication';
  }
?>
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
            <a href="?<?php echo paramEncrypt('hal=marketing-member-list') ?>"
              class="<?php echo $label1 ?>">All</a>
            /
            <a href="?<?php echo paramEncrypt('hal=marketing-member-list&sts=active') ?>"
               class="<?php echo $label2 ?>">Active with auth user</a>
            /
            <a href="?<?php echo paramEncrypt('hal=marketing-member-list&sts=not active with oten') ?>"
               class="<?php echo $label3 ?>">Inactive with auth user</a>
            /
            <a href="?<?php echo paramEncrypt('hal=marketing-member-list&sts=not active without oten') ?>"
               class="<?php echo $label4 ?>">Inactive without auth user</a>
        </div>
        <div class="x_content">
            <h3 class="green"><?php echo $title_page ?> </h3><span><?php echo $descript ?></span>
            <hr>
          <?php
          if ($_SESSION['success']==true) {

            if ($_SESSION['succes']==1) {
              $notif = "New member";
            }elseif ($_SESSION['success']==2) {
              $notif = "Changes";
            }
            ?>
        <div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong><i class="fa fa-check-circle"></i> Success!</strong> <?php echo $notif ?> successfully saved.
        </div>
          <?php
          }

          unset($_SESSION['success']);
           ?>
        <table class="table table-striped responsive-utilities jambo_table" border="1" id="orderlist">
          <thead>
            <tr>
              <th width="5%">ID</th>
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

          if (isset($sts)) {
            $member = $office->data_member_list_activestatus($sts);
          }else{
            $member = $office->data_member_list();
          }

          foreach ($member as $members) {
            $id_part = $members->id;
            $tipe    = $members->type;
          ?>
            <tr>
              <td align="center"><?php echo $members->id ?></td>
              <td><a href="#" class="edit-record" data-id="<?php echo $members->id ?>"><?php echo $members->name; ?></a></td>
              <td><?php echo $members->type ?></td>
              <td><?php echo $members->address ?></td>
              <td><?php echo $members->phone ?></td>
              <td><?php echo $members->email ?></td>
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

         <!-- Modal -->
         <?php
         $title = 'Participants Detail';
         $editable = 'yes';
         $id_modal = 'myModal';
         include 'modal/ajax-modal.php';
         ?>

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

        <!-- modal -->
        <script>
        $(function(){
            $(document).on('click','.edit-record',function(e){
                e.preventDefault();
                $("#myModal").modal('show');
                $.post('../pages/modal/marketing-part-detail.php?edit=<?php echo $editable ?>',
                    {id:$(this).attr('data-id')},
                    function(html){
                        $(".modal-body").html(html);
                    }
                );
            });
        });
        </script>


</body>

</html>
