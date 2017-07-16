
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

<table class="table table-bordered table-hover definewidth m10">
    <thead>
       
    <TR class="datafield" >
		<TH >汇款时间</TH>
		<TH >审核时间</TH>
		<TH >会员编号</TH>
		<TH >会员姓名</TH>
		<TH >金额</TH>
		<TH >汇款银行</TH>
		<TH >汇款号</TH>
		<TH >汇款卡号</TH>
		<TH >状态</TH>
		<TH >操作</TH>
	</TR>
    </thead>
        <?php 
            foreach($cashs as $key=>$v){
        ?>
         <tr>
            <td><?php echo $v['h_time'] ?></td>
			<td><?php echo $v['s_time'] ?></td>
			<td align="center"><?php echo $v["h_uaccount"]?>  </td>
			<td><?php echo $v['h_username'] ?></td>
			<td><?php echo $v['h_money'] ?></td>
			<td><?php echo $v['b_bank'] ?></td>
			<td><?php echo $v['h_dhao']?></td>
			<td><?php echo $v['h_card']?></td>
			<td>
				<?php 
                if($v["h_ztai"]==2){
                    echo "取消";   
                } elseif($v["h_ztai"]==1){
                    echo "已审核";
                }else{
                    echo "未审核";
                }
            ?>
				
			</td>
			
            <td align="center">
                <?php
                 if($v['h_ztai']==0){ 
                 ?>   
                    <a  href="<?php echo url("finance",'addMoneyEdit')."?id=".$v['id'] ?>">同意</a>
                   
               <?php } ?>
            </td>
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