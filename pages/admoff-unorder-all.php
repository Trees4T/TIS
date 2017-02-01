<?php  

$actual_link0 = "$_SERVER[REQUEST_URI]";
$actual_link1 = explode("?", $actual_link0);
$actual_link  = $actual_link1[1];
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
            <h2><i class="fa fa-folder-open"></i> Unapproved Order <i>(All)</i> <small></small></h2>
           
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
        <?php 
        if ($_SESSION['success']==1) {
        ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-check-circle"></i> Success!</strong> WINS Number <?php echo $_SESSION['order'] ?> has been updated.
          </div>
        <?php
        }
        if ($_SESSION['success']==3) {
        ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-check-circle"></i> Success!</strong> <?php echo $_SESSION['order'] ?> has been unapproved.
          </div>
        <?php
        }
        if ($_SESSION['success']==5) {
        ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-check-circle"></i> Success!</strong> <?php echo $_SESSION['order'] ?> has been approved.
          </div>
        <?php
        }
        if ($_SESSION['success']==2) {
        ?>
          <div class="alert alert-danger alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-ban"></i> Warning!</strong> WINS Number <?php echo $_SESSION['order'] ?> failed to update.
          </div>
        <?php
        }

        unset($_SESSION['success']);
        unset($_SESSION['order']);
        ?>
        <table class="table table-striped responsive-utilities jambo_table" border="1" id="unorder">
                                <thead>
                                    <tr>
                                        <th><center>Order Date<center></th>
                                        <th><center>No. Order</center></th>                         
                                        <th><center>Hang Tags Requested</center></th>
                                        <th><center>WINS Number</center></th>
                                        <th><center>Destination City</center></th>
                                        <th><center>Approved</center></th>
                                    </tr>
                                </thead>
                        
                                <tbody>
                        <?php 
                        $bulan = date("m");
                        
                        $order=mysql_query("select no, wkt_order, no_order, jml_wins, acc, tipe_prod, wins1, wins2, kota_tujuan,id_comp from t4t_order where acc=0 ");
                        while ($load_order=mysql_fetch_array($order)) {
                            $id_order=$load_order['no'];
                            $kode    =$load_order['id_comp'];
                            
                        ?>
                                    <tr>
                                        <td align="center"><?php echo $load_order['wkt_order'] ?></td>
                           
                                         <td align="center"><a href="#" data-toggle="modal" data-target="#myModal<?php echo $load_order['no'] ?>"><?php echo $load_order['no_order'] ?></a></td>                                    
                                        <td align="center">
                                            <?php 
                                            $no_order=$load_order['no_order']; //definisi no order
                                            $htag=mysql_fetch_array(mysql_query("select jml_wins from t4t_order where no_order='$no_order'"));
                                            echo $htag[0];
                                            ?>
                                        </td>
                                        <td align="center">
                                            <a href="#" data-toggle="modal" data-target="#win<?php echo $load_order['no'] ?>"><?php echo $load_order['wins1'].' to '.$load_order['wins2'] ?></a>
                                        </td>
                                        <td align="center">
                                            <?php 
                                            echo $load_order['kota_tujuan']
                                            ?>
                                        </td>
                                   
                                        <td align="center">
                                            <?php 
                                            $approve=mysql_fetch_array(mysql_query("select acc from t4t_order where no_order='$no_order'"));
                                            if ($approve[0]=="1") {
                                                ?>
                                                <a href="#" data-toggle="modal" data-target="#acc1<?php echo $load_order['no'] ?>"><i class="fa fa-check-square-o"></i></a>
                                                <?php 
                                            }else{
                                                ?>
                                                <a href="#" data-toggle="modal" data-target="#acc0<?php echo $load_order['no'] ?>"><i class="fa fa-square-o"></i></a>
                                                <?php
                                            }
                                            
                                            ?>
                                        </td>
                                    </tr>

 <!-- Modal -->
  <div class="modal fade" id="myModal<?php echo $load_order['no'] ?>" role="dialog">
    <div class="modal-dialog ">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">
          <?php  
          if ($load_order['acc']==1) {
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
            <label class="control-label col-md-4">Order No.
            </label>
            <div class="col-md-8 font-hijau">
              <?php 
              echo $load_order['no_order'];
               ?>
               <input type="hidden" name="no_order" value="<?php echo $load_order['no_order']; ?>" >
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
          <br>
          <br>

          <!-- table container -->
          <div class="form-group col-lg-12">
          <label class="col-md-10"><center>Container</center></label>
          <label class="col-md-2"> Stuffing </label>
          <label class="col-md-2">20'</label>
          <label class="col-md-2">40'</label>
          <label class="col-md-2">40' HC</label>
          <label class="col-md-2">45'</label>
          <label class="col-md-2">60'</label>
          <label class="col-md-2">Date</label>

            <?php 
          $no_order=$load_order['no_order'];
          $jml_cont=mysql_fetch_array(mysql_query("select count(no) from t4t_ordercontainer where no_order='$no_order'"));
          $i=1;
          $container=mysql_query("select * from t4t_ordercontainer where no_order='$no_order' group by tgl_stuf");
          while ($load_cont=mysql_fetch_array($container)) {
            $ii=$i-1;

            $tgl_stuf=$load_cont['tgl_stuf'];
            $ex_tgl=explode("-", $tgl_stuf);
            $tanggal_stf=$ex_tgl[2]."-".$ex_tgl[1]."-".$ex_tgl[0];  

            $container1=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_cont=1 and no_order='$no_order' limit $ii,1")); 
            $container2=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_cont=2 and no_order='$no_order' limit $ii,1")); 
            $container3=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_cont=3 and no_order='$no_order' limit $ii,1")); 
            $container4=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_cont=4 and no_order='$no_order' limit $ii,1")); 
            $container5=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_cont=5 and no_order='$no_order' limit $ii,1"));                        
           ?>

          <label class="col-md-2 font-hijau"><?php echo $container1[0] ?></label>
          <label class="col-md-2 font-hijau"><?php echo $container2[0] ?></label>
          <label class="col-md-2 font-hijau"><?php echo $container3[0] ?></label>
          <label class="col-md-2 font-hijau"><?php echo $container4[0] ?></label>
          <label class="col-md-2 font-hijau"><?php echo $container5[0] ?></label>
          <label class="col-md-2 font-hijau"><?php echo $tanggal_stf ?></label>
       
                 
                          <?php 
                          $i++;
                         }
                           ?>


          </div>
          <br><br><br><br><br><br>
        
           <div class="form-group col-lg-12">
              <label class="control-label col-md-4" for="first-name">Type of Product <span class="required"></span>
              </label>
              <div class="col-md-8 font-hijau">
                <?php echo $load_order['tipe_prod'] ?>
                
              </div>
            </div>
            <br><br><br>

            <div class="form-group col-lg-12">
              <label class="control-label col-md-4" for="first-name">Wood Species <span class="required"></span>
              </label>
              <div class="col-md-8">
                <ul class="to_do">
                <?php 
                $wood=mysql_query("select * from t4t_pohonen");

                while ($data_pohon=mysql_fetch_array($wood)) {
                  $id_pohon=$data_pohon[0];
                  $pohon=mysql_fetch_array(mysql_query("select a.id_pohon,b.no from t4t_pohonen a, t4t_orderphn b where a.id_pohon=b.no_phnen2 and no_order='$no_order' and a.id_pohon=$id_pohon"));
                 ?>
                  <?php 
                    if ($pohon[0]!="") {
                     ?>
                    <li>
                   
                     <p class="font-hijau"><input type="checkbox" class="flat" name="item[]" value="<?php echo $data_pohon[0] ?>" checked disabled="disabled"> <?php echo $data_pohon[1] ?> </p> 
                    
                    </li>
                     <?php
                    }else{
                     ?>
                       <!--  <p><input type="checkbox" class="flat" name="item[]" value="<?php echo $data_pohon[0] ?>" disabled="disabled"> <?php echo $data_pohon[1] ?> </p>  -->
                      <?php } ?>

                <?php

                }
                 ?>    
                </ul>
              </div>
            </div>
            <br><br>

            <div class="form-group col-lg-12">
              <label class="control-label col-md-4" for="first-name"> Quantity Hang Tags Requested <span class="required"></span>
              </label>
              <div class="col-md-8 font-hijau">
              <?php $jml_tag=mysql_fetch_array(mysql_query("select jml_wins from t4t_order where no_order='$no_order'"));
               echo $jml_tag[0] ?>
              </div>
            </div>
            <br><br><br>

            <!-- other request -->
            <div class="form-group col-lg-12">
              <label class="control-label col-md-4" for="first-name">Other Request <span class="required"></span>
              </label>
              <div class="col-md-8">
                <ul class="to_do">
                <?php 
                $other=mysql_query("select * from t4t_req");
                while ($data_other=mysql_fetch_array($other)) {
                  
                  $no_req=$data_other[0];
                  $request=mysql_fetch_array(mysql_query("select a.jml,b.no from t4t_orderrequest a, t4t_req b where a.no_req=b.no and a.no_order='$no_order' and a.no_req=$no_req "));

                 ?>
                    <li>
                   
                     <?php echo $request[0]; echo " - ".$data_other[1]; ?>
                    
                    </li>
                  <?php } ?>
                </ul>
              </div>
            </div>

            <?php 
               $pic_name=mysql_fetch_array(mysql_query("select pic from t4t_partisipan where id='$kode'"));
               if ($pic_name[0]=="") {
                 
               }else{
               
            ?>
            <div class="form-group col-lg-12">
              <label class="control-label col-md-4" for="first-name">PIC <span class="required"></span>
              </label>
              <div class="col-md-8 font-hijau">
                <?php echo $pic_name[0]; ?>                
              </div>
            </div>
            <?php } ?>


<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- end modal -->

  <!-- Modal WIN -->
  <div class="modal fade" id="win<?php echo $load_order['no'] ?>" role="dialog">
    <div class="modal-dialog ">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">
          <?php  
          if ($load_order['acc']==1) {
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
          <label class="control-label col-md-4">Order No.
          </label>
          <div class="col-md-8 font-hijau">
            <?php 
            echo $load_order['no_order'];
             ?>
             <input type="hidden" name="no_order" value="<?php echo $load_order['no_order']; ?>" >
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
        <br><br>


          
          
        </div>
        <div class="modal-footer">
        <form method="post" action="../action/admoff-order.php">
            <div class="form-group col-lg-12">
                <label class="control-label col-md-3 ">WINS Number
                </label>
                <div class="col-md-3 font-hijau">
                  <input type="number" class="form-control" name="wins1" value="<?php echo $load_order['wins1'] ?>"> 
                </div>
                <label class="control-label col-md-1">to &nbsp;</label>
                <div class="col-md-3 font-hijau">
                  <input type="number" class="form-control" name="wins2" value="<?php echo $load_order['wins2'] ?>">
                </div>
            </div>
            <input type="hidden" name="link" value="<?php echo $actual_link ?>">
            <input type="hidden" name="order" value="<?php echo $load_order['no_order'] ?>">

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
  <div class="modal fade" id="acc1<?php echo $load_order['no'] ?>" role="dialog">
    <div class="modal-dialog ">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">
          <?php  
          if ($load_order['acc']==1) {
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
          <label class="control-label col-md-4">Order No.
          </label>
          <div class="col-md-8 font-hijau">
            <?php 
            echo $load_order['no_order'];
             ?>
             <input type="hidden" name="no_order" value="<?php echo $load_order['no_order']; ?>" >
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
        <br><br>


          
          
        </div>
        <div class="modal-footer">
          <form method="post" action="../action/admoff-order.php">
            <div class="form-group col-lg-12 red" align="center">
            <font size="20"><i class="fa fa-exclamation-circle"></i><br></font>
                Change to <b>UNAPPROVED!</b>
            </div>

            <input type="hidden" name="link" value="<?php echo $actual_link ?>">
            <input type="hidden" name="order" value="<?php echo $load_order['no_order'] ?>">

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
  <div class="modal fade" id="acc0<?php echo $load_order['no'] ?>" role="dialog">
    <div class="modal-dialog ">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">
          <?php  
          if ($load_order['acc']==1) {
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
          <label class="control-label col-md-4">Order No.
          </label>
          <div class="col-md-8 font-hijau">
            <?php 
            echo $load_order['no_order'];
             ?>
             <input type="hidden" name="no_order" value="<?php echo $load_order['no_order']; ?>" >
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
          <form method="post" action="../action/admoff-order.php">
            <div class="form-group col-lg-12 font-hijau" align="center">
            <font size="20"><i class="fa fa-check-circle"></i><br></font>
                Change to <b>APPROVED!</b>
            </div>
            <input type="hidden" name="link" value="<?php echo $actual_link ?>">
            <input type="hidden" name="order" value="<?php echo $load_order['no_order'] ?>">
            <input type="hidden" name="comp" value="<?php echo $comp_name[0]; ?>" >
            <input type="hidden" name="type" value="<?php echo $load_order['tipe_prod']; ?>" >
            <input type="hidden" name="tags" value="<?php echo $load_order['jml_wins']; ?>" >

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
              $('#unorder').DataTable( {
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