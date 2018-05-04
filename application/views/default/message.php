<!--{template header}-->
<link rel="stylesheet" media="all" href="{SITE_URL}static/css/bianping/css/space.css" />
<style>
.detail a{
	color: #ea644a;
    font-size: 12px;
}
.related .pv,.tooltip{
	font-size: 12px;
}
</style>
<!--用户中心-->


    <div class="container person">

        <div class="row ">
            <div class="col-xs-17 main">

            <!-- 内容页面 -->
    <div class="row">
                 <div class="col-sm-24">

                     <div class="dongtai">

                             <div> <strong class="mar-b-1 font-18 ">我的消息</strong></div>

                        <hr>
                         <p>

                          <button type="button" class="btn btn-success mar-l-1 pull-right" onclick="javascript:document.location = '{url message/updateunread}'">清空未读消息</button>
                         <button type="button" class="btn btn-default pull-right mar-ly-1" onclick="javascript:document.location = '{url message/sendmessage}'">写消息</button>
                         </p>
                                       <ul class="nav nav-secondary clear mar-t-05" >
        <li <!--{if $regular=="message/personal"}--> class="active"<!--{/if}-->>
        <a href="{url message/personal}">私人消息<span class="p-msg-count icon_hot"></span></a>
        </li>
                    <li <!--{if $regular=="message/system"}--> class="active"<!--{/if}-->>

                   <a href="{url message/system}">系统消息<span class="s-msg-count icon_hot"></span></a>
                    </li>

             </ul>
                         <hr >
                          <form  class="form-horizontal"  name="msgform" {if $type=='system'}action="{url message/remove}"{else}action="{url message/removedialog}"{/if} method="POST" onsubmit="javascript:if (!confirm('确定删除所选消息全部内容?')) return false;">
                                 <ul class="nav">
                    <!--{loop $messagelist $message}-->
                    <li id="msg{$message['id']}" {if $message['new']}class="new"{/if}>

                        <div class="row">
                          <div class="col-sm-1">
                            <!--{if $message['fromuid']}-->
                           <div class="avatar">
                            <a href="{url user/space/$message['fromuid']}" title="supermustang" target="_blank" class="pic"><img alt="{$message['from']}" src="{$message['from_avatar']}" /></a>
                        </div>
                          <!--{/if}-->
                          </div>

                          <div class="col-sm-24">

                           <div class="msgcontent ">
                            <p class="font-12" style="font-weight:600">
                                <!--{if $message['fromuid']==0}-->
                                <input type='checkbox' value="{$message['id']}" name="messageid[inbox][]"/>
                                {$message['subject']}
                                <!--{else}-->
                                <input type='checkbox' value="{$message['fromuid']}" name="message_author[]"/>
                                <a href="{url user/space/$message['fromuid']}">{$message['from']}</a> 对 <a href="{url user/score}">您</a> 说：
                                {$message['subject']}
                                <!--{/if}-->

                                  <!--{if $message['new']==1}-->
                                       <span class="icon_hot">新</span>
                                                <!--{/if}-->

                            </p>
                            <!--{if $type!='system'}-->
                            <div class="detail" style="cursor:pointer" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="查看并回复消息"  onclick="javascript:document.location = '{url message/view/$type/$message[fromuid]/$message['id']}';">{eval echo cutstr($message['content'],300,'')}</div>
                            <!--{else}-->
                            <div class="detail" style="">{$message['content']}</div>
                            <!--{/if}-->
                            <div class="related">
                                <div class="pv">{$message['format_time']}</div>
                            </div>
                        </div>
                          </div>
                        </div>



                    </li>
                    <!--{/loop}-->
                </ul>
                {if $messagelist!=null}
                          <div class="row mar-t-1">
                          <div class="col-sm-12">
                           <input type="checkbox" value="chkall" id="chkall" onclick="checkall('message');"/> 全选  <button type="submit"  name="submit" class="btn btn-success mar-ly-1" >删除</button>

                          </div>

                    <div class="clearfix"></div>
                </div>
                {/if}
                          </form>
                     </div>
                 </div>


             </div>
               <div class="pages">{$departstr}</div>
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