<div class="site-header">
    <div class="container">
        <div class="site-header-inner d-flex align-items-end">
            <!-- BEGIn Site Brand -->
            <div class="site-brand me-3">
                <div class="site-title mb-0">
                    <a href="/" class="site-link"><img src="{{config('api.url_media').setting('sys_logo') }}" alt="Logo" class="site-logo"></a>
                </div>
            </div><!-- END Site Brand -->
            <!-- BEGIN Site Header Nav -->
            <div class="site-header-nav">
                <ul class="nav header-main-nav d-none d-lg-flex">
                    {!! widget('frontend.widget.__menu_category') !!}
                </ul>
            </div><!-- END Site Header Nav -->
            <div class="site-header-right d-flex ms-auto">
                <ul class="nav header-right-nav align-items-center">
                    <li class="nav-item item-deposit d-none d-md-inline-block">
                        <a href="/nap-the" class="nav-link rounded-x ps-4 px-4"><strong>Nạp thẻ ngay <i class="las la-angle-right"></i></strong></a>
                    </li>
                    <li class="nav-item item-user-panel logged-in ms-2 ms-lg-5 dropdown">
                        <a id="info" href="#" class="d-flex align-items-center dropdown-toggle border-0"  >
{{--                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"--}}
                            <div class="text text-white d-none d-lg-block ">
{{--                                <div class="small op-5 text-end">--}}

{{--                                    Chào Hiếu--}}
{{--                                </div>--}}
{{--                                <div class="text-end">Số dư: 120.000 đ</div>--}}
                                <div class="text-center store-loading">
                                    <span class="pulser"></span>
                                </div>
                            </div>
                            <div class="avatar-wrapper ms-3">
                                <img src="/assets/frontend/{{theme('')->theme_key}}/img/temp/avatar-32.png" class="avatar rounded-circle" alt="">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end w-100 shadow">
                            <a href="#" class="dropdown-item d-none d-md-block d-lg-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="text text-black" id="info_mobile">
                                    <div class="text-center store-loading">
                                        <span class="pulser"></span>
                                    </div>


                                </div>
                            </a>
                            <style>
                                @media  screen and (max-width: 576px) {
                                    .d-md-block{display:block!important}
                                }
                            </style>
                            <a class="dropdown-item" href="/thong-tin"><i class="las la-user icon"></i>Hồ sơ cá nhân</a>
                            <a class="dropdown-item" href="/thong-tin?log=transaction-history"><i class="las la-clock icon"></i>Lịch sử giao dịch</a>
                            <a class="dropdown-item" href="/thong-tin?log=deposit-history"><i class="las la-credit-card icon"></i>Lịch sử nạp thẻ</a>
                            <a class="dropdown-item" href="/thong-tin?log=store-card"><i class="las la-credit-card icon"></i>Thẻ cào đã mua</a>

                            <a class="dropdown-item" href="/login" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="las la-sign-out-alt icon"></i>Đăng xuất</a>
                        </div>
                    </li>
                    <li class="nav-item item-menu d-lg-none ms-2">
                        <a href="#" class="nav-link"><i class="las la-bars"></i></a>
                    </li>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </div>
        </div>
    </div>
</div><!-- END Header -->
