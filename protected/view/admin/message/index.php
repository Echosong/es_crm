
<style type="text/css">body {
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
}</style>
<form class="form-inline definewidth m20" action="#" method="get">    
    会员编号：
    <input type="text" name="account" id="name"class="abc input-default" placeholder="" value="<?php  echo $_GET['account'] ?>">&nbsp;&nbsp;  
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp;<button type="button" class="btn btn-success" id="addnew">发送消息</button>
   
</form>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
       
    <TH >
		<nobr>
			发信人
		</nobr>
	</TH>
	<TH >
		<nobr>
			收信人
		</nobr>
	</TH>
	<TH >
		<nobr>
			标题
		</nobr>
	</TH>
	<TH >
		<nobr>
			创建时间
		</nobr>
	</TH>
	
	<TH >
		<nobr>
			操作
		</nobr>
	</TH>
</TR>  
    </thead>
         <?php foreach($message as $v){ ?>
        <TR class="datalist">
           <TD><?php echo $v['m_mid'] ?></TD>
            <TD><nobr><?php echo $v['m_uid'] ?></nobr></TD>
            <TD><nobr><?php echo $v['m_title'] ?></nobr></TD>
            <TD><nobr><?php echo $v['m_content'] ?></nobr></TD>
            <TD><nobr><?php echo $v['m_time'] ?></nobr></TD>
        </TR>    
        <?php } ?>
</table>
        <?php echo $page?>
</body>
</html>
<script>$("#addnew").click(function() {
			location.href = '<?php echo url('new', 'message') ?>';
})</script>