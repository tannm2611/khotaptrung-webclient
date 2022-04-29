<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="index,follow" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="path" content="" />
    <meta name="jwt" content="jwt" />
{{--    <title>Kho lưu trữ</title>--}}
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/lib/sweetalert2/sw2.css">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <!--    swiper-->
    <link rel="shortcut icon" href="/assets/frontend/{{theme('')->theme_key}}/images/icon_logo.png">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/lib/swiper/swiper.min.css">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/lib/animate/animate.min.css">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/css/buyacc.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/lib/OwlCarousel2/owl.carousel.min.css">
    <!--    bootstrap-->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/lib/bootstrap/bootstrap.min.css">
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <!--    gallery-->
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/lib/steps/jquery-steps.css">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/lib/select-nice/select-nice.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/lib/bootstrapdatepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/lib/fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/lib/fancybox/fancybox.css">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/lib/fixed-sticky/fixedsticky.css">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/lib/bootstrap-popover/bootstrap-popover-x.css">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/lib/date-picker/tui-date-picker.css">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/css/news.css?v={{time()}}">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/css/account.css?v={{time()}}">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/css/spin.css">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/lib/toastr/toastr.css">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/lib/steps/jquery-steps.css">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/css/main.css?v={{time()}}">

    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/css/@if(isset(theme('')->theme_config->sys_config_menu)){{theme('')->theme_config->sys_config_menu ? theme('')->theme_config->sys_config_menu : ''}}@endif/theme.css">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/css/@if(isset(theme('')->theme_config->sys_config_banner)){{theme('')->theme_config->sys_config_banner ? theme('')->theme_config->sys_config_banner : ''}}@endif/theme.css">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/css/@if(isset(theme('')->theme_config->sys_config_menu_news)){{theme('')->theme_config->sys_config_menu_news ? theme('')->theme_config->sys_config_menu_news : ''}}@endif/theme.css">
    @stack('style')

    <script src="/assets/frontend/{{theme('')->theme_key}}/lib/jquery.min.js"></script>
    <script src="/assets/frontend/{{theme('')->theme_key}}/lib/bootstrap/bootstrap.min.js"></script>
    <script src="/assets/frontend/{{theme('')->theme_key}}/lib/moment/moment.min.js"></script>

    <script src="/assets/frontend/{{theme('')->theme_key}}/lib/bootstrap-popover/bootstrap-popover.js"></script>

    <script src="/assets/frontend/{{theme('')->theme_key}}/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/assets/frontend/{{theme('')->theme_key}}/lib/toastr/toastr.min.js"></script>
    <script src="/assets/frontend/{{theme('')->theme_key}}/lib/bootstrapdatepicker/bootstrap-datepicker.min.js"></script>

    <script src="/assets/frontend/{{theme('')->theme_key}}/lib/rateit/jquery.barrating.min.js"></script>
    <script src="/assets/frontend/{{theme('')->theme_key}}/lib/rateit/examples.js"></script>

    <script src="/assets/frontend/{{theme('')->theme_key}}/lib/steps/jquery-steps.js"></script>
    <script src="/assets/frontend/{{theme('')->theme_key}}/lib/lazyload/lazyloadGen.js"></script>

    <script src="/assets/frontend/{{theme('')->theme_key}}/lib/select-nice/select-nice.js"></script>
    <script src="/assets/frontend/{{theme('')->theme_key}}/lib/easeJquery/easing.js"></script>
    <script src="/assets/frontend/{{theme('')->theme_key}}/lib/record/record.js"></script>
    <script src="/assets/frontend/{{theme('')->theme_key}}/js/sweetalert.min.js"></script>
    <script src="/assets/frontend/{{theme('')->theme_key}}/js/account_info.js?v={{time()}}"></script>

    <script src="/assets/frontend/{{theme('')->theme_key}}/lib/sweetalert2/sw2.js"></script>
    <script src="/assets/frontend/{{theme('')->theme_key}}/lib/popper/popper.min.js"></script>
    <script src="/assets/frontend/{{theme('')->theme_key}}/lib/popper/tippy-bundle.umd.js"></script>

    <script>
        $(document).ready(function () {
            @if(Request::is('thong-tin'))

            $('.account_thong-tin').addClass('menu_active')
            @elseif(Request::is('lich-su-giao-dich'))

            $('.account_lich-su-giao-dich').addClass('menu_active')

            @elseif(Request::is('minigame-log-726'))

            $('.account_minigame-log-726').addClass('menu_active')

            @elseif(Request::is('dich-vu-da-mua'))

            $('.account_dich-vu-da-mua').addClass('menu_active')

            @elseif(Request::is('nap-the'))

            $('.account_nap-the').addClass('menu_active')

            @elseif(Request::is('lich-su-nap-the'))

            $('.account_lich-su-nap-the').addClass('menu_active')

            @elseif(Request::is('recharge-atm'))

            $('.account_recharge-atm').addClass('menu_active')

            @elseif(Request::is('lich-su-mua-account'))

            $('.account_lich-su-mua-account').addClass('menu_active')

            @elseif(Request::is('withdrawitem-1'))
            $('.account_withdrawitem-1').addClass('menu_active')

            @endif
        })
    </script>

    @stack('js')

    @yield('seo_head')
        @if(Request::is('/'))
        <style>
            .content{
                padding-top: 140px;
            }
            @media only screen and (max-width: 1024px) {
                .content {
                    padding-top: 80px;
                }
            }
        </style>
    @else
        <style>
            .content{
                padding-top: 120px;
            }
            @media only screen and (max-width: 1024px) {
                .content {
                    padding-top: 100px;
                }
            }
        </style>
        @endif

</head>
<body>

<div class="{{ Request::is('/')?'main-lay-out':'' }}">
    @include('frontend.layouts.includes.header')
    <div class="content" style="">
        @yield('content')
    </div>
</div>
<div class="go-top">
    <i class="fas fa-arrow-alt-circle-up"></i>
</div>


@include('frontend.layouts.includes.footer')
<script>
    @if(\App\Library\AuthCustom::check())
    $( document ).ready(function() {
    $(document).on('scroll',function(){
        if($(window).width() > 1024){
            if ($(this).scrollTop() > 100) {
                $("#logout").css("display","none");

            } else {
                $("#logout").css("display","inline");
            }
        }

    });
    });
    @endif


</script>
<script src="/assets/frontend/{{theme('')->theme_key}}/lib/fancybox/fancybox.umd.js"></script>
<script src="/assets/frontend/{{theme('')->theme_key}}/lib/fancybox/jquery.fancybox.min.js"></script>

<script src="/assets/frontend/{{theme('')->theme_key}}/lib/OwlCarousel2/OwlCarousel2.min.js"></script>
<script src="/assets/frontend/{{theme('')->theme_key}}/lib/slick/slick.min.js"></script>

<script src="/assets/frontend/{{theme('')->theme_key}}/js/action.js?v={{time()}}"></script>
<script src="/assets/frontend/{{theme('')->theme_key}}/js/@if(isset(theme('')->theme_config->sys_config_menu)){{theme('')->theme_config->sys_config_menu ? theme('')->theme_config->sys_config_menu : ''}}@endif/theme.js"></script>

<script src="/assets/frontend/{{theme('')->theme_key}}/lib/swiper/swiper.min.js"></script>

<script src="/assets/frontend/{{theme('')->theme_key}}/js/swiper.js?v={{time()}}"></script>
<script src="/assets/frontend/{{theme('')->theme_key}}/js/jquery.cookie.min.js"></script>

<script src="/assets/frontend/{{theme('')->theme_key}}/js/account/buyacc.js"></script>


{{--@yield('scripts')--}}
</body>


</html>
