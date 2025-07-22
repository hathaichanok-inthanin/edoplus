@extends('frontend/layouts/template')
<style>
    a {
        color: #ffffff !important;
    }
    a:hover {
        color: #adadad !important;
    }
</style>
@section('content')
    @php
        $articles = DB::table('articles')->where('id', '!=', $article->id)->orderBy('updated_at', 'desc')->paginate(10);
    @endphp
    <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="single-article-section">
                    <div class="single-article-text">
                        <img src="{{ url('images/article') }}/{{ $article->image }}" class="img-responsive" width="100%">
                        <strong><h1 style="font-size: 2.5rem;" class="mt-5 text-center">{{ $article->title }}</h1></strong>
                        <div>{!! $article->article !!}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end single article section -->
    </div>
@endsection
