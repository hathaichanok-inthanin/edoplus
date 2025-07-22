@extends('frontend/layouts/template')
<link type="text/css" href="{{ asset('frontend/assets/css/carousel-slide.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@section('content')
    @php
        $image_slides = DB::table('slide_image_mains')->where('status', 'เปิด')->get();
    @endphp
    <section class="hero-slider hero-style">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach ($image_slides as $image_slide => $value)
                    <div class="swiper-slide">
                        <div class="slide-inner slide-bg-image"
                            data-background="{{ url('/images/slide_main') }}/{{ $value->image }}" style="width:100%">
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- swipper controls -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next-js"></div>
            <div class="swiper-button-prev-js"></div>
        </div>
    </section>
    

    {{-- <div style="background-color:#f0b6b5;">
        <div class="container" style="padding-top:5rem; padding-bottom:5rem;">
            <div class="header-title">
                <h2 style="color: #2e5b55;">
                    <strong>สมัครสมาชิกง่ายๆ ไม่กี่ขั้นตอน</strong>
                </h2>
                <h4>สมัครสมาชิกเป็นครอบครัวเอโดะพลัสง่ายๆ</h4>
                <div class="row" style="text-align: center;">
                    <div class="col-md-3 col-6">
                        <img src="{{ url('images/register/register_1.jpg') }}" style="border-radius: 10px;">
                        <h5 class="mt-3 mb-3">1. แอดไลน์ @touchjai</h5>
                    </div>
                    <div class="col-md-3 col-6">
                        <img src="{{ url('images/register/register_2.jpg') }}" style="border-radius: 10px;">
                        <h5 class="mt-3 mb-3">2. กดปุ่ม Member Club</h5>
                    </div>
                    <div class="col-md-3 col-6">
                        <img src="{{ url('images/register/register_3.jpg') }}" style="border-radius: 10px;">
                        <h5 class="mt-3 mb-3">3. เลือกช่องทางในการสมัครสมาชิก</h5>
                    </div>
                    <div class="col-md-3 col-6">
                        <img src="{{ url('images/register/register_4.jpg') }}" style="border-radius: 10px;">
                        <h5 class="mt-3 mb-3">4. กรอกรายละเอียดข้อมูลส่วนตัว</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="padding-top:5rem; padding-bottom:5rem;">
        <div class="header-title">
            <h2 style="color: #f0b6b5;">
                <strong>เครือข่ายพันธมิตร</strong>
            </h2>
            <h4>รับส่วนลดพิเศษในเครือข่ายพันธมิตร</h4>
        </div>
        <div class="row mt-5">
            @foreach ($partners as $partner => $value)
                <div class="col-lg-2 col-md-2 col-6">
                    <img src="{{ url('images/partner_shop') }}/{{ $value->image }}" class="mt-3">
                </div>
            @endforeach
        </div>
    </div>
    <div style="background-color:#f0b6b5;">
        <div class="container" style="padding-bottom: 5rem;">
            <div class="header-title">
                <h2 style="padding-top: 5rem; color: #2e5b55;">
                    <strong>บทความ ข่าวสาร</strong>
                </h2>
                <div style="display: flex; justify-content: space-between;">
                    <h4>ติดตามบทความ และข่าวสาร</h4>
                    <a href="{{ url('allarticle') }}">
                        <p style="color: #2e5b55;">ดูเพิ่มเติม <i class="fa fa-chevron-right" aria-hidden="true"></i></p>
                    </a>
                </div>
            </div>
            <br>
            <div class="latest-news">
                <div class="row">
                    @foreach ($articles as $article => $value)
                        <div class="col-lg-4 col-md-6">
                            <div class="single-latest-news" style="background-color: #ffffff;">
                                <a href="{{ url('article') }}/{{ $value->id }}/{{ $value->title }}">
                                    <img src="{{ url('images/article') }}/{{ $value->image }}"
                                        class="latest-news-bg img-responsive" width="100%">
                                </a>
                                <div class="news-text-box">
                                    <p class="blog-meta">
                                        <span>บทความ{{ $value->type }}</span>
                                    </p>
                                    <h1><a
                                            href="{{ url('article') }}/{{ $value->id }}/{{ $value->title }}">{{ $value->title }}</a>
                                    </h1>
                                    <div class="excerpt">{!! $value->article !!}</div><br>
                                    <div style="text-align: right;">
                                        <a href="{{ url('article') }}/{{ $value->id }}/{{ $value->title }}">read
                                            more <i class="fa fa-caret-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('frontend/assets/js/carousel-slide.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endsection
