@if(empty($data->data))

<div class="table-responsive">
    <table cellspacing="0" cellpadding="0" class="table table-hover">
        <thead>
        <tr>
            <th class="text-secondary">Thời gian</th>
            <th class="text-secondary">ID</th>
            <th class="text-secondary">Tài khoản </th>
            <th class="text-secondary">Giao dịch</th>
            <th class="text-secondary">Số tiền</th>
            <th class="text-secondary">Số dư cuối</th>
            <th class="text-secondary">Nội dung</th>
            <th class="text-secondary">Trạng thái</th>
        </tr>
        </thead>
        <tbody>

            @php
                $prev = null;
            @endphp
            @if(isset($data) && count($data) > 0)
                @foreach ($data as $item)

                    @php
                        $curr = \App\Library\Helpers::formatDate($item->created_at);
                    @endphp
                    @if($curr != $prev)

                        <tr>
                            <td colspan="8"><b>Ngày {{$curr}}</b></td>
                        </tr>
                        <tr>
                            <td>{{ formatDateTime($item->created_at) }}</td>
                            <td>#{{$item->id}}</td>
                            <td> {{ $item->user->username }} </td>

                            <td>
                                @foreach($config as $ils => $valls)
                                    @if($ils == $item->trade_type)
                                        {{ $valls }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @if($item->is_add==1)
                                    <span class="c-font-bold text-info">+{{formatPrice((int)$item->amount)}}đ</span>
                                @elseif($item->is_add==0)
                                    <span class="c-font-bold text-danger">-{{formatPrice((int)$item->amount)}}đ</span>
                                @endif
                            </td>
                            <td>{{ formatPrice((int)$item->last_balance) }}đ</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                @foreach($status as $istls => $valstls)
                                    @if($istls == $item->status)
                                        @if($item->status == 1)
                                            <b class="text-success">{{ $valstls }}</b>
                                        @elseif($item->status == 0)
                                            <b class="text-danger">{{ $valstls }}</b>
                                        @elseif($item->status == 2)
                                            <b class="text-warning">{{ $valstls }}</b>
                                        @endif
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        @php
                            $prev = $curr;
                        @endphp
                    @else
                        <tr>
                            <td>{{ formatDateTime($item->created_at) }}</td>
                            <td>#{{ $item->id }}</td>
                            <td> {{ $item->user->username }} </td>
                            <td>
                                @foreach($config as $ils => $valls)
                                    @if($ils == $item->trade_type)
                                        {{ $valls }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @if($item->is_add==1)
                                    <span class="c-font-bold text-info">+{{formatPrice((int)$item->amount)}}đ</span>
                                @elseif($item->is_add==0)
                                    <span class="c-font-bold text-danger">-{{formatPrice((int)$item->amount)}}đ</span>
                                @endif
                            </td>
                            <td>{{ formatPrice((int)$item->last_balance) }}đ</td>
                            <td>{{$item->description}}</td>
                            <td>
                                @foreach($status as $istls => $valstls)
                                    @if($istls == $item->status)
                                        @if($item->status == 1)
                                            <b class="text-success">{{ $valstls }}</b>
                                        @elseif($item->status == 0)
                                            <b class="text-danger">{{ $valstls }}</b>
                                        @elseif($item->status == 2)
                                            <b class="text-warning">{{ $valstls }}</b>
                                        @endif
                                    @endif
                                @endforeach
                            </td>

                        </tr>
                    @endif
                @endforeach
            @else
                <tr>
                    <td colspan="8">
                        <span style="color: red;font-size: 16px;">Không có dữ liệu!</span>
                    </td>
                </tr>
            @endif

        </tbody>
    </table>
</div>

@endif
<div class="row">
    <div class="col-md-12 left-right justify-content-end">
        <div class="d-flex justify-content-between align-items-md-center flex-column flex-md-row mt-2 pt-3">
            <div class="text-secondary mb-2">
                @if(isset($total) && isset($per_page))
                    Hiển thị {{ $per_page }} / {{ $total }} kết quả
                @endif
            </div>


            <nav class="page-pagination mb-2 paginate__v1_index_txns paginate__v1_mobie frontend__panigate">
                @if(isset($data))
                    @if($data->total()>1)
                        <div class="row marinautooo paginate__history paginate__history__fix justify-content-end">
                            <div class="col-auto paginate__category__col">
                                <div class="data_paginate paging_bootstrap paginations_custom" style="text-align: center">
                                    {{ $data->appends(request()->query())->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </nav>
        </div>
    </div>
</div>

{{--<div class="d-flex justify-content-between align-items-md-center flex-column flex-md-row mt-2">--}}
{{--    <div class="text-secondary mb-2">--}}
{{--        Hiển thị 5 / 10 kết quả--}}
{{--    </div>--}}
{{--    <nav class="page-pagination mb-2">--}}
{{--        <ul class="pagination">--}}
{{--            <li class="page-item disabled">--}}
{{--                <a class="page-link" href="#" tabindex="-1" aria-disabled="true"><i class="las la-angle-left"></i></a>--}}
{{--            </li>--}}
{{--            <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--            <li class="page-item active" aria-current="page">--}}
{{--                <a class="page-link" href="#">2</a>--}}
{{--            </li>--}}
{{--            <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--            <li class="page-item">--}}
{{--                <a class="page-link" href="#"><i class="las la-angle-right"></i></a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </nav>--}}
{{--</div>--}}
