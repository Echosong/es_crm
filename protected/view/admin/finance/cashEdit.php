<form action="<?php echo url('finance', 'cashEdit')?>" method="post" class="definewidth m20" >
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td width="10%" class="tableleft">流水号</td>
        <input type="hidden" value="<?php echo $cash["id"]?>" name="id" />
        <td><input type="text" name="hao" value="<?php echo $cash["h_huihao"]?>"/></td>
    </tr>
    
   
    <tr>
        <td width="10%" class="tableleft">内容</td>
        <td>
            <textarea name="info"> <?php echo $cash["h_info"]?></textarea>
     </td>
    </tr>
    
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button">提交 </button> &nbsp;&nbsp;
        </td>
    </tr>
</table>
</form>


