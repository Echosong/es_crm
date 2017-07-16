<?php

class MainController extends BaseController{
    /**
    * 登陆显示页面
    **/
    function getLogin(){
        $this->display('login.php');
    }

	/**
	 * 员工管理
	 */
	public function getStaff(){
		$page = $_GET['page']? $_GET['page']:1;
		$roleDb = new DB('role');
		$this->roles = $roleDb->findAll();
		$whereArr = array('name'=>'s','qq'=>'s', 'roleId'=>'i', 'state'=>'i', 'wx'=>'s', 'mobile'=>'s') ;
		$where = $this->requstWhere($whereArr);
        $staff = new DB('staff');
        $staffs = $staff->where($where)
             ->orderDesc('id')
             ->get(array($page,30));
      	foreach ($staffs as $key => $value) {
      		$role = $roleDb->find(array('id'=>$value['roleId']));
			$staffs[$key]['role'] = $role['name'];
      	}
        $this->staffs = $staffs;
        $this->page = $this->pager($staff->page) ;
        $this->display('admin/list.php');
	}
	
	
	/**
	 * 角色管理
	 */
	public function getRole(){
		$roleDb = new DB('role');	
		$this->roles = $roleDb->findAll();
		$this->display('admin/role.php');
	}
	
	/**
	 * 显示修改
	 */
	public function getEditRole(){
		$this->display('admin/roleEdit.php');
		
	}
	
	/**
	 * 修改信息
	 */
	public function postRole(){
		
		
	}
	
	public function getPower(){
		$this->display('admin/power.php');
		
	}
	

   /**
    * 登陆处理页面
    **/
    function postLogin(){
        $username = $_POST['username'];
        $password = $_POST['passwords'];
        if(strlen($username)<3 || strlen($password)<3 ){
            $this->history('账号密码不能为空');
        }
        $staffDB = new DB('staff');
        $staff = $staffDB ->find(array('account'=>$username));
		$this->globalsStaff['account'] = $username;
		$this->writeLog("用户{$username}登录");				  
        if(!isset($staff))
        {
            $this->history('管理员不存在!');
        }else{
            if(md5($staff['password'] .$_SESSION['admin_code'])!= $password){
                $this->history("密码错误{$admin['password']} ==> {$_SESSION['admin_code']}");    
            }else{
                $_SESSION['admin'] = $staff;
			
                $this->success('', url('main', 'index'));
            }
        }
    }
	
   
    /**
     * 生成验证码
     */
    function actionCode(){
        $str="0123456789abcdefghijklmnopqrstuvwxyz";
        $len=strlen($str)-1;
        $s="";
        for($i=0;$i<8; $i++)
        {
            $s.=$str[rand(0,$len)];
        };
        $_SESSION["admin_code"]=$s;
        echo $s;
    }
    
  /**
   * 展示配置
   */
    public function actionConfig(){
      $site = new DB('config');
	  $this->config = $site->firstOrFail(1);
      $this->display('admin/config.php');
    }


	/**
	 * dsfdsf
	 */
	private function Statistics($type){
		$fundDb = new DB('fund');
		$fundCount = $fundDb->query('select sum(fund_amout) as M from mo_fund where fund_type='.$type);
		return $fundCount[0]['M'];
	}
	
    
    /**
     * 更新配置
     */
    public function postConfig(){
        unset($_POST['id']);
        $site = new DB('config');
        $id = $site->update(array('id'=>1), $_POST);
        $this->history("修改成功");
    }
    
    

    /**
     * 加载首页
     */
    function getIndex(){
        $this->layout = "";
        $this->display('index.php');
    }
    
    /**
     * 文件上共页面
     */
    public function actionUpload(){
        if($_FILES['pic']){
            $type = $_POST['types'];
            exit($type);
            $uploadFile = new FileUpload;
            if($uploadFile->upload('pic')){
                
            }
            dump( $uploadFile->getErrorMsg());
        }else{
            $this->display('upload.php');
        } 
    }
	
	
	public function getLogout(){
		$this->writeLog('登出');
		session_unset($_SESSION['admin']);
		$this->success("", url("main", "login"));
	}

	/**
	 * 系统操作日志
	 */
	public function getLog(){
		$where = " 1= 1";
		$staffDb = new DB('staff');
		if(!empty($_GET['log_name'])){
			$where .= " AND log_name='{$_GET['log_name']}'";
		}
		if(!empty($_GET['title'])){
			$where .= " AND log_title like '%{$_GET['title']}%'";
		}
		$this->pageData('log', $where);
        $this->display('admin/log.php');
	}
    
   
}


?>
