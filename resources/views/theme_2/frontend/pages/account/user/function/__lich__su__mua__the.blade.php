
<!-- BEGIN List Items -->
{{--@dd($data->data)--}}



@if(empty($data->data))
    <div class="row" >
    @if(isset($data) && count($data) > 0)

        @foreach ($data as $key => $item)
                @foreach($item->card as $itemCard)
            <div class="col-lg-3 col-md-6">
                <!-- BEGIN Purchased Item -->

                <div class="purchased-item mb-4">
                    <div class="mb-2 item-meta small text-secondary">
                        <i class="las la-clock"></i> {{ formatDateTime($item->created_at) }}
                        {{--                        12:24 31/03/2021--}}
                    </div>



                    <div class="item-content">
                        <div class="inner">
                            <div class="item-logo mb-2 d-flex align-items-center">
{{--                                <img src="{{ $item->image }}" class="logo me-2" alt=""> --}}
                                                                Thẻ
                            </div>
                            <div class="mb-2">
                                <label class="mb-1 text-secondary">Mã Pin</label>
                                <div class="input-group">
{{--                                    @if(isset($arrpin) && count($arrpin))--}}
{{--                                        <input type="text" class="form-control border-end-0" placeholder="" value="{{ $arrpin[$key] }}" aria-label="">--}}
{{--                                    @endif--}}

                                    <input type="text" class="form-control border-end-0" placeholder="" value="{{  App\Library\Helpers::Decrypt($itemCard->pin,config('module.charge.key_encrypt')) }}" aria-label="">
                                    <span class="input-group-text bg-transparent text-secondary"><i class="las la-copy" style="cursor: pointer" data-id="{{  App\Library\Helpers::Decrypt($itemCard->pin,config('module.charge.key_encrypt')) }}"></i></span>
                                </div>
                            </div>
                            <div class="mb-2 d-flex justify-content-between">
                                <div class="text-secondary">Số seri</div>
                                <div>
{{--                                    @if(isset($item->serial))--}}
{{--                                        {{ $item->serial }}--}}
{{--                                    @endif--}}
                                    {{  App\Library\Helpers::Decrypt($itemCard->serial,config('module.charge.key_encrypt')) }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- END Purchased Item -->
            </div>
        <!-- END List Items -->
                @endforeach
        @endforeach
    @else
        <div class="col-md-12">
            <span style="color: red;font-size: 16px;">Không có dữ liệu!</span>
        </div>
    @endif
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


            <nav class="page-pagination mb-2 paginate__v1_index__lsmt paginate__v1_mobie frontend__panigate">
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
<script>
    $('body').on('click','i.la-copy',function(e){
        data = $(this).data('id');
        var $temp = $("<input>");
        $("body #copy").html($temp);
        $temp.val($.trim(data)).select();
        document.execCommand("copy");
        $temp.remove();
    });
</script>
