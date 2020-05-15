<?php
include 'assets/core/connection.php';

if(isset($_GET['tid'])){
    $tid = $_GET['tid'];
    $cid = $_GET['cid'];
}


//update test row..
$deactivate = update("UPDATE test SET status='' WHERE testID='$tid'");
if($deactivate){

    //update student status..
    $activestudent = select("SELECT * FROM users WHERE userstatus='testactive'");
    if($activestudent){
        foreach($activestudent as $activerow){
            $updatestatus = update("UPDATE users SET userstatus='' WHERE userID='".$activerow['userID']."'");
        }
         echo "<script>alert('TEST DEACTIVATED.!');window.location.href='set-test?cid=$cid';</script>";
    }else{
        echo "<script>alert('TEST DEACTIVATED.!');window.location.href='set-test?cid=$cid';</script>";
    }

//     header("Location:". $_SESSION['current_page']);
}else{
    echo "<script>alert('TEST DEACTIVATION FAILED.');window.location.href='set-test?cid=$cid';</script>";
//     header("Location:". $_SESSION['current_page']);
}

?>
