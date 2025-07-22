@extends('backend/layouts/staff/template')
<style>
    .addpoint h4 {
        color: #616161e1;
    }

    .addpoint h3 {
        color: #a7a7a7e1;
    }

    .addpoint p {
        font-size: 14px;
    }

    .addpoint span {
        font-size: 14px;
        color: red;
        font-weight: bold;
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
            <h4 class="mt-4">จัดการยอดเงินของสมาชิก Edo Invitation Only</h4>
        </div>
        <div class="addpoint">
            <div class="row">
                <div class="col-lg-12 mt-4 mb-lg-0 mb-4">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if (Session::has('alert-' . $msg))
                                <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                                </p>
                            @endif
                        @endforeach
                    </div>
                    <div class="card z-index-2 mt-2">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h6 class="text-capitalize">1. เลือกลูกค้า <span>* จำเป็น</span></h6>
                            <p>ค้นหาเบอร์โทรศัพท์</p>
                            <form action="{{ url('staff/search-invitation') }}">
                                <div class="row">
                                    <div class="col-md-10">
                                        <input class="phone_format form-control" type="text"
                                            placeholder="ค้นหาเบอร์โทรศัพท์" name="search">
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-outline-primary" type="submit"
                                            id="button-addon2">ค้นหาข้อมูล</button>
                                    </div>
                                </div>
                            </form>
                        </div><br>
                    </div>
                    @if ($search == 'No Search')
                    @elseif($search == '0')
                        <h3 class="mt-4" style="text-align:center;">- - ไม่พบข้อมูลสมาชิก - -</h3>
                    @else
                        @foreach ($members as $member => $value)
                            <center>
                                <a data-bs-toggle="modal" data-bs-target="#delete{{ $value->id }}"
                                    class="mt-4 btn btn-outline-danger btn-sm my-auto" style="color:#ff0000;">
                                    <i class="fa fa-minus-circle" aria-hidden="true"></i> ปรับลดยอดเงิน</a>
                            </center>
                            @php
                                $dateNow = Carbon\Carbon::now()->format('d/m/Y');
                            @endphp
                            <div class="card z-index-2 mt-4">
                                <div class="card-header pb-0 pt-3 bg-transparent">
                                    <div class="row mb-4 mt-4">
                                        <div class="col-md-4">
                                            <center><img src="{{ url('assets/image/profile.png') }}" width="70%;">
                                            </center>
                                        </div>
                                        @php
                                            $member_new = count(
                                                DB::table('members')
                                                    ->where('id', $value->id)
                                                    ->where('created_at', '>', now()->subDays(30)->endOfDay())
                                                    ->get(),
                                            );
                                            $balance = DB::table('invitation_balances')
                                                ->where('member_id', $value->id)
                                                ->where('type', 'เพิ่มยอดเงิน')
                                                ->sum('balance');
                                            if ($value->invitation == 'วงเงิน 500,000') {
                                                $balance = 0.05 * $balance + $balance; // members get an additional 5%
                                            } elseif ($value->invitation == 'วงเงิน 1,000,000') {
                                                $balance = 0.1 * $balance + $balance; // members get an additional 10%
                                            } elseif ($value->invitation == 'วงเงิน 2,000,000') {
                                                $balance = 0.15 * $balance + $balance; // members get an additional 15%
                                            } elseif ($value->invitation == 'วงเงิน 5,000,000') {
                                                $balance = 0.2 * $balance + $balance; // members get an additional 20%
                                            }
                                            $amount_spent = DB::table('invitation_balances')
                                                ->where('member_id', $value->id)
                                                ->where('type', 'ยอดที่ใช้ไป')
                                                ->sum('balance');
                                            $total_balance = $balance - $amount_spent;
                                        @endphp
                                        <div class="col-md-4" style="border-right: 2px dashed #9e9e9e;">

                                            @if ($value->status == 'ONLINE')
                                                <button class="btn btn-success btn-sm my-auto" style="color:#fff;">
                                                    {{ $value->status }}
                                                </button>
                                            @else
                                                <button class="btn btn-danger btn-sm my-auto" style="color:#fff;">
                                                    {{ $value->status }}
                                                </button>
                                            @endif
                                            @if ($member_new != 0)
                                                <button class="btn btn-warning btn-sm my-auto"
                                                    style="color:#fff;">ลูกค้าใหม่</button>
                                            @endif
                                            <h5 class="mt-2">หมายเลขสมาชิก <i class="fa fa-caret-down"
                                                    style="color:#777777;"></i><br>{{ $value->serialnumber }}</h5>
                                            <h5 class="mt-2">หมายเลขบัตรประชาชน <i class="fa fa-caret-down"
                                                    style="color:#777777;"></i>
                                            </h5>
                                            @if ($value->card_id == null)
                                                <a
                                                    href="{{ url('editProfile') }}/{{ $value->id }}">ใส่หมายเลขบัตรประชาชน</a>
                                            @else
                                                <h5>{{ $value->card_id }}</h5>
                                            @endif

                                            <h4>คุณ{{ $value->name }} {{ $value->surname }}</h4>
                                            <h5 class="mb-1">เบอร์โทรศัพท์ <i class="fa fa-caret-right"
                                                    style="color:#777777;"></i> {{ $value->tel }}</h5>
                                            <h5>วัน/เดือน/ปีเกิด <i class="fa fa-caret-right" style="color:#777777;"></i>
                                                {{ $value->bday }}</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <h2>Edo Invitation Only</h2><br>
                                            <h5>ระดับสมาชิก <i class="fa fa-caret-right" style="color:#777777;"></i>
                                                {{ $value->invitation }}</h5>
                                            <h5 class="mb-1">ยอดเงินที่ใช้ได้ <i class="fa fa-caret-right"
                                                    style="color:#777777;"></i>
                                                {{ number_format($total_balance) }} บาท</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Delete-->
                            <div class="modal fade" id="delete{{ $value->id }}" data-bs-backdrop="static"
                                tabindex="-1">
                                <div class="modal-dialog">
                                    <form action="{{ url('staff/delete-balance') }}" method="POST"
                                        enctype="multipart/form-data" class="modal-content">
                                        @csrf
                                        <input type="hidden" name="member_id" value="{{ $value->id }}">
                                        <input type="hidden" name="date" value="{{ $dateNow }}">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteTitle">ปรับลดยอดเงิน</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    @php
                                                        $store_id = DB::table('account_staffs')
                                                            ->where('id', Auth::guard('staff')->id())
                                                            ->value('store_id');
                                                        $store_name = DB::table('account_stores')
                                                            ->where('id', $store_id)
                                                            ->value('store_name');
                                                        $branch = DB::table('account_stores')
                                                            ->where('id', $store_id)
                                                            ->value('branch');
                                                    @endphp
                                                    <label class="form-label">สาขา</label>
                                                    <select name="branch_id" class="form-control">
                                                        <option value="{{ $store_id }}">{{ $store_name }}
                                                            สาขา{{ $branch }}</option>
                                                    </select>
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
                                                        accept=".jpg, .jpeg, .png" multiple/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal"
                                                style="font-family: 'Noto Sans Thai';">ปิด</button>
                                            <input type="hidden" name="staff_id"
                                                value="{{ Auth::guard('staff')->id() }}">
                                            <input type="hidden" name="type" value="ยอดที่ใช้ไป">
                                            <button type="submit" class="btn btn-danger"
                                                style="font-family: 'Noto Sans Thai';">ปรับลดยอดเงิน</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="col-lg-2 mt-4 mb-lg-0 mb-4"></div>
            </div>
        </div>
    </div>


    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        // number phone
        function phoneFormatter() {
            $('input.phone_format').on('input', function() {
                var number = $(this).val().replace(/[^\d]/g, '')
                if (number.length >= 5 && number.length < 10) {
                    number = number.replace(/(\d{3})(\d{2})/, "$1-$2");
                } else if (number.length >= 10) {
                    number = number.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3");
                }
                $(this).val(number)
                $('input.phone_format').attr({
                    maxLength: 12
                });
            });
        };
        $(phoneFormatter);
    </script>
@endsection
