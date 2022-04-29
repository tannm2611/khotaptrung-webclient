$(document).ready(function(){
    let page = $('#hidden_page_service_lxnt').val();
    const csrf_token = $('meta[name="csrf-token"]').attr('content');
    const token =  $('meta[name="jwt"]').attr('content');

    $(document).on('click', '.paginate__v1_index_lsnt .pagination a',function(event){
        event.preventDefault();

        var page = $(this).attr('href').split('page=')[1];

        $('#hidden_page_service_lsnt').val(page);

        $('li').removeClass('active');
        $(this).parent().addClass('active');

        var started_at_lsnt = $('.started_at_lsnt_data').val();
        var ended_at_lsnt =  $('.ended_at_lsnt_data').val();

        loadDataChargeHistory(page,started_at_lsnt,ended_at_lsnt);
    });


    function loadDataChargeHistory(page,started_at_lsnt,ended_at_lsnt) {

        request = $.ajax({
            type: 'GET',
            url: '/lich-su-nap-the-tich-hop',
            data: {
                page:page,
                started_at:started_at_lsnt,
                ended_at:ended_at_lsnt,
            },
            beforeSend: function (xhr) {
                $(".load_spinner").show();
                $("#data_napthe_history").hide();
            },
            success: (data) => {
                $(".load_spinner").hide();
                $("#data_napthe_history").show();
                $("#data_napthe_history").empty().html('');
                $("#data_napthe_history").empty().html(data);
            },
            error: function (data) {

            },
            complete: function (data) {

            }
        });
    }

    $(document).on('submit', '.form__lsnt', function(e){
        e.preventDefault();

        var started_at_lsnt = $('.started_at_lsnt').val();

        if (started_at_lsnt == null || started_at_lsnt == undefined || started_at_lsnt == ''){
            $('.started_at_data_lsnt').val('');
        }else {
            $('.started_at_data_lsnt').val(started_at_lsnt);
        }

        var ended_at_lsnt =  $('.ended_at_lsnt').val();

        if (ended_at_lsnt == null || ended_at_lsnt == undefined || ended_at_lsnt == ''){
            $('.ended_at_data_lsnt').val('');
        }else {
            $('.ended_at_data_lsnt').val(ended_at_lsnt);
        }

        var started_at = $('.started_at_data_lsnt').val();
        var ended_at =  $('.ended_at_data_lsnt').val();
        var page = $('#hidden_page_service_lsnt').val();

        loadDataChargeHistory(page,started_at,ended_at);
    });

    $('body').on('click','.data__napthe',function(e){

        e.preventDefault();
        $('.started_at_txns_data').val('');
        $('.ended_at_txns_data').val('');

        var started_at_lsnt_data = $('.started_at_lsnt_data').val();
        var ended_at_lsnt_data = $('.ended_at_lsnt_data').val();
        var page = $('#hidden_page_service_lsnt').val();

        loadDataChargeHistory(page,started_at_lsnt_data,ended_at_lsnt_data)

    });
    var loc = window.location.search;

    if(loc.replace('?log=','') == 'deposit-history'){
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('active');
        $('.tab-pane').removeClass('show');
        $('.data__napthe').addClass('active');
        $('.data__napthe').addClass('show');
        $('.data__napthe_tab').addClass('active');
        $('.data__napthe_tab').addClass('show');

        $('.started_at_txns_data').val('');
        $('.ended_at_txns_data').val('');

        var started_at_lsnt_data = $('.started_at_lsnt_data').val();
        var ended_at_lsnt_data = $('.ended_at_lsnt_data').val();
        let page = $('#hidden_page_service_lsnt').val();

        loadDataChargeHistory(page,started_at_lsnt_data,ended_at_lsnt_data)


    }
})
