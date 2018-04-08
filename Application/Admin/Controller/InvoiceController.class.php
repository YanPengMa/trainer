<?php
namespace Admin\Controller;
use Think\Controller;
class InvoiceController extends CheckController {
	public function index(){
		header("Content-type:text/html;charset=utf-8");
		$invoice = M('Invoice');
		$invoicestatus = I('get.invoicestatus',1);
		if(!in_array($invoicestatus,array('0','1','all'))){$this ->error('参数错误！');}
		$condition = ($invoicestatus == 'all') ? "" : "status=".$invoicestatus; //判断$condition如果是all，则条件为空，0或1条件为status=0或1
		$this -> data = $invoice ->where($condition) -> select();
		$this -> display();
	}
	public function unsetInvoice(){
		header("Content-type:text/html;charset=utf-8");
		vendor('PhpValidate/PhpValidate');
		$validate = new \Validate();
		$id = $validate -> validate('id','required,number');
		if($id){
			$data['ID'] = $id;
			$data['time'] = date('Y-m-d H:i:s');
			$data['ip'] = get_client_ip();
			$data['status'] = 0;
			$invoice = M('Invoice');
			$invoice -> save($data);
			if($invoice){
				$this -> ajaxReturn(array('error'=>0,'msg'=>'删除成功'));
				exit;
			}
		}
		$this -> ajaxReturn(array('error'=>1,'msg'=>'删除失败'));
	}
	public function recoverInvoice(){
		vendor('PhpValidate/PhpValidate');
		$validate = new \Validate();
		$id = $validate -> validate('id','required,number');
		if($id){
			$data['ID'] = $id;
			$data['time'] = date('Y-m-d H:i:s');
			$data['ip'] = get_client_ip();
			$data['status'] = 1;
			$invoice = M('Invoice');
			$invoice -> save($data);
			if($invoice){
				$this -> ajaxReturn(array('error'=>0,'msg'=>'删除成功'));
				exit;
			}
		}
		$this -> ajaxReturn(array('error'=>1,'msg'=>'删除失败'));
	}
	public function chartSession(){
		layout(false);
		if(IS_POST){
			vendor('PhpValidate.PhpValidate');
			$validate = new \Validate();
	        $chartData = $validate -> validate('chartData','required');
	        session('chart',$chartData);
	        $exporturl = U('exportinvoice');
	        $this -> ajaxReturn(array('error'=>0,'exporturl'=>$exporturl));
		}else{
	        $this -> ajaxReturn(array('error'=>1,'msg'=>'缓存写入失败'));
		}
	}
	public function exportinvoice(){
		header("Content-type:text/html;charset=utf-8");
		layout(false);
		$data = session('chart');
		if($data){
			$data = json_decode($data,true);
			ob_end_clean();
			session('chart',null);
			exportExcel($data,'培训中心发票信息统计','5/8'); //设置H列的文本格式，第八列
		}else{
			$this -> error('资源不存在');
		}
	}
}