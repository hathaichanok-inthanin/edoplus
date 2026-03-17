<style>
    .hr {
        border-top: 1px solid #eeeeee;
    }
</style>
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
                <a href="{{ url('/dashboard') }}" class="nav-link d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-chart-pie me-2"></i> ภาพรวม (Dashboard)
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/addpoint') }}" class="nav-link d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fab fa-product-hunt me-2"></i> เพิ่มพอยท์
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/member/list') }}" class="nav-link d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fa fa-users me-2"></i> ข้อมูลสมาชิกทั้งหมด
                    </span>
                </a>
            </li>
            @if(Auth::guard('admin')->user()->role == "ผู้ดูแลระบบหลัก")
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
                                <a class="nav-link" href="{{ url('/invitation/member') }}"><i
                                        class="fas fa-user me-2"></i>ข้อมูลสมาชิก</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/invitation/manage-balance') }}"><i
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
                                <a class="nav-link" href="{{ url('/specialmember/member') }}"><i
                                        class="fas fa-user me-2"></i>ข้อมูลสมาชิก</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            <li class="nav-item hr">
                <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                    href="#privilege" role="button" aria-expanded="false" aria-controls="privilege">
                    <span>
                        <i class="fas fa-gifts me-2"></i> สิทธิพิเศษ
                    </span>
                </a>
                <div class="collapse" id="privilege">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/benefit') }}"><i
                                    class="fas fa-hand-holding-heart me-2"></i>สิทธิประโยชน์สมาชิก</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/campaign') }}"><i
                                    class="fas fa-ticket-alt me-2"></i>คูปอง</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/reward') }}"><i
                                    class="fa fa-gift me-2"></i>ของรางวัล</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/partner') }}"><i
                                    class="fas fa-handshake me-2"></i>เครือข่ายพันธมิตร</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                    href="#report" role="button" aria-expanded="false" aria-controls="report">
                    <span>
                        <i class="fas fa-folder-open me-2"></i> รายงานสรุป
                    </span>
                </a>
                <div class="collapse" id="report">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/report/birthMonth') }}"><i
                                    class="fa fa-file-excel me-2"></i>ข้อมูลเดือนเกิด</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/report/member') }}"><i
                                    class="fa fa-file-excel me-2"></i>ข้อมูลสมาชิกทั้งหมด</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/report/point') }}"><i
                                    class="fa fa-file-excel me-2"></i>ประวัติการจัดการพอยท์</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                    href="#setting" role="button" aria-expanded="false" aria-controls="setting">
                    <span>
                        <i class="fa fa-cogs me-2"></i> การตั้งค่า
                    </span>
                </a>
                <div class="collapse" id="setting">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/article') }}"><i
                                    class="fas fa-newspaper me-2"></i>บทความและข่าวสาร</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/media') }}"><i
                                    class="fas fa-images me-2"></i>Media</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/account-store') }}"><i
                                    class="fas fa-store me-2"></i>ข้อมูลบัญชีร้านค้า</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/tier') }}"><i
                                    class="fas fa-stream me-2"></i>ระดับสมาชิก</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item hr">
                <a href="{{ route('admin.logout') }}"
                    onclick="event.preventDefault();
        document.getElementById('logout-form').submit();"
                    class="nav-link d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-sign-out-alt me-2"></i> ออกจากระบบ
                    </span>
                </a>
                <form id="logout-form"
                    action="{{ 'App\Admin' == Auth::getProvider()->getModel() ? route('admin.logout') : route('admin.logout') }}"
                    method="POST" style="display: none;">
                    @csrf
                </form>
            </li>

        </ul>
    </div>
</aside>
