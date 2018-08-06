<div class="">
<div class="page-title">
            <div class="title_left">
              <h3>Monitoring</h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

              </div>
            </div>
          </div>
    <div class="x_panel">
        <div class="x_title">
            <h2><a href="<?php $fc->back() ?>"><i class="fa fa-reply"></i></a> - Desa <?php echo $fc->nama_desa($id_desa)->desa ?></h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">


              <div class="panel-body">
                  <!-- isi accordion 1 -->
                  <div class="accordion">
                     <?php
                     $list_tahun = $fc->list_tahun_lahan($id_desa,$kode_ta);
                     foreach ($list_tahun as $load_tahun) {
                     ?>

                      <div class="panel">
                          <a class="panel-heading" href="?<?php echo paramEncrypt('hal=fc-content-monitor-detail-data&id_desa='.$load_tahun->id_desa.'&thn_tanam='.$load_tahun->thn_tanam.'') ?>">
                              <h4 class="panel-title">
                             <i class="fa fa-caret-square-o-down"></i> Lahan pada tahun <?php echo $load_tahun->thn_tanam ?>
                              </h4>
                          </a>

                      </div>

                      <?php } ?>
                  </div>
                  <!-- end isi accordion 1 -->
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
        <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
        <!-- icheck -->
        <script src="../js/icheck/icheck.min.js"></script>
        <script src="../js/custom.js"></script>
        <!-- pace -->
        <script src="../js/pace/pace.min.js"></script>


</body>

</html>
