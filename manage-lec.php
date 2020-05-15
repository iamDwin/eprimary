<?php
$active = 'lcourses';
include 'layout/header.php';

if(isset($_GET['cid'])){
    $cid = $_GET['cid'];
    $lecNum = $_GET['lid'];
}
$MAIN_UPLOAD = PARENT_DIR.$cid.'/';
$MEDIA_UPLOAD = PARENT_DIR.$cid.'/media/';
$DOC_UPLOAD = PARENT_DIR.$cid.'/documents/';
$ASSIGNMENT_UPLOAD = PARENT_DIR.$cid.'/assignment/';

$_SESSION['current_page']=$_SERVER['REQUEST_URI'];
//get course details..
$cnm = select("SELECT * FROM courses WHERE ciD='$cid'");
foreach($cnm as $cnmrow){}

$allLec = select("SELECT * FROM lecture WHERE cID='$cid' AND lecNum='$lecNum'");
if($allLec){
    foreach($allLec as $lecrow){}
}

//CREATE LECTURE QUERY..
if(isset($_POST['updateLec'])){
    $lectitle = trim(htmlspecialchars($_POST['lectitle']));

    $numlecdoc = count($_FILES['lecdoc']['name']);
    $numdoctype = count($_POST['type']);

    if($numlecdoc > 0 && $numdoctype > 0){
    //create lecture codes
//    $createlec = insert("INSERT INTO lecture(cID,lecID,lecNum,lecTitle,doe) VALUES('$cid','".$userDet['lecID']."','$newlec','$lectitle','$dateToday')");
    $updatelec = update("UPDATE lecture SET lectitle='$lectitle' WHERE lecNum='$lecNum' AND cID='$cid'");
    if($updatelec){
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
                        $allowed = array('application','doc','docx','ppt','pptx','pdf','txt');
                    }

                    if($type == 'video'){
                        $allowed = array('video','mpeg','mp4','WEBM','webm');
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
                    $savedoc = insert("INSERT INTO cdocument(cID,lecID,lecture,docName,doe) VALUES('$cid','".$userDet['lecID']."','$lecNum','$file_name_new', '$dateToday')");
                }

                if($type == 'video' || $type == 'audio'){
                    $savedoc = insert("INSERT INTO cmedia(cID,lecID,lecture,mediatype,mediaName,doe) VALUES('$cid','".$userDet['lecID']."','$lecNum','$type','$file_name_new', '$dateToday')");
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
              <?php echo $cnmrow['cID'];?> : <?php echo strtoupper($cnmrow['courseName']);?> - Lecture <?php echo $lecNum; ?> <small class="text-right"></small>
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

                    <!--====================  START COURSE CONTENT PANEL =================-->
                    <div class="col-md-6">
                        <div class="card">
                          <div class="card-status card-status-left bg-blue"></div>
                          <div class="card-header">
                            <h3 class="card-title"> COURSE CONTENT PANEL</h3>
                            <div class="card-options">
                              <a href="#" class="card-options-collapse btn btn-primary btn-sm" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                            </div>
                          </div>
                          <div class="card-body">

                              <div class="row">

                                <div class="col-md-12">
                        <form class="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-12">
                            <table id="dynamic_field4" class="table table-bordered" width="100%">
                            <tbody>
                                <tr>
                                    <td colspan="3">
                                        <input type="text" name="lectitle" class="form-control" value="<?php echo $lecrow['lecTitle']; ?>" placeholder="Lecture Title..." required />
                                    </td>

<!--                                    <td class="text-center"></td>-->
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
                                <button type="submit" name="updateLec" class="btn btn-primary btn-block" >
                                  UPDATE LECTURE <?php echo $lecNum; ?>  <i class="fe fe-refresh-cw"></i>
                                </button>
                            </div>
                          </div>
                                    </div>
                                    </form>
                                  </div>
                              </div>

                          </div>
                        </div>
                    </div>
                    <!--====================  ENDING COURSE CONTENT PANEL =================-->
                    <div class="col-md-6">
                                        <!--===================== START COURSE CONTENT ==============================-->
                <?php
                $allLec = select("SELECT * FROM lecture WHERE cID='$cid' AND lecNum='$lecNum'");
                if($allLec){
                    foreach($allLec as $lecrow){
                ?>
                <div class="card">
                    <div class="card-status bg-blue"></div>
                  <div class="card-header">
                <h3 class="card-title"> Lecture <?php echo $lecrow['lecNum']; ?> - <?php echo $lecrow['lecTitle']; ?>.</h3>
                    <div class="card-options">
<!--                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>-->
<!--                      <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>-->
                    </div>
                  </div>

                  <div class="card-body">
                      <div class="row">

                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <th colspan="2" style="font-weight:bold;"> Lecture Documents</th>
                            </thead>
                            <?php
                            $lecdoc = select("SELECT * FROM cdocument WHERE cID='$cid' AND lecture='".$lecrow['lecNum']."'");
                        if($lecdoc){
                            foreach($lecdoc as $docrow){
                            ?>
                            <tr>
                                <td>
                <a href="<?php echo $DOC_UPLOAD.$docrow['docName'];?>" target="_blank" class=""><i class="fe fe-file-text"></i> <?php echo $docrow['docName'];?></a>
                                </td>
                                <td style="width:10%;"><a onclick="return confirm('TRASH ?');" href="trash-lecfile?id=<?php echo $docrow['id'];?>&type=1" class="btn btn-danger btn-sm text-white">Trash <i class="fe fe-trash"></i></a></td>
                            </tr>
                            <?php }}else{?>
                            <tr><td> NO LECTURE DOCUMENTS UPLOADED.</td></tr>
                            <?php }?>
                        </table>
                    </div>

                          <?php
                             //get lecture media...
                        $lecmedia = select("SELECT * FROM cmedia WHERE cID='$cid' AND lecture='".$lecrow['lecNum']."'");
                        if($lecmedia){
                          ?>
                        <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <th colspan="2" style="font-weight:bold;"> Lecture Media</th>
                    </thead>
                            <?php
//                            //get lecture media...
//                        $lecmedia = select("SELECT * FROM cmedia WHERE cID='$cid' AND lecture='".$lecrow['lecNum']."'");
                        if($lecmedia){
                            foreach($lecmedia as $lmediarow){
                                $mediaye = $lmediarow['mediatype'];
                            ?>
                        <?php if($mediaye == 'video'){?>

                        <tr>
                            <td>
                                <video width="100%" height="100" controls>
                                  <source src="<?php echo $MEDIA_UPLOAD.$lmediarow['mediaName'];?>" style="width:100%;" type="video/mp4">
                                Your browser does not support the video tag.
                                </video>
                            </td>
                            <td style="width:10%;"><a onclick="return confirm('TRASH ?');" href="trash-lecfile?id=<?php echo $lmediarow['id'];?>&type=2" class="btn btn-danger btn-sm text-white text-right">Trash <i class="fe fe-trash"></i></a></td>
                        </tr>

                        <?php } if($mediaye == 'audio'){?>
                                <tr>
                                    <td>
                                        <audio controls style="height:25px;">
                                          <source src="<?php echo $MEDIA_UPLOAD.$lmediarow['mediaName'];?>" type="">
                                        Your browser does not support the audio element.
                                        </audio>
                                    </td>
                                    <td style="width:10%;"><a onclick="return confirm('TRASH ?');" href="trash-lecfile?id=<?php echo $lmediarow['id'];?>&type=2" class="btn btn-danger btn-sm text-white text-right">Trash <i class="fe fe-trash"></i></a></td>
                                </tr>
                            <?php }?>
                        <?php }}else{?>
                            <tr><td colspan="2"> NO MEDIA FOR THIS LECTURE.</td></tr>
                        <?php }?>
                        </table>
                        </div>
                          <?php } ?>

                      </div>
                  </div>
                </div>
                <?php }}else{?>
                 <div class="card card-collapsed" style="margin-top:5px;">
                    <div class="card-status bg-red"></div>
                  <div class="card-header">
                    <h3 class="card-title">NO LECTURE MATERIALS UPLOADED FOR THIS COURSE</h3>
                  </div>
                </div>
                <?php }?>
                <!--===================== END COURSE CONTENT ==============================-->

                    </div>

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
