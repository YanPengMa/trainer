<?php
namespace Home\Controller;
use Think\Controller;
class OpenidController extends Controller {
//	public function index(){
	public function _initialize(){
//		if(!cookie('openid') || cookie('openid') == null ){
//			if (!isset($_GET['code'])){
//				$this_url = urlencode(get_url());
//				redirect("https://open.weixin.qq.com/connect/oauth2/authorize?appid=".C('WX_APPID')."&redirect_uri=".$this_url."&response_type=code&scope=snsapi_base&state=sports#wechat_redirect");
//				exit;
//			}else {
//				$code = $_GET['code'];
//				$url_yes = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".C('WX_APPID')."&secret=".C('WX_APPSECRET')."&code=".$code."&grant_type=authorization_code";
//				$content = file_get_contents($url_yes);
//				if(empty($content)){
//					$openid = false;
//					exit();
//				}
//				$content_json = json_decode($content,true);
//				if(empty($content_json)){
//					$openid = false;
//					exit();
//				}
//				$openid = $content_json['openid'];
//				cookie('openid',encrypt($openid, 'E'));
//			}
//		}
		//调试使用
		if(!cookie('openid')){
			$openid = 'myopenid_djjasjdjas';
			cookie('openid',encrypt($openid, 'E'));
		}
	}
	public function test(){
		var_dump(cookie('openid'));
		echo '<br>';
		$openid = cookie('openid');
		var_dump(encrypt($openid,'D'));
	}
	public function test2(){
		cookie('openid',null);
	}
}