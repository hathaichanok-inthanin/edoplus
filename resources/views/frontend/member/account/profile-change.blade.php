@extends('frontend/layouts/template')

<style>
    span {
        color: red;
    }
</style>
@section('content')
    <div class="pt-3 pb-5">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-lg-12">
                    <div class="card z-index-2 h-100">
                        <form action="{{ url('/member/profile-update') }}" enctype="multipart/form-data" method="post">@csrf
                            <div class="card-body">
                                <div class="flash-message">
                                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                        @if (Session::has('alert-' . $msg))
                                            <p class="alertdesign alert alert-{{ $msg }}">
                                                {{ Session::get('alert-' . $msg) }}</p>
                                        @endif
                                    @endforeach
                                </div>
                                <h3 class="header-title" style="color: #454545;">แก้ไขข้อมูลส่วนตัว <i
                                        class="fas fa-caret-down" style="color:#777777;"></i></h3>
                                <div class="row pt-5">
                                    <div class="col-md-2">
                                        <p>คำนำหน้า <i class="fas fa-caret-right" style="color:#777777;"></i></p>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="title" class="form-control">
                                            <option value="นาย">นาย</option>
                                            <option value="นาง">นาง</option>
                                            <option value="นางสาว">นางสาว</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-2">
                                        <p>
                                            <span>*</span> หมายเลขบัตรประชาชน <i class="fa fa-caret-down"
                                                style="color:#777777;"></i>
                                            @if ($errors->has('card_id'))
                                                <span class="text-danger"
                                                    style="font-size: 15px;">({{ $errors->first('card_id') }})</span>
                                            @endif
                                        </p>
                                        <input class="form-control" type="text" value="{{ $member->card_id }}"
                                            name="card_id">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-2">
                                        <p>
                                            <span>*</span> ชื่อ ตามบัตรประชาชน <i class="fa fa-caret-down"
                                                style="color:#777777;"></i>
                                            @if ($errors->has('name'))
                                                <span class="text-danger"
                                                    style="font-size: 15px;">({{ $errors->first('name') }})</span>
                                            @endif
                                        </p>
                                        <input class="form-control" type="text" value="{{ $member->name }}"
                                            name="name">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <p>
                                            <span>*</span> นามสกุล ตามบัตรประชาชน <i class="fa fa-caret-down"
                                                style="color:#777777;"></i>
                                            @if ($errors->has('surname'))
                                                <span class="text-danger"
                                                    style="font-size: 15px;">({{ $errors->first('surname') }})</span>
                                            @endif
                                        </p>
                                        <input class="form-control" type="text" value="{{ $member->surname }}"
                                            name="surname">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <p>
                                            <span>*</span> วัน/เดือน/ปี ค.ศ เกิด <i class="fa fa-caret-down"
                                                style="color:#777777;"></i>
                                            @if ($errors->has('bday'))
                                                <span class="text-danger"
                                                    style="font-size: 15px;">({{ $errors->first('bday') }})</span>
                                            @endif
                                        </p>
                                        <input class="form-control" type="text" value="{{ $member->bday }}"
                                            name="bday">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <p>
                                            <span>*</span> เบอร์โทรศัพท์ <i class="fa fa-caret-down"
                                                style="color:#777777;"></i>
                                            @if ($errors->has('tel'))
                                                <span class="text-danger"
                                                    style="font-size: 15px;">({{ $errors->first('tel') }})</span>
                                            @endif
                                        </p>
                                        <input class="phone_format form-control" type="text" value="{{ $member->tel }}"
                                            name="tel">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-3">
                                        <input type="hidden" name="id" value="{{ $member->id }}">
                                        <button type="submit" class="btn btn-sm btn-success">แก้ไขข้อมูลส่วนตัว</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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
