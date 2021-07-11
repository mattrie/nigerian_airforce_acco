<?php  
    session_start();
           $naija_code = "+234";
           $phone1 = $naija_code . '09167725200';
           $name = "James Onurah";
           $next_due1 = "5th Sep 2024";
           $curl = curl_init();
           curl_setopt_array($curl, array(
               CURLOPT_URL => 'https://api.ng.termii.com/api/sms/send',
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => '',
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 0,
               CURLOPT_FOLLOWLOCATION => true,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => 'POST',
               CURLOPT_POSTFIELDS => ' {
         "to": "' . $phone1 . '",
          "from": "NAF",
           "sms": "'.$name.' has been successfully registered. The next due date for promotion is ' . $next_due1 . '.",
          "type": "plain",
          "channel": "generic",
          "api_key": "TL5jl5xbi29yHgC5o8svrV4dNliIeYYqg7zRRTbGZLSlFbT6HW2Iqd4MaWwNuJ"

      }',
               CURLOPT_HTTPHEADER => array(
                   'Content-Type: application/json'
               ),
           ));
           $response = curl_exec($curl);
           echo $response;
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  
</body>
</html>