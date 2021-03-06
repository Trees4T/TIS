<?php
session_start();
error_reporting(0);
include '../koneksi/koneksi.php';
if ($_SESSION['kode']!="") {
    header("location:../login/back_home.php");
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Page | Trees4Trees&trade;</title>

    <!-- Bootstrap core CSS -->

    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link href="../fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="../css/custom.css" rel="stylesheet">
    <link href="../css/icheck/flat/green.css" rel="stylesheet">


    <script src="../js/jquery.min.js"></script>

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        [endif]-->

</head>

<body style="background:#F7F7F7;">

    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
                    <form method="post" action="login.php">
                        <h1>Login Form</h1>
                        <div>
                            <input type="text" class="form-control" name="username" placeholder="Username" required="" />
                        </div>
                        <div>
                            <input type="password" class="form-control" name="password" placeholder="Password" required="" />
                        </div>
                        <!-- <div>
                                          <select class="form-control" name="group" >
                                              <option class="form-control">- Choose System -</option>
                                               <option value="adm">Administrator</option>
                                               <option value="">Accountant</option>
                                               <option value="">Operational</option>
                                          </select>
                                          <noscript><input type="submit" value="partisipan"></noscript>
                                      </div> -->
                        <div><br>
                            <button class="btn btn-default submit" name="submit" type="submit">Log in</button>
                           <!--  <a class="reset_pass" href="#">Lost your password?</a> -->
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <!-- <p class="change_link">
                                <a href="#toregister" class="to_register"> Lost your password? </a>
                            </p> -->
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><img src="../images/logo-theme.png" width="185"></h1>
                                <p>©<?php echo date("Y") ?> Trees4Trees&trade; All Rights Reserved.  </p>
                                <?php echo $version; ?>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
            <div id="register" class="animate form">
                <section class="login_content">
                    <form>
                        <h1>Forgot Password</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Email Address" required="" />
                        </div>
                        <div>
                            <a class="btn btn-default submit" href="index.html">Submit</a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <p class="change_link">Account is ready?
                                <a href="#tologin" class="to_register"> Log in </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><i class="fa fa-tree" style="font-size: 26px;"></i> Trees4Trees&trade;</h1>

                                <p>© <?php echo date("Y") ?> Trees4Trees&trade; All Rights Reserved.  </p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
        </div>
    </div>

</body>

</html>
