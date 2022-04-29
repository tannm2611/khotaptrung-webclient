@if(isset($data) && count($data) > 0)

    @foreach($data as $key => $item)
        @if($key == 0)
            <div class="mb-4 item-f-article">
                <div class="media-placeholder item-thumb ratio-2-1 rounded">


                        <div class="media-inner aling-items-end">
                            <a href="/tin-tuc/{{ $item->slug }}">
                                <img src="https://media-tt.nick.vn/{{ $item->image }}" alt="" class="bg rounded">
                            </a>

                            <div class="align-items-bottom">
                                {{--                            <div class="align-items-end h-100 text-white">--}}
                                <h3 class="item-title">
                                    @if(isset($item->url_redirect_301))
                                        <a target="_blank" href="{{ $item->url_redirect_301 }}" class="text-white">{{ $item->title }}</a>
                                    @else
                                        <a href="/tin-tuc/{{ $item->slug }}" class="text-white">{{ $item->title }}</a>
                                    @endif
                                </h3>
                                {{--                            </div>--}}
                            </div>

                        </div>


                </div>
            </div><!-- END Item -->
        @else
            <div class="mb-4 item-c-article">
                <div class="item-thumb">
                    <div class="media-placeholder ratio-5-3 rounded">
                        <div class="bg rounded item-imager-blog" >
                            <a href="/tin-tuc/{{ $item->slug }}">
                                <img src="https://media-tt.nick.vn/{{ $item->image }}" class="img-fluid" title="{{ $item->title }}">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="item-content">
                    <h6 class="item-title">
                        @if(isset($item->url_redirect_301))
                            <a target="_blank" href="{{ $item->url_redirect_301 }}">{{ $item->title }}</a>
                        @else
                            <a href="/tin-tuc/{{ $item->slug }}">{{ $item->title }}</a>
                        @endif
                    </h6>
                    <div class="item-meta small">

                        <div class="time text-secondary"><i class="las la-clock"></i>

                            {{ formatDateTime($item->created_at) }} | Danh mục : {{ $item->groups[0]->title }}

                        </div>
                    </div>
                    <div class="item-summary">
                        {!! $item->description !!}
                    </div>
                </div>
            </div><!-- END Item -->
        @endif
        <!-- END List -->
    @endforeach
@else
    <div class="row pb-3 pt-3">
        <div class="col-md-12 text-center">
            <span style="color: red;font-size: 16px;">Không có dữ liệu !</span>
        </div>
    </div>
@endif



<div class="row">
    <div class="col-md-12 left-right justify-content-end">
        <div class="d-flex justify-content-between align-items-md-center flex-column flex-md-row mt-2 border-top pt-3">
            <div class="text-secondary mb-2">
                @if(isset($total) && isset($per_page))
                Hiển thị {{ $per_page }} / {{ $total }} kết quả
                @endif
            </div>


            <nav class="page-pagination mb-2 paginate__v1_index paginate__v1_mobie frontend__panigate">
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











