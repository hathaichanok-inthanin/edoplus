@extends("backend/layouts/admin/template")
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
          แก้ไขข้อมูลบัญชีพนักงาน
        </div>
        <form action="{{url('/edit-account-staff')}}" enctype="multipart/form-data" method="post">@csrf
        <div class="card-body">
          <div class="account">
            @php
                $stores = DB::table('account_stores')->get();
            @endphp
            <div class="row">
              <div class="col-md-12">
                <p>เลือกร้านค้า</p>
                <select name="store_id" class="form-control">
                    @php
                        $store_name = DB::table('account_stores')->where('id',$staff->store_id)->value('store_name');
                        $branch = DB::table('account_stores')->where('id',$staff->store_id)->value('branch');
                    @endphp
                    <option value="{{$staff->store_id}}" readonly>{{$store_name}} {{$branch}}</option>
                </select>
              </div>
              <div class="col-md-12 mt-2">
                <p>ตำแหน่ง</p>
                <select name="position" class="form-control">
                  <option value="{{$staff->position}}">{{$staff->position}}</option>
                  <option value="ADMIN">ADMIN</option>
                  <option value="USER">USER</option>
                </select>
              </div>
              <div class="col-md-12 mt-2">
                <p><span>*</span> ชื่อ <span>(จำเป็นต้องกรอก)</span>
                  @if ($errors->has('name'))
                    <span class="text-danger" style="font-size: 15px;">({{ $errors->first('name') }})</span>
                  @endif
                </p>
                <input class="form-control" type="text" value="{{$staff->name}}" name="name">
              </div>
              <div class="col-md-12 mt-2">
                <p><span>*</span> ชื่อผู้ใช้งาน <span>(จำเป็นต้องกรอก)</span>
                  @if ($errors->has('username'))
                    <span class="text-danger" style="font-size: 15px;">({{ $errors->first('username') }})</span>
                  @endif
                </p>
                <input class="form-control" type="text" value="{{$staff->username}}" name="username" readonly>
              </div>
              <div class="col-md-12 mt-2">
                <p>สถานะการใช้งาน</p>
                <select name="status" class="form-control">
                  <option value="{{$staff->status}}">{{$staff->status}}</option>
                  <option value="เปิด">เปิด</option>
                  <option value="ปิด">ปิด</option>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 mt-3">
                <input type="hidden" name="id" value="{{$staff->id}}">
                <button type="submit" class="btn btn-lg btn-success">แก้ไขบัญชีพนักงาน</button>
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