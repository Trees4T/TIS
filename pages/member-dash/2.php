<?php
session_start();
include '../../koneksi/koneksi.php';
require_once '../../action/function/class.office.php';
$office = new office();

$kode=$_SESSION['kode'];
$jml_win=$office->jml_win($kode);
 ?>
<div class="left"></div>
    <div class="center">
        <span class="count_top"><i class="fa fa-globe"></i> Total WIN Used</span>
        <div class="count" align="right"><?php echo number_format($jml_win->jml) ?></div>

    </div>
