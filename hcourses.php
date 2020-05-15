<?php
$active = 'hcourses';
include 'layout/header.php';

if(isset($_POST['REGCOURSE'])){
    //count the variables..
    $cIDNum = count($_POST['cID']);
    $cnNum = count($_POST['courseName']);
    $lnum = count($_POST['level']);
    $snum = count($_POST['semester']);
    $depID = $userDet['depID'];

    if($cIDNum > 0 && $cnNum > 0 && $lnum > 0 && $snum > 0){
        for($id=0, $nm=0, $lv=0, $s=0; $id<$cIDNum, $nm<$cnNum, $lv<$lnum, $s<$snum; $id++, $nm++, $lv++, $s++){
            $cID = trim(htmlentities($_POST['cID'][$id]));
            $courseName = trim(htmlentities($_POST['courseName'][$nm]));
            $level = trim(htmlentities($_POST['level'][$lv]));
            $semester = trim(htmlentities($_POST['semester'][$s]));
            if(!empty($cID) && !empty($courseName) && !empty($level) && !empty($semester)){
                     //check if course code exists..
                    $codesql = select("SELECT * FROM courses WHERE cID='$cID'");
                if($codesql){
                    $error = "<script>document.write('COURSE CODE ALREADY USED...');</script>";
                }else{
                    //check course name exists...
                    $namesql = select("SELECT * FROM courses WHERE courseName='$courseName'");
                    if($namesql){
                        $error = "<script>document.write('COURSE NAME ALREADY USED...');</script>";
                    }else{
                        //insert courses into table after checks...
                        $insertcourse =$course->addcourse($cID,$depID,$courseName,$level,$semester,$dateToday);
                        //$depnamedir =  str_replace(' ','-', $departmentName);
                           echo make_dir($cID);
                        if($insertcourse){
                           $success = "<script>document.write('COURSE CREATED SUCCESSFULL.');window.location.href='hcourses';</script>";
                        }else{
                            $error = "<script>document.write('COURSE CREATION FAILED, TRY AGAIN.');</script>";
                        }
                    }

                }
            }else{
                $error = "<script>document.write('EMPTY FIELDS..');</script>";
            }

        }
    }else{
        $error = "<script>document.write('EMPTY FIELDS TO SAVE.');</script>";
    }
}

?>

<div class="my-3 my-md-5">
    <div class="container">
<!--        <div class="page-header">-->
<!--          <h1 class="page-title"> <i class="fe fe-users"></i>  Lecturers </h1>-->
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
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title"><i class="fe fe-layers"></i> Create Courses</h3>
                </div>
                <div class="card-body">
                  <form class="form" method="post" enctype="multipart/form-data" onsubmit="return confirm('SAVE COURSES ?');" >
                      <table id="dynamic_field4" class="table table-bordered" width="100%">
                            <thead>
                                <th width="15%">Course ID<span class="form-required">*</span></th>
                                <th>Course Name<span class="form-required">*</span></th>
                                <th>Level<span class="form-required">*</span></th>
                                <th>Semester<span class="form-required">*</span></th>
                                <th></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="cID[]" class="form-control" placeholder="Course ID" required></td>
                                    <td><input type="text" name="courseName[]" class="form-control" placeholder="Course Name" required ></td>
                                    <td>
                                        <select class="form-control" name="level[]" required>
                                            <option></option>
                                            <option value="100">100</option>
                                            <option value="200">200</option>
                                            <option value="300">300</option>
                                            <option value="400">400</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="semester[]" required>
                                            <option></option>
                                            <option value="1">1st Semester</option>
                                            <option value="2">2nd Semester</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button type="button" name="add" id="add4" class="btn btn-primary btn-block">
                                            ADD MORE <i class="fe fe-plus-square"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                      </table>

                      <div class="row">
                          <div class="col-md-8"></div>
                        <div class="col-md-4">
                          <div class="form-footer">
                                <button type="submit" name="REGCOURSE" class="btn btn-primary btn-block" >
                                  CREATE COURSES <i class="fe fe-download"></i>
                                </button>
                            </div>
                          </div>
                      </div>

                  </form>
                </div>
              </div>
            </div>


              <div class="col-md-12">
                <div class="card">
                  <div class="table-responsive">
                    <table id="example" class="table table-hover table-outline table-vcenter text-nowrap card-table datatable">
                      <thead>
                        <tr>
                          <th><i class="fe fe-hash"></i> ID</th>
                          <th class="text-center"><i class="fe fe-grid"></i> COURSE</th>
                          <th class="text-center"><i class="fe fe-bar-chart"></i> LEVEL</th>
                          <th class="text-center"><i class="fe fe-grid"></i> SEMESTER</th>
                          <th class="text-center"><i class="fa fa-cog"></i>  ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $allcourse = $course->find_by_depID($userDet['depID']);
                          if($allcourse){
                              foreach($allcourse as $crow){
                          ?>
                        <tr>
                          <td>
                            <div><?php echo $crow['cID'];?></div>
                          </td>
                          <td class="text-center"> <?php echo $crow['courseName'];?> </td>
                          <td class="text-center"> <?php echo $crow['level'];?> </td>
                          <td class="text-center"> <?php echo $crow['semester'];?> </td>
                          <td class="text-center">
                              <a href="./hupcourse?c=<?php echo $crow['cID'];?>" class="btn btn-primary btn-sm"><i class="fe fe-file-text"></i> Details</a>
                          </td>
                        </tr>
                          <?php }}else{?>
                          <tr>
                            <td colspan="3"> No <i class="fe fe-layers"></i> Courses Registered.</td>
                          </tr>
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
    $(document).ready(function(){
        var i=1;
        $('#add4').click(function(){
            i++;
            $('#dynamic_field4').append('<tr id="row'+i+'"><td><input type="text" name="cID[]" class="form-control" placeholder="Course ID" required></td><td><input type="text" name="courseName[]" class="form-control" placeholder="Course Name" required ></td><td><select class="form-control" name="level[]" required><option></option><option value="100">100</option><option value="200">200</option><option value="300">300</option><option value="400">400</option></select></td><td><select class="form-control" name="semester[]" required><option></option><option value="1">1st Semester</option><option value="2">2nd Semester</option></select></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
        });

        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });
    });
</script>
<?php include 'layout/footer.php'; ?>
