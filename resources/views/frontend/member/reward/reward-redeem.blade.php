@extends('frontend/layouts/template')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<style>
    .article-detail p {
        color: #ffffff;
        font-size: 1.5rem;
    }
</style>
@section('content')
    @php
        $redeem_reward_point = 0;
        $sumpoint = 0;
        $redeem_point_sum = 0;
        $balance_point = 0;
    @endphp

    {{-- point ที่ได้รับ --}}
    @foreach ($points as $point => $value)
        @php
            $price = floor($value->price / 100);
            $sumpoint += $price;
        @endphp
    @endforeach

    {{-- หักคะแนนจากการแลกของรางวัล --}}
    @foreach ($redeem_rewards as $redeem_reward => $value)
        @php
            $redeem_reward_point += $value->point;
        @endphp
    @endforeach

    {{-- หักคะแนนแลกสิทธิ์ร้านค้าพันธมิตร --}}
    @foreach ($redeem_points as $redeem_point => $value)
        @php
            $redeem_point_sum += $value->point;
        @endphp
    @endforeach

    {{-- point คงเหลือ --}}
    @php
        $balance_point = $sumpoint - $redeem_reward_point - $redeem_point_sum;
    @endphp

    <div class="container">
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4 col-12" style="text-align: right;">
                <h4 style="color: #F28123;" class="large-6 column">
                    คะแนนสะสม
                </h4>
                <h4 style="color: #ffffff;" class="large-6 column">
                    {{ number_format($balance_point) }} points
                </h4>
            </div>
        </div><br>
    </div>
    @php
        $reward_point = DB::table('reward_points')
            ->where('reward_id', $reward->id)
            ->orderBy('id', 'desc')
            ->value('point');
    @endphp
    <!-- single article section -->
    <div class="mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mt-5">
                    <div class="single-article-section">
                        <img src="{{ url('images/reward') }}/{{ $reward->image }}" class="img-responsive" width="100%">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single-article-section">
                        <h1 class="mt-5" style="font-size: 3.5rem; color: #F28123;">
                            <strong>{{ $reward->name }}</strong>
                        </h1>
                        <div class="article-detail">{!! $reward->detail !!}</div>
                        <h3 class="mt-3 mb-3">ใช้พอยท์ <i class="fa fa-caret-right" style="color:#777777;"></i>
                            <span style="color: red;"><strong>{{ $reward_point }}</strong></span> พอยท์
                        </h3>
                        <h5 class="mt-5">เงื่อนไขการแลกคะแนนสะสม</h5>
                        <ui>
                            <li>กรุณาบันทึกภาพหน้าจอการแลกของรางวัลไว้เป็นหลักฐาน</li>
                            <li>เมื่อทำรายการแล้วไม่สามารถเปลี่ยนแปลง ยกเลิก คืน หรือ ทอน เป็นคะแนนหรือเงินสดได้</li>
                            <li>บริษัทฯ ถือตามข้อมูลที่ปรากฏในระบบของบริษัทฯ เป็นสำคัญ</li>
                            <li>เงื่อนไขเป็นไปตามที่บริษัทฯ กำหนด ขอสงวนสิทธิ์ในการเปลี่ยนแปลง แก้ไข
                                โดยไม่ต้องแจ้งให้ทราบล่วงหน้า</li>
                        </ui>
                    </div>
                    <button data-toggle="modal" data-target="#myModal" class="btn btn-block btn-success mt-3"
                        style="color: #ffffff;">กดแลกคะแนนสะสม</button>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ url('/member/reward-success') }}" enctype="multipart/form-data" method="post">@csrf
        @if ($balance_point > $reward_point || $balance_point == $reward_point)
            <div class="modal fade mobile" id="myModal" role="dialog">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="md-12">
                                <center>
                                    <h3 style="color:#092895 !important; font-weight:normal;">{{ $reward->name }}
                                    </h3>
                                </center>
                                <center>
                                    <h3 style="color:#d85700 !important; font-weight:normal;" class="mt-3">ใช้คะแนนสะสม
                                        {{ $reward_point }} คะแนน</u></h3>
                                </center>
                                <div class="photo">
                                    <center><img src="{{ url('/images/reward') }}/{{ $reward->image }}"
                                            class="img-responsive mt-5 mb-5" width="80%" style="border-radius: 10px;"></center>
                                </div>
                                <center>
                                    <div class="description">
                                        <h4 style="color:#092895 !important; font-weight:normal;">คะแนนสะสม :
                                            {{ number_format($balance_point) }} points</h4>
                                        <?php
                                        $reward_point = $reward_point;
                                        $balancePoint = $balance_point - $reward_point;
                                        ?>
                                        <h4 style="color:#092895 !important; font-weight:normal;">คะแนนคงเหลือ :
                                            {{ number_format($balancePoint) }} points</h4>
                                    </div>
                                </center>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button style="font-family: 'Noto Sans Thai' !important;" type="button" class="btn btn-danger"
                                data-dismiss="modal">ยกเลิก</button>
                            <input type="hidden" value="{{ $reward->id }}" name="id">
                            <button style="font-family: 'Noto Sans Thai' !important;" type="submit"
                                class="btn btn-success">แลกพอยท์</button>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="modal fade mobile" id="myModal" role="dialog">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h3 style="text-align: center; color:#F28123;" class="mt-5 mb-5">คะแนนสะสมไม่เพียงพอ</h3>
                        </div>
                        <div class="modal-footer">
                            <button style="font-family: 'Noto Sans Thai' !important;" type="button" class="btn btn-danger"
                                data-dismiss="modal">ยกเลิก</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
@endsection
