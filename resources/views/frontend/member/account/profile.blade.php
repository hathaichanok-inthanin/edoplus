@extends('frontend/layouts/template')
<style>
    @media only screen and (max-width: 768px) {
        #mobile {
            display: inline !important;
            padding: 5px;
        }

        #desktop {
            display: none;
        }
    }

    .card-profile h5 {
        color: #777777;
    }

    .card-profile h4 {
        color: #777777;
    }

    .card-profile h3 {
        color: #777777;
    }
</style>
@section('content')
    @php
        $redeem_reward_point = 0;
        $sumpoint = 0;
        $redeem_point_sum = 0;
        $balance_point = 0;
    @endphp

    @php
        // point ที่ได้รับ
        $sumprice = DB::table('points')->where('member_id', $member->id)->where('type', 'เพิ่มพอยท์')->sum('price');
        // ยอดเงินที่ปรับลด
        $sumprice -= DB::table('points')->where('member_id', $member->id)->where('type', 'ปรับลดยอดเงิน')->sum('price');

        $balance = DB::table('invitation_balances')
            ->where('member_id', $member->id)
            ->where('type', 'เพิ่มยอดเงิน')
            ->sum('balance');
        if ($member->invitation == 'วงเงิน 500,000') {
            $balance = 0.05 * $balance + $balance; // members get an additional 5%
        } elseif ($member->invitation == 'วงเงิน 1,000,000') {
            $balance = 0.1 * $balance + $balance; // members get an additional 10%
        } elseif ($member->invitation == 'วงเงิน 2,000,000') {
            $balance = 0.15 * $balance + $balance; // members get an additional 15%
        } elseif ($member->invitation == 'วงเงิน 5,000,000') {
            $balance = 0.2 * $balance + $balance; // members get an additional 20%
        }
        $amount_spent = DB::table('invitation_balances')
            ->where('member_id', $member->id)
            ->where('type', 'ยอดที่ใช้ไป')
            ->sum('balance');
        $total_balance = $balance - $amount_spent;
        $total_balance = number_format($total_balance);
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
        $point_balance = $sumpoint - $redeem_reward_point - $redeem_point_sum;
    @endphp

    @if (Auth::guard('member')->user()->invitation != null)
        <div class="container" id="desktop" style="margin-top: 10rem;">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="card z-index-2">
                        <div class="card-header pb-0 pt-3 bg-transparent card-profile">
                            <div class="row mb-4 mt-4">
                                <div class="col-md-2">
                                    <center><img src="{{ url('assets/image/profile.png') }}" width="100%;"></center>
                                </div>
                                @php
                                    $member_new = count(
                                        DB::table('members')
                                            ->where('id', $member->id)
                                            ->where('created_at', '>', now()->subDays(30)->endOfDay())
                                            ->get(),
                                    );
                                @endphp
                                <div class="col-md-5" style="border-right: 2px dashed #9e9e9e;">

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
                                    <h4>คุณ{{ $member->name }} {{ $member->surname }}</h4>
                                    <h5 class="mb-1">เบอร์โทรศัพท์ <i class="fa fa-caret-right"
                                            style="color:#777777;"></i>
                                        {{ $member->tel }}</h5>
                                    <h5>วัน/เดือน/ปีเกิด <i class="fa fa-caret-right" style="color:#777777;"></i>
                                        {{ $member->bday }}</h5>
                                </div>
                                <div class="col-md-5">
                                    <h4 style="font-size: 20px;">Edo Invitation Only</h4>
                                    <h4 style="font-size: 20px;">{{ $member->invitation }} บาท</h4>
                                    <h4 class="mb-1">ยอดเงินคงเหลือใน Wallet <i class="fa fa-caret-down"
                                            style="color:#777777;"></i><br><span
                                            style="font-size:22px;">{{ $total_balance }}</span> บาท</h4>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    @else
        <div class="container" id="desktop" style="margin-top: 10rem;">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="card z-index-2">
                        <div class="card-header pb-0 pt-3 bg-transparent card-profile">
                            <div class="row mb-4 mt-4">
                                <div class="col-md-2">
                                    <center><img src="{{ url('assets/image/profile.png') }}" width="100%;"></center>
                                </div>
                                @php
                                    $member_new = count(
                                        DB::table('members')
                                            ->where('id', $member->id)
                                            ->where('created_at', '>', now()->subDays(30)->endOfDay())
                                            ->get(),
                                    );
                                @endphp
                                <div class="col-md-5" style="border-right: 2px dashed #9e9e9e;">

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
                                    <h4>คุณ{{ $member->name }} {{ $member->surname }}</h4>
                                </div>
                                <div class="col-md-5">
                                    <h4 class="mb-1">พอยท์คงเหลือ <i class="fa fa-caret-down"
                                            style="color:#777777;"></i><br><span
                                            style="font-size:22px;">{{ $point_balance }}</span> พอยท์</h4>
                                    <h5 class="mb-1">เบอร์โทรศัพท์ <i class="fa fa-caret-right"
                                            style="color:#777777;"></i>
                                        {{ $member->tel }}</h5>
                                    <h5>วัน/เดือน/ปีเกิด <i class="fa fa-caret-right" style="color:#777777;"></i>
                                        {{ $member->bday }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    @endif

    @if (Auth::guard('member')->user()->invitation != null)
        <div class="container" id="mobile" style="display:none;">
            <div class="card z-index-2">
                <div class="card-header pb-0 pt-3 bg-transparent card-profile">
                    <div class="row mb-4 mt-4">

                        <div class="col-md-12">
                            <center><img src="{{ url('assets/image/profile.png') }}" width="40%;"></center>
                        </div>
                        @php
                            $member_new = count(
                                DB::table('members')
                                    ->where('id', $member->id)
                                    ->where('created_at', '>', now()->subDays(30)->endOfDay())
                                    ->get(),
                            );
                        @endphp
                        <div class="col-md-12">
                            <div class="d-flex align-items-center justify-content-center" style="gap: 10px;">
                                @if ($member->status == 'ONLINE')
                                    <button class="btn btn-success btn-sm my-auto"
                                        style="color:#fff; margin-top:10px;">{{ $member->status }}</button>
                                @else
                                    <button class="btn btn-danger btn-sm my-auto"
                                        style="color:#fff;">{{ $member->status }}</button>
                                @endif

                                @if ($member_new != 0)
                                    <button class="btn btn-warning btn-sm my-auto" style="color:#fff;">ลูกค้าใหม่</button>
                                @endif
                            </div>
                            <div class="container" style="text-align: center;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="mt-2">หมายเลขสมาชิก <i class="fa fa-caret-down"
                                                style="color:#777777;"></i><br>{{ $member->serialnumber }}</h5>
                                        <h3>คุณ{{ $member->name }} {{ $member->surname }}</h3>
                                        <h5 class="mb-1">เบอร์โทรศัพท์ <i class="fa fa-caret-right"
                                                style="color:#777777;"></i> {{ $member->tel }}</h5>
                                        <h5>วัน/เดือน/ปีเกิด <i class="fa fa-caret-right" style="color:#777777;"></i>
                                            {{ $member->bday }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="border-top: 2px dashed #9e9e9e;"></div>
                        <div class="col-md-5 mt-3">
                            <div class="container" style="text-align: center;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 style="font-size: 20px;">Edo Invitation Only</h4>
                                        <h4 style="font-size: 20px;">{{ $member->invitation }} บาท</h4>
                                        <h4 class="mb-1">ยอดเงินคงเหลือใน Wallet <i class="fa fa-caret-down"
                                                style="color:#777777;"></i><br><span
                                                style="font-size:22px;">{{ $total_balance }}</span> บาท</h4>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container" id="mobile" style="display:none;">
            <div class="card z-index-2">
                <div class="card-header pb-0 pt-3 bg-transparent card-profile">
                    <div class="row mb-4 mt-4">

                        <div class="col-md-12">
                            <center><img src="{{ url('assets/image/profile.png') }}" width="40%;"></center>
                        </div>
                        @php
                            $member_new = count(
                                DB::table('members')
                                    ->where('id', $member->id)
                                    ->where('created_at', '>', now()->subDays(30)->endOfDay())
                                    ->get(),
                            );
                        @endphp
                        <div class="col-md-12">
                            <div class="d-flex align-items-center justify-content-center" style="gap: 10px;">
                                @if ($member->status == 'ONLINE')
                                    <button class="btn btn-success btn-sm my-auto"
                                        style="color:#fff; margin-top:10px;">{{ $member->status }}</button>
                                @else
                                    <button class="btn btn-danger btn-sm my-auto"
                                        style="color:#fff;">{{ $member->status }}</button>
                                @endif

                                @if ($member_new != 0)
                                    <button class="btn btn-warning btn-sm my-auto" style="color:#fff;">ลูกค้าใหม่</button>
                                @endif
                            </div>
                            <div class="container" style="text-align: center;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="mt-2">หมายเลขสมาชิก <i class="fa fa-caret-down"
                                                style="color:#777777;"></i><br>{{ $member->serialnumber }}</h5>
                                        <h3>คุณ{{ $member->name }} {{ $member->surname }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="container mt-3" style="text-align: center;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="mb-1">พอยท์คงเหลือ <i class="fa fa-caret-right"
                                                style="color:#777777;"></i><span style="font-size:22px;">
                                                {{ $point_balance }}</span> พอยท์</h4>
                                        <h5 class="mb-1">เบอร์โทรศัพท์ <i class="fa fa-caret-right"
                                                style="color:#777777;"></i> {{ $member->tel }}</h5>
                                        <h5>วัน/เดือน/ปีเกิด <i class="fa fa-caret-right" style="color:#777777;"></i>
                                            {{ $member->bday }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{--  --}}
    @if (Auth::guard('member')->user()->invitation != null)
        <div class="container" style="text-align: center; margin-bottom:10rem;">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-4 col-6">
                            <a href="{{ url('member/profile-change') }}">
                                <div class="card mt-3">
                                    <div class="card-body" style="padding: 1.25rem 0 1.25rem 0;">
                                        <p>แก้ไขข้อมูลส่วนตัว</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-6">
                            <a href="{{ url('member/tel-change') }}">
                                <div class="card mt-3">
                                    <div class="card-body" style="padding: 1.25rem 0 1.25rem 0;">
                                        <p>เปลี่ยนเบอร์โทรศัพท์</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-6">
                            <a href="{{ route('password.change') }}">
                                <div class="card mt-3">
                                    <div class="card-body" style="padding: 1.25rem 0 1.25rem 0;">
                                        <p>เปลี่ยนรหัสผ่าน</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-6">
                            <a href="{{ route('member.logout') }}"
                                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                                <div class="card mt-3">
                                    <div class="card-body" style="padding: 1.25rem 0 1.25rem 0;">
                                        <p>ออกจากระบบ</p>
                                    </div>
                                </div>
                            </a>
                            <form id="logout-form" action="{{ route('member.logout') }}" method="POST"
                                style="display: none;">@csrf</form>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    @else
        <div class="container" style="text-align: center; margin-bottom:10rem;">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-4 col-6">
                            <a href="{{ url('member/coupon') }}">
                                <div class="card mt-3">
                                    <div class="card-body" style="padding: 1.25rem 0 1.25rem 0;">
                                        <p>คูปองของฉัน</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-6">
                            <a href="{{ url('member/profile-change') }}">
                                <div class="card mt-3">
                                    <div class="card-body" style="padding: 1.25rem 0 1.25rem 0;">
                                        <p>แก้ไขข้อมูลส่วนตัว</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-6">
                            <a href="{{ url('member/redeem-point') }}">
                                <div class="card mt-3">
                                    <div class="card-body" style="padding: 1.25rem 0 1.25rem 0;">
                                        <p>ประวัติการแลกพอยท์</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-6">
                            <a href="{{ url('member/tel-change') }}">
                                <div class="card mt-3">
                                    <div class="card-body" style="padding: 1.25rem 0 1.25rem 0;">
                                        <p>เปลี่ยนเบอร์โทรศัพท์</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-6">
                            <a href="{{ route('password.change') }}">
                                <div class="card mt-3">
                                    <div class="card-body" style="padding: 1.25rem 0 1.25rem 0;">
                                        <p>เปลี่ยนรหัสผ่าน</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-6">
                            <a href="{{ route('member.logout') }}"
                                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                                <div class="card mt-3">
                                    <div class="card-body" style="padding: 1.25rem 0 1.25rem 0;">
                                        <p>ออกจากระบบ</p>
                                    </div>
                                </div>
                            </a>
                            <form id="logout-form" action="{{ route('member.logout') }}" method="POST"
                                style="display: none;">@csrf</form>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    @endif
@endsection
