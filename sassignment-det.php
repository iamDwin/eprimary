<?php
$active = 'ltests';
include 'layout/header.php';

if(isset($_GET['aid'])){
    $aid = $_GET['aid'];
}
//get assignment details...
$assigndet = select("SELECT * FROM assignment WHERE asID='$aid'");
foreach($assigndet as $assignrow){
    //get course details..
    $cnm = select("SELECT * FROM courses WHERE cID='".$assignrow['cID']."'");
    foreach($cnm as $cnmrow){}
}

$cid = $cnmrow['cID'];

$MAIN_UPLOAD = PARENT_DIR.$cid.'/';
$MEDIA_UPLOAD = PARENT_DIR.$cid.'/media/';
$DOC_UPLOAD = PARENT_DIR.$cid.'/documents/';
$ASSIGNMENT_UPLOAD = PARENT_DIR.$cid.'/assignment/';

//$_SESSION['current_page']=$_SERVER['REQUEST_URI'];

$username = $userDet['firstName'][0].$userDet['lastName'];

if(isset($_POST['updateAssign'])){

            //file properties
            $file_name=$_FILES['answer']['name'];
            $file_tmp=$_FILES['answer']['tmp_name'];
            $file_size= $_FILES['answer']['size'];
            $file_error = $_FILES['answer']['error'];
            //etract extension
            $file_ext =explode('.',$file_name);
            $file_ext = strtolower(end($file_ext));
            $allowed = array('application','doc','docx','txt','ppt','pptx','pdf');

            if(in_array($file_ext, $allowed)){
                if($file_error===0){
                    if($file_size <= 4097152){
//                        $count = count(select("SELECT * FROM assignment WHERE cID='$cid'")) + 1;
                     $file_name_new=$cid.'_Answer'.$aid.'_'.$username.".".$file_ext;
                        $file_destination = $ASSIGNMENT_UPLOAD.$file_name_new;
                        //check if file has been loaded earlier and move it from temporary location into folder
                        if(move_uploaded_file($file_tmp,$file_destination)){

$saveAssign = insert("INSERT INTO assignment_answers(asID,studentID,answer) VALUES('$aid','".$userDet['studentID']."','$file_destination')");

            if($saveAssign){
    $success = "<script>document.write('ASSIGNMENT ANSWER UPLOADED.');window.location.href='".$_SESSION['current_page']."'</script>";
            }else{
                $error = "<script>document.write('ANSWER UPLOAD FAILED,TRY AGAIN.!');</script>";
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


?>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
          <h1 class="page-title">
               <a class="btn btn-primary" href="javascript:history.back()">
                   <i class="fe fe-arrow-left mr-2"></i>Go back
               </a>
           <?php echo strtoupper($cnmrow['courseName']);?> - ASSIGNMENT
          </h1>
        </div>
        <div class="row">
            <div class="col-md-12">
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
                <div class="row">

                    <!--====================  START COURSE CONTENT PANEL =================-->
                    <div class="col-md-7">
                        <div class="card">
                          <div class="card-status card-status-left bg-blue"></div>
                          <div class="card-header">
                            <h3 class="card-title">ASSIGNMENT QUESTIONS PANEL</h3>
                          </div>
                          <div class="card-body">

                              <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th><i class="fe fe-file-text"></i> QUESTION </th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $allTest = select("SELECT * FROM assignment WHERE asID='$aid'");
                                            if($allTest){
                                                foreach($allTest as $qstnrow){
                                                    $type = $qstnrow['type'];
                                            ?>
                                            <tr>
                                                <?php if($type == 'file'){?>
                                                <td><a target="_blank" href="<?php echo $qstnrow['question'];?>"> VIEW QUESTION </a></td>
                                                <?php }?>

                                                <?php if($type == 'text'){?>
                                                <td><?php echo $qstnrow['question'];?></td>
                                                <?php }?>

                                            </tr>
                                            <?php }}else{?>
                                            <tr>
                                                <td colspan="3"> No Questions Available.</td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                  </div>
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th><i class="fe fe-file-text"></i> ANSWER TO ASSIGNMENT</th>
                                        </thead>
                                        <tbody>
                                            <?php
                $allTest = select("SELECT * FROM assignment_answers WHERE asID='$aid' AND studentID='".$userDet['studentID']."'");
                                            if($allTest){
                                                foreach($allTest as $qstnrow){
                                                    //$type = $qstnrow['type'];
                                            ?>
                                            <tr>
                                                <?php // if($type == 'file'){?>
                                                <td><a target="_blank" href="<?php echo $qstnrow['answer'];?>"> VIEW ANSWER </a></td>
                                                <?php // }?>

<!--
                                                <?php // if($type == 'text'){?>
                                                <td><?php // echo $qstnrow['question'];?></td>
                                                <?php // / }?>
-->

                                            </tr>
                                            <?php }}else{?>
                                            <tr>
                                                <td colspan="3"> No Answers Available.</td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                  </div>
                              </div>
                          </div>
                        </div>
                    </div>

                <div class="col-md-5">
                 <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> SUBMIT ANSWER</h4>
                    </div>
                    <div class="card-body">
                      <form class="form" method="post" enctype="multipart/form-data" onsubmit="return confirm('UPLOAD ANSWER ?');" >
                          <div class="row">
                                <div class="col-md-12">
                                   <div class="form-group">
                                      <label class="form-label"><i class="fe fe-upload"></i> Upload Answer</label>
                                      <input type="file" accept="application/*" name="answer" class="form-control" placeholder="Upload Answer"/>
                                    </div>
                              </div>
                          </div>
                        <div class="form-footer">
                            <div class="row">
                                <div class="col-md-12">
                          <button type="submit" name="updateAssign" class="btn btn-primary btn-block">SUBMIT <i class="fe fe-send"></i></button>
                                </div>
                            </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                    <!--====================  ENDING COURSE CONTENT PANEL =================-->

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function readtype(val){
// load the select option data into a div
    $('#loader').html("Please Wait...");
    $('#readtype').load('load/readtype.php?t='+val, function(){
    $('#loader').html("");
   });
}
</script>
<?php include 'layout/footer.php'; ?>
