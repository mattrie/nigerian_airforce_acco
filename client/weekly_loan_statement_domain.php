<?php
session_start();
    include 'connection.php';
    ?>
<!DOCTYPE html>


<html>
    <head>
        <title>Client Weekly_Statement</title> <meta content="width=device-width, initial-scale=1.0" name="viewport">
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
    
     <hr style="color: red; height: 3px; margin-top: 40px;"/> 
  <!--<button id="back" onclick="goBack()" style="padding: 4px; margin-bottom:  5px;  border-radius: 8px; font-size: 16px; background-color: black; color: whitesmoke; border: 2px solid white; cursor: pointer;"><<|Back|</button>-->
 
 
 
            <?php
            
            //loop through all table rows
           
           $name = $codename = $type = ""; 
         
        @$name = $_GET['name'];
       @$codename = $_GET['codename'];
       @$type = $_GET['type'];
       
//        if(isset($_SESSION['redirect_message_weekly'])){
//         echo $_SESSION['redirect_message_weekly']; 
//             $_SESSION['redirect_message_weekly'] = "";
//     }
//     
//       echo '';
//          $_SESSION['pen_name'] = $name;
//      $_SESSION['pen_codename'] = $codename;
//      $_SESSION['pen_type'] = $type;
             $inc=1;
             
             ////SELECT NAME FROM DATABASE TO LOAD PASSPORT TEL & ADDRESS
   $debtor_info = mysqli_query($connect, "SELECT * FROM members WHERE namee = '$name'");        
        while($row_info = mysqli_fetch_assoc($debtor_info)){
             $address = $row_info['addresss'];
             $tel = $row_info['telephone'];
              $image = $row_info['imagess'];
        }     
   
        ////////get details from loan database (type and end date)
    //     ------------------------------------------------------------------------  
            $closingdate = "";
          $sql_state1 = "SELECT * FROM weekly_allloan WHERE codename = '$codename' AND disburseloan > 1 AND remarks = 'loan disbursement'";
            $result1 = mysqli_query($connect, $sql_state1);
      
            while ($row = mysqli_fetch_assoc($result1)) {   
              $closingdate = $row["enddate"];
              $loan_type = $row["type"];
             $disburseloan = $row["disburseloan"];
             $percentage = $row["percentage"];  
            }
        
                     
            $output_closedate = date('d-M-Y', strtotime($closingdate));  
            
              ///////////////////////////////////////
                 //GET NUMBER OF MONTHS & DAYS LEFT
                    $dated = strtotime("$closingdate");
                    
            $remaining = $dated - time();
            
//           $remain_days = date('d',$remaining) ;
//                 $getmonth = date('m',$remaining);
//                $remain_months = $getmonth - 1;
                 
                
                ///////COUNT ONLY DAYS
        $days_remaining = floor($remaining / 86400);   
        $weeks_remaining = floor($days_remaining / 7)." weeks left";
        
        
        
        



         
              echo "";
//     ------------------------------------------------------------------------   
        echo '<div class="row">';
        
         echo '<div class="col-sm-3" style="margin-left: 150px;">';
         echo "<p style='font-size:18px; color:black; margin-bottom:30px; margin-left: 35px;'>";
         echo "<label>Name: ". $name ."</label><br>";
          echo "<label>Tel: ". $tel ."</label><br>";
          echo "<label>Address: ". $address ."</label><br>";
          echo "<label>Expiry Date: ". $output_closedate ."</label><br>";
          echo "<label>RM: ". $weeks_remaining ."</label><br>";
         
      
        echo "<p>";
          /////CREATE HIDDEN INPUT TEXTBOX TO CARRY VALUES TO JAVASCRIPT 

//        PLEASE NOTE THAT YOU HAVE TO USE SOME "\" TO AVOID BRAKE SPACE IN NAMES
       echo "<input type='hidden' value=\"".$name. "\" id = 'name'/>"; 
       echo '<input type="hidden" value=\''. $codename .'\' id = "codename"/>';
       echo '<input type="hidden" value=\''. $type .'\' id="type"/>';
       
           echo "</div>";
         
           
           ////////GET THE LAST BALANCE
         $sql_state2 = "SELECT * FROM weekly_allloan WHERE name = '$name' AND codename = '$codename'";
            $result2 = mysqli_query($connect, $sql_state2);
      
            while ($row = mysqli_fetch_assoc($result2)) {   
              $available_blance = $row["indbalance"];
              $loan_type = $row["type"];
            }
            
   
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
   ///////////////////////////////////////////MONTH 1 PENALTY START/////////////////////////////////         
//            
//            
/////////////////////////////////////----------------------------------////////////////////         
//                
////            LETS DO AUTOMATIC REWARD PENALTY FOR MONTH 1
//     if($days_remaining11 > 27 && $days_remaining11 < 56 && $repay_sum_month1 < $amt_checker && $month_checker === "first_month"){
//                   
//                  
//                  
//                  
////  *******************************************************************************************************                
//    /////THIS IS TO SUM PAYMENTS TO ADD IT TO REPAY SO WE  KNOW IF PENALTY CAN BE AWARDED
//     $total_payments24 = mysqli_query($connect, "SELECT SUM(repay) as total FROM weekly_allloan WHERE codename='$codename'");      
//           while  ($row1 = mysqli_fetch_array($total_payments24)){
//                  $summation_pay2 = $row1['total'];                          
//                  } 
//                  
//                  
//    /////THIS IS TO SUM PAYMENTS TO ADD IT TO SAVINGS SO WE  KNOW IF PENALTY CAN BE AWARDED
//     $total_payments26 = mysqli_query($connect, "SELECT SUM(savings) as total FROM weekly_allloan WHERE codename='$codename'");      
//           while  ($row1 = mysqli_fetch_array($total_payments26)){
//                  $summation_savings2 = $row1['total'];                          
//                  }   
//        $lets_know_if_loan_Iscomplete = $summation_pay2 + $summation_savings2;
//        
//        
//        /////LETS GET THE AMOUNT COLLECTED
//              $amount_disbursed = "";
//        $total_disburse28 = mysqli_query($connect, "SELECT * FROM weekly_allloan WHERE codename='$codename' AND disburseloan > 1 AND remarks = 'loan disbursement'");      
//           while  ($row1 = mysqli_fetch_array($total_disburse28)){
//                  $amount_disbursed = $row1['disburseloan'];                          
//                  } 
//                
//        
////  *******************************************************************************************************               
//            
//                  
//                  
//                 
//                  
//                  
//                  if($lets_know_if_loan_Iscomplete < $amount_disbursed){
//                  
//              $date = date("jS F Y");
//            $month = date("F");
//            $year = date("Y");
//
//              $decimal_pen =  10 / 100 ;
//             $penalty = $decimal_pen * ($amt_checker - $repay_sum_month1);
//             
////             ---------------------------------------
////        //          SET NEW DATE FOR ANOTHER PENALTY 
//               
//                    $today1 = time();
//          $today = date("Y-m-d", $today1);
//                  
//          $new_closedate  = date('Y-m-d', strtotime($today. ' + 28 days'));
//
//                 $today_date  = date('Y-m-d', time());
////       -----------------------------------------------------------   
//   
////           UPDATE THE MONTH CHECKER SO REPAYMENT CAN GET CURRENT MONTH
//       $sql_state12 = "UPDATE weekly_allloan SET month_checker = 'second_month' WHERE name = '$name' AND disburseloan > 1 AND remarks = 'loan disbursement' AND codename = '$codename'";
//            $result12 = mysqli_query($connect, $sql_state12);
//          
//         
////          INSERT NEW PENALTY INTO DATEBASE
//           $sql_statement = "INSERT INTO weekly_allloan (name, type, remarks, disburseloan, codename, date, month, year, lastpaiddate) VALUES ('$name', 'Weekly Payment', 'Penalty', '$penalty', '$codename', '$date', '$month', '$year', '$closingdate')";
//     $result = mysqli_query($connect, $sql_statement); 
//                     
//                     
//            ////GET THE REMAINING LATEST BALANCE OF LOAN FOR AN INDIVIDUAL
//                       $summation_loan2 = "";
//                       $summation_pay2 = "";
//                       
//             ///////THIS IS TO GET THE INDIVIDUAL BALANCE
//                        ////////////THIS IS TO SUM LOAN
//        $code_loan = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM weekly_allloan WHERE codename = '$codename' ");      
//          while  ($row = mysqli_fetch_assoc($code_loan)){
//          $summation_loan2 = $row['total']; 
//          }
//              
//        ////////////THIS IS TO SUM PAYMENTS
//        $total_payments2 = mysqli_query($connect, "SELECT SUM(repay) as total FROM weekly_allloan WHERE codename='$codename'");      
//      while  ($row1 = mysqli_fetch_array($total_payments2)){
//      $summation_pay2 = $row1['total'];                          
//      }
//                    
//                /////LETS GET THE BALANCE
//              $available_blance = $summation_loan2 - $summation_pay2;
//              
//       
//          ////////GET ALL REVERSAL PAYMENT TO MINUS FROM
//               $total_payments33 = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM weekly_allloan WHERE codename='$codename' AND remarks = 'Reversal Entry'");      
//              while  ($row1 = mysqli_fetch_array($total_payments33)){
//              $summation_reverse2 = $row1['total'];                          
//              }
//         $original_summation = $summation_pay2 - $summation_reverse2;   
//     //        -----------------------------------------------------------------------             
//          
//         /////////SUM GENERAL REPAY & DISBURSE LOAN SO YOU CAN GET GEN BALALNCE
//            ////////////THIS IS TO SUM PAYMENTS
//                $total_payments = mysqli_query($connect, "SELECT SUM(repay) as total FROM weekly_allloan");      
//              while  ($row1 = mysqli_fetch_array($total_payments)){
//              $summation_pay = $row1['total'];                          
//                   }
//                   
//                   
//             ////////////THIS IS TO SUM DISBURSE
//                $total_disburse2 = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM weekly_allloan");      
//              while  ($row2 = mysqli_fetch_array($total_disburse2)){
//                        $summation_disburse = $row2['total'];                          
//                   }
//                   $gen_balance =  $summation_disburse - $summation_pay;  
////        -----------------------------------------------------------------------             
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//            //       *********************************||||||||||||||||****************************************************            
//                      $summation5 =  $summation6 = "";
//                   ///////////THIS IS TO SUM TOTAL monthly_disburseloan///////////////////
//                        $total_monthly_disburseloan = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM monthly_allloan WHERE name='$name'");      
//                          while  ($row = mysqli_fetch_array($total_monthly_disburseloan)){
//                          $summation5 = $row['total'];                          
//                          }
//                            
//      ////////////THIS IS TO TOTAL monthly_payment
//                            $total_monthly_payment = mysqli_query($connect, "SELECT SUM(repay) as total FROM monthly_allloan WHERE name='$name'");      
//                          while  ($row1 = mysqli_fetch_array($total_monthly_payment)){
//                          $summation6 = $row1['total'];                          
//                          }
//                          //////////////////////////////////////////
//                       @$monthly_status =  $summation5 - $summation6;
//
//                 
//                         
//      //       *********************************||||||||||||||||****************************************************            
//                      $summation1 =  $summation2 =  $summation3 =  $summation4 = "";
//                   ///////////THIS IS TO SUM TOTAL daily_disburseloan///////////////////
//                        $total_daily_disburseloan = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM allloan WHERE name='$name'");      
//                          while  ($row = mysqli_fetch_array($total_daily_disburseloan)){
//                          $summation1 = $row['total'];                          
//                          }
//                            
//      ////////////THIS IS TO TOTAL daily_payment
//                            $total_daily_payment = mysqli_query($connect, "SELECT SUM(repay) as total FROM allloan WHERE name='$name'");      
//                          while  ($row1 = mysqli_fetch_array($total_daily_payment)){
//                          $summation2 = $row1['total'];                          
//                          }
//                          //////////////////////////////////////////
//                       @$daily_status =  $summation1 - $summation2;
//
///////======================================================================
//
//
//  ///////THIS IS TO SUM TOTAL weekly_disburseloan///////////////////
//                        $total_weekly_disburseloan = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM weekly_allloan WHERE name='$name'");      
//                          while  ($row = mysqli_fetch_array($total_weekly_disburseloan)){
//                          $summation3 = $row['total'];                          
//                          }
//                            
//      ////////////THIS IS TO TOTAL weekly_payment
//                      $total_weekly_payment = mysqli_query($connect, "SELECT SUM(repay) as total FROM weekly_allloan WHERE name='$name'");      
//                          while  ($row1 = mysqli_fetch_array($total_weekly_payment)){
//                          $summation4 = $row1['total'];                          
//                          }
//                          //////////////////////////////////////////
//                       @$weekly_status =  $summation3 - $summation4;
//
//                    @$total_status =  $daily_status + $weekly_status + $monthly_status;
//      //UPDATE RECORD
//      $sql_statement101 = "UPDATE members SET balance = '$total_status' WHERE namee='$name'";
//                     $result29 = mysqli_query($connect, $sql_statement101); 
// //       **************************||||||||||||||||***********************************************            
//              
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                   
//                   
//              
//                //GET LAST ID  
//               $get_last_id = mysqli_query($connect, "SELECT * FROM weekly_allloan");      
//                          while  ($row = mysqli_fetch_assoc($get_last_id)){
//                          $id = $row['id'];                           
//                          }
//                     
//               ////UPDATE TO GET A NEW INDIVIDUAL BALANCE
//                  $result2 = mysqli_query($connect, "UPDATE weekly_allloan SET genbalance = '$gen_balance',  repaycumm = '$original_summation', indbalance = '$available_blance' WHERE id = '$id'");
//                   //           UPDATE weeklyenddate FOR MEMEBERS DB TO AUTO-DETECT PENALTY
//        $result222 = mysqli_query($connect, "UPDATE members SET weeklyindbal = '$available_blance', weeklyenddate = '$today', weeklycode = '$codename' WHERE namee = '$name'");
//                  
//                          if($result2==true){                             
////                     $output_new_closedate = date('d-M-Y', strtotime($new_closedate));         
//            echo "<script>alert('Notification: $name has been given a penalty fee of ".number_format($penalty)." Naira. Total balance now is: ".number_format($available_blance)." Naira Only. $name loan repayment is overdue for the previous month.')</script>";
//               $id = "";
//             } else {
//    echo "<script>alert('Error')</script>";
//                        }
//           }
//      
//           if($lets_know_if_loan_Iscomplete > @$amount_disbursed){
//               echo "<script>alert('savings plus + current payments has settled the loan')</script>";
//           }
//       } 
//       
//       
//       
//       
//       
//        //UPDATE THE MONTH CHECKER SO REPAYMENT CAN GET CURRENT MONTH in weekly_allloan
//        if($days_remaining11 > 27 && $days_remaining11 < 56){       
//          $sql_state12 = "UPDATE weekly_allloan SET month_checker = 'second_month' WHERE name = '$name' AND disburseloan > 1 AND remarks = 'loan disbursement' AND codename = '$codename'";
//               $result12 = mysqli_query($connect, $sql_state12);  
//        }
//           
//           
//       //START COUNT UP TO 28 DAYS FOR ANOTHER MONTH. TO ENABLE DEFAULTERS ALERT
//      ////HERE IS TO AVOID REPEAT OF THE COUNTER DATE SET FOR THE NEXT 28 DAYS   
//                $sql_check_secondmonth_date = mysqli_query($connect, "SELECT * FROM members WHERE namee = '$name'");  
//              while($row = mysqli_fetch_assoc($sql_check_secondmonth_date)){
//                  $submit_month = $row['submit_date_month']; 
//                }
//              
//           if($days_remaining11 > 27 && $days_remaining11 < 56 && $submit_month === "first_month"){
//               $result222 = mysqli_query($connect, "UPDATE members SET  weeklyenddate = '$today', submit_date_month = 'second_month', weeklycode = '$codename' WHERE namee = '$name'");
//         }   
//        
//   ////////////////////startdate///////////////////////MONTH 1 PENALTY END/////////////////////////////////         
//      
//   ///////////////////////////////////----------------------------------////////////////////         
//             //  *******************************************************************************************************                
//         
//             
//       
//     
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//        
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//        
//         ///////////////////////////////////////////MONTH 2 PENALTY START/////////////////////////////////         
//            
//            
/////////////////////////////////////----------------------------------////////////////////         
//                
////            LETS DO AUTOMATIC REWARD PENALTY FOR MONTH 2
//     if($days_remaining11 > 55 && $days_remaining11 < 84 && $repay_sum_month2 < $amt_checker && $month_checker === "second_month"){
//                   
//                  
//                  
//                  
////  *******************************************************************************************************                
//    /////THIS IS TO SUM PAYMENTS TO ADD IT TO REPAY SO WE  KNOW IF PENALTY CAN BE AWARDED
//     $total_payments24 = mysqli_query($connect, "SELECT SUM(repay) as total FROM weekly_allloan WHERE codename='$codename'");      
//           while  ($row1 = mysqli_fetch_array($total_payments24)){
//                  $summation_pay2 = $row1['total'];                          
//                  } 
//                  
//                  
//    /////THIS IS TO SUM PAYMENTS TO ADD IT TO SAVINGS SO WE  KNOW IF PENALTY CAN BE AWARDED
//     $total_payments26 = mysqli_query($connect, "SELECT SUM(savings) as total FROM weekly_allloan WHERE codename='$codename'");      
//           while  ($row1 = mysqli_fetch_array($total_payments26)){
//                  $summation_savings2 = $row1['total'];                          
//                  }   
//        $lets_know_if_loan_Iscomplete = $summation_pay2 + $summation_savings2;
//        
//        
//        /////LETS GET THE AMOUNT COLLECTED
//              $amount_disbursed = "";
//        $total_disburse28 = mysqli_query($connect, "SELECT * FROM weekly_allloan WHERE codename='$codename' AND disburseloan > 1 AND remarks = 'loan disbursement'");      
//           while  ($row1 = mysqli_fetch_array($total_disburse28)){
//                  $amount_disbursed = $row1['disburseloan'];                          
//                  } 
//                
//        
////  *******************************************************************************************************               
//            
//                  
//                  
//                 
//                  
//                  
//                  if($lets_know_if_loan_Iscomplete < $amount_disbursed){
//                  
//              $date = date("jS F Y");
//            $month = date("F");
//            $year = date("Y");
//
//              $decimal_pen =  10 / 100 ;
//             $penalty = $decimal_pen * ($amt_checker - $repay_sum_month2);
//             
////             ---------------------------------------
////        //          SET NEW DATE FOR ANOTHER PENALTY 
//               
//                    $today1 = time();
//          $today = date("Y-m-d", $today1);
//                  
//          $new_closedate  = date('Y-m-d', strtotime($today. ' + 28 days'));
//
//                 $today_date  = date('Y-m-d', time());
////       -----------------------------------------------------------   
//   
////           UPDATE THE MONTH CHECKER SO REPAYMENT CAN GET CURRENT MONTH
//       $sql_state12 = "UPDATE weekly_allloan SET month_checker = 'third_month' WHERE name = '$name' AND disburseloan > 1 AND remarks = 'loan disbursement' AND codename = '$codename'";
//            $result12 = mysqli_query($connect, $sql_state12);
//          
//         
////          INSERT NEW PENALTY INTO DATEBASE
//           $sql_statement = "INSERT INTO weekly_allloan (name, type, remarks, disburseloan, codename, date, month, year, lastpaiddate) VALUES ('$name', 'Weekly Payment', 'Penalty', '$penalty', '$codename', '$date', '$month', '$year', '$closingdate')";
//     $result = mysqli_query($connect, $sql_statement); 
//                     
//                     
//            ////GET THE REMAINING LATEST BALANCE OF LOAN FOR AN INDIVIDUAL
//                       $summation_loan2 = "";
//                       $summation_pay2 = "";
//                       
//             ///////THIS IS TO GET THE INDIVIDUAL BALANCE
//                        ////////////THIS IS TO SUM LOAN
//        $code_loan = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM weekly_allloan WHERE codename = '$codename' ");      
//          while  ($row = mysqli_fetch_assoc($code_loan)){
//          $summation_loan2 = $row['total']; 
//          }
//              
//        ////////////THIS IS TO SUM PAYMENTS
//        $total_payments2 = mysqli_query($connect, "SELECT SUM(repay) as total FROM weekly_allloan WHERE codename='$codename'");      
//      while  ($row1 = mysqli_fetch_array($total_payments2)){
//      $summation_pay2 = $row1['total'];                          
//      }
//                    
//                /////LETS GET THE BALANCE
//              $available_blance = $summation_loan2 - $summation_pay2;
//              
//       
//          ////////GET ALL REVERSAL PAYMENT TO MINUS FROM
//               $total_payments33 = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM weekly_allloan WHERE codename='$codename' AND remarks = 'Reversal Entry'");      
//              while  ($row1 = mysqli_fetch_array($total_payments33)){
//              $summation_reverse2 = $row1['total'];                          
//              }
//         $original_summation = $summation_pay2 - $summation_reverse2;   
//     //        -----------------------------------------------------------------------             
//          
//         /////////SUM GENERAL REPAY & DISBURSE LOAN SO YOU CAN GET GEN BALALNCE
//            ////////////THIS IS TO SUM PAYMENTS
//                $total_payments = mysqli_query($connect, "SELECT SUM(repay) as total FROM weekly_allloan");      
//              while  ($row1 = mysqli_fetch_array($total_payments)){
//              $summation_pay = $row1['total'];                          
//                   }
//                   
//                   
//             ////////////THIS IS TO SUM DISBURSE
//                $total_disburse2 = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM weekly_allloan");      
//              while  ($row2 = mysqli_fetch_array($total_disburse2)){
//                        $summation_disburse = $row2['total'];                          
//                   }
//                   $gen_balance =  $summation_disburse - $summation_pay;  
////        -----------------------------------------------------------------------             
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//            //       *********************************||||||||||||||||****************************************************            
//                      $summation5 =  $summation6 = "";
//                   ///////////THIS IS TO SUM TOTAL monthly_disburseloan///////////////////
//                        $total_monthly_disburseloan = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM monthly_allloan WHERE name='$name'");      
//                          while  ($row = mysqli_fetch_array($total_monthly_disburseloan)){
//                          $summation5 = $row['total'];                          
//                          }
//                            
//      ////////////THIS IS TO TOTAL monthly_payment
//                            $total_monthly_payment = mysqli_query($connect, "SELECT SUM(repay) as total FROM monthly_allloan WHERE name='$name'");      
//                          while  ($row1 = mysqli_fetch_array($total_monthly_payment)){
//                          $summation6 = $row1['total'];                          
//                          }
//                          //////////////////////////////////////////
//                       @$monthly_status =  $summation5 - $summation6;
//
//                 
//                         
//      //       *********************************||||||||||||||||****************************************************            
//                      $summation1 =  $summation2 =  $summation3 =  $summation4 = "";
//                   ///////////THIS IS TO SUM TOTAL daily_disburseloan///////////////////
//                        $total_daily_disburseloan = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM allloan WHERE name='$name'");      
//                          while  ($row = mysqli_fetch_array($total_daily_disburseloan)){
//                          $summation1 = $row['total'];                          
//                          }
//                            
//      ////////////THIS IS TO TOTAL daily_payment
//                            $total_daily_payment = mysqli_query($connect, "SELECT SUM(repay) as total FROM allloan WHERE name='$name'");      
//                          while  ($row1 = mysqli_fetch_array($total_daily_payment)){
//                          $summation2 = $row1['total'];                          
//                          }
//                          //////////////////////////////////////////
//                       @$daily_status =  $summation1 - $summation2;
//
///////======================================================================
//
//
//  ///////THIS IS TO SUM TOTAL weekly_disburseloan///////////////////
//                        $total_weekly_disburseloan = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM weekly_allloan WHERE name='$name'");      
//                          while  ($row = mysqli_fetch_array($total_weekly_disburseloan)){
//                          $summation3 = $row['total'];                          
//                          }
//                            
//      ////////////THIS IS TO TOTAL weekly_payment
//                      $total_weekly_payment = mysqli_query($connect, "SELECT SUM(repay) as total FROM weekly_allloan WHERE name='$name'");      
//                          while  ($row1 = mysqli_fetch_array($total_weekly_payment)){
//                          $summation4 = $row1['total'];                          
//                          }
//                          //////////////////////////////////////////
//                       @$weekly_status =  $summation3 - $summation4;
//
//                    @$total_status =  $daily_status + $weekly_status + $monthly_status;
//      //UPDATE RECORD
//      $sql_statement101 = "UPDATE members SET balance = '$total_status' WHERE namee='$name'";
//                     $result29 = mysqli_query($connect, $sql_statement101); 
// //       **************************||||||||||||||||***********************************************            
//              
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                   
//                   
//              
//                //GET LAST ID  
//               $get_last_id = mysqli_query($connect, "SELECT * FROM weekly_allloan");      
//                          while  ($row = mysqli_fetch_assoc($get_last_id)){
//                          $id = $row['id'];                           
//                          }
//                     
//               ////UPDATE TO GET A NEW INDIVIDUAL BALANCE
//                  $result2 = mysqli_query($connect, "UPDATE weekly_allloan SET genbalance = '$gen_balance',  repaycumm = '$original_summation', indbalance = '$available_blance' WHERE id = '$id'");
//         //           UPDATE weeklyenddate FOR MEMEBERS DB TO AUTO-DETECT PENALTY
//        $result222 = mysqli_query($connect, "UPDATE members SET weeklyindbal = '$available_blance', weeklyenddate = '$today', weeklycode = '$codename' WHERE namee = '$name'");
//                  
//                          if($result2==true){                             
////                     $output_new_closedate = date('d-M-Y', strtotime($new_closedate));         
//            echo "<script>alert('Notification: $name has been given a penalty fee of ".number_format($penalty)." Naira. Total balance now is: ".number_format($available_blance)." Naira Only. $name loan repayment is overdue for the previous month.')</script>";
//               $id = "";
//             } else {
//    echo "<script>alert('Error')</script>";
//                        }
//           }
//      
//           if($lets_know_if_loan_Iscomplete > @$amount_disbursed){
//               echo "<script>alert('savings plus + current payments has settled the loan')</script>";
//           }
//       } 
//       
//       
//       
//       
//       
//        //UPDATE THE MONTH CHECKER SO REPAYMENT CAN GET CURRENT MONTH in weekly_allloan
//        if($days_remaining11 > 55 && $days_remaining11 < 84){       
//          $sql_state12 = "UPDATE weekly_allloan SET month_checker = 'third_month' WHERE name = '$name' AND disburseloan > 1 AND remarks = 'loan disbursement' AND codename = '$codename'";
//               $result12 = mysqli_query($connect, $sql_state12);  
//        }
//           
//           
//       //START COUNT UP TO 28 DAYS FOR ANOTHER MONTH. TO ENABLE DEFAULTERS ALERT
//                $sql_check_secondmonth_date2 = mysqli_query($connect, "SELECT * FROM members WHERE namee = '$name'");  
//              while($row = mysqli_fetch_assoc($sql_check_secondmonth_date2)){
//                  $submit_month = $row['submit_date_month']; 
//                }
//                
//    ////HERE IS TO AVOID REPEAT OF THE COUNTER DATE SET FOR THE NEXT 28 DAYS           
//           if($days_remaining11 > 55 && $days_remaining11 < 84 && $submit_month == "second_month"){
//               $result222 = mysqli_query($connect, "UPDATE members SET  weeklyenddate = '$today', submit_date_month = 'third_month', weeklycode = '$codename' WHERE namee = '$name'");
//         }   
//        
//   ////////////////////startdate///////////////////////MONTH 2 PENALTY END/////////////////////////////////         
//      
//   ///////////////////////////////////----------------------------------////////////////////         
//             //  *******************************************************************************************************                
//         
//             
//       
//       
//       
//       
//       
//       
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//          ///////////////////////////////////////////MONTH 3 PENALTY START/////////////////////////////////         
//            
//            
/////////////////////////////////////----------------------------------////////////////////         
//                
////            LETS DO AUTOMATIC REWARD PENALTY FOR MONTH 3
//     if($days_remaining11 > 85 && $days_remaining11 < 112 && $repay_sum_month3 < $amt_checker && $month_checker === "third_month"){
//                   
//                  
//                  
//                  
////  *******************************************************************************************************                
//    /////THIS IS TO SUM PAYMENTS TO ADD IT TO REPAY SO WE  KNOW IF PENALTY CAN BE AWARDED
//     $total_payments24 = mysqli_query($connect, "SELECT SUM(repay) as total FROM weekly_allloan WHERE codename='$codename'");      
//           while  ($row1 = mysqli_fetch_array($total_payments24)){
//                  $summation_pay2 = $row1['total'];                          
//                  } 
//                  
//                  
//    /////THIS IS TO SUM PAYMENTS TO ADD IT TO SAVINGS SO WE  KNOW IF PENALTY CAN BE AWARDED
//     $total_payments26 = mysqli_query($connect, "SELECT SUM(savings) as total FROM weekly_allloan WHERE codename='$codename'");      
//           while  ($row1 = mysqli_fetch_array($total_payments26)){
//                  $summation_savings2 = $row1['total'];                          
//                  }   
//        $lets_know_if_loan_Iscomplete = $summation_pay2 + $summation_savings2;
//        
//        
//        /////LETS GET THE AMOUNT COLLECTED
//              $amount_disbursed = "";
//        $total_disburse28 = mysqli_query($connect, "SELECT * FROM weekly_allloan WHERE codename='$codename' AND disburseloan > 1 AND remarks = 'loan disbursement'");      
//           while  ($row1 = mysqli_fetch_array($total_disburse28)){
//                  $amount_disbursed = $row1['disburseloan'];                          
//                  } 
//                
//        
////  *******************************************************************************************************               
//            
//                  
//                  
//                 
//                  
//                  
//                  if($lets_know_if_loan_Iscomplete < $amount_disbursed){
//                  
//              $date = date("jS F Y");
//            $month = date("F");
//            $year = date("Y");
//
//              $decimal_pen =  10 / 100 ;
//             $penalty = $decimal_pen * ($amt_checker - $repay_sum_month3);
//             
////             ---------------------------------------
////        //          SET NEW DATE FOR ANOTHER PENALTY 
//               
//                    $today1 = time();
//          $today = date("Y-m-d", $today1);
//                  
//          $new_closedate  = date('Y-m-d', strtotime($today. ' + 28 days'));
//
//                 $today_date  = date('Y-m-d', time());
////       -----------------------------------------------------------   
//   
////           UPDATE THE MONTH CHECKER SO REPAYMENT CAN GET CURRENT MONTH
//       $sql_state12 = "UPDATE weekly_allloan SET month_checker = 'fourth_month' WHERE name = '$name' AND disburseloan > 1 AND remarks = 'loan disbursement' AND codename = '$codename'";
//            $result12 = mysqli_query($connect, $sql_state12);
//          
//         
////          INSERT NEW PENALTY INTO DATEBASE
//           $sql_statement = "INSERT INTO weekly_allloan (name, type, remarks, disburseloan, codename, date, month, year, lastpaiddate) VALUES ('$name', 'Weekly Payment', 'Penalty', '$penalty', '$codename', '$date', '$month', '$year', '$closingdate')";
//     $result = mysqli_query($connect, $sql_statement); 
//                     
//                     
//            ////GET THE REMAINING LATEST BALANCE OF LOAN FOR AN INDIVIDUAL
//                       $summation_loan2 = "";
//                       $summation_pay2 = "";
//                       
//             ///////THIS IS TO GET THE INDIVIDUAL BALANCE
//                        ////////////THIS IS TO SUM LOAN
//        $code_loan = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM weekly_allloan WHERE codename = '$codename' ");      
//          while  ($row = mysqli_fetch_assoc($code_loan)){
//          $summation_loan2 = $row['total']; 
//          }
//              
//        ////////////THIS IS TO SUM PAYMENTS
//        $total_payments2 = mysqli_query($connect, "SELECT SUM(repay) as total FROM weekly_allloan WHERE codename='$codename'");      
//      while  ($row1 = mysqli_fetch_array($total_payments2)){
//      $summation_pay2 = $row1['total'];                          
//      }
//                    
//                /////LETS GET THE BALANCE
//              $available_blance = $summation_loan2 - $summation_pay2;
//              
//       
//          ////////GET ALL REVERSAL PAYMENT TO MINUS FROM
//               $total_payments33 = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM weekly_allloan WHERE codename='$codename' AND remarks = 'Reversal Entry'");      
//              while  ($row1 = mysqli_fetch_array($total_payments33)){
//              $summation_reverse2 = $row1['total'];                          
//              }
//         $original_summation = $summation_pay2 - $summation_reverse2;   
//     //        -----------------------------------------------------------------------             
//          
//         /////////SUM GENERAL REPAY & DISBURSE LOAN SO YOU CAN GET GEN BALALNCE
//            ////////////THIS IS TO SUM PAYMENTS
//                $total_payments = mysqli_query($connect, "SELECT SUM(repay) as total FROM weekly_allloan");      
//              while  ($row1 = mysqli_fetch_array($total_payments)){
//              $summation_pay = $row1['total'];                          
//                   }
//                   
//                   
//             ////////////THIS IS TO SUM DISBURSE
//                $total_disburse2 = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM weekly_allloan");      
//              while  ($row2 = mysqli_fetch_array($total_disburse2)){
//                        $summation_disburse = $row2['total'];                          
//                   }
//                   $gen_balance =  $summation_disburse - $summation_pay;  
////        -----------------------------------------------------------------------             
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//            //       *********************************||||||||||||||||****************************************************            
//                      $summation5 =  $summation6 = "";
//                   ///////////THIS IS TO SUM TOTAL monthly_disburseloan///////////////////
//                        $total_monthly_disburseloan = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM monthly_allloan WHERE name='$name'");      
//                          while  ($row = mysqli_fetch_array($total_monthly_disburseloan)){
//                          $summation5 = $row['total'];                          
//                          }
//                            
//      ////////////THIS IS TO TOTAL monthly_payment
//                            $total_monthly_payment = mysqli_query($connect, "SELECT SUM(repay) as total FROM monthly_allloan WHERE name='$name'");      
//                          while  ($row1 = mysqli_fetch_array($total_monthly_payment)){
//                          $summation6 = $row1['total'];                          
//                          }
//                          //////////////////////////////////////////
//                       @$monthly_status =  $summation5 - $summation6;
//
//                 
//                         
//      //       *********************************||||||||||||||||****************************************************            
//                      $summation1 =  $summation2 =  $summation3 =  $summation4 = "";
//                   ///////////THIS IS TO SUM TOTAL daily_disburseloan///////////////////
//                        $total_daily_disburseloan = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM allloan WHERE name='$name'");      
//                          while  ($row = mysqli_fetch_array($total_daily_disburseloan)){
//                          $summation1 = $row['total'];                          
//                          }
//                            
//      ////////////THIS IS TO TOTAL daily_payment
//                            $total_daily_payment = mysqli_query($connect, "SELECT SUM(repay) as total FROM allloan WHERE name='$name'");      
//                          while  ($row1 = mysqli_fetch_array($total_daily_payment)){
//                          $summation2 = $row1['total'];                          
//                          }
//                          //////////////////////////////////////////
//                       @$daily_status =  $summation1 - $summation2;
//
///////======================================================================
//
//
//  ///////THIS IS TO SUM TOTAL weekly_disburseloan///////////////////
//                        $total_weekly_disburseloan = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM weekly_allloan WHERE name='$name'");      
//                          while  ($row = mysqli_fetch_array($total_weekly_disburseloan)){
//                          $summation3 = $row['total'];                          
//                          }
//                            
//      ////////////THIS IS TO TOTAL weekly_payment
//                      $total_weekly_payment = mysqli_query($connect, "SELECT SUM(repay) as total FROM weekly_allloan WHERE name='$name'");      
//                          while  ($row1 = mysqli_fetch_array($total_weekly_payment)){
//                          $summation4 = $row1['total'];                          
//                          }
//                          //////////////////////////////////////////
//                       @$weekly_status =  $summation3 - $summation4;
//
//                    @$total_status =  $daily_status + $weekly_status + $monthly_status;
//      //UPDATE RECORD
//      $sql_statement101 = "UPDATE members SET balance = '$total_status' WHERE namee='$name'";
//                     $result29 = mysqli_query($connect, $sql_statement101); 
// //       **************************||||||||||||||||***********************************************            
//              
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                   
//                   
//              
//                //GET LAST ID  
//               $get_last_id = mysqli_query($connect, "SELECT * FROM weekly_allloan");      
//                          while  ($row = mysqli_fetch_assoc($get_last_id)){
//                          $id = $row['id'];                           
//                          }
//                     
//               ////UPDATE TO GET A NEW INDIVIDUAL BALANCE
//                  $result2 = mysqli_query($connect, "UPDATE weekly_allloan SET genbalance = '$gen_balance',  repaycumm = '$original_summation', indbalance = '$available_blance' WHERE id = '$id'");
//                   //           UPDATE weeklyenddate FOR MEMEBERS DB TO AUTO-DETECT PENALTY
//        $result222 = mysqli_query($connect, "UPDATE members SET weeklyindbal = '$available_blance', weeklyenddate = '$today', weeklycode = '$codename' WHERE namee = '$name'");
//                  
//                          if($result2==true){                             
////                     $output_new_closedate = date('d-M-Y', strtotime($new_closedate));         
//            echo "<script>alert('Notification: $name has been given a penalty fee of ".number_format($penalty)." Naira. Total balance now is: ".number_format($available_blance)." Naira Only. $name loan repayment is overdue for the previous month.')</script>";
//               $id = "";
//             } else {
//    echo "<script>alert('Error')</script>";
//                        }
//           }
//      
//           if($lets_know_if_loan_Iscomplete > @$amount_disbursed){
//               echo "<script>alert('savings plus + current payments has settled the loan')</script>";
//           }
//       } 
//       
//       
//       
//       
//       
//        //UPDATE THE MONTH CHECKER SO REPAYMENT CAN GET CURRENT MONTH in weekly_allloan
//        if($days_remaining11 > 85 && $days_remaining11 < 112){       
//          $sql_state12 = "UPDATE weekly_allloan SET month_checker = 'fourth_month' WHERE name = '$name' AND disburseloan > 1 AND remarks = 'loan disbursement' AND codename = '$codename'";
//               $result12 = mysqli_query($connect, $sql_state12);  
//        }
//           
//           
//       //START COUNT UP TO 28 DAYS FOR ANOTHER MONTH. TO ENABLE DEFAULTERS ALERT
//                $sql_check_secondmonth_date3 = mysqli_query($connect, "SELECT * FROM members WHERE namee = '$name'");  
//              while($row = mysqli_fetch_assoc($sql_check_secondmonth_date3)){
//                  $submit_month = $row['submit_date_month']; 
//                }
//                
//    ////HERE IS TO AVOID REPEAT OF THE COUNTER DATE SET FOR THE NEXT 28 DAYS           
//           if($days_remaining11 > 85 && $days_remaining11 < 112 && $submit_month == "third_month"){
//               $result222 = mysqli_query($connect, "UPDATE members SET  weeklyenddate = '$today', submit_date_month = 'fourth_month', weeklycode = '$codename' WHERE namee = '$name'");
//         }   
//        
//   ////////////////////startdate///////////////////////MONTH 3 PENALTY END/////////////////////////////////         
//      
//   ///////////////////////////////////----------------------------------////////////////////         
//             //  *******************************************************************************************************                
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//          ///////////////////////////////////////////MONTH 4 PENALTY START/////////////////////////////////         
//            
//            
/////////////////////////////////////----------------------------------////////////////////         
//                
////            LETS DO AUTOMATIC REWARD PENALTY FOR MONTH 4
//     if($days_remaining11 > 111 && $days_remaining11 < 140 && $repay_sum_month2 < $amt_checker && $month_checker === "fourth_month"){
//                   
//                  
//                  
//                  
////  *******************************************************************************************************                
//    /////THIS IS TO SUM PAYMENTS TO ADD IT TO REPAY SO WE  KNOW IF PENALTY CAN BE AWARDED
//     $total_payments24 = mysqli_query($connect, "SELECT SUM(repay) as total FROM weekly_allloan WHERE codename='$codename'");      
//           while  ($row1 = mysqli_fetch_array($total_payments24)){
//                  $summation_pay2 = $row1['total'];                          
//                  } 
//                  
//                  
//    /////THIS IS TO SUM PAYMENTS TO ADD IT TO SAVINGS SO WE  KNOW IF PENALTY CAN BE AWARDED
//     $total_payments26 = mysqli_query($connect, "SELECT SUM(savings) as total FROM weekly_allloan WHERE codename='$codename'");      
//           while  ($row1 = mysqli_fetch_array($total_payments26)){
//                  $summation_savings2 = $row1['total'];                          
//                  }   
//        $lets_know_if_loan_Iscomplete = $summation_pay2 + $summation_savings2;
//        
//        
//        /////LETS GET THE AMOUNT COLLECTED
//              $amount_disbursed = "";
//        $total_disburse28 = mysqli_query($connect, "SELECT * FROM weekly_allloan WHERE codename='$codename' AND disburseloan > 1 AND remarks = 'loan disbursement'");      
//           while  ($row1 = mysqli_fetch_array($total_disburse28)){
//                  $amount_disbursed = $row1['disburseloan'];                          
//                  } 
//                
//        
////  *******************************************************************************************************               
//            
//                  
//                  
//                 
//                  
//                  
//                  if($lets_know_if_loan_Iscomplete < $amount_disbursed){
//                  
//              $date = date("jS F Y");
//            $month = date("F");
//            $year = date("Y");
//
//              $decimal_pen =  10 / 100 ;
//             $penalty = $decimal_pen * ($amt_checker - $repay_sum_month4);
//             
////             ---------------------------------------
////        //          SET NEW DATE FOR ANOTHER PENALTY 
//               
//                    $today1 = time();
//          $today = date("Y-m-d", $today1);
//                  
//          $new_closedate  = date('Y-m-d', strtotime($today. ' + 28 days'));
//
//                 $today_date  = date('Y-m-d', time());
////       -----------------------------------------------------------   
//   
////           UPDATE THE MONTH CHECKER SO REPAYMENT CAN GET CURRENT MONTH
//       $sql_state12 = "UPDATE weekly_allloan SET month_checker = 'fifth_month' WHERE name = '$name' AND disburseloan > 1 AND remarks = 'loan disbursement' AND codename = '$codename'";
//            $result12 = mysqli_query($connect, $sql_state12);
//          
//         
////          INSERT NEW PENALTY INTO DATEBASE
//           $sql_statement = "INSERT INTO weekly_allloan (name, type, remarks, disburseloan, codename, date, month, year, lastpaiddate) VALUES ('$name', 'Weekly Payment', 'Penalty', '$penalty', '$codename', '$date', '$month', '$year', '$closingdate')";
//     $result = mysqli_query($connect, $sql_statement); 
//                     
//                     
//            ////GET THE REMAINING LATEST BALANCE OF LOAN FOR AN INDIVIDUAL
//                       $summation_loan2 = "";
//                       $summation_pay2 = "";
//                       
//             ///////THIS IS TO GET THE INDIVIDUAL BALANCE
//                        ////////////THIS IS TO SUM LOAN
//        $code_loan = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM weekly_allloan WHERE codename = '$codename' ");      
//          while  ($row = mysqli_fetch_assoc($code_loan)){
//          $summation_loan2 = $row['total']; 
//          }
//              
//        ////////////THIS IS TO SUM PAYMENTS
//        $total_payments2 = mysqli_query($connect, "SELECT SUM(repay) as total FROM weekly_allloan WHERE codename='$codename'");      
//      while  ($row1 = mysqli_fetch_array($total_payments2)){
//      $summation_pay2 = $row1['total'];                          
//      }
//                    
//                /////LETS GET THE BALANCE
//              $available_blance = $summation_loan2 - $summation_pay2;
//              
//       
//          ////////GET ALL REVERSAL PAYMENT TO MINUS FROM
//               $total_payments33 = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM weekly_allloan WHERE codename='$codename' AND remarks = 'Reversal Entry'");      
//              while  ($row1 = mysqli_fetch_array($total_payments33)){
//              $summation_reverse2 = $row1['total'];                          
//              }
//         $original_summation = $summation_pay2 - $summation_reverse2;   
//     //        -----------------------------------------------------------------------             
//          
//         /////////SUM GENERAL REPAY & DISBURSE LOAN SO YOU CAN GET GEN BALALNCE
//            ////////////THIS IS TO SUM PAYMENTS
//                $total_payments = mysqli_query($connect, "SELECT SUM(repay) as total FROM weekly_allloan");      
//              while  ($row1 = mysqli_fetch_array($total_payments)){
//              $summation_pay = $row1['total'];                          
//                   }
//                   
//                   
//             ////////////THIS IS TO SUM DISBURSE
//                $total_disburse2 = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM weekly_allloan");      
//              while  ($row2 = mysqli_fetch_array($total_disburse2)){
//                        $summation_disburse = $row2['total'];                          
//                   }
//                   $gen_balance =  $summation_disburse - $summation_pay;  
////        -----------------------------------------------------------------------             
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//            //       *********************************||||||||||||||||****************************************************            
//                      $summation5 =  $summation6 = "";
//                   ///////////THIS IS TO SUM TOTAL monthly_disburseloan///////////////////
//                        $total_monthly_disburseloan = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM monthly_allloan WHERE name='$name'");      
//                          while  ($row = mysqli_fetch_array($total_monthly_disburseloan)){
//                          $summation5 = $row['total'];                          
//                          }
//                            
//      ////////////THIS IS TO TOTAL monthly_payment
//                            $total_monthly_payment = mysqli_query($connect, "SELECT SUM(repay) as total FROM monthly_allloan WHERE name='$name'");      
//                          while  ($row1 = mysqli_fetch_array($total_monthly_payment)){
//                          $summation6 = $row1['total'];                          
//                          }
//                          //////////////////////////////////////////
//                       @$monthly_status =  $summation5 - $summation6;
//
//                 
//                         
//      //       *********************************||||||||||||||||****************************************************            
//                      $summation1 =  $summation2 =  $summation3 =  $summation4 = "";
//                   ///////////THIS IS TO SUM TOTAL daily_disburseloan///////////////////
//                        $total_daily_disburseloan = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM allloan WHERE name='$name'");      
//                          while  ($row = mysqli_fetch_array($total_daily_disburseloan)){
//                          $summation1 = $row['total'];                          
//                          }
//                            
//      ////////////THIS IS TO TOTAL daily_payment
//                            $total_daily_payment = mysqli_query($connect, "SELECT SUM(repay) as total FROM allloan WHERE name='$name'");      
//                          while  ($row1 = mysqli_fetch_array($total_daily_payment)){
//                          $summation2 = $row1['total'];                          
//                          }
//                          //////////////////////////////////////////
//                       @$daily_status =  $summation1 - $summation2;
//
///////======================================================================
//
//
//  ///////THIS IS TO SUM TOTAL weekly_disburseloan///////////////////
//                        $total_weekly_disburseloan = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM weekly_allloan WHERE name='$name'");      
//                          while  ($row = mysqli_fetch_array($total_weekly_disburseloan)){
//                          $summation3 = $row['total'];                          
//                          }
//                            
//      ////////////THIS IS TO TOTAL weekly_payment
//                      $total_weekly_payment = mysqli_query($connect, "SELECT SUM(repay) as total FROM weekly_allloan WHERE name='$name'");      
//                          while  ($row1 = mysqli_fetch_array($total_weekly_payment)){
//                          $summation4 = $row1['total'];                          
//                          }
//                          //////////////////////////////////////////
//                       @$weekly_status =  $summation3 - $summation4;
//
//                    @$total_status =  $daily_status + $weekly_status + $monthly_status;
//      //UPDATE RECORD
//      $sql_statement101 = "UPDATE members SET balance = '$total_status' WHERE namee='$name'";
//                     $result29 = mysqli_query($connect, $sql_statement101); 
// //       **************************||||||||||||||||***********************************************            
//              
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                   
//                   
//              
//                //GET LAST ID  
//               $get_last_id = mysqli_query($connect, "SELECT * FROM weekly_allloan");      
//                          while  ($row = mysqli_fetch_assoc($get_last_id)){
//                          $id = $row['id'];                           
//                          }
//                     
//               ////UPDATE TO GET A NEW INDIVIDUAL BALANCE
//                  $result2 = mysqli_query($connect, "UPDATE weekly_allloan SET genbalance = '$gen_balance',  repaycumm = '$original_summation', indbalance = '$available_blance' WHERE id = '$id'");
//                   //           UPDATE weeklyenddate FOR MEMEBERS DB TO AUTO-DETECT PENALTY
//        $result222 = mysqli_query($connect, "UPDATE members SET weeklyindbal = '$available_blance', weeklyenddate = '$today', weeklycode = '$codename' WHERE namee = '$name'");
//                  
//                          if($result2==true){                             
////                     $output_new_closedate = date('d-M-Y', strtotime($new_closedate));         
//            echo "<script>alert('Notification: $name has been given a penalty fee of ".number_format($penalty)." Naira. Total balance now is: ".number_format($available_blance)." Naira Only. $name loan repayment is overdue for the previous month.')</script>";
//               $id = "";
//             } else {
//    echo "<script>alert('Error')</script>";
//                        }
//           }
//      
//           if($lets_know_if_loan_Iscomplete > @$amount_disbursed){
//               echo "<script>alert('savings plus + current payments has settled the loan')</script>";
//           }
//       } 
//       
//       
//       
//       
//       
//        //UPDATE THE MONTH CHECKER SO REPAYMENT CAN GET CURRENT MONTH in weekly_allloan
//        if($days_remaining11 > 111 && $days_remaining11 < 140){       
//          $sql_state12 = "UPDATE weekly_allloan SET month_checker = 'fifth_month' WHERE name = '$name' AND disburseloan > 1 AND remarks = 'loan disbursement' AND codename = '$codename'";
//               $result12 = mysqli_query($connect, $sql_state12);  
//        }
//           
//           
//       //START COUNT UP TO 28 DAYS FOR ANOTHER MONTH. TO ENABLE DEFAULTERS ALERT
//                $sql_check_secondmonth_date2 = mysqli_query($connect, "SELECT * FROM members WHERE namee = '$name'");  
//              while($row = mysqli_fetch_assoc($sql_check_secondmonth_date2)){
//                  $submit_month = $row['submit_date_month']; 
//                }
//                
//    ////HERE IS TO AVOID REPEAT OF THE COUNTER DATE SET FOR THE NEXT 28 DAYS           
//           if($days_remaining11 > 111 && $days_remaining11 < 140 && $submit_month == "fourth_month"){
//               $result222 = mysqli_query($connect, "UPDATE members SET  weeklyenddate = '$today', submit_date_month = 'fifth_month', weeklycode = '$codename' WHERE namee = '$name'");
//         }   
//        
//   ////////////////////startdate///////////////////////MONTH 4 PENALTY END/////////////////////////////////         
//      
//   ///////////////////////////////////----------------------------------////////////////////         
//             //  *******************************************************************************************************                
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//         
//          ///////////////////////////////////////////MONTH 5 PENALTY START/////////////////////////////////         
//            
//            
/////////////////////////////////////----------------------------------////////////////////         
//                
////            LETS DO AUTOMATIC REWARD PENALTY FOR MONTH 5
//     if($days_remaining11 > 139 && $repay_sum_month5 < $amt_checker && $month_checker === "fifth_month"){
//                   
//                  
//                  
//                  
////  *******************************************************************************************************                
//    /////THIS IS TO SUM PAYMENTS TO ADD IT TO REPAY SO WE  KNOW IF PENALTY CAN BE AWARDED
//     $total_payments24 = mysqli_query($connect, "SELECT SUM(repay) as total FROM weekly_allloan WHERE codename='$codename'");      
//           while  ($row1 = mysqli_fetch_array($total_payments24)){
//                  $summation_pay2 = $row1['total'];                          
//                  } 
//                  
//                  
//    /////THIS IS TO SUM PAYMENTS TO ADD IT TO SAVINGS SO WE  KNOW IF PENALTY CAN BE AWARDED
//     $total_payments26 = mysqli_query($connect, "SELECT SUM(savings) as total FROM weekly_allloan WHERE codename='$codename'");      
//           while  ($row1 = mysqli_fetch_array($total_payments26)){
//                  $summation_savings2 = $row1['total'];                          
//                  }   
//        $lets_know_if_loan_Iscomplete = $summation_pay2 + $summation_savings2;
//        
//        
//        /////LETS GET THE AMOUNT COLLECTED
//              $amount_disbursed = "";
//        $total_disburse28 = mysqli_query($connect, "SELECT * FROM weekly_allloan WHERE codename='$codename' AND disburseloan > 1 AND remarks = 'loan disbursement'");      
//           while  ($row1 = mysqli_fetch_array($total_disburse28)){
//                  $amount_disbursed = $row1['disburseloan'];                          
//                  } 
//                
//        
////  *******************************************************************************************************               
//            
//                  
//                  
//                 
//                  
//                  
//                  if($lets_know_if_loan_Iscomplete < $amount_disbursed){
//                  
//              $date = date("jS F Y");
//            $month = date("F");
//            $year = date("Y");
//
//              $decimal_pen =  10 / 100 ;
//             $penalty = $decimal_pen * ($amt_checker - $repay_sum_month5);
//             
////             ---------------------------------------
////        //          SET NEW DATE FOR ANOTHER PENALTY 
//               
//                    $today1 = time();
//          $today = date("Y-m-d", $today1);
//                  
//          $new_closedate  = date('Y-m-d', strtotime($today. ' + 28 days'));
//
//                 $today_date  = date('Y-m-d', time());
////       -----------------------------------------------------------   
//   
////           UPDATE THE MONTH CHECKER SO REPAYMENT CAN GET CURRENT MONTH
//       $sql_state12 = "UPDATE weekly_allloan SET month_checker = 'sixth_month' WHERE name = '$name' AND disburseloan > 1 AND remarks = 'loan disbursement' AND codename = '$codename'";
//            $result12 = mysqli_query($connect, $sql_state12);
//          
//         
////          INSERT NEW PENALTY INTO DATEBASE
//           $sql_statement = "INSERT INTO weekly_allloan (name, type, remarks, disburseloan, codename, date, month, year, lastpaiddate) VALUES ('$name', 'Weekly Payment', 'Penalty', '$penalty', '$codename', '$date', '$month', '$year', '$closingdate')";
//     $result = mysqli_query($connect, $sql_statement); 
//                     
//                     
//            ////GET THE REMAINING LATEST BALANCE OF LOAN FOR AN INDIVIDUAL
//                       $summation_loan2 = "";
//                       $summation_pay2 = "";
//                       
//             ///////THIS IS TO GET THE INDIVIDUAL BALANCE
//                        ////////////THIS IS TO SUM LOAN
//        $code_loan = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM weekly_allloan WHERE codename = '$codename' ");      
//          while  ($row = mysqli_fetch_assoc($code_loan)){
//          $summation_loan2 = $row['total']; 
//          }
//              
//        ////////////THIS IS TO SUM PAYMENTS
//        $total_payments2 = mysqli_query($connect, "SELECT SUM(repay) as total FROM weekly_allloan WHERE codename='$codename'");      
//      while  ($row1 = mysqli_fetch_array($total_payments2)){
//      $summation_pay2 = $row1['total'];                          
//      }
//                    
//                /////LETS GET THE BALANCE
//              $available_blance = $summation_loan2 - $summation_pay2;
//              
//       
//          ////////GET ALL REVERSAL PAYMENT TO MINUS FROM
//               $total_payments33 = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM weekly_allloan WHERE codename='$codename' AND remarks = 'Reversal Entry'");      
//              while  ($row1 = mysqli_fetch_array($total_payments33)){
//              $summation_reverse2 = $row1['total'];                          
//              }
//         $original_summation = $summation_pay2 - $summation_reverse2;   
//     //        -----------------------------------------------------------------------             
//          
//         /////////SUM GENERAL REPAY & DISBURSE LOAN SO YOU CAN GET GEN BALALNCE
//            ////////////THIS IS TO SUM PAYMENTS
//                $total_payments = mysqli_query($connect, "SELECT SUM(repay) as total FROM weekly_allloan");      
//              while  ($row1 = mysqli_fetch_array($total_payments)){
//              $summation_pay = $row1['total'];                          
//                   }
//                   
//                   
//             ////////////THIS IS TO SUM DISBURSE
//                $total_disburse2 = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM weekly_allloan");      
//              while  ($row2 = mysqli_fetch_array($total_disburse2)){
//                        $summation_disburse = $row2['total'];                          
//                   }
//                   $gen_balance =  $summation_disburse - $summation_pay;  
////        -----------------------------------------------------------------------             
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//                   
//            //       *********************************||||||||||||||||****************************************************            
//                      $summation5 =  $summation6 = "";
//                   ///////////THIS IS TO SUM TOTAL monthly_disburseloan///////////////////
//                        $total_monthly_disburseloan = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM monthly_allloan WHERE name='$name'");      
//                          while  ($row = mysqli_fetch_array($total_monthly_disburseloan)){
//                          $summation5 = $row['total'];                          
//                          }
//                            
//      ////////////THIS IS TO TOTAL monthly_payment
//                            $total_monthly_payment = mysqli_query($connect, "SELECT SUM(repay) as total FROM monthly_allloan WHERE name='$name'");      
//                          while  ($row1 = mysqli_fetch_array($total_monthly_payment)){
//                          $summation6 = $row1['total'];                          
//                          }
//                          //////////////////////////////////////////
//                       @$monthly_status =  $summation5 - $summation6;
//
//                 
//                         
//      //       *********************************||||||||||||||||****************************************************            
//                      $summation1 =  $summation2 =  $summation3 =  $summation4 = "";
//                   ///////////THIS IS TO SUM TOTAL daily_disburseloan///////////////////
//                        $total_daily_disburseloan = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM allloan WHERE name='$name'");      
//                          while  ($row = mysqli_fetch_array($total_daily_disburseloan)){
//                          $summation1 = $row['total'];                          
//                          }
//                            
//      ////////////THIS IS TO TOTAL daily_payment
//                            $total_daily_payment = mysqli_query($connect, "SELECT SUM(repay) as total FROM allloan WHERE name='$name'");      
//                          while  ($row1 = mysqli_fetch_array($total_daily_payment)){
//                          $summation2 = $row1['total'];                          
//                          }
//                          //////////////////////////////////////////
//                       @$daily_status =  $summation1 - $summation2;
//
///////======================================================================
//
//
//  ///////THIS IS TO SUM TOTAL weekly_disburseloan///////////////////
//                        $total_weekly_disburseloan = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM weekly_allloan WHERE name='$name'");      
//                          while  ($row = mysqli_fetch_array($total_weekly_disburseloan)){
//                          $summation3 = $row['total'];                          
//                          }
//                            
//      ////////////THIS IS TO TOTAL weekly_payment
//                      $total_weekly_payment = mysqli_query($connect, "SELECT SUM(repay) as total FROM weekly_allloan WHERE name='$name'");      
//                          while  ($row1 = mysqli_fetch_array($total_weekly_payment)){
//                          $summation4 = $row1['total'];                          
//                          }
//                          //////////////////////////////////////////
//                       @$weekly_status =  $summation3 - $summation4;
//
//                    @$total_status =  $daily_status + $weekly_status + $monthly_status;
//      //UPDATE RECORD
//      $sql_statement101 = "UPDATE members SET balance = '$total_status' WHERE namee='$name'";
//                     $result29 = mysqli_query($connect, $sql_statement101); 
// //       **************************||||||||||||||||***********************************************            
//              
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                     
//                   
//                   
//              
//                //GET LAST ID  
//               $get_last_id = mysqli_query($connect, "SELECT * FROM weekly_allloan");      
//                          while  ($row = mysqli_fetch_assoc($get_last_id)){
//                          $id = $row['id'];                           
//                          }
//                     
//               ////UPDATE TO GET A NEW INDIVIDUAL BALANCE
//                  $result2 = mysqli_query($connect, "UPDATE weekly_allloan SET genbalance = '$gen_balance',  repaycumm = '$original_summation', indbalance = '$available_blance' WHERE id = '$id'");
//                   //           UPDATE weeklyenddate FOR MEMEBERS DB TO AUTO-DETECT PENALTY
//        $result222 = mysqli_query($connect, "UPDATE members SET weeklyindbal = '$available_blance', weeklyenddate = '$today', weeklycode = '$codename' WHERE namee = '$name'");
//                  
//                          if($result2==true){                             
////                     $output_new_closedate = date('d-M-Y', strtotime($new_closedate));         
//            echo "<script>alert('Notification: $name has been given a penalty fee of ".number_format($penalty)." Naira. Total balance now is: ".number_format($available_blance)." Naira Only. $name loan repayment is overdue for the previous month.')</script>";
//               $id = "";
//             } else {
//    echo "<script>alert('Error')</script>";
//                        }
//           }
//      
//           if($lets_know_if_loan_Iscomplete > @$amount_disbursed){
//               echo "<script>alert('savings plus + current payments has settled the loan')</script>";
//           }
//       } 
//       
//       
//       
//       
//       
//        //UPDATE THE MONTH CHECKER SO REPAYMENT CAN GET CURRENT MONTH in weekly_allloan
//        if($days_remaining11 > 139 ){       
//          $sql_state12 = "UPDATE weekly_allloan SET month_checker = 'sixth_month' WHERE name = '$name' AND disburseloan > 1 AND remarks = 'loan disbursement' AND codename = '$codename'";
//               $result12 = mysqli_query($connect, $sql_state12);  
//        }
//           
//           
//       //START COUNT UP TO 28 DAYS FOR ANOTHER MONTH. TO ENABLE DEFAULTERS ALERT
//                $sql_check_secondmonth_date5 = mysqli_query($connect, "SELECT * FROM members WHERE namee = '$name'");  
//              while($row = mysqli_fetch_assoc($sql_check_secondmonth_date5)){
//                  $submit_month = $row['submit_date_month']; 
//                }
//                
//    ////HERE IS TO AVOID REPEAT OF THE COUNTER DATE SET FOR THE NEXT 28 DAYS           
//           if($days_remaining11 > 139 && $submit_month == "fifth_month"){
//               $result222 = mysqli_query($connect, "UPDATE members SET  weeklyenddate = '$today', submit_date_month = 'sixth_month', weeklycode = '$codename' WHERE namee = '$name'");
//         }   
//        
//   ////////////////////startdate///////////////////////MONTH 5 PENALTY END/////////////////////////////////         
//      
//   ///////////////////////////////////----------------------------------////////////////////         
//             //  *******************************************************************************************************                
//         
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
       
       
                ///////THIS IS TO GET THE INDIVIDUAL SAVINGS BALANCE
                ///////////////THIS IS TO SUM ALL SAVINGS
            $sum_savings = mysqli_query($connect, "SELECT SUM(savings) as total FROM weekly_allloan WHERE name = '$name' AND codename = '$codename'");      
              while  ($row = mysqli_fetch_assoc($sum_savings)){
         $summation_savings = $row['total']; 
//               $plus_interest = $row['interest'];  
              }
                 
                            
                ////////////THIS IS TO SUM ALLWITHDRAWALS
        $sum_withdraw = mysqli_query($connect, "SELECT SUM(withdrawsavings) as total FROM weekly_allloan WHERE name = '$name' AND codename = '$codename'");      
         while  ($row1 = mysqli_fetch_assoc($sum_withdraw)){
         $summation_withdraw = $row1['total'];                          
         }
              
              $savings_balance =  $summation_savings - $summation_withdraw;
              
              
        //  *******************************************************************************************************                
       
           
              
                //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@                
              ///////THIS IS TO GET THE INDIVIDUAL EQUITY
                ///////////////THIS IS TO SUM ALL SAVINGS
            $sum_savings1 = mysqli_query($connect, "SELECT SUM(equity) as total FROM weekly_allloan WHERE name = '$name' AND codename = '$codename'");      
              while  ($row = mysqli_fetch_assoc($sum_savings1)){
         $summation_equi1 = $row['total']; 
//               $plus_interest = $row['interest'];  
              }
                 
                            
                ////////////THIS IS TO SUM ALLWITHDRAWALS
        $sum_withdraw1 = mysqli_query($connect, "SELECT SUM(withdrawequity) as total FROM weekly_allloan WHERE name = '$name' AND codename = '$codename'");      
         while  ($row1 = mysqli_fetch_assoc($sum_withdraw1)){
         $summation_equi2 = $row1['total'];                          
         }
              
              $equity_balance =  $summation_equi1 - $summation_equi2;
              
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@                
         
              
              
              
              
              
              
           
           
           
           
           
           
           
           
//            $_SESSION['av_bal']= $available_blance;FOR AJAX
            echo '<input type="hidden" value='. $available_blance .' id="av_bal"/>'; 
        echo '<div class="col-sm-3">';
        echo "<label style='font-size: 18px; font-weight: bold;'>Balance: N ".number_format($available_blance)."</label>";
         echo '<form name="loan" action="loan_statement" method="POST" enctype="multipart/form-data">';
           
         
                   //////GET THE TOTAL PENALTY AWARDED 
                 $total_disburse4 = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM weekly_allloan WHERE (remarks = 'penalty' OR reversepen = 'penalty reverse') AND codename = '$codename' ");      
      while  ($row4 = mysqli_fetch_array($total_disburse4)){
                $summation_penalty = $row4['total'];                          
           }
           
           
              //////GET THE TOTAL MINUS PENALTY REVERSE 
                 $total_disburse5 = mysqli_query($connect, "SELECT SUM(repay) as total FROM weekly_allloan WHERE reversepen = 'penalty reverse' AND codename = '$codename' ");      
      while  ($row4 = mysqli_fetch_array($total_disburse5)){
                $summation_penalty_reverse = $row4['total'];                          
           }
                   
             $true_penalty =  $summation_penalty - $summation_penalty_reverse;
           
         echo "<label style='font-size: 18px; font-weight: bold;'>Total Penalty Awarded: <input type='text' id='perc_java' value='". number_format($true_penalty) ."' style='color: red; font-weight: bold;' placeholder='None' readonly='true' name='penalty'/></label>";
        echo "<label style='font-size: 18px; font-weight: bold;'>Savings: N ".number_format($savings_balance)."</label><br>";
       echo "<label style='font-size: 18px; font-weight: bold;'>Equity: N ".number_format($equity_balance)."</label>";
       
         echo '</form>';
    
        echo "</div>";
         
        echo '<div class="col-sm-1">';
//        echo "<a class='btn' style='color: whitesmoke; background-color: green; margin-left: 25px;' href='weekly_payment?codename=" . $codename. " &name=" . $name. "'>Make Payments</a>";
//               echo "<br><a href='weekly_payment' style='color:blue;'>Click Here for Blank Payment Panel</a>";
     
         echo "</div>";
        
        echo '<div class="col-sm-3">';
          echo '<div  style="margin-left: 40px; width:140px; height:140px;">
            <img id="img" src="../'.$image.'" alt="THIS IS LOADS PHOTO"  style="border: 4px #99ff99 solid; width:140px; height:140px;" >
              </div>'; 
          echo "</div>";
           echo "</div>";
        
         echo "<br>";  
           
        $sql_state = "SELECT * FROM weekly_allloan WHERE codename = '$codename'";
            $result = mysqli_query($connect, $sql_state);
           
            
            echo '<div class="container-fluid">';
     echo  '<div class="table-responsive-sm ">' ;
                 echo '<CAPTION><h3 align="center" style="font-size:20px; color: black;"> Codename: ('.$codename.') - ACCOUNT STATEMENT. [WEEKLY]</h3></CAPTION>';
    echo '<table class="table table-bordered table-striped table-sm  table-hover " style="font-size:16px; margin-right: 200px;" align="center">';
    
     echo '<thead class="thead-dark">';
         echo '<tr align = "center">';
         echo '<th>S/N</th>';
         echo '<th>Date</th>'; 
          echo '<th>Savings</th>'; 
         echo '<th>Savings Withdrawal</th>'; 
         echo '<th>Savings Balance</th>';
       echo '<th>Equity</th>'; 
       echo '<th>Equity    Withdrawal</th>'; 
         echo '<th>Description</th>';
          echo '<th>Disbursement</th>';
          echo '<th>Interest</th>';
            echo '<th>Repayments</th>';  
            echo '<th>Repay Cummulative</th>';
              echo '<th>Balance</th>';
      
          echo '</tr>';   
            echo '</thead>';

    echo '<tbody class="text-nowrap" style="font-family: sans-serif; color:black ; font-weight:bold;">';
     while ($row=mysqli_fetch_array($result)){
              $_SESSION['district'] = $row['district'];  
          echo '<input type="hidden" value='. $_SESSION['district'] .' id="district"/>';
            echo "<tr align = 'center'>";
            echo "<td>" .$inc."</td>";
            echo "<td>" .$row['date']."</td>";
            echo "<td>" .$row['savings']."</td>";
            echo "<td>" .$row['withdrawsavings']."</td>";
            echo "<td>" .$row['indbalsavings']."</td>";
            echo "<td>" .$row['equity']."</td>";
            echo "<td>" .$row['withdrawequity']."</td>";
            echo "<td>" .$row['remarks']."</td>";
            $disburseloan_nointerest = $row['disburseloan'] - $row['interest'];
             echo "<td style='color: red;'>" .number_format($disburseloan_nointerest)."</td>";
             if($row['interest'] == 0){$color = "#e0d3d3";} else {$color = "red";}
                echo "<td style='color: ".$color.";'>" .number_format($row['interest'])."</td>";
              echo "<td style='color: green;'>" .number_format($row['repay'])."</td>";
               echo "<td>" .number_format($row['repaycumm'])."</td>";
             if($row['remarks'] == 'loan disbursement'){ $display = $row['disburseloan'];} else { $display = $row['indbalance'];} 
             echo "<td>" .number_format($display)."</td>";  
           
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
                 window.location = "weekly_debtors";
             }
          </script>
    </body>
</html>
