@extends('backend/layouts/staff/template')
<style>
    .coupon h4 {
        color: #fff;
    }

    .coupon p {
        font-size: 15px;
        margin-bottom: 0.3rem !important;
    }

    .coupon span {
        font-size: 12px;
        color: red;
        font-weight: bold;
    }

    .header h4 {
        color: #fff;
        border-bottom: 2px solid #eeeeee;
        padding-bottom: 15px;
    }

    .img-campaign {
        border-radius: 1.2rem !important;
    }

    .status span {
        color: #fff;
        font-size: 14px;
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
                <div class="col-lg-3 mt-4 mb-lg-0 mb-4"></div>
                <div class="col-lg-6 mt-4 mb-lg-0 mb-4">
                    <div class="card z-index-2">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <p>ค้นหาคูปอง <span>* จำเป็น</span></p>
                            <form action="{{ url('staff/search-coupon') }}">
                                <div class="row">
                                    <div class="col-md-9">
                                        <input class="phone_format form-control" type="text"
                                            placeholder="ใส่รหัสคูปอง 6 หลัก" name="code">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="hidden" name="member_id" value="{{ $member_id }}">
                                        <button class="btn btn-outline-primary" type="submit"
                                            id="button-addon2">ค้นหาคูปอง</button>
                                    </div>
                                </div>
                            </form>
                        </div><br>
                    </div>
                </div>
                <div class="col-lg-3 mt-4 mb-lg-0 mb-4"></div>
            </div>
            @if (count($coupons) == 0)
                <h3 class="mt-4" style="text-align:center;">- - ไม่พบข้อมูลคูปองในระบบ - -</h3>
            @else
                <div class="row">
                    @foreach ($coupons as $coupon => $value)
                        @php
                            $dateNow = Carbon\Carbon::now()->format('d/m/Y');
                            $expire_date_format = date('d/m/Y', strtotime($value->expire_date));
                        @endphp
                        <div class="col-lg-3 mt-4 mb-lg-0 mb-4"></div>
                        <div class="col-lg-6 mt-4 mb-lg-0 mb-4">
                            <div class="card z-index-2">
                                <div class="card-header pb-0 pt-3 bg-transparent">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <center><img src="{{ url('images/campaign') }}/{{ $value->image }}"
                                                    class="img-campaign img-responsive" width="100%;"></center>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="status">
                                                <h5>รหัส <i class="fa fa-caret-right" style="color:#777777;"></i>
                                                    {{ $value->code }}
                                                    @if (
                                                        $value->status_coupon == 'กำลังจัดแคมเปญ' &&
                                                            $expire_date_format > $dateNow &&
                                                            $value->status_get_coupon == 'ยังไม่ใช้งาน')
                                                        <span style="color:green;">ใช้งานได้</span>
                                                    @elseif ($expire_date_format < $dateNow && $value->status_get_coupon == 'ยังไม่ใช้งาน')
                                                        <span style="color:red;">ไม่สามารถใช้งานได้ (คูปองหมดอายุ)</span>
                                                    @elseif ($value->status_get_coupon == 'ใช้งานแล้ว')
                                                        <span style="color:red;">ไม่สามารถใช้งานได้
                                                            (คูปองถูกใช้งานแล้ว)
                                                        </span>
                                                    @else
                                                        <span style="color:red;">ไม่สามารถใช้งานได้
                                                            ({{ $value->status_coupon }})</span>
                                                    @endif
                                                </h5>
                                            </div>
                                            <h5 style="border-bottom: 2px dashed #cac8c8;">{{ $value->name }}</h5>
                                            <div>{!! $value->detail !!}</div>
                                            <p>วันที่กดรับคูปอง <i class="fa fa-caret-right" style="color:#777777;"></i>
                                                {{ $value->date_get_coupon }}</p>
                                            <p>วันที่สิ้นสุดคูปอง <i class="fa fa-caret-right" style="color:#777777;"></i>
                                                {{ $expire_date_format }}</p>
                                            @if (
                                                $value->status_coupon == 'กำลังจัดแคมเปญ' &&
                                                    $expire_date_format > $dateNow &&
                                                    $value->status_get_coupon == 'ยังไม่ใช้งาน')
                                                <a href="{{ url('staff/use-coupon') }}/{{ $value->id }}"
                                                    class="mt-2 btn btn-success btn-lg my-auto"
                                                    style="color:#fff;">กดใช้คูปอง</a>
                                            @else
                                                <button class="mt-2 btn btn-secondary btn-lg my-auto" style="color:#fff;"
                                                    disabled>ไม่สามารถกดใช้คูปองได้</button>
                                            @endif
                                        </div>
                                    </div>
                                </div><br>
                            </div>
                        </div>
                        <div class="col-lg-3 mt-4 mb-lg-0 mb-4"></div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
