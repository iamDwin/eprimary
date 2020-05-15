<?php
$active = 'dashboard';
include 'layout/header.php';
?>

<!-- ======================  START IT MANAGER DASHBOARD ==================== -->
<?php if($access == 'manager'){ ?>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6">
              <a href="./mfaculty" style="text-decoration:none; color:rgba(5, 5, 5, 0.62);">
                <div class="card">
                  <div class="card-body text-center">
                    <div class="h5"><i class="fe fe-list"></i>  FACULTY</div>
                    <div class="display-4 font-weight-bold mb-4"><?php echo $numFAc = $faculty->find_num_fac();?></div>
                  </div>
                </div>
              </a>
          </div>
          <div class="col-lg-3 col-md-6">
              <a href="./mdepartment" style="text-decoration:none; color:rgba(5, 5, 5, 0.62);">
                <div class="card">
                  <div class="card-body text-center">
                    <div class="h5"><i class="fe fe-grid"></i>  DEPARTMENTS</div>
                    <div class="display-4 font-weight-bold mb-4"><?php echo $numDep = $department->find_num_dep();?></div>
                  </div>
                </div>
              </a>
          </div>
          <div class="col-lg-3  col-md-6">
              <a href="./mlecturers" style="text-decoration:none; color:rgba(5, 5, 5, 0.62);">
                <div class="card">
                  <div class="card-body text-center">
                    <div class="h5"><i class="fe fe-users"></i>  LECTURERS</div>
                    <div class="display-4 font-weight-bold mb-4"><?php echo $numLec = $lecturer->find_num_lec();?></div>
                  </div>
                </div>
              </a>
          </div>
          <div class="col-lg-3 col-md-6">
              <a href="./mstudents" style="text-decoration:none; color:rgba(5, 5, 5, 0.62);">
                <div class="card">
                  <div class="card-body text-center">
                    <div class="h5"><i class="fe fe-users"></i> STUDENTS</div>
                    <div class="display-4 font-weight-bold mb-4"><?php echo $numStud = $student->find_num_student();?></div>
                  </div>
                </div>
              </a>
          </div>
        </div>
<!--
        <div class="row row-cards">
            <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Faculties : Departments</h3>
                  </div>
                  <div class="card-body">
                    <div id="chart-bar-stacked" style="height: 16rem"></div>
                  </div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                  	$(document).ready(function(){
                  		var chart = c3.generate({
                  			bindto: '#chart-bar-stacked', // id of chart wrapper
                  			data: {
                  				columns: [
                  				    // each columns data
                  					['data1', 3, 1, 1],
//                  					['data2', 7, 7, 5]
                  				],
                  				type: 'bar', // default type of chart
                  				groups: [
                  					[ 'data1']
                  				],
                  				colors: {
                  					'data1': tabler.colors["blue"],
//                  					'data2': tabler.colors["pink"]
                  				},
                  				names: {
                  				    // name of each serie
                  					'data1': 'Faculties',
//                  					'data2': 'Departments'
                  				}
                  			},
                  			axis: {
                  				x: {
                  					type: 'category',
                  					// name of each category
                  					categories: ['FESAC', 'FBA', 'FTM']
                  				},
                  			},
                  			bar: {
                  				width: 16
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
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Department : Lecturers</h3>
                  </div>
                  <div class="card-body">
                    <div id="chart-pie" style="height: 16rem"></div>
                  </div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                  	$(document).ready(function(){
                  		var chart = c3.generate({
                  			bindto: '#chart-pie', // id of chart wrapper
                  			data: {
                  				columns: [
                  				    // each columns data
                  					['data1', 63],
                  					['data2', 44],
                  					['data3', 12],
                  					['data4', 14]
                  				],
                  				type: 'pie', // default type of chart
                  				colors: {
                  					'data1': tabler.colors["blue-darker"],
                  					'data2': tabler.colors["blue"],
                  					'data3': tabler.colors["blue-light"],
                  					'data4': tabler.colors["blue-lighter"]
                  				},
                  				names: {
                  				    // name of each serie
                  					'data1': 'A',
                  					'data2': 'B',
                  					'data3': 'C',
                  					'data4': 'D'
                  				}
                  			},
                  			axis: {
                  			},
                  			legend: {
                                  show: false, //hide legend
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
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Department : Students</h3>
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
                  					['data1', 63],
                  					['data2', 37]
                  				],
                  				type: 'donut', // default type of chart
                  				colors: {
                  					'data1': tabler.colors["green"],
                  					'data2': tabler.colors["green-light"]
                  				},
                  				names: {
                  				    // name of each serie
                  					'data1': 'Maximum',
                  					'data2': 'Minimum'
                  				}
                  			},
                  			axis: {
                  			},
                  			legend: {
                                  show: false, //hide legend
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
-->
    </div>
</div>
<?php }?>
<!-- ======================  END IT MANAGER DASHBOARD ====================== -->





<!-- ======================  START HOD DASHBOARD =========================== -->
<?php if($access == 'hod'){
    $fac = $faculty->find_by_facID($userDet['facID']);
    foreach($fac as $facrow){}
    $dep = $department->find_by_depID($userDet['depID']);
    foreach($dep as $deprow){}
?>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
          <h1 class="page-title">
            <?php echo strtoupper($facrow['facultyName'])." - ".strtoupper($deprow['departmentName']);?>
          </h1>
        </div>

        <div class="row">
          <div class="col-lg-3 col-md-6">
              <a href="./hlecturers" style="text-decoration:none; color:rgba(5, 5, 5, 0.62);">
                <div class="card">
                  <div class="card-body text-center">
                    <div class="h5"><i class="fe fe-users"></i>  LECTURERS</div>
                    <div class="display-4 font-weight-bold mb-4"><?php echo $numLec = $lecturer->find_num_lecdep($userDet['depID']);?></div>
                  </div>
                </div>
              </a>
          </div>
          <div class="col-lg-3 col-md-6">
              <a href="./hstudents" style="text-decoration:none; color:rgba(5, 5, 5, 0.62);">
                <div class="card">
                  <div class="card-body text-center">
                    <div class="h5"><i class="fe fe-users"></i> STUDENTS</div>
                    <div class="display-4 font-weight-bold mb-4"><?php echo $numStud = $student->find_num_studentdep($userDet['depID']);?></div>
                  </div>
                </div>
              </a>
          </div>
          <div class="col-lg-3 col-md-6">
              <a href="./hcourses" style="text-decoration:none; color:rgba(5, 5, 5, 0.62);">
                <div class="card">
                  <div class="card-body text-center">
                    <div class="h5"><i class="fe fe-layers"></i> COURSES</div>
                    <div class="display-4 font-weight-bold mb-4"><?php echo $numStud = $course->find_num_coursesdep($userDet['depID']);?></div>
                  </div>
                </div>
              </a>
          </div>
          <div class="col-lg-3 col-md-6">
              <a href="./hgeneral-report" style="text-decoration:none; color:rgba(5, 5, 5, 0.62);">
                <div class="card">
                  <div class="card-body text-center">
                    <div class="h5"><i class="fe fe-file-text"></i> REPORTS</div>
                    <div class="display-4 font-weight-bold mb-4"><i class="fe fe-file-text"></i></div>
                  </div>
                </div>
              </a>
          </div>
        </div>
    </div>
</div>
<?php }?>
<!-- ======================  END HOD DASHBOARD ============================ -->





<!-- ======================  START LECTURER DASHBOARD ===================== -->
<?php if($access == 'lecturer'){
//get faculty details..
$getfac = select("SELECT * FROM faculty WHERE facID='".$userDet['facID']."'");
foreach($getfac as $facrow){}
//get department details..
$getdep = select("SELECT * FROM department WHERE depID='".$userDet['depID']."'");
foreach($getdep as $deprow){}

//get courses for level and department.
$getcourse = select("SELECT * FROM cmanagement WHERE depID='".$userDet['depID']."' AND lecID='".$userDet['lecID']."'");
if($getcourse){
    @$numcourses = count($getcourse);
    foreach($getcourse as $allcourserow){}
}
?>
<div class="my-3 my-md-5">
    <div class="container">
<!--
        <div class="page-header">
          <h1 class="page-title">
            Lecturer Dashboard
          </h1>
        </div>
-->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                 <div class="card">
                  <div class="card-body">
                    <div class="media">
                      <div class="media-body">
                    <h5 class="m-0"><?php echo strtoupper($userDet['lastName']." ".$userDet['firstName']." ".$userDet['otherName']);?></h5>
<!--                    <p class="text-mutd mb-0"><i class="fe fe-hash"></i> : <?php echo $userDet['lecID'];?></p>-->
                        <p class="text-mutd mb-0"><i class="fe fe-list"></i> : <?php echo $facrow['facultyName'];?></p>
                        <p class="text-mutd mb-0"><i class="fe fe-grid"></i> : <?php echo $deprow['departmentName'];?></p>
                        <p class="text-mutd mb-0"><i class="fe fe-mail"></i> : <?php echo $userDet['email'];?></p>
<!--                        <p class="text-mutd mb-0"><i class="fe fe-phone"></i> : <?php // echo $userDet['phone'];?></p>-->
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <a href="./lcourses" style="text-decoration:none; color:rgba(5, 5, 5, 0.62);">
                <div class="card">
                  <div class="card-body text-center">
                    <div class="h5"><i class="fe fe-layers"></i> ASSIGNED COURSES</div>
                    <div class="display-4 font-weight-bold mb-4"><?php echo (int)$numcourses;?></div>
                  </div>
                </div>
              </a>
            </div>
          <div class="col-lg-3 col-md-6">
              <a href="./inbox" style="text-decoration:none; color:rgba(5, 5, 5, 0.62);">
                <div class="card">
                  <div class="card-body text-center">
                    <div class="h5"><i class="fe fe-mail"></i> MESSAGES</div>
                    <div class="display-4 font-weight-bold mb-4"><?php if($msgs == ''){echo '0';}else{ echo $msgs;}?></div>
                  </div>
                </div>
              </a>
          </div>
            <div class="col-lg-3 col-md-6">
              <a href="ltests" style="text-decoration:none; color:rgba(5, 5, 5, 0.62);" class="disabled">
                <div class="card">
                  <div class="card-body text-center">
                    <div class="h5"><i class="fe fe-file"></i> ACTIVE TESTS</div>
                    <div class="display-4 font-weight-bold mb-4">0</div>
                  </div>
                </div>
              </a>
            </div>
        </div>
    </div>
</div>
<?php }?>
<!-- ======================  END LECTURER DASHBOARD ======================= -->





<!-- ======================  START STUDENT DASHBOARD ====================== -->
<?php if($access == 'student'){
$getdep = select("SELECT * FROM department WHERE depID='".$userDet['depID']."'");
foreach($getdep as $deprow){}

//get courses for level and department.
$getcourse = select("SELECT * FROM courses WHERE depID='".$userDet['depID']."' AND level='".$userDet['level']."'");
if($getcourse){
    $numcourses = count($getcourse);
    foreach($getcourse as $allcourserow){}
}

//get active assignment...
    $getassign = count(select("SELECT * FROM assignment WHERE level='".$userDet['level']."' AND status='active'"));
    if($getassign > 0){
        $getnumassign = $getassign;
    }else{
        $getnumassign = 0;
    }
?>
<div class="my-3 my-md-5">
    <div class="container">
<!--
        <div class="page-header">
          <h1 class="page-title">
            Student Dashboard
          </h1>
        </div>
-->

        <div class="row">
            <div class="col-lg-3 col-md-6">
                 <div class="card">
                  <div class="card-body">
                    <div class="media">
                      <div class="media-body">
                    <h5 class="m-0"> <?php echo strtoupper($userDet['lastName']." ".$userDet['firstName']." ".$userDet['otherName']);?></h5>
                    <p class="text-muted mb-0"><i class="fe fe-hash"></i> <?php echo $userDet['studentID'];?></p>
                        <p class="text-muted mb-0">D : <?php echo $deprow['departmentName'];?></p>
                        <p class="text-muted mb-0">L : <?php echo $userDet['level'];?></p>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <a href="./scourses" style="text-decoration:none; color:rgba(5, 5, 5, 0.62);">
                <div class="card">
                  <div class="card-body text-center">
                    <div class="h5"><i class="fe fe-layers"></i> COURSES</div>
                    <div class="display-4 font-weight-bold mb-4"><?php if($numcourses < 1 || $numcourses == ''){ echo '0';}else{ echo $numcourses;} ?></div>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-3 col-md-6">
              <a href="./sassignment" style="text-decoration:none; color:rgba(5, 5, 5, 0.62);">
                <div class="card">
                  <div class="card-body text-center">
                    <div class="h5"><i class="fe fe-file-text"></i> ASSIGNMENT</div>
                    <div class="display-4 font-weight-bold mb-4"><?php echo $getnumassign; ?></div>
                  </div>
                </div>
              </a>
            </div>
          <div class="col-lg-3 col-md-6">
              <a href="./student-report" style="text-decoration:none; color:rgba(5, 5, 5, 0.62);">
                <div class="card">
                  <div class="card-body text-center">
                    <div class="h5"><i class="fe fe-folder"></i> REPORTS</div>
                    <div class="display-4 font-weight-bold mb-4"><i class="fe fe-file-text"></i></div>
                  </div>
                </div>
              </a>
          </div>
        </div>
    </div>
</div>
<?php }?>
<!-- ======================  END STUDENT DASHBOARD ======================= -->

<?php include 'layout/footer.php'; ?>
