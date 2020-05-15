<?php
include '../assets/core/connection.php';

if(isset($_GET['lecID'])){
    $lecID = $_GET['lecID'];
}

$selectlec = select("SELECT * FROM users WHERE userID='$lecID'");
foreach($selectlec as $lecrow){
    $online = $lecrow['onlinestatus'];
}

if($online == '1'){
?>
<span class="stamp stamp-md bg-green mr-3">
  <i class="fe fe-user"></i>
</span>

<!--
<span class="avatar">
 <i class="fe fe-user"></i> <span class="avatar-status bg-green"></span>
</span>
-->

<?php
}

if($online == '0'){
?>


<!--
<span class="avatar">
 <i class="fe fe-user"></i> <span class="avatar-status bg-red"></span>
</span>
-->

<span class="stamp stamp-md bg-red mr-3">
  <i class="fe fe-user"></i>
</span>
<?php } ?>
