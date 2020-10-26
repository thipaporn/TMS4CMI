@extends('queue-management.base')

<!-- @yield('content-wrapper') -->
<!-- @yield('script') -->

@section('content-wrapper')

<div class="row">
  <div class="col-lg-6">
    <h3>รายการทั้งหมด</h3>
  </div>
  <div class="col-lg-6 template-demo">
    <form action="home" method="get">
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
            @if(isset($_GET['search']))
            <?php
            $search = strtolower($_GET['search']);
            $row = 0;
            ?>
            @foreach($orders as $index => $order)
            @if(str_contains(strtolower($order->name), $search) || str_contains(strtolower($order->type), $search)|| str_contains(strtolower($order->carNumber), $search)|| str_contains(strtolower($order->dest), $search) || str_contains(strtolower($order->trackNumber), $search) || str_contains(strtolower($order->startDate), $search)|| str_contains(strtolower($order->status), $search))
            <?php $row++; ?>
            @endif
            @endforeach
            @if ($row != 0)
            <tr>
              <th>ลำดับ</th>
              <th>ชื่อพนักงานขับรถ</th>
              <th>ประเภทรถ</th>
              <th>หมายเลขรถ</th>
              <th>สถานที่</th>
              <th>เลขที่บิล</th>
              <th>วันที่จัดส่ง</th>
              <th>สถานะการขนส่ง</th>
            </tr>
            @endif  
            @else
            <tr>
              <th>ลำดับ</th>
              <th>ชื่อพนักงานขับรถ</th>
              <th>ประเภทรถ</th>
              <th>หมายเลขรถ</th>
              <th>สถานที่</th>
              <th>เลขที่บิล</th>
              <th>วันที่จัดส่ง</th>
              <th>สถานะการขนส่ง</th>
            </tr>
            @endif
          </thead>
          <tbody>
          @if (isset($_GET['search']))
          <?php
          $search = strtolower($_GET['search']);
          $row = 0;
          ?>
          @foreach($orders as $index => $order)
          @if(str_contains(strtolower($order->name), $search) || str_contains(strtolower($order->type), $search)|| str_contains(strtolower($order->carNumber), $search)|| str_contains(strtolower($order->dest), $search) || str_contains(strtolower($order->trackNumber), $search) || str_contains(strtolower($order->startDate), $search)|| str_contains(strtolower($order->status), $search))
          <?php $row++; ?>
            <tr>
              <td class="py-1">{{$index + 1}}</td>
              <td>{{$order->name}}</td>
              <td>{{$order->type}}</td>
              <td>{{$order->carNumber}}</td>
              <td>{{$order->dest}}</td>
              <td>{{$order->trackNumber}}</td>
              <td>{{$order->startDate}}</td>
              <td>{{$order->status}}</td>
            </tr>
          @endif
          @endforeach
          @if ($row = 0)
          <tr>
            <td class="py-1">Not Found</td>
          </tr>
          @endif
          @else
          @foreach($orders as $index => $order)
          <tr>
            <td class="py-1">{{$index + 1}}</td>
            <td>{{$order->name}}</td>
            <td>{{$order->type}}</td>
            <td>{{$order->carNumber}}</td>
            <td>{{$order->dest}}</td>
            <td>{{$order->trackNumber}}</td>
            <td>{{$order->startDate}}</td>
            <td>{{$order->status}}</td>
          </tr>
          @endforeach
          @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @endsection