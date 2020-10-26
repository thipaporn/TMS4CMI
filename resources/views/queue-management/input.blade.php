@extends('queue-management.base')
<!-- @yield('content-wrapper') -->
<!-- @yield('script') -->
@section('content-wrapper')
<div class="row">
  <div class="page-header col-lg-12">
    <h3>เพิ่มคิวรถ</h3>
  </div>
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <form method ="get" action="{{ URL::to('/') }}" class="forms-sample" name="add_bill" id="add_bill">
            <div class="form-group">
              <label for="type">ประเภทของรถขนส่ง</label>
              <select class="form-control" id="type">
                <option selected value="0">เลือก</option>
                <option value="รถกระบะ">รถกระบะ</option>
                <option value="รถบรรทุก">รถบรรทุก</option>
              </select>
            </div>
            <div class="form-group">
              <label for="location">เส้นทางในการขนส่ง</label>
              <select class="form-control" id="location">
                <option selected value="0">เลือก</option>
                <option value="เชียงใหม่">เชียงใหม่</option>
                <option value="เชียงดาว-ฝาง">เชียงดาว-ฝาง</option>
                <option value="ลำปาง">ลำปาง</option>
                <option value="เชียงราย">เชียงราย</option>
                <option value="พะเยา(พาน-ป่าแดด)">พะเยา(พาน-ป่าแดด)</option>
                <option value="พะเยา(วังเหนือ-พะเยา)">พะเยา(วังเหนือ-พะเยา)</option>
                <option value="แม่ฮ่องสอน">แม่ฮ่องสอน</option>
              </select>
            </div>
            <div class="form-group">
              <label for="date">วันที่จัดส่งสินค้า</label>
              <input type="date" class="form-control" id="date" >
            </div>
            <div class="dynamic_field">
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label for="name">ชื่อลูกค้า</label>
                      <input type="text" name="name[]" class="form-control" id="name" >
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label for="number">เลขที่บิล</label>
                      <input type="text" name="number[]" class="form-control" id="number" >
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <br />
                      <button type="button" name="add" id="add" class="btn btn-success btn_add">เพิ่ม</button>
                    </div>
                  </div>
                </div>
              </div>
            <div class="row">
              <div class="col-md-12"><br /></div>
              <div class="col-md-4"></div>
              <div class="col-md-4">
                <button type="submit" style="width:100%;font-size:20px;" class="btn btn-gradient-danger btn-icon-append"><i class="mdi mdi-note-plus"></i> เพิ่มคิวรถ</button>
              </div>
              <div class="col-md-4"></div>
              <div class="col-md-12"><br /></div>
            </div>
          </form>
          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
              <button style="width:100%;font-size:20px;" class="btn btn-gradient-primary btn-icon-text" onclick="window.location.href = '{{url('/queueManagement')}}';">ยกเลิก</button>
            </div>
            <div class="col-md-4"></div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function(){
        var i=1;
        $('.btn_add').click(function(){
          i++;
        $('.dynamic_field').append('<div class="row"><div class="col-md-5"><div class="form-group"><input type="text" name="name['+i+']" class="form-control" id="name" ></div></div><div class="col-md-5"><div class="form-group"><input type="text" name="number['+i+']" class="form-control" id="number" ></div></div><div class="col-md-2"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">ลบ</button></div></div>');
            });
        $('.dynamic_field').on('click', '.btn_remove', function(){
          $(this).closest('div.row').remove();
          i--;
        });
        $('#submit').click(function(){
          $.ajax({
            url:"name.php",
            method:"POST",
            data:$('#add_bill').serialize(),
            success:function(data)
            {
              alert(data);
              $('#add_bill')[0].reset();
            }
          });
        });
});
</script>
@endsection
