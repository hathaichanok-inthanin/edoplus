@extends('frontend/layouts/template')
<link href="{{ asset('frontend_main/assets/css/table-lavel.css') }}" rel="stylesheet">
@section('content')
    @php
        $image_slides = DB::table('slide_image_mains')->where('status', 'เปิด')->get();
        $benefits = DB::table('benefits')->where('status', 'ใช้งานได้')->get();
    @endphp
    <section id="hero" class="hero section dark-background">
        <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
            @foreach ($image_slides as $image_slide => $value)
                <div class="carousel-item {{ $image_slide == 0 ? 'active' : '' }}">
                    <img class="image-wrapper" src="{{ url('/images/slide_main') }}/{{ $value->image }}">
                </div>
            @endforeach
            <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>
            <ol class="carousel-indicators"></ol>
        </div>
    </section>

    <section id="services" class="services section">
        <div class="container section-title" data-aos="fade-up">
            <p>Edo Plus - With You in Every Lifestyle</p>

            <div class="row mt-5">
                <div class="col-md-4">
                    <img src="{{ asset('frontend_main/assets/img/privilege/collect-point.png') }}" class="img-fluid"
                        width="50%">
                    <h1 style="font-size: 1.5rem; color:#fcbc38;"><strong>สะสมคะแนน</strong></h1>
                    <h5>
                        สะสมคะแนนง่าย ๆ ทุกครั้งที่ใช้จ่ายในเครือเอโดะกรุ๊ป
                        เพียงแจ้งหมายเลขโทรศัพท์ ก็สามารถสะสมแต้มเพื่อนำไปแลกรับสิทธิพิเศษ ส่วนลด
                        หรือของรางวัลได้ทันที
                    </h5>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('frontend_main/assets/img/privilege/redeem-reward.png') }}" class="img-fluid"
                        width="50%">
                    <h1 style="font-size: 1.5rem;"><strong>แลกคะแนน</strong></h1>
                    <h5>ใช้คะแนนสะสมเพื่อแลกรับคูปองแทนเงินสด
                        หรือส่วนลดสำหรับซื้อสินค้าและบริการจากร้านค้าในเครือเอโดะกรุ๊ป และของรางวัลที่ร่วมรายการ
                    </h5>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('frontend_main/assets/img/privilege/privilege.png') }}" class="img-fluid"
                        width="50%">
                    <h1 style="font-size: 1.5rem;"><strong>สิทธิประโยชน์</strong></h1>
                    <h5>มอบสิทธิประโยชน์มากมายที่ออกแบบมาเพื่อตอบโจทย์ทุกไลฟ์สไตล์ของคุณ
                        เพียงสมัครเป็นสมาชิก ก็สามารถเข้าถึงข้อเสนอสุดพิเศษที่คัดสรรมาเฉพาะคุณเท่านั้น</h5>
                </div>
            </div>
        </div>
    </section>

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
    <div style="background-color: #000000; padding-top: 50px;">
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
