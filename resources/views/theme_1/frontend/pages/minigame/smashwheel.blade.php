@extends('frontend.layouts.master')
@section('content')
    <div class="item_play">
        <div class="container">
            <div class="item_play_title">
                <p>{{$result->group->title}}</p>
                <div class="item_play_line"></div>

            </div>
            <div class="item_play_online_out">
                <div class="item_play_online"></div>
                @php
                    echo "Số người đang chơi: ".number_format($numPlay)." (".rand(3,10)." bạn chung)";
                @endphp
            </div>
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <marquee style="padding: 10px 0">{!!$currentPlayList!!}</marquee>
                    <div class="item_play_spin">
                        @if($result->checkVoucher==1)
                        <div class="item_play_spin_sale-off">
                            <input type="text" placeholder="Nhập mã giảm giá">
                        </div>
                        @endif

                        <div id="start-played" class="item_play_spin_shake">
                            <img src="{{config('api.url_media').$result->group->image_icon}}">
                        </div>
                        @if($result->checkPoint==1)
                        <div class="item_play_spin_progress">
                            <div class="item_play_spin_progress_bubble {{$result->pointuser > 99 ? 'clickgif' : ''}}" style="width: {{$result->pointuser<100?$result->pointuser:'100'}}%"></div>
                            <div class="item_play_spin_progress_percent">{{$result->pointuser}}/100 point</div>
                        </div>
                        @endif

                        <img src="{{config('api.url_media').$result->group->params->image_static}}" id="lac_lixi" style="width: 100%;max-width: 100%;opacity: 1;background: url({{config('api.url_media').$result->group->params->image_background}}) no-repeat center center;background-size: contain;" alt="">
                        <input type="hidden" value="{{config('api.url_media').$result->group->params->image_static}}" id="hdImageLD">
                        <input type="hidden" value="{{config('api.url_media').$result->group->params->image_animation}}" id="hdImageDapLu">
                    </div>
                    <div class="pyro" style="position: absolute;top: 0;left: 0;width: 182px;height: 37px;display:none"><div class="before"></div><div class="after"></div></div>
                    <div class="item_spin_dropdown">
                        <select name="" id="numrolllop">
                                <option value="1">Mua X1/{{$result->group->price/1000}}k 1 lần chơi</option>
                            @if($result->group->params->price_sticky_3 > 0))
                                <option value="3">Mua X3/{{$result->group->params->price_sticky_3/1000}}k 1 lần chơi</option>
                            @endif
                            @if($result->group->params->price_sticky_5 > 0))
                                <option value="5">Mua X5/{{$result->group->params->price_sticky_5/1000}}k 1 lần chơi</option>
                            @endif
                            @if($result->group->params->price_sticky_7 > 0))
                                <option value="7">Mua X7/{{$result->group->params->price_sticky_7/1000}}k 1 lần chơi</option>
                            @endif
                            @if($result->group->params->price_sticky_10 > 0))
                                <option value="10">Mua X10/{{$result->group->params->price_sticky_10/1000}}k 1 lần chơi</option>
                            @endif
                        </select>
                    </div>
                    <div class="item_spin_num_play">
                        Giá {{number_format($result->group->price)}}/lượt chơi
                    </div>

                    <div class="item_play_try">
                        @if($result->group->params->is_try == 1)
                        <a class="btn btn-primary num-play-try">Chơi thử</a>
                        @endif
                        <a class="btn btn-success" id="start-played"><i class="fas fa-bolt"></i> chơi ngay</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="item_play_category">
                        <a href="#" class="col-sm-12 btn btn-success" data-toggle="modal" data-target="#theleModal">Thể lệ</a>
                    </div>
                    <div class="item_play_category">
                        <a class="btn btn-success col-sm-12" data-toggle="modal" data-target="#luotquayModal">Lượt chơi gần đây</a>
                    </div>
                    <div class="item_play_category">
                        <a href="{{route('getLog',[$result->group->id])}}" class="col-sm-12 btn btn-success">Lịch sử chơi</a>
                    </div>
                    <div class="item_play_category">
                        <a href="#" class="col-sm-12 btn btn-success" data-toggle="modal" data-target="#topquaythuongModal">Top quay thưởng</a>
                    </div>
                </div>
            </div>
            @if($groups_other!=null)
            <div class="item_play_title">
                <p>Các vòng minigame khác</p>
                <div class="item_play_line"></div>

            </div>
            <div class="item_play_dif">
                <div class="row" style="position: relative">
                    <div class="col-12 item_play_dif_slide" >
                        <div class="swiper-container item_play_dif_slide_detail">
                            <div class="swiper-wrapper">
                                @foreach($groups_other as $item)
                                <div class="swiper-slide" >
                                    <div class="item_play_dif_slide_detail_in">
                                        <div class="item_play_dif_slide_img">
                                            <a href="{{route('getIndex',[$item->slug])}}">
                                                <img src="{{config('api.url_media').$item->image}}" alt="{{$item->title}}"  class="img-fluid swiper-lazy item_play_dif_slide_img_main">
                                                @if(isset($item->params->image_percent_sale) && $item->params->image_percent_sale!=null)
                                                <img src="{{config('api.url_media').$item->params->image_percent_sale}}" alt="{{$item->title}}" class="item_play_dif_slide_img_sale">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="item_play_dif_slide_title">
                                            <p><strong>{{$item->title}}</strong></p>
                                        </div>
                                        <div class="item_play_dif_slide_description">
                                            <div class="countime"> </div>
                                            <p>Đã chơi: {{isset($item->params->fake_num_play)?($item->params->fake_num_play+$item->order_gate_count):$item->order_gate_count}}</p>
                                            <span class="item_play_dif_slide_description-old-price">{{number_format($item->price*100/80)}}đ</span>
                                            <span class="item_play_dif_slide_description-new-price">{{number_format($item->price)}}đ</span>
                                        </div>
                                        <div class="item_play_dif_slide_more">
                                            <div class="item_play_dif_slide_more_view" >
                                                <a href="{{route('getIndex',[$item->slug])}}">
                                                    @if(isset($item->params->image_view_all) && $item->params->image_view_all!=null)
                                                    <img src="{{config('api.url_media').$item->params->image_view_all}}"  alt="{{$item->title}}">
                                                    @else
                                                    Chơi ngay
                                                    @endif
                                                </a>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                        <div class="swiper-button-prev">
                            <i class="fas fa-chevron-left"></i>
                        </div>
                        <div class="swiper-button-next">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="item_play_intro ">
                <div class="item_play_intro_content">
                    {!!$result->group->content!!}
                </div>
                <span class="item_play_intro_viewmore">Xem tất cả »</span>
                <span class="item_play_intro_viewless">Thu gọn »</span>
            </div>
        </div>
    </div>


<div class="modal fade" id="luotquayModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" style="font-weight: bold;text-transform: uppercase;color: #FF0000;text-align: center;margin: auto;padding-left: 60px">Lượt chơi đây</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="font-family: helvetica, arial, sans-serif;">
                <div class="c-content-title-1" style="margin: 0 auto">
                </div>
                <div class="list-roll-inner">
                    <table cellpadding="10" class="table table-striped">
                        <tbody>
                        <tr>
                            <th>Tài khoản</th>
                            <th>Giải thưởng</th>
                            <th>Thời gian</th>
                        </tr>
                        </tbody>
                        <tbody>
                            @foreach($result->log as $item)
                                <tr>
                                    <th>{{$item->author->username}}</th>
                                    <th>{{$item->item_ref->title}}</th>
                                    <th>{{\Carbon\Carbon::parse($item->created_at)->format('Y-m-d H:i')}}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="theleModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-weight: bold;text-transform: uppercase;color: #FF0000;text-align: center">Thể Lệ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body" style="font-family: helvetica, arial, sans-serif;">
                {!! $result->group->params->thele !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="noticeModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-weight: bold;text-transform: uppercase;color: #FF0000;text-align: center">Thông báo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="middle nohuthang" style="text-align: center;padding: 15px 0;color: blue"></div>
            <div class="modal-body content-popup" style="font-family: helvetica, arial, sans-serif;">

            </div>
            <div class="modal-footer">
                <a href="#" id="btnWithdraw" class="btn btn-success m-btn m-btn--custom m-btn--icon m-btn--pill" >Rút quà</a>
                <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="naptheModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-weight: bold;text-transform: uppercase;color: #FF0000;text-align: center">Thông báo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body content-popup" style="font-family: helvetica, arial, sans-serif;">
                Bạn đã hết lượt chơi. Nạp thẻ để chơi tiếp!               
            </div>
            <div class="modal-footer">
                <a href="/nap-the" class="btn btn-success m-btn m-btn--custom m-btn--icon m-btn--pill" >Nạp thẻ</a>
                <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>


<!--    popup-->
<div class="modal fade bd-example-modal-lg" id="topquaythuongModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p>Bảng xếp hạng vòng chơi</p>
                <!--                    <h4 style="text-transform: uppercase;margin: auto; padding-left: 28px;" class="modal-title"><span>Bảng xếp hạng vòng chơi</span></h4>-->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="tap1" class="rank-modal-tab">
                    <ul role="tablist" class="nav nav-tabs">
                        <li role="presentation" class="active"><a id="tap1-tab-1" role="tab" aria-controls="tap1-pane-1" aria-selected="true" href="#"><span>Hôm nay</span></a></li>
                        <li role="presentation" class=""><a id="tap1-tab-2" role="tab" aria-controls="tap1-pane-2" tabindex="-1" aria-selected="false" href="#"><span>7 ngày qua</span></a></li>
                        <li role="presentation" class=""><a id="tap1-tab-3" role="tab" aria-controls="tap1-pane-3" tabindex="-1" aria-selected="false" href="#"><span>Quà đua Top</span></a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tap1-pane-1" aria-labelledby="tap1-tab-1" role="tabpanel" aria-hidden="false" class="tab-pane active in">
                            <div>
                                
                                @if(count($topDayList)>0)
                                <div class="top-info-section">
                                    <img src="/assets/frontend/{{theme('')->theme_key}}/image/icon-user.png" class="" alt="top donate"><img src="/assets/frontend/{{theme('')->theme_key}}/image/no1_top_list.png" class="background-top1" alt="s">
                                    <p style="margin-top: 25px;"><span><a href="#" target="_blank" style="font-weight: bold;" rel="noopener noreferrer">
                                    {{$topDayList[0]['name']}}</a></span></p>
                                    <p style="font-weight: bold;font-size:15px">{{$topDayList[0]['numwheel']}} lượt quay</p>
                                </div>
                                @endif
                                @if(count($topDayList)>1)
                                <ul class="rank-list">
                                    @foreach($topDayList as $item)
                                    @if($loop->index>0)
                                    <li>
                                        <div class="pull-left">
                                            <p class="pull-left" style="width: 25px;">#{{$loop->index}}</p>
                                            <div class="avt avt-xs"><img src="https://shopas.net/assets/backend/images/icon-user.png" class="avt-img" alt="player duo"></div>
                                            <p class="name-player-review hidden-over-name color-vip-1">{{$item['name']}}</p>
                                        </div>
                                        <p class="pull-right" style="margin-right: 0px;float: right">{{$item['numwheel']}} lượt</p>
                                        <div class="clearfix"> </div>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                        </div>
                        <div id="tap1-pane-2" aria-labelledby="tap1-tab-2" role="tabpanel" aria-hidden="true" class="tab-pane">
                            <div>
                                @if(count($top7DayList)>0)
                                <div class="top-info-section">
                                    <img src="/assets/frontend/{{theme('')->theme_key}}/image/icon-user.png" class="" alt="top donate"><img src="/assets/frontend/{{theme('')->theme_key}}/image/no1_top_list.png" class="background-top1" alt="s">
                                    <p style="margin-top: 25px;"><span><a href="#" target="_blank" style="font-weight: bold;" rel="noopener noreferrer">
                                    {{$top7DayList[0]['name']}}</a></span></p>
                                    <p style="font-weight: bold;font-size:15px">{{$top7DayList[0]['numwheel']}} lượt quay</p>
                                </div>
                                @endif
                                @if(count($top7DayList)>1)
                                <ul class="rank-list">
                                    @foreach($top7DayList as $item)
                                    @if($loop->index>0)
                                    <li>
                                        <div class="pull-left">
                                            <p class="pull-left" style="width: 25px;">#{{$loop->index}}</p>
                                            <div class="avt avt-xs"><img src="https://shopas.net/assets/backend/images/icon-user.png" class="avt-img" alt="player duo"></div>
                                            <p class="name-player-review hidden-over-name color-vip-1">{{$item['name']}}</p>
                                        </div>
                                        <p class="pull-right" style="margin-right: 0px;float: right">{{$item['numwheel']}} lượt</p>
                                        <div class="clearfix"> </div>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                        </div>
                        <div id="tap1-pane-3" aria-labelledby="tap1-tab-3" role="tabpanel" aria-hidden="true" class="tab-pane">
                            <div class="content-qdt">
                                {!!$result->group->params->phanthuong!!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
@foreach(config('constants.'.'game_type') as $item => $key)
    <input type="hidden" id="withdrawruby_{{$item}}" value="{{$key}}">
@endforeach
<input type="hidden" id="type_play" value="real">
<input type="hidden" name="checkPoint" value="{{$result->checkPoint}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    $(document).ready(function(e) {

        var saleoffpass = "";
        //var saleoffmessage = "";
        var userpoint = 0;
        var numrollbyorder = 0;
        var roll_check = true;
        var num_loop = 4;
        var angle_gift = '';
        var num_gift = '{{count($result->group->items)}}';
        var gift_detail = '';
        var num_roll_remain = 0;
        var angles = 0;
        var arrxgt;
        var free_wheel = 0;
        var value_gif_bonus = '';
        var msg_random_bonus = '';
        //var arrDiscount = '';

        $('body').delegate('#start-played', 'click', function() {
            $('#type_play').val('real');
            play();
        });

        $('body').delegate('.num-play-try', 'click', function() {
            $('#type_play').val('try');
            play();
        });

        //Click nút chơi
        function play(){
            if (roll_check) {
                $('#lac_lixi').attr('src',$("#hdImageDapLu").val());
                roll_check = false;
                saleoffpass = $("#saleoffpass").val();
                numrolllop = $("#numrolllop").val();
                $.ajax({
                    url: '/minigame-play',
                    datatype: 'json',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: '{{$result->group->id}}',
                        numrolllop: numrolllop,
                        numrollbyorder: numrollbyorder,
                        typeRoll: $('#type_play').val(),
                        saleoffpass: saleoffpass,
                    },
                    type: 'POST',
                    success: function(data) {                        
                        if (data.status == 4) {
                            location.href='/login';
                        } else if (data.status == 3) {
                            $('#lac_lixi').attr('src',$("#hdImageLD").val());
                            $('#naptheModal').modal('show')
                            return;
                        } else if (data.status == 0) {
                            $('#lac_lixi').attr('src',$("#hdImageLD").val());
                            roll_check = true;
                            $('.content-popup').text(data.msg);
                            $('#noticeModal').modal('show');
                            return;
                        }
                        numrollbyorder = parseInt(data.numrollbyorder) + 1;
                        gift_detail = data.gift_detail;
                        console.log(gift_detail);
                        if(gift_detail.image.length > 0)
                        {
                            $('#lac_lixi').attr('src','{{config("api.url_media")}}'+gift_detail.image);
                        }
                        gift_revice = data.arr_gift;
                        //arrDiscount = data.arrDiscount;
                        arrxgt = data.xgt;
                        if (data.xgt > 0) {
                            xvalue = data.xgt[data.xgt.length - 1];
                        } else {
                            xvalue = 0;
                        }
                        value_gif_bonus = data.value_gif_bonus;
                        msg_random_bonus = data.msg_random_bonus;
                        xvalueaDD = data.xValue;
                        free_wheel = data.free_wheel;
                        num_roll_remain = gift_detail.num_roll_remain;
                        angles = 0;
                        angle_gift = gift_detail.order * (360 / num_gift);
                        loop();

                        if($('#type_play').val()=='real'){
                            userpoint = data.userpoint;
                            if(userpoint<100){
                                $(".item_spin_progress_bubble").css("width", data.userpoint + "%")
                            }else{
                                $(".item_spin_progress_bubble").css("width", "100%");
                                $(".item_spin_progress_bubble").addClass('clickgif');
                            }
                            $(".item_spin_progress_percent").html(data.userpoint + "/100 point");
                            $("#saleoffpass").val("");
                            //saleoffmessage = data.saleMessage;
                        }
                    },
                    error: function() {
                        $('#lac_lixi').attr('src',$("#hdImageLD").val());
                        $('.content-popup').text('Có lỗi xảy ra. Vui lòng thử lại!');
                        $('#noticeModal').modal('show');
                    }
                })
            }
        };


        function getgifbonus() {            
            if($('#checkPoint').val() != "1"){
                return;
            }
            $.ajax({
                url: '/minigame-bonus',
                datatype: 'json',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: '{{$result->group->id}}',
                },
                type: 'POST',
                success: function(data) {
                    if (data.status == 0) {
                        $('.content-popup').text(data.msg);
                        $('#noticeModal').modal('show');
                        return;
                    }
                    gift_detail = data.gift_detail;
                    if(gift_detail.image.length > 0)
                    {
                        $('#lac_lixi').attr('src','{{config("api.url_media")}}'+gift_detail.image);
                    }
                    $('#noticeModal .content-popup').append("<div style='color:blue'>" + data.msg + " - " + data.arr_gift[0].title + "</div>");
                    //$("#noticeModalNoHu #btnWithdraw").hide();
                    $('#noticeModal').modal('show');
                    var userpoint = data.userpoint;
                    if(userpoint<100){
                        $(".item_spin_progress_bubble").css("width", data.userpoint + "%");
                        $(".item_spin_progress_bubble").removeClass('clickgif');
                    }else{
                        $(".item_spin_progress_bubble").css("width", "100%");
                        $(".item_spin_progress_bubble").addClass('clickgif');
                    }
                    $(".item_spin_progress_percent").html(data.userpoint + "/100 point");
                    $(".pyro").show();
                    setTimeout(function(){
                        $(".pyro").hide();
                    },6000)
                },
                error: function() {
                    $('.content-popup').text('Có lỗi xảy ra. Vui lòng thử lại!');
                    $('#noticeModal').modal('show');
                }
            })
        }

        function loop() {
            roll_check = true;

            $("#btnWithdraw").show();
            if (gift_detail.winbox == 0) {
                $("#btnWithdraw").hide();
            } else {
                if (gift_detail.gift_type == 0) {
                    $("#btnWithdraw").html("Rút " + $("#withdrawruby_" + gift_detail.game_type).val());
                    $("#btnWithdraw").attr('href', '/withdrawitem-' + gift_detail.game_type);
                } else if (gift_detail.gift_type == 1) {
                    $("#btnWithdraw").html("Kiểm tra nick trúng");
                    $("#btnWithdraw").attr('href', '/minigame-logacc-' + '{{$result->group->id}}');
                // } else if (gift_detail.gift_type == 'nrocoin') {
                //     $("#btnWithdraw").html("Rút vàng");
                //     $("#btnWithdraw").attr('href', '/withdrawservice?id=' + $("#ID_NROCOIN").val());
                // } else if (gift_detail.gift_type == 'nrogem') {
                //     $("#btnWithdraw").html("Rút ngọc");
                //     $("#btnWithdraw").attr('href', '/withdrawservice?id=' + $("#ID_NROGEM").val());
                // } else if (gift_detail.gift_type == 'nroxu') {
                //     $("#btnWithdraw").html("Rút xu");
                //     $("#btnWithdraw").attr('href', '/withdrawservice?id=' + $("#ID_NINJAXU").val());
                } else if (gift_detail.gift_type == 2) {
                    $("#btnWithdraw").html("Load lại trang");
                    $("#btnWithdraw").removeAttr("href");
                    $("#btnWithdraw").addClass('reLoad');
                } else {
                    $("#btnWithdraw").hide();
                }

            }
            if (gift_revice.length > 0) {
                $html = "";
                $strDiscountcode="";
                // if(saleoffmessage.length > 0)
                // {
                //     $html += "<br/><span style='font-size: 14px;color: #f90707;font-style: italic;display: block;text-align: center;'>"+saleoffmessage+"</span><br/>";
                // }
                
                if($('#type_play').val() == "real")
                {
                    if(gift_revice.length == 1)
                    {
                            // if(arrDiscount[0] != "")
                            // {
                            //     $strDiscountcode="<span>Bạn nhận được 1 mã giảm giá khuyến mãi đi kèm: <b>"+arrDiscount[0]+"</b></span>";
                            // }
                            $html += "<span>Kết quả: "+gift_revice[0]["parrent"].title+"</span><br/>";
                            if(gift_detail.winbox == 1){
                                $html += "<span>Mua X1: Nhận được "+gift_revice[0]["parrent"].params.value+"</span><br/>";
                                //$html += "<span>chơi được "+(xvalue+3)+" hình trùng nhau. Nhận X"+(xvalueaDD[0])+" giải thưởng: "+gift_revice[0]["parrent"].params.value*(xvalueaDD[0])+""+msg_random_bonus[0]+"</span><br/>"+$strDiscountcode;
                                $html += "<span>Tổng cộng: "+parseInt(gift_revice[0]["parrent"].params.value)*(parseInt(xvalueaDD[0]))+"</span>";
                            }
                    }
                    else
                    {
                        $totalRevice = 0;
                        $html += "<span>Kết quả: Nhận "+gift_revice.length+" phần thưởng cho "+gift_revice.length+" lượt chơi.</span><br/>";
                        $html += "<span><b>Mua X"+gift_revice.length+":</b></span><br/>";
                        for($i=0;$i<gift_revice.length;$i++)
                        {
                            // if(arrDiscount[$i] != "")
                            // {
                            //     $strDiscountcode="<span>Bạn nhận được 1 mã giảm giá khuyến mãi đi kèm: <b>"+arrDiscount[$i]+"</b></span>";
                            // }
                            $html += "<span>Lần chơi "+($i + 1)+": "+gift_revice[$i]['parrent'].title;
                            if(gift_revice[$i].winbox == 1){
                                $html +=" - nhận được: "+gift_revice[$i]["parrent"].params.value+" X"+(parseInt(xvalueaDD[$i]))+" = "+parseInt(gift_revice[$i]["parrent"].params.value)*(parseInt(xvalueaDD[$i]))+""+msg_random_bonus[$i]+"</span><br/>"+$strDiscountcode+"<br/>";
                            }
                            else
                            {
                                $html +=""+msg_random_bonus[$i]+"<br/>"+$strDiscountcode+"<br/>";
                            }
                            $totalRevice +=  parseInt(gift_revice[$i]["parrent"].params.value)*(parseInt(xvalueaDD[$i]))+ parseInt(value_gif_bonus[$i]);
                        }
                        
                        $html += "<span><b>Tổng cộng: "+$totalRevice+"</b></span>";
                    }
                }
                else
                {
                    if(gift_revice.length == 1)
                    {
                            $html += "<span>Kết quả chơi thử: "+gift_revice[0]["parrent"].title+"</span><br/>";
                            if(gift_detail.winbox == 1){
                                $html += "<span>Mua X1: Nhận được "+gift_revice[0]["parrent"].params.value+"</span><br/>";
                                //$html += "<span>chơi được "+(xvalue+3)+" hình trùng nhau. Nhận X"+(xvalueaDD[0])+" giải thưởng: "+gift_revice[0]["parrent"].params.value*(xvalueaDD[0])+""+msg_random_bonus[0]+"</span><br/>";
                                $html += "<span>Tổng cộng: "+parseInt(gift_revice[0]["parrent"].params.value)*(parseInt(xvalueaDD[0]))+"</span>";
                            }
                    }
                    else
                    {
                        $totalRevice = 0;
                        $html += "<span>Kết quả chơi thử: Nhận "+gift_revice.length+" phần thưởng cho "+gift_revice.length+" lượt chơi.</span><br/>";
                        $html += "<span><b>Mua X"+gift_revice.length+":</b></span><br/>";
                        for($i=0;$i<gift_revice.length;$i++)
                        {
                            $html += "<span>Lần chơi "+($i + 1)+": "+gift_revice[$i]['parrent'].title;
                            if(gift_revice[$i].winbox == 1){
                                $html +=" - nhận được: "+gift_revice[$i]["parrent"].params.value+" X"+(parseInt(xvalueaDD[$i]))+" = "+parseInt(gift_revice[$i]["parrent"].params.value)*(parseInt(xvalueaDD[$i]))+""+msg_random_bonus[$i]+"</span><br/>";
                            }
                            else
                            {
                                $html +=""+msg_random_bonus[$i]+"<br/>";
                            }
                            $totalRevice +=  parseInt(gift_revice[$i]["parrent"].params.value)*(parseInt(xvalueaDD[$i]))+ parseInt(value_gif_bonus[$i]);
                        }
                        
                        $html += "<span><b>Tổng cộng: "+$totalRevice+"</b></span>";
                    }
                }
            }

            $('.content-popup').html($html);

            if (userpoint > 99) {
                getgifbonus();
            }
            $('#noticeModal').modal('show');
        }
    });

    $('body').delegate('.reLoad', 'click', function() {
        location.reload();
    })
</script>
@endsection
