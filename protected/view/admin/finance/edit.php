
<script src="/i/kindeditor/kindeditor-min.js"></script>
<form action="<?php echo url('new', 'edit')?>" method="post" class="definewidth m20" enctype="multipart/form-data" >
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td width="10%" class="tableleft">标题</td>
        <input type="hidden" value="<?php echo $new["id"]?>" name="id" />
        <td><input type="text" name="n_name" value="<?php echo $new["n_name"]?>"/></td>
    </tr>
    
    <tr>
        <td width="10%" class="tableleft">类别</td>
        <td>
        	<select name="n_type" id="n_type">
        		<?php foreach($pclass as $v) {?>
        			<option value="<?php echo $v['id'] ?>"><?php echo $v['class_name'] ?></option>
        		<?php }?>
        	</select>
        </td>
    </tr>
   
    <tr>
        <td width="10%" class="tableleft">内容</td>
        <td>
            <textarea name="n_info"> <?php echo $new["n_info"]?></textarea>
     </td>
    </tr>
    
    <tr>
        <td width="10%" class="tableleft">图片</td>
        <td><input type="text" name="n_img" value="<?php echo $new["n_img"]?>"/>
            <input type="file" id="lefile" name="pic" value="" style="display: none;" >
            <a class="btn" onclick="$('input[id=lefile]').click();">Browse</a>
        </td>
    </tr>
    
    <tr>
        <td width="10%" class="tableleft">时间</td>
        <td><input type="text" name="n_time" value="<?php echo $new["n_time"]?>"/></td>
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
	$(function(){
        $("#lefile").change(function(){
            $("input[name='n_img']").val($(this).val());
        })
        $("#n_type").val(<?php echo $new['n_type'] ?>);
    })
		var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="n_info"]', {
					allowFileManager : true,
					 width : '800px',
					 height:'340px'
				});		
			})

</script>
