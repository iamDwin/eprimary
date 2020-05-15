<?php

$active = 'hlecturers';
$active = 'lecturers';

include 'layout/header.php';

if(isset($_GET['lc'])){
    $lc = $_GET['lc'];
}

$findlec = $lecturer->find_by_lecID($lc);
if($findlec){
    foreach($findlec as $lecDet){}
    $findfacName = select("SELECT * FROM faculty WHERE facID='".$lecDet['facID']."'");
    foreach($findfacName as $facnmrow){}
    $findDepName = select("SELECT * FROM department WHERE depID='".$lecDet['depID']."'");
    foreach($findDepName as $dpnmrow){}
}

if(isset($_POST['reglect'])){
    $lecID = trim(htmlspecialchars($_POST['lecID']));
    $firstName = trim(htmlspecialchars($_POST['firstName']));
    $lastName = trim(htmlspecialchars($_POST['lastName']));
    $otherName = trim(htmlspecialchars($_POST['otherName']));
    $email = trim(htmlspecialchars($_POST['email']));
    $phone = trim(htmlspecialchars($_POST['phone']));
    $position = trim(htmlspecialchars($_POST['staffcat']));
    $facID = trim(htmlspecialchars($_POST['facID']));
    $depID = trim(htmlspecialchars($_POST['depID']));

    $chekPhone = $lecturer->checkphone($phone);

    $UPLec = $lecturer->updatelec($lecID,$facID,$depID,$firstName,$lastName,$otherName,$email,$phone,$position);
    if($UPLec){
        $success = "<script>document.write('LECTURER UPDATE SUCCESSFUL.');window.location.href='mlecturers';</script>";
    }else{
        $error = "<script>document.write('LECTURER UPDATE FAILED, TRY AGAIN.');</script>";
    }

}
?>

<div class="my-3 my-md-5">
    <div class="container">
<!--        <div class="page-header">-->
<!--          <h1 class="page-title"> <i class="fe fe-users"></i>  Lecturers </h1>-->
<!--        </div>-->
        <div class="row">
            <div class="col-md-6">
            <div class="card">
<!--
                <div class="card-header">
                  <h3 class="card-title"><i class="fe fe-user-plus"></i> Register Lecturer</h3>
                </div>
-->
                <div class="card-body">
                  <form class="form" method="post" enctype="multipart/form-data" onsubmit="return confirm('CONFIRM UPDATE.');" >
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="input-icon">
                                <span class="input-icon-addon"><i class="fe fe-hash"></i><span class="form-required">*</span></span>
                                <input type="text" name="lecID" class="form-control" value="<?php echo $lc;?>" readonly>
                            </div>
                          </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                <div class="input-icon">
                                    <span class="input-icon-addon"><i class="fe fe-user"></i><span class="form-required">*</span></span>
                                <input type="text" name="firstName" class="form-control" value="<?php echo $lecDet['firstName'];?>" required >
                                </div>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                        <div class="input-icon">
                            <span class="input-icon-addon"><i class="fe fe-user"></i><span class="form-required">*</span></span>
                            <input type="text" name="lastName" class="form-control" value="<?php echo $lecDet['lastName'];?>" required >
                        </div>
                      </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                <div class="input-icon">
                                    <span class="input-icon-addon"><i class="fe fe-user"></i></span>
                                    <input type="text" name="otherName" class="form-control" value="<?php echo $lecDet['otherName'];?>">
                                </div>
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                        <div class="input-icon">
                            <span class="input-icon-addon"><i class="fe fe-mail"></i><span class="form-required">*</span></span>
                            <input type="email" name="email" class="form-control" value="<?php echo $lecDet['email'];?>" required>
                        </div>
                      </div>

                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label"><i class="fe fe-phone"></i> Active Phone<span class="form-required">*</span></label>
                                <div class="input-icon">
                                <input type="tel" name="phone" class="form-control" value="<?php echo $lecDet['phone'];?>" placeholder="Active Phone" required>
                                </div>
                              </div>

                          </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="form-label"><i class="fe fe-folder"></i> Lecturer Position<span class="form-required">*</span></label>
                                <div class="input-icon">
                                    <select class="form-control" placeholder="Positon" name="staffcat" required>
                                        <option value="<?php echo $lecDet['position'];?>"><?php echo $lecDet['position'];?></option>
                                        <option value="lecturer"> Lecturer</option>
                                        <option value="hod"> Head Of Department</option>
                                        <option value="dean"> Dean </option>
                                    </select>
                                </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                            <div class="col-md-6">
                          <div class="form-group">
                      <label class="form-label"><i class="fe fe-list"></i> Faculty Name<span class="form-required">*</span></label>
                        <?php
                        $allfac = $faculty->find_all_fac();
                        if($allfac){
                        ?>
                        <select name="facID" class="form-control" required id="fac" onchange="facdep(this.value)">
                            <option value="<?php echo $facnmrow['facID'];?>"><?php echo $facnmrow['facultyName']; ?></option>
                            <?php
                            foreach($allfac as $facrow){
                            ?>
                            <option value="<?php echo $facrow['facID'];?>" > <?php echo $facrow['facultyName'];?> </option>
                            <?php }?>
                        </select>
                        <?php }else{ ?>
                      <input type="text" name="facID" class="form-control" value="NO FACULTY CREATED" readonly disabled />
                        <?php }?>
                    </div>
                          </div>
                            <div class="col-md-6">
                          <div class="form-group" id="dept">
                              <label class="form-label"><i class="fe fe-grid"></i> Department Name</label>
                                <select name="depID" class="form-control" required>
                                <option value="<?php echo $dpnmrow['depID'];?>"><?php echo $dpnmrow['departmentName'];?></option>
                                    <?php
                                    $findalldep = $department->find_all_dep();
                                    foreach($findalldep as $deprow){
                                    ?>
                                    <option value="<?php echo $deprow['depID'];?>" > <?php echo $deprow['departmentName'];?> </option>
                                    <?php }?>
                                </select>
                                </div>
                          </div>
                      </div>

                    <div class="form-footer">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="btn btn-primary btn-block" href="javascript:history.back()">
                                    <i class="fe fe-arrow-left mr-2"></i>Go back
                                </a>
                            </div>
                            <div class="col-md-8">
                            <button type="submit" name="reglect" class="btn btn-info btn-block" <?php if(!$allfac){ echo 'disabled';}?> >
                              UPDATE DETAILS <i class="fe fe-refresh-cw"></i>
                            </button>
                            </div>
                        </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>


              <div class="col-md-6">
                  <?php if($error){ ?>
                        <div class="alert alert-icon alert-danger" data-auto-dismiss role="alert">
                            <button type="button" class="close" data-dismiss="alert"></button>
                          <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> <?php echo $error;?>
                        </div>
                    <?php } ?>
                  <?php if($success){ ?>
                      <div class="alert alert-icon alert-success" role="alert">
                          <button type="button" class="close" data-dismiss="alert"></button>
                          <i class="fe fe-check mr-2" aria-hidden="true"></i> <?php echo $success;?>
                        </div>
                    <?php } ?>
                <div class="card">
<!--
                    <div class="card-header">
                      <h3 class="card-title"><i class="fe fe-layers"></i> Assigned Courses</h3>
                    </div>
-->
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th><i class="fe fe-hash"></i> ID</th>
                                <th><i class="fe fe-layers"></i> COURSE</th>
                                <th><i class="fe fe-layers"></i> LEVEL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $fecthassigned = select("SELECT * FROM cmanagement WHERE lecID='$lc'");
                            if($fecthassigned){
                                foreach($fecthassigned as $assrow){
                              $getcid = select("SELECT * FROM courses WHERE cID='".$assrow['cID']."'");
                                    foreach($getcid as $getname){}
                            ?>
                            <tr>
                                <td><?php echo $getname['cID'];?></td>
                                <td><?php echo $getname['courseName'];?></td>
                                <td><?php echo $getname['level'];?></td>
                            </tr>

                            <?php }}else{ ?>
                            <td colspan="2"> No <i class="fe fe-layers"></i> Courses Assigned.</td>
                            <?php }?>
                        </tbody>
                    </table>


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
