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
          <?php
          $desa = $fc->nama_desa($id_desa);
          ?>
            <h2> <a href="<?php $fc->back() ?>"><i class="fa fa-reply"></i></a> - Data Partisipan <small><u>Desa <?php echo $desa->desa ?> - Kel. Tani <?php $data_kel_tani= $fc->data_kel_tani($id_kel_tani); echo $nama_keltani = $data_kel_tani->nama_kel_tani; ?> </u></small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <a href="?<?php echo paramEncrypt('hal=fc-planning-input-data-partisipan')?>" data-toggle="tooltip" data-placement="left" title="Memasukkan data partisipan baru"><i class="fa fa-plus-circle"></i> Input Data Partisipan</a>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <div class="panel-body">

            <?php
            if ($lahan == "") {
            ?>
            <!-- Partisipan -->
                          <table class="table table-striped responsive-utilities jambo_table" id="data_partisipan">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Partisipan</th>
                                      <th>Alamat</th>
                                      <th><center>Jml. Lahan</center></th>
                                      <th><center>Aksi</center></th>
                                  </tr>
                              </thead>

                              <tbody>
                      <?php
                      $no=1;

                      $anggota_keltani = $fc->list_keltani_anggota($id_desa,$id_kel_tani);
                      foreach ($anggota_keltani as $load_part) {
                        $kd_petani = $load_part->kd_petani;

                        $anggota = $fc->t4t_petani($id_desa,$kd_petani);
                        $jml_lahan = $fc->jml_agg_lahan($id_desa,$kd_petani);
                      ?>
                                  <tr>
                                      <th scope="row"><?php echo $no; ?></th>
                                      <td><?php echo $anggota->nm_petani; ?>
                                        <br>
                                        <div class="avatar-view-petani" title="">
                                        <a href="?<?php echo paramEncrypt('hal=fc-planning-petani-detail&id_kel_tani='.$id_kel_tani.'&kd_petani='.$kd_petani.'&id_desa='.$id_desa.'&nama_desa='.$nama_desa.'&nama_kec='.$nama_kec.'&nama_kab='.$nama_kab.'') ?>">
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
                                        </a>
                                        </div>
                                      </td>

                                      <td><?php echo $anggota->alamat ?></td>
                                      <td align="center"><?php echo $jml_lahan->count ?></td>
                                      <td align="center"><a href="?<?php echo paramEncrypt('hal=fc-content-dataanggota-detail&id_kel_tani='.$id_kel_tani.'&kd_petani='.$kd_petani.'&id_desa='.$id_desa.'&nama_desa='.$nama_desa.'&nama_kec='.$nama_kec.'&nama_kab='.$nama_kab.'&lahan=1') ?>"><i class="fa fa-chevron-circle-right"></i> Lihat Lahan </a></td>
                                  </tr>
                      <?php
                      $no++;
                      } ?>
                              </tbody>

                          </table>
        <?php
      }elseif($lahan == "1"){
        ?>

        <!-- Lahan -->
        <table class="table table-striped responsive-utilities jambo_table" id="data_partisipan">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Partisipan</th>
                    <th>No. Lahan</th>
                    <th>No. KTP</th>
                    <th>Alamat</th>
                    <th>No. SPPT</th>
                    <th>Luas Lahan (m&sup2;)</th>
                    <th>Tipe Silvikultur</th>
                    <th>No GPS</th>
                    <th>Keanggotaan</th>
                    <th><center>Aksi</center></th>
                </tr>
            </thead>

            <tbody>
              <?php
              $no=1;


              $lahan = $fc->list_lahan_anggota($id_desa,$kd_petani);
              foreach ($lahan as $load_lahan) {
                $kd_petani = $load_lahan->kd_petani;

                $data_petani = $fc->t4t_petani($id_desa,$kd_petani);
                $nama_silvi = $fc->nama_silvi($load_lahan->id_lahan);

              ?>

                          <tr>
                              <th scope="row"><?php echo $no; ?></th>
                              <td><?php echo $data_petani->nm_petani; ?>
                                <br>
                                <div class="avatar-view-petani" title="">
                                <a href="?<?php echo paramEncrypt('hal=fc-planning-petani-detail&id_kel_tani='.$id_kel_tani.'&kd_petani='.$kd_petani.'&id_desa='.$id_desa.'&nama_desa='.$nama_desa.'&nama_kec='.$nama_kec.'&nama_kab='.$nama_kab.'') ?>">
                                    <?php
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
                                </a>
                                </div>
                              </td>
                              <td><?php if (empty($load_lahan->no_lahan)) {
                                echo "-";
                              }else{
                                echo $load_lahan->no_lahan;
                              } ?></td>

                              <td><?php if (empty($data_petani->no_ktp)) {
                                echo "-";
                              }else{
                                echo $data_petani->no_ktp;
                              } ?></td>

                              <td><?php if (empty($data_petani->alamat)) {
                                echo "-";
                              }else{
                                echo $data_petani->alamat;
                              } ?></td>

                              <td><?php if (empty($data_petani->no_dok)) {
                                echo "-";
                              }else{
                                echo $data_petani->no_dok;
                              } ?></td>

                              <td align="center"><?php if (empty($load_lahan->luas_lahan)) {
                                echo "-";
                              }else{
                                echo $load_lahan->luas_lahan;
                              } ?></td>

                              <td><?php if (empty($nama_silvi->jenis_lahan)) {
                                echo "-";
                              }else{
                                echo $nama_silvi->jenis_lahan;
                              } ?></td>

                              <td><?php if (empty($load_lahan->noGPS)) {
                                echo "-";
                              }else{
                                echo $load_lahan->noGPS;
                              } ?></td>

                              <td class="red">???</td>

                              <td align="center">
                                <!-- <a href="?<?php //echo paramEncrypt('hal=fc-planning-petani-detail&id_kel_tani='.$id_kel_tani.'&kd_petani='.$kd_petani.'&id_desa='.$id_desa.'&nama_desa='.$nama_desa->desa.'&nama_kec='.$nama_kec->kecamatan.'&nama_kab='.$nama_kab->nama.'') ?>"><i class="fa fa-chevron-circle-right"></i> Lihat Lahan </a> -->
                              </td>
                          </tr>

              <?php
              $no++;
              } ?>

              <?php
              // $lahan_tegakan = $fc->list_lahan_anggota($id_desa,$kd_petani);
              // foreach ($lahan as $load_lahan) {
                ?>
              <!-- <tr>
                  <th scope="row"><?php //echo $no; ?></th>
                  <td>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>?</td>

                  <td align="center"><a href="?<?php //echo paramEncrypt('hal=fc-planning-petani-detail&kd_petani='.$kd_petani.'&id_desa='.$id_desa.'&nama_desa='.$nama_desa->desa.'&nama_kec='.$nama_kec->kecamatan.'&nama_kab='.$nama_kab->nama.'') ?>"><i class="fa fa-chevron-circle-right"></i> Lihat Lahan </a></td>
              </tr> -->
              <?php //} ?>

            </tbody>

        </table>
        <?php
        } ?>

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

        <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
        <!-- icheck -->
        <script src="../js/icheck/icheck.min.js"></script>
        <script src="../js/custom.js"></script>
        <!-- pace -->
        <script src="../js/pace/pace.min.js"></script>


</body>

</html>
