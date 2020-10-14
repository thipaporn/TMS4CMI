@extends('queue-management.base')

<!-- @yield('content-wrapper') -->
<!-- @yield('script') -->

@section('content-wrapper')
<h2>สร้างคิวอาร์โค้ดและหมายเลขติดตามการขนส่ง</h2><br />
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