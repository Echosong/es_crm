<form action="<?php echo url('finance', 'addMoneyEdit')?>" method="post" class="definewidth m20" >
<table class="table table-bordered table-hover definewidth m10">
    
    <tr>
        <td width="10%" class="tableleft">说明</td>
        <td>
        	<input type="hidden" value="<?php echo $cash["id"]?>" name="id" />
            <textarea name="info"> <?php echo $cash["h_info"]?></textarea>
     </td>
    </tr>
    
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button">同意加款入账 </button> &nbsp;&nbsp;
            <button type="button" class="btn btn-primary" type="button" onclick="javascript:location.history(-1);">不同意 </button> &nbsp;&nbsp;
        </td>
    </tr>
</table>
</form>

