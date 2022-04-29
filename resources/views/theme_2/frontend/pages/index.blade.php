@extends('frontend.layouts.master')
@section('seo_head')
    @include('frontend.widget.__seo_head')
@endsection
@push('js')
    <script src="/assets/frontend/{{theme('')->theme_key}}/js/storeCard/store_card.js?v={{time()}}"></script>
    <script>
        $(document).ready(function(){
            $('.item-').addClass('active')
        });

    </script>
@endpush
@section('content')
<div class="site-content-body first">
    <div class="row">
        <div class="col-lg-9">
            <div class="nav-qp-tabs-wrap">
                <!-- BEGIN Tabs -->
                <ul class="nav nav-qp-tabs mb-4" role="tablist">
                    <li class="nav-item nav-item-telecom" role="presentation">
{{--                        <a class="nav-link active" href="#" id="game-tab" data-bs-toggle="tab" data-bs-target="#game" type="button" role="tab" aria-controls="game" aria-selected="true"><span><i class="las la-gamepad"></i> <span><span class="d-none d-md-inline">Mua thẻ</span> Game</span></span></a>--}}
                        <a class="nav-link nav-link-telecom active" href="#" id="thedienthoai-tab" data-bs-toggle="tab" data-content="thedienthoai" data-bs-target="#thedienthoai" type="button" role="tab" aria-controls="mobile" aria-selected="true"><span><i class="las la-mobile"></i> <span class="d-none d-md-inline">Mua thẻ</span> </span></a>
                    </li>
{{--                    <li class="nav-item" role="presentation">--}}
{{--                        <a class="nav-link" href="#" id="mobile-tab" data-bs-toggle="tab" data-bs-target="#mobile" type="button" role="tab" aria-controls="mobile" aria-selected="true"><span><i class="las la-mobile"></i> <span class="d-none d-md-inline">Mua thẻ</span> Điện thoại</span></a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item" role="presentation">--}}
{{--                        <a class="nav-link" href="#" id="data-tab" data-bs-toggle="tab" data-bs-target="#data" type="button" role="tab" aria-controls="data" aria-selected="true"><span><i class="las la-wifi"></i> <span class="d-none d-md-inline">Nạp tiền</span> 3G/4G</span></a>--}}
{{--                    </li>--}}
                </ul>
            </div>
            <div class="tab-content mb-4">
                <div class="tab-pane fade show active" id="thedienthoai" role="tabpanel" aria-labelledby="thedienthoai-tab">
                    <div id="nav-steps-wrapper" class="nav-steps-wrapper mb-4">
                        <ul class="nav nav-steps nav-pills nav-justified">
                            <li class="nav-item" data-tab="steps-1">
                                <a href="#" class="nav-link text-start steps-1 active"><span class="icon"><i class="las la-shopping-cart"></i></span> Đặt hàng</a>
                            </li>
                            <li class="nav-item" data-tab="steps-2">
                                <a href="#" class="nav-link steps-2 text-start"><span class="icon"><i class="las la-receipt"></i></span> Thanh toán</a>
                            </li>
                            <li class="nav-item" data-tab="steps-3">
                                <a href="#" class="nav-link text-start steps-3"><span class="icon"><i class="las la-check"></i></span> Nhận thẻ</a>
                            </li>
                        </ul>
                    </div>
                    <form method="POST" action="{{route('postStoreCard')}}" id="form-storeCard">
                        @csrf
                        <div style="display: none" id="input_telecom"></div>
                        <div style="display: none" id="input_amount"></div>
                        <div style="display: none" id="input_ratio"></div>
                        <div style="display: none" id="input_qty"></div>
                        <div id="step-example" class="">
                            <div id="steps-1" class="active tab-content">
                                <div class="pb-5 block-number">
                                    <div class="icon">1</div>
                                    <h6 class="text-uppercase title-small mb-3">Lựa chọn nhà cung cấp</h6>
                                    <div class="text-center store-loading">
                                        <span class="pulser"></span>
                                    </div>
                                    <div class="supplier_thedienthoai row row-gateway gateway-store g-0">
                                        {{--                                    thẻ--}}
                                        {{--                                    <div class="col-md-3 col-6">--}}
                                        {{--                                        <div class="item-gateway me-2" >--}}
                                        {{--                                            <div class="text-center">--}}
                                        {{--                                                <img src="/assets/frontend/{{theme('')->theme_key}}/img/gateway/garena.png" class="mw-100 img" alt="">--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    thẻ--}}
                                    </div>
                                </div>
                                <div class="price_telecom_thedienthoai">
                                    {{--                                <div class="pb-5 block-number gateway-telecom">--}}
                                    {{--                                    <div class="icon">2</div>--}}
                                    {{--                                    <h6 class="title-small text-uppercase mb-3">Lựa chọn mệnh giá</h6>--}}
                                    {{--                                    <div class="row row-price g-0">--}}
                                    {{--                                        <div class="col-md-3 col-6">--}}
                                    {{--                                            <div class="item-price me-2">--}}
                                    {{--                                                <h4 class="text-center mb-2">20.000 đ</h4>--}}
                                    {{--                                                <div class="text-center">Giá: <span class="text-danger">19.200</span> đ</div>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}

                                    {{--                                    </div>--}}
                                    {{--                                    <div class="d-flex justify-content-between align-items-center mt-4">--}}
                                    {{--                                        <label class="label mb-0">Số lượng</label>--}}
                                    {{--                                        <div style="width: 140px">--}}
                                    {{--                                            <input type="number" class="form-control text-center" value="1" min="1" max="100" step="1"/>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                </div>--}}
                                </div>
                                <div class="infor-pay pay_thedienthoai">
                                    <div class="mb-5 block-number last">
                                        <div class="icon">3</div>
                                        <h6 class="text-uppercase title-small mb-3">Thông tin thanh toán</h6>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <table class="table table-sm table-striped table-borderless" cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                    <tr>
                                                        <td class="text-secondary">Loại mã thẻ</td>
                                                        <td id="text-telecom" data-id="thedienthoai">Chưa chọn</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-secondary">Mệnh giá</td>
                                                        <td id="text-amount">Chưa chọn</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-secondary">Phí giao dịch</td>
                                                        <td>Miễn phí</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-secondary">Giảm giá</td>
                                                        <td id="text-ratio">0 VNĐ</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-secondary">Số lượng</td>
                                                        <td id="text-quantity">1</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3 border-bottom pb-2">
                                                    <div class="text-end">
                                                        Tổng tiền
                                                    </div>
                                                    <div class="display-6 text-danger text-end"  id="total-price">
                                                        0 đ
                                                    </div>
                                                </div>
                                                <div class="text-end" id="store_pay">
                                                    <a href="#" class="btn text-white bg-warning-gradient pe-4 ps-4 pt-2 pb-2 rounded button-action-steps" data-id="2" ><strong>Thanh toán</strong> <i class="las la-angle-double-right"></i></a>                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="steps-2" class="tab-content">
                                <!-- BEGIN Content Step 2 -->
                                <div class="mb-4">
                                    <h6 class="title-small text-uppercase mb-2"><i class="las la-wallet"></i> Sử dụng ví của bạn</h6>
                                    <div class="table-responsive">
                                        <table cellspacing="0" cellpadding="0" class="table table-borderless border mb-3">
                                            <tr>
                                                <td>Số tiền cần thanh toán</td>
                                                <td id="text-money-pay" class="text-end">0</td>
                                                <td class="text-end text-secondary" width="20">đ</td>
                                            </tr>
                                            <tr>
                                                <td>Số dự hiện tại</td>
                                                <td id="auth-money" class="text-end">0</td>
                                                <td class="text-end text-secondary" width="20">đ</td>
                                            </tr>
                                            <tr id="text-noti">

                                            </tr>
                                        </table>
                                        <div class="mb-3 text-noti-balance" >
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button id="store-telecom-button" class="btn text-white bg-warning-gradient pe-4 ps-4 pt-2 pb-2 rounded button-action-steps" data-id="3" data-content="1215151510ncjubdc" type="submit"><strong>Xác nhận</strong> <i class="las la-angle-double-right"></i></button>
                                    </div>
                                </div>
                                <!-- END Content Step 2 -->
                            </div>
                            <div id="steps-3" class="tab-content">
                                <!-- BEGIN Content Step 3 -->
                                <div class="content-notify-store" class="mb-4">
                                    <div class="content-notify-content"></div>
                                    <div class="info-buy-card" class="p-3 border-dashed mb-3">
                                        <h6 class="title-style-left mb-3">Thông tin thẻ</h6>
                                        <div class="row align-items-stretch">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-striped table-borderless table-store-card" cellspacing="0" cellpadding="0">

                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        Bạn có muốn ? <a href="/" class="btn btn-outline-secondary ps-4 pe-4 ms-3"><strong>Mua thẻ khác</strong> <i class="las la-angle-double-right"></i></a>
                                    </div>
                                </div>
                                <!-- END Content Step 3 -->
                            </div>
                        </div>
                    </form>






                </div>
{{--                <div class="tab-pane fade" id="mobile" role="tabpanel" aria-labelledby="mobile-tab">Mobile</div>--}}
{{--                <div class="tab-pane fade" id="data" role="tabpanel" aria-labelledby="data-tab">Data</div>--}}
            </div>
            <!-- BEGIN -->
            <div class="p-3 bg-light rounded mb-4">
                <div class="text-rounded custom-text">
                    {!! setting('sys_intro_text') !!}
                </div>
                <div class="text-center text-more"><a href="#" class="more-link">Xem thêm <i class="las la-angle-down"></i></a></div>
            </div>
        </div>
        <div class="col-lg-3">
            @include('frontend.widget.__huongdan__trangchu')

            <!-- BEGIN Support Block -->
                <div class="mb-4">
                    <h6 class="title-style-tab"><span><i class="las la-info-circle"></i> Hỗ trợ</span></h6>
                    <!-- BEGIN Support Item -->
                    <div class="item-block-support hotline d-flex p-2 justify-content-between align-items-center mb-2">
                        <div class="item-icon">
                            <i class="las la-phone-volume"></i>
                        </div>
                        <div class="item-content">
                            <div class="op-7 text-end">Hotline</div>
                            <a href="tel:+{{setting('sys_phone')}}" class="d-block main-text text-end text-danger"><strong> {{setting('sys_phone')}}</strong></a>
                        </div>
                    </div><!-- END Support Item -->
                    <!-- BEGIN Support Item -->
                    <div class="item-block-support facebook d-flex p-2 justify-content-between align-items-center mb-2">
                        <div class="item-icon">
                            <i class="lab la-facebook-f"></i>
                        </div>
                        <div class="item-content">
                            <div class="op-7 text-end">Facebook</div>
                            <a href="{{setting('sys_fanpage')}}" class="d-block main-text text-end" target="_blank"><strong>{{\Request::server("HTTP_HOST")}}</strong></a>
                        </div>
                    </div><!-- END Support Item -->
                </div><!-- BEGIN Support Block -->
        </div>
    </div>
</div>
<div class="site-content-body alt last">
    <h3 class="text-primary mb-3">Tin tức cập nhật <i class="las la-angle-right"></i></h3>
    @include('frontend.widget.__baiviet__trangchu')
    <p class="mb-0 text-center"><a href="/tin-tuc" class="btn bg-secondary text-white rounded-x ps-4 pe-4">Tất cả tin tức <i class="las la-angle-right"></i></a></p>
</div>
<div class="after"></div>

<div id="copy"></div>
<div style="display: none" id="auth">
{{--    <input type="text" class="auth" value="0">--}}
</div>

@endsection
