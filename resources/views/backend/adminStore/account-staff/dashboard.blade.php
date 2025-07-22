@extends("backend/layouts/adminStore/template")
<style>
  .header h4{
    color: #fff;
    border-bottom: 2px solid #eeeeee;
    padding-bottom: 15px;
}
</style>
@section("content")
<div class="container-fluid py-4">
  <div class="header">
    <h4>บัญชีพนักงาน</h4>
  </div>
  <a href="{{url('admin/create-account-staff')}}" class="btn btn-success mt-2" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มบัญชีพนักงาน</a><br>
  <div class="row mt-4">
    <div class="col-md-2"></div>
    <div class="col-lg-8 mb-lg-0 mb-4">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
          <h6 class="text-capitalize">ข้อมูลบัญชีพนักงาน </h6>
        </div>
        <div class="card-body p-3">
          <div class="table-responsive">
            <table class="table align-items-center">
                <thead class="thead-light">
                  <tr style="text-align: center;">
                    <th>#</th>
                    <th>ชื่อพนักงาน</th>
                    <th>ชื่อเข้าใช้งาน</th>
                    <th>สถานะ</th>
                  </tr>
                </thead>
                <tbody class="list">
                  @foreach ($account_staffs as $account_staff => $value)
                    <tr style="text-align:center;">
                      <td>{{$NUM_PAGE*($page-1) + $account_staff+1}}</td>
                      <td>{{$value->name}}</td>
                      <td>{{$value->username}}</td>
                      <td>{{$value->status}}</td>
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