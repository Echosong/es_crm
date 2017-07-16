<?php
class BaseController extends Controller{
    public $tep_dir = 'admin';
    public $layout = "admin/layout.php";
	public $globalsStaff = null;
    
	function init(){
        header("Content-type: text/html; charset=utf-8");
        $powerlist = array('main_login', 'main_code', 'main_upload', "order_post","order_token",'order_notify','order_back');
        global $__controller, $__action;
        if(!in_array($__controller.'_'.$__action,  $powerlist) ){
            $this->globalsStaff = $_SESSION['admin'];
            if(!isset($_SESSION['admin'])){
                $this->success('对不起你还没登陆,无权限进入',
                                 url('main','login'));
            } 
			
        }
    }
    
     /**
     * 统一输出下分页
     */
    function pager($pageArr, $param=""){
        if($param !=''){
            $param = '&'.$param;
        }
        if(!$pageArr['all_pages']){
            return "";
        }
        $pageStr = '<div class="pagination pagination-right definewidth m10"><ul>';  
        $pageStr.= '<li class="disabled"> <a href="#">共  <span style="color: red;">'.$pageArr['total_count'].'</span> 条记录
                 '.$pageArr['total_page'].' 页 </a> </li>';
        $current = $pageArr['current_page'];
        if($current > 1){
            $pageStr.='<li ><a href="?page=1'.$param.'">首页</a></li><li ><a href="?page='.strval($curren-1).$param.'">上一页</a></li>';
        }else{
            $pageStr.='<li class="disabled"><a href="#">首页</a></li><li class="disabled"><a href="#">上一页</a></li>';
        }  
        
        foreach ($pageArr['all_pages'] as $p){
             if($p== $current){
                 $pageStr.= '<li class="current"><a href="#" style="background-color:#36c;color:#fff;">'.strval($p).'</a></li>';
             }else{
                 $pageStr.= '<li ><a href="?page='.strval($p) .$param.'">'.strval($p).'</a></li>';
             }
         }  
        if($curren < $pageArr['total_page']){
            $pageStr.='<li ><a href="?page='.strval($curren+1).$param.'">下一页</a></li><li ><a href="?page=1'.$param.'">末页</a></li>';
        }else{
            $pageStr.='<li class="disabled"><a href="#">下一页</a></li><li class="disabled"><a href="#">末页</a></li>';
        }     
        $pageStr.= "</ul></div>"; 
        
        return $pageStr;
      
    }


    /**
    *获取客户端真实IP
    */
     function getip() {  
        $unknown = 'unknown';  
        if ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown) ) {  
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
        } elseif ( isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown) ) {  
            $ip = $_SERVER['REMOTE_ADDR'];  
        }  
        return $ip;
    }    
	 
	/**
	 * 查询条件简单配置
	 */
	function  requstWhere($where){
		$returnStr = " 1=1 ";
		if(!is_array($where)){return $returnStr;}
		
		foreach ($where as $key => $value) {
			if(empty($_REQUEST[$key])){
				continue;
			}
			switch ($value) {
				case 'i':
					$returnStr .= " AND {$key}={$_REQUEST[$key]}";
					break;
				case 's':
					$returnStr .= " AND {$key}='{$_REQUEST[$key]}'";
					break;
			}
		}
		return $returnStr;
	}


 	/**
	 * 写日志
	 */
	public function writeLog( $logTitle){
		$logDb = new  DB('log');
		$logDb->create(array(  'log_title'=>$logTitle,
		   					   'log_type'=>0,
		   					   'log_ip'=>$this->getip(),
		   					   'log_name'=>$this->globalsStaff['account'],
		   					   'log_date'=>date('Y-m-d H:i:s'),
		   					   'log_memo'=> serialize($_REQUEST),
							)
						);
	}
	
	
	/**
	 * 分页数据获取
	 */
	protected function pageData($dbName, $whereArr = "1=1", $whereEx=""){
		$page = $_GET['page']? $_GET['page']:1;
		$pageDb = new DB($dbName);
		if(is_array($whereArr)){
			$where = $this->requstWhere($whereArr);
		}else{
			$where = $whereArr;
		}
		$where .= $whereEx;
        $this->datas = $pageDb->findAll($where, 'id desc');
        $this->page = $this->pager($staff->page) ;
	}
	
	/**
	 * 统一json打印
	 */
	protected function jsonView($code, $message){
		return exit(json_encode(array('code'=>$code, 'message'=>$message)));
	}
	
	/**
	 * 顺丰数据格式
	 */
	protected function sfFromat($transType, $body){
		$sfData =  array(
			"head"=>array(
				"transType"=> $transType,
				'transMessageId'=>date('Ymd').strval(rand(100000, 999999)) ."0000"
			),
			"body"=>$body
		);	
		return json_encode($sfData, JSON_UNESCAPED_UNICODE);
	}
	

} 