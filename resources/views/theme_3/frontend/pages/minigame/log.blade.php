@extends('frontend.layouts.master')
@section('seo_head')
    @include('frontend.widget.__seo_head')
@endsection
@section('content')

    {{--  Menu  --}}
    <section class="media-web">
        <div class="container container-fix menu-container-ct">
            <ul>
                <li><a href="/">Trang chủ</a></li>
                <li class="menu-container-li-ct"><img class="lazy" src="/assets/frontend/{{theme('')->theme_key}}/image/cay-thue/arrow-right.png" alt=""></li>
                <li class="menu-container-li-ct"><a href="/lich-su-giao-dich">Lịch sử giao dịch</a></li>
                <li class="menu-container-li-ct"><img class="lazy" src="/assets/frontend/{{theme('')->theme_key}}/image/cay-thue/arrow-right.png" alt=""></li>
                <li class="menu-container-li-ct"><a href="javascript:void(0)">LỊCH SỬ CHƠI {{$group->title}} TRÚNG VẬT PHẨM</a></li>
            </ul>
        </div>
    </section>

    <section class="media-mobile">
        <div class="container container-fix banner-mobile-container-ct">

            <div class="row marginauto banner-mobile-row-ct">
                <div class="col-auto left-right" style="width: 10%">
                    <a href="" class="previous-step-one" style="line-height: 28px">
                        <img class="lazy" src="/assets/frontend/{{theme('')->theme_key}}/image/cay-thue/back.png" alt="" >
                    </a>
                </div>

                <div class="col-auto left-right banner-mobile-span text-center" style="width: 80%">
                    <h1>LỊCH SỬ CHƠI {{$group->title}} TRÚNG VẬT PHẨM</h1>
                </div>
                <div class="col-auto left-right" style="width: 10%">
                </div>
            </div>

        </div>
    </section>

    {{--   Bopdy --}}
    <section>
        <div class="container container-fix body-container-ct">
            <div class="row marginauto body-container-row-ct body-container-row-mobile-ct">

                @include('theme_3.frontend.widget.__navbar__profile')

                <div class="col-lg-9 col-12 body-container-detail-right-ct">
                    <div class="row marginauto logs-content">
                        <div class="col-md-12 left-right">
                            <div class="row marginauto logs-title">
                                <div class="col-md-12 left-right">
                                    <span>LỊCH SỬ CHƠI {{$group->title}} TRÚNG VẬT PHẨM</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 logs-search left-right">

                            <div class="row marginauto">
                                <div class="col-12 left-right">
                                    <div class="row marginauto">
                                        <div class="col-md-3 col-5 logs-vat-pham-left">
                                            <div class="row marginauto">
                                                <div class="col-12 left-right background-nick-col-bottom-ct status-finter-nick">
                                                    <select class="wide" name="type" id="type">
                                                        <option selected>Log trúng vật phẩm</option>
                                                        <option value="1">Log trúng acc</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-5 logs-vat-pham-right">
                                            <div class="row marginauto">
                                                <div class="col-12 left-right background-nick-col-bottom-ct status-finter-nick">
                                                    <select class="wide" name="id" id="id">
                                                        @foreach($group_api as $item)
                                                            <option value="{{route('getLog',[$item->id])}}" {{$group->id==$item->id?'selected':''}}>{{$item->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="group_id" value="{{$group->id}}">
                                        <script type="text/javascript">
                                            $("#id").change(function(){
                                                window.location.href = $( "select#id" ).val();
                                            });
                                            $("#type").change(function(){
                                                var link = $( "select#id" ).val().replace('log','logacc')
                                                window.location.href = link;
                                            });
                                        </script>
                                    </div>
                                </div>
                                <div class="col-auto ml-auto left-right">

                                    <div class="row marginauto justify-content-end nick-findter-row">

                                        <div class="col-auto nick-findter" style="position: relative">
                                            <ul>
                                                <li class="li-boloc">Bộ lọc</li>
                                                <li class="margin-findter">
                                                    <img class="lazy" src="/assets/frontend/{{theme('')->theme_key}}/image/nick/filter.png" alt="">
                                                    <span class="overlay-find">
                                                        0
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row marginauto nick-findter-data">

                            </div>
                        </div>

                        <div class="col-md-12 logs-table left-right">
                            <div class="row default-table">
                                <div class="col-md-12 left-right">
                                    <table class="table table-striped table-responsive table-hover table-logs" id="table-default">
                                        <thead>
                                        <tr>
                                            <th>Thời gian</th>
                                            <th width="20%">ID</th>
                                            <th width="30%">Phần thưởng</th>
                                            <th width="20%">Số vật phẩm</th>
                                            <th width="20%">Danh mục</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($result->data as $item)
                                        <tr>
                                            <td>{{\Carbon\Carbon::parse($item->created_at)->format('Y-m-d H:i')}}</td>
                                            <td>#{{$item->id}}</td>

                                            <td>{{$item->item_ref->parrent->title??""}}</td>
                                            <td>
                                                {{$item->item_ref->parrent->params->value??""}}
                                            </td>
                                            <td>
                                                {{$item->group->title}}
                                            </td>
                                        </tr>
                                        @empty
                                            <tr style="width: 100%" id="table-notdata"><td colspan="7"><span>Không có dữ liệu</span></td></tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 left-right justify-content-end default-paginate-addpadding default-paginate">

                            @if(isset($paginatedItems))
                                <div class="row marinautooo justify-content-center">
                                    <div class="col-auto">
                                        <div class="data_paginate paging_bootstrap paginations_custom" style="text-align: center">
                                            {{ $paginatedItems->appends(request()->query())->links('pagination::bootstrap-default-4') }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="modal fade login show small-log-Modal modal-logs-txns" id="openFinter" aria-modal="true">

        <div class="modal-dialog step-tab-panel modal-lg modal-dialog-centered login animated">
            <!--        <div class="image-login"></div>-->
            <div class="modal-content">
                <div class="modal-header p-0" style="border-bottom: 0">
                    <div class="row marginauto modal-header-nick-ct">
                        <div class="col-12 left-right text-center" style="position: relative">
                            <span>Bộ lọc</span>
                            <img class="lazy img-close-nick-ct close-modal-default" src="/assets/frontend/{{theme('')->theme_key}}/image/cay-thue/close.png" alt="">
                        </div>
                    </div>

                </div>

                <div class="modal-body modal-body-order-ct">
                    <form action="{{route('getLog',[$group->id])}}" method="get" class=" account_content_transaction_history__v2">
                        <div class="row marginauto">

                            <div class="col-md-12 left-right">
                                <div class="row marginauto">
                                    <div class="col-12 left-right background-nick-col-top-ct body-title-detail-span-ct">
                                        <span>Tên quà</span>
                                    </div>
                                    <div class="col-12 left-right background-nick-col-bottom-ct transaction-finter-nick">
                                        <input type="text" name="gift_name" class="input-defautf-ct serial" placeholder="Tên quà">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 left-right">
                                <div class="row body-title-detail-ct">

                                    <div class="col-md-6 text-left body-title-detail-col-ct">
                                        <div class="row marginauto">
                                            <div class="col-md-12 left-right body-title-detail-span-ct">
                                                <span>Từ ngày</span>
                                            </div>
                                            <div class="col-md-12 left-right body-title-detail-select-ct">
                                                <input autocomplete="off" name="started_at" class="input-defautf-ct started_at" type="text" placeholder="Chọn">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="col-md-6 text-left body-title-detail-col-ct">
                                        <div class="row marginauto password-mobile">
                                            <div class="col-md-12 left-right body-title-detail-span-ct">
                                                <span>Đến ngày</span>
                                            </div>
                                            <div class="col-md-12 left-right body-title-detail-select-ct" style="position: relative">
                                                <input autocomplete="off" class="input-defautf-ct ended_at" type="text" placeholder="Chọn">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12 left-right padding-nicks-footer-ct">

                                <div class="row marginauto justify-content-center">
                                    <div class="col-md-6 col-6 modal-footer-success-col-left-ct">
                                        <div class="row marginauto modal-footer-success-row-not-ct">
                                            <div class="col-md-12 left-right">
                                                <a href="javascript:void(0)" class="button-not-bg-ct close-find"><span>Đóng</span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-6 modal-footer-success-col-right-ct">
                                        <div class="row marginauto">
                                            <div class="col-md-12 left-right">
                                                <button class="button-default-modal-ct button-modal-nick openSuccess" type="submit">Áp dụng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function (e) {
            $('body').on('click','.close-find',function(){
                $('#openFinter').modal('hide');
            })

            $('body').on('click','.close-modal-default',function(){
                $('#openFinter').modal('hide');
            })

            $('body').on('click','.nick-findter',function(){
                $('#openFinter').modal('show')
            })

            $('.wide').niceSelect();

            $('.started_at').datetimepicker({
                format: 'DD-MM-YYYY LT',
                useCurrent: false,
                icons:
                    { time: 'fas fa-clock',
                        date: 'fas fa-calendar',
                        up: 'fas fa-arrow-up',
                        down: 'fas fa-arrow-down',
                        previous: 'fas fa-arrow-circle-left',
                        next: 'fas fa-arrow-circle-right',
                        today: 'far fa-calendar-check-o',
                        language: 'vi',
                        clear: 'fas fa-trash',
                        close: 'far fa-times' },
                maxDate: moment()

            });

            $('.ended_at').datetimepicker({
                format: 'DD-MM-YYYY LT',
                useCurrent: false,
                icons:
                    { time: 'fas fa-clock',
                        date: 'fas fa-calendar',
                        up: 'fas fa-arrow-up',
                        down: 'fas fa-arrow-down',
                        previous: 'fas fa-arrow-circle-left',
                        next: 'fas fa-arrow-circle-right',
                        today: 'far fa-calendar-check-o',
                        clear: 'fas fa-trash',
                        close: 'far fa-times' },
                maxDate: moment()
            });
        })

    </script>
@endsection









