<?php
$actual_link0 = "$_SERVER[REQUEST_URI]";
$actual_link1 = explode("dashboard/", $actual_link0);
$actual_link  = $actual_link1[1];
?>
<div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>
                Change your password
            </h3>
                    </div>

                </div>
                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">

                            <div class="x_content">
                            <?php
                              if ($_SESSION['success']==1) {
                                ?>
                            <div class="alert alert-success alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong><i class="fa fa-check-circle"></i> Success!</strong> Change password successfully saved.
                            </div>
                              <?php
                              }

                              if ($_SESSION['success']==2) {
                                ?>
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong><i class="fa fa-ban"></i> </strong> Sorry password you entered is incorrect.
                            </div>
                              <?php
                              }

                              unset($_SESSION['success']);
                            ?>
                                <form class="form-horizontal form-label-left" novalidate method="post" action="../action/change-password.php">

                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Current Password <span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="occupation" type="password" name="old_pass" data-validate-length-range="1,20" class="optional form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label for="password" class="control-label col-md-3">Password</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="password" type="password" name="password" data-validate-length-range="6,20" class="form-control col-md-7 col-xs-12" required="required">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Verify Password</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="password2" type="password" name="password2" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required">
                                        </div>
                                    </div>

                                    <input type="hidden" name="link" value="<?php echo $actual_link ?>">
                                    <input type="hidden" name="btn_change_pass" value="1">
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <a href="?<?php echo paramEncrypt('hal=change-password')?>" class="btn btn-primary">Clear</a>
                                            <button id="send" type="submit" name="" class="btn btn-success">Save Changes</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- /page content -->
    </div>

</div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="../js/bootstrap.min.js"></script>

    <!-- chart js -->
    <script src="../js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="../js/icheck/icheck.min.js"></script>
    <!-- pace -->
    <script src="../js/pace/pace.min.js"></script>
    <script src="../js/custom.js"></script>
    <!-- form validation -->
    <script src="../js/validator/validator.js"></script>
    <script>
        // initialize the validator function
        validator.message['date'] = 'not a real date';

        // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
        $('form')
            .on('blur', 'input[required], input.optional, select.required', validator.checkField)
            .on('change', 'select.required', validator.checkField)
            .on('keypress', 'input[required][pattern]', validator.keypress);

        $('.multi.required')
            .on('keyup blur', 'input', function () {
                validator.checkField.apply($(this).siblings().last()[0]);
            });

        // bind the validation to the form submit event
        //$('#send').click('submit');//.prop('disabled', true);

        $('form').submit(function (e) {
            e.preventDefault();
            var submit = true;
            // evaluate the form using generic validaing
            if (!validator.checkAll($(this))) {
                submit = false;
            }

            if (submit)
                this.submit();
            return false;
        });

        /* FOR DEMO ONLY */
        $('#vfields').change(function () {
            $('form').toggleClass('mode2');
        }).prop('checked', false);

        $('#alerts').change(function () {
            validator.defaults.alerts = (this.checked) ? false : true;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);
    </script>

</body>

</html>
