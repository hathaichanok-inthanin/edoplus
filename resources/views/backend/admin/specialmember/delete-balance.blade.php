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
            <h4 class="mt-4">ปรับลดยอดเงิน</h4>
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
                    <form action="{{ url('delete-balance-specialmember') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-12 mb-lg-0 mb-4">
                                <div class="card z-index-2">
                                    <div class="card-header pb-0 pt-3 bg-transparent">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                @php
                                                    $branchs = DB::table('account_stores')->get();
                                                @endphp
                                                <label class="form-label">สาขา</label>
                                                <select name="branch_id" class="form-control">
                                                    @foreach ($branchs as $branch => $value)
                                                        <option value="{{ $value->id }}">{{ $value->store_name }}
                                                            สาขา{{ $value->branch }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">วันที่ใช้บริการ
                                                    @if ($errors->has('service_date'))
                                                        <span class="text-danger"
                                                            style="font-size: 15px;">({{ $errors->first('service_date') }})</span>
                                                    @endif
                                                </label>
                                                <input type="date" id="service_date" name="service_date"
                                                    class="form-control" placeholder="dd/mm/yyyy" />
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">หมายเลขบิล
                                                    @if ($errors->has('bill_number'))
                                                        <span class="text-danger"
                                                            style="font-size: 15px;">({{ $errors->first('bill_number') }})</span>
                                                    @endif
                                                </label>
                                                <input type="text" name="bill_number" class="form-control"
                                                    placeholder="หมายเลขบิล" />
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">จำนวนเงิน
                                                    @if ($errors->has('balance'))
                                                        <span class="text-danger"
                                                            style="font-size: 15px;">({{ $errors->first('balance') }})</span>
                                                    @endif
                                                </label>
                                                <input type="text" name="balance" class="form-control"
                                                    placeholder="จำนวนเงิน (ไม่ต้องใส่เครื่องหมาย ใส่แค่ตัวเลข)" />
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">แนบหลักฐานการใช้บริการ
                                                    @if ($errors->has('file'))
                                                        <span class="text-danger"
                                                            style="font-size: 15px;">({{ $errors->first('file') }})</span>
                                                    @endif
                                                </label>
                                                <input type="file" name="file[]" class="form-control"
                                                    accept=".jpg, .jpeg, .png" multiple />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mt-3">
                                                <input type="hidden" name="member_id" value="{{ $member_id }}">
                                                <input type="hidden" name="admin_id"
                                                    value="{{ Auth::guard('admin')->id() }}">
                                                <input type="hidden" name="date" value="{{ $dateNow }}">
                                                <input type="hidden" name="type" value="ยอดที่ใช้ไป">
                                                <button type="submit" class="btn btn-lg btn-danger">ปรับลดยอดเงิน</button>
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
