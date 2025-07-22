<footer id="footer" class="footer dark-background">

    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                        <img src="{{ asset('frontend_main/assets/img/logo.png') }}" alt="edoplus">
                    </a>
                </div>

                <div class="col-lg-3 col-md-3 footer-links">
                    <h4>ระบบสมาชิก</h4>
                    <ul>
                        <li><a href="{{ url('about-us') }}">เกี่ยวกับเรา</a></li>
                        <li><a href="{{ url('allarticle') }}">บทความและข่าวสาร</a></li>
                        <li><a href="{{ url('condition') }}">ข้อกำหนดและเงื่อนไข</a></li>
                        <li><a href="{{ url('help-center') }}">ศูนย์ช่วยเหลือ</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-3 footer-links">
                    <h4>สำหรับสมาชิก</h4>
                    <ul>
                        <li><a href="{{ url('rewards') }}">REWARD</a></li>
                        <li><a href="{{ url('alliance') }}">สิทธิประโยชน์สมาชิก</a></li>
                        @if (Auth::guard('member')->user() == null)
                            <li><a href="{{ url('member/login') }}">เข้าสู่ระบบสมาชิก</a></li>
                        @endif

                        @auth('member')
                            <li>
                                <a href="{{ url('member/profile') }}">บัญชีสมาชิก</a>
                            </li>
                        @endauth
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>ศูนย์บริการสมาชิก</h4>
                    <ul>
                        <li><a href="#">edoplus.official@gmail.com</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="copyright text-center">
        <div class="container d-flex flex-column flex-lg-row justify-content-center align-items-center">

            <div class="d-flex flex-column align-items-center">
                <div>
                    © Copyright <strong>Edo Plus</strong>. All Rights Reserved
                </div>
            </div>

        </div>
    </div>

</footer>
