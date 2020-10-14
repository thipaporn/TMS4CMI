@extends('queue-management.base')

<!-- @yield('content-wrapper') -->
<!-- @yield('script') -->

@section('content-wrapper')
<h2>คิวอาร์โค้ดและหมายเลขติดตามการขนส่ง</h2><br />
<div class="col-md-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="form-group row">
        <h3 class="col-sm-3 col-form-label">หมายเลขติดตามการขนส่ง</h3>
        <div class="col-lg-7">
          <input type="text" class="form-control text-center" style="font-size: 15px;" value="11111111" readonly>
        </div>
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
          <h2>คิวอาร์โค้ดและหมายเลขติดตามการขนส่ง</h2><br />
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="form-group row">
                  <h3 class="col-sm-3 col-form-label">หมายเลขติดตามการขนส่ง</h3>
                  <div class="col-lg-7">
                      @foreach ($bill as $b)
                        <input type="text" class="form-control text-center" value="{{$b->trackNumber}}" readonly>
                        <input id="qr-text" type="hidden" value="http://localhost/TMS4CMI/public/readQR/?bill={{$b->trackNumber}}">
                      @endforeach
                  </div>
                </div>
                <!-- ใส่รูป -->
                <div class="row">
                    <canvas id="qr-code"></canvas>
                    <div class="col-3">
                        <form action="codeGeneratorInput">
                        <button type="submit" class="btn btn-gradient-danger">กลับ</button></form>
                    </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
  <script>
        var qr;
        (function() {
                qr = new QRious({
                element: document.getElementById('qr-code'),
                size: 200,
                value: document.getElementById("qr-text").value
            });
        })();
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

