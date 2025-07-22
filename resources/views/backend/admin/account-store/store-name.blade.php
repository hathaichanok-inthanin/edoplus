@extends("backend/layouts/admin/template")

@section("content")
<div class="container-fluid py-4">
  <div class="row">   
    <div class="col-lg-5 mb-lg-0 mb-4">
        <a href="javascript:history.back();" style="color:#fff;"><i class="ni ni-bold-left"></i> ย้อนกลับ</a>
    </div>
  </div>
  <div class="row mt-4">
    @foreach ($account_stores as $account_store => $value)
      <div class="col-md-4 mt-4">
        <div class="card">
          <div class="card-body p-3">
            <center><h4>{{$value->store_name}} {{$value->branch}} <span style="font-size: 18px;"><a href="{{url('/edit-account-store')}}/{{$value->id}}"><i class="fa fa-pencil-square"></i></a></span></h4></center>
            <div class="row">
                <div class="col-md-6">
                    <label>Username</label>
                    <input type="text" class="form-control" value="{{$value->username}}">
                </div>
                <div class="col-md-6">
                    <label>Password</label>
                    <input type="text" class="form-control" value="{{$value->password_name}}">
                </div>
            </div>
            <center><a href="{{url('/create-account-staff')}}/{{$value->store_name}}/{{$value->branch}}" class="btn btn-primary btn-block mt-3">สร้างบัญชีพนักงาน {{$value->store_name}} {{$value->branch}}</a></center>
            <center><a href="{{url('/account-staff')}}/{{$value->store_name}}/{{$value->branch}}" class="btn btn-success btn-block">บัญชีพนักงาน {{$value->store_name}} {{$value->branch}}</a></center>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection