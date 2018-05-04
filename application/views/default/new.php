<!--{template header}-->
<link rel="stylesheet" media="all" href="{SITE_URL}static/css/bianping/css/category.css" />
<div class="container collection index" style="padding-top:10px;">

  <div class="row" style="padding-top:0px;margin-top:0px">
    <div class=" col-xs-17   main" style="padding-top:10px;">
  <div class="recommend-collection">
             最新问题
          </div>
    <div class="split-line"></div>
 <div id="list-container">
        <!-- 文章列表模块 -->
<ul class="note-list" >

                <!--{loop $questionlist $index $question}-->

    <li id="note-{$question['id']}" data-note-id="{$question['id']}" {if $question['image']!=null}  class="have-img" {else}class="" {/if}>
    {if $question['image']!=null}
      <a class="wrap-img" {if isset($question['articleclassid'])} href="{url topic/getone/$question['id']}"  {else}  href="{url question/view/$question['id']}" {/if} target="_blank">
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
            <a class="title" target="_blank"  {if isset($question['articleclassid'])} href="{url topic/getone/$question['id']}"  {else}  href="{url question/view/$question['id']}" {/if} >{$question['title']}</a>
            <p class="abstract">
                {eval echo strip_tags($question['description']);}

            </p>
             <div class="meta" style="margin:10px auto">


                                <!--{if $question['tags']}-->


<!--{loop $question['tags'] $tag}-->
<span><a  class="label " target="_blank" style="color:#fff" title="$tag" href="{url question/search/$tag}">{$tag}</a></span>

                <!--{/loop}--><!--{else}--><!--{/if}-->
                                </div>
            <div class="meta">

                <a target="_blank" {if isset($question['articleclassid'])} href="{url topic/getone/$question['id']}"  {else}  href="{url question/view/$question['id']}" {/if}>
                    <i class="fa fa-eye"></i> {$question['views']}
                </a>        <a target="_blank" {if isset($question['articleclassid'])} href="{url topic/getone/$question['id']}#comments"  {else}  href="{url question/view/$question['id']}#comments" {/if}>
                <i class="fa fa-comment-o"></i> {$question['answers']}
            </a>      <span><i class=" fa fa-heart-o"></i>  {$question['attentions']}</span>
            </div>
        </div>
    </li>

    <!--{/loop}-->


</ul>

      </div>

        </div>
 <div class=" col-xs-7 aside">
 <!--{template sider_login}-->
 <!--{template sider_topic}-->


            <!--{template sider_hotarticle}-->
 </div>
        </div>
          <div class="pages">
                           {$departstr}
                        </div>
      </div>


<!--{template footer}-->