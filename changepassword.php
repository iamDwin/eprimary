<?php
include 'assets/core/connection.php';
$user = new User();
$success = '';
$error = '';

if(isset($_GET['c'])){
    $code = decode5t($_GET['c']);;
}

if(isset($_POST['changepass'])){
    $email = trim(htmlentities($_POST['email']));
    $password = trim(htmlentities($_POST['password']));
    $cpassword = trim(htmlentities($_POST['cpassword']));

    $checkmail = $user->signin($email,$code);
    if($checkmail){
        if($password === $cpassword){
            $updateuser = update("UPDATE users SET password='$password',flogin='2' WHERE email='$email'");
            if($updateuser){
                $success = "<script>alert('PASSWORD CHANGED, LOGIN NOW.!');window.location.href='./index2';</script>";
            }else{
                $error = "<script>document.write('PASSWORDS CHANGE FAILED, TRY AGAIN');</script>";
            }
        }else{
            $error = "<script>document.write('PASSWORDS TO NOT MATCH, TRY AGAIN');</script>";
        }
    }else{
        $error = "<script>document.write('WRONG EMAIL, TRY AGAIN');</script>";
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
    <title>eLearning Change Password </title>
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
                  <span style="font-weight:bolder; font-size:160%; color:#2d89ef;"><img src="./favicon.ico" class="h-6" alt="">  E-LEARNING </span>
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
                    <label class="form-label">
                      <i class="fe fe-mail"></i> Email
                    </label>
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                  </div>
                  <div class="form-group">
                    <label class="form-label">
                      <i class="fe fe-lock"></i> New Password
                    </label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                    <label class="form-label">
                      <i class="fe fe-lock"></i> Confirm Password
                    </label>
                    <input type="password" name="cpassword" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                  </div>
                  <div class="form-footer">
                    <button type="submit" name="changepass" class="btn btn-primary btn-block">SAVE NEW PASSWORD <i class="fe fe-download"></i></button>
                  </div>
                    <div class="text-center text-muted">
                        <a href="./index">send me back</a> to the sign in screen.
                      </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
