<?php
require 'vendor/autoload.php';

// use PHPExcel_IOFactory;

session_start();
include 'connection.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        Posting Signal
    </title>

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
                                            <h5 class="m-b-10">Posting Signal</h5>
                                            <?php

                                            ?>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb">

                                            <?php
                                            if (isset($_SESSION['id_admin'])) {
                                                ?>
                                                <li class="breadcrumb-item">
                                                    <a href="admin_home"> <i class="fa fa-home"></i> </a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="admin_home">Dashboard</a>
                                                    <?php
                                            }
                                            ?>

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
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="file" name="excel_file" accept=".xlsx, .xls" required>
                                            <input type="submit" name="ex_up" class="btn btn-primary" value="Upload and Compare">
                                        </form>


                                        <!-- <p>Type something in the input field to search the table for first names, last names or emails:</p>   -->


                                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                                        <br>
                                        <?php
                                        include "connection.php";

                                        if (isset($_POST['ex_up'])) {

                                            $excel_uploaded = "uploads/" . $_FILES['excel_file']['name'];
                                            move_uploaded_file($_FILES['excel_file']['tmp_name'], $excel_uploaded);

                                            // Load the Excel file
                                            $inputFileName = "uploads/Signal (Posting).xlsx";
                                            $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

                                            // Select the worksheet
                                            $worksheet = $objPHPExcel->getActiveSheet();

                                            // Get all the data from the worksheet
                                            $excelData = $worksheet->toArray();




                                            $isFirstRow = true; // Flag to skip the first row
                                        
                                            $totalMatches = 0;
                                            foreach ($excelData as $row) {
                                                $svn_column = $row[3]; // fourth column o 1 2 3
                                                $name_column = $row[1];

                                                $count_result = mysqli_query($connect, "SELECT COUNT(id) as total_exist FROM census_registration WHERE svn = '$svn_column'");
                                                if ($count_result) {
                                                    $count_row = mysqli_fetch_assoc($count_result);
                                                    $count_exist = $count_row['total_exist'];
                                                    // Increment the total matches
                                                    $totalMatches += $count_exist;
                                                } else {
                                                    echo "Error executing the query: " . mysqli_error($connect);
                                                }

                                            }


                                            echo "<h3>$totalMatches already exist</h3>";
                                            echo '<table class="table table-bordered table-hover table-striped mt-2">';
                                            echo '<thead class="thead-dark">
                                                    <th>Name</th>
                                                    <th>SVN</th>
                                                    <th>Block</th>
                                                    <th>Status</th>
                                                </thead>';
                                            echo '<tbody id="myTable">';
                                            $get_svn = "";
                                            foreach ($excelData as $row) {
                                                if ($isFirstRow) {
                                                    $isFirstRow = false;
                                                    continue;
                                                }
                                                $svn_column = $row[3]; // fourth column
                                                $name_column = $row[1];
                                                // Prepare a SQL query to check if the value exists in the database
                                                $result22 = mysqli_query($connect, "SELECT * FROM census_registration WHERE svn = '$svn_column'");
                                                while (@$row2 = mysqli_fetch_assoc($result22)) {
                                                    $get_svn = $row2['svn'];
                                                    $get_block = $row2['block'];
                                                }
                                                echo '<tr>';
                                                if ($svn_column == $get_svn) {
                                                    echo "<td ><span style='background-color: yellow;'>$name_column</span> </td>";
                                                } else {
                                                    echo "<td>$name_column </td>";
                                                }

                                                echo '<td>';
                                                if ($svn_column == $get_svn) {
                                                    // The value exists in the database, highlight it or mark it as needed
                                                    echo '<span style="background-color: yellow;">' . $svn_column . '</span>';
                                                } else {
                                                    echo $svn_column;
                                                }
                                                echo '</td>';

                                                if ($svn_column == $get_svn) {
                                                    echo "<td ><span style='background-color: yellow;'>$get_block</span> </td>";
                                                } else {
                                                    echo "<td> </td>";
                                                }



                                                echo '<td>';

                                                if ($svn_column == $get_svn) {
                                                    // The value exists in the database, highlight it or mark it as needed
                                                    echo '<span style="background-color: yellow;">Exists</span>';
                                                } else {
                                                    echo 'No Match';
                                                }

                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            echo '</tbody>';

                                            echo '</table>';

                                        } else {

                                            // Do nothing
                                        }

                                        ?>




                                        <script>
                                            $(document).ready(function () {
                                                $("#myInput").on("keyup", function () {
                                                    var value = $(this).val().toLowerCase();
                                                    $("#myTable tr").filter(function () {
                                                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                                    });
                                                });
                                            });
                                        </script>

                                    
                                        <!-- <?php
                        if (isset($_SESSION['id_admin'])) {
                            ?>
                            <button onclick="exportToCSV()" style="cursor: pointer;" class="btn btn-primary">Export to
                                Excel</button>
                            <?php
                        }
                        ?> -->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                     

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
                            $(document).ready(function () {
                                $('#switcher').change(function () {

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
            saveAs(blob, table_name + '.csv');
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


    <div class="modal" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Enter Request</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="name" value="<?php echo $name ?>">
                        <input type="hidden" name="svn" value="<?php echo $svn ?>">
                        <input type="hidden" name="rank" value="<?php echo $rank ?>">
                        <textarea class="form-control" name="request" rows="10" required></textarea>
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

    <script>


        window.onload = function () {
            document.getElementById('magic-collapse').click();

        };
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>


</body>

</html>