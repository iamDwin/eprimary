<?php
include 'assets/core/connection.php';

if(isset($_GET['aid'])){
    $aid = $_GET['aid'];
}

//delete question from objtest table..
$trash = delete("DELETE FROM assignment WHERE asID='$aid'");
if($trash){
        echo "<script>alert('ASSIGNMENT TRASHED.!');</script>";
     header("Location:". $_SESSION['current_page']);
}else{
    echo "<script>alert('TRASHING FAILED, TRY AGAIN.');</script>";
     header("Location:". $_SESSION['current_page']);
}

?>
