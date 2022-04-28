@extends('frontend.layouts.master')
@section('content')
    <div class="account">

        <div class="account_content">
            <div class="container">
                @include('frontend.pages.account.sidebar')
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
                        <form action="{{route('getLog',[$group->id])}}" method="get" class=" account_content_transaction_history__v2">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group date" id="transaction_history_start">
                                        <span class="input-group-btn input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                            <input type="text" class="form-control input-group-addon started_at" name="started_at" autocomplete="off" placeholder="Từ ngày" value="{{request('started_at')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group date" id="transaction_history_end">
                                        <span class="input-group-btn input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                        </span>
                                            <input type="text" class="form-control input-group-addon ended_at" name="ended_at" autocomplete="off" placeholder="Đến ngày" value="{{request('ended_at')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control input-group-addon" name="gift_name" autocomplete="off" placeholder="Tên quà" value="{{request('gift_name')}}">
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
                                        <td>{{$item->item_ref->parrent->title}}</td>
                                        <td>{{$item->item_ref->parrent->params->value}}</td>
                                        <td>{{$item->group->title}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="col-md-12 left-right justify-content-end paginate__v1 paginate__v1_mobie frontend__panigate">
                                <div class="row marinautooo paginate__history paginate__history__fix justify-content-center">
                                    <div class="col-auto paginate__category__col">
                                        <div class="data_paginate paging_bootstrap paginations_custom" style="text-align: center">
                                            {{ $paginatedItems->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>

<script>
    // $(function () {

</script>
@endsection
