<?php 

class  OrderController extends  BaseController{

	/**
	 * 订单列表
	 */
	public function getIndex(){
		$whereEx = " ";
		$where = array('goodname'=>'s', 'Status'=>'i', 'id'=>'i', 'service'=>'s', 'creater'=>'s');
		if(!empty($_GET['beginDate'])){
			$whereEx.= " AND CreateDate>'{$_GET['beginDate']}'";
		}
		if(!empty($_GET['endDate'])){
			$whereEx .= " AND CreateDate < '{$_GET['endDate']}'"; 
		}
		$this->pageData('orderinfo',$where, $whereEx);
		$this->display('order/index.php');
	}
	
	/**
	 * 销售人员提交客户订单
	 */
	public function getCreate(){
		$id =$_GET['id'];
		$goodDb = new DB('good');
		$this->goods = $goodDb->orderDesc("id")->get();
		$order = null;
		if(empty($id)){
			//创建订单
			$customerId = $_GET['customerId'];
			if(empty($customerId) ){
				$this->history('请选择客户');
			}
			$customerDb = new DB('customer');
			$customer = $customerDb->find(array('id'=>$customerId));
			$order['customerId'] = $customerId;
			$order['customerAccount'] = $customer['account'];
			$order['UserPhone'] =  $customer['mobile'];
			$this->title = "添加";	
		}else{
			$orderDb = new DB('vieworder');
			$order = $orderDb->find(array('id'=>$id));
			$this->title = "核实";
		}
		$this->order = $order;
		$this->display('order/create.php');
	}
	
	/**
	 * 提交待确认的新订单
	 */
	public function postCreate(){
		$id = $_POST['id'];
		$_POST['creater'] = $this->globalsStaff['account'];
		$_POST['Status'] =1;
		$_POST['userid'] = $this->globalsStaff['id'];
		$_POST['mobile'] = $_POST['UserPhone'];
		$order = array(
			'creater'=>$this->globalsStaff['account'],
			'userid'=>$this->globalsStaff['id'],
			'UserPhone'=>$_POST['UserPhone'],
			'OrderAmount'=>intval($_POST['OrderAmount']),
			'goodNum'=>$_POST['goodNum'],
			'customerId'=>$_POST['customerId'],
			'goodName'=>$_POST['goodName'],
			'goodPrice'=>$_POST['goodPrice'],
			'goodMemo'=>$_POST['goodMemo'],
			'createDate'=>date('Y-m-d H:i:s'),
			'OrderKeywords'=>$_POST['OrderKeywords']
		);
		
		$post = array(
			'user'=>$_POST['user'],
			'name'=>"顺丰",
			'address'=>$_POST['address'],
			'mobile'=>$_POST['mobile'],
			'orderId'=>$orderId,
			'province'=>$_POST['province'],
			'city'=>$_POST['city'],
			'county'=>$_POST['county'],
			'weight'=>1
		);
		$postDb = new DB('post');
		$orderDb = new DB('orderinfo');
		if(empty($id)){
			unset($_POST['id']);
			$order['Status'] = 1;
			$order['customerAccount'] = $_POST['customerAccount'];
			$orderId = $orderDb->create($order);
			$post['transMessageId'] =date('YmdHis').mt_rand(10000, 90000)."00000";
			$post['orderId'] = $orderId;
			$postDb->create($post);
			$customerDb = new DB('customer');
			$customerDb->update(array('id'=>$_POST['customerId']), array('state'=>2));
		}else{
			$orderDb->update(array('Id'=>$id), $order);
			$posts = $postDb->find(array('orderId'=>$id));
			$postDb->update(array('id'=> $post['id']), $posts);
		}
		$this->history('处理订单数据成功');
	}
	
	
	/**
	 * 顺丰下单
	 */
	private function submitSF($orderId){
		$viewDb = new DB('vieworder');
		$configDb = new DB('config');
		$tokenDb = new DB('token');
		$token = $tokenDb->find(array('id'=>1));
		$config = $configDb->find(array('id'=>1));
		$order = $viewDb->find(array('Id'=>$orderId, 'Status'=>2));
		$body = array(
			'orderId'=>$order['Id'],
			'expressType'=> 1 ,//标准快递
			'payMethod'=>1, //1:寄方付
			'custId'=>$config['sfcustId'],
			'consigneeInfo'=>array(
				'company' => $order['user'],
				'contact'=>$order['user'],
				'tel'=> $order['mobile'],
				'province'=>$order['province'],
				'city'=>$order['city'],
				'county'=>$order['county'],
				'address' => $order['address'],
			),
			'cargoInfo'=>array(
				'cargo'=>$order['goodName']
			)
		);
		$sfappid =  trim($config['sfid']);
		$sfjson = $this->sfFromat(200, $body);
		$url = "{$config['sfurl']}/rest/v1.0/order/access_token/{$token['token']}/sf_appid/{$sfappid}/sf_appkey/{$config['sfkey']}";
		$result = http::sendJson($url, $sfjson); 
		$result = substr($result, strpos($result, "{"));
		$returnArr = json_decode(trim($result),TRUE);
		return $returnArr;
	}
		
	/**
	 * 异步回调
	 */
	public function postNotify(){
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		file_put_contents(getcwd()."/l.log","回调用数据：".$postStr ,FILE_APPEND);
		$postArr = json_decode($postStr, TRUE);
		
		if($postArr['head']['code'] == "EX_CODE_OPENAPI_0200"){
				$orderId = $postArr['body']["orderId"];
				$postNo = $postArr['body']['mailNo'];
				//更新状态
				$orderDb = new DB('orderinfo');
				$postDb = new DB('post');
				$postDb->update(array('orderId'=>$orderId), array('no'=>$postNo));
				$orderDb->update(array('Id'=>$orderId), array('Status'=>4));
			}
		$retrunJson = $this->sfFromat(4201, array('orderId'=>$orderId));
		exit($retrunJson);
	}
	
	//主动查询
	public function getSearchPost(){
		$configDb = new DB('config');
		$config = $configDb->find(array('id'=>1));
		$sfappid =  trim($config['sfid']);
		$tokenDb = new DB('token');
		$token = $tokenDb->find(array('id'=>1));
		$body = array("orderId" =>$_GET['id']);
		$sfjson = $this->sfFromat(203, $body);
		$url = "{$config['sfurl']}/rest/v1.0/order/query/access_token/{$token['token']}/sf_appid/{$sfappid}/sf_appkey/{$config['sfkey']}";
		$result = http::sendJson($url, $sfjson); 
		$result = substr($result, strpos($result, "{"));
		$postArr = json_decode($result, TRUE);
		if($postArr['head']['code'] == "EX_CODE_OPENAPI_0200"){
				$orderId = $postArr['body']["orderId"];
				$postNo = $postArr['body']['mailNo'];
				//更新状态
				$orderDb = new DB('orderinfo');
				$postDb = new DB('post');
				$postDb->update(array('orderId'=>$orderId), array('no'=>$postNo));
				$orderDb->update(array('Id'=>$orderId), array('Status'=>4));
				$this->jsonView(0, "快递收单");
		}else{
			$this->jsonView(11,  $postArr['body']['message']);
		}
	}
	
	
	/**
	 * 查询顺丰单号快递
	 */
	public function getRoute(){
		$orderId = $_GET['id'];
		$orderDb = new DB('vieworder');
		$order = $orderDb->find(array('Id'=>$orderId, 'Status'=>6));
		$returnArr = null;
		if(!$order){
			$this->postNo = "暂无";
			$returnArr['head']= array('message'=> "此状态订单还没发货，物流不能查询");
			$returnArr['body'] = array();
		}else{
			$this->postNo = $order['no'];	
			$configDb = new DB('config');
			$tokenDb = new DB('token');
			$token = $tokenDb->find(array('id'=>1));
			$config = $configDb->find(array('id'=>1));
			$url = "{$config['sfurl']}/rest/v1.0/route/query/access_token/{$token['token']}/sf_appid/{$config['sfid']}/sf_appkey/{$config['sfkey']}";
			$body = array(
				"trackingType "=> "2" ,
	 			"trackingNumber "=> "201501061506026278678669",
	 			"methodType "=> "1"
			);
			$sfjson = $this->sfFromat("501", $body);
			$result = http::sendJson($url, $sfjson); 
			$result = substr($result, strpos($result, "{"));
			$returnArr = json_decode($result,TRUE);
			if(!$returnArr['body']){
				$returnArr['body'] = array();
			}
		}
		$this->route = $returnArr;
		$this->display('order/sf.php');
	}
	
	
	/**
	 * 修改订单状态
	 */
	public function getUpdateState(){
		$id = $_GET['id'];
		$state = $_GET['state'];
		$orderDb = new DB('orderinfo');
		$order = $orderDb->find(array('id'=>$id));
		if(!$order){
			$this->jsonView(10, "订单信息不存在");
		}
		//'新订单','已核实','快递下单中','快递下单','打印中','已发货','已收款', '订单完成','订单取消','拒收' ),
		switch ($state) {
			case 2: //核实订单
				break;
			case 3: //快递下单中
				{
					$returnArr = $this->submitSF($id);
					if($returnArr['head']['code'] != "EX_CODE_OPENAPI_0200"){
						$this->jsonView(12, '顺丰快递下单失败 原因'.$returnArr['head']['message']);
					}
					break;
				}
			case 5: //打印中
				{
					$queueDb = new DB('queue');
					$queueDb->create(array(
						'retionName'=>'orderinfo',
						'retionId'=>$id,
						'state'=>0,
						'created'=>date('Y-m-d H:i:s')
					));
					break;
				}
			case 9: //取消订
				break;
		}
		$orderDb->update(array('id'=>$id), array('Status'=>$state));
		$this->jsonView(0, "处理成功");	
	}
	
	/**
	 * 设置快递
	 */
	public function getCreatePost(){
		$id = $_GET['id'];
		$postDb = new DB('post');
		$this->post = $postDb->find(array('orderId'=>$id));
		$this->display('order/post.php');
	}
	
	/**
	 * 提交设置快递信息
	 */
	public function postCreatePost(){
		$postDb = new DB('post');
		$orderDb = new DB("orderinfo");
		$id = $_POST['id'];
		$postDb->update(array('id'=>$id), $_POST);
		$orderDb->update(array('id'=>$_POST['orderId']), array('Status'=>4));
		$this->history('设置成功');
	}
	
	/*
	 * 挂机拉走快递信息
	 */
	public function getPost(){
		$queueDb = new DB('queue');
		$queue = $queueDb->findAll(array('state'=>0),'id desc', '*', 100);
		$retionIds = "0";
		foreach($queue as $v){
			$retionIds.= ",".$v['retionId'];
		}
		$viewDb = new DB('vieworder');
		$vieworders = $viewDb->query("select * from vieworder where id in({$retionIds})");
		$queueDb->execute("update queue set state = 1 where retionId in({$retionIds}) ");
		exit(json_encode($vieworders,JSON_UNESCAPED_UNICODE));
	}
	
	/**
	 * 挂机会写
	 */
	public function getBack(){
		$orderId = $_GET['orderid'];
		$queueDb = new DB('queue');
		$orderDb = new DB('orderinfo');
		$queueDb->delete(array('retionId'=>$orderId));
		$orderDb->update(array('Id'=>$orderId) ,array('Status'=>6));
		exit("反馈平台数据{$orderId} 运单号{$postNo} 成功");
	}
	
	/***
	 * 获取token
	 */
	public function postToken(){
		$tokenDb  = new DB('token');
		$tokenDb->update(array('id'=>1), $_POST);	
		print_r($_POST);
	}
}
?>