<form class="form-inline definewidth m20" action="index.html" method="get">  
   <button type="button" class="btn btn-success" id="addnew">新增角色</button>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>角色名称</th>
        <th>管理操作</th>
    </tr>
    </thead>
    <?php foreach($roles as $key=>$role){?>
         <tr>
            <td><?php echo $role["name"]?></td>
            <td>
                  <a href="<?php echo url('main','editRole').'?id='.$role['id']?>"><label class="icon-edit"></label> 编辑</a> 
                  <a href="#del" data-url = "<?php echo url('main','delRole')."?id=". $rs['id'] ?>"  title="角色" > <label class="icon-remove"></label>删除</a>                 
            </td>
        </tr>
    <?php } ?>
   </table>
<script type="text/javascript">
	$(function(){
	    $("#addnew").click(function(){
	        location.href= "<?php echo url('main','editRole')?>";
	    })
	})
	
</script>