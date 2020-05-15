<?php
$active = 'hreports';
include 'layout/header.php';
$_SESSION['current_page']=$_SERVER['REQUEST_URI'];

//get DEPARTMENT ID AND DETAILS..
$getDep = select("SELECT * FROM department WHERE depID='".$userDet['depID']."'");
foreach($getDep as $depdet){}

//get number of lecturers...
$getlec = select("SELECT * FROM lecturer WHERE depID='".$userDet['depID']."'");

//get number of students...
//$getstNum = count(select("SELECT * FROM student WHERE depID='".$userDet['depID']."'"));

//get number of courses...
//$getcrsNum = count(select("SELECT * FROM courses WHERE depID='".$userDet['depID']."'"));


?>

<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
        <h1 class="page-title"> <?php echo strtoupper($depdet['departmentName']);?> LECTURERS REPORT</h1>
        </div>
        <div class="row">
              <div class="col-sm-12">
            <?php if($success){ ?>
                  <div class="alert alert-icon alert-success" role="alert">
                      <button type="button" class="close" data-dismiss="alert"></button>
                      <i class="fe fe-check mr-2" aria-hidden="true"></i> <?php echo $success; ?>
                    </div>
                <?php } if($error){ ?>
                    <div class="alert alert-icon alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert"></button>
                      <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> <?php echo $error;?>
                    </div>
                <?php } ?>
                <div class="card">
                  <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                            <th class="text-bold"> <i class="fe fe-hash"></i> ID</th>
                            <th class="text-bold"> <i class="fe fe-user"></i> FULL NAME</th>
                            <th class="text-bold"> <i class="fe fe-user"></i> POSITION</th>
                            <th class="text-bold"> <i class="fe fe-layers"></i> ASSIGNED COURSES</th>
                        </thead>
                        <tbody>
                            <?php
                            if($getlec){
                                foreach($getlec as $lecDet){
                                    //GET NUMBER OF ASSIGNED COURSES..
                                    $getnumcourse = count(select("SELECT * FROM cmanagement WHERE lecID='".$lecDet['lecID']."'"));
                            ?>
                            <tr>
                                <td><?php echo $lecDet['lecID'];?></td>
                                <td><?php echo $lecDet['firstName']." ".$lecDet['otherName']." ".$lecDet['lastName'];?></td>
                                <td><?php echo strtoupper($lecDet['position']); ?></td>
                                <td><?php echo $getnumcourse; ?></td>
                            </tr>
                            <?php }}?>
                        </tbody>
                        <tfoot style="border-top:1px solid #eee;">
                            <tr>
<!--
                                <td><a class="btn btn-primary btn-block" href="javascript:history.back()">
                                    <i class="fe fe-arrow-left mr-2"></i>Go back
                                </a></td>
                                <td colspan="6"></td>
-->
                            </tr>
                        </tfoot>
                    </table>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
