
<style type="text/css">
    body {
        padding-bottom: 40px;
    }
    .sidebar-nav {
        padding: 9px 0;
    }

    @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
            float: none;
            padding-left: 5px;
            padding-right: 5px;
        }
    }
</style>
<form class="form-inline definewidth m20" action="#" method="get">    
    会员编号：
    <input type="text" name="account" id="name"class="abc input-default" placeholder="" value="<?php  echo $_GET['account'] ?>">&nbsp;&nbsp;  
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp;
   
</form>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
       
    <tr>
    <TH>申请类型</TH>
    <TH>用户编号</TH>
    <TH>用户姓名</TH>
    <TH>注册日期</TH>
    <TH>说明</TH>
     <TH>状态</TH>
     <TH>操作</TH>
    </tr>
    </thead>
         <?php foreach($applys as $v){ ?>
        <TR class="datalist">
            <TD><?php echo $GLOBALS['applyType'][$v['apply_type']]; ?></TD>
            <TD><?php echo $v['apply_uname'] ?></TD>
            <TD><?php echo $v['username'] ?></TD>
            <TD><nobr><?php echo $v['apply_time'] ?></nobr></TD>
            <TD><nobr><?php echo $v['apply_info'] ?></nobr></TD>
            <TD><nobr>
            	<?php 
            		if($v['apply_able']==1){
            			echo "通过";
					}else{
						echo "申请中";
					}
            	?> 
            	</nobr>
            </TD>
            <td> 
            	<?php if($v['apply_able']==1){?>
            	<a  href="javascript:void(0)" onclick="cancelApply(<?php echo $v['id'] ?>)"> 取消审核 </a>
            	<?php }else{ ?>
            	<a href="javascript:void(0)" onclick="checkApply(<?php echo $v['id'] ?>)"> 审核 </a>
            	<?php } ?>
            	
            </td>
        </TR>    
        <?php } ?>
</table>
        <?php echo $page?>
</body>
</html>
<script>
    function checkApply(id)
    {
        if(confirm("确定要审核？"))
        {
            var url = "<?php echo url('new','setApply')?>?type=1&id="+id;
            window.location.href=url;       
        }
    }
    
    var cancelApply = function(id){
    	if(confirm("确定要取消？"))
        {
            var url = "<?php echo url('new','setApply')?>?type=0&id="+id;
            window.location.href=url;       
        }
    }
</script>