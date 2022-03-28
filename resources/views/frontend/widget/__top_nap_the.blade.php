<p style="color: red;font-size: 14px">  {{ $errors->first() }}   </p>
<p style="color: red;font-size: 14px;text-align: center">  {{ $errors->first() }}   </p>
@if(isset($data) && count($data) > 0)
    <p style="color: red;font-size: 14px;text-align: center">  {{ $errors->first() }}   </p>

<ul class="content-banner-card-top">
    @foreach($data as $items => $item)

        <li>
            <i>{{$items ? $items : '0'}}</i>
            <span>{{$item->fullname ? $item->fullname : $item->username}}</span>
            <label >
                @if(isset($item->amount))
                    {{str_replace(',','.',number_format($item->amount))}}

                @else
                    0
                @endif
               <sup>đ</sup>
            </label>
        </li>
    @endforeach

</ul>
@endif
