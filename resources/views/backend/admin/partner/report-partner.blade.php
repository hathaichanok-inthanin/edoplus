@extends('backend/layouts/admin/template')
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
</style>
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-5 mb-lg-0 mb-4">
                <a href="javascript:history.back();" style="color:#fff;"><i class="ni ni-bold-left"></i> ย้อนกลับ</a>
            </div>
        </div>
        <div class="reward mt-4">
            <div class="row">
                <div class="col-lg-12 mb-lg-0 mb-4">
                    <div style="text-align: right;">
                        <a href="{{route('export')}}" class="btn btn-md btn-success"><i class="fa fa-download"></i> EXPORT EXCEL</a>
                    </div>
                    <div class="card z-index-2 h-100">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h6 class="text-capitalize">รายงานข้อมูลการใช้โปรโมชั่นร้านค้าพันธมิตร</h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table align-items-center">
                                    <thead class="thead-light">
                                        <tr style="text-align: center;">
                                            <th>#</th>
                                            <th>CODE</th>
                                            <th>ชื่อสมาชิก</th>
                                            <th>พันธมิตร</th>
                                            <th>โปรโมชั่น</th>
                                            <th>วันที่รับสิทธิ์</th>
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
                                            <tr style="text-align:center;">
                                                <td>{{ $NUM_PAGE * ($page - 1) + $redeem_point + 1 }}</td>
                                                <td>{{ $value->code }}</td>
                                                <td>{{ $name }} {{ $surname }}</td>
                                                <td>{{ $partner_name }} {{ $branch }}</td>
                                                <td>{!! $promotion !!}</td>
                                                <td>{{ $value->date }} {{ $time }}</td>
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
