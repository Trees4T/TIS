    <?php 
        error_reporting(0);
        include '../assets/lib-encript/function.php';
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
        }
    ?>

        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="../index.php" class="site_title"><i class="fa fa-tree"></i> <span>Trees4Trees&trade;</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                        <?php 
                        if ($id_group=='fc') {
                            $kode=$_SESSION['kode'];
                            $foto_fc=mysql_fetch_row(mysql_query("select foto from t4t_fc where kode='$kode'"));
                        ?>
                            <img src="../../management_t4t/gbr/poto/<?php echo $foto_fc[0] ?>" alt="..." class="img-circle profile_img" height='60' width='60'>
                        <?php
                        }elseif ($id_group=='part') {
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
                            } 

                            ?>

                                
                                
                                
                            </ul>
                        </div>
                        

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a href="?<?php echo paramEncrypt('hal=member-setting-account')?>" data-toggle="tooltip" data-placement="top" title="Account">
                            <span class="fa fa-user" aria-hidden="true"></span>
                        </a>
                        <a href="?<?php echo paramEncrypt('hal=change-password')?>" data-toggle="tooltip" data-placement="top" title="Change Password">
                            <span class="fa fa-key" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Help">
                            <span class="fa fa-question-circle" aria-hidden="true"></span>
                        </a>
                        <a href="../login/logout.php" data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
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
                                if ($id_group=='part') {
                                    echo " | ";
                                }else{
                                 ?>
                                    <img src="<?php 
                                    if ($id_group=='fc') {
                                        echo "../../management_t4t/gbr/poto/".$foto_fc[0]."";
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
                                     }else{
                                     echo $username;
                                     } ?>
                                    
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="?<?php echo paramEncrypt('hal=member-setting-account')?>">  Setting</a>
                                    </li>
                                    <li><a href="?<?php echo paramEncrypt('hal=change-password')?>">  Change Password</a>
                                    </li>
                                    <!-- 
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge bg-red pull-right">50%</span>
                                            <span>Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">Help</a>
                                    </li> -->
                                    <li><a href="../login/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
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
            //untuk mendecode url yang di encrypsi
            $var=decode($_SERVER['REQUEST_URI']);

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

            //concate dengan nama file
            $halaman="../pages/$page.php";
            $report="../action/report/$page.php";

            //jika file yang diinclude tidak ada.
            if(!file_exists($halaman) || empty($page)){
                include "../error/404.php";
            // }elseif($_SESSION['report']==1){
            //     include '$report';
            }else{
                include "$halaman";
            }
            ?>

            
           <?php //include 'footer.php'; ?>

            </div>
            <!-- /page content -->
