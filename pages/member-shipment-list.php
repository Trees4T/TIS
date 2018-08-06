<div class="">
<div class="page-title">
  <div class="title_left">
    <h3>Shipment <small></small></h3>
  </div>
  <div class="title_right">
    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

    </div>
  </div>
</div>
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-folder-open"></i> Shipment List <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <a href="?<?php echo paramEncrypt('hal=member-shipment-input')?>" data-toggle="tooltip" data-placement="left" title="Add new shipments"><i class="fa fa-plus-circle"></i> Input Shipments</a>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br>

      <?php
      if ($_SESSION['success']==1) {
        $text = "Your shipment with BL No. ".$_SESSION['bl']." successfully updated.";
      }
      ?>

      <?php if ($_SESSION['success']==true): ?>
      <!-- notif  -->
      <div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <strong><i class="fa fa-check-circle"></i> Success!</strong> <?php echo $text ?>
      </div>
      <!-- end notif  -->
    <?php endif; ?>

      <?php
      unset($_SESSION['success']);
      unset($_SESSION['bl']);
      ?>

            <div id="member1"></div>


        </div>
    </div>
</div>

<!-- js -->

        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript">
    <?php for ($i=1; $i <= 1; $i++) {
    ?>
        $(function member() {
            var dataid = [<?php echo $i ?>];
            $.each(dataid,function(i,id) {
                $("#member<?php echo $i ?>").append("<div id='member"+id+"' <div class='inner'><i class='fa fa-spinner fa-spin'></i> Loading...</div>");
                $.get("?<?php echo paramEncrypt('content=member-content-shiplist')?>",function(html_widget) {
                    $("#member"+id).replaceWith(html_widget);
                })
            })
          })
    <?php
    } ?>
    </script>
    <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="../js/icheck/icheck.min.js"></script>
    <script src="../js/custom.js"></script>
    <script src="../js/pace/pace.min.js"></script>



</body>

</html>
