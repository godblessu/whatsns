<!--{template header}-->
<link rel="stylesheet" media="all" href="{SITE_URL}static/css/bianping/css/category.css" />
<!--{eval $adlist = $this->fromcache("adlist");}-->
<div class="container collection index">
  <div class="row">
    <div class="col-xs-17  main">
      <!-- 专题头部模块 -->
      <div class="main-top">
        <a class="avatar-collection" href="{url category/view/$category['id']}">
          <img src="$category['bigimage']" alt="240">
</a>
{if $is_followed}
 <a class="btn btn-default following" id="attenttouser_{$category['id']}" onclick="attentto_cat($category['id'])"><i class="fa fa-check"></i><span>已关注</span></a>

{else}
 <a class="btn btn-success follow" id="attenttouser_{$category['id']}" onclick="attentto_cat($category['id'])"><i class="fa fa-plus"></i><span>关注</span></a>

{/if}

            <div class="btn btn-hollow js-contribute-button" onclick="window.location.href='{url question/add}';">
                                             投稿
            </div>

        <div class="title">
          <a class="name" href="{url category/view/$category['id']}"> {$category['name']}</a>
        </div>
        <div class="info">
                  收录了{$trownum}篇文章 ·{$category['questions']}个问题 · {$category['followers']}人关注
        </div>
      </div>
       <div class="recommend-collection">



          <!--{loop $sublist $index $cat}-->


                   <a class="collection"  href="{url category/view/$cat['id']}">
            <img src="$cat['image']" alt="195" style="height:32px;width:32px;">
            <div class="name">{$cat['name']}</div>
        </a>
                <!--{/loop}-->


        {if $category['pid']}
             <a class="more-hot-collection" href="{url topic/catlist/$category['pid']}">
        返回上级 <i class="fa fa-angle-right mar-ly-1"></i>
    </a>
        {/if}
                </div>
      <ul class="trigger-menu" data-pjax-container="#list-container">
      <li <!--{if all==$status}-->class="active"<!--{/if}-->><a href="{url category/view/$cid/all}">
      <i class="fa fa-sticky-note-o"></i> 全部问题</a>
      </li>
      <li <!--{if 1==$status}-->class="active"<!--{/if}-->><a href="{url category/view/$cid/1}">
      <i class="fa fa-times">
      </i> 未解决</a>
      </li>
      <li <!--{if 2==$status}-->class="active"<!--{/if}-->>
      <a  href="{url category/view/$cid/2}"><i class="fa fa-check"></i> 已解决</a>
      </li>
      <li <!--{if 6==$status}-->class="active"<!--{/if}-->>
      <a href="{url category/view/$cid/6}"><i class="fa fa-shield"></i> 推荐问题</a>
      </li>
      {if $category['isusearticle']}
        <li >
      <a href="{url topic/catlist/$cid}"><i class="fa fa-sticky-note-o"></i> 相关文章</a>
      </li>
      {/if}
      </ul>
      <div id="list-container">
        <!-- 文章列表模块 -->
<ul class="note-list" >

                <!--{loop $questionlist $index $question}-->

    <li id="note-{$question['id']}" data-note-id="{$question['id']}" {if $question['image']!=null}  class="have-img" {else}class="" {/if}>
    {if $question['image']!=null}
      <a class="wrap-img" {if $question['articleclassid']!=null} href="{url topic/getone/$question['id']}"  {else}  href="{url question/view/$question['id']}" {/if} target="_self">
            <img src="{$question['image']}">
        </a>
            {/if}
        <div class="content">
            <div class="author">





        {if $question['hidden']==1}

          <a class="avatar"  href="javascript:void(0)">
                    <img src="{SITE_URL}static/css/default/avatar.gif" alt="96">
                </a>      <div class="name">
                <a class="blue-link"  href="javascript:void(0)">匿名用户</a>


        {else}
        <a class="avatar" target="_self" href="{url user/space/$question['authorid']}">
                    <img src="{$question['avatar']}" alt="96">
                </a>      <div class="name">
                <a class="blue-link" target="_self" href="{url user/space/$question['authorid']}">
                {$question['author']}
                 {if $question['author_has_vertify']!=false}<i class="fa fa-vimeo {if $question['author_has_vertify'][0]=='0'}v_person {else}v_company {/if}  " data-toggle="tooltip" data-placement="right" title="" {if $question['author_has_vertify'][0]=='0'}data-original-title="个人认证" {else}data-original-title="企业认证" {/if} ></i>{/if}
                </a>

        {/if}


                <span class="time" data-shared-at="{$question['format_time']}">{$question['format_time']}</span>
            </div>
            </div>
            <a class="title" target="_self"  {if $question['articleclassid']!=null} href="{url topic/getone/$question['id']}"  {else}  href="{url question/view/$question['id']}" {/if} >{$question['title']}</a>
            <p class="abstract">
                {eval echo strip_tags($question['description']);}

            </p>
            <div class="meta">

                <a target="_self" {if $question['articleclassid']!=null} href="{url topic/getone/$question['id']}"  {else}  href="{url question/view/$question['id']}" {/if}>
                    <i class="fa fa-eye"></i> {$question['views']}
                </a>        <a target="_self" {if $question['articleclassid']!=null} href="{url topic/getone/$question['id']}#comments"  {else}  href="{url question/view/$question['id']}#comments" {/if}>
                <i class="fa fa-comment-o"></i> {$question['answers']}
            </a>      <span><i class=" fa fa-heart-o"></i>  {$question['attentions']}</span>
            </div>
        </div>
    </li>

    <!--{/loop}-->


</ul>

      </div>
         <div class="pages">{$departstr}</div>
    </div>
    <div class="col-xs-7  aside">
        <div class="recommend">


          <div class="title">
    <i class="fa fa-huati"></i>
   <span  class="title_text"> 专题公告</span>

   </div>

        <div class="description js-description">
              {if $category['miaosu']==''}
         暂无专题描述
         {else}
         {$category['miaosu']}
         {/if}
        </div>
           </div>


     <div class="recommend">
         <div class="title">
              <i class="fa fa-zhuanjia"></i>
          <span class="title_text">推荐专家</span>

          </div>

      <ul class="list collection-editor">
         <!--{loop $expertlist $expert}-->
      <li>
      <a href="{url user/space/$expert['uid']}" target="_self" class="avatar">
    <img src="{$expert['avatar']}" style="width:35px;height:35px;">
      </a>
      <a href="{url user/space/$expert['uid']}" target="_self" class="name">{$expert['username']}</a>



      </li>
  <!--{/loop}-->
     </ul>

     </div>




        <div class="recommend">
          <div class="title">
              <i class="fa fa-wenzhang"></i>
          <span class="title_text">相关文章</span>
            <span class="morelink">
     <a href="{url topic}"><i class="fa fa-ellipsis-h" ></i></a>
    </span>
          </div>
   <ul class="list">

  <!--{loop $topiclist $index $article}-->
   <li class="ws_art_text">


   <a target="_self" class="li-a-title" title=" {$article['title']}" href="{url topic/getone/$article['id']}" >
   {$article['title']}
   </a>

   </li>



  <!--{/loop}-->
      </ul>
 </div>


           {if $category['followers']>0}
             <div><div class="title">关注的人({$category['followers']})</div> <ul class="list collection-follower">

               <!--{loop $followerlist $fuser}-->
             <li><a href="{url user/space/$fuser['uid']}" target="_self" class="avatar">
             <img src="{$fuser['avatar']}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{$fuser['follower']} · {$fuser['format_time']} 关注"></a>
             </li>
             <!--{/loop}-->

             <a class="function-btn"><i class="fa fa-ellipsis-h"></i></a> <!----></ul>
     </div>
     {/if}
      <div class="share">
        <span>分享至</span>
        <a href="javascript:void((function(s,d,e,r,l,p,t,z,c){var%20f='http://v.t.sina.com.cn/share/share.php?appkey=1515056452',u=z||d.location,p=['&amp;url=',e(u),'&amp;title=',e(t||d.title),'&amp;source=',e(r),'&amp;sourceUrl=',e(l),'&amp;content=',c||'gb2312','&amp;pic=',e(p||'')].join('');function%20a(){if(!window.open([f,p].join(''),'mb',['toolbar=0,status=0,resizable=1,width=440,height=430,left=',(s.width-440)/2,',top=',(s.height-430)/2].join('')))u.href=[f,p].join('');};if(/Firefox/.test(navigator.userAgent))setTimeout(a,0);else%20a();})(screen,document,encodeURIComponent,'','','{$category['bigimage']}', '《{$category['name']}》','{url category/view/$category['id']}','页面编码gb2312|utf-8默认gb2312'));"><i class="fa fa-weibo text-success"></i></a>
        <a data-action="weixin-share " class="share-weixin"><i class="fa fa-wechat text-danger"></i></a>

        <script type="text/javascript">document.write(['<a class="share-circle" data-toggle="tooltip"  target="_self" data-original-title="分享到qq空间" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=',encodeURIComponent(location.href),'&title=',encodeURIComponent(document.title),'" target="_self"   title="分享到QQ空间"> <i class="fa fa-qq"></i><\/a>'].join(''));</script>
      </div>


    </div>
  </div>
</div>
<!-- 微信分享 -->
<div class="modal share-wechat animated" style="display: none;"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" data-dismiss="modal" class="close">×</button></div> <div class="modal-body"><h5>打开微信“扫一扫”，打开网页后点击屏幕右上角分享按钮</h5> <div data-url="{url question/view/$question['id']}" class="qrcode" title="{url question/view/$question['id']}"><canvas width="170" height="170" style="display: none;"></canvas>
<div id="qr_wxcode">
</div></div></div> <div class="modal-footer"></div></div></div></div>
<script>
var qrurl="{url category/view/$category['id']}";
$(function(){
	//微信二维码生成
	$('#qr_wxcode').qrcode(qrurl);
	 //显示微信二维码
	 $(".share-weixin").click(function(){

		 $(".share-wechat").show();
	 });
	 //关闭微信二维码
	 $(".close").click(function(){
		 $(".share-wechat").hide();
		 $(".pay-money").hide();
	 });
});

</script>
<!--{template footer }-->