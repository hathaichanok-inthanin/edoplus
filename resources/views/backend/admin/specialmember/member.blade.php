@extends('backend/layouts/admin/template')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
<style>
    .member-list h4 {
        color: #fff;
    }

    .member-list p {
        font-size: 14px;
    }

    .member-list span {
        font-size: 14px;
        color: red;
        font-weight: bold;
    }

    .member-list h6 {
        text-align: center;
    }

    .header h4 {
        color: #fff;
        border-bottom: 2px solid #eeeeee;
        padding-bottom: 15px;
    }
</style>
@section('content')
    @php

        $count_member = number_format(DB::table('members')->count());
        $count_member_online = number_format(DB::table('members')->where('status', 'online')->count());
        $count_member_offline = number_format(DB::table('members')->where('status', '!=', 'online')->count());

    @endphp
    <div class="container-fluid py-4">
        <div class="header">
            <h4>SPECIAL MEMBER</h4>
        </div>
        {{-- <div class="member-list">
            <div class="row">
                <div class="col-lg-5 mt-4 mb-lg-0 mb-4">
                    <form action="{{ url('/search-member-invitation') }}">
                        <div class="card z-index-2">
                            <div class="card-header pb-0 pt-3 bg-transparent">
                                <h6 class="text-capitalize">ค้นหาเบอร์โทรศัพท์</h6>
                                <div class="row mb-2">
                                    <div class="col-md-9">
                                        <input class="phone_format form-control" type="text"
                                            placeholder="ค้นหาเบอร์โทรศัพท์" name="search">
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-outline-primary" type="submit"
                                            id="button-addon2">ค้นหาข้อมูล</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
    </div>

    <div class="container-fluid py-4">

        <div class="member-list">
            <div class="row">
                <div class="col-lg-12 mb-lg-0 mb-4 mt-4">
                    <div class="card z-index-2 h-100">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h5 class="text-capitalize">รายชื่อสมาชิก</h5>
                        </div>
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table align-items-center">
                                    <thead class="thead-light">
                                        <tr style="text-align: center;">
                                            <th>ลำดับ</th>
                                            <th>หมายเลขสมาชิก</th>
                                            <th>เบอร์โทร</th>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>ยอดเงินที่ใช้ได้</th>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @if ($members->count())
                                            @foreach ($members as $member => $value)
                                                @php
                                                    $dateNow = Carbon\Carbon::now()->format('d/m/Y');
                                                @endphp
                                                <tr style="text-align:center;">
                                                    <td>{{ $NUM_PAGE * ($page - 1) + $member + 1 }}</td>
                                                    <td>{{ $value->serialnumber }}</td>
                                                    <td>{{ $value->tel }}</td>
                                                    <td>{{ $value->name }} {{ $value->surname }}</td>
                                                    <td>
                                                        @php
                                                            $balance = DB::table('specialmember_balances')
                                                                ->where('member_id', $value->id)
                                                                ->where('type', 'เพิ่มยอดเงิน')
                                                                ->sum('balance');
                                                            $amount_spent = DB::table('specialmember_balances')
                                                                ->where('member_id', $value->id)
                                                                ->where('type', 'ยอดที่ใช้ไป')
                                                                ->sum('balance');
                                                            $total_balance = $balance - $amount_spent;
                                                        @endphp
                                                        {{ number_format($total_balance) }}
                                                        <a
                                                            href="{{ url('add-balance-specialmember') }}/{{ $value->id }}"><i
                                                                class="fas fa-edit" style="color:red;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('delete-balance-specialmember') }}/{{ $value->id }}"
                                                            class="btn btn-outline-danger btn-sm my-auto"
                                                            style="color:#ff0000;">
                                                            <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                                            ปรับลดยอดเงิน</a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('member/profile') }}/{{ $value->id }}"
                                                            class="mt-2 btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                                                class="ni ni-bold-right" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
    </script> --}}
@endsection
