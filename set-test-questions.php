<?php
$active = 'ltests';
include 'layout/header.php';

if(isset($_GET['tid'])){
    $tid = $_GET['tid'];
}
//get test details...
$testdet = select("SELECT * FROM test WHERE testID='$tid'");
foreach($testdet as $testdetrow){
    //get course details..
    $cnm = select("SELECT * FROM courses WHERE cID='".$testdetrow['cID']."'");
    foreach($cnm as $cnmrow){}
}

$_SESSION['current_page']=$_SERVER['REQUEST_URI'];

if(isset($_POST['createTest'])){
    $numquestions = count($_POST['question']);
    $numop1 = count($_POST['option1']);
    $numop2 = count($_POST['option2']);
    $numop3 = count($_POST['option3']);
    $numop4 = count($_POST['option4']);
    $numanswer = count($_POST['answer']);

    if($numquestions > 0 && $numop1 >0 && $numop2 > 0 && $numop3 > 0 && $numop4 > 0 && $numanswer > 0){
        for($q=0,$n1=0,$n2=0,$n3=0,$n4=0,$a=0; $q<$numquestions,$n1<$numop1,$n2<$numop2,$n3<$numop3,$n4<$numop4,$a<$numanswer;$q++,$n1++,$n2++,$n3++,$n4++,$a++){

            $question = trim(htmlspecialchars($_POST['question'][$q]));
            $option1 = trim(htmlspecialchars($_POST['option1'][$n1]));
            $option2 = trim(htmlspecialchars($_POST['option2'][$n2]));
            $option3 = trim(htmlspecialchars($_POST['option3'][$n3]));
            $option4 = trim(htmlspecialchars($_POST['option4'][$n4]));
            $answer = trim(htmlspecialchars($_POST['answer'][$a]));

            if(!empty($question) && !empty($option1) &&  !empty($option2) &&  !empty($option3) &&  !empty($option4) &&  !empty($answer)){
                //time to insert questions into database....
                $savetest = insert("INSERT INTO objtest(testID,question,option1,option2,option3,option4,answer) VALUES('$tid','$question','$option1','$option2','$option3','$option4','$answer')");

                if($savetest){
                    $success = "<script>document.write('TEST QUESTIONS SAVED..');window.location='".$_SESSION['current_page']."';</script>";
                }else{
                    $error = "<script>document.write('FAILED TO SAVE TEST QUESTION, TRY AGAIN..');</script>";
                }
            }else{
                $error = "<script>document.write('EMPTY FIELDS NOT ALLOWED..');</script>";
            }
        }
    }else{
        $error = "<script>document.write('NO DATA TO BE SAVED..');</script>";
    }
}


if(isset($_POST['updateTest'])){
    $testID = trim(htmlentities($_POST['testID']));
//    $lecture = trim(htmlentities($_POST['lecture']));
    $passMark = trim(htmlentities($_POST['passMark']));
    $questionMark = trim(htmlentities($_POST['questionMark']));
    $duration = trim(htmlentities($_POST['duration']));

    $updateTest = update("UPDATE test SET passMark='$passMark', questionMark='$questionMark', duration='$duration' WHERE testID='$testID'");
    if($updateTest){
        $success = "<script>document.write('TEST UPDATED..!');window.location.href='".$_SESSION['current_page']."';</script>";
    }else{
        $error = "<script>document.write('TEST UPDATE FAILED,TRY AGAIN.!');</script>";
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
           <?php echo strtoupper($cnmrow['cID']);?> : <?php echo strtoupper($cnmrow['courseName']);?> - TEST <?php echo $tid; ?>
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
                    <div class="col-md-12">
                        <div class="card">
                          <div class="card-status card-status-left bg-blue"></div>
                          <div class="card-header">
                            <h3 class="card-title">SET TEST QUESTION PANEL</h3>
                            <div class="card-options">
                              <a href="#" class="card-options-collapse btn btn-primary btn-sm" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                            </div>
                          </div>
                          <div class="card-body">

                              <div class="row">
                                <div class="col-md-12">
                                    <form class="" method="post" enctype="multipart/form-data" onsubmit="return confirm('CONFIRM SAVING QUESTIONS.');">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table id="dynamic_field4" class="table table-bordered" width="100%">
                                                <tbody>
<!--
                                                    <tr>
                                                        <td colspan="2">
                                            <input type="text" name="lectitle" class="form-control" placeholder="Lecture Title..." required />
                                                        </td>
                                                        <td class="text-center"></td>
                                                    </tr>
-->
                                                    <tr>
                                                        <th style="width:30%;">
                                                            <i class="fe fe-grid"></i> Question<span class="form-required">*</span>
                                                        </th>
                                                        <th> <i class="fe fe-file"></i> Option 1<span class="form-required">*</span></th>
                                                        <th> <i class="fe fe-file"></i> Option 2<span class="form-required">*</span></th>
                                                        <th> <i class="fe fe-file"></i> Option 3<span class="form-required">*</span></th>
                                                        <th> <i class="fe fe-file"></i> Option 4<span class="form-required">*</span></th>
                                                        <th> Answer<span class="form-required">*</span></th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                           <div class="form-group">
                                                              <input type="text" placeholder="Question..." class="form-control" name="question[]" required>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                              <input type="text" class="form-control" name="option1[]" required>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                              <input type="text" class="form-control" name="option2[]" required>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                              <input type="text" class="form-control" name="option3[]" required>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                              <input type="text" class="form-control" name="option4[]" required>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="answer[]" required>
                                                                <option></option>
                                                                <option value="1" > 1</option>
                                                                <option value="2" > 2</option>
                                                                <option value="3" > 3</option>
                                                                <option value="4" > 4</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <button type="button" name="add" id="add4" class="btn btn-primary btn-block">
                                                                ADD <i class="fe fe-plus-square"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                </table>
                                            </div>

                                            <div class="col-md-4 col-offset-8">
                                              <div class="form-footer">
                                                    <button type="submit" name="createTest" class="btn btn-primary btn-block" >
                                                      SAVE TEST QUESTIONS <i class="fe fe-download"></i>
                                                    </button>
                                                </div>
                                              </div>
                                        </div>
                                    </form>
                                  </div>
                              </div>

                          </div>
                        </div>
                    </div>
                    <!--====================  ENDING COURSE CONTENT PANEL =================-->

                    <!--====================  START COURSE CONTENT PANEL =================-->
                    <div class="col-md-7">
                        <div class="card">
                          <div class="card-status card-status-left bg-blue"></div>
                          <div class="card-header">
                            <h3 class="card-title">TEST QUESTIONS PANEL</h3>
                            <div class="card-options">

<!--
                              <a href="" class="card-options-collapse btn btn-success btn-sm">
                                  <i class="fe fe-check-square"></i> Activate
                                </a>
                                --
-->
                              <a href="#" class="card-options-collapse btn btn-primary btn-sm" data-toggle="card-collapse">
                                  <i class="fe fe-chevron-up"></i>
                                </a>
                            </div>
                          </div>
                          <div class="card-body">

                              <div class="row">
                                <div class="col-md-12">
<!--                                    <div class="table">-->
                                        <table class="table table-bordered">
                                            <thead>
                                                <th><i class="fe fe-hash"></i> ID</th>
                                                <th><i class="fe fe-file-text"></i> Questions</th>
                                                <th class="text-center"><i class="fe fe-settings"></i> Action</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $allTest = select("SELECT * FROM objtest WHERE testID='$tid'");
                                                if($allTest){
                                                    foreach($allTest as $qstnrow){

                                                ?>
                                                <tr>
                                                    <td> <?php echo $qstnrow['qid'];?></td>
                                                    <td><?php echo wordwrap(substr($qstnrow['question'],0,50), 20)."....";?></td>

                                                    <td class="text-center">
                                                        <a href="manage-question?qid=<?php echo $qstnrow['qid'];?>" class="btn btn-primary btn-sm">Edit <i class="fe fe-edit"></i></a>

                                                        <a onclick="return confirm('TRASH QUESTION ?');" href="trash-question?qid=<?php echo $qstnrow['qid'];?>&tid=<?php echo $tid;?>" class="btn btn-danger btn-sm ">Trash <i class="fe fe-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <?php }}else{?>
                                                <tr>
                                                    <td colspan="3"> No Questions Available.</td>
                                                </tr>
                                                <?php }?>
                                            </tbody>

                                        </table>
<!--                                    </div>-->
                                  </div>

                              </div>

                          </div>
                        </div>
                    </div>

                                <div class="col-sm-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> TEST SETTINGS</h4>
                </div>
                <div class="card-body">
                  <form class="form" method="post" enctype="multipart/form-data" onsubmit="return confirm('SAVE TEST ?');" >
                    <div style="" class="form-group">
                      <label class="form-label"><i class="fe fe-hash"></i> Test ID</label>
                      <input type="text" name="testID" value="<?php echo $tid;?>" class="form-control" readonly/>
                    </div>
<!--
                    <div class="form-group">
                      <label class="form-label"><i class="fe fe-list"></i> Lecture</label>
                        <select name="lecture" class="form-control" required>
                            <option></option>
                            <?php
//                            $allLecs = select("SELECT * FROM lecture WHERE cID='$cid'");
//                            if($allLecs){
//                                foreach($allLecs as $lecsRow){
                            ?>
                            <option value="<?php //echo $lecsRow['lecNum'];?>"> Lecture <?php //echo $lecsRow['lecNum']." - ".$lecsRow['lecTitle'];?></option>
                            <?php// }}?>
                        </select>
                    </div>
-->
                      <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-label"><i class="fe fe-check-square"></i> Pass Mark</label>
                                  <input type="number" min="1" name="passMark" class="form-control" value="<?php echo $testdetrow['passMark'];?>"  placeholder="Pass Mark"/>
                                </div>
                          </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                  <label class="form-label"><i class="fe fe-check-circle"></i> Mark Per Question</label>
                                  <input type="number" min="1" name="questionMark" value="<?php echo $testdetrow['questionMark'];?>" class="form-control" placeholder="Mark Per Question"/>
                                </div>
                          </div>
                      </div>

<!--
                    <div class="form-group">
                      <label class="form-label"><i class="fe fe-clock"></i> Duration In Seconds</label>
                      <input type="number" min="1" name="duration" class="form-control" value="<?php // echo $testdetrow['duration'];?>"  placeholder="Test Duration..."/>
                    </div>
-->

                     <div class="form-group">
                      <label class="form-label"><i class="fe fe-clock"></i> Test Duration</label>
                        <select class="form-control" name="duration" required>
                            <option value="<?php echo $testdetrow['duration'];?>" ><?php echo $testdetrow['duration'];?></option>
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
                            <div class="col-md-12">
                      <button type="submit" name="updateTest" class="btn btn-primary btn-block">UPDATE TEST <i class="fe fe-download"></i></button>
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
<script>
    $(document).ready(function(){
        var i=1;
        $('#add4').click(function(){
            i++;
            $('#dynamic_field4').append('<tr id="row'+i+'"><td> <div class="form-group"> <input type="text" placeholder="Question..." class="form-control" name="question[]" required> </div> </td> <td> <div class="form-group"> <input type="text" class="form-control" name="option1[]" required> </div> </td>  <td> <div class="form-group"> <input type="text" class="form-control" name="option2[]" required> </div> </td> <td> <div class="form-group"> <input type="text" class="form-control" name="option3[]" required> </div> </td> <td> <div class="form-group"> <input type="text" class="form-control" name="option4[]" required> </div> </td> <td> <select class="form-control" name="answer[]" required> <option></option> <option value="1" > 1</option> <option value="2" > 2</option> <option value="3" > 3</option> <option value="4" > 4</option>  </select>  </td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
        });

        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });
    });
</script>
<?php include 'layout/footer.php'; ?>
