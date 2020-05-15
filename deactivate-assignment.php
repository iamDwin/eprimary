<?php
include 'assets/core/connection.php';

if(isset($_GET['aid'])){
    $aid = $_GET['aid'];
    $cid = $_GET['cid'];
}

//update test row..
$deactivate = update("UPDATE assignment SET status='' WHERE asID='$aid'");
if($deactivate){
         echo "<script>alert('ASSIGNMENT DEACTIVATED.!');window.location.href='set-assignment?cid=$cid';</script>";
    }else{
        echo "<script>alert('ASSIGNMENT DEACTIVATION FAILED.');window.location.href='set-assignment?cid=$cid';</script>";
//     header("Location:". $_SESSION['current_page']);
}

?>
