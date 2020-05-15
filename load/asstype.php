<?php
include '../assets/core/connection.php';
$department = new Department();

if(isset($_GET['type'])){
  $type = $_GET['type'];
}

//$finddep = select("SELECT * FROM assignment WHERE facID='$fid'");

if($type  == 'file'){
?>
<div class="col-md-12">
    <div class="form-group">
      <label class="form-label"><i class="fe fe-file-text"></i> Upload Assignment</label>
      <input type="file" accept="application/*"  name="question" class="form-control" placeholder="Submittion"/>
    </div>
</div>
<?php }
if($type  == 'text'){ ?>
<div class="col-md-12">
    <div class="form-group">
      <label class="form-label"><i class="fe fe-file-text"></i> Type Assignment</label>
        <textarea name="question" rows="3" class="form-control"></textarea>
    </div>
</div>
<?php }?>
