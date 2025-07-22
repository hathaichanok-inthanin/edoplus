@extends('backend/layouts/admin/template')
<style>
    .partner h4 {
        color: #fff;
        border-bottom: 2px solid #eeeeee;
        padding-bottom: 15px;
    }

    .partner h3 {
        color: #a7a7a7e1;
    }

    .partner p {
        font-size: 14px;
    }

    .partner span {
        font-size: 20px;
        color: red;
        font-weight: bold;
    }
</style>
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-5 mb-lg-0 mb-4">
                <a href="javascript:history.back();" style="color:#fff;"><i class="ni ni-bold-left"></i> ย้อนกลับ</a>
            </div>
        </div>
        <div class="partner mt-4">
            <h4>เครือข่ายพันธมิตร</h4>
        </div>
        <a href="{{ url('/create-partner') }}" class="btn btn-success mt-5"><i class="fa fa-plus-circle"
                aria-hidden="true"></i> สร้างพันธมิตร</a>
        <a href="{{ url('/report-partner') }}" class="btn btn-success mt-5"><i class="fas fa-folder-open"
                aria-hidden="true"></i> รายงานข้อมูลร้านค้าพันธมิตร</a><br>
        <a href="{{ url('/partner') }}" class="btn btn-secondary mt-5"><i class="fas fa-handshake"
                aria-hidden="true"></i> พันธมิตรทั้งหมด</a>
        <a href="{{ url('/partner-off') }}" class="btn btn-danger mt-5"><i class="fa fa-hourglass-half"
                aria-hidden="true"></i> ปิดการใช้งาน</a>
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
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h6 class="text-capitalize">ข้อมูลเครือข่ายพันธมิตร</h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table align-items-center">
                                    <thead class="thead-light">
                                        <tr style="text-align: center;">
                                            <th>#</th>
                                            <th>พันธมิตร</th>
                                            <th>สาขา</th>
                                            <th>เบอร์โทรศัพท์</th>
                                            <th>ประเภทพันธมิตร</th>
                                            <th>สถานะ</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach ($partners as $partner => $value)
                                            <tr style="text-align:center;">
                                                <td>{{ $NUM_PAGE * ($page - 1) + $partner + 1 }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->branch }}</td>
                                                <td>{{ $value->tel }}</td>
                                                <td>{{ $value->type }}</td>
                                                <td>{{ $value->status }}</td>
                                                <td><a href="{{ url('/partner-promotion') }}/{{ $value->id }}"><i
                                                            class="fas fa-folder-open" style="color: green;"></i></a>
                                                    <a href="{{ url('/partner-add-promotion') }}/{{ $value->id }}"><i
                                                            class="fa fa-plus-circle" style="color: green;"></i></a>
                                                    <a href="{{ url('/partner-edit') }}/{{ $value->id }}"><i
                                                            class="fas fa-edit" style="color: red;"></i></a>
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
@endsection
