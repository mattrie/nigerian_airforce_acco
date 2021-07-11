<?php
include 'connection_ajax.php';

$slide_control = $_GET['slide_control'];

if ($slide_control == 0) {
  $result_control = mysqli_query($connect, "UPDATE staff SET slider = 'close'");
  if ($result_control == true) {
    echo "SEAFB (RDCSAC) app has been successfully closed.";
  }
} else {
  $result_control = mysqli_query($connect, "UPDATE staff SET slider = 'open'");
  echo "SEAFB (RDCSAC) app is now successfully opened";
}