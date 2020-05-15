<?php
$active = 'faculty';
include 'layout/header.php';

if($_GET['fid']){
    $fid = $_GET['fid'];
}

$findfac = $faculty->find_by_facID($fid);
if($findfac){
    foreach($findfac as $facrow){}
}

if(isset($_POST['updfac'])){
    $facultyID = trim(htmlentities($_POST['facID']));
    $facultyName = trim(htmlentities($_POST['facultyName']));

    $udpdatefac = $faculty->updateFac($facultyID,$facultyName);
    if($udpdatefac){
        $success = "<script>document.write('FACULTY UPDATED..!');window.location.href='./mfaculty';</script>";
    }else{
        $error = "<script>document.write('FACULTY UPDATE FAILED, TRY AGAIN..!');</script>";
    }
}

?>

<div class="my-3 my-md-5">
    <div class="container">
<!--
        <div class="page-header">
          <h1 class="page-title">
            <i class="fe fe-list"></i> Faculty
          </h1>
        </div>
-->
        <div class="row">
            <div class="col-sm-5">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title"><i class="fe fe-edit"></i> Update Faculty</h3>
                </div>
                <div class="card-body">
                  <form class="form" method="post" enctype="multipart/form-data" onsubmit="return confirm('UPDATE FACULTY ?');" >
                    <div class="form-group">
                      <label class="form-label"><i class="fe fe-hash"></i> Faculty ID</label>
                      <input type="text" name="facID" value="<?php echo $facrow['facID'];?>" class="form-control" readonly/>
                    </div>
                    <div class="form-group">
                      <label class="form-label"><i class="fe fe-list"></i> Faculty Name</label>
                      <input type="text" name="facultyName" class="form-control" value="<?php echo $facrow['facultyName'];?>" />
                    </div>
                    <div class="form-footer">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="btn btn-primary btn-block" href="javascript:history.back()">
                                    <i class="fe fe-arrow-left mr-2"></i>Go back
                                </a>
                            </div>
                            <div class="col-md-8">
                      <button type="submit" name="updfac" class="btn btn-info btn-block">UPDATE FACULTY <i class="fe fe-refresh-cw"></i></button>
                            </div>
                        </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
              <div class="col-sm-7">
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
                <div class="card">
                  <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                      <thead>
                        <tr>
                          <th><i class="fe fe-hash"></i> ID</th>
                          <th class="text-center"><i class="fe fe-grid"></i> DEPARTMENT NAME</th>
                          <th class="text-center"><i class="fe fe-users"></i> NO. OF LEC.</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $alldepfac = $department->find_by_facID($facrow['facID']);
                          if($alldepfac){
                              foreach($alldepfac as $deprow){
                          ?>
                        <tr>
                          <td>
                            <div><?php echo $deprow['depID'];?></div>
                          </td>
                          <td class="text-center">
                              <?php echo $deprow['departmentName'];?>
                          </td>
                          <td class="text-center"> <?php echo $numDeplec = $department->find_num_deplec($deprow['depID']);?> </td>
                        </tr>
                          <?php }}else{ ?>
                          <tr>
                            <td colspan="4"> No Department For This Faculty.</td>
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
//$(document).ready(function() {
    // show the alert
    setTimeout(function() {
        $(".alert").alert('close');
    }, 5000);
//});
</script>
<?php include 'layout/footer.php'; ?>
