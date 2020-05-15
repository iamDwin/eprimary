<?php
include 'assets/core/connection.php';
$user = new User();
$success = '';
$error = '';

if(isset($_POST['signIn'])){

    $email = trim(htmlentities($_POST['email']));
    $password = trim(htmlentities($_POST['password']));


    if ($email != "" && $password != ""){

        $signIn = $user->signin($email,$password);
        $count = count($signIn);

        if($count > 0){

        foreach($signIn as $details){
            $userID = $details['userID'];
        }

        $flogin = $details['flogin'];
        if($flogin == 1){
            $password = encode5t($password);
            echo "<script>alert('CHANGED PASSWORD.');window.location.href='changepassword?c=$password';</script>";
        }else{


        $token = getToken(15);
        $_SESSION['email'] = $details['email'];
        $_SESSION['password'] = $details['password'];
        $_SESSION['access'] = $details['access'];
        $_SESSION['userID'] = $userID;
        $_SESSION['token'] = $token;

        $result_token = count(select("select * from user_token where userID='".$userID."' "));

        if($result_token > 0){
            $update_token = update("update user_token SET token='".$token."' WHERE userID='".$userID."'");
        }else{
            $insert_token= insert("insert into user_token(userID,token) values('".$userID."','".$token."')");
        }

        //do some checks if the user a student...
        if($_SESSION['access'] == 'student'){

                //get student details..
                $student = select("select * from student WHERE email='".$_SESSION['email']."' ");
                foreach($student as $studentrow){}

                //GET ACTIVES TESTS....
                $active = select("SELECT * FROM test WHERE status='active' AND level='".$studentrow['level']."'");
                if($active){
                    foreach($active as $activerow){
                        $activeCID = $activerow['cID'];

                        //GET COURSE DETAILS...
                        $cIDdetials = select("SELECT * FROM courses WHERE cID='$activeCID'");
                        foreach($cIDdetials as $cIDdetialsrow){
                            $courseLevel = $cIDdetialsrow['level'];
                        }
                        if($studentrow['level'] == $courseLevel && $cIDdetialsrow['depID'] == $studentrow['depID']){
                            $_SESSION['testactive'] = 'active';
$success = "<script>document.write('Test Available, Redirecting Now...');window.location.href='take-test?tid=".$activerow['testID']."';</script>";

                        }else{
                                                //insert into audit table..

                    $audit = insert("INSERT INTO audit(userID,action) VALUES('".$signrow['userID']."','LOGIN')");
                            $success = "<script>document.write('Sign In Successful.');</script>";
                                echo "<script>window.location.href='dashboard';</script>";
                        }
                    }
                }else{

                    //set online status
                    $updateonline = update("UPDATE users SET onlinestatus='1' WHERE userID='".$signrow['userID']."'");
                    //insert into audit table..
                    $audit = insert("INSERT INTO audit(userID,action) VALUES('".$signrow['userID']."','LOGIN')");
                    if($updateonline){
                    $success = "<script>document.write('Sign In Successful.');</script>";
                        echo "<script>window.location.href='dashboard';</script>";
                    }
                }


                }else{
                    //set online status
                    $updateonline = update("UPDATE users SET onlinestatus='1' WHERE userID='".$signrow['userID']."'");
                    //insert into audit table..
                    $audit = insert("INSERT INTO audit(userID,action) VALUES('".$signrow['userID']."','LOGIN')");
                    if($updateonline && $audit){
                    $success = "<script>document.write('Sign In Successful.');</script>";
                        echo "<script>window.location.href='dashboard';</script>";
                    }
                }


        }
        }else{
            $error = "<script>document.write('Wrong Email & Password.');</script>";
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
    <title>eLearning Login </title>
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
            <div class="col col-login mx-auto">
              <div class="text-center mb-6">
                  <span style="font-weight:bolder; font-size:160%; color:#17c700;">
<!--                      <img src="./favicon.ico" class="h-6" alt="">  -->
                      E-LEARNING </span>
                  <span style="font-weight:bolder; font-size:160%;"> SYSTEM</span>
              </div>
              <form class="card form" method="post">
                <div class="card-body p-6">
<!--                  <div class="card-title">Login to your account</div>-->
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
                  <div class="form-group">
                    <label class="form-label"><i class="fe fe-mail"></i> Email Address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                  </div>
                  <div class="form-group">
                    <label class="form-label">
                      <i class="fe fe-lock"></i> Password
                      <a href="./forgot-password" class="float-right small">I forgot password</a>
                    </label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                  </div>
                  <div class="form-footer">
                    <button type="submit" name="signIn" class="btn btn-success btn-block">SIGN IN <i class="fe fe-log-in"></i></button>
                  </div>
                </div>
              </form>
              <div class="text-center text-muted">
                Don't have account yet? <a href="./register">Sign up</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<script>
//$(document).ready(function() {
    // show the alert
    setTimeout(function() {
        $(".alert").alert('close');
    }, 8000);
//});
</script>
