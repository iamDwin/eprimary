<?php
include 'assets/core/connection.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
//    $cid = $_GET['cid'];
}

//delete question from objtest table..
$trash = delete("DELETE FROM reqreading WHERE id='$id'");
if($trash){
        echo "<script>alert('TRASHED.!');</script>";
     header("Location:". $_SESSION['current_page']);
}else{
    echo "<script>alert('TRASHING FAILED, TRY AGAIN.');</script>";
     header("Location:". $_SESSION['current_page']);
}

?>
