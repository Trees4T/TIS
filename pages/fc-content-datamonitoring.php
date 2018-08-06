<?php
$no_t4tlahan=$var['lahan'];
$mon=$var['mon'];

?>

<table class="table table-striped responsive-utilities jambo_table" border="1" id="monitoring">
  <thead>
      <tr>
          <th width="5%"><center>No.<center></th>
          <th width="10%"><center>No. Pohon<center></th>
          <th width="10%"><center>Sehat<center></th>
          <th width="10%"><center>Mati<center></th>
          <th width="10%"><center>Hilang<center></th>
          <th width="45%"><center>Keterangan<center></th>
      </tr>
  </thead>
  <tbody>
    <?php
    $no=1;
    $data_pohon = $fc->t4t_lahanpohon($no_t4tlahan,$mon);
    foreach ($data_pohon as $data) {
    ?>
    <tr>
      <td align="center"><?php echo $no ?>.</td>
      <td align="center"><?php echo $data->no_pohon ?></td>
      <td align="center"><?php
        if ($data->st=="sehat") {
          echo "<div class='font-big green'><i class='fa fa-check'></i></div>";
        }else{
          echo "-";
        }
          ?></td>
      <td align="center"><?php
        if ($data->st=="mati") {
          echo "<div class='font-big green'><i class='fa fa-check'></i></div>";
        }else{
          echo "-";
        }
          ?></td>
      <td align="center"><?php
        if ($data->st=="hilang") {
          echo "<div class='font-big green'><i class='fa fa-check'></i></div>";
        }else{
          echo "-";
        }
          ?></td>
      <td><?php echo $data->ket ?></td>
    </tr>
    <?php
    $no++;
    }
    ?>
  </tbody>
</table>

<!-- Datatables -->
<script src="../js/datatables/js/jquery.dataTables.js"></script>
<script src="../js/datatables/tools/js/dataTables.tableTools.js"></script>

<script>
$(function() {
$('#monitoring').DataTable( {
// "bJQueryUI":true,
"searching":false,
"bPaginate":true,
"sPaginationType": "full_numbers",
"iDisplayLength":100
} );

} );
</script>
<!-- end datatable -->
