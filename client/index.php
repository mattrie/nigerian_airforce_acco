<?php
session_start();
    include 'connection.php';
    ?>
  <?php
  
       if(isset($_GET['iddd'])){
              $id=$_GET['iddd'];
          $name = $_GET['name'];
                   
    $query = "DELETE FROM allloan WHERE id = '$id'"; 
    $result23 = mysqli_query($connect, $query);  
    
    //       *********************************||||||||||||||||****************************************************            
                      $summation5 =  $summation6 = "";
                   ///////////THIS IS TO SUM TOTAL monthly_disburseloan///////////////////
                        $total_monthly_disburseloan = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM monthly_allloan WHERE name='$name'");      
                          while  ($row = mysqli_fetch_array($total_monthly_disburseloan)){
                          $summation5 = $row['total'];                          
                          }
                            
      ////////////THIS IS TO TOTAL monthly_payment
                            $total_monthly_payment = mysqli_query($connect, "SELECT SUM(repay) as total FROM monthly_allloan WHERE name='$name'");      
                          while  ($row1 = mysqli_fetch_array($total_monthly_payment)){
                          $summation6 = $row1['total'];                          
                          }
                          //////////////////////////////////////////
                       @$monthly_status =  $summation5 - $summation6;


                       
      //       *********************************||||||||||||||||****************************************************            
                      $summation1 =  $summation2 =  $summation3 =  $summation4 = "";
                   ///////////THIS IS TO SUM TOTAL daily_disburseloan///////////////////
                        $total_daily_disburseloan = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM allloan WHERE name='$name'");      
                          while  ($row = mysqli_fetch_array($total_daily_disburseloan)){
                          $summation1 = $row['total'];                          
                          }
                            
      ////////////THIS IS TO TOTAL daily_payment
                            $total_daily_payment = mysqli_query($connect, "SELECT SUM(repay) as total FROM allloan WHERE name='$name'");      
                          while  ($row1 = mysqli_fetch_array($total_daily_payment)){
                          $summation2 = $row1['total'];                          
                          }
                          //////////////////////////////////////////
                       @$daily_status =  $summation1 - $summation2;

/////======================================================================


  ///////THIS IS TO SUM TOTAL weekly_disburseloan///////////////////
                        $total_weekly_disburseloan = mysqli_query($connect, "SELECT SUM(disburseloan) as total FROM weekly_allloan WHERE name='$name'");      
                          while  ($row = mysqli_fetch_array($total_weekly_disburseloan)){
                          $summation3 = $row['total'];                          
                          }
                            
      ////////////THIS IS TO TOTAL weekly_payment
                      $total_weekly_payment = mysqli_query($connect, "SELECT SUM(repay) as total FROM weekly_allloan WHERE name='$name'");      
                          while  ($row1 = mysqli_fetch_array($total_weekly_payment)){
                          $summation4 = $row1['total'];                          
                          }
                          //////////////////////////////////////////
                       @$weekly_status =  $summation3 - $summation4;

                   @$total_status =  $daily_status + $weekly_status + $monthly_status;   
      //UPDATE RECORD
      $sql_statement101 = "UPDATE members SET balance = '$total_status' WHERE namee='$name'";
                     $result29 = mysqli_query($connect, $sql_statement101); 
 //       **************************||||||||||||||||***********************************************            
              

    echo "<script>alert('Transaction Deleted!!!')</script>";
//             header("location: weekly_debtors");
          }  
          
      
       
       
       
       
            if(isset($_POST['btnsrch'])){
                $names1 = "";
               $get_code = $_POST['telephone']; 
                $sql_state1 = "SELECT * FROM allloan WHERE  disburseloan > 1 AND remarks = 'loan disbursement' AND codename = '$get_code'";
            $result1 = mysqli_query($connect, $sql_state1);
      
            while ($row = mysqli_fetch_assoc($result1)) {  
                $names1 = $row["name"];
              $closingdate = $row["enddate"];
              $loan_type = $row["type"];
              $disburseloan = $row["indbalance"];
              $check_codename = $row["codename"];
              $interest = $row["interest"]; 
            }
            
             if($names1 != ""){
                      
//          header("location:loan_statement_domain?codename=". $get_code."&name=".$names1.""); 
         echo  "<script> location.href = 'loan_statement_domain?codename=$get_code&name=$names1'; </script>";     
       
                } 
               
                
                
                
                
                
                ////////FOR WEEKLY
          $names2 = ""; 
               $get_code2 = $_POST['telephone']; 
                $sql_state2 = "SELECT * FROM weekly_allloan WHERE  disburseloan > 1 AND remarks = 'loan disbursement' AND codename = '$get_code2'";
            $result2 = mysqli_query($connect, $sql_state2);
      
                        while ($row = mysqli_fetch_assoc($result2)) {  
                            $names2 = $row["name"];
                          $closingdate = $row["enddate"];
                            

                        }
                   if($names2 != ""){
//                      header("location:weekly_loan_statement_domain?codename=".$get_code2."&name=".$names2."");  
                echo  "<script> location.href = 'weekly_loan_statement_domain?codename=$get_code2&name=$names2'; </script>";     
     
                      }
                
                
                
                
                
             ////FOR MONTHLY
              $names3 = "";
               $get_code3 = $_POST['telephone']; 
                $sql_state3 = "SELECT * FROM monthly_allloan WHERE disburseloan > 1 AND remarks = 'loan disbursement' AND codename = '$get_code3'";
            $result3 = mysqli_query($connect, $sql_state3);
      
            while ($row = mysqli_fetch_assoc($result3)) {  
                $names3 = $row["name"];
              $closingdate = $row["enddate"];
              $loan_type = $row["type"];
              $disburseloan = $row["indbalance"];
              $check_codename = $row["codename"];
              $interest = $row["interest"]; 
             }
            
             if($names3 != ""){
                      
//          header("location:monthly_loan_statement_domain?codename=".$get_code3."&name=".$names3."");   
            echo  "<script> location.href = 'monthly_loan_statement_domain?codename=$get_code3&name=$names3'; </script>";     
         
          }    
                
                
                
            
                
            ////FOR INVESTORS
              $names4 = "";
               $get_code4 = $_POST['telephone']; 
                $sql_state4 = "SELECT * FROM investment WHERE remarks = 'Investment deposited' AND codename = '$get_code4'";
            $result4 = mysqli_query($connect, $sql_state4);
      
            while ($row = mysqli_fetch_assoc($result4)) {  
                $names4 = $row["name"];
             
             }
            
             if($names4 != ""){
                      
//          header("location:investors_statement_domain?codename=".$get_code4."&name=".$names4."");   
          echo  "<script> location.href = 'investors_statement_domain?codename=$get_code4&name=$names4'; </script>";     
         
                }         
                
                
            
                ////FOR CONTRIBUTION
              $names5 = "";
               $get_code5 = $_POST['telephone']; 
                $sql_state5 = "SELECT * FROM members WHERE save_balance > 1 AND namee = '$get_code5'";
            $result5 = mysqli_query($connect, $sql_state5);
      
            while ($row = mysqli_fetch_assoc($result5)) {  
                $names5 = $row["namee"];
            
             
             }
             
            
              
             if($names5 != ""){
                      
//          header("location:contribution_statement_domain?name=".$names5."");  
          echo  "<script> location.href = 'contribution_statement_domain?name=$names5'; </script>";     
         
                } 
                
                
           
                
            if($names1 == "" && $names2 == "" && $names3 == ""){
                echo "<script>alert('Wrong Code or Name inserted!!. Recheck and insert again. Thank You.')</script>";
            }
                
          }
      
      
//    echo "<td ><a style='color: #ff9900;' href='loan_statement?codename=" . $row['codename']. "&name=".$row['name']."&type=".$row['type']."'>View details</a></td>";
         
            
            ?>
<script>
	window.location = 'index.php';
</script>
<!DOCTYPE html>
 

<html>
    <head>
        <title>CLIENT CODE ENTRY</title> <meta content="width=device-width, initial-scale=1.0" name="viewport">
        
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
    <center class="heading"><div class="trans fixed-top" style="background-color:#ff5d0f; font-size: 22px; color: black;"><b><a href="https://NAFinvestment.ng" style="color: black;">NAF</a></b></div></center>
    
     <hr style="color: red; height: 3px; margin-top: 0.5px"/>
        <!--<button id="back" onclick="goBack()" style="padding: 4px; margin-bottom:  0px;  border-radius: 8px; font-size: 16px; background-color: black; color: whitesmoke; border: 2px solid white; cursor: pointer;"><<|Back|</button>-->
         
        
        
        <div class="container-fluid ">
            
            
            <center>
                  <br>
             
                   
                         
                  <form action="" method="POST" enctype="multipart/form-data" style="margin-top: 200px;">
        
      <input type="text" style="font-size: 18px; border-radius: 4px;"   name="telephone" placeholder="Enter Codename Here" required=""  autofocus="true">
      <button class="btn btn-warning" id="btnsearch" name="btnsrch" type="submit">SEARCH</button>  
      </form> 
   
    <!--THIS IS TO SEARCH GROUP NAME-->
<!--    <form action=" " method="POST" enctype="multipart/form-data" >
    <input type="text"  id="group_name" name="group_name" style="margin-left: 50px;" placeholder="Enter Group Password Here" required=""  >
    <button  class="btn btn-primary"  id="group_na" >SEARCH</button>  -->
   <!--</form>-->
 
<!--        </form>  -->
     
                
            </center>
          
       <!--DISPLAY ARENA-->
      
       <div class="row ">  
            <div  class="col">  
            </div>
           
           
           
           
           <div  class="col" id="dispay_db">    
             
           </div>
        
       
        
       
       
       
          
        
       </div> 
      
          --
          <script type='text/javascript' >
    $( function() {
        $( ".autocomplete_staff" ).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: "autocomplete_staff",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function (event, ui) {
                $('.autocomplete_staff').val(ui.item.label); // display the selected text
                $('.selectuser_id').val(ui.item.value); // save selected id to input
                return false;
            }
        });
     });   
    </script>   
    
    
    
    
    
    
    
    
        <script type='text/javascript' >
    $( function() {
        $( ".autocomplete_staff1" ).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: "autocomplete_staff",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function (event, ui) {
                $('.autocomplete_staff1').val(ui.item.label); // display the selected text
                $('.selectuser_id').val(ui.item.value); // save selected id to input
                return false;
            }
        });
     });   
    </script>   
       
         
                  <!--ON LOAD DISPLAY ALL-->
<!--          <script>
             if (window.XMLHttpRequest)
                  {// code for IE7+, Firefox, Chrome, Opera, Safari
                  xmlhttp=new XMLHttpRequest();
                  }
                else
                  {// code for IE6, IE5
                  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                  }        
                   
                   xmlhttp.open("GET","debtor_magic",true);
                                 xmlhttp.send();                
                                 xmlhttp.onreadystatechange = function(){                                   
                      if(xmlhttp.readyState ===4 && xmlhttp.status===200) {
                 document.getElementById("dispay_db").innerHTML = xmlhttp.responseText;;
                                }
                        };
                 
                    
            
        </script>-->
        
        
        
                          <!--THIS IS TO DISPLAY SELECTED CLASS -->
          <script>
               $(document).ready(function() {
               var select_class = $(".select_class"); //THIS IS TO DISPLAY SELECTED CLASS   
    $(select_class).click(function(e){ //THIS IS TO DISPLAY SELECTED CLASS
        e.preventDefault();
        var getclass = document.getElementById('cla').value;
        
             if (window.XMLHttpRequest)
                  {// code for IE7+, Firefox, Chrome, Opera, Safari
                  xmlhttp=new XMLHttpRequest();
                  }
                else
                  {// code for IE6, IE5
                  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                  }        
                 
                 if(getclass === ""){
                     
                     alert("Please select district")
                 }
                 
                 else{
                   xmlhttp.open("GET","debtor_magic22?district="+getclass,true);
                                 xmlhttp.send();                
                                 xmlhttp.onreadystatechange = function(){                                   
                      if(xmlhttp.readyState ===4 && xmlhttp.status===200) {
                 document.getElementById("dispay_db").innerHTML = xmlhttp.responseText;;
                                }
                        };
                    
                        
                document.getElementById('cla').value = ""; 
                         }   
                    });  
                    
                    
                    
                    
                        var print_page = $(".print_me");
                        $(print_page).click(function(e){ //Function LINK TO PRINT
                  e.preventDefault();
                                window.print();
                             });         
           });     
            
        </script>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
         <!--THIS IS TO DISPLAY DISTRICT -->
          <script>
               $(document).ready(function() {
        
        ////////////////////SELECT TIME MONTH////////////////////////////////////////
        var select_time = $(".select_time"); //THIS IS TO DISPLAY SELECTED CLASS   
    $(select_time).click(function(e){ //THIS IS TO DISPLAY SELECTED CLASS
        e.preventDefault();
        var evaluation = document.getElementById('evaluation').value;
        var getmonth = document.getElementById('month').value;
        var getyear = document.getElementById('year').value;
        
             if (window.XMLHttpRequest)
                  {// code for IE7+, Firefox, Chrome, Opera, Safari
                  xmlhttp=new XMLHttpRequest();
                  }
                else
                  {// code for IE6, IE5
                  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                  }        
               
        if (getmonth==="" || getyear===""){ 
                alert("You must fill month and year to search");
            }else{
                   xmlhttp.open("GET","debtor_month?month="+getmonth+"&year="+getyear+"&evaluation="+evaluation,true);
                                 xmlhttp.send();                
                                 xmlhttp.onreadystatechange = function(){                                   
                      if(xmlhttp.readyState ===4 && xmlhttp.status===200) {
                 document.getElementById("dispay_db").innerHTML = xmlhttp.responseText;;
//               window.location = "statement_time";
                           
                                    }
                                };
                    
                            }          
              
                          
                        });  
                    
        
        
       
       
       
       
           ////////////////////SELECT TIME YEAR////////////////////////////////////////
        var select_year = $(".select_year"); //THIS IS TO DISPLAY SELECTED CLASS   
    $(select_year).click(function(e){ //THIS IS TO DISPLAY SELECTED CLASS
        e.preventDefault();
          var evaluation1 = document.getElementById('evaluation1').value;
        var getyear = document.getElementById('year_a').value;
        
             if (window.XMLHttpRequest)
                  {// code for IE7+, Firefox, Chrome, Opera, Safari
                  xmlhttp=new XMLHttpRequest();
                  }
                else
                  {// code for IE6, IE5
                  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                  }        
               
        if (getyear===""){ 
                alert("You must fill year to search");
            }else{
                   xmlhttp.open("GET","debtor_year?year="+getyear+"&evaluation1="+evaluation1,true);
                                 xmlhttp.send();                
                                 xmlhttp.onreadystatechange = function(){                                   
                      if(xmlhttp.readyState ===4 && xmlhttp.status===200) {
                 document.getElementById("dispay_db").innerHTML = xmlhttp.responseText;;
                         
                          }
                        };
                    
               }          
              
                          
                    });  
        
        
        
        
        
        
        
        
        
        
        
        
        
        
         ////////////////////SELECT TIME YEAR////////////////////////////////////////
        var group_na = $("#group_na"); //THIS IS TO DISPLAY SELECTED CLASS   
    $(group_na).click(function(e){ //THIS IS TO DISPLAY SELECTED CLASS
        e.preventDefault();
//            alert('WORKING');
        var group_pass = document.getElementById('group_name').value;
        
             if (window.XMLHttpRequest)
                  {// code for IE7+, Firefox, Chrome, Opera, Safari
                  xmlhttp=new XMLHttpRequest();
                  }
                else
                  {// code for IE6, IE5
                  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                  }        
               
        if (group_pass===""){ 
                alert("You must search for group first");
            }else{
                   xmlhttp.open("GET","group_domain_display?group="+group_pass,true);
                                 xmlhttp.send();                
                                 xmlhttp.onreadystatechange = function(){                                   
                      if(xmlhttp.readyState ===4 && xmlhttp.status===200) {
                       var check =  xmlhttp.responseText;
                          if(check === "Not Available"){
                       alert('Wrong Password inserted');       
                          } else {
                 document.getElementById("dispay_db").innerHTML = xmlhttp.responseText;;
                             }
                          }
                        };
                    
               }          
              
                          
                    });
        
        
        
        
        
        
        
        
        
        
                    
                        var print_page = $(".print_me");
                        $(print_page).click(function(e){ //Function LINK TO PRINT
                  e.preventDefault();
                                window.print();
                             });         
           });     
            
        </script>
        
        
        
        
        
        
        
        
        
        
        
         
         
                   <!--THIS IS TO RE-LOAD THE ENTIRE STUDENT-->
          <script>
         $(document).ready(function() {
               var show_all = $(".show_all"); //LINK TO GO AND VIEW ALL DEBTORS   
    $(show_all).click(function(e){ //Function LINK TO GO AND VIEW ALL DEBTORS button click
        e.preventDefault();
              window.location = "debtors";
            });
        });
          </script>   
          
          
          
          <script>
             function goBack() {
                 window.location = "admin_home";
             }
          </script>
          
          
          
                        <!--AUTO-COMPLETE-->
          <script type='text/javascript'>
    $( function() {
  
        $( "#autocomplete" ).autocomplete({
            source: function( request, response ) {
                
                $.ajax({
                    url: "district",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function (event, ui) {
                $('#autocomplete').val(ui.item.label); // display the selected text
                $('#selectuser_id').val(ui.item.value); // save selected id to input
                return false;
            }
        });
//        ==========================================================================
          $( "#codename" ).autocomplete({
            source: function( request, response ) {
                
                $.ajax({
                    url: "codename",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function (event, ui) {
                $('#codename').val(ui.item.label); // display the selected text
                $('#selectuser_id').val(ui.item.value); // save selected id to input
                return false;
            }
        });
        
        
        
        
         ////////////////////////////////////////////////////////////////////////////
          $( "#group_namee" ).autocomplete({
            source: function( request, response ) {
                
                $.ajax({
                    url: "group_name",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function (event, ui) {
                $('#group_name').val(ui.item.label); // display the selected text
              
                return false;
            }
        });
        
 ////////////////////////////////////////////////////////////////////////////////////////       
        $( ".autocomover" ).autocomplete({
            source: function( request, response ) {
                
                $.ajax({
//                    url: "autocomplete",
                    url: "district",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
      
            select: function (event, ui) {
                $('.autocomover').val(ui.item.label); // display the selected text
////                $('#selectuser_idd').val(ui.item.value);
                $('#text1').val(ui.item.value);                
////                console.log("this.value: " + this.value);
                $('#text1').trigger('change');
                

            }
            
       
  });
            
          
        
        
        ////////////////////////////////////////////////////////////////////////////////////////       
        $( ".class_d" ).autocomplete({
            source: function( request, response ) {
                $.ajax({

                    url: "district",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
//                         response(results.slice(0, 10));
                        
                    }
                });
            },
      
            select: function (event, ui) {
                $('.class_d').val(ui.item.label); // display the selected text
                $('#selectuser_idd').val(ui.item.value);
//                $('#text1').val(ui.item.value);                
//////                console.log("this.value: " + this.value);
//                $('#text1').trigger('change');
//                

            }
            
       
  });
        
        
        
            
            
        
///////////////////////////////////////////////////////////////////////////////////////////
        // Multiple select
        $( "#multi_autocomplete" ).autocomplete({
            source: function( request, response ) {
                
                var searchText = extractLast(request.term);
                $.ajax({
                    url: "autocomplete",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: searchText
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function( event, ui ) {
                var terms = split( $('#multi_autocomplete').val() );
                
                terms.pop();
                
                terms.push( ui.item.label );
                
                terms.push( "" );
                $('#multi_autocomplete').val(terms.join( ", " ));

                // Id
                var terms = split( $('#selectuser_ids').val() );
                
                terms.pop();
                
                terms.push( ui.item.value );
                
                terms.push( "" );
                $('#selectuser_ids').val(terms.join( ", " ));

                return false;
            }
           
        });
    });

    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }

    </script> 
          
          
       </div> 
     <footer style="bottom: 0; left: 0; right: 0; position: fixed; background-color: #ff5d0f; color: black; font-size: 22px; font-weight: bold;">
         <marquee>Please enter your correct code name to view transaction details. NAF *SAVINGS & LOAN* <label style="font-style: italic;">always there for you!!!</label> &copy;<?php echo date("Y")?>. By EasyMaster.</marquee>
        
     </footer>
      <!--<center style="font-size: 16px; color: #333333; "></center>-->
     
    </body>
</html>
