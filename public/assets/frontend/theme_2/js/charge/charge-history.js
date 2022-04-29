$(document).ready(function(){
    let page = $('#hidden_page_service_ls').val();
    const csrf_token = $('meta[name="csrf-token"]').attr('content');
    const token =  $('meta[name="jwt"]').attr('content');

    $(document).on('click', '.paginate__v1__ls .pagination a',function(event){
        event.preventDefault();

        var page = $(this).attr('href').split('page=')[1];

        $('#hidden_page_service_ls').val(page);

        $('li').removeClass('active');
        $(this).parent().addClass('active');

        var serial = $('.serial_data_ls').val();
        var key =  $('.key_data_ls').val();
        var status =  $('.status_data_ls').val();
        var started_at = $('.started_at_data_ls').val();
        var ended_at =  $('.ended_at_data_ls').val();

        loadDataChargeHistory(page, serial, key, status,started_at,ended_at);
    });

    function loadDataChargeHistory(page, serial, key, status,started_at,ended_at) {

        request = $.ajax({
            type: 'GET',
            url: '/lich-su-nap-the',
            data: {
                page:page,
                serial:serial,
                key:key,
                status:status,
                started_at:started_at,
                ended_at:ended_at,
            },
            beforeSend: function (xhr) {

            },
            success: (data) => {
                $("#data_pay_card_history_ls").empty().html('');
                $("#data_pay_card_history_ls").empty().html(data);
            },
            error: function (data) {

            },
            complete: function (data) {

            }
        });
    }

    $(document).on('submit', '.form-charge_ls', function(e){
        e.preventDefault();

        var serial_data = $('.serial').val();

        if (serial_data == null || serial_data == undefined || serial_data == ''){
            $('.serial_data_ls').val('');
        }else {
            $('.serial_data_ls').val(serial_data);
        }

        var key_data = $('.key').val();

        if (key_data == null || key_data == undefined || key_data == ''){
            $('.key_data_ls').val('');
        }else {
            $('.key_data_ls').val(key_data);
        }

        var status_data =  $('.status').val();

        if (status_data == null || status_data == undefined || status_data == ''){
            $('.status_data_ls').val('');
        }else {
            $('.status_data_ls').val(status_data);
        }

        var started_at_data = $('.started_at').val();
        if (started_at_data == null || started_at_data == undefined || started_at_data == ''){
            $('.started_at_data_ls').val('');
        }else {
            $('.started_at_data_ls').val(started_at_data);
        }

        var ended_at_data =  $('.ended_at').val();
        if (ended_at_data == null || ended_at_data == undefined || ended_at_data == ''){
            $('.ended_at_data_ls').val('');
        }else {
            $('.ended_at_data_ls').val(ended_at_data);
        }

        var serial = $('.serial_data_ls').val();
        var key =  $('.key_data_ls').val();
        var status =  $('.status_data_ls').val();
        var started_at = $('.started_at_data_ls').val();
        var ended_at =  $('.ended_at_data_ls').val();
        var page = $('#hidden_page_service_ls').val();

        loadDataChargeHistory(page, serial, key, status,started_at,ended_at);
    });

    $('body').on('click','.btn-hom-nay',function(e){

        var datestartTime = $('.started_at_day_ls').val();

        var dateEndTime = $('.end_at_day_ls').val();

        //alert(dateEndTime + datestartTime)
        $('.serial').val('');
        $('.key').val('');
        $('.status').val('');
        $('.started_at').val('');
        $('.ended_at').val('');
        $('.serial_data_ls').val('');
        $('.key_data_ls').val('');
        $('.status_data_ls').val('');
        $('.started_at_data_ls').val(datestartTime);
        $('.ended_at_data_ls').val(dateEndTime);

        var serial = $('.serial_data_ls').val();
        var key =  $('.key_data_ls').val();
        var status =  $('.status_data_ls').val();
        var started_at = $('.started_at_data_ls').val();
        var ended_at =  $('.ended_at_data_ls').val();

        loadDataChargeHistory(page, serial, key, status,started_at,ended_at);

    });

    $('body').on('click','.btn-hom-qua',function(e){

        var datestartTime = $('.started_at_yes_ls').val();
        var dateEndTime = $('.end_at_yes_ls').val();

        $('.serial').val('');
        $('.key').val('');
        $('.status').val('');
        $('.started_at').val('');
        $('.ended_at').val('');
        $('.serial_data_ls').val('');
        $('.key_data_ls').val('');
        $('.status_data_ls').val('');
        $('.started_at_data_ls').val(datestartTime);
        $('.ended_at_data_ls').val(dateEndTime);

        var serial = $('.serial_data_ls').val();
        var key =  $('.key_data_ls').val();
        var status =  $('.status_data_ls').val();
        var started_at = $('.started_at_data_ls').val();
        var ended_at =  $('.ended_at_data_ls').val();

        loadDataChargeHistory(page, serial, key, status,started_at,ended_at);

    });

    $('body').on('click','.btn-thang-nay',function(e){

        var datestartTime = $('.started_at_month_ls').val();
        var dateEndTime = $('.end_at_month_ls').val();

        $('.serial').val('');
        $('.key').val('');
        $('.status').val('');
        $('.started_at').val('');
        $('.ended_at').val('');
        $('.serial_data_ls').val('');
        $('.key_data_ls').val('');
        $('.status_data_ls').val('');
        $('.started_at_data_ls').val(datestartTime);
        $('.ended_at_data_ls').val(dateEndTime);

        var serial = $('.serial_data_ls').val();
        var key =  $('.key_data_ls').val();
        var status =  $('.status_data_ls').val();
        var started_at = $('.started_at_data_ls').val();
        var ended_at =  $('.ended_at_data_ls').val();

        loadDataChargeHistory(page, serial, key, status,started_at,ended_at);

    });

    $('body').on('click','.btn-all',function(e){

        $('.serial').val('');
        $('.key').val('');
        $('.status').val('');
        $('.started_at').val('');
        $('.ended_at').val('');
        $('.serial_data_ls').val('');
        $('.key_data_ls').val('');
        $('.status_data_ls').val('');
        $('.started_at_data_ls').val('');
        $('.ended_at_data_ls').val('');

        var serial = $('.serial_data_ls').val();
        var key =  $('.key_data_ls').val();
        var status =  $('.status_data_ls').val();
        var started_at = $('.started_at_data_ls').val();
        var ended_at =  $('.ended_at_data_ls').val();

        loadDataChargeHistory(page, serial, key, status,started_at,ended_at);

    });
})
