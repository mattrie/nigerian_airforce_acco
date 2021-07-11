<?php
session_start();
include 'connection.php';
if (empty($_SESSION['id_admin'])) {

    echo "<script type='text/javascript'> $(document).ready(function(){
                swal({
                         title: 'Sorry!',
                         text: 'You must first login ooooo',
                         icon: 'error',
                        buttons: {
                            confirm : {text:'Enter',className:'sweet-orange'},

                        },
                        closeOnClickOutside: false
                       })
                  .then(function() {
                     window.location = 'fin_admin.php';
                   });
                }); </script>";
}


if (isset($_SESSION['store_black_list'])) {
    echo $_SESSION['store_black_list'];
    $_SESSION['store_black_list'] = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>DashBoard</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
          <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="keywords"
        content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="Codedthemes" />
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <!-- waves.css -->
    <link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
    <!-- waves.css -->
    <link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- themify icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <!-- font-awesome-n -->
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome-n.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <!-- scrollbar.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">




    <!-- Script -->
    <script src='jquery-3.1.1.min.js' type='text/javascript'></script>

    <!-- jQuery UI -->

    <link href='jquery-ui.min.css' rel='stylesheet' type='text/css'>
    <script src='jquery-ui.min.js' type='text/javascript'></script>
    <script src='sweetalert.min.js' type='text/javascript'></script>

    <!--Boostrap & family-->
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <!--<link rel="stylesheet" href="maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->


    <script src="maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


</head>

<body>

    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <?php
            include 'admin_nav1.php';
            ?>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <?php
                    include 'admin_nav2.php';
                    ?>
                    <div class="pcoded-content">
                        <?php
                        $summation_loan = $summation_contribution = $summation_withdraw = $summation_repay = $summation_bal = $summation_disburseloan = $count_members = $expenses = $revenue = $profit = $expenses_year = $summation_loan_monthly = $revenue_year = $profit_year = $summation_disburseloan_weekly = $total_disburseloan_all = $count_active = $count_non_active = $summation_savings = $summation_investment = $summation_equity = $summation_repay_weekly = $total_repayall = $summation_loan_weekly = $total_loan = "";

                        /////TEMPOARILY REMOVE ILLEGAL UPDATES
                        

                        $count_all = mysqli_query($connect, "SELECT COUNT(id) as count_all FROM census_registration");
                        while ($row = mysqli_fetch_array($count_all)) {
                            $everbody = $row['count_all'];
                        }

                        ///GET ALL DEBTORS FOR DAILY
                        ////////////THIS IS TO SUM DAILY
                        $total_repay11 = mysqli_query($connect, "SELECT SUM(repay) as total FROM allloan");
                        while ($row = mysqli_fetch_array($total_repay11)) {
                            $summation_repay11 = $row['total'];
                        }

                        ////////////THIS IS TO SUM DAILY
                        $total_daily = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM allloan");
                        while ($row = mysqli_fetch_array($total_daily)) {
                            $summation_loan11 = $row['total'];
                        }

                        $summation_loan = $summation_loan11 - $summation_repay11;

                        $sum_unearned = 0;
                        $sum_unearned22 = mysqli_query($connect, "SELECT SUM(sum_unearned) as total FROM allloan");
                        while ($row = mysqli_fetch_array($sum_unearned22)) {
                            $sum_unearned = $row['total'];
                        }




                        //////TODAYS DATE
                        date_default_timezone_set("Africa/Lagos");
                        $todays_date = date("jS F Y");
                        ?>





                        <!-- Page-header start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Home</h5>
                                            <p class="m-b-0">Dashboard</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="admin_home"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="admin_home">Dashboard</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Page-header end -->




                        <!-----------------------DATE AND TIME------------------------>
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body ">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <div class="row">

                                            <div class="col-xl-3 col-md-12">
                                                <div class="card mat-clr-stat-card text-white blue ">
                                                    <div class="card-block">
                                                        <div class="row">
                                                            <div class="col-3 text-center bg-c-blue">
                                                                <i class="fas fa-calendar mat-icon f-24"></i>
                                                            </div>
                                                            <div class="col-9 cst-cont">
                                                                <h5 style="color:#003300;">
                                                                    <?php echo $todays_date; ?>
                                                                </h5>
                                                                <!-- <p class="m-b-0">More Blessings Today</p> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card mat-clr-stat-card text-white blue">
                                                    <div class="card-block">
                                                        <div class="row">
                                                            <div class="col-3 text-center bg-c-blue">
                                                                <i class="fas fa-clock mat-icon f-24"></i>
                                                            </div>
                                                            <div class="col-9 cst-cont">
                                                                <h5>
                                                                    <label id="Hour" style="color:#003300;"></label>
                                                                    <label id="Minut" style="color:#003300;"></label>
                                                                    <label id="Second" style="color:#003300;"></label>
                                                                    <label style="color:#003300; ">
                                                                        <?php echo date("A"); ?>
                                                                    </label>
                                                                </h5>
                                                                <!-- <p class="m-b-0" >God's time is the Best</p> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!----------------------END DATE AND TIME------------------------>




                                            <!-----------------MEMBERS ARENA----------------------->

                                            <!-- Material statustic card start -->
                                            <div class="col-xl-3 col-md-12">

                                            </div>







                                            <div class="col-xl-3 col-md-12">

                                            </div>





                                            <div class="col-xl-3 col-md-12">

                                            </div>
                                            <!----------------END MEMBERS ARENA----------------------->




                                            <!----------------PENALTY ARENA-------------------->


                                            <!---------------END PENALTY ARENA-------------------->



                                            <div class="col-xl-12 col-md-12">
                                                <div class="row">
                                                    <!-- sale card start -->
                                                    <!--TOTAL LOAN PORTFOLIO-->
                                                    <div class="col-md-4">
                                                        <div class="card text-center text-c-red order-visitor-card">
                                                            <a href="all_members.php">
                                                                <div class="card-block">

                                                                    <h6 class="m-b-0"> Total Number Registered
                                                                    </h6>

                                                                    <h2 class="m-t-15 m-b-15" style="color: blue;"><b
                                                                            class=""></b>
                                                                        <?php echo $everbody; ?>
                                                                    </h2>

                                                                    <p class="m-b-0" style="font-size: 16px;"></p>

                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>







                                                    <!-- sale card end -->
                                                </div>
                                            </div>

                                            <!--  sale analytics end -->

                                            <!-- Project statustic start -->

                                        </div>
                                        <!-- Page-body end -->
                                    </div>

                                    <div id="styleSelector"> </div>
                                </div>
                                <center style="font-size: 18px; color: black; margin-top: 5px;">
                                    <footer class="">&copy;
                                        <?php echo date('Y') ?>
                                    </footer>
                                </center>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Warning Section Starts -->
        <!-- Older IE warning message -->
        <!--[if lt IE 10]>
        <div class="ie-warning">
            <h1>Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="assets/images/browser/chrome.png" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="assets/images/browser/firefox.png" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="assets/images/browser/opera.png" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="assets/images/browser/safari.png" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="assets/images/browser/ie.png" alt="">
                            <div>IE (9 & above)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
        <![endif]-->
        <!-- Warning Section Ends -->


        <script type="text/javascript">
            function timedMsg() {
                var t = setInterval("change_time();", 1000);
            }
            function change_time() {
                var d = new Date();
                var curr_hour = d.getHours();
                var curr_min = d.getMinutes();
                var curr_sec = d.getSeconds();
                if (curr_hour > 12)
                    curr_hour = curr_hour - 12;
                document.getElementById('Hour').innerHTML = curr_hour + ':';
                document.getElementById('Minut').innerHTML = curr_min + ':';
                document.getElementById('Second').innerHTML = curr_sec;
            }
            timedMsg();
        </script>



        <!-- Required Jquery -->
        <script type="text/javascript" src="assets/js/jquery/jquery.min.js "></script>
        <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js "></script>
        <script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js "></script>
        <!-- waves js -->
        <script src="assets/pages/waves/js/waves.min.js"></script>
        <!-- jquery slimscroll js -->
        <script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>

        <!-- slimscroll js -->
        <script src="assets/js/jquery.mCustomScrollbar.concat.min.js "></script>

        <!-- menu js -->
        <script src="assets/js/pcoded.min.js"></script>
        <script src="assets/js/vertical/vertical-layout.min.js "></script>

        <script type="text/javascript" src="assets/js/script.js "></script>







</body>

</html>