$(document).ready(function () {
    
    //JS mua the module
    getListCard();

    var swiper_card = new Swiper(".slider--card", {
        slidesPerView: 1,
        spaceBetween: 16,
        freeMode: true,
        observer: true,
        observeParents: true,
    });

    var dataSend = {
        amount: 0,
        telecom: '',
        quantity: 0,
        _token: $('meta[name="csrf-token"]').attr('content'),
    }

    $('#btn-confirm').on('click', function (e) {
        e.preventDefault();
        resetConfirmModal();
        prepareConfirmModal();
        prepareDataSend();
    });

    $('#modal--confirm__payment #confirmSubmitButton').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            url:'/mua-the',
            type:'POST',
            data: dataSend,
            beforeSend: function () {
                $('#confirmSubmitButton').prop("disabled", true);
                $('#confirmSubmitButton').text("Đang xử lý");
                resetSuccessModal();
            },
            success:function (res) {
                // handle data callback
                $('#modal--confirm__payment').modal('hide');
                if ( res.status && res.status !== 401 ) {
                    let data = res.data;
                    let cardImage = $('input[name="card-type"]:checked').data('img');
                    let cardName = $('input[name="card-type"]:checked').val();

                    $('#modal--success__payment .card__message').text(res.message);
                    $('#modal--success__payment #successCard').attr('src', cardImage);
                    $('#modal--success__payment #successPrice').text(formatNumber(dataSend.amount) + ' đ');
                    $('#modal--success__payment #successQuantity').text(dataSend.quantity);
                    if (data.length > 0){

                        //Append HTML for desktop layout
                        data.forEach(function (card) {
                            let html_card = '';
                            html_card += `<div class="swiper-slide card__detail">`;
                            html_card += `  <div class="card--header__detail">`;
                            html_card += `      <div class="card--info__wrap">`;
                            html_card += `          <div class="card--logo">`;
                            html_card += `            <img src="${cardImage}" alt="telecom_logo">`;
                            html_card += `          </div>`;
                            html_card += `          <div class="card--info">`;
                            html_card += `              <div class="card--info__name">`;
                            html_card += `                  ${cardName}`;
                            html_card += `              </div>`;
                            html_card += `               <div class="card--info__value">`;
                            html_card += `                    ${formatNumber(dataSend.amount)} đ`;
                            html_card += `                </div>`;
                            html_card += `            </div>`;
                            html_card += `        </div>`;
                            html_card += `    </div>`;
                            html_card += `    <div class="card--gray">`;
                            html_card += `      <div class="card--attr">`;
                            html_card += `            <div class="card--attr__name">`;
                            html_card += `              Mã thẻ`;
                            html_card += `            </div>`;
                            html_card += `            <div class="card--attr__value">`;
                            html_card += `              <div class="card__info">`;
                            html_card += `                  ${card.pin}`;
                            html_card += `               </div>`;
                            html_card += `               <div class="icon--coppy js-copy-text">`;
                            html_card += `                    <img src="/assets/frontend/theme_4/image/icons/coppy.png" alt="icon__copy">`;
                            html_card += `                </div>`;
                            html_card += `            </div>`;
                            html_card += `        </div>`;
                            html_card += `        <div class="card--attr">`;
                            html_card += `             <div class="card--attr__name">`;
                            html_card += `                 Số Series`;
                            html_card += `              </div>`;
                            html_card += `              <div class="card--attr__value">`;
                            html_card += `                  <div class="card__info">`;
                            html_card += `                      ${card.serial}`;
                            html_card += `                   </div>`;
                            html_card += `                   <div class="icon--coppy js-copy-text">`;
                            html_card += `                      <img src="/assets/frontend/theme_4/image/icons/coppy.png" alt="icon__copy">`;
                            html_card += `                   </div>`;
                            html_card += `               </div>`;
                            html_card += `         </div>`;
                            html_card += `    </div>`;
                            html_card += `</div>`;
                            $('#modal--success__payment .swiper-wrapper').append(html_card);
                        });
                    }

                    if (data.length > 1){
                        swiper_card.params.slidesPerView = 1.25;
                    } else {
                        swiper_card.params.slidesPerView = 1;
                    }

                    swiper_card.update();

                    $('#modal--success__payment').modal('show');
                }
                else {
                    $('#message--error--buy').text(res.message);
                    $('#modal--fail__payment').modal('show');
                }
            },
            error: function (res) {
                $('#message--error--buy').text('');
                $('#modal--fail__payment').modal('show');
            },
            complete: function () {
                $('#confirmSubmitButton').prop("disabled", false);
                $('#confirmSubmitButton').text("Xác nhận");
            }
        });

        $('#modal--confirm__payment').modal('hide');
    });

    // only allow numeric input
    $('input[numberic]').on('keypress', function (e) {
        if (isNaN(this.value + String.fromCharCode(e.keyCode))) return false;
    });

    // Tăng giảm số lượng mua thẻ
    $('input.input--amount').on('input',function () {
        if ($(this).val() > 20){
            $(this).val(20);
        }
    })

    $('.js-amount').on('click', function () {
        let input = $(this).parent().find('input.input--amount');
        let value = input.val();
        if ($(this).data('action') === 'add') {
            input.val(++value);
        }
        if ($(this).data('action') === 'minus' && value > 1) {
            input.val(--value);
        }
        if (input.val() > 20) {
            input.val(20)
        }

        $('input[name=card-amount]').trigger('input');
    });

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
    }

    function getListCard () {
        $.ajax({
            url: '/store-card/get-telecom',
            type: 'GET',
            success: function (res) {
                if (res.status) {
                    let data = res.data;
                    let loop_index = 0;
                    data.forEach(function (card) {
                        let html = '';
                        html += `<li class="cards__item card__item-tag p_0">`;
                        //Check if it is the first loop
                        if (loop_index === 0) {
                            html += `<input type="radio" id="card-${card.id}" value="${card.key}" data-img="${card.image}" name="card-type" checked hidden>`;
                        } else {
                            html += `<input type="radio" id="card-${card.id}" value="${card.key}" data-img="${card.image}" name="card-type" hidden>`;
                        }
                        html += `<label for="card-${card.id}">`;
                        html += `<img src="${card.image}" class="card--logo" alt="${card.title}">`;
                        html += `</label>`;
                        html += `</li>`;

                        //Increase loop index
                        loop_index++;

                        if (card.params && card.params.teltecom_type) {
                            //Apepnd HTML
                            if (card.params.teltecom_type == 2) {
                                $('#cardGameList').append(html);
                            }
                            if (card.params.teltecom_type == 1) {
                                $('#cardPhoneList').append(html);
                            }

                        } else {
                            $('#cardGameList').append(html);
                        }
                    });

                    //Get amount of the card just been choosen when render
                    getCardAmount($('input[name="card-type"]').val());

                    //Listen to onchange event in input card-type
                    $('input[name="card-type"]').change(function (e) { 
                        e.preventDefault();
                        getCardAmount($(this).val());
                    });
                    
                    $('.section--amount__card').removeClass('d-none');
                }
            },
            error: function () {
                alert("Đã xảy ra lỗi khi load dữ liệu! Vui lòng load lại trang!")
            },
            complete: function () {
                $('#cardGameList .loader').addClass('d-none');
            }
        });
    };

    function getCardAmount (cardKey) {
        $.ajax({
            url: '/store-card/get-amount',
            type: 'GET',
            data: {
                telecom: cardKey
            },
            beforeSend: function () {
                //Display none wrapper
                $('.denos--wrap').addClass('d-none');
                //Add loading effect
                $('#amountWidget .loader').removeClass('d-none');
            },
            success: function (res) {
                if (res.status) {
                    let data = res.data;
                    let loop_index = 0;

                    //Empty element
                    $('#cardAmountList').empty();

                    data.forEach(function (card) {
                        let html = '';
                        html += `<li class="deno__item col-4 col-lg-4">`;
                        //Check if it is the first loop
                        if (loop_index === 0) {
                            html += `<input type="radio" id="amount-${card.id}" value="${card.amount}" data-discount="${card.ratio_default}" name="card-value" checked hidden>`;
                        } else {
                            html += `<input type="radio" id="amount-${card.id}" value="${card.amount}" data-discount="${card.ratio_default}" name="card-value" hidden>`;
                        }
                        html += `<label for="amount-${card.id}" class="deno__value card-item-value">`;
                        html += `<span>${formatNumber(card.amount)} đ</span>`;
                        html += `</label>`;
                        html += `</li>`;

                        //Increase loop index
                        loop_index++;

                        // Append new HTML amount
                        $('#cardAmountList').append(html);
                    });

                    //prepare the input field and update price related value
                    $('input[name="card-amount"]').val(1);
                    prepareAmountWidget();

                    //Activate onchange, oninput function for input field inside
                    $('input[name="card-value"]').change(function (e) {
                        e.preventDefault();
                        prepareAmountWidget();
                    });
                    $('input[name="card-amount"]').on('input', function (e) {
                        e.preventDefault();
                        prepareAmountWidget();
                    });

                    $('.denos--wrap').removeClass('d-none');

                } 
            },
            complete: function () {
                $('#amountWidget .loader').addClass('d-none');
            }
        });
    }

    function prepareAmountWidget () {
        let discountCardValue = $('input[name="card-value"]:checked').data('discount');
        $('input[name="card-discount"]').val(discountCardValue);
        $('.discount--value').text(`${100 - discountCardValue}%`);
        $('.price--total__value').text(`${formatNumber( calculatePrice() )} đ`);
    }

    //Calculate price
    function calculatePrice () {
        let amount = $('input[name="card-value"]:checked').val();
        let quantity = $('input[name="card-amount"]').val();
        let discount = $('input[name="card-discount"]').val();

        let discountPerCard = amount - (amount * discount /100);
        let totalPrice = (amount - discountPerCard) * quantity;
        let totalNotSale = amount * quantity;

        if (discountPerCard) {
            return totalPrice;
        }

        return totalNotSale;
    }

    //Reset data in confirm modal
    function resetConfirmModal () {
        $('#modal--confirm__payment #confirmPrice').text('');
        $('#modal--confirm__payment #confirmQuantity').text('');
        $('#modal--confirm__payment #confirmDiscount').text('');
        $('#modal--confirm__payment #confirmTotal').text('');
        $('#modal--confirm__payment #totalBill').text('');
    }

    function resetSuccessModal() {
        $('#modal--success__payment .card__message').text('');
        $('#modal--success__payment #successPrice').text('');
        $('#modal--success__payment #successQuantity').text('');
        $('#modal--success__payment .swiper-wrapper').empty();
        swiper_card.update();
    }

    //append new data into confirm modal
    function prepareConfirmModal() {
        let confirmCard = $('input[name="card-type"]:checked').data('img');
        let confirmPrice = $('input[name="card-value"]:checked').val();
        let confirmQuantity = $('input[name="card-amount"]').val();
        let confirmDiscount = $('input[name="card-value"]:checked').data('discount');

        $('#modal--confirm__payment #confirmCard').attr('src',confirmCard);
        $('#modal--confirm__payment #confirmPrice').text(`${formatNumber( confirmPrice )} đ`);
        $('#modal--confirm__payment #confirmQuantity').text(confirmQuantity);
        $('#modal--confirm__payment #confirmDiscount').text(`${100 - confirmDiscount}%`);
        $('#modal--confirm__payment #confirmTotal').text(`${formatNumber( calculatePrice() )} đ`);
        $('#modal--confirm__payment #totalBill').text(`${formatNumber( calculatePrice() )} đ`);
    }

    //Append new data to submit to backend
    function prepareDataSend() {
        let amount = $('input[name="card-value"]:checked').val();
        let telecom = $('input[name="card-type"]:checked').val();
        let quantity = $('input[name="card-amount"]').val();

        dataSend.amount = amount;
        dataSend.telecom = telecom.toUpperCase();
        dataSend.quantity = quantity;
    }

    //JS mua the module end 
});