<?php
$active = 'message';
include 'layout/header.php';

//if(isset($_GET['mid'])){
//    $mid = $_GET['mid'];
//}
//$_SESSION['current_page']=$_SERVER['REQUEST_URI'];
//
////get message details..
//$mesage = select("SELECT * FROM messages WHERE mid='$mid'");
//if(count($mesage) > 0){
//    foreach($mesage as $msgrow){}
//    //update message to read...
//    $update = update("UPDATE messages SET status='read' WHERE mid='$mid'");
//    //get sender..
//    $lecsearch = select("SELECT * FROM lecturer WHERE lecID='".$msgrow['sender']."'");
//    if(count($lecsearch) > 0){
//        foreach($lecsearch as $lecfrow){
//            if($msgrow['sender'] == $userDet['userID']){
//                 $sender = "You";
//            }else{
//                $sender = $lecfrow['firstName']." ".$lecfrow['lastName'];
//            }
//
//        }
//    }else{
//        $stusearch = select("SELECT * FROM student WHERE studentID='".$msgrow['sender']."'");
//        if(count($stusearch) > 0){
//            foreach($stusearch as $stufrow){
//                 if($msgrow['sender'] == $userDet['userID']){
//                 $sender = "You";
//                }else{
//                    $sender = $stufrow['firstName']." ".$stufrow['lastName'];
//                }
//            }
//        }
//    }
//}


if(isset($_POST['sendreply'])){
    $text = trim(htmlspecialchars($_POST['text']));
    $date = trim(date("Y-m-d"));
    $time = trim(date("H:i:s"));
    $status = trim("unread");

    $insert = insert("INSERT INTO message_reply(mid,sender,text,date,time,status) VALUES('$mid','".$userDet['userID']."','$text','$date','$time','$status')");

    //update message and set it to unread..
    $update = update("UPDATE messages SET status='unread' WHERE mid='$mid'");

    if($insert && $update){
        $success = "<script>document.write('REPLY SENT..!');window.location.href='./inbox';</script>";
    }else{
        $error = "<script>document.write('FAILED TO SEND REPLY, TRY AGAIN!');</script>";
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
            <a href="./inbox" class="list-group-item list-group-item-action d-flex align-items-center active">
              <span class="icon mr-3"><i class="fe fe-inbox"></i></span>Inbox <span class="ml-auto badge badge-primary"><?php echo $msgs;?></span>
            </a>
            <a href="./sent-message" class="list-group-item list-group-item-action d-flex align-items-center">
              <span class="icon mr-3"><i class="fe fe-send"></i></span>Sent Mail
            </a>
            <a href="./trash-message" class="list-group-item list-group-item-action d-flex align-items-center">
              <span class="icon mr-3"><i class="fe fe-trash-2"></i></span>Trash
            </a>
          </div>
          <div class="mt-6">
            <a href="./message" class="btn btn-secondary btn-block">Compose New Message</a>
          </div>
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
              <h4 class="card-title text-bold"> <?php echo $msgrow['heading'];?></h4>
          </div>
          <ul class="list-group card-list-group">
            <li class="list-group-item py-5">
              <div class="media">
                <div class="media-object avatar mr-1"> <i class="fe fe-user"></i></div>
                <div class="media-body">
                  <div class="media-heading">
                    <small class="float-right text-muted"><?php echo timeago($msgrow['doe']);?></small>
                    <h5><?php echo $sender; ?></h5>
                  </div>
                  <div><?php echo $msgrow['text'];?></div>
                    <ul class="media-list" style="height:150px; overflow: scroll;">
                <?php
                //get replies to this message..
                    $replies = select("SELECT * FROM message_reply WHERE mid='$mid' ORDER BY time ASC");
                    if(count($replies) > 0){
                        foreach($replies as $reprow){

                    //get sender..
                    $lecsearch = select("SELECT * FROM lecturer WHERE lecID='".$reprow['sender']."'");
                    if(count($lecsearch) > 0){
                        foreach($lecsearch as $lecfrow){
                            $sender2 = $lecfrow['firstName']." ".$lecfrow['lastName'];
                        }
                    }else{
                        $stusearch = select("SELECT * FROM student WHERE studentID='".$reprow['sender']."'");
                        if(count($stusearch) > 0){
                            foreach($stusearch as $stufrow){
                                $sender2 = $stufrow['firstName']." ".$stufrow['lastName'];
                            }
                        }
                    }
                ?>
                    <li class="media mt-4">
<!--                      <div class="media-object avatar mr-1"><i class="fe fe-user"></i></div>-->
                      <div class="media-body">
                        <strong><?php if($userDet['userID'] ==  $reprow['sender'] ){ echo "You";}else{ echo $sender2;} ?> </strong><br>
                        <?php echo $reprow['text'];?>
                      </div>
                    </li>

                <?php }}?>
                  </ul>


                </div>
              </div>
            </li>
          </ul>
            <div class="card-footer">
                <form method="post" enctype="multipart/form-data" onsubmit="return confirm('REPLY MESSAGE ?');">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                              <input type="text" class="form-control" name="text" placeholder="Message">
                              <div class="input-group-append">
                                <button type="submit" name="sendreply" class="btn btn-secondary">
                                  Send Reply <i class="fe fe-send"></i>
                                </button>
                              </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'layout/footer.php'; ?>
