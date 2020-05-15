<?php
include 'assets/core/connection.php';
if(!$_SESSION['email'] && !$_SESSION['password'] && !$_SESSION['access']){
    echo "<script>window.location.href='index'</script>";
}else{
    $getuser = select("SELECT * FROM users WHERE email='".$_SESSION['email']."'");
    foreach($getuser as $userDet){}
}

$faculty = new Faculty();
$fid = $_GET['fid'];

//check if departments registered under faculty..
$selectdep = select("SELECT * FROM department WHERE facID='$fid'");
if($selectdep){
    echo "<script>window.location.href='./faculty?fc=de';</script>";
}else{
   //delete faculty..
    $delfac = delete("DELETE FROM faculty WHERE facID='$fid'");
    if($delfac){
       echo "<script>window.location.href='./faculty?fc=fd';</script>";
    }else{
        echo "<script>window.location.href='./faculty?fc=df';</script>";
    }

}

?>
