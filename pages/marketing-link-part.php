<?php
$actual_link0 = "$_SERVER[REQUEST_URI]";
$actual_link1 = explode("?", $actual_link0);
$actual_link  = $actual_link1[1];
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
            <h2><i class="fa fa-folder-open"></i> Linking Participants <small></small></h2>

            <div class="clearfix"></div>


        </div>
        <div class="x_content">

        <?php
        switch ($_SESSION['success']) {
          case 'link_add':
            $perintah    = 'added';
            $participant = $_SESSION['part'];
            $buyer       = $_SESSION['buyer'];
            break;

          default:
            # code...
            break;
        }
        ?>

        <?php if ($_SESSION['success']!=''): ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-check-circle"></i> Success!</strong> "<?php echo $buyer ?>" successfully <?php echo $perintah ?> to "<?php echo $participant ?>".
          </div>
        <?php endif; ?>


        <?php
        unset($_SESSION['part']);
        unset($_SESSION['success']);
        unset($_SESSION['buyer']);
        ?>

        <table class="table table-striped responsive-utilities jambo_table" border="1" id="orderlist">
          <thead>
            <tr>
              <th width="5%">No.</th>
              <th width="50%">Participant Name</th>
              <th width="40%">Buyers</th>
              <th width="10%">Action</th>
            </tr>
          </thead>

          <tbody>
          <?php
          $no=1;
          $member = $office->data_member_list();
          foreach ($member as $members) {

            $id_part = $members->id;
            $tipe    = $members->type;
          ?>
            <tr>
              <td align="center"><?php echo $no ?></td>
              <td><a href="#" class="edit-record" data-id="<?php echo $members->id ?>"><?php echo $members->name.' ['.$members->id.']'; ?></a></td>
              <td><?php
                $retailer = $office->retailer_list2($id_part);
                foreach ($retailer as $retailers) {
                  $nama_buyer = $office->nama_relation_buyer($id_part,$retailers->repeat_id);
                  ?>
                  <a href="#" class="edit-record-ret" data-id="<?php echo $nama_buyer->related_part.'-'.$actual_link ?>">
                  <?php
                  echo $nama_buyer->name;echo ' ['.$retailers->repeat_id.']';
                  ?>
                  </a>
                  <?php
                  echo "<br>";
                }
               ?></td>
               <td align="center"> <a href="#" class="add-record" data-id="<?php echo $id_part.'-'.$actual_link ?>" type="button" name="button" class="btn btn-success btn-round"> <i class="fa fa-plus-circle"></i></a> </td>
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
         $editable = 'no';
         $id_modal = 'myModal';
         include 'modal/ajax-modal.php';

         $title = 'Add New Buyer';
         $id_modal = 'myModal2';
         include 'modal/ajax-modal.php';

         $title = 'Buyer Detail';
         $id_modal = 'myModal3';
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
        <!-- select -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
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

        <script>
        $(function(){
            $(document).on('click','.add-record',function(e){
                e.preventDefault();
                $("#myModal2").modal('show');
                $.post('../pages/modal/marketing/marketing-link-add.php',
                    {id:$(this).attr('data-id')},
                    function(html){
                        $(".modal-body").html(html);
                    }
                );
            });
        });
        </script>

        <script>
        $(function(){
            $(document).on('click','.edit-record-ret',function(e){
                e.preventDefault();
                $("#myModal3").modal('show');
                $.post('../pages/modal/marketing/marketing-link-detail.php',
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
