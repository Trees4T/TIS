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
            <h2><i class="fa fa-folder-open"></i> Data Partisipan <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <a href="?<?php echo paramEncrypt('hal=fc-planning-input-data-partisipan')?>" data-toggle="tooltip" data-placement="left" title="Memasukkan data partisipan baru"><i class="fa fa-plus-circle"></i> Input Data Partisipan</a>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <!-- start accordion -->
            <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                <?php 
                $kode_fc=$_SESSION['kode'];
                $desa=mysql_query("select * from t4t_lahan where kd_fc='$kode_fc' group by id_desa");
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
                        $jml_part =mysql_fetch_array(mysql_query("select count(*) from t4t_lahan where id_desa='$id_desa'"));

                        echo "Desa ".$nama_desa['desa']; echo " - Kec. ".$nama_kec['kecamatan']; echo " - Kab. ".$nama_kab['nama']; 
                        ?>

                        <span class='badge bg-green'><?php echo $jml_part[0] ?> partisipan</span>
                        </h4>
                    </a>
                    <div id="collapse<?php echo $load_desa['id_desa'] ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading<?php echo $load_desa['id_desa'] ?>">
                        <div class="panel-body">
                            <table class="table table-striped responsive-utilities jambo_table" id="data_partisipan<?php echo $load_desa['id_desa'] ?>">
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
                        $partisipan=mysql_query("select * from t4t_lahan where id_desa='$id_desa'");
                        while ($load_part=mysql_fetch_array($partisipan)) {
                            
                        
                        ?>
                                    <tr>
                                        <th scope="row"><?php echo $no; ?></th>
                                        <td>
                                        <?php  
                                        $kd_petani  =$load_part['kd_petani'];
                                        $nama_petani=mysql_fetch_array(mysql_query("select * from t4t_petani where kd_petani='$kd_petani' and id_desa='$id_desa'"));
                                        echo "<b>".$nama_petani['nm_petani'];"<b>"                        
                                        ?> <br>
                                        <div class="avatar-view-petani" title="">
                                                    <img src="../images/default.png" alt="Avatar" width="100%">
                                        </div>                                           
                                        </td>
                                        <td>
                                        <?php  
                                        echo "Desa ".$nama_desa['desa']; echo " - Kec. ".$nama_kec['kecamatan']; echo " - Kab. ".$nama_kab['nama']; 
                                        ?>                                            
                                        </td>
                                        
                                        <td align="center"><a href="?<?php echo paramEncrypt('hal=fc-planning-petani-detail&kd_petani='.$kd_petani.'&id_desa='.$id_desa.'&nama_desa='.$nama_desa['desa'].'&nama_kec='.$nama_kec['kecamatan'].'&nama_kab='.$nama_kab['nama'].'') ?>"><i class="fa fa-chevron-circle-right"></i> Lihat Detail </a></td>
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
          $('#data_partisipan<?php echo $load_desa['id_desa'] ?>').DataTable( {
                    // "bJQueryUI":true,
                  "bPaginate":true,
                  "sPaginationType": "full_numbers",
                  "iDisplayLength":5
          } );

      } );
    </script>
    <!-- end datatable --> 
                <?php 
                
                } ?>              
            </div>
            <!-- end of accordion -->


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

       
</body>

</html>