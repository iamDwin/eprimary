<?php
include 'assets/core/connection.php';

if(isset($_GET['aid'])){
    $aid = $_GET['aid'];
    $cid = $_GET['cid'];
}

//check active course testss...
//$alreadyActive = select("SELECT * FROM assignment WHERE cID='$cid' AND status='active'");
//if($alreadyActive){
//    foreach($alreadyActive as $activerow){}
//    echo "<script>alert('ASSIGNMENT ".$activerow['asID']." IS ACTIVE, MULTIPLE ACTIVE TESTS NOT ALLOWED.');window.location.href='set-assignment?cid=$cid';</script>";
//}else{
    //update test row..
    $activate = update("UPDATE assignment SET status='active' WHERE asID='$aid'");
    if($activate){
            echo "<script>alert('ASSIGNMENT ACTIVATED.!');window.location.href='set-assignment?cid=$cid';</script>";
//         header("Location:". $_SESSION['current_page']);
    }else{
        echo "<script>alert('ASSIGNMENT ACTIVATION FAILED.');window.location.href='set-assignment?cid=$cid';</script>";
//         header("Location:". $_SESSION['current_page']);
    }
//}



?>
