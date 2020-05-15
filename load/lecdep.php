<?php
include '../assets/core/connection.php';
$department = new Department();

if(isset($_GET['fid'])){
  $fid = $_GET['fid'];
}

$finddep = select("SELECT * FROM department WHERE facID='$fid'");

if($finddep){
?>
<label class="form-label"><i class="fe fe-grid"></i> Department Name</label>
<select name="depID" class="form-control" required>
    <option></option>
    <?php
    foreach($finddep as $deprow){
    ?>
    <option value="<?php echo $deprow['depID'];?>" > <?php echo $deprow['departmentName'];?> </option>
    <?php }?>
</select>
<?php }else{ ?>
<label class="form-label"><i class="fe fe-grid"></i> Department Name</label>
<select name="depID" class="form-control" required>
    <option></option>
</select>
<span class="text-danger">No Department Exist For This Faculty.</span>
<?php }?>
