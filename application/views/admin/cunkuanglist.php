<!--{template header}-->

<script src="js/admin.js" type="text/javascript"></script>
<div style="width:100%; height:15px;color:#000;margin:0px 0px 10px;">
    <div style="float:left;"><a href="index.php?admin_main/stat{$setting['seo_suffix']}" target="main"><b>控制面板首页</b></a>&nbsp;&raquo;&nbsp;公告管理</div>
</div>
<!--{if isset($message)}-->
<!--{eval $type=isset($type)?$type:'correctmsg'; }-->
<table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder">
    <tr>
        <td class="{$type}">删除成功</td>
    </tr>
</table>
<!--{/if}-->

<div>

<form action="index.php?admin_user/cunkuanglist{$setting['seo_suffix']}"  method=post>
<input type="hidden" name="id" id="ptid"/>
<input type="text" name="name" id="ptname"/>
<input type="submit" name="submit" value="提交"/>
</form>
</div>
<form onsubmit="return confirm('该操作不可恢复，您确认要删除这些公告吗？');"  action="index.php?admin_user/removecunkuang{$setting['seo_suffix']}"  method=post>
    <table cellspacing="1" cellpadding="4" width="100%" align="center" >
        <tr class="header"><td colspan="5">转账平台列表&nbsp;&nbsp;&nbsp;</td></tr>
        <tr class="header" align="center">
            <td width="5%"><input class="checkbox" value="chkall" id="chkall" onclick="checkall('delete[]')" type="checkbox" name="chkall"><label for="chkall">&nbsp;删除</label></td>
            <td  width="25%">转账平台</td>

            <td  width="10%">编辑</td>
        </tr>
        <!--{loop $cunkuanglist $cunkuang}-->
        <tr align="center" class="smalltxt">
            <td class="altbg2">&nbsp;<input class="checkbox" type="checkbox" value="{$cunkuang['id']}" name="delete[]"></td>

            <td class="altbg2">{$cunkuang['name']}</td>
            <td class="altbg2"><a href="javascript:void(0)" id="{$cunkuang['id']}" value="{$cunkuang['name']}" class="bianji">编辑</a></td>
        </tr>
        <!--{/loop}-->
        <!--{if $departstr}-->
        <tr class="smalltxt">
            <td class="altbg2" colspan="5" align="right"><div class="scott">{$departstr}</div></td>
        </tr>
        <!--{/if}-->
        <tr><td colspan="5" class="altbg1"><input type="submit" class="button" value="提交" /></td></td>
    </table>
    <script>
    $(".bianji").click(function(){
    	var id=$(this).attr("id");
    	var val=$(this).attr("value");
    	$("#ptname").val(val);
    	$("#ptid").val(id);
    })
    </script>
</form>
<!--{template footer}-->
