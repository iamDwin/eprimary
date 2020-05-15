<?php
include 'assets/core/connection.php';
$user = new User();
$student = new Student();
$success = '';
$error = '';
$dateToday = date("Y-m-d");

//register student function.....
if(isset($_POST['crtaccount'])){
    $studentID = trim(htmlspecialchars($_POST['studentID']));
    $firstName = trim(htmlspecialchars($_POST['firstName']));
    $lastName = trim(htmlspecialchars($_POST['lastName']));
    $otherName = trim(htmlspecialchars($_POST['otherName']));
    $email = trim(htmlspecialchars($_POST['email']));
    $phone = trim(htmlspecialchars($_POST['phone']));
    $school = trim(htmlspecialchars($_POST['school']));
    $level = trim(htmlspecialchars($_POST['level']));
    $depID = trim(htmlspecialchars($_POST['depID']));
    $fullname = $firstName." ".$otherName." ".$lastName;
    $position = trim(htmlspecialchars('student'));
    $password = rand(8,122).rand(500,680).date('i');
    $flogin = 1;


    //check studentID's existence in the system
    $checkID = count(select("SELECT * FROM student WHERE studentID='$studentID'"));
    if($checkID > 0){
        $error = "<script>document.write('ID ALREADY REGISTERED, CHECK AND TRY AGAIN.');</script>";
    }else{
        //checkemail existence in the system
        $checkmail = count(select("SELECT * FROM users WHERE email='$email'"));
        if($checkmail > 0){
            $error = "<script>document.write('EMAIL ALREADY REGISTERED, CHECK AND TRY AGAIN.');</script>";
        }else{
            //checkPhone's existence in the system..
            $checkphone = count(select("SELECT * FROM student WHERE phone='$phone'"));
            $checkphone2 = count(select("SELECT * FROM lecturer WHERE phone='$phone'"));
            if($checkphone > 0 || $checkphone2 > 0){
                $error = "<script>document.write('PHONE NUMBER ALREADY REGISTERED, CHECK AND TRY AGAIN.');</script>";
            }else{
                //compare passwords, make sure its the same...
                if($password !== $password){
                    $error = "<script>document.write('PASSWORDS DO NOT MATCH, CHECK AND TRY AGAIN.');</script>";
                }else{
                    //passed all checks now user can be registered into the system.
            $addstudent = $student->addstudent($studentID,$depID,$firstName,$lastName,$otherName,$email,$phone,$school,$level,$dateToday);
            $adduser = $user->addUser($studentID,$email,$password,$position,$flogin,$dateToday);

                    if($addstudent && $adduser){

                //SEND SMS TO STUDENT....
                $tel = clean($phone);
                $body = "Hello ".$fullname.", Your Account with student ID ".$studentID." use code ".$password." on first log in To change your password";
                $sendsms =  sendsmsme($tel,$body);

                //SEND MAIL TO LECTURER...
//                $send_to = $email;
//                $copy = '';
//$body = "Hello ".$fullname.", Your Account has been created succesfully, use code ".$password." on first log in to change your password";
//                $subj = "ELEARNING STUDENT ACCOUNT";
//                @$SENDMAIL = send_mail($email,'',$body,$subj);

                $success = "<script>document.write('ACCOUNT CREATED SUCCESSFULY,PIN ".$password.".');</script>";
                    }else{
                        $error = "<script>document.write('ACCOUNT CREATION FAILED, TRY AGAIN LATER.');</script>";
                    }
                }
            }
        }
    }
}


?>
<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <title>eLearning Register </title>
    <link rel="stylesheet" href="./assets/css/font-awesome2.css">
    <script src="./assets/js/require.min.js"></script>
    <script>
      requirejs.config({
          baseUrl: '.'
      });
    </script>
    <!-- Dashboard Core -->
    <link href="./assets/css/dashboard.css" rel="stylesheet" />
    <script src="./assets/js/dashboard.js"></script>
    <!-- Input Mask Plugin -->
    <script src="./assets/plugins/input-mask/plugin.js"></script>
  </head>
  <body class="">
    <div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col col-longin mx-auto">

              <div class="text-center mb-6">
<!--                  <span style="font-weight:bolder; font-size:160%; color:#2d89ef;"> E-LEARNING </span>-->
                  <span style="font-weight:bolder; font-size:160%; color:#17c700;"> E-LEARNING </span>
                  <span style="font-weight:bolder; font-size:160%;"> SYSTEM</span>
              </div>
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
              <form class="card" action="" method="post" onsubmit="return confirm('CREATE ACCOUNT.');">
                <div class="card-body p-5">
                  <div class="card-title">Create New Account</div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                            <label class="form-label"><i class="fe fe-hash"></i> STUDENT ID<span class="text-danger" style="font-size:120%;">*</span></label>
                            <input type="text" class="form-control" placeholder="Student ID" name="studentID" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label class="form-label"><i class="fe fe-user"></i> First Name<span class="text-danger" style="font-size:120%;">*</span></label>
                            <input type="text" class="form-control" placeholder="First name" name="firstName" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label class="form-label"><i class="fe fe-user"></i> Last Name<span class="text-danger" style="font-size:120%;">*</span></label>
                            <input type="text" class="form-control" placeholder="Last name" name="lastName" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label class="form-label"><i class="fe fe-user"></i> Other Name(s)</label>
                            <input type="text" class="form-control" placeholder="Other name" name="otherName">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label class="form-label"><i class="fe fe-mail"></i> Email address<span class="text-danger" style="font-size:120%;">*</span></label>
                            <input type="email" class="form-control" placeholder="Enter valid email" name="email" required>
                          </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label class="form-label"><i class="fe fe-phone"></i> Phone<span class="text-danger" style="font-size:120%;">*</span></label>
                            <input type="tel" class="form-control" placeholder="Enter active phone" name="phone" required>
                          </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label class="form-label"><i class="fe fe-folder"></i>  School<span class="text-danger" style="font-size:120%;">*</span></label>
                                <select class="form-control" name="school" required>
                                    <option></option>
                                    <option value="Regular"> Regular </option>
                                    <option value="Evening"> Evening </option>
                                    <option value="Weekend"> Weekend </option>
                                </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label class="form-label"><i class="fe fe-bar-chart"></i> Level<span class="text-danger" style="font-size:120%;">*</span></label>
                                <select class="form-control" name="level" required>
                                    <option></option>
                                    <option value="100"> 100 </option>
                                    <option value="200"> 200 </option>
                                    <option value="300"> 300 </option>
                                    <option value="400"> 400 </option>
                                </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label class="form-label">
                                <i class="fe fe-list"></i> Faculty<span class="text-danger" style="font-size:120%;">*</span>
                                </label>
                                <select class="form-control" name="faculty" onchange="facdep(this.value)" required>
                                    <option></option>
                                    <?php
                                    $facsql = select("SELECT * FROM faculty");
                                    if($facsql){
                                        foreach($facsql as $facDet){
                                    ?>
                                    <option value="<?php echo $facDet['facID'];?>"> <?php echo $facDet['facultyName'];?> </option>
                                    <?php }}?>
                                </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" id="dept">
                          </div>
                        </div>
<!--
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label"><i class="fe fe-lock"></i> Password<span class="text-danger" style="font-size:120%;">*</span></label>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                          </div>
                        </div>
-->
<!--
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label"><i class="fe fe-lock"></i> Confirm Password<span class="text-danger" style="font-size:120%;">*</span></label>
                            <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword">
                          </div>
                        </div>

-->
                        <div class="col-md-4">
                          <div class="form-group">
                              <label class="form-label">.</label>
<!--
                            <label class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" />
                              <span class="custom-control-label">Agree to the <a href="#">terms and policy</a></span>
                            </label>
-->
                          </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">.</label>
                                <button type="submit" name="crtaccount" class="btn btn-success btn-block">Create Account <i class="fe fe-user-check"></i> </button>
                              </div>
                        </div>
                    </div>

<!--
                    <div class="row">
                        <div class="col-md-8">
                          <div class="form-group">
                            <label class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" />
                              <span class="custom-control-label">Agree the <a href="terms.html">terms and policy</a></span>
                            </label>
                          </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary btn-block">Create Account <i class="fe fe-user-check"></i> </button>
                              </div>
                        </div>
                    </div>
-->

                </div>
              </form>

              <div class="text-center text-success text-muted">
                Already have account? <a href="./index">Sign in</a>
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
<script>
    setTimeout(function() {
        $(".alert").alert('close');
    }, 8000);
</script>
  </body>
</html>
