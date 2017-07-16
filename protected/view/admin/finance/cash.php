
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

<table class="table table-bordered table-hover definewidth m10">
    <thead>
       
    <tr>
    <TH>编号</TH>
    <Th>申请会员</th>
    <Th>申请姓名</th>
    <TH>金额</th>
    <Th>提现银行</th>
    <Th>提现账号</th>
    <Th>开户行</th>
    <TH>手续费</th>
    <TH>最终金额</th>
    <th>提现时间</th>
    <th>审核时间</th>
    <th>状态</th>
    <TH >操作</th>
    </tr>
    </thead>
        <?php 
            foreach($cashs as $key=>$rs){
        ?>
         <tr>
           <td align="center" ><?php echo $rs["id"]?></td>
            <td align="center"><?php echo $rs["h_uaccount"]?>  </td>
             <td align="center"><?php echo $rs["h_username"]?>  </td>
            <td align="center"><font style="color:#f00"><b><?php echo $rs["h_money"]?></b></font> RMB</td>
            <td align="center"><?php echo $rs["h_bank"]?>  </td>
            <td align="center"><?php echo $rs["h_bankaccount"]?>  </td>
            <td align="center"><?php echo $rs["h_bankaddress"]?>  </td>
            <td align="center"><?php echo $rs["h_late"] ?></td>
            <td align="center"><?php echo $rs["h_realmoney"] ?></td>
            <!--<td align="center"><?php echo $rs["h_huihao"] ?></td>-->
            <td align="center"><?php echo $rs["h_time"]?></td>
            <td align="center"><?php echo $rs["s_time"]?></td>
            <td align="center" style="color:#f00">
            <?php 
                if($rs["h_ztai"]==2){
                    echo "取消";   
                } elseif($rs["h_ztai"]==1){
                    echo "已审核";
                }else{
                    echo "未审核";
                }
            ?>
            </td>
            <td align="center">
                <?php
                 if($rs['h_ztai']==0){ 
                 ?>   
                    <a  href="<?php echo url("finance",'cashEdit')."?id=".$rs['id'] ?>">同意</a>
                    <a onclick="javascript:if(!confirm('确定要拒绝申请吗？')){return false;}"  href="<?php echo url("finance",'cashNo')."?id=".$rs['id'] ?>">拒绝</a>
               <?php } ?>
            </td>
        </tr>   
      <?php } ?>
</table>

        <?php echo $page?>
</body>
</html>
<script>
    $(function () {
        $('#addnew').click(function(){
                window.location.href="add.html";
         });
    });

    function del(id)
    {
        if(confirm("确定要删除吗？"))
        {
            var url = "<?php echo url('admin','')?>";
            window.location.href=url;       
        }
    }
</script>