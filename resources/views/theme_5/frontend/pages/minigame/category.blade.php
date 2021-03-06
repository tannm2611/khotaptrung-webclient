@extends('frontend.layouts.master')

@section('content')
    <div class="container c-container" id="minigame-category">
        <ul class="breadcrumb-list">
            <li class="breadcrumb-item">
                <a href="/" class="breadcrumb-link">Trang chủ</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/minigame" class="breadcrumb-link">Vòng quay</a>
            </li>
        </ul>
{{--        <div class="head-mobile">--}}
{{--            <a href="/" class="link-back close-step"></a>--}}

{{--            <h1 class="head-title text-title">Vòng quay may mắn</h1>--}}

{{--            <a href="/" class="home"></a>--}}
{{--        </div>--}}
        {{--            Slider baner    --}}
        @include('frontend.widget.__slider__banner')
        {{--            Top hôm nay    --}}
        @include('frontend.pages.minigame.widget.__top__today')
        {{--        Giam gia soc    --}}
        @include('frontend.pages.minigame.widget.__flash__sale')
        {{--            Dành cho bạn   --}}
        @include('frontend.pages.minigame.widget.__for__you')

        {{--            Vòng quayy free fire   --}}

        @include('frontend.pages.minigame.widget.__minigame__free__fire')
        {{--            Vòng quayy liên quân   --}}
        @include('frontend.pages.minigame.widget.__minigame__lien__quan')

        {{--            Dịch vụ khác   --}}
        @include('frontend.widget.__services__other')

    </div>

@endsection
