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
    $('.item_spin_list_more').click(function(){
        $('.item_spin_list').css("overflow","auto");
        $('.item_spin_list_less').css("display","block");
        $(".item_spin_list_more").css("display","none");
    });
    $('.item_spin_list_less').click(function(){
        $('.item_spin_list').css("overflow","hidden");
        $('.item_spin_list_less').css("display","none");
        $(".item_spin_list_more").css("display","block");
    });
});
$(document).ready(function(e) {
    $(".thele").on("click", function(){
        $("#theleModal").modal('show');
    })
    $(".tylevongquay").on("click", function(){
        $("#tylevongquayModal").modal('show');
    })
    $(".uytin").on("click", function(){
        $("#uytinModal").modal('show');
    })
    $(".luotquay").on("click", function(){
        $("#luotquayModal").modal('show');
    })
    $(".topquaythuong").on("click", function(){
        $("#topquaythuongModal").modal('show');
    })


    var tyleLoop = 0;
    var saleoffpass = "";
    //var saleoffmessage = "";
    var gift_revice="";
    var userpoint = 0;
    var numrollbyorder = 0;
    var roll_check = true;
    var num_loop = 3;
    var xvalue=0;
    var xvalueaDD = 0;
    var num = 0;
    var num_current = 0;
    var target = 0;
    var arrxgt;
    var free_wheel = 0;
    var typeRoll = "real";
    var value_gif_bonus='';
    var msg_random_bonus = '';
    var arrDiscount = '';
    var slot1_fake;
    var slot2_fake;
    var slot3_fake;
    //Click n??t quay
    $('body').delegate('#start-played', 'click', function() {

        if (roll_check) {
            //fakeLoop();
            roll_check = false;
            saleoffpass = $("#saleoffpass").val();
            typeRoll = "real";
            numrolllop = $("#numrolllop").val();
            $.ajax({
                url: '/minigame-play',
                datatype: 'json',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: $('#group_id').val(),
                    numrolllop: numrolllop,
                    numrollbyorder: numrollbyorder,
                    typeRoll: typeRoll,
                    saleoffpass: saleoffpass,
                },
                type: 'POST',
                success: function(data) {
                    if (data.status == 4) {
                        location.href='/login?return_url='+window.location.href;
                        return;
                    } else if (data.status == 3) {
                        roll_check = true;
                        $('#naptheModal').modal('show')
                        return;
                    } else if (data.status == 0) {
                        roll_check = true;
                        $('#noticeModal .content-popup').text(data.msg);
                        $('#noticeModal').modal('show');
                        return;
                    }
                    roll_check = true;
                    gift_detail = data.gift_detail;
                    var num1=0;
                    var num2=0;
                    var num3=0;
                    if(gift_detail.winbox == 0){
                        num1 = parseInt(gift_detail.order)+1;
                        num2 = num1 + 1;
                        if(num2 > parseInt($('#count_item').val())){
                            num2 = num2 - parseInt($('#count_item').val());
                        }
                        num3 = num2 + 1;
                        if(num3 > parseInt($('#count_item').val())){
                            num3 = num3 - parseInt($('#count_item').val());
                        }
                    }else{
                        num1 = parseInt(gift_detail.order)+1;
                        num2 = parseInt(gift_detail.order)+1;
                        num3 = parseInt(gift_detail.order)+1;
                    }



                    gift_revice = data.arr_gift;
                    numrollbyorder = parseInt(data.numrollbyorder) + 1;
                    arrxgt = data.xgt;
                    if (arrxgt > 0) {
                        xvalue = arrxgt[arrxgt.length - 1];
                    } else {
                        xvalue = 0;
                    }
                    value_gif_bonus = data.value_gif_bonus;
                    msg_random_bonus = data.msg_random_bonus;
                    xvalueaDD = data.xValue;
                    free_wheel = data.free_wheel;
                    userpoint = data.userpoint;
                    if(userpoint<100){
                        $(".item_spin_progress_bubble").css("width", data.userpoint + "%")
                    }else{
                        $(".item_spin_progress_bubble").css("width", "100%");
                        $(".item_spin_progress_bubble").addClass('clickgif');
                    }
                    $(".item_spin_progress_percent").html(data.userpoint + "/100 point");
                    $("#saleoffpass").val("");
                    tyleLoop = 1;
                    doSlot(num1,num2,num3);

                },
                error: function() {
                    $('#noticeModal .content-popup').text('C?? l???i x???y ra. Vui l??ng th??? l???i!');
                    $('#noticeModal').modal('show');
                }
            })
        }
    });


    function getgifbonus() {
        if($('#checkPoint').val() != "1"){
            return;
        }
        $.ajax({
            url: '/minigame-bonus',
            datatype: 'json',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: $('#group_id').val(),
            },
            type: 'POST',
            success: function(data) {
                if (data.status == 0) {
                    $('#noticeModal .content-popup').text(data.msg);
                    $('#noticeModal').modal('show');
                    return;
                }
                $('#noticeModal .nohuthang').html(data.msg + " - " + data.arr_gift[0].title);
                $('#noticeModal').modal('show');
                var userpoint = data.userpoint;
                if(userpoint<100){
                    $(".item_spin_progress_bubble").css("width", data.userpoint + "%");
                    $(".item_spin_progress_bubble").removeClass('clickgif');
                }else{
                    $(".item_spin_progress_bubble").css("width", "100%");
                    $(".item_spin_progress_bubble").addClass('clickgif');
                }
                $(".item_spin_progress_percent").html(data.userpoint + "/100 point");
                $(".pyro").show();
                setTimeout(function(){
                    $(".pyro").hide();
                },6000)
            },
            error: function() {
                $('#noticeModal .content-popup').text('C?? l???i x???y ra. Vui l??ng th??? l???i!');
                $('#noticeModal').modal('show');
            }
        })
    }


    $('body').delegate('.num-play-try', 'click', function() {
        if (roll_check) {
            //fakeLoop();
            roll_check = false;
            saleoffpass = $("#saleoffpass").val();
            typeRoll = "try";
            numrolllop = $("#numrolllop").val();
            $.ajax({
                url: '/minigame-play',
                datatype: 'json',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: $('#group_id').val(),
                    numrolllop: numrolllop,
                    numrollbyorder: numrollbyorder,
                    typeRoll: typeRoll,
                    saleoffpass: saleoffpass,
                },
                type: 'POST',
                success: function(data) {
                    if (data.status == 4) {
                        location.href='/login';
                        return;
                    } else if (data.status == 3) {
                        $('#naptheModal').modal('show')
                        return;
                    } else if (data.status == 0) {
                        roll_check = true;
                        $('#noticeModal .content-popup').text(data.msg);
                        $('#noticeModal').modal('show');
                        return;
                    }
                    roll_check = true;
                    gift_detail = data.gift_detail;
                    var num1=0;
                    var num2=0;
                    var num3=0;
                    if(gift_detail.winbox == 0){
                        num1 = parseInt(gift_detail.order)+1;
                        num2 = num1 + 1;
                        if(num2 > parseInt($('#count_item').val())){
                            num2 = num2 - parseInt($('#count_item').val());
                        }
                        num3 = num2 + 1;
                        if(num3 > parseInt($('#count_item').val())){
                            num3 = num3 - parseInt($('#count_item').val());
                        }
                    }else{
                        num1 = parseInt(gift_detail.order)+1;
                        num2 = parseInt(gift_detail.order)+1;
                        num3 = parseInt(gift_detail.order)+1;
                    }
                    tyleLoop = 1;
                    doSlot(num1,num2,num3);

                    gift_revice = data.arr_gift;
                    numrollbyorder = parseInt(data.numrollbyorder) + 1;
                    arrxgt = data.xgt;
                    if (arrxgt > 0) {
                        xvalue = arrxgt[arrxgt.length - 1];
                    } else {
                        xvalue = 0;
                    }
                    value_gif_bonus = data.value_gif_bonus;
                    msg_random_bonus = data.msg_random_bonus;
                    xvalueaDD = data.xValue;
                    free_wheel = data.free_wheel;
                    userpoint = data.userpoint;
                    if(userpoint<100){
                        $(".progress-bar").css("width", userpoint + "%");
                    }else{
                        $(".pyro").show();
                        setTimeout(function(){
                            $(".pyro").hide();
                        },6000)
                        $(".progress-bar").css("width", "100%");
                        $(".progress-bar").addClass('clickgif');
                    }
                    $('.progress-tooltip').text(`??i???m c???a b???n: ${userpoint}/100`);
                    $("#saleoffpass").val("");

                },
                error: function() {
                    $('#noticeModal .content-popup').text('C?? l???i x???y ra. Vui l??ng th??? l???i!');
                    $('#noticeModal').modal('show');
                }
            })
        }
    });

    // function fakeLoop(){
    //     document.getElementById("slot1").className='a1'
    //     document.getElementById("slot2").className='a1'
    //     document.getElementById("slot3").className='a1'
    //     var i1 = 0;
    //     var i2 = 0;
    //     var i3 = 0;
    //     slot1_fake = setInterval(spin1_fake, 50);
    //     slot2_fake = setInterval(spin2_fake, 50);
    //     slot3_fake = setInterval(spin3_fake, 50);

    //     function spin1_fake() {
    //         i1++;
    //         slotTile = document.getElementById("slot1");
    //         if (slotTile.className==`a${$('#count_item').val()}`){
    //             slotTile.className = "a0";
    //         }
    //         slotTile.className = "a"+(parseInt(slotTile.className.substring(1))+1)
    //     }
    //     function spin2_fake(){
    //         i2++;
    //         slotTile = document.getElementById("slot2");
    //         if (slotTile.className==`a${$('#count_item').val()}`){
    //             slotTile.className = "a0";
    //         }
    //         slotTile.className = "a"+(parseInt(slotTile.className.substring(1))+1)
    //     }
    //     function spin3_fake(){
    //         i3++;
    //         slotTile = document.getElementById("slot3");
    //         if (slotTile.className==`a${$('#count_item').val()}`){
    //             slotTile.className = "a0";
    //         }
    //         slotTile.className = "a"+(parseInt(slotTile.className.substring(1))+1)
    //     }
    // }


    function doSlot(one, two, three){
        // clearInterval(slot1_fake);
        // clearInterval(slot2_fake);
        // clearInterval(slot3_fake);
        document.getElementById("slot1").className='a1'
        document.getElementById("slot2").className='a1'
        document.getElementById("slot3").className='a1'
        var numChanges = randomInt(1,4)*parseInt($('#count_item').val());
        var numeberSlot1 = numChanges+one
        var numeberSlot2 = numChanges+2*parseInt($('#count_item').val())+two
        var numeberSlot3 = numChanges+4*parseInt($('#count_item').val())+three
        var i1 = 0;
        var i2 = 0;
        var i3 = 0;
        slot1 = setInterval(spin1, 50);
        slot2 = setInterval(spin2, 50);
        slot3 = setInterval(spin3, 50);

        function spin1() {
            i1++;
            if (tyleLoop == 1) {
                if (i1 >= numeberSlot1) {
                    clearInterval(slot1);
                    return null;
                }
            }
            slotTile = document.getElementById("slot1");
            if (slotTile.className==`a${$('#count_item').val()}`){
                slotTile.className = "a0";
            }
            slotTile.className = "a"+(parseInt(slotTile.className.substring(1))+1)
        }
        function spin2(){
            i2++;
            if (tyleLoop == 1) {
                if (i2 >= numeberSlot2) {
                    clearInterval(slot2);

                    return null;
                }
            }
            slotTile = document.getElementById("slot2");
            if (slotTile.className==`a${$('#count_item').val()}`){
                slotTile.className = "a0";
            }
            slotTile.className = "a"+(parseInt(slotTile.className.substring(1))+1)
        }
        function spin3(){
            i3++;
            if (tyleLoop == 1) {
                if (i3 >= numeberSlot3) {
                    clearInterval(slot3);
                    testWin();
                    return null;
                }
            }
            slotTile = document.getElementById("slot3");
            if (slotTile.className==`a${$('#count_item').val()}`){
                slotTile.className = "a0";
            }
            slotTile.className = "a"+(parseInt(slotTile.className.substring(1))+1)
        }
    }

    function randomInt(min, max){
        return Math.floor((Math.random() * (max-min+1)) + min);
    }

    function testWin() {
        roll_check = true;

        $("#btnWithdraw").show();
        if (gift_detail.winbox == 0) {
            $("#btnWithdraw").hide();
        } else {
            if (gift_detail.gift_type == 0) {
                $("#btnWithdraw").html("R??t qu??");
                $("#btnWithdraw").attr('href', '/withdrawitem-' + gift_detail.game_type);
            } else if (gift_detail.gift_type == 1) {
                $("#btnWithdraw").html("Ki???m tra nick tr??ng");
                $("#btnWithdraw").attr('href', '/minigame-logacc-' + $('#group_id').val());
                // } else if (gift_detail.gift_type == 'nrocoin') {
                //     $("#btnWithdraw").html("R??t v??ng");
                //     $("#btnWithdraw").attr('href', '/withdrawservice?id=' + $("#ID_NROCOIN").val());
                // } else if (gift_detail.gift_type == 'nrogem') {
                //     $("#btnWithdraw").html("R??t ng???c");
                //     $("#btnWithdraw").attr('href', '/withdrawservice?id=' + $("#ID_NROGEM").val());
                // } else if (gift_detail.gift_type == 'nroxu') {
                //     $("#btnWithdraw").html("R??t xu");
                //     $("#btnWithdraw").attr('href', '/withdrawservice?id=' + $("#ID_NINJAXU").val());
            } else if (gift_detail.gift_type == 2) {
                $("#btnWithdraw").html("Load l???i trang");
                $("#btnWithdraw").removeAttr("href");
                $("#btnWithdraw").addClass('reLoad');
            } else {
                $("#btnWithdraw").hide();
            }

        }


        if (gift_revice.length > 0) {
            $html = "";
            $strDiscountcode = "";
            // if(saleoffmessage.length > 0)
            // {
            //     $html += "<br/><span style='font-size: 14px;color: #f90707;font-style: italic;display: block;text-align: center;'>"+saleoffmessage+"</span><br/>";
            // }

            if (typeRoll == "real") {
                if (gift_revice.length == 1) {
                    // if(arrDiscount[0] != "")
                    // {
                    //     $strDiscountcode="<span>B???n nh???n ???????c 1 m?? gi???m gi?? khuy???n m??i ??i k??m: <b>"+arrDiscount[0]+"</b></span>";
                    // }
                    $html += "<span>K???t qu???: " + gift_revice[0]["title"] + "</span><br/>";
                    if (gift_detail.winbox == 1) {
                        $html += "<span>Mua X1: Nh???n ???????c " + gift_revice[0]["parrent"].params.value + "</span><br/>";
                        $html += "<span>Quay ???????c "+(xvalue+3)+" h??nh tr??ng nhau. Nh???n X"+(xvalueaDD[0])+" gi???i th?????ng: "+gift_revice[0]["parrent"].params.value*(xvalueaDD[0])+""+msg_random_bonus[0]+"</span><br/>";
                        $html += "<span>T???ng c???ng: " + parseInt(gift_revice[0]["parrent"].params.value) * (parseInt(xvalueaDD[0])) + "</span>";
                    }
                } else {
                    $totalRevice = 0;
                    $html += "<span>K???t qu???: Nh???n " + gift_revice.length + " ph???n th?????ng cho " + gift_revice.length + " l?????t quay.</span><br/>";
                    $html += "<span><b>Mua X" + gift_revice.length + ":</b></span><br/>";
                    for ($i = 0; $i < gift_revice.length; $i++) {
                        // if(arrDiscount[$i] != "")
                        // {
                        //     $strDiscountcode="<span>B???n nh???n ???????c 1 m?? gi???m gi?? khuy???n m??i ??i k??m: <b>"+arrDiscount[$i]+"</b></span>";
                        // }
                        $html += "<span>L???n quay " + ($i + 1) + ": " + gift_revice[$i]["title"];
                        if (gift_revice[$i].winbox == 1) {
                            $html += " - nh???n ???????c: " + gift_revice[$i]["parrent"].params.value + " X" + (parseInt(xvalueaDD[$i])) + " = " + parseInt(gift_revice[$i]["parrent"].params.value) * (parseInt(xvalueaDD[$i])) + "" + msg_random_bonus[$i] + "</span><br/>"  + "<br/>";
                        } else {
                            $html += "" + msg_random_bonus[$i] + "<br/>" + $strDiscountcode + "<br/>";
                        }
                        $totalRevice += parseInt(gift_revice[$i]["parrent"].params.value) * (parseInt(xvalueaDD[$i])) + parseInt(value_gif_bonus[$i]);
                    }

                    $html += "<span><b>T???ng c???ng: " + $totalRevice + "</b></span>";
                }
            } else {
                $("#btnWithdraw").hide();
                if (gift_revice.length == 1) {
                    $html += "<span>K???t qu??? ch??i th???: " + gift_revice[0]["title"] + "</span><br/>";
                    if (gift_detail.winbox == 1) {
                        $html += "<span>Mua X1: Nh???n ???????c " + gift_revice[0]["parrent"].params.value + "</span><br/>";
                        $html += "<span>Quay ???????c "+(xvalue+3)+" h??nh tr??ng nhau. Nh???n X"+(xvalueaDD[0])+" gi???i th?????ng: "+gift_revice[0]["parrent"].params.value*(xvalueaDD[0])+""+msg_random_bonus[0]+"</span><br/>";
                        $html += "<span>T???ng c???ng: " + parseInt(gift_revice[0]["parrent"].params.value) * (parseInt(xvalueaDD[0])) + "</span>";
                    }
                } else {
                    $totalRevice = 0;
                    $html += "<span>K???t qu??? ch??i th???: Nh???n " + gift_revice.length + " ph???n th?????ng cho " + gift_revice.length + " l?????t quay.</span><br/>";
                    $html += "<span><b>Mua X" + gift_revice.length + ":</b></span><br/>";
                    for ($i = 0; $i < gift_revice.length; $i++) {
                        $html += "<span>L???n quay " + ($i + 1) + ": " + gift_revice[$i]["title"];
                        if (gift_revice[$i].winbox == 1) {
                            $html += " - nh???n ???????c: " + gift_revice[$i]["parrent"].params.value + " X" + (parseInt(xvalueaDD[$i])) + " = " + parseInt(gift_revice[$i]["parrent"].params.value) * (parseInt(xvalueaDD[$i])) + "" + msg_random_bonus[$i] + "</span><br/>";
                        } else {
                            $html += "" + msg_random_bonus[$i] + "<br/>";
                        }
                        $totalRevice += parseInt(gift_revice[$i]["parrent"].params.value) * (parseInt(xvalueaDD[$i])) + parseInt(value_gif_bonus[$i]);
                    }

                    $html += "<span><b>T???ng c???ng: " + $totalRevice + "</b></span>";
                }
            }
        }

        $('#noticeModal .content-popup').html($html);

        if (userpoint > 99) {
            getgifbonus();
        }
        $("#noticeModal").modal('show');
        $("#noticeModal").on("hidden.bs.modal", function () {
            $('.modal-backdrop').remove();
            $('body').removeClass( "modal-open" );
        });
        if (free_wheel < 1) {
            $('.num-play-free').hide();
        } else {
            $('.num-play-free').html("(B???n c??n " + free_wheel + " l?????t quay mi???n ph??)");
        }
    }
});
$(".nav-tabs #tap1-tab-1").on("click",function(){
    $(".active").removeClass("active");
    $(this).parents("li").addClass("active");
    $(".tab-pane").hide();
    $("#tap1-pane-1").show();
})
$(".nav-tabs #tap1-tab-2").on("click",function(){
    $(".active").removeClass("active");
    $(this).parents("li").addClass("active");
    $(".tab-pane").hide();
    $("#tap1-pane-2").show();
})
$(".nav-tabs #tap1-tab-3").on("click",function(){
    $(".active").removeClass("active");
    $(this).parents("li").addClass("active");
    $(".tab-pane").hide();
    $("#tap1-pane-3").show();

})
