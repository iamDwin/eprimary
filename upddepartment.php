<?php
$active = 'department';
include 'layout/header.php';

if(isset($_GET['dp'])){
    $dp = $_GET['dp'];
}

$finddep = $department->find_by_depID($dp);
if($finddep){
    foreach($finddep as $deprow){
        $fecthfac = select("SELECT * FROM faculty WHERE facID='".$deprow['facID']."'");
        if($fecthfac){
            foreach($fecthfac as $frow){}
        }else{
            echo "no faculty";
        }
    }
}

if(isset($_POST['updateDep'])){
    $depID = trim(htmlentities($_POST['depID']));
    $facID = trim(htmlentities($_POST['facID']));
    $departmentName = trim(htmlentities($_POST['departmentName']));

    $udpdatedep = $department->updatedep($depID,$facID,$departmentName);
    if($udpdatedep){
        $success = "<script>document.write('UPDATE SUCCESSFULL.');window.location.href='./mdepartment';</script>";
    }else{
        $error = "<script>document.write('UPDATE FAILED.!');</script>";
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
                  <h3 class="card-title"><i class="fe fe-edit"></i> Update Department</h3>
                </div>
                <div class="card-body">
                  <form class="form" method="post" enctype="multipart/form-data" onsubmit="return confirm('CONFIRM UPDATE.!');" >
                    <div class="form-group">
                      <label class="form-label"><i class="fe fe-hash"></i>  Department ID</label>
                      <input type="text" name="depID" value="<?php echo $dp;?>" class="form-control" readonly/>
                    </div>
                    <div class="form-group">
                      <label class="form-label"><i class="fe fe-list"></i> Faculty Name</label>
                        <?php
                        $allfac = $faculty->find_all_fac();
                        if($allfac){
                        ?>
                        <select name="facID" class="form-control" required>
                            <option value="<?php echo $frow['facID'];?>"><?php echo $frow['facultyName'];?></option>
                            <?php
                            foreach($allfac as $facrow){
                            ?>
                            <option value="<?php echo $facrow['facID'];?>" > <?php echo $facrow['facultyName'];?> </option>
                            <?php }?>
                        </select>
                        <?php }else{ ?>
                      <input type="text" name="facID" class="form-control" value="NO FACULTY CREATED" readonly disabled />
                        <?php }?>
                    </div>
                    <div class="form-group">
                      <label class="form-label"><i class="fe fe-grid"></i> Department Name</label>
                      <input type="text" name="departmentName" value="<?php echo $deprow['departmentName'];?>" class="form-control" placeholder="Department Name" required />
                    </div>
                    <div class="form-footer">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="btn btn-primary btn-block" href="javascript:history.back()">
                                    <i class="fe fe-arrow-left mr-2"></i>Go back
                                </a>
                            </div>
                            <div class="col-md-8">
                      <button type="submit" name="updateDep" class="btn btn-info btn-block" <?php if(!$allfac){ echo 'disabled';}?> >UPDATE DEPARTMENT <i class="fe fe-refresh-cw"></i></button>
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
                    <table id="example" class="table table-hover table-outline table-vcenter text-nowrap card-table datatable">
                      <thead>
                        <tr>
                          <th><i class="fe fe-hash"></i>  ID</th>
                          <th class="text-center"><i class="fe fe-grid"></i> DEPARTMENT NAME</th>
                          <th class="text-center"><i class="fe fe-users"></i> NO. OF LEC</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $alldep = $department->find_all_dep();
                          if($alldep){
                              foreach($alldep as $deprow){
                          ?>
                        <tr>
                          <td>
                            <div><?php echo $deprow['depID'];?></div>
                            <div class="small text-muted">
<!--                              Created : <?php // echo $deprow['doe'];?>-->
                            </div>
                          </td>
                          <td class="text-center">
                              <?php echo $deprow['departmentName'];?>
                          </td>
                          <td class="text-center"> <?php echo $numDeplec = $department->find_num_deplec($deprow['depID']);?> </td>
                        </tr>
                          <?php }}?>
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
