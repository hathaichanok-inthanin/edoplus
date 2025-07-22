@extends('frontend/layouts/template')

@section('content')
    <div class="container" style="margin-bottom: 50px;">
        <center>
            <div class="header-title">
                <h2 style="margin-top:15rem;">
                    <strong>Travel</strong>
                </h2>
            </div>
        </center>
        <br>
        <div class="latest-news mt-80 mb-150">
            <div class="row">
                @foreach ($partners as $partner => $value)
                    @php
                        $name = DB::table('partner_shops')
                            ->where('id', $value->partner_id)
                            ->value('name');
                        $branch = DB::table('partner_shops')
                            ->where('id', $value->partner_id)
                            ->value('branch');
                        $partner_point = DB::table('partner_shop_points')
                            ->where('partner_id', $value->id)
                            ->value('point');
                    @endphp
                    <div class="col-lg-4 col-md-6">
                        <div class="single-latest-news" style="background-color: #ffffff;">
                            <a href="{{ url('alliance') }}/{{ $value->id }}/{{ $name }}">
                                <img src="{{ url('images/partner') }}/{{ $value->image }}"
                                    class="latest-news-bg img-responsive" width="100%">
                            </a>
                            <div class="news-text-box">
                                <h1><a href="{{ url('alliance') }}/{{ $value->id }}/{{ $value->name }}">{{ $name }}
                                        @if ($branch != null)
                                            สาขา{{ $branch }}
                                        @endif
                                    </a>
                                </h1>
                                <div>{!! $value->promotion !!}</div><br>
                                <div style="border-bottom: 2px dashed #cac8c8;"></div>
                                <div class="flex space-between">
                                    <p>ใช้พอยท์ <i class="fa fa-caret-right" style="color:#777777;"></i>
                                        <span
                                            style="color: red; font-size:25px;"><strong>{{ $partner_point }}</strong></span>
                                        พอยท์
                                    </p>
                                    <div style="text-align: right;" class="mt-3">
                                        <a href="{{ url('alliance') }}/{{ $value->id }}/{{ $name }}">รายละเอียดเพิ่มเติม
                                            <i class="fa fa-caret-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
