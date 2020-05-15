<?php
include 'assets/core/connection.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $type = $_GET['type'];
}


if($type == '1'){
    //delete question from objtest table..
    $trash = delete("DELETE FROM cdocument WHERE id='$id'");
    if($trash){
            echo "<script>alert('TRASHED.!');</script>";
         header("Location:". $_SESSION['current_page']);
    }else{
        echo "<script>alert('TRASHING FAILED, TRY AGAIN.');</script>";
         header("Location:". $_SESSION['current_page']);
    }
}


if($type == '2'){
    //delete question from objtest table..
    $trash = delete("DELETE FROM cmedia WHERE id='$id'");
    if($trash){
            echo "<script>alert('TRASHED.!');</script>";
         header("Location:". $_SESSION['current_page']);
    }else{
        echo "<script>alert('TRASHING FAILED, TRY AGAIN.');</script>";
         header("Location:". $_SESSION['current_page']);
    }
}


?>
