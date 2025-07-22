@extends("backend/layouts/admin/template")
<style>
  .header h4{
    color: #fff;
    border-bottom: 2px solid #eeeeee;
    padding-bottom: 15px;
}
</style>
@section("content")
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-lg-5 mb-lg-0 mb-4">
        <a href="javascript:history.back();" style="color:#fff;"><i class="ni ni-bold-left"></i> ย้อนกลับ</a>
    </div>
</div>
  <div class="header mt-4">
    <h4>บัญชีร้านค้า</h4>
  </div>
  <div class="row mt-4">
    <div class="col-xl-2"></div>
    <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-12">
              <div class="numbers">
                <h5 class="font-weight-bolder center">
                    <a href="{{url('/create-account-store')}}">สร้างบัญชีร้านค้า</a>
                </h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-12">
              <div class="numbers">
                <h5 class="font-weight-bolder center">
                    <a href="{{url('/account-store')}}">ข้อมูลบัญชีร้านค้า</a>
                </h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3"></div>
  </div>
  <div class="row mt-4">
    <div class="col-md-2"></div>
    <div class="col-lg-8 mb-lg-0 mb-4">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
          <h6 class="text-capitalize">ข้อมูลบัญชีร้านค้า</h6>
        </div>
        <div class="card-body p-3">
          <div class="table-responsive">
            <table class="table align-items-center">
                <thead class="thead-light">
                  <tr style="text-align: center;">
                    <th>#</th>
                    <th>ร้านค้า</th>
                    <th>จำนวนสาขา</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody class="list">
                  @foreach ($account_stores as $account_store => $value)
                    <tr style="text-align:center;">
                      <td>{{$NUM_PAGE*($page-1) + $account_store+1}}</td>
                      <td>{{$value->store_name}}</td>
                      <td>{{$value->countBranch}}</td>
                      <td><a href="{{url('/account-store')}}/{{$value->store_name}}"><i class="fa fa-caret-right"></i></a></td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-2"></div>
  </div>
</div>
@endsection