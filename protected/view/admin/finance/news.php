
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
    标题:<input type="text" name="n_name" id="name"class="abc input-default" placeholder="" value="">&nbsp;&nbsp;  
        <button type="button" class="btn btn-success" id="addnew">新增</button>
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp; 
    
</form>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
       
    <tr>
    <TH width="15%">编号</TH>
    <TH width="25%">标题</TH>
    <TH width="20%">类别</th>
    <TH width="20%">时间</th>
    <TH >操作</th>
    </tr>
    </thead>
        <?php 
            foreach($news as $key=>$rs){
        ?>
         <tr>
            <td align="center"><?php echo $rs["id"] ?></td>
             <td align="center"><?php echo $rs["n_name"] ?></td>
             <td align="center">
                <?php echo  $rs["n_type"] ?> 
             </td>
             <td align="center"><?php echo $rs["n_time"] ?></td>
             <td align="center">
                <a href="<?php echo url('new', 'edit').'?id='.$rs["id"] ?>">编辑</a>
                &nbsp;&nbsp;
                <a onclick="javascript:if(!confirm('确定删除该管理员？')){return false;}" href="<?php echo url('new', 'delete').'?id='.$rs["id"] ?>" title="删除该管理员" >删除</a>
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
                window.location.href="<?php echo url('new','edit')?>";
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