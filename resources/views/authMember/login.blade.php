@extends('frontend/layouts/template')
<link href="{{asset('frontend_main/assets/css/auth.css')}}" rel="stylesheet">
@section('content')
    <div class="container" style="padding-top: 50px; margin-bottom: 50px;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <span class="title">เข้าสู่ระบบสมาชิก</span>
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if (Session::has('alert-' . $msg))
                                <div class="alert alert-{{ $msg }}" role="alert">
                                    {{ Session::get('alert-' . $msg) }}
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <form class="form" method="POST" action="{{ route('member.login.submit') }}">@csrf
                        <div class="group">
                            <input placeholder="" type="text" name="tel" class="phone_format">
                            <label for="tel">เบอร์โทรศัพท์</label>
                        </div>
                        <div class="group">
                            <input placeholder="" type="password" name="password">
                            <label for="password">รหัสผ่าน</label>
                        </div>
                        <a href="{{ route('password.forget') }}">
                            <p style="color: #000000;">ลืมรหัสผ่าน ?</p>
                        </a>
                        <button type="submit">เข้าสู่ระบบสมาชิก</button>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        function phoneFormatter() {
            $('input.phone_format').on('input', function() {
                var number = $(this).val().replace(/[^\d]/g, '')
                if (number.length >= 5 && number.length < 10) {
                    number = number.replace(/(\d{3})(\d{2})/, "$1-$2");
                } else if (number.length >= 10) {
                    number = number.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3");
                }
                $(this).val(number)
                $('input.phone_format').attr({
                    maxLength: 12
                });
            });
        };
        $(phoneFormatter);
    </script>
@endsection
