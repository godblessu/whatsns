

            {if $member['vertify']['status']==1}
            <div class="recommend">
   <div class="title">
     <i class="fa fa-renzheng"></i>
   <span  class="title_text">认证信息</span>

   </div>

  <div class="description">

    <div class="js-intro"  style="color:#908d08">
    {$member['vertify']['jieshao']}
    </div>


  </div>
  </div>
   {/if}

          <div class="recommend">
   <div class="title">
     <i class="fa fa-jieshao"></i>
   <span  class="title_text">个人介绍</span>

   </div>

  <div class="description">
    <div class="js-intro">
{if $member['signature']}{$member['signature']}{else}暂无介绍{/if}
    </div>


  </div>
  </div>


  <ul class="list user-dynamic">
    <li>
      <a href="{url user/space/$member['uid']}">
        <i class="fa fa-home"></i> <span>TA的首页</span>
</a>    </li>
    <li>
      <a href="{url user/space_ask/$member['uid']/1}">
        <i class="fa fa-question-circle-o"></i> <span>TA的提问</span>
</a>    </li>

   <li>
      <a href="{url user/space_answer/$member['uid']}">
        <i class="fa fa-commenting-o"></i> <span>TA的回答</span>
</a>    </li>

   <li>
      <a href="{url topic/userxinzhi/$member['uid']}">
        <i class="fa fa-sticky-note"></i> <span>TA的文章</span>
</a>    </li>
 <li>
      <a href="{url user/space_attention/topic/$member['uid']}">
        <i class="fa fa-sticky-note"></i> <span>TA关注的话题</span>
</a>    </li>

  </ul>
