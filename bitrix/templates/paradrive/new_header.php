<?define("PATH_TO_404", "/404.php");?>
<!DOCTYPE html>
<html>
<head>
    <title><?$APPLICATION->ShowTitle()?></title>
    <?
        $APPLICATION->ShowHead();
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/fonts/styles.css");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/scripts/libs/jquery-1.8.3.js");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/scripts/libs/browser-selector-1.0.0.js");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/scripts/libs/suppress-2.0.0.js");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/scripts/libs/mousewheel-3.0.6.js");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/scripts/libs/serialize-object.js");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/scripts/libs/jquery.maskedinput.min.js");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/scripts/plugins/timer/timer-1.5.2.js");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/scripts/plugins/fancybox/jquery.fancybox.pack.js");
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/scripts/plugins/fancybox/jquery.fancybox.css");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/scripts/plugins/customselect/customselect.js");
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/scripts/plugins/customselect/styles.css");
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/scripts/main.js");
    ?>

    <link href="https://dadata.ru/static/css/suggestions.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="https://dadata.ru/static//js/jquery.autocomplete-1.2.4.min.js"></script>
    <link rel="shortcut icon" href="favicon.ico">

</head>
<body>
<?$APPLICATION->ShowPanel();?>

<div class="main-container">
<?if($APPLICATION->GetCurPage()!='/personal/order/make/' ||( $APPLICATION->GetCurPage()=='/personal/order/make/' && $_REQUEST['ORDER_ID'] )):?>
    <div class="top-nav-wrap">
        <div class="top-nav">
            <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "top_menu",
                    Array(
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
                );?>
            <div class="right-element">
                <?global $USER;
                    if($USER->IsAuthorized()):?>
                    <a href="<?=SITE_DIR?>personal/"><i></i><?if($USER->GetFullName()): echo $USER->GetFullName(); else: echo $USER->GetLogin();  endif;?></a>           
                    <a class="logout" href="?logout=yes">Выход</a>   
                    <?else:?>
                    <a href="#lg-form" class="auth_popup"><i></i>Личный кабинет</a>
                    <?endif;?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <?endif;?>
<div class="header">

    <div class="company">
        <div class="company-logo">
            <a href="/" title="Аэромаркет ParaDrive">
                <img src="<?=SITE_TEMPLATE_PATH?>/images/logotype.png" alt="Аэромаркет ParaDrive" title="Аэромаркет ParaDrive" />
            </a>
        </div>
        <div class="company-name">
            <?$APPLICATION->IncludeFile(
                    SITE_DIR."include/company-name.php",
                    array(),
                    array("MODE"=>"text")
                );?>
        </div>
        <div class="company-sign">
            <?$APPLICATION->IncludeFile(
                    SITE_DIR."include/company-sign.php",
                    array(),
                    array("MODE"=>"text")
                );?>
        </div>
    </div>

    <div id="small-basket">
        <?$APPLICATION->IncludeComponent(
                "bitrix:sale.basket.basket.small",
                "small_cart",
                Array(
                    "PATH_TO_BASKET" => "/personal/cart/",
                    "PATH_TO_ORDER" => "/personal/order/make/",
                    "SHOW_DELAY" => "Y",
                    "SHOW_NOTAVAIL" => "Y",
                    "SHOW_SUBSCRIBE" => "Y"
                )
            );?>
    </div>

    <!--div id="small-basket">
    <div class="basket-button active">
    <div class="b-a"><i class="bsk"></i><div class="red-round">8</div><i class="line-vert"></i>
    <span>корзина на сумму</span>
    <span class="price"><i>80 300</i>руб.</span>
    <span><a href="#">Оформить заказ</a></span>
    </div>
    </div>    

    </div-->

    <div class="contacts-info">
        <div class="big-phone"><span><a href="#" class="fancybox-link" >
                <?$APPLICATION->IncludeFile(
                        SITE_DIR."include/phone.php",
                        array(),
                        array("MODE"=>"text")
                    );?>

            </a><span class="w-tol"><span><a href="#call-back" class="popup-form-button" data-form="1" data-action="без акции" data-loc="header" onclick="_gaq.push(['_trackEvent', 'Zvonok_header', 'Zvonok_header' ]); yaCounter10125886.reachGoal('Zvonok_header'); return true;">Заказать звонок</a></span></span></span></div>
        <span class="contact-email">zakaz@paradrive.ru</span>
        <p class="adress">
            Москва, метро Полежаевская<br>
            Хорошевское шоссе 84, корп 4, офис 5, <br>
            Пн-Пт с 10:00 до 19:00<br>
        </p>
    </div>
    <!-- <div class="contacts">
    <div class="contacts-phone" style="text-align: left;">
    <?$APPLICATION->IncludeFile(
            SITE_DIR."include/contacts-phone.php",
            array(),
            array("MODE"=>"text")
        );?>
    </div>
    <div class="contacts-email">
    <?$APPLICATION->IncludeFile(
            SITE_DIR."include/contacts-email.php",
            array(),
            array("MODE"=>"text")
        );?>
    </div>
    </div>-->
    <!--  <div class="call-back">
    <div class="call-back-info">
    <?$APPLICATION->IncludeFile(
            SITE_DIR."include/call-back-info.php",
            array(),
            array("MODE"=>"text")
        );?>
    </div>
    <div class="call-back-sign">
    <?$APPLICATION->IncludeFile(
            SITE_DIR."include/call-back-sign.php",
            array(),
            array("MODE"=>"text")
        );?>
    </div>
    <a href="#call-back" class="button silver popup-form-button" data-form="1" data-action="без акции">Заказать звонок</a>
    </div>
    -->
    <?if($APPLICATION->GetCurPage()!='/personal/order/make/' ||( $APPLICATION->GetCurPage()=='/personal/order/make/' && $_REQUEST['ORDER_ID'] )):?>
        <div class="main-menu">
            <?$APPLICATION->IncludeFile(
                    SITE_DIR."include/main-menu.php",
                    array(),
                    array("MODE"=>"text")
                );?>

            <div class="dop-nav">
                <a href="#">&bull;&bull;&bull;</a>
                <div class="list-nav">
                    <?$APPLICATION->IncludeFile(
                            SITE_DIR."include/dop-menu.php",
                            array(),
                            array("MODE"=>"text")
                        );?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <?endif;?>

</div>
<div class="content">
<?if(!DsFunc::IsHome() && $APPLICATION->GetCurPage()!='/personal/order/make/' ||( $APPLICATION->GetCurPage()=='/personal/order/make/' && $_REQUEST['ORDER_ID'] )):?>
    <? 
        $APPLICATION->IncludeComponent("bitrix:breadcrumb", 
            "classic", 
            array(
                "START_FROM" => "0",
                "PATH" => "",   
                "SITE_ID" => "s1",
            ),
            false,
            array(
                "HIDE_ICONS" => "Y"
            )
        );?>
    <?endif?>
<?if(!DsFunc::IsHome() && !defined("NO_PAGE") || defined("ERROR_404")):?>
    <div class="page clearfix <?if(defined('BASKET')):?>basket-style<?endif;?>"> 
    <?$APPLICATION->IncludeComponent(
            "bitrix:main.include", 
            "sidebar-left",
            array(
                "AREA_FILE_SHOW" => "sect",
                "AREA_FILE_SUFFIX" => "sidebar_left",
                "AREA_FILE_RECURSIVE" => "N",
                "EDIT_TEMPLATE" => ""
            ),
            false,
            array(
                "HIDE_ICONS"=>"Y"
            )
        );?>
    <?$APPLICATION->IncludeComponent(
            "bitrix:main.include", 
            "sidebar-right", 
            array(
                "AREA_FILE_SHOW" => "sect",
                "AREA_FILE_SUFFIX" => "sidebar_right",
                "AREA_FILE_RECURSIVE" => "N",
                "EDIT_TEMPLATE" => ""
            ),
            false,
            array(
                "HIDE_ICONS"=>"Y"
            )
        );?>
    <div class="middle-content">
    <h1 <?if ($APPLICATION->GetCurDir() == '/personal/cart/'){?>style="position: relative;
            top: 25px;
            left: 30px;"<?}?>><?$APPLICATION->ShowTitle(false)?></h1>
    <?elseif(defined("TITLE_SHOW")):?>
    <h1 class="border-bottom uppercase"><?$APPLICATION->ShowTitle(false)?></h1>
    <?endif?>