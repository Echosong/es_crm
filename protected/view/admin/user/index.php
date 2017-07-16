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
<form class="form-inline definewidth m20"  action="<?php echo url("user", "list") ?>" method="get">
	姓名：
	<input type="text" name="name" id="name"  class="input-medium" placeholder="" value="">
	&nbsp;&nbsp;
	qq：
	<input type="text" name="qq" id="qq"  class="input-medium" placeholder="" value="">
	&nbsp;&nbsp;
	手机：
	<input type="text" name="mobile" id="mobile" class="input-medium"  placeholder="" value="">
	&nbsp;&nbsp;
	微信：
	<input type="text" name="wx" id="wx"  class="input-medium" placeholder="" value="">
	&nbsp;&nbsp;
	来源:
	<select name="source"  class="input-medium">
		<?php
		foreach ($GLOBALS['usersource'] as $k => $v) {
			if (intval($_GET['source']) == intval($k)) {
				echo "<option selected value='{$k}'>{$v}</option>";
			} else {
				echo "<option value='{$k}'>{$v}</option>";
			}
		}
		?>
	</select>
	用户类型:
	<select name="state" class="input-medium">
		<?php
		foreach ($GLOBALS['userstate'] as $k => $v) {
			if (intval($_GET['state']) == intval($k)) {
				echo "<option selected value='{$k}'>{$v}</option>";
			} else {
				echo "<option value='{$k}'>{$v}</option>";
			}
		}
		?>
	</select>

	<button type="submit" class="btn btn-primary">
	查询
	</button>
	&nbsp;&nbsp;
</form>
<table class="table table-bordered table-hover definewidth m10">
	<thead>

		<tr>
			<th>编号</th>
			<th>账号</th>
			<th>姓名</th>
			<th>性别</th>
			<th>来源</th>
			<th>用户key</th>
			<th>qq</th>
			<th>手机</th>
			<th>微信</th>
			<th>ip</th>
			<th>状态</th>
			<th>操作</th>
		</tr>
	</thead>
	<?php
	foreach($users as $key=>$user){
	?>
	<tr>
		<td><?php echo $user["id"]?></td>
		<td><?php echo $user["account"]?></td>
		<td><?php echo $user["name"]?></td>
		<td><?php echo $user["sex"]?></td>
		<td><?php echo $GLOBALS['usersource'][$user['source']] ?></td>
		<td><?php echo $user["userkey"]?></td>
		<td><?php echo $user["qq"]?></td>
		<td><?php echo $user["mobile"]?></td>
		<td><?php echo $user["wx"]?></td>
		<td><?php echo $user["ip"]?></td>
		<td><?php echo $GLOBALS['userstate'][$user['state']] ?></td>
		<td>
			<a  href="<?php echo url('user','modify')."?id=".$user['id']?>" title="修改用户资料" >
				<label class="icon-edit"></label>修改
			</a>
			
			
			&nbsp;
			<a  href="<?php echo url('order','create')."?customerId=".$user['id']."&customerAccount=".$user['account'] ?>" title="订单成交" >
				<label class="icon-shopping-cart"></label>下单
			</a>
			
			<a   data-toggle="modal" data-url="<?php echo url('user', 'trace')."?id=".$user['id'] ?>" href="#myiframeModal" title="建立客户跟踪" >
				<label class="icon-eye-open"></label> 跟踪
			</a>
			
			&nbsp;
			<a   href="#del" data-url=="<?php echo url('user','delete')."?id=".$user['id']?>" title="会员<?php echo $user['name'] ?>" >
				<label class="icon-remove"></label>删除
			</a>
			</td>
	</tr>
	<?php } ?>
</table>

<?php echo $page?>


</body>
</html>

