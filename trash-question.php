<?php
include 'assets/core/connection.php';

if(isset($_GET['qid'])){
    $qid = $_GET['qid'];
    $tid = $_GET['tid'];
}

//delete question from objtest table..
$trash = delete("DELETE FROM objtest WHERE qid='$qid' AND testID='$tid'");
if($trash){
        echo "<script>alert('QUESTION TRASHED.!');</script>";
     header("Location:". $_SESSION['current_page']);
}else{
    echo "<script>alert('TRASHING FAILED, TRY AGAIN.');</script>";
     header("Location:". $_SESSION['current_page']);
}

?>
