<div class="">
<div class="page-title">
            <div class="title_left">
              <h3>Planting <small>Realisasi Tanam</small></h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                
              </div>
            </div>
          </div>
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-folder-open"></i> Realisasi Tanam <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <a href="?<?php echo paramEncrypt('hal=fc-planting')?>" data-toggle="tooltip" data-placement="left" title="Memasukkan data realisasi tanam"><i class="fa fa-plus-circle"></i> Input Data Realisasi Tanam</a>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <!-- start accordion -->
            <div class="accordion" id="accordion" role="tablist" aria-multiSELECTable="true">
                <?php 
                $kode_fc=$_SESSION['kode'];
                $kode_ta=$_SESSION['ta'];
                $desa=$conn->query("SELECT * from t4t_lahan where kd_ta='$kode_ta' group by id_desa");
                while ($load_desa=$desa->fetch()) {
                    
                
                ?>

                <div class="panel">
                    <a class="panel-heading" role="tab" id="heading<?php echo $load_desa['id_desa'] ?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $load_desa['id_desa'] ?>" aria-expanded="true" aria-controls="collapse<?php echo $load_desa['id_desa'] ?>">
                        <h4 class="panel-title">
                        <i class="fa fa-caret-square-o-down"></i>
                        <?php 
                        $id_desa  =$load_desa['id_desa'];
                        $nama_desa=$conn->query("SELECT * from t4t_desa where id_desa='$id_desa'")->fetch();
                        $id_kec   =$nama_desa['id_kec'];
                        $id_kab   =$nama_desa['kab_code'];
                        $nama_kec =$conn->query("SELECT * from t4t_kec where id_kec='$id_kec'")->fetch();
                        $nama_kab =$conn->query("SELECT * from t4t_kab where kab_code='$id_kab'")->fetch();
                        // $jml_part =$conn->query("SELECT count(*) from t4t_lahan where id_desa='$id_desa' and kd_fc='$kode_fc'"));
                        $jml_tanaman=$conn->query("SELECT sum(jml_realisasi) from t4t_lahan where id_desa='$id_desa'")->fetch();

                        echo " Desa ".$nama_desa['desa']; echo " - Kec. ".$nama_kec['kecamatan']; echo " - Kab. ".$nama_kab['nama']; 
                        ?>
                     
                        <span class="badge bg-green"><?php echo number_format($jml_tanaman[0]) ?> pohon</span>
                        </h4>
                    </a>
                    <div id="collapse<?php echo $load_desa['id_desa'] ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading<?php echo $load_desa['id_desa'] ?>">
                        <div class="panel-body">
                            <!-- isi accordion 1 -->
                            <div class="accordion" id="accordion2" role="tablist" aria-multiSELECTable="true">
                               <?php 
                               $tahun=$conn->query("SELECT * from t4t_lahan where id_desa='$id_desa' and kd_ta='$kode_ta' group by thn_tanam order by thn_tanam desc ");
                               while ($load_tahun=$tahun->fetch()) {
                               ?>
                                <div class="panel">
                                    <a class="panel-heading" role="tab" id="heading<?php echo $load_tahun['thn_tanam'].''.$load_tahun['id_desa'] ?>" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $load_tahun['thn_tanam'].''.$load_tahun['id_desa'] ?>" aria-expanded="true" aria-controls="collapse<?php echo $load_tahun['thn_tanam'].''.$load_tahun['id_desa'] ?>">
                                        <h4 class="panel-title">
                                       <i class="fa fa-caret-square-o-down"></i> <?php echo $load_tahun['thn_tanam'] ?>
                                       <?php 
                                       $th=$load_tahun['thn_tanam'];
                                       $jml_tanaman2=$conn->query("SELECT sum(jml_realisasi) from t4t_lahan where id_desa='$id_desa' and thn_tanam='$th' ")->fetch();
                                       ?>
                                       <span class="badge bg-green"><?php echo number_format($jml_tanaman2[0]) ?> pohon</span>
                                        </h4>
                                    </a>
                                    <div id="collapse<?php echo $load_tahun['thn_tanam'].''.$load_tahun['id_desa'] ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading<?php echo $load_tahun['thn_tanam'].''.$load_tahun['id_desa'] ?>">
                                        <div class="panel-body">
                                <!-- isi table -->
                                <table class="table table-striped responsive-utilities jambo_table" border="1" id="rencana_tanam_list<?php echo $load_tahun['thn_tanam'].''.$load_tahun['id_desa'] ?>">
                                <thead>
                                        <tr>
                                            <th><center>No. Lahan<center></th>
                                            <th><center>Status Lahan</center></th>
                                            <th><center>Nama Partisipan</center></th>
                                            <th><center>Tahun Tanam</center></th>
                                            <th><center>Jenis Tanaman</center></th>
                                            <th><center>Luas Tanam (m²)</center></th>
                                            <th><center>Jumlah Rencana</center></th>
                                            <th><center>Jumlah Persetujuan</center></th>
                                            <th><center>Jumlah Realisasi</center></th>
                                            <th><center>Jenis Tanaman</center></th>
                                            <th><center>Tanggal Tanam</center></th>
                                        </tr>
                                    </thead>
                            
                                    <tbody>
                            <?php 
                            $th=$load_tahun['thn_tanam'];
                            
                            $lahan=$conn->query("SELECT * from t4t_lahan where id_desa='$id_desa' and kd_ta='$kode_ta' and thn_tanam='$th'");
                            while ($load_lahan=$lahan->fetch()) {
                            ?>
                                        <tr>
                                            <td align="center"><?php echo $load_lahan['no_lahan'] ?></td>
                                            <td align="center"><?php echo $load_lahan['status_lahan'] ?></td>
                                            <td align="center">
                                                <?php 
                                                $kd_petani=$load_lahan['kd_petani'];
                                                $nama_part=$conn->query("SELECT nm_petani from t4t_petani where kd_petani='$kd_petani' and id_desa='$id_desa'")->fetch();
                                                echo $nama_part[0];
                                                ?></td>
                                            <td align="center"><?php echo $load_lahan['thn_tanam'] ?></td>
                                            <td align="center">
                                                <?php
                                                $id_pohon=$load_lahan['id_pohon'];
                                                $pohon=$conn->query("SELECT nama_pohon from t4t_pohon where id_pohon='$id_pohon'")->fetch();
                                                echo $pohon[0]; 
                                                ?></td>
                                            <td align="center"><?php echo $load_lahan['luas_tanam'] ?></td>
                                            <td align="center"><?php echo $load_lahan['jml_usulan'] ?></td>
                                            <td align="center"><?php echo $load_lahan['jml_persetujuan'] ?></td>
                                            <td align="center"><?php echo $load_lahan['jml_realisasi'] ?></td>
                                            <td align="center">
                                                <?php
                                                $id_pohon2=$load_lahan['id_pohon2'];
                                                $pohon2=$conn->query("SELECT nama_pohon from t4t_pohon where id_pohon='$id_pohon2'")->fetch();
                                                echo $pohon2[0]; 
                                                ?></td>
                                            <td align="center" width="100px"><?php echo $load_lahan['wkt_tanam'] ?></td>
                                        </tr>


                            <?php 
                            }
                            ?>
                                    </tbody>
                            
                                </table>
                                <!-- end isi table -->
                                </div>
                                    </div>
                                </div>  
    <!-- Datatables -->
    <script src="../js/datatables/js/jquery.dataTables.js"></script>
    <script src="../js/datatables/tools/js/dataTables.tableTools.js"></script>

     <script>
      $(function() {
          $('#rencana_tanam_list<?php echo $load_tahun['thn_tanam'].''.$load_tahun['id_desa'] ?>').DataTable( {
                    // "bJQueryUI":true,
                  "bPaginate":true,
                  "sPaginationType": "full_numbers",
                  "iDisplayLength":10
          } );

      } );
    </script>
    <!-- end datatable -->
                                <?php } ?>             
                            </div>
                            <!-- end isi accordion 1 -->
                        </div>
                    </div>
                </div>  
                <?php 
                
                } ?>              
            </div>
            <!-- end of accordion -->
            <?php 
            $nama_ta=$conn->query("SELECT nama from t4t_tamaster where kd_ta='$kode_ta'")->fetch();
            $jml_tanaman_ta=$conn->query("SELECT sum(jml_realisasi),sum(jml_usulan) from t4t_lahan where kd_ta=$kode_ta")->fetch();
            $percent=($jml_tanaman_ta[0]/$jml_tanaman_ta[1])*100;
            ?>
    <div class="font-hijau">
    *) <small>Jumlah keseluruhan tanaman pada</small> Target Area <?php echo $nama_ta[0] ?> : <b> <?php echo number_format($jml_tanaman_ta[1]) ?> <small>tanaman, realisasi :</small> <?php echo number_format($jml_tanaman_ta[0]) ?> <small> tanaman</small> <span class='badge bg-blue'><?php echo number_format($percent,2) ?> %</span></b>
    </div>
        </div>
    </div>
</div>

<?php include '../layout/js.php'; ?>