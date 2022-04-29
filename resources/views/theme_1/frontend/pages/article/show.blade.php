@extends('frontend.layouts.master')
@section('seo_head')
    @include('frontend.widget.__seo_head',with(['data'=>$data]))
@endsection
@section('content')

    @if(isset($data->params) && isset($data->params->article_type))
        {!! $data->params->article_type !!}
    @endif

    <div class="news">
        <div class="news_breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-auto tintuc-auto pr-0">
{{--                        <div class="news_breadcrumbs_title news_breadcrumbs_title__show"><a href="/tin-tuc">Tin tức</a></div>--}}
                    </div>
                    <div class="col-lg-10 trangchu-auto col-md-12 ml-lg-auto">
                        <ul class="news_breadcrumbs_theme news_breadcrumbs_theme__show">
                            <li><a href="/" class="news_breadcrumbs_theme_trangchu news_breadcrumbs_theme_trangchu_a">Trang chủ</a></li>
                            <li>/</li>
                            <li><a href="/tin-tuc" class="news_breadcrumbs_theme_tintuc_a"><p class="news_breadcrumbs_theme_tintuc">Tin tức</p></a></li>
                            <li>/</li>
                            <li class="news_breadcrumbs_theme__li"><a href="javascript:void(0)" class="news_breadcrumbs_theme_title_a"><p class="news_breadcrumbs_theme_title">{{ $data->title }}</p></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="news_content">
            <div class="container">
                <div class="row news_content_in">
                    <div class="col-md-9 col-sm-12">
                        <div class="col-md-12 pl-0 pr-0">
                            <h1 class="news_content_p">{{ $data->title }}</h1>
                            <div class="news_content_line"></div>
                        </div>
                        <div class="news_detail">
                            <div class="news_detail_content">
                                {!! $data->content !!}
                            </div>
                        </div>
                    </div>

                    @include('frontend.widget.__menu__category__article',with(['slug'=>$data->slug]))

                </div>
            </div>
        </div>

        @include('frontend.pages.article.bai__viet__lien__quan')

    </div>




@endsection

