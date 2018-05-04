<!--{template header}-->
<div id="append">
</div>
<div style="width:100%; height:15px;color:#000;margin:0px 0px 10px;">
  <div style="float:left;"><a href="index.php?admin_main/stat{$setting['seo_suffix']}" target="main"><b>控制面板首页</b></a>&nbsp;&raquo;&nbsp;举报管理</div>
</div>
<!--{if isset($message)}-->
<!--{eval $type=isset($type)?$type:'correctmsg'; }-->
<table class="table">
	<tr>
		<td class="{$type}">{$message}</td>
	</tr>
</table>
<!--{/if}-->
<table class="table">
	<tbody>
	<tr class="header" ><td>举报管理</td></tr>
	<tr class="altbg1"><td>下面列表按举报时间排序</td></tr>
	</tbody>
</table>
[共 <font color="green">{$informnum}</font> 条举报记录]
<form name="userForm" action="index.php?admin_inform/remove{$setting['seo_suffix']}" method="POST">
 <table class="table">
	<tr class="header">
		<td width="10%"><input class="checkbox" value="chkall" id="chkall" onclick="checkall('qid[]')" type="checkbox" name="chkall"><label for="chkall">全选</label></td>
			<td  width="30%">举报的问题</td>
			<td  width="10%">举报人</td>
		<td  width="10%">举报的类型</td>
		<td  width="10%">举报内容</td>
		<td  width="20%">举报原因</td>
		<td  width="10%">举报次数</td>
		<td  width="10%">举报时间</td>
	</tr>
	<!--{loop $informlist $inform}-->
	<tr>
		<td class="altbg2"><input class="checkbox" type="checkbox" value="{$inform['qid']}" name="qid[]"></td>
		<td class="altbg2">
		{if $inform['qid']!=0}
		<a href="{url question/view/$inform['qid']}" target="_blank">{$inform['qtitle']}</a>
		{/if}
		{if $inform['aid']!=0}
		<a href="{url topic/getone/$inform['aid']}" target="_blank">{$inform['qtitle']}</a>
		{/if}


		</td>
		<td class="altbg2"><a href="index.php?user/space/{$inform['uid']}{$setting['seo_suffix']}" target="_blank">{$inform['username']}</a></td>
		<td class="altbg2">{$inform['title']}</td>

		<td class="altbg2">
		{$inform['keywords']}
		</td>
		{eval $fcontent = cutstr($inform['content'],30)}
		<td class="altbg2">{$fcontent}</td>

		<td class="altbg2">{$inform['counts']}</td>
		<td class="altbg2">{$inform['time']}</td>
	</tr>
	<!--{/loop}-->

	<tr>
		<td colspan="6" class="altbg1"><input class="button" type="button" name="delete" onclick="ondelete();" value="删除" /></td>
	</tr>
</table>
</form>

<script type="text/javascript">
    function ondelete(){
        if($("input[name='qid[]']:checked").length == 0){
            alert('你没有选择任何一条举报!');
            return false;
        }
        if(confirm('确认删除该举报记录?此操作不可恢复!')==false){
            return false;
        }
        document.userForm.action="index.php?admin_inform/remove{$setting['seo_suffix']}";
        document.userForm.submit();
    }
</script>
	<!--{if $departstr}-->
	<tr class="smalltxt">
		<td class="altbg2" colspan="6">{$departstr}</td>
	</tr>
	<!--{/if}-->
<!--{template footer}-->