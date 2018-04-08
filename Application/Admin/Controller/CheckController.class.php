<?php
namespace Admin\Controller;
use Think\Controller;
class CheckController extends Controller {
	public function _initialize(){
		if(!cookie('admin')){
			$this -> redirect('Login/index');
			exit;
		}
	}
}