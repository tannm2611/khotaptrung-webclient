@if(isset($data))
    <div class="list-service">
        @forelse($data as $service)
            <div class="item-service js-service">
                <div class="card">
                    <a href="/dich-vu/{{@$service->slug}}" class="card-body scale-thumb c-p-16">
                        <div class="account-thumb c-mb-8">
                            <img src="{{@\App\Library\MediaHelpers::media($service->image)}}" alt="{{@$service->slug}}"
                                 class="account-thumb-image">
                        </div>
                        <div class="account-title">
                            <div class="text-title fw-700 text-limit limit-1">{{@$service->title}}</div>
                        </div>
                        <div class="account-info">
                            <div class="info-attr">
                                @if(isset($service->total_order))
                                    @if($service->params_plus)
                                        @foreach($service->params_plus as $key => $val)
                                            @if($key == 'fk_buy')
                                                <p>Giao dịch: {{ str_replace(',','.',number_format($service->total_order + $val)) }}</p>
                                            @endif
                                        @endforeach

                                    @else
                                        <p>Giao dịch: {{ str_replace(',','.',number_format($service->total_order)) }}</p>
                                    @endif

                                @else
                                    @if($service->params_plus)
                                        @foreach($service->params_plus as $key => $val)
                                            @if($key == 'fk_buy')
                                                <p>Giao dịch: {{ str_replace(',','.',number_format($val)) }}</p>
                                            @endif
                                        @endforeach
                                    @else
                                        <p>Giao dịch: 0</p>
                                    @endif

                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @empty
        @endforelse
    </div>
@else
    <div class="col-12  text-center my-3" id="text-empty" style="display: none">
        <span class="text-danger">Không có kết quả nào phù hợp</span>
    </div>
@endif
