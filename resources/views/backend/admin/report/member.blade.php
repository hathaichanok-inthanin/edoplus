@extends('backend/layouts/admin/template')

@section('content')
    <div class="container-fluid">
        <div style="text-align: right;">
            <form id="exportForm" method="POST" action="{{ url('/report/export-member') }}">
                @csrf
                <input type="hidden" name="export_data" id="exportData">
                <button id="exportVisible" class="btn btn-md btn-success"><i class="fa fa-download"></i>
                    EXPORT
                    EXCEL</button>
            </form>
        </div>
        <div class="card z-index-2">
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table align-items-center" id="data-table">
                        <thead class="thead-light">
                            <tr style="text-align: center;">
                                <th>ลำดับ</th>
                                <th>หมายเลขสมาชิก</th>
                                <th>เบอร์โทร</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th>พอยท์</th>
                                <th>ระดับสมาชิก</th>
                                <th>วันที่สมัคร</th>
                                <th>สถานะ</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="list" id="data-wrapper">
                            @include('backend/admin/member/data')
                        </tbody>
                    </table>
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
