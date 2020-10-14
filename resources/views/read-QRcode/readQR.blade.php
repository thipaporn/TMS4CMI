@extends('queue-management.base')

<!-- @yield('content-wrapper') -->
<!-- @yield('script') -->

@section('content-wrapper')
<h2>อัปเดตสถานะการขนส่ง</h2><br />
<div class="col-md-12 grid-margin stretch-card">
<div>
    <?php echo $bill ?>
</div>
  <div class="card">
    <div class="card-body">
      <div class="form-group row">
        <div class="col-lg-2"></div>
        <h3 class="col-sm-2 col-form-label">เลขที่บิล</h3>
        <div class="col-lg-6">
          <input type="text" class="form-control" style="font-size: 15px;" value="11111111" readonly>
        </div>
        <div class="col-lg-2"></div>
      </div>
      <div class="form-group row">
        <div class="col-lg-2"></div>
        <h3 class="col-sm-2 col-form-label">ชื่อลูกค้า</h3>
        <div class="col-lg-6">
          <input type="text" class="form-control" style="font-size: 15px;" value="บริษัทจำกัดมหาชน" readonly>
        </div>
        <div class="col-lg-2"></div>
      </div>
      <div class="form-group row">
        <div class="col-lg-2"></div>
        <h3 class="col-sm-2 col-form-label">สถานะปัจจุบัน</h3>
        <div class="col-lg-6">
          <input type="text" class="form-control" style="font-size: 15px;" value="อยู่ระหว่างการขนส่ง" readonly>
        </div>
        <div class="col-lg-2"></div>
      </div>
      <div class="row">
        <div class="col-lg-3"></div>
        <button type="button" class="btn btn-gradient-primary btn-lg btn-block col-lg-6" style="font-size: 20px;"> อัปเดตสถานะ </button>
        <div class="col-lg-3"></div>
      </div>
    </div>
  </div>
  @endsection

  @section('script')
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
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
  @endsection
