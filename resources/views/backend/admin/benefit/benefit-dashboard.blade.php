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
        font-size: 14px;
    }

    .campaign span {
        font-size: 14px;
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
        <div class="campaign mt-4">
            <h4>สิทธิประโยชน์สมาชิก</h4>
        </div>
        <a href="{{ url('/create-benefit') }}" class="btn btn-success mt-5" type="submit"><i class="fa fa-plus-circle"
                aria-hidden="true"></i> เพิ่มสิทธิประโยชน์</a>
        <a href="{{ url('/benefit') }}" class="btn btn-secondary mt-5" type="submit"><i class="fas fa-ticket-alt"
                aria-hidden="true"></i> สิทธิประโยชน์ทั้งหมด</a>
    </div>
    <div class="container-fluid py-4">
        <div class="campaign">
            <div class="row">
                <div class="col-lg-12 mb-lg-0 mb-4">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if (Session::has('alert-' . $msg))
                                <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                                </p>
                            @endif
                        @endforeach
                    </div>
                    <div class="z-index-2 h-100">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($benefits as $benefit => $value)
                                    <div class="col-md-3 mt-5">
                                        <div class="card">
                                            <div class="card-body">
                                                <img src="{{ url('images/benefit') }}/{{ $value->image }}"
                                                    class="img-responsive" width="100%">
                                                <h5 class="mb-0 mt-3 mb-3">
                                                    {{ $value->name }}</h5>
                                                <p>สถานะ <i class="fa fa-caret-right" style="color:#777777;"></i>
                                                    {{ $value->status }}
                                                </p>
                                                <div class="col" style="text-align: right;">
                                                    <a href="{{ url('benefit-edit/') }}/{{ $value->id }}"
                                                        class="btn btn-outline-primary radius-15"><i class="fas fa-edit"
                                                            aria-hidden="true"></i></a>
                                                    <a href="{{ url('/benefit-delete') }}/{{ $value->id }}"
                                                        onclick="return confirm('Are you sure to delete ?')"
                                                        class="btn btn-outline-primary radius-15"><i class="fa fa-trash"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
