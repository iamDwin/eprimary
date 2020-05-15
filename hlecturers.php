<?php
$active = 'hlecturers';
include 'layout/header.php';

$numLec = $lecturer->find_num_lec();
$LecNum = $numLec + 1;
$lecID =  "LEC-".sprintf('%06s',$LecNum);


?>

<div class="my-3 my-md-5">
    <div class="container">
<!--        <div class="page-header">-->
<!--          <h1 class="page-title"> <i class="fe fe-users"></i>  Lecturers </h1>-->
<!--        </div>-->
        <div class="row">
<!--
            <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title"><i class="fe fe-user-check"></i> Register Lecturer</h3>
                </div>
                <div class="card-body">
                  <form class="form" method="post" enctype="multipart/form-data" onsubmit="return confirm('SAVE DEPARTMENT ?');" >

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="input-icon">
                                <span class="input-icon-addon"><i class="fe fe-hash"></i><span class="form-required">*</span></span>
                                <input type="text" name="lecID" class="form-control" value="<?php echo $lecID;?>" placeholder="Lecturer ID" readonly>
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
                      <div class="form-group">
                        <div class="input-icon">
                            <span class="input-icon-addon"><i class="fe fe-phone"></i><span class="form-required">*</span></span>
                            <input type="email" name="tel" class="form-control" placeholder="Active Phone" required>
                        </div>
                      </div>

                    <div class="form-footer">
                        <button type="submit" name="addDep" class="btn btn-primary btn-block" >
                          REGISTER LECTURER <i class="fe fe-download"></i>
                        </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
-->


              <div class="col-md-12">
                <div class="card">
                  <div class="table-responsive">
                    <table id="example" class="table table-hover table-outline table-vcenter text-nowrap card-table datatable">
                      <thead>
                        <tr>
                          <th><i class="fe fe-hash"></i>  ID</th>
                          <th class="text-center"><i class="fe fe-grid"></i> FULL NAME</th>
                          <th class="text-center"><i class="fe fe-mail"></i> EMAIL</th>
                          <th class="text-center"><i class="fe fe-phone"></i> PHONE</th>
                          <th class="text-center"><i class="fa fa-cog"></i>  ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $alllec = $lecturer->find_all_lecdep($userDet['depID']);
                          if($alllec){
                              foreach($alllec as $lecrow){
                          ?>
                        <tr>
                          <td>
                            <div><?php echo $lecrow['lecID'];?></div>
                          </td>
                          <td class="text-center">
                              <?php echo $lecrow['lastName']." ".$lecrow['firstName']." ".$lecrow['otherName'];?>
                          </td>
                          <td class="text-center"> <?php echo $lecrow['email']; ?> </td>
                          <td class="text-center"> <?php echo $lecrow['phone']; ?> </td>
                          <td class="text-center">
                              <a href="./huplecturer?lc=<?php echo $lecrow['lecID'];?>" class="btn btn-primary btn-sm text-white">
                                  <i class="fe fe-file-text"></i> Details
                              </a>
                          </td>
                        </tr>
                          <?php }}else{?>
                          <tr>
                            <td colspan="3"> No <i class="fe fe-users"></i> Lecturers Registered.</td>
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
