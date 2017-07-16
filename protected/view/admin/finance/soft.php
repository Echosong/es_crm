
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
    广告名称：
    <input type="text" name="name" id="name"class="abc input-default" placeholder="" value="">&nbsp;&nbsp;  
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp; <button type="button" class="btn btn-success" id="addnew">新增广告</button>
</form>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
       
    <tr>
    <TH >编号</TH>
    <TH >标题</TH>
    <TH >类别</th>
    <TH >排序</th>
    <TH >链接</th>
    <TH >操作</th>
    </tr>
    </thead>
        <?php 
            $softType = array('', '滚动广告');
            foreach($softs as $key=>$rs){
        ?>
         <tr>
            <td align="center"><?php echo $rs["id"] ?></td>
             <td align="center"><?php echo $rs["name"] ?></td>
             <td align="center"><?php echo $softType[$rs["type"]]  ?> </td>
             <td align="center"><?php echo $rs["order"] ?></td>
             <td align="center"><?php echo $rs["url"] ?></td>
             <td align="center">
                <a href="<?php echo url('new', 'editsoft').'?id='.$rs["id"] ?>">编辑</a>
                &nbsp;&nbsp;
                <a onclick="javascript:if(!confirm('确定删除该管理员？')){return false;}" href="<?php echo url('new', 'deleteSoft').'?id='.$rs["id"] ?>" title="删除该管理员" >删除</a>
             </td>
        </tr>   
      <?php } ?>
</table>
        <?php echo $page?>
</body>
</html>
<script>
   $("#addnew").click(function(){
		location.href = '<?php echo url('new', 'message') ?>';
	})
</script>