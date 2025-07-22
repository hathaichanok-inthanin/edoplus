@extends('backend/layouts/admin/template')

@section('content')
    <div class="container-fluid py-4">
        <div class="member-list">
            <div class="row">
                <div class="col-lg-5 mt-4 mb-lg-0 mb-4">
                    <form action="{{ url('/report/birthMonth') }}">
                        <div class="card z-index-2">
                            <div class="card-header pb-0 pt-3 bg-transparent">
                                <h6 class="text-capitalize">เลือกเดือนเกิด</h6>
                                <div class="row mb-2">
                                    <div class="col-md-9">
                                        <select name="month" id="month" class="form-select">
                                            <option value="01">มกราคม</option>
                                            <option value="02">กุมภาพันธ์</option>
                                            <option value="03">มีนาคม</option>
                                            <option value="04">เมษายน</option>
                                            <option value="05">พฤษภาคม</option>
                                            <option value="06">มิถุนายน</option>
                                            <option value="07">กรกฎาคม</option>
                                            <option value="08">สิงหาคม</option>
                                            <option value="09">กันยายน</option>
                                            <option value="10">ตุลาคม</option>
                                            <option value="11">พฤศจิกายน</option>
                                            <option value="12">ธันวาคม</option>
                                        </select>
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
        </div>
    </div>
    <div class="container-fluid">
        <div style="text-align: right;">
            <form id="exportForm" method="POST" action="{{ url('/report/export-birthMonth') }}">
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
                                <th>ชื่อ-นามสกุล</th>
                                <th>เบอร์โทร</th>
                                <th>วัน/เดือน/ปีเกิด</th>
                                <th>วันที่สมัครสมาชิก</th>
                            </tr>
                        </thead>
                        <tbody class="list" id="data-wrapper">
                            @php
                                $months = [
                                    '01' => 'มกราคม',
                                    '02' => 'กุมภาพันธ์',
                                    '03' => 'มีนาคม',
                                    '04' => 'เมษายน',
                                    '05' => 'พฤษภาคม',
                                    '06' => 'มิถุนายน',
                                    '07' => 'กรกฎาคม',
                                    '08' => 'สิงหาคม',
                                    '09' => 'กันยายน',
                                    '10' => 'ตุลาคม',
                                    '11' => 'พฤศจิกายน',
                                    '12' => 'ธันวาคม',
                                ];
                                $monthName = $months[$month] ?? $month;
                            @endphp
                            <h5>ข้อมูลสมาชิกที่เกิดในเดือน{{ $monthName }}</h5>
                            @if (count($members) == 0)
                                <tr>
                                    <td colspan="6" style="text-align: center;">ไม่พบข้อมูลสมาชิกที่เกิดในเดือนนี้</td>
                                </tr>
                            @else
                                @foreach ($members as $member => $value)
                                    @php
                                        $time = strtotime($value->bday);
                                        $time_format = date('d/m/Y', $time);
                                    @endphp
                                    <tr style="text-align:center;">
                                        <td>{{ $NUM_PAGE * ($page - 1) + $member + 1 }}</td>
                                        <td>{{ $value->serialnumber }}</td>
                                        <td>{{ $value->name }} {{ $value->surname }}</td>
                                        <td>{{ $value->tel }}</td>
                                        <td>{{ $time_format }}</td>
                                        <td>{{ $value->date }}</td>
                                    </tr>
                                @endforeach
                            @endif
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
