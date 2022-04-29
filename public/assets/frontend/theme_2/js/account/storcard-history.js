$(document).ready(function(){

    $('body').on('click','i.la-copy',function(e){
        data = $(this).data('id');
        var $temp = $("<input>");
        $("body #copy").html($temp);
        $temp.val($.trim(data)).select();
        document.execCommand("copy");
        $temp.remove();
    });
    const csrf_token = $('meta[name="csrf-token"]').attr('content');
    const token =  $('meta[name="jwt"]').attr('content');
    let page = $('#hidden_page_service_txns').val();

    $(document).on('click', '.paginate__v1_index__lsmt .pagination a',function(event){
        event.preventDefault();

        var page = $(this).attr('href').split('page=')[1];

        $('#hidden_page_service_lsmt').val(page);

        $('li').removeClass('active');
        $(this).parent().addClass('active');

        var id_lsmt_data = $('.id_lsmt_data').val();
        var started_at_lsmt_data = $('.started_at_lsmt_data').val();
        var ended_at_lsmt_data = $('.ended_at_lsmt_data').val();

        loadDataAccountList(page,id_lsmt_data,started_at_lsmt_data,ended_at_lsmt_data)
    });

    $(document).on('submit', '.form__lsmt', function(e){
        e.preventDefault();

        var id_lsmt = $('.id_lsmt').val();
        var started_at_lsmt = $('.started_at_lsmt').val();
        var ended_at_lsmt = $('.ended_at_lsmt').val();

        if (started_at_lsmt == null || started_at_lsmt == undefined || started_at_lsmt == ''){
            $('.started_at_lsmt_data').val('');
        }else {
            $('.started_at_lsmt_data').val(started_at_lsmt);
        }

        if (ended_at_lsmt == null || ended_at_lsmt == undefined || ended_at_lsmt == ''){
            $('.ended_at_lsmt_data').val('');
        }else {
            $('.ended_at_lsmt_data').val(ended_at_lsmt);
        }

        if (id_lsmt == null || id_lsmt == undefined || id_lsmt == ''){
            $('.id_lsmt_data').val('');
        }else {
            $('.id_lsmt_data').val(id_lsmt);
        }

        var id_lsmt_data = $('.id_lsmt_data').val();

        var started_at_lsmt_data = $('.started_at_lsmt_data').val();
        var ended_at_lsmt_data = $('.ended_at_lsmt_data').val();
        var page = $('#hidden_page_service_lsmt').val();


        loadDataAccountList(page,id_lsmt_data,started_at_lsmt_data,ended_at_lsmt_data)

    });

    $('body').on('click','.data__muathe',function(e){
        e.preventDefault();

        $('.id_lsmt_data').val('');
        $('.started_at_lsmt_data').val('');
        $('.ended_at_lsmt_data').val('');

        var id_lsmt_data = $('.id_lsmt_data').val();
        var started_at_lsmt_data = $('.started_at_lsmt_data').val();
        var ended_at_lsmt_data = $('.ended_at_lsmt_data').val();
        var page = $('#hidden_page_service_lsmt').val();

        loadDataAccountList(page,id_lsmt_data,started_at_lsmt_data,ended_at_lsmt_data)

    });

    var loc = window.location.search;
    if (loc.replace('?log=','') == 'store-card'){
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('active');
        $('.tab-pane').removeClass('show');
        $('.data__muathe').addClass('active');
        $('.data__muathe').addClass('show');
        $('.data__muathe_tab').addClass('active');
        $('.data__muathe_tab').addClass('show');
        $('.id_lsmt_data').val('');
        $('.started_at_lsmt_data').val('');
        $('.ended_at_lsmt_data').val('');

        var id_lsmt_data = $('.id_lsmt_data').val();
        var started_at_lsmt_data = $('.started_at_lsmt_data').val();
        var ended_at_lsmt_data = $('.ended_at_lsmt_data').val();
        let page = $('#hidden_page_service_lsmt').val();

        loadDataAccountList(page,id_lsmt_data,started_at_lsmt_data,ended_at_lsmt_data)
    }


    $('body').on('click','.button__lsmt',function(e){
        e.preventDefault();
        $('.id_lsmt_data').val('');
        $('.started_at_lsmt_data').val('');
        $('.ended_at_lsmt_data').val('');

        var id_lsmt_data = $('.id_lsmt_data').val();
        var started_at_lsmt_data = $('.started_at_lsmt_data').val();
        var ended_at_lsmt_data = $('.ended_at_lsmt_data').val();
        var page = $('#hidden_page_service_lsmt').val();

        loadDataAccountList(page,id_lsmt_data,started_at_lsmt_data,ended_at_lsmt_data)

    });

    function loadDataAccountList(page,id_lsmt_data,started_at_lsmt_data,ended_at_lsmt_data) {
        request = $.ajax({
            type: 'GET',
            url: '/lich-su-mua-the-tich-hop',
            data: {
                page:page,
                id:id_lsmt_data,
                started_at:started_at_lsmt_data,
                ended_at:ended_at_lsmt_data,
            },
            beforeSend: function (xhr) {
                $("#data_muathe_history").hide();
                $(".load_spinner").show();

            },
            success: (data) => {

                $("#data_muathe_history").empty().html('');
                $("#data_muathe_history").empty().html(data);

            },
            error: function (data) {

            },
            complete: function (data) {
                $("#data_muathe_history").show();
                $(".load_spinner").hide();

            }
        });
    }


})
