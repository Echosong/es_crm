<form action="<?php echo url('new', 'editsoft')?>" method="post" class="definewidth m20" enctype="multipart/form-data" >
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td width="10%" class="tableleft">标题</td>
       
        <td>
            <input type="hidden" name="id" value="<?php echo $soft['id'] ?>" />
            <input type="text" name="name" value="<?php echo $soft["name"]?>"/></td>
    </tr>
    
    <tr>
        <td width="10%" class="tableleft">类别</td>
        <td>
            <select name="type" class="selectpicker">
                <option value="1" <?php if ($soft['type']==1) {echo "checked";}?> >成人贷款</option>
                <option value="2" <?php if ($soft['type']==2) {echo "checked";}?> >大学生贷款</option>
                <option value="3" <?php if ($soft['type']==3) {echo "checked";}?> >提额神器</option>
                <option value="4" <?php if ($soft['type']==4) {echo "checked";}?> >微商神器</option>
                <option value="5" <?php if ($soft['type']==5) {echo "checked";}?> >信用卡快卡</option>
                <option value="6" <?php if ($soft['type']==6) {echo "checked";}?> >广告</option>
            </select>
            </td>
    </tr>
   
    <tr>
        <td width="10%" class="tableleft">描述</td>
        <td><textarea name="info"><?php echo $soft["info"]?></textarea> </td>
    </tr>
    
    <tr>
        <td width="10%" class="tableleft">图片</td>
        <td>
            <input type="file" id="lefile" name="pic" value="" style="display: none;" >
            <input type="text" name="img" value="<?php echo $soft["img"]?>"/>
            <a class="btn" onclick="$('input[id=lefile]').click();">Browse</a>
        </td>
    </tr>
    
    <tr>
        <td width="10%" class="tableleft">连接</td>
        <td><input type="url" name="url" value="<?php echo $soft["url"]?>"/></td>
    </tr>
    
    <tr>
        <td width="10%" class="tableleft">排序</td>
        <td><input type="text" name="order" value="<?php echo $soft["order"]?>"/></td>
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
	        $("input[name='img']").val( 'i/uploads/'+$(this).val());
	    })
	})
</script>
