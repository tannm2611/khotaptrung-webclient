

    $(document).ready(function () {
        var i = 0;
        var check = [];
        if(i == 0){
            getTelecom();
        }
        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
        }

        $('.nav-item-telecom').on('click',function(){
            $('body .gateway-telecom').remove();
            $('.infor-pay').css("display", "none");
            $('.nav-item .nav-link-telecom').each(function(){
                var active = $(this).hasClass('active');
                if(active){
                    telecom = $(this).attr("data-content");
                }
            });
            if(jQuery.inArray(telecom, check) == -1){
                getTelecom();
            }
            // $('.infor-pay').css("display", "none");
        })
        // mới

        // function formatNumber(num) {
        //     return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
        // }
        $('.more-link').on('click', function(e) {
            e.preventDefault();
            $('.text-rounded').toggleClass('-expanded');
            if ($('.text-rounded').hasClass('-expanded')) {
                $('.more-link').html('Thu gọn <i class="las la-angle-up"></i>');
            } else {
                $('.more-link').html('Xem thêm <i class="las la-angle-down"></i>');
            }
        });
        function getTelecom (){
            $('.nav-item .nav-link-telecom').each(function(){
                var active = $(this).hasClass('active');
                if(active){
                    telecom = $(this).attr("data-content");
                }
            });
            const url = '/store-card/get-telecom';
            $.ajax({
                type: "GET",
                url: url,
                data:{
                    key:telecom,
                },
                beforeSend: function (xhr) {
                },
                success: function (data) {
                    if(data.status == 1){
                        let html = '';
                        if(data.data.length > 0){
                            $.each(data.data,function(key,value){
                                html+=' <div class="col-md-3 col-6 item-telecom">'
                                html+=' <div class="item-gateway me-2" data-key="'+value.key+'">'
                                html+=' <div class="text-center">'
                                html+='  <img src="'+ 'https://media-tt.nick.vn/'+value.image +'" class="mw-100 img" alt="">'
                                html+=' </div>'
                                html+=' </div>'
                                html+=' </div>'
                            });
                            i = 1;
                            key = telecom;
                            $(".supplier_"+telecom).html(html).flickity({
                                cellAlign: 'left',
                                contain: true,
                                prevNextButtons: true,
                                pageDots: true,
                                autoPlay: 9000,
                                wrapAround: true,



                            });
                        }
                        else {
                            // swal({
                            //     title: "Có lỗi xảy ra !",
                            //     text: data.message,
                            //     icon: "error",
                            //     buttons: {
                            //         cancel: "Đóng",
                            //     },
                            // })
                        }


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
                    alert('Có lỗi phát sinh, vui lòng liên hệ QTV để kịp thời xử lý!')
                    return;
                },
                complete: function (data) {
                    $('.store-loading').hide();
                }
            });
            if(jQuery.inArray(telecom, check) == -1){
                check.push(telecom);
            }
        }

        $('body').on('click','.item-gateway',function(e){
            let html ="";
            let render = "";
            let input_telecom = "";
            var check_amount = [];
            e.preventDefault();
            $('.nav-item .nav-link-telecom').each(function(){
                var active = $(this).hasClass('active');
                if(active){
                    telecom = $(this).attr("data-content");
                }
            });
            key = $(this).data('key');
            $('.row-gateway .item-gateway').not($(this)).removeClass('active');
            $('.row-gateway .item-gateway').not($(this)).addClass('out');
            $(this).addClass('active');
            $(this).removeClass('out');
            const url = '/store-card/get-amount';
            if(jQuery.inArray(telecom, check_amount) == -1){

                $.ajax({
                    url: url,
                    type: "GET",
                    data:{
                        telecom:key,
                    },
                    success: function (data) {
                        render += '<div class="pb-5 block-number gateway-telecom">';
                        render += '<div class="icon">2</div>';
                        render += '<h6 class="title-small text-uppercase mb-3">Lựa chọn mệnh giá</h6>';
                        render += '<div class="row row-price g-0">';
                        render += '</div>';
                        render += '<div class="d-flex justify-content-between align-items-center mt-4">';
                        render += '<label class="label mb-0">Số lượng</label>';
                        render += '<div class="input-spinner input-group" style="width: 140px">';
                        render += '<button type="button" class="button-minus" data-field="quantity"></button>';
                        render += '<input readonly type="number" step="1" max="10" min="1" value="1" name="quantity" id="quantity-details" class="quantity-field details-item">';
                        render += '<button type="button" class="button-plus" data-field="quantity"></button>';
                        render += '</div>'
                        render += '</div>'
                        render += '</div>';
                        check_value = $('.price_telecom_'+telecom).html(render);

                        if(check_value){
                            $.each(data.data, function (key, value) {

                                html += '<div class="col-md-3 col-6">';
                                html += "<div class='item-price me-2' data-amount=\"" + value.amount + "\" data-ratio=\"" + value.ratio_default + "\">";
                                html += '<h4 class="text-center mb-2">'+formatNumber(value.amount)+' VND </h4>';
                                html += '<div class="text-center item-store">Giá: <span class="text-danger">'+formatNumber(value.amount * value.ratio_default / 100 )+'</span> đ</div>';
                                html += '<div class="text-center item-discount">Chiết khấu: <b class="text-danger">'+formatNumber(100 - value.ratio_default )+ ' %</b></div>';
                                html += '</div>';
                                html += '</div>';
                            });
                            $(".row-price").html(html).flickity({
                                cellAlign: 'left',
                                contain: true,
                                prevNextButtons: true,
                                pageDots: true,
                                autoPlay: 8000,
                                wrapAround: true,
                            });
                        }
                        input_telecom += '<input style="display:none;" class="input_telecom" type="text" value="'+key+'" name="telecom">';
                        $('#input_telecom').html(input_telecom);
                        $('.infor-pay').css("display", "block");
                        $('.pay_'+telecom+' #text-telecom').text(key);
                        $('.pay_'+telecom+' #text-amount').text(0);
                        $('.pay_'+telecom+' #text-ratio').text(0);
                        $('.pay_'+telecom+' #text-quantity').text(1);
                        $(".pay_"+telecom+" #total-price").html("0 VND");
                        if(jQuery.inArray(telecom, check_amount) == -1){
                            check_amount.push(telecom);
                        }
                    },
                });
            }
        });
        $('body').on('click','.row-price .item-price',function(e){
            e.preventDefault();
            $('.nav-item .nav-link-telecom').each(function(){
                var active = $(this).hasClass('active');
                if(active){
                    telecom_2 = $(this).attr("data-content");
                }
            });
            let input_amount ="";
            let input_ratio ="";
            amount = $(this).data('amount');
            ratio = $(this).data('ratio');

            $('.row-price .item-price').not($(this)).removeClass('active');
            $(this).addClass('active');
            input_amount += '<input style="display:none;" class="input_amount" type="text" value="'+amount+'" name="amount">';
            input_ratio += '<input class="input_ratio" style="display:none;" type="text" value="'+amount * ratio / 100 +'" name="ratio">';
            $('#input_amount').html(input_amount);
            $('#input_ratio').html(input_ratio);
            $('.pay_'+telecom_2+' #text-amount').text(formatNumber(amount)+ " VND");
            $('.pay_'+telecom_2+' #text-ratio').text(formatNumber(amount - (amount*ratio/100))+ " VND");
            updatePrice();
        });


        // function formatNumber(num) {
        //     return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
        // }
        $("input[type='number']").inputSpinner();
        function incrementValue(e) {
            e.preventDefault();
            var fieldName = $(e.target).data('field');
            var parent = $(e.target).closest('div');
            var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

            if (!isNaN(currentVal)) {
                parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
            } else {
                parent.find('input[name=' + fieldName + ']').val(1);
            }
        }

        function decrementValue(e) {
            e.preventDefault();
            var fieldName = $(e.target).data('field');
            var parent = $(e.target).closest('div');
            var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

            if (!isNaN(currentVal) && currentVal > 1) {
                parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
            } else {
                parent.find('input[name=' + fieldName + ']').val(1);
            }
        }
        $('body').on('click','.input-group .button-plus',function(e){
            $('.nav-item .nav-link-telecom').each(function(){
                var active = $(this).hasClass('active');
                if(active){
                    telecom = $(this).attr("data-content");
                }
            });
            incrementValue(e);
            qty = $('#quantity-details').val();
            $('.pay_'+telecom+' #text-quantity').text(qty);
            updatePrice();
        });

        $('body').on('click','.input-group .button-minus',function(e){
            $('.nav-item .nav-link-telecom').each(function(){
                var active = $(this).hasClass('active');
                if(active){
                    telecom = $(this).attr("data-content");
                }
            });
            decrementValue(e);
            qty = $('#quantity-details').val();
            $('.pay_'+telecom+' #text-quantity').text(qty);
            updatePrice();
        });

        function updatePrice(){
            $('.nav-item .nav-link-telecom').each(function(){
                var active = $(this).hasClass('active');
                if(active){
                    telecom_111 = $(this).attr("data-content");
                }
            });
            data_qty = $('#quantity-details').val();
            data_amount = $('.input_ratio').val();
            data_amount_old = $('.input_amount').val();
            if(data_amount == null){
                data_amount = 0;
            }
            if(data_qty == null){
                data_qty = 1;
            }
            $('.pay_'+telecom_111+' #text-ratio').text(formatNumber((data_amount_old - data_amount) * data_qty)+ " VND");
            $(".pay_"+telecom_111+" #total-price").html(formatNumber(data_qty * data_amount)+" VND");
            money_pay = $("#auth .auth").val();
            if(money_pay == "none"){
                $("#steps-2").remove();
            }
            total = data_qty * data_amount;
            money = money_pay - total;
            $("#"+telecom_111+" #text-money-pay").text(formatNumber(total));
            $("#"+telecom_111+" #auth-money").text(formatNumber(money_pay));
            let render = "";
            if(money < 0){
                money_1 = total - money_pay;
                render += '<td>Số tiền cần nạp thêm</td>';
                render += '<td id="text-auth-balance" class="text-end"><strong class="text-danger">'+formatNumber(money_1)+'</strong></td>';
                render += '<td class="text-end text-secondary" width="20">đ</td>';
                $(".text-noti-balance").html('<div class="alert alert-warning " role="alert"> <p class="mb-0">Không đủ tiền trong tài khoàn vui lòng <a href="/nap-the" target="_blank" class="border-bottom">nạp thêm</a>  vào tài khoản</p></div>')
            }else{
                render +='<td>Số tiền còn lại</td>';
                render += '<td id="text-auth-balance" class="text-end"><strong class="text-danger">'+formatNumber(money)+'</strong></td>';
                render += '<td class="text-end text-secondary" width="20">đ</td>';
            }
            $("#"+telecom_111+" #text-noti").html(render);
        }




        $('body').on('click','.button-action-steps',function(e){
            $("ul.nav-qp-tabs li a.nav-link-telecom").addClass('disabled');
            $(' #nav-steps-wrapper').css('display','block');
            var steps = new Array("steps-1", "steps-2", "steps-3");
            id = $(this).data("id");
            if(id == 2){
                check = $('#input_amount .input_amount').val();
                if(check == null || check == ""){

                    swal({
                        title: "Lỗi !",
                        text: "Bạn chưa chọn mệnh giá",
                        icon: "error"
                    })
                }else{
                    $('.nav-steps-wrapper ul.nav-steps li.nav-item a.nav-link').removeClass('active');
                    $('#step-example .tab-content').removeClass('active');

                    $("#steps-"+id+".tab-content").addClass('active');
                    $('.nav-steps-wrapper ul.nav-steps li.nav-item a.steps-'+id).addClass('active');
                }
            }
        });

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        $('body').on('click','i.la-copy',function(e){
            data = $(this).data('id');
            var $temp = $("<input>");
            $("body #copy").html($temp);
            $temp.val($.trim(data)).select();
            document.execCommand("copy");
            $temp.remove();
            toastr.success('Sao chép thành công!');
        });


        $('#form-storeCard').submit(function (e) {
            e.preventDefault();
            var formSubmit = $(this);
            var url = formSubmit.attr('action');
            var btnSubmit = formSubmit.find(':submit');
            key = $("#input_telecom input.input_telecom").val();
            amount = $("#input_amount input.input_amount").val();
            quantity = $('#quantity-details').val();
            // btnSubmit.text('Đang xử lý...');
            $.ajax({
                type: "POST",
                url: url,
                cache:false,
                data: formSubmit.serialize(), // serializes the form's elements.
                // data:{
                //     telecom:key,
                //     amount:amount,
                //     quantity:quantity,
                // },
                beforeSend: function (xhr) {
                    $("#overlay").fadeIn(300);
                },
                success: function (data) {
                    let html = '';
                    if(data.errors){
                        $(".info-buy-card").remove();

                        html += '<div class="alert alert-danger mb-3 text-center" role="alert">';
                        html += '<p class="display-6 text-danger mb-0"><i class="las la-frown"></i></p>';
                        html += '<h5 class="mb-0">uh oh, có lỗi xảy ra</h5>';
                        html += '<p class="mb-0">'+data.errors+'</p>';
                        html += '</div>';
                    }else{


                        if(data.status == 1){


                            html += '<div class="alert alert-success mb-3 text-center" role="alert">';
                            html += '<p class="display-6 mb-0 text-success"><i class="las la-glass-cheers"></i></p>';
                            html += '<p class="mb-0">Cảm ơn bạn đã lựa chọn chúng tôi, thông tin mã thẻ dưới đây hoặc bạn có thể xem lại trong mục, hồ sơ cá nhân -> <a href="/thong-tin">thẻ đã mua</a></p>';
                            html += '</div>';
                            btnSubmit.prop('disabled', true);
                            swal({
                                title: "Thành công !",
                                text: data.data.message,
                                icon: "success",
                            })
                            let render_html = '';
                            if(data.data.data_card.length > 0){

                                $.each(data.data.data_card,function(key,value){
                                    // html+='<div class="col-md-4 p-2">'
                                    // html+='<div class="alert alert-info">'
                                    // html+='<p>Mã thẻ'+key+' </p>'
                                    // html+='<div class="success_storecard_pin">'
                                    // html+='<p>Mã thẻ <br>'
                                    // html+='<span>'+value.pin+'</span>'
                                    // html+='</p>'
                                    // html+='<b><i style="cursor: pointer" class="fa fa-copy copyData" data-copy="'+value.pin+'" aria-hidden="true"></i></b>'
                                    // html+='</div>'
                                    // html+='<div class="success_storecard_serial">'
                                    // html+='<p>Serial  <br>'
                                    // html+='<span>'+value.serial+'</span>'
                                    // html+='</p>'
                                    // html+='<b><i style="cursor: pointer" class="fa fa-copy copyData" data-copy="'+value.serial+'" aria-hidden="true"></i></b>'
                                    // html+='</div>'
                                    // html+='</div>'
                                    // html+='</div>'

                                    render_html += '<tbody>';
                                    render_html += '<tr>';
                                    render_html += '<td class="text-secondary">Thẻ '+key+'</td>';
                                    render_html += '<td colspan="2"></td>';
                                    render_html += '</tr>';
                                    render_html += '<tr>';
                                    render_html += '<td class="text-secondary">Loại mã thẻ</td>';
                                    render_html += '<td colspan="2">'+value.telecom_key+'</td>';
                                    render_html += '</tr>';
                                    render_html += '<tr>';
                                    render_html += '<td class="text-secondary">Mệnh giá</td>';
                                    render_html += '<td colspan="2">'+formatNumber(value.amount)+' VNĐ</td>';
                                    render_html += '</tr>';
                                    render_html += '<tr>';
                                    render_html += '<td class="text-secondary">Số series</td>';
                                    render_html += '<td colspan="2">'+value.serial+'</td>';
                                    render_html += '</tr>';
                                    render_html += '<tr>';
                                    render_html += '<td class="text-secondary">Mã Pin</td>';
                                    render_html += '<td><strong class="text-warning">'+value.pin+'</strong></td>';
                                    render_html += '<td width="30"><a href="#"><i class="las la-copy" data-id="' + value.pin + '"></i></a></td>';
                                    render_html += '</tr>';
                                    render_html += '</tbody>';
                                    render_html += '</br>';

                                });
                                $('.table-store-card').html(render_html);

                            }
                        }
                        else if(data.status == 401){
                            window.location.href = '/login';
                        }
                        else if(data.status == 0){
                            $(".info-buy-card").remove();

                            html += '<div class="alert alert-danger mb-3 text-center" role="alert">';
                            html += '<p class="display-6 text-danger mb-0"><i class="las la-frown"></i></p>';
                            html += '<h5 class="mb-0">Mua thẻ thất bại !</h5>';
                            html += '<p class="mb-0">'+data.message+'</p>';
                            html += '</div>';


                            // swal({
                            //     title: "Mua thẻ thất bại !",
                            //     text: data.message,
                            //     icon: "error",
                            //     buttons: {
                            //         cancel: "Đóng",
                            //     },
                            // })
                        }
                        else{
                            // swal({
                            //     title: "Có lỗi xảy ra !",
                            //     text: data.message,
                            //     icon: "error",
                            //     buttons: {
                            //         cancel: "Đóng",
                            //     },
                            // })

                            $(".info-buy-card").remove();

                            html += '<div class="alert alert-danger mb-3 text-center" role="alert">';
                            html += '<p class="display-6 text-danger mb-0"><i class="las la-frown"></i></p>';
                            html += '<h5 class="mb-0">Cố lỗi xảy ra !</h5>';
                            html += '<p class="mb-0">'+data.message+'</p>';
                            html += '</div>';
                        }
                    }
                    $(".content-notify-content").html(html)


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
                    setTimeout(function(){
                        $("#overlay").fadeOut(300);
                        $('.nav-steps-wrapper ul.nav-steps li.nav-item a.nav-link').removeClass('active');
                        $('#step-example .tab-content').removeClass('active');
                        $("#steps-3.tab-content").addClass('active');
                        $('.nav-steps-wrapper ul.nav-steps li.nav-item a.steps-3').addClass('active');
                        $(".content-notify-store").css('display','block');
                    },500);
                }
            });


        });


        // $('body').on('click','#store-telecom-button',function(){
        //     $('.nav-item .nav-link-telecom').each(function(){
        //         var active = $(this).hasClass('active');
        //         if(active){
        //             telecom_view = $(this).attr("data-content");
        //         }
        //     });
        //     key = $("#input_telecom input.input_telecom").val();
        //     amount = $("#input_amount input.input_amount").val();
        //     quantity = $('#quantity-details').val();
        //     if(quantity == null){
        //         quantity = 1;
        //     }
        //
        //     $.ajax({
        //         url: "/mua-the",
        //         type: "POST",
        //         data:{
        //             telecom_key: key,
        //             amount: amount,
        //             quantity: quantity,
        //         },
        //         beforeSend: function(){
        //             $("#overlay").fadeIn(300);
        //         },
        //         success: function (data) {
        //             let html = "";
        //             if(data.errors){
        //                 $(".info-buy-card").remove();
        //                 html += '<div class="alert alert-danger mb-3 text-center" role="alert">';
        //                 html += '<p class="display-6 text-danger mb-0"><i class="las la-frown"></i></p>';
        //                 html += '<h5 class="mb-0">uh oh, có lỗi xảy ra</h5>';
        //                 html += '<p class="mb-0">'+data.errors+'</p>';
        //                 html += '</div>';
        //             }else{
        //                 html += '<div class="alert alert-success mb-3 text-center" role="alert">';
        //                 html += '<p class="display-6 mb-0 text-success"><i class="las la-glass-cheers"></i></p>';
        //                 html += '<p class="mb-0">Cảm ơn bạn đã lựa chọn chúng tôi, thông tin mã thẻ dưới đây hoặc bạn có thể xem lại trong mục, hồ sơ cá nhân -> <a href="/user/profile?log=transaction-history">thẻ đã mua</a></p>';
        //                 html += '</div>';
        //                 item = data.id;
        //                 $.ajax({
        //                     url: "/mua-the/"+item+"/thong-tin-the",
        //                     type:"GET",
        //                     success: function(data){
        //                         key_telecom = key;
        //                         let render_html = '';
        //                         $.each(data.arr,function(key,value){
        //                             render_html += '<tbody>';
        //                             render_html += '<tr>';
        //                             render_html += '<td class="text-secondary">Loại mã thẻ</td>';
        //                             render_html += '<td colspan="2">'+key_telecom+'</td>';
        //                             render_html += '</tr>';
        //                             render_html += '<tr>';
        //                             render_html += '<td class="text-secondary">Mệnh giá</td>';
        //                             render_html += '<td colspan="2">'+formatNumber(amount)+' VNĐ</td>';
        //                             render_html += '</tr>';
        //                             render_html += '<tr>';
        //                             render_html += '<td class="text-secondary">Số series</td>';
        //                             render_html += '<td colspan="2">'+value['serial_item']+'</td>';
        //                             render_html += '</tr>';
        //                             render_html += '<tr>';
        //                             render_html += '<td class="text-secondary">Mã Pin</td>';
        //                             render_html += '<td><strong class="text-warning">'+value['pin_item']+'</strong></td>';
        //                             render_html += "<td width='30'><a href='#'><i class='las la-copy' data-id=\"" + value["pin_item"] + "\"></i></a></td>";
        //                             render_html += '</tr>';
        //                             render_html += '</tbody>';
        //                         });
        //                         $('.table-store-card').html(render_html);
        //                     }
        //                 });
        //             }
        //             $(".content-notify-content").html(html)
        //         },
        //         complete: function(){
        //             setTimeout(function(){
        //                 $("#overlay").fadeOut(300);
        //                 $('.nav-steps-wrapper ul.nav-steps li.nav-item a.nav-link').removeClass('active');
        //                 $('#step-example .tab-content').removeClass('active');
        //                 $("#steps-3.tab-content").addClass('active');
        //                 $('.nav-steps-wrapper ul.nav-steps li.nav-item a.steps-3').addClass('active');
        //                 $(".content-notify-store").css('display','block');
        //             },500);
        //
        //         }
        //     });
        // });








        // cũ
    // $('#article-content img').addClass('img-fluid');
    // var i = 0;
    // var check = [];
    // if(i == 0){
    //     StoreTelecom();
    // }
    // $('.nav-item-telecom').on('click',function(){
    //     $('body .gateway-telecom').remove();
    //     $('.infor-pay').css("display", "none");
    //     $('.nav-item .nav-link-telecom').each(function(){
    //         var active = $(this).hasClass('active');
    //         if(active){
    //             telecom = $(this).attr("data-content");
    //         }
    //     });
    //     if(jQuery.inArray(telecom, check) == -1){
    //         StoreTelecom();
    //         console.log('vao day');
    //     }
    //     // $('.infor-pay').css("display", "none");
    // })
    // function StoreTelecom(){
    //     $('.nav-item .nav-link-telecom').each(function(){
    //         var active = $(this).hasClass('active');
    //         if(active){
    //             telecom = $(this).attr("data-content");
    //         }
    //     });
    //     var html;
    //     $.ajax({
    //         url: "/mua-the",
    //         type: "GET",
    //         data:{
    //             key:telecom,
    //             _token: $('meta[name="csrf-token"]').attr('content')
    //         },
    //         beforeSend: function(){
    //             $('.store-loading').show();
    //         },
    //         success: function (data) {
    //             let html = '';
    //             if(data.store_telecom.length > 0){
    //                 $.each(data.store_telecom, function (key, value) {
    //                     html += "<div class='col-md-3 col-6 item-telecom'>";
    //                     html += "<div class='item-gateway me-2' data-key=\"" + value["key"] + "\">";
    //                     html += '<div class="text-center">';
    //                     html += "<img class=\"mw-100 img\" src=\"" + value["image"] + "\" alt=\"" + value["title"] + "\">";
    //                     html += '</div>';
    //                     html += '</div>';
    //                     html += '</div>';
    //                 });
    //             }else{
    //                 html += "<p class='text-center'> KhĂ´ng cĂ³ dá»¯ liá»‡u </p>"
    //             }
    //             i = 1;
    //             key = telecom;
    //             $(".supplier_"+telecom).html(html).flickity({
    //                 cellAlign: 'left',
    //                 contain: true,
    //                 prevNextButtons: false,
    //                 pageDots: true
    //             });
    //         },
    //         complete: function(){
    //             $('.store-loading').hide();
    //         }
    //     });
    //     if(jQuery.inArray(telecom, check) == -1){
    //         check.push(telecom);
    //     }
    // }
    //
    // //
    //
    // $('body').on('click','.item-gateway',function(e){
    //     let html ="";
    //     let render = "";
    //     let input_telecom = "";
    //     var check_amount = [];
    //     e.preventDefault();
    //     $('.nav-item .nav-link-telecom').each(function(){
    //         var active = $(this).hasClass('active');
    //         if(active){
    //             telecom = $(this).attr("data-content");
    //         }
    //     });
    //     key = $(this).data('key');
    //     $('.row-gateway .item-gateway').not($(this)).removeClass('active');
    //     $('.row-gateway .item-gateway').not($(this)).addClass('out');
    //     $(this).addClass('active');
    //     $(this).removeClass('out');
    //     if(jQuery.inArray(telecom, check_amount) == -1){
    //         $.ajax({
    //             url: "/mua-the/get-amount?telecom_key="+key,
    //             type: "GET",
    //             data:{
    //                 key:key,
    //                 _token: $('meta[name="csrf-token"]').attr('content')
    //             },
    //             success: function (data) {
    //                 render += '<div class="pb-5 block-number gateway-telecom">';
    //                 render += '<div class="icon">2</div>';
    //                 render += '<h6 class="title-small text-uppercase mb-3">Lá»±a chá»n má»‡nh giĂ¡</h6>';
    //                 render += '<div class="row row-price g-0">';
    //                 render += '</div>';
    //                 render += '<div class="d-flex justify-content-between align-items-center mt-4">';
    //                 render += '<label class="label mb-0">Sá»‘ lÆ°á»£ng</label>';
    //                 render += '<div class="input-spinner input-group" style="width: 140px">';
    //                 render += '<button type="button" class="button-minus" data-field="quantity"></button>';
    //                 render += '<input readonly type="number" step="1" max="10" min="1" value="1" name="quantity" id="quantity-details" class="quantity-field details-item">';
    //                 render += '<button type="button" class="button-plus" data-field="quantity"></button>';
    //                 render += '</div>'
    //                 render += '</div>'
    //                 render += '</div>';
    //                 check_value = $('.price_telecom_'+telecom).html(render);
    //                 if(check_value){
    //                     $.each(data.store_telecom_value, function (key, value) {
    //                         html += '<div class="col-md-3 col-6">';
    //                         html += "<div class='item-price me-2' data-amount=\"" + value['amount'] + "\" data-ratio=\"" + value['ratio_default'] + "\">";
    //                         html += '<h4 class="text-center mb-2">'+formatNumber(value['amount'])+' Ä‘ </h4>';
    //                         html += '<div class="text-center item-store">GiĂ¡: <span class="text-danger">'+formatNumber(value['amount'] * value['ratio_default'] / 100 )+'</span> Ä‘</div>';
    //                         html += '<div class="text-center item-discount">Chiáº¿t kháº¥u: <b class="text-danger">'+formatNumber(100 - value['ratio_default'] )+ ' %</b></div>';
    //                         html += '</div>';
    //                         html += '</div>';
    //                     });
    //                     $(".row-price").html(html).flickity({
    //                         cellAlign: 'left',
    //                         contain: true,
    //                         prevNextButtons: false,
    //                         pageDots: true
    //                     });
    //                 }
    //                 input_telecom += '<input style="display:none;" class="input_telecom" type="text" value="'+key+'" name="telecom">';
    //                 $('#input_telecom').html(input_telecom);
    //                 $('.infor-pay').css("display", "block");
    //                 $('.pay_'+telecom+' #text-telecom').text(key);
    //                 $('.pay_'+telecom+' #text-amount').text(0);
    //                 $('.pay_'+telecom+' #text-ratio').text(0);
    //                 $('.pay_'+telecom+' #text-quantity').text(1);
    //                 $(".pay_"+telecom+" #total-price").html("0 VNÄ");
    //                 if(jQuery.inArray(telecom, check_amount) == -1){
    //                     check_amount.push(telecom);
    //                 }
    //             },
    //         });
    //     }
    // });
    // $('body').on('click','.row-price .item-price',function(e){
    //     e.preventDefault();
    //     $('.nav-item .nav-link-telecom').each(function(){
    //         var active = $(this).hasClass('active');
    //         if(active){
    //             telecom_2 = $(this).attr("data-content");
    //         }
    //     });
    //     let input_amount ="";
    //     let input_ratio ="";
    //     amount = $(this).data('amount');
    //     ratio = $(this).data('ratio');
    //     $('.row-price .item-price').not($(this)).removeClass('active');
    //     $(this).addClass('active');
    //     input_amount += '<input style="display:none;" class="input_amount" type="text" value="'+amount+'" name="amount">';
    //     input_ratio += '<input class="input_ratio" style="display:none;" type="text" value="'+amount * ratio / 100 +'" name="ratio">';
    //     $('#input_amount').html(input_amount);
    //     $('#input_ratio').html(input_ratio);
    //     $('.pay_'+telecom_2+' #text-amount').text(formatNumber(amount)+ " VNÄ");
    //     $('.pay_'+telecom_2+' #text-ratio').text(formatNumber(amount - (amount*ratio/100))+ " VNÄ");
    //     updatePrice();
    // });
    // $('.more-link').on('click', function(e) {
    //     e.preventDefault();
    //     $('.text-rounded').toggleClass('-expanded');
    //     if ($('.text-rounded').hasClass('-expanded')) {
    //         $('.more-link').html('Thu gá»n <i class="las la-angle-up"></i>');
    //     } else {
    //         $('.more-link').html('Xem thĂªm <i class="las la-angle-down"></i>');
    //     }
    // });
    // function formatNumber(num) {
    //     return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    // }
    // $("input[type='number']").inputSpinner();
    // function incrementValue(e) {
    //     e.preventDefault();
    //     var fieldName = $(e.target).data('field');
    //     var parent = $(e.target).closest('div');
    //     var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
    //
    //     if (!isNaN(currentVal)) {
    //         parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
    //     } else {
    //         parent.find('input[name=' + fieldName + ']').val(1);
    //     }
    // }
    //
    // function decrementValue(e) {
    //     e.preventDefault();
    //     var fieldName = $(e.target).data('field');
    //     var parent = $(e.target).closest('div');
    //     var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
    //
    //     if (!isNaN(currentVal) && currentVal > 1) {
    //         parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
    //     } else {
    //         parent.find('input[name=' + fieldName + ']').val(1);
    //     }
    // }
    // $('body').on('click','.input-group .button-plus',function(e){
    //     $('.nav-item .nav-link-telecom').each(function(){
    //         var active = $(this).hasClass('active');
    //         if(active){
    //             telecom = $(this).attr("data-content");
    //         }
    //     });
    //     incrementValue(e);
    //     qty = $('#quantity-details').val();
    //     $('.pay_'+telecom+' #text-quantity').text(qty);
    //     updatePrice();
    // });
    //
    // $('body').on('click','.input-group .button-minus',function(e){
    //     $('.nav-item .nav-link-telecom').each(function(){
    //         var active = $(this).hasClass('active');
    //         if(active){
    //             telecom = $(this).attr("data-content");
    //         }
    //     });
    //     decrementValue(e);
    //     qty = $('#quantity-details').val();
    //     $('.pay_'+telecom+' #text-quantity').text(qty);
    //     updatePrice();
    // });
    //
    // function updatePrice(){
    //     $('.nav-item .nav-link-telecom').each(function(){
    //         var active = $(this).hasClass('active');
    //         if(active){
    //             telecom_111 = $(this).attr("data-content");
    //         }
    //     });
    //     data_qty = $('#quantity-details').val();
    //     data_amount = $('.input_ratio').val();
    //     data_amount_old = $('.input_amount').val();
    //     if(data_amount == null){
    //         data_amount = 0;
    //     }
    //     if(data_qty == null){
    //         data_qty = 1;
    //     }
    //     $('.pay_'+telecom_111+' #text-ratio').text(formatNumber((data_amount_old - data_amount) * data_qty)+ " VNÄ");
    //     $(".pay_"+telecom_111+" #total-price").html(formatNumber(data_qty * data_amount)+" VNÄ");
    //     money_pay = $("#auth .auth").val();
    //     if(money_pay == "none"){
    //         $("#steps-2").remove();
    //     }
    //     total = data_qty * data_amount;
    //     money = money_pay - total;
    //     $("#"+telecom_111+" #text-money-pay").text(formatNumber(total));
    //     $("#"+telecom_111+" #auth-money").text(formatNumber(money_pay));
    //     let render = "";
    //     if(money < 0){
    //         money_1 = total - money_pay;
    //         render += '<td>Sá»‘ tiá»n cáº§n náº¡p thĂªm</td>';
    //         render += '<td id="text-auth-balance" class="text-end"><strong class="text-danger">'+formatNumber(money_1)+'</strong></td>';
    //         render += '<td class="text-end text-secondary" width="20">Ä‘</td>';
    //         $(".text-noti-balance").html(' <p class="mb-0">KhĂ´ng Ä‘á»§ tiá»n trong tĂ i khoĂ n vui lĂ²ng <a href="/nap-the" target="_blank" class="border-bottom">náº¡p thĂªm</a> vĂ o tĂ i khoáº£n</p>')
    //     }else{
    //         render +='<td>Sá»‘ dÆ° cĂ²n láº¡i</td>';
    //         render += '<td id="text-auth-balance" class="text-end"><strong class="text-danger">'+formatNumber(money)+'</strong></td>';
    //         render += '<td class="text-end text-secondary" width="20">Ä‘</td>';
    //     }
    //     $("#"+telecom_111+" #text-noti").html(render);
    // }
    // $('body').on('click','.button-action-steps',function(e){
    //     $("ul.nav-qp-tabs li a.nav-link-telecom").addClass('disabled');
    //     $(' #nav-steps-wrapper').css('display','block');
    //     var steps = new Array("steps-1", "steps-2", "steps-3");
    //     id = $(this).data("id");
    //     if(id == 2){
    //         check = $('#input_amount .input_amount').val();
    //         if(check == null || check == ""){
    //
    //             swal({
    //                 title: "Lá»—i !",
    //                 text: "Báº¡n chÆ°a chá»n má»‡nh giĂ¡",
    //                 icon: "error"
    //             })
    //         }else{
    //             $('.nav-steps-wrapper ul.nav-steps li.nav-item a.nav-link').removeClass('active');
    //             $('#step-example .tab-content').removeClass('active');
    //
    //             $("#steps-"+id+".tab-content").addClass('active');
    //             $('.nav-steps-wrapper ul.nav-steps li.nav-item a.steps-'+id).addClass('active');
    //         }
    //     }
    // });
    //
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
    //
    // $('body').on('click','i.la-copy',function(e){
    //     data = $(this).data('id');
    //     var $temp = $("<input>");
    //     $("body #copy").html($temp);
    //     $temp.val($.trim(data)).select();
    //     document.execCommand("copy");
    //     $temp.remove();
    // });
    //


});
