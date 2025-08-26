@extends('backend/layouts/adminStore/template')
<style>
    .member-profile a {
        color: #ffffff;
    }

    .member-profile a:hover {
        color: #ffffff;
    }

    .vertical-center {
        margin: 0;
        position: absolute;
        top: 50%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
    }

    .card span {
        font-size: 30px;
        color: red;
        font-weight: bold;
    }

    .card-header a {
        color: #1300c2;
    }

    .card-header a:hover {
        color: #471de0;
    }
</style>
@section('content')
    @php
        // point ที่ได้รับ
        $sumprice = DB::table('points')->where('member_id', $member->id)->where('type', 'เพิ่มพอยท์')->sum('price');
        // ยอดเงินที่ปรับลด
        $sumprice -= DB::table('points')->where('member_id', $member->id)->where('type', 'ปรับลดยอดเงิน')->sum('price');
        $culPrice = floor($sumprice / 100);

        // หักคะแนนจากการแลกของรางวัล
        $redeem_reward_point = DB::table('redeem_rewards')
            ->join('reward_points', 'reward_points.id', '=', 'redeem_rewards.point_id')
            ->where('member_id', $member->id)
            ->sum('reward_points.point');

        // หักคะแนนแลกสิทธิ์ร้านค้าพันธมิตร
        $redeem_point = DB::table('redeem_points')
            ->join('partner_shop_points', 'partner_shop_points.id', '=', 'redeem_points.point_id')
            ->where('member_id', $member->id)
            ->sum('partner_shop_points.point');

        $point_balance = $culPrice - $redeem_reward_point - $redeem_point;
    @endphp
    <div class="container-fluid py-4">
        <div class="member-profile">
            <div class="row">
                <div class="col-lg-5 mb-lg-0 mb-4">
                    <a href="javascript:history.back();"><i class="ni ni-bold-left"></i> ย้อนกลับ</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8 mt-4 mb-lg-0 mb-4">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if (Session::has('alert-' . $msg))
                            <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                        @endif  
                    @endforeach
                    <div class="card z-index-2">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <a href="{{ url('admin/edit-profile') }}/{{ $member->id }}"><i class="ni ni-settings"
                                            aria-hidden="true"></i> แก้ไขข้อมูล</a>
                                </div>
                                <div class="col-md-4">
                                    <center><img src="{{ url('assets/image/profile.png') }}" width="70%;"></center>
                                </div>
                                @php
                                    $member_new = count(
                                        DB::table('members')
                                            ->where('id', $member->id)
                                            ->where('created_at', '>', now()->subDays(30)->endOfDay())
                                            ->get(),
                                    );
                                    // min_price, max_price ระดับสมาชิก
                                    $min_price_silver = DB::table('tiers')->where('tier', 'SILVER')->value('min_price');
                                    $max_price_silver = DB::table('tiers')->where('tier', 'SILVER')->value('max_price');
                                    $min_price_gold = DB::table('tiers')->where('tier', 'GOLD')->value('min_price');
                                    $max_price_gold = DB::table('tiers')->where('tier', 'GOLD')->value('max_price');
                                    $min_price_black = DB::table('tiers')->where('tier', 'BLACK')->value('min_price');
                                @endphp
                                <div class="col-md-4" style="border-right: 2px dashed #9e9e9e;">

                                    @if ($member->status == 'ONLINE')
                                        <button class="btn btn-success btn-sm my-auto" style="color:#fff;">
                                            {{ $member->status }}
                                        </button>
                                    @else
                                        <button class="btn btn-danger btn-sm my-auto" style="color:#fff;">
                                            {{ $member->status }}
                                        </button>
                                    @endif
                                    @if ($member_new != 0)
                                        <button class="btn btn-warning btn-sm my-auto"
                                            style="color:#fff;">ลูกค้าใหม่</button>
                                    @endif
                                    <h5 class="mt-2">หมายเลขสมาชิก <i class="fa fa-caret-down"
                                            style="color:#777777;"></i><br>{{ $member->serialnumber }}</h5>
                                    <h5 class="mt-2">หมายเลขบัตรประชาชน <i class="fa fa-caret-down"
                                            style="color:#777777;"></i>
                                        <h5>
                                            @if ($member->card_id == null)
                                                <a
                                                    href="{{ url('editProfile') }}/{{ $member->id }}">ใส่หมายเลขบัตรประชาชน</a>
                                            @else
                                                <h5>{{ $member->card_id }}</h5>
                                            @endif

                                            <h4>คุณ{{ $member->name }} {{ $member->surname }}</h4>
                                </div>
                                <div class="col-md-4">
                                    @if ($sumprice == $min_price_silver || $sumprice < $max_price_silver)
                                        <h5 class="mt-3">ระดับของสมาชิก <i class="fa fa-caret-down"
                                                style="color:#777777;"></i><br><span>SILVER</span></h5>
                                    @elseif($sumprice == $min_price_gold || $sumprice < $max_price_gold)
                                        <h5 class="mt-3">ระดับของสมาชิก <i class="fa fa-caret-down"
                                                style="color:#777777;"></i><br><span>GOLD</span></h5>
                                    @elseif($sumprice > $min_price_black)
                                        <h5 class="mt-3">ระดับของสมาชิก <i class="fa fa-caret-down"
                                                style="color:#777777;"></i><br><span>BLACK</span></h5>
                                    @endif
                                    <h4 class="mb-1">พอยท์คงเหลือ <i class="fa fa-caret-down"
                                            style="color:#777777;"></i><br><span> {{ $point_balance }} </span>พอยท์</h4>
                                    <h5 class="mb-1">เบอร์โทรศัพท์ <i class="fa fa-caret-right"
                                            style="color:#777777;"></i> {{ $member->tel }}</h5>
                                    <h5>วัน/เดือน/ปีเกิด <i class="fa fa-caret-right" style="color:#777777;"></i>
                                        {{ $member->bday }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8 mt-4 mb-lg-0 mb-4">
                    <div class="card z-index-2">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <div class="table-responsive">
                                <table class="table align-items-center">
                                    <thead class="thead-light">
                                        <tr style="text-align: center;">
                                            <th>ลำดับ</th>
                                            <th>วันที่ใช้บริการ</th>
                                            <th>สาขา</th>
                                            <th>หมายเลขบิล</th>
                                            <th>จำนวนเงิน</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach ($points as $point => $value)
                                            @php
                                                $store_name = DB::table('account_stores')
                                                    ->where('id', $value->branch_id)
                                                    ->value('store_name');
                                                $branch = DB::table('account_stores')
                                                    ->where('id', $value->branch_id)
                                                    ->value('branch');
                                            @endphp
                                            <tr style="text-align:center;">
                                                <td>{{ $NUM_PAGE * ($page - 1) + $point + 1 }}</td>
                                                <td>{{ $value->service_date }}</td>
                                                <td>{{ $store_name }} {{ $branch }}</td>
                                                <td>{{ $value->bill_number }}</td>
                                                <td>{{ $value->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>
@endsection
