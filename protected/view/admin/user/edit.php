<script src="/i/kindeditor/kindeditor-min.js"></script>
<form action="<?php echo url('user', 'modify')?>" method="post" class="definewidth m20" >
<table class="table table-bordered table-hover definewidth m10">
    
    <tr>
        <td width="10%" class="tableleft">姓名</td>
        <td>
        	<input type="hidden" value="<?php echo $user["id"]?>" name="id" />
            <input type="text" name="name" id="name" value="<?php echo $user['name']?>" />
     </td>
    </tr>
   
    <tr>
        <td width="10%" class="tableleft">账号</td>
        <td>
        	
            <input type="text" name="account" id="account" value="<?php echo $user['account']?>" />
     </td>
    </tr>
    
    <tr>
        <td width="10%" class="tableleft">性别</td>
        <td>
        	<select name="sex" class="input-mini">
        		<option value="男">男</option>
        		<option value="女">女</option>
        	</select>
     </td>
    </tr>
    
    <tr>
        <td width="10%" class="tableleft">来源</td>
        <td>
        	<select name="source"  class="input-medium">
		    	<?php
				foreach ($GLOBALS['usersource'] as $k => $v) {
					if (intval($user['source']) == intval($k)) {
						echo "<option selected value='{$k}'>{$v}</option>";
					} else {
						echo "<option value='{$k}'>{$v}</option>";
					}
				}
		    	?>
		    </select> 
     </td>
    </tr>
    
     <tr>
        <td width="10%" class="tableleft">qq</td>
        <td>
            <input type="text" name="qq" id="qq" value="<?php echo $user['qq']?>" />
     </td>
    </tr>
    
     <tr>
        <td width="10%" class="tableleft">手机</td>
        <td>
            <input type="text" name="mobile" id="mobile" value="<?php echo $user['mobile']?>" />
     </td>
    </tr>
    
     <tr>
        <td width="10%" class="tableleft">微信</td>
        <td>
            <input type="text" name="wx" id="wx" value="<?php echo $user['wx']?>" />
     </td>
    </tr>
    
    <tr>
        <td width="10%" class="tableleft">备注</td>
        <td>
        	<textarea name="memo" class="ke-edit-textarea"><?php echo $user['memo']?></textarea>
     </td>
    </tr>
 
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button"><?php echo $title?> </button> &nbsp;&nbsp;
        </td>
    </tr>
</table>
</form>
<script type="text/javascript">
	
		var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="memo"]', {
					allowFileManager : true,
					 width : '800px',
					 height:'340px'
				});		
			})
</script>
