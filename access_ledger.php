<?php
session_start();
    include 'connection.php';
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
                                            <h5 class="m-b-10">Dashboard</h5>
                                            <p class="m-b-0">Financial Summary</p>
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
            <div class="row" style="margin-top: 40px;">
                <div class="col-sm-4">
                    
                </div>
             <div class="col-sm-3">
<!--                 <form name="statuses" action="all_members" method="POST" enctype="multipart/form-data">
                 
               
                   <select name="status"  required="">
                    <option value="" disabled selected hidden>select status</option>
                    <option value="active">Active</option>
                  <option value="non_active">Non_Active</option>
               </select>
               
               <br> 
               <button  name="submit_status" style="font-weight: bold; border-radius: 8px; padding:7px; font-style:italic ; font-size: 14px; background-color:green; color: whitesmoke; cursor: pointer; margin-bottom: 70px;">Status</button>
         
               </form>-->
               </div>
           
           <div class="col-sm-3">
          <!--SHOW ALL-->
         <!--<button class="show_all" style="border-radius: 8px; padding:8px; font-style:italic ; font-size: 18px; background-color:green; color: whitesmoke; cursor: pointer">VIEW ALL</button><br>-->
              </div>
                
                 <div class="col-sm-3">
                    
                </div>
         
</div>
            
             <div class="row">
                 <div class="col-sm-4">
                     
                 </div> 
                 
                
                 
                 <div class="col-sm-4">
                     <form name="srch" action="" method="POST" enctype="multipart/form-data">
               
               <center>
<!--         <div class="input-group mb-3">
             <input type="text" class="form-control" id="autocomplete" name="srch" placeholder="Search Customer To View" required=""  autofocus="" >
    <div class="input-group-append">
      <button class="btn btn-warning" id="btnsearch" name="btnsrch" type="submit">SEARCH</button>  
     </div>
  </div>-->
                 </center>
          </form> 
                     
                     
               
                     
              </div> 
                 <div class="col-sm-4" style="color: #cc6600">
                     
                 </div> 
            </div> 
            
          
            </form>
            
            
            <?php
                    if (isset($_POST['access_submit'])) {
                     $daily_l = $_POST['daily_l'];
                      $weekly_l = $_POST['weekly_l'];
                     $monthly_l = $_POST['monthly_l'];  
                   $staff_name = $_POST['staff_name'];     
                     
                $update_ledger = mysqli_query($connect, "UPDATE staff SET daily_ledger = '$daily_l', weekly_ledger = '$weekly_l', monthly_ledger = '$monthly_l' WHERE namee = '$staff_name'");   
                if ($update_ledger == true) {
                      echo "<script type='text/javascript'> $(document).ready(function(){ 
                swal({
                         title: 'Success!',
                         text: '$staff_name access to Ledgers is Updated.   Daily = $daily_l access.   Weekly = $weekly_l access.   Monthly = $monthly_l access.',
                         icon: 'success',
                        buttons: {
                            confirm : {text:'Ok',className:'sweet-orange'},
                          
                        },
                        closeOnClickOutside: false
                       })
                  
                }); </script>";
                }   
              
                        
                    }
          
          //loop through all table rows
            $inc=1;
           
     $quco111 = mysqli_query($connect, "SELECT * FROM staff ORDER BY namee ASC");
//     printf("Errormessage: %s\n", mysqli_error($connect));        
        
     echo ' <div class="card card-block table-border-style">';       
     echo     '<div class="table-responsive">';  

                 echo '<CAPTION><h3 align="center" style="font-size:28px; color:black;">GRANT ACCESS TO LEDGERS</h3></CAPTION>';
      echo '<table class="table table-bordered table-striped " align="center">';
      
       echo ' <thead class="thead-dark">'; 
        
         echo '<tr align = "center">';
         echo '<th>S/N</th>';
         echo '<th>Name</th>';
         echo '<th>Daily Ledger</th>';
         echo '<th>Weekly Ledger</th>';
           echo '<th>Monthly Ledger</th>';
              
             echo '<th>View Details</th>';
          echo '</tr>'; 
          
          echo '</thead>';

    echo '<tbody class="" style="font-family: sans-serif; color:black ; font-weight:bold;">';
    
    
  
    
     while ($row = mysqli_fetch_assoc($quco111)){
         
                   
         
            echo "<tr align = 'center'>";
            echo "<td>" . $inc."</td>";
            echo "<td>" . $row['namee']."</td>";
          
            echo '  <form name="access_submit" action="access_ledger" method="POST" enctype="multipart/form-data">';   
               echo "<input type='hidden' name='staff_name' value='".$row['namee']."'>"; 
            echo "<td>
                  <select style='color:#006600;' name='daily_l'>
                         <option  value='".$row['daily_ledger']."'>".$row['daily_ledger']."</option>
                         <option value='No'>No</option>
                         <option value='Yes'>Yes</option>
                     </select>  
                     </td>"; 
              
            echo "<td>
                <select style='color:#cc6600;' name='weekly_l'>
                   <option value='".$row['weekly_ledger']."'>" . $row['weekly_ledger']."</option>
                  <option value='No'>No</option>
                         <option value='Yes'>Yes</option>
               </select>  
               </td>"; 
            
            
            
              echo "<td>
                  <select style='color:red;' name='monthly_l'>
                   <option value='".$row['monthly_ledger']."'>" . $row['monthly_ledger']."</option>
                  <option value='No'>No</option>
                         <option value='Yes'>Yes</option>
               </select>  
               </td>"; 
          echo "<td ><input type='submit' class='btn btn-success' style='color:white;' value='UPDATE' name='access_submit'></td>";
           echo '</form>';   
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
            
            
        </div>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        <script>
             function goBack() {
                 window.location = "admin_home";
             }
          </script>
          
           <!--THIS IS TO RE-LOAD THE ENTIRE STUDENT-->
          <script>
         $(document).ready(function() {
               var show_all = $(".show_all"); //LINK TO GO AND VIEW ALL DEBTORS   
    $(show_all).click(function(e){ //Function LINK TO GO AND VIEW ALL DEBTORS button click
        e.preventDefault();
              window.location = "all_members";
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

   <script>
     /////REMOVE nav2 for table     
       var size = window.innerWidth; 
//       alert(size);
     if(size > 1000){
setTimeout(function() {document.getElementById("mymenu2").click(); }, 1000);
     }
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
