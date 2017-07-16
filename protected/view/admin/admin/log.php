<form class="form-inline definewidth m20" action="<?php echo url("main", "log") ?>" method="get">   
  操作人：
    <input type="text" name="log_name" id="log_name"  class="input-medium" placeholder="" value="">&nbsp;&nbsp;  
  关键字：
    <input type="text" name="title" id="title"  class="input-medium" placeholder="" value="">&nbsp;&nbsp; 
  
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp; 
</form>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
    	<th>编号</th>
        <th>操作人</th>
        <th>标题</th>
        <th>ip</th>
        <th>时间</th>
        <th>操作</th>
    </tr>
    </thead>
        <?php 
            foreach($datas as $key=>$v){
        ?>
	     <tr>
	     	<td><?php echo $v["id"]?></td>
	        <td><?php echo $v["log_name"]?></td>
	        <td><?php echo $v["log_title"]?></td>
            <td><?php echo $v["log_ip"]?></td>
            <td><?php echo $v['log_date'] ?></td>
            <td>
                <a href="#contentModal"   data-toggle="modal" data-content="<?php  echo urlencode($v['log_memo']) ?>" title="日志详情" ><span class="icon-info-sign"></span>详情</a>       
            </td>
        </tr>	
        <?php } ?>
</table>

        <?php echo $page?>
</body>
</html>
