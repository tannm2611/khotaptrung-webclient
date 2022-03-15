<div class="account_sidebar_menu">
    <div class="row">
        <div class="col-6 col-sm-6 col-xl-6 col-lg-12 col-xl-12 m-t-15 m-b-20">
            <div class="account_sidebar_menu_title">
                <p>Menu tài khoản</p>
            </div>
            <div class="account_sidebar_menu_nav">
                <ul>
                    @foreach($data_menu_profile as $items)
                        <li><a href="{{$items->url ? $items->url : $items->slug}}">{{$items->title}}</a></li>
                    @endforeach


                </ul>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-xl-6 col-lg-12 col-xl-12">
            <div class="account_sidebar_menu_title">
                <p>Menu giao dịch</p>
            </div>
            <div class="account_sidebar_menu_nav">
                <ul>
                    @foreach($data_menu_transaction as $items)
                        <li><a href="{{$items->url ? $items->url : $items->slug}}">{{$items->title}}</a></li>
                    @endforeach

                    {{--                    <li><a href="/nap-the-tu-dong" class="@if(Request::is('/nap-the-tu-dong')) account_sidebar_menu_nav_active @endif">Nạp thẻ tự động</a> </li>--}}
{{--                    <li><a href="/lich-su-nap-the">Lịch sử nạp thẻ</a></li>--}}
{{--                    <li><a href="/recharge-atm">Nạp thẻ từ ATM - Ví điện tử</a></li>--}}
{{--                    <li><a href="/tai-khoan-da-mua">Tài khoản đã mua</a></li>--}}
{{--                    <li><a href="/tai-khoan-tra-gop">Tài khoản trả góp</a></li>--}}
{{--                    <li><a href="/lich-su-quay-thuong">Lịch sử quay thưởng</a></li>--}}
{{--                    <li>--}}

{{--                        <a  data-toggle="collapse" href="#menuchild_gieoquedaunam" role="button" aria-expanded="true" aria-controls="collapseExample">Gieo quẻ (1)</a>--}}
{{--                        <ul id="menuchild_gieoquedaunam" class="collapse">--}}
{{--                            <li><a href="/gieo-que">Lịch sử gieo Nhận Lixi Đầu Xuân</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li><a href="">Rung cây (0)</a></li>--}}
{{--                    <li><a href="">Đập lu (0)</a></li>--}}
                </ul>
            </div>
        </div>
    </div>
</div>
