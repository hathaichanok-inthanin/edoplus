@extends('frontend/layouts/template')

@section('content')
    <div class="container" style="padding-bottom: 50px;">
        <h1 class="header-title text-center" style="padding-top:5rem;">
            <strong>{{ $benefit->name }}</strong>
        </h1>
        <div class="row mt-5">
            <div class="col-md-7">
                <img src="{{ url('/images/benefit') }}/{{ $benefit->image }}" class="img-responsive" width="100%">
            </div>
            <div class="col-md-5">
                <h1 style="font-size: 30px;" class="mt-3 text-center">รายละเอียดสิทธิประโยชน์</h1>
                <p style="line-height: 1.6em; font-size: 1.3em;">
                    {!! $benefit->detail !!}
                </p>
            </div>
        </div>

    </div>
@endsection
