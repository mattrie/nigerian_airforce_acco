<?php
require 'vendor/autoload.php';

// use PHPExcel_IOFactory;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Signal</title>

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

<body class="container mt-5">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="excel_file" accept=".xlsx, .xls" required>
        <input type="submit" name="ex_up" value="Upload and Compare">
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
            $svn_column = $row[3]; // fourth column
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
        echo '<table class="table table-bordered table-hover table-striped mt-5">';
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



        // Load the Excel file
        $inputFileName = 'main bsg data.xlsx';
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

        // Select the worksheet
        $worksheet = $objPHPExcel->getActiveSheet();

        // Get all the data from the worksheet
        $excelData = $worksheet->toArray();





        $isFirstRow = true; // Flag to skip the first row
    
        echo '<table class="table table-bordered table-hover table-striped mt-5">';
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
            $svn_column = $row[6]; // Assuming the value to check is in the fifth column
            $name_column = $row[4];
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