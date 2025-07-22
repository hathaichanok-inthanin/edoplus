@extends('backend/layouts/admin/template')
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
    <div class="container-fluid py-4">
        <div class="member-list">
            <div class="row">
                <div class="col-lg-12 mb-lg-0 mb-4 mt-4">
                    <div style="text-align: right;">
                        <form id="exportForm" method="POST" action="{{ url('/report/export-point') }}">
                            @csrf
                            <input type="hidden" name="export_data" id="exportData">
                            <button id="exportVisible" class="btn btn-md btn-success"><i class="fa fa-download"></i>
                                EXPORT
                                EXCEL</button>
                        </form>
                    </div>
                    <div class="card z-index-2 h-100">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h5 class="text-capitalize">ประวัติการจัดการพอยท์</h5>
                        </div>
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table align-items-center" id="data-table">
                                    <thead class="thead-light">
                                        <tr style="text-align: center;">
                                            <th>ลำดับ</th>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>เบอร์โทร</th>
                                            <th>การจัดการ</th>
                                            <th>หมายเลขบิล</th>
                                            <th>จำนวนพอยท์</th>
                                            <th>สาขาที่ทำรายการ</th>
                                            <th>ผู้ทำรายการ</th>
                                            <th>วันที่ทำรายการ</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="data-wrapper">
                                        @foreach ($points as $index => $value)
                                            @php
                                                $name = DB::table('members')
                                                    ->where('id', $value->member_id)
                                                    ->value('name');
                                                $surname = DB::table('members')
                                                    ->where('id', $value->member_id)
                                                    ->value('surname');
                                                $tel = DB::table('members')
                                                    ->where('id', $value->member_id)
                                                    ->value('tel');
                                                $point = floor($value->price / 100);
                                                $store_name = DB::table('account_stores')
                                                    ->where('id', $value->branch_id)
                                                    ->value('store_name');
                                                $branch = DB::table('account_stores')
                                                    ->where('id', $value->branch_id)
                                                    ->value('branch');
                                                $admin_name = DB::table('admins')
                                                    ->where('id', $value->admin_id)
                                                    ->value('name');
                                                $store_name = DB::table('account_stores')
                                                    ->where('id', $value->store_id)
                                                    ->value('store_name');
                                                $store_branch = DB::table('account_stores')
                                                    ->where('id', $value->store_id)
                                                    ->value('branch');
                                                $staff_name = DB::table('account_staffs')
                                                    ->where('id', $value->staff_id)
                                                    ->value('name');
                                            @endphp
                                            <tr style="text-align:center;">
                                                <td>{{ $NUM_PAGE * ($page - 1) + $index + 1 }}</td>
                                                <td>{{ $name }} {{ $surname }}</td>
                                                <td>{{ $tel }}</td>
                                                <td>{{ $value->type }}</td>
                                                <td>{{ $value->bill_number }}</td>
                                                <td>{{ $point }}</td>
                                                <td>{{ $store_name }} สาขา{{ $branch }}</td>
                                                <td>
                                                    @if ($value->admin_id != null)
                                                        {{ $admin_name }}
                                                    @elseif($value->store_id != null)
                                                        {{ $store_name }} สาขา{{ $store_branch }}
                                                    @elseif($value->staff_id != null)
                                                        {{ $staff_name }}
                                                    @endif
                                                </td>
                                                <td>{{ $value->date }}</td>
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
    <script>
        document.querySelector("#exportForm").addEventListener("submit", function(e) {
            const rows = document.querySelectorAll("#data-table tbody tr");
            const visibleData = [];

            rows.forEach(row => {
                if (row.offsetParent !== null) {
                    const rowData = [];
                    row.querySelectorAll("td").forEach(cell => {
                        rowData.push(cell.textContent.trim());
                    });
                    visibleData.push(rowData);
                }
            });
            document.getElementById("exportData").value = JSON.stringify(visibleData);
        });
    </script>
@endsection
