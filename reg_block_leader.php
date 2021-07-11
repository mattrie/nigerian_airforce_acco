<?php
session_start();
     
    include 'connection.php';
    
   
    $random_pin = rand(10, 1000000);
    
    
      //            UPLOAD PHOTO FUNCTION  
            function fn_resize($image_resource_id,$width,$height) {
                    $target_width =300;
                    $target_height =300;
                    $target_layer=imagecreatetruecolor($target_width,$target_height);
                    imagecopyresampled($target_layer,$image_resource_id,0,0,0,0,$target_width,$target_height, $width,$height);
                    return $target_layer;
                  }   

                             if(isset($_POST['Submit'])){
                                $name = strtoupper($_POST['name']);
                                $svn = strtoupper($_POST['svn']) ;
                                $unit = $_POST['unit'];
                                $block = $_POST['block'];    
                                $phone = $_POST['phone']; 
                                $username = $_POST['username'];       
                                $pass1 = $_POST['pass'];  
                                   $pass = md5($pass1);
                                $date = date("Y-m-d");
          //           THIS IS TO UPLOAD PASSPORT PHOTO  

              $target_dir = "images/";// this is the directory to upload to
           //....................................
            
       
           if (is_array($_FILES)) {
            $timestamp = time(); // Get current timestamp
            // $file2 =  $timestamp . '_' . $_FILES['fileToUpload']['tmp_name'];
            $file = $_FILES['fileToUpload']['tmp_name'];
            $source_properties = getimagesize($file);
            $image_type = $source_properties[2];

            // if (function_exists('exif_read_data')) {
            //     // Check if the image has an orientation attribute
            //     $exif = exif_read_data($file);
            //     if (!empty($exif['Orientation'])) {
            //         $orientation = $exif['Orientation'];
        
            //         // Create an image resource from the uploaded file
            //         if ($image_type == IMAGETYPE_JPEG) {
            //             $image_resource_id = imagecreatefromjpeg($file);
            //         } elseif ($image_type == IMAGETYPE_GIF) {
            //             $image_resource_id = imagecreatefromgif($file);
            //         } elseif ($image_type == IMAGETYPE_PNG) {
            //             $image_resource_id = imagecreatefrompng($file);
            //         }
        
            //         // Rotate the image based on its orientation
            //         switch ($orientation) {
            //             case 3:
            //                 $image_resource_id = imagerotate($image_resource_id, 180, 0);
            //                 break;
            //             case 6:
            //                 $image_resource_id = imagerotate($image_resource_id, -90, 0);
            //                 break;
            //             case 8:
            //                 $image_resource_id = imagerotate($image_resource_id, 90, 0);
            //                 break;
            //         }
            //     }

            //     $target_layer = fn_resize($image_resource_id, $source_properties[0], $source_properties[1]);
            //     $target_file = $target_dir . $timestamp . '_' . $_FILES['fileToUpload']['name'];
            //     imagepng($target_layer, $target_dir . $timestamp . '_' . $_FILES['fileToUpload']['name']);   
           
            // }else
            
            
            if ($image_type == IMAGETYPE_GIF) {
                $image_resource_id = imagecreatefromgif($file);
                $target_layer = fn_resize($image_resource_id, $source_properties[0], $source_properties[1]);
                $target_file = $target_dir . $timestamp . '_' . $_FILES['fileToUpload']['name'];
                imagegif($target_layer, $target_dir . $timestamp . '_' . $_FILES['fileToUpload']['name']);
                // imagegif($target_layer, $timestamp . '_' .$target_dir2 . $_FILES['fileToUpload']['name']);

            } elseif ($image_type == IMAGETYPE_PNG) {
                $image_resource_id = imagecreatefrompng($file);
                $target_layer = fn_resize($image_resource_id, $source_properties[0], $source_properties[1]);
                $target_file = $target_dir . $timestamp . '_' . $_FILES['fileToUpload']['name'];
                imagepng($target_layer, $target_dir . $timestamp . '_' . $_FILES['fileToUpload']['name']);
                // imagepng($target_layer, $timestamp . '_' . $target_dir2 . $_FILES['fileToUpload']['name']);

            }  elseif ($image_type == IMAGETYPE_JPEG) {
                $image_resource_id = imagecreatefromjpeg($file);
                $target_layer = fn_resize($image_resource_id, $source_properties[0], $source_properties[1]);
                $target_file = $target_dir . $timestamp . '_' .  $_FILES['fileToUpload']['name'];
                imagejpeg($target_layer, $target_dir . $timestamp . '_' . $_FILES['fileToUpload']['name']);
                // imagejpeg($target_layer, $timestamp . '_' .$target_dir2 . $_FILES['fileToUpload']['name']);

            } 



        }


           
      
      $sql_statement = "INSERT INTO block_assign (name, svn, unit, block, phone, images, date, username, password) Values('$name','$svn', '$unit', '$block',  '$phone', '$target_file', '$date', '$username', '$pass')";
                     $result = mysqli_query($connect, $sql_statement); 
                //  echo "DB Error ". mysqli_error($connect);
                                    if($result==true){
                                    echo "<script type='text/javascript'> $(document).ready(function(){ 
                swal({
                         title: 'Success!',
                         text: '$name has been successfully assigned to $block',
                         icon: 'success',
                        buttons: {
                            confirm : {text:'Ok',className:'sweet-orange'},
                          
                        },
                        closeOnClickOutside: false
                       })
                  
                }); </script>"; 
                                    } else {
                                        echo "<script>alert('Not submitted')</script>";
                                    }
                           
                                    

                           
                           
                           
                     
            } 
//                    } else {  //Image name already exist in the database
//                     
//                  echo    "This image name has been used. Rename image and try again!!!";
//                    }
//          
//              } else { //greater than 2MB
//                  echo "File size must not be greater than 2 MB!!!"; 
//              }


//          } else { //not jpeg
//              echo "only images allowed, please choose a JPEG, JPG or PNG file!!!";
//          }

//            

    
    
    
    ?>

 
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Block Leader Registration</title>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
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
//                swal({
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
      @media (min-width: 1024px) {
          .button-distance {
             margin-left: 80px;
          }
      }

      @media (max-width: 768px) {
          .button-distance {
             margin-left: 0px;
          }
      }
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
                                            <h5 class="m-b-10">Block Leader</h5>
                                            <p class="m-b-0">Register Block Leader</p>
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
                                        
                                        
          <div class="row">
                                            <div class="col-sm-12">
                                                <!-- Basic Form Inputs card start -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>REGISTRATION FORM</h5>
                                                        <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
                                                    </div>
                                                    <div class="card-block">
                                                        <!--<h4 class="sub-title">Basic Inputs</h4>-->
                                                        <form action="" method="POST" enctype="multipart/form-data">
                                                          <center> 
                                                          <div class="row">
                                                            <div class="col-sm-6">
                                                            <b>For Iphone users, Please capture 45⁰ left</b><br>
                                                                <img src="images/tilt phone.PNG" style="width: 160px;" alt="">
                                                            </div>
                                                           
                                                            <div class="col-sm-6">
                                                            <div  style="width:140px; height:140px;" class="mb-5">
                                                                <img id="img123" src="#" alt="CLICK 'BROWSE' TO UPLOAD PHOTO"  style="border: 4px #99ff99 solid; width:140px; height:140px;" >

                                                                <div class="custom-file mb-3" style="width: 200px;">
                                                                    <input type="file" class="custom-file-input" id="customFile" name="fileToUpload" accept="image/*" >
                                                                    <label class="custom-file-label" for="customFile">Choose Photo>></label>
                                                                </div> 
                                                             </div>
                                                            </div>
                                                           </div>


                                                          
                                                          </center>  
                                                          
                                                            
                                                            <div class="form-group row">
                                                                 <input type="hidden" id="duplicate_name" />  
                                                                <label class="col-sm-2 col-form-label">Name:</label>
                                                                <div class="col-sm-10">
                                                                      <input type="text" class="form-control" placeholder="enter Name"  name="name" id="name"   maxlength="70"  style="text-transform: uppercase;" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">SVN:</label>
                                                                <div class="col-sm-10">
                                                                      <input type="text" class="form-control" placeholder="enter SVN" name="svn" id="svn" maxlength="50"  style="text-transform: uppercase;" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Unit:</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" placeholder="enter Unit"   name="unit" id="unit"  maxlength="70" required="">
                                                                </div>
                                                            </div>
                                                         
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Block Assigned:</label>
                                                                <div class="col-sm-10">
                                                                   <input  class="form-control" type="text" placeholder="enter Block Assigned" name="block" id="block" maxlength="50" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Phone:</label>
                                                                <div class="col-sm-10">
                                                                   <input  class="form-control" type="number" placeholder="enter Phone" name="phone" id="phone" maxlength="50" required>
                                                                </div>
                                                            </div>
                                                          
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Username:</label>
                                                                <div class="col-sm-10">
                                                                      <input type="text" class="form-control"  name="username" required="true" id="username" placeholder="enter username" maxlength="20">
                                                                </div>
                                                            </div>
                                                             <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Password:</label>
                                                                <div class="col-sm-10">
                                                                      <input type="text" class="form-control"  name="pass" required="true" id="pass" placeholder="enter password" maxlength="20">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label"></label>
                                                              
                                                                <div class="col-sm-10 mx-auto">
                                                                    <input style="" type="submit" name="Submit" id="get_submit"  class="btn btn-success button-distance" value="Register"/>
                                                                    <a style="margin-left:70px;" class="btn btn-dark" href="reg_block_leader">Reset</a> 
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
                  $(document).ready(function() {
                    $("#get_submit").click(function(){
                    // var customFile = document.getElementById("customFile").value
                    if(document.getElementById("customFile").value === ""){
                       alert("Please upload a passport photo");
                       $('#customFile').focus();
                       $('#customFile').click();
                       return false;

                    } else if(document.getElementById("name").value === ""){                    
                        alert("Enter a valid name");
                        $('#name').focus();  
                        $('#name').click();                     
                       return false;

                   
                    } else if(document.getElementById("svn").value === ""){
                       alert("Enter SVN");                     
                       $('#svn').focus();
                       $('#svn').click();                     
                       return false;

                    } else if(document.getElementById("unit").value === ""){
                       alert("Enter Unit");                     
                       $('#unit').focus();
                       $('#unit').click();                     
                       return false;

                    
                    } else if(document.getElementById("block").value === ""){
                       alert("Enter Block");                     
                       $('#block').focus();
                       $('#block').click();                     
                       return false;


                 
                    } else if(document.getElementById("phone").value === ""){
                       alert("Enter phone number");                     
                       $('#phone').focus();
                       $('#phone').click();                     
                       return false;
                   

                    } else if(document.getElementById("username").value === ""){
                       alert("Enter Username");                     
                       $('#username').focus();
                       $('#username').focus();                     
                       return false;

                    } else if(document.getElementById("pass").value === ""){
                       alert("Enter Password");                     
                       $('#pass').focus(); 
                       $('#pass').focus();                     
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
    
    
    
    
    
         <script>
      function generate_pin(){
//          var pin_no = document.getElementById('pin').value;
          document.getElementById('pin').value = Math.floor(Math.random() * 1000000);
          return false;
      }
    </script>
    
    
    
        <script>
            $(document).ready(function() {     
//          var check_duplicate = $("#check_duplicate");    
    $("#pin").click(function(){  
        document.getElementById('pin').value = Math.floor(Math.random() * 1000000);
                    });
               });     
   
        </script>
      
    
        

            <!--<center style="font-size: 18px; color: #cccccc; margin-top: 400px"><footer class="">&copy;<?php echo date('Y')?>. By Mr. Matt.</footer></center>-->
   
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
                $('#duplicate_name').val(ui.item.value); // save selected id to input
                $('#duplicate_name').trigger('change');
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
             
             
             /////////THIS IS TO CHECK BEFORE FINAL DELETION////////
              $(document).ready(function () {
               
        $("#delete").click(function () {
               var  name_del = document.getElementById('nam').value;   
        if (name_del === ""){
            alert ("Search member to delete first");
        }   else {
             var  del_check = confirm("You will loose all '"+name_del+"' information when you delete. DO YOU WISH TO CONTINUE?");
                
                if(del_check===true){
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
                  $(document).ready(function() {     
  
    $("#check_duplicate").click(function(){        
        ///////////////////////////////////////////////////////////////////
             
       ////////////////////////////////////////////////////////////   
           var get_name = document.getElementById('autocomplete').value;
            var trim_name =  get_name.trim();
             document.getElementById('autocomplete').value = trim_name;
         
             var studname = $("#autocomplete");
            var duplicate_nam =  $("#duplicate_name");
            
            
            if (get_name === ""){
                swal({
                         title: 'Not Allowed!',
                         text:  'Please fill the form to register a staff first',
                         icon: 'error',
                        buttons: {
                            confirm : {text:'Ok',className:'sweet-orange'}
                          
                        },
                        closeOnClickOutside: false
                       });
                 return false;
            } else {
                if(duplicate_nam.val() === studname.val()){
            var spell_name = document.getElementById('autocomplete').value;
                  swal({
                         title: 'Duplicate!',
                         text: spell_name + ' been registered or used. Please alternate',
                         icon: 'warning',
                        buttons: {
                            confirm : {text:'Ok',className:'sweet-orange'}
                          
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
                  $(document).ready(function() {     
//          var check_duplicate = $("#check_duplicate"); //LINK TO GO AND VIEW ALL DEBTORS   
    $(".getname").keyup(function(){
                
                
                 var studname = document.getElementById("autocomplete").value;
                   
                         
             
               if (window.XMLHttpRequest)
                  {// code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp=new XMLHttpRequest();
                  }
                else
                  {// code for IE6, IE5
                  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                  }        
                   
                  
                     /////THIS IS TO INSERT 
                   xmlhttp.open("GET","check_name.php?name="+studname, true);
                   
                xmlhttp.send();                
                xmlhttp.onreadystatechange = function(){                                   
                    
                if(xmlhttp.readyState === 4 && xmlhttp.status=== 200) {
                               var get_response = xmlhttp.responseText;
                           var new_value =  get_response.trim();
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
   
    
    
</body>

</html>



