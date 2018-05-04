<!--{template header}-->
<link rel="stylesheet" media="all" href="{SITE_URL}static/css/bianping/css/space.css" />



<!--用户中心大背景结束标记-->

<!--用户中心-->


    <div class="container person">

        <div class="row ">
            <div class="col-xs-17 main">
              <!-- 用户title部分导航 -->
              <!--{template user_title}-->
             <!-- title结束标记 -->
            <!-- 内容页面 -->
    <div class="row">
                 <div class="col-sm-24">
                     <div class="dongtai">
                         <p class="pull-left">
                             <strong class="mar-l-1 font-18 ">我的消息</strong>
                        </p>
                         <button type="button" class="btn btn-success pull-right" onclick="javascript:document.location = '{url message/send}'">写消息</button>
                       <hr style="clear:both">
                                       <ul class="nav nav-secondary clearfix mar-t-05" >
        <li <!--{if $regular=="message/personal"}--> class="active"<!--{/if}-->>
        <a href="{url message/personal}">私人消息</a>
        </li>
                    <li <!--{if $regular=="message/system"}--> class="active"<!--{/if}-->>

                   <a href="{url message/system}">系统消息</a>
                    </li>

             </ul>
                         <hr >
                          <form class="form-horizontal"  name="msgform" action="{url message/remove}" method="POST" onsubmit="javascript:if (!confirm('确定删除所选消息?')) return false;">

                                 <ul class="nav">
                     <!--{loop $messagelist $message}-->
                    <li>
                    <div class="row">

                    <div class="col-sm-2">
                     <!--{if $message['fromuid']}-->
                        <div class="avatar">
                            <a href="{url user/space/$message['fromuid']}" title="supermustang" target="_blank" class="pic"><img width="48px" height="48px" class="img-rounded" alt="{$message['from']}" src="{$message['from_avatar']}"/></a>
                        </div>
                        <!--{/if}-->
                    </div>

                     <div class="col-sm-22">
                     <div class="msgcontent">
                            <p class="font-12" style="font-weight:600">
                                <!--{if $message['fromuid']==$user['uid']}-->
                                <input type='checkbox' value="{$message['id']}" name="messageid[outbox][]"/>
                                <a href="{url user/score}">您</a> 对 <a href="{url user/space/$message['fromuid']}">{$message['touser']}</a> 说：
                                <!--{else}-->
                                <input type='checkbox' value="{$message['id']}" name="messageid[inbox][]"/>
                                <a href="{url user/space/$message['fromuid']}">{$message['from']}</a> 对 <a href="{url user/score}">您</a> 说：
                                <!--{/if}-->
                                {$message['subject']}
                            </p>
                            <p class="news_content">{$message['content']}</p>
                            <div class="related">
                                <div class="pv">{$message['format_time']}</div>
                            </div>
                        </div>
                    </div>
                    </div>


                        <div class="clr"></div>
                    </li>
                    <!--{/loop}-->
                </ul>

                          <div class="row mar-t-1">
                          <div class="col-sm-24">
                           <input type="checkbox" value="chkall" id="chkall" onclick="checkall('message');"/> 全选  <button type="submit"  name="submit" class="btn btn-danger" >删除</button>

                          </div>

                    <div class="clearfix"></div>
                </div>
                          </form>

                             <!--{if 'personal'==$type}-->

                               <div class="row mar-t-1">
                               <div class="col-sm-24">

                                     <ul class="nav">
                <form class="form-horizontal"   name="commentform" action="{url message/sendmessage}" method="POST" onsubmit="return check_form();">
                    <li>
                    <div class="row">
                    <div class="col-sm-2">
                     <div class="avatar">
                            <span class="pic"><img width="48px" height="48px" class="img-rounded" alt="{$user['username']}" src="{$user['avatar']}"/></span>
                        </div>
                    </div>
                     <div class="col-sm-22">

                        <div class="msgcontent">

                  <!--{template editor}-->
                            <div class="row mar-t-1">


                                 <!--{if $setting['code_message']=='1'}-->
                                  <!--{template code}-->

                      <!--{/if}-->




                               <button type="submit"  class="btn btn-success " name="submit">提&nbsp;交</button>

                                <input type="hidden" name="username" value="{$fromuser['username']}" />

                            </div>
                        </div>
                    </div>
                    </div>

                        <div class="clr clear"></div>
                    </li>
                </form>
            </ul>
                               </div>

                               </div>
                               <!--{/if}-->

                            <div class="pages">{$departstr}</div>

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
<script type="text/javascript">
function check_form() {
    if ($.trim(UE.getEditor('content').getPlainTxt()) == '') {
        alert("消息内容不能为空!");
        return false;
    }
    return true;
}
</script>
<!--{template footer}-->