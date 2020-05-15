<?php
$active = 'hcourses';
include 'layout/header.php';

if(isset($_GET['c'])){
    $cid = $_GET['c'];
}
$findcourse = $course->find_by_cID($cid);
if($findcourse){
    foreach($findcourse as $crow){}
    //get department..
    $sdp = select("SELECT * FROM department WHERE depID='".$crow['depID']."'");
    foreach($sdp as $dprow){}
}

if(isset($_POST['updatecourse'])){
    $cIDs = trim(htmlspecialchars($_POST['cID']));
    $semester = trim(htmlspecialchars($_POST['semester']));
    $courseName = trim(htmlspecialchars($_POST['courseName']));
    $level = trim(htmlspecialchars($_POST['level']));

    $upCourse = $course->updateCourse($cIDs,$courseName,$semester,$level);
    if($upCourse){
        $success = "<script>document.write('COURSE UPDATED SUCCESSFULL.');window.location.href='hcourses';</script>";
    }else{
        $error = "<script>document.write('COURSE UPDATED FAILED, TRY AGAIN.');</script>";
    }
}

?>

<div class="my-3 my-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                  <form class="form" method="post" enctype="multipart/form-data" onsubmit="return confirm('CONFIRM COURSE UPDATE.');" >

                      <div class="row">
                          <div class="col-md-12">
                          <div class="form-group">
                            <div class="input-icon">
                                <span class="input-icon-addon"><i class="fe fe-hash"></i><span class="form-required">*</span></span>
            <input type="text" name="cID" class="form-control" value="<?php echo $crow['cID'];?>" readonly>
                            </div>
                          </div>
                          </div>
                        <div class="col-md-12">
                          <div class="form-group">
                        <div class="input-icon">
                            <span class="input-icon-addon"><i class="fe fe-user"></i><span class="form-required">*</span></span>
                            <input type="text" name="courseName" class="form-control" value="<?php echo $crow['courseName'];?>" required >
                        </div>
                      </div>
                          </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                                <select class="form-control" name="semester" required>
                                    <option value="<?php echo $crow['semester'];?>"><?php echo $crow['semester'];?></option>
                                    <option value="1">1st Semester</option>
                                    <option value="2">2nd Semester</option>
                                </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                              <div class="form-group">
                                <div class="input-icon">
                                    <span class="input-icon-addon"><i class="fe fe-bar-chart"></i><span class="form-required">*</span></span>
                                    <select class="form-control" name="level">
                                        <option value="<?php echo $crow['level'];?>"> <?php echo $crow['level'];?></option>
                                        <option value="100"> 100 </option>
                                        <option value="200"> 200 </option>
                                        <option value="300"> 300 </option>
                                        <option value="400"> 400 </option>
                                    </select>
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
                                <button type="submit" name="updatecourse" class="btn btn-info btn-block">
                                  UPDATE COURSE <i class="fe fe-refresh-cw"></i>
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
