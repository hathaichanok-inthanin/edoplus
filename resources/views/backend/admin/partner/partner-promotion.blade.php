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

    .partner a{
        color: #ffffff;
    }

    .partner a:hover{
        color: #ffffff;
    }
</style>
@section('content')
    @php
        $partner = DB::table('partner_shops')
            ->where('id', $id)
            ->value('name');
        $branch = DB::table('partner_shops')
            ->where('id', $id)
            ->value('branch');
    @endphp
    <div class="container-fluid py-4">
        <div class="partner">
            <div class="row">
                <div class="col-lg-5 mb-lg-0 mb-4">
                    <a href="javascript:history.back();"><i class="ni ni-bold-left"></i> ย้อนกลับ</a>
                </div>
            </div>
            <h4 class="mt-4">โปรโมชั่นเครือข่ายพันธมิตร {{ $partner }} สาขา{{$branch}}</h4>
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
        <div class="reward">
            <div class="row">
                <div class="col-lg-12 mb-lg-0 mb-4">
                    <div class="card z-index-2 h-100">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h6 class="text-capitalize">โปรโมชั่นเครือข่ายพันธมิตร</h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table align-items-center">
                                    <thead class="thead-light">
                                        <tr style="text-align: center;">
                                            <th>#</th>
                                            <th>โปรโมชั่น</th>
                                            <th>รูปภาพ</th>
                                            <th>สถานะ</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach ($promotions as $promotion => $value)
                                            <tr style="text-align:center;">
                                                <td>{{ $NUM_PAGE * ($page - 1) + $promotion + 1 }}</td>
                                                <td>{!! $value->promotion !!}</td>
                                                <td><a href="{{url('/images/partner')}}/{{$value->image}}" class="singleImage2"><i
                                                    class="fas fa-images" style="color: green;"></i></a></td> 
                                                <td>{{ $value->status }}</td>
                                                <td>
                                                    <a href="{{ url('/promotion-edit') }}/{{ $value->id }}"><i
                                                            class="fas fa-edit" style="color: green;"></i></a>
                                                    <a href="{{ url('/delete-promotion') }}/{{ $value->id }}"
                                                        onclick="return confirm('Are you sure to delete ?')"><i
                                                            class="fas fa-trash" style="color: red;"></i></a>
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
