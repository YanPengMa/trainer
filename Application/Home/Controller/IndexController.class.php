<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends OpenidController {
    public function index(){
		header("Content-type:text/html;charset=utf-8");
		$user = M('User');
		$result = $user -> where('openid = "'.encrypt(cookie('openid'), 'D').'" and status=1 ') -> order('ID desc') -> find();
		//提交页面
        if(I('post.formhead',null) != null){			
			foreach(I('post.') as $key => $value){
				$data[$key] = is_array($value) ? $value[0] : $value;
			}
			$data['openid'] = encrypt(cookie('openid'), 'D');
			$data['time'] = date("Y-m-d H:i:s");
			$data['ip'] = get_client_ip();
			$data['status'] = 1;
			
			if($result != null){
				$user ->data($data)-> where('openid = "'.encrypt(cookie('openid'), 'D').'" and status=1 ') -> save(); 
			}else{
				$user ->data($data) -> add();
			}
			$this -> formhead = encrypt($data['formhead'],'D');
			$this -> display('submit');
			exit;
        }
        //非提交页面
        //非第一次填写
        if($result != null){
			$result['submit'] = '修改';
			$this -> introduce = '您已提交过该信息，可在下方进行修改';
		}
		$this -> title = '培训中心报名入口';
		Vendor('PhpFormBuilder.PhpFormBuilder');
//  	$this -> introduce = '今日午晚餐的集合地点为西南石油大学正门，时间为12:00,请不要迟到！';
		$form = new \FormBuilder();
		$form -> set_att('action',U('index'));
		$form -> add_input('',array(
			'type' => 'hidden',
			'value' => encrypt($this -> title, 'E')
		),'formhead');
		$form -> add_input('单位名称',array(
			'placeholder' => '请输入您的单位名称',
			'value' => $result['companyname'],
			'data-rule' => 'required'
		),'companyName');
		$form -> add_input('姓名',array(
			'placeholder' => '请输入您的姓名',
			'value' => $result['username'],
			'data-rule' => 'required'
		),'userName');
		$form -> add_input('性别',array(
			'type' => 'select',
			'selected' => $result['usersex'],
			'options' => array(
				'male' => '男',
				'female' => '女'
			)
		),'userSex');
		$form -> add_input('手机号',array(
			'placeholder' => '请输入您的联系方式',
			'value' => $result['usertel'],
			'data-rule' => 'required,mobile'
		),'userTel');
		$form -> add_input('岗位名称',array(
			'placeholder' => '请输入您的岗位名称',
			'value' => $result['userstation'],
			'data-rule' => 'required'
		),'userStation');
		$form -> add_input('职称',array(
			'placeholder' => '请输入您的职称',
			'value' => $result['userjob'],
			'data-rule' => 'required'
		),'userJob');
		$form -> add_input('住宿房间',array(
			'type' => 'radio',
			'checked' => $result['userroom'],
			'options' => array(
				'oneself' => '我要单住',
				'notoneself' => '不单住'
			),
			'data-rule' => 'checked'
		),'userRoom');
		
		$form -> add_input('',array(
			'type' => 'submit',
			'class' => 'btn btn-primary',
			'value' => $result['submit'] ? $result['submit'] : '提交'
		),'submit');
		
		$this -> formReturn = $form -> build_form();
		$this -> display();
    }
	public function getSignup(){
		header("Content-type:text/html;charset=utf-8");
//  	var_dump(I('post.'));
		$user = M('User');
		foreach(I('post.') as $key => $value){
			$data[$key] = is_array($value) ? $value[0] : $value;
		}
		$data['openid'] = encrypt(cookie('openid'), 'D');
		$data['time'] = date("Y-m-d H:i:s");
		$data['ip'] = get_client_ip();
		$data['status'] = 1;
		$user ->data($data) -> add();
		$this -> formhead = encrypt($data['formhead'],'D');
		$this -> display('submit');
	}
	
	public function invoice(){
		header("Content-type:text/html;charset=utf-8");
		$user = M('Invoice');
		$result = $user -> where('openid = "'.encrypt(cookie('openid'), 'D').'" and status=1 ')  -> order('ID desc') -> find();
		//提交页面
        if(I('post.formhead',null) != null){
			foreach(I('post.') as $key => $value){
				$data[$key] = is_array($value) ? $value[0] : $value;
			}
			$data['openid'] = encrypt(cookie('openid'), 'D');
			$data['time'] = date("Y-m-d H:i:s");
			$data['ip'] = get_client_ip();
			$data['status'] = 1;
			
			if($result != null){
				$user ->data($data)-> where('openid = "'.encrypt(cookie('openid'), 'D').'" and status=1 ') -> save(); 
			}else{
				$user ->data($data) -> add();
			}
			$this -> formhead = encrypt($data['formhead'],'D');
			$this -> display('submit');
			exit;
        }
		//非提交页面		
		Vendor('PhpFormBuilder.PhpFormBuilder');
		$this -> introduce = '发票信息用于开取报账发票，请确认所填写的内容准确无误后再提交。<br><br>您已提交过该信息，可在下方进行修改';
		//第一次填写
		if($result == null){
			//获取用户信息
			$user = M('User');
			$result = $user -> where('openid = "'.encrypt(cookie('openid'), 'D').'" ') -> order('ID desc') -> find();
			$result['submit'] = '提交';
			$this -> introduce = '发票信息用于开取报账发票，请确认所填写的内容准确无误后再提交。';
		}
    	$this -> title = '培训发票信息统计表';
		$form = new \FormBuilder();
		$form -> set_att('action',U('invoice'));
		$form -> add_input('',array(
			'type' => 'hidden',
			'value' => encrypt($this -> title, 'E')
		),'formhead');
		$form -> add_input('姓名',array(
			'placeholder' => '请填写您的姓名',
			'value' => $result['username'],
			'data-rule' => 'required,chinese'
		),'userName');
		
		$form -> add_input('培训班名称',array(
			'placeholder' => '请输入培训班名称',
			'value' => $result['classname'],
			'data-rule' => 'required'
		),'className');
		
		$form -> add_input('发票抬头名称（即单位名称）',array(
			'placeholder' => '请填写您的发票抬头名称',
			'value' => $result['companyname'],
			'data-rule' => 'required'
		),'companyName');
		
		$form -> add_input('纳税人识别号',array(
			'placeholder' => '请填写您的纳税人识别号',
			'value' => $result['invoicenum'],
			'data-rule' => 'required'
		),'invoiceNum');
		
		$form -> add_input('地址、电话',array(
			'placeholder' => '请填写地址电话',
			'value' => $result['addrtel'],
			'data-rule' => 'required'
		),'addrTel');
		
		$form -> add_input('开户行',array(
			'placeholder' => '请填写开户行',
			'value' => $result['invoicebank'],
			'data-rule' => 'required,chinese'
		),'invoiceBank');
		
		$form -> add_input('开户账号',array(
			'placeholder' => '请填写开户账号',
			'value' => $result['banknum'],
			'data-rule' => 'required,length(10~21)'
		),'bankNum');
		
		$form -> add_input('发票类型',array(
			'type' => 'radio',
			'checked' => $result['invoicetype'],
			'options' => array(
				'zhuanpiao' => '增值税专用发票',
				'pupiao' => '增值税普通发票'
			),
			'data-rule' => 'checked'
		),'invoiceType');
		
		$form -> add_input('手机号码',array(
			'placeholder' => '请填写您的手机号码',
			'value' => $result['usertel'],
			'data-rule' => 'required,mobile'
		),'userTel');
		
		$form -> add_input('',array(
			'type' => 'submit',
			'class' => 'btn btn-primary',
			'value' => $result['submit'] ? $result['submit'] : '修改'
		),'submit');
		
		$this -> formReturn = $form -> build_form();
		$this -> display('index');
		
	}
	
	public function test(){
		header("Content-type:text/html;charset=utf-8");
//		$this -> title = '跟队午晚餐统计';
		$this -> formhead = '跟队午晚餐统计';
		$this -> error = 1;
		$this -> prompt = '提交尼玛个鬼';
		$this -> msg = '明天又他妈的要上线了沃日';
		$this -> display('submit');
	}
	
	public function meal(){
		header("Content-type:text/html;charset=utf-8");
    	Vendor('PhpFormBuilder.PhpFormBuilder');
		//获取用户信息
		$user = M('User');
		$result = $user -> where('openid = "'.encrypt(cookie('openid'), 'D').'" ') -> order('ID desc') -> find();
		//获取就餐的配置信息
		$config = M('Config');
		$configSet = $config -> select();
		for($i=0; $i<count($configSet); $i++){
			if( in_array($configSet[$i]['configname'], array('lunch_on','lunch_auto','dinner_on','dinner_auto','lunch_start','lunch_stop','dinner_start','dinner_stop')) ){
				$data[$configSet[$i]['configname']] = $configSet[$i]['configvalue'];
			}
		}
		$config = $data;
		//判定预定时间
		$meal = $this -> nowMeal($config);
		//判断是否开启午晚餐统计
		if($meal['nowMeal'] == '午餐' && $config['lunch_on'] == 0){
			$this -> title = '跟队午晚餐统计';
			$this -> formReturn = '<div class="text-center .success-icon"><h3>今日午餐统计未打开</h3></div>';
    		$this -> display('index');
    		exit;
		}else if($meal['nowMeal'] == '晚餐' && $config['dinner_on'] == 0){
			$this -> title = '跟队午晚餐统计';
			$this -> formReturn = '<div class="text-center .success-icon"><h3>今日晚餐统计未打开</h3></div>';
    		$this -> display('index');
    		exit;
		}
		//判断是否自动开启
		if($meal['nowMeal'] == '午餐' && $config['lunch_on'] == 1 && $config['lunch_auto'] == 0){
			$meal = array(
				'code' => true,
				'nowDate' => $nowDate,
				'nowMeal' => '午餐',
				'nowStatus' => '我要跟队',
				'startTime' => $lunchStart,
				'stopTime' => $lunchStop
			);
		}else if($meal['nowMeal'] == '晚餐' && $config['dinner_on'] == 1 && $config['dinner_auto'] == 0){
			$meal = array(
				'code' => true,
				'nowDate' => $nowDate,
				'nowMeal' => '晚餐',
				'nowStatus' => '我要跟队',
				'startTime' => $dinnerStart,
				'stopTime' => $dinnerStop
			);
		}
		
    	$this -> title = '跟队午晚餐统计';
    	$this -> introduce = $ceshi.'  今日午晚餐的集合地点为西南石油大学正门，时间为12:00,请不要迟到！<br><br>本次统计时间为'.$meal['startTime'].'-'.$meal['stopTime'];
		$form = new \FormBuilder();
		$form -> set_att('action',U('Index/getMeal'));
		$form -> add_input('',array(
			'type' => 'hidden',
			'value' => encrypt($this -> title, 'E')
		),'formhead');
		$form -> add_input('姓名',array(
			'placeholder' => '请输入您的姓名',
			'value' => $result['username'],
			'data-rule' => 'required'
		),'userName');
		
		$form -> add_input('联系方式',array(
			'placeholder' => '请输入您的联系方式',
			'value' => $result['usertel'],
			'data-rule' => 'required,mobile'
		),'userTel');
		
		$form -> add_input('预定时间',array(
			'value' => $meal['nowDate'].$meal['nowMeal'],
			'readonly' => true
		),'mealTime');
		
		$btnClass = $meal['code'] ? 'btn btn-primary' : 'btn';
		
		$form -> add_input('',array(
			'type' => 'submit',
			'class' => $btnClass,
			'value' => $meal['nowStatus'],
			'disabled' => !$meal['code']
		),'submit');
		$this -> formReturn = $form -> build_form();
    	$this -> display('index');
    }
    public function getMeal(){
		header("Content-type:text/html;charset=utf-8");
//  	var_dump(I('post.'));
		foreach(I('post.') as $key => $value){
			if($key == 'mealTime'){
				$data[$key] = date('Y年').$value;
			}else{
				$data[$key] = $value;
			}
		}
		$data['openid'] = encrypt(cookie('openid'), 'D');
		$data['time'] = date("Y-m-d H:i:s");
		$data['ip'] = get_client_ip();
		$data['status'] = 1;
		$meal = M('Meal');
		$meal ->data($data) -> add();
		$this -> formhead = encrypt(I('post.formhead'),'D');
		$this -> display('submit');
    }
    
	private function nowMeal($config){
		$lunchStart = $config['lunch_start'];
		$lunchStop = $config['lunch_stop'];
		$dinnerStart = $config['dinner_start'];
		$dinnerStop = $config['dinner_stop'];
		
		$nowTime = date('H:i');
		$nowDate = date('m月d日');
		$data = array();
		if(strtotime($nowTime) < strtotime($lunchStart)){
			$data = array(
				'code' => false,
				'nowDate' => $nowDate,
				'nowMeal' => '午餐',
				'nowStatus' => '未开始',
				'startTime' => $lunchStart,
				'stopTime' => $lunchStop
			);
		}else if(strtotime($nowTime) >= strtotime($lunchStart) && strtotime($nowTime) <= strtotime($lunchStop)){
			$data = array(
				'code' => true,
				'nowDate' => $nowDate,
				'nowMeal' => '午餐',
				'nowStatus' => '我要跟队',
				'startTime' => $lunchStart,
				'stopTime' => $lunchStop
			);
		}else if(strtotime($nowTime) > strtotime($lunchStop) && strtotime($nowTime) < strtotime($dinnerStart)){
			$data = array(
				'code' => false,
				'nowDate' => $nowDate,
				'nowMeal' => '晚餐',
				'nowStatus' => '未开始',
				'startTime' => $dinnerStart,
				'stopTime' => $dinnerStop
			);
		}else if(strtotime($nowTime) >= strtotime($dinnerStart) && strtotime($nowTime) <= strtotime($dinnerStop)){
			$data = array(
				'code' => true,
				'nowDate' => $nowDate,
				'nowMeal' => '晚餐',
				'nowStatus' => '我要跟队',
				'startTime' => $dinnerStart,
				'stopTime' => $dinnerStop
			);
		}else if(strtotime($nowTime) > strtotime($dinnerStop)){
			$data = array(
				'code' => false,
				'nowDate' => $nowDate,
				'nowMeal' => '晚餐',
				'nowStatus' => '已结束',
				'startTime' => $dinnerStart,
				'stopTime' => $dinnerStop
			);
		}
		return $data;
	}
	
	public function advice(){
		header("Content-type:text/html;charset=utf-8");
		//先提取User表中的姓名
		$user = M('User') -> field('username') -> where('openid = "'.encrypt(cookie('openid'), 'D').'" and status=1 ') -> order('ID desc') -> find();
		//获取invoice表中的姓名
		if($user == null){
			$invoice = M('User') -> field('username') -> where('openid = "'.encrypt(cookie('openid'), 'D').'" and status=1 ') -> order('ID desc') -> find();
		}
//		var_dump($user);
//		var_dump($invoice);
//		exit;
		//判断姓名是否都存在，不存在则表示没有提交过这两个表的信息，优先使用User表中的姓名
		if($user==null && $invoice == null){
			$this -> error = 1;
			$this -> formhead = '培训中心培训评估';
			$this -> prompt = '禁止评估';
			$this ->msg = '请先提交报名信息或者发票信息再进行评估';
			$this -> display('submit');
			exit;
		}else if($user){
			$username = $user['username'];
		}else if($invoice){
			$username = $invoice['username'];
		}
		
		$advice = M('Advice');
		$result = $advice -> where('openid = "'.encrypt(cookie('openid'), 'D').'" and status=1 ') -> order('ID desc') -> find();
		//提交页面
        if(I('post.formhead',null) != null){
			foreach(I('post.') as $key => $value){
				$data[$key] = is_array($value) ? $value[0] : $value;
			}
			$data['openid'] = encrypt(cookie('openid'), 'D');
			$data['time'] = date("Y-m-d H:i:s");
			$data['ip'] = get_client_ip();
			$data['status'] = 1;
			if($result == null){
				$advice ->data($data) -> add();
			}
			$this -> formhead = encrypt($data['formhead'],'D');
			$this -> display('submit');
			exit;
        }
        //非提交页面
		$this -> title = '培训中心培训评估';
    	$this -> introduce = '请填写您对本次培训的评价，您的评价对我们今后的改进工作有非常大的帮助。<br><br>注：评估后不可修改';
    	//已经提交过
    	if($result != null){
    		$this -> myAdvice = $result;
    		$this -> display('advice');
    		exit;
    	}
    	
    	Vendor('PhpFormBuilder.PhpFormBuilder');
		$form = new \FormBuilder();
		$form -> set_att('action',U('advice'));
		
		$form -> add_input('',array(
			'type' => 'hidden',
			'value' => encrypt($this -> title, 'E')
		),'formhead');
		$form -> add_input('',array(
			'type' => 'hidden',
			'value' => $username
		),'userName');
		$form -> add_input('1、对课程设计的评价',array(
			'type' => 'radio',
			'options' => array(
				'class4' => '非常好',
				'class3' => '好',
				'class2' => '一般',
				'class1' => '差'
			),
			'data-rule' => 'checked'
		),'adviceClass');
		$form -> add_input('2、对管理服务的评价',array(
			'type' => 'radio',
			'options' => array(
				'sevice4' => '非常好',
				'sevice3' => '好',
				'sevice2' => '一般',
				'sevice1' => '差'
			),
			'data-rule' => 'checked'
		),'adviceService');
		$form -> add_input('3、对食宿的评价',array(
			'type' => 'radio',
			'options' => array(
				'dealRoom4' => '非常好',
				'dealRoom3' => '好',
				'dealRoom2' => '一般',
				'dealRoom1' => '差'
			),
			'data-rule' => 'checked'
		),'adviceDealRoom');
		$form -> add_input('4、对教师教学的评价',array(
			'type' => 'radio',
			'options' => array(
				'teacher4' => '非常好',
				'teacher3' => '好',
				'teacher2' => '一般',
				'teacher1' => '差'
			),
			'data-rule' => 'checked'
		),'adviceTeacher');
		
		$form -> add_input('5、您的建议',array(
			'type' => 'textarea',
			'placeholder' => '请留下您的建议，选填（120字以内）',
			'data-rule' => 'length(~120)'
		),'adviceText');
		
		$form -> add_input('',array(
			'type' => 'submit',
			'class' => 'btn btn-primary',
			'value' => '提交'
		),'submit');
		
		$this -> formReturn = $form -> build_form();
		$this -> display('index');
		
	}
	
	
}