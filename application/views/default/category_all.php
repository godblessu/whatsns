<!--{template header}-->
<link rel="stylesheet" media="all" href="{SITE_URL}static/css/bianping/css/topic.css" />
<div class="container recommend" >
<div style="background: #fff;padding:10px;">

  <img class="recommend-banner" src="{SITE_URL}static/images/tuijian.png" alt="Recommend collection">
  <ul class="trigger-menu" data-pjax-container="#list-container">
  <li {if $status=='hot'} class="active"{/if} >
  <a data-order-by="recommend" href="{url category/viewtopic/hot}">
  <i class="fa fa-book"></i> 推荐</a>
  </li>
  <li {if $status=='new'} class="active"{/if} ><a data-order-by="hot" href="{url category/viewtopic/new}">
  <i class="fa fa-hacker-news"></i> 最新</a>
  </li>

  </li>
  </ul>

  <div class="row" id="list-container">

    <!--{loop $catlist  $category1}-->



              <div class="col-xs-8">
  <div class="collection-wrap">
    <a class="avatar-collection" target="_self" href="{url category/view/$category1['id']}">
      <img src="{$category1['bigimage']}" alt="180">
</a>    <h4><a target="_self" href="{url category/view/$category1['id']}">{$category1['name']}</a></h4>
    <p class="collection-description">
{$category1['miaosu']}
</p>
{if $category1['follow']}
 <a class="btn btn-default following" id="attenttouser_{$category1['id']}" onclick="attentto_cat($category1['id'])"><i class="fa fa-check"></i><span>已关注</span></a>

{else}
 <a class="btn btn-success follow" id="attenttouser_{$category1['id']}" onclick="attentto_cat($category1['id'])"><i class="fa fa-plus"></i><span>关注</span></a>

{/if}


    <hr>
    <div class="count"><a target="_self" href="{url category/view/$category1['id']}">{$category1['questions']}个问题</a>·{$category1['followers']}人关注</div>
  </div>
</div>

                <!--{/loop}-->





  </div>

    <div class="pages">$departstr</div>
    </div>
</div>
<!--{template footer}-->