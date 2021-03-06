@if(empty($data->data))
    <div class="col-md-12 left-right">
        <div class="row marginauto body-detail-ct">
            @if(isset($items) && count($items) > 0)

                <div class="col-md-12 text-left left-right">
                    <div class="row body-detail-row-ct">

                        @foreach ($items as $item)

                            @if($item->status == 1)
                                @if($data->display_type == 2)
                                    <div class="col-auto body-detail-nick-col-ct">
                                        <a href="javascript:void(0)" class="list-item-nick-hover">
                                            <div class="row marginauto">
                                                <div class="col-md-12 left-right default-overlay-nick-ct nick-item-cover-overlay">
                                                    @if(isset($data->params->thumb_default) && isset($data->params))
                                                        <img class="img-list-nick-category lazy" src="{{\App\Library\MediaHelpers::media($data->params->thumb_default)}}" alt="{{ $item->randId }}" >
                                                    @else
                                                        @if(isset($item->image))
                                                            <img class="img-list-nick-category lazy" src="{{\App\Library\MediaHelpers::media($item->image)}}" alt="{{ $item->randId }}">
                                                        @else
                                                            <img class="img-list-nick-category lazy" src="/assets/frontend/{{theme('')->theme_key}}/image/images_1/no-image.png" alt="No-image">
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="col-md-12 left-right list-item-nick">
                                                    <div class="row marginauto list-item-nick-body">
                                                        <div class="col-md-12 left-right text-left body-detail-account-col-span-ct">
                                                            <span>ID: {{ $item->randId }}</span>
                                                        </div>

                                                        <div class="col-md-12 left-right text-left body-detail-account-small-span-ct">
                                                            <ul>
                                                                @if(isset($data->params) && isset($data->params->price))
                                                                    <li class="fist-li-account">{{ str_replace(',','.',number_format($data->params->price)) }}??</li>
                                                                    <li class="second-li-account">{{ str_replace(',','.',number_format($data->params->price_old??$data->params->price)) }}??</li>
                                                                    @php
                                                                        if (isset($data->params->price_old)) {
                                                                            $sale_percent = (($data->params->price_old - $data->params->price) / $data->params->price_old) * 100;
                                                                            $sale_percent = round($sale_percent, 0, PHP_ROUND_HALF_UP);
                                                                        } else {
                                                                            $sale_percent = 0;
                                                                        }
                                                                    @endphp
                                                                    <li class="three-li-account">-{{$sale_percent}}%</li>
                                                                @else
                                                                    <li class="fist-li-account">{{ str_replace(',','.',number_format($item->price)) }}??</li>
                                                                    <li class="second-li-account">{{ str_replace(',','.',number_format($item->price_old??$item->price)) }}??</li>
                                                                    @php
                                                                        if (isset($item->price_old)) {
                                                                            $sale_percent = (($item->price_old - $item->price) / $item->price_old) * 100;
                                                                            $sale_percent = round($sale_percent, 0, PHP_ROUND_HALF_UP);
                                                                        } else {
                                                                            $sale_percent = 0;
                                                                        }
                                                                    @endphp
                                                                    <li class="three-li-account">-{{$sale_percent}}%</li>
                                                                @endif
                                                            </ul>
                                                        </div>

                                                        <button class="button-secondary list-item-nick-button buy-random-acc" data-id="{{ $item->randId }}">Mua ngay</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="formDonhangAccount{{ $item->randId }}" style="display: none">
                                        <form class="formDonhangAccount" action="/acc/{{ $item->randId }}/databuy" method="POST">
                                            {{ csrf_field() }}
                                            <div class="modal-header p-0" style="border-bottom: 0">
                                                <div class="row marginauto modal-header-order-ct">
                                                    <div class="col-12 span__donhang text-center" style="position: relative">
                                                        <span>X??c nh???n thanh to??n</span>
                                                        <img class="lazy img-close-ct close-modal-default" src="/assets/frontend/{{theme('')->theme_key}}/image/cay-thue/close.png" alt="">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="modal-body modal-body-order-ct">
                                                <div class="row marginauto">

                                                    <div class="col-md-12 left-right title-order-ct">
                                                        <span>Th??ng tin acc</span>
                                                    </div>

                                                    <div class="col-md-12 left-right" id="order-errors">
                                                        <div class="row marginauto order-errors">
                                                            <div class="col-md-12 left-right">
                                                                @if(App\Library\AuthCustom::check())
                                                                    @if(App\Library\AuthCustom::user()->balance < $data->params->price)
                                                                        <small>B???n kh??ng ????? s??? d?? ????? mua t??i kho???n n??y. B???n h??y click v??o n??t n???p th??? ????? n???p th??m v?? mua t??i kho???n.</small>
                                                                    @endif
                                                                @else
                                                                    <small>B???n ph???i ????ng nh???p m???i c?? th??? mua t??i kho???n t??? ?????ng.</small>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @if (App\Library\AuthCustom::check())
                                                        <div class="col-md-12 left-right padding-order-ct">
                                                            <div class="row marginauto">
                                                                <div class="col-md-12 left-right background-order-ct">
                                                                    <div class="row marginauto background-order-row-ct">
                                                                        <div class="col-auto left-right background-order-col-left-ct">
                                                                            <span>T??i kho???n</span>
                                                                        </div>
                                                                        <div class="col-auto left-right background-order-col-right-ct">
                                                                            <small>{{ App\Library\AuthCustom::user()->username }}</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif


                                                    <div class="col-md-12 left-right padding-order-ct">
                                                        <div class="row marginauto">
                                                            <div class="col-md-12 left-right background-order-ct">
                                                                <div class="row marginauto background-order-body-row-ct">
                                                                    <div class="col-auto left-right background-order-col-left-ct">
                                                                        <span>Nh?? ph??t h??nh</span>
                                                                    </div>
                                                                    <div class="col-auto left-right background-order-col-right-ct">
                                                                        <small>{{ $item->groups[0]->title }}</small>
                                                                    </div>
                                                                </div>

                                                                <div class="row marginauto background-order-body-row-ct">
                                                                    <div class="col-auto left-right background-order-col-left-ct">
                                                                        <span>T??n game</span>
                                                                    </div>
                                                                    <div class="col-auto left-right background-order-col-right-ct">
                                                                        <small>{{ isset($data->custom->title) ? $data->custom->title :  $data->title }}</small>
                                                                    </div>
                                                                </div>

                                                                <div class="row marginauto background-order-body-row-ct">
                                                                    <div class="col-auto left-right background-order-col-left-ct">
                                                                        <span>Gi?? ti???n</span>
                                                                    </div>
                                                                    <div class="col-auto left-right background-order-col-right-ct">
                                                                        <small>
                                                                            @if(isset($data->params) && isset($data->params->price))
                                                                                {{ str_replace(',','.',number_format($data->params->price)) }}??
                                                                            @else
                                                                                {{ str_replace(',','.',number_format($item->price)) }}??
                                                                            @endif
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 left-right padding-order-ct">
                                                        <div class="row marginauto">
                                                            <div class="col-md-12 left-right background-order-ct">

                                                                @if(isset($item->groups))
                                                                    <?php $att_values = $item->groups ?>
                                                                    @foreach($att_values as $att_value)
                                                                        @if($att_value->module == 'acc_label' && $att_value->is_slug_override == null)
                                                                            @if(isset($att_value->parent))
                                                                                <div class="row marginauto background-order-body-row-ct">
                                                                                    <div class="col-auto left-right background-order-col-left-ct">
                                                                                        <span>{{ $att_value->parent->title??null }}</span>
                                                                                    </div>
                                                                                    <div class="col-auto left-right background-order-col-right-ct">
                                                                                        <small>{{ $att_value->title??null }}</small>
                                                                                    </div>
                                                                                </div>
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
                                                                                                <div class="row marginauto background-order-body-row-ct">
                                                                                                    <div class="col-auto left-right background-order-col-left-ct">
                                                                                                        <span>{{ $child->title }}</span>
                                                                                                    </div>
                                                                                                    <div class="col-auto left-right background-order-col-right-ct">
                                                                                                        <small>{{ $param }}</small>
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    @endforeach
                                                                                @endif

                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @endif

                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 left-right padding-order-ct">
                                                        <div class="row marginauto">
                                                            <div class="col-md-12 left-right background-order-ct">
                                                                <div class="row marginauto background-order-row-ct">
                                                                    <div class="col-auto left-right background-order-col-left-ct">
                                                                        <span>T???ng thanh to??n</span>
                                                                    </div>
                                                                    <div class="col-auto left-right background-order-col-right-ct">
                                                                        <span>
                                                                            @if(isset($data->params) && isset($data->params->price))
                                                                                {{ str_replace(',','.',number_format($data->params->price)) }}??
                                                                            @else
                                                                                {{ str_replace(',','.',number_format($item->price)) }}??
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 left-right padding-order-footer-ct">
                                                        <div class="row marginauto">
                                                            <div class="col-md-12 left-right">
                                                                @if(App\Library\AuthCustom::check())

                                                                    @if(App\Library\AuthCustom::user()->balance >= $data->params->price)
                                                                        <button class="button-default-ct button-next-step-two" type="submit">X??c nh???n</button>
                                                                    @else
                                                                        <div class="row marginauto justify-content-center gallery-right-footer">
                                                                            <div class="col-md-6 col-6 modal-footer-success-col-left-ct">
                                                                                <div class="row marginauto">
                                                                                    <div class="col-md-12 left-right">
                                                                                        <a href="/nap-the" class="btn -secondary btn-big">Th??? c??o</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-6 modal-footer-success-col-right-ct">
                                                                                <div class="row marginauto">
                                                                                    <div class="col-md-12 left-right">
                                                                                        <a href="/recharge-atm" class="btn -secondary btn-big">ATM, Momo</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @else
                                                                    <button class="button-default-ct" type="button" onclick="openLoginModal();">????ng nh???p</button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @else
                                    <div class="col-auto body-detail-nick-col-ct">
                                        <a href="/acc/{{ $item->randId }}" class="list-item-nick-hover">
                                            <div class="row marginauto">
                                                <div class="col-md-12 left-right default-overlay-nick-ct nick-item-cover-overlay">
                                                    @if(isset($item->image))
                                                        <img class="img-list-nick-category lazy" src="{{\App\Library\MediaHelpers::media($item->image)}}" alt="{{ $item->randId }}">
                                                    @else
                                                        <img class="img-list-nick-category lazy" src="/assets/frontend/{{theme('')->theme_key}}/image/images_1/no-image.png" alt="No-image">
                                                    @endif
                                                </div>
                                                <div class="col-md-12 left-right list-item-nick">
                                                    <div class="row marginauto list-item-nick-body">
                                                        {{--<div class="col-md-12 left-right text-left body-detail-account-col-span-ct">
                                                            <span>{{ $item->title }}</span>
                                                        </div>--}}
                                                        <div class="col-md-12 left-right text-left body-detail-account-col-span-ct">
                                                            <span>ID: {{ $item->randId }}</span>
                                                        </div>
                                                        <?php
                                                            $total = 0;
                                                        ?>
                                                        @if(isset($item->groups))
                                                            <?php
                                                                $att_values = $item->groups;
                                                            ?>
                                                            @foreach($att_values as $att_value)
                                                                @if($att_value->module == 'acc_label' && $att_value->is_slug_override == null)
                                                                    @if(isset($att_value->parent))
                                                                        @if($total < 4)
                                                                            <?php
                                                                                $total = $total + 1;
                                                                            ?>

                                                                            <div class="col-md-12 left-right text-left body-detail-account-small-span-ct">
                                                                                <small>{{ $att_value->parent->title??null }}: {{ isset($att_value->title)? \Str::limit($att_value->title,16) : null }}</small>
                                                                            </div>

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

                                                                                                <div class="col-md-12 left-right text-left body-detail-account-small-span-ct">
                                                                                                    <small>{{ $child->title??null }}: {{ isset($param) ? \Str::limit($param,16) : null }}</small>
                                                                                                </div>
                                                                                            @else
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

                                                        @if ($total < 4)
                                                            @for ($i = 0; $i < 4 - $total; $i++)
                                                                <div class="col-md-12 left-right text-left body-detail-account-small-span-ct"></div>
                                                            @endfor
                                                        @endif

                                                        <div class="col-md-12 left-right text-left body-detail-account-small-span-ct">
                                                            <ul>
                                                                @if(isset($data->params) && isset($data->params->price))
                                                                    <li class="fist-li-account">{{ str_replace(',','.',number_format($data->params->price)) }}??</li>
                                                                    <li class="second-li-account">{{ str_replace(',','.',number_format($data->params->price_old??$data->params->price)) }}??</li>
                                                                    @php
                                                                        if (isset($data->params->price_old)) {
                                                                            $sale_percent = (($data->params->price_old - $data->params->price) / $data->params->price_old) * 100;
                                                                            $sale_percent = round($sale_percent, 0, PHP_ROUND_HALF_UP);
                                                                        } else {
                                                                            $sale_percent = 0;
                                                                        }
                                                                    @endphp
                                                                    <li class="three-li-account">-{{$sale_percent}}%</li>
                                                                @else
                                                                    <li class="fist-li-account">{{ str_replace(',','.',number_format($item->price)) }}??</li>
                                                                    <li class="second-li-account">{{ str_replace(',','.',number_format($item->price_old??$item->price)) }}??</li>
                                                                    @php
                                                                        if (isset($item->price_old)) {
                                                                            $sale_percent = (($item->price_old - $item->price) / $item->price_old) * 100;
                                                                            $sale_percent = round($sale_percent, 0, PHP_ROUND_HALF_UP);
                                                                        } else {
                                                                            $sale_percent = 0;
                                                                        }
                                                                    @endphp
                                                                    <li class="three-li-account">-{{$sale_percent}}%</li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif

                            @endif

                        @endforeach

                    </div>
                </div>
            @else
            @endif

            <div class="col-md-12 left-right justify-content-end default-paginate">
                @if(isset($items))
                    @if($items->total()>1)

                        <div class="row marinautooo justify-content-center">
                            <div class="col-auto">
                                <div class="data_paginate paginate__v1 paging_bootstrap paginations_custom" style="text-align: center">
                                    {{ $items->appends(request()->query())->links('pagination::bootstrap-default-4') }}
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>

        </div>
    </div>
@endif
