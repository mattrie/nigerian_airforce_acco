<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
    include 'connection_ajax.php';
 
// Check connection
if($connect === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
if(isset($_POST['search'])){
    $search = $_POST['search'];

    $query = "SELECT DISTINCT observation FROM census_registration WHERE observation like'%".$search."%'  ORDER BY observation ASC LIMIT 12";
    $result = mysqli_query($connect, $query);
    
    while($row = mysqli_fetch_array($result) ){
        $response[] = array("label"=>$row['observation']);
    }

    echo json_encode($response);
}

exit;