<?define("PATH_TO_404", "/404.php"); ?>
<!DOCTYPE html>
<html lang="ru">
    <head>
	<?echo '<meta http-equiv="Content-Type" content="text/html; charset='.LANG_CHARSET.'"'.(false? ' /':'').'>'."\n";?>
        <title><? $APPLICATION->ShowTitle() ?></title>
		<?
		$APPLICATION->ShowMeta("robots", false, false);
		$APPLICATION->ShowMeta("keywords", false, false);
		$APPLICATION->ShowMeta("description", false, false);
		?>
        <? if ($_REQUEST['PAGEN_1']): ?><link rel="canonical" href="http://www.paradrive.ru<?= $APPLICATION->GetCurDir() ?>"/><? endif; ?>
        <? if ($_REQUEST['PAGEN_1']): ?>
            <meta name="robots" content="noindex, follow"/>
        <? else: ?>
            <meta name="robots" content="index, follow"/>
        <? endif; ?>
 <link rel="shortcut icon" href="/favicon.ico">

        <?
		//Тут канонический url
		$APPLICATION->ShowLink("canonical", null, false);
      //  $APPLICATION->ShowHead();
		
		//Тут стили шаблона сайта
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/fonts/styles.css");
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/pop-up.css");
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/scripts/plugins/fancybox/jquery.fancybox.css");
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/scripts/plugins/customselect/styles.css");
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/scripts/plugins/colorbox/colorbox.css");

		//Тут выводим стили
		$APPLICATION->ShowCSS(true, false);
		
		//Тут скрипты
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/scripts/libs/jquery-1.8.3.min.js");//
		//$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/scripts/pop-up.script.js");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/scripts/web_forms.js");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/scripts/libs/browser-selector-1.0.0.js");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/scripts/libs/suppress-2.0.0.js");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/scripts/libs/mousewheel-3.0.6.js");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/scripts/libs/serialize-object.js");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/scripts/libs/jquery.maskedinput.min.js");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/scripts/libs/jquery.activity.min.js");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/scripts/plugins/timer/timer-1.5.2.js");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/scripts/plugins/fancybox/jquery.fancybox.pack.js");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/scripts/plugins/colorbox/jquery.colorbox-min.js");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/scripts/plugins/customselect/customselect.js");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/scripts/main.js");
       
	   //Тут выводим скрипты
		$APPLICATION->ShowHeadStrings();
		$APPLICATION->ShowHeadScripts();
	   ?>

       




        <script type="text/javascript">
          /*  (function (w, d, e) {
                var a = 'all', b = 'tou';
                var src = b + 'c' + 'h';
                src = 'm' + 'o' + 'd.c' + a + src;
                var jsHost = (("https:" == d.location.protocol) ? "https://" : "http://") + src;
                s = d.createElement(e);
                p = d.getElementsByTagName(e)[0];
                s.async = 1;
                s.src = jsHost + "." + "r" + "u/d_client.js?param;ref" + escape(d.referrer) + ";url" + escape(d.URL) + ";cook" + escape(d.cookie) + ";";
                if (!w.jQuery) {
                    jq = d.createElement(e);
                    jq.src = jsHost + "." + "r" + 'u/js/jquery-1.5.1.min.js';
                    p.parentNode.insertBefore(jq, p);
                }
                p.parentNode.insertBefore(s, p);
            }(window, document, 'script'));  */
        </script>

        

    </head>
    <body>
	<!-- zmirk -->
        <!-- Код google -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-25164631-2', 'auto');
  ga('send', 'pageview');

</script>
                    <? $APPLICATION->ShowPanel(); ?>

        <div class="main-container">
                    <? if ($APPLICATION->GetCurPage() != '/personal/order/make/' || ( $APPLICATION->GetCurPage() == '/personal/order/make/' && $_REQUEST['ORDER_ID'] )): ?>
                <div class="top-nav-wrap">
                    <div class="top-nav">
                        <?
                        $APPLICATION->IncludeComponent(
                                "bitrix:menu", "top_menu", Array(
                            "ROOT_MENU_TYPE" => "top",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "left",
                            "USE_EXT" => "N",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => ""
                                )
                        );
                        ?>
    <? Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("right-element"); ?>
                        <div class="right-element">
                <? global $USER;
                if ($USER->IsAuthorized()):
                    ?>
                                <a href="<?= SITE_DIR ?>personal/"><i></i><? if ($USER->GetFullName()): echo $USER->GetFullName();
            else: echo $USER->GetLogin();
            endif; ?></a>           
                                <a class="logout" href="?logout=yes">Выход</a>   
    <? else: ?>
                                <a href="#lg-form" class="auth_popup"><i></i>Личный кабинет</a>
    <? endif; ?>
                        </div>
                            <? Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("right-element", "Загрузка..."); ?>
                        <div class="clear"></div>
                    </div>
                </div>
                        <? endif; ?>
            <div class="header">

                <div class="company">
                    <div class="company-logo">
                        <a href="/" title="Аэромаркет ParaDrive">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/logotype.png" alt="Аэромаркет ParaDrive" title="Аэромаркет ParaDrive" />
                        </a>
                    </div>
                    <div class="company-name">
<?
$APPLICATION->IncludeFile(
        SITE_DIR . "include/company-name.php", array(), array("MODE" => "text")
);
?>
                    </div>
                    <div class="company-sign">
                    <?
                    $APPLICATION->IncludeFile(
                            SITE_DIR . "include/company-sign.php", array(), array("MODE" => "text")
                    );
                    ?>
                    </div>
                </div>

                <div id="small-basket">
                                <?
                                $APPLICATION->IncludeComponent(
                                        "bitrix:sale.basket.basket.small", "small_cart", Array(
                                    "PATH_TO_BASKET" => "/personal/cart/",
                                    "PATH_TO_ORDER" => "/personal/order/make/",
                                    "SHOW_DELAY" => "Y",
                                    "SHOW_NOTAVAIL" => "Y",
                                    "SHOW_SUBSCRIBE" => "Y"
                                        )
                                );
                                ?>
                </div>
                <div class="contacts-info">
                <? $arContactP = explode('/', $APPLICATION->GetCurDir());?>
                    <div class="big-phone"><span><a href="/ajax/callback.php" class="callback" rel="nofollow" data-form="1" data-action="без акции" data-loc="header" onclick="_gaq.push(['_trackEvent', 'Zvonok_header', 'Zvonok_header']);
                            yaCounter10125886.reachGoal('Zvonok_header');
                            return true;">
                        <?
                       
                        if (count($arContactP) == 4 && $arContactP[1] == "contacts") {
                             $APPLICATION->IncludeFile(
                                SITE_DIR . "include/fil_phone.php", array(), array("MODE" => "text")
                        );
                                                    }
                        else{
                            $APPLICATION->IncludeFile(
                                SITE_DIR . "include/phone.php", array(), array("MODE" => "text")
                        ); 
                        } 
                       
                        ?>

                            </a><span class="w-tol"><span><a href="/ajax/callback.php" class="callback" rel="nofollow" data-form="1" data-action="без акции" data-loc="header" onclick="_gaq.push(['_trackEvent', 'Zvonok_header', 'Zvonok_header']);
                                    yaCounter10125886.reachGoal('Zvonok_header');
                                    return true;">Заказать звонок</a></span></span></span></div>
                    <span class="contact-email">zakaz@paradrive.ru</span>
                    <div class="adress">

                        <?
                       
                        if (count($arContactP) == 4 && $arContactP[1] == "contacts") {
                            $APPLICATION->IncludeComponent(
                                    "bitrix:main.include", "", Array(
                                "AREA_FILE_SHOW" => "sect",
                                "AREA_FILE_SUFFIX" => "contact",
                                "AREA_FILE_RECURSIVE" => "Y",
                                "EDIT_TEMPLATE" => ""
                                    ), false
                            );
                        } else {
                            $APPLICATION->IncludeFile(
                                    SITE_DIR . "include/address.php", array(), array("MODE" => "html")
                            );
                        }
                        ?>
                    </div>
                </div>

                            <? if ($APPLICATION->GetCurPage() != '/personal/order/make/' || ( $APPLICATION->GetCurPage() == '/personal/order/make/' && $_REQUEST['ORDER_ID'] )): ?>
                    <div class="main-menu">
                                <?
                                $APPLICATION->IncludeFile(
                                        SITE_DIR . "include/main-menu.php", array(), array("MODE" => "text")
                                );
                                ?>

                        <div class="dop-nav">
                            <a class="more" href="#">ЕЩЕ</a>
                            <div class="list-nav">
    <?
    $APPLICATION->IncludeFile(
            SITE_DIR . "include/dop-menu.php", array(), array("MODE" => "text")
    );
    ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                <? endif; ?>

            </div>
            <div class="content">
                <? if (!DsFunc::IsHome() && $APPLICATION->GetCurPage() != '/personal/order/make/' || ( $APPLICATION->GetCurPage() == '/personal/order/make/' && $_REQUEST['ORDER_ID'] )): ?>
                    <?
                    $APPLICATION->IncludeComponent("bitrix:breadcrumb", "classic", array(
                        "START_FROM" => "0",
                        "PATH" => "",
                        "SITE_ID" => "s1",
                            ), false, array(
                        "HIDE_ICONS" => "Y"
                            )
                    );
                    ?>
                    <? endif ?>
                    <? if (!DsFunc::IsHome() && !defined("NO_PAGE") || defined("ERROR_404")): ?>
                    <div class="page clearfix <? if (defined('BASKET')): ?>basket-style<? endif; ?>"> 
                        <?
                        $APPLICATION->IncludeComponent(
                                "bitrix:main.include", "sidebar-left", array(
                            "AREA_FILE_SHOW" => "sect",
                            "AREA_FILE_SUFFIX" => "sidebar_left",
                            "AREA_FILE_RECURSIVE" => "N",
                            "EDIT_TEMPLATE" => ""
                                ), false, array(
                            "HIDE_ICONS" => "Y"
                                )
                        );
                        ?>
                        <?
                        $APPLICATION->IncludeComponent(
                                "bitrix:main.include", "sidebar-right", array(
                            "AREA_FILE_SHOW" => "sect",
                            "AREA_FILE_SUFFIX" => "sidebar_right",
                            "AREA_FILE_RECURSIVE" => "N",
                            "EDIT_TEMPLATE" => ""
                                ), false, array(
                            "HIDE_ICONS" => "Y"
                                )
                        );
                        ?>
                        <div class="middle-content">
                            <h1 <? if ($APPLICATION->GetCurDir() == '/personal/cart/') { ?>style="position: relative;
                                                                                            top: 25px;
                                                                                            left: 30px;"<? } ?>><? $APPLICATION->ShowTitle(false) ?></h1>
<? elseif (defined("TITLE_SHOW")): ?>
                            <h1 class="border-bottom uppercase"><? $APPLICATION->ShowTitle(false) ?></h1>
    <?
endif?>