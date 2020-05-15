<?php
$active = 'message';
include 'layout/header.php';

//if(isset($_GET['cid'])){
//    $cid = $_GET['cid'];
//}
$_SESSION['current_page']=$_SERVER['REQUEST_URI'];

//GET ALL MESSAGES FOR USER..
$msges = select("SELECT * FROM messages WHERE sender='".$userDet['userID']."' AND status='trashed' OR recipient='".$userDet['userID']."' AND status='trashed'");
if($msges){
    foreach($msges as $msgrow){}
}
?>

<div class="my-3 my-md-5">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
<!--        <h3 class="page-title mb-5">Messaging Service</h3>-->
        <div>
          <div class="list-group list-group-transparent mb-0">
            <a href="./inbox" class="list-group-item list-group-item-action d-flex align-items-center ">
              <span class="icon mr-3"><i class="fe fe-inbox"></i></span>Inbox <span class="ml-auto badge badge-primary"><?php echo $msgs;?></span>
            </a>
            <a href="./sent-message" class="list-group-item list-group-item-action d-flex align-items-center">
              <span class="icon mr-3"><i class="fe fe-send"></i></span>Sent Mail
            </a>
            <a href="./trash-message" class="list-group-item list-group-item-action d-flex align-items-center active">
              <span class="icon mr-3"><i class="fe fe-trash-2"></i></span>Trash
            </a>
          </div>
          <div class="mt-6">
            <a href="./message" class="btn btn-secondary btn-block">Compose New Message</a>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <div class="card">
          <table class="table card-table table-vcenter">
              <?php
                if($msges){
                    foreach($msges as $msgrow){
                    $sender = $msgrow['sender'];
                    //get sender..
                        $lecsearch = select("SELECT * FROM lecturer WHERE lecID='$sender'");
                        if(count($lecsearch) > 0){
                            foreach($lecsearch as $lecfrow){
                                $sender = $lecfrow['firstName']." ".$lecfrow['lastName'];
                            }
                        }else{
                            $stusearch = select("SELECT * FROM student WHERE studentID='$sender'");
                            if(count($stusearch) > 0){
                                foreach($stusearch as $stufrow){
                                    $sender = $stufrow['firstName']." ".$stufrow['lastName'];
                                }
                            }
                        }
              ?>
            <tr class="">
                <td>
                    <a  class="<?php echo 'text-black'; ?>" href="./message-details?mid=<?php echo $msgrow['mid'];?>" > <i class="fe fe-user"></i> <?php echo $sender; ?></a>
                </td>
                <td><a  class="<?php echo 'text-black';?>" href="./message-details?mid=<?php echo $msgrow['mid'];?>"><?php echo $msgrow['heading'];?></a> </td>
                <td class="text-right d-none d-md-table-cell text-nowrap <?php if($msgrow['status'] == 'read'){ echo 'text-black';}else{ echo 'text-primary';}?>"> <?php echo timeago($msgrow['date'].$msgrow['time']);?></td>
<!--
                <td class="text-right d-none d-md-table-cell text-nowrap">
                  <a href="./trash-msg?mid=<?php // echo $msgrow['mid'];?>" onclick="return confirm('TRASH MESSAGE ?');" class="btn btn-danger btn-sm"><i class="fe fe-trash"></i></a>
                </td>
-->
            </tr>
              <?php }}else{ ?>
              <tr> <td colspan="4"> No Messages Available</td> </tr>
              <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'layout/footer.php'; ?>
