<!--{template meta}-->

<div class="container  mar-t-1 mar-b-1">
<div class="row">
  <div class="col-sm-24">

    <form  class="form-horizontal mar-t-1" id="askform" name="questionform" method="post" enctype="multipart/form-data">
            <div class="askbox">
                
       
                 
                
                
                       <div class="form-group">
          <p class="col-md-24 "></p>
          <div class="col-md-16">
        
               <input class="qtitle form-control" name="title" id="qtitle" value="{$question['title']}">
          </div>
        </div>
        
                 <div class="form-group mar-t-05">
          <p class="col-md-24 form-title ">编辑描述</p>
          <div class="col-md-16">
            <div id="introContent">
                       <!--{template editor}-->
                    </div>
          </div>
        </div>
            
                  <!--{if $user['grouptype']!=1&&$user['credit1']<$setting['jingyan']}-->
                      
     <!--{template code}-->
          <!--{/if}-->
          
         <div class="form-group">
          <div class=" ui-btn-wrap">
        
                          <input type="hidden" value="{$qid}" id="bianji_qid" name="qid" />
            <button type="button" id="submit" name="submit" class="ui-btn ui-btn-primary"  data-loading="稍候...">保存</button> 
            <a class="ui-btn" onclick="window.history.go(-1)">返回</a>
          </div>
        </div>
            </div>	
        </form>
  </div>
  

</div>
</div>
<script>
$("#submit").click(function(){

	 var eidtor_content='';
	
			eidtor_content = editor.wang_txt.html();
		
	   <!--{if $user['grouptype']!=1}-->
	  var data={
			  title:$("#qtitle").val(),
			  content:eidtor_content,
			 qid:$("#bianji_qid").val(),
			 submit:$("#submit").val(),
			  askfromuid:$("#askfromuid").val(),
  			
  			code:$("#code").val()
  	}
	    <!--{else}-->
		var data={
				  title:$("#qtitle").val(),
				  qid:$("#bianji_qid").val(),
				  submit:$("#submit").val(),
    			 content:eidtor_content
    			 
    			
      			
      			
    			
    	}
	     <!--{/if}-->
	  

	$.ajax({
        //提交数据的类型 POST GET
        type:"POST",
        //提交的网址
        url:"{url question/ajaxedit}",
        //提交的数据
        data:data,
        //返回数据的格式
        datatype: "json",//"xml", "html", "script", "json", "jsonp", "text".
        //在请求之前调用的函数
        beforeSend:function(){
        	
        },
        //成功返回之后调用的函数             
        success:function(data){
        	$(".progress").addClass("hide");
        	var data=eval("("+data+")");
           if(data.message=='ok'){
        	   var tmpmsg='问题编辑成功!';
        	  
        	  alert(tmpmsg);
        	   setTimeout(function(){
        		  
                   window.location.href=data.url;
               },1500);
           }else{
        	alert(data.message)
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
})




</script>
<!--{template footer}-->