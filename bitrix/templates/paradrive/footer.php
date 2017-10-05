<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    IncludeTemplateLangFile(__FILE__);
?>
<?if(!DsFunc::IsHome() && !defined("NO_PAGE") || defined("ERROR_404")):?>
    </div>
    </div>
    <?endif?>
</div>
<?if($APPLICATION->GetCurPage()!='/personal/order/make/' ||( $APPLICATION->GetCurPage()=='/personal/order/make/' && $_REQUEST['ORDER_ID'] )):?>
	<?$APPLICATION->IncludeFile(
		SITE_DIR."include/popup.php",
		array(),
		array("MODE"=>"text")
	);?>
    <div class="footer">
        <?$APPLICATION->IncludeComponent("bitrix:main.include", 
                "",
                array(
                    "AREA_FILE_SHOW" => "sect",
                    "AREA_FILE_SUFFIX" => "bottom",
                    "AREA_FILE_RECURSIVE" => "Y",
                    "EDIT_TEMPLATE" => ""
                ),
                false
            );?>
        <div class="footer-bottom">
            <div class="footer-wrapper">
                <div class="bottom-menu">
                    <?$APPLICATION->IncludeComponent("bitrix:menu", 
                            "classic",
                            array(
                                "ROOT_MENU_TYPE" => "bottom", 
                                "MAX_LEVEL" => "1", 
                                "CHILD_MENU_TYPE" => "bottom", 
                                "USE_EXT" => "N",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "Y",
                                "MENU_CACHE_TYPE" => "N", 
                                "MENU_CACHE_TIME" => "3600", 
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => "" 
                            ),
                            false
                        );?>
                </div>
                <div class="social-links">
                    <div class="social-caption"><?=GetMessage("SOCIAL")?></div>
                    <div class="social-icons">
                        <?$APPLICATION->IncludeFile(
                                SITE_DIR."include/social.php",
                                array(),
                                array("MODE"=>"text")
                            );?>
                    </div>
                </div>
                <div class="company-logo">
                    <a href="/" title="Аэромаркет ParaDrive">
                        <img src="<?=SITE_TEMPLATE_PATH?>/images/logotype-small.png" alt="Аэромаркет ParaDrive" title="Аэромаркет ParaDrive" />
                    </a>
                </div>
                <div class="copyright">
                    <?$APPLICATION->IncludeFile(
                            SITE_DIR."include/copyright.php",
                            array(),
                            array("MODE"=>"text")
                        );?>
                </div>
            </div>
        </div>
    </div>
    <?endif;?>
</div>
<?$path = explode('/',$APPLICATION->GetCurPage());?>
<script type="text/javascript">
    $(document).ready(function(){
            var menu = false;
            $('.main-menu li.top-item').each(function(n, el){
                    var str = $(el).find('a').attr('href');
                    var pos = str.indexOf('/<?=$path[1]?>/');
                    if(!pos){
                        $(el).addClass('active-menu');
                        menu = true;
                    }
            });
            if(!menu){
                $('.list-nav li').each(function(n, el){
                        var str = $(el).find('a').attr('href');

                        if(typeof(str)!=='undefined') 
                            { var pos = str.indexOf('/<?=$path[1]?>/');
                            if(!pos){
                                $('div.dop-nav a.more').addClass('active-menu');
                            }
                        }
                })
            }

    })
</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    var yaParams = {/*Здесь параметры визита*/};
</script>

<script type="text/javascript">
    (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                    try {
                        w.yaCounter10125886 = new Ya.Metrika({id:10125886,
                                webvisor:true,
                                clickmap:true,
                                trackLinks:true,
                                accurateTrackBounce:true,params:window.yaParams||{ }});
                    } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/10125886" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->


    <script type="text/javascript">
	var _gaq = _gaq || [];
        $('body').activity({
                'achieveTime':60
                ,'testPeriod':10
                ,useMultiMode: 1
                ,callBack: function (e) {
                    _gaq.push(['_trackEvent', 'Activity', '60 seconds', '60 seconds']);
                    yaCounter10125886.reachGoal('60_sec');
                }
        });
    </script>

<!-- Rating@Mail.ru counter -->
<script type="text/javascript">
    var _tmr = _tmr || [];
    _tmr.push({id: "2540442",  type: "pageView", start: (new Date()).getTime()});
    (function (d, w) {
            var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true;
            ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";
            var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
            if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
    })(document, window);
</script><noscript><div style="position:absolute;left:-10000px;">
        <img src="//top-fwz1.mail.ru/counter?id=2540442;js=na" style="border:0;" height="1" width="1" alt="Рейтинг@Mail.ru" />
    </div></noscript>
<!-- //Rating@Mail.ru counter -->

<!-- Код vk -->

<script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=TMtH06pspCKwkQ1iCtu8AJGOBEXu/CrBLdGURKiHwiSem2V*O*lfXmm6aNYXLVGJ*DJ2czEEPSwrndo7aJ2VbX6erkXmvicE4kBG7X4Xxh4GAogmaVqIBzbHkvOYUK*8YWyxLLXEqj5jw0o1ZvcMB93AJc8XcUFUqr8piHXZb*o-';</script>





<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
    (function(){ var widget_id = '115695';
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script>
<!-- {/literal} END JIVOSITE CODE -->



</body>
</html>