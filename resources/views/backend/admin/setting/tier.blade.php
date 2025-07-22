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
            <h4>ระดับของสมาชิก</h4>
        </div>
        <a data-bs-toggle="modal" data-bs-target="#settingTier" data-bs-toggle="modal" data-bs-target="#settingTier"
            class="btn btn-success mt-5" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i>
            สร้างระดับสมาชิก</a>
    </div>
    <div class="container-fluid py-4">
        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if (Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                @endif
            @endforeach
        </div>
        <div class="reward">
            <div class="row">
                <div class="col-lg-12 mb-lg-0 mb-4">
                    <div class="card z-index-2 h-100">
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table align-items-center">
                                    <thead class="thead-light">
                                        <tr style="text-align: center;">
                                            <th>#</th>
                                            <th>ระดับสมาชิก</th>
                                            <th>รายละเอียด</th>
                                            <th>คะแนนเริ่มต้น</th>
                                            <th>คะแนนสูงสุด</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach ($tiers as $tier => $value)
                                            <tr style="text-align:center;">
                                                <td>{{ $NUM_PAGE * ($page - 1) + $tier + 1 }}</td>
                                                <td>{{ $value->tier }}</td>
                                                <td>{{ $value->detail }}</td>
                                                <td>{{ $value->min_price }}</td>
                                                <td>{{ $value->max_price }}</td>
                                                <td>

                                                    <a href="{{ url('/edit-tier') }}/{{ $value->id }}"><i
                                                            class="fas fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="{{ url('/tier-delete') }}/{{ $value->id }}"
                                                        onclick="return confirm('คุณต้องการลบระดับสมาชิกใช่หรือไม่ ?')"><i
                                                            class="fas fa-trash-alt" style="color: red;"></i></a>
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
    <!-- Modal -->
    <div class="modal fade" id="settingTier" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ url('addtier') }}" method="POST" enctype="multipart/form-data" class="modal-content">@csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="settingTierTitle">เพิ่มระดับสมาชิก</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">ชื่อระดับ</label>
                            <input type="text" name="tier" class="form-control"
                                placeholder="เช่น SILVER, GOLD, BLACK" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">คำอธิบายระดับสมาชิก</label>
                            <textarea name="detail" class="form-control"
                                placeholder="เช่น ระดับ SILVER สมาชิกที่มียอดค่าใช้จ่ายตั้งแต่ 0-200000 บาท"></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">ยอดค่าใช้จ่ายเริ่มต้น</label>
                            <input type="text" name="min_price" class="form-control"
                                placeholder="เช่น 0 ( ยอดสะสมที่เป็นค่าเริ่มต้นของระดับ SILVER ยอดค่าใช้จ่าย 0.- )" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">ยอดค่าใช้จ่ายสูงสุด</label>
                            <input type="text" name="max_price" class="form-control"
                                placeholder="เช่น 200000 ( ยอดสะสมที่เป็นค่าสูงสุดของระดับ ยอดค่าใช้จ่าย 200000.- )" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                        style="font-family:'Noto Sans Thai';">ปิด</button>
                    <button type="submit" class="btn btn-primary"
                        style="font-family:'Noto Sans Thai';">เพิ่มระดับสมาชิก</button>
                </div>
            </form>
        </div>
    </div>
@endsection
