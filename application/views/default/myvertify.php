<!--{template header}-->
<link rel="stylesheet" media="all" href="{SITE_URL}static/css/bianping/css/space.css" />






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
           <ul class="trigger-menu" data-pjax-container="#list-container">
        <li><a href="{url user/profile}">个人资料</a></li>
                    <li ><a href="{url user/uppass}">修改密码</a></li>
                 <li class=""><a href="{url user/editemail}">激活</a></li>
                    <li ><a href="{url user/editimg}">修改头像</a></li>
                    <li >
                    <a href="{url user/mycategory}">我的设置</a>
                    </li>
                      <li class="active">
                    <a href="{url user/vertify}">申请认证</a>
                    </li>
             </ul>



                    <form class="form-horizontal"  method="POST" id="vertify_form"  >
 <div class="form-group">
          <p class="col-md-6 text-left">当前状态:</p>
          <div class="col-md-8">
          {if !isset($vertify['msg'])}
                    未认证
          {else}
          {$vertify['msg']}
          {/if}
          {if $vertify['status']==2}
          <div style="color:#777"> 驳回原因:{$vertify['shibaiyuanyin']}</div>
          {/if}
          </div>
        </div>


       <div class="form-group">
          <p class="col-md-6 text-left ">认证类型:</p>
          <div class="col-md-14">
           {eval if ($setting['vertify_gerentip']==null||trim($setting['vertify_gerentip'])=='')$setting['vertify_gerentip']='个人';}
                        <span><input type="radio" value="0" {if $vertify['status']==0}disabled{/if}  class="normal_radio vertify_type" name="type" <!--{if isset($vertify['type'])&&(0 == $vertify['type'])}--> checked <!--{/if}-->/>{$setting['vertify_gerentip']} &nbsp;&nbsp;</span>
           {eval if ($setting['vertify_qiyetip']==null||trim($setting['vertify_qiyetip'])=='')$setting['vertify_qiyetip']='企业';}
                        <span><input type="radio" value="1" {if $vertify['status']==0}disabled{/if}  class="normal_radio vertify_type" name="type" <!--{if isset($vertify['type'])&&(1 == $vertify['type'])}--> checked <!--{/if}--> />{$setting['vertify_qiyetip']}</span>
          </div>
        </div>
         <div class="form-group">
           {eval if ($setting['cansetcatnum']==null||trim($setting['cansetcatnum'])=='')$setting['cansetcatnum']='1';}
          <p class="col-md-6 text-left ">擅长领域(最多{$setting['cansetcatnum']}个)：</p>
          <div class="col-md-18">
             <input type="hidden" value="" name="cids" id="cate_value" />
            {if $vertify['status']!=0}
             <div {if count($user['category'])>=$setting['cansetcatnum']}class="btn disabled  btn-danger"{else} class="btn btn-danger" {/if}  id="changecategory" onclick="checkcategory()" ><span>添加擅长分类+</span></div>

               {/if}

                            <ul id="cate_view" class="tag ">
                                <!--{loop $user['category'] $category}-->
                                <li class="item" id="{$category['cid']}">{$category['categoryname']}
                                 {if $vertify['status']!=0}
                                <i class="icon icon-times text-danger hand"></i>
                                {/if}
                                </li>
                                <!--{/loop}-->
                            </ul>

          </div>

        </div>

           <div class="form-group">
          <p class="col-md-6 text-left change_name">真实姓名：</p>
          <div class="col-md-12">
             <input type="text" name="name" id="name" {if $vertify['status']==0}disabled{/if} value="{if isset($vertify['name'])}$vertify['name']{/if}" placeholder="" class="form-control">
          </div>
        </div>




         <div class="form-group">
          <p class="col-md-6 text-left change_idcode">身份证号码：</p>
          <div class="col-md-12">
             <input type="text"  name="id_code" id="id_code"  {if $vertify['status']==0}disabled{/if} value="{if isset($vertify['id_code'])}$vertify['id_code']{/if}" placeholder="" class="form-control">
          </div>
        </div>

         <div class="form-group">
          <p class="col-md-6 text-left ">认证介绍:</p>
          <div class="col-md-24">
            <textarea name="jieshao" id="jieshao"  {if $vertify['status']==0}disabled{/if} style="width:488px;height:89px;" class="form-control" >{if isset($vertify['jieshao'])}$vertify['jieshao']{/if}</textarea>


          </div>
        </div>
         <div class="form-group">
          <p class="col-md-6 text-left ">附件一(必传):</p>
          <div class="col-md-12">

							<a class="btn btn-mini btn-default">上传附件</a>

							<p class="text-hui">请提交对应的身份证或者组织机构代码证件扫描</p>
							<input  {if $vertify['status']==0}disabled{/if} name="attach1" type="file" class="fujianfule  collapse" onchange="previewImage(this)">
					  <img src='{if isset($vertify['zhaopian1'])}{SITE_URL}{$vertify['zhaopian1']}{/if}' id="vertify_img1" class="vertify_img {if isset($vertify['zhaopian1'])&&$vertify['zhaopian1']==''}hide{/if}"/>
          </div>
        </div>
               <div class="form-group">
          <p class="col-md-6 text-left ">附件二(可选):</p>
          <div class="col-md-12">

							<a class="btn btn-mini btn-default">上传附件</a>

							<p class="text-hui">其它证明材料(图片格式)</p>
							<input  {if $vertify['status']==0}disabled{/if} name="attach2" type="file" class="fujianfule  collapse" onchange="previewImage1(this)">
					  <img src='{if isset($vertify['zhaopian2'])}{SITE_URL}{$vertify['zhaopian2']}{/if}' id="vertify_img2"  class="vertify_img {if isset($vertify['zhaopian2'])&&$vertify['zhaopian2']==''}hide{/if}"/>
          </div>
        </div>


         {if $vertify['status']!=0}
         <div class="form-group">
          <div class=" col-md-10">
           {if $vertify['status']==2}
 <input type="button" id="submit" name="submit" onclick="submitvertify()" class="btn btn-success" value="重新提交" data-loading="稍候...">
          {else}
          <input type="button" id="submit" name="submit" onclick="submitvertify()" class="btn btn-success" value="保存" data-loading="稍候...">
          {/if}

          </div>
        </div>
        {/if}

 </form>
                     </div>
                 </div>


             </div>
            </div>

            <!--右侧栏目-->
            <div class="col-xs-7  aside ">




                <!--导航列表-->

               <!--{template user_menu}-->

                <!--结束导航标记-->


                <div>

                </div>


            </div>

        </div>

    </div>
{if $vertify['status']!=0}
<script>

//类型切换
$("#vertify_form .vertify_type").click(function(){
	var _val=$(this).val();
	switch(_val){
	case '0':
		$("#vertify_form .change_name").html("真实姓名：");
		$("#vertify_form .change_idcode").html("身份证号码：");
		break;
	case '1':
		$("#vertify_form .change_name").html("企业名称:");
		$("#vertify_form .change_idcode").html("组织机构代码:");
		break;
	}
})

//提交资料
function submitvertify(){
	//认证类型
	var _type=$.trim($("input[name='type']:checked").val());
	//用户名
	var _name=$.trim($("#vertify_form #name").val());
	//身份证号码
	var _idcode=$.trim($("#vertify_form #id_code").val());
	//认证介绍
	var _jieshao=$.trim($("#vertify_form #jieshao").val());
	//认证附件图片
	var _vertifyimgfile=$.trim($("#vertify_img1").attr("src"));
	switch(_type){
	case '0':
		if(_name==''){
			alert("真实姓名不能为空");
			return false;
		}
		if(_idcode==''){
			alert("身份证号码不能为空");
			return false;
		}
		break;
	case '1':
		if(_name==''){
			alert("企业名称不能为空");
			return false;
		}
		if(_idcode==''){
			alert("组织机构代码证不能为空");
			return false;
		}
		break;
	}
	if(_jieshao==''){
		alert("认证介绍不能为空");
		return false;
	}

	if(_vertifyimgfile==''){
		alert("附件一认证材料不能为空");
		return false;
	}
	//认证附件图片2
	var _vertifyimgfile2=$.trim($("#vertify_img2").attr("src"));

	var data={
			type:_type,
			name:_name,
			idcode:_idcode,
			jieshao:_jieshao,
			zhaopian1:_vertifyimgfile,
			zhaopian2:_vertifyimgfile2
	}
	function success(data){
		alert(data.result);
		if(data.code=='200'){
			setTimeout(function(){
				window.location.reload();
			},1000);

		}
	}
	var _posturl="{url user/ajaxvertify}";
	ajaxpost(_posturl,data,success);
}

//图片上传预览    IE是用了滤镜。
function previewImage(file)
{
  var MAXWIDTH  = 260;
  var MAXHEIGHT = 180;

  if (file.files && file.files[0])
  {


      var reader = new FileReader();
      reader.onload = function(evt){

    	  var canvas=document.createElement("canvas");
          var ctx=canvas.getContext("2d");
          var image=new Image();
          image.src=evt.target.result;
          image.onload=function(){
              var cw=image.width;
              var ch=image.height;
              var w=image.width;
              var h=image.height;
              canvas.width=w;
              canvas.height=h;
              if(cw>800&&cw>ch){
                  w=800;
                  h=(800*ch)/cw;
                  canvas.width=w;
                  canvas.height=h;
              }
              if(ch>800&&ch>cw){
                  h=800;
                  w=(800*cw)/ch;
                  canvas.width=w;
                  canvas.height=h;

              }

              ctx.drawImage(image,0,0,w,h);
              var _src=canvas.toDataURL("image/png",1);
              console.log(_src);

    	 $("#vertify_img1").attr("src",_src).removeClass("hide");


      }
      }
      reader.readAsDataURL(file.files[0]);
  }


}
//图片上传预览    IE是用了滤镜。
function previewImage1(file)
{
  var MAXWIDTH  = 260;
  var MAXHEIGHT = 180;

  if (file.files && file.files[0])
  {


      var reader = new FileReader();
      reader.onload = function(evt){

    	  var canvas=document.createElement("canvas");
          var ctx=canvas.getContext("2d");
          var image=new Image();
          image.src=evt.target.result;
          image.onload=function(){
              var cw=image.width;
              var ch=image.height;
              var w=image.width;
              var h=image.height;
              canvas.width=w;
              canvas.height=h;
              if(cw>800&&cw>ch){
                  w=800;
                  h=(800*ch)/cw;
                  canvas.width=w;
                  canvas.height=h;
              }
              if(ch>800&&ch>cw){
                  h=800;
                  w=(800*cw)/ch;
                  canvas.width=w;
                  canvas.height=h;

              }

              ctx.drawImage(image,0,0,w,h);
              var _src=canvas.toDataURL("image/png",1);
              console.log(_src);

    	 $("#vertify_img2").attr("src",_src).removeClass("hide");


      }
      }
      reader.readAsDataURL(file.files[0]);
  }


}
</script>
{/if}
 <div class="modal fade" id="myLgModal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div id="dialogcate">
        <form name="editcategoryForm" action="{url question/movecategory}" method="post">
            <input type="hidden" name="qid" value="{if isset($question['id'])}$question['id']{/if}" />
            <input type="hidden" name="category" id="categoryid" />
            <input type="hidden" name="selectcid1" id="selectcid1" value="{if isset($question['cid1'])}$question['cid1']{/if}" />
            <input type="hidden" name="selectcid2" id="selectcid2" value="{if isset($question['cid2'])}$question['cid2']{/if}" />
            <input type="hidden" name="selectcid3" id="selectcid3" value="{if isset($question['cid3'])}$question['cid3']{/if}" />
            <table class="table table-striped">
                <tr valign="top">
                    <td width="125px">
                        <select  id="category1" class="catselect" size="8" name="category1" ></select>
                    </td>
                    <td align="center" valign="middle" width="25px"><div style="display: none;" id="jiantou1">>></div></td>
                    <td width="125px">
                        <select  id="category2"  class="catselect" size="8" name="category2" ></select>
                    </td>
                    <td align="center" valign="middle" width="25px"><div style="display: none;" id="jiantou2">>>&nbsp;</div></td>
                    <td width="125px">
                        <select id="category3"  class="catselect" size="8"  name="category3" ></select>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                    <span>
                    <input  type="button" class="btn btn-success" value="确&nbsp;认" onclick="add_category();"/></span>
                    <span>
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    </span>
                    </td>

                </tr>
                 <tr>
                    <td colspan="5">
                     <ul class="taglist tag">

                     </ul>
                    </td>

                </tr>
            </table>
        </form>
    </div>
    </div>
  </div>
</div>
<!--用户中心结束-->
{if $vertify['status']!=1}
<script type="text/javascript">
var catsetnum={$setting['cansetcatnum']};

$(".taglist").html($("#cate_view").html());
    var category1 = {$categoryjs[category1]};
            var category2 = {$categoryjs[category2]};
            var category3 = {$categoryjs[category3]};

        initcategory(category1);
        fillcategory(category2, $("#category1 option:selected").val(), "category2");
        fillcategory(category3, $("#category2 option:selected").val(), "category3");
        $("#cate_view .icon-times,.taglist .icon-times").click(function() {
            var cid = $(this).parent().attr("id");

            $.post("{SITE_URL}index.php?user/ajaxdeletecategory", {cid: cid});

            $(this).parent().remove();

            if ($('#cate_view li').size() < catsetnum) {
                $("#changecategory").removeClass("disabled");
            }


        });

    function checkcategory(){
    	  $(".taglist").html($("#cate_view").html());
    	  $('#myLgModal').modal("show");
    }
    function add_category() {

        var selected_category1 = $("#category1 option:selected");
        var selected_category2 = $("#category2 option:selected");
        var selected_category3 = $("#category3 option:selected");
        if ($('#cate_view li').size() >= catsetnum) {
        	$('#myLgModal').modal("hide");
            return false;
        }
        var selected_cid = 0;
        if (selected_category3.val() > 0) {
            selected_cid = selected_category3.val();
            $("#cate_view").append('<li class="item">' + selected_category3.html() + '<i class="icon icon-times text-danger hand"></i></li>');
        } else if (selected_category2.val() > 0) {
            selected_cid = selected_category2.val();
            $("#cate_view").append('<li class="item">' + selected_category2.html() + '<i class="icon icon-times text-danger hand"></i></li>');
        } else if (selected_category1.val() > 0) {
            selected_cid = selected_category1.val();
            $("#cate_view").append('<li class="item">' + selected_category1.html() + '<i class="icon icon-times text-danger hand"></i></li>');
        }
        if (selected_cid > 0) {
            $.post("{SITE_URL}index.php?user/ajaxcategory", {cid: selected_cid});
        }
        $(".taglist").html($("#cate_view").html());
        $("#cate_view .icon-times,.taglist .icon-times").click(function() {
            var cid = $(this).parent().attr("id");

            $.post("{SITE_URL}index.php?user/ajaxdeletecategory", {cid: cid});

            $(this).parent().remove();

            if ($('#cate_view li').size() < catsetnum) {
                $("#changecategory").removeClass("disabled");
            }


        });
        if ($('#cate_view li').size() >= catsetnum) {
            $("#changecategory").addClass("disabled");

        }
        $('#myLgModal').modal("hide");
    }

</script>
{/if}
<!--{template footer}-->