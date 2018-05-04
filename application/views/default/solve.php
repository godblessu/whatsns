<!--{template header}-->
<link rel="stylesheet" media="all" href="{SITE_URL}static/css/bianping/css/detail.css" />

  <!--{eval $adlist = $this->fromcache("adlist");}-->
<div class="container index">
<div class="row">
   <div class="col-xs-17 main">
   <div class="note">
    <div class="post">
        <div class="article">
            <h1 class="title"> {$question['title']} </h1>
<div class="tag_selects">

 <!--{if $taglist}-->
                                       <!--{loop $taglist $tag}-->


                    <div class="tag_s"><a href="{url question/search}?word=$tag"><span>{$tag}</span></a></div>
                <!--{/loop}--><!--{else}--><!--{/if}-->
</div>
            <!-- 作者区域 -->
            <div class="author">
            {if $question['hidden']==1}

                <a class="avatar" href="javascript:void(0)">

                    <img src="{SITE_URL}static/css/default/avatar.gif" alt="144">
                     </a>
                      <div class="info">
                <span class="tag">提问者</span>
                <span class="name">匿名用户</span>
                <!-- 关注用户按钮 -->

    {else}
                <a class="avatar" href="{url user/space/$question['authorid']}">
                    <img src="{$question['author_avartar']}" alt="144">
                </a>          <div class="info">
                <span class="tag">提问者</span>
                <span class="name"><a href="{url user/space/$question['authorid']}">
                {$question['author']}
                 {if $question['author_has_vertify']!=false}<i class="fa fa-vimeo {if $question['author_has_vertify'][0]=='0'}v_person {else}v_company {/if}  " data-toggle="tooltip" data-placement="right" title="" {if $question['author_has_vertify'][0]=='0'}data-original-title="个人认证" {else}data-original-title="企业认证" {/if} ></i>{/if}
                </a></span>
                <!-- 关注用户按钮 -->
                 {if  $is_followedauthor}

  <a class="btn btn-default following" id="attenttouser_{$question['authorid']}" onclick="attentto_user($question['authorid'])"><i class="fa fa-check"></i><span>已关注</span></a>

  {else}

         <a class="btn btn-success follow" id="attenttouser_{$question['authorid']}" onclick="attentto_user($question['authorid'])"><i class="fa fa-plus"></i><span>关注</span></a>

  {/if}
              {/if}
                <!-- 文章数据信息 -->
                <div class="meta">
                    <!-- 如果文章更新时间大于发布时间，那么使用 tooltip 显示更新时间 -->
                    <span class="publish-time" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="最后编辑于 {$question['format_time']}">{$question['format_time']}</span>
                    <span class="wordage ">悬赏 {$question['price']}财富值 </span>
                    <span class="views-count">阅读 {$question['views']}</span><span class="comments-count">回答 {$question['answers']}</span><span class="likes-count">收藏 {$question['attentions']}</span>
                     {if $question['shangjin']!=0}
                      <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="如果回答被采纳将获得 {$question['shangjin']}元，可提现" class="icon_hot"><i class="fa fa-cny mar-r-03"></i>悬赏$question['shangjin']元</span>

                    {/if}
                 {if $question['hasvoice']!=0}
                      <span data-toggle="tooltip" data-placement="bottom" title=""  class="icon_green"><i class="fa fa-volume-up mar-r-03"></i>语音偷听</span>
                    {/if}
                        {if $question['askuid']>0}
                      <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="邀请{$question['askuser']['username']}回答"  class="icon_zise"><i class="fa fa-twitch mar-r-03"></i>邀请回答</span>
                  {/if}
                  {if $question['status']!=9}
                    {if $showtime}
                    <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="超过时间没有采纳，系统将自动分配最佳答案，没有回答赏金自动返回给作者"  class="time-item hide">
                    【<span id="day_show">0天</span>

	<strong id="hour_show">0时</strong>

	<strong id="minute_show">0分</strong>

	<strong id="second_show">0秒</strong>】
	</span>
	<script>

		setoutTime({$outtime});
		$(".time-item").removeClass("hide").css("color","#42c02e").show()

	</script>
                    {/if}
                        {/if}
                    </div>
            </div>
                <!--{if $user['grouptype']==1||$user['uid']==$question['authorid']}-->
                <!-- 如果是当前作者，加入编辑按钮 -->
                <a href="javascript:void(0)"  data-toggle="dropdown" class="edit dropdown-toggle">操作 <i class="fa fa-angle-down mar-lr-05"></i> </a>
                 <ul class="dropdown-menu" role="menu">

  <!--{if $user['grouptype']==1}-->
     <li>

                    <a href="{url topicdata/pushindex/$question['id']/qid}" >
                        <i class="fa fa-edit"></i><span>顶置问题</span>
                    </a>
                      </li>

                     <li>

                    <a id="changecategory" data-toggle="modal" data-target="#catedialog" >
                        <i class="fa fa-edit"></i><span>移动分类</span>
                    </a>
                      </li>
                           <!--{/if}-->
                       <li>

                    <a href="{url question/edit/$question[id]}" >
                        <i class="fa fa-edit"></i><span>编辑问题</span>
                    </a>
                      </li>
                       {if $question['shangjin']==0}
                           <li>

                    <a id="delete_question">
                        <i class="fa fa-trash-o "></i><span>删除问题</span>
                    </a>
                      </li>
                        {/if}
                       <li>

                    <a id="close_question">
                        <i class="fa fa-close "></i><span>关闭问题</span>
                    </a>
                      </li>
                        <li>

                    <a onclick="edittag();">
                        <i class="fa fa-tag"></i><span>编辑标签</span>
                    </a>
                      </li>

                             </ul>
                               <!--{/if}-->
            </div>
            <!-- -->

            <!-- 问题描述 -->
            <div class="show-content">

                <p>
                {eval    echo replacewords($question['description']);    }
                </p>
            </div>
            <!--  -->

            <div class="show-foot">
                <a class="notebook" href="{url category/view/$question['cid']}" data-toggle="tooltip" data-html="true" data-original-title="问题归属分类">
                    <i class="fa fa-file-text"></i> <span>{$question['category_name']}</span>
                </a>          <div class="copyright" data-toggle="tooltip" data-html="true" data-original-title="转载请联系作者获得授权，并标注“问答作者”。">
                © 著作权归作者所有
            </div>
                <div class="modal-wrap" data-report-note="">
                    <a onclick="openinform({$question['id']},'{$question['title']}',0)" id="report-modal">举报问题</a>
                </div>
            </div>
        </div>

    <div class="meta-bottom">
      <div class="like"><div class="btn like-group"><div class="btn-like"><a href="{url question/attentto/$question['id']}"><i class="fa fa-heart-o"></i>收藏</a></div> <div class="modal-wrap"><a>{$question['attentions']}</a></div></div> <!----></div>
      <div class="share-group">
        <a class="share-circle share-weixin" data-action="weixin-share" data-toggle="tooltip" data-original-title="分享到微信">
          <i class="fa fa-wechat"></i>
        </a>
        <a class="share-circle" data-toggle="tooltip" href="javascript:void((function(s,d,e,r,l,p,t,z,c){var%20f='http://v.t.sina.com.cn/share/share.php?appkey=1515056452',u=z||d.location,p=['&amp;url=',e(u),'&amp;title=',e(t||d.title),'&amp;source=',e(r),'&amp;sourceUrl=',e(l),'&amp;content=',c||'gb2312','&amp;pic=',e(p||'')].join('');function%20a(){if(!window.open([f,p].join(''),'mb',['toolbar=0,status=0,resizable=1,width=440,height=430,left=',(s.width-440)/2,',top=',(s.height-430)/2].join('')))u.href=[f,p].join('');};if(/Firefox/.test(navigator.userAgent))setTimeout(a,0);else%20a();})(screen,document,encodeURIComponent,'','','{$setting['site_logo']}', '推荐 {$question['author']} 的问题《{$question['title']}》','{url question/view/$question[id]}','页面编码gb2312|utf-8默认gb2312'));" data-original-title="分享到微博">
          <i class="fa fa-weibo"></i>
        </a>




  <script type="text/javascript">document.write(['<a class="share-circle" data-toggle="tooltip"  target="_self" data-original-title="分享到qq空间" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=',encodeURIComponent(location.href),'&title=',encodeURIComponent(document.title),'" target="_self"   title="分享到QQ空间"> <i class="fa fa-qq"></i><\/a>'].join(''));</script>

      </div>
    </div>



        <div><div id="comment-list" class="comment-list"><div>
           <!--{if 9!=$question['status']  }-->
        {if $user['uid']!=0}
 <form class="new-comment" id="huidaform"  name="answerForm"  method="post">
  <input type="hidden" value="{$question['id']}" id="ans_qid" name="qid">
   <input type="hidden" id="tokenkey" name="tokenkey" value='{$_SESSION["answertoken"]}'/>
                <input type="hidden" value="{$question['title']}" id="ans_title" name="title">
 <a class="avatar">
 <img src="{$user['avatar']}">
 </a>

    <!--{template editor}-->
  <div class="write-function-block">
  <div class="hint">付费偷看设置</div>

  <div class="emoji-modal-wrap">
 <a class="emoji "  data-toggle="tooltip" data-placement="right" title="" data-original-title="设置付费查看回答金额">
 <i class="fa fa-paypal text-red mar-ly-1"></i>
 </a>
</div>
  <a class="btn btn-send" id="ajaxsubmitasnwer">发送</a>
  <a class="cancel">取消</a></div>
     <div class="write-function-block ">

      <!--{if $setting['code_ask']&&$user['credit1']<$setting['jingyan']}-->
 {template code}
   <!--{/if}-->
 </div>
  </form>
      {else}
  <form class="new-comment"><a class="avatar"><img src="{$user['avatar']}"></a> <div class="sign-container"><a href="{url user/login}" class="btn btn-sign">登录</a> <span>后发表回答</span></div></form>

            {/if}

              <!--{else}-->
               <div class="c-text alert alert-success-inverse"><i class="fa fa-info-circle mar-ly-1"></i>该问题目前已经被作者或者管理员关闭, 无法添加新回复</div>
                     <!--{/if}-->
                         <!--广告位1-->
            <!--{if (isset($adlist['question_view']['inner1']) && trim($adlist['question_view']['inner1']))}-->
            <div style="margin-top:5px;">{$adlist['question_view']['inner1']}</div>
            <!--{/if}-->
        </div>
        <div id="normal-comment-list" class="normal-comment-list">
        <div>
        <div>
        <div class="top">
        <span>{$question['answers']}条回答</span>
         <a class="author-only" style="display: none;">只看作者</a>
          <a class="close-btn" style="display: none;">关闭回答</a>
           <div class="pull-right">
           <a class="active" style="display: none;">按喜欢排序</a>
           <a class="" style="display: none;">按时间正序</a>
           <a class="" style="display: none;">按时间倒序</a>
           </div>
           </div>
           </div>
            <!--{if $bestanswer['id']>0}-->

               <div id="comment-{$bestanswer['id']}" class="comment">

            <div>
            <div class="author">
            <a href="{url user/space/$bestanswer['authorid']}" target="_self" class="avatar">
            <img src="{$bestanswer['author_avartar']}">
            </a>
            <div class="info">
            <a href="{url user/space/$bestanswer['authorid']}" target="_self" class="name">
            {$bestanswer['author']}
             {if $bestanswer['author_has_vertify']!=false}<i class="fa fa-vimeo {if $bestanswer['author_has_vertify'][0]=='0'}v_person {else}v_company {/if}  " data-toggle="tooltip" data-placement="right" title="" {if $bestanswer['author_has_vertify'][0]=='0'}data-original-title="个人认证" {else}data-original-title="企业认证" {/if} ></i>{/if}
            </a>
            <!---->
             <div class="meta">
             <span>1楼 · {$bestanswer['format_time']}.<span class="text-danger"><i class="fa fa-check"></i>采纳回答</span></span>
             </div>
             </div>
             </div>
             <div class="comment-wrap art-content">
             <p>
                {if $bestanswer['serverid']==null}
                             {if $bestanswer['reward']==0||$bestanswer['authorid']==$user['uid']}
                             {eval    echo replacewords($bestanswer['content']);    }
                               {else}
                                    {eval if($question['authorid']==$user['uid']) $bestanswer['canview']=1;}
                               {if $bestanswer['canview']==0}
                                 <div class="box_toukan ">

											{if $user['uid']==0}
											<a onclick="login()" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="我也付费偷偷看" class="thiefbox font-12" onclick=""><i class="icon icon-lock font-12"></i> &nbsp;精彩回答&nbsp;$bestanswer['reward']&nbsp;&nbsp;元偷偷看…… <span class="kanguoperson">$bestanswer['viewnum']人看过</span></a>
											{else}
											<a onclick="viewanswer($bestanswer['id'])" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="我也付费偷偷看" class="thiefbox font-12" onclick=""><i class="icon icon-lock font-12"></i> &nbsp;精彩回答&nbsp;$bestanswer['reward']&nbsp;&nbsp;元偷偷看……<span class="kanguoperson">$bestanswer['viewnum']人看过</span></a>
											{/if}


										</div>
                               {else}
                                 {eval    echo replacewords($bestanswer['content']);    }
                               {/if}

                               {/if}



                    {else}

									<div class="htmlview">
					  <div class="yuyinplay" id="{$bestanswer['serverid']}">
                     <i class="fa fa-volume-up " ></i><span class="u-voice">
                     <span class="wtip">免费偷听</span>

                     &nbsp;{$bestanswer['voicetime']}秒</span>
                     <audio id="voiceaudio" width="420" style="display:none">
    <source src="{SITE_URL}data/weixinrecord/{$bestanswer['mediafile']}" type="audio/mpeg" />

</audio>
                    </div>
					</div>
                    {/if}

                 <div class="appendcontent">
                                <!--{loop $bestanswer['appends'] $append}-->
                                <div class="appendbox">
                                    <!--{if $append['authorid']==$bestanswer['authorid']}-->
                                    <h4 class="appendanswer font-12">回答:<span class="time">
                                    {$bestanswer['format_time']}</span></h4>
                                    <!--{else}-->
                                    <h4 class="appendask font-12">作者追问:<span class='time'>{$bestanswer['format_time']}</span></h4>
                                    <!--{/if}-->
                                       <div class="zhuiwentext">   {eval    echo replacewords($append['content']);    }
                                       </div>
                                <div class="clr"></div>
                                </div>
                                <!--{/loop}-->
                        </div>
             </p>
             <div class="tool-group">
                <a class="button_agree" id='{$bestanswer['id']}'><i class="fa fa-thumbs-o-up"></i> <span>{$bestanswer['supports']}人赞</span></a>
             <a class="icon_discuss jsslideshowcomment"  onclick="show_comment('{$bestanswer['id']}');"><i class="fa fa-cloud"></i> <span>  添加讨论({$bestanswer['comments']})</span></a>
             <a class="hide"><i class="fa fa-commenting-o"></i> <span>回答</span></a>
                  <!--{if  1==$user['grouptype'] ||$user['uid']==$bestanswer['authorid']}-->

                       <a href="{url answer/append/$question['id']/$bestanswer['id']}" data-original-title="继续回答问题"  data-placement="bottom" title="" data-toggle="tooltip" ><i class="fa fa-edit"></i> <span>继续回答</span></a>

               <a href="{url question/editanswer/$bestanswer['id']}" data-original-title="修改自己答案"  data-placement="bottom" title="" data-toggle="tooltip" ><i class="fa fa-edit"></i> <span>编辑</span></a>
                 <!--{/if}-->
                <!--{if $user['uid']==$question['authorid']}-->

           <a data-placement="bottom" title="" data-toggle="tooltip" data-original-title="继续回答问题" href="{url answer/append/$question['id']/$bestanswer['id']}"><i class="fa fa-file-powerpoint-o"></i> <span>追问</span></a>


               <!--{/if}-->
             {if $setting['openwxpay']==1}
        <a class="shangke " data-placement="bottom" title="" data-toggle="tooltip" {if $bestanswer['total']==0} data-original-title="任意打赏Ta" {else} data-original-title="已获得网友$bestanswer['total']元赏金" {/if} onclick="wxpay('aid',{$bestanswer['id']},{$bestanswer['authorid']} );"><i class="fa fa-cny color-white"></i> <span class="count color-white">打赏TA</span></a>
                {/if}

               <a class="report" onclick="openinform({$question['id']},'{$question['title']}',{$bestanswer['id']})"><span>举报</span></a>
                <!---->
                </div>
                </div>
                </div>
                <div class="comments-mod "  style="display: none; float:none;padding-top:10px;" id="comment_{$bestanswer['id']}">
                    <div class="areabox clearfix">


                  <div class="input-group">
             <input type="text" placeholder="请输入评论内容，不少于2个字" class="comment-input form-control" name="content" />
                        <input type='hidden' value='0' name='replyauthor' />
              <span class="input-group-btn"><input type="button" value="评论"  class="btn btn-green" name="submit" onclick="addcomment({$bestanswer['id']});"/> </span>
            </div>

                    </div>
                    <ul class="my-comments-list nav">
                        <li class="loading">
                        <img src='{SITE_URL}static/css/default/loading.gif' align='absmiddle' />
                        &nbsp;加载中...
                        </li>
                    </ul>
                </div>
                </div>

                <!--{/if}-->
            <!--{if $answerlist==null&&$bestanswer==null}-->
            <div class="no-comment"></div>
             <!--{if 9!=$question['status']  }-->
              <div class="text">
            沙发正空，不想<a>发表一点想法</a>咩~
          </div>
              <!--{else}-->
               <div class="text">
           还没有人回答过~
          </div>
               <!--{/if}-->

              <!--{/if}-->
          <!--{loop $answerlist $nindex $answer}-->
            <div id="comment-{$answer['id']}" class="comment">
            <div>
            <div class="author">
            <a href="{url user/space/$answer['authorid']}" target="_self" class="avatar">
            <img src="{$answer['author_avartar']}">
            </a>
            <div class="info">
            <a href="{url user/space/$answer['authorid']}" target="_self" class="name">
            {$answer['author']}
              {if $answer['author_has_vertify']!=false}<i class="fa fa-vimeo {if $answer['author_has_vertify'][0]=='0'}v_person {else}v_company {/if}  " data-toggle="tooltip" data-placement="right" title="" {if $answer['author_has_vertify'][0]=='0'}data-original-title="个人认证" {else}data-original-title="企业认证" {/if} ></i>{/if}
            </a>
            <!---->
             <div class="meta">
             <span>{eval echo $nindex+2;}楼-- · {$answer['time']}</span>
             </div>
             </div>
             </div>
             <div class="comment-wrap art-content">
             <p>
                {if $answer['serverid']==null}
                             {if $answer['reward']==0||$answer['authorid']==$user['uid']}
                             {eval    echo replacewords($answer['content']);    }
                               {else}
                               {eval if($question['authorid']==$user['uid']) $answer['canview']=1;}
                               {if $answer['canview']==0}
                                 <div class="box_toukan ">

											{if $user['uid']==0}
											<a onclick="login()" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="我也付费偷偷看" class="thiefbox font-12" onclick=""><i class="icon icon-lock font-12"></i> &nbsp;精彩回答&nbsp;$answer['reward']&nbsp;&nbsp;元偷偷看……{if $answer['viewnum']>0}<span class="kanguoperson">$answer['viewnum']人看过{/if}</span></a>
											{else}
											<a onclick="viewanswer($answer['id'])" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="我也付费偷偷看" class="thiefbox font-12" onclick=""><i class="icon icon-lock font-12"></i> &nbsp;精彩回答&nbsp;$answer['reward']&nbsp;&nbsp;元偷偷看……{if $answer['viewnum']>0}<span class="kanguoperson">$answer['viewnum']人看过{/if}</span></a>
											{/if}


										</div>
                               {else}
                                 {eval    echo replacewords($answer['content']);    }
                               {/if}

                               {/if}



                    {else}
                    <!-- ie8浏览器用微信扫一扫，不支持html5标签 -->
                    <div class="ieview hide">

                                         此回答为语音回复，请在微信中扫一扫下面偷听回答
                 <div id="output{$answer['id']}" style="width:135px;height:135px;"></div>
				  <script>

					$(function(){

						$('#output{$answer['id']}').qrcode("{url question/voice/$qid/$answer['id']}");

					})

					</script>
					  </div>
					<div class="htmlview">
					  <div class="yuyinplay" id="{$answer['serverid']}">
                     <i class="fa fa-volume-up " ></i><span class="u-voice">
                     <span class="wtip">免费偷听</span>

                     &nbsp;{$answer['voicetime']}秒</span>
                     <audio id="voiceaudio" width="420" style="display:none">
    <source src="{SITE_URL}data/weixinrecord/{$answer['mediafile']}" type="audio/mpeg" />

</audio>
                    </div>
					</div>
                    {/if}

                 <div class="appendcontent">
                                <!--{loop $answer['appends'] $append}-->
                                <div class="appendbox">
                                    <!--{if $append['authorid']==$answer['authorid']}-->
                                    <h4 class="appendanswer font-12">回答:<span class="time">
                                    {$append['format_time']}</span></h4>
                                    <!--{else}-->
                                    <h4 class="appendask font-12">作者追问:<span class='time'>{$append['format_time']}</span></h4>
                                    <!--{/if}-->
                                       <div class="zhuiwentext ">   {eval    echo replacewords($append['content']);    }
                                       </div>
                                <div class="clr"></div>
                                </div>
                                <!--{/loop}-->
                        </div>
             </p>
             <div class="tool-group">
             <a class="button_agree" id='{$answer['id']}'><i class="fa fa-thumbs-o-up"></i> <span>{$answer['supports']}人赞</span></a>

                                                  <a class="icon_discuss jsslideshowcomment"  onclick="show_comment('{$answer['id']}');"><i class="fa fa-cloud"></i> <span>  添加讨论({$answer['comments']})</span></a>

              <a class="hide"><i class="fa fa-commenting-o"></i> <span>回答</span></a>
                  <!--{if  1==$user['grouptype'] ||$user['uid']==$answer['authorid']}-->

                       <a href="{url answer/append/$question['id']/$answer['id']}" data-original-title="继续回答问题"  data-placement="bottom" title="" data-toggle="tooltip" ><i class="fa fa-edit"></i> <span>继续回答</span></a>

               <a href="{url question/editanswer/$answer['id']}" data-original-title="修改自己答案"  data-placement="bottom" title="" data-toggle="tooltip" ><i class="fa fa-edit"></i> <span>编辑</span></a>
                 <!--{/if}-->
                <!--{if $user['uid']==$question['authorid']}-->

           <a data-placement="bottom" title="" data-toggle="tooltip" data-original-title="追问回答者" href="{url answer/append/$question['id']/$answer['id']}"><i class="fa fa-file-powerpoint-o"></i> <span>追问</span></a>


               <!--{/if}-->

                    <!--{if $bestanswer['id']<=0}-->
         <!--{if 1==$user['grouptype'] ||$user['uid']==$question['authorid']}-->

                                <a data-placement="bottom" title="" data-toggle="tooltip" data-original-title="采纳满意回答"   href="javascript:void(0);" onclick="adoptanswer({$answer['id']});"><i class="fa fa-bookmark-o"></i> <span>采纳</span></a>
                                <!--{/if}-->
                             <!--{/if}-->
                      {if $setting['openwxpay']==1}
                <a class="shangke " data-placement="bottom" title="" data-toggle="tooltip" {if $answer['total']==0} data-original-title="任意打赏Ta" {else} data-original-title="已获得网友$answer['total']元赏金" {/if} onclick="wxpay('aid',{$answer['id']},{$answer['authorid']} );"><i class="fa fa-cny color-white"></i> <span class="count color-white">打赏TA</span></a>
                {/if}
                <!--{if 1==$user['grouptype'] ||$user['uid']==$answer['authorid']}-->

    <a data-placement="bottom" title="" data-toggle="tooltip" data-original-title="删除回答"   href="javascript:void(0);" onclick="deleteanswer($answer['id'])"><i class="fa fa-bookmark-o"></i> <span>删除</span></a>
     <!--{/if}-->
               <a class="report" onclick="openinform({$question['id']},'{$question['title']}',{$answer['id']})"><span>举报</span></a>
                <!---->
                </div>
                </div>
                </div>


                        <div class="comments-mod " style="display: none; float:none;padding-top:10px;" id="comment_{$answer['id']}">
                            <div class="areabox clearfix" >

                               <div class="input-group">
             <input type="text" placeholder="请输入评论内容，不少于2个字" class="comment-input form-control" name="content" />
                        <input type='hidden' value='0' name='replyauthor' />
              <span class="input-group-btn"><input type="button" value="评论"  class="btn btn-green" name="submit" onclick="addcomment({$answer['id']});"/> </span>
            </div>

                            </div>
                            <ul class="my-comments-list nav">
                                <li class="loading text-left"><img src='{SITE_URL}static/css/default/loading.gif' align='absmiddle' />&nbsp;加载中...</li>
                            </ul>
                        </div>

                </div>
 <!--{/loop}-->
  <div class="pages" >{$departstr}</div>
             <div class="comments-placeholder" style="display: none;"><div class="author"><div class="avatar"></div> <div class="info"><div class="name"></div> <div class="meta"></div></div></div> <div class="text"></div> <div class="text animation-delay"></div> <div class="tool-group"><i class="iconfont ic-zan-active"></i><div class="zan"></div> <i class="iconfont ic-list-comments"></i><div class="zan"></div></div></div></div></div> <!----> <!----></div></div>
    </div>


</div>
   </div>
   <div class="col-xs-7  aside ">
   <div class="recommend">
   <div class="title">
    <i class="fa fa-wenti"></i>
   <span  class="title_text">相关问题</span>
      <span class="morelink">
     <a href="{url category/view/$question['cid']}"><i class="fa fa-ellipsis-h" ></i></a>
    </span>
   </div>
   <ul class="list">

  <!--{loop $solvelist $solve}-->
   <li>


   <a target="_self" class="li-a-title" title=" {$solve['title']}" href="{url question/view/$solve['id']}" >
   {$solve['title']}
   </a>

   </li>



  <!--{/loop}-->
      </ul>
</div>

    {if $question['attentions']>0}
             <div style="margin:40px auto"><div class="title">收藏的人({$question['attentions']})</div> <ul class="list collection-follower">

               <!--{loop $followerlist $fuser}-->
             <li><a href="{url user/space/$fuser['followerid']}" target="_self" class="avatar">
             <img src="{$fuser['avatar']}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{$fuser['follower']} · {$fuser['format_time']} 关注"></a>
             </li>
             <!--{/loop}-->

             <a class="function-btn"><i class="fa fa-ellipsis-h"></i></a> <!----></ul>
     </div>
     {/if}
            <!--广告位5-->
        <!--{if (isset($adlist['question_view']['right1']) && trim($adlist['question_view']['right1']))}-->

        <div class="right_ad">{$adlist['question_view']['right1']}</div>


        <!--{/if}-->
   </div>
</div>
</div>

<div class="modal fade" id="dialogadopt">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">关闭</span></button>
      <h4 class="modal-title">采纳回答</h4>
    </div>
    <div class="modal-body">

     <form class="form-horizontal"  name="editanswerForm"  method="post" >
        <input type="hidden"  value="{$question['id']}" id="adopt_qid" name="qid"/>
        <input type="hidden" id="adopt_answer" value="0" name="aid"/>
        <table  class="table ">
            <tr valign="top">
                <td>向帮助了您的知道网友说句感谢的话吧!</td>
            </tr>
            <tr>
                <td>
                    <div class="inputbox mt15">
                        <textarea class="form-control" id="adopt_txtcontent"  name="content">非常感谢!</textarea>
                    </div>
                </td>
            </tr>
            <tr>
                <td><button type="button" id="adoptbtn" class="btn btn-success" >确&nbsp;认</button></td>
            </tr>
        </table>
    </form>

    </div>

  </div>
</div>

<script>
if(typeof($(".art-content").find("img").attr("data-original"))!="undefined"){
	var imgurl=$(".art-content").find("img").attr("data-original");
	$(".art-content").find("img").attr("src",imgurl);
}
$(".art-content").find("img").attr("data-toggle","lightbox");

$("#adoptbtn").click(function(){
	  var data={
    			content:$("#adopt_txtcontent").val(),
    			qid:$("#adopt_qid").val(),
    			aid:$("#adopt_answer").val()

    	}

	$.ajax({
	    //提交数据的类型 POST GET
	    type:"POST",
	    //提交的网址
	    url:"{url question/ajaxadopt}",
	    //提交的数据
	    data:data,
	    //返回数据的格式
	    datatype: "json",//"xml", "html", "script", "json", "jsonp", "text".
	    //在请求之前调用的函数
	    beforeSend:function(){},
	    //成功返回之后调用的函数
	    success:function(data){
	    	var data=eval("("+data+")");
	       if(data.message=='ok'){
	    	   new $.zui.Messager('采纳成功!', {
	    		   type: 'success',
	    		   close: true,
	       	    placement: 'center' // 定义显示位置
	       	}).show();
	    	   setTimeout(function(){
	               window.location.reload();
	           },1500);
	       }else{
	    	   new $.zui.Messager(data.message, {
	        	   close: true,
	        	    placement: 'center' // 定义显示位置
	        	}).show();
	       }


	    }   ,
	    //调用执行后调用的函数
	    complete: function(XMLHttpRequest, textStatus){

	    },
	    //调用出错执行的函数
	    error: function(){
	        //请求出错处理
	    }
	 });
})

</script>
</div>
<!-- 编辑标签 -->

<div class="modal fade" id="dialog_tag">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">关闭</span></button>
      <h4 class="modal-title">编辑标签</h4>
    </div>
    <div class="modal-body">

    <form  class="form-horizontal"  name="edittagForm"  action="{url question/edittag}" method="post" >
        <input type="hidden"  value="{$question['id']}" name="qid"/>

                <p>多个标签请以空格隔开!</p>

                    <div class="inputbox mar-t-1">
                        <input type="text" placeholder="多个标签请以空格隔开" class="form-control"  name="qtags" value="{eval echo implode(' ',$taglist)}"/>
                    </div>

            <div class="mar-t-1">

                <button type="submit" class="btn btn-success">保存</button>
                 <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </form>

    </div>

  </div>
</div>
</div>
 <!--{if 1==$user['grouptype'] && $user['uid']}-->
<div class="modal fade" id="catedialog">
<div class="modal-dialog modal-md" style="width: 460px; top: 50px;">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">关闭</span></button>
      <h4 class="modal-title">修改分类</h4>
    </div>
    <div class="modal-body">

      <div id="dialogcate">
        <form class="form-horizontal"  name="editcategoryForm" action="{url question/movecategory}" method="post">
            <input type="hidden" name="qid" value="{$question['id']}" />
            <input type="hidden" name="category" id="categoryid" />
            <input type="hidden" name="selectcid1" id="selectcid1" value="{$question['cid1']}" />
            <input type="hidden" name="selectcid2" id="selectcid2" value="{$question['cid2']}" />
            <input type="hidden" name="selectcid3" id="selectcid3" value="{$question['cid3']}" />
            <table class="table ">
                <tr valign="top">
                    <td >
                        <select  id="category1" class="catselect" size="8" name="category1" ></select>
                    </td>
                    <td align="center" valign="middle" ><div style="display: none;" id="jiantou1">>></div></td>
                    <td >
                        <select  id="category2"  class="catselect" size="8" name="category2" style="display:none"></select>
                    </td>
                    <td align="center" valign="middle" ><div style="display: none;" id="jiantou2">>>&nbsp;</div></td>
                    <td >
                        <select id="category3"  class="catselect" size="8"  name="category3" style="display:none"></select>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">


                <span>
                    <input  type="submit" class="btn btn-success" value="确&nbsp;认" onclick="change_category();"/></span>
                    <span>
                    <button type="button" class="btn btn-default mar-lr-1" data-dismiss="modal">关闭</button>
                    </span>


                    </td>
                </tr>
            </table>
        </form>
    </div>

    </div>

  </div>
</div>
</div>
  <!--{/if}-->
<!-- 举报 -->
<div class="modal fade panel-report" id="dialog_inform">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">关闭</span></button>
      <h4 class="modal-title">举报内容</h4>
    </div>
    <div class="modal-body">

<form id="rp_form" class="rp_form"  action="{url inform/add}" method="post">
<input value="" type="hidden" name="qid" id="myqid">
<input value="" type="hidden" name="aid" id="myaid">
<input value="" type="hidden" name="qtitle" id="myqtitle">
<div class="js-group-type group group-2">
<h4>检举类型</h4><ul>
<li class="js-report-con">
<label><input type="radio" name="group-type" value="1"><span>检举内容</span></label>
</li>
<li class="js-report-user">
<label><input type="radio" name="group-type" value="2"><span>检举用户</span></label>
</li>
</ul>
</div>
<div class="group group-2">
<h4>检举原因</h4><div class="list">
<ul>
<li>
<label class="reason-btn"><input type="radio" name="type" value="4"><span>广告推广</span></label>
</li>
<li>
<label class="reason-btn"><input type="radio" name="type" value="5"><span>恶意灌水</span></label>
</li>
<li>
<label class="reason-btn"><input type="radio" name="type" value="6"><span>回答内容与提问无关</span>
</label>
</li>
<li>
<label class="copy-ans-btn"><input type="radio" name="type" value="7"><span>抄袭答案</span></label>
</li>
<li>
<label class="reason-btn"><input type="radio" name="type" value="8"><span>其他</span></label>
</li>
</ul>
</div>
</div>
<div class="group group-3">
<h4>检举说明(必填)</h4>
<div class="textarea">
<ul class="anslist" style="display:none;line-height:20px;overflow:auto;height:171px;">
</ul>
<textarea name="content" maxlength="200" placeholder="请输入描述200个字以内">
</textarea>
</div>
</div>
    <div class="mar-t-1">

                <button type="submit" id="btninform" class="btn btn-success">提交</button>
                 <button type="button" class="btn btn-default mar-ly-1" data-dismiss="modal">关闭</button>
      </div>
</form>


    </div>

  </div>
</div>
</div>

<!-- 微信分享 -->
<div class="modal share-wechat animated" style="display: none;"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" data-dismiss="modal" class="close">×</button></div> <div class="modal-body"><h5>打开微信“扫一扫”，打开网页后点击屏幕右上角分享按钮</h5> <div data-url="{url question/view/$question['id']}" class="qrcode" title="{url question/view/$question['id']}"><canvas width="170" height="170" style="display: none;"></canvas>
<div id="qr_wxcode">
</div></div></div> <div class="modal-footer"></div></div></div></div>

<!-- 设置付费金额 -->
<div class="modal pay-money animated" style="display: none;">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">

<button type="button" data-dismiss="modal" class="close">×</button>
</div>
<div class="modal-body">
<h5>付费偷看金额在0.1-10元之间</h5>
<div class="mar-t-1">

<input type="number" value="0" id="chakanjine" class="form-control" />

</div>
 <button id="comfirm_pay" class="btn btn-success mar-t-1">确定</button>
</div>
 <div class="modal-footer">

 </div>
 </div>
 </div>
 </div>
  <script>
  <!--{if $setting['code_ask']}-->
  var needcode=1;
  <!--{else}-->
  var needcode=0;
    <!--{/if}-->
  var g_id = {$user['groupid']};
  var qid = {$question['id']};
  function listertext(){
  	 var _content=$("#anscontent").val();
  	 if(_content.length>0&&g_id!=1){

  		 $(".code_hint").show();
  	 }else{
  		 $(".code_hint").hide();
  	 }
  }
  {if $setting['mobile_localyuyin']==0}
  var mobile_localyuyin=0;
  {else}
  var mobile_localyuyin=1;
  {/if}
	//  var userAgent = window.navigator.userAgent.toLowerCase();
	//  $.browser.msie8 = $.browser.msie && /msie 8\.0/i.test(userAgent);
	 // if($.browser.msie8==true){
		//  var mobile_localyuyin=0;
	 // }
  var targetplay=null;
  $(".yuyinplay").click(function(){
  	targetplay=$(this);
  	var _serverid=targetplay.attr("id");
  	   if(_serverid == '') {
  			alert('语音文件丢失');
             return;
         }
  	   $(".wtip").html("免费偷听");
  	   targetplay.find(".wtip").html("播放中..");
  	   if(mobile_localyuyin==1){
  		 $(".htmlview").removeClass("hide");
		   $(".ieview").addClass("hide");

  		   var myAudio =targetplay.find("#voiceaudio")[0];
  	  	  // myAudio.pause();
  	  	   //myAudio.play();
  	  	   if(myAudio.paused){
  	  		   targetplay.find(".wtip").html("播放中..");
  	             myAudio.play();
  	         }else{
  	      	   targetplay.find(".wtip").html("暂停..");
  	             myAudio.pause();
  	         }
  	  	   function endfun(){ targetplay.find(".wtip").html("播放结束");alert("播放结束!")}
  	  	   var   is_playFinish = setInterval(function(){
  	             if( myAudio.ended){

  	          	   endfun();
  	  	                    window.clearInterval(is_playFinish);
  	             }
  	     }, 10);
  	   }else{

  		 $(".ieview").removeClass("hide");
  		   $(".htmlview").addClass("hide");
  	   }




  })
function deleteanswer(current_aid){
	window.location.href=g_site_url + "index.php" + query + "question/deleteanswer/"+current_aid+"/$question['id']";

}
  function adoptanswer(aid) {

      $("#adopt_answer").val(aid);

      $('#dialogadopt').modal('show');
}
  //编辑标签
  function edittag() {
 	 $('#dialog_tag').modal('show');

 }
  if(typeof($(".show-content").find("img").attr("data-original"))!="undefined"){
		var imgurl=$(".show-content").find("img").attr("data-original");
		$(".show-content").find("img").attr("src",imgurl);
	}
	$(".show-content").find("img").attr("data-toggle","lightbox");

  var category1 = {$categoryjs[category1]};
  var category2 = {$categoryjs[category2]};
  var category3 = {$categoryjs[category3]};
  var selectedcid = "{$question['cid1']},{$question['cid2']},{$question['cid2']}";
  //修改分类
  function change_category() {
      var category1 = $("#category1 option:selected").val();
              var category2 = $("#category2 option:selected").val();
              var category3 = $("#category3 option:selected").val();
              if (category1 > 0) {
      $("#categoryid").val(category1);
      }
      if (category2 > 0) {
      $("#categoryid").val(category2);
      }
      if (category3 > 0) {
      $("#categoryid").val(category3);
      }
      $("#catedialog").model("hide");
              $("form[name='editcategoryForm']").submit();
      }
  //投诉
  function openinform(qid ,qtitle,aid) {
	  $("#myqid").val(qid);
	  $("#myqtitle").val(qtitle);
	  $("#myaid").val(aid);
 	 $('#dialog_inform').modal('show');

 }
  function show_comment(answerid) {
      if ($("#comment_" + answerid).css("display") === "none") {
      load_comment(answerid);
              $("#comment_" + answerid).slideDown();
      } else {
      $("#comment_" + answerid).slideUp();
      }
      }
  //添加评论
  function addcomment(answerid) {
  var content = $("#comment_" + answerid + " input[name='content']").val();
  var replyauthor = $("#comment_" + answerid + " input[name='replyauthor']").val();
  if (g_uid == 0){
      login();
      return false;
  }
  if (bytes($.trim(content)) < 5){
  alert("评论内容不能少于5字");
          return false;
  }
  $.ajax({
  type: "POST",
          url: "{url answer/addcomment}",
          data: "content=" + content + "&answerid=" + answerid+"&replyauthor="+replyauthor,
          success: function(status) {
          if (status == '1') {
          $("#comment_" + answerid + " input[name='content']").val("");
                  load_comment(answerid);
          }else{
          	if(status == '-2'){
          		alert("问题已经关闭，无法评论");
          	}
          }
          }
  });
  }

  //删除评论
  function deletecomment(commentid, answerid) {
  if (!confirm("确认删除该评论?")) {
  return false;
  }
  $.ajax({
  type: "POST",
          url: "{url answer/deletecomment}",
          data: "commentid=" + commentid + "&answerid=" + answerid,
          success: function(status) {
          if (status == '1') {
          load_comment(answerid);
          }
          }
  });
  }
  //加载评论
  function load_comment(answerid){
  $.ajax({
  type: "GET",
          cache:false,
          url: "{SITE_URL}index.php?answer/ajaxviewcomment/" + answerid,
          success: function(comments) {
          $("#comment_" + answerid + " .my-comments-list").html(comments);
          }
  });
  }

  function replycomment(commentauthorid,answerid){
      var comment_author = $("#comment_author_"+commentauthorid).attr("title");
      $("#comment_"+answerid+" .comment-input").focus();
      $("#comment_"+answerid+" .comment-input").val("回复 "+comment_author+" :");
      $("#comment_" + answerid + " input[name='replyauthor']").val(commentauthorid);
  }
	$(function(){
		  initcategory(category1);
          fillcategory(category2, $("#category1 option:selected").val(), "category2");
          fillcategory(category3, $("#category2 option:selected").val(), "category3");
		var qrurl=g_site_url+"/?question/view/"+qid;
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
	     $(".button_agree").click(function(){
             var supportobj = $(this);
                     var answerid = $(this).attr("id");
                     $.ajax({
                     type: "GET",
                             url:"{SITE_URL}index.php?answer/ajaxhassupport/" + answerid,
                             cache: false,
                             success: function(hassupport){
                             if (hassupport != '1'){






                                     $.ajax({
                                     type: "GET",
                                             cache:false,
                                             url: "{SITE_URL}index.php?answer/ajaxaddsupport/" + answerid,
                                             success: function(comments) {

                                             supportobj.find("span").html(comments+"人赞");
                                             }
                                     });
                             }else{
                            	 alert("您已经赞过");
                             }
                             }
                     });
             });

	})


                </script>
<!--{template footer}-->