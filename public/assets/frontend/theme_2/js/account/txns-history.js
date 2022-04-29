$(document).ready(function(){
    const csrf_token = $('meta[name="csrf-token"]').attr('content');
    const token =  $('meta[name="jwt"]').attr('content');
    let page = $('#hidden_page_service_txns').val();
    $(document).on('click', '.paginate__v1_index_txns .pagination a',function(event){
        event.preventDefault();

        var page = $(this).attr('href').split('page=')[1];

        $('#hidden_page_service_txns').val(page);

        $('li').removeClass('active');
        $(this).parent().addClass('active');

        var id_txns_data = $('.id_txns_data').val();
        var started_at_txns_data = $('.started_at_txns_data').val();
        var ended_at_txns_data = $('.ended_at_txns_data').val();

        loadDataAccountList(page,id_txns_data,started_at_txns_data,ended_at_txns_data)
    });

    $(document).on('submit', '.form__txns', function(e){
        e.preventDefault();

        var id_txns = $('.id_txns').val();
        var started_at_txns = $('.started_at_txns').val();
        var ended_at_txns = $('.ended_at_txns').val();

        if (started_at_txns == null || started_at_txns == undefined || started_at_txns == ''){
            $('.started_at_txns_data').val('');
        }else {
            $('.started_at_txns_data').val(started_at_txns);
        }

        if (ended_at_txns == null || ended_at_txns == undefined || ended_at_txns == ''){
            $('.ended_at_txns_data').val('');
        }else {
            $('.ended_at_txns_data').val(ended_at_txns);
        }

        if (id_txns == null || id_txns == undefined || id_txns == ''){
            $('.id_txns_data').val('');
        }else {
            $('.id_txns_data').val(id_txns);
        }

        var id_txns_data = $('.id_txns_data').val();

        var started_at_txns_data = $('.started_at_txns_data').val();
        var ended_at_txns_data = $('.ended_at_txns_data').val();
        var page = $('#hidden_page_service_txns').val();


        loadDataAccountList(page,id_txns_data,started_at_txns_data,ended_at_txns_data)

    });

    $('body').on('click','.data__giaodich',function(e){
        e.preventDefault();
        $('.id_txns_data').val('');
        $('.started_at_txns_data').val('');
        $('.ended_at_txns_data').val('');

        var id_txns_data = $('.id_txns_data').val();
        var started_at_txns_data = $('.started_at_txns_data').val();
        var ended_at_txns_data = $('.ended_at_txns_data').val();
        var page = $('#hidden_page_service_txns').val();

        loadDataAccountList(page,id_txns_data,started_at_txns_data,ended_at_txns_data)

    });
    var loc = window.location.search;
    if(loc.replace('?log=','') == 'transaction-history'){
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('active');
        $('.tab-pane').removeClass('show');
        $('.data__giaodich').addClass('active');
        $('.data__giaodich').addClass('show');
        $('.data__giaodich_tab').addClass('active');
        $('.data__giaodich_tab').addClass('show');
        $('.id_txns_data').val('');
        $('.started_at_txns_data').val('');
        $('.ended_at_txns_data').val('');

        var id_txns_data = $('.id_txns_data').val();
        var started_at_txns_data = $('.started_at_txns_data').val();
        var ended_at_txns_data = $('.ended_at_txns_data').val();
        let page = $('#hidden_page_service_txns').val();

        loadDataAccountList(page,id_txns_data,started_at_txns_data,ended_at_txns_data)
    }


    $('body').on('click','.button__txns',function(e){
        e.preventDefault();
        $('.id_txns_data').val('');
        $('.started_at_txns_data').val('');
        $('.ended_at_txns_data').val('');

        var id_txns_data = $('.id_txns_data').val();
        var started_at_txns_data = $('.started_at_txns_data').val();
        var ended_at_txns_data = $('.ended_at_txns_data').val();
        var page = $('#hidden_page_service_txns').val();

        loadDataAccountList(page,id_txns_data,started_at_txns_data,ended_at_txns_data)

    });

    function loadDataAccountList(page,id_txns_data,started_at_txns_data,ended_at_txns_data) {

        request = $.ajax({
            type: 'GET',
            url: '/lich-su-giao-dich-tich-hop',
            data: {
                page:page,
                id:id_txns_data,
                started_at:started_at_txns_data,
                ended_at:ended_at_txns_data,
            },
            beforeSend: function (xhr) {
                $(".load_spinner").show();
                $("#data_lich__su_history").hide(300);
            },
            success: (data) => {
                $(".load_spinner").hide();
                $("#data_lich__su_history").show();
                $("#data_lich__su_history").empty().html('');
                $("#data_lich__su_history").empty().html(data);
            },
            error: function (data) {

            },
            complete: function (data) {

                    $("#overlay").fadeOut(100);

            }
        });
    }


})
