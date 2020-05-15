<?php
$active = 'hstudents';
include 'layout/header.php';

if(isset($_GET['st'])){
    $st = $_GET['st'];
}
$findstudent = $student->find_by_id($st);
if($findstudent){
    foreach($findstudent as $strow){}
    //get department..
    $sdp = select("SELECT * FROM department WHERE depID='".$strow['depID']."'");
    foreach($sdp as $dprow){}
}

if(isset($_POST['updatestudent'])){
    $studentID = trim(htmlspecialchars($_POST['studentID']));
    $firstName = trim(htmlspecialchars($_POST['firstName']));
    $lastName = trim(htmlspecialchars($_POST['lastName']));
    $otherName = trim(htmlspecialchars($_POST['otherName']));
    $email = trim(htmlspecialchars($_POST['email']));
    $phone = trim(htmlspecialchars($_POST['phone']));
    $school = trim(htmlspecialchars($_POST['school']));
    $level = trim(htmlspecialchars($_POST['level']));
    $depID = trim(htmlspecialchars($_POST['depID']));

    $upStu = $student->updateStudent($studentID,$depID,$firstName,$lastName,$otherName,$email,$phone,$school,$level);
    if($upStu){
        $success = "<script>document.write('STUDENT UPDATED SUCCESSFULL.');window.location.href='hstudents';</script>";
    }else{
        $error = "<script>document.write('STUDENT UPDATED FAILED, TRY AGAIN.');</script>";
    }
}

?>

<div class="my-3 my-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                  <form class="form" method="post" enctype="multipart/form-data" onsubmit="return confirm('CONFIRM STUDENT UPDATE.');" >

                      <div class="row">
                          <div class="col-md-6">
                          <div class="form-group">
                            <div class="input-icon">
                                <span class="input-icon-addon"><i class="fe fe-hash"></i><span class="form-required">*</span></span>
            <input type="text" name="studentID" class="form-control" value="<?php echo $strow['studentID'];?>" readonly>
                            </div>
                          </div>
                          </div>
                        <div class="col-md-6">
                          <div class="form-group">
                        <div class="input-icon">
                            <span class="input-icon-addon"><i class="fe fe-user"></i><span class="form-required">*</span></span>
                            <input type="text" name="firstName" class="form-control" value="<?php echo $strow['firstName'];?>" required >
                        </div>
                      </div>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                        <div class="input-icon">
                            <span class="input-icon-addon"><i class="fe fe-user"></i><span class="form-required">*</span></span>
                            <input type="text" name="lastName" class="form-control" value="<?php echo $strow['lastName'];?>" required >
                        </div>
                      </div>
                          </div>
                        <div class="col-md-6">
                          <div class="form-group">
                        <div class="input-icon">
                            <span class="input-icon-addon"><i class="fe fe-user"></i></span>
                            <input type="text" name="otherName" class="form-control" value="<?php echo $strow['otherName'];?>">
                        </div>
                      </div>
                          </div>
                      </div>

                      <div class="form-group">
                        <div class="input-icon">
                            <span class="input-icon-addon"><i class="fe fe-mail"></i><span class="form-required">*</span></span>
                        <input type="email" name="email" class="form-control" value="<?php echo $strow['email'];?>" required readonly>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="input-icon">
                                <span class="input-icon-addon"><i class="fe fe-phone"></i><span class="form-required">*</span></span>
                                <input type="tel" name="phone" class="form-control" value="<?php echo $strow['phone'];?>" required readonly>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                              <div class="form-group">
                                <div class="input-icon">
                                    <span class="input-icon-addon"><i class="fe fe-bar-chart"></i><span class="form-required">*</span></span>
                                    <select class="form-control" disabled name="level">
                                        <option value="<?php echo $strow['level'];?>"> <?php echo $strow['level'];?></option>
                                        <option value="100"> 100 </option>
                                        <option value="200"> 200 </option>
                                        <option value="300"> 300 </option>
                                        <option value="400"> 400 </option>
                                    </select>
                                </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label class="form-label"><i class="fe fe-folder"></i> School<span class="form-required">*</span></label>
                                <div class="input-icon">
                                    <select class="form-control" name="school" disabled required>
                                        <option value="<?php echo $strow['school'];?>"><?php echo $strow['school'];?></option>
                                        <option value="Regular"> Regular</option>
                                        <option value="Evening"> Evening</option>
                                        <option value="Weekend"> Weekend</option>
                                    </select>
                                </div>
                              </div>
                          </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label"><i class="fe fe-grid"></i> Department Name <span class="form-required">*</span></label>
                            <div class="input-icon">
<!--                                <span class="input-icon-addon"><i class="fe fe-grid"></i><span class="form-required">*</span></span>-->
                        <input type="text" name="depName" class="form-control" value="<?php echo $dprow['departmentName'] ;?>" readonly>
                        <input type="text" name="depID" class="form-control" value="<?php echo $dprow['depID'];?>" readonly hidden>
                            </div>
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
                                <button type="submit" name="updatestudent" class="btn btn-info btn-block">
                                  UPDATE STUDENT <i class="fe fe-refresh-cw"></i>
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
<!--
                <div class="card">
                </div>
-->
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
