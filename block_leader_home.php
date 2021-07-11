<?php
session_start();
include 'connection.php';
if (empty($_SESSION['id_bl'])) {

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
                     window.location = 'block_leader.php';
                   });
                }); </script>";
}


if(isset($_POST['sub_request'])){
    // By  Adedokun Adewale Azeez
    $name = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['name']))); 
    $_GET['namee'] = $name;
    $svn = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['svn']))); 
    $block = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['block'])));
    $block_leader = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['block_leader']))); 
    $phone = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['phone']))); 
    $rank = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['rank']))); 
    $unit = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['unit']))); 
    $request = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['request'])));
    $date = date("Y-m-d");
    
    $store_name = $name;
    $submit_request = mysqli_query($connect, "INSERT INTO request (name, svn, rank, unit, request, date, status) VALUES('$name', '$svn', '$rank', '$unit', '$request', '$date', 'pending')");

    if ($submit_request == true) {
        //["' . $phone1 . '", "' . $phone1 . '"] multiple sms
        $ng_code = "+234";
        $phone1 = $ng_code . '08168627861'; // 09021010387 Request handler phone number ##08029549088##
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
        "sms": "'.$name.' Request. \n SVN: '.$svn.'.\n Rank: '. $rank .' .\n Unit: '. $unit .'.\n Block: '. $block .'.\n Phone: '. $phone .'\n Messsage: '.$request.'.",
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
    }
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
                                                <a href="block_leader_home"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="block_leader_home">Dashboard</a>
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



                                          
                                            <!--  sale analytics end -->

                                            <!-- Project statustic start -->

                                        </div>




                                        <h2>Welcome <?php echo $_SESSION['bl_full_name'] ?></h2>
                                                <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                            <h4><?php echo $_SESSION['block'] ?> Leader</h4>
                                            </div>

                                            <div class="col-sm-6">
                                                <b>Make a request on behalf of <?php echo $_SESSION['block'] ?> occupnat(s)</b>
                                                <br>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                                    Make a Request
                                                </button>
                                            </div>
                                        </div>   
                                        <br><br>
                                        
                                        <?php  
                                        
                                                   //loop through all table rows
                                                   $inc = 1;
                                                   $count_all = mysqli_query($connect, "SELECT COUNT(id) as count_all FROM census_registration WHERE block = '".$_SESSION['block']."'");
                                                   while ($row = mysqli_fetch_array($count_all)) {
                                                     $everbody = $row['count_all'];
                                                   }
                                                   $result = mysqli_query($connect, "SELECT * FROM census_registration WHERE block = '".$_SESSION['block']."' ORDER BY id DESC");
                                                   echo '<input type="hidden" id="get_table_name" value="ALL REGISTERED: [' . $_SESSION['block'] . '] "';
                                                   echo ' <div class="card">';
                                                   echo '<div class="card-block table-border-style">';
       
                                                   echo '<div class="table-responsive" >';
                                                   echo '<CAPTION><h3 align="center" style="font-size:20px; color:black;" >ALL REGISTERED: ' . $_SESSION['block'] . '</h3></CAPTION>';
                                                   echo '<table class="table table-bordered table-striped   table-hover " id="myTable">';
       
                                                   echo ' <thead class="thead-dark">';
       
                                                   echo '<tr align = "center">';
                                                   echo '<th>S/N</th>';
                                                   echo '<th>Name</th>';
                                                   echo '<th>Rank</th>';
                                                   echo '<th>Gender</th>';
                                                   echo '<th>Service Number</th>';
                                                   echo '<th>Unit</th>';
                                                   echo '<th>Date of Birth</th>';
                                                   echo '<th>Phone</th>';
                                                   echo '<th>Block</th>';                                     
                                                  
                                                   echo '<th>Flat No</th>';
                                                   echo '<th>Room</th>';
                                                   echo '<th>Accn</th>';
                                                   echo '<th>Marital Status</th>';
                                                   echo '<th>State of Origin</th>';
                                                   echo '<th>Number of Dependants</th>';
                                                   // echo '<th>Dependants Details</th>';
       
                                                   echo '<th>View Details</th>';
                                                   echo '<th>Edit</th>';
                                                   echo '</tr>';
       
                                                   echo '</thead>';
       
                                                   echo '<tbody class="" style="font-family: sans-serif; color:black ; font-weight:bold;">';
                                                   while ($row = mysqli_fetch_array($result)) {
       
       
       
                                                       echo "<tr align = 'center'>";
                                                       echo "<td>" . $inc . "</td>";
                                                       echo "<td>" . $row['name'] . "</td>";
                                                       echo "<td>" . $row['rank'] . "</td>";
                                                       echo "<td>" . $row['gender'] . "</td>";
                                                       echo "<td>" . $row['svn'] . "</td>";
                                                       echo "<td>" . $row['unit'] . "</td>";
                                                       echo "<td>" . date("d-M-Y", strtotime($row['dob'])). "</td>";
                                                       echo "<td>" . $row['phone'] . "</td>";
                                                       echo "<td>" . $row['block'] . "</td>";                                              
                                                      
                                                    
                                                       echo "<td>" . $row['flat_no'] . "</td>";
                                                       echo "<td>" . $row['room'] . "</td>";
                                                       echo "<td>" . $row['accomodation_type'] . "</td>";
                                                       echo "<td>" . $row['marital_status'] . "</td>";
                                                       echo "<td>" . $row['state_of_origin'] . "</td>";
                                                       echo "<td>" . $row['nod'] . "</td>";
                                                       // echo "<td>" . $row['nod_details'] . "</td>";                                                
                                                       echo "<td ><a style='color: blue;' href='view_member.php?svn=" . $row['svn'] . "'>View details</a></td>";
       
                                                       echo "<td ><a style='color: brown;' href='edit_members.php?namee=" . $row['name'] . "'>Edit </a></td>";
       
                                                       echo "</tr>";
                                                       $inc++;
                                                   }
       
       
       
       
       
                                                   echo ' </tbody>';
                                                   echo ' </table>';
       
                                                   echo '</div>';
                                                   echo '</div>';
                                                   echo '</div>';
                                        
                                        ?>
                                            
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


        



                                                <div class="modal" id="myModal">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Fill Accurately</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>


                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <form action="" method="post">
                                                                <label for="">Name:</label>
                                                                <input type="text" name="name" class="form-control" required>
                                                                <br>

                                                                <label for="">SVN:</label>
                                                                <input type="text" name="svn" class="form-control" required>
                                                                <br>

                                                                <label for="">Rank:</label>
                                                                <input type="text" name="rank" class="form-control" required>
                                                                <br>

                                                                <label for="">Phone:</label>
                                                                <input type="number" name="phone" class="form-control" required>
                                                                <br>

                                                                <label for="">Unit:</label>
                                                                <input type="text" name="unit" class="form-control" required>
                                                                <input type="hidden" name="block" value="<?php echo $_SESSION['block'] ?>">
                                                                <input type="hidden" name="block_leader" value="<?php echo $_SESSION['block_leader'] ?>">
                                                                <br>
                                                                
                                                                <label for="">Request:</label>
                                                                <textarea  class="form-control" name="request" rows="5" required maxlength="200"></textarea>
                                                                <br>
                                                                <button type="submit" name="sub_request" class="btn btn-success">SUBMIT</button>
                                                            </form>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>

                                                        </div>
                                                    </div>
                                                </div>



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