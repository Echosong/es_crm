
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
    用户名称：
    <input type="text" name="name" id="name"class="abc input-default" placeholder="" value="">&nbsp;&nbsp;  
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp; <button type="button" class="btn btn-success" id="addnew">新增用户</button>
</form>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
       
    <tr>
        <th>用户</th>
        <th>群号</th>
        <th>群名称</th>
        <th>二维码</th>
        <th>头像</th>
        <th>时间</th>
        <th>删除</th>
    </tr>
    </thead>
        <?php 
            foreach($groups as $key=>$item){
        ?>
	     <tr>
	        <td><?php echo $item["g_uaccount"]?></td>
	        <td><?php echo $item["g_account"]?></td>
            <td><?php echo $item["g_name"]?></td>
            <td><img width="150" height="100" src="<?php echo $item["g_qrcode"]?>"/> </td>
            <td><img width="150" height="100" src="<?php echo $item["g_photo"]?>"/> </td>
            <td><?php echo $item["g_ceated"]?></td>
            <td><?php echo $item["g_ceated"]?></td>
        </tr>	
        <?php } ?>
</table>

        <?php echo $page?>
</body>
</html>
<script>
    $(function () {
		$('#addnew').click(function(){
				window.location.href="add.html";
		 });

    });

	function del(id)
	{
		if(confirm("确定要删除吗？"))
		{
			var url = "<?php echo url('admin','')?>";
			window.location.href=url;		
		}
	}
</script>