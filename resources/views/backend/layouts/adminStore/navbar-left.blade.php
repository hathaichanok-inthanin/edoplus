@php
    $image = DB::table('account_stores')
        ->where('id', Auth::guard('admin-store')->user()->id)
        ->value('image');
    $store_name = DB::table('account_stores')
        ->where('id', Auth::guard('admin-store')->user()->id)
        ->value('store_name');
    $branch = DB::table('account_stores')
        ->where('id', Auth::guard('admin-store')->user()->id)
        ->value('branch');
@endphp
<div class="min-height-300 bg-primary position-absolute w-100"></div>
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ url('/dashboard') }}">
            <div class="img-navbar-brand">
                <img src="{{ asset('assets/image/logo.png') }}" class="navbar-brand-img h-100" alt="edoplus">
            </div>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="{{ url('admin/dashboard') }}"
                    class="nav-link d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-chart-pie me-2"></i> ภาพรวม (Dashboard)
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/addpoint') }}"
                    class="nav-link d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fab fa-product-hunt me-2"></i> เพิ่มพอยท์
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                    href="#invitation" role="button" aria-expanded="false" aria-controls="invitation">
                    <span>
                        <i class="fas fa-hand-holding-heart me-2"></i> Edo Invitation Only
                    </span>
                </a>
                <div class="collapse" id="invitation">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('admin/invitation/manage-balance') }}"><i
                                    class="fas fa-coins me-2"></i>จัดการยอดเงิน</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                    href="#specialmember" role="button" aria-expanded="false" aria-controls="specialmember">
                    <span>
                        <i class="fas fa-user-tie me-2"></i> ลูกค้ากลุ่มพิเศษ
                    </span>
                </a>
                <div class="collapse" id="specialmember">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('admin/specialmember/member') }}"><i
                                    class="fas fa-user me-2"></i>ข้อมูลสมาชิก</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/search-member-coupon') }}"
                    class="nav-link d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-ticket-alt me-2"></i> คูปอง
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/account-staff') }}"
                    class="nav-link d-flex justify-content-between align-items-center">
                    <span>
                        <i class="ni ni-single-02 me-2"></i> บัญชีพนักงาน
                    </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.logout') }}"
                    onclick="event.preventDefault();
        document.getElementById('logout-form').submit();"
                    class="nav-link d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-sign-out-alt me-2"></i> ออกจากระบบ
                    </span>
                </a>
                <form id="logout-form"
                    action="{{ 'App\AccountStore' == Auth::getProvider()->getModel() ? route('admin-store.logout') : route('admin-store.logout') }}"
                    method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</aside>
