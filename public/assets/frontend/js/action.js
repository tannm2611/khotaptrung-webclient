$( document ).ready(function() {
    $(document).on('scroll',function(){
        if($(window).width() > 1024){
            if ($(this).scrollTop() > 100) {
                $(".nav-bar-container").css("height","90px");
                $(".nav-bar-category .nav li a").css("line-height","90px");
                $("header .nav-bar").css("background-color","rgba(0,0,0,0.5)");
                $(".nav-bar-brand").css("margin","14px");

            } else {
                $(".nav-bar-container").css("height","120px");
                $(".nav-bar-category .nav li a").css("line-height","120px");
                $(".nav-bar-brand").css("margin","20px 0");
                $("header .nav-bar").css("background-color","rgba(0,0,0,0.8)");
            }
        }

    });
    $(document).on('scroll',function(){
        if ($(this).scrollTop() > 300) {
            $('.go-top').fadeIn();
        } else {
            $('.go-top').fadeOut();
        }

    });
    $('.go-top').click(function(){
        $('html, body').animate({scrollTop : 0},500);
    });

});

$('#transaction_history_end').datetimepicker({
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
    // minDate: moment()
});
$('#transaction_history_start').datetimepicker({
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
    // minDate: moment()
});
$('#datetimepicker2').datetimepicker({
    format: 'DD-MM-YYYY'
});
$('#datetimepicker3').datetimepicker({
    format: 'LT'
});
$('#datetimepicker3').datetimepicker({
    format: 'LT'
});


$('.go-top').click(function(){
    $('html, body').animate({scrollTop : 0},800);
});
$('.item_play_intro_viewmore').click(function(){
    $('.item_play_intro_viewless').css("display","flex");
    $('.item_play_intro_viewmore').css("display","none");
    $(".item_play_intro_content").addClass( "showtext" );
});
$('.item_play_intro_viewless').click(function(){
    $('.item_play_intro_viewmore').css("display","flex");
    $('.item_play_intro_viewless').css("display","none");
    $(".item_play_intro_content").removeClass( "showtext");
});
$('.item_buy_viewmore').click(function(){
    $('.item_buy_viewless').css("display","block");
    $('.item_buy_viewmore').css("display","none");
    $(".item_buy_info").css( "max-height","initial" );
});
$('.item_buy_viewless').click(function(){
    $('.item_buy_viewmore').css("display","block");
    $('.item_buy_viewless').css("display","none");
    $(".item_buy_info").css( "max-height"," 162px" );
});
Fancybox.bind('[data-fancybox="gallerycoverDetail"]', {
    dragToClose: true,
    animated: true,
    closeButton: "top",
    openSpeed: 300,
    Image: {
        zoom: false,
        // zoom: 200
    },

    slideshow: true,
    Toolbar: {
        display: [
            { id: "prev", position: "center" },
            { id: "counter", position: "center" },
            { id: "next", position: "center" },
            "slideshow",
            // "fullscreen",
            // "download",
            "thumbs",
            "close",
        ],

    },

});

