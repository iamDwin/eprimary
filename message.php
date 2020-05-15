<?php
$active = 'message';
include 'layout/header.php';

//if(isset($_GET['cid'])){
//    $cid = $_GET['cid'];
//}
$_SESSION['current_page']=$_SERVER['REQUEST_URI'];

if(isset($_POST['sendMessage'])){
    $sernder = $userDet['userID'];
    $recipient = trim(htmlspecialchars($_POST['recipient']));
    $heading = trim(htmlspecialchars($_POST['heading']));
    $text = trim(htmlspecialchars($_POST['text']));
    $date = trim(date("Y-m-d"));
    $time = trim(date("H:i:s"));
    $status = trim("unread");

    if($sernder == $recipient){
       $error = "<script>document.write('SENDER AND RECIPIENT ARE THE SAME..');</script>";
    }else{
         $savemsg = insert("INSERT INTO messages(sender,recipient,heading,text,date,time,status,doe) VALUES('$sernder','$recipient','$heading','$text','$date','$time','$status','$dateToday')");
        if($savemsg){
            $success = "<script>document.write('MESSAGE SENT..!');window.location.href='./sent-message';</script>";
        }else{
            $error = "<script>document.write('FAILED TO SEND MESSAGE, TRY AGAIN!');</script>";
        }
    }


}
?>

<div class="my-3 my-md-5">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
<!--        <h3 class="page-title mb-5">Messaging Service</h3>-->
        <div>
          <div class="list-group list-group-transparent mb-0">
            <a href="./inbox" class="list-group-item list-group-item-action d-flex align-items-center">
              <span class="icon mr-3"><i class="fe fe-inbox"></i></span>Inbox <span class="ml-auto badge badge-primary"><?php echo $msgs;?></span>
            </a>
            <a href="./sent-message" class="list-group-item list-group-item-action d-flex align-items-center">
              <span class="icon mr-3"><i class="fe fe-send"></i></span>Sent Mail
            </a>
<!--
            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
              <span class="icon mr-3"><i class="fe fe-alert-circle"></i></span>Important <span class="ml-auto badge badge-secondary">3</span>
            </a>
            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
              <span class="icon mr-3"><i class="fe fe-star"></i></span>Starred
            </a>
            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
              <span class="icon mr-3"><i class="fe fe-file"></i></span>Drafts
            </a>
            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
              <span class="icon mr-3"><i class="fe fe-tag"></i></span>Tags
            </a>
-->
            <a href="./trash-message" class="list-group-item list-group-item-action d-flex align-items-center">
              <span class="icon mr-3"><i class="fe fe-trash-2"></i></span>Trash
            </a>
          </div>
<!--
          <div class="mt-6">
            <a href="#" class="btn btn-secondary btn-block">Compose new Email</a>
          </div>
-->
        </div>
      </div>
      <div class="col-md-9">
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
          <div class="card-header">
            <h3 class="card-title">Compose new message</h3>
          </div>
          <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data" onsubmit="return confirm('SEND MESSAGE ?');">
              <div class="form-group">
                <div class="row align-items-center">
                  <label class="col-sm-2">To:</label>
                  <div class="col-sm-10">
                      <select class="form-control" name="recipient" required>
                          <option></option>
                        <optgroup label="Lecturer"> </optgroup>
                          <?php
                           $lecsql = select("SELECT * FROM lecturer WHERE depID='".$userDet['depID']."'");
                          if($lecsql){
                              foreach($lecsql as $lecrow){
                          ?>
<option value="<?php echo $lecrow['lecID'];?>" <?php if($lecrow['lecID'] == $_SESSION['userID']){ echo 'style="display:none;"'; }?> ><?php echo $lecrow['firstName']." ".$lecrow['otherName']." ".$lecrow['lastName'];?></option>
                          <?php }}?>

                          <optgroup label="Student"> Student</optgroup>
                          <?php
                           $stusql = select("SELECT * FROM student WHERE depID='".$userDet['depID']."'");
                          if($stusql){
                              foreach($stusql as $strow){
                          ?>
                          <option value="<?php echo $strow['studentID'];?>" <?php if($strow['studentID'] == $_SESSION['userID']){ echo 'style="display:none;"'; }?> ><?php echo $strow['firstName']." ".$strow['otherName']." ".$strow['lastName'];?></option>
                          <?php }}?>
                      </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row align-items-center">
                  <label class="col-sm-2">Subject:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="heading" required>
                  </div>
                </div>
              </div>
              <textarea rows="3" class="form-control" name="text" required></textarea>
              <div class="btn-list mt-4 text-right">
                <button type="reset" class="btn btn-secondary btn-space">Cancel</button>
                <button type="submit" name="sendMessage" class="btn btn-primary btn-space">Send message</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'layout/footer.php'; ?>
