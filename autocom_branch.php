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

    $query = "SELECT name FROM branch WHERE name like'%".$search."%' ORDER BY name ASC LIMIT 12";
    $result = mysqli_query($connect,$query);
    
    while($row = mysqli_fetch_array($result) ){
        $response[] = array("label"=>$row['name']);
    }

    echo json_encode($response);
}

exit;