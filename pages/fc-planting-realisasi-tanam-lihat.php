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
            <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                <?php 
                $kode_fc=$_SESSION['kode'];
                $kode_ta=$_SESSION['ta'];
                $desa=mysql_query("select * from t4t_lahan where kd_ta='$kode_ta' group by id_desa");
                while ($load_desa=mysql_fetch_array($desa)) {
                    
                
                ?>

                <div class="panel">
                    <a class="panel-heading" role="tab" id="heading<?php echo $load_desa['id_desa'] ?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $load_desa['id_desa'] ?>" aria-expanded="true" aria-controls="collapse<?php echo $load_desa['id_desa'] ?>">
                        <h4 class="panel-title">
                        <i class="fa fa-caret-square-o-down"></i>
                        <?php 
                        $id_desa  =$load_desa['id_desa'];
                        $nama_desa=mysql_fetch_array(mysql_query("select * from t4t_desa where id_desa='$id_desa'"));
                        $id_kec   =$nama_desa['id_kec'];
                        $id_kab   =$nama_desa['kab_code'];
                        $nama_kec =mysql_fetch_array(mysql_query("select * from t4t_kec where id_kec='$id_kec'"));
                        $nama_kab =mysql_fetch_array(mysql_query("select * from t4t_kab where kab_code='$id_kab'"));
                        // $jml_part =mysql_fetch_array(mysql_query("select count(*) from t4t_lahan where id_desa='$id_desa' and kd_fc='$kode_fc'"));
                        $jml_tanaman=mysql_fetch_array(mysql_query("select sum(jml_realisasi) from t4t_lahan where id_desa='$id_desa'"));

                        echo " Desa ".$nama_desa['desa']; echo " - Kec. ".$nama_kec['kecamatan']; echo " - Kab. ".$nama_kab['nama']; 
                        ?>
                     
                        <span class="badge bg-green"><?php echo number_format($jml_tanaman[0]) ?> pohon</span>
                        </h4>
                    </a>
                    <div id="collapse<?php echo $load_desa['id_desa'] ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading<?php echo $load_desa['id_desa'] ?>">
                        <div class="panel-body">
                            <!-- isi accordion 1 -->
                            <div class="accordion" id="accordion2" role="tablist" aria-multiselectable="true">
                               <?php 
                               $tahun=mysql_query("select * from t4t_lahan where id_desa='$id_desa' and kd_ta='$kode_ta' group by thn_tanam order by thn_tanam desc ");
                               while ($load_tahun=mysql_fetch_array($tahun)) {
                               ?>
                                <div class="panel">
                                    <a class="panel-heading" role="tab" id="heading<?php echo $load_tahun['thn_tanam'].''.$load_tahun['id_desa'] ?>" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $load_tahun['thn_tanam'].''.$load_tahun['id_desa'] ?>" aria-expanded="true" aria-controls="collapse<?php echo $load_tahun['thn_tanam'].''.$load_tahun['id_desa'] ?>">
                                        <h4 class="panel-title">
                                       <i class="fa fa-caret-square-o-down"></i> <?php echo $load_tahun['thn_tanam'] ?>
                                       <?php 
                                       $th=$load_tahun['thn_tanam'];
                                       $jml_tanaman2=mysql_fetch_row(mysql_query("select sum(jml_realisasi) from t4t_lahan where id_desa='$id_desa' and thn_tanam='$th' "));
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
                            
                            $lahan=mysql_query("select * from t4t_lahan where id_desa='$id_desa' and kd_ta='$kode_ta' and thn_tanam='$th'");
                            while ($load_lahan=mysql_fetch_array($lahan)) {
                            ?>
                                        <tr>
                                            <td align="center"><?php echo $load_lahan['no_lahan'] ?></td>
                                            <td align="center"><?php echo $load_lahan['status_lahan'] ?></td>
                                            <td align="center"><?php echo $load_lahan[''] ?></td>
                                            <td align="center"><?php echo $load_lahan['thn_tanam'] ?></td>
                                            <td align="center"><?php echo $load_lahan['id_pohon'] ?></td>
                                            <td align="center"><?php echo $load_lahan['luas_tanam'] ?></td>
                                            <td align="center"><?php echo $load_lahan['jml_usulan'] ?></td>
                                            <td align="center"><?php echo $load_lahan['jml_persetujuan'] ?></td>
                                            <td align="center"><?php echo $load_lahan['jml_realisasi'] ?></td>
                                            <td align="center"><?php echo $load_lahan['id_pohon2'] ?></td>
                                            <td align="center"><?php echo $load_lahan['wkt_tanam'] ?></td>
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
            $nama_ta=mysql_fetch_array(mysql_query("select nama from t4t_tamaster where kd_ta='$kode_ta'"));
            $jml_tanaman_ta=mysql_fetch_array(mysql_query("select sum(jml_realisasi),sum(jml_usulan) from t4t_lahan where kd_ta=$kode_ta"));
            $percent=($jml_tanaman_ta[0]/$jml_tanaman_ta[1])*100;
            ?>
    <div class="font-hijau">
    *) <small>Jumlah keseluruhan tanaman pada</small> Target Area <?php echo $nama_ta[0] ?> : <b> <?php echo number_format($jml_tanaman_ta[1]) ?> <small>tanaman, realisasi :</small> <?php echo number_format($jml_tanaman_ta[0]) ?> <small> tanaman</small> <span class='badge bg-blue'><?php echo number_format($percent,2) ?> %</span></b>
    </div>
        </div>
    </div>
</div>

<?php include '../layout/js.php'; ?>