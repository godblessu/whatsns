<!DOCTYPE html>
<html lang="zh-cn">
  <!--{eval global $starttime,$querynum;$mtime = explode(' ', microtime());$runtime=number_format($mtime[1] + $mtime[0] - $starttime,6); $setting=$this->setting;$user=$this->user;$regular=$this->regular;$toolbars="'".str_replace(",", "','", $setting['editor_toolbars'])."'";}-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--{if isset($seo_title)}-->
        <title>{$seo_title}</title>
        <!--{else}-->
        <title><!--{if $navtitle}-->{$navtitle} - <!--{/if}-->{$setting['site_name']}</title>
        <!--{/if}-->
        <!--{if isset($seo_description)}-->
        <meta name="description" content="{$seo_description}" />
        <!--{else}-->
        <meta name="description" content="{$setting['site_name']}" />
        <!--{/if}-->
        <meta name="baidu_union_verify" content="0a6eb0d38028073338fae8907c1c5d4d">
        <meta name="keywords" content="{$seo_keywords}" />
        <meta name="author" content="Ask2 Team" />
        <meta name="copyright" content="2017 ask2.cn" />
        <meta name="robots" content="index, follow">
        <meta name="googlebot" content="index, follow" />
      <meta name="applicable-device" content="pc"/>
           <meta name="default-theme" content="{$setting['tpl_themedir']}"/>
      <meta http-equiv='Cache-Control' content='no-transform'/>
      <link rel="stylesheet" media="all" href="{SITE_URL}static/css/common/animate.min.css" />
          <link href="{SITE_URL}static/css/dist/css/zui.min.css" rel="stylesheet">
     <link rel="stylesheet" media="all" href="{SITE_URL}static/css/bianping/css/zhongchou.css" />
    <link rel="stylesheet" media="all" href="{SITE_URL}static/css/bianping/css/common.css" />
  <link rel="stylesheet" href="{SITE_URL}static/css/bianping/css/leftmenu.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="{SITE_URL}static/css/bianping/css/whatsns.css" media="screen" type="text/css">
       <link rel="stylesheet" media="all" href="{SITE_URL}static/css/bianping/css/custom.css" />
    <link href="{SITE_URL}static/css/static/css/font-awesome/css/font-awesome.css" rel="stylesheet">
<script src="{SITE_URL}static/js/jquery-1.11.3.min.js"></script>
<script src="{SITE_URL}static/js/ie.js" type="text/javascript"></script>
<!-- ZUI Javascript组件 -->
<script src="{SITE_URL}static/css/dist/js/zui.min.js"></script>
 <script src="{SITE_URL}static/css/bianping/js/common.js"></script>
   <script type="text/javascript" src="{SITE_URL}static/js/jquery.qrcode.min.js"></script>
    <!--[if lt IE 9]>
    <script src="{SITE_URL}static/css/dist/lib/ieonly/html5shiv.js"></script>
    <script src="{SITE_URL}static/css/dist/lib/ieonly/respond.js"></script>
    <![endif]-->

        <script type="text/javascript">
          var g_site_url = "{SITE_URL}";
            var g_site_name = "{$setting['site_name']}";
            var g_prefix = "{$setting['seo_prefix']}";
            var g_suffix = "{$setting['seo_suffix']}";
            var g_uid = {$user['uid']};
            var qid = 0;
            </script>
</head>