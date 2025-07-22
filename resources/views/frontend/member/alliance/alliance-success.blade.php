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
<style>
    .promotion-detail {
        color: #888888 !important;
    }
</style>
@section('content')
    @php
        $partner_point = DB::table('partner_shop_points')
            ->where('id', $point_id)
            ->orderBy('id', 'desc')
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
    @php
        $partner_name = DB::table('partner_shops')
            ->where('id', $partner_promotion->partner_id)
            ->value('name');
        $partner_branch = DB::table('partner_shops')
            ->where('id', $partner_promotion->partner_id)
            ->value('branch');
    @endphp
    <div class="container" style="margin-bottom: 50px;">
        <!-- single article section -->
        <div class="row">
            <div class="col-lg-6 mt-5">
                <div class="single-article-section">
                    <div class="single-article-text">
                        <img src="{{ url('images/partner') }}/{{ $partner_promotion->image }}" class="img-responsive"
                            width="100%">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="single-article-section">
                    <div class="single-article-text">
                        <h1 class="article-title">{{ $partner_name }} @if ($partner_branch != null)
                                สาขา{{ $partner_branch }}
                            @endif
                        </h1>
                        <div class="article-detail">{!! $partner_promotion->promotion !!}</div>
                        <h5 class="mt-5">เงื่อนไขการใช้สิทธิพิเศษ</h5>
                        <ui>
                            <li>ไม่สามารถใช้ร่วมกับโปรโมชั่นส่งเสริมการขายอื่นได้</li>
                            <li>บริษัทฯ ถือตามข้อมูลที่ปรากฏในระบบของบริษัทฯ เป็นสำคัญ</li>
                            <li>เงื่อนไขเป็นไปตามที่บริษัทฯ กำหนด ขอสงวนสิทธิ์ในการเปลี่ยนแปลง แก้ไข
                                โดยไม่ต้องแจ้งให้ทราบล่วงหน้า</li>
                        </ui>
                    </div>
                </div>
                {{-- <a href="{{ url('member/alliance-redeem/') }}/{{ $partner_promotion->id }}"
                    class="btn btn-block btn-success mt-3" style="color: #ffffff;">กดใช้สิทธิพิเศษ</a> --}}
                <button data-toggle="modal" data-target="#myModal" class="btn btn-block btn-success mt-3"
                    style="color: #ffffff;">กดใช้สิทธิพิเศษ</button>
            </div>
        </div>
        <!-- end single article section -->
    </div>
    <div class="bs-example">
        <div id="myModal" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="color: #F28123;" class="modal-title">{{ $partner_promotion->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        {{-- <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
                            <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);">
                            </div>
                            <span class="swal2-success-line-tip"></span>
                            <span class="swal2-success-line-long"></span>
                            <div class="swal2-success-ring"></div>
                            <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                            <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);">
                            </div>
                        </div>
                        <h5 style="text-align: center; color:#F28123;">กดรับสิทธิพิเศษสำเร็จ</h5> --}}
                        <div class="single-article-section">
                            <div class="single-article-text">
                                <h1 class="article-title" style="text-align: center;">{{ $partner_name }} @if ($partner_branch != null)
                                        สาขา{{ $partner_branch }}
                                    @endif
                                </h1>
                            </div>
                        </div>
                        <div class="single-article-section">
                            <div class="single-article-text">
                                <center><img src="{{ url('images/partner') }}/{{ $partner_promotion->image }}"
                                    class="img-responsive" width="50%" style="border-radius: 10px;"></center>
                            </div>
                        </div>
                        <div class="single-article-section" style="color: #888888;">
                            <div class="single-article-text">
                                <div class="promotion-detail mt-3">{!! $partner_promotion->promotion !!}</div><hr>
                                <h5 class="mt-3" style="color: #525252;">เงื่อนไขการใช้สิทธิพิเศษ</h5>
                                <ui>
                                    <li>ไม่สามารถใช้ร่วมกับโปรโมชั่นส่งเสริมการขายอื่นได้</li>
                                    <li>บริษัทฯ ถือตามข้อมูลที่ปรากฏในระบบของบริษัทฯ เป็นสำคัญ</li>
                                    <li>เงื่อนไขเป็นไปตามที่บริษัทฯ กำหนด ขอสงวนสิทธิ์ในการเปลี่ยนแปลง แก้ไข
                                        โดยไม่ต้องแจ้งให้ทราบล่วงหน้า</li>
                                </ui>
                            </div>
                        </div>
                        <!-- end single article section -->
                        <p style="text-align: center; color:red;">*
                            กรุณาแสดงภาพบันทึกหน้าจอต่อพนักงานหน้าร้านที่ท่านใช้บริการ</p>
                    </div>
                    <form action="{{ url('/') }}">
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
