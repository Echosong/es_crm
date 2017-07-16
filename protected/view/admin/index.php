<!DOCTYPE HTML>
<html>
<head>
    <title>后台管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/i/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="/i/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
    <link href="/i/assets/css/main-min.css" rel="stylesheet" type="text/css" />
</head>
<body>


<div class="content">
    <div class="dl-main-nav">
        <div class="dl-inform"><div class="dl-inform-title"><s class="dl-inform-icon dl-up"></s></div></div>
        <ul id="J_Nav"  class="nav-list ks-clear">
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-home">系统管理</div></li>		
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-order">客户管理</div></li>
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-goods ">订单管理</div></li>
           
            <div class="dl-log"><span class="icon-user"></span> 欢迎您，<span class="dl-log-user"><?php echo $_SESSION['admin']['name'] ?></span>
                <a href="<?php echo url('main', 'logout') ?>" title="退出系统" class="dl-log-quit">[退出]</a>
            </div>
        </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">
    
    </ul>
</div>
<script type="text/javascript" src="/i/assets/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="/i/assets/js/bui-min.js"></script>
<script type="text/javascript" src="/i/assets/js/common/main-min.js"></script>
<script type="text/javascript" src="/i/assets/js/config-min.js"></script>
<script>
    BUI.use('common/main',function(){
        var config = [
        	{id:'1', homePage: '1',menu:
                [{text:'系统管理',items:[
	                    
	                    {id:'1',text:'员工管理',href:"<?php echo url('main','staff')?>"},
	                    {id:'2',text:'角色管理',href:"<?php echo url('main','role')?>"},
	                    {id:'3',text:'操作日志',href:"<?php echo url('main','log')?>"},
	                    {id:'4',text:'系统配置',href:"<?php echo url('main','config')?>"},
	                    
                	]
                }]
            },
        
            {id:'2', homePage: '1',menu:
                [{text:'客户管理',items:[
	                    
	                    {id:'1',text:'客户列表',href:"<?php echo url('user','list')?>"},
	                    {id:'2',text:'新增客户',href:"<?php echo url('user','modify')?>"},
                	]
                }]
            },
            
            {id:'3',homePage : '1',menu:
                [{text:'订单管理',
                items:[
	                   
	                    {id:'1',text:'订单列表',href:"<?php echo url('order','index')?>"},
	                    {id:'2',text:'商品管理',href:"<?php echo url('good','index')?>"},
	                  
                	]
                }]
        	},
        	/*
        	{id:'4',homePage : '1',menu:
                [{text:'财务管理',
                items:[
                   	 	 {id:'1',text:'资金明细',href:"<?php echo url('finance','index')?>"},
               
                	]
                }]
        	},
        	*/
        	
        	
        ];
        new PageUtil.MainPage({
            modulesConfig : config
        });
    });
   
</script>

</body>
</html>