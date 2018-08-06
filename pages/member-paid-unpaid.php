<div class="">
<div class="page-title">
            <div class="title_left">
              <h3>Paid & Unpaid <small></small></h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

              </div>
            </div>
          </div>


    <div class="x_panel">
    <div class="col-md-12">
        <div class="x_panel">
            <!-- <div class="x_title">

                <ul class="nav navbar-right panel_toolbox">

                </ul>
                <div class="clearfix"></div>
            </div> -->
            <div class="x_content">
              <div class="" role="tabpanel" data-example-id="togglable-tabs">
                  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Unpaid</a>
                      </li>
                      <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Paid</a>
                      </li>

                  </ul>
              <div id="member3"></div>

            </div>
        </div>
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
    <?php for ($i=3; $i <= 3; $i++) {
    ?>
        $(function member() {
            var dataid = [<?php echo $i ?>];
            $.each(dataid,function(i,id) {
                $("#member<?php echo $i ?>").append("<div id='member"+id+"' <div class='inner'><i class='fa fa-spinner fa-spin'></i> Loading...</div>");
                $.get("?<?php echo paramEncrypt('content=member-content-paidunpaid')?>",function(html_widget) {
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



</body>

</html>
