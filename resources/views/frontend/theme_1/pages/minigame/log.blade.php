@extends('frontend.'.theme('')->theme_key.'.layouts.master')
@section('content')
    <div class="account">

        <div class="account_content">
            <div class="container">
                @include('frontend.'.theme('')->theme_key.'.pages.account.sidebar')
                <div class="account_sidebar_content">
                    <div class="account_sidebar_content_title">
                        <p>LỊCH SỬ CHƠI {{$group->title}} TRÚNG VẬT PHẨM</p>
                        <div class="account_sidebar_content_line"></div>
                    </div>
                    <div class="account_content_transaction_history">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <select name="type" id="type" class="form-control">
                                        <option selected>Log trúng vật phẩm</option>
                                        <option value="1">Log trúng acc</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <select name="id" id="id" class="form-control">
                                        @foreach($group_api as $item)
                                        <option value="{{route('getLog',[$item->id])}}" {{$group->id==$item->id?'selected':''}}>{{$item->title}}</option>
                                        @endforeach
                                    </select>
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
                        <form action="{{route('getLog',[$group->id])}}" method="get">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control input-group-addon" name="gift_name" autocomplete="off" placeholder="Tên quà" value="{{request('gift_name')}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group date" id="transaction_history_start">
                                        <span class="input-group-btn">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                            <input type="text" class="form-control input-group-addon" name="started_at" autocomplete="off" placeholder="Từ ngày" value="{{request('started_at')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group date" id="transaction_history_end">
                                        <span class="input-group-btn input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                        </span>
                                            <input type="text" class="form-control input-group-addon" name="ended_at" autocomplete="off" placeholder="Đến ngày" value="{{request('ended_at')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="submit" style="margin-right: 16px" class="btn c-theme-btn c-btn-square m-b-10" value="Tìm kiếm" >
                                    <a href="{{url()->current()}}" class="btn c-btn-square m-b-10 btn-danger">Tất cả</a>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-hover table-custom-res">
                                <thead>
                                    <tr>
                                        <th>Thời gian</th>
                                        <th>ID</th>
                                        <th>Phần thưởng </th>
                                        <th>Số vật phẩm </th>
                                        <th>Danh mục</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($result->data as $item)
                                    <tr>
                                        <td>{{\Carbon\Carbon::parse($item->created_at)->format('Y-m-d H:i')}}</td>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->item_ref->title}}</td>
                                        <td>{{$item->item_ref->params->value}}</td>
                                        <td>{{$item->group->title}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="data_paginate paging_bootstrap paginations_custom" style="text-align: center">
                                {{ $paginatedItems->links() }}
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>

<script>
    // $(function () {
    $('#transaction_history_end').datetimepicker({
        format: 'DD/MM/YYYY HH:mm',
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
        // minDate: moment()
    });
    $('#transaction_history_start').datetimepicker({
        format: 'DD/MM/YYYY HH:mm',
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
        // minDate: moment()

    });
</script>
@endsection