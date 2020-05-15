<?php
$active = 'ltests';
include 'layout/header.php';

if(isset($_GET['aid'])){
    $aid = $_GET['aid'];
    $assgn = select("SELECT * FROM assignment_answers WHERE asID='$aid'");
    foreach($assgn as $assgnrow){}
}
$_SESSION['current_page']=$_SERVER['REQUEST_URI'];


//FORMULAR TO CALCULATE FOR PASSED AND FAILED PERCENTAGES...
//get total student who partook..
$numtestresult = count(select("SELECT * FROM assignment_answers WHERE asID='$aid'"));
$numofpassed = count(select("SELECT * FROM assignment_answers WHERE asID='$aid' AND status='PASS'"));
$numoffailed = count(select("SELECT * FROM assignment_answers WHERE asID='$aid' AND status='FAILED'"));

$passpercent = ($numofpassed/$numtestresult) * 100 ;
$failedpercent = ($numoffailed/$numtestresult) * 100 ;

?>

<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
        <h1 class="page-title">ASSIGNMENT <?php echo $aid;?> - GENERAL REPORT</h1>
        </div>
        <div class="row">
              <div class="col-sm-8">
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
                          <th><i class="fe fe-hash"></i> STUDENT ID</th>
                          <th class="text"><i class="fe fe-user"></i> NAME</th>
<!--                          <th class="text"><i class="fe fe-check-square"></i> PASS MARK</th>-->
<!--                          <th class="text"><i class="fe fe-check"></i> SCORE</th>-->
                          <th class="text"><i class="fe fe-check"></i> STATUS</th>
                          <th class="text-center"><i class="fa fa-cog"></i> ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                            $select = select("SELECT * FROM assignment_answers WHERE asID='$aid' ORDER BY score DESC");
                            if($select){
                                foreach($select as $reportrow){
                                    $student = select("SELECT * FROM student WHERE studentID='".$reportrow['studentID']."'");
                                    foreach($student as $studentrow){}
                          ?>
                          <tr>
                            <td> <?php echo $reportrow['studentID'];?></td>
                            <td> <?php echo $studentrow['firstName']." ".$studentrow['otherName']." ".$studentrow['lastName'];?></td>
<!--                            <td> <?php // echo $testrow['passMark']; ?></td>-->
<!--                            <td> <?php // echo $reportrow['totalScore']; ?></td>-->
                            <td> <?php if($reportrow['status'] == 'PASS'){?>
                                <span class="tag tag-green"> PASS</span>
                                <?php } if($reportrow['status'] == 'FAILED'){?>
                                <span class="tag tag-red"> FAILED</span>
                                <?php } ?>
                            </td>
                            <td class="text-center"><a href="./individualA-report?aid=<?php echo $aid."&sid=".$reportrow['studentID']; ?>" class="btn btn-primary"> View Answer <i class="fe fe-folder"></i></a></td>
                          </tr>
                          <?php }}else{ ?>
                          <tr><td colspan="6"> NO REPORTS FOR THIS TEST YET.</td></tr>
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


            <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title"> SCORES CHART</h3>
                  </div>
                  <div class="card-body">
                    <div id="chart-donut" style="height: 16rem"></div>
                  </div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                  	$(document).ready(function(){
                  		var chart = c3.generate({
                  			bindto: '#chart-donut', // id of chart wrapper
                  			data: {
                  				columns: [
                  				    // each columns data
                  					['data1', <?php echo $passpercent; ?>],
                  					['data2', <?php echo $failedpercent;?>]
                  				],
                  				type: 'donut', // default type of chart
                  				colors: {
                  					'data1': tabler.colors["green"],
                  					'data2': tabler.colors["red"]
                  				},
                  				names: {
                  				    // name of each serie
                  					'data1': 'Passed',
                  					'data2': 'Failed'
                  				}
                  			},
                  			axis: {
                  			},
                  			legend: {
                                  show: true, //hide legend
                  			},
                  			padding: {
                  				bottom: 0,
                  				top: 0
                  			},
                  		});
                  	});
                  });
                </script>
              </div>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
