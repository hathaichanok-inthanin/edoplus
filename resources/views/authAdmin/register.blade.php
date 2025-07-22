@extends("backend/layouts/admin/template-auth")

@section("content")
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-4">
            <div class="card mt-9">
                <div class="card-header">{{ __('ลงทะเบียนสำหรับผู้ดูแลระบบหลัก') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{url('register')}}" enctype="multipart/form-data">
                        @csrf
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                                <div class="alert alert-{{ $msg }}" role="alert">{{ Session::get('alert-' . $msg) }}</div>
                            @endif
                        @endforeach
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                                      <input type="text" name="name" placeholder="ชื่อ" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-text"><i class="fa fa-id-badge"></i></span>
                                      <input type="text" name="username" placeholder="ชื่อเข้าใช้งาน" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-text"><i class="fa fa-eye-slash" id="eye-hide1" onclick="eye_hide_show1()"></i><i class="fa fa-eye" id="eye-show1" onclick="eye_hide_show1()"></i></span>
                                      <input type="password" name="password_name" placeholder="รหัสผ่าน" class="form-control" id="password1">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-text"><i class="fa fa-eye-slash" id="eye-hide2" onclick="eye_hide_show2()"></i><i class="fa fa-eye" id="eye-show2" onclick="eye_hide_show2()"></i></span>
                                      <input type="password" name="password_confirmation" placeholder="ยืนยันรหัสผ่าน" class="form-control" id="password2">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text NotoSansThai">สถานะ</span>
                                        <select name="status" class="form-control" style="padding-left: 10px;">
                                            <option value="เปิด">เปิด</option>
                                            <option value="ปิด">ปิด</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="role" value="ผู้ดูแลระบบหลัก">

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-md w-100">
                                        {{ __('ลงทะเบียนผู้ดูแลระบบหลัก') }} 
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
