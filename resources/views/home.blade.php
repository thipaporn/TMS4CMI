@extends('queue-management.base')

<!-- @yield('content-wrapper') -->
<!-- @yield('script') -->

@section('content-wrapper')

<div class="row">
  <div class="col-lg-6">
    <h3>รายการทั้งหมด</h3>
  </div>
  <div class="col-lg-6 template-demo">
    <form action="queueManagement" method="get">
      <div class="form-group row">
        <div class="col-lg-8">
          <input type="text" name="search" class="form-control" placeholder="ค้นหาข้อมูล">
        </div>
        <div class="col-lg-2">
          <button type="submit" class="btn btn-inverse-dark btn-fw">ค้นหา</button>
        </div>
      </div>
    </form>
  </div>
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ลำดับ</th>
              <th>ชื่อพนักงานขับรถ</th>
              <th>ประเภทรถ</th>
              <th>หมายเลขรถ</th>
              <th>สถานที่</th>
              <th>เลขที่บิล</th>
              <th>สถานะการขนส่ง</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="py-1">#number</td>
              <td>#name</td>
              <td>#CarType</td>
              <td>#CarNum</td>
              <td>#location</td>
              <td>#billNumber</td>
              <td>#status</td>
            </tr>
            <tr>
              <td class="py-1">#number</td>
              <td>#name</td>
              <td>#CarType</td>
              <td>#CarNum</td>
              <td>#location</td>
              <td>#billNumber</td>
              <td>#status</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @endsection