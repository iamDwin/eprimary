<?php
$active = 'assignment';
include 'layout/header.php';
$_SESSION['current_page']=$_SERVER['REQUEST_URI'];

//get active assignment...
$getassign = select("SELECT * FROM assignment WHERE level='".$userDet['level']."' AND status='active'");



?>

<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
        <h1 class="page-title"> ACTIVE ASSIGNMENT</h1>
        </div>
        <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                      <thead>
                        <tr>
                          <th><i class="fe fe-hash"></i></th>
                          <th class="text"><i class="fe fe-layers"></i> COURSE</th>
                          <th class="text"><i class="fe fe-book"></i> LECTURE</th>
                          <th class="text"><i class="fe fe-clock"></i> DUE DATE</th>
                          <th class="text"><i class="fe fe-check"></i> STATUS</th>
                          <th class="text"><i class="fe fe-settings"></i> ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $count =0;
                          if($getassign){
                              foreach($getassign as $assdet){
                                  $count ++;
                                  $duedate = $assdet['dueDate'];
                                // Declare two dates
                                $start_date = strtotime(date("Y-m-d"));
                                $end_date = strtotime($duedate);

                                // Get the difference and divide into
                                // total no. seconds 60/60/24 to get
                                // number of days
                                $datdif =  ($end_date - $start_date)/60/60/24;

                                if($datdif == 0){
                                    $dueStatus = "Due Date Is Today";
                                }elseif($datdif < 0){
                                    $dueStatus = "Date Is Due";
                                }else{
                                    if($datdif == 1){
                                        $dueStatus = $datdif." Day more";
                                    }else{
                                        $dueStatus = $datdif." Days more";
                                    }

                                }

                            //get course details..
                            $getcourse = select("SELECT * FROM courses WHERE cID='".$assdet['cID']."'");
                                  foreach($getcourse as $cdet){
                          ?>
                          <tr>
                                <td><?php echo $count;?></td>
                                <td><?php echo $cdet['courseName'];?></td>
                                <td><?php echo $assdet['lecNum'];?></td>
                                <td><?php echo $assdet['dueDate'];?></td>
                                <td><?php echo $dueStatus;?></td>
                                <td>
                                    <?php
                                      if($datdif < 0){
                                          echo "SUBMISSION OF ANSWERS ENDED.";
                                      }elseif($datdif >= 0){

                                    ?>
                                    <a href="./sassignment-det?aid=<?php echo $assdet['asID'];?>" class="btn btn-primary btn-sm">
                                        VIEW / SUBMIT ANSWERS <i class="fe fe-edit"></i></a>
                                    <?php } ?>
                                </td>
                          </tr>
                          <?php }}}else{?>
                          <tr><td colspan="6"> NO ASSIGNMENT AVAILABLE.</td></tr>
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
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
