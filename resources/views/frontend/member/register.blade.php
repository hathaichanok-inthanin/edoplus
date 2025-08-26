@extends('frontend/layouts/template')
<link href="{{ asset('frontend_main/assets/css/auth.css') }}" rel="stylesheet">
@section('content')
    <div class="container" style="padding-top: 50px; margin-bottom: 50px;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if (Session::has('alert-' . $msg))
                                <div class="alert alert-{{ $msg }}" role="alert">
                                    {{ Session::get('alert-' . $msg) }}
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <span class="title">สมัครสมาชิกใหม่</span>

                    <form class="form" method="POST" action="{{ url('register-member') }}">@csrf

                        <div class="group">
                            <input placeholder="" onkeyup="autoTab(this)" id="txtID" type="text" name="card_id"
                                value="{{ old('card_id') }}">
                            <label for="card_id">หมายเลขบัตรประชาชน
                                @if ($errors->has('card_id'))
                                    <span class="text-danger"
                                        style="font-size: 15px;">({{ $errors->first('card_id') }})</span>
                                @endif
                            </label>
                        </div>

                        <div class="group">
                            <div class="col-md-3 mb-3">
                                <select name="title" class="form-control">
                                    <option value="นาย" {{ old('title') == 'นาย' ? 'selected' : '' }}>นาย
                                    </option>
                                    <option value="นาง" {{ old('title') == 'นาง' ? 'selected' : '' }}>นาง
                                    </option>
                                    <option value="นางสาว" {{ old('title') == 'นางสาว' ? 'selected' : '' }}>นางสาว
                                    </option>
                                </select>
                                <label for="title">คำนำหน้า</label>
                            </div>
                        </div>


                        <div class="group">
                            <input placeholder="" type="text" name="name" value="{{ old('name') }}">
                            <label for="name">ชื่อ ตามบัตรประชาชน
                                @if ($errors->has('name'))
                                    <span class="text-danger"
                                        style="font-size: 15px;">({{ $errors->first('name') }})</span>
                                @endif
                            </label>

                        </div>


                        <div class="group">
                            <input placeholder="" type="text" name="surname" value="{{ old('surname') }}">
                            <label for="surname">นามสกุล ตามบัตรประชาชน
                                @if ($errors->has('surname'))
                                    <span class="text-danger"
                                        style="font-size: 15px;">({{ $errors->first('surname') }})</span>
                                @endif
                            </label>
                        </div>


                        <div class="group">
                            <input placeholder="" type="date" name="bday" value="{{ old('bday') }}">
                            <label for="bday">วัน/เดือน/ปี ค.ศ เกิด
                                @if ($errors->has('bday'))
                                    <span class="text-danger"
                                        style="font-size: 15px;">({{ $errors->first('bday') }})</span>
                                @endif
                            </label>
                        </div>


                        <div class="group">
                            <input placeholder="" type="text" name="tel" class="phone_format"
                                value="{{ old('tel') }}">
                            <label for="tel">เบอร์โทรศัพท์
                                @if ($errors->has('tel'))
                                    <span class="text-danger" style="font-size: 15px;">({{ $errors->first('tel') }})</span>
                                @endif
                            </label>
                        </div>

                        <div class="group">
                            <input placeholder="" type="password" name="password" value="{{ old('password') }}">
                            <label for="tel">ตั้งรหัสผ่าน</label>
                        </div>

                        <div class="group">
                            <input placeholder="" type="password" name="password_confirmation"
                                value="{{ old('password_confirmation') }}">
                            <label for="tel">ยืนยันรหัสผ่านอีกครั้ง</label>
                        </div>

                        <input type="hidden" name="status" value="รอยืนยัน">
                        <button type="submit">สมัครสมาชิกใหม่</button>
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
