    <?php
        error_reporting(0);
        include '../assets/lib-encript/function.php';
        //untuk mendecode url yang di encrypt
        $var     =decode($_SERVER['REQUEST_URI']);
        $var2    =decode($_SERVER['REQUEST_URI']);
        $content =$var2['content'];

        if (!Empty($content)) {
          # code...
        }else{
    ?>
<body class="nav-md" onload="setInterval('displayServerTime()', 1000);">

    <div class="container body">
    <?php
    $username  = $_SESSION['username'];
    $id_group  = $_SESSION['level'];
        if ($id_group=='adm') {
            $group='Administrator';
        }
        elseif ($id_group=='fc') {
            $group='Field Coordinator';
        }elseif ($id_group=='part') {
            $group='Participant';
        }elseif ($id_group=='admoff') {
            $group='Admin Officer';
        }elseif ($id_group=='fin') {
            $group='Finance';
        }
    ?>

        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="../index.php" class="site_title"><img src="../images/T4TLogo.png" width="26"> <span>Trees4Trees&trade;</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                        <?php
                        if ($id_group=='fc') {
                            $kode=$_SESSION['kode'];
                            $foto_fc  = $conn->query("SELECT foto from t4t_fc where kode='$kode'")->fetch(PDO::FETCH_OBJ);
                        ?>
                            <img src="../../management_t4t/gbr/poto/<?php echo $foto_fc->foto ?>" alt="..." class="img-circle profile_img" height='60' width='60'>
                        <?php
                        }elseif ($id_group=='part' or $id_group=='admoff' or $id_group=='fin') {
                            # code...
                        }else{
                         ?>
                            <img src="../images/default.png" alt="..." class="img-circle profile_img">
                        <?php } ?>
                        </div>

                        <?php
                        if ($id_group=='part') {
                        ?>
                        <div class="profile_info2">
                            <span>Welcome,</span>
                            <h2><?php echo $_SESSION['nama_part'] ?></h2>
                        </div><br><br><br><br>
                        <?php
                        }elseif($id_group=='admoff' or $id_group=='fin'){
                        ### Empty ###
                        }else{
                         ?>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo $username ?></h2>
                        </div>
                        <?php } ?>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3><?php echo $group ?></h3>
                            <ul class="nav side-menu">
                            <?php if ($_SESSION['level']=="adm") {
                                include 'sidebar-admin.php';
                            }elseif ($_SESSION['level']=="fc") {
                                include 'sidebar-fc.php';
                            }elseif ($_SESSION['level']=="part") {
                                include 'sidebar-member.php';
                            }elseif ($_SESSION['level']=="admoff") {
                                include 'sidebar-admoff.php';
                            }elseif ($_SESSION['level']=="fin") {
                                include 'sidebar-fin.php';
                            }

                            ?>




                            </ul>
                        </div>


                    </div>
                    <!-- /sidebar menu -->
                    <?php
                    if ($id_group=='admoff' or $id_group=='fin') {
                        # code...
                    }else{
                    ?>
                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a href="?<?php echo paramEncrypt('hal=member-setting-account')?>" data-toggle="tooltip" data-placement="top" title="Account">
                            <span class="fa fa-user" aria-hidden="true"></span>
                        </a>
                        <a href="?<?php echo paramEncrypt('hal=change-password')?>" data-toggle="tooltip" data-placement="top" title="Change Password">
                            <span class="fa fa-key" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="V 0.2.12">
                            <span class="fa fa-question-circle" aria-hidden="true"></span>
                        </a>
                        <a href="../login/logout.php" data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                    <?php
                    } ?>
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <?php
                                if ($id_group=='part' or $id_group=='admoff' or $id_group=='fin') {
                                    echo " | ";
                                }else{
                                 ?>
                                    <img src="<?php
                                    if ($id_group=='fc') {
                                        echo "../../management_t4t/gbr/poto/".$foto_fc->foto."";
                                    }else{
                                        echo "../images/default.png";
                                    }
                                     ?>" alt="">
                                <?php
                                }
                                 ?>
                                     <?php
                                     if ($id_group=='part') {
                                         echo $_SESSION['nama_part'];
                                     }elseif($id_group=='admoff'){
                                         echo "Admin Officer";
                                     }elseif($id_group=='fin'){
                                         echo "Finance";
                                     }else{
                                         echo $username;
                                     } ?>

                                    <span class=" fa fa-angle-down"></span>
                                </a>
                            <?php
                            if ($id_group=='admoff' or $id_group=='fin') {
                            ?>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="?<?php echo paramEncrypt('hal=change-password')?>">  Change Password</a>
                                    </li>
                                    <li><a href="../login/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            <?php
                            }else{
                            ?>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="?<?php echo paramEncrypt('hal=member-setting-account')?>">  Setting</a>
                                    </li>
                                    <li><a href="?<?php echo paramEncrypt('hal=change-password')?>">  Change Password</a>
                                    </li>
                                    <li><a href="../login/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            <?php
                            }
                            ?>
                            </li>

                            <li role="" class="">
                                <a href="" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-clock-o"> <?php date_default_timezone_set('Asia/Jakarta'); echo " " . date("d F Y - "); ?><span id="clock"></span> WIB.</i>
                                    <!-- <span class="badge bg-green">6</span> -->
                                </a>

                            </li>

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">

           <?php
          }
         //end content

            //pecahkan nilai array

            $page=$var['hal'];

            ############# member ############
            if ($id_order=$var['id_order']) {
                $_SESSION['id_order']=$id_order;
            }

            if ($id_ship=$var['id_ship']) {
                $_SESSION['id_ship']=$id_ship;
            }
            ############# member ############

            ############# fc ############
            #petani detail
            $kd_petani  =$var['kd_petani'];
            $id_desa    =$var['id_desa'];
            $nama_desa  =$var['nama_desa'];
            $nama_kec   =$var['nama_kec'];
            $nama_kab   =$var['nama_kab'];

            #monitoring detail
            $id_lahan   =$var['id_lahan'];
            $mon        =$var['mon'];
            ############# fc ############

            ############# Adm Off #############
            #order list
            $id_member  =$var['id_member'];
            ############# Adm Off #############

            //concate dengan nama file
            $halaman="../pages/$page.php";
            $report="../action/report/$page.php";


          if (!Empty($content)) {
            include "../pages/$content.php";
          }else{
            //jika file yang diinclude tidak ada.
            if(!file_exists($halaman) || empty($page)){
                include "../error/404.php";
            // }elseif($_SESSION['report']==1){
            //     include '$report';
            }else{
                include "$halaman";
            }
          }
            ?>


           <?php

           //include 'footer.php'; ?>

            </div>
            <!-- /page content -->
