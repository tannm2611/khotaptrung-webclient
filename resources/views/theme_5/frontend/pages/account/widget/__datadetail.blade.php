@if(isset($data))
    @if($data->status == 1)
        <section class="acc-detail data-account-detail">
            <div class="section-content">
                <div class="card account-thumb">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-thumb" role="tabpanel">
                            <div class="card-body c-p-16 c-p-lg-0 mx-n3 mx-lg-0 d-flex">
                                <div class="swiper gallery-top d-none d-lg-block">
                                    <div class="swiper-wrapper">
                                        @foreach(explode('|',$data->image_extension) as $val)

                                            <div class="swiper-slide">
                                                <div class="gallery-photo" data-fancybox="gallerycoverDetail" href="{{\App\Library\MediaHelpers::media($val)}}">
                                                    <img class="lazy" src="{{\App\Library\MediaHelpers::media($val)}}" alt="mua-nick" >
                                                </div>
                                            </div>

                                        @endforeach


                                    </div>
                                </div>

                                <div class="swiper gallery-thumbs c-ml-16 c-ml-lg-0">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="gallery-photo" data-fancybox="gallerycoverDetail" href="{{\App\Library\MediaHelpers::media($val)}}">
                                                <img class="lazy" src="{{\App\Library\MediaHelpers::media($val)}}" alt="mua-nick" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-video" role="tabpanel">
                            Coming soon...
                        </div>
                    </div>
                    <div class="nav-controller c-px-lg-0 c-my-lg-12">
                        <div class="swiper-pagination d-none d-lg-flex">
                            <div class="navigation slider-prev v2 c-mr-8"></div>
                            <div class="navigation slider-next v2"></div>
                        </div>
                        <ul class="nav nav-tabs size-auto" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="tab-show-acc active count-thumb" data-toggle="tab" href="#tab-thumb" role="tab"
                                   aria-selected="true"></a>
                            </li>
                            <li class="c-mx-4"></li>
                            <li class="nav-item" role="presentation">
                                <a class="tab-show-acc video" data-toggle="tab" href="#tab-video" role="tab"
                                   aria-selected="false">Video</a>
                            </li>
                        </ul>
                    </div>
{{--                    <div class="group-btn d-flex d-lg-none" style="--data-between: 12px">--}}
{{--                        <a href="/mua-the" class="btn pink two-line">--}}
{{--                            <span class="line-1">Mua b???ng Th??? c??o</span>--}}
{{--                            <span class="line-2">Mua b???ng Th??? c??o</span>--}}
{{--                        </a>--}}
{{--                        <a href="/recharge-atm" class="btn pink two-line">--}}
{{--                            <span class="line-1">Mua b???ng ATM, Momo</span>--}}
{{--                            <span class="line-2">Mua b???ng ATM, Momo</span>--}}
{{--                        </a>--}}
{{--                    </div>--}}

                    @if(isset($card_percent))
                        @if($card_percent == 0)
                            <div class="group-btn d-flex d-lg-none" style="--data-between: 12px">
                                <a href="/nap-the" class="btn pink two-line">
                                    <span class="line-1">Mua b???ng Th??? c??o</span>
                                    <span class="line-2">{{ str_replace(',','.',number_format(round($data->price))) }} ??</span>
                                </a>
                                @if(isset($data->price_atm))
                                    <a href="/recharge-atm" class="btn pink two-line">
                                        <span class="line-1">Mua b???ng ATM, Momo</span>
                                        <span class="line-2">{{ str_replace(',','.',number_format(round($data->price_atm))) }} ??</span>
                                    </a>
                                @endif
                            </div>
                        @else
                            @if(isset($data->price_atm))
                                <div class="group-btn d-flex d-lg-none" style="--data-between: 12px">
                                    <a href="/recharge-atm" class="btn pink two-line">
                                        <span class="line-1">Mua b???ng ATM, Momo</span>
                                        <span class="line-2">{{ str_replace(',','.',number_format(round($data->price_atm))) }} ??</span>
                                    </a>
                                </div>
                            @endif
                        @endif
                    @else
                        <div class="group-btn d-flex d-lg-none" style="--data-between: 12px">
                            <a href="/nap-the" class="btn pink two-line">
                                <span class="line-1">Mua b???ng Th??? c??o</span>
                                <span class="line-2">{{ str_replace(',','.',number_format(round($data->price))) }} ??</span>
                            </a>
                            @if(isset($data->price_atm))
                                <a href="/recharge-atm" class="btn pink two-line">
                                    <span class="line-1">Mua b???ng ATM, Momo</span>
                                    <span class="line-2">{{ str_replace(',','.',number_format(round($data->price_atm))) }} ??</span>
                                </a>
                            @endif
                        </div>
                    @endif

                    <div class="d-block d-lg-none c-pt-28 c-pb-16">
                        <hr>
                    </div>

                    <div class="text-title c-py-8 d-block d-lg-none">
                        Th??ng tin acc
                    </div>

                    <table class="table-acc-info c-mb-24 d-table d-lg-none">

                        @if(isset($data->groups))
                            <?php $att_values = $data->groups ?>
                            @foreach($att_values as $att_value)
                                @if(isset($att_value->module) && $att_value->module == 'acc_label' && $att_value->is_slug_override == null)
                                    @if(isset($att_value->parent))
                                        <tr>
                                            <td>
                                                        <span class="link-color">
                                                            {{ $att_value->parent->title??null }}
                                                        </span>
                                            </td>
                                            <td>
                                                        <span>
                                                            {{ $att_value->title??null }}
                                                        </span>
                                            </td>
                                            {{--                                                    <td>--}}
                                            {{--                                                        <a href="javascript:void(0)" class="link blue eye btn-show-tuong">Xem</a>--}}
                                            {{--                                                    </td>--}}
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        @endif

                        @if(isset($data->params) && isset($data->params->ext_info))
                            <?php $params = json_decode(json_encode($data->params->ext_info),true) ?>
                            @if(isset($dataAttribute))
                                @foreach($dataAttribute as $index=>$att)
                                    @if($att->position == 'text')
                                        @if(isset($att->childs))
                                            @foreach($att->childs as $child)
                                                @foreach($params as $key => $param)
                                                    @if($key == $child->id && $child->is_slug_override == null)
                                                        <tr>
                                                            <td>
                                                                <span class="link-color">
                                                                    {{ $child->title??'' }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span>
                                                                    {{ $param }}
                                                                </span>
                                                            </td>
                                                            {{--                                                    <td>--}}
                                                            {{--                                                        <a href="javascript:void(0)" class="link blue eye btn-show-tuong">Xem</a>--}}
                                                            {{--                                                    </td>--}}
                                                        </tr>

                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        @endif

                    </table>
                </div>

                <div class="card account-detail-info js_sticky" data-top="140">
                    <div class="card-body c-p-16 mx-n3 mx-lg-0">
                        <div class="section-title title-color fz-lg-18 lh-lg-24">{{ isset($data->category->custom->title) ? $data->category->custom->title :  $data->category->title }}</div>
                        <div class="text-title fw-700 c-mb-6 d-none d-lg-block">M?? s???: #{{ $data->randId }}</div>
                        <span class="d-block d-lg-none link-color c-mb-8">
                            M?? s???: {{ $data->randId }}
                        </span>
                        <hr>
                        <div class="d-block d-lg-none c-pb-12"></div>

                        <div class="text-title c-py-8 d-none d-lg-block">
                            Th??ng tin acc
                        </div>

                        <table class="table-acc-info c-mb-24 d-none d-lg-table">
                            @if(isset($data->groups))
                                <?php $att_values = $data->groups ?>
                                @foreach($att_values as $att_value)
                                    @if(isset($att_value->module) && $att_value->module == 'acc_label' && $att_value->is_slug_override == null)
                                        @if(isset($att_value->parent))
                                                <tr>
                                                    <td>
                                                        <span class="link-color">
                                                            {{ $att_value->parent->title??null }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            {{ $att_value->title??null }}
                                                        </span>
                                                    </td>
{{--                                                    <td>--}}
{{--                                                        <a href="javascript:void(0)" class="link blue eye btn-show-tuong">Xem</a>--}}
{{--                                                    </td>--}}
                                                </tr>
                                        @endif
                                    @endif
                                @endforeach
                            @endif

                            @if(isset($data->params) && isset($data->params->ext_info))
                                <?php $params = json_decode(json_encode($data->params->ext_info),true) ?>
                                @if(isset($dataAttribute))
                                    @foreach($dataAttribute as $index=>$att)
                                        @if($att->position == 'text')
                                            @if(isset($att->childs))
                                                @foreach($att->childs as $child)
                                                    @foreach($params as $key => $param)
                                                        @if($key == $child->id && $child->is_slug_override == null)
                                                            <tr>
                                                                <td>
                                                            <span class="link-color">
                                                                {{ $child->title??'' }}
                                                            </span>
                                                                </td>
                                                                <td>
                                                            <span>
                                                                {{ $param }}
                                                            </span>
                                                                </td>
                                                                {{--                                                    <td>--}}
                                                                {{--                                                        <a href="javascript:void(0)" class="link blue eye btn-show-tuong">Xem</a>--}}
                                                                {{--                                                    </td>--}}
                                                            </tr>

                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                            @endif

                        </table>
                        @php
                            if (isset($data->price_old)) {
                                $sale_percent = (($data->price_old - $data->price) / $data->price_old) * 100;
                                $sale_percent = round($sale_percent, 0, PHP_ROUND_HALF_UP);
                            } else {
                                $sale_percent = 0;
                            }
                        @endphp
                        <div class="card disabled-color">
                            <div class="card-body text-center c-p-0">
                                <div class="price-acc">
                                    <div class="price-old fz-lg-12 lh-lg-16">
                                        {{ str_replace(',','.',number_format($data->price_old)) }}??
                                    </div>
                                    <div class="price-current fz-lg-20 lh-lg-28 c-mx-8">
                                        {{ str_replace(',','.',number_format($data->price)) }}??
                                    </div>
                                    <div class="discount">
                                        -{{ $sale_percent }}%
                                    </div>
                                </div>
                                <span>
                                    R??? v?? ?????i, gi?? t???t nh???t th??? tr?????ng
                                </span>
                            </div>
                        </div>
                        <div class="c-py-24 d-none d-lg-block">
                            <hr>
                        </div>
                        <div class="group-btn c-mb-16 d-none d-lg-flex " style="--data-between: 12px">
                            <button class="btn secondary tinhnang">Tr??? g??p</button>
                            @if(App\Library\AuthCustom::check())
                                @if(App\Library\AuthCustom::user()->balance < $data->price)
                                    <button type="button" class="btn primary the-cao-atm">Mua ngay</button>
                                @else
                                    <button type="button" class="btn primary btn-muangay">Mua ngay</button>
                                @endif
                            @else
                                <button type="button" class="btn primary" onclick="openLoginModal()">Mua ngay</button>
                            @endif


                        </div>
                        @if(isset($card_percent))
                            @if($card_percent == 0)
                                <div class="group-btn d-none d-lg-flex" style="--data-between: 12px">
                                    <a href="/nap-the" class="btn pink two-line">
                                        <span class="line-1">Mua b???ng Th??? c??o</span>
                                        <span class="line-2">{{ str_replace(',','.',number_format(round($data->price))) }} ??</span>
                                    </a>
                                    @if(isset($data->price_atm))
                                    <a href="/recharge-atm" class="btn pink two-line">
                                        <span class="line-1">Mua b???ng ATM, Momo</span>
                                        <span class="line-2">{{ str_replace(',','.',number_format(round($data->price_atm))) }} ??</span>
                                    </a>
                                    @endif
                                </div>
                            @else
                                @if(isset($data->price_atm))
                                <div class="group-btn d-none d-lg-flex" style="--data-between: 12px">
                                    <a href="/recharge-atm" class="btn pink two-line">
                                        <span class="line-1">Mua b???ng ATM, Momo</span>
                                        <span class="line-2">{{ str_replace(',','.',number_format(round($data->price_atm))) }} ??</span>
                                    </a>
                                </div>
                                @endif
                            @endif
                        @else
                            <div class="group-btn d-none d-lg-flex" style="--data-between: 12px">
                                <a href="/nap-the" class="btn pink two-line">
                                    <span class="line-1">Mua b???ng Th??? c??o</span>
                                    <span class="line-2">{{ str_replace(',','.',number_format(round($data->price))) }} ??</span>
                                </a>
                                @if(isset($data->price_atm))
                                <a href="/recharge-atm" class="btn pink two-line">
                                    <span class="line-1">Mua b???ng ATM, Momo</span>
                                    <span class="line-2">{{ str_replace(',','.',number_format(round($data->price_atm))) }} ??</span>
                                </a>
                                @endif
                            </div>
                        @endif

                    </div>
                </div>
                <div class="account-desc c-mt-16">
                    <h2 class="text-title-bold d-block d-lg-none c-mb-8">Chi ti???t d???ch v???</h2>
                    <div class="card overflow-hidden">
                        <div class="card-body c-px-16">
                            <h2 class="text-title-bold d-none d-lg-block c-mb-24">Chi ti???t d???ch v???</h2>
                            <div class="content-desc">
                                {!! $data->description !!}
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <span class="see-more" data-content="Xem th??m n???i dung"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-mobile">
                <div class="c-px-16 c-pt-16 group-btn" style="--data-between: 12px">
                    <button class="btn secondary tinhnang">Mua tr??? g??p</button>
                    @if(App\Library\AuthCustom::check())
                        @if(App\Library\AuthCustom::user()->balance < $data->price)
                            <button class="btn primary the-cao-atm">Mua Ngay</button>
                        @else
                            <button class="btn primary js-step" data-target="#step2">Mua Ngay</button>
                        @endif
                    @else
                        <button class="btn primary" onclick="openLoginModal()">Mua Ngay</button>
                    @endif

                </div>
            </div>


        {{--  s??? l?? step  --}}

            <div class="step" id="step2">
                <form class="formDonhangAccount" action="/acc/{{ $data->randId }}/databuy" method="POST">
                    {{ csrf_field() }}
                <div class="head-mobile">
                    <a href="javascript:void(0) " class="link-back close-step"></a>

                    <h1 class="head-title text-title">X??c nh???n thanh to??n</h1>

                    <a href="/" class="home"></a>
                </div>
                <div class="body-mobile">

                    <div class="body-mobile-content c-p-16">
                        <div class="dialog--content__title fw-700 fz-15 c-mb-12 text-title-theme">
                            Th??ng tin mua Acc
                        </div>
                        <div class="card--gray c-mb-16 c-pt-8 c-pb-8 c-pl-12 c-pr-12 brs-8 g_mobile-content">
                            <div class="card--attr justify-content-between d-flex c-mb-8 text-center">
                                <div class="card--attr__name fw-400 fz-13 text-center text-order">
                                    Game
                                </div>
                                <div class="card--attr__value fz-13 fw-500">{{ isset($data->category->custom->title) ? $data->category->custom->title :  $data->category->title }}</div>
                            </div>
                            <div class="card--attr justify-content-between d-flex c-mb-8 text-center">
                                <div class="card--attr__name fw-400 fz-13 text-center text-order">
                                    Gi?? ti???n
                                </div>
                                <div class="card--attr__value fz-13 fw-500">{{ str_replace(',','.',number_format($data->price)) }} ??</div>
                            </div>
                        </div>

                        <div class="card--gray c-mb-16 c-pt-8 c-pb-8 c-pl-12 c-pr-12 brs-8 g_mobile-content">

                            @if(isset($data->groups))
                                <?php $att_values = $data->groups ?>
                                @foreach($att_values as $att_value)
                                    @if($att_value->module == 'acc_label' && $att_value->is_slug_override == null)
                                        @if(isset($att_value->parent))
                                                <div class="card--attr justify-content-between d-flex c-mb-8 text-center">
                                                    <div class="card--attr__name fw-400 fz-13 text-center text-order">
                                                    {{ $att_value->parent->title??null }}
                                                </div>
                                                <div class="card--attr__value fz-13 fw-500">{{ $att_value->title??null }}</div>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            @endif

                            @if(isset($data->params) && isset($data->params->ext_info))
                                <?php $params = json_decode(json_encode($data->params->ext_info),true) ?>
                                @foreach($params as $key => $param)
                                    <div class="card--attr justify-content-between d-flex c-mb-8 text-center">
                                        <div class="card--attr__name fw-400 fz-13 text-center text-order">
                                            {{ $key }}
                                        </div>
                                        <div class="card--attr__value fz-13 fw-500">{{ $param }}</div>
                                    </div>
                                @endforeach
                            @endif

                        </div>

                        <div class="card--gray c-mb-16 c-pt-8 c-pb-8 c-pl-12 c-pr-12 brs-8 g_mobile-content">
                            <div class="card--attr justify-content-between d-flex c-mb-8 text-center">
                                <div class="card--attr__name fz-13 fw-400 text-center text-order">
                                    Ph????ng th???c thanh to??n
                                </div>
                                <div class="card--attr__value fz-13 fw-500">
                                    T??i kho???n Shopbrand
                                </div>
                            </div>
                            <div class="card--attr justify-content-between d-flex c-mb-8 text-center">
                                <div class="card--attr__name fw-400 fz-13 text-center">
                                    Ph?? thanh to??n
                                </div>
                                <div class="card--attr__value fz-13 fw-500">
                                    Mi???n ph??
                                </div>
                            </div>
                        </div>
                        <div class="card--gray c-mb-0 c-pt-8 c-pb-8 c-pl-12 brs-8 c-pr-12 g_mobile-content">
                            <div class="card--attr__total justify-content-between d-flex text-center">
                                <div class="card--attr__name fw-400 fz-13 text-center text-order">
                                    T???ng thanh to??n
                                </div>
                                <div class="card--attr__value fz-13 fw-500"><a href="javascript:void(0)" class="c-text-primary">{{ str_replace(',','.',number_format($data->price)) }} ??</a></div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="footer-mobile">
                    <div class="c-px-16 c-pt-16 group-btn" style="--data-between: 12px">
                        <button type="submit" class="btn primary">X??c nh???n</button>
                    </div>
                </div>
                </form>
            </div>

            <div class="step" id="step3">
                <div class="head-mobile">
                    <a href="javascript:void(0) " class="link-back close-step"></a>

                    <h1 class="head-title text-title">X??c nh???n thanh to??n</h1>

                    <a href="/" class="home"></a>
                </div>
                <div class="body-mobile">
                    <div class="body-mobile-content c-p-16">
                        <div class="dialog--content__title fw-700 fz-15 c-mb-12 text-title-theme">
                            Th??ng tin mua th???
                        </div>
                        <div class="card--gray c-mb-16 c-pt-8 c-pb-8 c-pl-12 c-pr-12 brs-8 g_mobile-content">
                            <div class="card--attr justify-content-between d-flex c-mb-8 text-center">
                                <div class="card--attr__name fw-400 fz-13 text-center text-order">
                                    Lo???i th???
                                </div>
                                <div class="card--attr__value fz-13 fw-500">10.000??</div>
                            </div>
                            <div class="card--attr justify-content-between d-flex c-mb-8 text-center">
                                <div class="card--attr__name fw-400 fz-13 text-center text-order">
                                    M???nh gi??
                                </div>
                                <div class="card--attr__value fz-13 fw-500">10.000??</div>
                            </div>
                            <div class="card--attr justify-content-between d-flex c-mb-8 text-cente text-order">
                                <div class="card--attr__name fw-400 fz-13 text-center">
                                    S??? l?????ng
                                </div>
                                <div class="card--attr__value fz-13 fw-500">01</div>
                            </div>
                            <div class="card--attr justify-content-between d-flex c-mb-8 text-center text-order">
                                <div class="card--attr__name fw-400 fz-13 text-center">
                                    Chi???t kh???u
                                </div>
                                <div class="card--attr__value fz-13 fw-500">1%</div>
                            </div>
                        </div>
                        <div class="card--gray c-mb-16 c-pt-8 c-pb-8 c-pl-12 c-pr-12 brs-8 g_mobile-content">
                            <div class="card--attr justify-content-between d-flex c-mb-8 text-center">
                                <div class="card--attr__name fz-13 fw-400 text-center text-order">
                                    Ph????ng th???c thanh to??n
                                </div>
                                <div class="card--attr__value fz-13 fw-500">
                                    T??i kho???n Shopbrand
                                </div>
                            </div>
                            <div class="card--attr justify-content-between d-flex c-mb-8 text-center">
                                <div class="card--attr__name fw-400 fz-13 text-center">
                                    Ph?? thanh to??n
                                </div>
                                <div class="card--attr__value fz-13 fw-500">
                                    Mi???n ph??
                                </div>
                            </div>
                        </div>
                        <div class="card--gray c-mb-0 c-pt-8 c-pb-8 c-pl-12 brs-8 c-pr-12 g_mobile-content">
                            <div class="card--attr__total justify-content-between d-flex text-center">
                                <div class="card--attr__name fw-400 fz-13 text-center text-order">
                                    T???ng thanh to??n
                                </div>
                                <div class="card--attr__value fz-13 fw-500"><a href="javascript:void(0)" class="c-text-primary">9.900 ??</a></div>
                            </div>
                        </div>

                        <div class="dialog--content__title c-mt-24 fw-500 fz-15 c-mb-12 text-title-theme">
                            Th??ng tin tr??? g??p
                        </div>

        {{--                Thoong tin tra gop    --}}
                        <div class="card--gray c-mb-16 c-pt-8 c-pb-8 c-pl-12 c-pr-12 brs-8 g_mobile-content">
                            <div class="c-mt-8">
                                <label class="c-mb-4 fw-500 fz-13 lh-20">Tr??? l???n 1</label>
                                <div class="col-md-12 p-0">
                                    <input type="text" name="" id="" placeholder="placeholder">
                                </div>
                            </div>
                            <div class="c-mt-8">
                                <label class="c-mb-4 fw-500 fz-13 lh-20">Tr??? l???n 2</label>
                                <div class="col-md-12 p-0">
                                    <input type="text" name="" id="" placeholder="placeholder">
                                </div>
                            </div>
                            <div class="c-mt-12">
                                <label class="c-mb-4 fw-500 fz-13 lh-20">M?? b???o v???</label>
                                <div class="col-md-12 p-0 d-flex">
                                    <input class="input-form w-100" type="text" placeholder="Nh???p m?? b???o v???">
                                    <div class="c-ml-8 c-mr-8">
                                        <div>
                                            <span>
                                                  <img class="lazy" src="/assets/frontend/{{theme('')->theme_key}}/image/son/macacha.png" alt="">
                                            </span>
                                        </div>
                                    </div>
                                    <button class="refresh-captcha">
                                        <img class="lazy" src="/assets/frontend/{{theme('')->theme_key}}/image/son/refresh.png" alt="">
                                    </button>

                                </div>
                            </div>
                        </div>


                        <div class="dialog--content__title c-mt-24 fw-500 fz-13 c-mb-12 text-title-theme">
                            Quy ?????nh tr??? g??p
                        </div>
                        <div class="c-mt-8 m_content-tra-gop brs-8">
                            <div class="col-md-12 c-py-12 c-px-8">
                                <ul class="c-pl-20">
                                    <li>Tr??? g??p ban ?????u 20% gi?? tr??? t??i kho???n d??? ki???n mua ????? gi??? t??i kho???n. ??p d???ng cho t??i kho???n tr??? gi?? t??? 200.000?? tr??? l??n.</li>
                                    <li>Th???i gian tr??? g??p: 7 ng??y. Kh??ng t??nh ng??y x??c nh???n tr??? g??p.</li>
                                    <li>Ph?? tr??? g??p: 0%</li>
                                    <li>Trong th???i gian tr??? g??p b???n ph???i ho??n t???t ph???n c??n l???i ????? giao d???ch ho??n t???t.</li>
                                    <li>Tr?????ng h???p qu?? th???i gian tr??? g??p giao d???ch c???a b???n s??? t??? ?????ng b??? h???y b??? v?? ho??n l???i 20% s??? ti???n ???? g??p ban ?????u.L??c n??y t??i kho???n ???????c t??? do. (V?? d???: t??i kho???n c???n mua tr??? gi?? 1 tri???u, tr??? g??p ban ?????u 200.000??.</li>
                                    <li>N???u qu?? th???i gian giao d???ch tr??? g??p b??? h???y b??? th?? b???n s??? nh???n l???i 20% t???c 40.000?? trong t??i kho???n) Quy tr??nh giao d???ch ?????u x??? l?? t??? ?????ng, b???n kh??ng th??? g???i h??? tr??? gia h???n th??m ng??y tr??? g??p ho???c ?????i kh??c quy ?????nh tr??n.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="footer-mobile">
                    <div class="c-px-16 c-pt-16 group-btn" style="--data-between: 12px">
                        <button class="btn primary btn-success-mobile">X??c nh???n</button>
                    </div>
                </div>
            </div>
</section>
    @else
        <div class="item_buy">

            <div class="container pt-3">
                <div class="row pb-3 pt-3">
                    <div class="col-md-12 text-center">
                        <span style="color: red;font-size: 16px;">
                            T??i kho???n kh??ng t???n t???i,ho???c ???? ???????c mua!
                        </span>
                    </div>
                </div>

            </div>

        </div>
    @endif
@endif

{{--    Modal x??c nh???n thanh to??n--}}
<div class="modal fade modal-big loadModal__acount" id="orderModal">
    <div class="modal-dialog modal-dialog-centered modal-custom">
        <div class="modal-content c-p-24">
            <form class="formDonhangAccount" action="/acc/{{ $data->randId }}/databuy" method="POST">
                {{ csrf_field() }}
            <div class="modal-header">
                <h2 class="modal-title center">X??c nh???n thanh to??n</h2>
                <button type="button" class="close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body pl-0 pr-0 c-pt-24 c-pb-24">
                <div class="dialog--content__title fw-700 fz-13 c-mb-12 text-title-theme">
                    Th??ng tin mua Acc
                </div>
                <div class="card--gray c-mb-16 c-pt-8 c-pb-8 c-pl-12 c-pr-12">
                    <div class="card--attr justify-content-between d-flex c-mb-16 text-center">
                        <div class="card--attr__name fw-400 fz-13 text-center">
                            Game
                        </div>
                        <div class="card--attr__value fz-13 fw-500">{{ isset($data->category->custom->title) ? $data->category->custom->title :  $data->category->title }}</div>
                    </div>
                    <div class="card--attr justify-content-between d-flex c-mb-16 text-center">
                        <div class="card--attr__name fw-400 fz-13 text-center">
                            Gi?? ti???n
                        </div>
                        <div class="card--attr__value fz-13 fw-500">{{ str_replace(',','.',number_format($data->price)) }} ??</div>
                    </div>
                </div>


                <div class="card--gray c-mb-16 c-pt-8 c-pb-8 c-pl-12 c-pr-12">

                    @if(isset($data->groups))
                        <?php $att_values = $data->groups ?>
                        @foreach($att_values as $att_value)
                            @if($att_value->module == 'acc_label' && $att_value->is_slug_override == null)
                                @if(isset($att_value->parent))
                                    <div class="card--attr justify-content-between d-flex c-mb-16 text-center">
                                        <div class="card--attr__name fw-400 fz-13 text-center">
                                            {{ $att_value->parent->title??null }}
                                        </div>
                                        <div class="card--attr__value fz-13 fw-500">{{ $att_value->title??null }}</div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endif

                    @if(isset($data->params) && isset($data->params->ext_info))
                        <?php $params = json_decode(json_encode($data->params->ext_info),true) ?>
                        @foreach($params as $key => $param)
                            <div class="card--attr justify-content-between d-flex c-mb-16 text-center">
                                <div class="card--attr__name fw-400 fz-13 text-center">
                                    {{ $key }}
                                </div>
                                <div class="card--attr__value fz-13 fw-500">{{ $param }}</div>
                            </div>
                        @endforeach
                    @endif

                </div>

                <div class="card--gray c-mb-16 c-pt-8 c-pb-8 c-pl-12 c-pr-12">
                    <div class="card--attr justify-content-between d-flex c-mb-16 text-center">
                        <div class="card--attr__name fz-13 fw-400 text-center">
                            Ph????ng th???c thanh to??n
                        </div>
                        <div class="card--attr__value fz-13 fw-500">
                            T??i kho???n Shopbrand
                        </div>
                    </div>
                    <div class="card--attr justify-content-between d-flex c-mb-16 text-center">
                        <div class="card--attr__name fw-400 fz-13 text-center">
                            Ph?? thanh to??n
                        </div>
                        <div class="card--attr__value fz-13 fw-500">
                            Mi???n ph??
                        </div>
                    </div>
                </div>
                <div class="card--gray c-mb-0 c-pt-8 c-pb-8 c-pl-12 c-pr-12">
                    <div class="card--attr__total justify-content-between d-flex c-mb-16 text-center">
                        <div class="card--attr__name fw-400 fz-13 text-center">
                            T???ng thanh to??n
                        </div>
                        <div class="card--attr__value fz-13 fw-500"><a href="javascript:void(0)" class="c-text-primary">{{ str_replace(',','.',number_format($data->price)) }} ??</a></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn primary">X??c nh???n</button>
            </div>
            </form>
        </div>
    </div>
</div>

{{--    Modal x??c nh???n thanh to??n--}}
<div class="modal fade modal-big" id="orderModalNot">
    <div class="modal-dialog modal-dialog-centered modal-custom">
        <div class="modal-content c-p-24">
            <div class="modal-header">
                <h2 class="modal-title center">X??c nh???n thanh to??n</h2>
                <button type="button" class="close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body pl-0 pr-0 c-pt-24 c-pb-24">
                <div class="dialog--content__title fw-700 fz-13 c-mb-12 text-title-theme">
                    Th??ng tin mua th???
                </div>
                <div class="card--gray c-mb-16 c-pt-8 c-pb-8 c-pl-12 c-pr-12">
                    <div class="card--attr justify-content-between d-flex c-mb-16 text-center">
                        <div class="card--attr__name fw-400 fz-13 text-center">
                            Lo???i th???
                        </div>
                        <div class="card--attr__value fz-13 fw-500">10.000??</div>
                    </div>
                    <div class="card--attr justify-content-between d-flex c-mb-16 text-center">
                        <div class="card--attr__name fw-400 fz-13 text-center">
                            M???nh gi??
                        </div>
                        <div class="card--attr__value fz-13 fw-500">10.000??</div>
                    </div>
                    <div class="card--attr justify-content-between d-flex c-mb-16 text-center">
                        <div class="card--attr__name fw-400 fz-13 text-center">
                            S??? l?????ng
                        </div>
                        <div class="card--attr__value fz-13 fw-500">01</div>
                    </div>
                    <div class="card--attr justify-content-between d-flex c-mb-16 text-center">
                        <div class="card--attr__name fw-400 fz-13 text-center">
                            Chi???t kh???u
                        </div>
                        <div class="card--attr__value fz-13 fw-500">1%</div>
                    </div>
                </div>
                <div class="card--gray c-mb-16 c-pt-8 c-pb-8 c-pl-12 c-pr-12">
                    <div class="card--attr justify-content-between d-flex c-mb-16 text-center">
                        <div class="card--attr__name fz-13 fw-400 text-center">
                            Ph????ng th???c thanh to??n
                        </div>
                        <div class="card--attr__value fz-13 fw-500">
                            T??i kho???n Shopbrand
                        </div>
                    </div>
                    <div class="card--attr justify-content-between d-flex c-mb-16 text-center">
                        <div class="card--attr__name fw-400 fz-13 text-center">
                            Ph?? thanh to??n
                        </div>
                        <div class="card--attr__value fz-13 fw-500">
                            Mi???n ph??
                        </div>
                    </div>
                </div>
                <div class="card--gray c-mb-0 c-pt-8 c-pb-8 c-pl-12 c-pr-12">
                    <div class="card--attr__total justify-content-between d-flex c-mb-16 text-center">
                        <div class="card--attr__name fw-400 fz-13 text-center">
                            T???ng thanh to??n
                        </div>
                        <div class="card--attr__value fz-13 fw-500"><a href="javascript:void(0)" class="c-text-primary">9.900 ??</a></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn primary">X??c nh???n</button>

            </div>
        </div>
    </div>
</div>
