
@if(isset($data) && count($data) > 0)
<!-- BEGIN Recent Posts -->

<div class="mb-4">
    <h6 class="title-style-tab"><span>Bài viết hay</span></h6>
    <ul class="list-posts">
        @foreach($data as $key => $item)
            @if($key < 4)

                <li class="item d-flex mb-2">
                    <div class="item-thumb me-3">
                        <div class="media-placeholder rounded blog-relative">
                            <div class="bg rounded">
                                <a href="/tin-tuc/{{ $item->slug }}">
                                    <img src="https://media-tt.nick.vn/{{ $item->image }}" class="img-fluid" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item-content">
                        <a href="/tin-tuc/{{ $item->slug }}" class="post-link">{{ $item->title }}</a>
                    </div>
                </li>
            @endif
        @endforeach
    </ul>
</div><!-- END Recent Posts -->

<!-- BEGIN Banner Block -->
@foreach($data as $key => $item)
    @if($key == 4)
        <div class="mb-4">
            <a href="/tin-tuc/{{ $item->slug }}">
                <div class="media-placeholder ratio-4-3">
                    <div class="media-inner bg-overlay gradient-from-bottom d-flex align-items-end">
                        <img src="https://cdn.upanh.info/{{ $item->image }}" class="bg" alt="" style="object-fit: cover">
                        <div class="p-3 text-white p-3 text-white gradient-from-bottom-title">
                            <p class="lead mb-0" style="color: #fff !important;">{{ $item->title }}</p>
                            <h5 class="mb-0" style="color: #fff !important;">Ăn ngay khuyến mãi</h5>
                            <a href="/tin-tuc/{{ $item->slug }}" class="btn btn-sm rounded-x bg-warning-gradient text-white mt-2 ps-3 pe-3">Xem chi tiết <i class="las la-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </a>

        </div><!-- BEGIN Banner Block -->
    @endif
@endforeach
@endif
