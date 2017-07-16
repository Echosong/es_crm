<?php
class UserController extends  BaseController {

	public function getModify() {
		$id = $_GET['id'];
		if (empty($id)) {
			$this -> title = "添加";
		} else {
			$this -> title = "修改";
		}
		$userDb = new DB('customer');
		$this -> user = $userDb -> find(array('id' => $id));
		$this -> display('user/edit.php');
	}

	public function postModify() {
		$id = $_POST['id'];
		$userDb = new DB('customer');
		if (empty($id)) {
			unset($_POST['id']);
			$_POST['state'] = 1;
			if(empty($_POST['account'])){
				$this->history('必须输入用户账号');
			}
			$userDb -> create($_POST);
			$title = "添加";
		} else {
			$userDb -> update(array('id' => $id), $_POST);
			$title = "修改";
			$this->writeLog('修改客户_'. $id);
		}

		$this -> history('处理资料成功');
	}

	public function getSetPass() {
		$id = $_GET['id'];
		if (empty($id)) {
			$this -> history('参数错误');
		}
		$type = $_GET['type'] | 0;
		$userDb = new DB('user');
		if ($type == 0) {
			$userDb -> update(array('id' => $id), array('u_password' => md5('111111')));
			$this -> history('密码重置为 111111 成功');
		} else {
			$userDb -> update(array('id' => $id), array('u_passwords' => md5('222222')));
			$this -> history('交易密码重置为 222222 成功');
		}
	}

	/***
	 * 用户列表
	 */
	public function getList() {
		$page = $_GET['page'] ? $_GET['page'] : 1;
		$whereArr = array('name' => 's', 'qq' => 's', 'source' => 'i', 'state' => 'i', 'wx' => 's', 'mobile' => 's');
		$where = $this -> requstWhere($whereArr);
		$user = new DB('customer');
		$users = $user -> where($where) -> orderDesc('id') -> get(array($page, 30));

		$this -> users = $users;
		$this -> page = $this -> pager($user -> page);
		$this -> display('user/index.php');
	}

	/**
	 * 群查看
	 */
	public function getGroup() {
		$page = $_GET['page'] ? $_GET['page'] : 1;
		$name = $_GET['name'];
		$where = '1=1';

		if ($name) {
			$where .= " and g_name like '{$name}'";
		}
		$group = new DB('group');
		$this -> groups = $group -> where($where) -> orderDesc('id') -> get(array($page));
		$this -> page = $this -> pager($group -> page);
		$this -> display('user/group.php');
	}

	/**
	 * 删除用户
	 */
	public function getDeleteUser() {
		$id = $_GET['id'];
		if (empty($id)) {
			$this -> history('参数错误');
		} else {
			$userDb = new DB('user');
			$user = $userDb -> find(array('id' => $id));
			if ($user['u_status'] == 1) {
				$this -> history('正式会员不允许删除');
			}
			$uCount = $userDb -> findCount(array('u_parentId' => $id));
			if ($uCount != 0) {
				$this -> history('已经成为接点会员不能删除');
			}
			$userDb -> delete(array('id' => $id));
			$moneyDb = new DB('money');
			$moneyDb -> delete(array('userid' => $id));
			$bankDb = new DB('bank');
			$bankDb -> delete(array('u_id' => $id));
			$this -> history('删除成功');
		}
	}

	/**
	 * 跟踪用户
	 */
	public function getTrace(){
		$id = $_GET['id'];
		if(empty($id)){
			die("参数错误");
		}
		$traceDb = new DB('customertrack');
		$this->traces = $traceDb->findAll(array('uid'=>$id), 'id desc', '*', 20);
		$this->display('user/trace.php');
	}
	
	/**
	 * 处理跟踪记录
	 */
	public function postTrace(){
		$content = $_POST['content'];
		if(strlen($content)<6){
			$this->history('参数错误');
		}	
		$customerId = $_POST['uid'];
		$customerDb = new DB('customer');
		$customer = $customerDb->firstOrFail($customerId);
		if(!$customer){
			$this->history('客户不存在');
		}
		$traceDb = new DB('customertrack');
		$traceDb->create(array('customer'=>$customer['name'], 'uid'=>$customerId,
								 'created'=>date('Y-m-d H:i:s'),
								 'content'=> $content,
								 'staff'=>$this->globalsStaff['account']
							 )
						);
		$this->history('添加跟踪记录成功');
		
	}
	
	/**
	 * 删除用户
	 */
	public function getDelete(){
		$id = $_GET['id'];
		if(empty($id)){
			$this->history('参数错误');
		}
		$this->writeLog('删除客户_'.$id);
		$customerDb = new DB('customer');
		$customerDb->delete(array('id'=>$id));
		$this->history('删除客户成功');
	}

}
