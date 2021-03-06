<div class="col-12 item_buy_form_search">
    <div class="input-group">
        <span class="input-group-addon">Tìm kiếm</span>
        <input name="title-mobile" type="text" class="form-control title-mobile" placeholder="Tìm kiếm">
    </div>
</div>
<div class="col-12 item_buy_form_search">
    <div class="input-group">
        <span class="input-group-addon">Mã số</span>
        <input name="id-mobile" type="text" class="form-control id-mobile" placeholder="Mã số">
    </div>
</div>
<div class="col-12 item_buy_form_search">
    <div class="input-group">
        <span class="input-group-addon" >Giá tiền</span>

        {{--                                        {{Form::select('price',array(''=>'-- Chọn giá tiền --')+config('module.acc.price'),old('price', isset($data['price']) ? $data['price'] : null),array('class'=>'form-control price'))}}--}}

        <select type="text" name="price-mobile price-mobile" class="form-control">
            <option value="">Chọn giá tiền</option>
            <option value="0-50000">Dưới 50K</option>
            <option value="50000-200000">Từ 50K - 200K</option>
            <option value="200000-500000">Từ 200K - 500K</option>
            <option value="500000-1000000">Từ 500K - 1 Triệu</option>
            <option value="1000000-5000000">Trên 1 Triệu</option>
            <option value="5000000-10000000">Trên 5 Triệu</option>
            <option value="10000000">Trên 10 Triệu</option>
        </select>

    </div>
</div>
<div class="col-12 item_buy_form_search">
    <div class="input-group">
        <span class="input-group-addon">Trạng thái</span>
        <select type="text" name="status-mobile" class="form-control status-mobile">
            <option value="">Chọn trạng thái</option>
            <option value="1">Chưa bán</option>
            <option value="0">Đã bán</option>
            {{--                                            <option value="2">Đã đặt cọc</option>--}}
            <option value="">Tất cả</option>
        </select>
    </div>
</div>

@if(isset($dataAttribute) && count($dataAttribute) > 0)
    @foreach($dataAttribute as $val)
        {{--        @dd($val)--}}
        @if($val->position == 'select')
            <div class="col-12 item_buy_form_search">
                <div class="input-group">
                    <span class="input-group-addon">{{ $val->title }}</span>
                    <select type="text" class="form-control select-mobile" name="attribute_id_{{ $val->id }}">
                        <option value="">--Không chọn--</option>
                        @foreach($val->childs as $child)
                            <option value="{{ $child->id }}">{{ $child->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
    @endforeach
@endif


<div class="col-12 item_buy_form_search">
    <div class="row">
        <div class="col-md-6">
            <div class="input-group">
                <button type="submit" class="btn">Tìm kiếm</button>
                <a href="javascript:void(0)" class="btn btn-danger btn-all-mobile">Tất cả</a>
            </div>
        </div>
        <div class="col-md-6" style="margin-top: 8px">
            <div class="row justify-content-end">
                <div class="col-auto">
                    <div class="input-group">
                        <span class="input-group-addon">Sắp xếp theo</span>
                        <select type="text" name="sort_by_mobile" class="form-control sort_by_mobile">
                            <option value="">Chọn cách sắp xếp</option>
                            <option value="random">Ngẫu nhiên</option>
                            <option value="price_start">Giá tiền từ cao đến thấp</option>
                            <option value="price_end">Giá tiền từ thấp đến cao</option>
                            <option value="created_at_start">Mới nhất</option>
                            <option value="created_at_end">Cũ nhất</option>
                            {{--                                                            <option value="">Tất cả</option>--}}
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>







