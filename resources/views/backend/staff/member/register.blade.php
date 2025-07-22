@extends('backend/layouts/staff/template')
<style>
    .account p {
        font-weight: 600;
        font-size: 16px;
    }

    .account span {
        color: rgba(253, 48, 48, 0.699);
        font-size: 14px;
    }

    .account h4 {
        color: #fff;
    }

    .account h3 {
        font-size: 26px;
    }

    .header h4 {
        color: #fff;
        border-bottom: 2px solid #eeeeee;
        padding-bottom: 15px;
    }
</style>
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-5 mb-lg-0 mb-4">
                <a href="javascript:history.back();" style="color:#fff;"><i class="ni ni-bold-left"></i> ย้อนกลับ</a>
            </div>
        </div>
        <div class="header mt-4">
            <h4>สมัครสมาชิกใหม่</h4>
        </div>
        <div class="account">
            <div class="row mt-4">
                <div class="col-lg-3 mb-lg-0 mb-4"></div>
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="card z-index-2 h-100">
                        <form action="{{ url('staff/register-member') }}" enctype="multipart/form-data" method="post">@csrf
                            <div class="card-body">
                                <div class="flash-message">
                                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                        @if (Session::has('alert-' . $msg))
                                            <p class="alertdesign alert alert-{{ $msg }}">
                                                {{ Session::get('alert-' . $msg) }}</p>
                                        @endif
                                    @endforeach
                                </div>
                                <h3>ข้อมูลผู้สมัครสมาชิก <i class="fa fa-caret-down" style="color:#777777;"></i></h3>
                                <div class="row">
                                    <div class="col-md-2 mt-4">
                                        <p>คำนำหน้า <i class="fa fa-caret-right" style="color:#777777;"></i></p>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <select name="title" class="form-control">
                                            <option value="นาย" {{ old('title') == 'นาย' ? 'selected' : '' }}>นาย
                                            </option>
                                            <option value="นาง" {{ old('title') == 'นาง' ? 'selected' : '' }}>นาง
                                            </option>
                                            <option value="นางสาว" {{ old('title') == 'นางสาว' ? 'selected' : '' }}>นางสาว
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-2">
                                        <p>
                                            <span>*</span> หมายเลขบัตรประชาชน <i class="fa fa-caret-down"
                                                style="color:#777777;"></i><br>
                                            @if ($errors->has('card_id'))
                                                <span class="text-danger"
                                                    style="font-size: 15px;">({{ $errors->first('card_id') }})</span>
                                            @endif
                                        </p>
                                        <input onkeyup="autoTab(this)" id="txtID" type="text"
                                            placeholder="หมายเลขบัตรประชาชน" name="card_id" class="form-control"
                                            value="{{ old('card_id') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-2">
                                        <p>
                                            <span>*</span> ชื่อ ตามบัตรประชาชน <i class="fa fa-caret-down"
                                                style="color:#777777;"></i><br>
                                            @if ($errors->has('name'))
                                                <span class="text-danger"
                                                    style="font-size: 15px;">({{ $errors->first('name') }})</span>
                                            @endif
                                        </p>
                                        <input class="form-control" type="text" placeholder="กรอกชื่อ ตามบัตรประชาชน"
                                            name="name" value="{{ old('name') }}">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <p>
                                            <span>*</span> นามสกุล ตามบัตรประชาชน <i class="fa fa-caret-down"
                                                style="color:#777777;"></i><br>
                                            @if ($errors->has('surname'))
                                                <span class="text-danger"
                                                    style="font-size: 15px;">({{ $errors->first('surname') }})</span>
                                            @endif
                                        </p>
                                        <input class="form-control" type="text" placeholder="กรอกนามสกุล ตามบัตรประชาชน"
                                            name="surname" value="{{ old('surname') }}">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <p>
                                            <span>*</span> วัน/เดือน/ปี ค.ศ เกิด <i class="fa fa-caret-down"
                                                style="color:#777777;"></i><br>
                                            @if ($errors->has('bday'))
                                                <span class="text-danger"
                                                    style="font-size: 15px;">({{ $errors->first('bday') }})</span>
                                            @endif
                                        </p>
                                        <input class="form-control" type="text" placeholder="กรอกวัน/เดือน/ปี ค.ศ เกิด"
                                            name="bday" value="{{ old('bday') }}">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <p>
                                            <span>*</span> เบอร์โทรศัพท์ <i class="fa fa-caret-down"
                                                style="color:#777777;"></i><br>
                                            @if ($errors->has('tel'))
                                                <span class="text-danger"
                                                    style="font-size: 15px;">({{ $errors->first('tel') }})</span>
                                            @endif
                                        </p>
                                        <input class="phone_format form-control" type="text"
                                            placeholder="กรอกเบอร์โทรศัพท์" name="tel" value="{{ old('tel') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-3">
                                        <input type="hidden" name="status" value="ONLINE">
                                        <button type="submit" class="btn btn-lg btn-success">สมัครสมาชิกใหม่</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 mb-lg-0 mb-4"></div>
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

    <script language="javascript">
        //เมื่อมีการคลิกฟังก์ชัน
        $(function() {
            $('.btn_sub').click(function() {
                if ($('#txtID').val().trim() == '') {
                    $('#msg').text('กรุณากรอกเลขประจำตัว');
                    $('#txtID').focus();
                } else {
                    //checkID($('#txtID').val() จะไปเรียกฟังก์ชัน  checkID(id)
                    if (!checkID($('#txtID').val().trim())) {
                        alert('รหัสประชาชนไม่ถูกต้อง');
                        return false;
                    }
                }
            });
        });

        //ตรวจสอบเลข ปปช ว่ามีจริงหรือไม่
        function checkID(id) {

            //ตัดข้อความ - ออก
            var zid = id;
            var zids = zid.split("-");
            for (var i = 0; i < zids.length; i++) {
                zids[i];
            }
            var id_val = zids[0] + zids[1] + zids[2] + zids[3] + zids[4];

            if (id_val.length != 13) return false;
            for (i = 0, sum = 0; i < 12; i++)
                sum += parseFloat(id_val.charAt(i)) * (13 - i);
            if ((11 - sum % 11) % 10 != parseFloat(id_val.charAt(12)))
                return false;
            return true;
        }

        //ฟังก์ชัน รูปแบบ
        function autoTab(obj) {
            /* กำหนดรูปแบบข้อความโดยให้ _ แทนค่าอะไรก็ได้ แล้วตามด้วยเครื่องหมาย
            หรือสัญลักษณ์ที่ใช้แบ่ง เช่นกำหนดเป็น  รูปแบบเลขที่บัตรประชาชน
            4-2215-54125-6-12 ก็สามารถกำหนดเป็น  _-____-_____-_-__
            รูปแบบเบอร์โทรศัพท์ 08-4521-6521 กำหนดเป็น __-____-____
            หรือกำหนดเวลาเช่น 12:45:30 กำหนดเป็น __:__:__
            ตัวอย่างข้างล่างเป็นการกำหนดรูปแบบเลขบัตรประชาชน
            */
            var pattern = new String("_-____-_____-_-__"); // กำหนดรูปแบบในนี้
            var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
            var returnText = new String("");
            var obj_l = obj.value.length;
            var obj_l2 = obj_l - 1;
            for (i = 0; i < pattern.length; i++) {
                if (obj_l2 == i && pattern.charAt(i + 1) == pattern_ex) {
                    returnText += obj.value + pattern_ex;
                    obj.value = returnText;
                }
            }
            if (obj_l >= pattern.length) {
                obj.value = obj.value.substr(0, pattern.length);
            }
        }
    </script>
@endsection
