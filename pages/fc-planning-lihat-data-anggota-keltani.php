<div class="">
<div class="page-title">
            <div class="title_left">
              <h3>Planning <small>Data Anggota</small></h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

              </div>
            </div>
          </div>
    <div class="x_panel">
        <div class="x_title">
            <h2><a href="<?php $fc->back() ?>"><i class="fa fa-reply"></i></a> - List Kelompok Tani <small><u><?php $desa = $fc->nama_desa($id_desa); echo 'Desa '.$desa->desa; ?></u></small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <a href="?<?php echo paramEncrypt('hal=fc-planning-input-data-partisipan')?>" data-toggle="tooltip" data-placement="left" title="Memasukkan data partisipan baru"><i class="fa fa-plus-circle"></i> Input Data Anggota</a>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">


          <div class="panel-body">
              <table class="table table-striped responsive-utilities jambo_table" id="data_partisipan">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Nama Kelompok Tani</th>
                          <th><center>Jml. Anggota</center></th>
                          <th><center>Status</center></th>
                          <th><center>Aksi</center></th>
                      </tr>
                  </thead>

                  <tbody>
          <?php
          $no=1;

          $kel_tani = $fc->list_keltani_perdesa($id_desa);
          foreach ($kel_tani as $load_keltani) {

              $data_kel_tani = $fc->data_kel_tani($load_keltani->id_kel_tani);
              $jml_agg_kel_tani = $fc->jml_agg_kel_tani($id_desa,$load_keltani->id_kel_tani);

          ?>
            <tr>
                <th scope="row"><?php echo $no; ?></th>
                <td>
                <?php
                  echo $data_kel_tani->kode_kel_tani.' - '.$data_kel_tani->nama_kel_tani;
                ?>
                </td>
                <td align="center"><?php echo $jml_agg_kel_tani->count ?></td>
                <td align="center">
                <?php
                if ($data_kel_tani->aktif=="1") {
                  echo "Aktif";
                }else{
                  echo "Tidak Aktif";
                }

                ?>
                </td>

                <td align="center"><a href="?<?php echo paramEncrypt('hal=fc-content-dataanggota-detail&id_kel_tani='.$load_keltani->id_kel_tani.'&id_desa='.$id_desa.'&nama_desa='.$nama_desa.'&nama_kec='.$nama_kec.'&nama_kab='.$nama_kab.'') ?>"><i class="fa fa-chevron-circle-right"></i> Lihat Anggota </a></td>
            </tr>
          <?php
          $no++;
          } ?>
                  </tbody>

              </table>


          </div>
                  </div>
                  <!-- Datatables -->
                  <script src="../js/datatables/js/jquery.dataTables.js"></script>
                  <script src="../js/datatables/tools/js/dataTables.tableTools.js"></script>

                  <script>
                  $(function() {
                  $('#data_partisipan').DataTable( {
                          // "bJQueryUI":true,
                        "bPaginate":true,
                        "sPaginationType": "full_numbers",
                        "iDisplayLength":10
                  } );
                  } );
                  </script>
                  <!-- end datatable -->
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
        <script type="text/javascript">
        <?php for ($i=1; $i <= 1; $i++) {
        ?>
            $(function fc() {
                var dataid = [<?php echo $i ?>];
                $.each(dataid,function(i,id) {
                    $("#fc<?php echo $i ?>").append("<div id='fc"+id+"' <div class='inner'><i class='fa fa-spinner fa-spin'></i> Loading...</div>");
                    $.get("?<?php echo paramEncrypt('content=fc-content-dataanggota&id_desa='.$id_desa.'')?>",function(html_widget) {
                        $("#fc"+id).replaceWith(html_widget);
                    })
                })
              })
        <?php
        } ?>
        </script>
        <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
        <!-- icheck -->
        <script src="../js/icheck/icheck.min.js"></script>
        <script src="../js/custom.js"></script>
        <!-- pace -->
        <script src="../js/pace/pace.min.js"></script>


</body>

</html>
