<?php
$active = 'students';
include 'layout/header.php';

$numStu = $student->find_num_student();
$stuNum = $numStu + 1;
$studID =  "PUC/19".sprintf('%04s',$stuNum);

if(isset($_POST['addStu'])){
    $studentID = trim(htmlspecialchars($_POST['studentID']));
    $firstName = trim(htmlspecialchars($_POST['firstName']));
    $lastName = trim(htmlspecialchars($_POST['lastName']));
    $otherName = trim(htmlspecialchars($_POST['otherName']));
    $email = trim(htmlspecialchars($_POST['email']));
    $phone = trim(htmlspecialchars($_POST['phone']));
    $school = trim(htmlspecialchars($_POST['school']));
    $level = trim(htmlspecialchars($_POST['level']));
    $depID = trim(htmlspecialchars($_POST['depID']));
    $position = trim(htmlspecialchars('student'));
    $password = rand(8,122).rand(500,680).date('i');
    $flogin = 1;
    $fullname = $firstName." ".$otherName." ".$lastName;

    $chekPhone = $student->checkphone($phone);
    if($chekPhone){
        $error = "<script>document.write('PHONE NUMBER ALREADY USED.');</script>";
    }else{
        $chekmail = $student->checkmail($email);
        if($chekmail){
            $error = "<script>document.write('EMAIL ADDRESS ALREADY USED.');</script>";
        }else{

                //SEND SMS TO LECTURER....
                $tel = clean($phone);
                $body = "Hello ".$fullname.", Your Account has been created succesfully, use code ".$password." on first log in To change your password";
                $sendsms =  sendsmsme($tel,$body);

                //SEND MAIL TO LECTURER...
                $send_to = $email;
                $copy = '';
$body = "Hello ".$fullname.", Your Account has been created succesfully, use code ".$password." on first log in to change your password";
                $subj = "ELEARNING STUDENT ACCOUNT";
                $SENDMAIL = send_mail($email,'',$body,$subj);

            $addLec = $student->addstudent($studentID,$depID,$firstName,$lastName,$otherName,$email,$phone,$school,$level,$dateToday);
            $adduser = $user->addUser($studentID,$email,$password,$position,$flogin,$dateToday);

            if($addLec && $adduser){
                $success = "<script>document.write('STUDENT REGISTRATION SUCCESSFULL.');window.location.href='mstudents';</script>";
            }else{
                $error = "<script>document.write('STUDENT REGISTRATION FAILED, TRY AGAIN.');</script>";
            }
        }
    }
}

?>

<div class="my-3 my-md-5">
    <div class="container">
<!--
        <div class="page-header">
          <h1 class="page-title"> <i class="fe fe-users"></i>  Students </h1>
        </div>
-->
        <div class="row">
            <div class="col-md-6">
            <div class="card">
<!--
                <div class="card-header">
                  <h3 class="card-title"><i class="fe fe-user-plus"></i> Register Students</h3>
                </div>
-->
                <div class="card-body">
                  <form class="form" method="post" enctype="multipart/form-data" onsubmit="return confirm('CONFIRM REGISTRATION.');" >

                      <div class="row">
                          <div class="col-md-6">
                          <div class="form-group">
                            <div class="input-icon">
                                <span class="input-icon-addon"><i class="fe fe-hash"></i><span class="form-required">*</span></span>
                                <input type="text" name="studentID" class="form-control" value="<?php echo $studID;?>" placeholder="Lecturer ID" readonly>
                            </div>
                          </div>
                          </div>
                        <div class="col-md-6">
                          <div class="form-group">
                        <div class="input-icon">
                            <span class="input-icon-addon"><i class="fe fe-user"></i><span class="form-required">*</span></span>
                            <input type="text" name="firstName" class="form-control" placeholder="First Name" required >
                        </div>
                      </div>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                        <div class="input-icon">
                            <span class="input-icon-addon"><i class="fe fe-user"></i><span class="form-required">*</span></span>
                            <input type="text" name="lastName" class="form-control" placeholder="Last Name" required >
                        </div>
                      </div>
                          </div>
                        <div class="col-md-6">
                          <div class="form-group">
                        <div class="input-icon">
                            <span class="input-icon-addon"><i class="fe fe-user"></i></span>
                            <input type="text" name="otherName" class="form-control" placeholder="Other Name">
                        </div>
                      </div>
                          </div>
                      </div>

                      <div class="form-group">
                        <div class="input-icon">
                            <span class="input-icon-addon"><i class="fe fe-mail"></i><span class="form-required">*</span></span>
                            <input type="email" name="email" class="form-control" placeholder="Valid Email" required>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="input-icon">
                                <span class="input-icon-addon"><i class="fe fe-phone"></i><span class="form-required">*</span></span>
                                <input type="tel" name="phone" class="form-control" placeholder="Active Phone" required>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                              <div class="form-group">
                                <div class="input-icon">
                                    <span class="input-icon-addon"><i class="fe fe-bar-chart"></i><span class="form-required">*</span></span>
                                    <select class="form-control" name="level">
                                        <option> -- Select Level --</option>
                                        <option value="100"> 100 </option>
                                        <option value="200"> 200 </option>
                                        <option value="300"> 300 </option>
                                        <option value="400"> 400 </option>
                                    </select>
                                </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label class="form-label"><i class="fe fe-folder"></i> School<span class="form-required">*</span></label>
                                <div class="input-icon">
                                    <select class="form-control" name="school" required>
                                        <option></option>
                                        <option value="Regular"> Regular</option>
                                        <option value="Evening"> Evening</option>
                                        <option value="Weekend"> Weekend</option>
                                    </select>
                                </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label"><i class="fe fe-grid"></i> Department Name</label>
                                <?php
                                $finddep = $department->find_all_dep();
                                if($finddep){
                                ?>
                                <select name="depID" class="form-control" required>
                                    <option></option>
                                    <?php
                                    foreach($finddep as $deprow){
                                    ?>
                                    <option value="<?php echo $deprow['depID'];?>" > <?php echo $deprow['departmentName'];?> </option>
                                    <?php }?>
                                </select>
                                <?php }else{ ?>
                              <input type="text" name="depID" class="form-control" value="NO DEPARTMENT CREATED" readonly disabled />
                                <?php }?>
                            </div>
                          </div>
                      </div>

                    <div class="form-footer">
                        <button type="submit" name="addStu" class="btn btn-primary btn-block" <?php if(!$finddep){ echo 'disabled';}?> >
                          REGISTER STUDENT <i class="fe fe-download"></i>
                        </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>


              <div class="col-md-6">
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
                  <div class="table-responsive">
                    <table id="example" class="table table-hover table-outline table-vcenter text-nowrap card-table datatable">
                      <thead>
                        <tr>
                          <th><i class="fe fe-hash"></i>  ID</th>
                          <th class="text-center"><i class="fe fe-grid"></i> FULL NAME</th>
                          <th class="text-center"><i class="fa fa-cog"></i>  ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $allstu = $student->find_all_student();
                          if($allstu){
                              foreach($allstu as $sturow){
                          ?>
                        <tr>
                          <td>
                            <div><?php echo $sturow['studentID'];?></div>
                          </td>
                          <td class="text-center">
                              <?php echo $sturow['lastName']." ".$sturow['firstName']." ".$sturow['otherName'];?>
                          </td>
                          <td class="text-center">

                              <a href="./upstudent?st=<?php echo $sturow['studentID'];?>" class="btn btn-info btn-sm text-white"><i class="fe fe-file-text"></i> Details</a>
<!--
                              ||
                              <a onclick="return confirm('CONFIRM DELETE');" href="./#?st=<?php echo $sturow['studentID'];?>" class="btn btn-danger btn-sm text-white disabled"><i class="fe fe-trash"></i> Trash</a>
-->
                          </td>
                        </tr>
                          <?php }}else{?>
                          <tr>
                            <td colspan="3"> No <i class="fe fe-users"></i> Student Registered.</td>
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
function facdep(val){
// load the select option data into a div
    $('#loader').html("Please Wait...");
    $('#dept').load('load/lecdep.php?fid='+val, function(){
    $('#loader').html("");
   });
}
</script>
<?php include 'layout/footer.php'; ?>
