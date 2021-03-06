<div class="col-md-12 left-right">
    <div class="row marginauto body-detail-ct">

        <div class="col-md-12 text-left left-right">
            <div class="row body-detail-row-ct">
                @if (isset($data))
                    @foreach ($data as $item)
                        <div class="col-auto body-detail-nick-col-ct" data-title="{{ isset($item->custom->title) ? $item->custom->title :  $item->title }}">
                            <a href="/mua-acc/{{ isset($item->custom->slug) && $item->custom->slug != '' ? $item->custom->slug :  $item->slug }}" class="list-item-nick-hover">
                                <div class="row marginauto">
                                    <div class="col-md-12 left-right default-overlay-nick-ct">
                                        @if(isset($item->image))
                                            <img class="lazy" src="{{ isset($item->custom->image) ? \App\Library\MediaHelpers::media($item->custom->image) : \App\Library\MediaHelpers::media($item->image) }}" alt="">
                                        @endif
                                    </div>
                                    <div class="col-md-12 left-right list-item-nick">
                                        <div class="row marginauto list-item-nick-body">
                                            <div class="col-md-12 left-right text-left body-detail-account-col-span-ct">
                                                <span>{{ isset($item->custom->title) ? $item->custom->title :  $item->title }}</span>
                                            </div>
                                            <div class="col-md-12 left-right text-left body-detail-account-small-span-ct">
                                                @if(isset($item->items_count))
                                                    @if((isset($item->account_fake) && $item->account_fake > 1) || (isset($item->custom->account_fake) && $item->custom->account_fake > 1))
                                                        <small>S??? t??i kho???n: {{ str_replace(',','.',number_format(round(isset($item->custom->account_fake) ? $item->items_count*$item->custom->account_fake : $item->items_count*$item->account_fake))) }}</small>
                                                    @else
                                                        <small>S??? t??i kho???n: {{ $item->items_count }} </small>
                                                    @endif

                                                @else
                                                    <small>S??? t??i kho???n: 9999 </small>
                                                @endif
                                            </div>
                                            {{-- <div class="col-md-12 left-right text-left body-detail-account-small-span-ct">
                                                <small>???? b??n: 40K</small>
                                            </div> --}}
                                            {{-- <div class="col-md-12 left-right text-left body-detail-account-small-span-ct">
                                                <ul>
                                                    <li class="fist-li-account">15.000??</li>
                                                    <li class="second-li-account">30.000??</li>
                                                    <li class="three-li-account">-50%</li>
                                                </ul>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <p>Hi???n t???i kh??ng c?? d??? li???u n??o ph?? h???p v???i y??u c???u c???a b???n! H??? th???ng c???p nh???t nick th?????ng xuy??n b???n vui l??ng theo d??i web trong th???i gian t???i !</p>
                @endif
            </div>
        </div>

    </div>
</div>
