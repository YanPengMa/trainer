<?php
namespace Admin\Controller;
use Think\Controller;
class MealController extends CheckController {
	public function index(){
		header("Content-type:text/html;charset=utf-8");
		$year = I('get.year',null);
		$month = I('get.month',null);
		$day = I('get.day',null);
		if($year == null && $month == null && $day == null){
			$date = date('Y年m月d日').'%';
			$condition['mealTime'] = array('LIKE',$date);
		}else if(is_numeric($year)){
			$date = $year.'年'.$month.'月'.$day.'日%';
			$condition['mealTime'] = array('LIKE',$date);
		}
		$condition['status'] = 1;
		$invoice = M('Meal');
		$this -> data = $invoice ->where($condition) -> select();
		$this -> display();
	}
	public function unsetMeal(){
		vendor('PhpValidate/PhpValidate');
		$validate = new \Validate();
		$id = $validate -> validate('id','required,number');
		if($id){
			$data['ID'] = $id;
			$data['time'] = date('Y-m-d H:i:s');
			$data['ip'] = get_client_ip();
			$data['status'] = 0;
			$meal = M('Meal');
			$meal -> save($data);
			$this -> ajaxReturn(array('error'=>0,'msg'=>'删除成功'));
		}else{
			$this -> ajaxReturn(array('error'=>1,'msg'=>'删除失败'));
		}
	}
	public function chartSession(){
		layout(false);
		if(IS_POST){
			vendor('PhpValidate.PhpValidate');
			$validate = new \Validate();
	        $chartData = $validate -> validate('chartData','required');
	        session('chart',$chartData);
	        $exporturl = U('exportMeal');
	        $this -> ajaxReturn(array('error'=>0,'exporturl'=>$exporturl));
		}else{
	        $this -> ajaxReturn(array('error'=>1,'msg'=>'缓存写入失败'));
		}
	}
	public function exportMeal(){
		header("Content-type:text/html;charset=utf-8");
		layout(false);
		$data = session('chart');
		if($data){
			$data = json_decode($data,true);
			ob_end_clean();
			session('chart',null);
			exportExcel($data,'培训中心就餐信息统计表');
		}else{
			$this -> error('资源不存在');
		}
	}
	public function set(){
		$config = M('Config');
		$configSet = $config -> select();
		$data = array();
		for($i=0; $i<count($configSet); $i++){
			if( in_array($configSet[$i]['configname'], array('lunch_on','lunch_auto','dinner_on','dinner_auto','lunch_start','lunch_stop','dinner_start','dinner_stop')) ){
				$data[$configSet[$i]['configname']] = $configSet[$i]['configvalue'];
			}
		}
		$this -> config = $data;
//		var_dump($data);
//		exit;
		$this -> display();
	}
	public function test(){
		$config = M('Config');
		$configSet = $config -> select();
		$data = array();
		for($i=0; $i<count($configSet); $i++){
			if( in_array($configSet[$i]['configname'], array('lunch_on','lunch_auto','dinner_on','dinner_auto','lunch_start','lunch_stop','dinner_start','dinner_stop')) ){
				$data[$configSet[$i]['configname']] = $configSet[$i]['configvalue'];
			}
		}
		var_dump($data);
		exit;
	}
}