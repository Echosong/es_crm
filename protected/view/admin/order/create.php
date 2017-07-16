<SCRIPT src="/i/My97DatePicker/WdatePicker.js"></SCRIPT>
<script type="text/javascript" src="/i/city/js/jquery.cityselect.js"></script>
<form action="<?php echo url('order', 'create')?>" method="post" class="definewidth m20" >
<table class="table table-bordered table-hover definewidth m10">
    
     <tr>
        <td width="10%" class="tableleft">用户账号</td>
        <td>
        	<input type="text" readonly="true" name="customerAccount" value="<?php echo $order['customerAccount'] ?>" />
     </td>
    </tr>
    <tr>
        <td width="10%" class="tableleft">商品</td>
        <td>
        	<input type="hidden" value="<?php echo $order['Id'] ?>"  name="id"/>
        	<input type="hidden" value="<?php echo $order["customerId"]?>" name="customerId" />
           <select name="goodName" id="goodName" class="input-default">
           		<?php foreach( $goods  as $k=>$v) {?>
           			<option value="<?php echo $v['title'] ?>" data-attr="<?php echo $v['memo'] ?>" data-price = "<?php echo $v['price'] ?>"> <?php echo $v['title']  ?> </option>
           		<?php } ?>
           </select>
           
           <select  id="attr" name="atrr">
           		
           </select>
     </td>
    </tr>
   
   <tr>
        <td width="10%" class="tableleft">单价</td>
        <td>
            <input type="text" name="goodPrice" readonly="true" id="goodPrice" value="<?php echo $order['goodPrice']?>" />
     </td>
    </tr>
   
    <tr>
        <td width="10%" class="tableleft">数量</td>
        <td>
            <input type="text" name="goodNum" id="goodNum" value="<?php echo $order['goodNum'] or 1 ?>" />
     </td>
    </tr>
    
    <tr>
        <td width="10%" class="tableleft">规格</td>
        <td>
        	<input type="text" name="OrderKeywords" id="OrderKeywords" value="<?php echo $order['OrderKeywords'] ?>" />
     </td>
    </tr>
    
     <tr>
        <td width="10%" class="tableleft">总金额</td>
        <td>
            <input type="text" name="OrderAmount" id="OrderAmount" value="<?php echo $order['OrderAmount']?>" />
     </td>
    </tr>
    
 	<tr>
        <td width="10%" class="tableleft">收件人</td>
        <td>
            <input type="text" name="user" id="user" value="<?php echo $order['user']?>" />
     </td>
    </tr>
    
 	<tr>
        <td width="10%" class="tableleft">地址</td>
        <td>

        	<div id="city_4">
		  		<select class="prov" name="province"></select> 
		    	<select class="city" disabled="disabled" name="city"></select>
		        <select class="dist" disabled="disabled" name="county"></select>
		    </div>
     </td>
   </tr>
    
    <tr>
        <td width="10%" class="tableleft">详细地址</td>
        <td>
        	<textarea name="address" class=" input-xxlarge" style="height: 50px;"><?php echo $order['address']?></textarea>
     </td>
    </tr>
    
     
    <tr>
        <td width="10%" class="tableleft">联系方式</td>
        <td>
            <input type="text" name="UserPhone" id="UserPhone" value="<?php echo $order['UserPhone']?>" />
     </td>
    </tr>
     <tr>
        <td width="10%" class="tableleft">下单时间</td>
        <td>
            <input type="text" name="createDate" id="createDate"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"  value="<?php echo empty($order['createDate'])? date('Y-m-d H:i:s'):$order['createDate']  ?>" />
     </td>
    </tr>
    
    <tr>
        <td width="10%" class="tableleft">备注</td>
        <td>
        	<textarea name="goodMemo" class=" input-xxlarge" style="height: 100px;"><?php echo $order['goodMemo']?></textarea>
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
	$(function(){
		$("#goodName").val('<?php echo $order['goodName'] ?>');
		$("#goodName").change(function(){
			var price = $(this).find("option:selected").attr('data-price');
			$("#goodPrice").val(price);
			$("#OrderAmount").val(parseFloat(price) * parseInt($("#goodNum").val()));
			$("#attr").empty();
			var attrSelect = $(this).find("option:selected").attr('data-attr').split(',');
			for (i=0;i< attrSelect.length;i++) {
				$("#attr").append("<option value='"+attrSelect[i]+"'>"+attrSelect[i]+"</option>");
				$("#OrderKeywords").val($("#attr").val()+"*"+ $("#goodNum").val());
			} 
		});
		$("#goodNum").change(function(){
			$("#OrderAmount").val(parseFloat($("#goodPrice").val()) * parseInt($("#goodNum").val()));
			$("#OrderKeywords").val($("#attr").val()+"*"+ $("#goodNum").val());
		})
		$("#city_4").citySelect({
	    	url:"/i/city/js/city.min.js"
		});
		
		$("#attr").change(function(){
			$("#OrderKeywords").val($("#attr").val()+"*"+ $("#goodNum").val());
		});
		
		
		
		$(".prov").val('<?php  echo $order['province'] ?>');
		$(".city").val('<?php  echo $order['city']?>');
		$(".dist").val('<?php echo $order['county'] ?>');
	})
	
	
</script>
