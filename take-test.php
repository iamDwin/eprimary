<?php
$active = 'ltests';
include 'layout/header.php';

if(isset($_GET['tid'])){
    $tid = $_GET['tid'];
}
$_SESSION['current_page']=$_SERVER['REQUEST_URI'];

//get test details...
$testdetails = select("SELECT * FROM test WHERE testID='$tid'");
foreach($testdetails as $testdet){}

//get course...
$course = select("SELECT * FROM courses WHERE cID='".$testdet['cID']."'");
foreach($course as $courserow){}

//GET LECTURE DETAILS..
$lecture = select("SELECT * FROM lecture WHERE cID='".$testdet['cID']."' AND lecNum='".$testdet['lecture']."'");
foreach($lecture as $lecturerow){}

//get questions query...
$questions = select("SELECT * FROM objtest WHERE testID='$tid'");
$counters = 0;
?>

<script>
function start_countdown()
{
 var counter=<?php echo $testdet['duration']; ?>;
 myVar= setInterval(function()
 {
  if(counter>=0)
  {
   document.getElementById("countdown").innerHTML="YOU WILL BE LOGGED OUT IN "+counter+" SECONDS.";
  }
  if(counter==0)
  {
   $.ajax
   ({
     type:'post',
     url:'logout.php?test=logout',
     data:{
      logout:"logout"
     },
     success:function(response)
     {
      window.location="";
     }
   });
   }
   counter--;
 }, 1000)
}
</script>
<script >start_countdown();</script>
<div class="my-3 my-md-5">
    <div class="container">
         <div class="page-header">
          <h5 class="page-title" style="font-size:120%;">
           <?php echo strtoupper($courserow['courseName']);?> TEST <?php echo $tid;?>
          </h5>
        </div>
        <div class="row">
<!--            <div class="col-md-2"></div>-->
            <div class="col-sm-12">
            <div class="card">
                <div class="card-header" style="width:100%;">
                    <h5 class="card-title text-center text-danger" style="font-size:85%;"  id="countdown"> </h5>
                </div>
                  <form class="form" method="post" enctype="multipart/form-data" onsubmit="return confirm('SUBMIT ANSWERS ?');" >
                <div class="card-body">
                      <?php
                      foreach($questions as $questionsrow){
                          $counters ++;
                      ?>
                     <div class="form-group">
                        <div class="form-label"><?php echo "Q".$counters;?>. <?php echo $questionsrow['question'];?></div>
                        <div class="custom-controls-stacked">

                            <div class="row">
                                <?php if(!empty($questionsrow['option1'])){ ?>
                                <div class="col-md-6">
                                    <label class="custom-control custom-radio">
<input type="radio" class="custom-control-input" name="ans<?php echo $questionsrow['qid'];?>" value="1" onchange="fetch_select(this.value);">
                                        <span class="custom-control-label"><?php echo $questionsrow['option1'];?></span>
                                      </label>
                <input type="hidden" name="q<?php echo $questionsrow['qid']; ?>" value="<?php echo $questionsrow['qid']; ?>" >
                <input type="hidden" name="c<?php echo $questionsrow['qid']; ?>" value="<?php echo $questionsrow['testID']; ?>" >
                                </div>
                                <?php }else{ echo ""; }?>
                                <?php if(!empty($questionsrow['option2'])){ ?>
                                <div class="col-md-6">
                                    <label class="custom-control custom-radio">
<input type="radio" class="custom-control-input" name="ans<?php echo  $questionsrow['qid'];?>" value="2" onchange="fetch_select(this.value);">
                                        <span class="custom-control-label"><?php echo $questionsrow['option2'];?></span>
                                      </label>
                <input type="hidden" name="q<?php echo $questionsrow['qid']; ?>" value="<?php echo $questionsrow['qid']; ?>" >
                <input type="hidden" name="c<?php echo $questionsrow['qid']; ?>" value="<?php echo $questionsrow['testID']; ?>" >
                                </div>
                                <?php }else{ echo ""; }?>
                                <?php if(!empty($questionsrow['option3'])){ ?>
                                <div class="col-md-6">
                                    <label class="custom-control custom-radio">
<input type="radio" class="custom-control-input" name="ans<?php echo  $questionsrow['qid'];?>" value="3" onchange="fetch_select(this.value);">
                                        <span class="custom-control-label"><?php echo $questionsrow['option3'];?></span>
                                      </label>
                <input type="hidden" name="q<?php echo $questionsrow['qid']; ?>" value="<?php echo $questionsrow['qid']; ?>" >
                <input type="hidden" name="c<?php echo $questionsrow['qid']; ?>" value="<?php echo $questionsrow['testID']; ?>" >
                                </div>
                                <?php }else{ echo ""; }?>
                                <?php if(!empty($questionsrow['option4'])){ ?>
                                <div class="col-md-6">
                                    <label class="custom-control custom-radio">
<input type="radio" class="custom-control-input" name="ans<?php echo  $questionsrow['qid'];?>" value="4" onchange="fetch_select(this.value);">
                                        <span class="custom-control-label"><?php echo $questionsrow['option4'];?></span>
                                      </label>
                <input type="hidden" name="q<?php echo $questionsrow['qid']; ?>" value="<?php echo $questionsrow['qid']; ?>" >
                <input type="hidden" name="c<?php echo $questionsrow['qid']; ?>" value="<?php echo $questionsrow['testID']; ?>" >
                                </div>
                                <?php }else{ echo ""; }?>
                            </div>
                        </div>
                      </div>
                    <hr/>

                <?php
                    if(isset($_POST['ans'. $questionsrow['qid']])){
                        $ansa = $_POST['ans'.$questionsrow['qid']];
                        $qu = $_POST['q'.$questionsrow['qid']];
                        $ca = $_POST['c'.$questionsrow['qid']];

                        //get right answer
                        $right_sql = select("SELECT * FROM objtest WHERE testID='$ca' AND qid='$qu' ");
                        foreach($right_sql as $q_num){};


                        if($ansa == $q_num['answer']){
                            $mark = $testdet['questionMark'];
                        }else{
                            $mark = '0';
                        }
                        //check student hasnt taken test already..
                        $check = select("SELECT * FROM objans WHERE studentID='".$userDet['studentID']."' AND testID='$ca' AND qid='$qu'");
                        if($check){
                            echo "<script>window.location.href='score?tid={$tid}';</script>";
                        }else{
                             $answer_sqll = insert("INSERT INTO objans(testID,qid,studentID,answer,right_ans,score,doe) VALUES('$ca','$qu','".$userDet['studentID']."','$ansa','".$q_num['answer']."','$mark','$dateToday')");
                        }


                    }
                ?>
                      <?php } ?>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <button type="submit" name="subanser" class="btn btn-primary btn-block">
                              SUBMIT ANSWERS <i class="fe fe-file-text"></i>
                            </button>
                        </div>
                    </div>
                </div>
                 </form>
                 <?php

                    if(isset($_POST['subanser'])){
                        $settesactive = update("UPDATE users SET userstatus='testactive' WHERE userID='".$userDet['studentID']."'");
                        if($settesactive){
                            echo "<script>window.location.href='score?tid={$tid}';</script>";
                        }

                    }

                ?>
              </div>
            </div>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
