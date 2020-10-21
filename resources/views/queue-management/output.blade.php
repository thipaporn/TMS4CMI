@extends('queue-management.base')
 
<!-- @yield('content-wrapper') -->
<!-- @yield('script') -->

@section('content-wrapper')
<div class="row">
            <div class="col-lg-6">
              <h3>จัดคิวรถขนส่ง</h3>
            </div>
            <div class="col-lg-6 template-demo">
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ชื่อพนักงานขับรถ</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">เลขที่บิล</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
                <button type="button" class="btn btn-inverse-dark for inverse buttons">ค้นหา</button>
              </div>
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
                      </tr>
                      <tr>
                        <td class="py-1">#number</td>
                        <td>#name</td>
                        <td>#CarType</td>
                        <td>#CarNum</td>
                        <td>#location</td>
                        <td>#billNumber</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-lg-4"></div>
            <div class="col-lg-6">
              <a class="nav-link" href="queueManagementInput">
                <button type="button" class="btn btn-gradient-danger btn-icon-append">
                <i class="mdi mdi-note-plus"></i>เพิ่มข้อมูล</button>
              </a>
              <a class="nav-link" href="home">
                <button onclick="" type="button" class="btn btn-gradient-primary btn-icon-text">
                <i class="mdi mdi-file-check btn-icon-prepend"></i> ยืนยัน </button></div>
              </a>
              
          </div>

@endsection