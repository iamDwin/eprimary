<?php
$active = 'mreports';
include 'layout/header.php';
$_SESSION['current_page']=$_SERVER['REQUEST_URI'];

//get DEPARTMENT ID AND DETAILS..
$numOFfac = count(select("SELECT * FROM faculty"));

//get DEPARTMENT ID AND DETAILS..
$getnumDep = count(select("SELECT * FROM department"));

//get number of lecturers...
$getlecNum = count(select("SELECT * FROM lecturer"));

//get number of students...
$getstNum = count(select("SELECT * FROM student"));

//get number of courses...
$getcrsNum = count(select("SELECT * FROM courses"));


?>

<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
        <h1 class="page-title"> GENERAL REPORT</h1>
        </div>

        <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                            <th colspan="2" class="text-bold"> SYSTEM GENERAL REPORT</th>
                        </thead>
                        <tbody>
                                <tr> <td style="width:50%;" class="text-bold"> TOTAL NUMBER OF FACULTIES </td> <td><?php echo $numOFfac;?></td></tr>
                                <tr> <td class="text-bold"> TOTAL NUMBER OF DEPARTMENT </td> <td><?php echo $getnumDep;?></td></tr>
                                <tr> <td class="text-bold"> TOTAL NUMBER OF LECTURERS</td>  <td><?php echo $getlecNum;?></td></tr>
                                <tr> <td class="text-bold"> TOTAL NUMBER OF STUDENTS </td>  <td><?php echo $getstNum;?></td></tr>
                                <tr> <td class="text-bold"> TOTAL NUMBER OF COURSES </td>  <td><?php echo $getcrsNum;?></td></tr>
<!--
                                <tr>
                                    <td> </td>
                                    <td class="text-right">
                                        <a href="#" class="btn btn-primary btn-md"> Print Report <i class="fe fe-file"></i></a>
                                        <a href="#" class="btn btn-primary btn-md"> Detailed Report <i class="fe fe-file-text"></i></a>
                                    </td>
                                </tr>
-->
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
        </div>

        <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                            <th colspan="5" class="text-bold"> SYSTEM USER ACTIVITY REPORT</th>
                        </thead>
                        <tbody>
                            <?php
                            //get audit trail table details
                            $getaudit = select("SELECT * FROM audit WHERE userID !='USER-000001' ORDER BY id DESC LIMIT 10");
                            $count = 0;
                            foreach($getaudit as $auditdet){
                            $count ++;



                                $action = $auditdet['action'];
                            ?>
                            <tr>
                                <td><?php echo $count;?></td>
                                <td><?php echo $auditdet['userID'];?></td>

                                <td>
                                    <?php
                                //get user details with userID from audit table....
                                $getuser = select("SELECT * FROM student WHERE studentID='".$auditdet['userID']."'");
                                if($getuser){
                                    foreach($getuser as $userdet){
                                       echo $fullName = $userdet['firstName']." ".$userdet['otherName']." ".$userdet['lastName'];
                                    }
                                }else{
                                    $getuser = select("SELECT * FROM lecturer WHERE lecID='".$auditdet['userID']."'");
                                    if($getuser){
                                       foreach($getuser as $userdet){
                                         echo  $fullName = $userdet['firstName']." ".$userdet['otherName']." ".$userdet['lastName'];
                                        }
                                    }
                                }
                                    ?>
                                </td>

                                <td>
                                    <?php
                                        if($auditdet['action'] == 'LOGOUT'){
                                            echo '<span class="tag tag-red btn-sm text-white">'.$action.'</span>';
                                        }elseif($auditdet['action'] == 'LOGIN'){
                                            echo '<span class="tag tag-green btn-sm text-white">'.$action.'</span>';
                                        }else{
                                            echo $action;
                                        }
                                    ?>
                                </td>
                                <td><?php echo date("D Y-m-d, H:i a",strtotime($auditdet['doe']));?></td>
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

<?php include 'layout/footer.php'; ?>
