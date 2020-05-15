<?php
$active = 'scourses';
include 'layout/header.php';
?>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="row row-cards row-deck">
<?php

//get courses for level and department.
$getcourse = select("SELECT * FROM courses WHERE depID='".$userDet['depID']."' AND level='".$userDet['level']."'");
if($getcourse){
    foreach($getcourse as $allcourserow){

//get number of lectures..
$numlec = select("SELECT * FROM lecture WHERE cID='".$allcourserow['cID']."'");
$countnum = count($numlec);
?>

<a href="./scourses-det?cid=<?php echo $allcourserow['cID'];?>">
  <div class="col-sm-6 col-lg-3">
    <div class="card p-3">
      <div class="d-flex align-items-center">
        <span class="stamp stamp-md bg-blue mr-3">
          <i class="fe fe-layers"></i>
        </span>
        <div>
          <h5 class="m-0"><a href="./scourses-det?cid=<?php echo $allcourserow['cID'];?>"><?php echo $allcourserow['courseName'];?></a></h5>
            <small class="text-muted">LECTURES : <?php echo $countnum;?></small>
        </div>
      </div>
    </div>
  </div>
</a>
<?php }}?>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
