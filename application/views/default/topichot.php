<!--{template header}-->
<!--{eval $adlist = $this->fromcache("adlist");}-->
<div class="container index">
    <div class="row">
    <div class="col-xs-17 main">
    <div class="recommend-collection">
             站长推荐文章
          </div>
    <div class="split-line"></div>
    <div id="list-container">
     <!--{if $topiclist==null}-->
     <div class="text"><span>目前还没有推荐文章</span> </div>
        <!--{/if}-->
    <!-- 文章列表模块 -->
    <ul class="note-list" >


             <!--{loop $topiclist $index $topic}-->

   <li id="note-{$topic['id']}" data-note-id="{$topic['id']}" {if $topic['image']!=null}  class="have-img" {else}class="" {/if}>
    {if $topic['image']!=null}
      <a class="wrap-img"  href="{url topic/getone/$topic['id']}"  target="_blank">
            <img src="{$topic['image']}">
        </a>
            {/if}
        <div class="content">
            <div class="author">






        <a class="avatar" target="_blank" href="{url user/space/$topic['authorid']}">
                    <img src="{$topic['avatar']}" alt="96">
                </a>      <div class="name">
                <a class="blue-link" target="_blank" href="{url user/space/$topic['authorid']}">{$topic['author']}</a>




                <span class="time" data-shared-at="{$topic['format_time']}">{$topic['format_time']}</span>
            </div>
            </div>
            <a class="title" target="_blank"   href="{url topic/getone/$topic['id']}"  >{$topic['title']}</a>
            <p class="abstract">
                   {if $topic['price']!=0}
                         <div class="box_toukan ">


											<a  class="thiefbox font-12" ><i class="icon icon-lock font-12"></i> &nbsp;阅读需支付&nbsp;$topic['price']&nbsp;&nbsp;积分……</a>



										</div>
                   {else}
                     {eval echo clearhtml($topic['describtion']);}

                    {/if}

            </p>
            <div class="meta">
  <a class="collection-tag" target="_self" href="{url topic/catlist/$topic['articleclassid']}">$topic['category_name']</a>

                <a target="_blank"  href="{url topic/getone/$topic['id']}" >
                    <i class="fa fa-eye"></i> {$topic['views']}
                </a>        <a target="_blank"   href="{url topic/getone/$topic['id']}#comments" >
                <i class="fa fa-comment-o"></i> {$topic['articles']}
            </a>      <span><i class=" fa fa-heart-o"></i>  {$topic['likes']}</span>

            <a title="取消热文推荐" href="{url topic/cancelhot/$topic['id']}">取消热文推荐</a>
            </div>
        </div>
    </li>

    <!--{/loop}-->

    </ul>
    <!-- 文章列表模块 -->
    <div class="pages">
    $departstr
    </div>
    </div>
    </div>

    <!--右边栏目-->
    <div class="col-xs-7  aside rightpanel">

     <!--{template sider_author}-->
      <!--{template sider_newarticle}-->


    </div>





        </div>


    </div>
<!--{template footer}-->