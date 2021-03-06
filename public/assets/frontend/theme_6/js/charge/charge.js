$(document).ready(function(){

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
    }

    function reload_captcha() {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {

                $(".captcha_1 span").html(data.captcha);
            }
        });
    }

    $('#reload_1').click(function () {
        $('.refresh-captcha img').toggleClass("down");
        $.ajax({
            type: 'GET',
            url: 'reload-captcha2',
            success: function (data) {
                // console.log(data)
                $(".captcha_1 span").html(data);
            }
        });

    });

    function getTelecom(){
        var url = '/get-tele-card';
        $.ajax({
            type: "GET",
            url: url,
            success: function (data) {
                console.log(data)
                if(data.status == 1){
                    let html = '';
                    if(data.data.length > 0){
                        $.each(data.data,function(key,value){
                            html += '<option value="'+value.key+'">'+value.key+'</option>';
                        });
                    }
                    else{
                        html += '<option value="">-- Vui lòng chọn nhà mạng --</option>';
                    }
                    $('select#telecom').html(html)
                    $('.select-form').niceSelect('update');
                    ele = $('select#telecom option').first();
                    var telecom = ele.val();
                    getAmount(telecom);
                    $('.charge_name').html(' <small>'+telecom+'</small>')
                    paycartDataChargeHistory();

                    $('.loading-data').remove();


                    $('#form-charge2').removeClass('hide_charge');
                }
            },
            error: function (data) {
                swal({
                    title: "Lỗi !",
                    text: "Có lỗi phát sinh vui lòng liên hệ QTV để kịp thời xử lý.",
                    icon: "error",
                    buttons: {
                        cancel: "Đóng",
                    },
                })
            },
            complete: function (data) {
            }
        });
    }

    function getAmount(telecom){
        var url = '/get-amount-tele-card';
        $.ajax({
            type: "GET",
            url: url,
            data: {
                telecom:telecom
            },
            beforeSend: function (xhr) {

            },
            success: function (data) {
                if(data.status == 1){
                    $('.amount-loading').remove();
                    let html = '';
                    // html += '<option value="">-- Vui lòng chọn mệnh giá, sai mất thẻ --</option>';
                    console.log(data.data)
                    if(data.data.length > 0){
                        $.each(data.data,function(key,value){
                            html += '<div class=" col-4 col-md-4 pl-fix-4 pr-fix-4 check-radio-form charge-card-form">'
                            if (key == 0){
                                html += '<input  name="amount" type="radio" id="recharge_amount_'+key+'" data-ratito="'+value.ratio_true_amount+'" value="'+value.amount+'"  hidden checked>'
                            }else {
                                html += '<input  name="amount" type="radio" id="recharge_amount_'+key+'" data-ratito="'+value.ratio_true_amount+'" value="'+value.amount+'" hidden>'
                            }

                            html += '<label for="recharge_amount_'+key+'">'
                            html += '<p>'+ formatNumber(value.amount)  +'đ</p>'
                            html += ' </label>'
                            html += '  </div>'
                            // html += '<option value="'+ value.amount +'" rel-ratio="'+ value.ratio_default+'">'+ formatNumber(value.amount)  +' VNĐ - Nhận ' + value.ratio_true_amount +'% </option>';
                        });
                    }


                    $('#amount').html(html);

                    amount_checked =  $('input[name=amount]:checked');

                    $('.charge_amount').html(' <small>'+  formatNumber(amount_checked.val())+'</small>')
                    $('.charge_price').html(' <span>'+  formatNumber(amount_checked.val())+'</span>')
                    $('.charge_ratito').html(' <small>'+  formatNumber(amount_checked.attr("data-ratito"))+'</small>')
                    $('input[name=amount]').change(function(){
                        $('.charge_amount').html(' <small>'+ formatNumber($(this).val()) +'</small>')
                        $('.charge_price').html(' <span>'+ formatNumber($(this).val()) +'</span>')
                        $('.charge_ratito').html(' <small>'+ formatNumber($(this).attr("data-ratito")) +'</small>')

                    });


                    reload_captcha()
                }
                // else{
                //     swal({
                //         title: "Có lỗi xảy ra !",
                //         text: data.message,
                //         icon: "error",
                //         buttons: {
                //             cancel: "Đóng",
                //         },
                //     })
                // }
            },
            error: function (data) {
                swal({
                    title: "Lỗi !",
                    text: "Có lỗi phát sinh vui lòng liên hệ QTV để kịp thời xử lý.",
                    icon: "error",
                    buttons: {
                        cancel: "Đóng",
                    },
                })
            },
            complete: function (data) {

            }
        });
    }



    $('body').on('change','#telecom',function(){
        var telecom = $(this).val();
        $('.charge_name').html(' <small>'+telecom+'</small>')
        $('.charge_amount').html('')
        $('.charge_price').html('')
        $('.charge_ratito').html('')
        getAmount(telecom)
    });

    getTelecom();




    var formSubmit = $('#form-charge2');
    var url = formSubmit.attr('action');
    var btnSubmit = formSubmit.find(':submit');
    let width = $(window).width();
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

    function postCharge(){
        $.ajax({
            type: "POST",
            url: url,
            cache:false,
            data: formSubmit.serialize(), // serializes the form's elements.
            beforeSend: function (xhr) {

            },
            success: function (data) {

                $('#openCharge').modal('hide');

                if(data.status == 1){
                    $('#successChargeModal').modal('show');
                    $('#success_charge').html(data.message)

                }
                else if(data.status == 401){
                    window.location.href = '/login?return_url='+window.location.href;
                }
                else if(data.status == 0){
                    $('#rejectChargeModal').modal('show');
                    $('#reject_charge').html(data.message)
                }
                else{
                    swal({
                        title: "Có lỗi xảy ra !",
                        text: data.message,
                        icon: "error",
                        buttons: {
                            cancel: "Đóng",
                        },
                    })
                }
            },
            error: function (data) {
                swal({
                    title: "Có lỗi xảy ra !",
                    text: "Có lỗi phát sinh vui lòng liên hệ QTV để kịp thời xử lý.",
                    icon: "error",
                    buttons: {
                        cancel: "Đóng",
                    },
                })
            },
            complete: function (data) {
                $('#reload_1').trigger('click');
                formSubmit.trigger("reset");
                btnSubmit.text('Nạp thẻ');
                btnSubmit.prop('disabled', false);
            }
        });
    }

    formSubmit.submit(function (e) {
        e.preventDefault();
        e.stopPropagation();

        if (width < 992){
            if (animating) return false;
            animating = true;
            current_fs = $('#fieldset-one_transaction');
            next_fs = $('#fieldset-two-charge');
            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function (now, mx) {
                    left = (now * 50) + "%";
                    opacity = 1 - now;
                    next_fs.css({'left': left, 'opacity': opacity});
                },
                complete: function () {
                    current_fs.hide();
                    animating = false;
                },
                easing: 'easeInOutBack'
            });
        }else {
            $('#openCharge').modal('show');
        }


    });
    $('.btn-confirm-charge').on('click', function (m) {

        btnSubmit.text('Đang xử lý...');
        btnSubmit.prop('disabled', true);

        if (width < 992){
            postCharge()

        }else {
            postCharge()
        }
        return false;





    });

    $(document).on('click', '.paginate__v1__nt .pagination a',function(event){
        event.preventDefault();

        var page = $(this).attr('href').split('page=')[1];

        $('#hidden_page_service_nt').val(page);

        $('li').removeClass('active');
        $(this).parent().addClass('active');


        paycartDataChargeHistory(page);
    });

    function paycartDataChargeHistory(page) {

        request = $.ajax({
            type: 'GET',
            url: '/get-tele-card/data',
            data: {
                page:page,
            },
            beforeSend: function (xhr) {

            },
            success: (data) => {
                if (data.status == 1){
                    $(".paycartdata").empty().html('');
                    $(".paycartdata").empty().html(data.data);
                }else if (data.status == 0){
                    var html = '';
                    html += '<div class="table-responsive" id="tableacchstory">';
                    html += '<table class="table table-hover table-custom-res">';
                    html += '<thead><tr><th>Thời gian</th><th>Nhà mạng</th><th>Mã thẻ</th><th>serial</th><th>Mệnh giá</th><th>Kết quả</th><th>Thực nhận</th></tr></thead>';
                    html += '<tbody>';
                    html += '<tr><td colspan="8"><span style="color: red;font-size: 16px;">' + data.message + '</span></td></tr>';
                    html += '</tbody>';
                    html += '</table>';
                    html += '</div>';

                    $(".paycartdata").empty().html('');
                    $(".paycartdata").empty().html(html);
                }

            },
            error: function (data) {

            },
            complete: function (data) {

            }
        });
    }
});
