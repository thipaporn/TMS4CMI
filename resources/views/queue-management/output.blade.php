@extends('queue-management.base')

<!-- @yield('content-wrapper') -->
<!-- @yield('script') -->

@section('content-wrapper')
<div class="row">
  <div class="col-lg-6">
    <h3>จัดคิวรถขนส่ง</h3>
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
</div>
<?php
  //echo $pre;
?>
<form action="addQueue" method="post">
    @csrf
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
            <?php
                $count = 1;
                $driverDist = array();
                foreach($driver as $d){
                    $driverDist[$d->id] = 0;
                    foreach ($sumDist as $sum) {
                        if($d->id == $sum->id){
                            $driverDist[$d->id] = $sum->dist;
                        }
                    }
                }
                //print_r($driverDist);
            ?>
            
            @if (isset($_GET['search']))
              <?php
              $search = strtolower($_GET['search']);
              $r= 0;
              ?>
              @foreach($pre as $row)
                <?php
                  $driverCan = array();
                  foreach ($driver as $d) {
                      $driverCan[$d->id] = true;
                      if($row->type == $d->type){
                          foreach ($schedule as $s) {
                              if($d->id == $s->id &&  $row->startDate == $s->startDate){
                                  $driverCan[$d->id] = false;
                              }
                          }
                      }else{
                          $driverCan[$d->id] = false;
                      }
                  }

                  //id driver can order
                  $driverId = array();
                  foreach ($driver as $d) {
                      if($driverCan[$d->id]){
                          array_push($driverId,$d->id);
                      }
                  }
                  // echo " have ";
                  // print_r($driverId);

                  if(count(array_filter($driverCan)) == 1){
                      foreach ($driver as $d) {
                          if($driverCan[$d->id]){
                              $id = $d->id;
                              $driverName = $d->name;
                              $driverNumber = $d->number;
                              foreach ($dist as $distValue) {
                                  if($distValue->prov == $row->dest){
                                      $driverDist[$d->id] += $distValue->dist;
                                  }
                              }
                          }
                      }
                  }elseif(count(array_filter($driverCan)) == 2){
                      $cal = array();
                      foreach ($dist as $distValue) {
                          if($distValue->prov == $row->dest){
                              $a = $driverDist[$driverId[0]];
                              $b = $driverDist[$driverId[1]];
                              $x = ($a + $b + $distValue->dist)/2;

                              $cal[$driverId[0]] = pow(($a + $distValue->dist - $x),2) + pow(($b - $x),2);
                              $cal[$driverId[1]] = pow(($a - $x),2) + pow(($b + $distValue->dist - $x),2);

                              $cal[$driverId[0]] = sqrt($cal[$driverId[0]]);
                              $cal[$driverId[1]] = sqrt($cal[$driverId[1]]);

                              foreach ($driver as $d) {
                                  if( $cal[$driverId[0]] <= $cal[$driverId[1]] ){
                                      if($d->id == $driverId[0]){
                                          $id = $d->id;
                                          $driverName = $d->name;
                                          $driverNumber = $d->number;
                                          $driverDist[$driverId[0]] += $distValue->dist;
                                      }
                                  }elseif( $cal[$driverId[0]] > $cal[$driverId[1]] ){
                                      if($d->id == $driverId[1]){
                                          $id = $d->id;
                                          $driverName = $d->name;
                                          $driverNumber = $d->number;
                                          $driverDist[$driverId[1]] += $distValue->dist;
                                      }
                                  }
                              }
                          }
                      }
                      // echo "cal ----> ";
                      // print_r($cal);
                  }elseif(count(array_filter($driverCan)) == 3){
                      $cal = array();
                      foreach ($dist as $distValue) {
                          if($distValue->prov == $row->dest){
                              $a = $driverDist[$driverId[0]];
                              $b = $driverDist[$driverId[1]];
                              $c = $driverDist[$driverId[2]];
                              $x = ($a + $b + $c +$distValue->dist)/3;

                              $cal[$driverId[0]] = pow(($a + $distValue->dist - $x),2)  + pow(($b - $x),2) + pow(($c - $x),2);
                              $cal[$driverId[1]] = pow(($a - $x),2)  + pow(($b + $distValue->dist - $x),2) + pow(($c - $x),2);
                              $cal[$driverId[2]] = pow(($a - $x),2)  + pow(($b - $x),2) + pow(($c + $distValue->dist - $x),2);

                              $cal[$driverId[0]] = sqrt($cal[$driverId[0]]/2 );
                              $cal[$driverId[1]] = sqrt($cal[$driverId[1]]/2 );
                              $cal[$driverId[2]] = sqrt($cal[$driverId[2]]/2 );

                              foreach ($driver as $d) {
                                  if( $cal[$driverId[0]] <= $cal[$driverId[1]] && $cal[$driverId[0]] <= $cal[$driverId[2]] ){
                                      if($d->id == $driverId[0]){
                                          $id = $d->id;
                                          $driverName = $d->name;
                                          $driverNumber = $d->number;
                                          $driverDist[$driverId[0]] += $distValue->dist;
                                      }
                                  }elseif( $cal[$driverId[1]] <= $cal[$driverId[0]] && $cal[$driverId[1]] <= $cal[$driverId[2]]){
                                      if($d->id == $driverId[1]){
                                          $id = $d->id;
                                          $driverName = $d->name;
                                          $driverNumber = $d->number;
                                          $driverDist[$driverId[1]] += $distValue->dist;
                                      }
                                  }elseif( $cal[$driverId[2]] <= $cal[$driverId[0]] && $cal[$driverId[2]] <= $cal[$driverId[2]]){
                                      if($d->id == $driverId[2]){
                                          $id = $d->id;
                                          $driverName = $d->name;
                                          $driverNumber = $d->number;
                                          $driverDist[$driverId[2]] += $distValue->dist;
                                      }
                                  }
                              }
                          }
                      }
                      // echo "cal ----> ";
                      // print_r($cal);
                  }else{
                      foreach ($driver as $d) {
                          if($d->id == "001"){
                              $driverId = $d->id;
                              $driverName = $d->name;
                              $driverNumber = $d->number;
                              foreach ($dist as $distValue) {
                                  if($distValue->prov == $row->dest){
                                      $driverDist[$d->id] += $distValue->dist;
                                  }
                              }
                          }
                      }
                  }
                  //print_r($driverDist);
                ?>
                @if(str_contains(strtolower($driverName), $search) || str_contains(strtolower($row->type), $search) || str_contains(strtolower($driverNumber), $search) || str_contains(strtolower($row->dest), $search) || str_contains(strtolower($row->trackNumber), $search))
                  <?php $r++; ?>
                  <tr>
                      <td>{{$count}}</td>
                      <td>{{$driverName}}</td>
                      <td>{{$row->type}}</td>
                      <td>{{$driverNumber}}</td>
                      <td>{{$row->dest}}</td>
                      <td>{{$row->trackNumber}}</td>
                  </tr>
                  <input type="hidden" name="id[]" value="{{$id}}">
                  <input type="hidden" name="name[]" value="{{$driverName}}">
                  <input type="hidden" name="type[]" value="{{$row->type}}">
                  <input type="hidden" name="carNumber[]" value="{{$driverNumber}}">
                  <input type="hidden" name="dest[]" value="{{$row->dest}}">
                  <input type="hidden" name="trackNumber[]" value="{{$row->trackNumber}}">
                  <input type="hidden" name="startDate[]" value="{{$row->startDate}}">
                  @foreach ($dist as $d)
                    @if ($d->prov == $row->dest)
                      <input type="hidden" name="dist[]" value="{{$d->dist}}">
                    @endif
                  @endforeach
                  <?php $count++ ?>
                @endif              
              @endforeach
            
            @if ($r = 0)
              <h3>Not Found {{$_GET['search']}}</h3>
            @endif
            @else
              @foreach($pre as $row)
                <?php
                  $driverCan = array();
                  foreach ($driver as $d) {
                      $driverCan[$d->id] = true;
                      if($row->type == $d->type){
                          foreach ($schedule as $s) {
                              if($d->id == $s->id &&  $row->startDate == $s->startDate){
                                  $driverCan[$d->id] = false;
                              }
                          }
                      }else{
                          $driverCan[$d->id] = false;
                      }
                  }

                  //id driver can order
                  $driverId = array();
                  foreach ($driver as $d) {
                      if($driverCan[$d->id]){
                          array_push($driverId,$d->id);
                      }
                  }
                  // echo " have ";
                  // print_r($driverId);

                  if(count(array_filter($driverCan)) == 1){
                      foreach ($driver as $d) {
                          if($driverCan[$d->id]){
                              $id = $d->id;
                              $driverName = $d->name;
                              $driverNumber = $d->number;
                              foreach ($dist as $distValue) {
                                  if($distValue->prov == $row->dest){
                                      $driverDist[$d->id] += $distValue->dist;
                                  }
                              }
                          }
                      }
                    }elseif(count(array_filter($driverCan)) == 2){
                        $cal = array();
                        foreach ($dist as $distValue) {
                            if($distValue->prov == $row->dest){
                                $a = $driverDist[$driverId[0]];
                                $b = $driverDist[$driverId[1]];
                                $x = ($a + $b + $distValue->dist)/2;

                                $cal[$driverId[0]] = pow(($a + $distValue->dist - $x),2) + pow(($b - $x),2);
                                $cal[$driverId[1]] = pow(($a - $x),2) + pow(($b + $distValue->dist - $x),2);

                                $cal[$driverId[0]] = sqrt($cal[$driverId[0]]);
                                $cal[$driverId[1]] = sqrt($cal[$driverId[1]]);

                                foreach ($driver as $d) {
                                    if( $cal[$driverId[0]] <= $cal[$driverId[1]] ){
                                        if($d->id == $driverId[0]){
                                            $id = $d->id;
                                            $driverName = $d->name;
                                            $driverNumber = $d->number;
                                            $driverDist[$driverId[0]] += $distValue->dist;
                                        }
                                    }elseif( $cal[$driverId[0]] > $cal[$driverId[1]] ){
                                        if($d->id == $driverId[1]){
                                            $id = $d->id;
                                            $driverName = $d->name;
                                            $driverNumber = $d->number;
                                            $driverDist[$driverId[1]] += $distValue->dist;
                                        }
                                    }
                                }
                            }
                        }
                        // echo "cal ----> ";
                        // print_r($cal);
                    }elseif(count(array_filter($driverCan)) == 3){
                        $cal = array();
                        foreach ($dist as $distValue) {
                            if($distValue->prov == $row->dest){
                                $a = $driverDist[$driverId[0]];
                                $b = $driverDist[$driverId[1]];
                                $c = $driverDist[$driverId[2]];
                                $x = ($a + $b + $c +$distValue->dist)/3;

                                $cal[$driverId[0]] = pow(($a + $distValue->dist - $x),2)  + pow(($b - $x),2) + pow(($c - $x),2);
                                $cal[$driverId[1]] = pow(($a - $x),2)  + pow(($b + $distValue->dist - $x),2) + pow(($c - $x),2);
                                $cal[$driverId[2]] = pow(($a - $x),2)  + pow(($b - $x),2) + pow(($c + $distValue->dist - $x),2);

                                $cal[$driverId[0]] = sqrt($cal[$driverId[0]]/2 );
                                $cal[$driverId[1]] = sqrt($cal[$driverId[1]]/2 );
                                $cal[$driverId[2]] = sqrt($cal[$driverId[2]]/2 );

                                foreach ($driver as $d) {
                                    if( $cal[$driverId[0]] <= $cal[$driverId[1]] && $cal[$driverId[0]] <= $cal[$driverId[2]] ){
                                        if($d->id == $driverId[0]){
                                            $id = $d->id;
                                            $driverName = $d->name;
                                            $driverNumber = $d->number;
                                            $driverDist[$driverId[0]] += $distValue->dist;
                                        }
                                    }elseif( $cal[$driverId[1]] <= $cal[$driverId[0]] && $cal[$driverId[1]] <= $cal[$driverId[2]]){
                                        if($d->id == $driverId[1]){
                                            $id = $d->id;
                                            $driverName = $d->name;
                                            $driverNumber = $d->number;
                                            $driverDist[$driverId[1]] += $distValue->dist;
                                        }
                                    }elseif( $cal[$driverId[2]] <= $cal[$driverId[0]] && $cal[$driverId[2]] <= $cal[$driverId[2]]){
                                        if($d->id == $driverId[2]){
                                            $id = $d->id;
                                            $driverName = $d->name;
                                            $driverNumber = $d->number;
                                            $driverDist[$driverId[2]] += $distValue->dist;
                                        }
                                    }
                                }
                            }
                        }
                        // echo "cal ----> ";
                        // print_r($cal);
                    }else{
                        foreach ($driver as $d) {
                            if($d->id == "001"){
                                $driverId = $d->id;
                                $driverName = $d->name;
                                $driverNumber = $d->number;
                                foreach ($dist as $distValue) {
                                    if($distValue->prov == $row->dest){
                                        $driverDist[$d->id] += $distValue->dist;
                                    }
                                }
                            }
                        }
                    }
                    //print_r($driverDist);
                ?>              
                <tr>
                  <td>{{$count}}</td>
                  <td>{{$driverName}}</td>
                  <td>{{$row->type}}</td>
                  <td>{{$driverNumber}}</td>
                  <td>{{$row->dest}}</td>
                  <td>{{$row->trackNumber}}</td>
                </tr>
                <input type="hidden" name="id[]" value="{{$id}}">
                <input type="hidden" name="name[]" value="{{$driverName}}">
                <input type="hidden" name="type[]" value="{{$row->type}}">
                <input type="hidden" name="carNumber[]" value="{{$driverNumber}}">
                <input type="hidden" name="dest[]" value="{{$row->dest}}">
                <input type="hidden" name="trackNumber[]" value="{{$row->trackNumber}}">
                <input type="hidden" name="startDate[]" value="{{$row->startDate}}">
                @foreach ($dist as $d)
                  @if ($d->prov == $row->dest)
                    <input type="hidden" name="dist[]" value="{{$d->dist}}">
                  @endif
                @endforeach
                <?php $count++ ?>
              @endforeach
            @endif

          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row col-lg-12">
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
      <button type="button" style="width:100%;font-size:20px;" class="btn btn-gradient-danger btn-icon-append" onclick="window.location.href = '{{url('/queueManagementInput')}}';">
        <i class="mdi mdi-note-plus"></i> เพิ่มคิวรถ
      </button>
    </div>
    <div class="col-lg-4"></div>
    <div class="col-lg-12"> <br /></div>
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
      <button type="submit" style="width:100%;font-size:20px;" class="btn btn-gradient-primary btn-icon-text">
        <i class="mdi mdi-file-check btn-icon-prepend"></i> ยืนยัน
      </button>
    </div>
    <div class="col-lg-4"></div>
  </div>
</form>

@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
  function fncAction0(billNum) {
    Swal.fire({
      title: 'ยืนยันข้อมูลการจัดคิวรถ?',
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ใช่',
      cancelButtonText: 'ไม่'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          'Deleted!',
          'Your file has been deleted.',
          'success'
        )
        setTimeout(function() {
          window.location.assign("/TMS4CMI/public/updateStatus?billNum=" + billNum);
        }, 2000);
      }
    });
  }
</script>
@endsection
