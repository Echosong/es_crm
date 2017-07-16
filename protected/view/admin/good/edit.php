<form action="<?php echo url('good', 'edit')?>" method="post" class="definewidth m20" enctype="multipart/form-data" >
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td width="10%" class="tableleft">标题</td>
        <input type="hidden" value="<?php echo $good["id"]?>" name="id" />
        <td><input type="text" name="title" value="<?php echo $good["title"]?>"/></td>
    </tr>
    
    <tr>
        <td width="10%" class="tableleft">类别</td>
        <td>
        	<select name="type"><option value="保健品">保健品</option></select>
        </td>
    </tr>
   
    <tr>
        <td width="10%" class="tableleft">价格</td>
        <td>
        	<input type="text" name="price" value="<?php echo $good["price"]?>"/>
     </td>
    </tr>
    
    <tr>
        <td width="10%" class="tableleft">运费</td>
        <td>
        	<input type="text" name="postPrice" value="<?php echo $good["postPrice"]?>"/>
     </td>
    </tr>
   
    <tr>
        <td width="10%" class="tableleft">库存</td>
        <td>
            <input type="text" name="count" value="<?php echo $good["count"]?>"/>
     </td>
    </tr>
    
    <tr>
        <td width="10%" class="tableleft">图片</td>
        <td><input type="text" name="img" value="<?php echo $good["img"]?>"/>
            <input type="file" id="lefile" name="pic" value="" style="display: none;" >
            <a class="btn" onclick="$('input[id=lefile]').click();">Browse</a>
        </td>
    </tr>
    
    
     <tr>
        <td width="10%" class="tableleft">商品规格</td>
        <td>
            <textarea name="memo" cols="600" rows="10"> <?php echo $good["memo"]?></textarea>
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
	$(function(){
        $("#lefile").change(function(){
            $("input[name='img']").val($(this).val());
        })
    })
</script>
