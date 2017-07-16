<?php 
class NewController extends BaseController{
    
    public function actionList(){
        
        $page = $_GET['page']? $_GET['page']:1;
        $name = $_GET['name'];
        $where = '1=1';
        if($name){
            $where .= " and n_name like '%{$name}%'";
        }
        $news = new DB('news');
        $news = $news->where($where)
             ->orderDesc('id')
             ->get(array($page));
		foreach($news as $k=>$v){
			$carDb = new DB('class');
			$car = $carDb->find(array('id'=>$v['n_type']));
			$news[$k]['n_type'] = $car['class_name'];
		}
		$this->news = $news;
        $this->page = $this->pager($news->page) ;
        $this->display('finance/news.php');
    }
    
     public function actionSoft(){
        
        $page = $_GET['page']? $_GET['page']:1;
        $name = $_GET['name'];
        $where = '1=1';
        if($name){
            $where .= " and name like '%{$name}%'";
        }
        $soft = new DB('soft');
        $this->softs = $soft->where($where)
             ->orderDesc('id')
             ->get(array($page));
        $this->page = $this->pager($soft->page) ;
        $this->display('finance/soft.php');
    }
     
    
    /**
     * 添加修改文章
     */
    public function getEdit(){
        $id = $_GET['id'];
        $new = new DB('news');
		$carDb = new DB('class');
		$this->pclass = $carDb->findAll('class_type<>0');
        $this->new = $new ->firstOrFail($id);
        $this->display('finance/edit.php');
    }
    
    /**
     * 处理新闻
     */
    public function postEdit(){
        $new = new DB('news');
		if($_FILES['pic']){
            $uploadFile = new FileUpload;
            if($uploadFile->upload('pic')){
                $_POST['n_img'] = $uploadFile->getFileName();
                if(!strpos($_POST['n_img'],'uploads')){
                    $_POST['n_img'] = '/i/uploads/'.$_POST['n_img'];
                }
            }
        }
        $new->addOrEdit($_POST);
        $this->success('数据处理成功',url('new','list'));
    }
    /**
     * 删除文章
     */
    public function getDelete(){
        $new = new DB('news');
        $new->delete(array('id'=>$_GET['id']));
        $this->history('文章信息删除成功!');
    }
    
    /**
     * 删除软件
     */
    public function getDeleteSoft(){
        $new = new DB('soft');
        $new->delete(array('id'=>$_GET['id']));
        $this->history('软件信息删除成功!');
    }
    
    /**
     * 添加修改文章
     */
    public function getEditSoft(){
        $id = $_GET['id'];
        
        $softM = new Model('soft');
        $this->soft =( $softM->find(array('id'=>$id)));
        $this->display('finance/editSoft.php');
    }
    
    /**
     * 处理软件
     */
    public function postEditSoft(){
        $soft = new DB('soft');
        if($_FILES['pic']){
            $uploadFile = new FileUpload;
            if($uploadFile->upload('pic')){
                $_POST['img'] = $uploadFile->getFileName();
                if(!strpos($_POST['img'],'uploads')){
                    $_POST['img'] = '/i/uploads/'.$_POST['img'];
                }
            }
        }
        $soft->addOrEdit($_POST);
        $this->history('数据处理成功');
    }
    
	/**
	 * 消息列表
	 */
	public function getMessageList(){
		$messageDb = new DB('message');
		$userDb = new DB('user');
		$page = $_GET['page']? $_GET['page']:1;
        $type = $_GET['type'];
		$u_account = $_GET['account'];
        $where = '1=1';
        if($name){
			$user = $userDb->find(array('u_account'=>$u_account));
            $where .= " and m_mid like '{$user['id']}'";
        }
        $message = $messageDb->where($where)
             ->orderDesc('id')
             ->get(array($page,30));
		foreach($message as $k=>$v){
			$tuser =  $userDb->firstOrFail($v['m_uid']);
			if(!$tuser){
				$message[$k]['m_uid'] = '全部';
			}else{
				$message[$k]['m_uid'] = $tuser['u_account'];
			}
			$fuser =  $userDb->firstOrFail($v['m_mid']);
			if(!$fuser){
				$message[$k]['m_mid'] = '管理员';
			}else{
				$message[$k]['m_mid'] = $fuser['u_account'];
			}
		}
		$this->message = $message;
        $this->page = $this->pager($messageDb->page) ;
		
		$this->display('message/index.php');
	}
	
	/**
	 * 收到邮件
	 */
	public function getMessage(){
		$this->display('message/message.php');
	}
	
	/**
	 * 邮件发送
	 */
	public function postMessage(){
		$m_uid = $_POST['m_uid'];
		$m_content = $_POST['m_content'];
		if(empty($m_uid)){
			$m_uid = 0;
			$type = 2;
		}else{
			$userDb = new DB('user');
			$user =  $userDb->find(array('u_account'=>$m_uid));
			$m_uid = $user['id'];
			$type = 1;
		}
		$messageDb = new DB('message');
		$messageDb->create(array('m_title'=>'管理员发送信息', 
								'm_content'=>$m_content,
								'm_type'=>$type,
								'm_uid'=>$m_uid,
								'm_mid'=>0,
								'm_time'=>date('Y-m-d H:i:s'))
						);
		$this->history('信息发送成功');
	}
	
	
	/**
	 * 报单中心
	 */
	public function getApply(){
		$applyDb = new DB('apply');
		$page = $_GET['page']? $_GET['page']:1;
		$u_account = $_GET['account'];
        $where = '1=1';
		$param = "";
        if($u_account){
            $where .= " and apply_uname like '$u_account'";
			$param = "&account=".$u_account;
        }
        $applys = $applyDb->where($where)
             ->orderDesc('id')
             ->get(array($page,30));
        $this->page = $this->pager($applyDb->page, $param) ;
		$userDb = new DB('user');
		foreach($applys as $k=>$v){
			$user = $userDb->find(array('id'=>$v['apply_uid']));
			$applys[$k]['username'] = $user['u_name'];
		}
		$this->applys = $applys;
		$this->display('message/apply.php');
	}
	
	/**
	 * 处理保单中心
	 */
	public function getSetApply(){
		$id = $_GET['id'];
		if(empty($id)){
			$this->history('参数错误');
		}
		$type = $_GET['type']==1?1:0;
		
		$applyDb = new DB('apply');
		$apply = $applyDb->find(array('id'=>$id));
		if($apply){
			$userDb = new DB('user');
			if($type==1){
				$userDb->update(array('id'=>$apply['apply_uid'] ), array('u_isStore'=>2));
				$applyDb->update(array('id'=>$id), array('apply_able'=>1));
				switch ($apply['apply_type']) {
					case 0:
						$userDb->update(array('id'=>$apply['apply_uid'] ), array('u_iscenter'=>1));
						break;
					case 1:
						$userDb->update(array('id'=>$apply['apply_uid'] ), array('u_iswealth'=>1, 'u_sendTime'=>date('Y-m-d H:i:s')));
						break;
					case 2:
						$userDb->update(array('id'=>$apply['apply_uid'] ), array('u_isagent'=>1));
						break;
				}
				
			}else{
				$userDb->update(array('id'=>$apply['apply_uid'] ), array('u_isStore'=>1));
				$applyDb->update(array('id'=>$id), array('apply_able'=>0));
					switch ($apply['apply_type']) {
					case 0:
						$userDb->update(array('id'=>$apply['apply_uid'] ), array('u_iscenter'=>0));
						break;
					case 1:
						$userDb->update(array('id'=>$apply['apply_uid'] ), array('u_iswealth'=>0));
						break;
					case 2:
						$userDb->update(array('id'=>$apply['apply_uid'] ), array('u_isagent'=>0));
						break;
				}
			}
			
		}
		if($apply['apply_type']==0){
			$this->history('处理报单中心数据成功');
		}elseif($apply['apply_type']==1){
				
			$this->history('处理财富线数据成功');
		}else{
			$this->history(' 区域代理数据成功');
		}
		
	}

	/*新闻类目*/
	public function getNewsCars(){
		$carDb = new DB('class');
		
		$where = "1=1 ";
		$this->cars = $carDb->where($where)
             ->orderDesc('id')
             ->get(array($page,40));
        $this->page = $this->pager($applyDb->page, $param) ;
		$this->display('message/newcar.php');
	}
	
	/**
	 * 修改
	 */
	public function getNewcaredit(){
		$id = $_GET['id'];
		$carDb = new DB('class');
		if($id){
			$this->car = $carDb->find(array('id'=>$id)); 
		}
		$this->pclass = $carDb->findAll(array('class_pid'=>0));
		$this->display('message/newcaredit.php');
	}
	
	
	/**
	 * 处理请求
	 */
	public function postNewcaredit(){
		if($_FILES['pic']){
            $uploadFile = new FileUpload;
            if($uploadFile->upload('pic')){
                $_POST['class_img'] = $uploadFile->getFileName();
                if(!strpos($_POST['class_img'],'uploads')){
                    $_POST['class_img'] = '/i/uploads/'.$_POST['class_img'];
                }
            }
        }
		$carDb = new DB('class');
		$id = $_POST['id'];
		unset($_POST['id']);
		if($id){//修改
			$carDb->update(array('id'=>$id), $_POST);
		}else{
			$carDb->create($_POST);
		}
		$this->success('数据处理成功', url('new','newscar'));
	}
	
	/**
	 * 删除类
	 */
	public function getNewdelete(){
		$id = $_GET['id'];
		$carDb = new DB('class');
		if($id){
			$newDb = new DB('news');
			
			$carDb->delete(array('id'=>$id));
			$newDb->delete(array('n_type'=>$id));
		}
		
		$this->history('删除成功');
	}
    
    
}
