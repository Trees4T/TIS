<div class="">
<div class="page-title">
            <div class="title_left">
              <h3>Monitoring</h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

              </div>
            </div>
          </div>
    <div class="x_panel">
        <div class="x_title">
            <h2><a href="<?php $fc->back() ?>"><i class="fa fa-reply"></i></a> - Desa <?php echo $fc->nama_desa($id_desa)->desa ?> -
            Tahun <?php echo $thn_tanam ?></h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">

        <div class="panel-body">
          <!-- isi table -->
          <table class="table table-striped responsive-utilities jambo_table" border="1" id="monitoring_list">
          <thead>
              <tr>
                  <th><center>No. Lahan<center></th>
                  <th><center>Monitoring I</center></th>
                  <th><center>Monitoring II</center></th>
                  <th><center>Monitoring III</center></th>
                  <th><center>Monitoring IV</center></th>
                  <th><center>Monitoring V</center></th>
                  <th><center>Monitoring VI</center></th>
                  <th><center>Monitoring VII</center></th>
              </tr>
          </thead>

          <tbody>
          <?php
          $lahan=$conn->query("select * from t4t_lahan where id_desa='$id_desa' and kd_ta='$kode_ta' and thn_tanam='$thn_tanam'");
          while ($load_lahan=$lahan->fetch()) {
            if ($load_lahan['jml_realisasi'] == '0') {
              # code...
            }else{
          ?>
              <tr>
                  <td align="center"><?php echo $load_lahan['no_lahan'] ?></td>

                  <?php
                  $jml_mon=7;
                  for ($i=1; $i <= $jml_mon ; $i++) {
                    $link=paramEncrypt('hal=fc-monitoring-detail&id_lahan='.$load_lahan['no'].'&mon='.$i.'');


                  ?>

                  <td align="center">
                  <?php

                   if ($load_lahan['accmon'.$i]==0) {
                      echo "<a href='?".$link."'>";
                      echo "<div class='font-big'><i class='fa fa-circle-o'></i></div>";
                      echo "</a>";
                   }elseif ($load_lahan['accmon'.$i]==1) {
                      echo "<a href='?".$link."'>";
                      echo "<div class='font-hijau-big'><i class='fa fa-check-circle'></i></div>";
                      echo "</a>";
                   }

                  ?></td>

                  <?php

                  } // end for
                  ?>

              </tr>


          <?php
        }//end if
          }
          ?>
          </tbody>

          </table>
          <!-- end isi table -->
          </div>
          </div>

          <!-- Datatables -->
          <script src="../js/datatables/js/jquery.dataTables.js"></script>
          <script src="../js/datatables/tools/js/dataTables.tableTools.js"></script>

          <script>
          $(function() {
          $('#monitoring_list').DataTable( {
          // "bJQueryUI":true,
          "b.Filter":false,
          "bPaginate":true,
          "sPaginationType": "full_numbers",
          "iDisplayLength":100
          } );

          } );
          </script>
          <!-- end datatable -->

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
        <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
        <!-- icheck -->
        <script src="../js/icheck/icheck.min.js"></script>
        <script src="../js/custom.js"></script>
        <!-- pace -->
        <script src="../js/pace/pace.min.js"></script>


</body>

</html>
