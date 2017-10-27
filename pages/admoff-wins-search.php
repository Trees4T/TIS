<?php
// echo $_SESSION['jml'];
?>
<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>Report <small></small></h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2> WINS Information </h2>

                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />


                    <font size="">


                    <div class="col-sm-12">

                                <div class="x_content">
                                    <div class="well">
                                      <?php
                                      $choose = $_POST['choose'];
                                      ?>
                                      <form action="" method="post">

                                      <div class="col-md-4">
                                        <div class="form-group">
                                        <select class="form-control col-md-1 col-md-offset-12" name="choose" onchange="this.form.submit()">
                                          <?php
                                          if (isset($choose)) {
                                            if ($choose=="wins") {
                                              $value="Search by : Wins No.";
                                            }else{
                                              $value="Search by : Shipment No.";
                                            }
                                          ?>
                                          <option value="<?php echo $choose ?>"><?php echo $value ?></option>
                                          <?php
                                        }else{
                                        ?>
                                        <option value="">- Search by -</option>
                                        <?php
                                        }
                                          ?>

                                          <option value="wins">Wins No.</option>
                                          <option value="ship">Shipment No.</option>
                                          <!-- <noscript><input type="submit" value="choose"></noscript> -->
                                        </select>
                                        </div>
                                      </div>

                                      </form>

                                      <?php

                                      if (isset($choose)) {

                                        if ($choose=="wins") {

                                      ?>

                                      <br>
                                        <form class="form-horizontal" method="post" action="../action/search-info-wins.php">
                                          <div class="form-group">
                                            <label class="control-label col-md-5" for="first-name">WINS NO. <span class="required red">*</span>
                                            </label>
                                            <div class="col-md-2">
                                              <input type="number" class="form-control" name="win" min="1" required value="<?php echo $_SESSION['win']?>">
                                            </div>
                                          </div>

                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                              <div class="col-md-5 col-md-offset-5">
                                                <a href="?<?php echo paramEncrypt('hal=admoff-wins-search')?>" class="btn btn-primary">Reset</a>
                                                <button type="submit" class="btn btn-success">Submit</button>
                                              </div>
                                            </div>
                                        </form>
                                        <?php

                                          }elseif($choose=="ship"){
                                        ?>
                                        <br>
                                          <form class="form-horizontal" method="post" action="../action/search-no-order.php">
                                            <div class="form-group">
                                              <label class="control-label col-md-5" for="first-name">SHIPMENT NO. <span class="required red">*</span>
                                              </label>
                                              <div class="col-md-3">
                                                <input type="text" class="form-control" name="no_ship" required value="<?php echo $_SESSION['no_ship']?>">
                                              </div>
                                            </div>

                                              <div class="ln_solid"></div>
                                              <div class="form-group">
                                                <div class="col-md-5 col-md-offset-5">
                                                  <a href="?<?php echo paramEncrypt('hal=admoff-wins-search')?>" class="btn btn-primary">Reset</a>
                                                  <button type="submit" class="btn btn-success">Submit</button>
                                                </div>
                                              </div>
                                          </form>
                                        <?php
                                          }
                                        }
                                        ?>
                                    </div>
<?php
$nomor_win=$_SESSION['win'];
if (isset($_SESSION['win'])) {

unset($_SESSION['win']);
  //ORDER
  $order = $conn->query("SELECT * from t4t_order where wins1 <= '$nomor_win' and wins2 >= '$nomor_win' or wins1='$nomor_win' and wins2='$nomor_win'");

?>
                          <!-- order -->
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2>ORDER <small>INFORMATION</small></h2>
                                                <ul class="nav navbar-right panel_toolbox">
                                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                    </li>
                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">

                                                <div class="bs-example" data-example-id="simple-jumbotron">
                                                    <div class="jumbotron form-group">
                                                    <?php
                                                    if ($kosong=$order->fetch()==false) {
                                                      echo "No result found.";
                                                    }else{
                                                $order_2 = $conn->query("SELECT * from t4t_order where wins1 <= '$nomor_win' and wins2 >= '$nomor_win' or wins1='$nomor_win' and wins2='$nomor_win'");
                                                    while ($load_order=$order_2->fetch()) {
                                                      $id_part = $load_order['id_comp'];
                                                      $nm_part = $conn->query("SELECT name from t4t_participant where id='$id_part'")->fetch();
                                                     ?>
                                                        <label>Order No.</label>
                                                        <h3 class="green"><?php echo $load_order['no_order'] ?></h3>

                                                        <table>
                                                          <tr>
                                                            <td><b>Participant Name</td>
                                                            <td>:</td>
                                                            <td><?php echo $nm_part[0] ?></td>
                                                          </tr>
                                                          <tr>
                                                            <td><b>Order Date</td>
                                                            <td>:</td>
                                                            <td><?php echo $load_order['wkt_order'] ?></td>
                                                          </tr>
                                                          <tr>
                                                            <td><b>First WINS</td>
                                                            <td>:</td>
                                                            <td><?php echo $load_order['wins1'] ?></td>
                                                          </tr>
                                                          <tr>
                                                            <td><b>Last WINS</td>
                                                            <td>:</td>
                                                            <td><?php echo $load_order['wins2'] ?></td>
                                                          </tr>
                                                          <tr>
                                                            <td><b>Product Type</td>
                                                            <td>:</td>
                                                            <td><?php echo $load_order['tipe_prod'] ?></td>
                                                          </tr>
                                                          <tr>
                                                            <td><b>QTY WINS</td>
                                                            <td>:</td>
                                                            <td><?php echo $load_order['jml_wins'] ?></td>
                                                          </tr>
                                                          <tr>
                                                            <td><b>Destination</td>
                                                            <td>:</td>
                                                            <td><?php echo $load_order['kota_tujuan'] ?></td>
                                                          </tr>
                                                        </table>
                                                        <hr>

                                                        <?php }
                                                      }
                                                          ?>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                          <!-- end order -->

<?php
  // $jml_order = $conn->query("SELECT count(*) from t4t_order where wins1 < '$nomor_win' and wins2 > '$nomor_win'")->fetch();
  // echo $jml_order[0];
  $bl_ketemu    = $_SESSION['ketemu'];
  $shipment     = $conn->query("SELECT * from t4t_shipment where bl='$bl_ketemu'")->fetch();
    $id_comp = $shipment['id_comp'];
  $nm_part_ship = $conn->query("SELECT name from t4t_participant where id='$id_comp'")->fetch();
?>
                          <!-- shipment -->
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2>SHIPMENT <small>INFORMATION</small></h2>
                                                <ul class="nav navbar-right panel_toolbox">
                                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                    </li>
                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">

                                                <div class="bs-example" data-example-id="simple-jumbotron">
                                                    <div class="jumbotron">
                                                      <?php
                                                      if ($bl_ketemu=="") {
                                                        echo "No result found.";
                                                      }else{
                                                      ?>
                                                      <label>Shipment No.</label>
                                                      <h3 class="green"><?php echo $shipment['no_shipment'] ?></h3>

                                                      <table>
                                                        <tr>
                                                          <td><b>Participant Name</td>
                                                          <td>:</td>
                                                          <td><?php echo $nm_part_ship[0] ?></td>
                                                        </tr>
                                                        <tr>
                                                          <td><b>Order No.</td>
                                                          <td>:</td>
                                                          <td><?php
                                                                if ($shipment['no_order']=="") {
                                                                ?>
                                                                <i class="fa fa-minus-square-o red"></i>
                                                                <?php
                                                                }else{
                                                                  echo $shipment['no_order'];
                                                                }
                                                                ?></td>
                                                        </tr>
                                                        <tr>
                                                          <td><b>BL No.</td>
                                                          <td>:</td>
                                                          <td><?php echo $shipment['bl'] ?></td>
                                                        </tr>
                                                        <tr>
                                                          <td><b>Shipment Report Date</td>
                                                          <td>:</td>
                                                          <td><?php echo $shipment['wkt_shipment'] ?></td>
                                                        </tr>
                                                        <tr>
                                                          <td><b>WINS</td>
                                                          <td>:</td>
                                                          <td><textarea rows="10" readonly=""><?php echo $shipment['wins_used'] ?></textarea></td>
                                                        </tr>
                                                        <tr>
                                                          <td><b>Destination</td>
                                                          <td>:</td>
                                                          <td><?php echo $shipment['kota_tujuan'] ?></td>
                                                        </tr>
                                                        <tr>
                                                          <td><b>Paid</td>
                                                          <td>:</td>
                                                          <td><?php
                                                          if ($shipment['acc_paid']==1):
                                                            ?>
                                                          <i class="fa fa-check-square-o green"></i>
                                                          <?php
                                                          else:
                                                          ?>
                                                              <div class="font-15 red big">&empty;</div>
                                                          <?php
                                                          endif;
                                                          ?></td>
                                                        </tr>
                                                        <br>
                                                        <tr>
                                                        <form action="../action/search-no-order.php" method="post">
                                                          <input type="hidden" name="no_ship" value="<?php echo $shipment['no_shipment']?>">
                                                          <td><button type="submit" name="search_order" class="btn btn-info">Search Order No</button></td>
                                                        </form>
                                                        </tr>
                                                      </table>
                                                      <?php } ?>
                                                      </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                      <!-- end shipment -->

<?php } ?>

<?php
###### TAHAP 2
$jml_loop_order_search = $_SESSION['jml'];
if (isset($jml_loop_order_search)) {
  unset($_SESSION['jml']);
  $no_ship = $_SESSION['shipment'];
  $shipment     = $conn->query("SELECT * from t4t_shipment where no_shipment='$no_ship'")->fetch(PDO::FETCH_OBJ);
    $id_comp = $shipment->id_comp;
  $nm_part_ship = $conn->query("SELECT name from t4t_participant where id='$id_comp'")->fetch();
?>
<!-- shipment -->
          <div class="col-md-12 ">
              <div class="x_panel">
                  <div class="x_title">
                      <h2>SHIPMENT <small>INFORMATION</small></h2>
                      <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                      </ul>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                      <div class="bs-example" data-example-id="simple-jumbotron">
                          <div class="jumbotron">

                            <label>Shipment No.</label>
                            <h3 class="green"><?php echo $shipment->no_shipment ?></h3>

                            <table>
                              <tr>
                                <td><b>Participant Name</td>
                                <td>:</td>
                                <td><?php echo $nm_part_ship[0] ?></td>
                              </tr>
                              <tr>
                                <td><b>Order No.</td>
                                <td>:</td>
                                <td><?php
                                      if ($shipment->no_order=="") {
                                      ?>
                                      <i class="fa fa-minus-square-o red"></i>
                                      <?php
                                      }else{
                                        echo $shipment->no_order;
                                      }
                                      ?></td>
                              </tr>
                              <tr>
                                <td><b>BL No.</td>
                                <td>:</td>
                                <td><?php echo $shipment->bl ?></td>
                              </tr>
                              <tr>
                                <td><b>Shipment Report Date</td>
                                <td>:</td>
                                <td><?php echo $shipment->wkt_shipment ?></td>
                              </tr>
                              <tr>
                                <td><b>WINS</td>
                                <td>:</td>
                                <td><textarea rows="2" readonly=""><?php echo $shipment->wins_used ?></textarea></td>
                              </tr>
                              <tr>
                                <td><b>Destination</td>
                                <td>:</td>
                                <td><?php echo $shipment->kota_tujuan ?></td>
                              </tr>
                              <tr>
                                <td><b>Paid</td>
                                <td>:</td>
                                <td><?php
                                if ($shipment->acc_paid==1):
                                  ?>
                                <i class="fa fa-check-square-o green"></i>
                                <?php
                                else:
                                ?>
                                    <div class="font-15 red big">&empty;</div>
                                <?php
                                endif;
                                ?></td>
                              </tr>
                              <br>
                              <tr>
                                <td><br><br></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                              <td><b class="green">No Orders Found</b></td>
                              <td>:</td>
                              <td>
                                <?php
                                for ($i=0; $i < $jml_loop_order_search ; $i++) {

                                  $no_order[] = $_SESSION['no_order'.$i];

                                    if ($i=="0") {
                                      //echo $_SESSION['no_order'.$i].', ';
                                    }else{

                                    }
                                  //  echo "<br>";
                                }



                                //echo $no_order[1];
                                print "<pre>";
                                $hasil = array_unique($no_order);
                                foreach ($hasil as $hasil_pencarian) {
                                  echo $hasil_pencarian.", ";
                                }
                                print "</pre>";
                                //echo $no_order[0];
                                // $q_order = $conn->query("SELECT no_order from t4t_order where no_order like '%$hasil%'")->fetch();
                                // foreach ($q_order as $data) {
                                //   echo $data[0];
                                // }
                                ?>
                              </td>
                              </tr>
                            </table>

                            </div>
                          </div>
                      </div>

                  </div>
              </div>
          </div>
<!-- end shipment -->

<?php
  for ($i=0; $i <10 ; $i++) {

?>

<!-- order -->
          <!-- <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                      <h2>ORDER <small>INFORMATION</small></h2>
                      <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                      </ul>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                      <div class="bs-example" data-example-id="simple-jumbotron">
                          <div class="jumbotron form-group">
                          <?php
                        //  if ($kosong=$order->fetch()==false) {
                        //    echo "No result found.";
                        //  }else{
                    //  $order_2 = $conn->query("SELECT * from t4t_order where wins1 <= '$nomor_win' and wins2 >= '$nomor_win' or wins1='$nomor_win' and wins2='$nomor_win'");
                        //  while ($load_order=$order_2->fetch()) {
                          //  $id_part = $load_order['id_comp'];
                          //  $nm_part = $conn->query("SELECT nama from t4t_partisipan where id='$id_part'")->fetch();
                           ?>
                              <label>Order No.</label>
                              <h3 class="green"><?php //echo $load_order['no_order'] ?></h3>

                              <table>
                                <tr>
                                  <td><b>Participant Name</td>
                                  <td>:</td>
                                  <td><?php //echo $nm_part[0] ?></td>
                                </tr>
                                <tr>
                                  <td><b>Order Date</td>
                                  <td>:</td>
                                  <td><?php //echo $load_order['wkt_order'] ?></td>
                                </tr>
                                <tr>
                                  <td><b>First WINS</td>
                                  <td>:</td>
                                  <td><?php// echo $load_order['wins1'] ?></td>
                                </tr>
                                <tr>
                                  <td><b>Last WINS</td>
                                  <td>:</td>
                                  <td><?php //echo $load_order['wins2'] ?></td>
                                </tr>
                                <tr>
                                  <td><b>Product Type</td>
                                  <td>:</td>
                                  <td><?php //echo $load_order['tipe_prod'] ?></td>
                                </tr>
                                <tr>
                                  <td><b>QTY WINS</td>
                                  <td>:</td>
                                  <td><?php //echo $load_order['jml_wins'] ?></td>
                                </tr>
                                <tr>
                                  <td><b>Destination</td>
                                  <td>:</td>
                                  <td><?php //echo $load_order['kota_tujuan'] ?></td>
                                </tr>
                              </table>
                              <hr>

                              <?php //}
                          //  }
                                ?>

                          </div>
                      </div>

                  </div>
              </div>
          </div> -->
<!-- end order -->
<?php
  }//end for
?>

<?php
}//end if
?>
<?php
$ship_tdk_ada = $_SESSION['kosong'];
unset($_SESSION['kosong']);
if ($ship_tdk_ada==true) {
?>
<!-- shipment -->
          <div class="col-md-12 ">
              <div class="x_panel">
                  <div class="x_title">
                      <h2>SHIPMENT <small>INFORMATION</small></h2>
                      <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                      </ul>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                      <div class="bs-example" data-example-id="simple-jumbotron">
                          <div class="jumbotron">

                            <label>Shipment No.</label>
                            <h3 class="green">Not Found.</h3>

                            </div>
                          </div>
                      </div>

                  </div>
              </div>
          </div>
<!-- end shipment -->
<?php
}
?>

                                </div>



                      </div>







                    </div>

                    </font>

                </div>
              </div>
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

    <!-- bootstrap progress js -->
    <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="../js/icheck/icheck.min.js"></script>
    <script src="../js/custom.js"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="../js/moment/moment.min.js"></script>
    <script type="text/javascript" src="../js/datepicker/daterangepicker.js"></script>

    <!-- range slider -->
    <script src="../js/ion_range/ion.rangeSlider.min.js"></script>
    <!-- color picker -->
    <script src="../js/colorpicker/bootstrap-colorpicker.min.js"></script>
    <script src="../js/colorpicker/docs.js"></script>


    <!-- pace -->
    <script src="../js/pace/pace.min.js"></script>

    <!-- datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {

            var cb = function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange_right span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
                //alert("Callback has fired: [" + start.format('D MMMM, YYYY') + " to " + end.format('D MMMM, YYYY') + ", label = " + label + "]");
            }

            var optionSet1 = {
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: {
                    days: 60
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'right',
                buttonClasses: ['btn btn-default'],
                applyClass: 'btn-small btn-primary',
                cancelClass: 'btn-small',
                format: 'DD/MM/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Clear',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            };

            $('#reportrange_right span').html(moment().subtract(29, 'days').format('D MMMM, YYYY') + ' - ' + moment().format('D MMMM, YYYY'));

            $('#reportrange_right').daterangepicker(optionSet1, cb);

            $('#reportrange_right').on('show.daterangepicker', function () {
                console.log("show event fired");
            });
            $('#reportrange_right').on('hide.daterangepicker', function () {
                console.log("hide event fired");
            });
            $('#reportrange_right').on('apply.daterangepicker', function (ev, picker) {
                console.log("apply event fired, start/end dates are " + picker.startDate.format('D MMMM, YYYY') + " to " + picker.endDate.format('D MMMM, YYYY'));
            });
            $('#reportrange_right').on('cancel.daterangepicker', function (ev, picker) {
                console.log("cancel event fired");
            });

            $('#options1').click(function () {
                $('#reportrange_right').data('daterangepicker').setOptions(optionSet1, cb);
            });

            $('#options2').click(function () {
                $('#reportrange_right').data('daterangepicker').setOptions(optionSet2, cb);
            });

            $('#destroy').click(function () {
                $('#reportrange_right').data('daterangepicker').remove();
            });

        });
    </script>
    <!-- datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {

            var cb = function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
                //alert("Callback has fired: [" + start.format('D MMMM, YYYY') + " to " + end.format('D MMMM, YYYY') + ", label = " + label + "]");
            }

            var optionSet1 = {
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: {
                    days: 60
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'left',
                buttonClasses: ['btn btn-default'],
                applyClass: 'btn-small btn-primary',
                cancelClass: 'btn-small',
                format: 'DD/MM/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Clear',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            };
            $('#reportrange span').html(moment().subtract(29, 'days').format('D MMMM, YYYY') + ' - ' + moment().format('D MMMM, YYYY'));
            $('#reportrange').daterangepicker(optionSet1, cb);
            $('#reportrange').on('show.daterangepicker', function () {
                console.log("show event fired");
            });
            $('#reportrange').on('hide.daterangepicker', function () {
                console.log("hide event fired");
            });
            $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
                console.log("apply event fired, start/end dates are " + picker.startDate.format('D MMMM, YYYY') + " to " + picker.endDate.format('D MMMM, YYYY'));
            });
            $('#reportrange').on('cancel.daterangepicker', function (ev, picker) {
                console.log("cancel event fired");
            });
            $('#options1').click(function () {
                $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
            });
            $('#options2').click(function () {
                $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
            });
            $('#destroy').click(function () {
                $('#reportrange').data('daterangepicker').remove();
            });
        });
    </script>
    <!-- /datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#single_cal1').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_1"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            $('#single_cal2').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_2"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            $('#single_cal3').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_3"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            $('#single_cal4').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#reservation').daterangepicker(null, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
        });
    </script>
    <!-- /datepicker -->
    <!-- ion_range -->
    <script>
        $(function () {
            $("#range_27").ionRangeSlider({
                type: "double",
                min: 1000000,
                max: 2000000,
                grid: true,
                force_edges: true
            });
            $("#range").ionRangeSlider({
                hide_min_max: true,
                keyboard: true,
                min: 0,
                max: 5000,
                from: 1000,
                to: 4000,
                type: 'double',
                step: 1,
                prefix: "$",
                grid: true
            });
            $("#range_25").ionRangeSlider({
                type: "double",
                min: 1000000,
                max: 2000000,
                grid: true
            });
            $("#range_26").ionRangeSlider({
                type: "double",
                min: 0,
                max: 10000,
                step: 500,
                grid: true,
                grid_snap: true
            });
            $("#range_31").ionRangeSlider({
                type: "double",
                min: 0,
                max: 100,
                from: 30,
                to: 70,
                from_fixed: true
            });
            $(".range_min_max").ionRangeSlider({
                type: "double",
                min: 0,
                max: 100,
                from: 30,
                to: 70,
                max_interval: 50
            });
            $(".range_time24").ionRangeSlider({
                min: +moment().subtract(12, "hours").format("X"),
                max: +moment().format("X"),
                from: +moment().subtract(6, "hours").format("X"),
                grid: true,
                force_edges: true,
                prettify: function (num) {
                    var m = moment(num, "X");
                    return m.format("Do MMMM, HH:mm");
                }
            });
        });
    </script>
    <!-- /ion_range -->

      <!-- Datatables -->

        <script src="../js/datatables/js/jquery.dataTables.js"></script>
        <script src="../js/datatables/tools/js/dataTables.tableTools.js"></script>

        <script>
          $(function() {
              $('#example').DataTable( {
                        // "bJQueryUI":true,
                      "bPaginate":true,
                      "sPaginationType": "full_numbers",
                      "iDisplayLength":10
              } );

          } );
        </script>
</body>

</html>
