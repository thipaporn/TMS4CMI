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
      <!-- ใส่รูป -->
      <div class="row">
        <div class="col-9"></div>
        <div class="col-3">
          <button type="button" class="btn btn-gradient-danger">กลับ</button>
        </div>
      </div>
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