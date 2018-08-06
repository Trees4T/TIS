<?php
  /**
   *
   */
  require_once 'dbcon.php';

  class Office{

    public function __construct(){
        $database = new Database();
    		$db = $database->dbConnection();
    		$this->conn = $db;
    }

    public function cek_nosh($kode,$tgl){
        try {
          $stmt = $this->conn->prepare("SELECT floor(substr(no_shipment,12,10)) as no_sh from t4t_shipment where id_comp='$kode' and no_shipment like '%$tgl%' order by no_sh desc limit 1");
          $stmt->execute(array($kode,$tgl));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }

    public function wkt_order(){
      try {
        $stmt = $this->conn->prepare("SELECT wkt_order from t4t_order order by wkt_order limit 1");
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function cek_ship_relation_buyer($ship){
      try {
        $stmt = $this->conn->prepare("SELECT buyer,relation from t4t_shipment where no_shipment=?");
        $stmt->execute(array($ship));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function nama_relation_buyer($id_part,$repeat_id){
      try {
        $stmt = $this->conn->prepare("SELECT a.id_part,a.related_part,a.repeat_id,b.name FROM t4t_idrelation a, t4t_participant b
          WHERE a.related_part=b.id AND a.id_part=? AND a.repeat_id=?");
        $stmt->execute(array($id_part,$repeat_id));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function mkt_rep_contrib($id_part,$date_awal,$date_akhir){
      try {
        $stmt = $this->conn->query("SELECT * FROM t4t_shipment WHERE id_comp='$id_part' AND wkt_shipment BETWEEN '$date_awal%' AND '$date_akhir%'");
        $stmt->execute();
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function mkt_rep_sponsor($id_part,$date_awal,$date_akhir){
      try {
        $stmt = $this->conn->query("SELECT w.wins, h.petani, h.jml_phn, p.nama_pohon
          FROM `t4t_wins` w
          LEFT JOIN `t4t_shipment` s ON w.bl=s.bl
          LEFT JOIN `t4t_htc` h ON w.bl=h.bl
          LEFT JOIN t4t_lahan l ON h.kd_lahan=l.kd_lahan
          LEFT JOIN t4t_pohon p ON l.id_pohon2=p.id_pohon
          WHERE s.id_comp='$id_part' AND wkt_shipment BETWEEN '$date_awal%' AND '$date_akhir%' ");
        $stmt->execute();
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function mkt_rep_supplier($id_part,$date_awal,$date_akhir){
      try {
        $stmt = $this->conn->query("SELECT w.wins, w.bl, h.petani, h.jml_phn, pt.name
          FROM `t4t_wins` w
          LEFT JOIN `t4t_shipment` s ON w.bl=s.bl
          LEFT JOIN `t4t_htc` h ON w.bl=h.bl
          LEFT JOIN t4t_lahan l ON h.kd_lahan=l.kd_lahan
          LEFT JOIN t4t_pohon p ON l.id_pohon2=p.id_pohon
          LEFT JOIN t4t_idrelation i ON s.buyer=i.repeat_id
          LEFT JOIN t4t_participant pt ON i.related_part=pt.id
          WHERE s.id_comp='$id_part' AND s.relation=1
          AND wkt_shipment BETWEEN '$date_awal%' AND '$date_akhir%' limit 10");
        $stmt->execute();
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function mkt_rep_order_ship($id_part,$date_awal,$date_akhir,$search,$nomor){
      try {

        if ($search=='Order No.') {
          $stmt = $this->conn->query("SELECT o.`no_order`, o.`wkt_order`, ow.`wkt_kirim`, o.`jml_wins`, o.`wins1`, o.`wins2`
            FROM t4t_order o
            LEFT JOIN t4t_orderwkt ow ON o.`no_order`=ow.`no_order`
            WHERE id_comp='$id_part' AND wkt_order BETWEEN '$date_awal' AND '$date_akhir' AND o.`no_order`='$nomor'");
        }elseif ($search=='Shipment No.') {
          $stmt = $this->conn->query("SELECT no_order, wins_used, wkt_shipment, no_shipment, bl FROM t4t_shipment
            WHERE no_shipment='$nomor'");
        }elseif ($search=='BL No.') {
          # code...
        }elseif ($search=='') {
          $stmt = $this->conn->query("SELECT o.`no_order`, o.`wkt_order`, ow.`wkt_kirim`, o.`jml_wins`, o.`wins1`, o.`wins2`
            FROM t4t_order o
            LEFT JOIN t4t_orderwkt ow ON o.`no_order`=ow.`no_order`
            WHERE id_comp='$id_part' AND wkt_order BETWEEN '$date_awal' AND '$date_akhir' ");
        }

        $stmt->execute(array());
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function report_ordership_detail($id_part,$search,$nomor){
      try {
        // echo $nomor;
        if ($search=='Order No.') {
          $stmt = $this->conn->query("SELECT * FROM t4t_shipment WHERE id_comp='$id_part' and no_order LIKE '$nomor, %' OR '% $nomor, %' OR '%, $nomor'");
        }elseif ($search=='Shipment No.') {
          $stmt = $this->conn->query("SELECT * FROM t4t_order WHERE id_comp='$id_part' and no_order='$nomor'");
        }elseif ($search=='BL No.') {
          # code...
        }elseif ($search=='') {
          $stmt = $this->conn->query("SELECT * FROM t4t_shipment WHERE id_comp='$id_part' and no_order LIKE '$nomor, %' OR '% $nomor, %' OR '%, $nomor'");
        }

        $stmt->execute(array());
        if ($search=='Shipment No.') {
          $res = $stmt->fetch(PDO::FETCH_OBJ);
        }else{
          while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
            $res[] =$data;
          }
        }

        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function report_ordership_orderwkt($nomor){
      try {
        $stmt = $this->conn->prepare("SELECT * FROM t4t_orderwkt WHERE no_order=?");
        $stmt->execute(array($nomor));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function nama_retailer($id_comp,$kode_retailer){
      try {
        $stmt = $this->conn->prepare("SELECT a.related_part,b.name FROM t4t_idrelation a JOIN t4t_participant b ON a.related_part=b.id
                                      WHERE repeat_id=? AND id_part=?");
        $stmt->execute(array($kode_retailer,$id_comp));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function report_ordership_hangtags($nomor){
      try {
        $stmt = $this->conn->prepare("SELECT jml_wins FROM t4t_order WHERE no_order=?");
        $stmt->execute(array($nomor));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function explode_wkt_order($wkt_order){
      $ex_w_order = explode("-",$wkt_order);

      return $ex_w_order[0];
    }

    public function data_order_list($cond){
      try {
        $stmt = $this->conn->prepare("SELECT a.no, a.wkt_order, a.no_order, a.jml_wins, a.acc, a.tipe_prod, a.wins1, a.wins2, a.kota_tujuan, a.id_comp,b.name
        FROM t4t_order a JOIN t4t_participant b
        ON a.id_comp=b.id
        WHERE a.acc=?  ");
        $stmt->execute(array($cond));
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function no_order_shipment_yet_list($select_year){
      try {
        $stmt = $this->conn->prepare("SELECT no_order, wkt_order, id_comp, acc from t4t_order where wkt_order like '%$select_year%' ");
        $stmt->execute(array($select_year));
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function cek_no_order_shipment_yet($no_order){
      try {
        $stmt = $this->conn->prepare("SELECT no_shipment from t4t_shipment where no_order like '$no_order%' or no_order like '%, $no_order%' limit 1");
        $stmt->execute(array($no_order));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function data_member($id){
      try {
        $stmt = $this->conn->prepare("SELECT * from t4t_participant where id=?");
        $stmt->execute(array($id));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function data_member_list(){
      try {
        $stmt = $this->conn->prepare("SELECT * FROM t4t_participant ORDER BY name");
        $stmt->execute(array());
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function data_member_list_tipe($type){
      try {
        $stmt = $this->conn->prepare("SELECT * FROM t4t_participant where type=? ORDER BY name");
        $stmt->execute(array($type));
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function pohon_list(){
      try {
        $stmt = $this->conn->prepare("SELECT * from t4t_pohonen");
        $stmt->execute(array());
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function req_list(){
      try {
        $stmt = $this->conn->prepare("SELECT * from t4t_req");
        $stmt->execute(array());
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function order_list($kode){
      try {
        $stmt = $this->conn->prepare("SELECT no_order from t4t_order where id_comp='$kode' and acc=1 order by no desc");
        $stmt->execute(array($kode));
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function container_list(){
      try {
        $stmt = $this->conn->prepare("SELECT * from t4t_container");
        $stmt->execute(array());
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function type_part_list(){
      try {
        $stmt = $this->conn->prepare("SELECT * FROM t4t_participant GROUP BY TYPE ORDER BY TYPE ");
        $stmt->execute(array());
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function retailer_list($id){ //menggunakan table lama
      try {
        $stmt = $this->conn->prepare("SELECT * from t4t_retailer where id_partisipan='$id'");
        $stmt->execute(array($id));
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function retailer_list2($id){
      try {
        $stmt = $this->conn->prepare("SELECT a.no,a.id_part,a.related_part,a.repeat_id,b.* from t4t_idrelation a, t4t_participant b where a.related_part=b.id and a.id_part=?");
        $stmt->execute(array($id));
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function cek_retailer($id){ //menggunakan table lama
      try {
        $stmt = $this->conn->prepare("SELECT kode_retailer from t4t_retailer where id_partisipan='$id'");
        $stmt->execute(array($id));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function cek_relation($id){
      try {
        $stmt = $this->conn->prepare("SELECT * from t4t_idrelation where id_part='$id' limit 1");
        $stmt->execute(array($id));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function cek_id_comp($type){
      try {
        $stmt = $this->conn->prepare("SELECT SUBSTRING(id, 3, 3) AS nomor from t4t_participant where id like '%$type%' order by no desc limit 1");
        $stmt->execute(array($type));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function wkt_shipment_pertama($kode){
      try {
        $stmt = $this->conn->prepare("SELECT wkt_shipment from t4t_shipment where id_comp='$kode' and acc=1 order by wkt_shipment limit 1");
        $stmt->execute(array($kode));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function wkt_order_pertama($kode){
      try {
        $stmt = $this->conn->prepare("SELECT substr(wkt_order,1,4) as th from t4t_order where id_comp='$kode' order by th limit 1");
        $stmt->execute(array($kode));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    ##### member dash #####
    public function jml_unpaid($kode){
      try {
        $stmt = $this->conn->prepare("SELECT count(*) as jml from t4t_shipment where id_comp='$kode' and acc_paid=0 ");
        $stmt->execute(array($kode));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function jml_win($kode){
      try {
        $stmt = $this->conn->prepare("SELECT count(*) as jml from t4t_wins where id_part='$kode' and bl!='' and no_shipment!='' ");
        $stmt->execute(array($kode));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }
    ##### end member dash #####

    public function cek_no_order($bln,$thn){
      try {
        $stmt = $this->conn->prepare("SELECT no_order from t4t_order where no_order like '%T4T-E/$bln/$thn%' ORDER BY no desc limit 1 ");
        $stmt->execute(array($bln,$thn));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }
    function encryptWIN($win){    $theSource = Array("8","v","w","M","P","I","N","o","Z","h","g","_","u","W","D","-","b","O","k","a","G","t","U","j","6","7","K","A","r","y","l","5","X","p","n","z","F","4","Y","d","2","9","q","V","s","0",".","e","H","c","x","Q","B","S");    	$r = '';    	while ($win>0){    		$num = $win % 53;    		$win = ($win - $num) / 53;    		$r .= $theSource[$num];    	}    	return $r;    }    function decryptWIN($crypted){    $win = 0;    $theSource = Array("8","v","w","M","P","I","N","o","Z","h","g","_","u","W","D","-","b","O","k","a","G","t","U","j","6","7","K","A","r","y","l","5","X","p","n","z","F","4","Y","d","2","9","q","V","s","0",".","e","H","c","x","Q","B","S");    $theSource = array_flip($theSource);    	$i = strlen($crypted);    	while ($i>0){    		$i--;    		$win = $win * 53 + $theSource[$crypted[$i]];    	}    	return $win;    }
    ## ACTION ##
    public function insert_member($id,$tipe,$nama,$alamat,$tlp,$fax,$email,$email2,$email3,$website,$direktur,$pic,$bhn_utama,$header,$introduction,$jml_outlet,$wkt_isi){
        try {
          $stmt = $this->conn->prepare("INSERT into t4t_partisipan (id,tipe,nama,alamat,tlp,fax,email,email2,email3,website,direktur,pic,bhn_utama,header,introduction,jml_outlet,wkt_isi)
          values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
          $stmt->execute(array($id,$tipe,$nama,$alamat,$tlp,$fax,$email,$email2,$email3,$website,$direktur,$pic,$bhn_utama,$header,$introduction,$jml_outlet,$wkt_isi));
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }

    public function insert_member2($id,$tipe,$nama,$alamat,$tlp,$fax,$email,$email2,$email3,$website,$direktur,$pic,$bhn_utama,$header,$introduction,$jml_outlet,$wkt_isi){
        try {
          $stmt = $this->conn->prepare("INSERT into t4t_participant (id,type,name,address,phone,fax,email,email1,email2,website,director,pic,material,header,introduction,outlet_qty,date_join)
          values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
          $stmt->execute(array($id,$tipe,$nama,$alamat,$tlp,$fax,$email,$email2,$email3,$website,$direktur,$pic,$bhn_utama,$header,$introduction,$jml_outlet,$wkt_isi));
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }

    public function update_member($id,$nama,$alamat,$tlp,$fax,$email,$email2,$email3,$website,$direktur,$pic,$bhn_utama,$header,$introduction,$jml_outlet){
        try {
          $stmt = $this->conn->prepare("UPDATE t4t_partisipan set nama=:nama, alamat=:alamat, tlp=:tlp, fax=:fax, email=:email, email2=:email2, email3=:email3, website=:web, direktur=:dir, pic=:pic, bhn_utama=:bhn, header=:head, introduction=:intro, jml_outlet=:outlet where id=:id ");

          $stmt->execute(array(
            ":id"=>$id,
            ":nama"=>$nama,
            ":alamat"=>$alamat,
            ":tlp"=>$tlp,
            ":fax"=>$fax,
            ":email"=>$email,
            ":email2"=>$email2,
            ":email3"=>$email3,
            ":web"=>$website,
            ":dir"=>$direktur,
            ":pic"=>$pic,
            ":bhn"=>$bhn_utama,
            ":head"=>$header,
            ":intro"=>$introduction,
            ":outlet"=>$jml_outlet
          ));

          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }

    public function update_member2($id,$nama,$alamat,$tlp,$fax,$email,$email2,$email3,$website,$direktur,$pic,$bhn_utama,$header,$introduction,$jml_outlet){
        try {
          $stmt = $this->conn->prepare("UPDATE t4t_participant set name=:nama, address=:alamat, phone=:tlp, fax=:fax, email=:email, email1=:email2, email2=:email3, website=:web, director=:dir, pic=:pic, material=:bhn, header=:head, introduction=:intro, outlet_qty=:outlet where id=:id ");

          $stmt->execute(array(
            ":id"=>$id,
            ":nama"=>$nama,
            ":alamat"=>$alamat,
            ":tlp"=>$tlp,
            ":fax"=>$fax,
            ":email"=>$email,
            ":email2"=>$email2,
            ":email3"=>$email3,
            ":web"=>$website,
            ":dir"=>$direktur,
            ":pic"=>$pic,
            ":bhn"=>$bhn_utama,
            ":head"=>$header,
            ":intro"=>$introduction,
            ":outlet"=>$jml_outlet
          ));

          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }

  }//END CLASS





?>