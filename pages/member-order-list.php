<div class="">
<div class="page-title">
            <div class="title_left">
              <h3>Order <small></small></h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

              </div>
            </div>
          </div>
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-folder-open"></i> Order List <small></small></h2>
            <ul class="nav navbar-right panel_toolbox"><b>
                <a href="?<?php echo paramEncrypt('hal=member-order-input')?>" data-toggle="tooltip" data-placement="left" title="Add new orders"><i class="fa fa-plus-circle"></i> Go to Input Orders</a></b>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <div id="member2"></div>

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
        <?php for ($i=2; $i <= 2; $i++) {
        ?>
            $(function member() {
                var dataid = [<?php echo $i ?>];
                $.each(dataid,function(i,id) {
                    $("#member<?php echo $i ?>").append("<div id='member"+id+"' <div class='inner'><i class='fa fa-spinner fa-spin'></i> Loading...</div>");
                    $.get("?<?php echo paramEncrypt('content=member-content-ordlist')?>",function(html_widget) {
                        $("#member"+id).replaceWith(html_widget);
                    })
                })
              })
        <?php
        } ?>
        </script>
        <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
        <!-- icheck -->
        <script src="../js/icheck/icheck.min.js"></script>
        <script src="../js/custom.js"></script>
        <!-- pace -->
        <script src="../js/pace/pace.min.js"></script>


</body>

</html>
