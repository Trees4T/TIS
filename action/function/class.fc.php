<?php
  /**
   *
   */
  require_once 'dbcon.php';

  class Fc{

    public function __construct(){
        $database = new Database();
    		$db = $database->dbConnection();
    		$this->conn = $db;
    }

    public function list_desa($kode_fc){
        try {
          $stmt = $this->conn->prepare("SELECT * from t4t_lahan where kd_fc=? group by id_desa");
          $stmt->execute(array($kode_fc));
          while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
            $res[] = $data;
          }
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function list_keltani_perdesa($id_desa){
        try {
          $stmt = $this->conn->prepare("SELECT * from anggota_kel_tani where id_desa=? group by id_kel_tani");
          $stmt->execute(array($id_desa));
          while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
            $res[] = $data;
          }
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function list_keltani_anggota($id_desa,$id_kel_tani){
        try {
          $stmt = $this->conn->prepare("SELECT * from anggota_kel_tani where id_desa=? and id_kel_tani=?");
          $stmt->execute(array($id_desa,$id_kel_tani));
          while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
            $res[] = $data;
          }
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function data_kel_tani($id_kel_tani){
        try {
          $stmt = $this->conn->prepare("SELECT * from kel_tani where id_kel_tani=?");
          $stmt->execute(array($id_kel_tani));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function nama_desa($id_desa){
        try {
          $stmt = $this->conn->prepare("SELECT * from t4t_desa where id_desa=?");
          $stmt->execute(array($id_desa));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function lahan($id_lahan){
        try {
          $stmt = $this->conn->prepare("SELECT * from t4t_lahan where no=?");
          $stmt->execute(array($id_lahan));
          $res = $stmt->fetch();
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function rekapmon($id_desa,$no_lahan,$kd_petani){ //??????
        try {
          $stmt = $this->conn->prepare("SELECT * from t4t_rekapmon where id_desa=? and no_lahan=? and kd_petani=?");
          $stmt->execute(array($id_desa,$no_lahan,$kd_petani));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function nama_kec($id_kec){
        try {
          $stmt = $this->conn->prepare("SELECT * from t4t_kec where id_kec=?");
          $stmt->execute(array($id_kec));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function nama_kab($id_kab){
        try {
          $stmt = $this->conn->prepare("SELECT * from t4t_kab where kab_code=?");
          $stmt->execute(array($id_kab));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function nama_mu($kode_kabupaten,$kode_provinsi){
        try {
          $stmt = $this->conn->prepare("SELECT * from t4t_mu where kab_kode=? and prov_code=?");
          $stmt->execute(array($kode_kabupaten,$kode_provinsi));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function kode_kab_prov($nama_kab){
        try {
          $stmt = $this->conn->prepare("SELECT kab_code,prov_code FROM t4t_kab where nama=?");
          $stmt->execute(array($nama_kab));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function jml_part($id_desa){
        try {
          $stmt = $this->conn->prepare("SELECT count(*) as count from t4t_lahan where id_desa=?");
          $stmt->execute(array($id_desa));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function jml_kel_tani($id_desa){
        try {
          $stmt = $this->conn->prepare("SELECT count(distinct(id_kel_tani)) as count from anggota_kel_tani where id_desa=?");
          $stmt->execute(array($id_desa));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function jml_agg_kel_tani($id_desa,$id_kel_tani){
        try {
          $stmt = $this->conn->prepare("SELECT count(*) as count from anggota_kel_tani where id_desa=? and id_kel_tani=? group by id_kel_tani");
          $stmt->execute(array($id_desa,$id_kel_tani));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function jml_agg_lahan($id_desa,$id_kel_tani){
        try {
          $stmt = $this->conn->prepare("SELECT count(*) as count from t4t_lahan where id_desa=? and kd_petani=?");
          $stmt->execute(array($id_desa,$id_kel_tani));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function no_part($id_desa){
        try {
          $stmt = $this->conn->prepare("SELECT kd_petani as no from t4t_petani where id_desa=? order by kd_petani desc limit 1");
          $stmt->execute(array($id_desa));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function no_lahan($id_desa){
        try {
          $stmt = $this->conn->prepare("SELECT no_lahan AS no from t4t_lahan where id_desa=? order by no_lahan desc limit 1");
          $stmt->execute(array($id_desa));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function jml_tanam_rentanam($id_desa){
        try {
          $stmt = $this->conn->prepare("SELECT sum(jml_usulan) as jml from t4t_lahan where id_desa=?");
          $stmt->execute(array($id_desa));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function jml_tanam_realtanam($id_desa){
        try {
          $stmt = $this->conn->prepare("SELECT sum(jml_realisasi) as jml from t4t_lahan where id_desa=?");
          $stmt->execute(array($id_desa));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function ta_master($kode_ta){
        try {
          $stmt = $this->conn->prepare("SELECT * from t4t_tamaster where kd_ta=?");
          $stmt->execute(array($kode_ta));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function t4t_lahanpohon($no_t4tlahan,$mon){
        try {
          $stmt = $this->conn->prepare("SELECT * from t4t_lahanpohon where no_t4tlahan=? and mon=?");
          $stmt->execute(array($no_t4tlahan,$mon));
          while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
            $res[] =$data;
          }
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function kel_tani($kd_mu){
        try {
          $stmt = $this->conn->prepare("SELECT nama_kel_tani from kel_tani where kd_mu=? and aktif=1");
          $stmt->execute(array($kd_mu));
          while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
            $res[] =$data;
          }
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function tabel_partisipan($id_desa){
        try {
          $stmt = $this->conn->prepare("SELECT * from t4t_lahan where id_desa=?");
          $stmt->execute(array($id_desa));
          while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
            $res[] =$data;
          }
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function list_tahun_lahan($id_desa,$kode_ta){
        try {
          $stmt = $this->conn->prepare("SELECT * from t4t_lahan where id_desa=? and kd_ta=? group by thn_tanam order by thn_tanam desc");
          $stmt->execute(array($id_desa,$kode_ta));
          while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
            $res[] =$data;
          }
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function jml_tanam_rentanam_th($id_desa,$th){
        try {
          $stmt = $this->conn->prepare("SELECT sum(jml_usulan) as jml from t4t_lahan where id_desa=? and thn_tanam=?");
          $stmt->execute(array($id_desa,$th));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function jml_tanam_realtanam_th($id_desa,$th){
        try {
          $stmt = $this->conn->prepare("SELECT sum(jml_realisasi) as jml from t4t_lahan where id_desa=? and thn_tanam=?");
          $stmt->execute(array($id_desa,$th));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function list_lahan_th($id_desa,$kode_ta,$th){
        try {
          $stmt = $this->conn->prepare("SELECT * from t4t_lahan where id_desa=? and kd_ta=? and thn_tanam=?");
          $stmt->execute(array($id_desa,$kode_ta,$th));
          while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
            $res[] =$data;
          }
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function list_nama_part($id_desa){
        try {
          $stmt = $this->conn->prepare("SELECT kd_petani,nm_petani from t4t_petani where id_desa=? order by nm_petani");
          $stmt->execute(array($id_desa));
          while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
            $res[] =$data;
          }
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function list_silvil(){
        try {
          $stmt = $this->conn->prepare("SELECT * from t4t_typelahan");
          $stmt->execute();
          while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
            $res[] =$data;
          }
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function nama_silvi($id_lahan){
        try {
          $stmt = $this->conn->prepare("SELECT * from t4t_typelahan where id_lahan=? ");
          $stmt->execute(array($id_lahan));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function list_lahan_anggota($id_desa,$kd_petani){
        try {
          $stmt = $this->conn->prepare("SELECT * from t4t_lahan where id_desa=? and kd_petani=?");
          $stmt->execute(array($id_desa,$kd_petani));
          while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
            $res[] =$data;
          }
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    // public function list_lahan_anggota_tegakan($id_desa,$kd_petani){
    //     try {
    //       $stmt = $this->conn->prepare("SELECT * from t4t_lahan where id_desa=? and kd_petani=?");
    //       $stmt->execute(array($id_desa,$kd_petani));
    //       while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
    //         $res[] =$data;
    //       }
    //       return $res;
    //     } catch (PDOException $e) {
    //       echo $e->getMessage();
    //     }
    // }
    public function t4t_petani($id_desa,$kd_petani){
        try {
          $stmt = $this->conn->prepare("SELECT a.no,a.kd_petani,a.nm_petani,a.alamat,a.profesi,a.pdpTani,a.pdpDagang,a.pdpPegawai,a.pdpKebun,a.pdpLain,a.motif,a.persepsi,
a.budaya,a.id_desa,a.digawe,a.no_ktp,b.j_kel,b.tgl_lahir,b.foto from t4t_petani a left join t4t_petani_detail b on a.id_desa=b.id_desa
where a.id_desa=? and a.kd_petani=?");
          $stmt->execute(array($id_desa,$kd_petani));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function t4t_petani_detail($id_desa,$kd_petani){
        try {
          $stmt = $this->conn->prepare("SELECT * from t4t_petani_detail where id_desa=? and kd_petani=? ");
          $stmt->execute(array($id_desa,$kd_petani));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function t4t_pohon($id_pohon){
        try {
          $stmt = $this->conn->prepare("SELECT nama_pohon from t4t_pohon where id_pohon=?");
          $stmt->execute(array($id_pohon));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function list_pohon(){
        try {
          $stmt = $this->conn->prepare("SELECT * from t4t_pohon order by nama_pohon");
          $stmt->execute();
          while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
            $res[] =$data;
          }
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    public function back(){
      echo "javascript:history.back()";
    }


    ##### ACTION #####
    public function insert_partisipan($kd_petani,$nm_petani,$alamat,$profesi,$pdp_tani,$pdp_dagang,$pdp_pegawai,$pdp_kebun,$pdp_lain,$persepsi,$ktp,$id_desa,$tujuan){
        try {
          echo $wkt_buat = date("Y-m-d H:i:s");
          $stmt = $this->conn->prepare("INSERT into t4t_petani (kd_petani,nm_petani,alamat,profesi,pdpTani,pdpDagang,pdpPegawai,pdpKebun,pdpLain,persepsi,id_desa,digawe,no_ktp,motif)
          values (?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
          $stmt->execute(array($kd_petani,$nm_petani,$alamat,$profesi,$pdp_tani,$pdp_dagang,$pdp_pegawai,$pdp_kebun,$pdp_lain,$persepsi,$id_desa,$wkt_buat,$ktp,$tujuan));
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }

    public function insert_data_rencana_tanam($kd_fc,$kd_mu,$kd_ta,$id_desa,$no_lahan,$kd_petani,$no_gps,$no_doc,$status_lahan,$id_lahan,$luas_lahan,$id_pohon,$tutup_lahan,$jml_usulan,$kd_lahan){
        try {
          echo $tahun_tanam = date("Y");
          $stmt = $this->conn->prepare("INSERT into t4t_lahan (kd_fc,kd_mu,kd_ta,id_desa,no_lahan,kd_petani,noGPS,no_dok,status_lahan,id_lahan,luas_lahan,id_pohon,tutup_lahan,jml_usulan,thn_tanam,kd_lahan)
          values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
          $stmt->execute(array($kd_fc,$kd_mu,$kd_ta,$id_desa,$no_lahan,$kd_petani,$no_gps,$no_doc,$status_lahan,$id_lahan,$luas_lahan,$id_pohon,$tutup_lahan,$jml_usulan,$tahun_tanam,$kd_lahan));
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }

    public function insert_petani_detail($id_desa,$kd_petani,$foto,$j_kel,$tgl_lahir){
      try {
        $stmt = $this->conn->prepare("INSERT into t4t_petani_detail (id_desa,kd_petani,foto,j_kel,tgl_lahir)
        values (?,?,?,?,?) ");
        $stmt->execute(array($id_desa,$kd_petani,$foto,$j_kel,$tgl_lahir));
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }


  }//END CLASS





?>
