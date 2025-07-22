@extends('backend/layouts/partner/template-auth')

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
                        {{ __('PARTNER LOGIN') }}</div>

                    <div class="card-body" style="padding-top: 0.5rem !important; padding-bottom: 0.5rem !important;">
                        <form method="POST" action="{{ route('partner.login.submit') }}" enctype="multipart/form-data">
                            @csrf

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
                                            <input type="password" name="tel" placeholder="รหัสผ่าน"
                                                class="phone_format form-control" id="password">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-md w-100">
                                            {{ __('Login Partner') }}
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
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // number phone
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
