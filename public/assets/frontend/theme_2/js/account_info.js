$(document).ready(function(){
    const csrf_token = $('meta[name="csrf-token"]').attr('content');
    const token =  $('meta[name="jwt"]').attr('content');
    function getInfo(){
        const url = '/user/account_info';
        if(token == 'undefined' || token == null || token =='' || token == undefined){
            $('#info .store-loading').remove();
            $('#info_mobile .store-loading').remove();
            $('#info').attr('href','/login')
            $('#info>div:first-child').html('<div class="small op-5 text-end"> Đăng nhập</div>')
            $('#auth').html('<input type="text" class="auth" value="none">')
            $('#store_pay').html(' <a href="login" class="btn text-white bg-warning-gradient pe-4 ps-4 pt-2 pb-2 rounded" ><strong>Đăng nhập để thanh toán</strong> <i class="las la-angle-double-right"></i></a>  ')

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
                    $('#info .store-loading').remove();
                    $('#info_mobile .store-loading').remove();
                    $('#info').attr('href','/login')
                    $('#info>div:first-child').html('<div class="small op-5 text-end"> Đăng nhập</div>')
                    $('#auth').html('<input type="text" class="auth" value="none">')
                    $('#store_pay').html(' <a href="login" class="btn text-white bg-warning-gradient pe-4 ps-4 pt-2 pb-2 rounded" ><strong>Đăng nhập để thanh toán</strong> <i class="las la-angle-double-right"></i></a>  ')

                }
                if(data.status === "ERROR"){
                    alert('Lỗi dữ liệu, vui lòng load lại trang để tải lại dữ liệu')
                }
                if(data.status == true){
                    $('#info>div:first-child').html(' <div class="small op-5 text-end"> Chào '+ fn(data.info.username, 6)  +'</div> <div class="text-end">Số dư: '+formatNumber(data.info.balance)+' đ</div>')
                    $('#info_mobile').html('<div class="medium op-5 text-start"><b>'+ fn(data.info.username, 6)  +'</b></div>  <div class="text-start">Số dư:  '+formatNumber(data.info.balance)+' đ</div>')
                    $('#info').attr('data-bs-toggle','dropdown')
                    $('#info').attr('aria-haspopup','true')
                    $('#info').attr('aria-expanded','false')
                    $('#info').attr('href','#')
                    $('#info_fullname').val(data.info.username)
                    $('#auth').html('<input type="text" class="auth" value="'+data.info.balance+'">')
                    $('#store_pay').html(' <a href="#" class="btn text-white bg-warning-gradient pe-4 ps-4 pt-2 pb-2 rounded button-action-steps" data-id="2" ><strong>Thanh toán</strong> <i class="las la-angle-double-right"></i></a>  ')

                    // $('#username').val(data.info.username);
                    // $('#info .loading').remove();
                    // $('#logout .loading').remove();
                    // $('#info').attr('href','/thong-tin')
                    // $('#logout').attr('href','/logout')
                    //
                    // // mobile tab
                    // $('#info_tab_mobile .loading').remove();
                    // $('#logout_tab_mobile .loading').remove();
                    // $('#info_tab_mobile').attr('href','/thong-tin')
                    // $('#logout_tab_mobile').attr('href','/logout')
                    //
                    // $('#logout-form').attr('href','/logout')
                    //
                    //
                    //
                    // $('#logout').attr('onclick','event.preventDefault();\ndocument.getElementById(\'logout-form\').submit();')
                    // $('#info').html('<i class="fas fa-user"></i> '+ fn(data.info.username, 6)  +' - $' +formatNumber(data.info.balance))
                    // $('#logout').html('<i class="fas fa-user"></i> Đăng xuất')

                }
            },
            error: function (data) {
                alert('Có lỗi phát sinh, vui lòng liên hệ QTV để kịp thời xử lý!')
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
//
// // new
// $(document).ready(function(){
//     const csrf_token = $('meta[name="csrf-token"]').attr('content');
//     const token =  $('meta[name="jwt"]').attr('content');
//     function getInfo(){
//         const url = '/user/account_info';
//         if(token == 'undefined' || token == null || token =='' || token == undefined){
//             $('#info .loading').remove();
//             $('#logout .loading').remove();
//             $('#info').attr('href','/login');
//             $('#logout').attr('href','/register');
//             $('#info').html('<i class="fas fa-user"></i> Đăng nhập');
//             $('#logout').html('<i class="fas fa-user"></i> Đăng kí');
//             return;
//         }
//         $.ajax({
//             type: "POST",
//             url: url,
//             cache:false,
//             data: {
//                 _token:csrf_token,
//                 jwt:token
//             },
//             beforeSend: function (xhr) {
//
//             },
//             success: function (data) {
//                 // if(data.status === "LOGIN"){
//                 //     window.location.href = '/login';
//                 //     // method = method || 'post';
//                 //     return;
//                 // }
//                 // if(data.status === "ERROR"){
//                 //     alert('Lỗi dữ liệu, vui lòng load lại trang để tải lại dữ liệu')
//                 // }
//                 console.log(data);
//                 if(data.status == 1){
//                     $('#info .loading').remove();
//                     $('#logout .loading').remove();
//                     $('#info').attr('href','/thong-tin')
//                     $('#logout').attr('href','/logout')
//                     $('#logout-form').attr('href','/logout')
//
//                     $('#logout').attr('onclick','event.preventDefault();\ndocument.getElementById(\'logout-form\').submit();')
//                     $('#info').html('<i class="fas fa-user"></i> '+data.info.username)
//                     $('#logout').html('<i class="fas fa-user"></i> Đăng xuất')
//                 }
//                 else{
//                     $('#info').attr('href','/login');
//                     $('#logout').attr('href','/register');
//                     $('#info').html('<i class="fas fa-user"></i> Đăng nhập');
//                     $('#logout').html('<i class="fas fa-user"></i> Đăng kí');
//                 }
//             },
//             error: function (data) {
//                 alert('Có lỗi phát sinh, vui lòng liên hệ QTV để kịp thời xử lý!')
//                 return;
//             },
//             complete: function (data) {
//
//             }
//         });
//     }
//     getInfo();
// });
