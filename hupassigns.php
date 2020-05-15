<?php
$active = 'hassigns';
include 'layout/header.php';

if(isset($_GET['cm'])){
    $cm = $_GET['cm'];
}
//find assign by assignid
$findcm = $cmanage->find_by_id($cm);
if($findcm){
    foreach($findcm as $cmrow){}
    //get department..
    $sdp = select("SELECT * FROM department WHERE depID='".$cmrow['depID']."'");
    foreach($sdp as $dprow){}
    //get course name
    $cname = select("SELECT * FROM courses WHERE cID='".$cmrow['cID']."'");
    foreach($cname as $cnrow){}
    //get lecturer
    $lname = select("SELECT * FROM lecturer WHERE lecID='".$cmrow['lecID']."'");
    foreach($lname as $lrow){}
}

if(isset($_POST['reassign'])){
    $cID = trim(htmlspecialchars($_POST['cID']));
    $lecID = trim(htmlspecialchars($_POST['lecID']));

    $updateAssign = $cmanage->updatecmanage($cm,$lecID);
    if($updateAssign){
        $success = "<script>document.write('COURSE RE-ASSIGNED SUCCESSFULL.');window.location.href='hassigns';</script>";
    }else{
        $error = "<script>document.write('COURSE RE-ASSIGNING FAILED, TRY AGAIN.');</script>";
    }
}

?>

<div class="my-3 my-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                  <form class="form" method="post" enctype="multipart/form-data" onsubmit="return confirm('CONFIRM COURSE RE-ASSIGNMENT.');" >

                      <div class="row">
                          <div class="col-md-12">
                          <div class="form-group">
                            <div class="input-icon">
                                <span class="input-icon-addon"><i class="fe fe-hash"></i><span class="form-required">*</span></span>
            <input type="text" name="cID" class="form-control" value="<?php echo $cmrow['cID'];?>" readonly>
                            </div>
                          </div>
                          </div>
                        <div class="col-md-12">
                          <div class="form-group">
                        <div class="input-icon">
                            <span class="input-icon-addon"><i class="fe fe-layers"></i><span class="form-required">*</span></span>
                            <input type="text" name="courseName" class="form-control" value="<?php echo $cnrow['courseName'];?>" required readonly>
                        </div>
                      </div>
                          </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                              <div class="form-group">
                                <div class="input-icon">
                                    <span class="input-icon-addon"><i class="fe fe-users"></i><span class="form-required">*</span></span>
                                    <?php
                                            $alllec = $lecturer->find_all_lecdep($userDet['depID']);
                                            if($alllec){
                                        ?>
                                        <select class="form-control" name="lecID" required>
                                            <option value="<?php echo $lrow['lecID']; ?>"><?php echo $lrow['firstName']." ".$lrow['lastName']." ".$lrow['otherName']; ?></option>
                                            <?php foreach($alllec as $lecrow){ ?>
                                            <option value="<?php echo $lecrow['lecID'];?>"><?php echo $lecrow['firstName']." ".$lecrow['lastName']." ".$lecrow['otherName'];?></option>
                                            <?php }?>
                                        </select>
                                        <?php }else{ ?>
                                        <input type="text" name="" class="form-control" value="No Lecturer Available" readonly >
                                        <?php }?>
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
                                <button type="submit" name="reassign" class="btn btn-info btn-block">
                                  RE-ASSIGN COURSE <i class="fe fe-refresh-cw"></i>
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
