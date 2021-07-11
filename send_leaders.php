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







if(isset($_POST['sub_sms1'])){
    // By  Adedokun Adewale Azeez 
    $single_block = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['single_block'])));
    $message = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['message'])));

    $result_block = mysqli_query($connect, "SELECT * FROM block_assign WHERE block = '$single_block'");
    while($row = mysqli_fetch_array($result_block)){
        $get_phone = $row['phone'];
    }


   
        //["' . $phone1 . '", "' . $phone1 . '"] multiple sms
        $ng_code = "+234";
        $phone1 = $ng_code . $get_phone; // 09021010387 Request handler phone number ##08029549088##
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.ng.termii.com/api/sms/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => ' {
      "to": "' . $phone1 . '",
       "from": "NAF",
        "sms": "'.$single_block.' \n Message: '.$message.'.",
       "type": "plain",
       "channel": "generic",
       "api_key": "TL5jl5xbi29yHgC5o8svrV4dNliIeYYqg7zRRTbGZLSlFbT6HW2Iqd4MaWwNuJ"

       }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        // echo "<script>alert('$response')</script>";
        echo "<script>alert('Message Sent Successfully')</script>";
  
}








////Multiple SMS
if(isset($_POST['sub_sms2'])){
    $message = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['message'])));

    $result_block = mysqli_query($connect, "SELECT * FROM block_assign ");
    while($row = mysqli_fetch_array($result_block)){
        // $get_phone = $row['phone'];

        $ng_code = "+234";
        $phone1 = $ng_code . $row['phone']; // 09021010387 Request handler phone number ##08029549088##
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.ng.termii.com/api/sms/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => ' {
      "to": "' . $phone1 . '",
       "from": "NAF",
        "sms": "Message: '.$message.'.",
       "type": "plain",
       "channel": "generic",
       "api_key": "TL5jl5xbi29yHgC5o8svrV4dNliIeYYqg7zRRTbGZLSlFbT6HW2Iqd4MaWwNuJ"

       }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        // echo "<script>alert('$response')</script>";
        echo "<script>alert('Message Sent Successfully')</script>";
    
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Send Block Leader SMS</title>
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
                                        <h2>Message</h2>
                                        <form action="" method="post">
                                          <textarea  id="message" class="form-control" name="message" required rows="5"></textarea>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h5>Send to Single Block Leader</h5>
                                                <div class="input-group">

                                                <input list="datalist" autocomplete="off" name="single_block" id="single_block" placeholder="Select Block" class="form-control" >
                                                <datalist id="datalist">
                                                    <?php 
                                                        $sql_get_block = mysqli_query($connect, "SELECT DISTINCT block FROM block_assign ORDER BY block ASC");
                                                        while($row = mysqli_fetch_array($sql_get_block)){
                                                            ?>

                                                            <option value="<?php echo $row['block']?>"></option>
                                                            <?php

                                                        }
                                                    ?>
                                                </datalist>

                                                    <div class="input-group-append">
                                                        <button type="submit" name="sub_sms1" id="check_single" class="btn btn-info">Send Single</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 text-center">                                               
                                                <h5>Send to All</h5>
                                                <button type="submit" name="sub_sms2" class="btn btn-primary">Send All</button>
                                            </div>
                                        </div>
                                        </form>

                                      
                                        
                                        <!-- Page-body end -->
                                    </div>

                                    <div id="styleSelector"> </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            $(document).ready(function() {
                $('#check_single').click(function() {
                    var single_block = document.getElementById('single_block').value;
                    var message = document.getElementById('message').value;

                    if (message === "") {
                        icons = "warning";
                        swal({
                            title: "Not Allowed",
                            text: "Please enter message to send",
                            icon: icons,
                            buttons: {
                                confirm: { text: "Ok", className: "sweet-orange" },
                            },
                            closeOnClickOutside: false,
                            });
                            return false;
                        
                    } else if (single_block === "") {                       
                        icons = "warning";
                        swal({
                            title: "Not Allowed",
                            text: "Please select block!!",
                            icon: icons,
                            buttons: {
                                confirm: { text: "Ok", className: "sweet-orange" },
                            },
                            closeOnClickOutside: false,
                            });
                            return false;
                    } else {
                        return true;
                    }
                });
            });
        </script>

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