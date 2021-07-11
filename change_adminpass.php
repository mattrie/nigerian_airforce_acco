<?php



session_start();


include 'connection.php';

$get_old_pass = "";
if (isset($_POST['submit'])) {


    $password_old1 = $_POST['password_old'];
    $new = $_POST['password1'];
    $confirm1 = $_POST['password2'];

    //            UPLOAD PHOTO FUNCTION  
    function fn_resize($image_resource_id, $width, $height)
    {
        $target_width = 300;
        $target_height = 300;
        $target_layer = imagecreatetruecolor($target_width, $target_height);
        imagecopyresampled($target_layer, $image_resource_id, 0, 0, 0, 0, $target_width, $target_height, $width, $height);
        return $target_layer;
    }


    if (!empty($_FILES['fileToUpload']['name'])) {
        //           THIS IS TO UPLOAD PASSPORT PHOTO  

        $target_dir = "images/"; // this is the directory to upload to
        //....................................


        if (is_array($_FILES)) {
            $file = $_FILES['fileToUpload']['tmp_name'];
            $source_properties = getimagesize($file);
            $image_type = $source_properties[2];
            if ($image_type == IMAGETYPE_JPEG) {
                $image_resource_id = imagecreatefromjpeg($file);
                $target_layer = fn_resize($image_resource_id, $source_properties[0], $source_properties[1]);
                $target_file = $target_dir . $_FILES['fileToUpload']['name'];
                imagejpeg($target_layer, $target_dir . $_FILES['fileToUpload']['name']);


            } elseif ($image_type == IMAGETYPE_GIF) {
                $image_resource_id = imagecreatefromgif($file);
                $target_layer = fn_resize($image_resource_id, $source_properties[0], $source_properties[1]);
                $target_file = $target_dir . $_FILES['fileToUpload']['name'];
                imagegif($target_layer, $target_dir . $_FILES['fileToUpload']['name']);


            } elseif ($image_type == IMAGETYPE_PNG) {
                $image_resource_id = imagecreatefrompng($file);
                $target_layer = fn_resize($image_resource_id, $source_properties[0], $source_properties[1]);
                $target_file = $target_dir . $_FILES['fileToUpload']['name'];
                imagepng($target_layer, $target_dir . $_FILES['fileToUpload']['name']);


            }
        }
    } else {
        $target_file = $_SESSION['store_image'];
    }



    @$name = $_SESSION['name_id_admin'];
    @$password = $_SESSION['password_admin'];
    @$id = $_SESSION['id_admin'];

    $password_old = md5($password_old1);
    $sql_check_old = mysqli_query($connect, "SELECT * FROM admin WHERE id = '$id'");
    while ($row = mysqli_fetch_assoc($sql_check_old)) {
        $get_old_pass = $row['pass'];
    }
    if ($get_old_pass == $password_old) {
        if ($id == "") {
            echo "<script type='text/javascript'> $(document).ready(function(){ 
                swal({
                         title: 'Acces denied!',
                         text: 'Login required!!',
                         icon: 'error',
                        buttons: {
                            confirm : {text:'Ok',className:'sweet-orange'},
                          
                        },
                        closeOnClickOutside: false
                       })
                  
                }); </script>";


        } elseif ($new != $confirm1) {

            echo "<script type='text/javascript'> $(document).ready(function(){ 
                swal({
                         title: 'Password does not match!',
                         text: 'Please make sure you confirm  password choosen!!',
                         icon: 'warning',
                        buttons: {
                            confirm : {text:'Ok',className:'sweet-orange'},
                          
                        },
                        closeOnClickOutside: false
                       })
                  
                }); </script>";



        } else {
            $confirm = md5($confirm1);

            $sql_statement = "UPDATE admin SET pass = '$confirm', imagess = '$target_file' WHERE id ='$id'";
            $result = mysqli_query($connect, $sql_statement);

            if ($result == true) {
                echo "<script type='text/javascript'> $(document).ready(function(){ 
                swal({
                         title: 'Success!',
                         text: 'Your password has been encrypted with MD5 ($confirm)',
                         icon: 'success',
                        buttons: {
                            confirm : {text:'Ok',className:'sweet-orange'},
                          
                        },
                        closeOnClickOutside: false
                       })
                  
                }); </script>";
                echo "<div style='color:#66ff66; font-weight: bold; '>Password changed successfully!!</div>";

            } else {
                echo "<div style='color:red;'>An error occured. Re-login</div>";
            }
        }
    } else {
        echo "<script type='text/javascript'> $(document).ready(function(){ 
                swal({
                        title: 'Old Password does not match!',
                       text: 'Please make sure you confirm old password before proceeding!!',
                         icon: 'warning',
                        buttons: {
                            confirm : {text:'Ok',className:'sweet-orange'},
                          
                        },
                        closeOnClickOutside: false
                       })
                  
                }); </script>";
    }

}






$user_id = $_SESSION['id_admin'];

$result_image = mysqli_query($connect, "SELECT * FROM admin WHERE id = '$user_id'");
while ($row = mysqli_fetch_assoc($result_image)) {
    $images = $row['imagess'];
}

$_SESSION['store_image'] = $images;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Change Password</title>
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
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
    <!-- waves.css -->
    <link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="assets/icon/font-awesome/css/font-awesome.min.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
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
                            //                if (file > 148) { 
                            //                    alert( 
                            //                      "Image too large, please resize image to 100kb. Your current image size is: "+file/1000+"mb ("+file+"kb). Image should be: Horizontal = 400px by Vertical = 300px."); 
                            ////                    document.getElementById('size').value = file; 
                            //                         return false;                
                            //                }  else {
                            img.src = URL.createObjectURL(this.files[0]); // set src to blob url
                            img.onload = imageIsLoaded;
                            //                }
                        }
                    }
                }
            });
        });


    </script>
</head>

<body themebg-pattern="theme1">
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

    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->

                    <form class="md-float-material form-material" action="" method="POST"
                        enctype="multipart/form-data">
                        <div class="text-center">
                            <a href="admin_home">
                                <i style="color: #ccffcc;">_<b style="font-weight: bolder; font-size: 24px;">651BSG
                                        ACCN</b><b style="font-size: 16px;"></b>_</i>
                            </a>
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <input type="file" style="color: transparent; display: none" name="fileToUpload"
                                    accept="image/*">

                                <input type="hidden" name="idd" value="<?php echo $id; ?>" />
                                <input type="hidden" name="imge" value="<?php echo $images; ?>" />

                                <br> <br>
                                <div class="row m-b-20">
                                    <!--<div class="col-md-12">-->

                                    <!--</div>-->
                                </div>
                                <h3 class="text-center">Change Password</h3>
                                <div class="form-group form-primary">

                                    <input type="password" name="password_old" id="passA" maxlength="6" required=""
                                        class="form-control">

                                    <span class="form-bar"></span>
                                    <label class="float-label">Old Password:</label>
                                </div>
                                <div class="form-group form-primary">

                                    <input type="password" name="password1" id="pass1" maxlength="6" required=""
                                        class="form-control ">

                                    <span class="form-bar"></span>
                                    <label class="float-label">New Password:</label>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="password" name="password2" id="pass2" maxlength="6" required=""
                                        class="form-control">

                                    <span class="form-bar"></span>
                                    <label class="float-label">Confirm Password:</label>
                                </div>
                                <div class="row m-t-25 text-left">
                                    <div class="col-12">
                                        <div class="checkbox-fade fade-in-primary d-">
                                            <label>
                                                <input type="checkbox" onclick="switching()" />
                                                <span class="cr"><i
                                                        class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">Show Password</span>
                                            </label>
                                        </div>
                                        <!--                                            <div class="forgot-phone text-right f-right">
                                                <a href="auth-reset-password.html" class="text-right f-w-600"> Forgot Password?</a>
                                            </div>-->
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" name="submit"
                                            class="btn btn-success btn-md btn-block waves-effect waves-light text-center m-b-20">Change
                                            Password</button>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-10">
                                        <!--<i class="text-inverse text-left m-b-0">Have a Nice Day!!!</i>-->
                                        <!--<p class="text-inverse text-left"><a href="index.html"><b>Back to website</b></a></p>-->
                                    </div>
                                    <!--                                        <div class="col-md-2">
                                            <img src="assets/images/auth/Logo-small-bottom.png" alt="small-logo.png">
                                        </div>-->
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- end of form -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
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
    <!-- Required Jquery -->
    <script type="text/javascript" src="assets/js/jquery/jquery.min.js "></script>
    <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js "></script>
    <!-- waves js -->
    <script src="assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script type="text/javascript" src="assets/js/common-pages.js"></script>






    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="tooltip1"]').tooltip();
        });
    </script>


    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>




    <script>


        function switching() {
            var get_input = document.getElementById('pass1');
            if (get_input.type === "password") {
                get_input.type = "text";

            } else {
                get_input.type = "password";
            }

            //  -------------------confirm password---------------------------//
            var get_input2 = document.getElementById('pass2');
            if (get_input2.type === "password") {
                get_input2.type = "text";
                //            get_input2.style.marginBottom = "8%";
            } else {
                get_input2.type = "password";
            }





            //  -------------------old password---------------------------//
            var get_input3 = document.getElementById('passA');
            if (get_input3.type === "password") {
                get_input3.type = "text";
                //            get_input2.style.marginBottom = "8%";
            } else {
                get_input3.type = "password";
            }
        }
    </script>
</body>

</html>