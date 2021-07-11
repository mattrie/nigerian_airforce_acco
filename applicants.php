<?php
        session_start();
        include 'connection.php';
        
        
        
        
        
        
        
        
        if(isset($_GET['iddd'])){
              $id=$_GET['iddd'];
          $name = $_GET['name'];
                   
    $query = "DELETE FROM members WHERE id = '$id'"; 
        $result23 = mysqli_query($connect, $query);  
     
        if ($result23) {
        echo  "<script type='text/javascript'> $(document).ready(function(){ 
                swal({
                         title: 'Deleted!',
                         text: '$name application has been deleted',
                         icon: 'success',
                        buttons: {
                            confirm : {text:'ok',className:'sweet-orange'},
                          
                        },
                        closeOnClickOutside: false
                       })
                  
                }); </script>";
   
        }
     }
        ?>
        
        
        
     
<!DOCTYPE html>
<html lang="en">

<head>
    <title>APPLICANTS</title>
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
                                            <h5 class="m-b-10">Applicants</h5>
                                            <p class="m-b-0">Summary</p>
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
                                   <?php
            
          
          //loop through all table rows
            $inc=1;
           
     $quco111 = mysqli_query($connect, "SELECT * FROM members WHERE not_yet = 'not yet' ORDER BY id DESC");
             
        
        echo ' <div class="card">';
         echo '<div class="card-block table-border-style">';
     
     echo     '<div class="table-responsive" >';   
                 echo '<CAPTION><h3 align="center" style="font-size:28px; color:black;">ONLINE APPLICANTS</h3></CAPTION>';
      echo '<table class="table table-bordered table-striped   table-hover " >';
      
       echo ' <thead class="thead-dark">'; 
        
         echo '<tr align = "center">';
         echo '<th>S/N</th>';
         echo '<th>Name</th>';
         echo '<th>Address</th>';
         echo '<th>Date of Birth</th>';
           echo '<th>Occupation</th>';
             echo '<th>Telephone</th>';
              
             echo '<th>View Details</th>';
               echo '<th>Delete</th>';
          echo '</tr>'; 
          
          echo '</thead>';

    echo '<tbody class="" style="font-family: sans-serif; color:black ; font-weight:bold;">';
    
    
  
    
     while ($row = mysqli_fetch_assoc($quco111)){
            
         
            echo "<tr align = 'center'>";
            echo "<td>" . $inc."</td>";
            echo "<td>" . $row['namee']."</td>";
              echo "<td>" . $row['addresss']."</td>"; 
            echo "<td>" . date('jS F Y', strtotime($row['dateofbirth']))."</td>"; 
           echo "<td>" . $row['parentt']."</td>"; 
               echo "<td>" . $row['telephone']."</td>";  
          echo "<td ><a style='color:brown;' href='edit_members.php?name=" . $row['namee']. "'>Consider</a></td>";
              echo "<td ><a style='color:#cc9900;' onclick=\"javascript: return  $(document).ready(function(){ 
        
                    swal({
                        title: 'Are you sure?',
                        text: 'You are about to delete " . $row['namee']." application. Do you wish to continue?',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true
                         
                      })
                      .then((willDelete) => {
                        if (willDelete) {
                     document.getElementById('oya').click();   
                        } else {
                          swal({
                          text:'Not Deleted!',
                         buttons: {
                            confirm : {text:'ok',className:'sweet-orange'},
                          
                        },
                               });
                               return false;
                        }
                     });
           
          }); \" href='#'>Delete</a></td>";
    echo  "<a style='color:white;' id='oya' href='applicants?iddd=" . $row['id']."&name=".$row['namee']."'>Delete</a>";
              echo "</tr>";
            $inc++;
              
        } 
            
            
        
            
            
                ////////////THIS IS TO SUM CONTRIBUTION
//                        $total_savings = mysqli_query($connect, "SELECT SUM(amount) as total FROM contribution WHERE name='$name'");      
//                          while  ($row = mysqli_fetch_array($total_savings)){
//                          $summation = $row['total'];                          
//                          }
//                            
//                            ////////////THIS IS TO SUM WITHDRAWAL
//                            $total_savings1 = mysqli_query($connect, "SELECT SUM(amount) as total FROM witdraw WHERE name='$name'");      
//                          while  ($row1 = mysqli_fetch_array($total_savings1)){
//                          $summation1 = $row1['total'];                          
//                          }
//                          
//                       $actual_savings =  $summation - $summation1;
//            
//            
            
            
             echo ' </tbody>';
          echo ' </table>';
     
           echo '</div>' ;
            echo '</div>' ;
   
            
            ?>
                
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
             function goBack() {
                 window.location = "admin_home.php";
             }
          </script>
          
           <!--THIS IS TO RE-LOAD THE ENTIRE STUDENT-->
          <script>
         $(document).ready(function() {
               var show_all = $(".show_all"); //LINK TO GO AND VIEW ALL DEBTORS   
    $(show_all).click(function(e){ //Function LINK TO GO AND VIEW ALL DEBTORS button click
        e.preventDefault();
              window.location = "all_members.php";
            });
        });
          </script>   
          
          <!-- Script -->
    <script type='text/javascript'>
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
       });  
        </script>
        
   
     <script>
     /////REMOVE nav2 for table     
       var size = window.innerWidth; 
//       alert(size);
     if(size > 1000){
setTimeout(function() {document.getElementById("mymenu2").click(); }, 1000);
     }
        </script> 
    
    
</body>

</html>
