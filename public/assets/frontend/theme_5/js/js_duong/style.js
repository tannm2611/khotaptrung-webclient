/* js quantity */
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
});

/*js swiper about us*/
var list_about = new Swiper('.list-intro', {
    autoplay: false,
    updateOnImagesReady: true,
    watchSlidesVisibility: false,
    lazyLoadingInPrevNext: false,
    lazyLoadingOnTransitionStart: false,
    loop: false,
    centeredSlides: false,
    slidesPerView: 4,
    speed: 800,
    spaceBetween: 16,
    freeMode: true,
    touchMove: true,
    freeModeSticky:true,
    grabCursor: true,
    observer: true,
    observeParents: true,
    keyboard: {
        enabled: true,
    },
    breakpoints: {

        992: {
            slidesPerView: 3,
        },
        768: {
            slidesPerView: 3,
        },

        480: {
            slidesPerView: 1.8,
            spaceBetween: 6,
        }
    }
});


/*js swiper detail article*/
var list_relate = new Swiper('.article--slider__news', {
    autoplay: false,
    updateOnImagesReady: true,
    watchSlidesVisibility: false,
    lazyLoadingInPrevNext: false,
    lazyLoadingOnTransitionStart: false,
    loop: false,
    centeredSlides: false,
    slidesPerView: 5,
    speed: 800,
    spaceBetween: 16,
    freeMode: true,
    touchMove: true,
    freeModeSticky:true,
    grabCursor: true,
    observer: true,
    observeParents: true,
    keyboard: {
        enabled: true,
    },
    breakpoints: {

        992: {
            slidesPerView: 3,
        },
        768: {
            slidesPerView: 3,
        },

        480: {
            slidesPerView: 1.8,
            spaceBetween: 6,
        }
    }
});


/* js search service */
$('#service-form').on('submit', function (e) {
    e.preventDefault();
    let keyword = convertToSlug($('#keyword--search').val());
    let is_empty = true;
    let text_empty = $('#text-empty');
    text_empty.hide();
    $('.js-service').each(function (i,elm) {
        let slug_service = $(elm).find('img').attr('alt');
        slug_service = convertToSlug(slug_service);
        $(this).toggle(slug_service.indexOf(keyword) > -1);
        if (slug_service.indexOf(keyword) > -1){
            is_empty  = false;
        }
    });
    if (is_empty){
        text_empty.show();
    }
});
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
