<?php
include '../../koneksi/koneksi.php';
include_once('../../action/function/class.office.php');

$office = new office();

$kd_part = $_GET['kd_part'];
$date_awal = $_GET['awal'];
$date_akhir = $_GET['akhir'];
?>

<!-- ################# -->
<!-- Table -->
<!-- ################# -->


<table id="supplier" class="table table-striped responsive-utilities jambo_table" width='100%' border="0">
<thead>
  <tr class="headings">
    <th><center>WIN</center></th>
    <th><center>Farmer</center> </th>
    <th><center>Qty. of Trees</center> </th>
    <th><center>Retailer Name</center></th>
    <th><center>BL No.</center></th>
    <th><center>URL SYT</th>
  </tr>
</thead>

</table>

<!-- #END# Table -->

<script type="text/javascript">
$(document).ready(function() {
  $('#supplier').dataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": "../assets/datatable/scripts/mkt-rep-supplier.php?date1=<?php echo $date_awal ?>&date2=<?php echo $date_akhir ?>&comp=<?php echo $kd_part ?>"
  } );
 } );
</script>
