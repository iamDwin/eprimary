<?php
$active = 'ltests';
include 'layout/header.php';

//if(isset($_GET['cid'])){
//    $cid = $_GET['cid'];
//}
$_SESSION['current_page']=$_SERVER['REQUEST_URI'];


?>

        <div class="my-3 my-md-5">
          <div class="container">
            <div class="row">
              <div class="col-md-3">
                <h3 class="page-title mb-5">Messaging Service</h3>
                <div>
                  <div class="list-group list-group-transparent mb-0">
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center active">
                      <span class="icon mr-3"><i class="fe fe-inbox"></i></span>Inbox <span class="ml-auto badge badge-primary">14</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                      <span class="icon mr-3"><i class="fe fe-send"></i></span>Sent Mail
                    </a>
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
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                      <span class="icon mr-3"><i class="fe fe-trash-2"></i></span>Trash
                    </a>
                  </div>
                  <div class="mt-6">
                    <a href="#" class="btn btn-secondary btn-block">Compose new Email</a>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <div class="card">
                  <div class="card-header">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Message">
                      <div class="input-group-append">
                        <button type="button" class="btn btn-secondary">
                          <i class="fe fe-camera"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <ul class="list-group card-list-group">
                    <li class="list-group-item py-5">
                      <div class="media">
                        <div class="media-object avatar avatar-md mr-4" style="background-image: url(demo/faces/male/16.jpg)"></div>
                        <div class="media-body">
                          <div class="media-heading">
                            <small class="float-right text-muted">4 min</small>
                            <h5>Peter Richards</h5>
                          </div>
                          <div>
                            Aenean lacinia bibendum nulla sed consectetur. Vestibulum id ligula porta felis euismod semper. Morbi leo risus, porta ac consectetur
                          </div>
                          <ul class="media-list" style="height:150px; overflow: scroll;">
                            <li class="media mt-4">
                              <div class="media-object avatar mr-4" style="background-image: url(demo/faces/female/17.jpg)"></div>
                              <div class="media-body">
                                <strong>Debra Beck: </strong>
                                Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec ullamcorper nulla non metus
                                auctor fringilla. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Sed posuere consectetur est at lobortis.
                              </div>
                            </li>
                            <li class="media mt-4">
                              <div class="media-object avatar mr-4" style="background-image: url(demo/faces/male/32.jpg)"></div>
                              <div class="media-body">
                                <strong>Jack Ruiz: </strong>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit
                                amet risus.
                              </div>
                            </li>
                            <li class="media mt-4">
                              <div class="media-object avatar mr-4" style="background-image: url(demo/faces/male/32.jpg)"></div>
                              <div class="media-body">
                                <strong>Jack Ruiz: </strong>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit
                                amet risus.
                              </div>
                            </li>
                            <li class="media mt-4">
                              <div class="media-object avatar mr-4" style="background-image: url(demo/faces/male/32.jpg)"></div>
                              <div class="media-body">
                                <strong>Jack Ruiz: </strong>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit
                                amet risus.
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </li>
                  </ul>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                  <input type="text" class="form-control" placeholder="Message">
                                  <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary">
                                      Send Reply <i class="fe fe-send"></i>
                                    </button>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

<?php include 'layout/footer.php'; ?>
