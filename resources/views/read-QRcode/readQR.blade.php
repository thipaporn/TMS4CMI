@extends('queue-management.base')

<!-- @yield('content-wrapper') -->
<!-- @yield('script') -->

@section('content-wrapper')
<h2>อัปเดตสถานะการขนส่ง</h2><br />
<div class="col-md-12 grid-margin stretch-card">
  @foreach ($bill as $b)
  <div class="card">
    <div class="card-body">
      <div class="form-group row">
        <div class="col-lg-2"></div>
        <h3 class="col-sm-2 col-form-label">เลขที่บิล</h3>
        <div class="col-lg-6">
          <input type="text" class="form-control" style="font-size: 15px;" value="{{$b->trackNumber}}" readonly>
        </div>
        <div class="col-lg-2"></div>
      </div>
      <div class="form-group row">
        <div class="col-lg-2"></div>
        <h3 class="col-sm-2 col-form-label">ชื่อลูกค้า</h3>
        <div class="col-lg-6">
          <input type="text" class="form-control" style="font-size: 15px;" value="{{$name[0]->name}}" readonly>
        </div>
        <div class="col-lg-2"></div>
      </div>
      <div class="form-group row">
        <div class="col-lg-2"></div>
        <h3 class="col-sm-2 col-form-label">สถานะปัจจุบัน</h3>
        <div class="col-lg-6">
          
          <input type="text" class="form-control" style="font-size: 15px;" value="{{$b->status}}" readonly>
        </div>
        <div class="col-lg-2"></div>
      </div>
      <form>
        <div class="row">
          <div class="col-lg-3"></div>

          @csrf
          <input type="hidden" name="billNum" value="{{$b->trackNumber}}" />
          <input type="hidden" name="billStatus" value="{{$b->status}}" />
          @if ($b->status != 'จัดส่งสินค้าเรียบร้อยแล้ว')
          <button type="button" onclick="fncAction0(billNum.value)" class="btn btn-gradient-primary btn-lg btn-block col-lg-6" style="font-size: 20px;"> อัปเดตสถานะ </button>
          @endif

          <div class="col-lg-3"></div>
          
        </div>
      </form>
    </div>
  </div>
  @endforeach
  @endsection

  @section('script')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script type="text/javascript">
    function fncAction0(billNum) {
      Swal.fire({
        title: 'ต้องการอัปเดตสถานะ?',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่',
        cancelButtonText: 'ไม่'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'อัปเดตสถานะสำเร็จ!'
          )
          setTimeout(function() {
            window.location.assign("/TMS4CMI/public/updateStatus?billNum=" + billNum);
          }, 2000);
        }
      });
    }
  </script>
  @endsection