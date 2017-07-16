<?php

date_default_timezone_set('PRC');

$config = array(
	'rewrite' => array(
		'admin/index.html' => 'admin/main/index',
		'<m>/<c>_<a>.html'    => '<m>/<c>/<a>', 
		'<c>/<a>'          => '<c>/<a>',
		'/'                => 'main/index',
	),
	
	'orderstatus'=> array( '请选择', '新订单','已核实','快递下单中','快递下单','打印中','已发货','已收款', '订单完成','订单取消','拒收' ),
	'usersource'=>  array(''=>'请选择',1=>'手机自动抓取','qq自动抓取','400电话自动抓取','400电话打入','离线包加入','qq加入','微信加入'),
	'userstate'=>array(''=>'请选择',1=>'潜在用', '正式用户','成交客户'),
	'staffstate'=> array( '关闭', '正常'),
	'postCompany'=>array(1=>'顺丰' ,2=>'EMS' ),
);



$domain = array(
	
    "www.crm.com" => array( 
        'debug' => 1,
        'mysql' => array(
            'MYSQL_HOST' => '127.0.0.1',
            'MYSQL_PORT' => '3306',
            'MYSQL_USER' => 'root',
            'MYSQL_DB'   => 'db_cntlis',
            'MYSQL_PASS' => 'songfeiok', 
            'MYSQL_CHARSET' => 'utf8',
        ),
        'prefix' => '',        
    ),
    "www.hsnxja.com" => array( 
        'debug' => 1,
        'mysql' => array(
            'MYSQL_HOST' => 'localhost',
            'MYSQL_PORT' => '3306',
            'MYSQL_USER' => 'root',
            'MYSQL_DB'   => 'db_crm',
            'MYSQL_PASS' => 'SongSongLove112233', 
            'MYSQL_CHARSET' => 'utf8',
        ),
        'prefix' => '',        
    ),
);

return $domain[$_SERVER["HTTP_HOST"]] + $config;