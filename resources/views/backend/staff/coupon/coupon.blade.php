@extends('backend/layouts/staff/template')
<style>
    .coupon h4 {
        color: #616161e1;
    }

    .coupon h3 {
        color: #a7a7a7e1;
    }

    .coupon p {
        font-size: 14px;
    }

    .coupon span {
        font-size: 14px;
        color: red;
        font-weight: bold;
    }

    .header h4 {
        color: #fff;
        border-bottom: 2px solid #eeeeee;
        padding-bottom: 15px;
    }
</style>
@section('content')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-5 mb-lg-0 mb-4">
                <a href="javascript:history.back();" style="color:#fff;"><i class="ni ni-bold-left"></i> ย้อนกลับ</a>
            </div>
        </div>
        <div class="header mt-4">
            <h4>ใช้คูปอง</h4>
        </div>
        <div class="coupon">
            <div class="row">
                <div class="col-lg-2 mt-4 mb-lg-0 mb-4"></div>
                <div class="col-lg-8 mt-4 mb-lg-0 mb-4">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if (Session::has('alert-' . $msg))
                                <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                                </p>
                            @endif
                        @endforeach
                    </div>
                    <div class="card z-index-2">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h6 class="text-capitalize">1. เลือกลูกค้า <span>* จำเป็น</span></h6>
                            <p>ค้นหาเบอร์โทรศัพท์</p>
                            <form action="{{ url('staff/search-member-coupon') }}">
                                <div class="row">
                                    <div class="col-md-9">
                                        <input class="phone_format form-control" type="text"
                                            placeholder="ค้นหาเบอร์โทรศัพท์" name="search">
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-outline-primary" type="submit"
                                            id="button-addon2">ค้นหาข้อมูล</button>
                                    </div>
                                </div>
                            </form>
                        </div><br>
                    </div>
                    @if ($search == 'No Search')
                    @elseif($search == '0')
                        <h3 class="mt-4" style="text-align:center;">- - ไม่พบข้อมูลสมาชิก - -</h3>
                    @else
                        @foreach ($members as $member => $value)
                            <center>
                                <a href="{{ url('staff/coupon') }}/{{ $value->id }}"
                                    class="mt-4 btn btn-outline-success btn-sm my-auto" style="color:#0c6640;">
                                    <i class="fa fa-search" aria-hidden="true"></i> ค้นหาคูปอง</a>
                            </center>
                            @php
                                $dateNow = Carbon\Carbon::now()->format('d/m/Y');

                                // point ที่ได้รับ
                                $sumprice = DB::table('points')
                                    ->where('member_id', $value->id)
                                    ->where('type', 'เพิ่มพอยท์')
                                    ->sum('price');
                                // ยอดเงินที่ปรับลด
                                $sumprice -= DB::table('points')
                                    ->where('member_id', $value->id)
                                    ->where('type', 'ปรับลดยอดเงิน')
                                    ->sum('price');
                                $culPrice = floor($sumprice / 100);

                                // หักคะแนนจากการแลกของรางวัล
                                $redeem_reward_point = DB::table('redeem_rewards')
                                    ->join('reward_points', 'reward_points.id', '=', 'redeem_rewards.point_id')
                                    ->where('member_id', $value->id)
                                    ->sum('reward_points.point');

                                // หักคะแนนแลกสิทธิ์ร้านค้าพันธมิตร
                                $redeem_point = DB::table('redeem_points')
                                    ->join(
                                        'partner_shop_points',
                                        'partner_shop_points.id',
                                        '=',
                                        'redeem_points.point_id',
                                    )
                                    ->where('member_id', $value->id)
                                    ->sum('partner_shop_points.point');

                                $point_balance = $culPrice - $redeem_reward_point - $redeem_point;
                            @endphp
                            <div class="card z-index-2 mt-4">
                                <div class="card-header pb-0 pt-3 bg-transparent">
                                    <div class="row mb-4 mt-4">
                                        <div class="col-md-4">
                                            <center><img src="{{ url('assets/image/profile.png') }}" width="70%;">
                                            </center>
                                        </div>
                                        @php
                                            $member_new = count(
                                                DB::table('members')
                                                    ->where('id', $value->id)
                                                    ->where('created_at', '>', now()->subDays(30)->endOfDay())
                                                    ->get(),
                                            );
                                        @endphp
                                        <div class="col-md-4" style="border-right: 2px dashed #9e9e9e;">

                                            @if ($value->status == 'ONLINE')
                                                <button class="btn btn-success btn-sm my-auto" style="color:#fff;">
                                                    {{ $value->status }}
                                                </button>
                                            @else
                                                <button class="btn btn-danger btn-sm my-auto" style="color:#fff;">
                                                    {{ $value->status }}
                                                </button>
                                            @endif
                                            @if ($member_new != 0)
                                                <button class="btn btn-warning btn-sm my-auto"
                                                    style="color:#fff;">ลูกค้าใหม่</button>
                                            @endif
                                            <h5 class="mt-2">หมายเลขสมาชิก <i class="fa fa-caret-down"
                                                    style="color:#777777;"></i><br>{{ $value->serialnumber }}</h5>
                                            <h4>คุณ{{ $value->name }} {{ $value->surname }}</h4>

                                            @if ($sumprice == 0 || $sumprice < 200001)
                                                <h5 class="mt-3">ระดับของสมาชิก <i class="fa fa-caret-down"
                                                        style="color:#777777;"></i><br>SILVER</h5><br>
                                            @elseif($sumprice == 200001 || $sumprice < 500001)
                                                <h5 class="mt-3">ระดับของสมาชิก <i class="fa fa-caret-down"
                                                        style="color:#777777;"></i><br>GOLD</h5><br>
                                            @elseif($sumprice > 500001)
                                                <h5 class="mt-3">ระดับของสมาชิก <i class="fa fa-caret-down"
                                                        style="color:#777777;"></i><br>BLACK</h5><br>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            <h4 class="mb-1">พอยท์คงเหลือ <i class="fa fa-caret-down"
                                                    style="color:#777777;"></i><br><span style="font-size:30;">
                                                    {{ $point_balance }} </span>พอยท์</h4>
                                            <h5 class="mb-1">เบอร์โทรศัพท์ <i class="fa fa-caret-right"
                                                    style="color:#777777;"></i> {{ $value->tel }}</h5>
                                            <h5>วัน/เดือน/ปีเกิด <i class="fa fa-caret-right" style="color:#777777;"></i>
                                                {{ $value->bday }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="col-lg-2 mt-4 mb-lg-0 mb-4"></div>
            </div>
        </div>
    </div>

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // number phone
        function phoneFormatter() {
            $('input.phone_format').on('input', function() {
                var number = $(this).val().replace(/[^\d]/g, '')
                if (number.length >= 5 && number.length < 10) {
                    number = number.replace(/(\d{3})(\d{2})/, "$1-$2");
                } else if (number.length >= 10) {
                    number = number.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3");
                }
                $(this).val(number)
                $('input.phone_format').attr({
                    maxLength: 12
                });
            });
        };
        $(phoneFormatter);
    </script>
@endsection
