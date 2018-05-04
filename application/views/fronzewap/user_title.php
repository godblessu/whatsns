<div class="user-header-info">
   <i class="ui-icon-set icon_setting"></i>
    <ul class="ui-row">
        <li class="ui-col ui-col-25">
            <div class="ui-avatar-lg">
                <span style="background-image:url({$user['avatar']})"></span>
            </div>
        </li>
        <li class="ui-col ui-col-75">
              <p>

                  <span class="ui-txt-highlight user-name">
                  {$user['username']}
                   {if $user['author_has_vertify']!=false}<i class="fa fa-vimeo {if $user['author_has_vertify'][0]=='0'}v_person {else}v_company {/if}  " data-toggle="tooltip" data-placement="right" title="" {if $user['author_has_vertify'][0]=='0'}data-original-title="个人认证" {else}data-original-title="企业认证" {/if} ></i>{/if}
                  </span>
              </p>

                <ul class="ui-user-tiled">
                    <li><div>{$user['answers']}</div><i>回答</i></li>
                    <li><div>{$user['questions']}</div><i>提问</i></li>
                    <li><div>{$user['followers']}</div><i>粉丝</i></li>
                    <li><div>{$user['credit1']}</div><i>经验</i></li>
                    <li><div>{$user['credit2']}</div><i>财富</i></li>
                     <li><div>{eval echo $user['jine']/100}元</div><i>钱包</i></li>
                </ul>

        </li>

        </ul>

        <section class="ui-leftsilde">
<div class="ui-actionsheet">
  <div class="ui-actionsheet-cnt">
    <h4>我的管理中心导航</h4>


    <button onclick="window.location.href='{url user/editimg}'">修改头像</button>
     <button onclick="window.location.href='{url user/profile}'">修改个人信息</button>
     <button onclick="window.location.href='{url user/uppass}'">修改密码</button>
       <button onclick="window.location.href='{url user/editemail}'">激活邮箱和手机号</button>
      <button class="ui-actionsheet-del" onclick="window.location.href='{url user/logout}'">
                退出
            </button>
    <button onclick="hidemenu()">取消</button>
  </div>
</div>


</section>
</div>