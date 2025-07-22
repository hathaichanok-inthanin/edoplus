@extends('frontend/layouts/template')
<link type="text/css" href="{{ asset('frontend_main/assets/css/accordion.css') }}" rel="stylesheet">
@section('content')
    <div style="background-color:#090909;">
        <div class="container">
            <center>
                <div class="header-title">
                    <h2 style="padding-top:5rem; color: #ffffff; font-size: 2rem;">
                        <strong>ศูนย์ช่วยเหลือสมาชิก</strong>
                    </h2>
                    <h3 class="mt-3">คุณต้องการความช่วยเหลือในเรื่องใด? กรุณาเลือกหัวข้อด้านล่าง</h3>
                </div>
            </center>
            <br>
        </div>
        <div class="container" style="padding-bottom:5rem;">
            <div class="accordion">
                
                <div class="accordion-item">
                    <input type="checkbox" id="item-1" />
                    <label for="item-1" class="accordion-header">
                        <span>ระบบสมาชิกเอโดะพลัส คืออะไร ?</span>
                    </label>
                    <div class="accordion-content">
                        <h5><strong>EDO PLUS
                                (สมาชิกเอโดะพลัส)</strong>
                            ระบบสมาชิกลอยัลตี้
                            ที่ออกแบบมาเพื่อให้คุณได้รับสิทธิพิเศษและประสบการณ์ที่เหนือกว่าในทุกด้านของไลฟ์สไตล์
                            ไม่ว่าจะเป็นการรับประทานอาหาร ช้อปปิ้ง การเดินทาง กิจกรรมเพื่อการพักผ่อน และอื่นๆอีกมากมาย —
                            ทุกการใช้จ่ายของคุณสามารถสะสมแต้มได้ในเครือเอโดะกรุ๊ป
                            และแลกรับสิทธิประโยชน์จากร้านค้าชั้นนำและพันธมิตรในเครือ
                            ได้อย่างคุ้มค่า คุณสามารถเข้าถึง ดีลพิเศษ โปรโมชั่น และสิทธิ์เฉพาะสมาชิก ได้ง่ายๆ
                        </h5>
                    </div>
                </div>

                <div class="accordion-item">
                    <input type="checkbox" id="item-3" />
                    <label for="item-3" class="accordion-header">
                        <span>สมัครสมาชิก Edo Plus ได้อย่างไร ?</span>
                    </label>
                    <div class="accordion-content">
                        <h5>
                            คุณสามารถสมัครสมาชิก Edo Plus ได้ที่ร้านในเครือเอโดะกรุ๊ป
                            โดยสแกน QR Code ที่ร้าน หรือผ่านช่องทางที่บริษัทกำหนด
                            สมาชิก 1 ท่านสามารถมีบัญชี EDO PLUS ได้เพียงบัญชีเดียวเท่านั้น
                        </h5>
                        <div style="background-color: #eeeeee; padding: 1rem; border-radius: 10px;">
                            <div class="header-title">
                                <h4 style="color: #000000; font-size: 1.5rem; padding-top: 1rem;">
                                    <strong>ร้านในเครือเอโดะกรุ๊ป</strong>
                                </h4>
                            </div>
                            <div class="row mt-3">
                                @foreach ($account_stores as $account_store => $value)
                                    <div class="col-lg-2 col-md-2 mb-5">
                                        <img src="{{ url('images/store-logo') }}/{{ $value->image }}" width="100%">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <input type="checkbox" id="item-4" />
                    <label for="item-4" class="accordion-header">
                        <span>คะแนนสะสมมีวันหมดอายุหรือไม่ ?</span>
                    </label>
                    <div class="accordion-content">
                        <h5>
                            คะแนนสะสมไม่มีวันหมดอายุ สามารถสะสมคะแนนเพื่ออัพเกรดระดับสมาชิก และแลกของรางวัลพรีเมี่ยมได้ที่
                            www.edoplus.com
                        </h5>
                    </div>
                </div>

                <div class="accordion-item">
                    <input type="checkbox" id="item-5" />
                    <label for="item-5" class="accordion-header">
                        <span>ตรวจสอบคะแนนได้อย่างไร ?</span>
                    </label>
                    <div class="accordion-content">
                        <h5>
                            สามารถตรวจสอบคะแนนสะสมได้ที่ www.edoplus.com
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="background-color: #000000; padding: 50px;">
        <div class="container">
            <h1 style="font-size: 2rem;"><strong>ติดต่อเรา</strong></h1>
            <div class="row mt-3">
                <div class="col-md-6">
                    <p style="color: #fff; font-size: 1.2em;">
                        หากคุณมีคำถามหรือข้อสงสัยเกี่ยวกับระบบสมาชิกลอยัลตี้ของเรา
                        กรุณาติดต่อเราผ่านช่องทางด้านล่างนี้
                    </p>
                    <p style="color: #fff; font-size: 1.2em;">
                        <strong>อีเมล : </strong>
                </div>
            </div>
        </div>
    </div>
@endsection
