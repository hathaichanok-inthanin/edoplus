<header id="header" class="fixed-top header d-flex align-items-center">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
        <a href="{{ url('/') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('frontend_main/assets/img/logo.png') }}" alt="edoplus">
        </a>
        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ url('/') }}">หน้าหลัก</a></li>
                <li><a href="{{ url('about-us') }}">เกี่ยวกับเรา</a></li>
                <li><a href="{{ url('alliance') }}">สิทธิประโยชน์สมาชิก</a></li>
                <li><a href="{{ url('allarticle') }}">บทความ / ข่าวสาร</a></li>
                @if (Auth::guard('member')->user() == null)
                    <li><a style="background-image: linear-gradient(90deg, #0864a1, #3cb4f0); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block;"
                            href="{{ url('member/login') }}">เข้าสู่ระบบสมาชิก</a></li>
                @endif

                @auth('member')
                    @if (Auth::guard('member')->user()->invitation != null)
                        <li>
                            <a style="background-image: linear-gradient(90deg, #0864a1, #3cb4f0); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block;"
                                href="{{ url('member/profile') }}">Edo Invitation Only</a>
                        </li>
                    @else
                        <li>
                            <a style="background-image: linear-gradient(90deg, #0864a1, #3cb4f0); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block;"
                                href="{{ url('member/profile') }}">บัญชีสมาชิก</a>
                        </li>
                    @endif
                @endauth
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</header>
