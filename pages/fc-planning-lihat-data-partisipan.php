<div class="">
<div class="page-title">
            <div class="title_left">
              <h3>Planning <small>Data Partisipan</small></h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

              </div>
            </div>
          </div>
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-folder-open"></i> Data Partisipan <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <a href="?<?php echo paramEncrypt('hal=fc-planning-input-data-partisipan')?>" data-toggle="tooltip" data-placement="left" title="Memasukkan data partisipan baru"><i class="fa fa-plus-circle"></i> Input Data Partisipan</a>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <div id="fc1"></div>

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
            $(function fc() {
                var dataid = [<?php echo $i ?>];
                $.each(dataid,function(i,id) {
                    $("#fc<?php echo $i ?>").append("<div id='fc"+id+"' <div class='inner'><i class='fa fa-spinner fa-spin'></i> Loading...</div>");
                    $.get("?<?php echo paramEncrypt('content=fc-content-datapart')?>",function(html_widget) {
                        $("#fc"+id).replaceWith(html_widget);
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
