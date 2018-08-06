<?php

$data           = $fc->t4t_petani($id_desa,$kd_petani);
$kode_kab       = $fc->kode_kab_prov($nama_kab);
$kode_kabupaten = $kode_kab->kab_code;
$kode_provinsi  = $kode_kab->prov_code;
$nama_mu        = $fc->nama_mu($kode_kabupaten,$kode_provinsi);

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

                  <h2><a href="<?php $fc->back(); ?>"><i class="fa fa-reply"></i></a> - </button> <i class="fa fa-user"></i> Detail Data Partisipan  </h2>
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
                      <?php
                      if ($data->foto!="") {
                      ?>
                      <img src="../../management_t4t/gbr/poto/<?php echo $data->foto ?>" alt="Avatar" width="100%">
                      <?php
                      }else{
                      ?>
                      <img src="../images/default.png" alt="Avatar" width="100%">
                      <?php
                      }
                      ?>

                    </div>
                    <input type="file">
                    </div>

                    <div class="col-sm-10">
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Desa <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12 font-hijau">
                      <label class="control-label">
                        <?php echo $nama_desa.' - Kec.'.$nama_kec.' - Kab.'.$nama_kab.'' ?>
                      </label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No. Partisipan <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12 font-hijau">
                      <label class="control-label">
                        <?php echo $data->kd_petani ?>
                      </label>
                      </div>
                    </div>

                    <!-- nama partisipan -->
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Partisipan <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" required="required" class="form-control col-md-7 col-xs-12" name="nama" value="<?php echo $data->nm_petani ?>">
                      </div>
                    </div>
                    <!-- no ktp -->
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No. KTP <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control input" name="ktp" value="<?php echo $data->no_ktp ?>" minlength="18">
                        <span class="fa fa-credit-card form-control-feedback right" aria-hidden="true"></span>
                      </div>
                    </div>
                    <!-- alamat partisipan -->
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Alamat Partisipan <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea type="text" required="required" class="form-control col-md-7 col-xs-12" name="alamat"><?php echo $data->alamat ?></textarea>
                      </div>
                    </div>
                    <!-- kelompok tani -->
                    <?php
                    $kel_tani=$conn->query("SELECT * from anggota_kel_tani where kd_petani='$kd_petani' and id_desa='$id_desa' ")->fetch(PDO::FETCH_OBJ);

                    $id_kel_tani = $kel_tani->id_kel_tani;
                    $nama_kel_tani=$conn->query("SELECT * from kel_tani where id_kel_tani='$id_kel_tani' ")->fetch(PDO::FETCH_OBJ);
                     ?>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kelompok Tani <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="kelompok_tani">
                          <option><?php
                                  if ($nama_kel_tani->nama_kel_tani=='') {
                                    echo "- Kelompok Tani -";
                                  }else{
                                  echo $nama_kel_tani->nama_kel_tani; }
                                  ?>
                          </option>

                          <?php
                          $nama_kel_tani=$conn->query("SELECT nama_kel_tani from kel_tani where kd_mu='$nama_mu->kd_mu' and aktif=1");
                          while ($data_keltani=$nama_kel_tani->fetch(PDO::FETCH_OBJ)) {
                           ?>
                          <option><?php echo $data_keltani->nama_kel_tani ?></option>
                          <?php
                          }
                           ?>
                        </select>

                      </div>
                    </div>
                    <!-- keanggotaan dalam kelompok -->
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Keanggotaan Dalam Kelompok <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" readonly="" name="keanggotaan_kelompok">
                          <option></option>
                        </select>
                      </div>
                    </div>
                    <!-- jenis kelamin -->
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jenis Kelamin <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="jenis_kel" readonly="">
                          <option><?php
                                  if ($jenis_kel=='') {
                                    echo "- Pilih Jenis Kelamin -";
                                  }else{
                                  echo $jenis_kel; }
                                  ?>
                          </option>
                          <option>Laki-laki</option>
                          <option>Perempuan</option>
                        </select>

                      </div>
                    </div>
                    <!-- umur -->
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Umur <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="umur" required="required" class="form-control col-md-7 col-xs-12" readonly="">
                      </div>
                    </div>
                    <!-- profesi -->
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Profesi <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="profesi">
                          <option><?php
                                  if ($data->profesi=='') {
                                    echo "- Pilih Profesi -";
                                  }else{
                                  echo $data->profesi; }
                                  ?>
                          </option>
                          <option>Petani</option>
                          <option>Karyawan / Pegawai</option>
                          <option>Wiraswasta / Pedagang</option>
                          <option>Lain-lain</option>

                        </select>

                      </div>
                    </div>
                    <!-- tujuan menanam pohon -->
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tujuan Menanam Pohon <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="tujuan" readonly="">
                          <option></option>
                        </select>
                      </div>
                    </div>
                    <!-- rencana penebangan -->
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Rencana Penebangan <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="rencana" readonly=" ">
                          <option></option>
                        </select>
                      </div>
                    </div>
                    <!-- pendapatan / tahun -->
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pendapatan / Tahun <span class="required red">*</span>
                      </label>
                      <div class="col-md-6">
                        <div class="col-md-4">
                        <label class="control-label">1. Petanian</label>
                        </div>
                        <div class="col-md-8">
                        <input type="text" name="pdp_tani" id="angka11" data-affixes-stay="true" data-prefix="Rp. " data-thousands="." data-decimal="," required="required" class="form-control col-md-3" value="<?php echo 'Rp. '.$data->pdpTani.',00' ?>"/>
                        </div>
                        <br>

                        <div class="col-md-4">
                        <label class="control-label">2. Perdagangan</label>
                        </div>
                        <div class="col-md-8">
                        <input type="text" name="pdp_dagang" id="angka12" data-affixes-stay="true" data-prefix="Rp. " data-thousands="." data-decimal="," required="required" class="form-control col-md-3" value="<?php echo 'Rp. '.$data->pdpDagang.',00' ?>"/>
                        </div>
                        <br>

                        <div class="col-md-4">
                        <label class="control-label">3. Pegawai</label>
                        </div>
                        <div class="col-md-8">
                        <input type="text" name="pdp_pegawai" id="angka13" data-affixes-stay="true" data-prefix="Rp. " data-thousands="." data-decimal="," required="required" class="form-control col-md-3" value="<?php echo 'Rp. '.$data->pdpPegawai.',00' ?>"/>
                        </div>
                        <br>

                        <div class="col-md-4">
                        <label class="control-label"> 4. Perkebunan</label>
                        </div>
                        <div class="col-md-8">
                      <input type="text" name="pdp_kebun" id="angka14" data-affixes-stay="true" data-prefix="Rp. " data-thousands="." data-decimal="," required="required" class="form-control col-md-3" value="<?php echo 'Rp. '.$data->pdpKebun.',00' ?>"/>
                        </div>
                        <br>

                        <div class="col-md-4">
                        <label class="control-label">5. Lainnya</label>
                        </div>
                        <div class="col-md-8">
                        <input type="text" name="pdp_lain" id="angka15" data-affixes-stay="true" data-prefix="Rp. " data-thousands="." data-decimal="," required="required" class="form-control col-md-3" value="<?php echo 'Rp. '.$data->pdpLain.',00' ?>"/>
                        </div>

                      </div>
                    </div>
                    <!-- persepsi tentang t4t -->
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Persepsi Tentang T4T <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="persepsi" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $data->persepsi ?>">
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
     <!-- pace -->
     <script src="../js/pace/pace.min.js"></script>
     <!-- maskmoney -->
     <script src="../js/maskmoney/jquery.maskMoney.min.js"></script>
     <?php for ($i=1; $i <= 5 ; $i++) {  ?>
     <script type="text/javascript">
     $(document).ready(function(){
       $('#angka1<?php echo $i ?>').maskMoney();
       // $('#angka2').maskMoney({prefix:'US$'});
       $('#angka3<?php echo $i ?>').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0});
       // $('#angka4').maskMoney();
     });
     </script>
     <?php } ?>
     <!-- input_mask -->
     <script>
         $(document).ready(function () {
             $("input").inputmask();
         });
     </script>
     <!-- /input mask -->
     <script type="text/javascript" charset="utf-8">
   	function fnHitung() {
   	var angka = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah(document.getElementById('inputku').value)))); //input ke dalam angka tanpa titik
   	if (document.getElementById('inputku').value == "") {
   		alert("Jangan Dikosongi");
   		document.getElementById('inputku').focus();
   		return false;
   	}
   	else
   		if (angka >= 1) {
   		alert("angka aslinya : "+angka);
   		document.getElementById('inputku').focus();
   		document.getElementById('inputku').value = tandaPemisahTitik(angka) ;
   		return false;
   		}
   	}
   	</script>

 </body>

 </html>
