<?php
session_start();

include 'connection.php';


$random_pin = rand(10, 1000000);






$check_svn = "";
//            UPLOAD PHOTO FUNCTION  
function fn_resize($image_resource_id, $width, $height)
{
    $target_width = 300;
    $target_height = 300;
    $target_layer = imagecreatetruecolor($target_width, $target_height);
    imagecopyresampled($target_layer, $image_resource_id, 0, 0, 0, 0, $target_width, $target_height, $width, $height);
    return $target_layer;
}





if (isset($_POST['Submit'])) {

    // By  Adedokun Adewale Azeez 
    // description: Escaping or evading malicious attack or threat for unscropulous users
    // <script>alert('You have been hacked')</script>
    $name1 = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['name'])));

    $name = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", strtoupper($name1))));
    $rank = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['rank'])));
    $next_due = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['next_due'])));

    ////CALCULATE NEXT PROMOTION DATE
    $promo_gap = "12";
    $get_days = $promo_gap * 365;
    $next_due1 = date('jS F Y', strtotime($next_due . ' + ' . $get_days . ' days'));
    $db_next_due1 = date('Y-m-d', strtotime($next_due . ' + ' . $get_days . ' days'));

    $gender = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['gender']))); // This is now BQ Occupant Name
    if ($gender == 'male') {
        $gender_no = 0;
    } else {
        $gender_no = 1;
    }

    $svn = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['svn'])));
    $unit = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", strtoupper($_POST['unit']))));
    $dob = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", date("Y-m-d", strtotime($_POST['dob'])))));
    $marital_status = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['marital_status'])));

    $block = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", strtoupper($_POST['block']))));
    $flat_no = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['flat_no'])));
    $room = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['room'])));
    $accomodation_type = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['accomodation_type'])));
    $date_allo = date("Y-m-d", strtotime($_POST['date_allo']));

    $nod = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['nod'])));

    if ($nod == 0 || $nod == "") {
        $nod_details = "None";
    } else {
        $nod_details = $nod;
    }


    $state_of_origin = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['state_of_origin'])));
    $phone = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['phone'])));
    $email = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['email']))); // This is now occupation

    $plate_no1 = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['plate_no1'])));
    $veh_type1 = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['veh_type1'])));

    $plate_no2 = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['plate_no2'])));
    $veh_type2 = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['veh_type2'])));

    $plate_no3 = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['plate_no3'])));
    $veh_type3 = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['veh_type3'])));

    $submit_type1 = mysqli_query($connect, "INSERT INTO car_type (plate_no, type) VALUES('$plate_no1', '$veh_type1')");
    $submit_type2 = mysqli_query($connect, "INSERT INTO car_type (plate_no, type) VALUES('$plate_no2', '$veh_type2')");
    $submit_type3 = mysqli_query($connect, "INSERT INTO car_type (plate_no, type) VALUES('$plate_no3', '$veh_type3')");

    $block_leader = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['block_leader'])));
    $observation = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['observation'])));
    $leader_phone = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['leader_phone'])));

    $username = 'abcfsdhfsfdhfsdfhsd8fsdf9sdfdsfhdf';
    $pass1 = '3986jkhuyiu854';
    $pass = md5($pass1);
    $date = date("Y-m-d");

    $sql_check = "SELECT * FROM census_registration WHERE svn = '$svn'";
    $check = mysqli_query($connect, $sql_check);
    while ($row = mysqli_fetch_assoc($check)) {
        $check_svn = $row['svn'];
    }

    if ($check_svn != "") {
        echo "<script type='text/javascript'> $(document).ready(function(){ 
                swal({
                         title: 'Duplicate!',
                         text: '$name already exist with service number $svn',
                         icon: 'warning',
                        buttons: {
                            confirm : {text:'Ok',className:'sweet-orange'},
                          
                        },
                        closeOnClickOutside: false
                       })
                  
                }); </script>";


    } else {


        //get file name and set to target directory & UPLOAD        
        // Open JPG image
        $target_dir = "images/"; // this is the directory to upload to
        //....................................

        if (is_array($_FILES)) {
            $timestamp = time(); // Get current timestamp
            // $file2 =  $timestamp . '_' . $_FILES['fileToUpload']['tmp_name'];
            $file = $_FILES['fileToUpload22']['tmp_name'];
            $source_properties = getimagesize($file);
            $image_type = $source_properties[2];


            if ($image_type == IMAGETYPE_GIF) {
                $image_resource_id = imagecreatefromgif($file);
                $target_layer = fn_resize($image_resource_id, $source_properties[0], $source_properties[1]);
                $target_file12 = $target_dir . $timestamp . '_' . $_FILES['fileToUpload22']['name'];
                imagegif($target_layer, $target_dir . $timestamp . '_' . $_FILES['fileToUpload22']['name']);

            } elseif ($image_type == IMAGETYPE_PNG) {
                $image_resource_id = imagecreatefrompng($file);
                $target_layer = fn_resize($image_resource_id, $source_properties[0], $source_properties[1]);
                $target_file12 = $target_dir . $timestamp . '_' . $_FILES['fileToUpload22']['name'];
                imagepng($target_layer, $target_dir . $timestamp . '_' . $_FILES['fileToUpload22']['name']);

            } elseif ($image_type == IMAGETYPE_JPEG) {
                $image_resource_id = imagecreatefromjpeg($file);
                $target_layer = fn_resize($image_resource_id, $source_properties[0], $source_properties[1]);
                $target_file12 = $target_dir . $timestamp . '_' . $_FILES['fileToUpload22']['name'];
                imagejpeg($target_layer, $target_dir . $timestamp . '_' . $_FILES['fileToUpload22']['name']);

            }



        }



        // Submit Dependence Here
        if (isset($_POST['namee'])) {
            $namee = $_POST['namee'];
            // $gendere = $_POST['gendere'];
            $agee = $_POST['agee'];
            $relationshipe = $_POST['relationshipe'];
            // $occupatione = $_POST['occupatione'];

            $i = 0;
            foreach ($_POST['namee'] as $value) {

                // $gendere = mysqli_real_escape_string($connect, $_POST['gendere'][$i]);
                $agee = mysqli_real_escape_string($connect, $_POST['agee'][$i]);
                $relationshipe = mysqli_real_escape_string($connect, $_POST['relationshipe'][$i]);
                // $occupatione = mysqli_real_escape_string($connect, $_POST['occupatione'][$i]);

                // File Upload Section
                $target_dir = "images/"; // this is the directory to upload to
                $timestamp = time() . '_' . $i;
                ; // Get current timestamp
                $target_file = $target_dir . $timestamp . '_' . basename($_FILES["fileToUpload"]["name"][$i]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Check if image file is a actual image or fake image
                if (isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$i]);
                    if ($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        // echo "File is not an image.";
                        $uploadOk = 0;
                    }
                }

                // Allow certain file formats
                if (
                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"
                ) {
                    // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }

                // Resize image to reduce file size
                $target_file_resized = $target_dir . $timestamp . '_resized.' . $imageFileType;
                $file = $_FILES["fileToUpload"]["tmp_name"][$i];
                $source_properties = getimagesize($file);
                $image_type = $source_properties[2];

                if ($image_type == IMAGETYPE_GIF) {
                    $image_resource_id = imagecreatefromgif($file);
                } elseif ($image_type == IMAGETYPE_PNG) {
                    $image_resource_id = imagecreatefrompng($file);
                } elseif ($image_type == IMAGETYPE_JPEG) {
                    $image_resource_id = imagecreatefromjpeg($file);
                }

                $new_width = 300; // Set your desired width
                $new_height = 300; // Set your desired height
                $image_resized = imagecreatetruecolor($new_width, $new_height);
                imagecopyresampled($image_resized, $image_resource_id, 0, 0, 0, 0, $new_width, $new_height, $source_properties[0], $source_properties[1]);

                // Save the resized image
                imagejpeg($image_resized, $target_file_resized, 50);

                // MySqli Insert Query
                $sql_statement2 = "INSERT INTO dependency (name, gender, age, relation, occupation, svn, image_path) VALUES ('$value', 'xyz', '$agee', '$relationshipe', 'xyz', '$svn', '$target_file_resized')";
                $result = mysqli_query($connect, $sql_statement2);
                $i++;
            }
        }

        //     $ng_code = "+234";
        //     $phone1 = $ng_code . '08168627861'; // Promoter phone number 09021010387 08168578302
        //     $curl = curl_init();
        //     curl_setopt_array($curl, array(
        //         CURLOPT_URL => 'https://api.ng.termii.com/api/sms/send',
        //         CURLOPT_RETURNTRANSFER => true,
        //         CURLOPT_ENCODING => '',
        //         CURLOPT_MAXREDIRS => 10,
        //         CURLOPT_TIMEOUT => 0,
        //         CURLOPT_FOLLOWLOCATION => true,
        //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //         CURLOPT_CUSTOMREQUEST => 'POST',
        //         CURLOPT_POSTFIELDS => ' {
        //   "to": "' . $phone1 . '",
        //    "from": "NAF",
        //     "sms": "' . $name . ' has been successfully registered. The next due date for promotion is ' . $next_due1 . '.",
        //    "type": "plain",
        //    "channel": "generic",
        //    "api_key": "TL5jl5xbi29yHgC5o8svrV4dNliIeYYqg7zRRTbGZLSlFbT6HW2Iqd4MaWwNuJ"

        //    }',
        //         CURLOPT_HTTPHEADER => array(
        //             'Content-Type: application/json'
        //         ),
        //     )
        //     );
        //     $response = curl_exec($curl);

        ///INSERT NEW MEMBER TO DATABASE
        $sql_statement = "INSERT INTO census_registration (name, rank, gender, svn, dob, block,	unit, flat_no,	room, date_allocated, accomodation_type, marital_status, state_of_origin, phone, nod, nod_details, email, images, gender_no, block_leader, observation, leader_phone, date_reg, db_next_due1, username, password, plate_no1, veh_type1, plate_no2, veh_type2, plate_no3, veh_type3) Values('$name', '$rank','$gender', '$svn','$dob', '$block', '$unit', '$flat_no', '$room', '$date_allo', '$accomodation_type', '$marital_status', '$state_of_origin', '$phone', '$nod', '$nod_details', '$email', '$target_file12', '$gender_no', '$block_leader', '$observation', '$leader_phone', '$date', '$db_next_due1', '$username', '$pass', '$plate_no1', '$veh_type1', '$plate_no2', '$veh_type2', '$plate_no3', '$veh_type3')";
        $result = mysqli_query($connect, $sql_statement);
        if ($result == true) {
            echo "<script type='text/javascript'> $(document).ready(function(){ 
                swal({
                         title: 'Success!',
                         text: '$name with Service number $svn has been successfully registered!!',
                         icon: 'success',
                        buttons: {
                            confirm : {text:'Ok',className:'sweet-orange'},
                          
                        },
                        closeOnClickOutside: false
                       })
                  
                }); </script>";


        }
    }

}




?>




<!DOCTYPE html>
<html lang="en">

<head>
    <title>Personnel Registration</title>
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


    <!--Boostrap & family-->
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <!--<link rel="stylesheet" href="maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->


    <script src="maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>

    </style>

</head>

<body onload="hide_nod()">
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

                        <!-- Page-header start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">OFFRS DATA FORM</h5>
                                            <p class="m-b-0">Offrs Registration</p>
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





                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">

                                        <script>
                                            window.addEventListener('load', function () {
                                                document.querySelector('input[type="file"]').addEventListener('change', function () {
                                                    if (this.files && this.files[0]) {
                                                        var img = document.getElementById('img123');  // $('img')[0]
                                                        var fi = document.getElementById('customFile');
                                                        if (fi.files.length > 0) {
                                                            for (const i = 0; i <= fi.files.length - 1; i++) {

                                                                const fsize = fi.files.item(i).size;
                                                                const file = Math.round((fsize / 1000));
                                                                // The size of the file. 

                                                                img.src = URL.createObjectURL(this.files[0]); // set src to blob url
                                                                img.onload = imageIsLoaded;

                                                            }
                                                        }
                                                    }

                                                });
                                            });
                                        </script>


                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- Basic Form Inputs card start -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>OFFRS DATA FORM</h5>
                                                        <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
                                                    </div>
                                                    <div class="card-block">
                                                        <!--<h4 class="sub-title">Basic Inputs</h4>-->
                                                        <form action="" method="POST" enctype="multipart/form-data">
                                                            <center>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <b>For Iphone users, Please capture 45⁰
                                                                            left</b><br>
                                                                        <img src="images/tilt phone.PNG"
                                                                            style="width: 160px;" alt="">
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div style="width:140px; height:140px;"
                                                                            class="mb-5">
                                                                            <img id="img123" class="myImg" src="#"
                                                                                alt=""
                                                                                style="border: 4px #99ff99 solid; width:140px; height:140px;">
                                                                            <!-- The Modal Enlarge Image-->

                                                                            <div class="custom-file mb-3"
                                                                                style="width: 200px;">
                                                                                <input type="file"
                                                                                    class="custom-file-input"
                                                                                    id="customFile"
                                                                                    name="fileToUpload22"
                                                                                    accept="image/*">
                                                                                <label class="custom-file-label"
                                                                                    for="customFile">Browse</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>



                                                                <div id="myModal33" class="modal22">

                                                                    <img class="modal-content" id="img01">
                                                                    <div id="caption"></div>
                                                                </div>
                                                            </center>

                                                            <div class="row">
                                                                <div class="col-sm-2"></div>
                                                                <div class="col-sm-10">
                                                                    <h5 style="text-decoration: underline;">PERSONNEL
                                                                        INFORMATION</h5>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <input type="hidden" id="duplicate_name" />
                                                                <label class="col-sm-2 col-form-label">Rank:</label>
                                                                <div class="col-sm-10">

                                                                    <input list="browsers" class="form-control"
                                                                        name="rank" id="rank" autocomplete="off"
                                                                        maxlength="70" placeholder="Enter Rank"
                                                                        style="text-transform: capitalize;">
                                                                    <datalist id="browsers">
                                                                        <?php
                                                                        $sql_all_names = mysqli_query($connect, "SELECT  DISTINCT rank FROM census_registration ORDER BY name ASC");
                                                                        while ($row = mysqli_fetch_assoc($sql_all_names)) { ?>
                                                                            <option
                                                                                value="<?php echo $id = $row['rank']; ?>">

                                                                            <?php } ?>
                                                                    </datalist>
                                                                    <!--<input type="text" class="form-control" placeholder="enter Select branch"  name="branch" id="autocom_branch" class="getname"  maxlength="50"  >-->
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <input type="hidden" id="duplicate_name" />
                                                                <label class="col-sm-2 col-form-label">Name:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="enter Name" name="name"
                                                                        id="autocomplete" class="getname" maxlength="50"
                                                                        style="text-transform: uppercase;">
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Service
                                                                    Number:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="enter Service Number" name="svn"
                                                                        id="svn" maxlength="25"
                                                                        style="text-transform: uppercase;">
                                                                </div>
                                                            </div>



                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Unit:</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text" name="unit"
                                                                        placeholder="enter Unit" id="unit"
                                                                        maxlength="70"
                                                                        style="text-transform: capitalize;">
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Marital
                                                                    Status:</label>
                                                                <div class="col-sm-10">
                                                                    <select name="marital_status" id="marital_status"
                                                                        class="form-control">
                                                                        <option value="" disabled selected hidden>select
                                                                            Marital Status</option>
                                                                        <option value="Single">Single</option>
                                                                        <option value="Married">Married</option>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Phone
                                                                    Number:</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="tel"
                                                                        placeholder="enter phone_number" name="phone"
                                                                        id="phone" maxlength="11">
                                                                </div>
                                                            </div>

                                                            <br>
                                                            <div class="row">
                                                                <div class="col-sm-2"></div>
                                                                <div class="col-sm-10">
                                                                    <h5 style="text-decoration: underline;">
                                                                        ACCOMMODATION
                                                                        INFORMATION</h5>
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Block:</label>
                                                                <div class="col-sm-10">
                                                                    <?php
                                                                    if (isset($_SESSION['id_bl'])) {
                                                                        ?>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="enter Block"
                                                                            value="<?php echo $_SESSION['block'] ?>"
                                                                            style="text-transform: capitalize;" id="block"
                                                                            name="block" readonly maxlength="70">

                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <input type="text" class="form-control block"
                                                                            placeholder="enter Block"
                                                                            style="text-transform: capitalize;"
                                                                            autocomplete="off" name="block" maxlength="70">

                                                                        <?php
                                                                    } ?>
                                                                </div>
                                                            </div>


                                                            <script type='text/javascript'>
                                                                $(function () {
                                                                    $(".block").autocomplete({
                                                                        source: function (request, response) {
                                                                            $.ajax({
                                                                                url: "autocomplete_block_aaco.php",
                                                                                type: 'post',
                                                                                dataType: "json",
                                                                                data: {
                                                                                    search: request.term
                                                                                },
                                                                                success: function (data) {
                                                                                    response(data);
                                                                                }
                                                                            });
                                                                        },
                                                                        select: function (event, ui) {
                                                                            $('.block').val(ui.item.label); // display the selected text
                                                                            $('#selectuser_id').val(ui.item.value); // save selected id to input
                                                                            return false;
                                                                        }
                                                                    });
                                                                });   
                                                            </script>



                                                            <script type='text/javascript'>
                                                                $(function () {
                                                                    $(".veh_type").autocomplete({
                                                                        source: function (request, response) {
                                                                            $.ajax({
                                                                                url: "autocomplete_vehicle.php",
                                                                                type: 'post',
                                                                                dataType: "json",
                                                                                data: {
                                                                                    search: request.term
                                                                                },
                                                                                success: function (data) {
                                                                                    response(data);
                                                                                }
                                                                            });
                                                                        },
                                                                        select: function (event, ui) {
                                                                            $('.veh_type').val(ui.item.label); // display the selected text
                                                                            $('#selectuser_id').val(ui.item.value); // save selected id to input
                                                                            return false;
                                                                        }
                                                                    });
                                                                });   
                                                            </script>


                                                            <input type="hidden" readonly
                                                                class="form-control datepicker1" name="next_due"
                                                                id="next_due" style="border-radius: 5px;">

                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Flat No:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="enter Flat No" id="flat_no"
                                                                        style="text-transform: capitalize;"
                                                                        name="flat_no" maxlength="70">
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Type of
                                                                    Accommodation:</label>
                                                                <div class="col-sm-10">
                                                                    <select name="accomodation_type"
                                                                        class="form-control" id="accomodation_type">
                                                                        <option value="" disabled selected hidden>select
                                                                            Accommodation Type</option>
                                                                        <option value="Transit">Transit</option>
                                                                        <option value="Married Qtrs">Married Qtrs
                                                                        </option>
                                                                        <option value="Tie Down">Tie Down</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <!-- <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Occupation/Trade:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" placeholder="enter Occupation/Trade"  type="text" name="occupation" maxlength="50"  style="text-transform: capitalize;">
                                                                </div>
                                                            </div> -->

                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Date
                                                                    Allocated:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="" class="form-control datepicker3"
                                                                        readonly placeholder="Select Date Allocated"
                                                                        name="date_allo" id="date_allo" maxlength="70">
                                                                </div>
                                                            </div>



                                                            <br>
                                                            <div class="row">
                                                                <div class="col-sm-2"></div>
                                                                <div class="col-sm-10">
                                                                    <h5 style="text-decoration: underline;">DEPENDANTS
                                                                        INFORMATION</h5>
                                                                </div>
                                                            </div>



                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Number of
                                                                    Dependants:</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="number"
                                                                        id="get_nod"
                                                                        placeholder="enter Number of Dependants"
                                                                        name="nod" maxlength="50">

                                                                    <div id="textboxesContainer"></div>

                                                                </div>
                                                            </div>





                                                            <!-- <input type="hidden" name="gender" id="gender" value="xyz"> -->
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">BQ Occupant
                                                                    Name</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text"
                                                                        name="gender" id="gender" maxlength="100"
                                                                        placeholder="enter BQ Occupant Name here">
                                                                </div>
                                                            </div>

                                                            <!-- <input type="hidden" name="email" id="email" value="xyz"> -->
                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-sm-2 col-form-label">Occupation</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text" name="email"
                                                                        id="email" maxlength="70"
                                                                        placeholder="enter Occupation here">
                                                                </div>
                                                            </div>


                                                            <br>
                                                            <div class="row">
                                                                <div class="col-sm-2"></div>
                                                                <div class="col-sm-10">
                                                                    <h5 style="text-decoration: underline;">VEHICLES
                                                                        INFORMATION</h5>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">VEHICLE 1</label>
                                                                <div class="col-sm-5">
                                                                    <input class="form-control" type="text"
                                                                        name="plate_no1" maxlength="70"
                                                                        placeholder="enter Vehicle 1 Plate No. here">
                                                                </div>

                                                                <div class="col-sm-5">
                                                                    <input class="form-control veh_type" type="text"
                                                                        name="veh_type1" maxlength="70"
                                                                        placeholder="enter Vehicle 1 Type here">
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">VEHICLE 2</label>
                                                                <div class="col-sm-5">
                                                                    <input class="form-control" type="text"
                                                                        name="plate_no2" maxlength="70"
                                                                        placeholder="enter Vehicle 2 Plate No. here">
                                                                </div>

                                                                <div class="col-sm-5">
                                                                    <input class="form-control veh_type" type="text"
                                                                        name="veh_type2" maxlength="70"
                                                                        placeholder="enter Vehicle 2 Type here">
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">VEHICLE 3</label>
                                                                <div class="col-sm-5">
                                                                    <input class="form-control" type="text"
                                                                        name="plate_no3" maxlength="70"
                                                                        placeholder="enter Vehicle 3 Plate No. here">
                                                                </div>

                                                                <div class="col-sm-5">
                                                                    <input class="form-control veh_type" type="text"
                                                                        name="veh_type3" maxlength="70"
                                                                        placeholder="enter Vehicle 3 Type here">
                                                                </div>
                                                            </div>
                                                            <br>


                                                            <input type="hidden" name="dob" id="dob" value="1970-01-01">
                                                            <!-- <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Date of Birth:</label>
                                                                <div class="col-sm-10">
                                                                      <input type="" readonly class="form-control datepicker2" name="dob" id="dob"  style="border-radius: 5px;" >
                                                                </div>
                                                            </div> -->
                                                            <script>
                                                                $(function () {
                                                                    $(".datepicker1").datepicker({
                                                                        changeYear: true,
                                                                        yearRange: "2010:2050",
                                                                        changeMonth: true,

                                                                        dateFormat: "dd-M-yy"

                                                                    });
                                                                });

                                                                $(function () {
                                                                    $(".datepicker2").datepicker({
                                                                        changeYear: true,
                                                                        yearRange: "1940:2010",
                                                                        changeMonth: true,

                                                                        dateFormat: "dd-M-yy"

                                                                    });
                                                                });


                                                                $(function () {
                                                                    $(".datepicker3").datepicker({
                                                                        changeYear: true,
                                                                        yearRange: "1980:2050",
                                                                        changeMonth: true,

                                                                        dateFormat: "dd-M-yy"

                                                                    });
                                                                });
                                                            </script>












                                                            <input type="hidden" name="room" id="room" value="xyz">
                                                            <!-- <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Room:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" placeholder="enter Room No"  style="text-transform: capitalize;" name="room"  maxlength="70" >
                                                                </div>
                                                            </div> -->














                                                            <input type="hidden" name="state_of_origin"
                                                                id="state_of_origin" value="xyz">
                                                            <!-- <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">State of Origin:</label>
                                                                <div class="col-sm-10">
                                                                    <select name="state_of_origin" id="state_of_origin" class="form-control" >
                                                                    <option value="" disabled selected hidden>select State of Origin</option>
                                                                    <option value="Abia">Abia</option>
                                                                    <option value="Adamawa">Adamawa</option>
                                                                    <option value="AkwaIbom">AkwaIbom</option>
                                                                    <option value="Anambra">Anambra</option>
                                                                    <option value="Bauchi">Bauchi</option>
                                                                    <option value="Bayelsa">Bayelsa</option>
                                                                    <option value="Benue">Benue</option>
                                                                    <option value="Borno">Borno</option>
                                                                    <option value="Cross River">Cross River</option>
                                                                    <option value="Delta">Delta</option>
                                                                    <option value="Ebonyi">Ebonyi</option>
                                                                    <option value="Edo">Edo</option>
                                                                    <option value="Ekiti">Ekiti</option>
                                                                    <option value="Enugu">Enugu</option>
                                                                    <option value="FCT">FCT</option>
                                                                    <option value="Gombe">Gombe</option>
                                                                    <option value="Imo">Imo</option>
                                                                    <option value="Jigawa">Jigawa</option>
                                                                    <option value="Kaduna">Kaduna</option>
                                                                    <option value="Kano">Kano</option>
                                                                    <option value="Katsina">Katsina</option>
                                                                    <option value="Kebbi">Kebbi</option>
                                                                    <option value="Kogi">Kogi</option>
                                                                    <option value="Kwara">Kwara</option>
                                                                    <option value="Lagos">Lagos</option>
                                                                    <option value="Nasarawa">Nasarawa</option>
                                                                    <option value="Niger">Niger</option>
                                                                    <option value="Ogun">Ogun</option>
                                                                    <option value="Ondo">Ondo</option>
                                                                    <option value="Osun">Osun</option>
                                                                    <option value="Oyo">Oyo</option>
                                                                    <option value="Plateau">Plateau</option>
                                                                    <option value="Rivers">Rivers</option>
                                                                    <option value="Sokoto">Sokoto</option>
                                                                    <option value="Taraba">Taraba</option>
                                                                    <option value="Yobe">Yobe</option>
                                                                    <option value="Zamfara">Zamafara</option>
                                                                    </select>
                                                                </div>
                                                            </div> -->






                                                            <input type="hidden" name="block_leader" id="block_leader"
                                                                value="xyz">
                                                            <!-- <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Block Leader:</label>
                                                                <div class="col-sm-10">
                                                                <input  class="form-control"   type="text" name="block_leader"  id="block_leader"    maxlength="50"  placeholder="Block Leader" >                                                                    
                                                                </div>
                                                            </div> -->


                                                            <input type="hidden" name="observation" id="observation"
                                                                value="offrs">
                                                            <!-- <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Observation:</label>
                                                                <div class="col-sm-10">
                                                                    <input  class="form-control"   type="text" name="observation" id="observation"    maxlength="200"  placeholder="Observation" >
                                                                </div>
                                                            </div> -->

                                                            <input type="hidden" name="leader_phone" id="leader_phone"
                                                                value="xyz">
                                                            <!-- <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Block Leader Phone No:</label>
                                                                <div class="col-sm-10">
                                                                <input  class="form-control"   type="tel" name="leader_phone" id="leader_phone"     maxlength="11"  placeholder="Block Leader Phone no." >
                                                                </div>
                                                            </div> -->


                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label"></label>

                                                                <div class="col-sm-10 mx-auto">
                                                                    <input type="hidden" id="hid_sub" value="1">
                                                                    <button type="submit" name="Submit" id="get_submit"
                                                                        class="btn btn-success button-distance">Register</button>
                                                                    <a style="margin-left:70px;" class="btn btn-dark"
                                                                        href="members.php">Clear All</a>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- Basic Form Inputs card end -->
                                            </div>
                                        </div>










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
            $(document).ready(function () {
                $('#get_nod').keyup(function () {
                    const numberOfTextboxesInput = document.getElementById('get_nod');
                    const textboxesContainer = document.getElementById('textboxesContainer');

                    // Clear the existing textboxes
                    textboxesContainer.innerHTML = '';

                    // Get the number entered by the user
                    const numberOfTextboxes = parseInt(numberOfTextboxesInput.value);

                    // Create and append the specified number of sets of text input fields for name, age, and gender
                    for (let i = 0; i < numberOfTextboxes; i++) {
                        // Create a div to hold the set of textboxes with Bootstrap spacing and styling classes
                        const textboxSet = document.createElement('div');
                        textboxSet.className = 'form-group'; // Bootstrap class for form groups

                        // Create and append labels for name, age, and gender with Bootstrap styling classes
                        const nameLabel = document.createElement('label');
                        nameLabel.className = 'col-form-label'; // Bootstrap class for form labels
                        nameLabel.innerHTML = '<h5>' + (i + 1) + ' </h5> Name:';
                        textboxSet.appendChild(nameLabel);

                        // Create and append text input for name with Bootstrap form-control class
                        const nameInput = document.createElement('input');
                        nameInput.className = 'form-control'; // Bootstrap class for form inputs
                        nameInput.type = 'text';
                        nameInput.name = 'namee[]';
                        textboxSet.appendChild(nameInput);

                        const ageLabel = document.createElement('label');
                        ageLabel.className = 'col-form-label';
                        ageLabel.innerHTML = 'Date of Birth:';
                        textboxSet.appendChild(ageLabel);

                        const ageInput = document.createElement('input');
                        ageInput.className = 'form-control';
                        ageInput.type = 'date';
                        ageInput.name = 'agee[]';
                        textboxSet.appendChild(ageInput);




                        // Create and append a select element for gender with options
                        // const genderLabel = document.createElement('label');
                        // genderLabel.className = 'col-form-label';
                        // genderLabel.innerHTML = 'Gender:';
                        // textboxSet.appendChild(genderLabel);

                        // const genderSelect = document.createElement('select');
                        // genderSelect.className = 'form-control'; // Bootstrap class for form inputs
                        // genderSelect.name = 'gendere[]';
                        // const maleOption = document.createElement('option');
                        // maleOption.value = 'Male';
                        // maleOption.text = 'Male';
                        // genderSelect.appendChild(maleOption);
                        // const femaleOption = document.createElement('option');
                        // femaleOption.value = 'Female';
                        // femaleOption.text = 'Female';
                        // genderSelect.appendChild(femaleOption);
                        // textboxSet.appendChild(genderSelect);

                        const relaLabel = document.createElement('label');
                        relaLabel.className = 'col-form-label';
                        relaLabel.innerHTML = 'Relationship:';
                        textboxSet.appendChild(relaLabel);

                        const relaInput = document.createElement('input');
                        relaInput.className = 'form-control';
                        relaInput.type = 'text';
                        relaInput.name = 'relationshipe[]';
                        textboxSet.appendChild(relaInput);


                        // const occuLabel = document.createElement('label');
                        // occuLabel.className = 'col-form-label';
                        // occuLabel.innerHTML = 'Occupation:';
                        // textboxSet.appendChild(occuLabel);

                        // const occuInput = document.createElement('input');
                        // occuInput.className = 'form-control';
                        // occuInput.type = 'text';
                        // occuInput.name = 'occupatione[]';
                        // textboxSet.appendChild(occuInput);

                        // Image Upload Section
                        const imageDiv = document.createElement('div');
                        imageDiv.style.width = '140px';
                        imageDiv.style.height = '140px';
                        imageDiv.className = 'mb-5';

                        const imageTag = document.createElement('img');
                        const imageId = 'img123_' + i;
                        imageTag.id = imageId; // Add unique ID for each image
                        imageTag.className = 'myImg';
                        imageTag.src = '#';
                        imageTag.alt = '';
                        imageTag.style.border = '4px #99ff99 solid';
                        imageTag.style.width = '140px';
                        imageTag.style.height = '140px';
                        imageTag.setAttribute('accept', 'image/*'); // Add accept attribute
                        imageDiv.appendChild(imageTag);

                        const fileDiv = document.createElement('div');
                        fileDiv.className = 'custom-file mb-3';
                        fileDiv.style.width = '200px';

                        const fileInput = document.createElement('input');
                        fileInput.type = 'file';
                        fileInput.className = 'custom-file-input';
                        fileInput.id = 'customFile_' + i; // Add unique ID for each file input
                        fileInput.name = 'fileToUpload[]';
                        fileInput.accept = 'image/*';

                        // Add event listener to dynamically update the image source when a file is selected
                        fileInput.addEventListener('change', function (event) {
                            const selectedFile = event.target.files[0];
                            const imageURL = URL.createObjectURL(selectedFile);
                            document.getElementById(imageId).src = imageURL;
                        });

                        const fileLabel = document.createElement('label');
                        fileLabel.className = 'custom-file-label';
                        fileLabel.htmlFor = 'customFile_' + i;
                        fileLabel.innerText = 'Browse';

                        fileDiv.appendChild(fileInput);
                        fileDiv.appendChild(fileLabel);
                        imageDiv.appendChild(fileDiv);

                        textboxSet.appendChild(imageDiv);


                        // Append a break tag to separate each set of textboxes
                        textboxSet.appendChild(document.createElement('br'));

                        // Append the set of textboxes to the container
                        textboxesContainer.appendChild(textboxSet);
                    }
                });
            });


        </script>






        <!--  Jquery -->
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


        <!--       <script>
       let imgInput = document.getElementById('customFile');
        imgInput.addEventListener('change', function (e) {
            if (e.target.files) {
                let imageFile = e.target.files[0];
                var reader = new FileReader();
                reader.onload = function (e) {
                    var img = document.createElement("img");
                    img.onload = function (event) {
                        // Dynamically create a canvas element
                        var canvas = document.createElement("canvas");

                        // var canvas = document.getElementById("canvas");
                        var ctx = canvas.getContext("2d");

                        // Actual resizing
                        ctx.drawImage(img, 0, 0, 300, 160);

                        // Show resized image in preview element
                        var dataurl = canvas.toDataURL(imageFile.type);
                        document.getElementById("img123").src = dataurl;
                       
                    };
                    img.src = e.target.result;
                };
                reader.readAsDataURL(imageFile);
            }
        });
     </script> -->



        <script>
            function generate_pin() {
                //          var pin_no = document.getElementById('pin').value;
                document.getElementById('pin').value = Math.floor(Math.random() * 1000000);
                return false;
            }
        </script>



        <script>
            $(document).ready(function () {
                //          var check_duplicate = $("#check_duplicate");    
                $("#pin").click(function () {
                    document.getElementById('pin').value = Math.floor(Math.random() * 1000000);
                });
            });

        </script>




        <!--<center style="font-size: 18px; color: #cccccc; margin-top: 400px"><footer class="">&copy;<?php echo date('Y') ?>. By Mr. Matt.</footer></center>-->

        <!-- Script -->
        <script type='text/javascript'>
            $(function () {

                $("#autocomplete").autocomplete({
                    source: function (request, response) {

                        $.ajax({
                            url: "autocomplete.php",
                            type: 'post',
                            dataType: "json",
                            data: {
                                search: request.term
                            },
                            success: function (data) {
                                response(data);
                            }
                        });
                    },
                    select: function (event, ui) {
                        $('#autocomplete').val(ui.item.label); // display the selected text
                        $('#selectuser_id').val(ui.item.value); // save selected id to input
                        $('#duplicate_name').val(ui.item.value); // save selected id to input
                        $('#duplicate_name').trigger('change');
                        return false;
                    }
                });





                $("#autocom_branch").autocomplete({
                    source: function (request, response) {

                        $.ajax({
                            url: "autocom_branch.php",
                            type: 'post',
                            dataType: "json",
                            data: {
                                search: request.term
                            },
                            success: function (data) {
                                response(data);
                            }
                        });
                    },
                    select: function (event, ui) {
                        $('#autocom_branch').val(ui.item.label); // display the selected text
                        //                $('#autocom_branch').val(ui.item.value); // save selected id to input

                        return false;
                    }
                });




                ////////////////////////////////////////////////////////////////////////////
                $("#district_zone").autocomplete({
                    source: function (request, response) {

                        $.ajax({
                            url: "district_zone.php",
                            type: 'post',
                            dataType: "json",
                            data: {
                                search: request.term
                            },
                            success: function (data) {
                                response(data);
                            }
                        });
                    },
                    select: function (event, ui) {
                        $('#district_zone').val(ui.item.label); // display the selected text

                        return false;
                    }
                });





                ////////////////////////////////////////////////////////////////////////////
                $("#group_name").autocomplete({
                    source: function (request, response) {

                        $.ajax({
                            url: "group_name.php",
                            type: 'post',
                            dataType: "json",
                            data: {
                                search: request.term
                            },
                            success: function (data) {
                                response(data);
                            }
                        });
                    },
                    select: function (event, ui) {
                        $('#group_name').val(ui.item.label); // display the selected text

                        return false;
                    }
                });






                //////////////////////////////////////////////////////////////////////////////////////////////////////
                // Multiple select
                $("#multi_autocomplete").autocomplete({
                    source: function (request, response) {

                        var searchText = extractLast(request.term);
                        $.ajax({
                            url: "autocomplete.php",
                            type: 'post',
                            dataType: "json",
                            data: {
                                search: searchText
                            },
                            success: function (data) {
                                response(data);
                            }
                        });
                    },
                    select: function (event, ui) {
                        var terms = split($('#multi_autocomplete').val());

                        terms.pop();

                        terms.push(ui.item.label);

                        terms.push("");
                        $('#multi_autocomplete').val(terms.join(", "));
                        ///////////////////////////////////////////////////////////////////////////////////////
                        // Id
                        var terms = split($('#selectuser_ids').val());

                        terms.pop();

                        terms.push(ui.item.value);

                        terms.push("");
                        $('#selectuser_ids').val(terms.join(", "));

                        return false;
                    }

                });
            });

            function split(val) {
                return val.split(/,\s*/);
            }
            function extractLast(term) {
                return split(term).pop();
            }


            /////////THIS IS TO CHECK BEFORE FINAL DELETION////////
            $(document).ready(function () {

                $("#delete").click(function () {
                    var name_del = document.getElementById('nam').value;
                    if (name_del === "") {
                        alert("Search member to delete first");
                    } else {
                        var del_check = confirm("You will loose all '" + name_del + "' information when you delete. DO YOU WISH TO CONTINUE?");

                        if (del_check === true) {
                            return true;
                        } else {
                            $('#nam').focus();
                            return false;

                        }
                    }
                });

            });
        </script>












        <!--THIS IS TO CHECK REQUIRED FIELDS-->
        <script>
            $(document).ready(function () {
                $("#get_submit").click(function () {
                    // var customFile = document.getElementById("customFile").value
                    if (document.getElementById("autocomplete").value === "") {
                        alert("Enter a valid name");
                        $('#autocomplete').focus();
                        $('#autocomplete').click();
                        return false;

                    } else if (document.getElementById("rank").value === "") {
                        alert("Select Rank");
                        $('#rank').focus();
                        $('#rank').click();
                        return false;





                    } else if (document.getElementById("svn").value === "") {
                        alert("Enter SVN");
                        $('#svn').focus();
                        $('#svn').click();
                        return false;

                    } else if (document.getElementById("unit").value === "") {
                        alert("Enter Unit");
                        $('#unit').focus();
                        $('#unit').click();
                        return false;

                    } else if (document.getElementById("dob").value === "") {
                        alert("Select Date of Birth");
                        $('#dob').focus();
                        $('#dob').click();
                        return false;

                    } else if (document.getElementById("marital_status").value === "") {
                        alert("Select Marital Status");
                        $('#marital_status').focus();
                        $('#marital_status').click();
                        return false;


                    } else if (document.getElementsByClassName("block").value === "") {
                        alert("Enter Block");
                        $('#block').focus();
                        $('#block').click();
                        return false;


                    } else if (document.getElementById("flat_no").value === "") {
                        alert("Enter Flat No");
                        $('#flat_no').focus();
                        $('#flat_no').click();
                        return false;

                    } else if (document.getElementById("date_allo").value === "") {
                        alert("Enter Date Allocated");
                        $('#date_allo').focus();
                        $('#date_allo').click();
                        return false;

                    } else if (document.getElementById("accomodation_type").value === "") {
                        alert("Select Accomodation Type");
                        $('#accomodation_type').focus();
                        $('#accomodation_type').click();
                        return false;

                    } else if (document.getElementById("get_nod").value === "") {
                        //    alert("Enter No. of dependency. Fill 0 for non");                     
                        //    $('#get_nod').focus();
                        //    $('#get_nod').click();                     
                        //    return false;
                        document.getElementById("get_nod").value = 0;

                    } else if (document.getElementById("state_of_origin").value === "") {
                        alert("Select State of Origin");
                        $('#state_of_origin').focus();
                        $('#state_of_origin').click();
                        return false;

                    } else if (document.getElementById("phone").value === "") {
                        alert("Enter phone number");
                        $('#phone').focus();
                        $('#phone').click();
                        return false;

                    } else if (document.getElementById("block_leader").value === "") {
                        alert("Enter Block Leader");
                        $('#block_leader').focus();
                        $('#block_leader').click();
                        return false;

                    } else if (document.getElementById("gender").value === "") {
                        alert("Enter BQ Occupant Name");
                        $('#gender').focus();
                        $('#gender').click();
                        return false;

                    } else if (document.getElementById("email").value === "") {
                        alert("Enter Occupation");
                        $('#email').focus();
                        $('#email').click();
                        return false;


                    } else {
                        return true;
                    }

                });
            });
        </script>















        <!--THIS IS TO PHOTOCOPY NAME-->
        <script>
            $(document).ready(function () {
                //          var check_duplicate = $("#check_duplicate"); //LINK TO GO AND VIEW ALL DEBTORS   
                $(".getname").keyup(function () {


                    var studname = document.getElementById("autocomplete").value;



                    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    }
                    else {// code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }


                    /////THIS IS TO INSERT 
                    xmlhttp.open("GET", "check_name.php?name=" + studname, true);

                    xmlhttp.send();
                    xmlhttp.onreadystatechange = function () {

                        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                            var get_response = xmlhttp.responseText;
                            var new_value = get_response.trim();
                            document.getElementById('duplicate_name').value = new_value;

                        }

                    };


                });












                ///////THIS WAS MEANT TO BRING MORE THAN ONE VARIABLE///////////
                //         $(".getname").keyup(function(){
                //                   var studname = document.getElementById("autocomplete").value;
                //                 
                //            $.ajax({
                //                url: 'check_name',
                //                type: 'POST',
                //                data: 'state_id='+studname,
                //                dataType: 'json',
                //                success:function(data){
                //                    var len = data.length;
                //                    if(len > 0){
                //                    
                ////                        var name = data[0]['name'];
                //                        var real_name = data[0]['real_name'];
                //                        var check_name = data[0]['check_name'];
                //                       
                //                        document.getElementById('duplicate_name').value = check_name;
                //                        document.getElementById('autocomplete').value = real_name;
                //                        document.getElementById('costt1').value = cost;
                //                        document.getElementById('costt1').value = cost;
                //                          $('#costt1').trigger('change');
                //                $('#costt1').value = cost;                
                //                     $('#costt1').focus();
                //                   
                //                   
                //                    }
                //                }
                //              });                  
                //      
                //            });



            });

        </script>


        <script>
            $(document).ready(function () {
                $(".myImg").click(function () {


                    // Get the modal
                    var modal = document.getElementById("myModal33");

                    // Get the image and insert it inside the modal - use its "alt" text as a caption
                    //    var img = document.getElementsByClassName("myImg");
                    var modalImg = document.getElementById("img01");
                    var captionText = document.getElementById("caption");

                    modal.style.display = "block";
                    modalImg.src = this.src;
                    captionText.innerHTML = this.alt;

                });
            });

        </script>
        <script>


            var span = document.getElementsByClassName("modal22")[0];
            $(document).ready(function () {
                $(span).click(function () {
                    var modal = document.getElementById("myModal33");

                    modal.style.display = "none";

                });
            });
        </script>

</body>

</html>