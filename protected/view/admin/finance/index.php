
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
 <form class="form-inline definewidth m20" action="#" method="get">    
    用户:<input type="text" name="fund_uid" id="fund_uid"class="abc input-default" placeholder="" value="<?php echo $_GET['fund_uid']?>">&nbsp;&nbsp;  
      <select name="fund_type">
     
      	<option value="">全部</option>
      	<?php
			foreach ($GLOBALS['fundType'] as $k => $v) {
				if($_GET['fund_type']==$k){
					echo "<option selected value='{$k}'>{$v}</option>";
				}else{
					echo "<option value='{$k}'>{$v}</option>";
				}
				
			}
      	?>
      </select>  
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp; 
    
</form>
    
<table class="table table-bordered table-hover definewidth m10">
    <thead> 
    <tr>
       <TH>变动编号</TH>
        <TH>变动标题</TH>
        <TH>变动类型</TH>
        <TH>变动时间</TH>
        <TH>变动人</TH>
        <TH>变动姓名</TH>
        <th>变动前额度</th>
        <TH>变动金额</th>
        <TH>变动变动后金额</th>
        <TH>相关变动编号</th>
      
    </tr>
    </thead>
        <?php 
            foreach($finances as $key=>$rs){
        ?>
         <tr>
             <td align="center" ><?php echo $rs["id"] ?></td>
            <td align="center"><?php echo $rs["fund_title"]?></td>
            <td align="center"><?php echo $GLOBALS['fundType'][$rs["fund_type"]]  ?></td>
            <td align="center"><?php echo $rs["fund_time"] ?></td>
            <td align="center"><?php echo $rs["fund_uid"] ?></td>
            <td align="center"><?php echo $rs["username"] ?></td>
            <td align="center"><?php echo $rs["fund_beginamout"] ?> </td>
            <td align="center"><?php echo $rs["fund_amout"] ?> </td>
            <td align="center"><?php echo $rs["fund_afteramout"] ?> </td>
            <Td align="center"><?php echo $rs["fund_retionid"] ?></th>
			
        </tr>   
        <?php } ?>
</table>
        <?php echo $page?>
</body>
</html>
<script>$(function() {
	$('#addnew').click(function() {
		window.location.href = "add.html";
	});

});

function del(id) {
	if (confirm("确定要删除吗？")) {
		var url = "<?php echo url('admin','')?>";
window.location.href = url;
}
}</script>