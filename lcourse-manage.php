<?php
$active = 'lcourses';
include 'layout/header.php';

if(isset($_GET['cid'])){
    $cid = $_GET['cid'];
}
$MAIN_UPLOAD = PARENT_DIR.$cid.'/';
$MEDIA_UPLOAD = PARENT_DIR.$cid.'/media/';
$DOC_UPLOAD = PARENT_DIR.$cid.'/documents/';
$ASSIGNMENT_UPLOAD = PARENT_DIR.$cid.'/assignment/';

$_SESSION['current_page']=$_SERVER['REQUEST_URI'];
//get course details..
$cnm = select("SELECT * FROM courses WHERE ciD='$cid'");
foreach($cnm as $cnmrow){}

//get number of courses lecture....
$num = select(" SELECT * FROM lecture WHERE cID='$cid'");
$numlecture = count($num);
$newlec = $numlecture+1;

//course outline insert query..
if(isset($_POST['uploadCO'])){
    //file properties
    $file_name=$_FILES['coutline']['name'];
    $file_tmp=$_FILES['coutline']['tmp_name'];
    $file_size= $_FILES['coutline']['size'];
    $file_error = $_FILES['coutline']['error'];
    //etract extension
    $file_ext =explode('.',$file_name);
    $file_ext = strtolower(end($file_ext));
    $allowed = array('application','doc','docx','ppt','pptx','pdf');

    if(in_array($file_ext, $allowed)){
        if($file_error===0){
            if($file_size <= 4097152){
             $file_name_new=$cid.'-outline'.'.'.$file_ext;
                $file_destination = $DOC_UPLOAD.$file_name_new;
                //check if file has been loaded earlier and move it from temporary location into folder
                if(move_uploaded_file($file_tmp,$file_destination)){


        //check for existing outline...
        $getoutline = select("SELECT * FROM outline WHERE cID='$cid'");
        if(count($getoutline) >= 1){
 $saveoutline = update("UPDATE outline SET lecID='".$userDet['lecID']."', outline='$file_name_new' WHERE cID='$cid'");
        }else{
 $saveoutline = insert("INSERT INTO outline(cID,lecID,outline,doe) VALUES('$cid','".$userDet['lecID']."','$file_name_new','$dateToday')");
        }

    if($saveoutline){
        $success = "<script>document.write('FILE UPLOAD SUCCESSFULL.');window.location.href='".$_SESSION['current_page']."'</script>";
    }



                }else{
                   $error = "<script>document.write('FILE NOT MOVED, TRY AGAIN');</script>";
                }
            }else{
                $error = "<script>document.write('FILE EXCEEDS MAX SIZE OF 10MB, TRY AGAIN');</script>";
            }

        }else{
            $error = "<script>document.write('".$file_error."');</script>";
        }
    }else{
        $error = "<script>document.write('FILE EXTENSION NOT SUPPORTED, TRY AGAIN');</script>";
    }
}

//required reading  insert query..
if(isset($_POST['requpload'])){
    $type = trim(htmlspecialchars($_POST['type']));
    //url insert query...
    if($type == 'url'){
        $content = trim($_POST['requiredurl']);
        $inst = insert("INSERT INTO reqreading(cID,lecID,readType,content,doe) VALUES('$cid','".$userDet['lecID']."','$type','$content','$dateToday')");

        if($inst){
            $success = "<script>document.write('URL SAVED SUCCESSFULL.');window.location.href='".$_SESSION['current_page']."'</script>";
        }else{
            $error = "<script>document.write('FAILED TO SAVE URL, TRY AGAIN');</script>";
        }
    }

    //book insert query....
    if($type == 'book'){
        $bookName = trim(htmlspecialchars($_POST['bookName']));
        $bookAuthor = trim(htmlspecialchars($_POST['bookAuthor']));
        $content = $bookName." by ".$bookAuthor;
        $inst = insert("INSERT INTO reqreading(cID,lecID,readType,content,doe) VALUES('$cid','".$userDet['lecID']."','$type','$content','$dateToday')");

        if($inst){
            $success = "<script>document.write('URL SAVED SUCCESSFULL.');window.location.href='".$_SESSION['current_page']."'</script>";
        }else{
            $error = "<script>document.write('FAILED TO SAVE URL, TRY AGAIN');</script>";
        }
    }

    //file insert query.........
    if($type == 'file'){
    //file properties
    $file_name=$_FILES['requiredfile']['name'];
    $file_tmp=$_FILES['requiredfile']['tmp_name'];
    $file_size= $_FILES['requiredfile']['size'];
    $file_error = $_FILES['requiredfile']['error'];
    //etract extension
    $file_ext =explode('.',$file_name);
    $file_ext = strtolower(end($file_ext));
    $allowed = array('application','doc','docx','ppt','pptx','pdf');

    if(in_array($file_ext, $allowed)){
        if($file_error === 0){
            if($file_size <= 4097152){
             $content = $file_name;
                $file_destination = $DOC_UPLOAD.$file_name;
                //check if file has been loaded earlier and move it from temporary location into folder
                if(move_uploaded_file($file_tmp,$file_destination)){
$sq=insert("INSERT INTO reqreading(cID,lecID,readType,content,doe) VALUES('$cid','".$userDet['lecID']."','$type','$content','$dateToday')");
    if($sq){
        $success = "<script>document.write('FILE UPLOAD SUCCESSFULL.');window.location.href='".$_SESSION['current_page']."'</script>";
    }
                }else{
                   $error = "<script>document.write('FILE NOT MOVED, TRY AGAIN');</script>";
                }
            }else{
                $error = "<script>document.write('FILE EXCEEDS MAX SIZE OF 10MB, TRY AGAIN');</script>";
            }

        }else{
            $error = "<script>document.write('".$file_error."');</script>";
        }
    }else{
        $error = "<script>document.write('FILE EXTENSION NOT SUPPORTED, TRY AGAIN');</script>";
    }
    }
}


//CREATE LECTURE QUERY..
if(isset($_POST['createLec'])){
    $lectitle = trim(htmlspecialchars($_POST['lectitle']));

    $numlecdoc = count($_FILES['lecdoc']['name']);
    $numdoctype = count($_POST['type']);

    if($numlecdoc > 0 && $numdoctype > 0){
    //create lecture codes
    $createlec = insert("INSERT INTO lecture(cID,lecID,lecNum,lecTitle,doe) VALUES('$cid','".$userDet['lecID']."','$newlec','$lectitle','$dateToday')");
    if($createlec){
        for($d=0, $t=0; $d < $numlecdoc, $t < $numdoctype; $d++, $t++){
            if($_POST['type'][$t] != '' && $_FILES['lecdoc']['name'][$d] != ''){
                $type = $_POST['type'][$t];
                    //file properties
                    $file_name=$_FILES['lecdoc']['name'][$d];
                    $file_tmp=$_FILES['lecdoc']['tmp_name'][$d];
                    $file_size= $_FILES['lecdoc']['size'][$d];
                    $file_error = $_FILES['lecdoc']['error'][$d];
                    //etract extension
                    $file_ext =explode('.',$file_name);
                    $file_ext = strtolower(end($file_ext));

                    if($type == 'file'){
                        $allowed = array('application','doc','docx','ppt','pptx');
                    }

                    if($type == 'video'){
                        $allowed = array('video','mpeg','mp4');
                    }

                    if($type == 'audio'){
                        $allowed = array('audio','mp3','wav');
                    }


    if(in_array($file_ext, $allowed)){
        if($file_error===0){
//            if($file_size <= 4097152){
             $file_name_new = $file_name;

                if($type == 'file'){
                $file_destination = $DOC_UPLOAD.$file_name_new;
                }

                if($type == 'video' || $type == 'audio'){
                $file_destination = $MEDIA_UPLOAD.$file_name_new;
                }
                //check if file has been loaded earlier and move it from temporary location into folder
                if(move_uploaded_file($file_tmp,$file_destination)){

                if($type == 'file'){
                    $savedoc = insert("INSERT INTO cdocument(cID,lecID,lecture,docName,doe) VALUES('$cid','".$userDet['lecID']."','$newlec','$file_name_new', '$dateToday')");
                }

                if($type == 'video' || $type == 'audio'){
                    $savedoc = insert("INSERT INTO cmedia(cID,lecID,lecture,mediatype,mediaName,doe) VALUES('$cid','".$userDet['lecID']."','$newlec','$type','$file_name_new', '$dateToday')");
                }

    if($savedoc){
        $success = "<script>document.write('FILE UPLOAD SUCCESSFULL.');window.location.href='".$_SESSION['current_page']."'</script>";
    }
                }else{
                   $error = "<script>document.write('FILE NOT MOVED, TRY AGAIN');</script>";
                }
//            }else{
//                $error = "<script>document.write('FILE EXCEEDS MAX SIZE, TRY AGAIN');</script>";
//            }

        }else{
            $error = "<script>document.write('".$file_error."');</script>";
        }
    }else{
        $error = "<script>document.write('FILE EXTENSION NOT SUPPORTED, TRY AGAIN');</script>";
    }


            }
        }
        }else{
        $error = "<script>document.write('LECTURE SAVING FAILED, TRY AGAIN');</script>";
    }


    }else{
        $error = "<script>document.write('NO FILES TO UPLOAD.');</script>";
    }
}
?>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
          <h1 class="page-title">
            <a class="btn btn-primary" href="javascript:history.back()"><i class="fe fe-arrow-left mr-2"></i>Go back</a>
           <?php echo $cnmrow['cID'];?> : <?php echo strtoupper($cnmrow['courseName']);?> - COURSE CONTENT <small class="text-right"></small>
          </h1>
        </div>
        <div class="row">
            <div class="col-md-12">
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
                <div class="row">

                    <!--====================  START COURSE OUTLINE PANEL =================-->
                    <div class="col-md-6">
                        <div class="card  card">
                          <div class="card-status card-status-left bg-blue"></div>
                          <div class="card-header">
                            <h3 class="card-title">COURSE OUTLINE PANEL</h3>
                            <div class="card-options">
                              <a href="#" class="card-options-collapse btn btn-primary btn-sm" data-toggle="card-collapse">
                                  <i class="fe fe-chevron-up"></i></a>
                            </div>
                          </div>
                          <div class="card-body">
                              <div class="row">
                                <div class="col-md-6">
                                    <form class="form" method="post" enctype="multipart/form-data" onsubmit="return confirm('UPLOAD FILE. ?');">
                                      <div class="form-group">
                                          <input type="file" accept="application/msword" class="form-control" name="coutline" required>
                                      </div>
                                        <?php
                                        $getoutline = select("SELECT * FROM outline WHERE cID='$cid'");
                                        if($getoutline){
                                        ?>
                                        <div class="form-action">
                                            <button class="btn btn-primary btn-sm btn-block" type="submit" name="uploadCO"> UPDATE OUTLINE <i class="fe fe-refresh-cw"></i></button>
                                        </div>
                                        <?php }else{ ?>

                                        <div class="form-action">
                                            <button class="btn btn-primary btn-sm btn-block" type="submit" name="uploadCO"> SAVE OUTLINE <i class="fe fe-download"></i></button>
                                        </div>
                                        <?php }?>
                                    </form>
                                  </div>
                                <div class="col-md-6">
                                    <div class="table">
                                        <table class="table table-stripped">
                                            <?php
                                            $outlinecount = 0;
                                            $alloutline = select("SELECT * FROM outline WHERE cID='$cid'");
                                            if($alloutline){
                                                foreach($alloutline as $outrow){
                                                    $outlinecount ++;
                                            ?>
                                            <tr>
                                                <td><?php echo $outlinecount; ?></td>
                                                <td><a href="<?php echo $DOC_UPLOAD.$outrow['outline'];?>" target="_blank"><?php echo $outrow['outline']; ?></a></td>
                                            </tr>
                                            <?php }}else{?>
                                            <tr><td colspan="2"> No Outline Uploaded.</td></tr>
                                            <?php } ?>
                                        </table>
                                    </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                    </div>
                    <!--====================  ENDING COURSE OUTLINE PANEL =================-->


                    <!--====================  START REQUIRED READING PANEL =================-->
                    <div class="col-md-6">
                        <div class="card card-collapseds">
                          <div class="card-status card-status-left bg-blue"></div>
                          <div class="card-header">
                            <h3 class="card-title">REQUIRED READING PANEL</h3>
                            <div class="card-options">
                              <a class="card-options-collapse btn btn-primary btn-sm" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                            </div>
                          </div>
                          <div class="card-body">
                              <div class="row">
                                <div class="col-md-12">
                                    <form class="form" method="post" enctype="multipart/form-data" onsubmit="return confirm('SAVE REQUIRED READING ?');">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <select class="form-control" name="type"  onchange="readtype(this.value)" required>
                                                        <option> -- Select type --</option>
                                                        <option value="file">File</option>
                                                        <option value="url">Url</option>
                                                        <option value="book">Book</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-8" id="readtype"></div>
                                        </div>
                                    </form>
                                  </div>
                              </div>
                              <hr/>
                              <div class="row">
                                <div class="col-md-12">
                                    <div class="table">
                                        <table class="table table-stripped">
                                            <tbody>
                                <?php
                                $getrequired = select("SELECT * FROM reqreading WHERE cID='$cid'");
                                if($getrequired){
                                    foreach($getrequired as $reqrow){
                                        $type = $reqrow['readType'];
                                ?>
                                    <?php if($type == 'book'){?>
                                    <tr>
                                        <td><?php echo $reqrow['content'];?></td>
                                        <td><a onclick="return confirm('TRASH ?');" href="trash-required?id=<?php echo $reqrow['id']; ?>" class="btn btn-danger btn-sm"><i class="fe fe-trash text-white"></i></a></td>
                                    </tr>
                                    <?php } if($type == 'url'){ ?>
                                <tr>
                                    <td><a href="<?php echo $reqrow['content'];?>" target="_blank"><?php echo $reqrow['content'];?></a></td>
                                    <td><a onclick="return confirm('TRASH ?');" href="trash-required?id=<?php echo $reqrow['id']; ?>" class="btn btn-danger btn-sm"><i class="fe fe-trash text-white"></i></a></td>
                                </tr>
                                    <?php } if($type == 'file'){?>
                                <tr>
                                    <td><a href="<?php echo $DOC_UPLOAD.$reqrow['content'];?>" target="_blank"><?php echo $reqrow['content'];?></a></td>
                                    <td><a onclick="return confirm('TRASH ?');" href="trash-required?id=<?php echo $reqrow['id']; ?>" class="btn btn-danger btn-sm"><i class="fe fe-trash text-white"></i></a></td>
                                </tr>
                                    <?php }?>
                                <?php }}else{?>
                                <tr><td>No required reading Available.</td></tr>
                                <?php }?>
                            </tbody>
                                        </table>
                                    </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                    </div>
                    <!--====================  ENDING REQUIRED READING PANEL =================-->


                    <!--====================  START COURSE CONTENT PANEL =================-->
                    <div class="col-md-12">
                        <div class="card">
                          <div class="card-status card-status-left bg-blue"></div>
                          <div class="card-header">
                            <h3 class="card-title">COURSE CONTENT PANEL</h3>
                            <div class="card-options">
                              <a class="card-options-collapse btn btn-primary btn-sm" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                            </div>
                          </div>
                          <div class="card-body">

                              <div class="row">

                                <div class="col-md-6">
                        <form class="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-12">
                            <table id="dynamic_field4" class="table table-bordered" width="100%">
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <input type="text" name="lectitle" class="form-control" placeholder="Lecture Title..." required />
                                    </td>

                                    <td class="text-center"></td>
                                </tr>
                            <tr>
                                <th style="width:30%;"><i class="fe fe-grid"></i> File Type<span class="form-required">*</span></th>
                                <th><i class="fe fe-file"></i> File<span class="form-required">*</span></th>
                                <th></th>
                            </tr>
                                <tr>
                                    <td>
                                       <select class="form-control" name="type[]" required>
                                            <option value="file"> File</option>
                                            <option value="video"> Video</option>
                                            <option value="audio"> Audio</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                          <input type="file" accept="" class="form-control" name="lecdoc[]">
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" name="add" id="add4" class="btn btn-primary btn-block">
                                            ADD MORE <i class="fe fe-plus-square"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                                        </div>

                        <div class="col-md-12">
                          <div class="form-footer">
                                <button type="submit" name="createLec" class="btn btn-primary btn-block" >
                                  CREATE LECTURE <?php echo $newlec; ?>  <i class="fe fe-download"></i>
                                </button>
                            </div>
                          </div>
                                    </div>
                                    </form>
                                  </div>

                                <div class="col-md-6">
<!--                                    <div class="table">-->
                                        <table class="table table-bordered">
                                            <thead>
                                                <th>Lecture </th>
                                                <th>Lecture Title</th>
                                                <th class="text-center"> Action</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $allLec = select("SELECT * FROM lecture WHERE cID='$cid'");
                                                if($allLec){
                                                    foreach($allLec as $lecrow){

                                                ?>
                                                <tr>
                                                    <td> <?php echo $lecrow['lecNum'];?></td>
                                                    <td><?php echo $lecrow['lecTitle']; ?></td>
                                                    <td><a href="manage-lec?cid=<?php echo $lecrow['cID']; ?>&lid=<?php echo $lecrow['lecNum'];?>" class="btn btn-primary btn-sm btn-block">Manage <i class="fe fe-file-text"></i></a></td>
                                                </tr>
                                                <?php }}else{?>
                                                <tr>
                                                    <td colspan="3"> No Lectures Created.</td>
                                                </tr>
                                                <?php }?>
                                            </tbody>

                                        </table>
<!--                                    </div>-->
                                  </div>

                              </div>

                          </div>
                        </div>
                    </div>
                    <!--====================  ENDING COURSE CONTENT PANEL =================-->

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function readtype(val){
// load the select option data into a div
    $('#loader').html("Please Wait...");
    $('#readtype').load('load/readtype.php?t='+val, function(){
    $('#loader').html("");
   });
}
</script>
<script>
    $(document).ready(function(){
        var i=1;
        $('#add4').click(function(){
            i++;
            $('#dynamic_field4').append('<tr id="row'+i+'"><td><select class="form-control" name="type[]" required><option value="file"> File</option><option value="video"> Video</option><option value="audio"> Audio</option></select></td><td><div class="form-group"><input type="file" class="form-control" name="lecdoc[]"></div></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
        });

        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });
    });
</script>
<?php include 'layout/footer.php'; ?>
