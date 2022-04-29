@if(isset($data) && count($data) > 0)
<!-- BEGIN Guide Block -->
<div class="mb-4">
    <h6 class="title-style-tab"><span><i class="las la-question-circle icon"></i> Hướng dẫn</span></h6>
    <ul class="list-unstyled list-with-icon">
        @foreach($data as $key => $item)
            @if($key < 3)
            <li><a href="/tin-tuc/{{ $item->slug }}"><i class="las la-angle-right icon"></i> {{ $item->title }}</a></li>
            @endif
        @endforeach
    </ul>
</div><!-- BEGIN Guide Block -->
<!-- BEGIN Banner Block -->
@foreach($data as $key => $item)
    @if($key == 3)

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



