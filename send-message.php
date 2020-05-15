<?php
$active = 'ltests';
include 'layout/header.php';

//if(isset($_GET['cid'])){
//    $cid = $_GET['cid'];
//}
$_SESSION['current_page']=$_SERVER['REQUEST_URI'];

if(isset($_POST['sendmessage'])){
    $message = $_POST['message'];
    $number = $_POST['number'];
    $frm = "DWIN";
    $send = sendmessage(clean($number),$message,$frm);
    if($send){
        echo "<script>alert('DONE..');</script>";
    }else{
        echo "<script>alert('FAILED..');</script>";
    }
}

?>

<div class="my-3 my-md-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-5">
            <div class="card">
                <div class="card-body">
                  <form class="form" method="post" enctype="multipart/form-data" onsubmit="return confirm('SEND MESSAGE ?');" >
                    <div class="form-group">
                      <label class="form-label"><i class="fe fe-phone"></i> Phone Number</label>
                      <input type="tel" name="number" class="form-control" placeholder="Phone Number"/>
                    </div>
                    <div class="form-group">
                      <label class="form-label"><i class="fe fe-mail"></i> Message</label>
                      <textarea class="form-control" name="message" rows="3"></textarea>
                    </div>
                    <div class="form-footer">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="btn btn-primary btn-block" href="javascript:history.back()">
                                    <i class="fe fe-arrow-left mr-2"></i>Go back
                                </a>
                            </div>
                            <div class="col-md-8">
                      <button type="submit" name="sendmessage" class="btn btn-primary btn-block">SEND MESSAGE <i class="fe fe-send"></i></button>
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
