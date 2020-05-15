<?php
include '../assets/core/connection.php';
//$department = new Department();

if(isset($_GET['t'])){
  $type = $_GET['t'];
}

if($type == 'file'){
?>
<div class="form-group">
  <input type="file" accept="application/*" class="form-control" name="requiredfile">
</div>

<div class="form-action">
    <button class="btn btn-primary btn-sm btn-block" type="submit" name="requpload"> SAVE READING <i class="fe fe-download"></i></button>
</div>
<?php
}
if($type == 'url'){
?>
<div class="form-group">
  <input name="requiredurl" type="text" class="form-control" placeholder="https://...">
</div>
<div class="form-action">
    <button class="btn btn-primary btn-sm btn-block" type="submit" name="requpload"> SAVE READING <i class="fe fe-download"></i></button>
</div>
<?php
}
if($type == 'book'){
?>

<div class="form-group">
  <input type="text" name="bookName" class="form-control" placeholder="Book Name" required>
</div>

<div class="form-group">
  <input type="text" name="bookAuthor" class="form-control" placeholder="Author Name" required>
</div>
<div class="form-action">
    <button class="btn btn-primary btn-sm btn-block" type="submit" name="requpload"> SAVE READING <i class="fe fe-download"></i></button>
</div>

<?php }?>
