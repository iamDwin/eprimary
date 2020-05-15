<?php
$active = 'faculty';
include 'layout/header.php';

$numfac = $faculty->find_num_fac();
$facNum = $numfac + 1;
$FacID =  "FAC-".sprintf('%06s',$facNum);

if(isset($_POST['addFac'])){
    $facultyID = trim(htmlentities($_POST['facID']));
    $facultyName = trim(htmlentities($_POST['facultyName']));
    //check if faculty exixts....
    $fexist = $faculty->find_by_facultyName($facultyName);
    if($fexist){
        $error = "<script>document.write('FACULTY ALREADY EXISTS.!');</script>";
    }else{
        $saveFac = $faculty->addfac($facultyID,$facultyName,$dateToday);
        if($saveFac){
            $success = "<script>document.write('FACULTY CREATED..!');window.location.href='./mfaculty';</script>";
        }else{
            $error = "<script>document.write('FACULTY CREATION FAILED,TRY AGAIN.!');</script>";
        }
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
<!--
                <div class="card-header">
                  <h3 class="card-title"><i class="fe fe-plus-square"></i> Create Faculty</h3>
                </div>
-->
                <div class="card-body">
                  <form class="form" method="post" enctype="multipart/form-data" onsubmit="return confirm('SAVE FACULTY ?');" >
                    <div class="form-group">
                      <label class="form-label"><i class="fe fe-hash"></i> Faculty ID</label>
                      <input type="text" name="facID" value="<?php echo $FacID;?>" class="form-control" readonly/>
                    </div>
                    <div class="form-group">
                      <label class="form-label"><i class="fe fe-list"></i> Faculty Name</label>
                      <input type="text" name="facultyName" class="form-control" placeholder="Faculty Name"/>
                    </div>
                    <div class="form-footer">
                      <button type="submit" name="addFac" class="btn btn-primary btn-block">CREATE FACULTY <i class="fe fe-download"></i></button>
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
                <div class="ddcard">
                  <div class="table-responsive" style="border:1px solid #eee; padding:8px;">
                    <table id="example" class="table table-hover table-outline table-vcenter text-nowrap card-table">
<!--                      <table id="example" class="table table-striped table-bordered" style="width:100%">-->
                      <thead>
                        <tr>
                          <th><i class="fe fe-hash"></i> ID</th>
                          <th class="text-center"><i class="fe fe-list"></i> FACULTY NAME</th>
                          <th class="text-center"><i class="fe fe-grid"></i> NO. OF DEP</th>
                          <th class="text-center"><i class="fa fa-cog"></i> ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $allfac = $faculty->find_all_fac();
                          if($allfac){
                              foreach($allfac as $facRow){
                          ?>
                        <tr>
                          <td>
                            <div><?php echo $facRow['facID'];?></div>
                            <div class="small text-muted">
<!--                              Created : <?php // echo $facRow['doe'];?>-->
                            </div>
                          </td>
                          <td class="text-center">
                              <?php echo $facRow['facultyName'];?>
                          </td>
                          <td class="text-center"> <?php echo $numfacDep = $faculty->find_num_facdep($facRow['facID']);?> </td>
                          <td class="text-center">
                              <a href="./updfaculty?fid=<?php echo $facRow['facID'];?>" class="btn btn-info btn-sm text-white"><i class="fe fe-file-text"></i> Details</a>
<!--
                              ||
                              <a onclick="return confirm('CONFIRM DELETE');" href="./delfaculty?fid=<?php// echo $facRow['facID'];?>" class="btn btn-danger btn-sm text-white disabled"><i class="fe fe-trash"></i> Trash</a>
-->
                          </td>
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
<?php include 'layout/footer.php'; ?>
