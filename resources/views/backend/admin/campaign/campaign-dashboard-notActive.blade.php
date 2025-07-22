@extends('backend/layouts/admin/template')
<style>
    .campaign h4 {
        color: #fff;
        border-bottom: 2px solid #eeeeee;
        padding-bottom: 15px;
    }

    .campaign h3 {
        color: #a7a7a7e1;
    }

    .campaign p {
        font-size: 14px;
    }

    .campaign span {
        font-size: 14px;
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
        <div class="campaign mt-4">
            <h4>คูปอง</h4>
        </div>
        <a href="{{ url('/create-campaign') }}" class="btn btn-success mt-5" type="submit"><i class="fa fa-plus-circle"
                aria-hidden="true"></i> สร้างคูปอง</a><br>
        <a href="{{ url('/campaign') }}" class="btn btn-secondary mt-5" type="submit"><i class="fas fa-ticket-alt"
                aria-hidden="true"></i> คูปองทั้งหมด</a>
        <a href="{{ url('/campaign-on') }}" class="btn btn-success mt-5" type="submit"><i class="fa fa-pause"
                aria-hidden="true"></i> กำลังจัดแคมเปญ</a>
        <a href="{{ url('/campaign-notActive') }}" class="btn btn-info mt-5" type="submit"><i class="fa fa-play-circle"
                aria-hidden="true"></i> ยังไม่เริ่มแคมเปญ</a>
        <a href="{{ url('/campaign-pause') }}" class="btn btn-warning mt-5" type="submit"><i
                class="fa fa-exclamation-circle" aria-hidden="true"></i> แคมเปญถูกพัก</a>
        <a href="{{ url('/campaign-off') }}" class="btn btn-danger mt-5" type="submit"><i class="fa fa-ban"
                aria-hidden="true"></i> สิ้นสุดแคมเปญ</a>
    </div>
    <div class="container-fluid py-4">
        <div class="campaign">
            <div class="row">
                <div class="col-lg-12 mb-lg-0 mb-4">
                    <div class="z-index-2 h-100">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($campaigns as $campaign => $value)
                                    @php
                                        $store_name = DB::table('partner_shops')
                                            ->where('id', $value->partner_id)
                                            ->value('name');
                                        $dateNow = Carbon\Carbon::now()->format('Y-m-d');
                                    @endphp
                                    @if ($value->expire_date > $dateNow)
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <img src="{{ url('images/campaign') }}/{{ $value->image }}"
                                                        class="img-responsive" width="100%">
                                                    <p class="mb-0 mt-4" style="color: red;">รหัสคูปอง <i
                                                            class="fa fa-caret-right" style="color:#ff0000;"></i>
                                                        <strong>{{ $value->code }}</strong>
                                                    </p>
                                                    <h5 class="mb-0 mt-2 mb-3" style="border-bottom: 2px dashed #cac8c8;">
                                                        {{ $value->name }}</h5>


                                                    @if ($value->expire_date < $dateNow || $value->status == 'สิ้นสุดแคมเปญ')
                                                        <p style="border-bottom: 2px dashed #cac8c8; color: red;">สถานะ <i
                                                                class="fa fa-caret-right" style="color:#ff0000;"></i>
                                                            สิ้นสุดแคมเปญ
                                                        </p>
                                                    @else
                                                        <p style="border-bottom: 2px dashed #cac8c8;">สถานะ <i
                                                                class="fa fa-caret-right" style="color:#777777;"></i>
                                                            {{ $value->status }}
                                                        </p>
                                                    @endif
                                                    @php
                                                        $date_format = date('d-m-Y', strtotime($value->expire_date));
                                                    @endphp
                                                    <p>สิ้นสุดแคมเปญ <i class="fa fa-caret-right"
                                                            style="color:#777777;"></i>
                                                        {{ $date_format }}</p>
                                                    <div class="col" style="text-align: right;">
                                                        <a href="{{ url('campaign-edit/') }}/{{ $value->id }}"
                                                            class="btn btn-outline-primary radius-15"><i class="fas fa-edit"
                                                                aria-hidden="true"></i></a>
                                                        <a href="{{ url('/campaign-delete') }}/{{ $value->id }}"
                                                            onclick="return confirm('Are you sure to delete ?')"
                                                            class="btn btn-outline-primary radius-15"><i class="fa fa-trash"
                                                                aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
