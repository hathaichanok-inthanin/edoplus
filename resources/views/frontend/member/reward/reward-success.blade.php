@extends('frontend/layouts/template')
<link type="text/css" href="{{ asset('frontend_main/assets/css/reward-success.css') }}" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script>
    $(document).ready(function() {
        $("#myModal").modal('show');
    });
</script>

@section('content')
    @php
        $reward_point = DB::table('reward_points')
            ->where('id', $reward_point_id)
            ->value('point');
    @endphp

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
    <div class="bs-example">
        <div id="myModal" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="color: #F28123;" class="modal-title">{{ $reward->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
                            <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);">
                            </div>
                            <span class="swal2-success-line-tip"></span>
                            <span class="swal2-success-line-long"></span>
                            <div class="swal2-success-ring"></div>
                            <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                            <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);">
                            </div>
                        </div>
                        <h5 style="text-align: center; color:#F28123;">แลกพอยท์สำเร็จ</h5>
                        <h5 style="text-align: center; color:black;">คะแนนสะสมคงเหลือ : <strong>{{ number_format($balance_point) }}</strong> points</h5>
                        <p style="text-align: center; color:red;">* กรุณารอการติดต่อกลับจากทางทีมงาน ภายใน 15 วันทำการ</p>
                    </div>
                    <form action="{{ url('/member/redeem-point') }}">
                        <div class="modal-footer">
                            <input style="font-family: 'Noto Sans Thai' !important;" data-target="#myModal" data-toggle="modal"
                                data-backdrop="static" data-keyboard="false" type="submit" class="btn btn-success btn-sm"
                                value="ปิด">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        })
    </script>
@endsection
