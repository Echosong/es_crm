<?php
    
class FinanceController extends  BaseController{
    /**
     * 资金明细列表
     */
    public function getIndex(){
        $page = $_GET['page']? $_GET['page']:1;
        $name = $_GET['name'];
		$fund_type = $_GET['fund_type'];
        $where = '1=1';
        if($name){
            $where .= " and fund_title like '%{$name}%'";
        }
		if($fund_type){
			 $where .= " and fund_type = {$fund_type}";
		}
        $finance = new DB('fund');
        $finances = $finance->where($where)
             ->orderDesc('id')
             ->get(array($page,30));
			 
		foreach($finances as $k=>$v){
			$userDb = new DB('user');
			$user = $userDb->find(array('id'=>$v['fund_uid']));
			$finances[$k]['fund_uid'] = $user['u_account'];
			$finances[$k]['username'] = $user['u_name'];
		}
		$this->finances = $finances;
        $this->page = $this->pager($finance->page) ;
        $this->display('finance/index.php');  

    }
    
    public function getCash(){
        $page = $_GET['page']? $_GET['page']:1;
        $name = $_GET['name'];
		if($_GET['type']==1){
			$where = 'z_type=1';
		}else{
			$where = 'z_type=2';
		}
        if($name){
            $where .= " and h_huihao like '%{$name}%'";
        }
        $cash = new DB('addmoney');
        
        $cashs = $cash->where($where)
             ->orderDesc('id')
             ->get(array($page,30));
		foreach($cashs as $k=>$v){
			$userDb = new DB('user');
			$bankDb = new DB('bank');
			$user = $userDb->find(array('id'=>$v['h_userid']));
			$bank = $bankDb->find(array('u_id'=>$user['id']));
			$cashs[$k]['h_uaccount'] = $user['u_account'];
			$cashs[$k]['h_username'] = $user['u_name'];
			$cashs[$k]['h_bank'] = $bank['b_name'];
			$cashs[$k]['h_bankaccount'] = $bank['b_account'];
			$cashs[$k]['h_bankaddress'] = $bank['b_address'];
		}
		
		$this->cashs = $cashs;
        $this->page = $this->pager($cash->page) ;
      	if($_GET['type']==1){
      		$this->display('finance/addmoney.php');
      	}else{
      		$this->display('finance/cash.php');
      	}
        
    }
    
    public function getCashEdit(){
        $id = $_GET['id'];
        $cash = new DB('addmoney');
        $this->cash = $cash->firstOrFail($id);
        $this->display('finance/cashEdit.php');
    }
	
	public function getAddMoneyEdit(){
        $id = $_GET['id'];
        $cash = new DB('addmoney');
        $this->cash = $cash->firstOrFail($id);
        $this->display('finance/addMoneyEdit.php');
    }
    
    
    /**
     * 拒绝
     */
    public function getCashNo(){
        $id = $_GET['id'];
        $cash = new DB('addmoney');
        $cash->update(array('id'=>$id), 
            array('h_info'=>'不符合平台规则拒绝',
                    'h_huihao'=>'',
                    'h_ztai'=>2)
         );
         $this->history('申请已经被拒绝!');
    }
    
	public function postAddMoneyEdit(){
		$id = $_POST['id'];
		if(empty($id)){
			$this->history('参数错误');
		}
        $info = $_POST['info'];
        $hao = $_POST['hao'];
        $cash = new DB('addmoney');
        $cashDb = $cash->firstOrFail($id);
        if($cashDb['h_ztai']!=0){
            $this->history('状态不可变');
        }
        $cash->update(array('id'=>$id), 
            array('h_info'=>$info,
                    'h_huihao'=>$hao,
                    'h_ztai'=>1,
                    's_time'=>date('Y-m-d H:i:s'))
         );
		
		
		$user = new DB('user');
		$userDb = $user->find(array('id'=>$cashDb['h_userid']));
        //扣款
        $moneyDb = new DB('money');
		$money = $moneyDb->find(array('userid'=>$cashDb['h_userid']));

        $oldMoney = floatval($money['currency']);
        $realMoney = floatval($cashDb['h_money']);
        $afterMoney = $oldMoney+$realMoney;

        $moneyDb->update(array('userid'=>$cashDb['h_userid']), array('currency'=>$afterMoney));
        //写记录
        $log = new DB('fund');
        $log->create(array(
            'fund_title'=>"客户{$userDb['u_account']}加款成功",
            'fund_uid'=>$userDb['id'],
            'fund_time'=>date('Y-m-d h:i:s'),
            'fund_beginamout'=>$oldMoney,
            'fund_amout'=>$realMoney,
            'fund_afteramout'=>$afterMoney,
            'fund_type'=>1,
            'fund_late'=>$cashDb['h_rate'],
            'fund_memo'=>"客户{$userDb['u_account']}加款成功",
            'fund_retionid'=>$id
        ));
        $this->history('给客户加款成功'); 
	}
	
    /**
     * 提现处理
     */
    public function postCashEdit(){
        $id = $_POST['id'];
        $info = $_POST['info'];
        $hao = $_POST['hao'];
        $cash = new DB('addmoney');
        $cashDb = $cash->firstOrFail($id);
        if($cashDb['h_ztai']!=0){
            $this->history('状态不可变');
        }
        $cash->update(array('id'=>$id), 
            array('h_info'=>$info,
                    'h_huihao'=>$hao,
                    'h_ztai'=>1,
                    's_time'=>date('Y-m-d H:i:s'))
         );
		 $user = new DB('user');
		$userDb = $user->find(array('id'=>$cashDb['h_userid']));
        //扣款
        $moneyDb = new DB('money');
		$money = $moneyDb->find(array('userid'=>$cashDb['h_userid']));
        $oldMoney = floatval($money['currency']);
        $realMoney = floatval($cashDb['h_money']);
        $afterMoney = $oldMoney-$realMoney;
 
        if( $oldMoney< $realMoney ){
            $this->history('金额不足');
        }
        $moneyDb->update(array('userid'=>$cashDb['h_userid']), array('currency'=>$afterMoney));
        //写记录
        $log = new DB('fund');
        $log->create(array(
            'fund_title'=>"客户{$userDb['u_account']}提现成功",
            'fund_uid'=>$userDb['id'],
            'fund_time'=>date('Y-m-d h:i:s'),
            'fund_beginamout'=>$oldMoney,
            'fund_amout'=>$realMoney,
            'fund_afteramout'=>$afterMoney,
            'fund_type'=>2,
            'fund_late'=>$cashDb['h_rate'],
            'fund_memo'=>"客户{$userDb['u_account']}提现成功",
            'fund_retionid'=>$id
        ));
        $this->history('提现审核成功');  
    }

	/**
	 * 加款
	 */
	public function getSetMoney(){
		$id = $_GET['id'];
		if(empty($id)){
			$this->history('参数错误');
		}	
		$type = $_GET['type']|0;
		if($type==0){
			$this->value = "加款";
		}else{
			$this->value = "扣款";
		}
		$this->type = $type;
		$moneyDb = new DB('money');
		$this->money = $moneyDb->find(array('id'=>$id));
		
		$this->display('finance/setmoney.php');
	}
	
	/**
	 * 处理
	 */
	public function postSetMoney(){
		$type = $_POST['type']|0;
		$account = $_POST['account'];
		$money = $_POST['money'];
		$log = new DB('fund');
		$userDb = new DB('user');
		$user= $userDb->find(array('u_account'=>$account));
		$moneyDb = new DB('money');
		$moneyObj = $moneyDb->find(array('account'=>$account));
		if($type==0){
			//加快
			$moneyDb->update(array('account'=>$account), array('currency'=>$moneyObj['currency']+$money));
			//扣钱日志
			$log->create(
				array(
				'fund_title'=>"管理员给 {$account} 加款",
				'fund_type'=> 12,
				'fund_time'=>date('Y-m-d H:i:s'),
				'fund_beginamout'=> $moneyObj['currency'] ,
				'fund_amout'=> $money,
				'fund_afteramout'=>$moneyObj['currency']+ $money,
				'fund_uid'=>$moneyObj['userid'],
				'fund_retionid'=>$moneyObj['userid']
				)
			);
			$this->history('加款成功');
		}else{
			//扣款
			if($moneyObj['currency'] < $money){
				$this->history('金额不够不能扣除');
			}
			//扣钱日志
			$moneyDb->update(array('account'=>$account), array('currency'=>$moneyObj['currency'] -$money));
			$log->create(
				array(
				'fund_title'=>"管理员给 {$account} 扣款",
				'fund_type'=> 13,
				'fund_time'=>date('Y-m-d H:i:s'),
				'fund_beginamout'=> $moneyObj['currency'] ,
				'fund_amout'=> $money,
				'fund_afteramout'=>$moneyObj['currency']- $money,
				'fund_uid'=>$moneyObj['userid'],
				'fund_retionid'=>$moneyObj['userid']
				)
			);
			$this->history('扣款成功');
		}
	}
	
}
