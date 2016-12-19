<?php 
$ta=$_SESSION['ta'];
  $_ta=mysql_fetch_row(mysql_query("select kab_code,prov_code,nama from t4t_tamaster where kd_ta='$ta'"));
$nama_mu=mysql_fetch_row(mysql_query("select kd_mu,nama from t4t_mu where kab_kode='$_ta[0]' and prov_code='$_ta[1]'"));

$data=mysql_fetch_array(mysql_query("select * from t4t_lahan where no='$id_lahan'"));
  $id_desa=$data['id_desa'];
  $kd_petani=$data['kd_petani'];
  $jenis_pohon=$data['id_pohon2'];
  $no_lahan=$data['no_lahan'];

  //data pohon
  $rekapmon=mysql_fetch_row(mysql_query("select jml,sht1 from t4t_rekapmon where id_desa='$id_desa' and no_lahan='$no_lahan' and kd_petani='$kd_petani'"));
 ?>


<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>Monitoring <small></small></h3>
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
                  <h2><i class="fa fa fa-circle-o"></i> No. Lahan <?php echo $data['no_lahan'] ?> </h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <a href="?<?php echo paramEncrypt('hal=fc-planning-lihat-rencana-tanam')?>" data-toggle="tooltip" data-placement="left" title="Lihat data rencana tanam"><i class="fa fa-eye"></i> Lihat Data Rencana Tanam</a>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form class="form-horizontal form-label-left" action="" method="post">
                    
                    <table class="col-md-6">
                      <tr>
                        <td class="col-md-5">Nama Petani</td>
                        <td> : </td>
                        <td><?php 
                        $petani=mysql_fetch_row(mysql_query("select nm_petani,alamat from t4t_petani where id_desa='$id_desa' and kd_petani='$kd_petani'"));
                        echo $petani[0]; ?></td>
                      </tr>
                      <tr>
                        <td class="col-md-5">Alamat Petani</td>
                        <td> : </td>
                        <td><?php echo $petani[1] ?></td>
                      </tr>
                      <tr>
                        <td class="col-md-5">No. Lahan</td>
                        <td> : </td>
                        <td><?php echo $data['no_lahan'] ?></td>
                      </tr>
                      <tr>
                        <td class="col-md-5">Jenis Tanaman</td>
                        <td> : </td>
                        <td><?php 
                        $jenis=mysql_fetch_row(mysql_query("select nama_pohon from t4t_pohon where id_pohon='$jenis_pohon'"));
                        echo $jenis[0];
                        ?></td>
                      </tr>
                      <tr>
                        <td class="col-md-5">Tahun Tanam</td>
                        <td> : </td>
                        <td><?php echo $data['thn_tanam'] ?></td>
                      </tr>
                      <tr>
                        <td class="col-md-5">Tanggal Tanam</td>
                        <td> : </td>
                        <td><?php 
                          $w=$data['wkt_tanam'];
                          $ex_wtanam=explode("-", $w);
                          echo $ex_wtanam[2].'/'.$ex_wtanam[1].'/'.$ex_wtanam[0];
                           ?></td>
                      </tr>
                      <tr>
                        <td class="col-md-5">Batas akhir monitoring <?php echo $mon ?></td>
                        <td> : </td>
                        <td><?php 
                          $b=$data['endmon'.$mon];
                          $ex_btsmon=explode("-", $b);
                          echo $ex_btsmon[2].'/'.$ex_btsmon[1].'/'.$ex_btsmon[0];
                         ?></td>
                      </tr>
                    </table>

                    <table class="col-md-6">
                      <tr>
                        <td class="col-md-4">Jumlah Total Pohon</td>
                        <td> : </td>
                        <td colspan="2"> <?php echo $rekapmon[0] ?></td>
                      </tr>
                      <tr>
                        <td class="col-md-4">Jumlah Pohon Hidup</td>
                        <td> : </td>
                        <td colspan="2"> <?php echo $rekapmon[1] ?></td>
                      </tr>
                      <tr>
                        <td class="col-md-4">Presentase Hidup</td>
                        <td> : </td>
                        <td colspan="2"> <?php $presentase=($rekapmon[1]/$rekapmon[0])*100; 
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
                  <table class="table table-striped responsive-utilities jambo_table" border="1" id="">
                    <thead>
                        <tr>
                            <th width="5%"><center>No.<center></th>
                            <th width="10%"><center>No. Pohon<center></th>
                            <th width="10%"><center>Sehat<center></th>
                            <th width="10%"><center>Mati<center></th>
                            <th width="10%"><center>Hilang<center></th>
                            <th width="45%"><center>Keterangan<center></th>
                        </tr>
                    </thead>
                  </table>
                
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
    <!-- daterangepicker -->
    <script type="text/javascript" src="../js/moment/moment.min.js"></script>
    <script type="text/javascript" src="../js/datepicker/daterangepicker.js"></script>
    <!-- input mask -->
    <script src="../js/input_mask/jquery.inputmask.js"></script>
    <!-- knob -->
    <script src="../js/knob/jquery.knob.min.js"></script>
    <!-- range slider -->
    <script src="../js/ion_range/ion.rangeSlider.min.js"></script>
    <!-- color picker -->
    <script src="../js/colorpicker/bootstrap-colorpicker.min.js"></script>
    <script src="../js/colorpicker/docs.js"></script>

    <!-- image cropping -->
    <script src="../js/cropping/cropper.min.js"></script>
    <script src="../js/cropping/main2.js"></script>
    <!-- pace -->
    <script src="../js/pace/pace.min.js"></script>

    <!-- input_mask -->
    <script>
        $(document).ready(function () {
            $("input").inputmask();
        });
    </script>
    <!-- /input mask -->

   
</body>

</html>
