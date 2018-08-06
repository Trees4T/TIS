<?php

$ta = $fc->ta_master($kode_ta);
  $kode_kabupaten = $ta->kab_code;
  $kode_provinsi  = $ta->prov_code;

$mu = $fc->nama_mu($kode_kabupaten,$kode_provinsi);
  $nama_mu = $mu->nama;

$lahan = $fc->lahan($id_lahan);
  $id_desa    = $lahan['id_desa'];
  $kd_petani  = $lahan['kd_petani'];
  $jenis_pohon= $lahan['id_pohon2'];
  $no_lahan   = $lahan['no_lahan'];
  $no_t4tlahan = $lahan['no'];

  //data pohon
$rekapmon = $fc->rekapmon($id_desa,$no_lahan,$kd_petani);

 ?>

<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>Monitoring </h3>
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
                  <h2><a href="<?php echo $fc->back() ?>"><i class="fa fa-reply"></i></a> - <i class="fa fa fa-tag"></i> No. Lahan <?php echo $no_lahan ?> / Monitoring <?php echo $mon ?></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form class="form-horizontal form-label-left" action="" method="post">

                    <table class="col-md-6" id="">
                      <tr>
                        <td class="col-md-5">Nama Petani</td>
                        <td> : </td>
                        <td><?php
                        $petani = $fc->t4t_petani($id_desa,$kd_petani);
                        echo $petani->nm_petani; ?></td>
                      </tr>
                      <tr>
                        <td class="col-md-5">Alamat Petani</td>
                        <td> : </td>
                        <td><?php echo $petani->alamat; ?></td>
                      </tr>
                      <tr>
                        <td class="col-md-5">No. Lahan</td>
                        <td> : </td>
                        <td><?php echo $no_lahan ?></td>
                      </tr>
                      <tr>
                        <td class="col-md-5">Jenis Tanaman</td>
                        <td> : </td>
                        <td><?php
                         $jenis =  $fc->t4t_pohon($jenis_pohon);
                        echo $jenis->nama_pohon;
                        ?></td>
                      </tr>
                      <tr>
                        <td class="col-md-5">Tahun Tanam</td>
                        <td> : </td>
                        <td><?php echo $lahan['thn_tanam'] ?></td>
                      </tr>
                      <tr>
                        <td class="col-md-5">Tanggal Tanam</td>
                        <td> : </td>
                        <td><?php
                          $w=$lahan['wkt_tanam'];
                          $ex_wtanam=explode("-", $w);
                          echo $ex_wtanam[2].'/'.$ex_wtanam[1].'/'.$ex_wtanam[0];
                           ?></td>
                      </tr>
                      <tr>
                        <td class="col-md-5">Batas akhir monitoring <?php echo $mon ?></td>
                        <td> : </td>
                        <td><?php

                          $b=$lahan['endmon'.$mon];
                          $ex_btsmon=explode("-", $b);
                          echo $ex_btsmon[2].'/'.$ex_btsmon[1].'/'.$ex_btsmon[0];
                         ?></td>
                      </tr>
                    </table>

                    <table class="col-md-6">
                      <tr>
                        <td class="col-md-4">Jumlah Total Pohon</td>
                        <td> : </td>
                        <td colspan="2">
                          <?php
                          if ($rekapmon == false) {
                            $jml = $fc->lahan($id_lahan);
                            echo $jml['jml_realisasi'];
                          }else{
                            echo $rekapmon->jml;
                          }
                        ?></td>
                      </tr>
                      <tr>
                        <td class="col-md-4">Jumlah Pohon Hidup</td>
                        <td> : </td>
                        <td colspan="2">
                          <?php
                          if ($rekapmon == false) {
                            echo $jml['jml_realisasi'];
                          }else{
                            echo $rekapmon->sht1;
                          } ?></td>
                      </tr>
                      <tr>
                        <td class="col-md-4">Presentase Hidup</td>
                        <td> : </td>
                        <td colspan="2"> <?php
                        if ($rekapmon == false) {
                          $presentase=100;
                        }else{
                          $presentase=($rekapmon->sht1/$rekapmon->jml)*100;
                        }
                              echo number_format($presentase,2) ?> %</td>
                      </tr>
                      <tr>
                        <td class="col-md-4">Mati</td>
                        <td> : </td>
                        <td class="col-md-3"><input type="number" class="form-control" value="0"></td>
                        <td class="col-md-5"><input type="text" class="form-control" placeholder="Keterangan"></td>
                      </tr>
                      <tr>
                        <td class="col-md-4">Hilang</td>
                        <td> : </td>
                        <td class="col-md-3"><input type="number" class="form-control" value="0"></td>
                        <td class="col-md-5"><input type="text" class="form-control" placeholder="Keterangan"></td>
                      </tr>

                    </table>


                  </form>
                  <br><br><br>

                  <div id="fc1">

                  </div>

                </div>
              </div>
            </div>
          </div>

         <!-- js -->
   </div>

    </div>
             <script src="../js/bootstrap.min.js"></script>


    <!-- bootstrap progress js -->
    <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="../js/icheck/icheck.min.js"></script>
    <script src="../js/custom.js"></script>
    <!-- input mask -->
    <script src="../js/input_mask/jquery.inputmask.js"></script>
    <!-- knob -->
    <script src="../js/knob/jquery.knob.min.js"></script>
    <!-- pace -->
    <script src="../js/pace/pace.min.js"></script>

    <!-- input_mask -->
    <script>
        $(document).ready(function () {
            $("input").inputmask();
        });
    </script>
    <!-- /input mask -->


    <script type="text/javascript">
    <?php for ($i=1; $i <= 1; $i++) {
    ?>
        $(function fc() {
            var dataid = [<?php echo $i ?>];
            $.each(dataid,function(i,id) {
                $("#fc<?php echo $i ?>").append("<div id='fc"+id+"' <div class='inner'><i class='fa fa-spinner fa-spin'></i> Loading...</div>");
                $.get("?<?php echo paramEncrypt('content=fc-content-datamonitoring&lahan='.$no_t4tlahan.'&mon='.$mon.'')?>",function(html_widget) {
                    $("#fc"+id).replaceWith(html_widget);
                })
            })
          })
    <?php
    } ?>
    </script>
</body>

</html>
