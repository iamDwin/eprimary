<?php
$active = 'scourses';
include 'layout/header.php';
$_SESSION['current_page']=$_SERVER['REQUEST_URI'];

if(isset($_GET['cid'])){
    $cid = $_GET['cid'];
}
$MAIN_UPLOAD = PARENT_DIR.$cid.'/';
$MEDIA_UPLOAD = PARENT_DIR.$cid.'/media/';
$DOC_UPLOAD = PARENT_DIR.$cid.'/documents/';
$ASSIGNMENT_UPLOAD = PARENT_DIR.$cid.'/assignment/';

//get course details..
$cdet = select("SELECT * FROM courses WHERE cID='$cid'");
if($cdet){
    foreach($cdet as $crow){}
    //get cmanage det
    $cmanage = select("SELECT * FROM cmanagement WHERE cID='".$crow['cID']."'");
    foreach($cmanage as $cmrow){}
    //get lec det from cmanagement..
    $lecdet = select("SELECT * FROM lecturer WHERE lecID='".$cmrow['lecID']."'");
    foreach($lecdet as $lectdetrow){}
}

if(isset($_POST['sendMessage'])){
    $sernder = $userDet['userID'];
    $recipient = trim(htmlspecialchars($lectdetrow['lecID']));
    $heading = trim(htmlspecialchars($_POST['heading']));
    $text = trim(htmlspecialchars($_POST['message']));
    $date = trim(date("Y-m-d"));
    $time = trim(date("H:i:s"));
    $status = trim("unread");

    if($sernder == $recipient){
       $error = "<script>document.write('SENDER AND RECIPIENT ARE THE SAME..');</script>";
    }else{
         $savemsg = insert("INSERT INTO messages(sender,recipient,heading,text,date,time,status,doe) VALUES('$sernder','$recipient','$heading','$text','$date','$time','$status','$dateToday')");
        if($savemsg){
            $success = "<script>document.write('MESSAGE SENT..!');window.location.href='".$_SESSION['current_page']."';</script>";
        }else{
            $error = "<script>document.write('FAILED TO SEND MESSAGE, TRY AGAIN!');</script>";
        }
    }


}
?>
<style>
/* width */
#chatpanel:-webkit-scrollbar {
  width: 10px;
}

/* Track */
#chatpanel :-webkit-scrollbar-track {
  background: #f1f1f1;
}

/* Handle */
#chatpanel:-webkit-scrollbar-thumb {
  background: #888;
}

/* Handle on hover */
#chatpanel :-webkit-scrollbar-thumb:hover {
  background: #555;
}
</style>

<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
            <a class="btn btn-primary" href="javascript:history.back()"><i class="fe fe-arrow-left mr-2"></i>Go back</a>
          <h1 class="page-title"><i class="fe fe-hash"></i> <?php echo $crow['cID'];?> : <?php echo strtoupper($crow['courseName']);?></h1>
        </div>
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                      <div id="leconlimne"></div>
                    <div>
                <h4 class="m-0"> Lecturer : <?php echo $lectdetrow['lastName']." ".$lectdetrow['firstName']." ".$lectdetrow['otherName'];?></h4>
                    </div>
                  </div>
                </div>

            <div class="card">
                <div class="card-body">
                  <form class="form" method="post" enctype="multipart/form-data" onsubmit="return confirm('SEND MESSAGE ?');" >
                    <div class="form-group">
                      <input type="text" name="heading" class="form-control" placeholder="Heading..."/>
                    </div>
                    <div class="form-group">
                      <textarea class="form-control" placeholder="Message..." name="message" rows="3"></textarea>
                    </div>
                    <div class="form-footer">
                        <div class="row">
                            <div class="col-md-12">
                      <button type="submit" name="sendMessage" class="btn btn-primary btn-block">SEND MESSAGE <i class="fe fe-send"></i></button>
                            </div>
                        </div>
                    </div>
                  </form>
                </div>
              </div>

              </div>

            <div class="col-md-6 col-xl-8">
        <!--===================== START REQUIRED READING ==============================-->
                <div class="card card-collapseds">
                    <div class="card-status bg-blue"></div>
                  <div class="card-header">
                    <h3 class="card-title"> COURSE OUTLINE & REQUIRED READINGS </h3>
                    <div class="card-options">
<!--                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>-->
<!--                <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>-->
                    </div>
                  </div>

                  <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <thead>
                                    <th style="font-weight:bold;"> COURSE OUTLINE </th>
                                </thead>
                                <tbody>
                                <?php
                                $getoutline = select("SELECT * FROM outline WHERE cID='$cid'");
                                if($getoutline){
                                    foreach($getoutline as $outrow){
                                ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo $DOC_UPLOAD.$outrow['outline'];?>" target="_blank"><i class="fe fe-file-text"></i> <?php echo $outrow['outline'];?></a>
                                    </td>
                                </tr>
                                <?php }}else{?>
                                <tr><td> No Outline Available.</td></tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>

                    <div class="col-md-6">
                        <table class="table table-bordered table-reponsive">
                            <thead>
<!--                                <th style="font-weight:bold;"> Type</th>-->
                                <th style="font-weight:bold;"> REQUIRED READING</th>
                            </thead>
                            <tbody>
                                <?php
                                $getrequired = select("SELECT * FROM reqreading WHERE cID='$cid'");
                                if($getrequired){
                                    foreach($getrequired as $reqrow){
                                        $type = $reqrow['readType'];
                                ?>
                                    <?php if($type == 'book'){?>
                                    <tr>
<!--                                        <td><?php echo $type; ?></td>-->
                                        <td><?php echo $reqrow['content'];?></td>
                                    </tr>
                                    <?php } if($type == 'url'){ ?>
                                <tr>
<!--                                    <td><?php echo $type; ?></td>-->
                                    <td><a href="<?php echo $reqrow['content'];?>" target="_blank"><?php echo $reqrow['content'];?></a></td>
                                </tr>
                                    <?php } if($type == 'file'){?>
                                <tr>
<!--                                    <td><?php echo $type; ?></td>-->
                                    <td><a href="<?php echo $DOC_UPLOAD.$reqrow['content'];?>" target="_blank"><?php echo $reqrow['content'];?></a></td>
                                </tr>
                                    <?php }?>
                                <?php }}else{?>
                                <tr><td colspan="">No required reading Available.</td></tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                      </div>
                  </div>
                </div>
                <!--===================== END REQUIRED READING ==============================-->


                <!--===================== START COURSE CONTENT ==============================-->
                <?php
                $allLec = select("SELECT * FROM lecture WHERE cID='$cid'");
                if($allLec){
                    foreach($allLec as $lecrow){
                ?>
                <div class="card card-collapseds" style="margin-top:5px;">
                    <div class="card-status bg-blue"></div>
                  <div class="card-header">
                <h3 class="card-title"> Lecture <?php echo $lecrow['lecNum']; ?> - <?php echo $lecrow['lecTitle']; ?>.</h3>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                      <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                    </div>
                  </div>

                  <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                            <?php
                            //get lecture media...
                        $lecmedia = select("SELECT * FROM cmedia WHERE cID='$cid' AND lecture='".$lecrow['lecNum']."'");
                        if($lecmedia){
                            foreach($lecmedia as $lmediarow){
                                $mediaye = $lmediarow['mediatype'];
                            ?>
                            <?php if($mediaye == 'video'){?>
                        <div class="card">
                          <div class="card-body" style="padding:5px;">
                              <video width="100%" height="300" controls>
                                  <source src="<?php echo $MEDIA_UPLOAD.$lmediarow['mediaName'];?>" style="width:100%;" type="video/mp4">
                                Your browser does not support the video tag.
                                </video>

                          </div>
                        </div>
                            <?php } if($mediaye == 'audio'){?>
                        <div class="card">
                          <div class="card-body" style="padding:5px;">
                              <audio controls>
                                  <source src="<?php echo $MEDIA_UPLOAD.$lmediarow['mediaName'];?>" type="">
                                Your browser does not support the audio element.
                                </audio>
                          </div>
                        </div>
                            <?php }?>
                        <?php }}else{?>

<!--
                        <div class="card">
                          <div class="card-body" style="padding:5px;">
                              <h6> NO MEDIA FOR THIS LECTURE.</h6>
                          </div>
                        </div>
-->
                            <?php }?>
                      </div>

                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <th style="font-weight:bold;"> Lecture Documents</th>
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
                            </tr>
                            <?php }}else{?>
                            <tr><td> NO LECTURE DOCUMENTS UPLOADED.</td></tr>
                            <?php }?>
                        </table>
                          </div>
                      </div>
                  </div>
                </div>
                <?php }}else{?>
                 <div class="card card-collapseds" style="margin-top:5px;">
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
<!--</div>-->
<script>
    function dis(){
        xmlhttp=new XMLHttpRequest();
        xmlhttp.open("GET","load/leconline.php?lecID=<?php echo $cmrow['lecID'];?>",false);
        xmlhttp.send(null);
        document.getElementById("leconlimne").innerHTML=xmlhttp.responseText;
    }
        dis();

        setInterval(function(){
            dis();
        },1000);
</script>
<?php include 'layout/footer.php'; ?>
