@extends('backend/layouts/partner/template')
<style>
    .partner h4 {
        color: #fff;
        border-bottom: 2px solid #eeeeee;
        padding-bottom: 15px;
    }

    .partner h3 {
        color: #a7a7a7e1;
    }

    .partner p {
        font-size: 14px;
    }

    .partner span {
        font-size: 20px;
        color: red;
        font-weight: bold;
    }

    <style>.repeat-member .member-types {
        display: flex;
        flex-direction: row;
        flex: 1;
        flex-wrap: wrap;
    }

    .repeat-member .member-types>div:first-child {
        background: #e6fcfc;
    }

    .repeat-member .member-types>div {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-width: 150px;
        padding: 20px 10px;
        border-radius: 16px;
        margin: 5px;
        box-shadow: 4px 4px 4px #f8f8f8;
    }

    .member-types p {
        font-weight: bolder;
        font-size: 18px;
    }

    .member-types span {
        font-weight: bolder;
        font-size: 18px;
    }

    .repeat-member p {
        font-weight: bolder;
        font-size: 18px;
    }
</style>
</style>
@section('content')
    <div class="container-fluid py-4">
        <div class="col-lg-4 col-12 mb-lg-0 mb-4">
            <div class="card z-index-2">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">สถิติของสมาชิก</h6>
                </div>
                @php
                    $redeem_point_last_month = count(
                        DB::table('redeem_points')
                            ->where('partner_id', Auth::guard('partner')->user()->id)
                            ->get(),
                    );
                    $redeem_point_month = count(
                        DB::table('redeem_points')
                            ->where('partner_id', Auth::guard('partner')->user()->id)
                            ->get(),
                    );
                    $redeem_point = count(
                        DB::table('redeem_points')
                            ->where('partner_id', Auth::guard('partner')->user()->id)
                            ->get(),
                    );
                @endphp
                <div class="card-body p-3 repeat-member">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="member-types">
                                <div class="text-sm mb-0" style="text-align:center;"><br>
                                    <p class="font-weight-bold">สมาชิกใช้สิทธิ์ทั้งหมด</p>
                                    <span style="text-align:center;">{{ $redeem_point }}</span>
                                    <span>สิทธิ์</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="member-types">
                                <div class="text-sm mb-0" style="background-color: #eef3ff; text-align:center;"><br>
                                    <p class="font-weight-bold">สมาชิกใช้สิทธิ์เดือนที่แล้ว</p>
                                    <span style="text-align:center;">{{ $redeem_point_last_month }}</span>
                                    <span>สิทธิ์</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="member-types">
                                <div class="text-sm mb-0" style="background-color: #f0e7fe; text-align:center;"><br>
                                    <p class="font-weight-bold">สมาชิกใช้สิทธิ์เดือนนี้</p>
                                    <span style="text-align:center;">{{ $redeem_point_month }}</span>
                                    <span>สิทธิ์</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="reward mt-4">
            <div class="row">
                <div class="col-lg-12 mb-lg-0 mb-4">
                    <div class="card z-index-2 h-100">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h6 class="text-capitalize">ข้อมูลการใช้โปรโมชั่นเครือข่ายพันธมิตร</h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table align-items-center">
                                    <thead class="thead-light">
                                        <tr style="text-align: center;">
                                            <th>#</th>
                                            <th>CODE</th>
                                            <th>ชื่อสมาชิก</th>
                                            <th>โปรโมชั่น</th>
                                            <th>วันที่รับสิทธิ์</th>
                                            <th>รูปภาพ</th>
                                            <th>สถานะการใช้งาน</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach ($redeem_points as $redeem_point => $value)
                                            @php
                                                $name = DB::table('members')
                                                    ->where('id', $value->member_id)
                                                    ->value('name');
                                                $surname = DB::table('members')
                                                    ->where('id', $value->member_id)
                                                    ->value('surname');
                                                $partner_name = DB::table('partner_shops')
                                                    ->where('id', $value->partner_id)
                                                    ->value('name');
                                                $branch = DB::table('partner_shops')
                                                    ->where('id', $value->partner_id)
                                                    ->value('branch');
                                                $promotion = DB::table('partner_shop_promotions')
                                                    ->where('id', $value->promotion_id)
                                                    ->value('promotion');
                                                $time = date('H:i:s', strtotime($value->created_at));
                                            @endphp
                                            <tr style="text-align:center; padding:0px !important;">
                                                <td>{{ $NUM_PAGE * ($page - 1) + $redeem_point + 1 }}</td>
                                                <td>{{ $value->code }}</td>
                                                <td>{{ $name }} {{ $surname }}</td>
                                                <td>
                                                    <p>{!! $promotion !!}</p>
                                                </td>
                                                <td>{{ $value->date }} {{ $time }}</td>
                                                @if ($value->image != null)
                                                    <td><a href="{{ url('/images/partnerRedeemPoint') }}/{{ $value->image }}"
                                                            class="singleImage2"><i class="fa fa-picture-o"
                                                                style="color: green;"></i></a></td>
                                                @endif
                                                @if ($value->status == 'ใช้งานแล้ว')
                                                    <td>
                                                        <button class="btn btn-success btn-sm my-auto" style="color:#fff;">
                                                            {{ $value->status }}
                                                        </button>
                                                    </td>
                                                @else
                                                    <td>
                                                        <button class="btn btn-danger btn-sm my-auto" style="color:#fff;">
                                                            {{ $value->status }}
                                                        </button>
                                                    </td>
                                                @endif
                                                <td>
                                                    <a
                                                        href="{{ url('partner/update-status-alliance') }}/{{ $value->id }}"><i
                                                            class="ni ni-settings" style="color: rgb(12, 129, 61);"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
