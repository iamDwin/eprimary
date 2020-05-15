<?php
$active = 'profile';
include 'layout/header.php';


?>

        <div class="my-3 my-md-5">
          <div class="container">
            <div class="row">
              <div class="col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Profile</h3>
                  </div>
                  <div class="card-body">
                    <div class="media">
<!--                      <span class="avatar avatar-xxl mr-5" style="background-image: url(demo/faces/male/21.jpg)"></span>-->
                      <span class="avatar avatar-xxl mr-5"><i class="fe fe-user"></i></span>
                      <div class="media-body">
                        <h4 class="m-0"><?php echo $userDet['firstName']." ".$userDet['otherName']." ".$userDet['lastName'];?></h4>
                        <p class="text-muted mb-0"><?php echo $userDet['userID'];?></p>
                        <p class="text-muted mb-0 capital"><?php echo $userDet['access'];?></p>
<!--
                        <ul class="social-links list-inline mb-0 mt-2">
                          <li class="list-inline-item">
                            <a href="javascript:void(0)" title="Facebook" data-toggle="tooltip"><i class="fa fa-facebook"></i></a>
                          </li>
                          <li class="list-inline-item">
                            <a href="javascript:void(0)" title="Twitter" data-toggle="tooltip"><i class="fa fa-twitter"></i></a>
                          </li>
                          <li class="list-inline-item">
                            <a href="javascript:void(0)" title="1234567890" data-toggle="tooltip"><i class="fa fa-phone"></i></a>
                          </li>
                          <li class="list-inline-item">
                            <a href="javascript:void(0)" title="@skypename" data-toggle="tooltip"><i class="fa fa-skype"></i></a>
                          </li>
                        </ul>
-->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-8">
                <form class="card">
                  <div class="card-body">
                    <h3 class="card-title">Edit Profile</h3>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-label"> <i class="fe fe-user"></i> First Name</label>
                          <input type="text" class="form-control" placeholder="First Name" value="<?php echo $userDet['firstName'];?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-label"><i class="fe fe-user"></i> Last Name</label>
                          <input type="text" class="form-control" placeholder="Last Name" value="<?php echo $userDet['lastName'];?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-label"><i class="fe fe-user"></i> Other Name(s)</label>
                          <input type="text" class="form-control" placeholder="Other Name" value="<?php echo $userDet['otherName'];?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-label"><i class="fe fe-mail"></i> Email Address <i class="text-danger">*</i></label>
                          <input type="email" class="form-control" placeholder="Email Address" value="<?php echo $userDet['email'];?>" readonly>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-label"> <i class="fe fe-phone"></i> Phone Number</label>
                          <input type="tel" class="form-control" placeholder="Active Phone Number" value="<?php echo $userDet['phone'];?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-label">Faculty</label>
                          <input type="text" class="form-control" placeholder="Faculty" value="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-label">Department</label>
                          <input type="number" class="form-control" placeholder="Department">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-label">Country</label>
                          <select class="form-control custom-select">
                            <option value="">Germany</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
<?php include 'layout/footer.php';?>
