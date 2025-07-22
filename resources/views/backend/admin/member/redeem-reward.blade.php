@extends('backend/layouts/admin/template')
<style>
    .redeem-reward h4 {
        color: #fff;
    }

    .redeem-reward p {
        font-size: 14px;
    }

    .redeem-reward span {
        font-size: 14px;
        color: red;
        font-weight: bold;
    }

    .redeem-reward h6 {
        text-align: center;
    }

    .header h4 {
        color: #fff;
        border-bottom: 2px solid #eeeeee;
        padding-bottom: 15px;
    }

    .header a {
        color: #ffffff;
    }

    .header a:hover {
        color: #ffffff;
    }
</style>
@section('content')
    <div class="container-fluid py-4">
        <div class="header">
            <div class="row">
                <div class="col-lg-5 mb-lg-0 mb-4">
                    <a href="javascript:history.back();"><i class="ni ni-bold-left"></i> ย้อนกลับ</a>
                </div>
            </div>
            <h4 class="mt-4">การแลกของรางวัล</h4>
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="redeem-reward">
            <div class="row">
                <div class="col-lg-12 mb-lg-0 mb-4 mt-4">
                    <div class="card h-100">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h5 class="text-capitalize">การแลกของรางวัล (ข้อมูลทั้งหมด)</h5>
                            <p>{{ $redeem_rewards->links() }}</p>
                        </div>
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table align-items-center" id="filter-table">
                                    <thead class="thead-light">
                                        <tr style="text-align: center;">
                                            <th>ลำดับ</th>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>เบอร์โทร</th>
                                            <th>ของรางวัล</th>
                                            <th>รายละเอียด</th>
                                            <th>พอยท์ที่ใช้แลก</th>
                                            <th>วันที่แลกพอยท์</th>
                                            <th>สถานะ</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach ($redeem_rewards as $redeem_reward => $value)
                                            @php
                                                $name = DB::table('members')
                                                    ->where('id', $value->member_id)
                                                    ->value('name');
                                                $surname = DB::table('members')
                                                    ->where('id', $value->member_id)
                                                    ->value('surname');
                                                $tel = DB::table('members')
                                                    ->where('id', $value->member_id)
                                                    ->value('tel');
                                                $reward = DB::table('rewards')
                                                    ->where('id', $value->reward_id)
                                                    ->value('name');
                                                $detail = DB::table('rewards')
                                                    ->where('id', $value->reward_id)
                                                    ->value('detail');
                                                $point = DB::table('reward_points')
                                                    ->where('id', $value->point_id)
                                                    ->value('point');
                                            @endphp
                                            <tr style="text-align:center;">
                                                <td>{{ $NUM_PAGE * ($page - 1) + $redeem_reward + 1 }}</td>
                                                <td>{{ $name }} {{ $surname }}</td>
                                                <td>{{ $tel }}</td>
                                                <td>{{ $reward }}</td>
                                                <td>{!! $detail !!}</td>
                                                <td>{{ $point }}</td>
                                                <td>{{ $value->date }}</td>
                                                @if ($value->status == 'แลกรางวัลสำเร็จ')
                                                    <td>
                                                        <button class="btn btn-success btn-sm my-auto" style="color:#fff;">
                                                            {{ $value->status }}
                                                        </button>
                                                    </td>
                                                @else
                                                    <td>
                                                        <button data-bs-toggle="modal" data-bs-target="#confirmRedeemReward{{$value->id}}"
                                                            class="btn btn-warning btn-sm my-auto" style="color:#fff;">
                                                            <i class="ni ni-settings" aria-hidden="true"></i>
                                                            {{ $value->status }}
                                                        </button>
                                                    </td>
                                                @endif
                                            </tr>
                                            <!-- Modal -->
                                            <div class="modal fade" id="confirmRedeemReward{{$value->id}}" data-bs-backdrop="static"
                                                tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form action="{{ url('/confirm-redeem-reward') }}" method="POST"
                                                            enctype="multipart/form-data">@csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="confirmRedeemRewardTitle">
                                                                    ยืนยันสถานะการแลกของรางวัล
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12 mb-3">
                                                                        <label class="form-label">สถานะ</label>
                                                                        <select name="status" class="form-control">
                                                                            <option value="แลกรางวัลสำเร็จ">แลกรางวัลสำเร็จ</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="id" value="{{$value->id}}">
                                                                <button type="button" class="btn btn-outline-secondary btn-sm"
                                                                    data-bs-dismiss="modal"
                                                                    style="font-family:'Noto Sans Thai';">ปิด</button>
                                                                <button type="submit" class="btn btn-warning btn-sm"
                                                                    style="font-family:'Noto Sans Thai';">ยืนยันสถานะ</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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
