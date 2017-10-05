$(document).ready(function() {
        function decl(number, titles)  
        {  
            cases = [2, 0, 1, 1, 1, 2];  
            return titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];  
        }

        // action timer
        $(".promo-time").each(function() {
                var $element = $(this);
                var $day = $element.find(".promo-timer-separaton:eq(0) .promo-timer-num");
                var $hour = $element.find(".promo-timer-separaton:eq(1) .promo-timer-num");
                var $min = $element.find(".promo-timer-separaton:eq(2) .promo-timer-num");
                var $sec = $element.find(".promo-timer-separaton:eq(3) .promo-timer-num");

                var $textDay = $element.find(".promo-timer-separaton:eq(0) .promo-timer-sign");
                var $textHour = $element.find(".promo-timer-separaton:eq(1) .promo-timer-sign");
                var $textMin = $element.find(".promo-timer-separaton:eq(2) .promo-timer-sign");
                var $textSec = $element.find(".promo-timer-separaton:eq(3) .promo-timer-sign");

                function declTimer() {
                    $textDay.text(decl(day, ["день", "дня", "дней"]));
                    $textHour.text(decl(hour, ["час", "часа", "часов"]));
                    $textMin.text(decl(min, ["минута", "минуты", "минут"]));
                    $textSec.text(decl(sec, ["секунда", "секунды", "секунд"]));
                }

                var day = (parseInt($day.text()) < 10) ? "0" + parseInt($day.text()) : parseInt($day.text());
                var hour = (parseInt($hour.text()) < 10) ? "0" + parseInt($hour.text()) : parseInt($hour.text());
                var min = (parseInt($min.text()) < 10) ? "0" + parseInt($min.text()) : parseInt($min.text());
                var sec = (parseInt($sec.text()) < 10) ? "0" + parseInt($sec.text()) : parseInt($sec.text());

                var timer = $.timer(function() {
                        if ((day == 0) && (hour == 0) && (min == 0) && (sec == 0)) {
                            $element.find(".button").hide();
                            timer.stop();
                        }
                        else if ((hour == 0) && (min == 0) && (sec == 0)) {
                            hour = 12;
                            min = 60;
                            sec = 60;
                            day--;
                            day = (day < 10) ? "0" + day : day;
                            $day.text(day);
                            $hour.text(--hour);
                            $min.text(--min);
                            $sec.text(--sec);
                        }
                        else if ((min == 0) && (sec == 0)) {
                            min = 60;
                            sec = 60;
                            hour--;
                            hour = (hour < 10) ? "0" + hour : hour;
                            $hour.text(hour);
                            $min.text(--min);
                            $sec.text(--sec);
                        } 
                        else if (sec == 0) {
                            sec = 60;
                            min--;
                            min = (min < 10) ? "0" + min : min;
                            $min.text(min);
                            $sec.text(--sec);
                        }
                        else {
                            sec--;
                            sec = (sec < 10) ? "0" + sec : sec;
                            $sec.text(sec);
                        }
                        declTimer();
                });

                declTimer();

                timer.set({
                        time : 1000,
                        autostart : true 
                });
        });


        $(".button-basket-add").live('click',function() {
                var $element = $(this);
                var $item = $element.parent().parent();

                if( ! $item.hasClass("catalog-item"))
                    $item = $(this);

                var offsetItem = $item.offset();
                var offsetCart = $(".basket-line").offset();

                var disabled = $(this).attr('disabled');
                var goodID 	= 	$( '#goodID' ).html();
                var color 	= 	$( '.catalog-color-list img.active' ).attr( 'id' );
                var size 	= 	$( '.catalog-size-item.selected .catalog-size-value' ).html();
                var price = $('.catalog-detail-price.active').find('.catalog-detail-price-sum').html(); 
                var picture = $('img#detail_picture').attr('src');
                var color_name = $( '.catalog-color-list img.active' ).attr('alt');
                var offerId = $(this).attr('data-id');
                var link = '';
                if(disabled!='disabled'){
                    if (color || size)
                        {

                        $.ajax({
                                url: '/ajax/addToBasket.php',//data,
                                type: "POST",
                                data:{
                                    id:offerId,
                                      color:color_name,
                                    size:size,
                                },

                                success:     function(data){

                                    $('a#button_buy').removeClass('button button-basket-add basket-red');
                                    $("a#button_buy").attr('disabled', 'disabled');
                                    $('a#button_buy').addClass('button_green green');
                                    $('a#button_buy').html('В корзине');
                                    $('a#button_buy1').removeClass('button button-basket-add basket-red');
                                    $("a#button_buy1").attr('disabled', 'disabled');
                                    $('a#button_buy1').addClass('button_green green');
                                    $('a#button_buy1').html('В корзине');

                                    $.fancybox({
                                            'padding':0,
                                            'scrolling': 'no',
                                            'minHeight':760,
                                            type        : 'ajax',
                                            href        : '/ajax/in_basket.php?id='+goodID,
                                            ajax: {
                                                data:{ 
                                                    price: price,
                                                    picture: picture,
                                                    color_name:color_name,
                                                    size:size,
                                                    offerId:offerId,                                                    
                                                },
                                            },
                                            afterShow:function(){
                                                $('a.fancybox-close').addClass('new-close');
                                                $('a.exit').click(function(){
                                                        $('a.fancybox-close').click();
                                                });
                                            }

                                    }) ;
                                    $("#small-basket").load("/ajax/small-basket.php");


                                }

                        });

                    }
                    else
                        {
                        price = $('.catalog-detail-price-sum').html();
                        picture = $('img#detail_picture').attr('src');
                        $.ajax({
                                url: '/ajax/addToBasket.php',//data,
                                type: "POST",
                                data:{
                                    id:goodID,
                                },

                                success: function(){     
                                    $("#small-basket").load("/ajax/small-basket.php");

                                    $('a#button_buy').removeClass('button button-basket-add basket-red');
                                    $("a#button_buy").attr('disabled', 'disabled');
                                    $('a#button_buy').addClass('button_green green');
                                    $('a#button_buy').html('В корзине');
                                    $('a#button_buy1').removeClass('button button-basket-add basket-red');
                                    $("a#button_buy1").attr('disabled', 'disabled');
                                    $('a#button_buy1').addClass('button_green green');
                                    $('a#button_buy1').html('В корзине');

                                    $.fancybox({
                                            'padding':0,
                                            'scrolling': 'no',
                                            'minHeight':760,
                                            type        : 'ajax',
                                            href        : '/ajax/in_basket.php?id='+goodID,
                                            ajax: {
                                                data:{ 
                                                    price: price,
                                                    picture: picture,
                                                },
                                            },
                                            afterShow:function(){
                                                $('a.fancybox-close').addClass('new-close');
                                                $('a.exit').click(function(){
                                                        $('a.fancybox-close').click();
                                                });
                                            }

                                    }); 
                                }
                        });
                    }
                }

                //...........................................................................//
                return false;
        });

        $(".button-basket-add1").live('click',function() {
                var $element = $(this);
                var $item = $element.parent().parent();

                if( ! $item.hasClass("catalog-item"))
                    $item = $(this);

                var offsetItem = $item.offset();
                var offsetCart = $(".basket-line").offset();

                // 10.09.2013, ownedmuhaha, Получаем торговое предложение по цвету и размеру //

                var goodID 	= 	$( '#goodID' ).html();
                var color 	= 	$( '.catalog-color-list img.active' ).attr( 'id' );
                var size 	= 	$( '.catalog-size-item.selected .catalog-size-value' ).html();

                var link = '';

                $("#small-basket").load("/ajax/small-basket.php");

                //$item.hide();
                $item
                .clone()
                .addClass(".added-cart")
                .css({
                        "position" : "absolute",
                        "z-index"  : 20,
                        "top"	   : offsetItem.top,
                        "left"	   : offsetItem.left
                })
                .appendTo(".main-container").
                animate({
                        "top"  : offsetCart.top,
                        "left" : offsetCart.left,
                        "opacity" : 0.5
                    },800,function(){
                        $(this).remove();
                });
                console.log($item);



                //...........................................................................//


                return false;
        });

        $(".fancybox").fancybox({
                openEffect	: 'none',
                closeEffect	: 'none',
                nextClick	: true,
                nextEffect	: 'none',
                prevEffect  : 'none',
                prevEasing  : 'none',
                nextEasing  : 'none'
        });

        $(".popup-form-button").live('click',function(){
                var $element = $(this);
                var id = $element.attr("data-form");
                var dataAction = $element.attr("data-action");
                var dataProduct = $('input[name=prodName]').val();
                var dataLoc = $element.attr('data-loc');
                console.log(dataLoc);
              //  if(dataLoc){

                    $('.popup-container form').attr('data-loc',dataLoc);
                //}
                $.fancybox({
                        openEffect    : 'none',
                        closeEffect    : 'none',
                        padding     : 0,
                        closeBtn    : false,
                        minHeight    : 50,
                        maxWidth    : 389,
                        type        : 'ajax',
                        href        : '/ajax/popup-form.php?id=' + id,
                        ajax: {
                            data:{ 
                                dataProduct: dataProduct,
                                dataAction : dataAction,
                            },
                        },
                        onUpdate    : function() {
                            $('.popup-container form').attr('data-loc',dataLoc);

                            $('.popup-container form').live('submit',function(){
                                    var subm = "&web_form_submit="+$('input[name="web_form_submit"]').val();

                                    var bOk = true;
                                    $('.popup-container form input[type="text"]').each(function(index, elem){


                                            if ($(elem).val().trim() == '')
                                                {
                                                $(this).prev().addClass('error');

                                                bOk = false;
                                            }
                                            else
                                                {
                                                $(this).prev().removeClass('error');
                                            }

                                    });

                                    if (!bOk)
                                        return false;

                                    $.ajax({
                                            type: "POST",
                                            dataType : 'html',
                                            data:  $('.popup-container form').serialize()+subm,
                                            url: "/ajax/popup-form.php?id=" + id,
                                            beforeSend :  function(){
                                                $('.popup-container form').html('<div class="form-load">Загрузка...</div>')
                                            },
                                            success :function( html ) {
                                                $('.popup-container form').html('Спасибо! Ваша заявка принята!')
                                            }
                                    })
                                    return false;
                            });


                        },
                        beforeShow   : function() {
                            if (dataAction == 'oneClick')
                                {
                                $(".popup-title-text").text(dataProduct);
                                $('input[name="form_hidden_28"]').val(dataProduct);
                            }
                            else if(dataAction != "без акции" && dataAction != "" && dataAction != undefined)
                                {
                                $('input[name="form_hidden_17"]').val(dataAction);
                                $(".popup-title-text").text("Заказ по акции на " + dataAction);
                            }
                            else if(dataProduct != "" && dataProduct != undefined)
                                {
                                $(".popup-title-text").html("Узнать стоимость товара <br>«" + dataProduct + "»");
                                $('input[name="form_hidden_21"]').val(dataProduct);

                            }
                            else if(dataAction == "без акции"){
                                $('input[name="form_hidden_17"]').val(dataAction);
                            }
                        }
                });
        });


        $(document).on("click", ".popup-container .popup-close", function(){
                $.fancybox.close();
        });

        $('form.classic select').customSelect();

        // Выбор цвета в карточке
        $( '.catalog-color-list img' ).click(

            function ()
            {
                $('img#basket_pic').attr('src',$(this).attr('data-pic_res'));
                $(this).parent().find( 'img' ).removeClass( 'active' );
                $( this ).addClass( 'active' );
            }

        );

        $( '.catalog-size-item' ).live('click', function ()
            {

                $(this).parent().find( '.catalog-size-item' ).removeClass( 'selected' );

                $( this ).addClass( 'selected' );

            }

        );

        /*-------------------------pluse minus--------------------*/
        $('.button-wrap a').live('click',function(e){
                e.preventDefault();
                var $input = $(this).parent('.button-wrap').find('input');
                var tempValue = parseInt($input.val());
                if ($(this).hasClass('link-pluse')) {tempValue = parseInt($input.val())+1;$input.val(tempValue);}
                if ($(this).hasClass('link-minus')) {
                    tempValue = parseInt($input.val());
                    if (tempValue <= 2) {
                        $input.val('1');
                    } else  {tempValue--; $input.val(tempValue); }}
        });


        /*------------------------auth/reg-----------------------------*/


        $('.auth_popup').live('click',function(){
                $.fancybox({
                        scrolling    : 'no',
                        'padding':0,
                        type        : 'ajax',
                        href        : '/ajax/auth_popup.php',
                        onUpdate    : function(){
                            $("#auth-form").live('submit',function(){
                                    $.ajax({
                                            type: "POST",
                                            url: "/ajax/auth.php",
                                            data: $('#auth-form').serialize(),
                                            success: function(data){
                                                $('#login-panel').html(data);
                                                if($('#login-panel').find('.popup-success').length > 0){
                                                    setTimeout(function(){location.replace("/personal/");}, 1000);
                                                }
                                            }
                                    });
                                    return false;
                            });


                            $("#forgot_form").live('submit',function(){
                                    $.ajax({
                                            type: "POST",
                                            url: "/ajax/forgot_passw.php",
                                            data: $('#forgot_form').serialize(),
                                            success: function(data){
                                                //alert(data);
                                                $('#login-panel').html(data);

                                            }
                                    });
                                    return false;
                            });


                            $("#reg-form").live('submit', function(){
                                    $.ajax({
                                            type: "POST",
                                            url: "/ajax/reg.php",
                                            data: {
                                                'login'    : $(this).find('#login').val()
                                            },
                                            error: function (data){
                                                console.log(data);
                                                alert('Ошибка соединения');
                                            },
                                            success: function(data){
                                                $('#reg-panel').html(data);
                                                if($('#reg-panel').find('.notetext').length > 0){

                                                    setTimeout(function(){location.replace("/personal/");}, 1000);
                                                }
                                            }
                                    });

                                    return false;
                            });
                        },
                        afterShow:function(){
                            $('a.fancybox-close').addClass('new-close');
                        }
                });
                return false;
        });

        /*--------------forgot passw-------------*/

        $('a#passw-link').live('click',function(){
                $.ajax({
                        type:"POST",
                        url:"/ajax/forgot_passw.php",
                        success:function(data){
                            $('#login-panel').html(data);                        
                        }
                })
        })
        $('a#auth-link').live('click',function(){
                $.ajax({
                        type:"POST",
                        url:"/ajax/auth.php",
                        success:function(data){
                            $('#login-panel').html(data);                        
                        }
                })
        })

        /*--------------my---*/

        $('.fancybox-link').fancybox({
                'padding':0,
                afterShow:function(){
                    $('a.fancybox-close').addClass('new-close');
                }
        });

        $('.login-reg .nav-l li a').live('click',function(e){
                e.preventDefault();
                if(!$(this).parent().hasClass('selected')) {
                    $(this).parent().parent().find('> li').each(function(){
                            $(this).removeClass('selected');
                    });    
                    $(this).parent().addClass('selected');    
                }
                $(this).parents('.login-reg').find('.tab-content-panels').each(function(){
                        $(this).removeClass('show');
                });
                $('.login-reg ' + $(this).attr('href')).addClass('show');
        });

        $('.header .dop-nav').hover(function(){
                $(this).addClass('active');
            },function(){
                $(this).removeClass('active');
        });

        /*list*/
        $('.list-color li a').live('click',function(e){
                e.preventDefault();
                $(this).parents('.list-color').find(' > li a').each(function(){
                        $(this).removeClass('active');
                });
                $(this).addClass('active');
        });

        $('.list-razmer li a').live('click',function(e){
                e.preventDefault();
                $(this).parents('.list-razmer').find(' > li a').each(function(){
                        $(this).removeClass('active');
                });
                $(this).addClass('active');
        });

        $('.list-prof .item-prof > a').click(function(e){
                e.preventDefault();
                if ($(this).parent().find('.content-prof').hasClass('active')) {
                    $(this).parent().find('.content-prof').slideUp(500).removeClass('active');
                } else {
                    $(this).parent().find('.content-prof').slideDown(500).addClass('active');
                }

        });

});