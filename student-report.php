<?php
$active = 'sreports';
include 'layout/header.php';

//if(isset($_GET['tid'])){
//    $tid = $_GET['tid'];
//    $test = select("SELECT * FROM test WHERE testID='$tid'");
//    foreach($test as $testrow){}
//}

//get all test taken by student..
$getreprt = select("SELECT * FROM generalreport WHERE studentID='".$userDet['studentID']."'");


$_SESSION['current_page']=$_SERVER['REQUEST_URI'];

?>

<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
        <h1 class="page-title"> GENERAL TESTS REPORT</h1>
        </div>
        <div class="row">
              <div class="col-sm-12">
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
                          <th><i class="fe fe-hash"></i> COURSE</th>
                          <th class="text"><i class="fe fe-user"></i> TEST ID</th>
                          <th class="text"><i class="fe fe-check-square"></i> PASS MARK</th>
                          <th class="text"><i class="fe fe-check"></i> SCORE</th>
                          <th class="text"><i class="fe fe-check"></i> STATUS</th>
                          <th class="text-center"><i class="fa fa-cog"></i> ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
//                            $select = select("SELECT * FROM generalreport WHERE testID='$tid' ORDER BY totalScore DESC");
                            if($getreprt){
                                foreach($getreprt as $reportrow){
                                    //get course details...
                                    $crse = select("SELECT * FROM courses WHERE cID='".$reportrow['cID']."'");
                                    foreach($crse as $crserow){}

                                    //get test details..
                                    $gettest = select("SELECT * FROM test WHERE testID='".$reportrow['testID']."'");
                                    foreach($gettest as $tstrow){}
                          ?>
                          <tr>
                            <td> <?php echo $crserow['courseName'];?></td>
                            <td> <?php echo $reportrow['testID'];?></td>
                            <td> <?php echo $tstrow['passMark']; ?></td>
                            <td> <?php echo $reportrow['totalScore']; ?></td>
                            <td> <?php if($reportrow['teststatus'] == 'PASS'){?>
                                <span class="tag tag-green"> PASS</span>
                                <?php } if($reportrow['teststatus'] == 'FAILED'){?>
                                <span class="tag tag-red"> FAILED</span>
                                <?php } ?>
                            </td>
                            <td class="text-center"><a href="./detailed-report?tid=<?php echo $tstrow['testID']."&sid=".$reportrow['studentID']; ?>" class="btn btn-info"> Individual Report</a></td>
                          </tr>
                          <?php }}else{ ?>
                          <tr><td colspan="6"> NO TEST REPORTS YET.</td></tr>
                          <?php }?>
                      </tbody>
                        <tfoot style="border-top:1px solid #eee;">
                            <tr>
                                <td><a class="btn btn-primary btn-block" href="javascript:history.back()">
                                    <i class="fe fe-arrow-left mr-2"></i>Go back
                                </a></td>
                                <td colspan="6"></td>
                            </tr>
                        </tfoot>
                    </table>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
