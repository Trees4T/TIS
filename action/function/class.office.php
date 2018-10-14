<?php
  /**
   *
   */
  require_once 'dbcon.php';

  class Office {

    public function __construct(){
        $database = new Database();
    		$db = $database->dbConnection();
    		$this->conn = $db;
    }

    public function back(){
      echo "javascript:history.back()";
    }

    public function current_link(){
      $actual_link0 = "$_SERVER[REQUEST_URI]";
      $actual_link1 = explode("?", $actual_link0);
      $actual_link  = $actual_link1[1];
      return $actual_link;
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

    public function pm_manufacture(){
      try {
        $stmt = $this->conn->prepare("SELECT
        `a`.`no`          AS `id_mapdata`,
        `c`.`id`          AS `id_part`,
        `a`.`no_shipment` AS `id_shipment`,
        `c`.`name`        AS `name`,
        `a`.`geo`         AS `geo`,
        LEFT(`a`.`geo`,(LOCATE('E',`a`.`geo`) - 1)) AS `latitude_dms`,
        SUBSTR(`a`.`geo`,LOCATE('E',`a`.`geo`),15) AS `longitude_dms`,
        `DMS2DEC`(LEFT(`a`.`geo`,(LOCATE('E',`a`.`geo`) - 1)))  AS `latitude`,
        `DMS2DEC`(SUBSTR(`a`.`geo`,LOCATE('E',`a`.`geo`),15))  AS `longitude`,
          `a`.`jml_phn`     AS `total_trees`,
          `e`.`nama_latin`  AS `species`,
          `a`.`luas`        AS `area`,
          `a`.`desa`        AS `village`,
          `a`.`ta`          AS `district`,
          `a`.`mu`          AS `municipality`,
          `a`.`petani`      AS `farmer`,
          `d`.`thn_tanam`   AS `planting_year`
        FROM ((((`t4t_t4t`.`t4t_htc` `a`
            LEFT JOIN `t4t_t4t`.`t4t_lahan` `d`
              ON ((`a`.`geo` = `d`.`koordinat`)))
            JOIN `t4t_t4t`.`t4t_pohon` `e`
              ON ((`d`.`id_pohon2` = `e`.`id_pohon`)))
            LEFT JOIN `t4t_t4t`.`t4t_shipment` `f`
              ON ((`a`.`bl` = `f`.`bl`)))
            LEFT JOIN `t4t_t4t`.`t4t_participant` `c`
              ON ((`f`.`id_comp` = `c`.`id`))) ");
        $stmt->execute(array());
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function pm_retailer(){
      try {
        $stmt = $this->conn->prepare("SELECT
            a.`no` AS `id_mapdata`,
            b.`id_part` AS `id_part`,
            a.`no_shipment` AS `id_shipment`,
            c.`name` AS `name`,
            a.`geo` AS `geo`,
            LEFT(a.geo,(LOCATE('E',a.geo) - 1)) AS `latitude_dms`,
            SUBSTR(a.geo,LOCATE('E',a.geo),15) AS `longitude_dms`,
            `DMS2DEC`(LEFT(a.geo,(LOCATE('E',a.geo) - 1)))  AS `latitude`,
            `DMS2DEC`(SUBSTR(a.geo,LOCATE('E',a.geo),15))  AS `longitude`,
            a.`jml_phn` AS `total_trees`,
            e.`nama_latin` AS `species`,
            a.`luas` AS `area`,
            a.`desa` AS `village`,
            a.`ta` AS `district`,
            a.`mu` AS `municipality`,
            a.`petani` AS `farmer`,
            d.`thn_tanam` AS `planting_year`

          FROM t4t_t4t.t4t_htc a
          LEFT JOIN t4t_t4t.`t4t_lahan` d
            ON a.geo=d.koordinat
          JOIN t4t_t4t.`t4t_pohon` e
            ON d.id_pohon2=e.id_pohon
          LEFT JOIN t4t_t4t.`t4t_shipment` f
            ON a.bl=f.bl
          LEFT JOIN t4t_web.`view_winbatch` b
            ON a.no_shipment=b.win_batch
          LEFT JOIN t4t_t4t.`t4t_participant` c
            ON b.id_part=c.id ");
        $stmt->execute(array());
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function pm2_manufacture(){
      try {
        $stmt = $this->conn->prepare("SELECT
        `a`.`no`          AS `id_mapdata`,
        `c`.`id`          AS `id_part`,
        `a`.`no_shipment` AS `id_shipment`,
        `c`.`name`        AS `name`,
        `a`.`geo`         AS `geo`,
          SUM(a.`jml_phn`) AS `total_trees`,
          `e`.`nama_latin`  AS `species`,
          `a`.`luas`        AS `area`,
          `a`.`desa`        AS `village`,
          `a`.`ta`          AS `district`,
          `a`.`mu`          AS `municipality`,
          `a`.`petani`      AS `farmer`,
          `d`.`thn_tanam`   AS `planting_year`
        FROM ((((`t4t_t4t`.`t4t_htc` `a`
            LEFT JOIN `t4t_t4t`.`t4t_lahan` `d`
              ON ((`a`.`geo` = `d`.`koordinat`)))
            JOIN `t4t_t4t`.`t4t_pohon` `e`
              ON ((`d`.`id_pohon2` = `e`.`id_pohon`)))
            LEFT JOIN `t4t_t4t`.`t4t_shipment` `f`
              ON ((`a`.`bl` = `f`.`bl`)))
            LEFT JOIN `t4t_t4t`.`t4t_participant` `c`
              ON ((`f`.`id_comp` = `c`.`id`)))

        GROUP BY c.`id`,a.`geo`
		    ORDER BY a.`no`");
        $stmt->execute(array());
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function pm2_retailer(){
      try {
        $stmt = $this->conn->prepare("SELECT
            a.`no` AS `id_mapdata`,
            b.`id_part` AS `id_part`,
            a.`no_shipment` AS `id_shipment`,
            c.`name` AS `name`,
            a.`geo` AS `geo`,
            SUM(a.`jml_phn`) AS `total_trees`,
            e.`nama_latin` AS `species`,
            a.`luas` AS `area`,
            a.`desa` AS `village`,
            a.`ta` AS `district`,
            a.`mu` AS `municipality`,
            a.`petani` AS `farmer`,
            d.`thn_tanam` AS `planting_year`

          FROM t4t_t4t.t4t_htc a
          LEFT JOIN t4t_t4t.`t4t_lahan` d
            ON a.geo=d.koordinat
          JOIN t4t_t4t.`t4t_pohon` e
            ON d.id_pohon2=e.id_pohon
          LEFT JOIN t4t_t4t.`t4t_shipment` f
            ON a.bl=f.bl
          LEFT JOIN t4t_web.`view_winbatch` b
            ON a.no_shipment=b.win_batch
          LEFT JOIN t4t_t4t.`t4t_participant` c
            ON b.id_part=c.id

            GROUP BY b.`id_part`,a.`geo`
            ORDER BY a.`no`");
        $stmt->execute(array());
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
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
        $stmt = $this->conn->prepare("SELECT buyer,relation,wins_used from t4t_shipment where no_shipment=?");
        $stmt->execute(array($ship));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function nama_relation_buyer($id_part,$no){
      try {

          $stmt = $this->conn->prepare("SELECT a.id_part,a.related_part,a.repeat_id,b.name FROM t4t_idrelation a, t4t_participant b
            WHERE a.related_part=b.id AND a.id_part=? AND a.no=?");

        $stmt->execute(array($id_part,$no));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function first_shipment(){
      try {
        $stmt = $this->conn->prepare("SELECT * FROM t4t_shipment ORDER BY wkt_shipment LIMIT 1");
        $stmt->execute(array());
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function mkt_rep_contrib($id_part,$date_awal,$date_akhir){
      try {
        $stmt = $this->conn->query("SELECT * FROM t4t_shipment WHERE id_comp='$id_part' AND date(wkt_shipment) BETWEEN '$date_awal%' AND '$date_akhir%'");
        $stmt->execute();
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function mkt_rep_wincheck($id_part,$date_awal,$date_akhir){
      try {
        $stmt = $this->conn->query("SELECT * FROM t4t_web.`view_wincheck_log` WHERE id_part='$id_part' AND date(search_date) BETWEEN '$date_awal%' AND '$date_akhir%'");
        $stmt->execute();
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function api_lahan_per_wins($wins,$key){
      try {

        $stmt = $this->conn->query("SELECT * FROM t4t_web.`planting_maps` WHERE id_shipment IN (
                SELECT no_shipment FROM t4t_t4t.t4t_wins WHERE wins='$wins' ) AND id_part IN (
                SELECT id_part FROM t4t_t4t.api WHERE api_key='$key' )");
        $stmt->execute($wins,$key);
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function mkt_ar_status_total($date){
      try {
        $ex_date = explode("-", $date);
        $date1_format = $ex_date[0];
         $date1 = date("Y-m-d", strtotime($date1_format));
        $date2_format = $ex_date[1];
         $date2 = date("Y-m-d", strtotime($date2_format));

        $stmt = $this->conn->prepare("SELECT SUM(item_qty) as total FROM t4t_shipment
                                      WHERE DATE(wkt_shipment) BETWEEN '$date1' AND '$date2' AND acc_paid=1");
        $stmt->execute(array());
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function mkt_ar_status($limit,$date){
      try {
        $ex_date = explode("-", $date);
        $date1_format = $ex_date[0];
         $date1 = date("Y-m-d", strtotime($date1_format));
        $date2_format = $ex_date[1];
         $date2 = date("Y-m-d", strtotime($date2_format));

          $stmt = $this->conn->query("SELECT p.name as name,s.id_comp,SUM(s.item_qty) AS jml,s.wkt_shipment,s.tgl_paid,s.acc_paid,
                              	IFNULL(DATEDIFF(s.tgl_paid, s.wkt_shipment),0) AS selisih
                               FROM t4t_shipment s LEFT JOIN t4t_participant p
                               ON s.id_comp=p.id
                               WHERE DATE(wkt_shipment) BETWEEN '$date1' AND '$date2' AND s.acc_paid=1

                               GROUP BY id_comp
                               ORDER BY jml DESC
                               LIMIT $limit");

        $stmt->execute(array());
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function mkt_ar_status_jumlah($limit,$kondisi,$id_part,$date){
      try {
        $ex_date = explode("-", $date);
        $date1_format = $ex_date[0];
         $date1 = date("Y-m-d", strtotime($date1_format));
        $date2_format = $ex_date[1];
         $date2 = date("Y-m-d", strtotime($date2_format));

          if ($kondisi=="30") {
            $value = "<=30";
          }elseif ($kondisi=="60") {
            $value = " between 31 and 60";
          }elseif ($kondisi=="90") {
            $value = ">60";
          }

          $stmt = $this->conn->query("SELECT SUM(s.item_qty) AS jml,s.bl,s.id_comp,s.wkt_shipment,s.item_qty,s.tgl_paid,s.acc_paid,
                  IFNULL(DATEDIFF(s.tgl_paid, s.wkt_shipment),0) AS selisih,p.name
                  FROM t4t_shipment s LEFT JOIN t4t_participant p ON s.id_comp=p.id
                  WHERE DATE(s.wkt_shipment) BETWEEN '$date1' AND '$date2' AND s.acc_paid=1
                  AND DATEDIFF(s.tgl_paid, s.wkt_shipment)$value and s.id_comp='$id_part' GROUP BY id_comp order by jml desc limit $limit");

        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function mkt_dash_top5contrib($limit,$date){
      try {
        $ex_date = explode("-", $date);
        $date1_format = $ex_date[0];
         $date1 = date("Y-m-d", strtotime($date1_format));
        $date2_format = $ex_date[1];
         $date2 = date("Y-m-d", strtotime($date2_format));
        $stmt = $this->conn->query("SELECT SUM(a.fee) AS fee,a.id_comp, b.`name`
                                    FROM t4t_shipment a JOIN t4t_participant b
                                     ON a.`id_comp`=b.`id`
                                    WHERE date(a.tgl_paid) BETWEEN '$date1%' AND '$date2%' and acc_paid=1
                                    GROUP BY a.id_comp ORDER BY fee DESC LIMIT $limit
                                    ");
        $stmt->execute($limit);
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function mkt_dash_wins_ordered($date){
      try {

        $stmt = $this->conn->query("SELECT IFNULL(SUM(jml_wins),0) AS win FROM t4t_order WHERE date(wkt_order) LIKE '$date%'");
        $stmt->execute(array());
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function mkt_dash_sumfee($date){
      try {
        $ex_date = explode("-", $date);
        $date1_format = $ex_date[0];
         $date1 = date("Y-m-d", strtotime($date1_format));
        $date2_format = $ex_date[1];
         $date2 = date("Y-m-d", strtotime($date2_format));

        if ($date!="") {
          $stmt = $this->conn->query("SELECT SUM(fee) AS fee FROM t4t_shipment where date(wkt_shipment) BETWEEN '$date1' and '$date2'");
        }else{
          $stmt = $this->conn->query("SELECT SUM(fee) AS fee FROM t4t_shipment");
        }

        $stmt->execute(array());
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function mkt_jml_wins_by_month($tanggal){
      try {
        // if ($status=="awal") {
        //    $tanggal2 = date("Y-m", strtotime($tanggal));
        //    $stmt = $this->conn->query("SELECT * FROM t4t_order WHERE wkt_order BETWEEN '$tanggal' AND '$tanggal2-31'");
        // }
        $tanggal2 = date("Y-m", strtotime($tanggal));

          $stmt = $this->conn->query("SELECT IFNULL(SUM(jml_wins), 0) AS qty FROM t4t_order WHERE wkt_order like '$tanggal2%' ");

        $stmt->execute(array());
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function mkt_order_jml_order($cari,$date){
      try {
        $ex_date = explode("-", $date);
        $date1_format = $ex_date[0];
         $date1 = date("Y-m-d", strtotime($date1_format));
        $date2_format = $ex_date[1];
         $date2 = date("Y-m-d", strtotime($date2_format));

        if ($cari=='recieved') {
          $stmt = $this->conn->query("SELECT COUNT(*) as jml_order FROM t4t_order WHERE date(wkt_order) BETWEEN '$date1' AND '$date2'");
        }elseif($cari=='shipped'){
          $stmt = $this->conn->query("SELECT COUNT(*) as jml_order FROM t4t_order WHERE date(wkt_order) BETWEEN '$date1' AND '$date2' and acc=1");
        }

        $stmt->execute(array());
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function mkt_order_jml_wins($cari,$date){
      try {
        $ex_date = explode("-", $date);
        $date1_format = $ex_date[0];
         $date1 = date("Y-m-d", strtotime($date1_format));
        $date2_format = $ex_date[1];
         $date2 = date("Y-m-d", strtotime($date2_format));

        if ($cari=='recieved') {
          $stmt = $this->conn->query("SELECT sum(jml_wins) as win FROM t4t_order WHERE date(wkt_order) BETWEEN '$date1' AND '$date2'");
        }elseif($cari=='shipped'){
          $stmt = $this->conn->query("SELECT sum(jml_wins) as win FROM t4t_order WHERE date(wkt_order) BETWEEN '$date1' AND '$date2' and acc=1");
        }

        $stmt->execute(array());
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function mkt_shipments($cari,$date){
      try {
        $ex_date = explode("-", $date);
        $date1_format = $ex_date[0];
         $date1 = date("Y-m-d", strtotime($date1_format));
        $date2_format = $ex_date[1];
         $date2 = date("Y-m-d", strtotime($date2_format));

        if ($cari=='shipment') {
          $stmt = $this->conn->query("SELECT COUNT(*) as ship FROM t4t_shipment WHERE date(wkt_shipment) BETWEEN '$date1%' AND '$date2%'");
        }elseif($cari=='tree'){
          $stmt = $this->conn->query("SELECT SUM(jml_phn) as tree FROM t4t_htc WHERE no_shipment IN
            (
             SELECT no_shipment FROM t4t_shipment WHERE date(wkt_shipment) BETWEEN '$date1%' AND '$date2%'
            )");
        }

        $stmt->execute(array());
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function mkt_shipments_trees($date){
      try {
          $stmt = $this->conn->query("SELECT SUM(jml_phn) as tree FROM t4t_htc WHERE no_shipment IN
            (
             SELECT no_shipment FROM t4t_shipment WHERE wkt_shipment LIKE '$date%'
            )");

        $stmt->execute(array());
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function mkt_dash_contrib($cari,$pilihan,$date){
      try {
        $ex_date = explode("-", $date);
        $date1_format = $ex_date[0];
         $date1 = date("Y-m-d", strtotime($date1_format));
        $date2_format = $ex_date[1];
         $date2 = date("Y-m-d", strtotime($date2_format));

          if ($pilihan=="payment") {
            $pilihan = "IFNULL(SUM(fee),0) as fee";
          }elseif ($pilihan=="shipment") {
            $pilihan = "count(*) as count";
          }

          if ($cari=="shipment") {
            $trans = "trans_type=1";
          }elseif ($cari=="donation2") {
            $trans = "trans_type=2";
          }elseif ($cari=="donation3") {
            $trans = "trans_type=3";
          }elseif ($cari="sponsor"){
            $trans = "trans_type=4";
          }
          $stmt = $this->conn->query("SELECT $pilihan FROM t4t_shipment WHERE acc_paid=1 AND no_shipment IN
                  (
                	SELECT no_shipment FROM t4t_wins WHERE bl IN (
                	 SELECT bl FROM t4t_shipment WHERE date(wkt_shipment) BETWEEN '$date1%' AND '$date2%'
                	)
                  AND $trans GROUP BY no_shipment
                  )");

        $stmt->execute(array());
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function mkt_dash_contrib_total($cari,$date){
      try {
        $ex_date = explode("-", $date);
        $date1_format = $ex_date[0];
         $date1 = date("Y-m-d", strtotime($date1_format));
        $date2_format = $ex_date[1];
         $date2 = date("Y-m-d", strtotime($date2_format));

          if ($cari=="payment") {
            $select = "SUM(fee) as totfee";
          }elseif($cari=="shipment"){
            $select = "count(*) as count";
          }
          $stmt = $this->conn->query("SELECT $select FROM t4t_shipment WHERE date(wkt_shipment) BETWEEN '$date1%' AND '$date2%' AND acc_paid=1");

        $stmt->execute(array());
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function mkt_rep_sponsor($id_part,$date_awal,$date_akhir){
      try {
        $stmt = $this->conn->query("SELECT * from mkt_rep_sponsor
          WHERE id_comp='$id_part' AND date(wkt_shipment) BETWEEN '$date_awal%' AND '$date_akhir%' ");
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
        $stmt = $this->conn->query("SELECT * from mkt_rep_supplier
          WHERE id_comp='$id_part'
          AND date(wkt_shipment) BETWEEN '$date_awal%' AND '$date_akhir%'");
        $stmt->execute();
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function mkt_rep_ordership($id_part,$d_awal,$d_akhir){
      try {

        $stmt = $this->conn->prepare("SELECT * FROM t4t_order WHERE id_comp='$id_part' AND date(wkt_order) BETWEEN ? AND ?");

        $stmt->execute(array($d_awal,$d_akhir));
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }

    }

    public function datetime_to_date($date){
      $date0 = explode(" ", $date);
      $tanggal = $date0[0];

      return $tanggal;
    }

    public function get_iplocation($IPaddr){

      if ($IPaddr == "") {
          return 0;
      } else {
          $ips = explode(".", "$IPaddr");
          $ip_long = ($ips[3] + $ips[2] * 256 + $ips[1] * 256 * 256 + $ips[0] * 256 * 256 * 256);

          try {

            $stmt = $this->conn->query("SELECT * FROM ip_location
              WHERE ip_from <= '$ip_long' AND ip_to >= '$ip_long' ");

            $stmt->execute(array($ip_long));
            $res = $stmt->fetch(PDO::FETCH_OBJ);
            return $res;
          } catch (PDOException $e) {
            echo $e->getMessage();
          }
      }

    }

    function Dot2LongIP($IPaddr)
    {
        if ($IPaddr == "") {
            return 0;
        } else {
            $ips = explode(".", "$IPaddr");
            return ($ips[3] + $ips[2] * 256 + $ips[1] * 256 * 256 + $ips[0] * 256 * 256 * 256);
        }
    }

    function is_connected()
    {
        $connected = @fsockopen("www.google.com", 80);
                                            //website, port  (try 80 or 443)
        if ($connected){
            $is_conn = true; //action when connected
            fclose($connected);
        }else{
            $is_conn = false; //action in connection failure
        }
        return $is_conn;

    }

    public function mkt_rep_order_ship($id_part,$date_awal,$date_akhir,$search,$nomor){
      try {

        if ($search=='Order No.') {
          $stmt = $this->conn->query("SELECT o.`no_order`, o.`wkt_order`, ow.`wkt_kirim`, o.`jml_wins`, o.`wins1`, o.`wins2`
            FROM t4t_order o
            LEFT JOIN t4t_orderwkt ow ON o.`no_order`=ow.`no_order`
            WHERE id_comp='$id_part' AND date(wkt_order) BETWEEN '$date_awal' AND '$date_akhir' AND o.`no_order`='$nomor'");
        }elseif ($search=='Shipment No.') {
          $stmt = $this->conn->query("SELECT no_order, wins_used, wkt_shipment, no_shipment, bl FROM t4t_shipment
            WHERE no_shipment='$nomor'");
        }elseif ($search=='BL No.') {
          # code...
        }elseif ($search=='') {
          $stmt = $this->conn->query("SELECT o.`no_order`, o.`wkt_order`, ow.`wkt_kirim`, o.`jml_wins`, o.`wins1`, o.`wins2`
            FROM t4t_order o
            LEFT JOIN t4t_orderwkt ow ON o.`no_order`=ow.`no_order`
            WHERE id_comp='$id_part' AND date(wkt_order) BETWEEN '$date_awal' AND '$date_akhir' ");
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

    public function report_ordership_details($id_part,$nomor){
      try {
        // var_dump($nomor);
          $stmt = $this->conn->query("SELECT * FROM t4t_shipment WHERE id_comp='$id_part' and no_order LIKE '$nomor%' OR '% $nomor, %' OR '%, $nomor'");

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
        // var_dump($nomor);
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

    public function report_stuffing_shipment($nomor){
      try {
        $stmt = $this->conn->prepare("SELECT * FROM t4t_ordercontainer WHERE no_order=?");
        $stmt->execute(array($nomor));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function shipment_detail($nomor){
      try {
        $stmt = $this->conn->prepare("SELECT * FROM t4t_shipment WHERE no_shipment=?");
        $stmt->execute(array($nomor));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
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

    public function last30days(){
      $today          = date("M d, Y");
      $krg30hr        = mktime(0,0,0,date("n"),date("j")-29,date("Y"));
      $last30days     = date("M d, Y", $krg30hr);

      return $last30days;
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

    public function log_system($uname,$title,$desc){
      try {
         $tgl = date("Y-m-d");
         $wkt = date("H:i:s");

        $stmt = $this->conn->prepare("INSERT into t4t_log (uname,log,log_tempat,tgl,wkt) values
        (?,?,?,?,?)");
        $stmt->execute(array($uname,$title,$desc,$tgl,$wkt));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function linked_participant_count($sts,$date){
      try {
        $ex_date = explode("-", $date);
        $date1_format = $ex_date[0];
         $date1 = date("Y-m-d", strtotime($date1_format));
        $date2_format = $ex_date[1];
         $date2 = date("Y-m-d", strtotime($date2_format));

         if ($sts=='acc') {
           $stmt = $this->conn->prepare("SELECT COUNT(*) as jml FROM t4t_log WHERE LOG='Linking Participant' AND log_tempat='Accepted' AND DATE(tgl) BETWEEN ? AND ?");
         }elseif ($sts=='reject') {
           $stmt = $this->conn->prepare("SELECT COUNT(*) as jml FROM t4t_log WHERE LOG='Linking Participant' AND log_tempat='Rejected' AND DATE(tgl) BETWEEN ? AND ?");
         }

        $stmt->execute(array($date1,$date2));
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

    public function data_ret_acc($id){
      try {
        $stmt = $this->conn->prepare("SELECT * from t4t_retailer_acc where no=?");
        $stmt->execute(array($id));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function del_ret_acc($id){
      try {
        $stmt = $this->conn->prepare("DELETE from t4t_retailer_acc where no=?");
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

    public function data_member_list_activestatus($status){
      try {
        if ($status=='active') {
          $stmt = $this->conn->prepare("SELECT * FROM t4t_participant WHERE id IN
                  (
                   SELECT kode FROM otenuser WHERE active=1
                  )
                  ");
        }elseif($status=='not active with oten') {
          $stmt = $this->conn->prepare("SELECT * FROM t4t_participant WHERE id IN
                  (
                   SELECT kode FROM otenuser WHERE active=0
                  )
                  ");
        }elseif($status=='not active without oten') {
          $stmt = $this->conn->prepare("SELECT * FROM t4t_participant WHERE id NOT IN
                  (
                   SELECT kode FROM otenuser
                  )
                  ");
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

    public function data_ret_acc_list(){
      try {
        $stmt = $this->conn->prepare("SELECT * FROM t4t_retailer_acc ORDER BY no asc");
        $stmt->execute(array());
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function data_jml_ret_acc(){
      try {
        $stmt = $this->conn->prepare("SELECT count(*) as jml FROM t4t_retailer_acc where status=0");
        $stmt->execute(array());
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function update_status_ret_acc($no,$to){
      try {
        if ($to=='reject') {
          $stmt = $this->conn->prepare("UPDATE t4t_retailer_acc SET status=2 where no=?");
        }elseif($to=='acc'){
          $stmt = $this->conn->prepare("UPDATE t4t_retailer_acc SET status=1 where no=?");
        }

        $stmt->execute(array($no));
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function data_member_join_ship($pil_th){
      try {
        $stmt = $this->conn->query("SELECT a.*,b.name FROM t4t_shipment a JOIN t4t_participant b ON a.id_comp=b.id
          WHERE a.wkt_shipment LIKE '%$pil_th%' AND a.acc_paid='0' ");
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

    public function wood_species_detail($id_phn,$no_order){
      try {
        $stmt = $this->conn->prepare("SELECT a.id_pohon,b.no from t4t_pohonen a, t4t_orderphn b where a.id_pohon=b.no_phnen2 and no_order=? and a.id_pohon=?");
        $stmt->execute(array($no_order,$id_phn));
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
        $stmt = $this->conn->prepare(" SELECT a.no,a.id_part,a.related_part,a.repeat_id,b.id,
         b.`type`,b.`name` FROM t4t_idrelation a, t4t_participant b
         WHERE a.related_part=b.id AND a.id_part=?");
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

    function encryptWIN($win){
    $theSource = Array("8","v","w","M","P","I","N","o","Z","h","g","_","u","W","D","-","b","O","k","a","G","t","U","j","6","7","K","A","r","y","l","5","X","p","n","z","F","4","Y","d","2","9","q","V","s","0",".","e","H","c","x","Q","B","S");
    	$r = '';
    	while ($win>0){
    		$num = $win % 53;
    		$win = ($win - $num) / 53;
    		$r .= $theSource[$num];
    	}
    	return $r;
    }

    function decryptWIN($crypted){
    $win = 0;
    $theSource = Array("8","v","w","M","P","I","N","o","Z","h","g","_","u","W","D","-","b","O","k","a","G","t","U","j","6","7","K","A","r","y","l","5","X","p","n","z","F","4","Y","d","2","9","q","V","s","0",".","e","H","c","x","Q","B","S");
    $theSource = array_flip($theSource);
    	$i = strlen($crypted);
    	while ($i>0){
    		$i--;
    		$win = $win * 53 + $theSource[$crypted[$i]];
    	}
    	return $win;
    }

    ## ACTION ##------------------------------#######################################
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

    //tambah product
    public function insert_member3($id,$tipe,$nama,$alamat,$tlp,$fax,$email,$email2,$email3,$website,$direktur,$pic,$bhn_utama,$header,$introduction,$jml_outlet,$wkt_isi,$produk){
        try {
          $stmt = $this->conn->prepare("INSERT into t4t_participant (id,type,name,address,phone,fax,email,email1,email2,website,director,pic,material,header,introduction,outlet_qty,date_join,product)
          values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
          $stmt->execute(array($id,$tipe,$nama,$alamat,$tlp,$fax,$email,$email2,$email3,$website,$direktur,$pic,$bhn_utama,$header,$introduction,$jml_outlet,$wkt_isi,$produk));
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }

    public function update_t4torder($tipe,$jml_wins,$destination,$wins1,$wins2,$no_order){
        try {
          $stmt = $this->conn->prepare("UPDATE t4t_order set tipe_prod=:tipe, jml_wins=:jml_win, kota_tujuan=:desti, wins1=:win1, wins2=:win2 where no_order=:order ");
          $stmt->execute(array(
            ":tipe"=>$tipe,
            ":jml_win"=>$jml_wins,
            ":desti"=>$destination,
            ":win1"=>$wins1,
            ":win2"=>$wins2,
            ":order"=>$no_order
          ));
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }

    public function delete_t4torderphn($no_order){
        try {
          $stmt = $this->conn->prepare("DELETE FROM t4t_orderphn where no_order=?");
          $stmt->execute(array($no_order));
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }

    public function delete_t4torderrequest($no_order){
        try {
          $stmt = $this->conn->prepare("DELETE from t4t_orderrequest where no_order=?");
          $stmt->execute(array($no_order));
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }

    public function delete_t4tordercont($no_order){
        try {
          $stmt = $this->conn->prepare("DELETE from t4t_ordercontainer where no_order=?");
          $stmt->execute(array($no_order));
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }

    public function insert_t4torderphn($no_order,$no_phn){
        try {

            $stmt = $this->conn->prepare("INSERT into t4t_orderphn (no_order,no_phnen2) values (?,?)");

          $stmt->execute(array($no_order,$no_phn));
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }

    public function insert_t4torderrequest($no_order,$no,$o_req){
        try {

          $stmt = $this->conn->prepare("INSERT into t4t_orderrequest (no_order,no_req,jml) values (?,?,?)");

          $stmt->execute(array($no_order,$no,$o_req));
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }

    public function insert_t4tordercont($no_order,$no_cont,$jml,$tgl){
        try {

          $stmt = $this->conn->prepare("INSERT into t4t_ordercontainer (no_order,no_cont,jml,tgl_stuf) values (?,?,?,?)");

          $stmt->execute(array($no_order,$no_cont,$jml,$tgl));
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }

    public function update_t4torderwkt($no_order,$tgl){
        try {

          $stmt = $this->conn->prepare("UPDATE t4t_orderwkt set wkt_kirim=? where no_order=? ");

          $stmt->execute(array($tgl,$no_order));
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

    public function update_member2($id,$nama,$alamat,$tlp,$fax,$email,$email2,$email3,$website,$direktur,$pic,$bhn_utama,$header,$introduction,$jml_outlet,$type){
        try {
          $stmt = $this->conn->prepare("UPDATE t4t_participant set name=:nama, address=:alamat, phone=:tlp, fax=:fax, email=:email, email1=:email2, email2=:email3, website=:web, director=:dir, pic=:pic, material=:bhn, header=:head, introduction=:intro, outlet_qty=:outlet, type=:type where id=:id ");

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
            ":outlet"=>$jml_outlet,
            ":type"=>$type,
          ));

          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }

    public function backdoor_planting_maps_insert(
          $id_mapdata,
        	$id_part,
        	$id_shipment,
        	$name,
        	$geo,
        	$latitude_dms,
        	$longitude_dms,
        	$latitude,
        	$longitude,
        	$total_trees,
        	$species,
        	$area,
        	$village,
        	$district,
        	$municipality,
        	$farmer,
        	$planting_year
          ){

        try {
          $stmt = $this->conn->prepare("INSERT into t4t_web.planting_maps_copy
             (id_mapdata,id_part,id_shipment,name,geo,latitude_dms,longitude_dms,latitude,longitude,total_trees,species,area,village,district,municipality,farmer,planting_year)
            values (
            ?,     	?,     	?,     	?,     	?,     	?,    	?,     	?,
          	?,     	?,     	?,     	?,    	?,     	?,     	?,     	?,      ?)
            ");

          $stmt->execute(array(
            $id_mapdata,
          	$id_part,
          	$id_shipment,
          	$name,
          	$geo,
          	$latitude_dms,
          	$longitude_dms,
          	$latitude,
          	$longitude,
          	$total_trees,
          	$species,
          	$area,
          	$village,
          	$district,
          	$municipality,
          	$farmer,
          	$planting_year
          ));


        } catch (PDOException $e) {
           $e->getMessage();
        }
    }

    public function backdoor_planting_maps_insert2(
          $id_mapdata,
        	$id_part,
        	$id_shipment,
        	$name,
        	$geo,
        	$total_trees,
        	$species,
        	$area,
        	$village,
        	$district,
        	$municipality,
        	$farmer,
        	$planting_year
          ){

        try {

          $stmt = $this->conn->prepare("INSERT into t4t_web.planting_maps
             (id_mapdata,id_part,id_shipment,name,geo,total_trees,species,area,village,district,municipality,farmer,planting_year)
            values (
            ?,     	?,     	?,     	?,     	?,     	?,    	?,
          	?,     	?,     	?,     	?,    	?,     	?     	    	      )
            ");

          $stmt->execute(array(
            $id_mapdata,
          	$id_part,
          	$id_shipment,
          	$name,
          	$geo,
          	$total_trees,
          	$species,
          	$area,
          	$village,
          	$district,
          	$municipality,
          	$farmer,
          	$planting_year
          ));


        } catch (PDOException $e) {
           $e->getMessage();
        }
    }

    public function truncate_pm(){
      try {
        $stmt = $this->conn->prepare("TRUNCATE TABLE t4t_web.planting_maps ");
        $stmt->execute(array());
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
         $e->getMessage();
      }
    }

    public function marketing_link_add(
        	$id_part,
        	$related_part,
        	$repeat_id
          ){

        try {

          $stmt = $this->conn->prepare("INSERT into t4t_idrelation
             (id_part,related_part,repeat_id)
            values (
            ?,     	?,     	?    )
            ");

          $stmt->execute(array(
            $id_part,
          	$related_part,
          	$repeat_id
          ));


        } catch (PDOException $e) {
           $e->getMessage();
        }
    }

    public function get_actual_link(){
      $actual_link0 = "$_SERVER[REQUEST_URI]";
      $actual_link1 = explode("?", $actual_link0);
      $actual_link  = $actual_link1[1];

      return $actual_link;
    }

  }//END CLASS





?>
