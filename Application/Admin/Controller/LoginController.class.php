<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
	public function index(){
		layout(false);
		$this -> display();
	}
	public function getAdmin(){
		if(IS_AJAX){
			vendor('PhpValidate.PhpValidate');
			$validate = new \Validate();
	        $nickname = $validate -> validate('nickname','required');
	        $pwd = $validate -> validate('pwd','required');
	        if($nickname && $pwd){
	        	$config = M('Config');
				$configSet = $config -> select();
				for($i=0; $i<count($configSet); $i++){
					if( in_array($configSet[$i]['configname'], array('admin_username','admin_pwd')) ){
						$data[$configSet[$i]['configname']] = $configSet[$i]['configvalue'];
					}
				}
//				$this -> ajaxReturn(array('error'=>1,'msg'=>encrypt($data['admin_pwd'], 'D')));
				if( $nickname == encrypt($data['admin_username'], 'D') && $pwd == encrypt($data['admin_pwd'], 'D')){
					cookie('admin',encrypt($nickname,'E'));
					$this -> ajaxReturn(array('error'=>0,'msg'=>'登录成功'));
				}else{
					$this -> ajaxReturn(array('error'=>1,'msg'=>'用户名密码不匹配'));
				}
			}else{
				$this -> ajaxReturn(array('error'=>1,'msg'=>'登录错误'));
			}
		}
	}
	public function unsetLogin(){
		cookie('admin',null);
		$this -> redirect('Login/index');
	}
}