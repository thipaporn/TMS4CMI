@extends('queue-management.base')

<!-- @yield('content-wrapper') -->
<!-- @yield('script') -->


          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <div class="nav-profile-img">
                <img src="assets/images/faces/face1.jpg" alt="image">
                <span class="availability-status online"></span>
              </div>
              <div class="nav-profile-text">
                <p class="mb-1 text-black">กิตติ</p>
              </div>
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="#">
                <i class="mdi mdi-cached mr-2 text-success"></i> Activity Log </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="nav-profile-image">
                <img src="assets/images/faces/face1.jpg" alt="profile">
                <span class="login-status online"></span>
                <!--change to offline or busy as needed-->
              </div>
              <div class="nav-profile-text d-flex flex-column">
                <span class="font-weight-bold mb-2">กิตติ</span>
                <span class="text-secondary text-small">Administor</span>
              </div>
              <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="home">
              <span class="menu-title">หน้าแรก</span>
              <i class="mdi mdi-home menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="queueManagement">
              <span class="menu-title">จัดคิวรถขนส่ง</span>
              <i class="mdi mdi-truck menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="codeGenerator">
              <span class="menu-title">สร้างรหัสการติดตาม</span>
              <i class="mdi mdi-qrcode menu-icon"></i>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->

      <!-- FOOTER -->
      <div class="main-panel">
        <div class="content-wrapper">
          <h2>สร้างคิวอาร์โค้ดและหมายเลขติดตามการขนส่ง</h2><br/>
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="form-group row">
                  <h3 class="col-sm-2 col-form-label">ชื่อลูกค้า/บริษัท</h3>
                  <div class="col-lg-7">
                    <input type="text" class="form-control" placeholder="ชื่อลูกค้า หรือ ชื่อบริษัท">
                  </div>
                  <div class="col-lg-3">
                    <button type="button" class="btn btn-inverse-dark btn-fw">ค้นหา</button>
                  </div>
                </div>
                <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> ชื่อ </th>
                          <th> เลขที่บิล </th>
                          <th>  </th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($bills as $b)
                            <tr>
                                <td> {{$b->name}} </td>
                                <td> {{$b->trackNumber}} </td>
                                <td>
                                    <form action="codeGeneratorOutput" method="POST">
                                        @csrf
                                        <input type="hidden" name="bill" value="{{$b->trackNumber}}"/>
                                        <button type="submit" class="btn btn-gradient-info btn-rounded btn-fw">สร้าง</button>
                                    </form>
                                </td>
                            </tr>
                          @endforeach
                      </tbody>
                    </table>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left  d-block d-sm-inline-block"></i></span>
              <span class="text-muted text-center text-sm-center  d-block d-sm-inline-block">บริษัท เชียงใหม่เซ็นเตอร์สตีล จำกัด </span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"></i></span>
            </div>
          </footer>
          <!-- partial -->

        </div>
      </div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th> ชื่อ </th>
            <th> เลขที่บิล </th>
            <th> </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td> Herman Beck </td>
            <td>11111111</td>
            <td> <button type="button" class="btn btn-gradient-info btn-rounded btn-fw">สร้าง</button> </td>
          </tr>
          <tr>
            <td> Messsy Adam </td>
            <td>22222222</td>
            <td> <button type="button" class="btn btn-gradient-info btn-rounded btn-fw">สร้าง</button> </td>
          </tr>
          <tr>
            <td> John Richards </td>
            <td>33333333</td>
            <td> <button type="button" class="btn btn-gradient-info btn-rounded btn-fw">สร้าง</button> </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script type="text/javascript">
        function nextPage(billNum) {
           window.location.assign("{{URL::to('codeGeneratorOutput/?bill=')}}" + billNum);
        }

     </script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
</body>

</html>

