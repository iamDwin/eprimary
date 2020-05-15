<?php
$active = 'ltests';
include 'layout/header.php';

if(isset($_GET['cid'])){
    $cid = $_GET['cid'];
}
$_SESSION['current_page']=$_SERVER['REQUEST_URI'];

$alltest = select("SELECT * FROM test WHERE cID='$cid'");
$numTest = count($alltest);
$newnum = $numTest + 1;
$testID = date("dsi").$newnum;

//get course details..
$cnm = select("SELECT * FROM courses WHERE ciD='$cid'");
foreach($cnm as $cnmrow){}

if(isset($_POST['createTest'])){
    $testID = trim(htmlentities($_POST['testID']));
    $lecture = trim(htmlentities($_POST['lecture']));
    $passMark = trim(htmlentities($_POST['passMark']));
    $questionMark = trim(htmlentities($_POST['questionMark']));
    $duration = trim(htmlentities($_POST['duration']));

    //check if test ID exixts....
    $TIDexist = select("SELECT * FROM test WHERE testID='$testID'");
    if($TIDexist){
        $testID = $testID + 1;
        $saveTest = insert("INSERT INTO test(level,semester,cID,testID,lecture,passMark,questionMark,duration,doe) VALUES('".$cnmrow['level']."','".$cnmrow['semester']."','$cid','$testID','$lecture','$passMark','$duration','$dateToday')");
        if($saveTest){
            $success = "<script>document.write('TEST CREATED..!');window.location.href='".$_SESSION['current_page']."';</script>";
        }else{
            $error = "<script>document.write('TEST CREATION FAILED,TRY AGAIN.!');</script>";
        }
    }else{
        $saveTest = insert("INSERT INTO test(level,semester,cID,testID,lecture,passMark,questionMark,duration,doe) VALUES('".$cnmrow['level']."','".$cnmrow['semester']."','$cid','$testID','$lecture','$passMark','$questionMark','$duration','$dateToday')");
        if($saveTest){
            $success = "<script>document.write('TEST CREATED..!');window.location.href='".$_SESSION['current_page']."';</script>";
        }else{
            $error = "<script>document.write('TEST CREATION FAILED,TRY AGAIN.!');</script>";
        }
    }
}

?>

<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
          <h1 class="page-title">
            <a class="btn btn-primary" href="javascript:history.back()"><i class="fe fe-arrow-left mr-2"></i>Go back</a>
           <?php echo strtoupper($cnmrow['courseName']);?> TESTS <small class="text-right"></small>
          </h1>
        </div>
        <div class="row">
            <div class="col-sm-5">
            <div class="card">
                <div class="card-body">
                  <form class="form" method="post" enctype="multipart/form-data" onsubmit="return confirm('SAVE TEST ?');" >
                    <div style="display:none;" class="form-group">
                      <label class="form-label"><i class="fe fe-hash"></i> Test ID</label>
                      <input type="text" name="testID" value="<?php echo $testID;?>" class="form-control" readonly/>
                    </div>
                    <div class="form-group">
                      <label class="form-label"><i class="fe fe-list"></i> Lecture</label>
                        <select name="lecture" class="form-control" required>
                            <option></option>
                            <?php
                            $allLecs = select("SELECT * FROM lecture WHERE cID='$cid'");
                            if($allLecs){
                                foreach($allLecs as $lecsRow){
                            ?>
                            <option value="<?php echo $lecsRow['lecNum'];?>"> Lecture <?php echo $lecsRow['lecNum']." - ".$lecsRow['lecTitle'];?></option>
                            <?php }}?>
                        </select>
                    </div>
                      <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-label"><i class="fe fe-check-square"></i> Pass Mark</label>
                                  <input type="number" min="1" name="passMark" class="form-control" placeholder="Pass Mark" required />
                                </div>
                          </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                  <label class="form-label"><i class="fe fe-check-circle"></i> Mark Per Question</label>
                                  <input type="number" min="1" name="questionMark" class="form-control" placeholder="Mark Per Question" required />
                                </div>
                          </div>
                      </div>

                    <div class="form-group">
                      <label class="form-label"><i class="fe fe-clock"></i> Test Duration</label>
                        <select class="form-control" name="duration" required>
                            <option></option>
                            <option value="30"> 30 Seconds</option>
                            <option value="45"> 45 Seconds</option>
                            <option value="60"> 1 munite</option>
                            <option value="300"> 5 munites</option>
                            <option value="600"> 10 munites</option>
                            <option value="1200"> 20 munites</option>
                            <option value="1800"> 30 munites</option>
                            <option value="2700"> 45 munites</option>
                            <option value="3600"> 1 hour</option>
                        </select>
                    </div>
                    <div class="form-footer">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="btn btn-primary btn-block" href="javascript:history.back()">
                                    <i class="fe fe-arrow-left mr-2"></i>Go back
                                </a>
                            </div>
                            <div class="col-md-8">
                      <button type="submit" name="createTest" class="btn btn-primary btn-block">CREATE TEST <i class="fe fe-download"></i></button>
                            </div>
                        </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
              <div class="col-sm-7">
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
                        <tr>
                          <th><i class="fe fe-hash"></i> ID</th>
                          <th class="text-center"><i class="fe fe-list"></i> LECTURE</th>
                          <th class="text-center"><i class="fe fe-check"></i> PASS MARK</th>
                          <th class="text-center"><i class="fa fa-cog"></i> ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
//                          $allfac = $faculty->find_all_fac();
                          $alltest = select("SELECT * FROM test WHERE cID='$cid'");
                          if($alltest){
                              foreach($alltest as $testRow){
                          ?>
                        <tr>
                          <td> <div><?php echo $testRow['testID'];?></div> </td>
                          <td class="text-center"> <?php echo $testRow['lecture'];?> </td>
                          <td class="text-center"> <?php echo $testRow['passMark'];?> </td>
                          <td class="text-center">
                <a href="./set-test-questions?tid=<?php echo $testRow['testID'];?>" class="btn btn-info btn-sm text-white <?php if($testRow['status'] == 'active'){ echo 'disabled';} ?> "><i class="fe fe-file-text"></i> Manage </a>
                              ||
                              <?php
                              if($testRow['status'] == ''){
                              ?>
                              <a onclick="return confirm('CONFIRM ACTIVATION.');" href="./activate-test?tid=<?php echo $testRow['testID'];?>&cid=<?php echo $testRow['cID'];?>" class="btn btn-success btn-sm text-white"><i class="fe fe-check-square"></i> Activate</a>
                              <?php }
                              if($testRow['status'] == 'active'){
                              ?>
            <a onclick="return confirm('CONFIRM DEACTIVATION.');" href="./deactivate-test?tid=<?php echo $testRow['testID'];?>&cid=<?php echo $testRow['cID'];?>" class="btn btn-danger btn-sm text-white"><i class="fe fe-x-square"></i> Deactivate</a>
                              <?php } ?>
                              ||
                <a href="./test-report?tid=<?php echo $testRow['testID'];?>" class="btn btn-primary btn-sm text-white <?php if($testRow['status'] == 'active'){ echo 'disabled';} ?> "><i class="fe fe-folder"></i> Report </a>
                          </td>
                        </tr>
                          <?php }}else{?>
                          <tr><td colspan="4"> NO TEST AVAIABLE..</td></tr>
                          <?php }?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
