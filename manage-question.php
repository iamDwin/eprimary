<?php
$active = 'ltests';
include 'layout/header.php';

if(isset($_GET['qid'])){
    $qid = $_GET['qid'];
    //get question from table...
    $getqtsn = select("SELECT * FROM objtest WHERE qid='$qid'");
    if(count($getqtsn) > 0){
        foreach($getqtsn as $qdet){}
    }
}


//$_SESSION['current_page']=$_SERVER['REQUEST_URI'];

if(isset($_POST['updateQtsn'])){
    $question = trim(htmlentities($_POST['question']));
    $option1 = trim(htmlentities($_POST['option1']));
    $option2 = trim(htmlentities($_POST['option2']));
    $option3 = trim(htmlentities($_POST['option3']));
    $option4 = trim(htmlentities($_POST['option4']));
    $answer = trim(htmlentities($_POST['answer']));

    $updateTest = update("UPDATE objtest SET question='$question', option1='$option1', option2='$option2', option3='$option3', option4='$option4', answer='$answer' WHERE qid='$qid'");
    if($updateTest){
        $success = "<script>document.write('QUESTION UPDATED..!');window.location.href='".$_SESSION['current_page']."';</script>";
    }else{
        $error = "<script>document.write('QUESTION UPDATE FAILED,TRY AGAIN.!');</script>";
    }

}
?>
<div class="my-3 my-md-5">
    <div class="container">
<!--        <div class="page-header">-->
<!--
          <h1 class="page-title">
               <a class="btn btn-primary" href="javascript:history.back()">
                    <i class="fe fe-arrow-left mr-2"></i>Go back
                </a>
          </h1>
-->
<!--        </div>-->
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


        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> UPDATE QUESTION </h4>
                </div>
                <div class="card-body">
                  <form class="form" method="post" enctype="multipart/form-data" onsubmit="return confirm('UPDATE QUESTION ?');" >

                      <div class="row">
                         <div class="col-md-6">
                            <div style="" class="form-group">
                              <label class="form-label"><i class="fe fe-file-text"></i> Question</label>
                                <textarea class="form-control" name="question" rows="9" required><?php echo $qdet['question']; ?></textarea>
                            </div>

                            <div class="row">
                            <div class="col-md-6">
                              <a class="btn btn-primary btn-block" href="javascript:history.back()">
                                    <i class="fe fe-arrow-left mr-2"></i>Go back
                                </a>
                            </div>
                            <div class="col-md-6">
                              <button type="submit" name="updateQtsn" class="btn btn-primary btn-block">
                                  UPDATE QUESTION <i class="fe fe-download"></i>
                                </button>
                            </div>
                        </div>
                          </div>
                        <div class="col-md-6">
                                <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-label"><i class="fe fe-check-square"></i> Option 1</label>
                                    <textarea class="form-control" name="option1"><?php echo $qdet['option1'];?></textarea>
                                </div>
                          </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-label"><i class="fe fe-check-square"></i> Option 2</label>
                                    <textarea class="form-control" name="option2"><?php echo $qdet['option2'];?></textarea>
                                </div>
                          </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-label"><i class="fe fe-check-square"></i> Option 3</label>
                                    <textarea class="form-control" name="option3"><?php echo $qdet['option3'];?></textarea>
                                </div>
                          </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-label"><i class="fe fe-check-square"></i> Option 4</label>
                                    <textarea class="form-control" name="option4"><?php echo $qdet['option4'];?></textarea>
                                </div>
                            </div>
                          <div class="col-md-12"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-label"><i class="fe fe-check-circle text-success"></i> Answer</label>
                                    <select class="form-control" name="answer" required>
                                        <option value="<?php echo $qdet['answer'];?>" ><?php echo "Option ".$qdet['answer'];?></option>
                                        <option value="1"> Option 1</option>
                                        <option value="2"> Option 2</option>
                                        <option value="3"> Option 3</option>
                                        <option value="4"> Option 4</option>
                                    </select>
                                </div>
                            </div>
                      </div>
                          </div>
                      </div>
                    <div class="form-footer">

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
<?php include 'layout/footer.php'; ?>
