(function($){
    $.fn.extend({
        donetyping: function(callback,timeout){
            timeout = timeout || 1e3; // 1 second default timeout
            var timeoutReference,
                doneTyping = function(el){
                    if (!timeoutReference) return;
                    timeoutReference = null;
                    callback.call(el);
                };
            return this.each(function(i,el){
                var $el = $(el);
                // Chrome Fix (Use keyup over keypress to detect backspace)
                // thank you @palerdot
                $el.is(':input') && $el.on('keyup keypress paste',function(e){
                    // This catches the backspace button in chrome, but also prevents
                    // the event from triggering too preemptively. Without this line,
                    // using tab/shift+tab will make the focused element fire the callback.
                    if (e.type=='keyup' && e.keyCode!=8) return;

                    // Check if timeout has been set. If it has, "reset" the clock and
                    // start over again.
                    if (timeoutReference) clearTimeout(timeoutReference);
                    timeoutReference = setTimeout(function(){
                        // if we made it here, our timeout has elapsed. Fire the
                        // callback
                        doneTyping(el);
                    }, timeout);
                }).on('blur',function(){
                    // If we can, fire the event since we're leaving the field
                    doneTyping(el);
                });
            });
        }
    });
})(jQuery);



$(document).ready(function () {

    $('.started_at').datetimepicker({
        format: 'DD-MM-YYYY LT',
        useCurrent: false,
        icons:
            { time: 'fas fa-clock',
                date: 'fas fa-calendar',
                up: 'fas fa-arrow-up',
                down: 'fas fa-arrow-down',
                previous: 'fas fa-arrow-circle-left',
                next: 'fas fa-arrow-circle-right',
                today: 'far fa-calendar-check-o',
                clear: 'fas fa-trash',
                close: 'far fa-times' },

    });

    $('.ended_at').datetimepicker({
        format: 'DD-MM-YYYY LT',
        useCurrent: false,
        icons:
            { time: 'fas fa-clock',
                date: 'fas fa-calendar',
                up: 'fas fa-arrow-up',
                down: 'fas fa-arrow-down',
                previous: 'fas fa-arrow-circle-left',
                next: 'fas fa-arrow-circle-right',
                today: 'far fa-calendar-check-o',
                clear: 'fas fa-trash',
                close: 'far fa-times' },
        maxDate: moment()
    });

    $(window).scroll(function() {
        if ($(window).scrollTop() > 150) {
            $('.m-scroll-top').addClass('show');
        } else {
            $('.m-scroll-top').removeClass('show');
        }
    });

    $('.m-scroll-top').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop:0}, '300');
    });

    $(".menu-control").click(function() {

        $('.list-menu-link').toggle('fast', function() {
            // $('#form-search input').focus();
        });
    });

    $('.slick-slider').slick({
        autoplay:false,
        autoplaySpeed:3000,
        dots: false,
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 5,
        prevArrow: '<i class="fas fa-chevron-left arrow prev"></i>',
        nextArrow: '<i class="fas fa-chevron-right arrow next"></i>',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            }

        ]

    });

    $('.slider-banner').slick({
        autoplay:false,
        autoplaySpeed:3000,
        dots: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: '<i class="fas fa-chevron-left arrow prev"></i>',
        nextArrow: '<i class="fas fa-chevron-right arrow next"></i>',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }

        ]

    });


    $('#txtSearch').donetyping(function() {


        let keyword = convertToSlug($(this).val());

        let index = 0;
        let value = 0;

        $('.entries_item_service').each(function (i,elm) {
            $(this).removeClass('dis-block-service');
        })

        $('.entries_item_service').each(function (i,elm) {

            let slug_item = $(elm).find('img').attr('alt');
            slug_item = convertToSlug(slug_item);
            $(this).toggle(slug_item.indexOf(keyword) > -1);
            if (slug_item.indexOf(keyword) > -1){
                ++index;
                $(this).addClass('dis-block-service');
            }else {}

            $('#btn-expand-serivce').remove();
            $('#btn-expand-serivce-search').remove();
        })

        $('.dis-block-service').each(function (i,elm) {
            if (i>=8){
                $(this).css('display','none');
            }
        })


        if (index <= 8){
            value = 1;
        }else if (index <= 16){
            value = 2;
        }else if (index <= 24){
            value = 3;
        }else if (index <= 32){
            value = 4;
        }else if (index <= 40){
            value = 5;
        }

        if (value > 1){

            let htmlservice = '<button id="btn-expand-serivce-search" class="expand-button" data-page-current="1" data-page-max="' + value + '">Xem th??m d???ch v???</button>';
            $('.fix-border-dich-vu').append(htmlservice);
        }

        if (index == 0){
            $('.data-service-search').css('display','block');
        }else {
            $('.data-service-search').css('display','none');
        }

        //$(this).val() // get the current value of the input field.
    }, 400);

    $('body').on('click','#btn-expand-serivce-search',function(){

        var pageCurrrent=$(this).data('page-current');
        var pageMax=$(this).data('page-max');
        pageCurrrent=pageCurrrent+1;
        $('.dis-block-service').each(function (i,elm) {
            if (pageCurrrent == 2){
                if (i < 16){
                    $(this).css('display','block');
                }
            }else if (pageCurrrent == 3){
                if (i < 24){
                    $(this).css('display','block');
                }
            }else if (pageCurrrent == 4){
                if (i < 32){
                    $(this).css('display','block');
                }
            }else if (pageCurrrent == 5){
                if (i < 40){
                    $(this).css('display','block');
                }
            }
        });

        $(this).data('page-current',pageCurrrent);
        if(pageCurrrent==pageMax){
            $(this).remove();
        }
    });

    $('#txtSearchNick').donetyping(function() {

        let keyword = convertToSlug($(this).val());

        let index = 0;
        let value = 0;
        $('.entries_item_nick').each(function (i,elm) {
            $(this).removeClass('dis-block');
        })

        $('.entries_item_nick').each(function (i,elm) {
            // $('.body-modal__nick__text-error').css('display','none');
            let slug_item = $(elm).find('img').attr('alt');
            slug_item = convertToSlug(slug_item);
            $(this).toggle(slug_item.indexOf(keyword) > -1);
            if (slug_item.indexOf(keyword) > -1){
                ++index;
                $(this).addClass('dis-block');
            }else {

            }
            $('#btn-expand-serivce-nick').remove();
            $('#btn-expand-serivce-nick-search').remove();
        })


        $('.dis-block').each(function (i,elm) {
            if (i>=8){
                $(this).css('display','none');
            }
        })
        if (index <= 8){
            value = 1;
        }else if (index <= 16){
            value = 2;
        }else if (index <= 24){
            value = 3;
        }else if (index <= 32){
            value = 4;
        }else if (index <= 40){
            value = 5;
        }

        if (value > 1){

            let htmlnick = '<button id="btn-expand-serivce-nick-search" class="expand-button" data-page-current="1" data-page-max="' + value + '">Xem th??m danh m???c</button>';
            $('.fix-border-nick').append(htmlnick);
        }

        if (index == 0){
            $('.data-nick-search').css('display','block');
        }else {
            $('.data-nick-search').css('display','none');
        }
        //$(this).val() // get the current value of the input field.
    }, 400);

    $('body').on('click','#btn-expand-serivce-nick-search',function(){

        var pageCurrrent=$(this).data('page-current');
        var pageMax=$(this).data('page-max');
        pageCurrrent=pageCurrrent+1;
        $('.dis-block').each(function (i,elm) {
            if (pageCurrrent == 2){
                if (i < 16){
                    $(this).css('display','block');
                }
            }else if (pageCurrrent == 3){
                if (i < 24){
                    $(this).css('display','block');
                }
            }else if (pageCurrrent == 4){
                if (i < 32){
                    $(this).css('display','block');
                }
            }else if (pageCurrrent == 5){
                if (i < 40){
                    $(this).css('display','block');
                }
            }
        });

        $(this).data('page-current',pageCurrrent);
        if(pageCurrrent==pageMax){
            $(this).remove();
        }
    });

    $('#txtSearchMobile').donetyping(function() {
        let keyword = convertToSlug($(this).val());

        let index = 0;
        $('.entries_item').each(function (i,elm) {
            // $('.body-modal__nick__text-error').css('display','none');
            let slug_item = $(elm).find('img').attr('alt');
            slug_item = convertToSlug(slug_item);
            $(this).toggle(slug_item.indexOf(keyword) > -1);
            if (slug_item.indexOf(keyword) > -1){
                index = index + 1
            }else {}
            console.log(index)
            if (index > 8){
                $('.item-page-2').css('display','none');
                $('.item-page-3').css('display','none');
                $('.item-page-4').css('display','none');
            }

        })


        //$(this).val() // get the current value of the input field.
    }, 400);

    function convertToSlug(title) {
        var slug;
        //?????i ch??? hoa th??nh ch??? th?????ng
        slug = title.toLowerCase();
        //?????i k?? t??? c?? d???u th??nh kh??ng d???u
        slug = slug.replace(/??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'a');
        slug = slug.replace(/??|??|???|???|???|??|???|???|???|???|???/gi, 'e');
        slug = slug.replace(/i|??|??|???|??|???/gi, 'i');
        slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'o');
        slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???/gi, 'u');
        slug = slug.replace(/??|???|???|???|???/gi, 'y');
        slug = slug.replace(/??/gi, 'd');
        //X??a c??c k?? t??? ?????t bi???t
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\<|\'|\"|\:|\;|_/gi, '');
        //?????i kho???ng tr???ng th??nh k?? t??? g???ch ngang
        slug = slug.replace(/ /gi, "-");
        //?????i nhi???u k?? t??? g???ch ngang li??n ti???p th??nh 1 k?? t??? g???ch ngang
        //Ph??ng tr?????ng h???p ng?????i nh???p v??o qu?? nhi???u k?? t??? tr???ng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //X??a c??c k?? t??? g???ch ngang ??? ?????u v?? cu???i
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        // tr??? v??? k???t qu???
        return slug;
    }

    $('#btn-search').click( function(){
        $('body').addClass('search-active');
        $('.input-search').focus();
    });

    $('.icon-close').click( function(){
        $('body').removeClass('search-active');
    });
    $('body').on('click','button.icon-delete',function(){
        $('.input-search').val('');
    })

});


