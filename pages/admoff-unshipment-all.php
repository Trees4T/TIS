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
                        
                        $shipment=mysql_query("select * from t4t_shipment where acc=0");
                        while ($load_shipment=mysql_fetch_array($shipment)) {
                              $kode=$load_shipment['id_comp']; 
                         
                        ?>
                                    <tr>
                                        <td align="center"><?php echo $load_shipment['wkt_shipment'] ?></td>
                                      
                                        <td align="center"><a href="#" data-toggle="modal" data-target="#myModal<?php echo $load_shipment['no'] ?>"> <?php echo $load_shipment['bl'] ?></a></td>
                                      
                                        <td align="center"><?php echo $load_shipment['kota_tujuan'] ?></td>
                                        <td align="center">
                                            <?php 
                                            $no_shipment=$load_shipment['no_shipment']; //definisi no shipment
                                            $a=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='1'"));
                                            echo $a[0];
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php 
                                            $b=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='2'")); 
                                            echo $b[0];
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php 
                                            $b=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='3'")); 
                                            echo $b[0];
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php 
                                            $c=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='4'")); 
                                            echo $c[0];
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php 
                                            $d=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='5'")); 
                                            echo $d[0];
                                            ?>
                                        </td>
                                        <td align="center"><a href="#" data-toggle="modal" data-target="#win<?php echo $load_shipment['no'] ?>"><i class="fa fa-search-plus"></i>View and Edit</a> </td>
                                        <td align="center">
                                            <?php 
                                            $approve=mysql_fetch_array(mysql_query("select acc from t4t_shipment where no_shipment='$no_shipment'"));
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
  include 'modal/bl-detail.php';
  ?>
  <!-- end modal -->


<!-- Modal WIN -->
  <div class="modal fade" id="win<?php echo $load_shipment['no'] ?>" role="dialog">
    <div class="modal-dialog ">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">
          <?php  
          if ($load_shipment['acc']==1) {
          ?>
            <div class="font-hijau">
               <i class="fa fa-check-circle-o "> </i> Approved
            </div>
          <?php
          }else{
          ?>
            <div class="font-kuning">
               <i class="fa fa-circle-o "> </i> Pending
            </div>
          <?php 
          } ?>
            

          </h4>
        </div>
        <div class="modal-body">

        <div class="form-group col-lg-12">
          <label class="control-label col-md-4">BL No.
          </label>
          <div class="col-md-8 font-hijau">
            <?php 
            echo $load_shipment['bl'];
             ?>
          </div>
        </div>
        <br>

        <div class="form-group col-lg-12">
          <label class="control-label col-md-4">Shipment No.
          </label>
          <div class="col-md-8 font-hijau">
            <?php 
            echo $load_shipment['no_shipment'];
             ?>
          </div>
        </div>
        <br>

        <div class="form-group col-lg-12">
          <label class="control-label col-md-4 ">Company Name
          </label>
          <div class="col-md-8 font-hijau">
            <?php 
           
            $comp_name=mysql_fetch_array(mysql_query("select nama from t4t_partisipan where id='$kode'"));
            echo $comp_name[0];
            ?>
            <input type="hidden" name="comp" value="<?php echo $comp_name[0]; ?>" >
          </div>
        </div>
        <br><br><br>


          
          
        </div>
        <div class="modal-footer">
        <form method="post" action="../action/admoff-shipment.php">
            <div class="form-group col-lg-12">
                <label class="control-label col-md-3 ">WINS Number
                </label>
            </div> 
            <div class="form-group col-lg-12">
                <div class="col-md-12 font-hijau">
                  <textarea class="form-control" rows="6" name="wins"><?php echo $load_shipment['wins_used'] ?></textarea>
                </div>
            </div>
            <input type="hidden" name="link" value="<?php echo $actual_link ?>">
            <input type="hidden" name="bl" value="<?php echo $load_shipment['bl'] ?>">

            <button type="submit" name="btn_save_win" class="btn btn-success">Save Changes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </form>
        <br>
          
        </div>
      </div>
      
    </div>
  </div>
  <!-- end modal win -->

  <!-- Modal acc1 -->
  <div class="modal fade" id="acc1<?php echo $load_shipment['no'] ?>" role="dialog">
    <div class="modal-dialog ">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">
          <?php  
          if ($load_shipment['acc']==1) {
          ?>
            <div class="font-hijau">
               <i class="fa fa-check-circle-o "> </i> Approved
            </div>
          <?php
          }else{
          ?>
            <div class="font-kuning">
               <i class="fa fa-circle-o "> </i> Pending
            </div>
          <?php 
          } ?>
            

          </h4>
        </div>
        <div class="modal-body">

        <div class="form-group col-lg-12">
          <label class="control-label col-md-4">BL No.
          </label>
          <div class="col-md-8 font-hijau">
            <?php 
            echo $load_shipment['bl'];
             ?>
          </div>
        </div>
        <br>
        
        <div class="form-group col-lg-12">
          <label class="control-label col-md-4">Shipment No.
          </label>
          <div class="col-md-8 font-hijau">
            <?php 
            echo $load_shipment['no_shipment'];
             ?>
          </div>
        </div>
        <br>

        <div class="form-group col-lg-12">
          <label class="control-label col-md-4 ">Company Name
          </label>
          <div class="col-md-8 font-hijau">
            <?php 
           
            $comp_name=mysql_fetch_array(mysql_query("select nama from t4t_partisipan where id='$kode'"));
            echo $comp_name[0];
            ?>
          </div>
        </div>
        <br><br>


          
          
        </div>
        <div class="modal-footer">
          <form method="post" action="../action/admoff-shipment.php">
            <div class="form-group col-lg-12 red" align="center">
            <font size="20"><i class="fa fa-exclamation-circle"></i><br></font>
                Change to <b>UNAPPROVED!</b>
            </div>

            <input type="hidden" name="link" value="<?php echo $actual_link ?>">
            <input type="hidden" name="bl" value="<?php echo $load_shipment['bl'] ?>">

            <button type="submit" name="btn_save_acc1" class="btn btn-success">Save Changes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </form>
        <br>
          
        </div>
      </div>
      
    </div>
  </div>
  <!-- end modal acc1 -->

  <!-- Modal acc0 -->
  <div class="modal fade" id="acc0<?php echo $load_shipment['no'] ?>" role="dialog">
    <div class="modal-dialog ">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">
          <?php  
          if ($load_shipment['acc']==1) {
          ?>
            <div class="font-hijau">
               <i class="fa fa-check-circle-o "> </i> Approved
            </div>
          <?php
          }else{
          ?>
            <div class="font-kuning">
               <i class="fa fa-circle-o "> </i> Pending
            </div>
          <?php 
          } ?>
            

          </h4>
        </div>
        <div class="modal-body">

        <div class="form-group col-lg-12">
          <label class="control-label col-md-4">BL No.
          </label>
          <div class="col-md-8 font-hijau">
            <?php 
            echo $load_shipment['bl'];
             ?>
          </div>
        </div>
        <br>

        <div class="form-group col-lg-12">
          <label class="control-label col-md-4">Shipment No.
          </label>
          <div class="col-md-8 font-hijau">
            <?php 
            echo $load_shipment['no_shipment'];
             ?>
          </div>
        </div>
        <br>

        <div class="form-group col-lg-12">
          <label class="control-label col-md-4 ">Company Name
          </label>
          <div class="col-md-8 font-hijau">
            <?php 
           
            $comp_name=mysql_fetch_array(mysql_query("select nama from t4t_partisipan where id='$kode'"));
            echo $comp_name[0];
            ?>
          </div>
        </div>
        <br><br>


          
          
        </div>
        <div class="modal-footer">
          <form method="post" action="../action/admoff-shipment.php">
            <div class="form-group col-lg-12 font-hijau" align="center">
            <font size="20"><i class="fa fa-check-circle"></i><br></font>
                Change to <b>APPROVED!</b>
            </div>
            <input type="hidden" name="link" value="<?php echo $actual_link ?>">
            <input type="hidden" name="bl" value="<?php echo $load_shipment['bl'] ?>">
            <input type="hidden" name="shipment" value="<?php echo $load_shipment['no_shipment'] ?>">
            <input type="hidden" name="comp" value="<?php echo $comp_name[0] ?>">
            <input type="hidden" name="wins_used" value="<?php echo $load_shipment['wins_used'] ?>">
            <input type="hidden" name="order" value="<?php echo $load_shipment['no_order'] ?>">
            <input type="hidden" name="item" value="<?php echo $load_shipment['item_qty'] ?>">
            <input type="hidden" name="id_member" value="<?php echo $load_shipment['id_comp'] ?>">

            <button type="submit" name="btn_save_acc0" class="btn btn-success">Save Changes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </form>
        <br>
          
        </div>
      </div>
      
    </div>
  </div>
  <!-- end modal acc0 -->
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