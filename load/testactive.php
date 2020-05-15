<?php
include '../assets/core/connection.php';
//$department = new Department();

if(isset($_GET['level'])){
  $level = $_GET['level'];
}

$active = select("SELECT * FROM test WHERE status='active' AND level='$level'");
if($active){
    foreach($active as $activedet){
        $getcoursedet = select("SELECT * FROM courses WHERE cID='".$activedet['cID']."'");
        foreach($getcoursedet as $cName){
            echo "<script>alert('TEST ACTIVE');</script>";
        }
    }

}
?>
