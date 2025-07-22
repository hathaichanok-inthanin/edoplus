@extends("backend/layouts/adminStore/template")
<style>
  .account p {
    font-weight: bolder;
    font-size: 14px;
  }

  .account span {
    color: rgba(253, 48, 48, 0.699);
    font-size: 14px;
  }
</style>
@section("content")
<div class="container-fluid py-4">
  <div class="row">   
    <div class="col-lg-5 mb-lg-0 mb-4">
        <a href="javascript:history.back();" style="color:#fff;"><i class="ni ni-bold-left"></i> ย้อนกลับ</a>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-lg-2 mb-lg-0 mb-4"></div>
    <div class="col-lg-8 mb-lg-0 mb-4">
      <div class="card z-index-2 h-100">
        <div class="flash-message">
          @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

            <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
            @endif
          @endforeach
        </div>
        <div class="card-header pb-0 pt-5 bg-transparent center" style="font-size: 28px;">
          กรอกข้อมูลสำหรับพนักงาน
        </div>
        <form action="{{url('admin/create-account-staff')}}" enctype="multipart/form-data" method="post">@csrf
        <div class="card-body">
          <div class="account">
            <div class="row">
              <div class="col-md-12">
                <input class="form-control" type="hidden" name="store_id" value="{{Auth::guard('admin-store')->id()}}">
              </div>
              <div class="col-md-12 mt-2">
                <p>ตำแหน่ง</p>
                <select name="position" class="form-control">
                  <option value="USER">USER</option>
                  <option value="ADMIN">ADMIN</option>
                </select>
              </div>
              <div class="col-md-12 mt-2">
                <p><span>*</span> ชื่อ <span>(จำเป็นต้องกรอก)</span>
                  @if ($errors->has('name'))
                    <span class="text-danger" style="font-size: 15px;">({{ $errors->first('name') }})</span>
                  @endif
                </p>
                <input class="form-control" type="text" placeholder="ชื่อ" name="name">
              </div>
              <div class="col-md-12 mt-2">
                <p><span>*</span> ชื่อผู้ใช้งาน <span>(จำเป็นต้องกรอก)</span>
                  @if ($errors->has('username'))
                    <span class="text-danger" style="font-size: 15px;">({{ $errors->first('username') }})</span>
                  @endif
                </p>
                <input class="form-control" type="text" placeholder="ชื่อผู้ใช้งาน" name="username">
              </div>
              <div class="col-md-12 mt-2">
                <p><span>*</span> รหัสผ่าน <span>(จำเป็นต้องกรอก)</span>
                  @if ($errors->has('password_name'))
                    <span class="text-danger" style="font-size: 15px;">({{ $errors->first('password_name') }})</span>
                  @endif
                </p>
                <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-eye-slash" id="eye-hide1" onclick="eye_hide_show1()"></i><i class="fa fa-eye" id="eye-show1" onclick="eye_hide_show1()"></i></span>
                  <input type="password" name="password_name" placeholder="รหัสผ่าน" class="form-control" id="password1">
                </div>
              </div>
              <div class="col-md-12 mt-2">
                <p><span>*</span> ยืนยันรหัสผ่าน <span>(จำเป็นต้องกรอก)</span>
                  @if ($errors->has('password_confirmation'))
                    <span class="text-danger" style="font-size: 15px;">({{ $errors->first('password_confirmation') }})</span>
                  @endif
                </p>
                <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-eye-slash" id="eye-hide2" onclick="eye_hide_show2()"></i><i class="fa fa-eye" id="eye-show2" onclick="eye_hide_show2()"></i></span>
                  <input type="password" name="password_confirmation" placeholder="ยืนยันรหัสผ่าน" class="form-control" id="password2">
                </div>
              </div>
              <div class="col-md-12 mt-2">
                <p>สถานะการใช้งาน</p>
                <select name="status" class="form-control">
                  <option value="เปิด">เปิด</option>
                  <option value="ปิด">ปิด</option>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-lg btn-success">สร้างบัญชีพนักงาน</button>
              </div>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>
    <div class="col-lg-2 mb-lg-0 mb-4"></div>
  </div>
</div>

<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
  function eye_hide_show1() {
      var password = document.getElementById("password1");
      if(password.type === "password") {
          password.type = "text";
          document.getElementById("eye-hide1").style.display = "none";
          document.getElementById("eye-show1").style.display = "inline-block";
          
      } else {
          password.type = "password";
          document.getElementById("eye-hide1").style.display = "inline-block";
          document.getElementById("eye-show1").style.display = "none";
      }
  }

  function eye_hide_show2() {
      var password = document.getElementById("password2");
      if(password.type === "password") {
          password.type = "text";
          document.getElementById("eye-hide2").style.display = "none";
          document.getElementById("eye-show2").style.display = "inline-block";
          
      } else {
          password.type = "password";
          document.getElementById("eye-hide2").style.display = "inline-block";
          document.getElementById("eye-show2").style.display = "none";
      }
  }
</script>
@endsection