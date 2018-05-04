<!--{template meta}-->

<style>
.moreinfo{
	color:#31b7ae;
padding-left:.16rem;
    cursor: pointer;
text-align: left;
margin-top:.1rem;
}
.moreinfoitem{
	display:none;
}
.mycny{
    color: #ff8f00;
    font-size: 17px;
    position: absolute;
    top: .13rem;
    left: .16rem;
}
#qxianjin{
	padding-left:.16rem;
}

</style>
<section class="ui-container mar-t-01">
{if isset($touser)}
<div class="ui-tips ui-tips-info" style="text-align:left">
    <i></i><span>您正在向【{$touser['username']}】提问：</span>
</div>
{/if}


<div class="ui-form ui-border-t">
        <form id="login_form" onsubmit="return false;">
        <input type="hidden"  id="forward" name="return_url" value="{$forward}">

            <div class="ui-form-item ui-form-item-pure ui-border-b">
                <input name="title" id="qtitle" value="{$word}" maxlength="50" type="text" placeholder="标题简短，言简意赅，问号结尾">
                <a href="#" class="ui-icon-close"></a>
            </div>
            <div class=" ui-form-item-pure ui-border-b">
           <!--{template editor}-->
               <style>
.editor_container {
    box-shadow:none;
}
            </style>
            </div>



             <div class="ui-form-item ui-form-item-r ui-border-b">
            <label>分类</label>
            <div class="ui-select">
                              <select  name="srchcategory" id="srchcategory">

                              {$catetree}
                              </select>
            </div>
        </div>


                 <div class="ui-form-item ui-form-item-pure ui-border-b">
                <i class="fa fa-cny mycny"></i>
                <input name="xianjin" id="qxianjin" value=""  type="text" placeholder="现金悬赏金额，没有请先充值">
                <a href="#" class="ui-icon-close"></a>
            </div>
            <div style="color:red;padding-left:15px;">当前可用余额【{echo $user['jine']/100;}元】</div>
            <!--{if $iswxbrower==null&&$setting['code_ask']&&$user['credit1']<$setting['jingyan']}-->
  <div class="ui-form-item ui-form-item-pure ui-border-b">

 {template code}
  </div>
   <!--{/if}-->
   <div class="moreinfo">增加更多信息<i class="fa fa-angle-down"></i></div>
   <div class="ui-form-item ui-form-item-r ui-border-b moreinfoitem">
            <label>积分悬赏</label>
            <div class="ui-select">
                <select name="givescore" id="scorelist">
                   <option selected="selected" value="0">0</option><option value="3">3</option><option value="5">5</option><option value="10">10</option><option value="15">15</option><option value="30">30</option><option value="50">50</option><option value="80">80</option><option value="100">100</option>
                </select>
            </div>
        </div>

            <div class="ui-form-item ui-form-item-pure ui-border-b moreinfoitem">
                <input class="txt_tag" value="" maxlength="50" type="text" placeholder="标签之间英文逗号隔开">
                <a href="#" class="ui-icon-close"></a>
            </div>
         <!--{if $user['uid']}-->
            <div class="ui-form-item ui-form-item-switch ui-border-b moreinfoitem">
                <p>
                    匿名提问
                </p>
                <label class="ui-switch">
                   <input type="checkbox" name="hidanswer" id="hidanswer" value="1" />
                </label>
            </div>
             <!--{/if}-->
            <div class="ui-btn-wrap">
             <input type="hidden" name="cid" id="cid"/>
                    <input type="hidden" name="cid1" id="cid1" value="0"/>
                    <input type="hidden" name="cid2" id="cid2" value="0"/>
                    <input type="hidden" name="cid3" id="cid3" value="0"/>
                    <input type="hidden" value="{$askfromuid}" id="askfromuid" name="askfromuid" />

                <input type="hidden" id="tokenkey" name="tokenkey" value='{$_SESSION["addquestiontoken"]}'/>
                 <!--{if $touser}-->
                         <!--{if $touser['mypay']>0}-->
                            <button id="asksubmit"  class="ui-btn-lg ui-btn-primary">
                                         付费{$touser['mypay']}元提问
                </button>

                          <!--{else}-->
                              <!-- 若按钮不可点击则添加 disabled 类 -->
                <button id="asksubmit"  class="ui-btn-lg ui-btn-primary">
                                            提交问题
                </button>
                            <!--{/if}-->

               <!--{else}-->
                            <!-- 若按钮不可点击则添加 disabled 类 -->
                <button id="asksubmit"  class="ui-btn-lg ui-btn-primary">
                                            提交问题
                </button>
                            <!--{/if}-->

            </div>

        </form>
    </div>
</section>

<script>
$(".moreinfo").click(function(){
	$(".moreinfoitem").show();
	$(".moreinfo").hide();
})
	getcat();

function getcat(){

	var sv=$("#srchcategory").val();

	 $.ajax({
	        //提交数据的类型 POST GET
	        type:"POST",
	        //提交的网址
	        url:"{url question/ajaxgetcat}",
	        //提交的数据
	        data:{category:sv},
	        //返回数据的格式
	        datatype: "json",//"xml", "html", "script", "json", "jsonp", "text".
	      //在请求之前调用的函数
	        beforeSend:function(){

	        },
	        //成功返回之后调用的函数
	        success:function(data){

	        	var data=eval("("+data+")");

	        	  if(data.message=='ok'){
	        		  $("#cid").val(data.cid);
	        		  $("#cid1").val(data.cid1);
	        		  $("#cid2").val(data.cid2);
	        		  $("#cid3").val(data.cid3);

	        	  }else{
	        		  el2=$.tips({
          	            content:'分类不存在，估计是缓存引起',
          	            stayTime:1000,
          	            type:"info"
          	        });
	        	  }
	        }   ,

	        //调用执行后调用的函数
	        complete: function(XMLHttpRequest, textStatus){

	        },

	        //调用出错执行的函数
	        error: function(){

	            //请求出错处理
	        }
	    });
}
$("#srchcategory").change(function(){
	getcat();

})
$("#asksubmit").tap(function(){
	tijiao();
	return false;
})
function tijiao(){
	var _tagstr=$(".txt_tag").val();

     var _tmptag=_tagstr.split(',');
     if(_tmptag.length>5){
    	 alert("标签不能超过5个");
    	 return false;
     }
	 var qtitle = $("#qtitle").val();
    if (bytes($.trim(qtitle)) < 8 || bytes($.trim(qtitle)) > 100) {


        el2=$.tips({
	            content:'问题标题长度不得少于4个字，不能超过50字！',
	            stayTime:1500,
	            type:"info"
	        });
        $("#qtitle").focus();
        return false;
    }

    {if $user['uid']}
    //检查财富值是否够用
    var offerscore = 0;
    var selectsocre = $("#givescore").val();
	 if ($('#hidanswer').attr('checked')) {
        offerscore += 10;
    }
    offerscore += parseInt(selectsocre);
    if (offerscore > $user['credit2']) {

      el2=$.tips({
          content:'你的财富值不够!',
          stayTime:1000,
          type:"info"
      });
            return false;
    }
    {/if}

    console.log(editor);
    	// var eidtor_content= editor.getContent();
	 // 获取编辑器区域
        var _txt = editor.wang_txt;
     // 获取 html
        var eidtor_content =  _txt.html();
	 var _hidanswer=0;
	 if ($('#hidanswer').attr('checked')) {
		 _hidanswer=1;
	 }

	   var money_reg = /\d{1,4}/;
       var _money = $("#qxianjin").val();
       if('' == _money){
       	_money=0;
       }
	  <!--{if $setting['code_ask']}-->
	  var data={
			  title:$("#qtitle").val(),
			  description:eidtor_content,
			  cid:$("#cid").val(),
			  cid1:$("#cid1").val(),
			  cid2:$("#cid2").val(),
			  cid3:$("#cid3").val(),
			  givescore:$("#scorelist").val(),
			  hidanswer:_hidanswer,
			  askfromuid:$("#askfromuid").val(),
			  tokenkey:$("#tokenkey").val(),
			  jine:_money,
			  tags:_tagstr,
 			code:$("#code").val()
 	}
	    <!--{else}-->
		var data={
				  title:$("#qtitle").val(),
   			  description:eidtor_content,
   			  cid:$("#cid").val(),
   			  cid1:$("#cid1").val(),
   			  cid2:$("#cid2").val(),
   			  cid3:$("#cid3").val(),
   			  givescore:$("#scorelist").val(),
   			tokenkey:$("#tokenkey").val(),
   			  hidanswer:_hidanswer,
   			jine:_money,
   		 tags:_tagstr,
   			  askfromuid:$("#askfromuid").val()



   	}
	     <!--{/if}-->

	    	   var el='';
	$.ajax({
       //提交数据的类型 POST GET
       type:"POST",
       //提交的网址
       url:"{url question/ajaxadd}",
       //提交的数据
       data:data,
       async: false,
       //返回数据的格式
       datatype: "json",//"xml", "html", "script", "json", "jsonp", "text".
       //在请求之前调用的函数
       beforeSend:function(){
    	   el=$.loading({
    	        content:'加载中...',
    	    })
       },
       //成功返回之后调用的函数
       success:function(data){
    	   el.loading("hide");

       	var data=eval("("+data+")");
          if(data.message=='ok'){
       	   var tmpmsg='提问成功!';
       	   if(data.sh=='1'){
       		   tmpmsg='问题发布成功！为了确保问答的质量，我们会对您的提问内容进行审核。请耐心等待......';
       	   }

           el2=$.tips({
               content:tmpmsg,
               stayTime:1500,
               type:"info"
           });
       	   setTimeout(function(){

                  window.location.href=data.url;
              },1500);
          }else{

       	   el2=$.tips({
               content:data.message,
               stayTime:1500,
               type:"info"
           });
          }


       }   ,
       //调用执行后调用的函数
       complete: function(XMLHttpRequest, textStatus){
    	   el.loading("hide");
    	   return false;
       },
       //调用出错执行的函数
       error: function(){
           //请求出错处理
       }
    });
	return false;
}
</script>
<!--{template footer}-->