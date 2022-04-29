jQuery(document).ready(function($) {
    // $(function () {
    $('.started_at_lsnt').datetimepicker({
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
    $('.ended_at_lsnt').datetimepicker({
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

    $('.started_at_txns').datetimepicker({
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
    $('.ended_at_txns').datetimepicker({
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
    $('.started_at_tcdm').datetimepicker({
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
    $('.ended_at_tcdm').datetimepicker({
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
    $('.started_at_lsmt').datetimepicker({
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
    $('.ended_at_lsmt').datetimepicker({
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
	function layout(){


	}

	layout();

	// $row_gateway = $('.row-gateway');
    //
    // if ($row_gateway) {
    //     $row_gateway.flickity({
    //         cellAlign: 'left',
    //         contain: true,
    //         prevNextButtons: false,
    //         pageDots: true
    //     });
    // }

	/* Select Gateway */
	$('.row-gateway .item-gateway').click(function(e){
		e.preventDefault();
		$('.row-gateway .item-gateway').not($(this)).removeClass('active');
        $('.row-gateway .item-gateway').not($(this)).addClass('out');
		$(this).addClass('active');
        $(this).removeClass('out');
	});

	// $row_price = $('.row-price');
    //
    // if ($row_price) {
    //     $row_price.flickity({
    //         cellAlign: 'left',
    //         contain: true,
    //         prevNextButtons: false,
    //         pageDots: true
    //     });
    // }

	/* Select Price */
	$('.row-price .item-price').click(function(e){
		e.preventDefault();
		$('.row-price .item-price').not($(this)).removeClass('active');
		$(this).addClass('active');

	});

    /* List Banks */
    $('.list-banks li a').click(function(e){
        e.preventDefault();
        $('.list-banks li a').not($(this)).removeClass('active');
        $('.list-banks li a').not($(this)).addClass('out');
        $(this).addClass('active');
        $(this).removeClass('out');
    });

    /* Init Number Input */

    // $("input[type='number']").inputSpinner();

    /* Active Tab via url hash */
    var hash = location.hash.replace(/^#/, '');  // ^ means starting, meaning only match the first hash

    if (hash) {
        $('.nav-qp-tabs a[data-bs-target="#' + hash + '"]').tab('show');
    }



	/* Back to top */
	var position = $(window).scrollTop();

    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if((scroll > position) && (scroll > 320)) {
            if($(window).width() < 768){
                $('.scroll-top').css('bottom','3rem');

            }else{
                $('.scroll-top').css('bottom','2rem');
            }

        } else if((scroll < position) && (scroll < 320)) {
           $('.scroll-top').css('bottom','');
        }


        position = scroll;
    });

	/* -------------------
    OFFCANVAS NAV
    --------------------*/

    // Open Offcanvas Nav
    $('.site-header-right .item-menu .nav-link').click(function(e) {
    	e.preventDefault();
        open_offcanvas_nav();
    });

    // Close Offcanvas Nav
    $('.offcanvas-nav .btn-close').click(function(e) {
    	e.preventDefault();
        close_offcanvas_nav();
    });

    // Function Open Offcanvas nav
    function open_offcanvas_nav() {
    	$('.overlay').show();
    	$('.offcanvas-nav').css('right',0);
    }

    // Function Close Offcanvas Nav
    function close_offcanvas_nav() {
    	$('.overlay').hide();
        $('.offcanvas-nav').css('right',"-480px");
    }

	$(window).resize(function(){
		layout();

        if($(window).width() < 576){
            close_offcanvas_nav();
        }
	});

    //Sticky

    if($('.elsticky').length && ($(window).width() > 991)){
        $(".elsticky").stick_in_parent({
            parent :'.elsticky-wrap',
            offset_top: 90
        });
    }

    $(window).resize(function(){
        if($(window).width() < 992){
            if($('.elsticky').length){
                $(".elsticky").trigger("sticky_kit:detach");
            }
        }else{
            if($('.elsticky').length){
                $(".elsticky").stick_in_parent({
                    parent :'.elsticky-wrap',
                    offset_top: 90
                });
            }
        }
    })
});
