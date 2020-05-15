<?php
$active = 'sreports';
include 'layout/header.php';
//$studentID = $userDet['studentID'];
if(isset($_GET['tid'])){
    $tid = $_GET['tid'];
    $sid = $_GET['sid'];
    $gettest = select("SELECT * FROM test WHERE testID='$tid'");
    foreach($gettest as $testrow){}
}
$_SESSION['current_page']=$_SERVER['REQUEST_URI'];

//TOTAL QUESTIONS
$quetn = select("SELECT * FROM objtest WHERE testID='$tid'");
$numquestions = count($quetn);
//TOTAL MARKS
$totalamrks = $numquestions * $testrow['questionMark'];

//CORRECT ANSWERS
$correct = select("SELECT * FROM objans WHERE score !='0' AND studentID='$sid'");
$numcorrect = count($correct);
$correctMarks = $numcorrect * $testrow['questionMark'];

//WRONG ANSWERS
$wrong = select("SELECT * FROM objans WHERE score ='0' AND studentID='$sid'");
$numwrong = count($wrong);

//UNATTEMPTED QUESTIONS
$numoftotalanswer = $numcorrect + $numwrong;
$unanswered = $numquestions - $numoftotalanswer;

//TEST STATUS..
if($correctMarks >= $testrow['passMark']){
//    $testStatus = "<span class='tag tag-green text-bold'> PASS</span>";
    $testStatus = "PASS";
}else{
    $testStatus = "FAILED";
}

//GET STUDENT DETAILS..
$studentinfo = select("SELECT * FROM student WHERE studentID='$sid'");
if($studentinfo){
    foreach($studentinfo as $strow){}
}
?>

<div class="my-3 my-md-5">
    <div class="container">
        <div class="row">
<!--            <div class="col-md-2"></div>-->
            <div class="col-sm-12">
            <div class="card">
                  <form class="form" method="post" enctype="multipart/form-data">
                <div class="card-body">

                      <table class="table table-stripped">
                          <thead>
                              <th class="text"><h4> TEST <?php echo $tid; ?> REPORT</h4></th>
                              <th class="text-bold"> <?php echo $testrow['passMark']." Pass Mark"; ?></th>
                          </thead>
                            <tr>
                                <td> STUDENT DETAILS </td>
                                <td class="text-bold"> <?php echo $strow['firstName']." ".$strow['otherName']." ".$strow['lastName'];?> </td>
                            </tr>
                            <tr>
                                <td>TEST SCORE</td> <td class="text-bold"><?php echo $correctMarks." / ".$totalamrks; ?></td>
                            </tr>
                            <tr>
                                <td>TOTAL QUESTIONS</td> <td class="text-bold"><?php echo $numquestions." Questions"; ?></td>
                            </tr>
                            <tr>
                                <td>CORRECT ANSWERS</td> <td class="text-bold"><?php echo $numcorrect." (".$correctMarks." Marks )";?></td>
                            </tr>
                            <tr>
                                <td>WRONG ANSWERS</td>   <td class="text-bold"><?php echo $numwrong; ?></td>
                            </tr>
                            <tr>
                                <td>UNATTEMPTED QUESTIONS</td> <td class="text-bold"><?php echo $unanswered; ?></td>
                            </tr>
                            <tr>
                                <td>TEST STATUS</td>     <td class="text-bold"><?php if($testStatus == 'PASS'){ echo "<span class='tag tag-green text-bold'> PASS</span>"; }else{ echo "<span class='tag tag-red text-bold'> FAILED</span>";} ?></td>
                            </tr>
                      </table>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-3"><a class="btn btn-primary btn-block" href="javascript:history.back()">
                                    <i class="fe fe-arrow-left mr-2"></i>Go back
                                </a></div>
                            <div class="col-md-9">
                            </div>
                        </div>
                    </div>
                </form>

                <?php
                if(isset($_POST['finish'])){
                    //chek existing report..
                    $check = select("SELECT * FROM generalreport WHERE studentID='$studentID' AND testID='$tid'");
                    if($check){
                        echo "<script>window.location.href='logout';</script>";
                    }else{
                        $savereport = insert("INSERT INTO generalreport(studentID,cID,testID,totalScore,teststatus) VALUES('$studentID','".$testrow['cID']."','$tid','$correctMarks','$testStatus')");
                        if($savereport){
                            echo "<script>window.location.href='logout';</script>";
                        }
                    }

                }
                ?>
              </div>
            </div>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
