<?php
// require 'vendor/autoload';

session_start();
include 'connection.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        Posting Signal
    </title>
    <style>
        .highlight {
            background-color: yellow;
        }

        .highlight2 {
            background-color: lightblue;
        }
    </style>

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
            <span id="admin3">
                <?php
                include 'admin_nav1.php';
                ?>
            </span>

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
                                            <h5 class="m-b-10">Signal</h5>
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
                                        <span id="admin2">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h3>Paste Signal Here</h3>
                                                </div>

                                                <div class="col-sm-6 float-right">
                                                    <a href="https://convertio.co/pdf-docx/"
                                                        target="_blank" class="float-right"
                                                        style="color:blue;"><b>Convert Signal PDF to word</b></a>
                                                </div>
                                            </div>

                                            <form method="POST" action="">
                                                <textarea name="inputText" rows="4" class="form-control" required></textarea><br>
                                                <input type="submit" class="btn btn-primary" name="sub" value="Compare">
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="submit" class="btn btn-primary" name="identify" value="Highlight All">
                                            </form>
                                        </span>


                                        <?php
                                        include "connection.php";
                                        if (isset($_POST['sub'])) {
                                            // By  Adedokun Adewale Azeez
                                            // Connect to your MySQL database
                                            $mysqli = new mysqli("localhost", "root", "8168627861", "naf_housing");

                                            if ($mysqli->connect_error) {
                                                die("Connection failed: " . $mysqli->connect_error);
                                            }

                                            // Get the input text from the form
                                        
                                             // Get the input text from the form
                                             $inputText = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['inputText'])));
                                            // Initialize a variable to count "(NAF/" occurrences

                                            // Initialize a variable to count "(NAF/" occurrences
                                            $count_naf_occurrences = substr_count($inputText, "(NAF/");

                                            // Highlight "(NAF/" occurrences
                                            // $inputText = str_replace("(NAF/", "<span class='highlight'>(NAF/</span>", $inputText);
                                        


                                            // Perform a MySQL query to find and count matches
                                            $query = "SELECT name, svn, rank, block, flat_no FROM census_registration WHERE '" . $inputText . "' LIKE CONCAT('%', svn, '%')";
                                            $result = $mysqli->query($query);

                                            $result_count = mysqli_query($connect, "SELECT COUNT(svn) as total_count FROM census_registration WHERE '" . $inputText . "' LIKE CONCAT('%', svn, '%')");
                                            while ($row = mysqli_fetch_array($result_count)) {
                                                $occpants = $row['total_count'];
                                            }


                                            if ($result->num_rows > 0) {
                                                echo "<h2>Existing Personnel in Database: $occpants &nbsp;&nbsp; <button class='btn btn-info float-right' id='admin1' onclick='print_signal()'>PRINT</button></h2>";
                                                while ($row = $result->fetch_assoc()) {
                                                    $match = $row["svn"];
                                                    $inputText = preg_replace("/\b" . preg_quote($match, "/") . "\b/", "<span class='highlight'><a href='view_member.php?svn=" . $row["svn"] . "' style='font-size:20px;'>" . $match . "</a></span>", $inputText);
                                                    echo "<a href='view_member.php?svn=" . $row["svn"] . "' style='font-size:22px;'>" . $row["svn"] . " - " . $row["rank"] . " - " . $row["name"] . " - " . $row["block"] . " - Flat No " . $row["flat_no"] . "</a><br>";

                                                }
                                            } else {
                                                echo "<h2>No Match found in Database</h2>";

                                            }

                                            echo "<br>";
                                            // Display the count of "(NAF/" occurrences
                                            echo "<h4 class='text-center'>Total Posted: $count_naf_occurrences (Non Existing: " . $focus = $count_naf_occurrences - $occpants . ")</h4>";

                                            // Display the input text with highlights
                                            echo "<p style='font-size:18px;'>" . nl2br(html_entity_decode($inputText)) . "</p>";
                                            
                                            // Close the database connection
                                            $mysqli->close();


                                        }


                                        if (isset($_POST['identify'])) {
                                            // Connect to your MySQL database
                                            $mysqli = new mysqli("localhost", "root", "8168627861", "naf_housing");

                                            if ($mysqli->connect_error) {
                                                die("Connection failed: " . $mysqli->connect_error);
                                            }

                                            // Get the input text from the form
                                            $inputText = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['inputText'])));
                                            // Initialize a variable to count "(NAF/" occurrences
                                            $count_naf_occurrences = substr_count($inputText, "NAF/");




                                            // Perform a MySQL query to find and count matches
                                            $query = "SELECT svn  FROM census_registration WHERE '" . $inputText . "' LIKE CONCAT('%', svn, '%')";
                                            $result = $mysqli->query($query);



                                            if ($result->num_rows > 0) {
                                                // echo "<h2>Matching Values in Database:</h2>";
                                                $uniqueMatches = array(); // Create an array to store unique matches
                                        
                                                while ($row = $result->fetch_assoc()) {
                                                    $match = $row["svn"];

                                                    // Check if the match is unique
                                                    if (!in_array($match, $uniqueMatches)) {
                                                        $uniqueMatches[] = $match;
                                                        // Highlight the first occurrence in the input text
                                                        $inputText = preg_replace("/\b" . preg_quote($match, "/") . "\b/", "<span class='highlight' style='color:blue;font-size:18px;'>" . $match . "</span>", $inputText);

                                                        // echo $match . "<br>";
                                                    }
                                                }
                                            }




                                            // Highlight "(NAF/" occurrences
                                            $inputText = str_replace("NAF/", "<span class='highlight2' style='color:green;'>NAF/</span>", $inputText);


                                            echo "<br>";
                                            // Display the count of "(NAF/" occurrences
                                            echo "<h4 class='text-center'>Total Posted: $count_naf_occurrences </h4>
                                             <button class='btn btn-info ' id='admin1' onclick='print_signal()'>PRINT</button>";

                                            // Display the input text with highlights
                                            echo "<p style='font-size:18px;'>" . nl2br(html_entity_decode($inputText)) . "</p>";
                                            
                                            // Close the database connection
                                            $mysqli->close();


                                        }
                                        ?>
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
                            function print_signal() {
                                document.getElementById("admin1").style.display = 'none';
                                document.getElementById("admin3").style.display = 'none';
                                document.getElementById("admin2").style.display = 'none';
                                document.getElementById("mymenu2").click();

                                // document.title = document.getElementById('full_name').value;
                                window.print();
                                document.getElementById("admin1").style.display = '';
                                document.getElementById("admin3").style.display = '';
                                document.getElementById("admin2").style.display = '';
                                document.getElementById("mymenu2").click();



                            }
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
                    <form action="view_member" method="post">
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