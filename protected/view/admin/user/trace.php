<form method="post" action="<?php echo url('user', 'trace')?>" >
<div style="margin-bottom: 10px;">
	<h5>跟踪记录</h5>
	<input type="hidden" name="uid" id="uid" value="<?php echo $_GET['id'] ?>" />
	<textarea name="content" style="width: 95%;" rows="4" class="text-left"></textarea>
	<input type="submit" id="提交" class="btn btn-primary" name="" />
</div>
</form>
<div>
	<ul class="list-group">
		<?php foreach($traces as $k=>$v) {?>
		<li class="list-group-item " style=" padding-bottom: 10px;">
			</span> <span  style="color: red; "> <?php echo $v['created'] ?> </span>
			<?php echo $v['content'] ?>
		</li>
		<?php }?>
</div>
