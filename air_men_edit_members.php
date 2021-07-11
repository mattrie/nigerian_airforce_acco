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
    $id = $_POST['idd'];
    $name1 = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['name'])));


    $name = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", strtoupper($name1))));
    $rank = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['rank'])));

    $next_due = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", date("Y-m-d"))));
    ////CALCULATE CLOSING DATE


    $gender = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['gender'])));
    if ($gender == 'male') {
        $gender_no = 0;
    } else {
        $gender_no = 1;
    }

    $svn = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['svn'])));
    $unit = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", strtoupper($_POST['unit']))));
    $dob = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", date("Y-m-d", strtotime($_POST['dob'])))));
    $marital_status = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['marital_status'])));

    $block = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['block'])));
    $flat_no = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['flat_no'])));
    $room = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['room'])));
    $accomodation_type = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['accomodation_type'])));
    $date_allo = date("Y-m-d", strtotime($_POST['date_allo']));


    if ($_SESSION['store_db_next_due1'] != date('Y-m-d', strtotime($next_due))) {
        $promo_gap = "7";
        $get_days = $promo_gap * 365;
        $next_due1 = date('jS F Y', strtotime($next_due . ' + ' . $get_days . ' days'));
        $db_next_due1 = date('Y-m-d', strtotime($next_due . ' + ' . $get_days . ' days'));

        //     $ng_code = "+234";
        //     $phone1 = $ng_code . '08168627861'; // Promoter phone number 09021010387  08168578302
        //     $curl = curl_init();
        //     curl_setopt_array(
        //         $curl,
        //         array(
        //             CURLOPT_URL => 'https://api.ng.termii.com/api/sms/send',
        //             CURLOPT_RETURNTRANSFER => true,
        //             CURLOPT_ENCODING => '',
        //             CURLOPT_MAXREDIRS => 10,
        //             CURLOPT_TIMEOUT => 0,
        //             CURLOPT_FOLLOWLOCATION => true,
        //             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //             CURLOPT_CUSTOMREQUEST => 'POST',
        //             CURLOPT_POSTFIELDS => ' {
        //   "to": "' . $phone1 . '",
        //    "from": "NAF",
        //     "sms": "' . $name . ' has been successfully updated. The next due date for promotion is ' . $next_due1 . '.",
        //    "type": "plain",
        //    "channel": "generic",
        //    "api_key": "TL5jl5xbi29yHgC5o8svrV4dNliIeYYqg7zRRTbGZLSlFbT6HW2Iqd4MaWwNuJ"

        //    }',
        //             CURLOPT_HTTPHEADER => array(
        //                 'Content-Type: application/json'
        //             ),
        //         )
        //     );
        //     $response = curl_exec($curl);

    } else {
        $db_next_due1 = $_SESSION['store_db_next_due1'];
    }

    //CHECK FOR ACCOMODATION CHANGES
    if ($_SESSION['store_flat_no'] != $flat_no || $_SESSION['store_block'] != $block || $_SESSION['store_room'] != $room) {
        $from = $_SESSION['store_date_allo'];
        $to = date("Y-m-d");
        $acc_history = mysqli_query($connect, "INSERT INTO accomodation_history (name, svn, block, flat_no, room, accn_type, date_alloted, date_exited) VALUES ('$name', '$svn', '$block', '$flat_no', '$room', '$accomodation_type',  '$from','$to')");
    }




    $nod = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['nod'])));

    if ($nod == 0 || $nod == "") {
        $nod_details = "None";
    } else {
        $nod_details = $nod;
    }


    $state_of_origin = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['state_of_origin'])));
    $phone = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['phone'])));
    $email = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['email'])));

    $plate_no1 = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['plate_no1'])));
    $veh_type1 = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['veh_type1'])));

    $plate_no2 = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['plate_no2'])));
    $veh_type2 = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['veh_type2'])));


    $submit_type1 = mysqli_query($connect, "INSERT INTO car_type (plate_no, type) VALUES('$plate_no1', '$veh_type1')");
    $submit_type2 = mysqli_query($connect, "INSERT INTO car_type (plate_no, type) VALUES('$plate_no2', '$veh_type2')");

    $block_leader = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['block_leader'])));
    $observation = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['observation'])));
    $leader_phone = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['leader_phone'])));


    $date = date("Y-m-d");

    $sql_check = "SELECT * FROM census_registration WHERE svn = '$svn'";
    $check = mysqli_query($connect, $sql_check);
    while ($row = mysqli_fetch_assoc($check)) {
        $check_svn = $row['svn'];
    }

    if ($check_svn == "er439eru8t8ue8ut89ue98rutuer98tu89erut89eur8tu98ert") {
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


        if (!empty($_FILES['fileToUpload22']['name'])) {

            //get file name and set to target directory & UPLOAD        
            // Open JPG image
            $target_dir = "images/"; // this is the directory to upload to
            //....................................
            $target_dir2 = "client/images/"; // this is the directory to upload to         
            if (is_array($_FILES)) {
                $timestamp = time(); // Get current timestamp
                // $file2 =  $timestamp . '_' . $_FILES['fileToUpload22']['tmp_name'];
                $file = $_FILES['fileToUpload22']['tmp_name'];
                $source_properties = getimagesize($file);
                $image_type = $source_properties[2];

                if ($image_type == IMAGETYPE_GIF) {
                    $image_resource_id = imagecreatefromgif($file);
                    $target_layer = fn_resize($image_resource_id, $source_properties[0], $source_properties[1]);
                    $target_file22 = $target_dir . $timestamp . '_' . $_FILES['fileToUpload22']['name'];
                    imagegif($target_layer, $target_dir . $timestamp . '_' . $_FILES['fileToUpload22']['name']);
                    // imagegif($target_layer, $timestamp . '_' .$target_dir2 . $_FILES['fileToUpload']['name']);

                } elseif ($image_type == IMAGETYPE_PNG) {
                    $image_resource_id = imagecreatefrompng($file);
                    $target_layer = fn_resize($image_resource_id, $source_properties[0], $source_properties[1]);
                    $target_file22 = $target_dir . $timestamp . '_' . $_FILES['fileToUpload22']['name'];
                    imagepng($target_layer, $target_dir . $timestamp . '_' . $_FILES['fileToUpload22']['name']);
                    // imagepng($target_layer, $timestamp . '_' . $target_dir2 . $_FILES['fileToUpload']['name']);

                } elseif ($image_type == IMAGETYPE_JPEG) {
                    $image_resource_id = imagecreatefromjpeg($file);
                    $target_layer = fn_resize($image_resource_id, $source_properties[0], $source_properties[1]);
                    $target_file22 = $target_dir . $timestamp . '_' . $_FILES['fileToUpload22']['name'];
                    imagejpeg($target_layer, $target_dir . $timestamp . '_' . $_FILES['fileToUpload22']['name']);
                    // imagejpeg($target_layer, $timestamp . '_' .$target_dir2 . $_FILES['fileToUpload']['name']);
                }



            }


        } else {
            if (isset($_POST['imge'])) {
                $images = $_POST['imge'];
                @$target_file22 = $images;
            }

        }



        // Submit Dependence Here
// DELETE THE OLD TO REPLACE WITH THE NEW
        $result_delete = mysqli_query($connect, "DELETE FROM dependency WHERE svn ='$svn'");

        foreach (@$_POST['namee'] as $key => $value) {
            // $gendere = mysqli_real_escape_string($connect, $_POST['gendere'][$key]);
            $agee = mysqli_real_escape_string($connect, date("Y-m-d", strtotime($_POST['agee'][$key])));
            //$date_allo = date("Y-m-d", strtotime($_POST['agee'][$key])) ;
            $relationshipe = mysqli_real_escape_string($connect, $_POST['relationshipe'][$key]);
            // $occupatione = mysqli_real_escape_string($connect, $_POST['occupatione'][$key]);
            $value = mysqli_real_escape_string($connect, $value);

            // File Upload Section
            $target_dir = "images/"; // this is the directory to upload to
            $timestamp = time() . '_' . $key;
            $target_file_resized = '';

            // Check if a new image is uploaded for this dependent
            if ($_FILES["new_image"]["size"][$key] > 0) {
                // File upload and image resizing logic here
                $file = $_FILES['new_image']['tmp_name'][$key];
                $source_properties = getimagesize($file);
                $image_type = $source_properties[2];
                $uploadOk = 1;

                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["new_image"]["tmp_name"][$key]);
                if ($check === false) {
                    $uploadOk = 0;
                }

                // Allow certain file formats
                if ($image_type != IMAGETYPE_JPEG && $image_type != IMAGETYPE_PNG && $image_type != IMAGETYPE_GIF) {
                    $uploadOk = 0;
                }

                // Resize image to reduce file size if upload is valid
                if ($uploadOk) {
                    $new_width = 300; // Set your desired width
                    $new_height = 300; // Set your desired height

                    // Create a new image resource based on the file type
                    switch ($image_type) {
                        case IMAGETYPE_JPEG:
                            $image_resource_id = imagecreatefromjpeg($file);
                            break;
                        case IMAGETYPE_PNG:
                            $image_resource_id = imagecreatefrompng($file);
                            break;
                        case IMAGETYPE_GIF:
                            $image_resource_id = imagecreatefromgif($file);
                            break;
                    }

                    // Create a new true color image with the desired dimensions
                    $image_resized = imagecreatetruecolor($new_width, $new_height);

                    // Resample the original image to the new image with the desired dimensions
                    imagecopyresampled($image_resized, $image_resource_id, 0, 0, 0, 0, $new_width, $new_height, $source_properties[0], $source_properties[1]);

                    // Save the resized image to the target directory
                    $target_file_resized = $target_dir . $timestamp . '_resized.' . image_type_to_extension($image_type);
                    imagejpeg($image_resized, $target_file_resized, 50); // Adjust quality as needed

                    // Free up memory
                    imagedestroy($image_resource_id);
                    imagedestroy($image_resized);
                }
            }

            // Check if an existing image is submitted for this dependent
            if (empty($target_file_resized) && isset($_POST['existing_image'][$key])) {
                // If no new image submitted, keep the existing image path
                $existing_image_path = mysqli_real_escape_string($connect, $_POST['existing_image'][$key]);
                $sql_statement2 = "INSERT INTO dependency (name, gender, age, relation, occupation, svn, image_path) VALUES ('$value', 'xyz', '$agee', '$relationshipe', 'xyz', '$svn', '$existing_image_path')";
                $result = mysqli_query($connect, $sql_statement2);
            } elseif (isset($target_file_resized)) {
                // If a new image is uploaded, insert the new image path
                $sql_statement2 = "INSERT INTO dependency (name, gender, age, relation, occupation, svn, image_path) VALUES ('$value', 'xyz', '$agee', '$relationshipe', 'xyz', '$svn', '$target_file_resized')";
                $result = mysqli_query($connect, $sql_statement2);
            }


        }






        ///INSERT NEW MEMBER TO DATABASE
        $sql_statement = "UPDATE census_registration SET name = '$name', rank = '$rank', gender= '$gender', svn = '$svn', dob= '$dob', block = '$block', unit= '$unit', flat_no = '$flat_no',	room = '$room', date_allocated='$date_allo' ,accomodation_type='$accomodation_type', marital_status = '$marital_status', state_of_origin = '$state_of_origin', phone = '$phone', nod = '$nod', nod_details = '$nod_details', email = '$email', images = '$target_file22', gender_no = '$gender_no', block_leader = '$block_leader', observation = '$observation', leader_phone = '$leader_phone', db_next_due1 = '$db_next_due1', plate_no1 = '$plate_no1', veh_type1 = '$veh_type1', plate_no2 = '$plate_no2', veh_type2 = '$veh_type2' WHERE id=$id";
        $result = mysqli_query($connect, $sql_statement);



        if ($result == true) {







            echo "<script type='text/javascript'> $(document).ready(function(){ 
                swal({
                         title: 'Success!',
                         text: '$name with Service number $svn has been successfully updated!!',
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



if (isset($_POST['Delete'])) {
    $id = $_POST['idd'];
    $name1 = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['name'])));
    $name = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", strtoupper($name1))));
    $svn = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['svn'])));

    $sql_delete = mysqli_query($connect, "DELETE FROM census_registration WHERE id = '$id'");
    $get_error = mysqli_error($connect);
    $sql_delete_dependent = mysqli_query($connect, "DELETE FROM dependency WHERE svn = '$svn'");
    ;

    if ($sql_delete == true) {

        echo "<script type='text/javascript'> $(document).ready(function(){ 
            swal({
                     title: 'Success!',
                     text: '$name with Service number $svn has been successfully deleted!!',
                     icon: 'success',
                    buttons: {
                        confirm : {text:'Ok',className:'sweet-orange'},
                      
                    },
                    closeOnClickOutside: false
                   })
              
            }); </script>";

    } else {
        echo "<script>alert('$get_error')</script>";
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Airmen / Airwomen Registration</title>
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

                        <!-- Page-header start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Edit Airmen / Airwomen Registration</h5>
                                            <p class="m-b-0">Edit Airmen / Airwomen Registration</p>
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
                                                        <h5>Edit Airmen / Airwomen Registration</h5>
                                                        <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
                                                    </div>
                                                    <div class="card-block">
                                                        <form action="" method="POST"
                                                            enctype="multipart/form-data">
                                                            <center>
                                                                <div class="input-group mb-3">
                                                                    <?php
                                                                    if (isset($_SESSION['id_bl'])) {
                                                                        ?>
                                                                        <input list="datal" class="form-control" name="srch"
                                                                            placeholder="Search Personnel" required=""
                                                                            autocomplete="off" maxlength="70"
                                                                            placeholder="Enter Rank"
                                                                            style="text-transform: capitalize;">
                                                                        <datalist id="datal">
                                                                            <?php
                                                                            $sql_all_names = mysqli_query($connect, "SELECT  DISTINCT name FROM census_registration WHERE block = '" . $_SESSION['block'] . "' ORDER BY name ASC");
                                                                            while ($row = mysqli_fetch_assoc($sql_all_names)) { ?>
                                                                                <option
                                                                                    value="<?php echo $id = $row['name']; ?>">

                                                                                <?php } ?>
                                                                        </datalist>

                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <input type="text" class="form-control"
                                                                            id="autocomplete" name="srch"
                                                                            placeholder="Search Personnel" required="">


                                                                        <?php
                                                                    }
                                                                    ?>




                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-primary" id="btnsearch"
                                                                            name="btnsrch" type="submit">SEARCH</button>
                                                                    </div>
                                                                </div>
                                                            </center>


                                                            <!--///////////////////////////////////////////-->

                                                            <?php
                                                            $date_allo = $db_next_due1 = $name = $rank = $gender = $svn = $dob = $block = $unit = $flat_no = $room = $accomodation_type = $marital_status = $state_of_origin = $phone = $nod = $nod_details = $email = $images = $gender_no = $block_leader = $observation = $leader_phone = $date_reg = $plate_no1 = $plate_no2 = $plate_no3 = $veh_type1 = $veh_type2 = $veh_type3 = "";
                                                            //          session_start();
                                                            
                                                            if (isset($_GET['namee'])) {
                                                                $get_name = $_GET['namee'];
                                                                $sql_state = "SELECT * FROM census_registration WHERE name = '$get_name'";
                                                                $result = mysqli_query($connect, $sql_state);

                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    $id = $row["id"];

                                                                    $name = $row["name"];
                                                                    $rank = $row["rank"];
                                                                    $gender = $row["gender"];
                                                                    $dob = $row["dob"];
                                                                    $svn = $row["svn"];
                                                                    $block = $row["block"];
                                                                    $unit = $row["unit"];
                                                                    $flat_no = $row["flat_no"];
                                                                    $room = $row["room"];
                                                                    $accomodation_type = $row["accomodation_type"];
                                                                    $marital_status = $row["marital_status"];
                                                                    $state_of_origin = $row["state_of_origin"];

                                                                    $phone = $row["phone"];
                                                                    $nod = $row["nod"];
                                                                    $nod_details = $row["nod_details"];
                                                                    $email = $row["email"];
                                                                    $images = $row["images"];
                                                                    $date_allo = $row["date_allocated"];
                                                                    $db_next_due1 = $row["db_next_due1"];

                                                                    $block_leader = $row["block_leader"];
                                                                    $observation = $row["observation"];
                                                                    $leader_phone = $row["leader_phone"];

                                                                    $email = $row["email"];
                                                                    $plate_no1 = $row["plate_no1"];
                                                                    $veh_type1 = $row["veh_type1"];

                                                                    $plate_no2 = $row["plate_no2"];
                                                                    $veh_type2 = $row["veh_type2"];

                                                                    $date_reg = $row["date_reg"];



                                                                }

                                                                $_SESSION['store_flat_no'] = $flat_no;
                                                                $_SESSION['store_block'] = $block;
                                                                $_SESSION['store_room'] = $room;
                                                                $_SESSION['store_date_allo'] = $date_allo;
                                                                $_SESSION['store_db_next_due1'] = $db_next_due1;

                                                                if ($id < 1) {
                                                                    echo "<script type='text/javascript'> $(document).ready(function(){ 
                  swal({
                           title: 'Error!',
                           text: '$get_name does not exist',
                           icon: 'error',
                          buttons: {
                              confirm : {text:'Ok',className:'sweet-orange'},
                            
                          },
                          closeOnClickOutside: false
                         })
                    
                  }); </script>";
                                                                }

                                                                //   $_SESSION['email'] = $email;
                                                                //   $older_name = $name;
                                                            

                                                            }

                                                            if (isset($_POST['btnsrch'])) {
                                                                $id = "";
                                                                $get_name = $_POST['srch'];
                                                                if (isset($_SESSION['block'])) {
                                                                    $sql_state = "SELECT * FROM census_registration WHERE name = '$get_name' AND block = '" . $_SESSION['block'] . "'";
                                                                } else {
                                                                    $sql_state = "SELECT * FROM census_registration WHERE name = '$get_name' ";
                                                                }

                                                                $result = mysqli_query($connect, $sql_state);

                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    $id = $row["id"];

                                                                    $name = $row["name"];
                                                                    $rank = $row["rank"];
                                                                    $gender = $row["gender"];
                                                                    $dob = $row["dob"];
                                                                    $svn = $row["svn"];
                                                                    $block = $row["block"];
                                                                    $unit = $row["unit"];
                                                                    $flat_no = $row["flat_no"];
                                                                    $room = $row["room"];
                                                                    $accomodation_type = $row["accomodation_type"];
                                                                    $marital_status = $row["marital_status"];
                                                                    $state_of_origin = $row["state_of_origin"];


                                                                    $db_next_due1 = $row["db_next_due1"];
                                                                    $phone = $row["phone"];
                                                                    $nod = $row["nod"];
                                                                    $nod_details = $row["nod_details"];
                                                                    $email = $row["email"];
                                                                    $images = $row["images"];
                                                                    $date_allo = $row["date_allocated"];

                                                                    $block_leader = $row["block_leader"];
                                                                    $observation = $row["observation"];
                                                                    $leader_phone = $row["leader_phone"];

                                                                    $email = $row["email"];

                                                                    $plate_no1 = $row["plate_no1"];
                                                                    $veh_type1 = $row["veh_type1"];

                                                                    $plate_no2 = $row["plate_no2"];
                                                                    $veh_type2 = $row["veh_type2"];

                                                                    $date_reg = $row["date_reg"];

                                                                }

                                                                $_SESSION['store_flat_no'] = $flat_no;
                                                                $_SESSION['store_block'] = $block;
                                                                $_SESSION['store_room'] = $room;
                                                                $_SESSION['store_date_allo'] = $date_allo;
                                                                $_SESSION['store_db_next_due1'] = $db_next_due1;
                                                                if ($id < 1) {
                                                                    echo "<script type='text/javascript'> $(document).ready(function(){ 
                  swal({
                           title: 'Not found!',
                           text: '$get_name does not exist',
                           icon: 'error',
                          buttons: {
                              confirm : {text:'Ok',className:'sweet-orange'},
                            
                          },
                          closeOnClickOutside: false
                         })
                    
                  }); </script>";
                                                                }

                                                                //   $_SESSION['email'] = $email;
                                                                //   $older_name = $name;
                                                            


                                                            }
                                                            ?>



                                                        </form>
                                                        <!--<h4 class="sub-title">Basic Inputs</h4>-->
                                                        <form id="myForm" action="" method="POST"
                                                            enctype="multipart/form-data">
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
                                                                            <img class="myImg" id="img123"
                                                                                src="<?php echo $images; ?>"
                                                                                alt="<?php echo $name ?>"
                                                                                style="border: 4px #99ff99 solid; width:140px; height:140px;">
                                                                            <input type="hidden" name="idd" id="idd"
                                                                                value="<?php echo $id; ?>" />
                                                                            <input type="hidden" name="imge"
                                                                                value="<?php echo $images; ?>" />
                                                                            <div class="custom-file mb-3"
                                                                                style="width: 200px;">
                                                                                <input type="file"
                                                                                    class="custom-file-input"
                                                                                    id="customFile"
                                                                                    name="fileToUpload22"
                                                                                    accept="image/*">
                                                                                <i class="custom-file-label"
                                                                                    for="customFile">Choose Photo>></i>
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
                                                                <label class="col-sm-2 col-form-label">Service
                                                                    Number:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="enter Service Number"
                                                                        value="<?php echo $svn ?>" name="svn" id="svn"
                                                                        maxlength="25"
                                                                        style="text-transform: uppercase;" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <input type="hidden" id="duplicate_name" />
                                                                <label class="col-sm-2 col-form-label">Rank:</label>
                                                                <div class="col-sm-10">
                                                                    <input list="browsers" class="form-control"
                                                                        name="rank" id="rank" required=""
                                                                        value="<?php echo $rank ?>" autocomplete="off"
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
                                                                    <!--<input type="text" class="form-control" placeholder="enter Select branch"  name="branch" id="autocom_branch" class="getname"  maxlength="50"  required>-->
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <input type="hidden" id="duplicate_name" />
                                                                <label class="col-sm-2 col-form-label">Name:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="enter Name" name="name"
                                                                        id="namee11" value="<?php echo $name ?>"
                                                                        maxlength="50"
                                                                        style="text-transform: uppercase;" required>
                                                                </div>
                                                            </div>


                                                            <input type="hidden" readonly
                                                                class="form-control datepicker1" name="next_due" value="<?php if ($name == '') {
                                                                    echo "";
                                                                } else {
                                                                    echo date('d-M-y', strtotime($db_next_due1));
                                                                } ?>" style="border-radius: 5px;" required="">
                                                            <!-- <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Next Promotion:</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">        
                                                                       
                                                                        <div class="input-group-append">
                                                                            <select name="promo_gap"  class="form-control" id="">
                                                                                <option value="" selected hidden disabled>Gap (Yrs.)</option>
                                                                                <option value="3">3</option>
                                                                                <option value="4">4</option>
                                                                                <option value="5">5</option>
                                                                                <option value="6">6</option>
                                                                                <option value="7">7</option>
                                                                            </select>                    
                                                                        </div>              

                                                                    </div>
                                                                 </div>
                                                            </div> -->





                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Unit:</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text" name="unit"
                                                                        placeholder="enter Unit"
                                                                        value="<?php echo $unit ?>" id="group_name"
                                                                        maxlength="70"
                                                                        style="text-transform: capitalize;" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Marital
                                                                    Status:</label>
                                                                <div class="col-sm-10">
                                                                    <select name="marital_status" class="form-control"
                                                                        required>
                                                                        <option value="<?php echo $marital_status ?>">
                                                                            <?php echo $marital_status ?>
                                                                        </option>
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
                                                                        value="<?php echo $phone ?>"
                                                                        placeholder="enter phone_number" name="phone"
                                                                        maxlength="11" required>
                                                                </div>
                                                            </div>



                                                            <br>
                                                            <div class="row">
                                                                <div class="col-sm-2"></div>
                                                                <div class="col-sm-10">
                                                                    <h5 style="text-decoration: underline;">
                                                                        ACCOMMODATION INFORMATION</h5>
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
                                                                            style="text-transform: capitalize;" name="block"
                                                                            readonly maxlength="70" required="">

                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <input type="text" class="form-control block"
                                                                            placeholder="enter Block"
                                                                            style="text-transform: capitalize;" name="block"
                                                                            value="<?php echo $block ?>" maxlength="70"
                                                                            required="">

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
                                                                            $('#autocomplete').val(ui.item.label); // display the selected text
                                                                            $('#selectuser_id').val(ui.item.value); // save selected id to input
                                                                            return false;
                                                                        }
                                                                    });
                                                                });   
                                                            </script>

                                                            <script type='text/javascript'>
                                                                $(function () {
                                                                    $(".veh_type22").autocomplete({
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
                                                                            $('.veh_type22').val(ui.item.label); // display the selected text
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



                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Flat No:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="enter Flat No"
                                                                        value="<?php echo $flat_no ?>"
                                                                        style="text-transform: capitalize;"
                                                                        name="flat_no" maxlength="70" required="">
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Type of
                                                                    Accommodation:</label>
                                                                <div class="col-sm-10">
                                                                    <select name="accomodation_type"
                                                                        class="form-control" id="accomodation_type"
                                                                        required>
                                                                        <option
                                                                            value="<?php echo $accomodation_type ?>">
                                                                            <?php echo $accomodation_type ?>
                                                                        </option>
                                                                        <option value="Transit">Transit</option>
                                                                        <option value="Married Qtrs">Married Qtrs
                                                                        </option>
                                                                        <option value="Tie Down">Tie Down</option>
                                                                    </select>
                                                                </div>
                                                            </div>



                                                            <div class="form-group row">
                                                                <label class="col-sm-2 ">Date Allocated:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="" class="form-control datepicker3"
                                                                        <?php $store_da_allo = date("d M Y", strtotime($date_allo));
                                                                        if ($store_da_allo == "01 Jan 1970") {
                                                                            $store_da_allo = "Select Date Allocated";
                                                                        }
                                                                        ?> readonly
                                                                        placeholder="Select Date Allocated"
                                                                        value="<?php echo $store_da_allo ?>"
                                                                        name="date_allo" id="date_allo" maxlength="70">
                                                                </div>
                                                            </div>

                                                            <script>
                                                                $(function () {
                                                                    $(".datepicker3").datepicker({
                                                                        changeYear: true,
                                                                        yearRange: "1980:2050",
                                                                        changeMonth: true,

                                                                        dateFormat: "dd-M-yy"

                                                                    });
                                                                });
                                                            </script>

                                                            <br>
                                                            <div class="row">
                                                                <div class="col-sm-2"></div>
                                                                <div class="col-sm-10">
                                                                    <h5 style="text-decoration: underline;">DEPENDANTS
                                                                        INFORMATION</h5>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">
                                                                    Dependants:</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="hidden"
                                                                        id="numberOfTextboxes" value="1"
                                                                        placeholder="enter Number of Dependants" name=""
                                                                        required maxlength="50">
                                                                    <input type="hidden" name="nod"
                                                                        value="<?php echo $nod; ?>" id="get_nods">

                                                                    <div id="textboxesContainer">
                                                                        <?php
                                                                        $sn = 1;
                                                                        $get_dep = mysqli_query($connect, "SELECT * FROM dependency WHERE svn = '$svn'");
                                                                        while ($row = mysqli_fetch_array($get_dep)) {
                                                                            $get_name = $row['name'];
                                                                            echo '<div class="form-group">';
                                                                            echo '<h5>' . $sn . '.</h5>';
                                                                            echo '(To edit image <span style="font-size: 18px;">' . $sn . '</span> please delete and click "Add" to re-enter all details)<br>';
                                                                            echo '<label class="col-form-label">Name:</label>';
                                                                            echo '<input class="form-control" type="text" name="namee[]" value="' . $row['name'] . '">';
                                                                            echo '<label class="col-form-label">Date of Birth:</label>';
                                                                            echo '<input class="form-control" type="text" name="agee[]" onclick="this.type=(\'date\')" value="' . date("d M Y", strtotime($row['age'])) . '">';
                                                                            // echo '<label class="col-form-label">Gender:</label>';
                                                                            // echo '<select class="form-control" name="gendere[]">';
                                                                            // echo '<option value="Male"' . ($row['gender'] == 'Male' ? ' selected' : '') . '>Male</option>';
                                                                            // echo '<option value="Female"' . ($row['gender'] == 'Female' ? ' selected' : '') . '>Female</option>';
                                                                            // echo '</select>';
                                                                            echo '<label class="col-form-label">Relationship:</label>';
                                                                            echo '<input class="form-control" type="text" name="relationshipe[]" value="' . $row['relation'] . '">';
                                                                            // echo '<label class="col-form-label">Occupation:</label>';
                                                                            // echo '<input class="form-control" type="text" name="occupatione[]" value="' . $row['occupation'] . '">';
                                                                            // Display the image if available
                                                                            echo '<img class="myImg" id="image_' . $sn . '" src="' . $row['image_path'] . '" alt="' . $row['name'] . '" style="max-width: 200px; max-height: 200px;"><br>';
                                                                            echo '<input type="hidden" name="existing_image[]" value="' . $row['image_path'] . '" id="img_value"> ';
                                                                            echo '<input type="file" name="new_image[]" accept="image/*" onchange="updateImage(' . $sn . ', this)"><br><br>'; // File input for uploading a new image
                                                                        
                                                                            echo '<button class="btn btn-danger" onclick="removeTextboxes(this)">Delete ' . $sn . '  &nbsp;</button>';
                                                                            echo '<br>';
                                                                            echo '<br>';
                                                                            echo '</div>';
                                                                            $sn++;

                                                                        }
                                                                        ?>
                                                                    </div>

                                                                    <script>
                                                                        function updateImage(sn, input) {
                                                                            var file = input.files[0];
                                                                            var reader = new FileReader();

                                                                            reader.onload = function (e) {
                                                                                var imgId = 'image_' + sn;
                                                                                var img = document.getElementById(imgId);
                                                                                img.src = e.target.result;
                                                                                document.getElementById("img_value").value = "";
                                                                            };

                                                                            reader.readAsDataURL(file);
                                                                        }
                                                                    </script>
                                                                    <a href="##" class="btn btn-success"
                                                                        id="createTextboxes">Add </a>

                                                                    <!-- <button ></button> -->

                                                                </div>

                                                            </div>





                                                            <input type="hidden" name="dob" id="dob" value="1970-01-01">
                                                            <!-- <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Date of
                                                                    Birth:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="" readonly class="form-control"
                                                                        name="dob" id="datepicker"
                                                                        value="<?php //echo $dob   ?>"
                                                                        style="border-radius: 5px;" required="">
                                                                </div>
                                                            </div> -->



                                                            <input type="hidden" name="gender" id="gender" value="xyz">
                                                            <!-- <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Gender:</label>
                                                                <div class="col-sm-10">
                                                                    <select name="gender" class="form-control" required>
                                                                        <option value="<?php //echo $gender   ?>">
                                                                            <?php // echo $gender   ?>
                                                                        </option>
                                                                        <option value="MALE">MALE</option>
                                                                        <option value="FEMALE">FEMALE</option>
                                                                    </select>
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
                                                                    $("#datepicker").datepicker({
                                                                        changeYear: true,
                                                                        yearRange: "1930:2010",
                                                                        changeMonth: true,

                                                                        dateFormat: "dd-M-yy"

                                                                    });
                                                                });
                                                            </script>







                                                            <input type="hidden" name="room" id="room" value="xyz">
                                                            <!-- <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Room:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="enter Room No"
                                                                        value="<?php // echo $room   ?>"
                                                                        style="text-transform: capitalize;" name="room"
                                                                        maxlength="70">
                                                                </div>
                                                            </div> -->






                                                            <!-- <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Occupation/Trade:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" placeholder="enter Occupation/Trade"  type="text" name="occupation" maxlength="50" required style="text-transform: capitalize;">
                                                                </div>
                                                            </div> -->






                                                            <input type="hidden" name="state_of_origin"
                                                                id="state_of_origin" value="xyz">
                                                            <!-- <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">State of
                                                                    Origin:</label>
                                                                <div class="col-sm-10">
                                                                    <select name="state_of_origin" class="form-control"
                                                                        required>
                                                                        <option value="<?php // echo $state_of_origin   ?>">
                                                                            <?php // echo $state_of_origin   ?>
                                                                        </option>
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

                                                            <input type="hidden" name="email" id="email" value="xyz">
                                                            <!-- <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Email
                                                                    (Optional):</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="email"
                                                                        name="email" value="<?php // echo $email   ?>"
                                                                        maxlength="50" placeholder="enter Email here">
                                                                </div>
                                                            </div> -->

                                                            <!-- <input type="hidden" name="block_leader" id="block_leader" value="xyz"> -->
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Block
                                                                    Leader:</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text"
                                                                        name="block_leader" required="" maxlength="50"
                                                                        value="<?php echo $block_leader ?>"
                                                                        placeholder="Block Leader">

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
                                                                        name="plate_no1"
                                                                        value="<?php echo $plate_no1 ?>" maxlength="70"
                                                                        placeholder="enter Vehicle 1 Plate No. here">
                                                                </div>

                                                                <div class="col-sm-5">
                                                                    <input class="form-control veh_type" type="text"
                                                                        name="veh_type1"
                                                                        value="<?php echo $veh_type1 ?>" maxlength="70"
                                                                        placeholder="enter Vehicle 1 Type here">
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">VEHICLE 2</label>
                                                                <div class="col-sm-5">
                                                                    <input class="form-control" type="text"
                                                                        name="plate_no2"
                                                                        value="<?php echo $plate_no2 ?>" maxlength="70"
                                                                        placeholder="enter Vehicle 2 Plate No. here">
                                                                </div>

                                                                <div class="col-sm-5">
                                                                    <input class="form-control veh_type22" type="text"
                                                                        name="veh_type2"
                                                                        value="<?php echo $veh_type2 ?>" maxlength="70"
                                                                        placeholder="enter Vehicle 2 Type here">
                                                                </div>
                                                            </div>

                                                            <br>


                                                            <input type="hidden" name="observation" id="observation"
                                                                value="Airmen/Airwomen">
                                                            <!-- <div class="form-group row">
                                                                <label
                                                                    class="col-sm-2 col-form-label">Observation:</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text"
                                                                        name="observation"
                                                                        value="<?php //echo $observation   ?>"
                                                                        maxlength="200" placeholder="Observation">
                                                                </div>
                                                            </div> -->

                                                            <input type="hidden" name="leader_phone" id="leader_phone"
                                                                value="xyz">
                                                            <!-- <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Block Leader
                                                                    Phone No:</label>
                                                                <div class="col-sm-10">
                                                                <input class="form-control" type="tel"
                                                                            name="leader_phone" required="" maxlength="11"
                                                                            value="<?php echo $leader_phone ?>"
                                                                            placeholder="Block Leader Phone no.">
                                                                </div>
                                                            </div> -->


                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label"></label>

                                                                <div class="col-sm-10 mx-auto">
                                                                    <input type="hidden" id="get_sub1" value="1">
                                                                    <button type="submit" name="Submit" id="get_sub"
                                                                        class="btn btn-success button-distance">Update</button>

                                                                    <button type="submit" name="Delete" id="delete"
                                                                        style="margin-left:70px;"
                                                                        class="btn btn-danger">Delete</button>
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
            // Initialize the serial number to the last fetched value
            let sn = <?php echo $sn; ?>;

            $(document).ready(function () {
                $("#createTextboxes").click(function () {
                    var get_svn = document.getElementById("svn").value;

                    if (get_svn === "") {
                        swal({
                            title: 'Not Allowed!',
                            text: 'Search for personnel to add or remove Dependants',
                            icon: 'warning',
                            buttons: {
                                confirm: { text: 'Ok', className: 'sweet-orange' },

                            },
                            closeOnClickOutside: false
                        });
                    } else {
                        const numberOfTextboxesInput = document.getElementById('numberOfTextboxes');
                        const textboxesContainer = document.getElementById('textboxesContainer');

                        // Create a div to hold the set of textboxes with Bootstrap spacing and styling classes
                        const textboxSet = document.createElement('div');
                        textboxSet.className = 'form-group'; // Bootstrap class for form groups

                        // Create and append labels for name, age, and gender with Bootstrap styling classes
                        const nameLabel = document.createElement('label');
                        nameLabel.className = 'col-form-label'; // Bootstrap class for form labels
                        nameLabel.innerHTML = 'Name:';
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


                        // Create and append file input for image
                        const imageLabel = document.createElement('label');
                        imageLabel.className = 'col-form-label';
                        imageLabel.innerHTML = 'Image:';
                        textboxSet.appendChild(imageLabel);

                        const imageInput = document.createElement('input');
                        imageInput.className = 'form-control';
                        imageInput.type = 'file';
                        imageInput.name = 'new_image[]';
                        imageInput.accept = 'image/*';
                        textboxSet.appendChild(imageInput);

                        // Create and append image tag to display selected image
                        const previewImage = document.createElement('img');
                        previewImage.className = 'preview-image';
                        previewImage.style.display = 'none'; // Initially hide the preview image
                        previewImage.style.width = '140px'; // Set width to 140px
                        previewImage.style.height = '140px'; // Set height to 140px
                        previewImage.style.border = '4px solid #99ff99'; // Add border
                        textboxSet.appendChild(previewImage);

                        // Add event listener to the file input for image
                        imageInput.addEventListener('change', function (event) {
                            const file = event.target.files[0]; // Get the selected file
                            const reader = new FileReader();

                            // When file reader has loaded the file
                            reader.onload = function (e) {
                                // Set the source of the preview image to the loaded file
                                previewImage.src = e.target.result;
                                previewImage.style.display = 'block'; // Show the preview image
                            };

                            // Read the selected file as a data URL
                            reader.readAsDataURL(file);
                        });




                        // Append a "Remove" button for each set
                        const removeButton = document.createElement('button');
                        removeButton.textContent = 'Delete ' + sn;
                        removeButton.className = 'btn btn-danger';
                        removeButton.onclick = function () {
                            // Remove the entire set when the "Remove" button is clicked
                            textboxesContainer.removeChild(textboxSet);
                            // Decrement the serial number
                            sn--;
                        };
                        textboxSet.appendChild(removeButton);

                        // Append a break tag to separate each set of textboxes
                        textboxSet.appendChild(document.createElement('br'));

                        // Increment the serial number
                        sn++;

                        // Update the serial number in the new set
                        const serialNumber = document.createElement('h5');
                        serialNumber.textContent = sn - 1;
                        textboxSet.insertBefore(serialNumber, nameLabel);

                        // Append the set of textboxes to the container
                        textboxesContainer.appendChild(textboxSet);


                        //count nods

                        // Define the class name that identifies each set
                        const setClassName = 'col-form-label'; // This should match the class name you used for each set

                        // Find all elements with the specified class name within the container
                        const sets = textboxesContainer.getElementsByClassName(setClassName);

                        // Count the number of sets found
                        const totalSets = sets.length;
                        document.getElementById('get_nods').value = totalSets / 5

                        return false;

                    }

                });
            });

            function removeTextboxes(button) {
                const textboxesContainer = document.getElementById('textboxesContainer');
                const textboxSet = button.parentNode;
                // Remove the entire set when the "Remove" button is clicked
                textboxesContainer.removeChild(textboxSet);
                // Decrement the serial number
                sn--;


                // Define the class name that identifies each set
                const setClassName = 'col-form-label'; // This should match the class name you used for each set

                // Find all elements with the specified class name within the container
                const sets = textboxesContainer.getElementsByClassName(setClassName);

                // Count the number of sets found
                const totalSets = sets.length;
                document.getElementById('get_nods').value = totalSets / 5
                return false;
            }


        </script>



        <script>
            $(document).ready(function () {
                $('#get_sub').click(function () {
                    var idd = document.getElementById('idd').value;
                    if (idd === "") {
                        swal({
                            title: 'Not Allowed!',
                            text: 'Search for personnel to update',
                            icon: 'warning',
                            buttons: {
                                confirm: { text: 'Ok', className: 'sweet-orange' },

                            },
                            closeOnClickOutside: false
                        });
                        return false;
                    } else {
                        return true;
                    }
                });
            });

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
                            url: "autocomplete_airmen.php",
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
                    var name_del = document.getElementById('namee11').value;
                    if (name_del === "") {
                        alert("Search personnel to delete first");
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












        <!--THIS IS TO CHECK DUPLICATE-->
        <script>
            $(document).ready(function () {

                $("#check_duplicate").click(function () {
                    ///////////////////////////////////////////////////////////////////
                    //             alert("Processing: You have clicked submit button, do not click again");
                    var hid_sub = document.getElementById('hid_sub').value;
                    document.getElementById('hid_sub').value = "0";
                    document.getElementById('hid_sub').value = "1";


                    if (hid_sub === "0") {
                        swal({
                            title: 'Not Allowed!',
                            text: 'Processing: You have already clicked submit button, cannot resubmit',
                            icon: 'error',
                            buttons: {
                                confirm: { text: 'Ok', className: 'sweet-orange' }

                            },
                            closeOnClickOutside: false
                        });
                        return false;
                    }
                    ////////////////////////////////////////////////////////////   
                    var get_name = document.getElementById('autocomplete').value;
                    var trim_name = get_name.trim();
                    document.getElementById('autocomplete').value = trim_name;

                    var studname = $("#autocomplete");
                    var duplicate_nam = $("#duplicate_name");


                    if (get_name === "") {
                        swal({
                            title: 'Not Allowed!',
                            text: 'Please fill the form to register a member first',
                            icon: 'error',
                            buttons: {
                                confirm: { text: 'Ok', className: 'sweet-orange' }

                            },
                            closeOnClickOutside: false
                        });

                        return false;
                    } else {
                        if (duplicate_nam.val() === studname.val()) {
                            var spell_name = document.getElementById('autocomplete').value;
                            swal({
                                title: 'Duplicate!',
                                text: spell_name + ' been registered or used. Please alternate',
                                icon: 'warning',
                                buttons: {
                                    confirm: { text: 'Ok', className: 'sweet-orange' }

                                },
                                closeOnClickOutside: false
                            });

                            return false;
                        }
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