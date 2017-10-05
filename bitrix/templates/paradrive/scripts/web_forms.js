function submitForms(form,button){
    var form_id = $(button).data('form');
    $(form).off('submit');
    $(form).on('submit',function(){
            var bOk = true;
			var $form = $(this);
            $form.find('div.text-field.requaried').each(function(index, elem){
                    if ($(elem).find('input').val().trim() == ''){
                        $(elem).find('span.name').css({'color':'red'});
                        bOk = false;
                    }else{
                        $(elem).find('span.name').css({'color':''});
                    }
            })
			var test = /^\+7[0-9\x20\x28\x29\-]{5,20}$/.test($form.find('div.text-field.phone input').val());
            if(test === false){//$('div.text-field.phone input').val().match(/^\+7[0-9\x20\x28\x29\-]{5,20}$/
                bOk = false;
                $('div.text-field.phone span.name').css({'color':'red'});
            }
            if (!bOk)
                return false;
            var subm = "&web_form_submit="+$('input[name="web_form_submit"]').val();
            $.ajax({
                    type: "POST",
                    url: "/ajax/one_click_wf.php?id=" + form_id,
                    data: $(this).serialize()+subm,
                    beforeSend :function(){
                        $('div#wf').html('<div class="wrapper-text-field">Данные отправляются...</div>');
                        $.colorbox.resize();
                    },
                    success: function(data){
                        console.log(data);
                        $('div#wf').html('<div class="wrapper-text-field"><p>Спасибо, ваша заявка принята!</p><p>Наши менеджеры в скором времени свяжутся с вами.</p></div>');
                        $.colorbox.resize();
                    }
            });
            return false;
    });
}

$(document).ready(function(){
        // $('.quote-product').off('click');
        // $('.cost-product').off('click');




        $('.quote-product').on( "click",function(e){ 
                // console.log(this);
                e.preventDefault();
                var selSize;
                if(!$(this).hasClass('kompl'))
                    { 
                    selSize = $('.catalog-detail-info .catalog-size-item.selected .catalog-size-value').data('size');
                }

                var selColor = $('.catalog-detail-info .color-item.active').attr('id');
                var $btn = $(this);
                var prod_id = $btn.data('id');
                var loc = $btn.data('loc'); 
                var link = $btn.data('link');
                
                $(this).colorbox({
                        href:   link,
                        opacity:0.6,
                        close:  'x',
                        open:   true, 
                        data: {
                            prod_id:prod_id,
                            selColor:selColor,
                            selSize:selSize,
                        },
                        onOpen:function(){ console.log('onOpen: colorbox is about to open'); },
                        onLoad:function(){ console.log('onLoad: colorbox has started to load the targeted content'); },
                        onComplete:function(){
                            $('select.custom2').customSelect();
                            $('div.delivery input').val($('[data-type="delivery"]').parent().find('span.customSelectInner').text());
                            $('div.paysystem input').val($('[data-type="paysystem"]').parent().find('span.customSelectInner').text());
                            $('.order-one-click form').attr('data-loc',loc);
                            $.colorbox.resize(); 
                            submitForms('form[name="ONE_CLICK_ORDER"]',$btn);
                        },
                });
                //submitForms('form[name="ONE_CLICK_ORDER"]',this);
        });
setTimeout(prodEvents, 500);
function prodEvents(){
    $('.cost-product').on( "click",function(){
                //   webFormsAjax('form[name="REQUEST_QUOTE_PRODUCT"]','/ajax/cost_product.php',this,40);
                var selSize;
                if(!$(this).hasClass('kompl'))
                    { 
                    selSize = $('.catalog-detail-info .catalog-size-item.selected .catalog-size-value').attr('data-size');
                }
                var selColor = '';
                if(!$(this).hasClass('kompl'))
                    {
                    selColor =  $('.catalog-detail-info .color-item.active').attr('id');
                }
                var prod_id = $(this).attr('data-id');  
                var loc = $(this).attr('data-loc'); 
                var link2=$(this).attr('data-link');
                var $btn = $(this);
                $(this).colorbox({
                        opacity:0.6,
                        href:link2,
                        close:'x',
                        open:true,
                        data: {
                            prod_id:prod_id,
                            selColor:selColor,
                            selSize:selSize,
                        },
                        onComplete:function(){
                            $('select.custom2').customSelect();
                            $('.order-one-click form').attr('data-loc',loc);
                            $.colorbox.resize(); 
                            submitForms('form[name="REQUEST_QUOTE_PRODUCT"]',$btn);  
                        },
                });     
                //submitForms('form[name="REQUEST_QUOTE_PRODUCT"]',this);  
        });
}
        
        $('.callback').click(function(){
                var loc = $(this).attr('data-loc');
                $btn = $(this);
                $(this).colorbox({
                        opacity:0.6,
                        close:'x',
                        onComplete:function(){
                            submitForms('form[name="CALL_BACK"]',$btn);
                            $('.order-one-click form').attr('data-loc',loc);  
                        },
                });

                // webFormsAjax('form[name="CALL_BACK"]','/ajax/callback.php',this,0);
                //submitForms('form[name="CALL_BACK"]',this);
        });

        $('form[name=begin_subs]').on('submit',function(){

                var bOk = true; var subscribe = false;
                var input = $(this).find('input');

                $(input).each(function(index, elem){
                        if ($(elem).val().trim() == ''){
                            $(elem).css({'border-color':'red'});
                            bOk = false;

                        }else{
                            $(elem).css({'border-color':''});
                        }
                })

                if(!$(this).find('input[name=email]').val().match(/^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i) ){
                    bOk = false;
                    $(this).find('input[name=email]').css({'border-color':'red'});
                }

                if (!bOk)
                    return false;

                $.ajax({
                        type:"POST",
                        url:"/ajax/justclick.php",
                        data: $(this).serialize(),
                        success: function(data){
                            try{
                            yaCounter10125886.reachGoal('begin_subs');
                            console.log('suc');    
                            }  catch(e){
                                console.log(e);
                            }
                            
                            $('div.email_sbor_form_2').html('<p class="suc">Спасибо за подписку! Теперь проверьте электронную почту и подтвердите свое согласие получать от нас письма.</p>');
                        }
                });
                return false;
        });
})