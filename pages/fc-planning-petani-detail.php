<?php 
$data=mysql_fetch_array(mysql_query("select * from t4t_petani where id_desa='$id_desa' and kd_petani=$kd_petani"));
$kode_kab=mysql_fetch_row(mysql_query("select kab_code,prov_code FROM t4t_kab where nama='$nama_kab'"));
  $kode_kabupaten=$kode_kab[0];
  $kode_provinsi=$kode_kab[1];
$nama_mu=mysql_fetch_row(mysql_query("select kd_mu,nama from t4t_mu where kab_kode='$kode_kabupaten' and prov_code='$kode_provinsi'"));

 ?>
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
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-asterisk"></i> Detail Data Partisipan  </h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <a href="?<?php echo paramEncrypt('hal=fc-planning-lihat-data-partisipan')?>" data-toggle="tooltip" data-placement="left" title="Lihat data partisipan"><i class="fa fa-eye"></i> Lihat Data Partisipan</a>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                    <font size="">
                    <div class="col-sm-2">
                    <div class="avatar-view-input-petani" title="">
                      <img src="../images/default.png" alt="Avatar" width="100%">
                    </div>      
                    <input type="file">              
                    </div>

                    <div class="col-sm-10">
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Desa <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12 font-hijau">
                        <?php echo $nama_desa.' - Kec.'.$nama_kec.' - Kab.'.$nama_kab.'' ?> 
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No. Partisipan <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12 font-hijau">
                        <?php echo $data['kd_petani'] ?>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Partisipan <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $data['nm_petani'] ?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No. KTP <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" data-inputmask="'mask' : '9999-9999-9999-9999'" value="<?php echo $data['no_ktp'] ?>">
                        
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Alamat Partisipan <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea type="text" required="required" class="form-control col-md-7 col-xs-12"><?php echo $data['alamat'] ?></textarea>
                      </div>
                    </div>
<?php 
$kel_tani=mysql_fetch_assoc(mysql_query("select * from anggota_kel_tani where kd_petani='$kd_petani' and id_desa='$id_desa' "));
echo mysql_error();
 ?>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kelompok Tani <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                          <option><?php 
                          if ($kel_tani['nama_kel_tani']=="") {
                            echo "Tidak memiliki";
                          }else{ 
                            echo $kel_tani['nama_kel_tani']; 
                          } ?></option>

                          <?php 
                          $nama_kel_tani=mysql_query("select nama_kel_tani from kel_tani where kd_mu='$nama_mu[0]' and aktif=1");
                          while ($data_keltani=mysql_fetch_row($nama_kel_tani)) {
                            
                           ?>
                          <option><?php echo $data_keltani[0] ?></option>
                          <?php 
                          }
                           ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Keanggotaan Dalam Kelompok <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                          <option></option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jenis Kelamin <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                          <option></option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Umur <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Profesi <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                          <option><?php if ($data['profesi']=='') {
                            echo "Belum ada data";
                          }else{
                            echo $data['profesi'];
                            } ?></option>

                            <option>Petani / Nelayan</option>
                            <option>Karyawan / Pegawai</option>
                            <option>Wiraswasta / Pedagang</option>
                            <option>Nelayan</option>
                        </select>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tujuan Menanam Pohon <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                          <option></option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Rencana Penebangan <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                          <option></option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pendapatan / Tahun <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Persepsi Tentang T4T <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">Cancel</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </div>
                    </div>

                    </font>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <?php include '../layout/js.php'; ?>