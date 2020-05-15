<?php
$active = 'lstudents';
include 'layout/header.php';

//get courses for level and department.
$getcourse = select("SELECT * FROM cmanagement WHERE depID='".$userDet['depID']."' AND lecID='".$userDet['lecID']."'");
if($getcourse){
    foreach($getcourse as $allcourserow){
    //get course details..
    $cnm = select("SELECT * FROM courses WHERE ciD='".$allcourserow['cID']."'");

}}
?>

<div class="my-3 my-md-5">
    <div class="container">
<!--        <div class="page-header">-->
<!--          <h1 class="page-title"> <i class="fe fe-users"></i>  Lecturers </h1>-->
<!--        </div>-->
        <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="table-responsive">
                    <table id="example" class="table table-hover table-outline table-vcenter text-nowrap card-table datatable">
                      <thead>
                        <tr>
                          <th><i class="fe fe-hash"></i>  ID</th>
                          <th><i class="fe fe-layers"></i> COURSE NAME</th>
                          <th><i class="fe fe-grid"></i> LEVEL</th>
                          <th class="text-center"><i class="fe fe-users"></i> NUM. OF STUDENTS</th>
<!--                          <th class="text-center"><i class="fa fa-cog"></i>  ACTION</th>-->
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          //get courses for level and department.
                $getcourse = select("SELECT * FROM cmanagement WHERE depID='".$userDet['depID']."' AND lecID='".$userDet['lecID']."'");
                if($getcourse){
                foreach($getcourse as $allcourserow){
                //get course details..
                $cnm = select("SELECT * FROM courses WHERE ciD='".$allcourserow['cID']."'");


                        foreach($cnm as $cnmrow){
                    //get number of students with course level..
                $numofstudenet = select("SELECT * FROM student WHERE level='".$cnmrow['level']."' AND depID='".$cnmrow['depID']."'");
                            $num = count($numofstudenet);
                          ?>
                          <tr>
                                <td><?php echo $cnmrow['cID'];?></td>
                                <td><?php echo $cnmrow['courseName'];?></td>
                                <td><?php echo $cnmrow['level'];?></td>
                                <td class="text-center"><?php echo $num;?></td>
<!--                                <td class="text-center"><a class="btn btn-primary btn-sm text-white">Details <i class="fe fe-file-text"></i></a></td>-->
                          </tr>
                          <?php }}}else{?>
                          <tr> <td colspan="4"> No Student Offers Any Courses Assigned To You.</td></tr>
                          <?php }?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>
<script>
function facdep(val){
// load the select option data into a div
    $('#loader').html("Please Wait...");
    $('#dept').load('load/lecdep.php?fid='+val, function(){
    $('#loader').html("");
   });
}
</script>
<?php include 'layout/footer.php'; ?>
