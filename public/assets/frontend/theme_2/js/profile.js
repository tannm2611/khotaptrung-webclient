$(document).ready(function(){
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
    }
    function getInfo(){
        const url = '/profile';
        $.ajax({
            type: "GET",
            url: url,
            beforeSend: function (xhr) {

            },
            success: function (data) {
                if(data.status === "LOGIN"){
                    window.location.href = '/logout';
                    // method = method || 'post';
                    return;
                }
                if(data.status === "ERROR"){
                    alert('Lỗi dữ liệu, vui lòng load lại trang để tải lại dữ liệu')
                }
                if(data.status == true){
                    $('#info_create').html('Id: '+data.info.id)
                    $('#info_name').html(data.info.username +'<i class="las la-check-circle text-success"></i>')
                    $('#info_phone').val(data.info.id);
                    // $('#info_balance').html('<span>'+data.info.balance+'</span>')
                    // $('#info_balance').html('<span><i class="text-danger">'+formatNumber(data.info.balance)+'</i></span>')
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
});
