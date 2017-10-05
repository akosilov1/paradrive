/**
 * Created by Дмитрий on 06.10.2016.
 */
$(window).load(function () {
//$(document).ready(function () {

    var LS_KEY = 'modal_shown';
	//localStorage.setItem(LS_KEY, '');

    //showOverlay();
	
	$("#news_popup_form").submit(function(event){
		event.preventDefault();
		
		var strName = $("#news_popup_form_name").val();
			strEmail = $("#news_popup_form_email").val();
			intError = 0;
			
		if(!strName){
			$("#news_popup_form_name").css({"border-color": "red"});
			intError++;
		}
		if(!strEmail){
			$("#news_popup_form_email").css({"border-color": "red"});
			intError++;
		}
		
		if(intError == 0){
			$.ajax({
				url: '/ajax/popup_justclick.php',
				type: "POST",
				data: {name: strName, email: strEmail},
				dataType: "text",
				success: function(data){
					if(data == "0"){
						_gaq.push(['_trackEvent', 'Subscribe_success', 'Subscribe_success' ]);
						window.yaCounter10125886.reachGoal('Subscribe_success');
						$('#news_popup_message').html("<img style='padding-bottom: 30px;' src='/img/konvert.png'><br><p><b style='color:black;'>Отлично! Для получения книги необходимо подтвердить подписку на наши статьи. Проверьте Вашу почту.</b></p><p>Если письмо не пришло, проверьте папку со спамом и добавьте наш e-mail в список контактов.</p>");
					}else if(data == "4"){
						$('#news_popup_message').html("Заполните, пожалуйста, все поля");
					}else{
						switch(data) {
						  case "100":
							$('#news_popup_message').html("В переданных параметрах отсутствует e-mail контакта");
							break
						  case "101":
							$('#news_popup_message').html("Ошибка добавления пользователя в группу");
							break
						  case "102":
							$('#news_popup_message').html("Контакт уже есть во всех переданных группах");
							break
						  case "103":
							$('#news_popup_message').html("В запросе передана несуществующая группа");
							break
						  case "104":
							$('#news_popup_message').html("Добавление в эту группу невозможно. Например автогруппа.");
							break
						}
					}
					
					$('#news_popup_message').append("<div style='text-align: left;'>Окно закроется через <span id='close_timer'></span> секунд</div>");
					
					$('.news_popup_message').css({"top": $(window).height()/2-122});
					$('.pop-up1').fadeOut();
					$('.popUp-overlay').fadeIn();
					$('.news_popup_message').fadeIn();
					$('html').removeClass("html_noscroll");
					
					var i = 10;
					(function() {
						if(i > 0){
							$("#close_timer").html(i);
							i--;
							setTimeout(arguments.callee, 1000);
						}else{
							$('.popUp-overlay').fadeOut();
							$('.news_popup_message').fadeOut();
							$('body').css('overflow-y', 'scroll');
						} 
					})();
				}
			});
		}else{
			$("#fields_are_empty").show();
		}
	});
	
	$("#action_close_book").click(function(){
		_gaq.push(['_trackEvent', 'Subscribe_canсel', 'Subscribe_canсel' ]);
		window.yaCounter10125886.reachGoal('Subscribe_canсel');
	});
	$('.popUp-overlay').click(function(){
		if($('.pop-up1').is(":visible")){
			_gaq.push(['_trackEvent', 'Subscribe_canсel', 'Subscribe_canсel' ]);
			window.yaCounter10125886.reachGoal('Subscribe_canсel');
		}
	});
	
    $('.closeModal').click(function () {
        $('.popUp-overlay').fadeOut();
        $('.pop-up1').fadeOut();
        hideOverlay();
    })

    $(this).keydown(function(eventObject){
        if (eventObject.which == 27){
			if($('.pop-up1').is(":visible")){
				_gaq.push(['_trackEvent', 'Subscribe_canсel', 'Subscribe_canсel' ]);
				window.yaCounter10125886.reachGoal('Subscribe_canсel');
			}
			hideOverlay();
		}
    });

    function hideOverlay(){
		$('.popUp-overlay').fadeOut();
        $('.pop-up1').fadeOut();
        //$('html').css('overflow-y', 'visible');
		$('html').removeClass("html_noscroll");
    }

    function showOverlay(){
		if (!localStorage.getItem(LS_KEY)){
			_gaq.push(['_trackEvent', 'Show_subscribe_popup', 'Show_subscribe_popup' ]);
			window.yaCounter10125886.reachGoal('Show_subscribe_popup');
			localStorage.setItem(LS_KEY, '1');
            setTimeout(function () {
				$('.popUp-overlay').fadeIn();
                $('.pop-up1').fadeIn();
                //$('html').css('overflow-y', 'hidden');
				$('html').addClass("html_noscroll");
            }, 15000);
        }else{
            console.log('окно уже открывалось');
        }

    }

    $('body').click(function () {
        hideOverlay();
    })
    $('.pop-up1').click(function (e) {
        e.stopPropagation();
    })

    $(window).resize(function () {
        if (window.innerHeight < 615){
            $('.pop-up1')
                .css('top', 15)
                .css('margin-top', 0);
        }else{
            $('.pop-up1')
                .css('top', '50%')
                .css('margin-top', -300);
        }
    })

})