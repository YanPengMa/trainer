<?php
namespace Admin\Controller;
use Think\Controller;
class AdviceController extends CheckController {
	public function index(){
		header('Content-type:text/html;charset=utf8');
		$user = M('User') -> field('openid') -> where('status=1') -> select();
		for($i=0;$i<count($user); $i++){
			$userOpenid[] = $user[$i]['openid'];
		}
		$invoice = M('Invoice') -> field('openid') -> where('status=1') -> select();
		for($i=0;$i<count($invoice); $i++){
			$invoiceOpenid[] = $invoice[$i]['openid'];
		}
		$advice = M('Advice') -> where('status=1') -> select();
		
		$showAdvice = array(); //可以显示的advice
		for($i=0;$i<count($advice); $i++ ){
			if(in_array($advice[$i]['openid'], $userOpenid) || in_array($advice[$i]['openid'], $invoiceOpenid)){
				$showAdvice[] = $advice[$i]; 
			}
		}
		$this -> advice = $showAdvice;
		$this -> display('Advice/index');
		
	}
	
	public function chartSession(){
		layout(false);
		if(IS_POST){
			vendor('PhpValidate.PhpValidate');
			$validate = new \Validate();
	        $chartData = $validate -> validate('chartData','required');
	        session('chart',$chartData);
	        $exporturl = U('exportadvice');
	        $this -> ajaxReturn(array('error'=>0,'exporturl'=>$exporturl));
		}else{
	        $this -> ajaxReturn(array('error'=>1,'msg'=>'缓存写入失败'));
		}
	}
	public function exportadvice(){
		header("Content-type:text/html;charset=utf-8");
		layout(false);
		$data = session('chart');
		if($data){
			$data = json_decode($data,true);
			ob_end_clean();
			session('chart',null);
			exportExcel($data,'培训中心意见建议统计'); //设置H列的文本格式，第八列
		}else{
			$this -> error('资源不存在');
		}
	}
}
