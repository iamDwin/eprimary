<?php
$active = 'lcourses';
include 'layout/header.php';
?>
<style>
    i{
        font-size: 120%;
    }
</style>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="row">
<?php

//get courses for level and department.
$getcourse = select("SELECT * FROM cmanagement WHERE depID='".$userDet['depID']."' AND lecID='".$userDet['lecID']."'");
if($getcourse){
    foreach($getcourse as $allcourserow){
    //get course details..
    $cnm = select("SELECT * FROM courses WHERE ciD='".$allcourserow['cID']."'");
    foreach($cnm as $cnmrow){

    //OUTLINE EXISTS...
    $soutline = select("SELECT * FROM outline WHERE cID='".$cnmrow['cID']."'");
        if($soutline){
            $outlinestat = "<i class='fe fe-check-square text-success'></i>";
        }else{
            $outlinestat = "<i class='fe fe-x-square text-danger'></i>";
        }

    //REQUIRED EXISTS...
    $soutline = select("SELECT * FROM reqreading WHERE cID='".$cnmrow['cID']."'");
        if($soutline){
            $reqstat = "<i class='fe fe-check-square text-success'></i>";
        }else{
            $reqstat = "<i class='fe fe-x-square text-danger'></i>";
        }

    //LECTURER EXISTS...
    $soutline = select("SELECT * FROM lecture WHERE cID='".$cnmrow['cID']."'");
        if($soutline){
            $lecstat = "<i class='fe fe-check-square text-success'></i>";
        }else{
            $lecstat = "<i class='fe fe-x-square text-danger'></i>";
        }
?>

<a href="lcourse-manage?cid=<?php echo $cnmrow['cID'];?>">
  <div class="col-sm-6 col-lg-3">
    <div class="card p-3">
      <div class="d-flex align-items-center">
        <span class="stamp stamp-md bg-red mr-3" style="height:80px; line-height:80px;">
          <i class="fe fe-layers"></i>
        </span>
        <div>
          <h5 class="m-0"><a href="./lcourse-manage?cid=<?php echo $cnmrow['cID'];?>"><?php echo strtoupper($cnmrow['courseName']);?></a></h5>
            <small class="text-muted">OUTLINE : <?php echo $outlinestat; ?></small><br>
            <small class="text-muted">REQUIRED : <?php echo $reqstat; ?></small><br>
            <small class="text-muted">LECTURES : <?php echo $lecstat; ?></small>
        </div>
      </div>
    </div>
  </div>
</a>
<?php }}}else{?>
    <div class="page-header">
          <h1 class="page-title">
            NO COURSE ASSIGNED.
          </h1>
        </div>
            <?php }?>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
