<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CheckController {
	public function index(){
		header("Content-type:text/html;charset=utf-8");
		$userstatus = I('get.userstatus',1);
		if(!in_array($userstatus,array('0','1','all'))){$this ->error('参数错误！');}
		$condition = ($userstatus == 'all') ? "" : "user.status=".$userstatus; //判断$condition如果是all，则条件为空，0或1条件为status=0或1
		$user = M('User as user');
		$user = $user ->join('LEFT JOIN __CLASS__ as class on user.userclass = class.ID' ) ->field('user.*,class.ID as classid,classname') -> where($condition) -> select();
//		$this -> user = $user -> query('select user.id,openid,companyname,username,usersex,usertel,userstation,userjob,userroom,classname,class.id as classid,user.status as userstatus from __USER__ user left join __CLASS__ class on user.userClass=class.ID '.$where.' order by user.id');
		$this -> user = $user;
		$this -> display();
	}
	public function chartSession(){
		layout(false);
		if(IS_POST){
			vendor('PhpValidate.PhpValidate');
			$validate = new \Validate();
	        $chartData = $validate -> validate('chartData','required');
	        session('chart',$chartData);
	        $exporturl = U('exportuser');
	        $this -> ajaxReturn(array('error'=>0,'exporturl'=>$exporturl));
		}else{
	        $this -> ajaxReturn(array('error'=>1,'msg'=>'缓存写入失败'));
		}
	}
	public function exportuser(){
		header("Content-type:text/html;charset=utf-8");
		layout(false);
		$data = session('chart');
		if($data){
			$data = json_decode($data,true);
			ob_end_clean();
			session('chart',null);
			exportExcel($data,'培训中心报名表统计');
		}else{
			$this -> error('资源不存在');
		}
	}
	public function unsetuser(){
		vendor('PhpValidate/PhpValidate');
		$validate = new \Validate();
		$id = $validate -> validate('id','required,number');
		if($id){
			$data['ID'] = $id;
			$data['time'] = date('Y-m-d H:i:s');
			$data['ip'] = get_client_ip();
			$data['status'] = 0;
			$user = M('User');
			$user -> save($data);
			$this -> ajaxReturn(array('error'=>0,'msg'=>'删除成功'));
		}else{
			$this -> ajaxReturn(array('error'=>1,'msg'=>'删除失败'));
		}
	}
	public function recoveruser(){
		vendor('PhpValidate/PhpValidate');
		$validate = new \Validate();
		$id = $validate -> validate('id','required,number');
		if($id){
			$data['ID'] = $id;
			$data['time'] = date('Y-m-d H:i:s');
			$data['ip'] = get_client_ip();
			$data['status'] = 1;
			$user = M('User');
			$user -> save($data);
			$this -> ajaxReturn(array('error'=>0,'msg'=>'恢复成功'));
		}else{
			$this -> ajaxReturn(array('error'=>1,'msg'=>'恢复失败'));
		}
	}
	public function getClass(){
		header("Content-type:text/html;charset=utf-8");
		$class = M('Class');
		$data = $class -> field('id,classname') -> where('status=1') -> select();
//		var_dump($data);
		$url = U("Classgroup/index");
		$contentHtml = '<select name="classname" id="classname" class="form-control">';
		foreach($data as $value){
			$contentHtml .=  '<option value="'.$value['id'].'">'.$value['classname'].'</option>';
		}
		$contentHtml .= '</select><a href="'.$url.'">管理班级分组</a>';
		$this -> ajaxReturn($contentHtml);
	}
	public function fixClass(){
		if(IS_AJAX){
			vendor('PhpValidate/PhpValidate');
			$validate = new \Validate();
			$id = $validate -> validate('id','required,number');
			$index = $validate -> validate('selectClassIndex','required,number');
			if($id && $index){
				$data['ID'] = $id;
				$data['time'] = date('Y-m-d H:i:s');
				$data['ip'] = get_client_ip();
				$data['userClass'] = $index;
				$user = M('User');
				$user -> save($data);
				$this -> ajaxReturn(array('error'=>0,'msg'=>'修改成功'));
			}else{
				$this -> ajaxReturn(array('error'=>1,'msg'=>'修改失败'));
			}
		}
	}
	
//	public function fix(){
//		if(IS_AJAX){
//			vendor('PhpValidate/PhpValidate');
//			$validate = new \Validate();
//			$data = $validate -> validate('data','required');
//			if($data){
//				$data = json_decode($data,true);
//				vendor('PhpFormBuilder/PhpFormBuilder');
//				$form = new \FormBuilder();
//				$form -> set_att('action',U('fixuser'));
//				$form -> add_put('',array(
//					
//				),'');
//			}
//		}
//	}
//	public function fixuser(){
//		
//	}
	
	public function fixpwd(){
		header("Content-type:text/html;charset=utf-8");
    	Vendor('PhpFormBuilder.PhpFormBuilder');
		$form = new \FormBuilder();
		$form -> set_att('action',U('Index/subpwd'));
		$form -> add_input('旧密码',array(
			'type' => 'password',
			'placeholder' => '请输入旧密码',
			'data-rule' => 'required,password'
		),'oldpwd');
		$form -> add_input('新密码',array(
			'type' => 'password',
			'placeholder' => '请输入新密码',
			'data-rule' => 'required,password'
		),'newpwd');
		$form -> add_input('确认密码',array(
			'type' => 'password',
			'placeholder' => '请再次输入新密码',
			'data-rule' => 'required,match(newpwd)'
		),'renewpwd');
		$form -> add_input('',array(
			'type' => 'submit',
			'value' => '提交',
			'class' => 'btn btn-primary'
		),'submit');
		$this -> formBulid = $form -> build_form(); 
		$this -> display();
	}
	public function subpwd(){
		vendor('PhpValidate/PhpValidate');
		$validate = new \Validate();
		$oldpwd = $validate -> validate('oldpwd','required');
		$newpwd = $validate -> validate('newpwd','required');
		$renewpwd = $validate -> validate('renewpwd','required,match','newpwd');
		if($oldpwd && $newpwd && $renewpwd){
			$config = M('Config');
			$pwd = $config -> where('ConfigName="admin_pwd"') -> find();
			if($oldpwd != encrypt($pwd['configvalue'], 'D')){
				$this->error(' 旧密码输入错误 ');
				exit;
			} 
			$newpwd = encrypt($newpwd,'E');
			$id = $config ->field('id') -> where('ConfigName="admin_pwd"') -> find();
			$config -> execute("update __CONFIG__ set configvalue='".$newpwd."' where id='".$id['id']."'");
			$this->success(' 密码修改成功 ', 'index');
		}else{
			$this->error(' 密码修改失败 ');//error方法的默认跳转地址是 javascript:history.back(-1);
		}
	}
}