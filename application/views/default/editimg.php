<!--{template header}-->
<link rel="stylesheet" media="all" href="{SITE_URL}static/css/bianping/css/space.css" />

<!--用户中心-->


    <div class="container person">

        <div class="row ">
            <div class="col-xs-17 main">
           <!--{template user_title}-->
       <!-- 内容页面 -->
    <div class="row">
                 <div class="col-sm-24">
                     <div class="dongtai">
                         <p>
                             <strong class="font-18">修改头像</strong>
                         </p>

                              <ul class="trigger-menu" data-pjax-container="#list-container">
        <li><a href="{url user/profile}">个人资料</a></li>
                    <li><a href="{url user/uppass}">修改密码</a></li>
                     <li class=""><a href="{url user/editemail}">激活</a></li>
                    <li class="active"><a href="{url user/editimg}">修改头像</a></li>
                    <li>
                    <a href="{url user/mycategory}">我的设置</a>
                    </li>
                      <li>
                    <a href="{url user/vertify}">申请认证</a>
                    </li>
             </ul>


  <!--{if isset($imgstr)}-->
                {$imgstr}
                <!--{else}-->
                <p> 说明：</p>
                <ul class="nav">
                <li>
                  1、支持jpg、gif、png、jpeg四种格式图片上传
                </li>
                 <li>
                   2、图片大小不能超过2M;
                </li>
                 <li>
                3、图片长宽大于165*165px时系统将自动压缩
                </li>
                </ul>

 <form class="form-horizontal"  action="{url user/editimg/$user['uid']}" method="post"  enctype="multipart/form-data">
  <div class="form-group">

          <div class="col-md-24 mar-t-1">
              <img class="avatar" alt="{$user['username']}" src="{$user['avatar']}" />
          </div>
            <div class="col-md-24 mar-t-1">
             <input id="file_upload" name="userimage" type="file"/>
                            <button type="submit" name="uploadavatar" id="uploadavatar" class="btn btn-success mar-t-1" >
                            上&nbsp;传 </button>
          </div>
        </div>
 </form>
                 <!--{/if}-->

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




<!--{template footer}-->