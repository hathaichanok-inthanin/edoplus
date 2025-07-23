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
        font-size: 16px;
    }

    .campaign span {
        font-size: 14px;
        color: red;
        font-weight: 500;
    }

    .campaign a {
        color: #ffffff;
    }

    .campaign a:hover {
        color: #ffffff;
    }
</style>
@section('content')
    @php
        $dateNow = Carbon\Carbon::now()->format('d/m/Y');
    @endphp
    <div class="container-fluid py-4">
        <div class="campaign">
            <div class="row">
                <div class="col-lg-5 mb-lg-0 mb-4">
                    <a href="javascript:history.back();" style="color:#fff;"><i class="ni ni-bold-left"></i> ย้อนกลับ</a>
                </div>
            </div>
            <h4 class="mt-4">เพิ่มยอดเงิน</h4>
            <div class="row mt-4">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if (Session::has('alert-' . $msg))
                                <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                                </p>
                            @endif
                        @endforeach
                    </div>
                    <form action="{{ url('add-balance') }}" enctype="multipart/form-data" method="post">@csrf
                        <div class="row">
                            <div class="col-lg-12 col-12 mb-lg-0 mb-4">
                                <div class="card z-index-2">
                                    <div class="card-header pb-0 pt-3 bg-transparent">
                                        <div class="row">
                                            <div class="col-md-12 mt-2">
                                                <p><span>*</span> จำนวนเงินที่ต้องการเพิ่ม <span>(จำเป็นต้องกรอก)</span>
                                                    @if ($errors->has('balance'))
                                                        <span class="text-danger"
                                                            style="font-size: 15px;">({{ $errors->first('balance') }})</span>
                                                    @endif
                                                </p>
                                                <input class="form-control" type="text"
                                                    placeholder="จำนวนเงินที่ต้องการเพิ่ม เช่น 1000" name="balance"
                                                    value="{{ old('balance') }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mt-3">
                                                <input type="hidden" name="type" value="เพิ่มยอดเงิน">
                                                <input type="hidden" name="member_id" value="{{ $member_id }}">
                                                <input type="hidden" name="admin_id"
                                                    value="{{ Auth::guard('admin')->id() }}">
                                                <input type="hidden" name="date" value="{{ $dateNow }}">
                                                <button type="submit" class="btn btn-lg btn-success">เพิ่มยอดเงิน</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
@endsection
