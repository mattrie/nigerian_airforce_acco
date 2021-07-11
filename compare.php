<!DOCTYPE html>
<html>
<head>
    <title>Text Comparison</title>
    <style>
        .highlight{
            background-color: yellow;
        }
    </style>
</head>
<body>
    <h3>Paste Signal Here</h3>
    <form method="POST" action="">
        <textarea name="inputText" rows="5" cols="40"></textarea><br>
        <input type="submit" name="sub" value="Submit">
    </form>



    <?php
    include "connection.php";
   if(isset($_POST['sub'])){
    // Connect to your MySQL database
    $mysqli = new mysqli("localhost", "root", "8168627861", "naf_housing");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Get the input text from the form
    $inputText = mysqli_real_escape_string($connect, strip_tags(str_replace("'", "", $_POST['inputText'])));


    // Perform a MySQL query to find and count matches
     $query = "SELECT name, svn, block, flat_no FROM census_registration WHERE '" . $inputText . "' LIKE CONCAT('%', svn, '%')";
     $result = $mysqli->query($query);

     $result_count = mysqli_query($connect, "SELECT COUNT(svn) as total_count FROM census_registration WHERE '" . $inputText . "' LIKE CONCAT('%', svn, '%')") ;
     while($row = mysqli_fetch_array($result_count)){
        $test_sn = $row['total_count'];
     }

    
     if ($result->num_rows > 0) {
         echo "<h2>Matching Personnel in Database: $test_sn</h2>";
         while ($row = $result->fetch_assoc()) {
             $match = $row["svn"];
             $inputText = preg_replace("/\b" . preg_quote($match, "/") . "\b/", "<span class='highlight'><a href='view_member.php?svn=". $row["svn"] . "' >" . $match . "</a></span>", $inputText);
             echo "<a href='view_member.php?svn=". $row["svn"] . "' style='font-size:22px;'>". $row["svn"] . " - ". $row["name"] ." - ". $row["block"] ." - Flat No ". $row["flat_no"] ."</a><br>";
            
            }
     }

 
     // Display the input text with highlights
      echo "<p style='font-size:18px;'>" . nl2br(html_entity_decode($inputText)) . "</p>";
 
    // Close the database connection
    $mysqli->close();


}
    ?>
</body>
</html>
