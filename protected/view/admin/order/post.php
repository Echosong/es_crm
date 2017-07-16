<form action="<?php echo url('order', 'createpost')?>" method="post" class="definewidth m20" >
	<table class="table table-bordered table-hover definewidth m10">

		<tr>
			<td width="10%" class="tableleft">快递公司</td>
			<td>
				<input type="hidden" value="<?php echo $post['id'] ?>"  name="id"/>
				<input type="hidden" value="<?php echo $post['orderId'] ?>"  name="orderId"/>
				<select name="name" id="name" class="input-default">
					<?php foreach( $GLOBALS['postCompany']  as $k=>$v) {?>
						<option value="<?php echo $v ?>"> <?php echo $v ?> </option>
					<?php } ?>
				</select>
		</tr>
		<tr>
			<td width="10%" class="tableleft">运单号</td>
			<td>
				<input type="text" name="no"  id="no" value="<?php echo $post['no']?>" />
			</td>
		</tr>

		<tr>
			<td class="tableleft"></td>
			<td>
				<button type="submit" class="btn btn-primary" type="button">
				设 置
				</button> &nbsp;&nbsp; </td>
		</tr>
	</table>
	
</form>

<script type="text/javascript">
	$(function(){
		$("#name").val('<?php echo $post['name'] ?>' );
	})
</script>