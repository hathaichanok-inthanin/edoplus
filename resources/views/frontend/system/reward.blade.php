@extends('frontend/layouts/template')

@section('content')
    <div class="container" style="margin-bottom: 50px;">
        <h2 style="padding-top:5rem; font-size: 2.5rem; text-align:center;">
            <strong>ของรางวัลพรีเมียม</strong>
        </h2>
        <br>
        @if (count($rewards) != 0)
            <div class="reward mt-5">
                <div class="row">
                    @foreach ($rewards as $reward => $value)
                        @php
                            $reward_point = DB::table('reward_points')->where('reward_id', $value->id)->value('point');
                        @endphp
                        <div class="col-md-4">
                            <div class="card" style="border: 0;">
                                <div class="card-body" style="padding: 0;">
                                    <img src="{{ url('images/reward') }}/{{ $value->image }}" class="img-responsive"
                                        width="100%">
                                    <div class="news-text-box" style="padding: 15px;">
                                        <h1><a href="{{ url('reward-detail') }}/{{ $value->id }}">{{ $value->name }}</a>
                                        </h1>
                                        <p class="excerpt">{!! $value->detail !!}</p>
                                        <div style="border-bottom: 2px dashed #cac8c8;"></div>

                                        <div class="flex space-between">
                                            <p>ใช้พอยท์ <i class="fa fa-caret-right" style="color:#777777;"></i>
                                                <span
                                                    style="color: red; font-size:25px;"><strong>{{ $reward_point }}</strong></span>
                                                พอยท์
                                            </p>
                                            <div style="text-align: right;" class="mt-3">
                                                <a href="{{ url('reward-detail') }}/{{ $value->id }}">รายละเอียดเพิ่มเติม
                                                    <i class="fa fa-caret-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <h1 style="font-size: 3rem; text-align: center;">Coming Soon</h1>
        @endif
    </div>
@endsection
