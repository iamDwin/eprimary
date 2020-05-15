<?php
session_start();
date_default_timezone_set("Africa/Accra");
require "constants.php";

//connection
$host = DB_SERVER;
$username = DB_USER;
$password = DB_PASSWORD;
$dbname = DB_NAME;

try{
	$db = new PDO("mysql:host=localhost;dbname=$dbname", "$username", "$password");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
	echo 'ERROR: ' . $e->getMessage();
}

//select
function select($sql, $fetchMode = PDO::FETCH_ASSOC){
    global $db;
    $stmt = $db->prepare($sql);
    $ok = $stmt->execute();

    if(!$ok){
        return $ok;
    }
    return $stmt->fetchAll($fetchMode);
}

function query($sql){
    return select($sql);
}

//insert
function insert($sql){
    global $db;
    $stmt = $db->prepare($sql);
    return $stmt->execute();
}

//update
function update($sql){
    global $db;
    $stmt = $db->prepare($sql);
    return $stmt->execute();
 }

//delete
 function delete($sql){
    global $db;
    $stmt = $db->prepare($sql);
    return $stmt->execute();
 }

//function to encrypt the string
function encode5t($str){
    for($i=0;$i<5;$i++){
        $str = strrev(base64_encode($str));// apply base64 first and then reverse the string
    }
    return $str;
}

//function to decrypt the string
function decode5t($str){
    for($i=0;$i<5;$i++){
        $str = base64_decode(strrev($str));// apply base64 first and then reverse the string
    }
    return $str;
}

//folder creation
//function uploadDir($cid){
//    $sDirPath = './'.$cid.'/'; //Specified Pathname
//    if(!file_exists ($cid)){
//        mkdir($cid,0777,true);
//    }
//}

function make_dir($cid){
    $parent = 'uploads/';
   $the_dir = $parent.$cid;
   $media = $parent.$cid.'/media';
   $document = $parent.$cid.'/documents';
   $assignment = $parent.$cid.'/assignment';
    if (!file_exists ($the_dir)){
   @mkdir($the_dir, 0777, TRUE);
   @mkdir($media, 0777, TRUE);
   @mkdir($document, 0777, TRUE);
   @mkdir($assignment, 0777, TRUE);
    }
}

//generate time to go for courses and assigments....
function timeago($date){
    $timestamp = strtotime($date);

    $strTime = array("second", "minute", "hour", "day", "month", "year");
    $length = array("60", "60", "24", "30", "12", "10");

    $currentTime = time();
    if($currentTime >= $timestamp){
        $diff = time() - $timestamp;
        for($i=0; $diff >= $length[$i] && $i < count($length)-1; $i++){
            $diff = $diff / $length[$i];
        }

        $diff = round($diff);
        if($diff <= 1){
            return $diff." ".$strTime[$i]." ago";
        }else{
           return $diff." ".$strTime[$i]."s ago";
        }

    }
}

//Generate token...
function getToken($length){
 $token = "";
 $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
 $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
 $codeAlphabet.= "0123456789";
 $max = strlen($codeAlphabet); // edited

 for ($i=0; $i < $length; $i++) {
  $token .= $codeAlphabet[random_int(0, $max-1)];
 }

 return $token;
}

?>

<?php
include 'mail/gmail.php';
include 'classes.class.php';
include 'sms.php';
?>
