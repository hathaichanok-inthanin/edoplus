@extends('backend/layouts/admin/template-auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-9">
                <img src="{{ asset('assets/image/logo.png') }}" alt="edoplus" width="50%" class="mb-5 d-block mx-auto">
                <div class="card">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if (Session::has('alert-' . $msg))
                                <div class="alert alert-{{ $msg }}" role="alert">
                                    {{ Session::get('alert-' . $msg) }}</div>
                            @endif
                        @endforeach
                    </div>

                    <div class="card-header mt-3"
                        style="padding-top: 0.5rem !important; padding-bottom: 0.5rem !important; border-radius:5rem !important;">
                        {{ __('เข้าสู่ระบบสำหรับผู้ดูแลระบบหลัก') }}</div>
                    <div class="card-body" style="padding-top: 0.5rem !important; padding-bottom: 0.5rem !important;">
                        <form method="POST" action="{{ url('login') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                    @if ($errors->has('username'))
                                        <span class="text-danger"
                                            style="font-size: 15px;">({{ $errors->first('username') }})</span>
                                    @endif
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            <input type="text" name="username" placeholder="ชื่อเข้าใช้งาน"
                                                class="form-control" value="{{ old('username') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    @if ($errors->has('password'))
                                        <span class="text-danger"
                                            style="font-size: 15px;">({{ $errors->first('password') }})</span>
                                    @endif
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-eye-slash" id="eye-hide1"
                                                    onclick="eye_hide_show()"></i><i class="fa fa-eye" id="eye-show1"
                                                    onclick="eye_hide_show()"></i></span>
                                            <input type="password" name="password" placeholder="รหัสผ่าน"
                                                class="form-control" id="password">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-md w-100">
                                            {{ __('เข้าสู่ระบบ') }}
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
        function eye_hide_show() {
            var password = document.getElementById("password");
            if (password.type === "password") {
                password.type = "text";
                document.getElementById("eye-hide1").style.display = "none";
                document.getElementById("eye-show1").style.display = "inline-block";

            } else {
                password.type = "password";
                document.getElementById("eye-hide1").style.display = "inline-block";
                document.getElementById("eye-show1").style.display = "none";
            }
        }
    </script>
@endsection
