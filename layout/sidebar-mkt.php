<li><a href="?<?php echo paramEncrypt('hal=marketing-home')?>"><i class="fa fa-home"></i> Home</a></li>
<li><span class="fa fa-chevron-down"></span><a><i class="fa fa-group"></i> Participants</a>
  <ul class="nav child_menu" style="display: none">
    <li><a href="?<?php echo paramEncrypt('hal=marketing-member-input')?>">Create New Participant </a></li>
    <li><a href="?<?php echo paramEncrypt('hal=marketing-member-list')?>">List of Participants </a></li>
  </ul>
</li>
<li><a href="?<?php echo paramEncrypt('hal=marketing-link-part')?>"><i class="fa fa-chain"></i> Linking Participants</a></li>

<?php
  $jmls=$office->data_jml_ret_acc();

  if ($jmls->jml==0) {
    $status = "success";
  }else{
    $status = "warning";
  }
?>
<li><a href="?<?php echo paramEncrypt('hal=marketing-link-approval-change')?>"><i class="fa fa-check"></i> Approval <span class="label label-<?php echo $status ?> pull-right"><?php echo $jmls->jml; ?></span></a></li>

<!-- <li><a href="?<?php //echo paramEncrypt('hal=test-ajax')?>"><i class="fa fa-chain"></i> ajax</a></li> -->

<li><span class="fa fa-chevron-down"></span><a><i class="fa fa-file-text-o"></i> Order & Shipment</a>
    <ul class="nav child_menu" style="display: none">
      <!-- <li><a href="?<?php echo paramEncrypt('hal=x')?>"> Create Shipment or Order</a></li> -->
      <li><a href="?<?php echo paramEncrypt('hal=admoff-order-list')?>"> Order List</a></li>
      <li><a href="?<?php echo paramEncrypt('hal=admoff-shipment-list')?>"> Shipment List</a></li>
    </ul>
</li>

<li><span class="fa fa-chevron-down"></span><a><i class="fa fa-file-pdf-o"></i> Participants Report</a>
    <ul class="nav child_menu" style="display: none">
      <li><a href="?<?php echo paramEncrypt('hal=marketing-report-order-shipment')?>"> Order & Shipment Report</a></li>
      <li><a href="?<?php echo paramEncrypt('hal=marketing-report-contribution')?>"> Contribution Report</a></li>
      <li><a href="?<?php echo paramEncrypt('hal=marketing-report-sponsor')?>"> Sponsor Report</a></li>
      <li><a href="?<?php echo paramEncrypt('hal=marketing-report-supplier')?>"> Supplier Report</a></li>
      <li><a href="?<?php echo paramEncrypt('hal=marketing-report-wincheck')?>"> WIN Check Report</a>
      <!--<li><a href="?<?php //echo paramEncrypt('hal=marketing-report-missingwin')?>"> WIN Missing Report</a></li> -->
      <!-- new -->
      <li><a href="?<?php echo paramEncrypt('hal=admoff-wins-search')?>"></i> WIN Missing Report</a></li>
      <!-- <li><a href="?<?php //echo paramEncrypt('hal=blank')?>"></i> Blank</a></li>-->
      <!-- <li><a href="?<?php //echo paramEncrypt('hal=marketing-report-supplierOLD')?>"></i> Blank2</a></li> -->

    </ul>
</li>
<!--
<li><span class="fa fa-chevron-down"></span><a><i class="fa fa-info-circle"></i> Information</a>
    <ul class="nav child_menu" style="display: none">
      <li><a href="?<?php// echo paramEncrypt('hal=blank-page')?>"> aa</a></li>
      <li><a href="?<?php //echo paramEncrypt('hal=admoff-order-list')?>"> Win Missing</a></li>
    </ul>
</li> -->
