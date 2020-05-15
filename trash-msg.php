<?php
include 'assets/core/connection.php';

if(isset($_GET['mid'])){
    $mid = $_GET['mid'];
}

//delete question from objtest table..
$trash = update("UPDATE messages SET status='trashed' WHERE mid='$mid'");
if($trash){
        echo "<script>alert('TRASHED.!');</script>";
     header("Location:". $_SESSION['current_page']);
}else{
    echo "<script>alert('TRASHING FAILED, TRY AGAIN.');</script>";
     header("Location:". $_SESSION['current_page']);
}

?>
