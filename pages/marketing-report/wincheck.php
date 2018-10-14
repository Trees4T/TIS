<!-- nama partisipan -->
<?php if (isset($_POST['btn_submit'])): ?>
<h3 class="green"><?php echo $data_part->name.' ' ?></h3>
<?php endif; ?>

<div class="x_content">

  <div class="well">
    <form class="form-horizontal" method="post" action="" id="myform">
      <!-- Kolom 1 -->
      <div class="col-md-12">
        <!-- Kolom 1a -->
        <div class="col-md-3">
        <label class="control-label">Category</label>
        <select class="form-control" name="category" onchange="this.form.submit()">
          <?php if ($category!=''): ?>
          <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
          <option value="">------------------------</option>

          <?php else: ?>
            <option value="">- Select -</option>
          <?php endif; ?>

          <?php
          foreach ($tipe_part_list as $tipe_part_lists) {
          ?>
          <option value="<?php echo $tipe_part_lists->type; ?>"><?php echo $tipe_part_lists->type; ?></option>
          <?php
          }
          ?>
        </select>
        <!-- <noscript><input type="submit" value="category"></noscript> -->
        <label class="control-label">Director</label><br>
          <?php if ($data_part->director==''): ?>
          <?php echo "-"; ?>
          <?php else: ?>
          <p class="green"><?php echo $data_part->director ?></p>
          <?php endif; ?>
        </div>
        <!-- Kolom 1b -->
      <div class="col-md-4">


      <label class="control-label">Participant Name</label>
      <select class="form-control" name="kd_part" onchange="this.form.submit()">
      <?php if ($kd_part!=''): ?>
        <option value="<?php echo $kd_part; ?>"><?php echo $data_part->name; ?></option>
        <option value="">------------------------</option>
        <?php else: ?>
          <option value="">- Select -</option>
        <?php endif; ?>

        <?php
        $data_member_list = $office->data_member_list_tipe($category);
        foreach ($data_member_list as $data_member_lists) {
        ?>
        <option value="<?php echo $data_member_lists->id; ?>"><?php echo $data_member_lists->name; ?></option>
        <?php
        }
        ?>
      </select>
      <!-- <noscript><input type="submit" value="kd_part"></noscript> -->

      <label class="control-label">Address</label><br>
        <?php if ($data_part->address==''): ?>
        <?php echo "-"; ?>
        <?php else: ?>
        <p class="green"><?php echo $data_part->address ?></p>
        <?php endif; ?>
      </div>
      <!-- Kolom 1c -->
      <div class="col-md-5">
        <label class="control-label">Part ID</label>
        <input type="text" class="form-control" name="" value="<?php echo $data_part->id ?>" disabled style="width:90px;">

        <table>
          <tr>
            <td><label class="control-label">Tel</label><br>
              <?php if ($data_part->phone==''): ?>
                <?php echo "-"; ?>
                <?php else: ?>
                <p class="green"><?php echo $data_part->phone ?></p>
              <?php endif; ?>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><label class="control-label">Email</label><br>
              <?php if ($data_part->email==''): ?>
                <?php echo "-"; ?>
                <?php else: ?>
                <p class="green"><?php echo $data_part->email ?></p>
              <?php endif; ?></td>
          </tr>
        </table>
      </div>

      </div>
    </form>

    <form class="" action="" method="post">
      <input type="hidden" name="kd_part" value="<?php echo $kd_part ?>">
      <input type="hidden" name="link" value="<?php echo $actual_link ?>">
      <input type="hidden" name="category" value="<?php echo $category ?>">

      <div class="col-md-12">
        <div class="col-md-6">
          <fieldset>
            <div class="control-group">
              <?php
              date_default_timezone_set('Asia/Jakarta');
              $waktu    = date("d/m/Y");
              $tahun    = date("Y");
              $bln_lalu = date("m")-1;
                  if ($bln_lalu=='0') {
                      $bln_lalu='12';
                      $tahun=$tahun-1;
                  }
               ?>
            <label class="control-label">Date Range <span class="required red">*</span>
            </label><br>
              <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 70%">
                <i class="fa fa-calendar"></i>&nbsp;
                <span onkeyup="this.form.submit()"></span> <i class="fa fa-caret-down"></i>
                <input type="hidden" name="range_tanggal" value="" class="" id="hidden">
                <noscript><input type="submit" value="date"></noscript>
              </div>

              <script type="text/javascript">
                function MyClick()
                 {
                  document.getElementById('myform').submit();
                 }
              </script>
            </div>
          </fieldset>
        </div>
      </div>


      <div class="form-group">
        <?php if (isset($_POST['btn_submit'])): ?>
            <br><br><br><br><br><br>
          <?php else: ?>
            <br><br><br><br><br><br><br><br><br><br><br><br>
        <?php endif; ?>

        <div class="col-md-5 col-md-offset-5">
          <a href="?<?php echo $actual_link ?>" class="btn btn-primary">Reset</a>
          <?php if ($kd_part): ?>
          <button type="submit" name="btn_submit" class="btn btn-success">Submit</button>
          <?php endif; ?>
          <?php if (isset($_POST['btn_submit'])): ?>
            <?php else: ?>
              <br><br><br><br><br><br><br>
          <?php endif; ?>
        </div>
      </div>

    </form>
  </div>

</div>



<?php if (isset($_POST['btn_submit'])): ?>

<form class="" action="" method="post">
  <div class="" align="right">
    <input type="hidden" name="kd_part" value="<?php echo $kd_part ?>">
    <input type="hidden" name="date_awal" value="<?php echo $date_awal ?>">
    <input type="hidden" name="date_akhir" value="<?php echo $date_akhir ?>">
    <input type="hidden" name="alamat" value="<?php echo $data_part->address ?>">
    <input type="hidden" name="part" value="<?php echo $data_part->name ?>">
    <input type="hidden" name="search" value="<?php echo $_POST[search] ?>">
    <input type="hidden" name="nomor" value="<?php echo $_POST[nomor] ?>">

    <!-- <button type="submit" class="btn btn-success" name="button"><i class="fa fa-file-excel-o"></i> Export to Excel</button> -->
  </div>
</form>



<div class="pull-left">
  <form class="" action="../action/report/excel-report-mkt-wincheck.php" method="post">
    <input type="hidden" name="id_part" value="<?php echo $kd_part ?>">
    <input type="hidden" name="awal" value="<?php echo $date_awal ?>">
    <input type="hidden" name="akhir" value="<?php echo $date_akhir ?>">

    <button type="submit" name="button" class="btn btn-success"> Export to Excel</button>
  </form>
</div>

<br><br>

<!-- ################# -->
<!-- Table -->
<!-- ################# -->


<table id="example" class="table table-striped responsive-utilities jambo_table" width='100%' border="1">
<thead>
  <tr class="headings">
    <th><center>Checking Date</center> </th>
    <th><center>WINS</center> </th>
    <th><center>No. Order</center> </th>
    <th><center>Shipment</center></th>
    <th><center>BL</center></th>
    <!-- <th><center>Location</center></th> -->
  </tr>
</thead>

<tbody>
<?php

$no=1;
$mkt_report = $office->mkt_rep_wincheck($kd_part,$date_awal,$date_akhir);

foreach ($mkt_report as $mkt_reports) {
?>
  <tr class="even pointer">
    <td width='10%' align="center"><?php echo $office->datetime_to_date($mkt_reports->search_date); ?></td>
    <td width='10%' align="center"><?php echo $mkt_reports->wins; ?></td>
    <td width='35%' align="center"><?php echo $mkt_reports->no_order; ?></td>
    <td width='15%' align="center"><?php echo $mkt_reports->no_shipment; ?></td>
    <td width='15%' align="center"><?php echo $mkt_reports->bl; ?></td>
    <!-- <td width='15%' align="center"><?php echo $mkt_reports->ip_address; ?></td> -->

  </tr>

<?php
$no++;
$total_contrib[]=$mkt_reports->fee;
}
?>
</tbody>


</table>
<?php endif; ?>
<!-- #END# Table -->
<!-- modal -->
<?php
  $title = 'WINS Used';
  $editable = 'no';
  $id_modal = 'myModal';
  $size = 'md';
  include 'ajax-modal.php';
?>
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

<script>
$(function(){
    $(document).on('click','.show-win_used',function(e){
        e.preventDefault();
        $("#myModal").modal('show');
        $.post('../pages/modal/marketing/report/order-shipment.php?edit=<?php echo $editable ?>',
            {id:$(this).attr('data-id')},
            function(html){
                $(".modal-body").html(html);
            }
        );
    });
});
</script>
