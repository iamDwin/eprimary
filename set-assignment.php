<?php
$active = 'ltests';
include 'layout/header.php';

if(isset($_GET['cid'])){
    $cid = $_GET['cid'];
}

$MAIN_UPLOAD = PARENT_DIR.$cid.'/';
$MEDIA_UPLOAD = PARENT_DIR.$cid.'/media/';
$DOC_UPLOAD = PARENT_DIR.$cid.'/documents/';
$ASSIGNMENT_UPLOAD = PARENT_DIR.$cid.'/assignment/';

$_SESSION['current_page']=$_SERVER['REQUEST_URI'];

//$alltest = select("SELECT * FROM test WHERE cID='$cid'");
//$numTest = count($alltest);
//$newnum = $numTest + 1;
//$testID = date("dsi").$newnum;

//get course details..
$cnm = select("SELECT * FROM courses WHERE ciD='$cid'");
foreach($cnm as $cnmrow){}

if(isset($_POST['createAssignment'])){
//    $testID = trim(htmlentities($_POST['testID']));
    $lecture = trim(htmlentities($_POST['lecture']));
    $passMark = trim(htmlentities($_POST['passMark']));
    $overallMark = trim(htmlentities($_POST['overallMark']));
    $dueDate = trim(htmlentities($_POST['dueDate']));
    $type = trim(htmlentities($_POST['type']));

        // Declare two dates
    $start_date = strtotime(date("Y-m-d"));
    $end_date = strtotime($dueDate);

    // Get the difference and divide into
    // total no. seconds 60/60/24 to get
    // number of days
    $datdif =  ($end_date - $start_date)/60/60/24;

    if($datdif < 0){
        $error = "<script>document.write('SELECTED DUE DATE IS PAST, SELECT NEW DATE.!');</script>";
    }else{

        if($type == 'text'){
            $question = trim(htmlspecialchars($_POST['question']));
        $saveTest = insert("INSERT INTO assignment(level,semester,cID,lecNum,type,question,overallMark,passMark,dueDate,doe) VALUES('".$cnmrow['level']."','".$cnmrow['semester']."','$cid','$lecture','$type','$question','$overallMark','$passMark','$dueDate','$dateToday')");
            if($saveTest){
                $success = "<script>document.write('ASSIGNMENT CREATED..!');window.location.href='".$_SESSION['current_page']."';</script>";
            }else{
                $error = "<script>document.write('ASSIGNMENT CREATION FAILED,TRY AGAIN.!');</script>";
            }
        }

        if($type == 'file'){

            //file properties
            $file_name=$_FILES['question']['name'];
            $file_tmp=$_FILES['question']['tmp_name'];
            $file_size= $_FILES['question']['size'];
            $file_error = $_FILES['question']['error'];
            //etract extension
            $file_ext =explode('.',$file_name);
            $file_ext = strtolower(end($file_ext));
            $allowed = array('application','doc','docx','txt','ppt','pptx','pdf');

            if(in_array($file_ext, $allowed)){
                if($file_error===0){
                    if($file_size <= 4097152){
                        $count = count(select("SELECT * FROM assignment WHERE cID='$cid'")) + 1;
                     $file_name_new=$cid.'-assigment'.$count.'.'.$file_ext;
                        $file_destination = $ASSIGNMENT_UPLOAD.$file_name_new;
                        //check if file has been loaded earlier and move it from temporary location into folder
                        if(move_uploaded_file($file_tmp,$file_destination)){


            $saveTest = insert("INSERT INTO assignment(level,semester,cID,lecNum,type,question,overallMark,passMark,dueDate,doe) VALUES('".$cnmrow['level']."','".$cnmrow['semester']."','$cid','$lecture','$type','$file_destination','$overallMark','$passMark','$dueDate','$dateToday')");

            if($saveTest){
    $success = "<script>document.write('ASSIGNMENT FILE UPLOAD.');window.location.href='".$_SESSION['current_page']."'</script>";
            }else{
                $error = "<script>document.write('ASSIGNMENT CREATION FAILED,TRY AGAIN.!');</script>";
            }
                        }else{
                           $error = "<script>document.write('FILE NOT MOVED, TRY AGAIN');</script>";
                        }
                    }else{
                        $error = "<script>document.write('FILE EXCEEDS MAX SIZE OF 10MB, TRY AGAIN');</script>";
                    }

                }else{
                    $error = "<script>document.write('".$file_error."');</script>";
                }
            }else{
                $error = "<script>document.write('FILE EXTENSION NOT SUPPORTED, TRY AGAIN');</script>";
            }


        }


    }



//    }
}

?>

<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
          <h1 class="page-title">
            <a class="btn btn-primary" href="javascript:history.back()"><i class="fe fe-arrow-left mr-2"></i>Go back</a>
           <?php echo strtoupper($cnmrow['courseName']);?> ASIGNMENTS <small class="text-right"></small>
          </h1>
        </div>
        <div class="row">
            <div class="col-sm-5">
            <div class="card">
                <div class="card-body">
                  <form class="form" method="post" enctype="multipart/form-data" onsubmit="return confirm('SAVE ASSIGNMENT ?');" >

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
                                  <label class="form-label"><i class="fe fe-calendar"></i> Due Date</label>
                                  <input type="date"  name="dueDate" class="form-control" placeholder="Submittion" required />
                                </div>
                          </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                  <label class="form-label"><i class="fe fe-file"></i> Question Type</label>
                                   <select class="form-control" name="type" onchange="aType(this.value)" required>
                                        <option value=""></option>
                                        <option value="file"> File </option>
                                        <option value="text"> Text </option>
                                   </select>
                                </div>
                          </div>
                      </div>

                      <div class="row" id="textType">

                      </div>

                      <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-label"><i class="fe fe-check-circle"></i> Overall Mark</label>
                                  <input type="number" min="1"  name="overallMark" class="form-control" placeholder="Overall Mark"/>
                                </div>
                          </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                  <label class="form-label"><i class="fe fe-check-circle"></i> Pass Mark</label>
                                  <input type="number" min="1" name="passMark" class="form-control" placeholder="Pass Mark"/>
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
                      <button type="submit" name="createAssignment" class="btn btn-primary btn-block">SAVE ASSIGNMENT <i class="fe fe-download"></i></button>
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
                          <th><i class="fe fe-hash"></i></th>
                          <th class="text-center"><i class="fe fe-list"></i> LECTURE</th>
                          <th class="text-center"><i class="fe fe-check"></i> PASS MARK</th>
                          <th class="text-center"><i class="fa fa-cog"></i> ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
//                          $allfac = $faculty->find_all_fac();
                          $counter = 0;
                          $alltest = select("SELECT * FROM assignment WHERE cID='$cid'");
                          if($alltest){
                              foreach($alltest as $testRow){

                              $counter ++ ;
                          ?>
                        <tr>
                          <td> <div><?php echo $counter;?></div> </td>
                          <td class="text-center"> <?php echo $testRow['lecNum'];?> </td>
                          <td class="text-center"> <?php echo $testRow['passMark'];?> </td>
                          <td class="text-center">
                <a href="./manage-assignment?aid=<?php echo $testRow['asID'];?>" class="btn btn-info btn-sm text-white <?php if($testRow['status'] == 'active'){ echo 'disabled';} ?> "><i class="fe fe-file-text"></i> Manage </a>
                              ||
                              <?php
                              if($testRow['status'] == ''){
                              ?>
                              <a onclick="return confirm('CONFIRM ACTIVATION.');" href="./activate-assignment?aid=<?php echo $testRow['asID'];?>&cid=<?php echo $testRow['cID'];?>" class="btn btn-success btn-sm text-white"><i class="fe fe-check-square"></i> Activate</a>
                              <?php }
                              if($testRow['status'] == 'active'){
                              ?>
            <a onclick="return confirm('CONFIRM DEACTIVATION.');" href="./deactivate-assignment?aid=<?php echo $testRow['asID'];?>&cid=<?php echo $testRow['cID'];?>" class="btn btn-danger btn-sm text-white"><i class="fe fe-x-square"></i> Deactivate</a>
                              <?php } ?>
                              ||
                <a href="./assignment-report?aid=<?php echo $testRow['asID'];?>" class="btn btn-primary btn-sm text-white <?php if($testRow['status'] == 'active'){ echo 'disabled';} ?> "><i class="fe fe-folder"></i> Report </a>
                          </td>
                        </tr>
                          <?php }}else{?>
                          <tr><td colspan="4"> NO ASIGNMENT AVAIABLE..</td></tr>
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
function aType(val){
// load the select option data into a div
    $('#loader').html("Please Wait...");
    $('#textType').load('load/asstype.php?type='+val, function(){
    $('#loader').html("");
   });
}
</script>
<?php include 'layout/footer.php'; ?>
