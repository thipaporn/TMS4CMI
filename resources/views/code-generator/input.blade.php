@extends('queue-management.base')

<!-- @yield('content-wrapper') -->
<!-- @yield('script') -->

@section('content-wrapper')
<h2>สร้างคิวอาร์โค้ดและหมายเลขติดตามการขนส่ง</h2><br />
<div class="col-md-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
    <form action="codeGeneratorInput" method="get">
      <div class="form-group row">
        <h3 class="col-sm-2 col-form-label">ชื่อลูกค้า/บริษัท</h3>
            <div class="col-lg-7">
                <input type="text" name="search" class="form-control" placeholder="ชื่อลูกค้า หรือ ชื่อบริษัท">
            </div>
            <div class="col-lg-3">
                <button type="submit" class="btn btn-inverse-dark btn-fw" style="font-size: 20px;">ค้นหา</button>
            </div>
      </div>
    </form>
      <table class="table table-striped">
        <thead>
          @if(isset($_GET['search']))
            <?php
              $search = strtolower($_GET['search']);
              $row = 0;
            ?>
            @foreach ($bills as $b)
              @if(str_contains(strtolower($b->name), $search) || str_contains(strtolower($b->trackNumber), $search))
                <?php $row++; ?>
              @endif
            @endforeach
            @if ($row != 0)
              <tr>
                <th> ชื่อ </th>
                <th> เลขที่บิล </th>
                <th> </th>
              </tr>
            @endif
          @else
          <tr>
            <th> ชื่อ </th>
            <th> เลขที่บิล </th>
            <th> </th>
          </tr>
          @endif
        </thead>
        <tbody>
          @if (isset($_GET['search']))
            <?php
              $search = strtolower($_GET['search']);
              $row = 0;
            ?>
            @foreach ($bills as $b)
                @if(str_contains(strtolower($b->name), $search) || str_contains(strtolower($b->trackNumber), $search))
                    <?php $row++; ?>
                    <tr>
                        <td> {{$b->name}} </td>
                        <td> {{$b->trackNumber}} </td>
                        <td>
                        <form action="codeGeneratorOutput" method="POST">
                        @csrf
                          <input type="hidden" name="bill" value="{{$b->trackNumber}}" />
                          <button type="submit" class="btn btn-gradient-info btn-rounded btn-fw">สร้าง</button>
                        </form>
                        </td>
                      </tr>
                @endif
            @endforeach
            @if ($row = 0)
                <h3>Not Found {{$_GET['search']}}</h3>
            @endif
          @else
            @foreach ( $bills as $b)
            <tr>
              <td> {{$b->name}} </td>
              <td> {{$b->trackNumber}} </td>
              <td>
              <form action="codeGeneratorOutput" method="POST">
              @csrf
                <input type="hidden" name="bill" value="{{$b->trackNumber}}" />
                <button type="submit" class="btn btn-gradient-info btn-rounded btn-fw">สร้าง</button>
              </form>
              </td>
            </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
  @endsection

  @section('script')
  <script type="text/javascript">
    function nextPage(billNum) {
      window.location.assign("{{URL::to('codeGeneratorOutput/?bill=')}}" + billNum);
    }
  </script>
  @endsection