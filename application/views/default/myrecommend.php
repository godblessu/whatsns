<!--{template header}-->

<link rel="stylesheet" media="all" href="{SITE_URL}static/css/bianping/css/space.css" />





<!--用户中心-->


    <div class="container person">

        <div class="row " style="">
            <div class="col-xs-17 main">
            <!-- 用户title部分导航 -->
              <!--{template user_title}-->
             <!-- title结束标记 -->
       <!-- 内容页面 -->
    <div class="row" style="padding-top:0px">
                 <div class="col-sm-24">
                     <div class="dongtai">
                        <ul class="trigger-menu" data-pjax-container="#list-container">
 <li class=""><a href="{url user/default}"><i class="fa fa-clipboard"></i> 动态</a></li>
<li class=""><a href="{url user/ask}"><i class="fa fa-question-circle-o"></i> 提问</a></li>
<li class=""><a href="{url user/answer}"><i class="fa fa-comments"></i>回答</a></li>
<li class=""><a href="{url ut-$user['uid']}"><i class="fa fa-rss"></i>文章</a></li>
<li class="active"><a href="{url user/recommend}"><i class="fa fa-newspaper-o"></i>推荐</a></li>
 </ul>

<div id="list-container">
        <!-- 文章列表模块 -->
<ul class="note-list">
   <!--{if $questionlist}-->

      <!--{loop $questionlist $question}-->

    <li id="note-{$question['id']}" data-note-id="{$question['id']}" {if $question['image']!=null}  class="have-img" {else}class="" {/if}>
    {if $question['image']!=null}
      <a class="wrap-img" {if $question['articleclassid']!=null} href="{url topic/getone/$question['id']}"  {else}  href="{url question/view/$question['id']}" {/if} target="_blank">
            <img src="{$question['image']}">
        </a>
            {/if}
        <div class="content">
            <div class="author">





        {if $question['hidden']==1}

          <a class="avatar"  href="javascript:void(0)">
                    <img src="{$question['avatar']}" alt="96">
                </a>      <div class="name">
                <a class="blue-link"  href="javascript:void(0)">匿名用户</a>


        {else}
        <a class="avatar" target="_blank" href="{url user/space/$question['authorid']}">
                    <img src="{$question['avatar']}" alt="96">
                </a>      <div class="name">
                <a class="blue-link" target="_blank" href="{url user/space/$question['authorid']}">{$question['author']}</a>

        {/if}


                <span class="time" data-shared-at="{$question['format_time']}">{$question['format_time']}</span>
            </div>
            </div>
            <a  target="_blank"   href="{url question/view/$question['id']}"  >{$question['title']}</a>

            <div class="meta">

                <a target="_blank"  href="{url question/view/$question['id']}" >
                    <i class="fa fa-eye"></i> {$question['views']}
                </a>        <a target="_blank"   href="{url question/view/$question['id']}#comments" >
                <i class="fa fa-comment-o"></i> {$question['answers']}
            </a>      <span><i class=" fa fa-heart-o"></i>  {$question['attentions']}</span>
            </div>
        </div>
    </li>

    <!--{/loop}-->
      <!--{else}-->
       <div class="text">
          <p>   <span>亲，快设置下擅长领域吧，设置后可根据您的兴趣爱好为您推荐合适的问题!</span><a class="btn " href="{url user/mycategory}">点击设置擅长领域</a></p>
          </div>
          <!--{/if}-->














</ul>
  <div class="pages" >{$departstr}</div>
      </div>




                     </div>
                 </div>


             </div>
            </div>

            <!--右侧栏目-->
            <div class="col-xs-7  aside">




                <!--导航列表-->

               <!--{template user_menu}-->

                <!--结束导航标记-->


                <div>

                </div>


            </div>

        </div>

    </div>



<!--用户中心结束-->

<!--{template footer}-->