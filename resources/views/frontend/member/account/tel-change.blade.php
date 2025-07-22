@extends('frontend/layouts/template')
<link href="{{ asset('frontend_main/assets/css/auth.css') }}" rel="stylesheet">
@section('content')
    <div class="container" style="padding-top: 50px; margin-bottom: 50px;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <span class="title">เปลี่ยนเบอร์โทรศัพท์</span>
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if (Session::has('alert-' . $msg))
                                <div class="alert alert-{{ $msg }}" role="alert">
                                    {{ Session::get('alert-' . $msg) }}
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <form class="form" method="POST" action="{{ url('/member/tel-update') }}">@csrf
                        <div class="group">
                            <input placeholder="" type="text" name="tel" class="phone_format"
                                value="{{ $member->tel }}">
                            <label for="password">เบอร์โทรศัพท์ใหม่
                                @if ($errors->has('tel'))
                                    <span class="text-danger" style="font-size: 15px;">({{ $errors->first('tel') }})</span>
                                @endif
                            </label>
                        </div>
                        <input type="hidden" name="id" value="{{ $member->id }}">
                        <button type="submit">ยืนยันเบอร์โทรศัพท์ใหม่</button>
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
