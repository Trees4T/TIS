<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 $dt1 = $_GET['date1'];
 $dt2 = $_GET['date2'];
 $id_comp = $_GET['comp'];


// DB table to use
$table = 't4t_wins';

// Table's primary key
$primaryKey = 'bl';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => '`w`.`wins`', 'dt' => 0, 'field' => 'wins' ),
	array( 'db' => '`h`.`bl`',   'dt' => 4, 'field' => 'bl' ),
	array( 'db' => '`h`.`petani`',  'dt' => 1, 'field' => 'petani' ),
	array( 'db' => '`h`.`jml_phn`',  'dt' => 2, 'field' => 'jml_phn' ),
	array( 'db' => '`pt`.`name`',  'dt' => 3, 'field' => 'name' ),
	array( 'db' => '`w`.`wins`', 'dt' => 5, 'formatter' => function( $d, $row ) {
				return '<a href="https://trees4trees.org/?wins='.$d.'" target="_blank"><i class="fa fa-globe"></i> https://trees4trees.org/?wins='.$d.'</a>';
				},
				'field' => 'wins' )
);


// SQL server connection information
require('config.php');
$sql_details = array(
	'user' => $db_username,
	'pass' => $db_password,
	'db'   => $db_name,
	'host' => $db_host
);

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

// require( 'ssp.class.php' );
require('ssp.customized.class.php' );

$joinQuery = "FROM `t4t_wins` `w`
		         LEFT JOIN `t4t_shipment` `s`
		           ON `w`.`bl` = `s`.`bl`
		        LEFT JOIN `t4t_htc` `h`
		          ON `w`.`bl` = `h`.`bl`
		       LEFT JOIN `t4t_lahan` `l`
		         ON `h`.`kd_lahan` = `l`.`kd_lahan`
		      LEFT JOIN `t4t_pohon` `p`
		        ON `l`.`id_pohon2` = `p`.`id_pohon`
		     LEFT JOIN `t4t_idrelation` `i`
		       ON `s`.`buyer` = `i`.`repeat_id`
		    LEFT JOIN `t4t_participant` `pt`
		      ON `i`.`related_part` = `pt`.`id`
";
$extraWhere = "w.id_part='".$id_comp."' and date(s.wkt_shipment) BETWEEN '".$dt1."' and '".$dt2."' AND i.`id_part`='".$id_comp."'";
$groupBy = "";
$having = "";


echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
);
