<?php
$active = 'hreports';
include 'layout/header.php';

//get DEPARTMENT ID AND DETAILS..
$getDep = select("SELECT * FROM department WHERE depID='".$userDet['depID']."'");
foreach($getDep as $depdet){}

?>

<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
        <h1 class="page-title"> <?php echo strtoupper($depdet['departmentName']);?> STUDENT REPORT</h1>
        </div>
        <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="table-responsive">
                    <table id="example" class="table table-hover table-outline table-vcenter text-nowrap card-table datatable">
                      <thead>
                        <tr>
                          <th><i class="fe fe-hash"></i>  ID</th>
                          <th class="text-center"><i class="fe fe-grid"></i> FULL NAME</th>
                          <th class="text-center"><i class="fe fe-file"></i> SCHOOL</th>
                          <th class="text-center"><i class="fe fe-bar-chart"></i> LEVEL</th>
<!--                          <th class="text-center"><i class="fa fa-cog"></i>  ACTION</th>-->
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $allstu = $student->find_studentdep($userDet['depID']);
                          if($allstu){
                              foreach($allstu as $sturow){
                          ?>
                        <tr>
                          <td> <div><?php echo $sturow['studentID'];?></div> </td>
                          <td class="text-center">
                              <?php echo $sturow['lastName']." ".$sturow['firstName']." ".$sturow['otherName'];?>
                          </td>
                          <td class="text-center"> <?php echo $sturow['school']; ?> </td>
                          <td class="text-center"> <?php echo $sturow['level']; ?> </td>
<!--
                          <td class="text-center">
                                <a href="./hupstudent?st=<? // echo $sturow['studentID'];?>" class="btn btn-primary text-white btn-sm">
                                    <i class="fe fe-file-text"></i> Details
                                </a>
                          </td>
-->
                        </tr>
                          <?php }}else{?>
                          <tr>
                            <td colspan="3"> No <i class="fe fe-users"></i> Student Registered.</td>
                          </tr>
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
