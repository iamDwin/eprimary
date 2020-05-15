<?php
$active = 'hassigns';
include 'layout/header.php';

if(isset($_POST['addAssign'])){
    //COUNT NUMBER OD COURSE AND LEC...
    $numcid = count($_POST['cID']);
    $numlecid = count($_POST['lecID']);

    if($numcid > 0 && $numlecid > 0){
        for($c = 0, $l = 0; $c < $numcid, $l < $numcid; $c++, $l++){
            $cID = trim(htmlentities($_POST['cID'][$c]));
            $lecID = trim(htmlentities($_POST['lecID'][$l]));
            //ENSURE UNEMPTY FIELDS...
            if(!empty($cID) && !empty($lecID)){
                //CHECK COURSE ALREADY ASSINGED..
                $slcourse = select("SELECT * FROM cmanagement WHERE cID='$cID'");
                if($slcourse){
                    $error = "<script>document.write('COURSE ALREADY ASSIGNED..!');</script>";
                }else{
                    //check max number of lecturer courses...
                    //$numlec = select("SELECT * FROM cmanagement WHERE lecID='$lecID'");
//                    if($numlec){
//                        $countnum = count($numlec);
//                        if($countnum >= 6){
//                            $error = "<script>document.write('LECTURER ".$lecID." HAS REACHED MAX NUMBER OF COURSES.!');</script>";
//                        }
//                    }else{
                        $saveassgn = $cmanage->addcmanage($userDet['depID'],$cID,$lecID,$dateToday);
                        if($saveassgn){
                            $success = "<script>document.write('COURSE ASSIGNED SUCCESFUL..!');window.location.href='./hassigns';</script>";
                        }else{
                            $error = "<script>document.write('COURSE ASSIGN FAILED, TRY AGAIN..!');</script>";
                        }
                    //}
                }
            }else{
                $error = "<script>document.write('EMPTY FIELDS, CAN'T SAVE..!');</script>";
            }

        }
    }else{
        $error = "<script>document.write('NO DATA TO SAVE..!');</script>";
    }
}

?>

<div class="my-3 my-md-5">
    <div class="container">
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
                  <h3 class="card-title">
                      <i class="fe fe-layers"></i> <i class="fe fe-chevron-right"></i> <i class="fe fe-users"></i> Assign Courses
                    </h3>
                </div>
                <div class="card-body">
                  <form class="form" method="post" enctype="multipart/form-data" onsubmit="return confirm('SAVE ASSIGNINGS ?');" >
                      <table id="dynamic_field4" class="table table-bordered" width="100%">
                            <thead>
                                <th style="width:40%;"><i class="fe fe-layers"></i> Course<span class="form-required">*</span></th>
                                <th><i class="fe fe-user"></i> Lecturer<span class="form-required">*</span></th>
                                <th></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php
                                            $allcourse = $course->find_by_depID($userDet['depID']);
                                            if($allcourse){
                                        ?>
                                        <select class="form-control" name="cID[]" required>
                                            <option></option>
                                            <?php foreach($allcourse as $courserow){ ?>
                                            <option value="<?php echo $courserow['cID'];?>"><?php echo $courserow['courseName'];?></option>
                                            <?php }?>
                                        </select>
                                        <?php }else{ ?>
                                        <input type="text" name="" class="form-control" value="No Course Available" readonly >
                                        <?php }?>
                                    </td>
                                    <td>
                                         <?php
                                            $alllec = $lecturer->find_all_lecdep($userDet['depID']);
                                            if($alllec){
                                        ?>
                                        <select class="form-control" name="lecID[]" required>
                                            <option></option>
                                            <?php foreach($alllec as $lecrow){ ?>
                                            <option value="<?php echo $lecrow['lecID'];?>"><?php echo $lecrow['firstName']." ".$lecrow['lastName'];?></option>
                                            <?php }?>
                                        </select>
                                        <?php }else{ ?>
                                        <input type="text" name="" class="form-control" value="No Lecturer Available" readonly >
                                        <?php }?>
                                    </td>
            <td><button type="button" name="add" id="add4" class="btn btn-primary btn-block">  ADD MORE <i class="fe fe-plus-square"></i></button></td>
                                </tr>
                            </tbody>
                      </table>
                      <div class="row">
                          <div class="col-md-8"></div>
                        <div class="col-md-4">
                          <div class="form-footer">
                            <button type="submit" name="addAssign" class="btn btn-primary btn-block" <?php if(!$allcourse){ echo "disabled";}?> >
                              SAVE ASSIGNINGS <i class="fe fe-download"></i>
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
                          <th><i class="fe fe-hash"></i> COURSE ID</th>
                          <th><i class="fe fe-layers"></i> COURSE</th>
                          <th><i class="fe fe-users"></i> LECTURER</th>
                          <th class="text-center"><i class="fa fa-cog"></i>  ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $allcm = $cmanage->find_by_depID($userDet['depID']);
                          if($allcm){
                              foreach($allcm as $crow){
                              //get course name
                              $cname = select("SELECT * FROM courses WHERE cID='".$crow['cID']."'");
                              foreach($cname as $cnrow){}
                            //get lecturer
                            $lname = select("SELECT * FROM lecturer WHERE lecID='".$crow['lecID']."'");
                                  foreach($lname as $lrow){}
                          ?>
                        <tr>
                          <td><div><?php echo $crow['cID'];?></div></td>
                          <td><?php echo $cnrow['courseName'];?></td>
                          <td><?php echo $lrow['lastName']." ".$lrow['firstName']." ".$lrow['otherName'];?></td>
                          <td class="text-center">

                              <a href="./hupassigns?cm=<?php echo $crow['assignID'];?>" class="btn btn-primary btn-sm btn-square">
                                Details  <i class="fe fe-file-text"></i>
                              </a>

                          </td>
                        </tr>
                          <?php }}else{?>
                          <tr>
                            <td colspan="3"> No <i class="fe fe-layers"></i> Assignments Saved.</td>
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
            $('#dynamic_field4').append('<tr id="row'+i+'"><td><?php $allcourse = $course->find_by_depID($userDet['depID']); if($allcourse){ ?><select class="form-control" name="cID[]" required> <option></option> <?php foreach($allcourse as $courserow){ ?> <option value="<?php echo $courserow['cID'];?>"><?php echo $courserow['courseName'];?></option> <?php }?> </select> <?php }else{ ?> <input type="text" name="" class="form-control" value="No Course Available" readonly > <?php }?> </td> <td> <?php $alllec = $lecturer->find_all_lecdep($userDet['depID']); if($alllec){ ?> <select class="form-control" name="lecID[]" required> <option></option> <?php foreach($alllec as $lecrow){ ?> <option value="<?php echo $lecrow['lecID'];?>"><?php echo $lecrow['firstName']." ".$lecrow['lastName'];?></option> <?php }?> </select> <?php }else{ ?> <input type="text" name="" class="form-control" value="No Lecturer Available" readonly > <?php }?> </td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
        });

        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });
    });
</script>
<?php include 'layout/footer.php'; ?>
