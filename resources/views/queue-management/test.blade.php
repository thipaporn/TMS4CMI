@extends('queue-management.base')
 
<!-- @yield('content-wrapper') -->
<!-- @yield('script') -->
 
@section('content-wrapper')
<div class="page-header">
              <h2>เพิ่มคิวรถ</h2>
            </div>
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                   
                    <form method ="get" class="forms-sample" name="add_bill" id="add_bill">
                      <div class="form-group">
                        <label for="type">ประเภทของรถขนส่ง</label>
                        <select class="form-control" id="type">
                          <option value="รถกระบะ">รถกระบะ</option>
                          <option value="รถบรรทุก">รถบรรทุก</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="location">เส้นทางในการขนส่ง</label>
                        <select class="form-control" id="location">
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
                            <label for="add"></label>
                            <button type="button" name="add" id="add" class="btn btn-success btn_add">เพิ่ม</button>
                            </div>
                          </div>
                        </div>  
 
                      <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                          <button name="submit" value="sub" type="submit" style="width:50%;font-size:20px;" class="btn btn-gradient-primary mr-2" formaction="/queueManagement">เพิ่มคิวรถ</button>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-12"><br /></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-12">
                          <button name="cancel" value="can" style="width:50%;font-size:20px;" class="btn btn-light" formaction="/home">ยกเลิก</button>
                        </div>
                          <div class="col-md-3"></div>
                      </div>
 
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-2"></div>
            </div>
 
@endsection