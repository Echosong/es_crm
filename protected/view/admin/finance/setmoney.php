<form action="<?php echo url('finance', 'setMoney')?>" method="post" class="definewidth m20" >
<table class="table table-bordered table-hover definewidth m10">
    
    <tr>
        <td width="10%" class="tableleft">用户</td>
        <td>
        	<?php  echo $money['account'] ?>
     </td>
     
     <tr>
        <td width="10%" class="tableleft">余额</td>
        <td>
        	<?php  echo $money['currency'] ?>
     </td>
    </tr>
    
     <tr>
        <td width="10%" class="tableleft"><?php  echo $value?> 金额</td>
        <td>
        	<input type="hidden" value="<?php echo $money['account']?>" name="account"  />
        	<input type="hidden" name="type" id="type" value="<?php echo $type ?>" />
        	<input type="text" name="money" id="" value="" />
     </td>
    </tr>
    
    <tr>
        <td width="10%" class="tableleft">备注</td>
        <td>
        	<textarea name="info"></textarea>
     </td>
    </tr>
    
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button">同意<?php echo $value ?> </button> &nbsp;&nbsp;
            <button type="button" class="btn btn-primary" type="button" onclick="javascript:location.back(-1);">不同意 </button> &nbsp;&nbsp;
        </td>
    </tr>
</table>
</form>

