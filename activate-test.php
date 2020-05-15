<?php
include 'assets/core/connection.php';

if(isset($_GET['tid'])){
    $tid = $_GET['tid'];
    $cid = $_GET['cid'];
}

//check active course testss...
$alreadyActive = select("SELECT * FROM test WHERE cID='$cid' AND status='active'");
if($alreadyActive){
    foreach($alreadyActive as $activerow){}
    echo "<script>alert('TEST ".$activerow['testID']." IS ACTIVE, MULTIPLE ACTIVE TESTS NOT ALLOWED.');window.location.href='set-test?cid=$cid';</script>";
}else{
    //update test row..
    $activate = update("UPDATE test SET status='active' WHERE testID='$tid'");
    if($activate){
            echo "<script>alert('TEST ACTIVATED.!');window.location.href='set-test?cid=$cid';</script>";
//         header("Location:". $_SESSION['current_page']);
    }else{
        echo "<script>alert('TEST ACTIVATION FAILED.');window.location.href='set-test?cid=$cid';</script>";
//         header("Location:". $_SESSION['current_page']);
    }
}



?>
