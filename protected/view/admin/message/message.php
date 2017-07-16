
<script src="/i/kindeditor/kindeditor-min.js"></script>
<form action="<?php echo url('new', 'Message')?>" method="post" class="definewidth m20" enctype="multipart/form-data" >
<table class="table table-bordered table-hover definewidth m10">
	 <tr>
        <td width="10%" class="tableleft">对象</td>
        <td><input type="text" name="m_uid" value=""/> 复制用户的编号, 不填为发送给全部用户</td>
    </tr>
   
    <tr>
        <td width="10%" class="tableleft">内容</td>
        <td>
            <textarea name="m_content"> <?php echo $new["n_info"]?></textarea>
     </td>
    </tr>
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button">发送</button> &nbsp;&nbsp;<button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
        </td>
    </tr>
</table>
</form>
<script type="text/javascript">
	
		var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="m_content"]', {
					allowFileManager : true,
					 width : '800px',
					 height:'340px'
				});		
			})

</script>
