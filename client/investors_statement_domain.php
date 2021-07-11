<?php
session_start();
    include 'connection.php';
    ?>
<!DOCTYPE html>


<html>
    <head>
        <title>Client Statement</title> <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta charset="utf-8">
         <!-- Script -->
        <script src='jquery-3.1.1.min.js' type='text/javascript'></script>

        <!-- jQuery UI -->
        <link href='jquery-ui.min.css' rel='stylesheet' type='text/css'>
        <script src='jquery-ui.min.js' type='text/javascript'></script>
        <meta charset="utf-8">
        
        
           <!--Boostrap & family-->
  <!--<link rel="stylesheet" href="maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
 <link rel="stylesheet" href="maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 
  <!--<script src="ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
  <script src="cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
        
        
         <!--<link rel="stylesheet" type="text/css" href="majorstyle.css"/>-->
        <style type="text/css">
                    body{
                         background-image: none;
                        background-color: white;  
                        
                         }
        </style>
        
        
    </head>
    <body style="background-color: #e0d3d3;">
    <center class="heading" ><div class="trans fixed-top" style="background-color:#ff5d0f; font-size: 22px; color: black;"><b>NAF</b></div></center>
    <br> <br>
     <hr style="color: red; height: 3px; margin-top: 0.5px"/> 
<!--  <button id="back" onclick="goBack()" style="padding: 4px; margin-bottom:  5px;  border-radius: 8px; font-size: 16px; background-color: black; color: whitesmoke; border: 2px solid white; cursor: pointer;"><<|Back|</button>
 -->
    <br>
            <?php
            
            //loop through all table rows
           
           $name = $codename = $type = ""; 
         
        @$name = $_GET['name'];
       @$codename = $_GET['codename'];
       @$type = "";
       
       if(isset($_SESSION['redirect_message_investor'])){
         echo $_SESSION['redirect_message_investor']; 
             $_SESSION['redirect_message_investor'] = "";
     }
       echo '';
          $_SESSION['pen_name'] = $name;
      $_SESSION['pen_codename'] = $codename;
      $_SESSION['pen_type'] = $type;
             $inc=1;
             
             ////SELECT NAME FROM DATABASE TO LOAD PASSPORT TEL & ADDRESS
   $debtor_info = mysqli_query($connect, "SELECT * FROM members WHERE namee = '$name'");        
        while($row_info = mysqli_fetch_assoc($debtor_info)){
             $address = $row_info['addresss'];
             $tel = $row_info['telephone'];
            $image = $row_info['imagess'];
              $regnum = $row_info['registration_num'];
        }     
   
      
        echo '<div class="row">';
        
         echo '<div class="col-sm-3" style="margin-left: 150px;">';
         echo "<p style='font-size:18px; color:black; margin-bottom:30px; margin-left: 35px;'>";
         echo "<label>Name: ". $name ."</label><br>";
          echo "<label>Tel: ". $tel ."</label><br>";
          echo "<label>Address: ". $address ."</label><br>";
         
         
      
        echo "<p>";
          /////CREATE HIDDEN INPUT TEXTBOX TO CARRY VALUES TO JAVASCRIPT 

//        PLEASE NOTE THAT YOU HAVE TO USE SOME "\" TO AVOID BRAKE SPACE IN NAMES
       echo "<input type='hidden' value=\"".$name. "\" id = 'name'/>"; 
       echo '<input type="hidden" value=\''. $codename .'\' id = "codename"/>';
       echo '<input type="hidden" value=\''. $type .'\' id="type"/>';
       
           echo "</div>";
         
           
                    $lastpaid = "";
            $sql_state2 = "SELECT * FROM investment WHERE codename = '$codename' AND (remarks = 'Monthly Interest' OR remarks = 'Investment deposited')";
            $result22 = mysqli_query($connect, $sql_state2);
               while ($row=mysqli_fetch_array($result22)){
                 
                    $lastpaid = $row['lastpaid'];
               }
               
               
               
                 $sql_interestrate = "SELECT * FROM investment WHERE codename = '$codename' AND interestrate > 1";
            $result_interestrate = mysqli_query($connect, $sql_interestrate);
               while ($row=mysqli_fetch_array($result_interestrate)){
                      $interestrate = $row['interestrate'];
              
                  }  
               
               
//                 $lastpaid2 = "";
//            $sql_state22 = "SELECT * FROM investment WHERE codename = '$codename' AND (remarks = 'Monthly Interest' OR remarks = 'Investment deposited (A)')";
//            $result222 = mysqli_query($connect, $sql_state22);
//               while ($row=mysqli_fetch_array($result222)){
//                 
//                    $lastpaid2 = $row['lastpaid'];
//               }
//               
//             $sql_interestrate2 = "SELECT * FROM investment WHERE codename = '$codename' AND interestrate > 1";
//            $result_interestrate2 = mysqli_query($connect, $sql_interestrate2);
//               while ($row=mysqli_fetch_array($result_interestrate2)){
//                      $interestrate2 = $row['interestrate'];
//              
//                  }  
               
              
           //////////////////////////////////----------------------------------////////////////////         
             //  **********************FPRO *********************************************************************************                
         
              
                ///////THIS IS TO GET THE INDIVIDUAL SAVINGS BALANCE
                ///////////////THIS IS TO SUM ALL SAVINGS
            $sum_savings = mysqli_query($connect, "SELECT SUM(pay) as total FROM investment WHERE codename = '$codename' ");      
              while  ($row = mysqli_fetch_assoc($sum_savings)){
         $summation_savings = $row['total']; 
//               $plus_interest = $row['interest'];  
              }
                 
                            
                ////////////THIS IS TO SUM ALLWITHDRAWALS
        $sum_withdraw = mysqli_query($connect, "SELECT SUM(withdraw) as total FROM investment WHERE codename = '$codename'");      
         while  ($row1 = mysqli_fetch_assoc($sum_withdraw)){
         $summation_withdraw = $row1['total'];                          
         }
              
              $savings_balance =  $summation_savings - $summation_withdraw;
              
              
        //  *******************************************************************************************************                
       
                       //            LETS GET THE INTEREST ON AVAILABLE BALANCE   
             $investment_interest_amt = ($interestrate / 100) * $savings_balance;
           
               
               
//          LETS GET THE LAST INTEREST PAYMENT TO AUTOMATE     
             $dated_lastpaid = strtotime("$lastpaid");
            $gap = time() - $dated_lastpaid;
              $days_gap = floor($gap / 86400);  
              
//              if($days_gap > 29){
//                 $today1 = time();
//         
//          $today2 = date("Y-m-d", $today1);    
//                  $today = date("Y-m-d", strtotime($today2));
//                  $jSdate = date("jS F Y");
//                  $month = date("F");
//                  $year = date("Y");
//       $sql_set_invest ="INSERT INTO investment (name, codename, remarks, monthinterset, lastpaid, date, month, year, district) VALUES('$name', '$codename', 'Monthly Interest', '$investment_interest_amt', '$today2', '$jSdate', '$month', '$year', '$regnum')";           
//                mysqli_query($connect, $sql_set_invest);
//              
////    -------------------------------DO SOME UPDATE HERE--------------------------------------- 
//           /////////SUM INDIVIDUAL REPAY & DISBURSE BALALNCE
//            ////////////THIS IS TO SUM PAYMENTS
//                $total_payments11 = mysqli_query($connect, "SELECT SUM(pay) as total FROM investment WHERE codename = '$codename'");      
//              while  ($row1 = mysqli_fetch_array($total_payments11)){
//              $summation_pay_ind = $row1['total'];                          
//                   }
//                   
//                   
//             ////////////THIS IS TO SUM DISBURSE
//                $total_disburse22 = mysqli_query($connect, "SELECT SUM(withdraw) as total FROM investment WHERE codename = '$codename'");      
//              while  ($row2 = mysqli_fetch_array($total_disburse22)){
//                        $summation_disburse_ind = $row2['total'];                          
//                   }
//                   $ind_balance = $summation_pay_ind - $summation_disburse_ind;  
//                             
//       
//                   
////               LETS GET THE INTEREST BALANCE   
//                     ////////////THIS IS monthinterset
//                $total_monthinterset = mysqli_query($connect, "SELECT SUM(monthinterset) as total FROM investment WHERE codename = '$codename' AND name = '$name'");      
//              while  ($row1 = mysqli_fetch_array($total_monthinterset)){
//              $summation_monthinterset = $row1['total'];                          
//                   }
//                   
//                   
//             ////////////THIS IS TO interestpaid
//                $total_interestpaid = mysqli_query($connect, "SELECT SUM(interestpaid) as total FROM investment WHERE codename = '$codename' AND name = '$name'");      
//              while  ($row2 = mysqli_fetch_array($total_interestpaid)){
//                        $summation_interestpaid = $row2['total'];                          
//                   }
//                   $interest_balance = $summation_monthinterset - $summation_interestpaid;  
//                             
//                   
//                   
//                   
//                   
//                   
//                   
//                     
//                     //GET LAST ID  
//               $get_last_id = mysqli_query($connect, "SELECT * FROM investment");      
//                          while  ($row = mysqli_fetch_assoc($get_last_id)){
//                          $id = $row['id'];                           
//                          }
//                          
//                          
// 
//                           
//                     
//                     
//                     /////////SUM GENERAL REPAY & DISBURSE SO YOU CAN GET GEN BALALNCE
//            ////////////THIS IS TO SUM PAYMENTS
//                $total_payments = mysqli_query($connect, "SELECT SUM(pay) as total FROM investment");      
//              while  ($row1 = mysqli_fetch_array($total_payments)){
//              $summation_pay = $row1['total'];                          
//                   }
//                   
//                   
//             ////////////THIS IS TO SUM DISBURSE
//                $total_disburse2 = mysqli_query($connect, "SELECT SUM(withdraw) as total FROM investment");      
//              while  ($row2 = mysqli_fetch_array($total_disburse2)){
//                        $summation_disburse = $row2['total'];                          
//                   }
//                   $gen_balance = $summation_pay - $summation_disburse;  
//                     
//       $update_special = mysqli_query($connect, "UPDATE investment SET updatebal = '$ind_balance', updatedate = '$today2' WHERE codename = '$codename' AND remarks = 'Investment deposited' AND pay > 1");
//                         
//           $result2 = mysqli_query($connect, "UPDATE investment SET genbalinvest = '$gen_balance',  indbalinvest = '$ind_balance', cumminterest = '$interest_balance' WHERE id = '$id'");
//               
//           
//              if($result2==true){                             
////                     $output_new_closedate = date('d-M-Y', strtotime($new_closedate));         
//      echo "<script>alert('Notification: $name monthly interest of ".number_format($investment_interest_amt)." Naira is set.')</script>";
//              }
//           
//           }
//    --------------------------------------------------------------------------------------------       
           
//            $_SESSION['av_bal']= $available_blance;FOR AJAX
            echo '<input type="hidden" value='. $savings_balance .' id="av_bal"/>'; 
        echo '<div class="col-sm-2">';
        echo "<label style='font-size: 18px; font-weight: bold;'>Investment Balance:<br> N ".number_format($savings_balance)." @$interestrate% monthly</label>";
         echo "<label style='font-size: 18px; font-weight: bold;'>Interest on Investment:<br> N ".number_format($investment_interest_amt)." per month</label>";
       
        echo "</div>";
       
        
        echo '<div class="col-sm-2" style="margin-top: 40px;">';
//         echo "<a class='btn' style='color: whitesmoke; background-color: green;' href='investors_int_pay?codename=" . $codename. " &name=" . $name. "'>Pay Interest</a>";
       
         echo "</div>";
        
        echo '<div class="col-sm-3">';
          echo '<div  style="margin-left: 40px; width:140px; height:140px;">
            <img id="img" src="../'.$image.'" alt="THIS IS LOADS PHOTO"  style="border: 4px #99ff99 solid; width:140px; height:140px;" >
              </div>'; 
          echo "</div>";
           echo "</div>";
        
        
        $sql_state = "SELECT * FROM investment WHERE codename = '$codename'";
            $result = mysqli_query($connect, $sql_state);
           
            
            echo '<div class="container">';
     echo  '<div class="table-responsive-sm">' ;
                 echo '<CAPTION><h3 align="center" style="font-size:20px; color: black;"> '.$name.' codename('.$codename.') INVESTMENT.</h3></CAPTION>';
    echo '<table class="table table-bordered table-striped table-sm table-hover " style="font-size:16px;" align="center">';
    
     echo '<thead class="thead-dark">';
         echo '<tr align = "center">';
         echo '<th>S/N</th>';
         echo '<th>Date</th>'; 
          echo '<th>Description</th>'; 
         echo '<th>Investment</th>';
          echo '<th>Withdrawal</th>';
            echo '<th>Investment Balance</th>';  
           echo '<th>Interest on Investment (Auto)</th>'; 
            echo '<th>Interest Paid</th>'; 
           echo '<th>Interest Balance</th>'; 
      
          echo '</tr>';   
            echo '</thead>';

    echo '<tbody class="text-nowrap" style="font-family: sans-serif; color:black ; font-weight:bold;">';
     while ($row=mysqli_fetch_array($result)){
          
            echo "<tr align = 'center'>";
            echo "<td>" .$inc."</td>";
            echo "<td>" .$row['date']."</td>";
             echo "<td>" .$row['remarks']."</td>";
          echo "<td style='color: green;' >" . number_format($row['pay'])."</td>"; 
            echo "<td style='color: red;' >" . number_format($row['withdraw'])."</td>"; 
               
             echo "<td >" . number_format($row['indbalinvest'])."</td>"; 
              echo "<td >" . number_format($row['monthinterset'])."</td>"; 
              echo "<td >" . number_format($row['interestpaid'])."</td>"; 
            echo "<td >" . number_format($row['cumminterest'])."</td>";   
            echo "</tr>";
            $inc++;
         }
            
            
          echo ' </tbody>';
            echo ' </table>';
            echo '</div>';
            echo '</div>';
  
            
            if(isset($_POST['pen'])){
             
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
                   xmlhttp.open("GET","penalty_calculate?perc_java="+perc_java+"&name="+name+"&codename="+codename+"&type="+type+"&district="+district+"&av_bal="+av_bal,true);
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
                 window.location = "investors";
             }
          </script>
    </body>
</html>
