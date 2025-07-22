@extends('frontend/layouts/template')
<style>
    .privilege .coupon h5 {
        color: #777777;
    }

    .privilege .coupon i {
        color: #777777;
        font-size: 16px;
    }

    .article-card {
        height: 300px;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        font-family: "Noto Sans Thai", "Open Sans", sans-serif;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        transition: all 300ms;
    }

    .article-card::before {
        content: "";
        display: block;
        width: 30px;
        height: 30px;
        background-color: #000000;
        position: absolute;
        top: 130px;
        right: -15px;
        z-index: 1;
        border-radius: 50%;
    }

    .article-card::after {
        content: "";
        display: block;
        width: 30px;
        height: 30px;
        background-color: #000000;
        position: absolute;
        top: 130px;
        left: -15px;
        z-index: 1;
        border-radius: 50%;
    }

    .article-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
    }

    .article-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .article-card .content {
        box-sizing: border-box;
        width: 100%;
        position: absolute;
        padding: 30px 20px 20px 20px;
        height: auto;
        bottom: 0;
        background: linear-gradient(transparent, rgba(255, 255, 255, 0.6));
    }

    .article-card .title {
        font-size: 22px;
        color: #ffffff;
        font-weight: bolder;
    }

    .article-card p {
        font-size: 15px;
        color: #ff0000;
        font-weight: bold;
    }

    .article-card a {
        font-size: 16px;
        color: #000000;
        font-family: "Noto Sans Thai", "Open Sans", sans-serif;
    }

    .article-card a:hover {
        font-size: 16px;
        color: #000000;
        font-family: "Noto Sans Thai", "Open Sans", sans-serif;
    }
</style>
@section('content')
    <div class="container" style="margin-bottom: 50px;">
        <div class="header-title">
            <h2 style="padding-top: 5rem;">
                <strong>E-COUPON</strong>
            </h2>
            <div style="display: flex; justify-content: space-between;">
                <h4>E-Coupon ส่วนลดพิเศษเฉพาะคุณเท่านั้น</h4>
            </div>
        </div>
        <div class="latest-news mb-100" style="margin-top: 20px;">
            <div class="row">
                @foreach ($coupons as $coupon => $value)
                    @php
                        $partner = DB::table('partner_shops')
                            ->where('id', $value->partner_id)
                            ->value('name');
                        $branch = DB::table('partner_shops')
                            ->where('id', $value->partner_id)
                            ->value('branch');
                        $dateNow = Carbon\Carbon::now()->format('Y-m-d');
                        $monthNow = Carbon\Carbon::now()->format('m');

                        if (Auth::guard('member')->user() != null) {
                            // เดือนเกิด
                            $bday = Auth::guard('member')->user()->bday;
                            $bday_format = date_create_from_format('d/m/Y', $bday);
                            $bday_format = $bday_format->format('m');
                        }
                    @endphp

                    @if ($value->expire_date > $dateNow && Auth::guard('member')->user() == null && $value->campaign_type != 'วันเกิด')
                        <div class="col-md-4">
                            <div class="article-card mt-3">
                                <div class="content">
                                    <a href="{{ url('privilege') }}/{{ $value->id }}/{{ $value->name }}">
                                        <p class="title">{{ $value->name }}</p>
                                    </a>
                                    <p>ใช้คูปองได้ที่ <i class="fa fa-caret-down"></i>
                                        <br>{{ $partner }} สาขา{{ $branch }}
                                    </p>
                                    <div style="border-bottom: 1px dashed #cac8c8; margin-bottom:5px;"></div>
                                    <a href="{{ url('privilege') }}/{{ $value->id }}/{{ $value->name }}">รายละเอียดเพิ่มเติม
                                        <i class="fa fa-caret-right"></i></a>
                                </div>
                                <a href="{{ url('privilege') }}/{{ $value->id }}/{{ $value->name }}">
                                    <img src="{{ url('images/campaign') }}/{{ $value->image }}" alt="article-cover" /></a>

                            </div>
                        </div>
                    @endif

                    @auth('member')
                        @if ($value->expire_date > $dateNow)
                            @if ($value->campaign_type == 'วันเกิด')
                                @if ($monthNow == $bday_format)
                                    <div class="col-md-4">
                                        <div class="article-card mt-3">
                                            <div class="content">
                                                <a href="{{ url('privilege') }}/{{ $value->id }}/{{ $value->name }}">
                                                    <p class="title">{{ $value->name }}</p>
                                                </a>
                                                <p>ใช้คูปองได้ที่ <i class="fa fa-caret-down"></i>
                                                    <br>{{ $partner }} สาขา{{ $branch }}
                                                </p>
                                                <div style="border-bottom: 1px dashed #cac8c8; margin-bottom:5px;"></div>
                                                <a href="{{ url('privilege') }}/{{ $value->id }}/{{ $value->name }}">รายละเอียดเพิ่มเติม
                                                    <i class="fa fa-caret-right"></i></a>
                                            </div>
                                            <a href="{{ url('privilege') }}/{{ $value->id }}/{{ $value->name }}">
                                                <img src="{{ url('images/campaign') }}/{{ $value->image }}"
                                                    alt="article-cover" /></a>

                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="col-md-4">
                                    <div class="article-card mt-3">
                                        <div class="content">
                                            <a href="{{ url('privilege') }}/{{ $value->id }}/{{ $value->name }}">
                                                <p class="title">{{ $value->name }}</p>
                                            </a>
                                            <p>ใช้คูปองได้ที่ <i class="fa fa-caret-down"></i>
                                                <br>{{ $partner }} สาขา{{ $branch }}
                                            </p>
                                            <div style="border-bottom: 1px dashed #cac8c8; margin-bottom:5px;"></div>
                                            <a href="{{ url('privilege') }}/{{ $value->id }}/{{ $value->name }}">รายละเอียดเพิ่มเติม
                                                <i class="fa fa-caret-right"></i></a>
                                        </div>
                                        <a href="{{ url('privilege') }}/{{ $value->id }}/{{ $value->name }}">
                                            <img src="{{ url('images/campaign') }}/{{ $value->image }}"
                                                alt="article-cover" /></a>

                                    </div>
                                </div>
                            @endif
                        @endif
                    @endauth
                @endforeach
            </div>
        </div>
    </div>
    <div class="container mb-5">
        <center>
            <div class="header-title">
                <h2 style="margin-top: 5rem;">
                    <strong>สิทธิประโยชน์สมาชิกเอโดะพลัส</strong>
                </h2>
            </div>
        </center>
        <br>
        <div class="row mt-5">
            <div class="col-lg-3 col-md-3 col-6 mt-5">
                <div class="privilege text-center">
                    <i class="fas fa-parking"></i>
                    <h4>สะสมคะแนน</h4>
                    <p>
                        คะแนนสะสมไม่มีวันหมดอายุ
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-6 mt-5">
                <div class="privilege text-center">
                    <i class="fas fa-ticket"></i>
                    <h4>ส่วนลดพิเศษ</h4>
                    <p>
                        รับส่วนลดพิเศษในเครือข่ายพันธมิตร
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-6 mt-5">
                <div class="privilege text-center">
                    <i class="fas fa-ticket"></i>
                    <h4>E-COUPON</h4>
                    <p>
                        ส่วนลดพิเศษเฉพาะคุณเท่านั้น
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-6 mt-5">
                <div class="privilege text-center">
                    <i class="fas fa-gift"></i>
                    <h4>แลกของรางวัล</h4>
                    <p>
                        แลกรับของรางวัลพรีเมี่ยม
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
