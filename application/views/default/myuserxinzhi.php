<!--{template header}-->
<link rel="stylesheet" media="all" href="{SITE_URL}static/css/bianping/css/space.css" />
<div class="container person">
  <div class="row">
    <div class="col-xs-17 main">
          <!-- 用户title部分导航 -->

           <!--{if $uid==$user['uid']}-->
              <!--{template user_title}-->
             <!--{else}-->
                <!--{template space_title}-->
               <!--{/if}-->


         <ul class="trigger-menu" data-pjax-container="#list-container">
 <liclass=""><a href="{url user/default}"><i class="fa fa-clipboard"></i> 动态</a></li>
<li class=""><a href="{url user/ask}"><i class="fa fa-question-circle-o"></i> 提问</a></li>
<li class=""><a href="{url user/answer}"><i class="fa fa-comments"></i>回答</a></li>
<li class="active"><a href="{url ut-$user['uid']}"><i class="fa fa-rss"></i>文章</a></li>
<li class=""><a href="{url user/recommend}"><i class="fa fa-newspaper-o"></i>推荐</a></li>
 </ul>
      <div id="list-container">
        <!-- 回答列表模块 -->
<ul class="note-list">
   <!--{if $topiclist}-->

        <!--{loop $topiclist $index $topic}-->

    <li id="note-{$topic['id']}" data-note-id="{$topic['id']}" {if $topic['image']!=null}  class="have-img" {else}class="" {/if}>
    {if $topic['image']!=null}
      <a class="wrap-img"  href="{url topic/getone/$topic['id']}"  target="_self">
            <img src="{$topic['image']}">
        </a>
            {/if}
        <div class="content">
            <div class="author">






        <a class="avatar" target="_self" href="{url user/space/$topic['authorid']}">
                    <img src="{$topic['avatar']}" alt="96">
                </a>      <div class="name">
                <a class="blue-link" target="_self" href="{url user/space/$topic['authorid']}">{$topic['author']}</a>




                <span class="time" data-shared-at="{$topic['format_time']}">{$topic['format_time']}</span>
            </div>
            </div>
            <a class="title" target="_self"   href="{url topic/getone/$topic['id']}"  >{$topic['title']}</a>
            <p class="abstract">
                {eval echo strip_tags($topic['describtion']);}

            </p>
            <div class="meta">

                <a target="_self"  href="{url topic/getone/$topic['id']}" >
                    <i class="fa fa-eye"></i> {$topic['views']}
                </a>        <a target="_self"   href="{url topic/getone/$topic['id']}#comments" >
                <i class="fa fa-comment-o"></i> {$topic['articles']}
            </a>      <span><i class=" fa fa-heart-o"></i>  {$topic['likes']}</span>
             <a target="_self"   href=" {url user/editxinzhi/$topic['id']}" >
                <i class="fa fa-edit"></i> 编辑文章
            </a>


            </div>
        </div>
    </li>

    <!--{/loop}-->
      <!--{else}-->

          <!--{/if}-->














</ul>
  <div class="pages" >{$departstr}</div>
      </div>
    </div>

<div class="col-xs-7  aside">
  <!--{if $uid==$user['uid']}-->
              <!--{template user_menu}-->
             <!--{else}-->
                 <!--{template space_menu}-->
               <!--{/if}-->



</div>

  </div>
</div>
<!--{template footer}-->