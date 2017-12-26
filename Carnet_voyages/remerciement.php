
<?php
include_once('../../../wp-config.php');
include_once('../../../wp-load.php');
include_once('../../../wp-includes/wp-db.php');
global $wpdb;
global $current_user;
get_currentuserinfo();
$user = $current_user->user_login;
$user=$current_user->user_firstname.' '.$current_user->user_lastname  ;

?>
<?php 
      
          $var = explode('wp-content', content_url());
    
      ?>
<!DOCTYPE html>
<html itemscope="itemscope" itemtype="http://schema.org/WebPage" xmlns="http://www.w3.org/1999/xhtml" lang="fr-FR">
            
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
          <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
          <meta name="format-detection" content="telephone=no">
        <title itemprop="name">
       Merci ! </title>
        <link rel="shortcut icon" href="../wp-content/themes/jupiter/images/favicon.png"  />
        <link rel="alternate" type="application/rss+xml" title="Le blog de Nomade Aventure &#8211; Nomade&#039;s land RSS Feed" href="<?php echo $var[0 ].'feed/';?>">
        <link rel="alternate" type="application/atom+xml" title="Le blog de Nomade Aventure &#8211; Nomade&#039;s land Atom Feed" href="<?php echo $var[0 ].'feed/atom/';?>">
        <link rel="pingback" href="<?php echo $var[0 ].'xmlrpc.php';?>">

         <!--[if lt IE 9]>
         <script src="<?php echo $var[0 ].'wp-content/themes/jupiter/js/html5shiv.js';?>" type="text/javascript"></script>
         <link rel='stylesheet' href='<?php echo $var[0 ].'wp-content/themes/jupiter/stylesheet/css/ie.css';?>' /> 
         <![endif]-->
         <!--[if IE 7 ]>
               <link href="<?php echo $var[0 ].'wp-content/themes/jupiter/stylesheet/css/ie7.css';?>" media="screen" rel="stylesheet" type="text/css" />
               <![endif]-->
         <!--[if IE 8 ]>
               <link href="<?php echo $var[0 ].'wp-content/themes/jupiter/stylesheet/css/ie8.css';?>" media="screen" rel="stylesheet" type="text/css" />
         <![endif]-->

         <!--[if lte IE 8]>
            <script type="text/javascript" src="<?php echo $var[0 ].'wp-content/themes/jupiter/js/respond.js';?>"></script>
         <![endif]-->

         
         <script type="text/javascript">
          var mk_header_parallax, mk_banner_parallax, mk_page_parallax, mk_footer_parallax, mk_body_parallax;
          var mk_images_dir = "<?php echo $var[0 ].'wp-content/themes/jupiter/images';?>",
          mk_theme_js_path = "<?php echo $var[0 ].'wp-content/themes/jupiter/js';?>",
          mk_responsive_nav_width = 1140,
          mk_grid_width = 1140,
          mk_ajax_search_option = "fullscreen_search",
          mk_preloader_txt_color = "#444",
          mk_preloader_bg_color = "#fff",
          mk_accent_color = "#f97352",
          mk_preloader_bar_color = "#f97352",
          mk_preloader_logo = "";
          var mk_header_parallax = false,
          mk_banner_parallax = false,
          mk_page_parallax = false,
          mk_footer_parallax = false,
          mk_body_parallax = false,
          mk_no_more_posts = "No More Posts";
                    
          function is_touch_device() {
              return ('ontouchstart' in document.documentElement);
          }
          
         </script>
    <script type="text/javascript">var ajaxurl = "<?php echo $var[0 ].'wp-admin/admin-ajax.php';?>"</script><link rel='dns-prefetch' href='//fonts.googleapis.com' />

		<script type="text/javascript">
			window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/2\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/2\/svg\/","svgExt":".svg","source":{"concatemoji":"http:\/\/localhost\/cdv\/wp-includes\/js\/wp-emoji-release.min.js?ver=4.6.6"}};
			!function(a,b,c){function d(a){var c,d,e,f,g,h=b.createElement("canvas"),i=h.getContext&&h.getContext("2d"),j=String.fromCharCode;if(!i||!i.fillText)return!1;switch(i.textBaseline="top",i.font="600 32px Arial",a){case"flag":return i.fillText(j(55356,56806,55356,56826),0,0),!(h.toDataURL().length<3e3)&&(i.clearRect(0,0,h.width,h.height),i.fillText(j(55356,57331,65039,8205,55356,57096),0,0),c=h.toDataURL(),i.clearRect(0,0,h.width,h.height),i.fillText(j(55356,57331,55356,57096),0,0),d=h.toDataURL(),c!==d);case"diversity":return i.fillText(j(55356,57221),0,0),e=i.getImageData(16,16,1,1).data,f=e[0]+","+e[1]+","+e[2]+","+e[3],i.fillText(j(55356,57221,55356,57343),0,0),e=i.getImageData(16,16,1,1).data,g=e[0]+","+e[1]+","+e[2]+","+e[3],f!==g;case"simple":return i.fillText(j(55357,56835),0,0),0!==i.getImageData(16,16,1,1).data[0];case"unicode8":return i.fillText(j(55356,57135),0,0),0!==i.getImageData(16,16,1,1).data[0];case"unicode9":return i.fillText(j(55358,56631),0,0),0!==i.getImageData(16,16,1,1).data[0]}return!1}function e(a){var c=b.createElement("script");c.src=a,c.type="text/javascript",b.getElementsByTagName("head")[0].appendChild(c)}var f,g,h,i;for(i=Array("simple","flag","unicode8","diversity","unicode9"),c.supports={everything:!0,everythingExceptFlag:!0},h=0;h<i.length;h++)c.supports[i[h]]=d(i[h]),c.supports.everything=c.supports.everything&&c.supports[i[h]],"flag"!==i[h]&&(c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&c.supports[i[h]]);c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&!c.supports.flag,c.DOMReady=!1,c.readyCallback=function(){c.DOMReady=!0},c.supports.everything||(g=function(){c.readyCallback()},b.addEventListener?(b.addEventListener("DOMContentLoaded",g,!1),a.addEventListener("load",g,!1)):(a.attachEvent("onload",g),b.attachEvent("onreadystatechange",function(){"complete"===b.readyState&&c.readyCallback()})),f=c.source||{},f.concatemoji?e(f.concatemoji):f.wpemoji&&f.twemoji&&(e(f.twemoji),e(f.wpemoji)))}(window,document,window._wpemojiSettings);
		</script>
		<style type="text/css">
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
</style>
<link rel='stylesheet' id='dashicons-css'  href="<?php echo $var[0 ].'wp-includes/css/dashicons.min.css';?>" type='text/css' media='all' />
<link rel='stylesheet' id='admin-bar-css'  href="<?php echo $var[0 ].'wp-includes/css/admin-bar.min.css';?>" type='text/css' media='all' />
<link rel='stylesheet' id='digg-digg-css'  href="<?php echo $var[0 ].'wp-content/plugins/digg-digg/css/diggdigg-style.css';?>" type='text/css' media='screen' />
<link rel='stylesheet' id='responsive-lightbox-nivo_lightbox-css-css'  href="<?php echo $var[0 ].'wp-content/plugins/responsive-lightbox-lite/assets/nivo-lightbox/nivo-lightbox.css';?>" type='text/css' media='all' />


<link rel='stylesheet' id='theme-styles-css'  href="<?php echo $var[0 ].'wp-content/themes/jupiter/stylesheet/css/styles.min.css';?>" type='text/css' media='all' />
<link rel='stylesheet' id='pe-line-icon-css'  href="<?php echo $var[0 ].'wp-content/themes/jupiter/stylesheet/css/pe-line-icons.min.css';?>" type='text/css' media='all' />
<link rel='stylesheet' id='font-awesome-css'  href="<?php echo $var[0 ].'wp-content/themes/jupiter/stylesheet/css/font-awesome.min.css';?>" type='text/css' media='all' />
<link rel='stylesheet' id='icomoon-fonts-css'  href="<?php echo $var[0 ].'wp-content/themes/jupiter/stylesheet/css/icomoon-fonts.min.css';?>" type='text/css' media='all' />
<link rel='stylesheet' id='theme-icons-css'  href="<?php echo $var[0 ].'wp-content/themes/jupiter/stylesheet/css/theme-icons.min.css';?>" type='text/css' media='all' />
<link rel='stylesheet' id='google-font-api-special-1-css'  href='http://fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C700italic%2C800italic%2C900italic%2C900%2C400%2C300%2C800%2C700%2C600&#038;ver=4.6.6' type='text/css' media='all' />
<link rel='stylesheet' id='mk-style-css'  href="<?php echo $var[0 ].'wp-content/themes/jupiter/style.css';?>" type='text/css' media='all' />
<link rel='stylesheet' id='theme-dynamic-styles-css'  href="<?php echo $var[0 ].'wp-content/themes/jupiter/custom.css';?>" type='text/css' media='all' />
<style id='theme-dynamic-styles-inline-css' type='text/css'>
body {}body {font-family: Open Sans }body{background-color: #fff;}#mk-header{background-color: #f7f7f7;}.mk-header-bg{background-color: #fff;background-repeat:no-repeat;background-position:center center;background-attachment:fixed;}.mk-header-toolbar{background-color: #ffffff;}#theme-page{background-color: #fff;}#mk-footer{background-color: #3d4045;}#mk-footer .footer-wrapper{padding:30px 0;}#mk-footer .widget{margin-bottom:40px;}#mk-footer [class*='mk-col-'] {padding:0 2%;}#sub-footer{background-color: #43474d;}.mk-footer-copyright {font-size:11px;letter-spacing: 1px;}#mk-boxed-layout{  -webkit-box-shadow: 0 0 0px rgba(0, 0, 0, 0);  -moz-box-shadow: 0 0 0px rgba(0, 0, 0, 0);  box-shadow: 0 0 0px rgba(0, 0, 0, 0);}.mk-tabs-panes,.mk-news-tab .mk-tabs-tabs li.ui-tabs-active a,.mk-divider .divider-go-top,.ajax-container,.mk-fancy-title.pattern-style span,.mk-portfolio-view-all,.mk-woo-view-all,.mk-blog-view-all{background-color: #fff;}.mk-header-bg{  -webkit-opacity: 1;  -moz-opacity: 1;  -o-opacity: 1;  opacity: 1;}.header-sticky-ready .mk-header-bg{  -webkit-opacity: 1;  -moz-opacity: 1;  -o-opacity: 1;  opacity: 1;}.mk-header-inner,.header-sticky-ready .mk-header-inner,.header-style-2.header-sticky-ready .mk-classic-nav-bg{border-bottom:1px solid #ededed;}.header-style-4.header-align-left .mk-header-inner,.header-style-4.header-align-center .mk-header-inner {border-bottom:none;border-right:1px solid #ededed;}.header-style-4.header-align-right .mk-header-inner {border-bottom:none;border-left:1px solid #ededed;}.header-style-2 .mk-header-nav-container {border-top:1px solid #ededed;}body{font-size: 14px;color: #777777;font-weight: normal;line-height: 1.66em;}p,.mk-box-icon-2-content {font-size: 16px;color: #777777;line-height: 1.66em;}a {color: #2e2e2e;}a:hover {color: #f97352;}#theme-page strong {color: #f97352;}#theme-page h1{font-size: 36px;color: #404040;font-weight: bold;text-transform: uppercase;}#theme-page h2{font-size: 30px;color: #404040;font-weight: bold;text-transform: uppercase;}#theme-page h3{font-size: 24px;color: #404040;font-weight: bold;text-transform: uppercase;}#theme-page h4{font-size: 18px;color: #404040;font-weight: bold;text-transform: uppercase;}#theme-page h5{font-size: 16px;color: #404040;font-weight: bold;text-transform: uppercase;}#theme-page h6{font-size: 14px;color: #404040;font-weight: normal;text-transform: uppercase;}.page-introduce-title{font-size: 20px;color: ;text-transform: uppercase;font-weight: normal;letter-spacing: 2px;}.page-introduce-subtitle{font-size: 14px;line-height: 100%;color: ;font-size: 14px;text-transform: none;}::-webkit-selection{background-color: #f97352;color:#fff;}::-moz-selection{background-color: #f97352;color:#fff;}::selection{background-color: #f97352;color:#fff;}#mk-sidebar,#mk-sidebar p{font-size: 14px;color: #999999;font-weight: normal;}#mk-sidebar .widgettitle{text-transform: uppercase;font-size: 14px;color: #333333;font-weight: bolder;}#mk-sidebar .widgettitle a{color: #333333;}#mk-sidebar .widget a{color: #999999;}#mk-footer,#mk-footer p{font-size: 14px;color: #808080;font-weight: normal;}#mk-footer .widgettitle{text-transform: uppercase;font-size: 14px;color: #fff;font-weight: 800;}#mk-footer .widgettitle a{color: #fff;}#mk-footer .widget:not(.widget_social_networks) a{color: #999999;}.mk-side-dashboard {background-color: #444;}.mk-side-dashboard,.mk-side-dashboard p{font-size: 12px;color: #eee;font-weight: normal;}.mk-side-dashboard .widgettitle{text-transform: uppercase;font-size: 14px;color: #fff;font-weight: 800;}.mk-side-dashboard .widgettitle a{color: #fff;}.mk-side-dashboard .widget a{color: #fafafa;}.sidedash-navigation-ul li a,.sidedash-navigation-ul li .mk-nav-arrow {color:#fff;}.sidedash-navigation-ul li a:hover {color:#fff;background-color:;}#mk-sidebar .widget:not(.widget_social_networks) a:hover {color: #f97352;}#mk-footer .widget:not(.widget_social_networks) a:hover {color: #f97352;}.mk-side-dashboard .widget:not(.widget_social_networks) a:hover{color: #f97352;}.mk-grid{max-width: 1140px;}.mk-header-nav-container, .mk-classic-menu-wrapper{width: 1140px;}.theme-page-wrapper #mk-sidebar.mk-builtin{width: 27%;}.theme-page-wrapper.right-layout .theme-content,.theme-page-wrapper.left-layout .theme-content{width: 73%;}.mk-boxed-enabled #mk-boxed-layout,.mk-boxed-enabled #mk-boxed-layout .header-style-1 .mk-header-holder,.mk-boxed-enabled #mk-boxed-layout .header-style-3 .mk-header-holder{max-width: 1200px;}.mk-boxed-enabled #mk-boxed-layout .header-style-1 .mk-header-holder,.mk-boxed-enabled #mk-boxed-layout .header-style-3 .mk-header-holder{width: 100% !important;left:auto !important;}.mk-boxed-enabled #mk-boxed-layout .header-style-2.header-sticky-ready .mk-header-nav-container {width: 1200px !important;left:auto !important;}.header-style-1 .mk-header-start-tour,.header-style-3 .mk-header-start-tour,.header-style-1 .mk-header-inner #mk-header-search,.header-style-1 .mk-header-inner,.header-style-1 .mk-search-trigger,.header-style-3 .mk-header-inner,.header-style-1 .header-logo,.header-style-3 .header-logo,.header-style-1 .shopping-cart-header,.header-style-3 .shopping-cart-header,#mk-header-social.header-section a{height: 90px;line-height:90px;}@media handheld, only screen and (max-width: 1140px){.header-grid.mk-grid .header-logo.left-logo{left: 15px !important;}.header-grid.mk-grid .header-logo.right-logo, .mk-header-right {right: 15px !important;}}#mk-theme-container:not(.mk-transparent-header) .header-style-1 .mk-header-padding-wrapper,#mk-theme-container:not(.mk-transparent-header) .header-style-3 .mk-header-padding-wrapper {padding-top:122px;}@media handheld, only screen and (max-width: 960px){.theme-page-wrapper .theme-content{width: 100% !important;float: none !important;}.theme-page-wrapper{padding-right:15px !important;padding-left: 15px !important;}.theme-page-wrapper .theme-content:not(.no-padding){padding:25px 0 !important;}.theme-page-wrapper #mk-sidebar{width: 100% !important;float: none !important;padding: 0 !important;}.theme-page-wrapper #mk-sidebar .sidebar-wrapper{padding:20px 0 !important;}}@media handheld, only screen and (max-width: 1140px){.mk-go-top,.mk-quick-contact-wrapper{bottom:70px !important;}.mk-grid {width: 100%;}.mk-padding-wrapper {padding: 0 20px;} }#mk-toolbar-navigation ul li a,.mk-language-nav > a,.mk-header-login .mk-login-link,.mk-subscribe-link,.mk-checkout-btn,.mk-header-tagline a,.header-toolbar-contact a,#mk-toolbar-navigation ul li a:hover,.mk-language-nav > a:hover,.mk-header-login .mk-login-link:hover,.mk-subscribe-link:hover,.mk-checkout-btn:hover,.mk-header-tagline a:hover{color:#999999;}.mk-header-tagline,.header-toolbar-contact,.mk-header-date{color:#999999;}.mk-header-toolbar #mk-header-social a i {color:#999999;}.header-section#mk-header-social ul li a i {color: #999999;}.header-section#mk-header-social ul li a:hover i {color: #ccc;}.header-style-2 .header-logo,.header-style-4 .header-logo{height: 90px !important;}.header-style-4 .header-logo {margin:10px 0;}.header-style-2 .mk-header-inner{line-height:90px;}.mk-header-nav-container{background-color: ;}.mk-header-start-tour{font-size: 14px;color: #333;}.mk-header-start-tour:hover{color: #333;}.mk-classic-nav-bg{background-color: #fff;background-repeat:no-repeat;background-position:center center;background-attachment:fixed;}.mk-search-trigger,.mk-shoping-cart-link i,.mk-toolbar-resposnive-icon i{color: #444444;}.mk-css-icon-close div,.mk-css-icon-menu div {background-color: #444444;}#mk-header-searchform .text-input{background-color: !important;color: #c7c7c7;}#mk-header-searchform span i{color: #c7c7c7;}#mk-header-searchform .text-input::-webkit-input-placeholder{color: #c7c7c7;}#mk-header-searchform .text-input:-ms-input-placeholder{color: #c7c7c7;}#mk-header-searchform .text-input:-moz-placeholder{color: #c7c7c7;}.header-style-1.header-sticky-ready .menu-hover-style-1 .main-navigation-ul > li > a,.header-style-3.header-sticky-ready .menu-hover-style-1 .main-navigation-ul > li > a,.header-style-1.header-sticky-ready .menu-hover-style-5 .main-navigation-ul > li,.header-style-1.header-sticky-ready .menu-hover-style-2 .main-navigation-ul > li > a,.header-style-3.header-sticky-ready .menu-hover-style-2 .main-navigation-ul > li > a,.header-style-1.header-style-1.header-sticky-ready .menu-hover-style-4 .main-navigation-ul > li > a,.header-style-3.header-sticky-ready .menu-hover-style-4 .main-navigation-ul > li > a,.header-style-1.header-sticky-ready .menu-hover-style-3 .main-navigation-ul > li,.header-style-1.header-sticky-ready .mk-header-inner #mk-header-search,.header-style-3.header-sticky-ready .mk-header-holder #mk-header-search,.header-sticky-ready.header-style-3 .mk-header-start-tour,.header-sticky-ready.header-style-1 .mk-header-start-tour,.header-sticky-ready.header-style-1 .mk-header-inner,.header-sticky-ready.header-style-3 .mk-header-inner,.header-sticky-ready.header-style-3 .header-logo,.header-sticky-ready.header-style-1 .header-logo,.header-sticky-ready.header-style-1 .mk-search-trigger,.header-sticky-ready.header-style-1 .shopping-cart-header,.header-sticky-ready.header-style-3 .shopping-cart-header,.header-sticky-ready #mk-header-social.header-section a {height:55px !important;line-height:55px !important;}#mk-header-social.header-section a.small {margin-top: 28px;}#mk-header-social.header-section a.medium {margin-top: 20px;}#mk-header-social.header-section a.large {margin-top: 12px;}.header-sticky-ready #mk-header-social.header-section a.small,.header-sticky-ready #mk-header-social.header-section a.medium,.header-sticky-ready #mk-header-social.header-section a.large {margin-top: 10.5px;line-height: 16px !important;height: 16px !important;font-size: 16px !important;width: 16px !important;padding: 8px !important;}.header-sticky-ready #mk-header-social.header-section a.small i:before,.header-sticky-ready #mk-header-social.header-section a.medium i:before,.header-sticky-ready #mk-header-social.header-section a.large i:before {line-height: 16px !important;font-size: 16px !important;}.main-navigation-ul > li.menu-item > a.menu-item-link{color: #444444;font-size: 13px;font-weight: bold;padding-right:20px!important;padding-left:20px!important;text-transform:uppercase;}.mk-vm-menuwrapper ul li a {color: #444444;font-size: 13px;font-weight: bold;text-transform:uppercase;}.mk-vm-menuwrapper li > a:after,.mk-vm-menuwrapper li.mk-vm-back:after {color: #444444;}.main-navigation-ul > li.no-mega-menu ul.sub-menu li.menu-item a.menu-item-link {width:230px;}.mk-header-3-menu-trigger {color: #444444;}.menu-hover-style-1 .main-navigation-ul li.menu-item > a.menu-item-link:hover,.menu-hover-style-1 .main-navigation-ul li.menu-item:hover > a.menu-item-link,.menu-hover-style-1 .main-navigation-ul li.current-menu-item > a.menu-item-link,.menu-hover-style-1 .main-navigation-ul li.current-menu-ancestor > a.menu-item-link,.menu-hover-style-2 .main-navigation-ul li.menu-item > a.menu-item-link:hover,.menu-hover-style-2 .main-navigation-ul li.menu-item:hover > a.menu-item-link,.menu-hover-style-2 .main-navigation-ul li.current-menu-item > a.menu-item-link,.menu-hover-style-2 .main-navigation-ul li.current-menu-ancestor > a.menu-item-link,.menu-hover-style-1.mk-vm-menuwrapper li.menu-item > a:hover,.menu-hover-style-1.mk-vm-menuwrapper li.menu-item:hover > a,.menu-hover-style-1.mk-vm-menuwrapper li.current-menu-item > a,.menu-hover-style-1.mk-vm-menuwrapper li.current-menu-ancestor > a,.menu-hover-style-2.mk-vm-menuwrapper li.menu-item > a:hover,.menu-hover-style-2.mk-vm-menuwrapper li.menu-item:hover > a,.menu-hover-style-2.mk-vm-menuwrapper li.current-menu-item > a,.menu-hover-style-2.mk-vm-menuwrapper li.current-menu-ancestor > a{color: #f97352 !important;}.menu-hover-style-3 .main-navigation-ul > li.menu-item > a.menu-item-link:hover,.menu-hover-style-3 .main-navigation-ul > li.menu-item:hover > a.menu-item-link,.menu-hover-style-3.mk-vm-menuwrapper li > a:hover,.menu-hover-style-3.mk-vm-menuwrapper li:hover > a{border:2px solid #f97352;}.menu-hover-style-3 .main-navigation-ul > li.current-menu-item > a.menu-item-link,.menu-hover-style-3 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link,.menu-hover-style-3.mk-vm-menuwrapper li.current-menu-item > a,.menu-hover-style-3.mk-vm-menuwrapper li.current-menu-ancestor > a{border:2px solid #f97352;background-color:#f97352;color:#fff;}.menu-hover-style-3.mk-vm-menuwrapper li.current-menu-ancestor > a:after {color:#fff;}.menu-hover-style-4 .main-navigation-ul li.menu-item > a.menu-item-link:hover,.menu-hover-style-4 .main-navigation-ul li.menu-item:hover > a.menu-item-link,.menu-hover-style-4 .main-navigation-ul li.current-menu-item > a.menu-item-link,.menu-hover-style-4 .main-navigation-ul li.current-menu-ancestor > a.menu-item-link,.menu-hover-style-4.mk-vm-menuwrapper li a:hover,.menu-hover-style-4.mk-vm-menuwrapper li:hover > a,.menu-hover-style-4.mk-vm-menuwrapper li.current-menu-item > a,.menu-hover-style-4.mk-vm-menuwrapper li.current-menu-ancestor > a,.menu-hover-style-5 .main-navigation-ul > li.menu-item > a.menu-item-link:after{background-color: #f97352;color:#fff;}.menu-hover-style-4.mk-vm-menuwrapper li.current-menu-ancestor > a:after,.menu-hover-style-4.mk-vm-menuwrapper li.current-menu-item > a:after,.menu-hover-style-4.mk-vm-menuwrapper li:hover > a:after,.menu-hover-style-4.mk-vm-menuwrapper li a:hover::after {color:#fff;}.menu-hover-style-1 .main-navigation-ul > li.dropdownOpen > a.menu-item-link,.menu-hover-style-1 .main-navigation-ul > li.active > a.menu-item-link,.menu-hover-style-1 .main-navigation-ul > li.open > a.menu-item-link,.menu-hover-style-1 .main-navigation-ul > li.menu-item > a:hover,.menu-hover-style-1 .main-navigation-ul > li.current-menu-item > a.menu-item-link,.menu-hover-style-1 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link {border-top-color:#f97352;}.menu-hover-style-1.mk-vm-menuwrapper li > a:hover,.menu-hover-style-1.mk-vm-menuwrapper li.current-menu-item > a,.menu-hover-style-1.mk-vm-menuwrapper li.current-menu-ancestor > a{border-left-color:#f97352;}.header-style-1 .menu-hover-style-1 .main-navigation-ul > li > a,.header-style-1 .menu-hover-style-2 .main-navigation-ul > li > a,.header-style-1 .menu-hover-style-4 .main-navigation-ul > li > a,.header-style-1 .menu-hover-style-5 .main-navigation-ul > li {height: 90px;line-height:90px;}.header-style-1 .menu-hover-style-3 .main-navigation-ul > li,.header-style-1 .menu-hover-style-5 .main-navigation-ul > li{height: 90px;line-height:90px;}.header-style-1 .menu-hover-style-3 .main-navigation-ul > li > a {line-height:45px;}.header-style-1.header-sticky-ready .menu-hover-style-3 .main-navigation-ul > li > a {line-height:36.666666666667px;}.header-style-1 .menu-hover-style-5 .main-navigation-ul > li > a {line-height:20px;vertical-align:middle;}.main-navigation-ul > li.no-mega-menu  ul.sub-menu:after,.main-navigation-ul > li.has-mega-menu > ul.sub-menu:after{  background-color:#f97352;}.mk-shopping-cart-box {border-top:2px solid #f97352;}#mk-main-navigation li.no-mega-menu ul.sub-menu,#mk-main-navigation li.has-mega-menu > ul.sub-menu,.mk-shopping-cart-box{background-color: #333333;}#mk-main-navigation ul.sub-menu a.menu-item-link,#mk-main-navigation ul .megamenu-title,.megamenu-widgets-container a,.mk-shopping-cart-box .product_list_widget li a,.mk-shopping-cart-box .product_list_widget li.empty,.mk-shopping-cart-box .product_list_widget li span,.mk-shopping-cart-box .widget_shopping_cart .total{color: #b3b3b3;}.mk-shopping-cart-box .mk-button.cart-widget-btn {border-color:#b3b3b3;color:#b3b3b3;}.mk-shopping-cart-box .mk-button.cart-widget-btn:hover {background-color:#b3b3b3;color:#333333;}#mk-main-navigation ul .megamenu-title{color: #ffffff;}#mk-main-navigation ul .megamenu-title:after{background-color: #ffffff;}.megamenu-widgets-container {color: #b3b3b3;}.megamenu-widgets-container .widgettitle{text-transform: uppercase;font-size: 14px;font-weight: bolder;}#mk-main-navigation ul.sub-menu li.menu-item ul.sub-menu li.menu-item a.menu-item-link i{color: #e0e0e0;}#mk-main-navigation ul.sub-menu a.menu-item-link:hover{color: #ffffff !important;}.megamenu-widgets-container a:hover {color: #ffffff;}.main-navigation-ul li.menu-item ul.sub-menu li.menu-item a.menu-item-link:hover,.main-navigation-ul li.menu-item ul.sub-menu li.menu-item:hover > a.menu-item-link,.main-navigation-ul ul.sub-menu li.menu-item a.menu-item-link:hover,.main-navigation-ul ul.sub-menu li.menu-item:hover > a.menu-item-link,.main-navigation-ul ul.sub-menu li.current-menu-item > a.menu-item-link{background-color: !important;}.mk-search-trigger:hover,.mk-header-start-tour:hover{color: #f97352;}.main-navigation-ul li.menu-item ul.sub-menu li.menu-item a.menu-item-link{font-size: 12px;font-weight: normal;text-transform:uppercase;letter-spacing: 1px;}.has-mega-menu .megamenu-title {letter-spacing: 1px;}.header-style-4 {text-align : left}.mk-vm-menuwrapper li > a {padding-right: 45px;}@media handheld, only screen and (max-width: 1140px){.header-style-1 .mk-header-inner,.header-style-3 .mk-header-inner,.header-style-3 .header-logo,.header-style-1 .header-logo,.header-style-1 .shopping-cart-header,.header-style-3 .shopping-cart-header{height:90px;line-height:90px;}#mk-header:not(.header-style-4) .mk-header-holder {position:relative !important;top:0 !important;}.mk-header-padding-wrapper {display:none !important;}.mk-header-nav-container{width: auto !important;display:none;}.header-style-1 .mk-header-right,.header-style-2 .mk-header-right,.header-style-3 .mk-header-right {right:55px !important;}.header-style-1 .mk-header-inner #mk-header-search,.header-style-2 .mk-header-inner #mk-header-search,.header-style-3 .mk-header-inner #mk-header-search{display:none !important;}.mk-fullscreen-search-overlay {display:none;}#mk-header-search{padding-bottom: 10px !important;}#mk-header-searchform span .text-input{width: 100% !important;}.header-style-2 .header-logo .center-logo{    text-align: right !important;}.header-style-2 .header-logo .center-logo a{    margin: 0 !important;}.header-logo,.header-style-4 .header-logo{    height: 90px !important;}.mk-header-inner{padding-top:0 !important;}.header-logo{position:relative !important;right:auto !important;left:auto !important;float:left !important;text-align:left;}.shopping-cart-header{margin:0 20px 0 0 !important;}#mk-responsive-nav{background-color:#fff !important;}.mk-header-nav-container #mk-responsive-nav{visibility: hidden;}#mk-responsive-nav li ul li .megamenu-title:hover,#mk-responsive-nav li ul li .megamenu-title,#mk-responsive-nav li a, #mk-responsive-nav li ul li a:hover,#mk-responsive-nav .mk-nav-arrow{  color:#444444 !important;}.mk-mega-icon{display:none !important;}.mk-header-bg{zoom:1 !important;filter:alpha(opacity=100) !important;opacity:1 !important;}.header-style-1 .mk-nav-responsive-link,.header-style-2 .mk-nav-responsive-link{display:block !important;}.mk-header-nav-container{height:100%;z-index:200;}#mk-main-navigation{position:relative;z-index:2;}.mk_megamenu_columns_2,.mk_megamenu_columns_3,.mk_megamenu_columns_4,.mk_megamenu_columns_5,.mk_megamenu_columns_6{width:100% !important;}.header-style-1.header-align-right .header-logo img,.header-style-3.header-align-right .header-logo img,.header-style-3.header-align-center .header-logo img {float: left !important;right:auto !important;}.header-style-4 .mk-header-inner {width: auto !important;position: relative !important;overflow: visible;padding-bottom: 0;}.admin-bar .header-style-4 .mk-header-inner {top:0 !important;}.header-style-4 .mk-header-right {display: none;}.header-style-4 .mk-nav-responsive-link {display: block !important;}.header-style-4 .mk-vm-menuwrapper,.header-style-4 #mk-header-search {display: none;}.header-style-4 .header-logo {width:auto !important;display: inline-block !important;text-align:left !important;margin:0 !important;}.vertical-header-enabled .header-style-4 .header-logo img {max-width: 100% !important;left: 20px!important;-webkit-transform: translate(0, -50%)!important;-moz-transform: translate(0, -50%)!important;-ms-transform: translate(0, -50%)!important;-o-transform: translate(0, -50%)!important;transform: translate(0, -50%)!important;position:relative !important;}.vertical-header-enabled.vertical-header-left #theme-page > .mk-main-wrapper-holder,.vertical-header-enabled.vertical-header-center #theme-page > .mk-main-wrapper-holder,.vertical-header-enabled.vertical-header-left #theme-page > .mk-page-section,.vertical-header-enabled.vertical-header-center #theme-page > .mk-page-section,.vertical-header-enabled.vertical-header-left #theme-page > .wpb_row,.vertical-header-enabled.vertical-header-center #theme-page > .wpb_row,.vertical-header-enabled.vertical-header-left #mk-theme-container:not(.mk-transparent-header), .vertical-header-enabled.vertical-header-center #mk-footer,.vertical-header-enabled.vertical-header-left #mk-footer,.vertical-header-enabled.vertical-header-center #mk-theme-container:not(.mk-transparent-header) {  padding-left: 0 !important;}.vertical-header-enabled.vertical-header-right #theme-page > .mk-main-wrapper-holder,.vertical-header-enabled.vertical-header-right #theme-page > .mk-page-section,.vertical-header-enabled.vertical-header-right #theme-page > .wpb_row,.vertical-header-enabled.vertical-header-right #mk-footer,.vertical-header-enabled.vertical-header-right #mk-theme-container:not(.mk-transparent-header) {  padding-right: 0 !important;}}@media handheld, only screen and (min-width: 1140px) {  .mk-transparent-header .sticky-style-slide .mk-header-holder {    position: absolute;  }  .mk-transparent-header .remove-header-bg-true:not(.header-sticky-ready) .mk-header-bg {    opacity: 0;  }  .mk-transparent-header .remove-header-bg-true#mk-header:not(.header-sticky-ready) .mk-header-inner {    border: 0;  }  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .mk-desktop-logo.light-logo {    display: block !important;  }  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .mk-desktop-logo.dark-logo {    display: none !important;  }  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .main-navigation-ul > li.menu-item > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .mk-search-trigger,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .mk-shoping-cart-link i,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .mk-header-start-tour,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) #mk-header-social a i,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-1 .main-navigation-ul > li.menu-item > a.menu-item-link:hover,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-1 .main-navigation-ul > li.menu-item:hover > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-1 .main-navigation-ul > li.current-menu-item > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-1 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-2 .main-navigation-ul > li.menu-item > a.menu-item-link:hover,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-2 .main-navigation-ul > li.menu-item:hover > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-2 .main-navigation-ul > li.current-menu-item > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .mk-vm-menuwrapper li a,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .mk-vm-menuwrapper li > a:after,   .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .mk-vm-menuwrapper li.mk-vm-back:after {    color: #fff !important;  }  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .mk-css-icon-menu div {    background-color: #fff !important;  }  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-1 .main-navigation-ul > li.dropdownOpen > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-1 .main-navigation-ul > li.active > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-1 .main-navigation-ul > li.open > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-1 .main-navigation-ul > li.menu-item > a:hover,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-1 .main-navigation-ul > li.current-menu-item > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-1 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link {    border-top-color: #fff;  }  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-3 .main-navigation-ul > li.current-menu-item > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-3 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-3.mk-vm-menuwrapper li.current-menu-item > a,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-3.mk-vm-menuwrapper li.current-menu-ancestor > a {    border: 2px solid #fff;    background-color: #fff;    color: #222 !important;  }  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-3 .main-navigation-ul > li.menu-item > a.menu-item-link:hover,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-3 .main-navigation-ul > li.menu-item:hover > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-3.mk-vm-menuwrapper li > a:hover,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-3.mk-vm-menuwrapper li:hover > a {    border: 2px solid #fff;  }  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-4 .main-navigation-ul li.menu-item > a.menu-item-link:hover,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-4 .main-navigation-ul li.menu-item:hover > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-4 .main-navigation-ul li.current-menu-item > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.light-header-skin:not(.header-sticky-ready) .menu-hover-style-5 .main-navigation-ul > li.menu-item > a.menu-item-link:after {    background-color: #fff;    color: #222 !important;  }  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .mk-desktop-logo.dark-logo {    display: block !important;  }  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .mk-desktop-logo.light-logo {    display: none !important;  }  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .main-navigation-ul > li.menu-item > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .mk-search-trigger,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .mk-shoping-cart-link i,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .mk-header-start-tour,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) #mk-header-social a i,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-1 .main-navigation-ul li.menu-item > a.menu-item-link:hover,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-1 .main-navigation-ul li.menu-item:hover > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-1 .main-navigation-ul li.current-menu-item > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-1 .main-navigation-ul li.current-menu-ancestor > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-2 .main-navigation-ul li.menu-item > a.menu-item-link:hover,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-2 .main-navigation-ul li.menu-item:hover > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-2 .main-navigation-ul li.current-menu-item > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-2 .main-navigation-ul li.current-menu-ancestor > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .mk-vm-menuwrapper li a,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .mk-vm-menuwrapper li > a:after, .mk-vm-menuwrapper li.mk-vm-back:after {    color: #222 !important;  }  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-1 .main-navigation-ul > li.dropdownOpen > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-1 .main-navigation-ul > li.active > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-1 .main-navigation-ul > li.open > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-1 .main-navigation-ul > li.menu-item > a:hover,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-1 .main-navigation-ul > li.current-menu-item > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-1 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link {    border-top-color: #222;  }  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .mk-css-icon-menu div {    background-color: #222 !important;  }  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-3 .main-navigation-ul > li.current-menu-item > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-3 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-3.mk-vm-menuwrapper li.current-menu-item > a,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-3.mk-vm-menuwrapper li.current-menu-ancestor > a {    border: 2px solid #222;    background-color: #222;    color: #fff !important;  }  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-3 .main-navigation-ul > li.menu-item > a.menu-item-link:hover,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-3 .main-navigation-ul > li.menu-item:hover > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-3.mk-vm-menuwrapper li > a:hover,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-3.mk-vm-menuwrapper li:hover > a {    border: 2px solid #222;  }  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-4 .main-navigation-ul li.menu-item > a.menu-item-link:hover,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-4 .main-navigation-ul li.menu-item:hover > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-4 .main-navigation-ul li.current-menu-item > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-4 .main-navigation-ul li.current-menu-ancestor > a.menu-item-link,  .mk-transparent-header .remove-header-bg-true.dark-header-skin:not(.header-sticky-ready) .menu-hover-style-5 .main-navigation-ul > li.menu-item > a.menu-item-link:after {    background-color: #222;    color: #fff !important;  }}.comment-reply a,.mk-tabs .mk-tabs-tabs li.ui-tabs-active a > i,.mk-toggle .mk-toggle-title.active-toggle:before,.introduce-simple-title,.rating-star .rated,.mk-accordion .mk-accordion-single.current .mk-accordion-tab:before,.mk-testimonial-author,.modern-style .mk-testimonial-company,#wp-calendar td#today,.mk-tweet-list a,.widget_testimonials .testimonial-slider .testimonial-author,.news-full-without-image .news-categories span,.news-half-without-image .news-categories span,.news-fourth-without-image .news-categories span,.mk-read-more,.news-single-social li a,.portfolio-widget-cats,.portfolio-carousel-cats,.blog-showcase-more,.simple-style .mk-employee-item:hover .team-member-position,.mk-readmore,.about-author-name,.filter-portfolio li a:hover,.mk-portfolio-classic-item .portfolio-categories a,.register-login-links a:hover,#mk-language-navigation ul li a:hover,#mk-language-navigation ul li.current-menu-item > a,.not-found-subtitle,.mk-mini-callout a,.mk-quick-contact-wrapper h4,.search-loop-meta a,.new-tab-readmore,.mk-news-tab .mk-tabs-tabs li.ui-tabs-active a,.mk-tooltip,.mk-search-permnalink,.divider-go-top:hover,.widget-sub-navigation ul li a:hover,.mk-toggle-title.active-toggle i,.mk-accordion-single.current .mk-accordion-tab i,.monocolor.pricing-table .pricing-price span,#mk-footer .widget_posts_lists ul li .post-list-meta time,.mk-footer-tweets .tweet-username,.quantity .plus:hover,.quantity .minus:hover,.mk-woo-tabs .mk-tabs-tabs li.ui-state-active a,.product .add_to_cart_button i,.blog-modern-comment:hover,.blog-modern-share:hover,.mk-tabs.simple-style .mk-tabs-tabs li.ui-tabs-active a,.product-category .item-holder:hover h4{color: #f97352 !important;}.image-hover-overlay,.newspaper-portfolio,.similar-posts-wrapper .post-thumbnail:hover > .overlay-pattern,.portfolio-logo-section,.post-list-document .post-type-thumb:hover,#cboxTitle,#cboxPrevious,#cboxNext,#cboxClose,.comment-form-button,.mk-dropcaps.fancy-style,.mk-image-overlay,.pinterest-item-overlay,.news-full-with-image .news-categories span,.news-half-with-image .news-categories span,.news-fourth-with-image .news-categories span,.widget-portfolio-overlay,.portfolio-carousel-overlay,.blog-carousel-overlay,.mk-classic-comments span,.mk-similiar-overlay,.mk-skin-button,.mk-flex-caption .flex-desc span,.mk-icon-box .mk-icon-wrapper i:hover,.mk-quick-contact-link:hover,.quick-contact-active.mk-quick-contact-link,.mk-fancy-table th,.ui-slider-handle,.widget_price_filter .ui-slider-range,.shop-skin-btn,#review_form_wrapper input[type=submit],#mk-nav-search-wrapper form .nav-side-search-icon:hover,form.ajax-search-complete i,.blog-modern-btn,.showcase-blog-overlay,.gform_button[type=submit],.button.alt,#respond #submit,.woocommerce .price_slider_amount .button.button,.mk-shopping-cart-box .mk-button.checkout,.widget_shopping_cart .mk-button.checkout,.widget_shopping_cart .mk-button.checkout{background-color: #f97352 !important;}.mk-circle-image .item-holder{-webkit-box-shadow:0 0 0 1px #f97352;-moz-box-shadow:0 0 0 1px #f97352;box-shadow:0 0 0 1px #f97352;}.mk-blockquote.line-style,.bypostauthor .comment-content,.bypostauthor .comment-content:after,.mk-tabs.simple-style .mk-tabs-tabs li.ui-tabs-active a{border-color: #f97352 !important;}.news-full-with-image .news-categories span,.news-half-with-image .news-categories span,.news-fourth-with-image .news-categories span,.mk-flex-caption .flex-desc span{box-shadow: 8px 0 0 #f97352, -8px 0 0 #f97352;}.monocolor.pricing-table .pricing-cols .pricing-col.featured-plan{border:1px solid #f97352 !important;}.mk-skin-button.three-dimension{box-shadow: 0px 3px 0px 0px #c75c42;}.mk-skin-button.three-dimension:active{box-shadow: 0px 1px 0px 0px #c75c42;}.mk-footer-copyright, #mk-footer-navigation li a{color: #8c8e91;}.mk-woocommerce-main-image img:hover, .mk-single-thumbnails img:hover{border:1px solid #f97352 !important;}.product-loading-icon{background-color:rgba(249,115,82,0.6);}
</style>


<script type='text/javascript' src="<?php echo $var[0 ].'wp-includes/js/jquery/jquery.js';?>"></script>

<script type='text/javascript'>
/* <![CDATA[ */
var rllArgs = {"script":"nivo_lightbox","selector":"lightbox","custom_events":""};
/* ]]> */
</script>

<meta name="generator" content="Jupiter 4.0.3" />
<meta name="generator" content="Powered by Visual Composer - drag and drop page builder for WordPress."/>
<!--[if IE 8]><link rel="stylesheet" type="text/css" href="/wp-content/plugins/js_composer_theme/assets/css/vc-ie8.css" media="screen"><![endif]--><style type="text/css" media="print">#wpadminbar { display:none; }</style>
<style type="text/css" media="screen">
	html { margin-top: 32px !important; }
	* html body { margin-top: 32px !important; }
	@media screen and ( max-width: 782px ) {
		html { margin-top: 46px !important; }
		* html body { margin-top: 46px !important; }
	}
</style>
<style type="text/css" data-type="vc_shortcodes-custom-css">.vc_custom_1434116287752{margin-top: 60px !important;}</style><script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-59885024-1', 'auto');
  ga('send', 'pageview');
</script>

    </head>

<body class="home page page-id-6348 page-template-default logged-in admin-bar no-customize-support  wpb-js-composer js-comp-ver-4.3.4 vc_responsive" data-backText="Retour" data-vm-anim="1">



<div id="mk-boxed-layout">
<div id="mk-theme-container">

<header id="mk-header" data-height="90" data-hover-style="5" data-transparent-skin="light" data-header-style="2" data-sticky-height="55" data-sticky-style="fixed" data-sticky-offset="header" class="header-style-2 header-align-center header-toolbar-true sticky-style-fixed  mk-background-stretch boxed-header ">


<div class="mk-header-holder">

    <div class="mk-header-toolbar">
      
      <div class="mk-grid header-grid">	<div class="mk-header-login">
    		<a href="#" id="mk-header-login-button" class="mk-login-link mk-toggle-trigger"><i class="mk-moon-user-8"></i><?php echo $user; ?></a>
    		<!--div class="mk-login-register mk-box-to-trigger user-profile-box">
    			<img alt='' src='http://2.gravatar.com/avatar/?s=48&#038;d=mm&#038;r=g' srcset='http://1.gravatar.com/avatar/?s=96&amp;d=mm&amp;r=g 2x' class='avatar avatar-48 photo avatar-default' height='48' width='48' />    			<a href="http://localhost/cdv/wp-admin/profile.php">Edit Profile</a>
    			<a href="/wp-login.php?action=logout&amp;redirect_to=http%3A%2F%2Flocalhost%2Fcdv&amp;_wpnonce=2b68e3f46c" title="Logout">Déconnexion</a>
    		</div-->
    		</div>
		</div>    <div class="clearboth"></div>
  </div>

<div class="mk-header-inner">

    <div class="mk-header-bg "></div>



        <div class="mk-toolbar-resposnive-icon"><i class="mk-icon-chevron-down"></i></div>
  



  <div class="mk-grid header-grid">
  


<div class=" mk-nav-responsive-link">
            <div class="mk-css-icon-menu">
              <div class="mk-css-icon-menu-line-1"></div>
              <div class="mk-css-icon-menu-line-2"></div>
              <div class="mk-css-icon-menu-line-3"></div>
            </div>
          </div>  
  
      
  		<div class="header-logo logo-is-responsive logo-has-sticky">
		    <a href="<?php echo $var[0];?>" title="Le blog de Nomade Aventure &#8211; Nomade&#039;s land">

				<img class="mk-desktop-logo dark-logo" alt="Le blog de Nomade Aventure &#8211; Nomade&#039;s land" src="<?php echo ($var[0].'wp-content/uploads/2015/02/logo_nomade_carte.png');?>" />


				<img class="mk-desktop-logo light-logo" alt="Le blog de Nomade Aventure &#8211; Nomade&#039;s land" src="<?php echo ($var[0].'wp-content/uploads/2015/02/logo_nomade_carte.png');?>" />
				
			        <img class="mk-resposnive-logo" alt="Le blog de Nomade Aventure &#8211; Nomade&#039;s land" src="<?php echo ($var[0].'wp-content/uploads/2015/02/logo_nomade_carte.png');?>" />
				
			        <img class="mk-sticky-logo" alt="Le blog de Nomade Aventure &#8211; Nomade&#039;s land" src="<?php echo ($var[0].'wp-content/uploads/2015/02/logo_nomade_carte.png');?>" />
				


			</a>
		</div>

		  </div>
  <div class="clearboth"></div>
  <div class="mk-header-right">
  
  
  </div>



</div>


</div>

  <div class="clearboth"></div>





<div class="mk-header-padding-wrapper"></div>


<div class="clearboth"></div>

<div class="mk-zindex-fix">    

</div>

<div class="clearboth"></div>

</header>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Lobster');
        .back {
            height: 226px;
            width: 50%;
             margin: auto; 
            background: white;  
            opacity: .7;
        }
        .jumbotron{
                 opacity: 1;
                 color: black;                   
        }
        .display-3{
          font-size: 50px;  
          font-family: 'Lobster', cursive;
          margin: auto;
          text-align: center;
          color: #0a73f7;
        }
        .lead{
                width: 44%;
                margin: auto;
                height: 33px;
                background: #0a73f7;
                text-align: center;
                opacity: 1;
                color: white !important;
                border-radius: 6px;
        }
        .lead a{
             color: white;
             font-family: 'Lobster';
        }
    </style>
    <?php $url=content_url().'/plugins/Carnet_voyages/img/cover.jpg';
    $urlcarnet=admin_url().'admin.php?page=carnet';
    
    ?>
    
    <div style="height:700px;  background-image: url('<?php echo $url;?>'); background-size: 100%;background-repeat: no-repeat; background-attachment: fixed;"> 
        <div style="height:200px;"></div>
        <div class="back">
          <div class="jumbotron text-xs-center">
            <h1 class="display-3">Merci pour votre confiance!</h1>
            <!--p class="lead"><strong>Please check your email</strong> for further instructions on how to complete your account setup.</p-->
            <hr>
                <img style="  width: 13%;height: 101px; margin-left: 44%; margin-top: -6px;" alt="" title="" src="<?php  echo (admin_url().'images/Capture.PNG');?>">
            <p class="lead">
              <a rel="nofollow" rel="noreferrer"class="btn btn-primary btn-sm" href="<?php echo $urlcarnet; ?>" role="button">Continuer au page carnet voyage </a>
            </p>
          </div>
    </div>  
</div>
<section id="mk-footer" class="">


<div class="footer-wrapper mk-grid">

<div class="mk-padding-wrapper">


<div class="mk-col-1-4"></div>


<div class="mk-col-1-4"></div>


<div class="mk-col-1-4"></div>


<div class="mk-col-1-4"></div>


<div class="clearboth"></div>

</div>

</div>



<div id="sub-footer">

	<div class=" mk-grid">

		


    	<span class="mk-footer-copyright">Copyright All Rights Reserved &copy; 2014</span>

    	
	</div>

	<div class="clearboth"></div>

</div>




</section>











</div>




</div>


	




	<div class="mk-quick-contact-wrapper">
		<a href="#" class="mk-quick-contact-link"><i class="mk-icon-envelope"></i></a>
		
	</div>
	
		

		
		</body>


</html>









