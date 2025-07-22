@extends('frontend/layouts/template')
<style>
    .table .thead-light th {
        color: #ffffff !important;
        background-color: #777777 !important;
        border-color: #777777 !important;
    }
</style>
@section('content')
    <div class="container pt-5 pb-5">
        <h1 style="font-size:2.5rem;" class="text-center">
            <strong>ประวัติการแลกพอยท์</strong>
        </h1>
        <br>
    </div>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card mb-5">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <div class="table-responsive">
                        <table class="table align-items-center" style="color: #f28123;">
                            <thead class="thead-light">
                                <tr style="text-align: center;">
                                    <th>ลำดับ</th>
                                    <th>วันที่</th>
                                    <th>ของรางวัล</th>
                                    <th>คะแนนที่ใช้</th>
                                    <th>สถานะ</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($redeem_points as $redeem_point => $value)
                                    @php
                                        $reward = DB::table('rewards')->where('id', $value->reward_id)->value('name');
                                        $point = DB::table('reward_points')
                                            ->where('id', $value->point_id)
                                            ->value('point');
                                    @endphp
                                    <tr style="text-align:center;">
                                        <td>{{ $NUM_PAGE * ($page - 1) + $redeem_point + 1 }}</td>
                                        <td>{{ $value->date }}</td>
                                        <td>{{ $reward }}</td>
                                        <td>{{ $point }} คะแนน</td>
                                        @if ($value->status == 'แลกรางวัลสำเร็จ')
                                            <td style="color: green;">{{ $value->status }}</td>
                                        @else
                                            <td>{{ $value->status }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
