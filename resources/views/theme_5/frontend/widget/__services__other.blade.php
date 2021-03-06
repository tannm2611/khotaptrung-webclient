@if(isset($data))

<div class="section-header c-mb-16 media-web services-other-title">
    <div class="section-title fz-lg-20 lh-lg-24">
        Dịch vụ khác
    </div>
</div>
<div class="menu-category media-web services-other">
    <ul class="d-flex justify-content-between px-0 menu-category_fixm ">
        @foreach($data as $item)
        <li class="w-100 c-px-8">
            @if(isset($item->target))
            <a href="{{ $item->url }}" target="_blank">
                <div class="c-p-18 brs-8 menu-category-item d-flex justify-content-center">
                    <img src="/assets/frontend/{{theme('')->theme_key}}/image/nam/storecard.svg" alt="{{ $item->slug }}" class="c-pr-4">
                    <span class="fw-500 fz-15 lh-24">{{ $item->title }}</span>
                </div>
            </a>
            @else
                <a href="{{ $item->url }}">
                    <div class="c-p-18 brs-8 menu-category-item d-flex justify-content-center">
                        <img src="/assets/frontend/{{theme('')->theme_key}}/image/nam/storecard.svg" alt="{{ $item->slug }}" class="c-pr-4">
                        <span class="fw-500 fz-15 lh-24">{{ $item->title }}</span>
                    </div>
                </a>
            @endif
        </li>
        @endforeach
    </ul>
</div>
@endif
