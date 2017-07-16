
<script src="/i/kindeditor/kindeditor-min.js"></script>
<form action="<?php echo url('new', 'newcaredit')?>" method="post" class="definewidth m20" enctype="multipart/form-data" >
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td width="10%" class="tableleft">标题</td>
        <input type="hidden" value="<?php echo $car["id"]?>" name="id" />
        <td><input type="text" name="class_name" value="<?php echo $car["class_name"]?>"/></td>
    </tr>

    <tr>
        <td width="10%" class="tableleft">上级</td>
        <td>
        	<select name="class_pid" id="class_pid">
        		<option value="0">请选择</option>
        		<?php foreach($pclass as $v){ 
        			if($v['id'] != $car['id'] ){	
        		?>
        		
        		<option value="<?php echo $v['id'] ?>"><?php  echo $v['class_name']?></option>
        		<?php 
					}
				}?>
        	</select>
        </td>
    </tr>
   
   	<tr>
        <td width="10%" class="tableleft">类型</td>
        <td>
        	<select name="class_type" id="class_type">
        		<option value="1">单页</option>
        		<option value="0">列表</option>
        		<option value="2">产品</option>
        	</select>
        </td>
    </tr>
    
    <tr>
        <td width="10%" class="tableleft">排序</td>
        <td>
        	<input type="class_orderid" name="class_orderid" id="" value="<?php echo $v['class_orderid'] ?>" />
        </td>
    </tr>
    
    <tbody id="content">
    <tr>
        <td width="10%" class="tableleft">内容</td>
        <td>
            <textarea name="class_content"> <?php echo $car["class_content"]?></textarea>
     </td>
    </tr>
    </tbody>
    <tr>
        <td width="10%" class="tableleft">图片</td>
        <td><input type="text" name="class_img" value="<?php echo $car["class_img"]?>"/>
            <input type="file" id="lefile" name="pic" value="" style="display: none;" >
            <a class="btn" onclick="$('input[id=lefile]').click();">Browse</a>
        </td>
    </tr>
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button">保存</button> &nbsp;&nbsp;<button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
        </td>
    </tr>
</table>
</form>
<script type="text/javascript">
	

	$("#class_type").change(function(){
		val = $(this).val();
		if(val==1){
			$("#content").show();
		}else{
			$("#content").hide();
		}
	})
	
	$(function(){
        $("#lefile").change(function(){
            $("input[name='class_img']").val($(this).val());
        })
        $("#class_pid").val(<?php echo $car['class_pid']|0 ?>);
        $("#class_type").val(<?php echo $car['class_type'] ?>)
    })
		var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="class_content"]', {
					allowFileManager : true,
					 width : '800px',
					 height:'340px'
				});		
			})

</script>
