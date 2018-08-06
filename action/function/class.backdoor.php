<?php
  /**
   *
   */

  require_once 'dbcon.php';


  class Backdoor{

    public function __construct(){
        $database = new Database();
    		$db = $database->dbConnection();
    		$this->conn = $db;
    }


    public function qty_trees_and_families($id_part){
        try {
          $stmt = $this->conn->prepare("SELECT
                                        	(SELECT SUM(jml_phn) FROM t4t_t4t.t4t_htc WHERE bl IN (SELECT bl FROM t4t_t4t.t4t_shipment
                                        	WHERE id_comp=id_part))
                                        	AS qty_trees,
                                        	(SELECT COUNT(jml) AS jml_petani FROM (SELECT COUNT(petani) AS jml FROM t4t_t4t.t4t_htc WHERE bl IN
                                        	(SELECT bl FROM t4t_t4t.t4t_shipment WHERE id_comp=? ) GROUP BY petani) AS a) AS qty_families
                                        FROM t4t_web.participants WHERE id_part=? ");
          $stmt->execute(array($id_part,$id_part));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }

    public function get_koordinat($koordinat){
        try {
          $stmt = $this->conn->prepare("SELECT koordinat,id_pohon2,thn_tanam FROM t4t_t4t.t4t_lahan WHERE koordinat=?");
          $stmt->execute(array($koordinat));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }

    public function get_species($id_pohon){
        try {
          $stmt = $this->conn->prepare("SELECT * FROM t4t_t4t.t4t_pohon WHERE t4t_pohon.`id_pohon`=?");
          $stmt->execute(array($id_pohon));
          $res = $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }

    public function tambah_stok_perfc($kd_fc,$desa){
        try {

          $stmt = $this->conn->prepare("SELECT * FROM t4t_t4t.t4t_lahan WHERE kd_fc = ? and id_desa = ?");
          $stmt->execute(array($kd_fc,$desa));
          while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
            $res[] =$data;
          }
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }

    public function web_participant(){
        try {
          $stmt = $this->conn->prepare("SELECT * FROM t4t_web.participants");
          $stmt->execute(array());
          while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
            $res[] =$data;
          }
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }

    public function pm_manufacture($id_mapdata){
      try {
        $stmt = $this->conn->prepare("SELECT
        `a`.`no`          AS `id_mapdata`,
        `c`.`id`          AS `id_part`,
        `a`.`no_shipment` AS `id_shipment`,
        `c`.`name`        AS `name`,
        `a`.`geo`         AS `geo`,
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
              ON ((`f`.`id_comp` = `c`.`id`))) where a.no='$id_mapdata' limit 1");
        $stmt->execute(array($id_mapdata));
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function pm_retailer($limit){
      try {
        $stmt = $this->conn->prepare("SELECT
            a.`no` AS `id_mapdata`,
            b.`id_part` AS `id_part`,
            a.`no_shipment` AS `id_shipment`,
            c.`name` AS `name`,
            a.`geo` AS `geo`,
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
            ON b.id_part=c.id limit $limit ");
        $stmt->execute(array($limit));
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function pm_retailer_bypart($buyer){
      try {
        $stmt = $this->conn->prepare("SELECT * FROM t4t_t4t.t4t_htc WHERE no_shipment IN (SELECT no_shipment FROM t4t_t4t.`t4t_shipment` WHERE buyer=?)");
        $stmt->execute(array($buyer));
        while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] =$data;
        }
        return $res;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function planting_maps_insert(
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
          	?,     	?,     	?,     	?,    	?,     	?   	     )
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

    public function current_tree_insert(
          $no_pohon,
          $no_t4tlahan,
          $last_mon,
          $hidup,
          $used,
          $kd_mu,
          $id_pohon,
          $koordinat,$bl,$ship
          ){

        try {
          $stmt = $this->conn->prepare("INSERT INTO current_tree (no_pohon,no_t4tlahan,last_mon,hidup,used,kd_mu,id_pohon,koordinat,bl,no_shipment) VALUES
          (?,?,?,?,?,?,?,?,?,?)");

          $stmt->execute(array(
            $no_pohon,
            $no_t4tlahan,
            $last_mon,
            $hidup,
            $used,
            $kd_mu,
            $id_pohon,
            $koordinat,$bl,$ship
          ));


        } catch (PDOException $e) {
           $e->getMessage();
        }
    }

    public function wins_insert(
          $wins,
          $order,
          $bl,
          $id_part,
          $shipment,
          $time,
          $user,
          $type,
          $relation,
          $id_ret

          ){

        try {
          $stmt = $this->conn->prepare("INSERT INTO t4t_wins (wins,no_order,bl,id_part,no_shipment,time,log_user,trans_type,relation,id_retailer) VALUES
          (?,?,?,?,?,?,?,?,?,?)");

          $stmt->execute(array(
            $wins,
            $order,
            $bl,
            $id_part,
            $shipment,
            $time,
            $user,
            $type,
            $relation,
            $id_ret
          ));


        } catch (PDOException $e) {
           $e->getMessage();
        }
    }

    public function participant_insert(
          $above_map,
          $below_map,
          $wincheck_text,
          $refpage_text,
          $qty_trees,
          $qty_families,
          $id_part
          ){

        try {
          $stmt = $this->conn->prepare("UPDATE t4t_t4t.t4t_participant_test SET above_map=?, below_map=?, wincheck_text=?, refpage_text=?, qty_trees=?, qty_families=? WHERE id=?");

          $stmt->execute(array(
            $above_map,
            $below_map,
            $wincheck_text,
            $refpage_text,
            $qty_trees,
            $qty_families,
            $id_part
          ));


        } catch (PDOException $e) {
           $e->getMessage();
        }
    }

    public function truncate_pm(){
      try {
        $stmt = $this->conn->prepare("TRUNCATE TABLE t4t_web.planting_maps_copy2 ");
        $stmt->execute(array());
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        return $res;
      } catch (PDOException $e) {
         $e->getMessage();
      }
    }

  }//END CLASS











?>
