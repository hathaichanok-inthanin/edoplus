@extends('backend/layouts/admin/template')
<style>
    .reward h4 {
        color: #fff;
        border-bottom: 2px solid #eeeeee;
        padding-bottom: 15px;
    }

    .reward h3 {
        color: #a7a7a7e1;
    }

    .reward p {
        font-size: 14px;
    }

    .reward span {
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
            <h4>ของรางวัล</h4>
        </div>
        <a href="{{ url('/create-reward') }}" class="btn btn-success mt-5" type="submit"><i class="fa fa-plus-circle"
                aria-hidden="true"></i> สร้างของรางวัล</a><br>
        <a href="{{ url('/reward') }}" class="btn btn-secondary mt-5" type="submit"><i class="fa fa-gift"
                aria-hidden="true"></i> ของรางวัลทั้งหมด</a>
        <a href="{{ url('/reward-on') }}" class="btn btn-success mt-5" type="submit"><i class="fa fa-hourglass-half"
                aria-hidden="true"></i> กำลังใช้งาน</a>
        <a href="{{ url('/reward-notActive') }}" class="btn btn-info mt-5" type="submit"><i class="fa fa-play-circle"
                aria-hidden="true"></i> ยังไม่ใช้งาน</a>
        <a href="{{ url('/reward-pause') }}" class="btn btn-warning mt-5" type="submit"><i class="fa fa-exclamation-circle"
                aria-hidden="true"></i> พักการใช้งาน</a>
        <a href="{{ url('/reward-off') }}" class="btn btn-danger mt-5" type="submit"><i class="fa fa-ban"
                aria-hidden="true"></i> ปิดการใช้งาน</a>
    </div>

    <div class="container-fluid py-4">
        <div class="reward">
            <div class="row">
                <div class="col-lg-12 mb-lg-0 mb-4">
                    <div class="z-index-2 h-100">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($rewards as $reward => $value)
                                    @php
                                        $reward_point = DB::table('reward_points')
                                            ->where('reward_id', $value->id)
                                            ->value('point');
                                    @endphp
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <img src="{{ url('images/reward') }}/{{ $value->image }}"
                                                    class="img-responsive" width="100%">
                                                <p class="mb-0 mt-4 mb-3" style="border-bottom: 2px dashed #cac8c8;">
                                                    {{ $value->name }}</p>
                                                <p class="mb-2">ใช้พอยท์ <i class="fa fa-caret-right"
                                                        style="color:#777777;"></i> <span>{{ $reward_point }}</span> พอยท์
                                                </p>
                                                <p class="mb-3">สถานะ <i class="fa fa-caret-right"
                                                        style="color:#777777;"></i> {{ $value->status }}</p>
                                                <div class="col" style="text-align: right;">
                                                    <a href="{{ url('reward-edit/') }}/{{ $value->id }}"
                                                        class="btn btn-outline-primary radius-15"><i class="fa fa-pencil"
                                                            aria-hidden="true"></i></a>
                                                    <a href="{{ url('reward-delete/') }}/{{ $value->id }}"
                                                        onclick="return confirm('Are you sure to delete ?')"
                                                        class="btn btn-outline-primary radius-15"><i class="fa fa-trash"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div @endsection
