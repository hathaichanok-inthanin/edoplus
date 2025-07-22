@extends('frontend/layouts/template')
<style>
    .article-detail p {
        color: #ffffff;
        font-size: 1.5rem;
    }
</style>
@section('content')
    @php
        $rewards = DB::table('rewards')
            ->where('id', '!=', $reward->id)
            ->paginate(10);
        $reward_point = DB::table('reward_points')
            ->where('reward_id', $reward->id)
            ->value('point');
    @endphp
    <!-- single article section -->
    <div class="mb-150" style="margin-top: 200px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="single-article-section">
                        <img src="{{ url('images/reward') }}/{{ $reward->image }}" class="img-responsive" width="100%">
                        <h1 class="mt-5" style="font-size: 3.5rem; color: #F28123;">
                            <strong>{{ $reward->name }}</strong>
                        </h1>
                        <div class="article-detail">{!! $reward->detail !!}</div>
                        <h3 class="mt-3 mb-3">ใช้พอยท์ <i class="fa fa-caret-right" style="color:#777777;"></i>
                            <span style="color: red;"><strong>{{ $reward_point }}</strong></span> พอยท์
                        </h3>
                        <h5 class="mt-5">เงื่อนไขการแลกคะแนนสะสม</h5>
                        <ui>
                            <li>กรุณาบันทึกภาพหน้าจอการแลกของรางวัลไว้เป็นหลักฐาน</li>
                            <li>เมื่อทำรายการแล้วไม่สามารถเปลี่ยนแปลง ยกเลิก คืน หรือ ทอน เป็นคะแนนหรือเงินสดได้</li>
                            <li>บริษัทฯ ถือตามข้อมูลที่ปรากฏในระบบของบริษัทฯ เป็นสำคัญ</li>
                            <li>เงื่อนไขเป็นไปตามที่บริษัทฯ กำหนด ขอสงวนสิทธิ์ในการเปลี่ยนแปลง แก้ไข
                                โดยไม่ต้องแจ้งให้ทราบล่วงหน้า</li>
                        </ui>
                        <a href="{{ url('member/reward-redeem/') }}/{{ $reward->id }}"
                            class="btn btn-block btn-success mt-3" style="color: #ffffff;">กดแลกคะแนนสะสม</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="sidebar-section">
                        <div class="recent-posts">
                            <h4>OTHERS REWARD</h4>
                            <ul>
                                @foreach ($rewards as $reward => $value)
                                    <li><a
                                            href="{{ url('reward-detail') }}/{{ $value->id }}">{{ $value->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="tag-section">
                            <h4>Tags</h4>
                            <a href="{{ url('article/food') }}" class="btn btn-secondary mt-2" style="margin-right: 1rem;">บทความ อาหาร</a>
                            <a href="{{ url('article/lifeStyle') }}" class="btn btn-secondary mt-2" style="margin-right: 1rem;">บทความ ไลฟ์สไตล์</a>
                            <a href="{{ url('article/beauty') }}" class="btn btn-secondary mt-2" style="margin-right: 1rem;">บทความ บิวตี้</a>
                            <a href="{{ url('article/news') }}" class="btn btn-secondary mt-2" style="margin-right: 1rem;">บทความ ข่าว</a>
                            <a href="{{ url('article/horoscope') }}" class="btn btn-secondary mt-2" style="margin-right: 1rem;">บทความ ดูดวง</a>
                            <a href="{{ url('article/general') }}" class="btn btn-secondary mt-2" style="margin-right: 1rem;">บทความ ทั่วไป</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end single article section -->
@endsection
