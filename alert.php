<?php if($fc == 'false'){ ?>
    <div class="alert alert-icon alert-danger" data-auto-dismiss role="alert">
        <button type="button" class="close" data-dismiss="alert"></button>
      <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> FACULTY CREATION FAILED, TRY AGAIN.
    </div>
<?php } ?>

<?php if($fc == 'efalse'){ ?>
    <div class="alert alert-icon alert-danger" data-auto-dismiss role="alert">
        <button type="button" class="close" data-dismiss="alert"></button>
      <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> FACULTY NAME ALREADY EXIST.
    </div>
<?php } ?>

<?php if($fc == 'de'){ ?>
    <div class="alert alert-icon alert-danger" data-auto-dismiss role="alert">
        <button type="button" class="close" data-dismiss="alert"></button>
      <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> DEPARTMENTS EXIST FOR SELECTED FACULTY.
    </div>
<?php } ?>

<?php if($fc == 'df'){ ?>
    <div class="alert alert-icon alert-danger" data-auto-dismiss role="alert">
        <button type="button" class="close" data-dismiss="alert"></button>
      <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> DELETE FAILED.
    </div>
<?php } ?>

<?php if($fc == 'fupf'){ ?>
    <div class="alert alert-icon alert-danger" data-auto-dismiss role="alert">
        <button type="button" class="close" data-dismiss="alert"></button>
      <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> FACULTY UPDATE FAILED.
    </div>
<?php } ?>


<!--  ============================= SUCCESS ALERTS ====================== ===================== -->
<?php if($fc == 'true'){ ?>
  <div class="alert alert-icon alert-success" role="alert">
      <button type="button" class="close" data-dismiss="alert"></button>
      <i class="fe fe-check mr-2" aria-hidden="true"></i> FACULTY CREATED.
    </div>
<?php } ?>

<?php if($fc == 'fd'){ ?>
  <div class="alert alert-icon alert-success" role="alert">
      <button type="button" class="close" data-dismiss="alert"></button>
      <i class="fe fe-check mr-2" aria-hidden="true"></i> FACULTY DELETE SUCCESSFUL.
    </div>
<?php } ?>

<?php if($fc == 'fup'){ ?>
  <div class="alert alert-icon alert-success" role="alert">
      <button type="button" class="close" data-dismiss="alert"></button>
      <i class="fe fe-check mr-2" aria-hidden="true"></i> FACULTY UPDATED SUCCESSFUL.
    </div>
<?php } ?>


<?php if($dp == 'false'){ ?>
    <div class="alert alert-icon alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert"></button>
      <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> DEPARTMENT CREATION FAILED, TRY AGAIN.
    </div>
<?php } ?>
<?php if($dp == 'efalse'){ ?>
    <div class="alert alert-icon alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert"></button>
      <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> DEPARTMENT NAME ALREADY EXIST.
    </div>
<?php } ?>

<?php if($dp == 'true'){ ?>
  <div class="alert alert-icon alert-success" role="alert">
      <button type="button" class="close" data-dismiss="alert"></button>
      <i class="fe fe-check mr-2" aria-hidden="true"></i> DEPARTMENT CREATED.
    </div>
<?php } ?>
