@extends('frontend.layouts.master')
@section('seo_head')
    @include('frontend.widget.__seo_head',with(['data'=>$data]))
@endsection
@push('js')
    <script>
        $(document).ready(function(){
            $('.item-tin-tuc').addClass('active')
        });
    </script>
@endpush
@section('content')
    <div class="site-content-body alt first pt-0 pb-0 d-flex justify-content-between align-items-center">
        <ul class="nav nav-line">
            <li class="nav-item">
                <a href="/tin-tuc" class="nav-link">Tin tức chung</a>
            </li>
            @include('frontend.widget.__menu__article')
        </ul>
        <div>
            <div class="input-group input-group-search">
                <input type="text" value="" placeholder="Từ khóa" class="form-control">
                <button class="btn bg-transparent text-secondary" type="button"><i class="las la-search"></i></button>
            </div>
        </div>

    </div>
    <div class="site-content-body bg-white last">
        <nav class="site-breadcrumb mb-3">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/tin-tuc">Tin tức</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="/tin-tuc/{{ $data->groups[0]->slug }}">{{ $data->groups[0]->title }}</a></li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-lg-9">
                <div class="article-single mb-4">
                    <div class="article-thumb mb-4">
                        <div class="media-placeholder ratio-2-1 rounded">
                            <div class="bg rounded" style="background-image: url(https://media-tt.nick.vn/{{ $data->image }});"></div>
                            <div class="media-inner aling-items-end">
                                <div class="align-items-end h-100 text-white">
                                    <div class="align-items-bottom">
                                        <h1 class="item-title text-white" style="font-size: 2rem;">{{ $data->title }}</h1>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="article-main d-flex pt-4 elsticky-wrap">
{{--                        <div class="social-share">--}}
{{--                            <ul class="nav social-icons flex-column elsticky">--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="#" class="nav-link"><i class="las la-share"></i></a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item facebook">--}}
{{--                                    <a href="#" class="nav-link"><i class="lab la-facebook-f"></i></a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item twitter">--}}
{{--                                    <a href="#" class="nav-link"><i class="lab la-twitter"></i></a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                        <div class="article-content flex-grow-1 news_detail_content">
                            {!! $data->content !!}

                        </div>
                    </div>
                </div>
                <div class="mb-4 border-top pt-3">
                    <h4 class="title-style-left mb-3">Tin tức liên quan</h4>
                    <div class="row">

                        @include('frontend.widget.__baiviet__lienquan',with(['slug'=>$slug,'id'=>$id]))
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                @include('frontend.widget.__menu__category__article__index')
            </div>
        </div>
    </div>
    <div class="after"></div>

    <script>
        $(document).ready(function(){
            $('.active{{ $data->groups[0]->slug }}').addClass('active');
        })
    </script>
@endsection



