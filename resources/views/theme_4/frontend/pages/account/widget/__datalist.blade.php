@if(empty($data->data))

    @if(isset($items) && count($items) > 0)

        <div class="row fix-border">
            @foreach ($items as $item)

                @if($item->status == 1)
                    @if($data->display_type == 2)

                        <div class="col-md-3 col-sm-6 col-6 entries_item" style="display: block">
                            <a href="javascript:void(0)" class="{{ App\Library\AuthCustom::check()?'buyacc':'nick-checkdangnhap' }}" data-id="{{ $item->randId }}">
                                @if(isset($data->params->thumb_default) && isset($data->params))
                                    <img class="entries_item-img lazy item_buy_list_img-main{{ $item->randId }}" src="{{\App\Library\MediaHelpers::media($data->params->thumb_default)}}" alt="{{ $item->title }}" class="entries_item-img">
                                @endif

                                <h2 class="text-title text-left  fw-bold" style="color: #434657;margin-bottom: 8px;font-weight: 700">#{{ $item->randId }}</h2>

                                <?php
                                $total = 0;
                                ?>
                                @if(isset($item->groups))
                                    <?php
                                    $att_values = $item->groups;
                                    ?>
                                    @foreach($att_values as $att_value)
                                        {{--            @dd($att_value)--}}
                                        @if($att_value->module == 'acc_label' && $att_value->is_slug_override == null)
                                            {{--                                                        @dd($att_value->parent)--}}
                                            @if(isset($att_value->parent))
                                                @if($total < 4)
                                                    <?php
                                                    $total = $total + 1;
                                                    ?>
                                                    <p class="text-left" style="color: #82869E;margin-bottom: 4px">{{ $att_value->parent->title??null }}: {{ isset($att_value->title)? \Str::limit($att_value->title,16) : null }}</p>
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                @endif

                                @if(isset($item->params) && isset($item->params->ext_info))
                                    <?php
                                    $params = json_decode(json_encode($item->params->ext_info),true);
                                    ?>

                                    @if($total < 4)
                                        @if(!is_null($dataAttribute) && count($dataAttribute)>0)
                                            @foreach($dataAttribute as $index=>$att)
                                                @if($att->position == 'text')
                                                    @if(isset($att->childs))
                                                        @foreach($att->childs as $child)
                                                            @foreach($params as $key => $param)
                                                                @if($key == $child->id && $child->is_slug_override == null)

                                                                    @if($total < 4)
                                                                        <?php
                                                                        $total = $total + 1;
                                                                        ?>
                                                                        <p class="text-left" style="color: #82869E;margin-bottom: 4px">{{ $child->title??null }}: {{ isset($param) ? \Str::limit($param,16) : null }}</p>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
                                    @endif
                                @endif

                                @php
                                    if (isset($data->params->price_old)) {
                                        $sale_percent = (($data->params->price_old - $data->params->price) / $data->params->price_old) * 100;
                                        $sale_percent = round($sale_percent, 0, PHP_ROUND_HALF_UP);
                                    } else {
                                        $sale_percent = 0;
                                    }
                                @endphp
                                @if(isset($data->params) && isset($data->params->price))
                                <h2 class="text-left" style="color: rgb(238, 70, 35);font-size: 16px;margin-bottom: 0;margin-top: 8px">{{ str_replace(',','.',number_format($data->params->price)) }}??</h2>
                                <p class="text-left" style="color: #82869E;margin-bottom: 0;font-size: 14px;text-decoration: line-through;">{{ str_replace(',','.',number_format($data->params->price_old??$data->params->price)) }}?? <span class="badge badge-success" style="margin-left: 4px;padding-top: 4px;background: rgb(238, 70, 35);">{{ $sale_percent }}%</span></p>
                                @endif

                                @if(App\Library\AuthCustom::check())
                                <button class="btn btn-danger btn-muangay" style="width: 100%;margin-top: 16px;background: rgb(238, 70, 35)">Mua ngay</button>
                                @else
                                <button class="btn btn-danger nick-checkdangnhap" style="width: 100%;margin-top: 16px;background: rgb(238, 70, 35)">Mua ngay</button>
                                @endif
                            </a>

                        </div>

                        <div class="form-random formDonhangAccount{{ $item->randId }}">
                            <form class="formDonhangAccount" action="/acc/{{ $item->randId }}/databuy" method="POST">
                                {{ csrf_field() }}

                                <div class="modal-header" style="padding-left: 16px;padding-right: 16px">
                                    <h4 class="modal-title">X??c nh???n mua t??i kho???n</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">??</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div class="c-content-tab-4 c-opt-3" role="tabpanel">
                                        <ul class="nav nav-justified nav-justified__ul" role="tablist">
                                            <li role="presentation" class="active justified__ul_li">
                                                <a href="#paymentv2{{ $item->randId }}" role="tab" data-toggle="tab" aria-selected="true" class="c-font-16 active paymentv2{{ $item->randId }}">Thanh to??n</a>
                                            </li>
                                            <li role="presentation" class="justified__ul_li">
                                                <a href="#infov2{{ $item->randId }}" role="tab" data-toggle="tab" aria-selected="false" class="c-font-16 infov2{{ $item->randId }}">Th??ng tin t??i kho???n</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active show tabpaymentv2{{ $item->randId }}" id="paymentv2{{ $item->randId }}">
                                                <ul class="c-tab-items p-t-0 p-b-0 p-l-5 p-r-5">
                                                    <li class="c-font-dark">
                                                        <table class="table table-striped">
                                                            <tbody>
                                                            <tr>
                                                                <th colspan="2">Th??ng tin t??i kho???n #{{ $item->randId }}</th>
                                                            </tr>
                                                            </tbody><tbody>
                                                            <tr>
                                                                <td>Nh?? ph??t h??nh:</td>
                                                                <th>{{ $item->groups[0]->title }}</th>
                                                            </tr>
                                                            <tr>
                                                                <td>T??n game:</td>
                                                                {{--                                    @dd($data_category)--}}
                                                                <th>{{ isset($data->custom->title) ? $data->custom->title :  $data->title }}</th>
                                                            </tr>
                                                            <tr>
                                                                <td>Gi?? ti???n:</td>
                                                                <th style="color: rgb(238, 70, 35)">
                                                                    @if(isset($data->params) && isset($data->params->price))
                                                                        {{ str_replace(',','.',number_format($data->params->price)) }}??
                                                                    @else
                                                                        {{ str_replace(',','.',number_format($item->price)) }}??
                                                                        {{--                                                {{ formatPrice($item->price) }}??--}}
                                                                    @endif
                                                                </th>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade tabinfov2{{ $item->randId }}" id="infov2{{ $item->randId }}">
                                                <ul class="c-tab-items p-t-0 p-b-0 p-l-5 p-r-5">
                                                    <li class="c-font-dark">
                                                        <table class="table table-striped">
                                                            <tbody>
                                                            <tr>
                                                                <th colspan="2">Chi ti???t t??i kho???n #{{ $item->randId }}</th>
                                                            </tr>
                                                            @if(isset($item->groups))
                                                                <?php $att_values = $item->groups ?>
                                                                @foreach($att_values as $att_value)
                                                                    @if($att_value->module == 'acc_label' && $att_value->is_slug_override == null)
                                                                        @if(isset($att_value->parent))
                                                                            <tr>
                                                                                <td style="width:50%">{{ $att_value->parent->title??null }}:</td>
                                                                                <td class="text-danger" style="font-weight: 700">{{ $att_value->title??null }}</td>
                                                                            </tr>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                            @if(isset($item->params) && isset($item->params->ext_info))
                                                                <?php $params = json_decode(json_encode($item->params->ext_info),true) ?>
                                                                @if(!is_null($dataAttribute) && count($dataAttribute)>0)
                                                                    @foreach($dataAttribute as $index=>$att)
                                                                        @if($att->position == 'text')
                                                                            @if(isset($att->childs))
                                                                                @foreach($att->childs as $child)
                                                                                    @foreach($params as $key => $param)
                                                                                        @if($key == $child->id)
                                                                                            <tr>
                                                                                                <td style="width:50%">{{ $child->title }}:</td>
                                                                                                <td class="text-danger" style="font-weight: 700">{{ $param }}</td>
                                                                                            </tr>
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endforeach
                                                                            @endif

                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            @endif
                                                            </tbody>
                                                        </table>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        $(document).ready(function () {
                                            $(document).on('click', '.paymentv2{{ $item->randId }}',function(e){
                                                e.preventDefault();
                                                $('.tabpaymentv2{{ $item->randId }}').addClass('in');
                                                $('.tabpaymentv2{{ $item->randId }}').addClass('active');
                                                $('.tabpaymentv2{{ $item->randId }}').addClass('show');

                                                $('.tabinfov2{{ $item->randId }}').removeClass('show');
                                                $('.tabinfov2{{ $item->randId }}').removeClass('active');
                                                $('.tabinfov2{{ $item->randId }}').removeClass('in');
                                            });

                                            $(document).on('click', '.infov2{{ $item->randId }}',function(e){
                                                e.preventDefault();
                                                $('.tabinfov2{{ $item->randId }}').addClass('in');
                                                $('.tabinfov2{{ $item->randId }}').addClass('active');
                                                $('.tabinfov2{{ $item->randId }}').addClass('show');

                                                $('.tabpaymentv2{{ $item->randId }}').removeClass('show');
                                                $('.tabpaymentv2{{ $item->randId }}').removeClass('active');
                                                $('.tabpaymentv2{{ $item->randId }}').removeClass('in');
                                            });
                                        })
                                    </script>
                                    <div class="form-group form-group_buyacc ">
                                        @if(App\Library\AuthCustom::check())

                                            @if(App\Library\AuthCustom::user()->balance < $data->params->price)
                                                <div class="col-md-12"><label class="form-control-label text-danger" style="text-align: center;margin: 10px 0; ">B???n kh??ng ????? s??? d?? ????? mua t??i kho???n n??y. B???n h??y click v??o n??t n???p th??? ????? n???p th??m v?? mua t??i kho???n.</label></div>
                                            @else
                                                <div class="col-md-12"><label class="form-control-label" style="text-align: center;margin: 10px 0; ">T??i kho???n c???a b???n ch??a c???u h??nh b???o m???t ODP n??n ch??? c???n click v??o n??t x??c nh???n mua ????? ho??n t???t giao d???ch</label></div>
                                            @endif

                                        @else
                                            <label class="col-md-12 form-control-label text-danger" style="text-align: center;margin: 10px 0; ">B???n ph???i ????ng nh???p m???i c?? th??? mua t??i kho???n t??? ?????ng.</label>
                                        @endif

                                    </div>

                                    <div style="clear: both"></div>
                                </div>

                                <div class="modal-footer">

                                    @if(App\Library\AuthCustom::check())

                                        @if(App\Library\AuthCustom::user()->balance < $data->params->price)
                                            <a class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold gallery__bottom__span_bg__2 btn-success" href="/nap-the" id="d3">N???p th??? c??o</a>
                                            <a class="btn c-bg-green-4 c-font-white c-btn-square c-btn-uppercase c-btn-bold load-modal gallery__bottom__span_bg__2 btn-success" style="color: #FFFFFF" href="/recharge-atm">N???p t??? ATM - V?? ??i???n t???</a>
                                        @else
                                            <button type="submit" class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold loginBox__layma__button__displayabs" style="background: rgb(238, 70, 35);color: #ffffff;position: relative"  id="d3">X??c nh???n mua<div class="row justify-content-center loading-data__muangay"></div></button>
                                        @endif
                                    @else
                                        <a class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold nick-checkdangnhap" style="background: rgb(238, 70, 35);color: #ffffff" href="javascript:void(0)">????ng nh???p</a>
                                    @endif
                                    <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">????ng</button>
                                </div>
                            </form>
                        </div>

                    @else
                        <div class="col-md-3 col-sm-6 col-6 entries_item" style="display: block">
                            <a href="/acc/{{ $item->randId }}">
                                <img src="{{\App\Library\MediaHelpers::media($item->image)}}"
                                     alt="{{ $item->title }}" class="entries_item-img">
                                <h2 class="text-title text-left  fw-bold" style="color: #434657;margin-bottom: 8px;font-weight: 700">#{{ $item->randId }}</h2>
                                <?php
                                $total = 0;
                                ?>
                                @if(isset($item->groups))
                                    <?php
                                    $att_values = $item->groups;
                                    ?>
                                    @foreach($att_values as $att_value)
                                        {{--            @dd($att_value)--}}
                                        @if($att_value->module == 'acc_label' && $att_value->is_slug_override == null)
                                            {{--                                                        @dd($att_value->parent)--}}
                                            @if(isset($att_value->parent))
                                                @if($total < 4)
                                                    <?php
                                                    $total = $total + 1;
                                                    ?>
                                                    <p class="text-left" style="color: #82869E;margin-bottom: 4px">{{ $att_value->parent->title??null }}: {{ isset($att_value->title)? \Str::limit($att_value->title,16) : null }}</p>
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                @endif

                                @if(isset($item->params) && isset($item->params->ext_info))
                                    <?php
                                    $params = json_decode(json_encode($item->params->ext_info),true);
                                    ?>

                                    @if($total < 4)
                                        @if(!is_null($dataAttribute) && count($dataAttribute)>0)
                                            @foreach($dataAttribute as $index=>$att)
                                                @if($att->position == 'text')
                                                    @if(isset($att->childs))
                                                        @foreach($att->childs as $child)
                                                            @foreach($params as $key => $param)
                                                                @if($key == $child->id && $child->is_slug_override == null)

                                                                    @if($total < 4)
                                                                        <?php
                                                                        $total = $total + 1;
                                                                        ?>
                                                                        <p class="text-left" style="color: #82869E;margin-bottom: 4px">{{ $child->title??null }}: {{ isset($param) ? \Str::limit($param,16) : null }}</p>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
                                    @endif
                                @endif
                                @php
                                    if (isset($item->price_old)) {
                                        $sale_percent = (($item->price_old - $item->price) / $item->price_old) * 100;
                                        $sale_percent = round($sale_percent, 0, PHP_ROUND_HALF_UP);
                                    } else {
                                        $sale_percent = 0;
                                    }
                                @endphp
                                <h2 class="text-left" style="color: rgb(238, 70, 35);font-size: 16px;margin-bottom: 0;margin-top: 8px">{{ str_replace(',','.',number_format($item->price)) }}??</h2>
                                <p class="text-left" style="color: #82869E;margin-bottom: 0;font-size: 14px;text-decoration: line-through;">{{ str_replace(',','.',number_format($item->price_old)) }}?? <span class="badge badge-success" style="margin-left: 4px;padding-top: 4px;background: rgb(238, 70, 35);">{{ $sale_percent }}%</span></p>
                            </a>
                        </div>
                    @endif
                @endif

            @endforeach
        </div>

    @else

    @endif

    <div class="col-md-12 left-right justify-content-end paginate__v1 paginate__v1_mobie frontend__panigate" style="padding-top: 24px">

        @if(isset($items))
            @if($items->total()>1)
                <div class="row marinautooo paginate__history paginate__history__fix justify-content-center">
                    <div class="col-auto paginate__category__col">
                        <div class="data_paginate paging_bootstrap paginations_custom" style="text-align: center">
                            {{ $items->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>

@endif
