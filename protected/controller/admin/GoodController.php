<?php 

class  GoodController extends  BaseController{
	
	/**
	 * 获取分页信息
	 */
	 function pages($tableName, $where=""){
		$page = $_GET['page']? $_GET['page']:1;
		$where = '1 = 1'.$where;
		$db = new DB($tableName);
		$this->datas = $db->where($where)
							->orderDesc("id")
							->get(array($page));
		$this->page = $this->pager($db->page) ;
	}
	/**
	 * 商品列表
	 */
	public function getIndex(){
		$where = "";
		if(isset($_GET['name'])){
			$where .= " And name like '%{$_GET['name']}%'";
		}
		$this->pages('good',$where);
		$this->display('good/index.php');
	}
	
	/**
	 * 修改上面也没
	 */
	public function getEdit(){
		$id = $_GET['id'];
		$this->editName = "添加";
		if(isset($id)){
			//修改
			$this->editName = "修改";
			$good = new DB('good');
			$this->good = $good->find(array('id'=>$id));
		}
		$this->display('good/edit.php');
	}
	
	/**
	 * 修改保存时间
	 */
	public function postEdit(){
		$id = $_POST['id'];
		$good = new DB('good');
		if($_FILES['pic']){
            $uploadFile = new FileUpload;
            if($uploadFile->upload('pic')){
                $_POST['img'] = $uploadFile->getFileName();
                if(!strpos($_POST['img'],'uploads')){
                    $_POST['img'] = '/i/uploads/'.$_POST['img'];
                }
            }
        }
		if(isset($id)){
			unset($_POST['id']);
			$good->update(array('id'=>$id), $_POST);
		}else{
			$good->create($_POST);
		}
		$this->success('数据处理成功', url('good','index'));
	}
	
	/**
	 * 删除
	 */
	public function getDel(){
		$id  = $_GET['id'];
		$good = new DB('good');
		if(isset($id)){
			$good->delete(array('id'=>$id));	
		}else{
			$this->history('编号错误');	
		}
		$this->display('删除成功');
	}
	
}
?>