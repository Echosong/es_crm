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
<SCRIPT src="/i/My97DatePicker/WdatePicker.js"></SCRIPT>
<script src="/i/js/jquery.cookie.js"></script>
<form class="form-inline definewidth m20" action="#" method="get">
	订单编号：
	<input type="text" name="id" id="name" class="input-medium" placeholder="" value="<?php echo $_GET['id']?>">
	&nbsp;&nbsp;
	订单状态:
	<select name="Status" class="input-medium">
		<?php foreach($GLOBALS['orderstatus'] as $k=>$v) {?>
<option value="<?php  echo $k ?>"><?php echo $v ?></option>
<?php } ?>
	</select>&nbsp;&nbsp;
	下单人 :
	<input type="text" name="customerAccount" id="name" class="input-medium" placeholder="" value="<?php echo $_GET['customerAccount']?>">
	&nbsp;&nbsp;
	售前 :
	<input type="text" name="creater" id="name" class="input-medium" placeholder="" value="<?php echo $_GET['username']?>">
	&nbsp;&nbsp;
	售后 :
	<input type="text" name="service" id="name" class="input-medium" placeholder="" value="<?php echo $_GET['username']?>">
	&nbsp;&nbsp;
	时间：
	<input type="text" name="beginDate" id="name" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"  class="input-medium" placeholder="" value="<?php echo $_GET['beginDate']?>">
	至

	<input type="text" name="endDate" id="name" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"  class="input-medium" placeholder="" value="<?php echo $_GET['endDate']?>">
	&nbsp;&nbsp;

	<button type="submit" class="btn btn-primary">
	查询
	</button>
	&nbsp;&nbsp;
</form>
<table class="table table-bordered table-hover definewidth m10">
	<thead>
		<tr>
			<TH>编号</TH>
			<TH>商品</TH>
			<TH>规格</TH>
			<TH>购买人</TH>
			<TH>联系方式</TH>
			<th>单价</th>
			<TH>总数量</TH>
			<TH>总价格</TH>
			<TH>时间</TH>
			<TH>售前</TH>
			<TH>售后</TH>
			<th>状态</th>
			<th>操作</th>
		</tr>
	</thead>
	<?php
foreach($datas as $key=>$rs){
?>
<tr>
<td align="center" ><?php echo $rs["Id"] ?></td>
<td align="center"><?php echo $rs['goodName'] ?></td>
<td align="center"><?php echo $rs['OrderKeywords'] ?></td>
<td align="center"><?php echo $rs['customerAccount'] ?></td>
<td align="center"><?php echo $rs['UserPhone'] ?></td>
<td align="center"><?php echo  $rs["goodPrice"] ?></td>
<td align="center"><?php echo  $rs["goodNum"] ?></td>
<td align="center"><?php echo  $rs["OrderAmount"] ?></td>
<td align="center"><?php echo $rs["CreateDate"] ?></td>
<td align="center"><?php echo $rs["creater"] ?></td>
<td align="center"><?php echo $rs["service"] ?></td>
<td align="center" style="font-weight: bold;"><?php echo  $GLOBALS['orderstatus'][$rs['Status']]?></td>
<td align="center" >
<?php if($rs['Status']==1) {?>
<a href="#list" date-type="check" title="核实后订单后 会自动发送快递公司下快递单，你确定要核实吗?" data-url="<?php echo  url('order', 'UpdateState')."?id=".$rs['Id']."&state=2" ?>"  ><span class="icon-inbox"></span>核实</a>
<?php }?>
	
<?php if($rs['Status']==3) {?>
<a href="#list" date-type="search" title="查询订单" data-url="<?php echo  url('order', 'SearchPost')."?id=".$rs['Id'] ?>"  ><span class="icon-search"></span>刷新快递</a>
<?php }?>

<?php if($rs['Status'] == 2) {?>
&nbsp;<a href="#list" date-type="print" title="确定顺丰公司快递下单吗?" data-url="<?php echo  url('order', 'UpdateState')."?id=".$rs['Id']."&state=3" ?>"  ><span class="icon-picture"></span>快递下单</a>
<?php }?>
	
<?php if($rs['Status']==4) {?>
&nbsp;<a href="#list" date-type="print" title="确认审核打印该订单吗?" data-url="<?php echo  url('order', 'UpdateState')."?id=".$rs['Id']."&state=5" ?>"  ><span class="icon-picture"></span>打印</a>
<?php }?>


	
<?php if($rs['Status']>4) {?>
&nbsp;<a href="#myiframeModal"  data-url="<?php echo url('order', 'route')."?id=".$rs['Id'] ?>"  data-toggle="modal"  title="快递物流" ><span class="icon-share"></span>查看物流</a>
<?php }?>

<?php if($rs['Status']>1 and $rs['Status']!=9) {?>
&nbsp;<a href="#myiframeModal" title="手动设置物流信息" data-toggle="modal"  data-url="<?php echo  url('order', 'createPost')."?id=".$rs['Id']."&state=5" ?>"  ><span class="icon-camera"></span>设置物流</a>
<?php }?>
<?php if($rs['Status']!=9){?>
&nbsp;<a href="#list" date-type="remove" title="确定要取消该订单吗?" data-url="<?php echo  url('order', 'UpdateState')."?id=".$rs['Id']."&state=9" ?>"  ><span class="icon-remove"></span>取消订单</a>
<?php }?>
&nbsp;<a  href="<?php echo url('order','create')."?id=".$rs['Id'] ?>" title="订单修改" >
<label class="icon-edit"></label>修改
</a>
</td>
</tr>
<?php } ?>
</table>
<?php echo $page?>
</body>
<script type="text/javascript">
$(function() {
	$.cookie("search", 1); 
	/**
	 * 统一删除提示
	 */
	$("a[href='#list']").click(function(){
		var type = $(this).attr("data-type");
		var flg = true;
		if(!$.cookie(type)){
			$.cookie(type, 1); 
			flg = confirm($(this).attr("title"));	
		}
		if(flg){
			var url = $(this).attr('data-url');
			$.get(url, function(data){
				if(data.code==0){
					alert(data.message);
					location.reload();
				}else{
					alert(data.message);
				}
			},"json");
		}
	})
})
</script>
</html>