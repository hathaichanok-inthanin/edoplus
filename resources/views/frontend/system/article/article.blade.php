@extends('frontend/layouts/template')
<style>
    .excerpt {
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@section('content')
    <section id="recent-posts" class="recent-posts section" style="padding-bottom: 50px;">
        <div class="container section-title" data-aos="fade-up">
            <p><strong>บทความ / ข่าวสาร</strong></p>
        </div>
        <div class="container">

            <div class="row gy-5">
                @foreach ($articles as $article => $value)
                    <div class="col-xl-4 col-md-6">
                        <div class="post-item position-relative h-100">

                            <div class="post-img position-relative overflow-hidden">
                                <img src="{{ url('images/article') }}/{{ $value->image }}" class="img-fluid" alt="">
                                <span class="post-date">บทความ{{ $value->type }}</span>
                            </div>

                            <div class="post-content d-flex flex-column">

                                <h3 class="post-title">{{ $value->title }}</h3>

                                <div class="meta d-flex align-items-center text-dark">
                                    <div class="excerpt">{!! $value->article !!}</div>
                                </div>

                                <hr>

                                <a href="{{ url('article') }}/{{ $value->id }}/{{ $value->title }}"
                                    class="readmore stretched-link"><span>Read More</span><i
                                        class="bi bi-arrow-right"></i></a>

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
