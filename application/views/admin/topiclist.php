<!--{template header}-->
<script type="text/javascript" src="{SITE_URL}static/js/jquery-ui/jquery-ui.js"></script>
<script src="{SITE_URL}static/js/admin.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#list").sortable({
            update: function(){
                var reorderid="";
                var numValue=$("input[name='order[]']");
                for(var i=0;i<numValue.length;i++){
                    reorderid+=$(numValue[i]).val()+",";
                }
                var hiddentid=$("input[name='hiddentid']").val();
                $.post("index.php?admin_topic/reorder{$setting['seo_suffix']}",{order:reorderid});
            }
        });
    });
</script>
<style>
em{
	color:red;
}
</style>
<div style="width:100%; height:15px;color:#000;margin:0px 0px 10px;">
    <div style="float:left;"><a href="index.php?admin_main/stat{$setting['seo_suffix']}" target="main"><b>控制面板首页</b></a>&nbsp;&raquo;&nbsp;专题管理</div>
</div>
<!--{if isset($message)}-->
<table class="table">
    <tr>
        <td class="{if isset($type)}$type{/if}">{$message}</td>
    </tr>
</table>
<!--{/if}-->
   <a class="btn write-btn btn-success" target="_blank" href="{url user/addxinzhi}">
            <i class="fa fa-pencil"></i>写文章
        </a>
<form  method="post">
    <table class="table">
        <tbody>
            <tr class="header" ><td colspan="4">文章列表</td></tr>
            <tr class="altbg1"><td colspan="4">可以通过如下搜索条件，检索文章</td></tr>
            <tr>
                <td width="200"  class="altbg2">标题:<input class="txt form-control" name="srchtitle" {if isset($srchtitle)}value="{$srchtitle}" {/if}></td>
                <td  width="200" class="altbg2">作者:<input class="txt form-control" name="srchauthor" {if isset($srchauthor)}value="{$srchauthor}" {/if}></td>

                 <td  width="200" class="altbg2">分类:
                    <select class="form-control shortinput" name="srchcategory" id="srchcategory"><option value="0">--不限--</option>{$catetree}</select>
                </td>
            </tr>

            <tr>
              <td  rowspan="2" class="altbg2"><input class="btn btn-info" name="submit" type="submit" value="查询"></td>
              </tr>
        </tbody>
    </table>
</form>
[共 <font color="green">{$rownum}</font> 个问题]
<form name="answerlist"  method="POST">
    <table class="table">
        <tr class="header" align="center">
            <td width="10%"><input class="checkbox" value="chkall" id="chkall" onclick="checkall('tid[]')" type="checkbox" name="chkall"><label for="chkall">删除</label></td>
            <td  width="10%">博客作者</td>

            <td width="20%">博客名称</td>

             <td  width="10%">手机首页显示</td>
                <td  width="10%">PC首页显示</td>
            <td  width="10%">编辑</td>
        </tr>
    </table>
    <ul id="list" style="cursor: pointer;width:100%;float: right;" >
        <!--{loop $topiclist $topic}-->
        <li style="list-style:none;">
            <table  id="table1" class="table">
                <tr align="center" class="smalltxt">

                    <td width="10%" class="altbg2"><input class="checkbox" type="checkbox" value="{$topic['id']}" name="tid[]"></td>
                                      <td width="10%" class="altbg2">
                                      <strong>{$topic['author']}</strong></td>

                    <td width="20%" class="altbg2"><input name="order[]" type="hidden" value="{$topic['id']}"/><strong>{$topic['title']}</strong></td>

                           <td width="10%" class="altbg2" align="center"><!--{if $topic['isphone']=='0'}-->否 <!--{/if}--><!--{if $topic['isphone']=='1'}--><font color=red>是</font>  <!--{/if}--> </td>
                                   <td width="10%" class="altbg2" align="center"><!--{if $topic['ispc']=='0'}-->否 <!--{/if}--><!--{if $topic['ispc']=='1'}--><font color=red>是</font>  <!--{/if}--> </td>
                    <td width="10%" class="altbg2" align="center"><img src="{SITE_URL}static/css/admin/edit.png" style="cursor:pointer" onclick="document.location.href='{SITE_URL}index.php?admin_topic/edit/$topic['id']{$setting['seo_suffix']}'"></td>
                </tr>
            </table>
        </li>
        <!--{/loop}-->
    </ul>

   <div class="pages">{$departstr}</div>


             <input name="ctrlcase" class="btn btn-success" type="button" onClick="buttoncontrol(1);" value="推送到百度">&nbsp;&nbsp;&nbsp;

    <input class="button" tabindex="3" onClick="buttoncontrol(2)" type="submit" value=" 提 交 " name="ctrlcase">
</form>
<div class="modal fade" id="baidutui">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">关闭</span></button>
      <h4 class="modal-title">百度推送提醒</h4>
    </div>
    <div class="modal-body">
      <p>确定推送？此项操作只有配置了百度推送api地址有效！</p>
    </div>
    <div class="modal-footer">
     <button type="button" id="btntui" class="btn btn-primary">确定推送</button>
     <button type="button"  class="btn btn-primary" onclick="window.location.href='index.php?admin_setting/seo{$setting['seo_suffix']}'">去配置百度推送api地址</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>

    </div>
  </div>
</div>
</div>
<br>

<!--{template footer}-->
<script>
function buttoncontrol(num) {

	  if ($("input[name='tid[]']:checked").length == 0) {
          alert('你没有选择任何要操作的文章！');
          return false;
      }else{
    	   switch (num) {
           case 1:
           	$("#baidutui").modal("show");

           	$("#btntui").click(function(){
           		 document.answerlist.action = "index.php?admin_topic/baidutui{$setting['seo_suffix']}";
                   console.log( document.answerlist);
           		 document.answerlist.submit();
           	})

               break;
           case 2:
        	   if (confirm('确定删除问题？该操作不可返回！') == false) {
                   return false;
               } else {
               document.answerlist.action = "index.php?admin_topic/remove{$setting['seo_suffix']}";
               document.answerlist.submit();
               }
               break;

    	   }
      }
}
</script>