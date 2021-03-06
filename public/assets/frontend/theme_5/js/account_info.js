$(document).ready(function(){

    const csrf_token = $('meta[name="csrf-token"]').attr('content');
    const token =  $('meta[name="jwt"]').attr('content');
    function getInfo(){
        const url = '/user/account_info';
        if(token == 'undefined' || token == null || token =='' || token == undefined){


                $('.box-loading').hide();
                $('.box-logined').show();
                $('.box-account').hide();

                // đăng nhập, đăng ký

                  let html = '';
                  html += '<div class="box-icon brs-8 " >';
                  html += ' <img src="/assets/frontend/theme_5/image/nam/profile.svg" alt="" >';
                  html += '</div>';

                  $('.account-logined').html(html);
                  $('.box-account_nologined').show();
                  $('.box-account_logined').hide();


            $('meta[name="jwt"]').attr('content','jwt');
            return;
        }
        $.ajax({
            type: "POST",
            url: url,
            cache:false,
            data: {
                _token:csrf_token,
                jwt:token
            },
            beforeSend: function (xhr) {

            },
            success: function (data) {
                if(data.status === "LOGIN"){
                    $('.box-loading').hide();
                    $('.box-logined').show();
                    $('.box-account').hide();
                    // đăng nhập, đăng ký
                    let html = '';
                    html += '<div class="box-icon brs-8 " >';
                    html += ' <img src="/assets/frontend/theme_5/image/nam/profile.svg" alt="" >';
                    html += '</div>';

                    $('.account-logined').html(html);
                    $('.box-account_nologined').show();
                    $('.box-account_logined').hide();
                    $('meta[name="jwt"]').attr('content','jwt');

                }
                if(data.status == 401){


                }
                if(data.status === "ERROR"){
                    alert('Lỗi dữ liệu, vui lòng load lại trang để tải lại dữ liệu')
                }
                if(data.status == true){

                    $('.box-loading').hide();
                    $('.box-account_nologined').hide();
                    $('.box-account_logined').show();

                    // profile
                    let html = '';
                    html += '<div class="d-flex ">';
                    html += '<div class="account-name">';
                    html += '<div  class="text-right title-color fw-500">'+fn(data.info.username, 12)+'</div>';
                    html += '<div class="account-balance fw-400">Số dư: '+formatNumber(data.info.balance)+'</div>';
                    html += '</div>';
                    html += '<div class="account-avatar c-ml-12">';
                    html += '<img src="/assets/frontend/theme_5/image/nam/avatar.png" alt="">';
                    html += '</div>';
                    html += '</div>';

                    $('.account-logined').html(html);
                    $('.account-name-sidebar').html(data.info.username);
                    $('.account-balance-sidebar').html('Số dư: <span>'+formatNumber(data.info.balance)+'</span>');
                    $('.account-id-sidebar').html('ID: <span>'+data.info.id+'</span>');

                    let htmtLogout = '';
                    htmtLogout += '<a href="javascript:void(0);" onclick="event.preventDefault();document.getElementById(\'logout-form\').submit();" class="d-block align-items-center d-flex">';
                    htmtLogout += '<div class="sidebar-item-icon brs-8 c-p-8 c-mr-12">';
                    htmtLogout += '<img src="/assets/frontend/theme_5/image/nam/log-out.svg" alt="" style="width: 24px;height: 24px">';
                    htmtLogout += '</div>';
                    htmtLogout += '<p class="sidebar-item-text fw-400 fz-12 mb-0">Đăng xuất</p>';
                    htmtLogout += '</a>';

                    $('.log-out-button').html(htmtLogout);
                    $('meta[name="jwt"]').attr('content',data.token);

                }
            },
            error: function (data) {
                // alert('Có lỗi phát sinh, vui lòng liên hệ QTV để kịp thời xử lý(account_info)!')
                return;
            },
            complete: function (data) {

            }
        });
    }
    getInfo();

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
    }
    function fn(text, count){
        return text.slice(0, count) + (text.length > count ? "..." : "");
    }

});

