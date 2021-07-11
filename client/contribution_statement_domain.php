<?php
session_start();
    include 'connection.php';
    
   
    
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Statement</title>
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

   
    
    
            <!-- Script -->
    <script src='jquery-3.1.1.min.js' type='text/javascript'></script>

    <!-- jQuery UI -->
     
    <link href='jquery-ui.min.css' rel='stylesheet' type='text/css'>
    <script src='jquery-ui.min.js' type='text/javascript'></script>
        
        
          <!--Boostrap & family-->
 <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
 <link rel="stylesheet" href="maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 
 
  <script src="maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
        
</head>

<body style="margin-top: 90px; background-color: #e0d3d3; ">
    <center class="heading"><div class="trans fixed-top" style="background-color:#ff5d0f; font-size: 22px; color: black;"><b>NAF</b></div></center>
   
         

           
                                    <div class="page-body">
           <!--**********************************************************************************-->                                 
           <div class="row" style="margin-left: 200px;">
               <div class="col-sm-4" >
                  
                   <form  action="contribution_statement_domain" method="POST" enctype="multipart/form-data">
                   <select name="months" id="months"  required="">
                    <option value="" disabled selected hidden>select month</option>
                   <option>January</option>
                   <option>February</option>
                   <option>March</option>
                   <option>April</option>
                   <option>May</option>
                   <option>June</option>
                   <option>July</option>
                   <option>August</option>
                   <option>September</option>
                   <option>October</option>
                   <option>November</option>
                   <option>December</option>                  
               </select>
               
                   <select name="years1" id="years1" required="">
                    <option value="" disabled selected hidden>select year</option>
                   <option>2017</option>
                  <option>2018</option>
                   <option>2019</option>
                  <option>2020</option>
                  <option>2021</option>
                 <option>2022</option>
                 <option>2023</option>
                  <option>2024</option>
                   <option>2025</option>
                  <option>2026</option>
                  <option>2027</option>
                 <option>2028</option>   
                  <option>2029</option>
                 <option>2030</option>   
               </select>
                
               
               <br> 
               <input type="submit"  name="month_year" value="Search Month" class="select_month" style="font-weight: bold; border-radius: 8px; padding:7px; font-style:italic ; font-size: 14px; background-color:green; color: whitesmoke; cursor: pointer;">
         
               </form>
                </div>
               
               
               
               
               
               
           <div class="col-sm-4">
               <form  action="contribution_statement_domain" method="POST" enctype="multipart/form-data">
                 
               
                     <select name="year_alone2" id="year_a" required="">
                    <option value="" disabled selected hidden>select year</option>
                   <option>2017</option>
                  <option>2018</option>
                   <option>2019</option>
                  <option>2020</option>
                  <option>2021</option>
                 <option>2022</option>
                 <option>2023</option>
                  <option>2024</option>
                   <option>2025</option>
                  <option>2026</option>
                  <option>2027</option>
                 <option>2028</option>   
                  <option>2029</option>
                 <option>2030</option>   
               </select>
               
               <br> 
               <button  name="year_a2" class="select_year" style="font-weight: bold; border-radius: 8px; padding:7px; font-style:italic ; font-size: 14px; background-color:green; color: whitesmoke; cursor: pointer;">Search Year</button>
         
               </form>
               </div>
                   
                   
                     <div class="col-sm-4">
          <!--SHOW ALL-->
          
          <form action="contribution_statement_domain" method="POST" enctype="multipart/form-data">
             
              <a style="border-radius: 8px; padding:8px; font-style:italic ; font-size: 18px; background-color:green; color: whitesmoke; cursor: pointer" class="btn" href="contribution_statement_domain">VIEW ALL</a> <br>
     
          </form>
             </div>
                   
                   
             </div>  
           <br>
          <!--**********************************************************************************-->                               
                                     <?php
                                     
                                     
                                     
             //loop through all table rows
            $inc=1;
           if(@$_GET['name'] != ""){
       $_SESSION['store_name'] = $_GET['name'];
           }
       @$name = $_SESSION['store_name'];
       
        $sql_state = "SELECT * FROM contribution WHERE name = '$name' ORDER BY id DESC LIMIT 500";
            $result = mysqli_query($connect, $sql_state);
            echo '<div class="container">';
       ////SELECT NAME FROM DATABASE TO LOAD PASSPORT TEL & ADDRESS
   $debtor_info = mysqli_query($connect, "SELECT * FROM members WHERE namee = '$name'");        
        while($row_info = mysqli_fetch_assoc($debtor_info)){
             $address = $row_info['addresss'];
             $tel = $row_info['telephone'];
              $image = $row_info['imagess'];
        }     
   
      
        echo '<div class="row">';
        
         echo '<div class="col-sm-5" >';
         echo "<p style='font-size:18px; color:black; margin-bottom:30px; margin-left: 35px;'>";
         echo "<label>Name: ". $name ."</label><br>";
          echo "<label>Tel: ". $tel ."</label><br>";
          echo "<label>Address: ". $address ."</label><br>";
         
         
      
        echo "<p>";
          /////CREATE HIDDEN INPUT TEXTBOX TO CARRY VALUES TO JAVASCRIPT 

//        PLEASE NOTE THAT YOU HAVE TO USE SOME "\" TO AVOID BRAKE SPACE IN NAMES
       echo "<input type='hidden' value=\"".$name. "\" id = 'name'/>"; 

       
           echo "</div>";
           
          
           
           
           
           
           
           
           
           
           
           
           
           

               //=========+++++++++++++++++++++++++++MONTH DISPLAY
           if (isset($_POST['month_year'])) {
                
             $months = $_POST['months'];  
              $years1 = $_POST['years1'];  
            $name = $_SESSION['store_name'];
            $sql_state = "SELECT * FROM contribution WHERE name = '$name' AND month = '$months' AND year = '$years1' ORDER BY id DESC";
            $result = mysqli_query($connect, $sql_state);   
              
              
        echo '<div class="col-sm-3">';
//       echo "<a class='btn' style='color: whitesmoke; background-color: green; margin-right: 10px;' href='contribution?name=" . $name. "'>Contribute</a>";
//        echo "<a class='btn' style='color: whitesmoke; background-color: red;' href='contribution_withdrawal?name=" . $name. "'>Withdraw</a>";
//       echo "<br><a href='contribution' style='color:blue;'>Click Here for Blank Payment Panel</a>"; 
         echo "</div>";
        
        echo '<div class="col-sm-4">';
          echo '<div  style="margin-left: 40px; width:140px; height:140px;">
            <img id="img" src="'.$image.'" alt="THIS IS LOADS PHOTO"  style="border: 4px #99ff99 solid; width:140px; height:140px;" >
              </div>'; 
          echo "</div>";
           echo "</div>";
           
           
           
           
  
     echo     '<div class="table-responsive" style="margin-top: 20px;">'; 
                 echo '<CAPTION><h3 align="center" style="font-size:20px; color: black;"> '.$name.' '.$months.' - '.$years1.'[CONTRIBUTION/WITHDRAWALS]. </h3></CAPTION>';
    echo '<table class="table table-bordered table-striped   table-hover " >';
    
       echo ' <thead class="thead-dark">'; 
        
         echo '<tr align = "center">';
         echo '<th>S/N</th>';
         echo '<th>Date</th>';         
         echo '<th>Credit</th>';
         echo '<th>Debit</th>';
         echo '<th>Current Balance</th>';
         
          echo '</tr>';   
               echo '</thead>';

    echo '<tbody class="" style="font-family: sans-serif; color:black ; font-weight:bold;">';
           $sql_state1 = "SELECT SUM(amount) as totalx FROM contribution WHERE name = '$name' AND month = '$months' AND year = '$years1'";
            $result1 = mysqli_query($connect, $sql_state1);  
         while ($row= mysqli_fetch_assoc($result1)){  
             $sum_contribute = $row['totalx'];
         }
         
         
          $sql_state2 = "SELECT SUM(withdraw) as totaly FROM contribution WHERE name = '$name' AND month = '$months' AND year = '$years1'";
            $result2 = mysqli_query($connect, $sql_state2);  
         while ($row= mysqli_fetch_assoc($result2)){  
             $sum_withdraw = $row['totaly'];
         }
         
       $current_amount = $sum_contribute - $sum_withdraw;
         
           echo "<tr align = 'center'>";
        echo '<td></td>';
        echo '<td></td>';
            echo "<td style='color: green;  font-size: 22px;'>" . number_format($sum_contribute)."</td>"; 
            echo "<td style='color: red; font-size: 22px;'>" . number_format($sum_withdraw)."</td>";
            echo "<td style='color: black; font-size: 22px;'>" .  number_format($current_amount)."</td>";  
            echo "</tr>";
           
     while ($row=mysqli_fetch_array($result)){

       
         
            echo "<tr align = 'center'>";
            echo "<td>" . $inc."</td>";
            echo "<td>" . $row['date']."</td>";
            echo "<td style='color: green; '>" . $row['amount']."</td>"; 
            echo "<td style='color: red;'>" . $row['withdraw']."</td>";
                 echo '<td></td>';
            echo "</tr>";
            $inc++;
            }
          
            
            
       
   
            
            echo ' </tbody>';
          echo ' </table>';
     
           echo '</div>' ;
            echo '</div>' ; 
          
   //=========+++++++++++++++++++++++++++END MONTH DISPLAY
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
               } 
               
               else 
                   
                   //=========+++++++++++++++++++++++++++YEAR DISPLAY
           if (isset($_POST['year_a2'])) {
                
             
              $years1 = $_POST['year_alone2'];  
            $name = $_SESSION['store_name'];
            $sql_state = "SELECT * FROM contribution WHERE name = '$name'  AND year = '$years1' ORDER BY id DESC";
            $result = mysqli_query($connect, $sql_state);   
              
              
        echo '<div class="col-sm-3">';
//       echo "<a class='btn' style='color: whitesmoke; background-color: green; margin-right: 10px;' href='contribution?name=" . $name. "'>Contribute</a>";
//        echo "<a class='btn' style='color: whitesmoke; background-color: red;' href='contribution_withdrawal?name=" . $name. "'>Withdraw</a>";
//       echo "<br><a href='contribution' style='color:blue;'>Click Here for Blank Payment Panel</a>"; 
         echo "</div>";
        
        echo '<div class="col-sm-4">';
          echo '<div  style="margin-left: 40px; width:140px; height:140px;">
            <img id="img" src="'.$image.'" alt="THIS IS LOADS PHOTO"  style="border: 4px #99ff99 solid; width:140px; height:140px;" >
              </div>'; 
          echo "</div>";
           echo "</div>";
           
           
           
           
  
     echo     '<div class="table-responsive" style="margin-top: 20px;">'; 
                 echo '<CAPTION><h3 align="center" style="font-size:20px; color: black;"> '.$name.' '.$years1.'[CONTRIBUTION/WITHDRAWALS]. </h3></CAPTION>';
    echo '<table class="table table-bordered table-striped   table-hover " >';
    
       echo ' <thead class="thead-dark">'; 
        
         echo '<tr align = "center">';
         echo '<th>S/N</th>';
         echo '<th>Date</th>';         
         echo '<th>Credit</th>';
         echo '<th>Debit</th>';
         echo '<th>Current Balance</th>';
         
          echo '</tr>';   
               echo '</thead>';

    echo '<tbody class="" style="font-family: sans-serif; color:black ; font-weight:bold;">';
           $sql_state1 = "SELECT SUM(amount) as totalx FROM contribution WHERE name = '$name'  AND year = '$years1'";
            $result1 = mysqli_query($connect, $sql_state1);  
         while ($row= mysqli_fetch_assoc($result1)){  
             $sum_contribute = $row['totalx'];
         }
         
         
          $sql_state2 = "SELECT SUM(withdraw) as totaly FROM contribution WHERE name = '$name'  AND year = '$years1'";
            $result2 = mysqli_query($connect, $sql_state2);  
         while ($row= mysqli_fetch_assoc($result2)){  
             $sum_withdraw = $row['totaly'];
         }
         
       $current_amount = $sum_contribute - $sum_withdraw;
         
           echo "<tr align = 'center'>";
        echo '<td></td>';
        echo '<td></td>';
            echo "<td style='color: green;  font-size: 22px;'>" . number_format($sum_contribute)."</td>"; 
            echo "<td style='color: red; font-size: 22px;'>" . number_format($sum_withdraw)."</td>";
            echo "<td style='color: black; font-size: 22px;'>" .  number_format($current_amount)."</td>";  
            echo "</tr>";
           
     while ($row=mysqli_fetch_array($result)){

       
         
            echo "<tr align = 'center'>";
            echo "<td>" . $inc."</td>";
            echo "<td>" . $row['date']."</td>";
            echo "<td style='color: green; '>" . $row['amount']."</td>"; 
            echo "<td style='color: red;'>" . $row['withdraw']."</td>";
                 echo '<td></td>';
            echo "</tr>";
            $inc++;
            }
          
            
            
       
   
            
            echo ' </tbody>';
          echo ' </table>';
     
           echo '</div>' ;
            echo '</div>' ; 
          
   //=========+++++++++++++++++++++++++++END YEAR DISPLAY  
               }
               
               
               
               
               
               
               
               
               
               
               
               
               
               
               
               
               
               
               
               else {
                   
                   
                   
                   
                   
                   
       
        //=========+++++++++++++++++++++++++++GENERAL DISPLAY
        echo '<div class="col-sm-3">';
//       echo "<a class='btn' style='color: whitesmoke; background-color: green; margin-right: 10px;' href='contribution?name=" . $name. "'>Contribute</a>";
//        echo "<a class='btn' style='color: whitesmoke; background-color: red;' href='contribution_withdrawal?name=" . $name. "'>Withdraw</a>";
//        echo "<br><a href='contribution' style='color:blue;'>Click Here for Blank Payment Panel</a>"; 
         echo "</div>";
        
        echo '<div class="col-sm-4">';
          echo '<div  style="margin-left: 40px; width:140px; height:140px;">
            <img id="img" src="'.$image.'" alt="THIS IS LOADS PHOTO"  style="border: 4px #99ff99 solid; width:140px; height:140px;" >
              </div>'; 
          echo "</div>";
           echo "</div>";
           
           
           
           
  
     echo     '<div class="table-responsive" style="margin-top: 20px;">'; 
                 echo '<CAPTION><h3 align="center" style="font-size:20px; color: black;"> '.$name.' [CONTRIBUTION/WITHDRAWALS]</h3></CAPTION>';
    echo '<table class="table table-bordered table-striped   table-hover " >';
    
       echo ' <thead class="thead-dark">'; 
        
         echo '<tr align = "center">';
         echo '<th>S/N</th>';
         echo '<th>Date</th>';         
         echo '<th>Credit</th>';
         echo '<th>Debit</th>';
         echo '<th>Current Balance</th>';
         
          echo '</tr>';   
               echo '</thead>';

    echo '<tbody class="" style="font-family: sans-serif; color:black ; font-weight:bold;">';
           $sql_state1 = "SELECT * FROM members WHERE namee = '$name'";
            $result1 = mysqli_query($connect, $sql_state1);  
         while ($row= mysqli_fetch_assoc($result1)){  
           echo "<tr align = 'center'>";
        echo '<td></td>';
        echo '<td></td>';
            echo "<td style='color: green;  font-size: 22px;'>" . number_format($row['savings'])."</td>"; 
            echo "<td style='color: red; font-size: 22px;'>" . $row['loan']."</td>";
            echo "<td style='color: black; font-size: 22px;'>" .  number_format($row['save_balance'])."</td>";  
            echo "</tr>";
           }
     while ($row=mysqli_fetch_array($result)){

       
         
            echo "<tr align = 'center'>";
            echo "<td>" . $inc."</td>";
            echo "<td>" . $row['date']."</td>";
            echo "<td style='color: green; '>" . $row['amount']."</td>"; 
            echo "<td style='color: red;'>" . $row['withdraw']."</td>";
                 echo '<td></td>';
            echo "</tr>";
            $inc++;
            }
          
            
            
       
   
            
            echo ' </tbody>';
          echo ' </table>';
     
           echo '</div>' ;
            echo '</div>' ; 
          
   //=========+++++++++++++++++++++++++++END GENERAL DISPLAY
  
      }
                             
                                     
            
          
            
            ?>
  
  
  
   <script>
   
    //Function 4     FUNCTION IN A FUNCTION (ADD NEW OVERHEAD TO DATABASE) 
        
    
    
            
   </script>
   
   
   
     <script>
         $(document).ready(function() {          
              var pena_java = $(".pena_java"); //LINK TO GO AND VIEW ALL DEBTORS   
    $(pena_java).click(function(e){
            e.preventDefault(); 
                 
              
                     var perc_java = document.getElementById("perc_java").value;
                     var name = document.getElementById("name").value;
                     var codename = document.getElementById("codename").value;
                     var type = document.getElementById("type").value;
                     var district = document.getElementById("district").value;
                     var av_bal = document.getElementById("av_bal").value;
                     
             
             
              if (window.XMLHttpRequest)
                  {// code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp=new XMLHttpRequest();
                  }
                else
                  {// code for IE6, IE5
                  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                  }     
                    
            
                           if(perc_java !== "" ){
                   xmlhttp.open("GET","penalty_calculate.php?perc_java="+perc_java+"&name="+name+"&codename="+codename+"&type="+type+"&district="+district+"&av_bal="+av_bal,true);
                                 xmlhttp.send();                
                                 xmlhttp.onreadystatechange = function(){                                   
                      if(xmlhttp.readyState ===4 && xmlhttp.status===200) {
                
                 alert(xmlhttp.responseText);
                      location.reload();
                                }
                        };
                        
                            } else { 
                                alert("Please fill percentage penalty");
                        }
       }); 
    });
 
       </script>
  
  
   <script>
             function goBack() {
                 window.location = "savings";
             }
          </script>  
                                    <!-- Page-body end -->
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

    
   
    
    
 
    
    <script>
        
        
        window.onload = function(){
           document.getElementById('magic-collapse').click();
           
        };
             </script>
    
    
   
    
    
</body>

</html>
