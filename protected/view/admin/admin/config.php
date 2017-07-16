<style type="text/css">
        body {
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }

        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }
    </style>
    
  

<form action="<?php echo url('main', 'config')?>" method="post" class="definewidth m20" >
  <div class="m10" style="padding-left: 40px; padding-bottom: 10px;" >
  	
  </div>

<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td width="10%" class="tableleft">快递接口地址</td>
        <td><input type="text" name="sfurl" value="<?php echo $config["sfurl"]?>"/></td>
    </tr>
    
    <tr>
        <td width="10%" class="tableleft">sfid：</td>
        <td><input type="text" name="sfid" value="<?php echo $config["sfid"]?>"/></td>
    </tr>
    
    <tr>
        <td width="10%" class="tableleft">sfkey：</td>
        <td><input type="text" name="sfkey" value="<?php echo $config["sfkey"]?>"/></td>
    </tr>
   
    <tr>
        <td width="10%" class="tableleft">月结卡号：</td>
        <td><input type="text" name="sfcustId" value="<?php echo $config["sfcustId"]?>"/></td>
    </tr>
    
    
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button">保存</button> 
        </td>
    </tr>
</table>
</form>
