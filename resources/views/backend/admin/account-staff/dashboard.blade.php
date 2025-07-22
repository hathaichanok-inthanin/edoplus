@extends("backend/layouts/admin/template")

@section("content")
<div class="container-fluid py-4">
  <div class="row">   
    <div class="col-lg-5 mb-lg-0 mb-4">
        <a href="javascript:history.back();" style="color:#fff;"><i class="ni ni-bold-left"></i> ย้อนกลับ</a>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-md-2"></div>
    <div class="col-lg-8 mb-lg-0 mb-4">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
          <h6 class="text-capitalize">ข้อมูลบัญชีพนักงาน {{$store_name}} {{$branch}}</h6>
        </div>
        <div class="card-body p-3">
          <div class="table-responsive">
            <table class="table align-items-center">
                <thead class="thead-light">
                  <tr style="text-align: center;">
                    <th>#</th>
                    <th>ชื่อ</th>
                    <th>ตำแหน่ง</th>
                    <th>ชื่อเข้าใช้งาน</th>
                    <th>รหัสผ่าน</th>
                    <th>สถานะ</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody class="list">
                  @foreach ($account_staffs as $account_staff => $value)
                    <tr style="text-align:center;">
                      <td>{{$NUM_PAGE*($page-1) + $account_staff+1}}</td>
                      <td>{{$value->name}}</td>
                      <td>{{$value->position}}</td>
                      <td>{{$value->username}}</td>
                      <td>{{$value->password_name}}</td>
                      @if($value->status == "เปิด")
                        <td style="color:green">{{$value->status}}</td>
                      @else 
                        <td style="color:red">{{$value->status}}</td>
                      @endif
                      <td>
                        <a href="{{url('/edit-account-staff')}}/{{$value->id}}" style="color:blue;"><i class="ni ni-settings" aria-hidden="true"></i></a>
                      </td>
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