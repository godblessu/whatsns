<!--{template header}-->
<link rel="stylesheet" media="all" href="{SITE_URL}static/css/bianping/css/space.css" />






<!--用户中心-->


    <div class="container person">

        <div class="row ">
            <div class="col-xs-16 main">
            <!-- 用户title部分导航 -->
   <!--{template user_title}-->
             <!-- title结束标记 -->
       <!-- 内容页面 -->
    <div class="row">
                 <div class="col-sm-24">
                     <div class="dongtai">

                         <ul class="trigger-menu" data-pjax-container="#list-container">
        <li><a href="{url user/profile}">个人资料</a></li>
                    <li class="active"><a href="{url user/uppass}">修改密码</a></li>
                  <li class=""><a href="{url user/editemail}">激活</a></li>
                    <li ><a href="{url user/editimg}">修改头像</a></li>
                    <li>
                    <a href="{url user/mycategory}">我的设置</a>
                    </li>
                      <li>
                    <a href="{url user/vertify}">申请认证</a>
                    </li>
             </ul>



                    <form class="form-horizontal"  action="{url user/uppass}"  method="post" >
 <div class="form-group">
          <p class="col-md-24 ">当前密码</p>
          <div class="col-md-14">
             <input type="password" id="oldpwd" name="oldpwd"  value="" placeholder="" class="form-control">
          </div>
        </div>
         <div class="form-group">
          <p class="col-md-24 ">新密码</p>
          <div class="col-md-14">
             <input type="password" id="newpwd"  name="newpwd"  value="" placeholder="" class="form-control">
          </div>
        </div>

         <div class="form-group">
          <p class="col-md-24 ">确认密码</p>
          <div class="col-md-14">
             <input type="password" id="confirmpwd"  name="confirmpwd"  value="" placeholder="" class="form-control">
          </div>
        </div>

     <!--{template code}-->

        <div class="form-group">
          <div class=" col-md-10">
             <input type="submit" name="submit" id="submit" class="btn btn-success" value="保存" data-loading="稍候...">
          </div>
        </div>
 </form>
                     </div>
                 </div>


             </div>
            </div>

            <!--右侧栏目-->
            <div class="col-xs-7 col-xs-offset-1 aside ">




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
    function check_form(){
        var money_reg = /\d{1,4}/;
        var money = $("#money").val();
        if('' == money || !money_reg.test(money) || money>20000 ||  money<=0){
            alert("输入充值金额不正确!充值金额必须为整数，且单次充值不超过20000元!");
            return false;
        }
        return true;
    }
</script>
<!--{template footer}-->