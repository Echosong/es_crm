<form action="<?php echo url('admin', 'role')?>" method="post" class="definewidth m20" >
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td width="10%" class="tableleft">角色名称</td>
        <input type="hidden" value="<?php echo $admin["id"]?>" name="id" />
        <td><input type="text" name="admin_name" value="<?php echo $admin["admin_name"]?>"/></td>
    </tr>

    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button">保存</button> &nbsp;&nbsp;<button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
        </td>
    </tr>
</table>
</form>
