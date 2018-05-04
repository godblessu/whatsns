<!--{template header}-->
  <!--{eval $adlist = $this->fromcache("adlist");}-->
<link rel="stylesheet" media="all" href="{SITE_URL}static/css/bianping/css/detail.css" />
   <script type="text/javascript" src="{SITE_URL}static/js/jquery.qrcode.min.js"></script>
<div class="container index">
<div class="row">
   <div class="col-xs-17 main">
   <div class="note">
    <div class="post">
        <div class="article">
            <h1 class="title">{$note['title']}  </h1>

            <!-- 作者区域 -->
            <div class="author">
                <a class="avatar" href="{url user/space/$note['authorid']}">
                    <img src="{$note['avatar']}" alt="144">
                </a>          <div class="info">
                <span class="tag">作者</span>
                <span class="name"><a href="{url user/space/$note['authorid']}">{$note['author']}</a></span>
                <!-- 关注用户按钮 -->
                             {if  $is_followedauthor}

  <a class="btn btn-default following" id="attenttouser_{$note['authorid']}" onclick="attentto_user($note['authorid'])"><i class="fa fa-check"></i><span>已关注</span></a>

  {else}

         <a class="btn btn-success follow" id="attenttouser_{$note['authorid']}" onclick="attentto_user($note['authorid'])"><i class="fa fa-plus"></i><span>关注</span></a>

  {/if}

                <!-- 文章数据信息 -->
                <div class="meta">
                    <!-- 如果文章更新时间大于发布时间，那么使用 tooltip 显示更新时间 -->
                    <span class="publish-time" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="最后编辑于 {$note['format_time']}"> {$note['format_time']}</span>
                    <span class="wordage">字数 {$note['artlen']}</span>
                    <span class="views-count">阅读 {$note['views']}</span><span class="comments-count">评论 {$note['comments']}</span></div>
            </div>
        <!--{if $user['grouptype']==1||$user['uid']==$note['authorid']}-->
                <!-- 如果是当前作者，加入编辑按钮 -->
                <a href="javascript:void(0)"  data-toggle="dropdown" class="edit dropdown-toggle">操作 <i class="fa fa-angle-down mar-lr-05"></i> </a>
                 <ul class="dropdown-menu" role="menu">

  <!--{if $user['grouptype']==1}-->
     <li>

                    <a href="{url topicdata/pushindex/$note['id']/note}" >
                        <i class="fa fa-edit"></i><span>顶置公告</span>
                    </a>
                      </li>
     <!--{/if}-->


                             </ul>
                               <!--{/if}-->
            </div>
            <!-- -->

            <!-- 文章内容 -->
            <div class="show-content art-content">

                <p>
                {$note['content']}
                </p>
            </div>
            <!--  -->


        </div>
              <div class="meta-bottom">

      <div class="share-group">
        <a class="share-circle share-weixin" data-action="weixin-share" data-toggle="tooltip" data-original-title="分享到微信">
          <i class="fa fa-wechat"></i>
        </a>
        <a class="share-circle" data-toggle="tooltip" href="javascript:void((function(s,d,e,r,l,p,t,z,c){var%20f='http://v.t.sina.com.cn/share/share.php?appkey=1881139527',u=z||d.location,p=['&amp;url=',e(u),'&amp;title=',e(t||d.title),'&amp;source=',e(r),'&amp;sourceUrl=',e(l),'&amp;content=',c||'gb2312','&amp;pic=',e(p||'')].join('');function%20a(){if(!window.open([f,p].join(''),'mb',['toolbar=0,status=0,resizable=1,width=440,height=430,left=',(s.width-440)/2,',top=',(s.height-430)/2].join('')))u.href=[f,p].join('');};if(/Firefox/.test(navigator.userAgent))setTimeout(a,0);else%20a();})(screen,document,encodeURIComponent,'','','', '推荐 {$note['author']} 的文章《{$note['title']}》','{url note/view/$note['id']}','页面编码gb2312|utf-8默认gb2312'));" data-original-title="分享到微博">
          <i class="fa fa-weibo"></i>
        </a>




  <script type="text/javascript">document.write(['<a class="share-circle" data-toggle="tooltip"  target="_self" data-original-title="分享到qq空间" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=',encodeURIComponent(location.href),'&title=',encodeURIComponent(document.title),'" target="_self"   title="分享到QQ空间"> <i class="fa fa-qq"></i><\/a>'].join(''));</script>

      </div>
    </div>

        <!--{if (isset($adlist['question_view']['inner1']) && trim($adlist['question_view']['inner1']))}-->
            <div style="margin-top:5px;">{$adlist['question_view']['inner1']}</div>
            <!--{/if}-->

        <div>
        <div id="comment-list" class="comment-list">
        <div>
 <form class="new-comment" name="commentForm" action="{url note/addcomment}" method="post">
       <input type="hidden" value="{$note['id']}" name="noteid">
 <a class="avatar">
 <img src="{$user['avatar']}">
 </a>
 <textarea placeholder="写下你的评论..." oninput="listertext()" onpropertychange="listertext()" class="comment-area" id="content" name="content"></textarea>

<div class="write-function-block">
<div class="hint">评论说明重点</div>
 <input type="submit" name="submit" id="submit" class="btn btn-send btn-cm-submit" value="发送" data-loading="稍候...">

  <a class="cancel">取消</a>
  </div>
   <div class="write-function-block code_hint">
 {template code}
 </div>
 </form>



          </div>
        <div id="normal-comment-list" class="normal-comment-list clearfix">
        <div>
        <div>
        <div class="top">
        <span>{$note['comments']}条评论</span>
         <a class="author-only hide">只看作者</a>
          <a class="close-btn" style="display: none;">关闭评论</a>
           <div class="pull-right">
           <a class="active hide">按喜欢排序</a>
           <a class="hide">按时间正序</a>
           <a class="hide">按时间倒序</a>
           </div>
           </div>
           </div>
           <!----> <!---->
            <!--{if $commentlist==null}-->
            <div class="no-comment"></div>
            <div class="text">
            沙发正空，不想<a>发表一点想法</a>咩~
          </div>
              <!--{/if}-->
          <!--{loop $commentlist $index $comment}-->
            <div id="comment-{$comment['id']}" class="comment">
            <div>
            <div class="author">
            <a href="{url user/space/$comment['authorid']}" target="_self" class="avatar">
            <img src="{$comment['avatar']}">
            </a>
            <div class="info">
            <a href="{url user/space/$comment['authorid']}" target="_self" class="name">{$comment['author']}</a>
            <!---->
             <div class="meta">
             <span>$index楼 · {$comment['format_time']}</span>
             </div>
             </div>
             </div>
             <div class="comment-wrap">
             <p>
              {$comment['content']}
             </p>

                </div>
                </div>
                <div class="sub-comment-list hide"><!----> <!----></div>
                </div>
 <!--{/loop}-->
  <div class="pages" >{$departstr}</div>
             <div class="comments-placeholder" style="display: none;"><div class="author"><div class="avatar"></div> <div class="info"><div class="name"></div> <div class="meta"></div></div></div> <div class="text"></div> <div class="text animation-delay"></div> <div class="tool-group"><i class="iconfont ic-zan-active"></i><div class="zan"></div> <i class="iconfont ic-list-comments"></i><div class="zan">
             </div>
             </div>
             </div>
             </div>
             </div>
              <!----> <!---->
              </div>
              </div>

    </div>

    <div class="side-tool"><ul><li data-placement="left" data-toggle="tooltip" data-container="body" data-original-title="回到顶部" >
    <a href="#" class="function-button"><i class="fa fa-angle-up"></i></a>
    </li>

             </ul></div>
</div>
  </div>
   <div class="col-xs-7  aside ">


            <!--{template sider_note}-->

       <!--广告位5-->
        <!--{if (isset($adlist['question_view']['right1']) && trim($adlist['question_view']['right1']))}-->

        <div class="right_ad">{$adlist['question_view']['right1']}</div>


        <!--{/if}-->
   </div>
</div>

<div class="modal share-wechat animated" style="display: none;"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" data-dismiss="modal" class="close">×</button></div> <div class="modal-body"><h5>打开微信“扫一扫”，打开网页后点击屏幕右上角分享按钮</h5> <div data-url="{url note/view/$note['id']}" class="qrcode" title="{url note/view/$note['id']}"><canvas width="170" height="170" style="display: none;"></canvas>
<div id="qr_wxcode">
</div></div></div> <div class="modal-footer"></div></div></div></div>
<script type="text/javascript" src="{SITE_URL}static/ckplayer/ckplayer.js" charset="utf-8"></script>
<script type="text/javascript" src="{SITE_URL}static/ckplayer/video.js" charset="utf-8"></script>
<script>
var g_id = {$user['groupid']};
function listertext(){
	 var _content=$("#content").val();
	 if(_content.length>0&&g_id!=1){

		 $(".code_hint").show();
	 }else{
		 $(".code_hint").hide();
	 }
}
if(typeof($(".art-content").find("img").attr("data-original"))!="undefined"){
	var imgurl=$(".art-content").find("img").attr("data-original");
	$(".art-content").find("img").attr("src",imgurl);
}
$(".art-content").find("img").attr("data-toggle","lightbox");
$(".art-content").find("img").attr("class","img-thumbnail").css({"display":"block","margin-top":"3px"});
$(function(){

		//微信二维码生成
		$('#qr_wxcode').qrcode("{url note/view/$note['id']}");
	     //显示微信二维码
	     $(".share-weixin").click(function(){
	    	 $(".share-wechat").show();
	     });
	     //关闭微信二维码
	     $(".close").click(function(){
	    	 $(".share-wechat").hide();
	     })

})
</script>
<!--{template footer}-->