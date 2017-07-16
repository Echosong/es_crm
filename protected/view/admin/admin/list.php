
<style type="text/css">body {
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
}</style>
<form class="form-inline definewidth m20" action="<?php echo url("user", "list") ?>" method="get">   
  姓名：
    <input type="text" name="name" id="name"  class="input-medium" placeholder="" value="">&nbsp;&nbsp;  
     qq：
    <input type="text" name="qq" id="qq"  class="input-medium" placeholder="" value="">&nbsp;&nbsp; 
  手机：
    <input type="text" name="mobile" id="mobile" class="input-medium"  placeholder="" value="">&nbsp;&nbsp; 
  微信：
    <input type="text" name="wx" id="wx"  class="input-medium" placeholder="" value="">&nbsp;&nbsp; 
   
    角色:
    <select name="roleId" class="input-medium">
    	<?php
		foreach ($roles as $k => $v) {
			if (intval($_GET['roleId']) == intval($v['id'])) {
				echo "<option selected value='{$v['id']}'>{$v['name']}</option>";
			} else {
				echo "<option value='{$v['id']}'>{$v['name']}</option>";
			}
		}
    	?>
    </select> 
    
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp; 
</form>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
       
    <tr>
    	<th>账号</th>
        <th>姓名</th>
        <th>姓名</th>
        <th>角色</th>
        <th>创建时间</th>
        <th>修改时间</th>
        <th>qq</th>
        <th>手机</th>
        <th>微信</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    </thead>
        <?php 
            foreach($staffs as $key=>$user){
        ?>
	     <tr>
	        <td><?php echo $user["account"]?></td>
	        <td><?php echo $user["name"]?></td>
            <td><?php echo $user["role"]?></td>
            <td><?php echo $user['created'] ?></td>
            <td><?php echo $user["updated"]?></td>
            <td><?php echo $user["qq"]?></td>
            <td><?php echo $user["mobile"]?></td>
            <td><?php echo $user["wx"]?></td>
            <td><?php echo $user["ip"]?></td>
            <td><?php echo $GLOBALS['staffstate'][$user["state"]]?></td>
            <td>
            	
                <a  href="<?php echo url('user','staffedit')."?id=".$user['id']?>" title="修改用户资料" ><span class="icon-edit"></span>修改</a>       
            </td>
        </tr>	
        <?php } ?>
</table>

        <?php echo $page?>
</body>
</html>
