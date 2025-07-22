@extends('frontend/layouts/template')

@section('content')
    <div class="container" style="padding-bottom: 50px;">

        <br>
        <div class="row">
            <div class="col-md-8">
                <h1 class="header-title" style="padding-top:5rem;">
                    <strong>เกี่ยวกับเรา</strong>
                </h1>
                <h2 style="line-height: 1.6em; font-size: 1.3em;">
                    EDO PLUS ระบบสมาชิกลอยัลตี้
                    ที่ออกแบบมาเพื่อให้คุณได้รับสิทธิพิเศษและประสบการณ์ที่เหนือกว่าในทุกด้านของไลฟ์สไตล์
                    ไม่ว่าจะเป็นการรับประทานอาหาร ช้อปปิ้ง การเดินทาง กิจกรรมเพื่อการพักผ่อน และอื่นๆอีกมากมาย —
                    ทุกการใช้จ่ายของคุณสามารถสะสมแต้มได้ในเครือเอโดะกรุ๊ป
                    และแลกรับสิทธิประโยชน์จากร้านค้าชั้นนำและพันธมิตรในเครือ
                    ได้อย่างคุ้มค่า คุณสามารถเข้าถึง ดีลพิเศษ โปรโมชั่น และสิทธิ์เฉพาะสมาชิก ได้ง่ายๆ
                </h2>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('frontend_main/assets/img/aboutus/edoplus_aboutus.png') }}" class="img-responsive"
                    width="100%">
            </div>
        </div>
    </div>
    <div style="background-color: #3b3b3b; padding: 50px;">
        <div class="container">
            <h1 style="font-size: 2rem; color:#ffffff;"><strong>เครือเอโดะกรุ๊ป</strong></h1>
            <div class="row mt-3">
                @foreach ($account_stores as $account_store => $value)
                    <div class="col-lg-2 col-md-2 col-6">
                        <img src="{{ url('images/store-logo') }}/{{ $value->image }}" class="mt-3 img-responsive"
                            width="100%">
                    </div>
                @endforeach
            </div>
            @if ($partners->count() > 0)
                <h1 style="font-size: 2rem; color:#000000;" class="mt-5"><strong>เครือข่ายพันธมิตร</strong></h1>
                <div class="row mt-3">
                    @foreach ($partners as $partner => $value)
                        <div class="col-lg-2 col-md-2 col-6">
                            <img src="{{ url('images/partner_shop') }}/{{ $value->image }}" class="mt-3 img-responsive"
                                width="100%">
                        </div>
                    @endforeach
                </div>
            @endif
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
                        <strong>อีเมล : edoplus.official@gmail.com</strong>
                </div>
            </div>
        </div>
    </div>
@endsection
