
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
   <button type="button" class="btn btn-success" id="addnew">新增</button>
 </form>   
    
</form>

<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
   	<TH>编号</TH>
    <TH>类别</TH>
    <Th>上级</th>
    <Th>单页</th>
    <TH >操作</th>
    </tr>
    </thead>
        <?php 
            foreach($cars as $key=>$rs){
        ?>
         <tr>
           <td align="center" ><?php echo $rs["id"]?></td>
            <td align="center"><?php echo $rs["class_name"]?>  </td>
            <td align="center"><?php echo $rs['class_pid'] ?></td>
            <td align="center"><?php 
						if($rs["class_type"]==1)  echo "是"; else  echo "否"   ?></td>
       
            <td align="center"> 
            <a  href="<?php echo url("new",'newcaredit')."?id=".$rs['id'] ?>">修改</a>
            <a onclick="javascript:if(!confirm('确定要删除类别吗？')){return false;}"  href="<?php echo url("new",'newdelete')."?id=".$rs['id'] ?>">删除</a>
            </td>
        </tr>   
      <?php } ?>
</table>
        <?php echo $page?>
</body>
<script type="text/javascript">
	  $(function () {
        $('#addnew').click(function(){
                window.location.href="<?php echo url('new','newcaredit')?>";
         });
    });
</script>
</html>
