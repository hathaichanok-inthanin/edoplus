@extends('frontend/layouts/template')
<link href="{{ asset('frontend_main/assets/css/table-lavel.css') }}" rel="stylesheet">
@section('content')
    @php
        $benefits = DB::table('benefits')->where('status', 'ใช้งานได้')->get();
    @endphp
    <div class="container" style="padding-bottom: 50px;">
        <h1 class="header-title text-center" style="padding-top:5rem; font-size: 2rem;">
            <strong>สิทธิประโยชน์สมาชิก EDO PLUS</strong>
        </h1>
        <h2 class="text-center" style="font-size: 1.5rem;">EDO PLUS – Your Everyday Lifestyle</h2>
        <div class="row mt-5">
            <div class="col-md-12">
                <h2 class="text-center" style="line-height: 1.6em; font-size: 1.2em; color: #dddddd;">
                    ทุกวันของคุณ คือ โอกาสในการเข้าถึงสิทธิพิเศษเหนือระดับกับ EDO PLUS — ประสบการณ์ที่เราตั้งใจมอบให้คุณ
                    ไม่ว่าจะเป็นมื้ออาหารสุดพิเศษในร้านโปรด สิทธิประโยชน์ที่ครอบคลุมทุกไลฟ์สไตล์
                    หรือของรางวัลที่ออกแบบมาเพื่อคุณโดยเฉพาะ เพราะเรารู้ดีว่า...ความพิเศษไม่ควรเป็นเรื่องธรรมดา
                </h2>
                <h2 class="text-center mt-3" style="line-height: 1.6em; font-size: 1.2em; color: #dddddd;">
                    ทุกการใช้จ่ายในเครือเอโดะกรุ๊ปสามารถสะสมแต้ม
                    เพื่อแลกรับสิทธิประโยชน์จากพันธมิตรในเครือได้อย่างคุ้มค่า พร้อมเข้าถึงดีลพิเศษ โปรโมชั่น
                    และสิทธิ์เฉพาะสมาชิกได้อย่างง่ายดาย — ในแบบที่คุณเลือกได้เองทุกวัน
                </h2>
            </div>
        </div>
    </div>

    <div style="background-color: #ffffff; padding: 50px 0 50px 0;">
        <div class="container">
            <h2 style="font-size: 1.6rem; margin-bottom: 20px; text-align: center; color: #000000;">
                <strong>ตารางเปรียบเทียบสิทธิประโยชน์สมาชิก</strong>
            </h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>สิทธิประโยชน์สมาชิก</th>
                            <th>
                                <div class="level-silver">สมาชิกระดับ Silver</div>
                            </th>
                            <th>
                                <div class="level-gold">สมาชิกระดับ Gold</div>
                            </th>
                            <th>
                                <div class="level-black">สมาชิกระดับ Black</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ยอดคะแนนสะสม</td>
                            <td>0 - 2,000 คะแนน</td>
                            <td>2,001 - 10,000 คะแนน</td>
                            <td>10,001 คะแนนขึ้นไป</td>
                        </tr>
                        <tr>
                            <td>รับส่วนลด 5% ที่ร้านอาหารในเครือเอโดะกรุ๊ป</td>
                            <td class="silver plus-icon">+</td>
                            <td class="gold">-</td>
                            <td class="black">-</td>
                        </tr>
                        <tr>
                            <td>รับส่วนลด 10% ที่ร้านอาหารในเครือเอโดะกรุ๊ป</td>
                            <td class="gray">-</td>
                            <td class="gold plus-icon">+</td>
                            <td class="black">-</td>
                        </tr>
                        <tr>
                            <td>รับส่วนลด 15% ที่ร้านอาหารในเครือเอโดะกรุ๊ป</td>
                            <td class="gray">-</td>
                            <td class="gold">-</td>
                            <td class="black plus-icon">+</td>
                        </tr>
                        <tr>
                            <td>Complimentary ประจำฤดูกาล ที่ร้านอาหารในเครือเอโดะกรุ๊ป</td>
                            <td class="gray">-</td>
                            <td class="gold plus-icon">+</td>
                            <td class="black plus-icon">+</td>
                        </tr>
                        <tr>
                            <td>สิทธิ์ในการเข้าร่วมกิจกรรมพิเศษกับ edoplus+</td>
                            <td class="gray">-</td>
                            <td class="gold">-</td>
                            <td class="black plus-icon">+</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <section id="services-2" class="services-2 section dark-background" style="margin-bottom: 15rem;">
        <div class="container section-title text-center" data-aos="fade-up">
            <p><strong>สิทธิประโยชน์สมาชิก</strong></p>
        </div>
        <div class="services-carousel-wrap">
            <div class="container">
                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
              {
                "loop": true,
                "speed": 600,
                "autoplay": {
                  "delay": 5000
                },
                "slidesPerView": "auto",
                "pagination": {
                  "el": ".swiper-pagination",
                  "type": "bullets",
                  "clickable": true
                },
                "navigation": {
                  "nextEl": ".js-custom-next",
                  "prevEl": ".js-custom-prev"
                },
                "breakpoints": {
                  "320": {
                    "slidesPerView": 1,
                    "spaceBetween": 40
                  },
                  "1200": {
                    "slidesPerView": 3,
                    "spaceBetween": 40
                  }
                }
              }
            </script>
                    <button class="navigation-prev js-custom-prev">
                        <i class="bi bi-arrow-left-short"></i>
                    </button>
                    <button class="navigation-next js-custom-next">
                        <i class="bi bi-arrow-right-short"></i>
                    </button>
                    <div class="swiper-wrapper">
                        @foreach ($benefits as $benefit => $value)
                            <div class="swiper-slide">
                                <a href="{{ url('/benefit-detail') }}/{{ $value->id }}">
                                    <div class="service-item">
                                        <img src="{{ url('/images/benefit') }}/{{ $value->image }}" alt="Image"
                                            class="img-fluid">
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>

    <div style="background-color: #3b3b3b; padding: 50px;">
        <div class="container">
            <h1 style="font-size: 2rem; color: #fff;"><strong>เครือเอโดะกรุ๊ป</strong></h1>
            <div class="row mt-3">
                @foreach ($account_stores as $account_store => $value)
                    <div class="col-lg-2 col-md-2 col-6">
                        <img src="{{ url('images/store-logo') }}/{{ $value->image }}" class="mt-3 img-responsive"
                            width="100%">
                    </div>
                @endforeach
            </div>

            @if ($partners->count() > 0)
                <h1 style="font-size: 2rem; color: #fff;" class="mt-5"><strong>เครือข่ายพันธมิตร</strong></h1>
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
@endsection
