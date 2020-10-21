@extends('queue-management.base')

<!-- @yield('content-wrapper') -->
<!-- @yield('script') -->

@section('content-wrapper')
<h2>คิวอาร์โค้ดและหมายเลขติดตามการขนส่ง</h2><br />
<div class="col-md-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h3 class="text-center">หมายเลขติดตามการขนส่ง</h3>
      <div class="row">
        <div class="col-3"></div>
        <div class="text-center col-6">
          @foreach ($bill as $b)
            <!-- QR value-->
            <input id="qr-text" type="hidden" value="http://localhost/TMS4CMI/public/readQR?bill={{$b->trackNumber}}">
            <input  type="text" class="form-control text-center" style="font-size: 20px;" value="{{$b->trackNumber}}" readonly>
          @endforeach
        </div>
        <div class="col-3"></div>
      </div>
      <br />
      <!-- ใส่รูป -->
      <div class="row">
        <div class="col-3"></div>
        <div class="col-6 text-center">
          <canvas id="qr-code"></canvas>
        </div>
        <div class="col-3"></div>
      </div>
      <br />
      <div class="row">
        <div class="col-3"></div>
        <div class="col-6 text-center">
          <form action="codeGeneratorInput">
            <button type="submit" class="btn btn-gradient-danger" style="font-size: 20px;">กลับ</button></form>
        </div>
        <div class="col-3"></div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
<script>
  var qr;
  (function() {
    qr = new QRious({
      element: document.getElementById('qr-code'),
      size: 250,
      value: document.getElementById("qr-text").value
    });
  })();
</script>
@endsection
