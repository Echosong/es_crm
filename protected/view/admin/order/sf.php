<div>
	<h5>运单号: <?php echo $postNo ?> &nbsp;&nbsp;  <?php echo $route['head']['message'] ?> </h5>
	<ul class="list-group">
		
		<?php foreach($route['body'] as $k=>$v) {?>
		<li class="list-group-item " style=" padding-bottom: 10px;">
			</span> <span  style="color: red; "> <?php echo $v['acceptTime'] ?> </span>
			<?php echo $v["acceptAddress"] ."-".$v['remark'] ?>
		</li>
		<?php }?>
	</ul>
</div>
