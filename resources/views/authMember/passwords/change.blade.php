@extends('frontend/layouts/template')
<link href="{{ asset('frontend_main/assets/css/auth.css') }}" rel="stylesheet">
@section('content')
    <div class="container" style="padding-top: 50px; margin-bottom: 50px;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <span class="title">เปลี่ยนรหัสผ่าน</span>
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if (Session::has('alert-' . $msg))
                                <div class="alert alert-{{ $msg }}" role="alert">
                                    {{ Session::get('alert-' . $msg) }}
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <form class="form" method="POST" action="{{ route('password.update') }}">@csrf
                        <div class="group">
                            <input placeholder="" type="password" name="oldpassword">
                            <label for="password">รหัสผ่านเก่า</label>
                        </div>
                        <div class="group">
                            <input placeholder="" type="password" name="password">
                            <label for="password">รหัสผ่านใหม่</label>
                        </div>
                        <div class="group">
                            <input placeholder="" type="password" name="password_confirmation">
                            <label for="password">ยืนยันรหัสผ่านอีกครั้ง</label>
                        </div>
                        <button type="submit">เปลี่ยนรหัสผ่าน</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
