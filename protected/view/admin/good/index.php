
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
	
 商品标题:

 	<input type="text" name="title" id="name" class="abc input-default" placeholder="" value="<?php echo $_GET['title']?>">&nbsp;&nbsp;
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp;
    <button type="button" class="btn btn-success" id="addnew">新增</button>
</form>
    
<table class="table table-bordered table-hover definewidth m10">
    <thead>
       
    <tr>
       <TH>编号</TH>
        <TH>标题</TH>
        <TH>图片</TH>
        <TH>类目</TH>
        <TH>价格</TH>
        <TH>库存</TH>
        <th>备注</th>
        <TH>操作</th>
    </tr>
    </thead>
        <?php 
            foreach($datas as $key=>$rs){
        ?>
         <tr>

            <td align="center" ><?php echo $rs["id"] ?></td>
            <td align="center"><?php echo $rs["title"]?></td>
            <td align="center"><?php echo"<img src='{$rs['img']}'  width='120' height='120' /> " ?></td>
            <td align="center"><?php echo  $rs["type"] ?></td>
            <td align="center"><?php echo $rs["price"] ?></td>
            <td align="center"><?php echo $rs["count"] ?></td>
            <td align="center"><?php echo $rs["memo"] ?> </td>
            <Td align="center">
            	<a href="<?php echo url('good', 'edit')."?id=".$rs['id'] ?>">修改</a>
            	<a href="javascript:void(0)" onclick="del(<?php echo $rs['id']?>)">删除</a>
             </th>
        </tr>   
        <?php } ?>
</table>

        <?php echo $page?>
</body>
</html>
<script>
    $(function () {
        $('#addnew').click(function(){
                window.location.href="<?php echo url('good','edit')?>";
         });

    });

    function del(id)
    {
        if(confirm("确定要删除吗？"))
        {
            var url = "<?php echo url('good','del')?>&id="+id;
            window.location.href=url;       
        }
    }
</script>