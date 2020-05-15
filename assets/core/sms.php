<?php
function clean($string){
    $firstchar = $string[0]; //get first digit of phone number
    $remaining = substr($string, -9); // get remaining 9 digits
    $replacenum = str_replace('0','233', $firstchar); //replace first digit with 233
    $number = $replacenum.$remaining; //concatenate new number for sms
    return $number;
}

//SMS to student when approved
function sendsmsme($tel,$body){
$username = 'iamDwin';
//$password = 'x6G0U6K7';
$password = 'tycles95';
$message = $body;
$from = "ELEARNING";//your senderid example "kwamena"max is 11 chars;
$baseurl = "http://isms.wigalsolutions.com/ismsweb/sendmsg/";

//All numbers must have a country code. delimit them with comma(,)
$to = $tel;
$params = "username=".$username."&password=".$password."&from=".$from."&to=".$to."&message=".$message ;

//send the message
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$baseurl);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
$return = curl_exec($ch);
curl_close($ch);

$send = explode(" :: ",$return);
if(stristr($send[0],"SUCCESS") != FALSE){
//echo "message sent";
}else{
//echo "message could not be sent";
}
}


//SMS to student when approved
function sendmessage($tel,$body){
    $username = 'iamDwin';
    //$password = 'x6G0U6K7';
    $password = 'tycles95';
    $message = $body;
    $from = "ELEARNING";//your senderid example "kwamena"max is 11 chars;
    $baseurl = "http://isms.wigalsolutions.com/ismsweb/sendmsg/";

    //All numbers must have a country code. delimit them with comma(,)
    $to = $tel;
    $params = "username=".$username."&password=".$password."&from=".$from."&to=".$to."&message=".$message ;

    //send the message
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$baseurl);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_POST,1);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
    $return = curl_exec($ch);
    curl_close($ch);

    $send = explode(" :: ",$return);
    if(stristr($send[0],"SUCCESS") != FALSE){
        echo "message sent";
    }else{
        echo "message could not be sent";
    }
}


?>
