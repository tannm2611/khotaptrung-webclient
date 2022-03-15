@extends('frontend.layouts.master')
@section('content')
    <div class="account">
        <div class="account_content">
            <div class="container">
                @include('frontend.pages.account.sidebar')
                <div class="account_sidebar_content">
                    <div class="account_pay_card">
                        <div class="account_sidebar_content_title">
                            <p>NẠP THẺ</p>
                            <div class="account_sidebar_content_line"></div>
                        </div>

                        <p>ID của bạn: <strong> {{App\Library\AuthCustom::user()->id}}</strong> </p>
                        <span><p>* Ưu tiên nạp thẻ VIETTEL & VINAPHONE</p></span>
                        <p style="color: red;font-size: 14px">    {{ $errors->first() }}</p>
                        <p style="color: red"></p>
                        <form action="{{route('postTelecomDepositAuto')}}" method="POST" id="form-charge">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-3 control-label">
                                    Tài khoản

                                </label>
                                <div class="col-md-6">
                                    <div class="input-group" style="width: 100%">
                                        <input type="text" class="form-control" placeholder="" value=" {{App\Library\AuthCustom::user()->username}}" readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group row ">

                                <label class="col-md-3 control-label">
                                    Loại thẻ:
                                </label>

                                <div class="col-md-6">
                                    <div class="input-group" style="width: 100%">
                                        {{--                                        @dd($bank->datay)--}}
                                        @if(isset($bank->data))
                                            <select id="telecard" name="telecom" class="form-control">
                                                @foreach($bank->data as $items)
                                                    <option value="{{$items->key}}">{{$items->key}}</option>
                                                @endforeach


                                            </select>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">
                                    Mệnh giá:

                                </label>

                                <div class="col-md-6">
                                    <div class="input-group" style="width: 100%">
                                        <select name="amount" id="" class="form-control">
                                            <option value="">-- Chọn đúng mệnh giá, sai mất thẻ --</option>

                                            @foreach($amount->data as $items)
                                                <option value="{{$items->amount}}">{{$items->amount}} VNĐ (nhận {{$items->ratio_true_amount}}%)</option>
                                            @endforeach

{{--                                            <option value="1">10,000 VNĐ (nhận 100.0%)</option>--}}
{{--                                            <option value="2">20,000 VNĐ (nhận 100.0%)</option>--}}
{{--                                            <option value="">30,000 VNĐ (nhận 100.0%)</option>--}}
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">
                                    Mã số thẻ:

                                </label>
                                <div class="col-md-6">
                                    <div class="input-group" style="width: 100%">
                                        <input type="text" class="form-control" name="pin">
                                    </div>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">
                                    Số Serial:

                                </label>
                                <div class="col-md-6">
                                    <div class="input-group" style="width: 100%">
                                        <input type="text" class="form-control"  name="serial">
                                    </div>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">
                                    Mã bảo vệ:

                                </label>
                                <div class="col-md-6">
                                    <div class="input-group" style="width: 100%">
                                        <input type="text" class="form-control" name="captcha" id="captcha">
                                        <div class="captcha">
                                            <span class="reload"  id="reload">
                                                {!! captcha_img() !!}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group row " style="margin-top: 40px">
                                <div class="col-md-6" style="    margin-left: 25%;">
                                    <button class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold btn-block loading" type="submit">Nạp thẻ</button>
                                </div>
                            </div>
                        </form>

                        <table class="table table-striped">
                            <thead>
                            <tr>
{{--                                <th>Thời gian	</th>--}}
                                <th>Nhà mạng</th>
                                <th>Mã thẻ	</th>
                                <th>Serial</th>
                                <th>Kiểu nạp	</th>
                                <th>Mệnh giá	</th>
                                <th>Kết quả</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bankHistory->data->data as $historyitems)
                            <tr>
{{--                                <th>03/07/2022</th>--}}
                                <td>{{$historyitems->telecom_key}}</td>
                                <td>{{$historyitems->telecom_key}}</td>
                                <td>{{$historyitems->pin}}</td>
                                <td>{{$historyitems->serial}}</td>
                                <td>{{$historyitems->declare_amount}}</td>
                                <td>{{$historyitems->response_mess}}</td>
                            </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // $(document).on('click','.hideThanhich',function (e) {

        $(document).ready(function() {

            // $(function () {
            $('#telecard').change(function () {
                // $("#telecard").on('change', function(){
                $('.hide').show();
                telecom = $(this).val();
                $.ajax({
                    type: 'GET',
                    dataType: "json",
                    data: {
                        telecom: telecom,

                    },
                    url: "/telecom-deposit-auto",
                    success: function (response) {
                        console.log(response.data.data)
                        $('select[name="amount"]').find('option:not(:first)').remove();
                        for(i = 0; i < response.data.data.length; i++) {

                            tele = response.data.data[i];
                            let html = '';
                            html +=''
                            html += '<option value="'+ tele['amount'] +'">'+ tele['amount'] +' VNĐ (nhận ' + tele['agency_ratio_true_amount'] +'%) </option>';
                            $('select[name="amount"]').append(html)

                        };


                    }


                    {{--url : '/telecom-deposit-auto',--}}
                    {{--type: 'Post',--}}
                    {{--data: {--}}
                    {{--    _token: "{{ csrf_token() }}",--}}
                    {{--    // secret_key: config('api.secret_key'),--}}
                    {{--    // domain:'youtube.com',--}}
                    {{--    // telecom: telecom--}}
                    {{--},--}}

                    {{--// beforeSend: function (xhr) {--}}
                    {{--//     $('.hide').hide();--}}
                    {{--//     console.log(data)--}}
                    {{--// },--}}
                    {{--success: function (data) {--}}
                    {{--    console.log(data);--}}
                    {{--    $('.hide').hide();--}}
                    {{--},--}}
                    {{--error: function (data) {--}}
                    {{--    console.log('sai')--}}
                    {{--}--}}
                });


            });


            // });
            // $("#telecard").change(function (elm, select) {
            //
            //     // server = parseInt($(".server-filter").val());
            //     // $('[name="server"]').val(server);
            //     // if($("#minmax_"+server).length > 0)
            //     // {
            //     //     $('#min_money').text($("#minmax_"+server).attr("data-value-min-text").toString());
            //     //     $('#max_money').text($("#minmax_"+server).attr("data-value-max-text").toString());
            //     //     $('#input_pack').val($("#minmax_"+server).attr("data-value-min").toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            //     server = parseInt($("#telecard").val());
            //
            //     $('[name="server"]').val(server);
            //     // }
            //     telecard();
            // });

        });
    </script>

    <script type="text/javascript">
        $('#reload').click(function () {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function (data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
        $('#form-charge').submit(function (e) {
            e.preventDefault();
            var formSubmit = $(this);
            var url = formSubmit.attr('action');
            var btnSubmit = formSubmit.find(':submit');
            btnSubmit.text('Đang xử lý...');
            btnSubmit.prop('disabled', true);
            $.ajax({
                type: "POST",
                url: url,
                cache:false,
                data: formSubmit.serialize(), // serializes the form's elements.
                beforeSend: function (xhr) {

                },
                success: function (data) {
                    console.log(data);
                    if(data.status == 1){
                        alert(data.message);

                        // formSubmit.remove();
                    }
                    else{
                        alert(data);
                        btnSubmit.text('Xác nhận');
                        btnSubmit.prop('disabled', false);
                    }
                },
                error: function (data) {
                    // console.log(data.responseJSON.errors[1])
                    alert('Điền đúng mã capcha');
                    btnSubmit.text('Xác nhận');
                    btnSubmit.prop('disabled', false);
                },
                complete: function (data) {
                    $('#imgcaptcha').trigger('click');
                    $('#form-recharge').trigger("reset");
                }
            });
        });
    </script>


@endsection

