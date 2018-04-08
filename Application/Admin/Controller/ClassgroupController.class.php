<?php
namespace Admin\Controller;
use Think\Controller;
class ClassgroupController extends CheckController {
	public function index(){
		header("Content-type:text/html;charset=utf-8");
		$class = M('Class');
		$condition['status']  = array('neq',0);
		$data = $class ->where($condition) -> select();
		for($i=0; $i<count($data); $i++){
			if($data[$i]['status'] == 0){
				$data[$i]['status'] = '已删除';
			}elseif($data[$i]['status'] == 2){
				$data[$i]['status'] = '被禁用';
			}else{
				$data[$i]['status'] = '正常';
			}
		}
//		var_dump($data);
//		exit;
		$this -> class = $data;
		$this -> display();
	}
	public function fix(){
		if(IS_AJAX){
			Vendor('PhpValidate.PhpValidate');
			$validate = new \Validate();
			$resetname = $validate -> validate('resetname','required');
			$id = $validate -> validate('id','required,number');
			if($resetname && $id){
				$data['ID'] = $id;
				$data['className'] = $resetname;
				$data['time'] = date('Y-m-d H:i:s');
				$data['ip'] = get_client_ip();
				$class = M('Class');
				$class -> save($data);
				$this -> ajaxReturn(array('error'=>0,'msg'=>'修改成功'));
			}else{
				$this -> ajaxReturn(array('error'=>1,'msg'=>'修改失败'));
			}
		}
	}
	public function unsetclass(){
		if(IS_AJAX){
			Vendor('PhpValidate.PhpValidate');
			$validate = new \Validate();
			$id = $validate -> validate('id','required,number');
			if($id){
				$data['ID'] = $id;
				$data['time'] = date('Y-m-d H:i:s');
				$data['ip'] = get_client_ip();
				$data['status'] = 0;
				$class = M('Class');
				$class -> save($data);
				$this -> ajaxReturn(array('error'=>0,'msg'=>'删除成功'));
			}else{
				$this -> ajaxReturn(array('error'=>1,'msg'=>'删除失败'));
			}
		}
	}
	public function add(){
		if(IS_AJAX){
			Vendor('PhpValidate.PhpValidate');
			$validate = new \Validate();
			$classname = $validate -> validate('classname','required');
			if($classname){
				$data['className'] = $classname;
				$data['time'] = date('Y-m-d H:i:s');
				$data['ip'] = get_client_ip();
				$class = M('Class');
				$class -> data($data) -> add();
				$this -> ajaxReturn(array('error'=>0,'msg'=>'添加成功'));
			}else{
				$this -> ajaxReturn(array('error'=>1,'msg'=>'添加失败'));
			}
		}
	}
}