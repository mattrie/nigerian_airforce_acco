<?php
         session_start();
         include 'connection.php';
       
                    if(isset($_POST['xxxxbmit'])) {


                  $from_name = $_POST['name'];
            $from_email =  $_POST['email']; 
            $from_address =   "123 street";
            $from_phone = "080343856677";
            $from_date = date("jS F Y") ;

             $time_stamp = date("h:ia");  
           $time_stamp1  = date("h:ia", strtotime($time_stamp));
            $from_time =   $time_stamp1;


         $message_text = $_POST['message'];

                $to = "matriebelle@gmail.com";
                $subject = "Delivery Request";

                $message = "
                <html>
                <head>
                <title>Delivery Request!!!</title>
                </head>
                <body>
                <p>Delivery Request!!!</p>
                <table>
                <tr>
                <th>----</th>
                <th>-------</th>
                </tr>
                <tr>
                <td>Email:</td>
                <td>".$from_email."</td>
                </tr>
                <tr>
                <td>Name:</td>
                <td>".$from_name."</td>
                </tr>
                <tr>
                <td>Address:</td>
                <td>".$from_address."</td>
                </tr>
                <tr>
                <td>Phone:</td>
                <td>".$from_phone."</td>
                </tr>
                <tr>
                <td>Delivery Date:</td>
                <td>".$from_date."</td>
                </tr>
                <tr>
                <td>Delivery Time:</td>
                <td>".$from_time."</td>
                </tr>
                <tr>
                <td>Instruction:</td>
                <td>".$message_text."</td>
                </tr>
                </table>
                </body>
                </html>
                ";



                 // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                    // More headers
                $headers .= 'From: <Request@deroy.com>' . "\r\n";
                $headers .= 'Cc: ' . "\r\n";

              $mailsent =  mail($to,$subject,$message,$headers);


             if($mailsent == true){
             echo "<script type='text/javascript'> $(document).ready(function(){ 
                swal({
                         title: 'Success!',
                         text: 'Message is successfully sent!!!',
                         icon: 'success',
                        buttons: {
                            confirm : {text:'Ok',className:'sweet-orange'},
                          
                        },
                        closeOnClickOutside: false
                       })
                  
                }); </script>";
        
             } else {
              echo "<script type='text/javascript'> $(document).ready(function(){ 
                swal({
                         title: 'Error!',
                         text: 'Message not sent No vex!!!!!',
                         icon: 'warning',
                        buttons: {
                            confirm : {text:'Ok',className:'sweet-orange'},
                          
                        },
                        closeOnClickOutside: false
                       })
                  
                }); </script>";
      
         }  
                    }


                    
                    
                    
                    
                    
                    
                    


                   ///////////////////////////lets upload the file first/////////////////////////////////////////////                      

         $target_dir = "images/";// this is the directory to upload to
           //....................................
        $target_dir2 = "client/images/";// this is the directory to upload to
          
               
               
               
                 $check_name = "";
            function fn_resize($image_resource_id,$width,$height) {
                    $target_width =300;
                    $target_height =300;
                    $target_layer=imagecreatetruecolor($target_width,$target_height);
                    imagecopyresampled($target_layer,$image_resource_id,0,0,0,0,$target_width,$target_height, $width,$height);
                    return $target_layer;
                  }   
                  
           
                             if(isset($_POST['Submit'])){
                              // By  Adedokun Adewale Azeez 
                                $name =  mysqli_real_escape_string($connect,strip_tags(str_replace("'", "", strtoupper($_POST['name']))));
                                $email = mysqli_real_escape_string($connect,strip_tags(str_replace("'", "", $_POST['email'])))  ;
                                $address = mysqli_real_escape_string($connect,strip_tags(str_replace("'", "", $_POST['address'])));
                                 $dateofbirth = mysqli_real_escape_string($connect,strip_tags(str_replace("'", "", $_POST['dateofbirth'])));
//                                $dob = str_replace("'", "", $_POST['dob']);
                                $class = mysqli_real_escape_string($connect,strip_tags(str_replace("'", "", $_POST['class'])));//gender
                                $parent = mysqli_real_escape_string($connect,strip_tags(str_replace("'", "", strtoupper($_POST['parent']))));//occupation
                                $telephone = $_POST['telephone'];
//                                $mail = $_POST['mail'];
                                $prop_amt = str_replace(",", "", $_POST['prop_amt']) ;
                                $religion = mysqli_real_escape_string($connect,strip_tags(str_replace("'", "", $_POST['religion'])));
                                $login_id = mysqli_real_escape_string($connect,strip_tags(str_replace("'", "", $_POST['loginid'])));   
                                $date = date("jS F Y");
                                
        
        
                    $sql_check = "SELECT * FROM members WHERE namee = '$name'";
               $check = mysqli_query($connect, $sql_check);
             while($row = mysqli_fetch_assoc($check)){
                 $check_name = $row['namee'];
             }  
             
                if($check_name != ""){
                  echo "<script type='text/javascript'> $(document).ready(function(){ 
                swal({
                         title: 'Name Check!',
                         text: '$name already exist, please alter!!',
                         icon: 'warning',
                        buttons: {
                            confirm : {text:'Ok',className:'sweet-orange'},                          
                        },
                        closeOnClickOutside: false
                       })
                  
                }); </script>";
              
                                       
                } else {
                    
                    
//           THIS IS TO UPLOAD PASSPORT PHOTO         
                if(is_array($_FILES)) {
                    $file = $_FILES['fileToUpload']['tmp_name']; 
                    $source_properties = getimagesize($file);
                    $image_type = $source_properties[2]; 
                    if( $image_type == IMAGETYPE_JPEG ) {   
                        $image_resource_id = imagecreatefromjpeg($file);  
                        $target_layer = fn_resize($image_resource_id,$source_properties[0],$source_properties[1]);
                        $target_file = $target_dir.$_FILES['fileToUpload']['name'];
                        imagejpeg($target_layer,$target_dir.$_FILES['fileToUpload']['name'] );
                        imagejpeg($target_layer,$target_dir2.$_FILES['fileToUpload']['name'] );
                     
                      }
                    
                     elseif( $image_type == IMAGETYPE_GIF )  {  
                        $image_resource_id = imagecreatefromgif($file);
                        $target_layer = fn_resize($image_resource_id,$source_properties[0],$source_properties[1]);
                        $target_file = $target_dir.$_FILES['fileToUpload']['name'];   
                        imagegif($target_layer,$target_dir.$_FILES['fileToUpload']['name'] );
                        imagegif($target_layer,$target_dir2.$_FILES['fileToUpload']['name'] );
                        
                      }
                    
                     elseif( $image_type == IMAGETYPE_PNG ) {
                        $image_resource_id = imagecreatefrompng($file); 
                        $target_layer = fn_resize($image_resource_id,$source_properties[0],$source_properties[1]);
                         $target_file = $target_dir.$_FILES['fileToUpload']['name']; 
                        imagepng($target_layer, $target_dir.$_FILES['fileToUpload']['name'] );
                        imagepng($target_layer, $target_dir2.$_FILES['fileToUpload']['name'] );
                       
                    }
                }
                
                
                
                
                
       //           THIS IS TO UPLOAD IDENTITY CARD                 
                 if(is_array($_FILES)) {
                    $file = $_FILES['fileToUpload1']['tmp_name']; 
                    $source_properties = getimagesize($file);
                    $image_type = $source_properties[2]; 
                    if( $image_type == IMAGETYPE_JPEG ) {   
                        $image_resource_id = imagecreatefromjpeg($file);  
                        $target_layer = fn_resize($image_resource_id,$source_properties[0],$source_properties[1]);
                        $target_file1 = $target_dir.$_FILES['fileToUpload1']['name'];
                        imagejpeg($target_layer,$target_dir.$_FILES['fileToUpload1']['name'] );
                        imagejpeg($target_layer,$target_dir2.$_FILES['fileToUpload1']['name'] );
                     
                      }
                    
                     elseif( $image_type == IMAGETYPE_GIF )  {  
                        $image_resource_id = imagecreatefromgif($file);
                        $target_layer = fn_resize($image_resource_id,$source_properties[0],$source_properties[1]);
                        $target_file1 = $target_dir.$_FILES['fileToUpload1']['name'];   
                        imagegif($target_layer,$target_dir.$_FILES['fileToUpload1']['name'] );
                        imagegif($target_layer,$target_dir2.$_FILES['fileToUpload1']['name'] );
                        
                      }
                    
                     elseif( $image_type == IMAGETYPE_PNG ) {
                        $image_resource_id = imagecreatefrompng($file); 
                        $target_layer = fn_resize($image_resource_id,$source_properties[0],$source_properties[1]);
                         $target_file1 = $target_dir.$_FILES['fileToUpload1']['name']; 
                        imagepng($target_layer, $target_dir.$_FILES['fileToUpload1']['name'] );
                        imagepng($target_layer, $target_dir2.$_FILES['fileToUpload1']['name'] );
                       
                    }
                }
                    
           
                         ///INSERT NEW MEMBER TO DATABASE
      $sql_statement = "INSERT INTO members (namee, registered_by, addresss, classs, parentt, telephone,  religion, login_id, imagess, level, dateofbirth, email,  not_yet, card, prop_amt) Values('$name', 'admin', '$address', '$class', '$parent','$telephone',  '$religion', '$login_id', '$target_file', '$date', '$dateofbirth', '$email', 'not yet', '$target_file1', '$prop_amt')";
                     $result = mysqli_query($connect, $sql_statement); 
//                     printf("Errormessage: %s\n", mysqli_error($connect)); 
                                    if($result==true){
                                    echo "<script type='text/javascript'> $(document).ready(function(){ 
                swal({
                         title: 'Success!',
                         text: 'Thank you $name. Your application has been successfully submitted!!. We will get back to you shortly. Please endeavour to periodically check your mail for invitation. Thank you.',
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
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>651 BSG ACCN</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets1/img/naira1.jpeg" rel="icon">
  <link href="assets1/img/naira1.jpeg" rel="naira1">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i,900" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets1/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets1/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets1/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets1/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets1/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets1/vendor/owl.carousel/assets1/owl.carousel.min.css" rel="stylesheet">
  <link href="assets1/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets1/css/style.css" rel="stylesheet">

   <!-- Script -->
<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src='jquery-3.1.1.min.js' type='text/javascript'></script>

    <!-- jQuery UI -->
     
    <link href='jquery-ui.min.css' rel='stylesheet' type='text/css'>
    <script src='jquery-ui.min.js' type='text/javascript'></script>
        <meta charset="utf-8">
        <!--Boostrap & family-->
  <!--<link rel="stylesheet" href="maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
 <!--<link rel="stylesheet" href="maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->
 
 
  <script src="maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
  
     <script>
        window.addEventListener('load', function() {
 document.querySelector('input[type="file"]').addEventListener('change', function() {
              if (this.files && this.files[0]) {
               var img = document.getElementById('img123');  // $('img')[0]
               var fi = document.getElementById('customFile'); 
               if (fi.files.length > 0) { 
            for (const i = 0; i <= fi.files.length - 1; i++) { 
  
                const fsize = fi.files.item(i).size; 
                const file = Math.round((fsize / 1000)); 
                // The size of the file. 
//                if (file > 148) { 
//                  swal({
//                         title: 'Not Allowed!',
//                         text:  'Image too large, please resize image to 100kb. Your current image size is: '+file/1000+'mb ('+file+'kb). Image should be: Horizontal = 400px by Vertical = 300px.',
//                         icon: 'error',
//                        buttons: {
//                            confirm : {text:'Ok',className:'sweet-orange'}
//                          
//                        },
//                        closeOnClickOutside: false
//                       });
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
 
  
     <style>
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
 0%   {background-color:#6666ff; }
  25%  {background-color:#6600ff; }
  50%  {background-color:#6622ff;}
  75%  {background-color:#6633ff;}
  100%   {background-color:#6666ff; }
}

a.anime:hover{
    color:white;
}
     </style>
</head>

<body>

  <!-- ======= Top Bar ======= -->
  

  <!-- ======= Header ======= -->
  <header id="header">
      <div class="container" >

      <div class="logo float-left">
        <h1 class="text-light"><a href="index.php"><span><b>
         <img src="images/1200px-Nigerian_Air_Force_emblem.svg.png" style="width: 40px;" alt="">   651 BSG ACCN</b></span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.php"><img src="assets1/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

          <nav class="nav-menu float-right d-none d-lg-block" id="nav-menu">
        <ul>
          <li class="active"><a href="index.php"><b>Home</b></a></li>
          
          <li><a href="#about"><b>About </b></a></li>
          <li><a href="#services"><b>Services</b></a></li>
        
          <!-- <li><a href="#team"><b>Team</b></a></li> -->
 

          <li><a href="#contact"><b>Contact Us</b></a></li>
          <!-- <li><a href="client/index.php"><b>Codename</b></a></li> -->
        
        </ul>
      </nav><!-- .nav-menu -->
      <script>
          function coll(){
      document.getElementById('nav-menu').click();
      }
      </script>
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

          <!-- Slide 1 -->
          <div class="carousel-item active" style="background-image: url('assets1/img/slide/naf_slide.jpg');">
            <div class="carousel-container">
              <div class="carousel-content container">
                <h2 class="animate__animated animate__fadeInDown"><span> Sam Ethnan <br> Airforce Base <br> 651 BSG ACCN</span></h2>
                <p class="animate__animated animate__fadeInUp">Revolutionizing how the Base handles housing logistics, streamlining processes for efficiency and convenience and 
                a comprehensive solution for accommodation.
                </p>
            <!-- <a href="#"  class="btn btn-danger  btn-round-full text-white animation" id="menu2" data-toggle="modal" data-target="#myModal" ><b>Register For A Loan </b></a> -->
               
            
           
           
           
           
           
           
              </div>
            </div>
          </div>

          <!-- Slide 2 -->
          <div class="carousel-item" style="background-image: url('assets1/img/slide/naf_slide2.jpg');">
            <div class="carousel-container">
              <div class="carousel-content container">
                <h2 class="animate__animated animate__fadeInDown">Streamlined Efficiency</h2>
                <p class="animate__animated animate__fadeInUp"> a comprehensive solution for Airforce Barracks, offering intuitive interfaces and robust features tailored to the unique needs of military housing management as well as  optimizing occupancy rates and maximizing the utilization of available housing resources. <p>
             <!-- <a href="#"  class="btn btn-success  btn-round-full text-white animation" id="menu2" data-toggle="modal" data-target="#myModal" ><b>Register For A Loan </b></a> -->
             </div>
            </div>
          </div>

          <!-- Slide 3 -->
          <div class="carousel-item" style="background-image: url('assets1/img/slide/naf_slide4.jpg');">
            <div class="carousel-container">
              <div class="carousel-content container">
                <h2 class="animate__animated animate__fadeInDown">Transparency and <br> Accountability</h2>
                <p class="animate__animated animate__fadeInUp">With real-time updates and customizable features, adapting to the dynamic nature of Airforce operations, ensuring accurate tracking and allocation of accommodations across various bases and deployments to improve communication, and enhance the quality of life for service members and their families.</p>
             <!-- <a href="#"  class="btn btn-success  btn-round-full text-white animation" id="menu2" data-toggle="modal" data-target="#myModal" ><b>Register For A Loan </b></a> -->
            </div>
            </div>
          </div>

        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon icofont-rounded-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon icofont-rounded-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>

      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container">
             
        <div class="row no-gutters">
          <div class="col-lg-6 video-box">
              <img src="assets1/img/about.jpg" style=" padding-top: 50px;" class="img-fluid" alt="">
            <!--<a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a>-->
          </div>

          <div class="col-lg-6 d-flex flex-column justify-content-center about-content">

            <div class="section-title">
              <h2>About Us</h2>
              <p style="text-align: justify">At 651 BSG ACCN, we are dedicated to providing cutting-edge solutions for accommodation management in Airforce Barracks. With a team of passionate professionals, we strive to revolutionize the way military housing logistics are handled, ensuring efficiency, transparency, and ease of use for Airforce personnel and their families. Our innovative software is designed with the unique needs of the military in mind, offering intuitive interfaces and unparalleled support to enhance the quality of life and readiness of our service members.</p>
            </div>

            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="bx bx-fingerprint"></i></div>
              <h4 class="title"><a href="">Mission</a></h4>
              <p class="description">Our mission is to empower Airforce units with innovative software solutions that optimize accommodation management processes, enhance communication, and improve the overall experience of service members and their families.</p>
            </div>

         

          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= About Lists Section ======= -->
    <!-- End About Lists Section -->

    <!-- ======= Counts Section ======= -->
    <section class="counts section-bg">
      <div class="container">
          
          
          
          
     <!--========================MODAL===============-->     
   <div class="container w-100">

      <!-- Button to Open the Modal -->


      <!-- The Modal -->
       <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">REGISTRATION FORM</h4>
              <!--<button type="button" class="close text-danger" data-dismiss="modal"><b style="font-size: 20px;">&times;</b></button>-->
            </div>
            <form name="reg_loan" action="index.php" method="POST" enctype="multipart/form-data">

            <!-- Modal body -->
            <div class="modal-body">
                  <center class="row"> 
                     



                                <div  width="140" height="140" class="mb-2 col-sm-6">
                                    <img id="img123" src="#" alt="CLICK 'BROWSE' TO UPLOAD PHOTO"  style="border: 4px #99ff99 solid; width:140px; height:140px;" >

                                    <div class="custom-file mb-3" style="width: 200px;">
                                        <input type="file" class="custom-file-input" id="customFile" required="" name="fileToUpload" accept="image/*" >
                                        <label class="custom-file-label" for="customFile">Choose Photo>></label>
                                    </div> 
                                 </div>


                      
                      
                        <div class="col-sm-6 mb-5" style="margin-right:  0px;">
                                                                    <input type="file" name="fileToUpload1"  accept="image/*" name="image" id="file1" required="" onchange="loadFile1(event)" style="display: none;">
                                                            <label for="file1" style="cursor: pointer;">Click here to upload I.D. Card</label><br>
                                                            <img id="output1" width="250" height="150" />
                                                           <script>
                                                                var loadFile1 = function(event) {
                                                                       var image = document.getElementById('output1');
                                                                     var fi = document.getElementById('file1');
                                                                         if (fi.files.length > 0) { 
                                                                        for (const i = 0; i <= fi.files.length - 1; i++) { 

                                                                       const fsize = fi.files.item(i).size; 
                                                                       const file = Math.round((fsize / 1000)); 
                                                                       // The size of the file. 
//                                                                       if (file > 148) { 
//                                                                    swal({
//                                                                                             title: 'Not Allowed!',
//                                                                                             text:  'Image too large, please resize image to 100kb. Your current image size is: '+file/1000+'mb ('+file+'kb). Image should be: Horizontal = 400px by Vertical = 300px.',
//                                                                                             icon: 'error',
//                                                                                            buttons: {
//                                                                                                confirm : {text:'Ok',className:'sweet-orange'}
//
//                                                                                            },
//                                                                                            closeOnClickOutside: false
//                                                                                           }); 
//                                                                                return false;                
//                                                                       } else {
                                                                           image.src = URL.createObjectURL(event.target.files[0]);
//                                                                       }  
                                                                   }
                                                               }   
                                                             };
                                                                </script>
                                                                </div>
                                                          </center>  
                
                <div class="row">
                    <div class="col-sm-2">
                       Full Name: 
                    </div>
                    <div class="col-sm-10">
                       <input type="text" class="form-control" placeholder="enter Name"  name="name" id="autocomplete" class="getname"  maxlength="50"  style="text-transform: uppercase;" required >
                    </div>
                </div>
                
               
                                                                   <br>
                                                                   
                   <div class="row">
                    <div class="col-sm-2">
                       Address:
                    </div>
                    <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="enter Address"   name="address"  maxlength="70" required="">
                            </div>
                </div>
                                                                  
                                                                   
                                                                   
              
                                                              
                <br>
                
                
                
                
                
                
                  <div class="row">
                    <div class="col-sm-2">
                      Email:
                    </div>
                    <div class="col-sm-10">
                 <input type="email" class="form-control" name="email" required="" placeholder="Enter Email" style="text-transform: lowercase;"/>
                    </div>
                </div>
                
               
                <br>
                
                
                
                
                
                
                  <div class="row">
                    <div class="col-sm-2">
                   Gender:
                    </div>
                    <div class="col-sm-10">
                <select name="class" class="form-control" required>
                                                                    <option value="" disabled selected hidden>select Gender</option>
                                                                    <option value="MALE">MALE</option>
                                                                    <option value="FEMALE">FEMALE</option>
                                                                   </select>       
                    </div>
                </div>
                
              
             <br>
               
                                                                   
                                                                   
                                                                   
                                                                   
                  <div class="row">
                    <div class="col-sm-2">
                     Occupation:
                    </div>
                    <div class="col-sm-10">
                 <input type="text" class="form-control" placeholder="enter Occupation"  type="text" name="parent" maxlength="50" required style="text-transform: uppercase">
                       </div>
                </div>
                                                                   
                                                                   
                                                                 
                                                                <br>
                
                                                                
                                                                
                                                                
                                                                
                    <div class="row">
                    <div class="col-sm-2">
                     Telephone:
                    </div>
                    <div class="col-sm-10">
                        <input  class="form-control" type="number" placeholder="enter phone_number" name="telephone"  maxlength="11" required>
                       </div>
                </div>
                
                 
                                                             
                 <br>
                
                 
                 
                 
                 
                 
                 
                   <div class="row">
                    <div class="col-sm-2">
                       Date of Birth:
                    </div>
                    <div class="col-sm-10">
                <input type="text" onfocus="this.type='date'" class="form-control" name="dateofbirth" placeholder="Click here select date form calender icon" style="border-radius: 5px;" required="">
                       </div>
                </div>
                
                
                                                                <br>
                
                 
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                  <div class="row">
                    <div class="col-sm-2">
                         Amount Applied For:
                    </div>
                    <div class="col-sm-10">
                        <input  class="form-control" type="text" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" placeholder="enter amount" name="prop_amt"  maxlength="12" required>
                 </div>
                </div>
                
                  
                                                              
                 <br>                                            
                                                                
              
                 
                 
                 
                 
                 
                 
                 
                 
                 
                   <div class="row">
                    <div class="col-sm-2">
                       Guarantor 1:
                    </div>
                    <div class="col-sm-10">
              <input  class="form-control"   type="text" name="religion" required=""   maxlength="50"  placeholder="enter Refree 1 name and phone number" maxlength="50" >
                         </div>
                </div>
                
               
                                                              <br>
              
                                                              
                                                              
                                                              
                                                              
                                                              
                                                              
                                                              
                                                              
                                                              
                                                                <div class="row">
                    <div class="col-sm-2">
                        Guarantor 2:
                    </div>
                    <div class="col-sm-10">
              <input type="text" class="form-control" type="text"  name="loginid" placeholder="enter Refree 2 name and phone number" maxlength="50" >
                         </div>
                </div>
                
                 
                                                              
               
            </div>
            <hr>
         <center><button style=" width: 50%; font-weight: bolder; font-size: 20px;" type="submit" name="Submit" id="check_duplicate" class="btn btn-success">Submit</button></center>
             <br>
            <!-- Modal footer -->
            <div class="modal-footer">
                <!--<button type="submit" class="btn btn-success" style="border-radius: 20px; font-size: 16px;" name="submit_course">Submit</button><br>-->
                   <button style="margin-left: 0px;" id="reset" class="btn btn-danger float-right" >Close</button>
                   
       <script>
            $(document).ready(function(){
            $("#reset").click(function(){
               /////Load Modal on RESET  
           window.location = 'index.php';  
           
//          setTimeout(function() {document.getElementById("menu2").click(); }, 1000);
   
            });    
            });           
   
        </script>  
        
        
        
        
        
        <script>  // ////////Format number with commas/////////////////////////////////

                            function FormatCurrency(ctrl) {
                                //Check if arrow keys are pressed - we want to allow navigation around textbox using arrow keys
                                if (event.keyCode === 37 || event.keyCode === 38 || event.keyCode === 39 || event.keyCode === 40) {
                                    return;
                                }

                                var val = ctrl.value;

                                val = val.replace(/,/g, "");
                                ctrl.value = "";
                                val += '';
                                x = val.split('.');
                                x1 = x[0];
                                x2 = x.length > 1 ? '.' + x[1] : '';

                                var rgx = /(\d+)(\d{3})/;

                                while (rgx.test(x1)) {
                                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                                }

                                ctrl.value = x1 + x2;
                            }

                            function CheckNumeric() {
                                return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode === 46;
                            }

                  </script>

                     <!-- Script -->
                    <script type='text/javascript' >
                    $( function() {

                        $( "#autocomplete" ).autocomplete({
                            source: function( request, response ) {

                                $.ajax({
                                    url: "autocomplete.php",
                                    type: 'post',
                                    dataType: "json",
                                    data: {
                                        search: request.term
                                    },
                                    success: function( data ) {
                                        response( data );
                                    }
                                });
                            },
                            select: function (event, ui) {
                                $('#autocomplete').val(ui.item.label); // display the selected text
                                $('#selectuser_id').val(ui.item.value); // save selected id to input
                                return false;
                            }
                        });


                        //////////////////////////////////////////////////////////////////////////
                         $( "#codename" ).autocomplete({
                            source: function( request, response ) {

                                $.ajax({
                                    url: "codename.php",
                                    type: 'post',
                                    dataType: "json",
                                    data: {
                                        search: request.term
                                    },
                                    success: function( data ) {
                                        response( data );
                                    }
                                });
                            },
                            select: function (event, ui) {
                                $('#codename').val(ui.item.label); // display the selected text
                                $('#selectuser_id').val(ui.item.value); // save selected id to input
                                return false;
                            }
                        });




                //////////////////////////////////////////////////////////////////////////////////////////////////////
                        // Multiple select
                        $( "#multi_autocomplete" ).autocomplete({
                            source: function( request, response ) {

                                var searchText = extractLast(request.term);
                                $.ajax({
                                    url: "autocomplete.php",
                                    type: 'post',
                                    dataType: "json",
                                    data: {
                                        search: searchText
                                    },
                                    success: function( data ) {
                                        response( data );
                                    }
                                });
                            },
                            select: function( event, ui ) {
                                var terms = split( $('#multi_autocomplete').val() );

                                terms.pop();

                                terms.push( ui.item.label );

                                terms.push( "" );
                                $('#multi_autocomplete').val(terms.join( ", " ));
                ///////////////////////////////////////////////////////////////////////////////////////
                                // Id
                                var terms = split( $('#selectuser_ids').val() );

                                terms.pop();

                                terms.push( ui.item.value );

                                terms.push( "" );
                                $('#selectuser_ids').val(terms.join( ", " ));

                                return false;
                            }

                        });
                    });

                    function split( val ) {
                      return val.split( /,\s*/ );
                    }
                    function extractLast( term ) {
                      return split( term ).pop();
                    }



                        ///////////THIS IS TO CHANGE TO COMMAS 

                            


                    </script> 
            
            </div>
             </form>
          </div>
        </div>
      </div>

    </div>
        <!--========================END MODAL===============-->  
        
        
        
        
        
        
        
        
        <div class="row">

          <div class="col-lg-4 col-md-6 text-center" data-aos="fade-up">
            <div class="count-box">
              <i class="icofont-computer" style="color: #20b38e;"></i>
              <!-- <span data-toggle="counter-up">2,145</span> -->
              <p>Digital Entry</p>
            </div>
          </div>

<!--          <div class="col-lg-3 col-md-6 text-center" data-aos="fade-up" data-aos-delay="200">
            <div class="count-box">
              <i class="icofont-document-folder" style="color: #c042ff;"></i>
              <span data-toggle="counter-up">521</span>
              <p>Loan Disbursement</p>
            </div>
          </div>-->

          <div class="col-lg-4 col-md-6 text-center" data-aos="fade-up" data-aos-delay="400">
            <div class="count-box">
              <i class="icofont-safety" style="color: #46d1ff;"></i>
              <!-- <span data-toggle="counter-up">25</span> -->
              <p>Secured Database</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 text-center" data-aos="fade-up" data-aos-delay="600">
            <div class="count-box">
              <i class="icofont-users-alt-5" style="color: #ffb459;"></i>
              <!-- <span data-toggle="counter-up">115</span> -->
              <p>Data Collation</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>Features</h2>
        </div>

          <div class="row" >
<!--              <div class="col-lg-3 col-md-6 icon-box" data-aos="fade-up" data-toggle="modal" data-target="#myModal_save" style="cursor: pointer;">
            <div class="icon"><i class="icofont-money"></i></div>
            <h4 class="title">Savings and loan</h4>
            <p class="description"></p>
          </div>-->
          <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100" data-toggle="modal" data-target="#myModal_estate" style="cursor: pointer;">
            <div class="icon"><i class="icofont-user-alt-3"></i></div>
            <h4 class="title">Personnel  Registration</h4>
            <p class="" style="text-align: justify"> Each Personnel will be captured digitally. All required information will be provided as well as a facial information and dependents.</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200" data-toggle="modal" data-target="#myModal_gas" style="cursor: pointer;">
            <div class="icon"><i class="icofont-arrow-right"></i></div>
            <h4 class="title">Posting Identification</h4>
            <p class="" style="text-align: justify">Posting emanating from recieved signals can be matched against the Database to Identify Personnels with exiting accomodation</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300" data-toggle="modal" data-target="#myModal_invest" style="cursor: pointer;">
            <div class="icon"><i class="icofont-chart-bar-graph"></i></div>
            <h4 class="title">Data Analytics</h4>
            <p class="" style="text-align: justify">As a result of Digital collation of all Personnels, filtering existing data can help in identifying certain aspects of concern.</p>
          </div>
<!--          <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
            <div class="icon"><i class="icofont-settings"></i></div>
            <h4 class="title"><a href="">Consultancy</a></h4>
            <p class="description"></p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="500">
            <div class="icon"><i class="icofont-tasks-alt"></i></div>
            <h4 class="title"><a href="">Bank Deposit/Withdrawals</a></h4>
            <p class="description"></p>
          </div>-->
        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Our Portfolio Section ======= -->
    <!-- End Our Portfolio Section -->

    

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Frequently Asked Questions</h2>
        </div>

        <div class="row  d-flex align-items-stretch">

          <div class="col-lg-6 faq-item" data-aos="fade-up">
            <h4>How is each Personnel Registered ?</h4>
            <p style="text-align: justify">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque, accusantium vero animi facilis nobis amet aliquid explicabo in reiciendis dolorem tempore, illum nesciunt quos sapiente blanditiis sequi perferendis excepturi repellendus?
            </p>
          </div>

          <div class="col-lg-6 faq-item" data-aos="fade-up" data-aos-delay="100">
            <h4>How can double allocation be avoided ?</h4>
            <p style="text-align: justify">
               Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis id cupiditate veniam, voluptatem adipisci minima, similique voluptatibus perferendis suscipit molestiae illo repellendus laboriosam, repellat sapiente! Tempore magni quos hic saepe!
            </p>
          </div>

          <div class="col-lg-6 faq-item" data-aos="fade-up" data-aos-delay="200">
            <h4>What is the storage capacity ?</h4>
            <p style="text-align: justify">
         Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora at voluptas rerum hic deleniti quaerat minima? Mollitia molestiae eaque ullam? Illum facilis perspiciatis repudiandae corrupti assumenda incidunt accusamus id veritatis.    </p>
          </div>

          <div class="col-lg-6 faq-item" data-aos="fade-up" data-aos-delay="300">
            <h4>Are all registerd Data Secured ?</h4>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores, asperiores corporis? Necessitatibus eius enim at dicta. Minima magni nemo autem illum ad repellendus harum quia maxime nihil voluptatibus, facilis architecto.
            </p>
          </div>

<!--          <div class="col-lg-6 faq-item" data-aos="fade-up" data-aos-delay="400">
            <h4>Tempus quam pellentesque nec nam aliquam sem et tortor consequat?</h4>
            <p>
              Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
            </p>
          </div>

          <div class="col-lg-6 faq-item" data-aos="fade-up" data-aos-delay="500">
            <h4>Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor?</h4>
            <p>
              Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque.
            </p>
          </div>-->

        </div>

      </div>
    </section><!-- End Frequently Asked Questions Section -->

    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Contact Us</h2>
<!--           <div class="mb-3"  data-aos="fade-up" data-aos-delay="400">    
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d990.8421831063993!2d3.279815618500421!3d6.601015289485273!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b917cc65817df%3A0xedc40142ab59255b!2sKeyNote%20Music!5e0!3m2!1sen!2sng!4v1646064455802!5m2!1sen!2sng" style="width: 100%; height: 300px; border:0;" allowfullscreen="" loading="lazy"></iframe>
                                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d990.842123384639!2d3.279674729204991!3d6.601045131915929!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6fbe7e2dae2e5b0e!2zNsKwMzYnMDMuOCJOIDPCsDE2JzQ4LjgiRQ!5e0!3m2!1sen!2sng!4v1644230660705!5m2!1sen!2sng" style="width: 100%; height: 300px; border:0;"  allowfullscreen="" loading="lazy"></iframe>                   
				</div>-->
        </div>
      
        <div class="row">

          <div class="col-lg-6 d-flex align-items-stretch" data-aos="fade-up">
            <div class="info-box">
              <i class="bx bx-map"></i>
              <h3>Our Address</h3>
              <p>651 BSG ACCN, Sam Ethnan Airforce Base Ikeja, Lagos</p>
            </div>
          </div>

          <div class="col-lg-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="info-box">
              <i class="bx bx-envelope"></i>
              <h3>Email Us</h3>
              <p>bsgaccn@gmail.com </p>
            </div>
          </div>

          <div class="col-lg-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="info-box ">
              <i class="bx bx-phone-call"></i>
              <h3>Call Us</h3>
              <p>080XXXXXXXX</p>
            </div>
          </div>

<!--          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="form-row">
                <div class="col-lg-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="col-lg-6 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>-->

        </div>
          
          
          <!--Modal for savings and loan-->
     <!--========================Modal for savings and loan===============-->     
   <div class="container w-100">
  <!-- The Modal -->
       <div class="modal fade" id="myModal_save">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Savings and Loan</h4>
            </div>
            <div class="modal-body">
            <p>
         Get any form of Loan suitable for your flexibility as well as payment capacity. We offer Daily, Weekly and Monthly lending. Feel free to contact us regarding your choice of product.    
            </p>
           </div>
              <div class="modal-footer">
                <!--<button type="submit" class="btn btn-success" style="border-radius: 20px; font-size: 16px;" name="submit_course">Submit</button><br>-->
                   <button style="margin-left: 0px;" data-dismiss="modal" class="btn btn-danger float-right" >Close</button>
              </div>
          </div>
        </div>
      </div>

    </div> 
      <script>
            $(document).ready(function(){
            $("#reset1").click(function(){
               /////Load Modal on RESET  
           window.location = 'index.php';  
           
//          setTimeout(function() {document.getElementById("menu2").click(); }, 1000);
   
            });    
            });           
   
        </script>  
     
     
     
     
     
     
     
     
       <!--Modal for estate-->
     <!--========================Modal for estate===============-->     
   <div class="container w-100">
  <!-- The Modal -->
       <div class="modal fade" id="myModal_estate">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Personnel  Registration</h4>
            </div>
            <div class="modal-body">
            <p>
               Each Personnel will be captured digitally. All required information will be provided as well as  facial information and dependents.
            </p>
           </div>
              <div class="modal-footer">
                <!--<button type="submit" class="btn btn-success" style="border-radius: 20px; font-size: 16px;" name="submit_course">Submit</button><br>-->
                   <button style="margin-left: 0px;" data-dismiss="modal" class="btn btn-danger float-right" >Close</button>
              </div>
          </div>
        </div>
      </div>
    </div> 
      
     
     

     
       <!--Modal for Gas-->
     <!--========================Modal for gas===============-->     
   <div class="container w-100">
  <!-- The Modal -->
       <div class="modal fade" id="myModal_gas">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Posting Identification</h4>
            </div>
            <div class="modal-body">
            <p>
            Posting emanating from recieved signals can be matched against the Database to Identify Personnels with exiting accomodation.
             </p>
           </div>
              <div class="modal-footer">
                <!--<button type="submit" class="btn btn-success" style="border-radius: 20px; font-size: 16px;" name="submit_course">Submit</button><br>-->
                   <button style="margin-left: 0px;" data-dismiss="modal" class="btn btn-danger float-right" >Close</button>
              </div>
          </div>
        </div>
      </div>
    </div> 
     
     
     
     
     
     
     
     
     
     
      <!--Modal for invest-->
     <!--========================Modal for invest===============-->     
   <div class="container w-100">
  <!-- The Modal -->
       <div class="modal fade" id="myModal_invest">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Data Analytics</h4>
            </div>
            <div class="modal-body">
            <p>
            As a result of Digital collation of all Personnels, filtering existing data can help in identifying certain aspects of concern.  </p>
           </div>
              <div class="modal-footer">
                <!--<button type="submit" class="btn btn-success" style="border-radius: 20px; font-size: 16px;" name="submit_course">Submit</button><br>-->
                   <button style="margin-left: 0px;" data-dismiss="modal" class="btn btn-danger float-right" >Close</button>
              </div>
          </div>
        </div>
      </div>
    </div> 
      
     
     
     
     
      </div>
        
    </section><!-- End Contact Us Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" >
   

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>651 BSG ACCN</span></strong>. All Rights Reserved
      </div>
      <!-- <div class="credits">
          Designed by <a href="https://easymaster.com.ng/nice">EasyMaster <i></i></a>
      </div> -->
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets1/vendor/jquery/jquery.min.js"></script>
  <script src="assets1/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets1/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets1/vendor/php-email-form/validate.js"></script>
  <script src="assets1/vendor/jquery-sticky/jquery.sticky.js"></script>
  <script src="assets1/vendor/venobox/venobox.min.js"></script>
  <script src="assets1/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets1/vendor/counterup/counterup.min.js"></script>
  <script src="assets1/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets1/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets1/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets1/js/main.js"></script>

</body>

</html>