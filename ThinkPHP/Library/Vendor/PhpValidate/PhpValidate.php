<?php
	class Validate{
		//post,get方式
		public $method = null;
		
		public function __construct($method = 'POST'){
			if(!in_array($method, array('POST','GET'))){
				$method = false;
			}
			$this -> method = $method;
		}
		
		private function buildName($name = null){
			if($name == null){return false;}
			if($this -> method == 'POST'){
				return $_POST[$name];
			}else{
				return $_GET[$name];
			}
		}
		
		private function rules($rule){
			//返回正则表达式
			$exp = '';
			switch ($rule){
				case 'mobile':
					$exp = '/^1[34578]{1}[0-9]{9}$/';
					break;
					
				case 'email':
					$exp = '/([a-z0-9]*[-_\.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?/i';
					break;
					
				case 'url':
					$exp = '#(http|https|ftp|ftps)://([w-]+.)+[w-]+(/[w-./?%&=]*)?#i';
					break;
					
				case 'chinese':
					$exp = '/^[x{4e00}-x{9fa5}]+$/u';//utf-8格式下的
					break;
			}
			return $exp;
		}
		/*验证主操作
		 * @param $name,GET或者POST到的名称，$rules规则参数,$attr附加参数（只有在match的时候才用到）
		 * @return 正确时返回$_POST[$name]或者$_GET[$name]，错误时返回false
		 * 注意，$rule参数以英文逗号分隔，支持的有required,number,match,lenth(n~),range(m~n),mobile,email,url,chinese
		 * */
		public function validate($name,$rule,$attr = null){
			$names = $this -> buildName($name);
			$rules = explode(',', $rule);
			$result = true;
			foreach($rules as $valus){
				if($valus == 'required'){
					if(!$result){break;}
					$result = isset($names) ? $names : false;
				}else if($valus == 'number'){
					if(!$result){break;}
					$result = is_numeric($names) ? $names : false;
				}else if($valus == 'match'){
					if(!$result){break;}
					$result = ($names === $this->buildName($attr)) ? $names : false;
				}else if(substr($valus,0,4) == 'leng'){//length-字符长度
					if(!$result){break;}
					$rule = str_replace('length(','',$valus);
					$rule = str_replace(')','',$rule);
					$rule = explode('~', $rule);//将字符串通过~打成数组
					if($rule[0] == ''){
						$result = (strlen($names) <= $rule[1]) ? $names : false;
					}else if($rule[1] == ''){
						$result = (strlen($names) >= $rule[0]) ? $names : false;
					}else{
						$result = (strlen($names) >= $rule[0] && strlen($names) <= $rule[1]) ? $names : false;
					}
				}else if(substr($valus,0,4) == 'rang'){//range-数值范围
					if(!$result){break;}
					$rule = str_replace('range(','',$valus);
					$rule = str_replace(')','',$rule);
					$rule = explode('~', $rule);//将字符串通过~打成数组
					if($rule[0] == ''){
						$result = ($names <= $rule[1]) ? $names : false;
					}else if($rule[1] == ''){
						$result = ($names >= $rule[0]) ? $names : false;
					}else{
						$result = ($names >= $rule[0] && strlen($names) <= $rule[1]) ? $names : false;
					}
				}else{
					if(!$result){break;}
					$result = preg_match($this->rules($valus),$names) ? $names : false;
				}
			}
			return $result;
		}
		
	}
?>