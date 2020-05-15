<?php
include ('assets/core/connection.php');
if(isset($_SESSION['userID'])){
  $result = select("select * from user_token where userID='".$_SESSION['userID']."' ");

  if(count($result) > 0) {
      foreach($result as $row){
          $token = $row['token'];
      }

   if($_SESSION['token'] != $token){
    session_destroy();
    echo "<script>window.location.href='index2'</script>";
   }else{

    if($_SESSION['access'] == 'manager'){
            $getuser = select("SELECT * FROM users WHERE email='".$_SESSION['email']."'");
            foreach($getuser as $userDet){}
    }elseif($_SESSION['access'] == 'lecturer' || $_SESSION['access'] == 'hod' || $_SESSION['access'] == 'dean'){
    $getuser = select("SELECT * FROM users,lecturer WHERE users.email='".$_SESSION['email']."' AND lecturer.email='".$_SESSION['email']."' ");
        foreach($getuser as $userDet){}
    }else{
    $getuser = select("SELECT * FROM users,student WHERE users.email='".$_SESSION['email']."' AND student.email='".$_SESSION['email']."' ");
        foreach($getuser as $userDet){}
    }

}
  }
}else{
    session_destroy();
    echo "<script>window.location.href='index2'</script>";
}



$dateToday = date("Y-m-d H:i:s");
$faculty = new Faculty();
$department = new Department();
$student = new Student();
$course = new Course();
$lecturer = new Lecturer();
$user = new User();
$cmanage = new Cmanage();
$access = $_SESSION['access'];
$success = '';
$error = '';


if(isset($_GET['mid'])){
    $mid = $_GET['mid'];
    $_SESSION['current_page']=$_SERVER['REQUEST_URI'];

//get message details..
$mesage = select("SELECT * FROM messages WHERE mid='$mid'");
if(count($mesage) > 0){
    foreach($mesage as $msgrow){}
    //update message to read...
    $update = update("UPDATE messages SET status='read' WHERE mid='$mid'");
    //get sender..
    $lecsearch = select("SELECT * FROM lecturer WHERE lecID='".$msgrow['sender']."'");
    if(count($lecsearch) > 0){
        foreach($lecsearch as $lecfrow){
            if($msgrow['sender'] == $userDet['userID']){
                 $sender = "You";
            }else{
                $sender = $lecfrow['firstName']." ".$lecfrow['lastName'];
            }

        }
    }else{
        $stusearch = select("SELECT * FROM student WHERE studentID='".$msgrow['sender']."'");
        if(count($stusearch) > 0){
            foreach($stusearch as $stufrow){
                 if($msgrow['sender'] == $userDet['userID']){
                 $sender = "You";
                }else{
                    $sender = $stufrow['firstName']." ".$stufrow['lastName'];
                }
            }
        }
    }
}
}



//COUNT NUMBER OF UNREAD MESSAGES..
$msg = count(select("SELECT * FROM messages WHERE recipient='".$_SESSION['userID']."' AND status='unread'"));
if($msg <= 0){
    $msgs = '';
}else{
    $msgs = $msg;
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
    <title> eLearning</title>
    <link rel="stylesheet" href="./assets/css/font-awesome2.css">
    <!--   Core JS Files   -->
    <script src="./assets/js/require.min.js"></script>
    <script>
      requirejs.config({
          baseUrl: '.'
      });
    </script>
    <!-- Dashboard Core -->
    <link href="./assets/css/dashboard.css" rel="stylesheet" />
    <script src="./assets/js/dashboard.js"></script>
    <!-- c3.js Charts Plugin -->
    <link href="./assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
    <script src="./assets/plugins/charts-c3/plugin.js"></script>
    <!-- Google Maps Plugin -->
    <link href="./assets/plugins/maps-google/plugin.css" rel="stylesheet" />
    <script src="./assets/plugins/maps-google/plugin.js"></script>
    <!-- Input Mask Plugin -->
    <script src="./assets/plugins/input-mask/plugin.js"></script>
  <!-- DataTables -->
<!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">-->
<style>
    .text-white{
        color: white;
    }

    .text-bold{
        font-weight: bold;
    }

    .capital{
        text-transform: uppercase;
    }
    .text-black{
        color: #4b4b4b;
    }

    .nav-item{
        text-transform: uppercase;
        font-size: 90%;
    }

</style>
  </head>
  <body class="">
    <div class="page">
      <div class="page-main">
        <div class="header py-4">
          <div class="container">
            <div class="d-flex">
              <a class="header-brand" href="<?php if(@$_SESSION['testactive'] == 'active'){ echo "";}else{ echo "./dashboard";}?>">
<!--                <img src="./favicon.ico" class="header-brand-img" alt="tabler logo">-->
                <span style="font-weight:bold; font-size:100%; color:#2d89ef;"> eLearning</span>
              </a>
              <div class="d-flex order-lg-2 ml-auto">
                <div class="dropdown">
                  <a href="javascript:void(0)" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                    <span class="avatar"><i class="fe fe-user"></i></span>
                    <span class="ml-2 d-none d-lg-block">
                      <span class="text-default"><?php echo $userDet['userID'];?></span>
                      <small class="text-muted d-block mt-1 capital"><?php echo $userDet['firstName'];?></small>
                    </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <?php if($access !== 'manager'){ ?>
<!--
                    <a class="dropdown-item" href="./profile"  style="<?php // if(@$_SESSION['testactive'] == 'active'){ echo "display:none;";}?>">
                      <i class="dropdown-icon fe fe-user"></i> Profile
                    </a>
-->
                      <?php }?>
                      <?php if($access != 'manager' && $access != 'hod' ){ ?>
                        <a class="dropdown-item" href="./inbox" style="<?php if(@$_SESSION['testactive'] == 'active'){ echo "display:none;";}?>">
                                <span class="float-right">
                                  <span class="badge badge-primary"><?php echo $msgs;?></span>
                                </span>
                                <i class="dropdown-icon fe fe-mail"></i> INBOX
                        </a>
                      <?php }?>
<!--
                    <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-help-circle"></i> Need help?
                    </a>
-->
                      <?php if($access == 'manager'){ ?>
<!--
                    <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-database"></i> Back Up
                    </a>
-->
                      <?php }?>
                    <a class="dropdown-item" href="./logout">
                      <i class="dropdown-icon fe fe-log-out"></i> SIGN OUT
                    </a>
                  </div>
                </div>
              </div>
              <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
              </a>
            </div>
          </div>
        </div>

          <?php if($access == 'manager'){ ?>
    <!-- ================================== START IT MANAGER NAVBAR ==============================================  -->
            <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-3 ml-auto">
                <form class="input-icon my-3 my-lg-0">
                  <input type="search" disabled class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
                  <div class="input-icon-addon">
                    <i class="fe fe-search"></i>
                  </div>
                </form>
              </div>
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="./dashboard" class="nav-link <?php if($active == 'dashboard'){ echo 'active';}?>"><i class="fe fe-home"></i> Home</a>
                  </li>
                  <li class="nav-item">
                    <a href="./mfaculty" class="nav-link <?php if($active == 'faculty'){ echo 'active';}?>"><i class="fe fe-list"></i> Faculty</a>
                  </li>
                  <li class="nav-item">
                    <a href="./mdepartment" class="nav-link <?php if($active == 'department'){ echo 'active';}?>"><i class="fe fe-grid"></i> Department</a>
                  </li>
                  <li class="nav-item">
                    <a href="./mlecturers" class="nav-link <?php if($active == 'lecturers'){ echo 'active';}?>"><i class="fe fe-users"></i> Lecturers</a>
                  </li>
                  <li class="nav-item">
                    <a href="./mstudents" class="nav-link <?php if($active == 'students'){ echo 'active';}?>"><i class="fe fe-users"></i> Students</a>
                  </li>
                  <li class="nav-item">
                    <a href="./mreports" class="nav-link <?php if($active == 'mreports'){ echo 'active';}?>"><i class="fe fe-folder"></i> Report</a>
                  </li>
                  <li class="nav-item">
                    <a  href="./logout" class="nav-link pull-right"><i class="dropdown-icon fe fe-log-out"></i> Sign out</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
    <!-- ===================================== END IT MANAGER NAVBAR =====================================   -->






          <?php } if($access == 'hod'){ ?>
    <!-- ================================== START HOD NAVBAR ==============================================  -->
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-3 ml-auto">
                <form class="input-icon my-3 my-lg-0">
                  <input type="search" disabled class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
                  <div class="input-icon-addon">
                    <i class="fe fe-search"></i>
                  </div>
                </form>
              </div>
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="./dashboard" class="nav-link <?php if($active == 'dashboard'){ echo 'active';}?>"><i class="fe fe-home"></i> Home</a>
                  </li>
                  <li class="nav-item">
                    <a href="./hlecturers" class="nav-link <?php if($active == 'hlecturers'){ echo 'active';}?>"><i class="fe fe-users"></i> Lecturers</a>
                  </li>
<!--
                  <li class="nav-item">
                    <a href="./hstudents" class="nav-link <?php if($active == 'hstudents'){ echo 'active';}?>"><i class="fe fe-users"></i> Students</a>
                  </li>
-->
                  <li class="nav-item">
                    <a href="./hcourses" class="nav-link <?php if($active == 'hcourses'){ echo 'active';}?>"><i class="fe fe-layers"></i> Courses</a>
                  </li>
                  <li class="nav-item">
                    <a href="./hassigns" class="nav-link <?php if($active == 'hassigns'){ echo 'active';}?>"><i class="fe fe-layers"></i><i class="fe fe-chevron-right"></i><i class="fe fe-users"></i> Course Management</a>
                  </li>
<!--
                  <li class="nav-item">
                    <a href="./hreports" class="nav-link <?php // if($active == 'hreports'){ echo 'active';}?>"><i class="fe fe-file-text"></i> Reports</a>
                  </li>
-->
                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link  <?php if($active == 'hreports'){ echo 'active';}?>" data-toggle="dropdown">
                        <i class="fe fe-folder"></i> Reports</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./hgeneral-report" class="dropdown-item ">GENERAL REPORTS</a>
                      <a href="./hlecturer-report" class="dropdown-item ">LECTURER REPORTS</a>
                      <a href="./hstudent-report" class="dropdown-item ">STUDENTS REPORTS</a>
                    </div>
                  </li>

                 <li class="nav-item">
                    <a  href="./logout" class="nav-link pull-right"><i class="dropdown-icon fe fe-log-out"></i> Sign out</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
    <!-- ===================================== END HOD NAVBAR =================================================   -->




    <!-- ================================== START LECTURER NAVBAR ==============================================  -->
          <?php } if($access == 'lecturer'){ ?>

            <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-3 ml-auto">
                <form class="input-icon my-3 my-lg-0">
                  <input type="search" disabled class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
                  <div class="input-icon-addon">
                    <i class="fe fe-search"></i>
                  </div>
                </form>
              </div>
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="./dashboard" class="nav-link  <?php if($active == 'dashboard'){ echo 'active';}?>"><i class="fe fe-home"></i> HOME</a>
                  </li>
                  <li class="nav-item">
                    <a href="./lcourses" class="nav-link <?php if($active == 'lcourses'){ echo 'active';}?>"><i class="fe fe-layers"></i> COURSES</a>
                  </li>
                  <li class="nav-item">
                    <a href="./lstudents" class="nav-link <?php if($active == 'lstudents'){ echo 'active';}?>"><i class="fe fe-users"></i> Students</a>
                  </li>
                  <li class="nav-item">
                    <a href="./ltests" class="nav-link <?php if($active == 'ltests'){ echo 'active';}?>"><i class="fe fe-file-text"></i>Manage Tests</a>
                  </li>
                  <li class="nav-item">
                        <a href="./inbox" class="nav-link <?php if($active == 'message'){ echo 'active';}?> text-bold <?php if(!empty($msgs)){ echo "text-danger"; }?>">
                            <i class="fe fe-mail"></i> Messages <?php if(!empty($msgs)){ echo "- ".$msgs; }?>
                        </a>
                  </li>

                <li class="nav-item">
                    <a  href="./logout" class="nav-link pull-right"><i class="dropdown-icon fe fe-log-out"></i> Sign out</a>
                  </li>
<!--
                  <li class="nav-item">
                    <a href="./lreports" class="nav-link <?php // if($active == 'lreports'){ echo 'active';}?>"><i class="fe fe-folder"></i> Reports</a>
                  </li>
-->
                </ul>
              </div>
            </div>
          </div>
        </div>
    <!-- ===================================== END LECTURER NAVBAR ===========================================   -->



          <?php } if($access == 'student'){ ?>
    <!-- ================================== START STUDENT NAVBAR ==============================================  -->
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
          <div class="container">
            <div class="row align-items-center"  style="<?php if(@$_SESSION['testactive'] == 'active'){ echo "display:none;";}?>">
              <div class="col-lg-3 ml-auto">
                <form class="input-icon my-3 my-lg-0">
                  <input type="search" disabled class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
                  <div class="input-icon-addon">
                    <i class="fe fe-search"></i>
                  </div>
                </form>
              </div>
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="./dashboard" class="nav-link <?php if($active == 'dashboard'){ echo 'active';}?>"><i class="fe fe-home"></i> Home</a>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link <?php if($active == 'scourses'){ echo 'active';}?>" data-toggle="dropdown"><i class="fe fe-layers"></i> Courses</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                        <?php

                        //get courses for level and department.
                        $getcourse = select("SELECT * FROM courses WHERE depID='".$userDet['depID']."' AND level='".$userDet['level']."'");
                        if($getcourse){
                            foreach($getcourse as $allcourserow){
                        ?>
              <a href="./scourses-det?cid=<?php echo $allcourserow['cID'];?>" class="dropdown-item "><?php echo $allcourserow['courseName'];?></a>
                        <?php }}?>
                    </div>
                  </li>
<!--
                  <li class="nav-item">
                    <a href="./dashboard" class="nav-link<?php // if($active == 'stests'){ echo 'active';}?>"><i class="fe fe-file"></i> Tests</a>
                  </li>
-->
                  <li class="nav-item">
                        <a href="./inbox" class="nav-link <?php if($active == 'message'){ echo 'active';}?> text-bold <?php if(!empty($msgs)){ echo "text-danger"; }?>">
                            <i class="fe fe-mail"></i> Messages <?php if(!empty($msgs)){ echo "- ".$msgs; }?>
                        </a>
                  </li>

                  <li class="nav-item">
                    <a href="./student-report" class="nav-link <?php if($active == 'sreports'){ echo 'active';}?>">
                        <i class="fe fe-folder"></i> Reports</a>
                  </li>

                    <li class="nav-item">
                        <a  href="./logout" class="nav-link pull-right"><i class="dropdown-icon fe fe-log-out"></i> Sign out</a>
                    </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div id="testactive"></div>
    <!-- ===================================== END STUDENT NAVBAR ===========================================   -->
          <?php }?>




    <!-- ==============================================================================================================   -->
<!--
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-3 ml-auto">
                <form class="input-icon my-3 my-lg-0">
                  <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
                  <div class="input-icon-addon">
                    <i class="fe fe-search"></i>
                  </div>
                </form>
              </div>
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="./dashboard" class="nav-link"><i class="fe fe-home"></i> Home</a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Interface</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./cards.html" class="dropdown-item ">Cards design</a>
                      <a href="./charts.html" class="dropdown-item ">Charts</a>
                      <a href="./pricing-cards.html" class="dropdown-item ">Pricing cards</a>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-calendar"></i> Components</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./maps.html" class="dropdown-item ">Maps</a>
                      <a href="./icons.html" class="dropdown-item ">Icons</a>
                      <a href="./store.html" class="dropdown-item ">Store</a>
                      <a href="./blog.html" class="dropdown-item ">Blog</a>
                      <a href="./carousel.html" class="dropdown-item ">Carousel</a>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i class="fe fe-file"></i> Pages</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./profile.html" class="dropdown-item ">Profile</a>
                      <a href="./login.html" class="dropdown-item ">Login</a>
                      <a href="./register.html" class="dropdown-item ">Register</a>
                      <a href="./forgot-password.html" class="dropdown-item ">Forgot password</a>
                      <a href="./400.html" class="dropdown-item ">400 error</a>
                      <a href="./401.html" class="dropdown-item ">401 error</a>
                      <a href="./403.html" class="dropdown-item ">403 error</a>
                      <a href="./404.html" class="dropdown-item ">404 error</a>
                      <a href="./500.html" class="dropdown-item ">500 error</a>
                      <a href="./503.html" class="dropdown-item ">503 error</a>
                      <a href="./email.html" class="dropdown-item ">Email</a>
                      <a href="./empty.html" class="dropdown-item active">Empty page</a>
                      <a href="./rtl.html" class="dropdown-item ">RTL mode</a>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="./form-elements.html" class="nav-link"><i class="fe fe-check-square"></i> Forms</a>
                  </li>
                  <li class="nav-item">
                    <a href="./gallery.html" class="nav-link"><i class="fe fe-image"></i> Gallery</a>
                  </li>
                  <li class="nav-item">
                    <a href="./docs/index.html" class="nav-link"><i class="fe fe-file-text"></i> Documentation</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>-->
