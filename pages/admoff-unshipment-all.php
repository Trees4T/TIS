<?php  

$actual_link0 = "$_SERVER[REQUEST_URI]";
$actual_link1 = explode("?", $actual_link0);
$actual_link  = $actual_link1[1];
?>
<div class="">
<div class="page-title">
            <div class="title_left">
              <h3>Shipment<small></small></h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                
              </div>
            </div>
          </div>
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-folder-open"></i> Unapproved Shipment <i>(All)</i> <small></small></h2>
           
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
        <?php 
        if ($_SESSION['success']==1) {
        ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-check-circle"></i> Success!</strong> WINS Number <b><?php echo $_SESSION['bl'] ?></b> has been updated.
          </div>
        <?php
        }
        if ($_SESSION['success']==3) {
        ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-check-circle"></i> Success!</strong> <b><?php echo $_SESSION['bl'] ?></b> has been unapproved.
          </div>
        <?php
        }
        if ($_SESSION['success']==5) {
        ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-check-circle"></i> Success!</strong> <b><?php echo $_SESSION['bl'] ?></b> has been approved.
          </div>
        <?php
        }
        if ($_SESSION['success']==2) {
        ?>
          <div class="alert alert-danger alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-ban"></i> Warning!</strong> WINS Number <b><?php echo $_SESSION['bl'] ?></b> failed to update.
          </div>
        <?php
        }

        unset($_SESSION['success']);
        unset($_SESSION['bl']);
        ?>
        <table class="table table-striped responsive-utilities jambo_table" border="1" id="unshipment">
                                <thead>
                                    <tr>
                                        <th rowspan="2"><center>Shipment Date<center></th>
                                        <th rowspan="2"><center>No. BL</center></th>
                                        <th rowspan="2"><center>Dest. City</center></th>
                                        <th colspan="5"><center>Container Size</center></th>
                                        <th rowspan="2"><center>WINS Number</center></th>
                                        <th rowspan="2"><center>Approved</center></th>
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
                        $bulan = date("m");
                        
                        $shipment=$conn->query("select * from t4t_shipment where acc=0");
                        while ($load_shipment=$shipment->fetch()) {
                              $kode=$load_shipment['id_comp']; 
                         
                        ?>
                                    <tr>
                                        <td align="center"><?php echo $load_shipment['wkt_shipment'] ?></td>
                                      
                                        <td align="center"><a href="#" data-toggle="modal" data-target="#myModal<?php echo $load_shipment['no'] ?>"> <?php echo $load_shipment['bl'] ?></a></td>
                                      
                                        <td align="center"><?php echo $load_shipment['kota_tujuan'] ?></td>
                                        <td align="center">
                                            <?php 
                                            $no_shipment=$load_shipment['no_shipment']; //definisi no shipment
                                            $a=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='1'")->fetch();
                                            echo $a[0];
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php 
                                            $b=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='2'")->fetch();
                                            echo $b[0];
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php 
                                            $b=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='3'")->fetch();
                                            echo $b[0];
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php 
                                            $c=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='4'")->fetch();
                                            echo $c[0];
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php 
                                            $d=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='5'")->fetch();
                                            echo $d[0];
                                            ?>
                                        </td>
                                        <td align="center"><a href="#" data-toggle="modal" data-target="#win<?php echo $load_shipment['no'] ?>"><i class="fa fa-search-plus"></i>View and Edit</a> </td>
                                        <td align="center">
                                            <?php 
                                            $approve=$conn->query("select acc from t4t_shipment where no_shipment='$no_shipment'")->fetch();
                                            if ($approve[0]=="1") {
                                                ?>
                                                <a href="#" data-toggle="modal" data-target="#acc1<?php echo $load_shipment['no'] ?>"><i class="fa fa-check-square-o"></i></a>
                                                <?php 
                                            }else{
                                                ?>
                                                <a href="#"  data-toggle="modal" data-target="#acc0<?php echo $load_shipment['no'] ?>"><i class="fa fa-square-o"></i></a>
                                                <?php
                                            }
                                            
                                            ?>
                                        </td>
                                    </tr>

  <!-- Modal -->
  <?php  
  include 'modal/admoff-bl-detail.php';
  include 'modal/admoff-win-edit.php';
  include 'modal/admoff-acc-to-unacc.php';
  include 'modal/admoff-unacc-to-acc.php';
  ?>
  <!-- end modal -->



  

  
                        <?php 
                        }
                        ?>
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
              $('#unshipment').DataTable( {
                        // "bJQueryUI":true,
                      "bPaginate":true,
                      "sPaginationType": "full_numbers",
                      "iDisplayLength":10
              } );

          } );
        </script>
        <!-- end datatable -->
            <!-- PNotify -->
    <script type="text/javascript" src="../js/notify/pnotify.core.js"></script>
    <script type="text/javascript" src="../js/notify/pnotify.buttons.js"></script>
    <script type="text/javascript" src="../js/notify/pnotify.nonblock.js"></script>
    <?php  
      if ($_SESSION['mail']=='1') {
    ?>
    <script type="text/javascript">
        var permanotice, tooltip, _alert;
        $(function () {
            new PNotify({
                title: "Message Success",
                type: "success",
                text: " Message has been sent to <?php echo $_SESSION['company_name'] ?>",
                //addclass: "stack-bottomright",
                hide: false,
                closer: true,
                sticker: true,
                nonblock: {
                    nonblock: false
                },
                before_close: function (PNotify) {
                    // You can access the notice's options with this. It is read only.
                    //PNotify.options.text;

                    // You can change the notice's options after the timer like this:
                    PNotify.update({
                        title: PNotify.options.title + " - Enjoy your Stay",
                        before_close: null
                    });
                    PNotify.queueRemove();
                    return false;
                }
            });

        });
    </script>
    <?php 
      
      }
      if ($_SESSION['mail']=='0') {

    ?>
    <script type="text/javascript">
        var permanotice, tooltip, _alert;
        $(function () {
            new PNotify({
                title: "Message Failed",
                type: "error",
                text: " Message could not be sent to <?php echo $_SESSION['company_name'] ?>",
                //addclass: "stack-bottomright",
                hide: false,
                closer: true,
                sticker: true,
                nonblock: {
                    nonblock: false
                },
                before_close: function (PNotify) {
                    // You can access the notice's options with this. It is read only.
                    //PNotify.options.text;

                    // You can change the notice's options after the timer like this:
                    PNotify.update({
                        title: PNotify.options.title + " - Enjoy your Stay",
                        before_close: null
                    });
                    PNotify.queueRemove();
                    return false;
                }
            });

        });
    </script>
    <?php 
      }

      unset($_SESSION['mail']);
      unset($_SESSION['company_name']);
    ?>
       
</body>

</html>