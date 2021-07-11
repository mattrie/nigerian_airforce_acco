<?php
session_start();
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>ALL REGISTERED</title>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

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
                                            <h5 class="m-b-10">All Registered</h5>
                                            <p class="m-b-0">Table List</p>
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
                                    <form name="srch1" action="" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                      
                                            <div class="col-sm-4">                                           

                                                    <center>
                                                       <select  id="switcher" name="switcher1" class="form-control" required>
                                                            <option value="" hidden selected disabled>Filter by Field name</option>
                                                            <option value="gender">Filter By Gender</option>
                                                            <option value="rank">Filter By Rank</option>
                                                            <option value="address">Filter By Address</option>
                                                       </select>
                                                    </center>
                                            
                                            </div>



                                            <div class="col-sm-6">
                                                
                                                    <center>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" id="autocomplete"
                                                                name="srch" autocomplete="off" placeholder="Search Field Values"
                                                                required="">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-warning" id="btnsearch"
                                                                    name="btnsrch" type="submit">SEARCH</button>
                                                            </div>
                                                        </div>
                                                    </center>
                                               

                                            </div>

                                            <div class="col-sm-2">
                                                <a href="all_members.php" class="btn btn-primary">View All</a>
                                            </div>
                                        
                                        </div>
                                    </form>    
                                          
                                        <?php

                                     
                                        if (isset($_POST['btnsrch'])) {
                                            $switcher = $_POST['switcher1'];
                                            $get_category = $_POST['srch'];
                                            $cat_count = "";
                                            if ($switcher == "gender") {
                                                $count_cat = mysqli_query($connect, "SELECT COUNT(id) as count_cat FROM census_registration WHERE gender = '$get_category'");
                                                while ($row = mysqli_fetch_array($count_cat)) {
                                                    $cat_count = $row['count_cat'];
                                                  }
                                                $result_filter = mysqli_query($connect, "SELECT * FROM census_registration WHERE gender = '$get_category'");
                                            
                                            } elseif($switcher == "rank"){
                                                $count_cat = mysqli_query($connect, "SELECT COUNT(id) as count_cat FROM census_registration WHERE rank = '$get_category'");
                                                while ($row = mysqli_fetch_array($count_cat)) {
                                                    $cat_count = $row['count_cat'];
                                                  }
                                                $result_filter = mysqli_query($connect, "SELECT * FROM census_registration WHERE rank = '$get_category'");
                                            
                                            } elseif($switcher == "address"){
                                                $count_cat = mysqli_query($connect, "SELECT COUNT(id) as count_cat FROM census_registration WHERE address = '$get_category'");
                                                while ($row = mysqli_fetch_array($count_cat)) {
                                                    $cat_count = $row['count_cat'];
                                                  }
                                                $result_filter = mysqli_query($connect, "SELECT * FROM census_registration WHERE address = '$get_category'");
                                             
                                            } else {
                                                if ($cat_count < 1) {
                                                    echo "<script type='text/javascript'> $(document).ready(function(){ 
                                                        swal({
                                                                 title: 'Error!',
                                                                 text: '$get_category does not exist in any of the fields values!',
                                                                 icon: 'error',
                                                                buttons: {
                                                                    confirm : {text:'Ok',className:'sweet-orange'},
                                                                  
                                                                },
                                                                closeOnClickOutside: false
                                                               })
                                                          
                                                        }); </script>";
                                                }
                                            }

                                            echo '<input type="hidden" id="get_table_name" value="Filtered By: ' . $get_category . ' [' .$cat_count.'] "';
                                            echo ' <div class="card">';
                                            echo '<div class="card-block table-border-style">';

                                            echo '<div class="table-responsive" >';
                                          
                                            echo '<CAPTION><h3 align="center" style="font-size:20px; color:black;" >Filtered By: ' . $get_category . ' [' .$cat_count.']</h3></CAPTION>';
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
                                            while ($row = mysqli_fetch_array($result_filter)) {



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
                                                echo "<td ><a style='color: blue;' href='view_member.php?namee=" . $row['name'] . "'>View details</a></td>";

                                                echo "<td ><a style='color: brown;' href='edit_members.php?namee=" . $row['name'] . "'>Edit </a></td>";

                                                echo "</tr>";
                                                $inc++;
                                            }


                                            echo ' </tbody>';
                                            echo ' </table>';

                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            
                                           
                                        } else {
                                            //loop through all table rows
                                            $inc = 1;
                                            $count_all = mysqli_query($connect, "SELECT COUNT(id) as count_all FROM census_registration");
                                            while ($row = mysqli_fetch_array($count_all)) {
                                              $everbody = $row['count_all'];
                                            }
                                            $result = mysqli_query($connect, "SELECT * FROM census_registration ORDER BY id DESC");
                                            echo '<input type="hidden" id="get_table_name" value="ALL REGISTERED: [' . $everbody . '] "';
                                            echo ' <div class="card">';
                                            echo '<div class="card-block table-border-style">';

                                            echo '<div class="table-responsive" >';
                                            echo '<CAPTION><h3 align="center" style="font-size:20px; color:black;" >ALL REGISTERED: ' . $everbody . '</h3></CAPTION>';
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
                                                echo "<td ><a style='color: blue;' href='view_member.php?namee=" . $row['name'] . "'>View details</a></td>";

                                                echo "<td ><a style='color: brown;' href='edit_members.php?namee=" . $row['name'] . "'>Edit </a></td>";

                                                echo "</tr>";
                                                $inc++;
                                            }





                                            echo ' </tbody>';
                                            echo ' </table>';

                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                        }

                                        ?>

                                        <br>
                                        <button onclick="exportToCSV()" style="cursor: pointer;" class="btn btn-primary">Export to Excel</button>


                                        <script>
                                            function goBack() {
                                                window.location = "admin_home.php";
                                            }
                                        </script>

                                        <!--THIS IS TO RE-LOAD THE ENTIRE STUDENT-->
                                        <script>
                                            $(document).ready(function () {
                                                var show_all = $(".show_all"); //LINK TO GO AND VIEW ALL DEBTORS   
                                                $(show_all).click(function (e) { //Function LINK TO GO AND VIEW ALL DEBTORS button click
                                                    e.preventDefault();
                                                    window.location = "all_Registered.php";
                                                });
                                            });
                                        </script>




                                    <!-- SWITCH DROP DOWN -->
                                    <script>
                                        $(document).ready(function(){
                                            $('#switcher').change(function(){
                                             
                                               var switcher_value = document.getElementById('switcher').value;
                                            //    alert(switcher_value);
                                               if (switcher_value === "gender") {
                                                $(function () {

                                                    $("#autocomplete").autocomplete({
                                                        source: function (request, response) {

                                                            $.ajax({
                                                                url: "autocomplete_gender.php",
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
                                               }
                                             
                                               if (switcher_value === "rank") {
                                                $(function () {

                                                    $("#autocomplete").autocomplete({
                                                        source: function (request, response) {

                                                            $.ajax({
                                                                url: "autocomplete_rank.php",
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
                                               } 

                                               if (switcher_value === "address") {
                                                $(function () {

                                                    $("#autocomplete").autocomplete({
                                                        source: function (request, response) {

                                                            $.ajax({
                                                                url: "autocomplete_address.php",
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
        



        <script>
        function exportToCSV() {
            const table = document.getElementById('myTable');

            // Create a new HTML table element and copy the content
            const clonedTable = table.cloneNode(true);

            // Create a new Blob containing the table content as CSV
            const csvData = [];
            const rows = clonedTable.querySelectorAll('tr');
            for (const row of rows) {
                const rowData = [];
                const cells = row.querySelectorAll('th, td');
                for (const cell of cells) {
                    rowData.push(cell.textContent);
                }
                csvData.push(rowData.join(','));
            }
            const blob = new Blob([csvData.join('\n')], {
                type: 'text/csv;charset=utf-8'
            });

            // Use FileSaver.js to save the Blob as a CSV file
            var table_name = document.getElementById('get_table_name').value;
            // alert(table_name);
            saveAs(blob, table_name+'.csv');
        }
    </script>








        <!-- Warning Section Ends -->

        <script>
            /////REMOVE nav2 for table     
            var size = window.innerWidth;
            //       alert(size);
            if (size > 1000) {
                setTimeout(function () { document.getElementById("mymenu2").click(); }, 1000);
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

        <script>


            window.onload = function () {
                document.getElementById('magic-collapse').click();

            };
        </script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>


</body>

</html>