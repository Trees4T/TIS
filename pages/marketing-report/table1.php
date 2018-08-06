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


<table id="example" class="table table-striped responsive-utilities jambo_table" width='100%' border="1">
<thead>
  <tr class="headings">
    <th><center>WIN</center></th>
    <th><center>Farmer</center> </th>
    <th><center>Qty. of Trees</center> </th>
    <th><center>Type of Trees</center></th>
    <th><center>URL SYT</th>
  </tr>
</thead>

<tbody>
<?php

$no=1;
$mkt_report = $office->mkt_rep_sponsor($kd_part,$date_awal,$date_akhir);

foreach ($mkt_report as $mkt_reports) {
?>
  <tr class="even pointer">
    <td width='10%'><?php echo $mkt_reports->wins ?></td>
    <td width='30%'><?php echo $mkt_reports->petani ?></td>
    <td width='10%' align='right'><?php echo $mkt_reports->jml_phn ?></td>
    <td width='20%'><?php echo $mkt_reports->nama_pohon ?></td>
    <td width='30%'><a href="https://trees4trees.org/?wins=<?php echo $mkt_reports->wins ?>" target="_blank">
      https://trees4trees.org/?wins=<?php echo $mkt_reports->wins ?></a></td>
  </tr>

<?php
$no++;
$total_contrib[]=$mkt_reports->jml_phn;
}
?>
</tbody>
<tfoot>
   <tr class="font-hijau">
       <td colspan="2">TOTAL</td>
       <td align="right" class="font-hijau"><b><?php echo $tot_contrib=number_format(array_sum($total_contrib),2) ?></b></td>
       <td colspan="2"></td>
          <?php $_SESSION['tot_contrib']=$tot_contrib ?>
   </tr>
</tfoot>

</table>

<!-- datatable -->
<script>
  $(function() {
      $('#example').DataTable( {
                // "bJQueryUI":true,
              "bPaginate":true,
              "sPaginationType": "full_numbers",
              "iDisplayLength":10
      } );

  } );
</script>
