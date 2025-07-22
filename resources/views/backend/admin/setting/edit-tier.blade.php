@extends('backend/layouts/admin/template')
<style>
    .tier h4 {
        color: #fff;
        border-bottom: 2px solid #eeeeee;
        padding-bottom: 15px;
    }
</style>
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-5 mb-lg-0 mb-4">
                <a href="javascript:history.back();" style="color:#fff;"><i class="ni ni-bold-left"></i> ย้อนกลับ</a>
            </div>
        </div>
        <div class="tier mt-4">
            <h4>แก้ไขระดับของสมาชิก</h4>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if (Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                @endif
            @endforeach
        </div>
        <div class="card z-index-2">
            <form action="{{ url('update-tier') }}" enctype="multipart/form-data" method="post">@csrf
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">ชื่อระดับ</label>
                            <input type="text" name="tier" class="form-control" placeholder="เช่น SILVER, GOLD, BLACK"
                                value={{ $tier->tier }} />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">คำอธิบายระดับสมาชิก</label>
                            <textarea name="detail" class="form-control"
                                placeholder="เช่น ระดับ SILVER สมาชิกที่มียอดค่าใช้จ่ายตั้งแต่ 0-200000 บาท">{{ $tier->detail }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">ยอดค่าใช้จ่ายเริ่มต้น</label>
                            <input type="text" name="min_price" class="form-control"
                                placeholder="เช่น 0 ( ยอดสะสมที่เป็นค่าเริ่มต้นของระดับ SILVER ยอดค่าใช้จ่าย 0.- )"
                                value={{ $tier->min_price }} />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">ยอดค่าใช้จ่ายสูงสุด</label>
                            <input type="text" name="max_price" class="form-control"
                                placeholder="เช่น 200000 ( ยอดสะสมที่เป็นค่าสูงสุดของระดับ ยอดค่าใช้จ่าย 200000.- )"
                                value={{ $tier->max_price }} />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <input type="hidden" name="id" value="{{ $tier->id }}">
                            <button type="submit" class="btn btn-lg btn-success">แก้ไขระดับสมาชิก</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
