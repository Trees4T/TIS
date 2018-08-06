<div class="">
<div class="page-title">
            <div class="title_left">
              <h3>Planning <small>Data Partisipan</small></h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

              </div>
            </div>
          </div>
    <div class="x_panel">
        <div class="x_title">
          <?php
          $nama_desa = $fc->nama_desa($id_desa);
          ?>
            <h2> <a href="?<?php echo paramEncrypt('hal=fc-planning-lihat-data-partisipan')?>"><i class="fa fa-reply"></i></a> - Desa <?php echo $nama_desa->desa ?>  </h2>
            <ul class="nav navbar-right panel_toolbox">
                <a href="?<?php echo paramEncrypt('hal=fc-planning-input-data-partisipan')?>" data-toggle="tooltip" data-placement="left" title="Memasukkan data partisipan baru"><i class="fa fa-plus-circle"></i> Input Data Partisipan</a>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">


          <div class="panel-body">
                          <table class="table table-striped responsive-utilities jambo_table" id="data_partisipan">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Partisipan</th>
                                      <th>Lokasi</th>
                                      <th><center>Aksi</center></th>
                                  </tr>
                              </thead>

                              <tbody>
                      <?php
                      $no=1;
                      $partisipan = $fc->tabel_partisipan($id_desa);
                      foreach ($partisipan as $load_part) {
                      ?>
                                  <tr>
                                      <th scope="row"><?php echo $no; ?></th>
                                      <td>
                                      <?php
                                      $kd_petani  =$load_part->kd_petani;
                                      $nama_petani= $conn->query("select * from t4t_petani where kd_petani='$kd_petani' and id_desa='$id_desa'")->fetch(PDO::FETCH_OBJ);
                                      echo "<b>".$nama_petani->nm_petani;"<b>"
                                      ?> <br>
                                      <div class="avatar-view-petani" title="">
                                      <?php
                                      $data_petani = $fc->t4t_petani_detail($id_desa,$kd_petani);
                                      if ($data_petani->foto!="") {
                                      ?>
                                      <img src="../../management_t4t/gbr/poto/<?php echo $data_petani->foto ?>" alt="Avatar" width="100%">
                                      <?php
                                      }else{
                                      ?>
                                      <img src="../images/default.png" alt="Avatar" width="100%">
                                      <?php
                                      }
                                      ?>

                                      </div>
                                      </td>
                                      <td>
                                      <?php
                                      $id_desa   = $load_part->id_desa;
                                      $nama_desa = $fc->nama_desa($id_desa);

                                      $id_kec    = $nama_desa->id_kec;
                                      $nama_kec  = $fc->nama_kec($id_kec);

                                      $id_kab    = $nama_desa->kab_code;
                                      $nama_kab  = $fc->nama_kab($id_kab);


                                      echo "Desa ".$nama_desa->desa; echo " - Kec. ".$nama_kec->kecamatan; echo " - Kab. ".$nama_kab->nama;
                                      ?>
                                      </td>

                                      <td align="center"><a href="?<?php echo paramEncrypt('hal=fc-planning-petani-detail&kd_petani='.$kd_petani.'&id_desa='.$id_desa.'&nama_desa='.$nama_desa->desa.'&nama_kec='.$nama_kec->kecamatan.'&nama_kab='.$nama_kab->nama.'') ?>"><i class="fa fa-chevron-circle-right"></i> Lihat Detail </a></td>
                                  </tr>
                      <?php
                      $no++;
                      } ?>
                              </tbody>

                          </table>


                      </div>
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
                    $.get("?<?php echo paramEncrypt('content=fc-content-datapart')?>",function(html_widget) {
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
