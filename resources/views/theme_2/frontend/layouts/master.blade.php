<!doctype html>
<html lang="vi">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="path" content="" />
    <meta name="robots" content="index,follow" />
    <meta name="jwt" content="jwt" />
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/lib/sweetalert2/sw2.css">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/css/custom.boostrap.css">

{{--    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/lib/bootstrap/bootstrap.min.css">--}}

    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/css/line-awesome.min.css">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/node_modules/flickity/dist/flickity.min.css">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/lib/bootstrapdatepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/lib/toastr/toastr.css">
    <!--    <link rel="stylesheet" href="css/main.css">-->
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/css/style.css?v={{time()}}">
    <script src="/assets/frontend/{{theme('')->theme_key}}/lib/jquery.min.js"></script>
    <script src="/assets/frontend/{{theme('')->theme_key}}/lib/bootstrap/bootstrap.min.js"></script>
    <script src="/assets/frontend/{{theme('')->theme_key}}/lib/moment/moment.min.js"></script>
    <script src="/assets/frontend/{{theme('')->theme_key}}/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/assets/frontend/{{theme('')->theme_key}}/lib/bootstrapdatepicker/bootstrap-datepicker.min.js"></script>
    <script src="/assets/frontend/{{theme('')->theme_key}}/lib/sweetalert2/sw2.js"></script>
    <script src="/assets/frontend/{{theme('')->theme_key}}/js/account_info.js?v={{time()}}"></script>
    <script src="/assets/frontend/{{theme('')->theme_key}}/js/main.js?v={{time()}}"></script>

{{--    <script src="/assets/frontend/{{theme('')->theme_key}}/js/storeCard/store_card.js"></script>--}}
    @stack('js')

    <script>

    </script>
    @yield('seo_head')
</head>

<body>
<!-- BEGIN Site -->
<div class="site">
    <!-- BEGIN Header -->
    @include('frontend.layouts.includes.header')

    <!-- BEGIn Site main -->
    <div class="site-main">
        <div class="container">
            <div class="site-content">
                <div class="site-content-inner">
                    @yield('content')

                </div>
            </div>
        </div>
    </div><!-- END Site Main -->
    <!-- BEGIN Site Footer -->
    @include('frontend.layouts.includes.footer')
</div><!-- END SIte -->
<div class="overlay"></div>
<div class="offcanvas-nav">
    <button type="button" class="btn btn-close"><i class="las la-times"></i></button>
    <div class="offcanvas-nav-inner h-100 p-3">
        <ul class="nav flex-column">
            {!! widget('frontend.widget.__menu_category_theme2') !!}

{{--            <li class="nav-item item-home active"><a href="/" class="nav-link"><i class="las la-home icon"></i> Trang chủ</a></li>--}}
{{--            <li class="nav-item item-buy-card"><a href="/" class="nav-link"><i class="las la-credit-card icon"></i> Mua thẻ game điện thoại</a></li>--}}
{{--            <li class="nav-item item-history"><a href="/thong-tin#history" class="nav-link"><i class="las la-clock icon"></i> Lịch sử giao dịch</a></li>--}}
{{--            <li class="nav-item item-profile"><a href="/user/profile" class="nav-link"><i class="las la-user icon"></i> Thông tin cá nhân</a></li>--}}
{{--            <li class="nav-item item-news"><a href="/tin" class="nav-link"><i class="las la-newspaper icon"></i> Tin tức</a></li>--}}
{{--            <li class="nav-item item-news"><a href="/thong-tin#deposit" class="nav-link"><i class="las la-credit-card icon"></i> Lịch sử nạp thẻ</a></li>--}}
        </ul>
    </div>
</div>
<div class="scroll-top">
    <a href="#" class="scroll-top-link"><i class="las la-angle-double-up"></i></a>
</div>
<div class="text-center ajax-loading-store">
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>
</div>
<!-- Optional JavaScript; choose one of the two! -->
<script src="/assets/frontend/{{theme('')->theme_key}}/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/frontend/{{theme('')->theme_key}}/node_modules/jquery/dist/jquery.min.js"></script>
{{--<script src="/assets/frontend/{{theme('')->theme_key}}/lib/jquery.min.js"></script>--}}

<script src="/assets/frontend/{{theme('')->theme_key}}/node_modules/flickity/dist/flickity.pkgd.min.js"></script>
<script src="/assets/frontend/{{theme('')->theme_key}}/js/bootstrap-input-spinner.js"></script>
<script src="/assets/frontend/{{theme('')->theme_key}}/js/sticky-kit.min.js"></script>
<script src="/assets/frontend/{{theme('')->theme_key}}/lib/toastr/toastr.min.js"></script>



</body>

</html>
