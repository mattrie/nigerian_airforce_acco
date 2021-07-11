<?php
session_start();
include 'connection.php';

//   echo 'Your Login wrong';

//   include 'connection.php';
if (isset($_POST['submit'])) {
    // By  Adedokun Adewale Azeez 
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password1 = mysqli_real_escape_string($connect, $_POST['password']);
    $password = md5($password1);
    $sql_statement = "SELECT * FROM admin WHERE username='$username' AND pass='$password'";
    $result = mysqli_query($connect, $sql_statement);

    if (mysqli_num_rows($result)) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $_SESSION['id_admin'] = $rows['id'];
            $_SESSION['name_id_admin'] = $rows['username'];
            $_SESSION['password_admin'] = $rows['pass'];
        }

        echo "<script type='text/javascript'> 
                     window.location = 'admin_home.php';
                    </script>";
    } else {
        echo "<script type='text/javascript'> $(document).ready(function(){ 
                swal({
                         title: 'Access Denied!',
                         text: 'Login details is wrong',
                         icon: 'error',
                        buttons: {
                            confirm : {text:'Retry',className:'sweet-orange'},
                          
                        },
                        closeOnClickOutside: false
                       })
                  .then(function() {
                     window.location = 'fin_admin.php';
                   });   
                }); </script>";
    }
} else {
    session_destroy();
    session_unset();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Login</title>
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
    <script src='sweetalert.min.js' type='text/javascript'></script>
    <style>
        @media(min-width:1024px) {
            .lenght {
                width: 90%;
            }
        }
    </style>
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

                    <form class="md-float-material form-material" action="" method="POST">
                        <div class="text-center">
                            <i>_ <a href="index.php"><b
                                        style="font-weight: bolder; font-size: 24px; color: #ccffcc;">SEAFB
                                        (RDCSAC)</b></a>_</i>
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center">Admin Sign In</h3>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <i class="fa fa-user" style="font-size: 32px;"></i>&nbsp;&nbsp;
                                    </div>
                                    <div class="form-group form-primary lenght">
                                        <input type="text" name="username" maxlength="10" required class="form-control">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Username</label>
                                    </div>
                                </div>


                                <div class="input-group">
                                    <div class="input-group-append">
                                        <i class="fa fa-lock" style="font-size: 32px;"></i>&nbsp;&nbsp;
                                    </div>
                                    <div class="form-group form-primary lenght">
                                        <input type="password" name="password" id="pass" maxlength="20" required=""
                                            class="form-control">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Password</label>
                                    </div>
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
                                            class="btn btn-success btn-md btn-block waves-effect waves-light text-center m-b-20">Sign
                                            in</button>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-10">
                                        <i class="text-inverse text-left m-b-0">Have a Nice Day!!!</i>
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
            var get_input = document.getElementById('pass');
            if (get_input.type === "password") {
                get_input.type = "text";

            } else {
                get_input.type = "password";
                get_input.class = "";
            }
        }
    </script>
</body>

</html>

































































<!--<!DOCTYPE html>
<html>
<head>
    <title></title> <meta content="width=device-width, initial-scale=1.0" name="viewport">
        
         Script 
    <script src='jquery-3.1.1.min.js' type='text/javascript'></script>

     jQuery UI 
     
    <link href='jquery-ui.min.css' rel='stylesheet' type='text/css'>
    <script src='jquery-ui.min.js' type='text/javascript'></script>  
      
      
         Boostrap & family
  <link rel="stylesheet" href="maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <link rel="stylesheet" href="maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 
  <script src="ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
  
  <style>      
                body{
                       background-image: url('images/test_image12.jpeg');
                  background-size: 100%;
                     background-repeat: no-repeat;
                    }
      
        .dropdown-item:hover{
          background-color: black;
          color: whitesmoke;
             }
      
      
      .animation {  
  animation-name: imageblink;
  animation-duration: 5s;
  animation-iteration-count: infinite;
  text-align: center;
  
  font-size: 22px;
  border-radius: 10px;
  
}


/* Standard syntax */
@keyframes imageblink {
  0%   {background-color:#ff5d0f; }
  25%  {background-color:##ff5d11; }
  50%  {background-color:#f08e19;}
  75%  {background-color:#ff5d11;}
  100%   {background-color:#ff5d0f; }
}

a.anime:hover{
    color:white;
}
      
      
      
      
     
  /* Make the image fully responsive */
  .carousel-inner img {
    width: 100%;
    height: 100%;
  }
      
      
    
  </style>
  
  
</head>
<body style="background-color: #e0d3d3;">
    <div class="container">
    NAV BAR WITH BRANDING
   <nav class="navbar navbar-expand-sm navbar-dark fixed-top" style="color:whitesmoke; background-color: #ff5d0f">
       <a class="navbar-brand" href="fin_admin" style="font-weight: bold;">  <img src="images/nairaor.JPG" alt="logo" style="width: 50px; height: 40px; border-radius: 5px;">NAF</a>
      <a class="nav-link animation" style="color: black; font-size: 22px; font-weight: bold;" href="fin_admin">ADMIN LOGIN</a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
     THIS DOES NOT ATTACH ANY FORM OF DROP DOWN
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
    <li class="nav-item">
        
    </li>
    <li class="nav-item">
      <a class="nav-link" style="color: cornsilk;" href="#admission">Admission</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="color: cornsilk;" href="#news">News</a>
    </li>
    
    <li class="nav-item"><a class="nav-link" style="color: cornsilk;" href="fin_admin">Admin login</a></li>
 
 
  </ul>
       </div>      
     </nav>
   
   
    
    
    
    
    <div style="margin-top: 160px;">
    
       
       
        
  <div style="border: 2px #ff5d0f solid; border-radius: 32px; height: 320px; width: 380px; padding: 30px; 
    border-top-width: 14px;
    border-top-color: #ff5d0f;
    background-color: #ffe8f6;
    border-radius: 22px;" class="mx-auto">
      
    
      
      <form   style="width: 300px;">
       <div class="media">
    
    <div class="media-body">
     
      
      
   
        <div class="form-group" >
      <label for="uname">Username:</label>
      <input type="text" class="form-control "  style="width: 300px;"  >
       </div>
      
    
      
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control"  placeholder="password"   required>
      <input  type="checkbox" >show
    </div>
  
   

     
 

        <center><button  class="btn btn-success" data-toggle="modal" data-target="#myModal">Login</button></center>
    </div>
      
       <div class="form-group form-check">
      <label class="form-check-label">
        <input class="form-check-input align-self-end" type="checkbox" onclick="switching()">show       
      </label>
    </div>
      
      </div>
      
  </form>
          
       </div>
      
    
  
  
           
      

        




    </div>
   </div> 
    <footer><center style="margin-top: 160px; background-color: #ff5d00; color: black; font-size: 22px; font-weight: bold;"><marquee behavior="left">Please enter username and password to login. Make sure your system date is correct. NAF *SAVINGS*LOAN*. <label style="font-style: italic;">moving higher everyday!!!</label></marquee></center>
          <center style="font-size: 16px; color: whitesmoke; ">&copy;<?php echo date('Y') ?>. By Mr. Matt.</center></footer>
     
</body>
</html>-->