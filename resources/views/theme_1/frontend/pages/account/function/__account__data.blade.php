@if(empty($data->data))

    @if(isset($items) && count($items) > 0)
        <div class="item_buy_list row">
            @foreach ($items as $item)

{{--                Nick random--}}
                @if($item->status == 1)
                    @if($data->display_type == 2)

                        <div class="col-6 col-sm-6 col-lg-3">
                            <div class="item_buy_list_in">
                                <div class="item_buy_list_img">
                                    <a href="javascript:void(0)" class="buyacc" data-id="{{ $item->randId }}">
                                        @if(isset($item->image))
                                            <img class="item_buy_list_img-main" src="https://media-tt.nick.vn/{{ $item->image }}" alt="{{ $item->title }}">
                                        @else
                                            <img class="item_buy_list_img-main" src="https://shopas.net/storage/images/CGuYto7yjj_1645585924.jpg" alt="{{ $item->title }}">
                                        @endif

                                        <span>MS: {{ $item->randId }}</span>
                                    </a>
                                </div>
                                <div class="item_buy_list_description">
                                    bảo hành 100%,lỗi hoàn tiền
                                </div>
                                <div class="item_buy_list_info">
                                    <div class="row item_buy_list_info__row">
                                        <?php
                                        $index = 0;
                                        ?>
                                        @if(isset($item->groups))
                                            <?php
                                            $att_values = $item->groups;
                                            ?>
                                            @foreach($att_values as $att_value)
                                                {{--                                            @dd($att_value)--}}
                                                @if($att_value->module == 'acc_label' && $att_value->is_slug_override == null)
                                                    <?php
                                                    $index++;
                                                    ?>
                                                    @if($index < 5)
                                                        <div class="col-6 item_buy_list_info_in">
                                                            {{ $att_value->parent[0]->title }} : <b>{{ $att_value->title }}</b>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif

                                        @if(isset($item->params) && isset($item->params->ext_info))
                                            <?php
                                            $params = json_decode(json_encode($item->params->ext_info),true);
                                            ?>
                                            @if($index < 5)

                                                @if(!is_null($dataAttribute) && count($dataAttribute)>0)
                                                    @foreach($dataAttribute as $index=>$att)
                                                        @if($att->position == 'text')
                                                            @if(isset($att->childs))
                                                                @foreach($att->childs as $child)
                                                                    @foreach($params as $key => $param)
                                                                        @if($key == $child->id && $child->is_slug_override == null)
                                                                            <?php
                                                                            $index++;
                                                                            ?>
                                                                            @if($index < 5)
                                                                                <div class="col-6 item_buy_list_info_in">
                                                                                    {{ $child->title }} : <b>{{ $param }}</b>
                                                                                </div>
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
                                    </div>
                                </div>
                                <div class="item_buy_list_more">
                                    <div class="row">
                                        <div class="col-6 ">
                                            <div class="item_buy_list_price2 p7">
                                                {{ formatPrice($item->price) }}đ
                                            </div>

                                        </div>
                                        <a href="javascript:void(0)" class="col-6 buyacc" data-id="{{ $item->randId }}">
                                            <div class="item_buy_list_view">
                                                Mua ngay
                                            </div>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        {{--                    Nick thường--}}
                        <div class="col-6 col-sm-6 col-lg-3">
                            <div class="item_buy_list_in">
                                <div class="item_buy_list_img">
                                    <a href="/acc/{{ $item->randId }}">
                                        @if(isset($item->image))
                                            <img class="item_buy_list_img-main" src="https://media-tt.nick.vn/{{ $item->image }}" alt="{{ $item->title }}">
                                        @else
                                            <img class="item_buy_list_img-main" src="https://shopas.net/storage/images/CGuYto7yjj_1645585924.jpg" alt="{{ $item->title }}">
                                        @endif

                                        <span>MS: {{ $item->randId }}</span>
                                    </a>
                                </div>
                                <div class="item_buy_list_description">
                                    bảo hành 100%,lỗi hoàn tiền
                                </div>
                                <div class="item_buy_list_info">
                                    <div class="row item_buy_list_info__row">
                                        <?php
                                        $index = 0;
                                        ?>
                                        @if(isset($item->groups))
                                            <?php
                                            $att_values = $item->groups;
                                            ?>
                                            @foreach($att_values as $att_value)
                                                {{--                                            @dd($att_value)--}}
                                                @if($att_value->module == 'acc_label' && $att_value->is_slug_override == null)
                                                    <?php
                                                    $index++;
                                                    ?>
                                                    @if($index < 5)
                                                        <div class="col-6 item_buy_list_info_in">
                                                            {{ $att_value->parent[0]->title }} : <b>{{ $att_value->title }}</b>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
                                        {{--                                        @dd($item)--}}
                                        @if(isset($item->params) && isset($item->params->ext_info))
                                            <?php
                                            $params = json_decode(json_encode($item->params->ext_info),true);
                                            ?>
                                            @if($index < 5)
                                                @if(!is_null($dataAttribute) && count($dataAttribute)>0)
                                                    @foreach($dataAttribute as $index=>$att)
                                                        @if($att->position == 'text')
                                                            @if(isset($att->childs))
                                                                @foreach($att->childs as $child)
                                                                    @foreach($params as $key => $param)
                                                                        @if($key == $child->id && $child->is_slug_override == null)
                                                                            <?php
                                                                            $index++;
                                                                            ?>
                                                                            @if($index < 5)
                                                                                <div class="col-6 item_buy_list_info_in">
                                                                                    {{ $child->title }} : <b>{{ $param }}</b>
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                        {{--                                                                    @if(\App\Library\AuthCustom::check() && $key == $child->id && $child->is_slug_override != null)--}}
                                                                        {{--                                                                        <?php--}}
                                                                        {{--                                                                        $index++;--}}
                                                                        {{--                                                                        ?>--}}
                                                                        {{--                                                                        @if($index < 5)--}}
                                                                        {{--                                                                            <div class="col-6 item_buy_list_info_in">--}}
                                                                        {{--                                                                                {{ $child->title }} : <b>{{ $param }}</b>--}}
                                                                        {{--                                                                            </div>--}}
                                                                        {{--                                                                        @endif--}}
                                                                        {{--                                                                    @endif--}}
                                                                    @endforeach
                                                                @endforeach
                                                            @endif

                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="item_buy_list_more">
                                    <div class="row">
                                        <div class="col-12 ">
                                            <div class="item_buy_list_price">
                                                <span>{{ formatPrice($item->price_old) }}đ </span>
                                                {{ formatPrice($item->price) }}đ
                                            </div>

                                        </div>
                                        <a href="/acc/{{ $item->randId }}" class="col-12">
                                            <div class="item_buy_list_view">
                                                Chi tiết
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endif
                @endif
            @endforeach
        </div>
    @else
        <div class="row pb-3 pt-3">
            <div class="col-md-12 text-center">
                <span style="color: red;font-size: 16px;">Hiện tại không có tài khoản nào phù hợp với yêu cầu của bạn! Hệ thống cập nhật nick thường xuyên bạn vui lòng theo dõi web trong thời gian tới !</span>
            </div>
        </div>
    @endif

    <div class="col-md-12 left-right justify-content-end paginate__v1 paginate__v1_mobie frontend__panigate">

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





