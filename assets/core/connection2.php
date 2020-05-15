<?php
date_default_timezone_set("Africa/Accra");
//	require "constants.php";
error_reporting(0);
//connection
//$host = DB_SERVER;
//$username = DB_USER;
//$password = DB_PASSWORD;
//$dbname = DB_NAME;

//connection
$host2 = DB_SERVER2;
$username2 = DB_USER2;
$password2 = DB_PASSWORD2;
$dbname2 = DB_NAME2;

try{

//	$db = new PDO("mysql:host=localhost;dbname=$dbname", "$username", "$password");
	$db2 = new PDO("mysql:host=$host2;dbname=$dbname2", "$username2", "$password2");
	$db2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//	$db2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e){
//	echo 'ERROR: ' . $e->getMessage();
	echo '<span style="color:red;"> ERROR: No INTERNET CONNECTION</span> <br>';
}

//select
 	function select2($sql, $fetchMode = PDO::FETCH_ASSOC){
        global $db2;

        $stmt = $db2->prepare($sql);

        $ok = $stmt->execute();

        if(!$ok){
            return $ok;
        }
        return $stmt->fetchAll($fetchMode);

     }

     function query2($sql){
        return select($sql);

     }

//insert
     function insert2($sql){
        global $db2;

        $stmt = $db2->prepare($sql);
        return $stmt->execute();

     }

//update
     function update2($sql){
        global $db2;

        $stmt = $db2->prepare($sql);
        return $stmt->execute();

     }

//delete
     function delete2($sql){
        global $db2;
        $stmt = $db2->prepare($sql);
        return $stmt->execute();

     }

//
////backup script
////select
// 	function select2($sql, $fetchMode = PDO::FETCH_ASSOC){
//        global $db2;
//
//        $stmt = $db2->prepare($sql);
//
//        $ok = $stmt->execute();
//
//        if(!$ok){
//            return $ok;
//        }
//        return $stmt->fetchAll($fetchMode);
//
//     }
//
//     function query2($sql){
//        return select2($sql);
//
//     }
//
////insert
//     function insert2($sql){
//        global $db2;
//
//        $stmt = $db2->prepare($sql);
//        return $stmt->execute();
//
//     }
//
////update
//     function update2($sql){
//        global $db2;
//
//        $stmt = $db2->prepare($sql);
//        return $stmt->execute();
//
//     }
//
////delete
//     function delete2($sql){
//        global $db2;
//        $stmt = $db2->prepare($sql);
//        return $stmt->execute();
//
//     }

?>

    <?php
//include 'mail_old/gmail.php';
//include 'classes.class.php';
//include 'sms_api.php';
//include 'sms.php';
?>
