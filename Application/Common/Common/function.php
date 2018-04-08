<?php
	//加密解密类
	class KEY {
	    private $expire = 0, $key = 'secret';
	
	    public function __construct($key_str = null, $time_to_live = null) {
	        if ($key_str) {
	            self::setKey($key_str);
	        }
	        if ($time_to_live) {
	            self::setExpire($time_to_live);
	        }
	    }
	
	    public  function setExpire($time_to_live) {
	        $this->expire = floatval($time_to_live);
	    }
	
	    public  function setKey($key_str) {
	        $this->key = (string) $key_str;
	    }
	
	    public  function encode($tex, $key = null, $expire = 0) {
	        $key = $key ? $key : $this->key;
	        $expire = $expire ? $expire : $this->expire;
	        $chrArr = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
	            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
	            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
	        $tex.="~#~" . sprintf('%010d', $expire ? $expire + time() : 0) . "~#~";
	        $key_b = $chrArr[rand() % 62] . $chrArr[rand() % 62] . $chrArr[rand() % 62] . $chrArr[rand() % 62] . $chrArr[rand() % 62] . $chrArr[rand() % 62];
	        $rand_key = $key_b . $key;
	        $rand_key = md5($rand_key);
	        $texlen = strlen($tex);
	        $reslutstr = "";
	        for ($i = 0; $i < $texlen; $i++) {
	            $reslutstr.=$tex{$i} ^ $rand_key{$i % 32};
	        }
	        $reslutstr = trim($key_b . base64_encode($reslutstr), "==");
	        $reslutstr = substr(md5($reslutstr), 0, 8) . $reslutstr;
	        return $reslutstr;
	    }
	
	    public  function decode($tex, $key = null) {
	        $key = $key ? $key : $this->key;
	        if (strlen($tex) < 14)
	            return false;
	        $verity_str = substr($tex, 0, 8);
	        $tex = substr($tex, 8);
	        if ($verity_str != substr(md5($tex), 0, 8)) {
	            //完整性验证失败
	            return false;
	        }
	        $key_b = substr($tex, 0, 6);
	        $rand_key = $key_b . $key;
	        $rand_key = md5($rand_key);
	        $tex = base64_decode(substr($tex, 6));
	        $texlen = strlen($tex);
	        $reslutstr = "";
	        for ($i = 0; $i < $texlen; $i++) {
	            $reslutstr.=$tex{$i} ^ $rand_key{$i % 32};
	        }
	        $expiry_arr = array();
	        preg_match('/^(.*)~#~(\d{10})~#~$/', $reslutstr, $expiry_arr);
	        if (count($expiry_arr) != 3) {
	            //过期时间完整性验证失败
	            return false;
	        } else {
	            $tex_time = $expiry_arr[2];
	            if ($tex_time > 0 && $tex_time - time() <= 0) {
	                //验证码过期
	                return false;
	            } else {
	                $reslutstr = $expiry_arr[1];
	            }
	        }
	        return $reslutstr;
	    }
	
	}
	//加密解密函数
	function encrypt($string,$operation){
		$key = new KEY('trainer', 0);
		if($operation == "E"){
			return $key->encode($string);
		}elseif($operation == 'D'){
			return $key->decode($string);
		}else{
			return false;
		}
	}
	
	/**
	 * 导出Excel函数
	 * @param $data array要导出的数据数组；$filename文件名，自动带上_日期时间以防止冲突；$stringCol为文本列编号，1代表A，依次类推，多个列用/分开
	 * @return Excel文件
	 */
	//注释：char(65)对应A，以此类推，char(90)对于Z……则，1为65,2为66……26为90Z(+64)
	
	//待测试
//	$objPHPExcel->getActiveSheet()
//  ->setCellValueExplicit(
//      'A1', 
//      '20130829071002210', 
//      PHPExcel_Cell_DataType::TYPE_STRING
//  );
	function exportExcel($data,$filename='base.xls',$stringCol = null){
		header("Content-type:text/html;charset=utf-8");
		ini_set('max_execution_time', '0');
		$filename = iconv('utf-8','gb2312',$filename);
		Vendor('PHPExcel.PHPExcel');
		$filename=str_replace('.xls', '', $filename).'_'.date('YmdHis').'.xls';
		$phpexcel = new \PHPExcel();
		$phpexcel->getProperties()
			->setCreator("MartenPeng")
			->setLastModifiedBy("MartenPeng")
			->setTitle("Office 2007 XLSX Document")
			->setSubject("Office 2007 XLSX Document")
			->setDescription("SWPUTrainer document for Office 2007 XLSX, generated using PHP classes.")
			->setKeywords("office 2007 openxml php")
			->setCategory("SWPUTrainer result file");
//		}
		$phpexcel->setActiveSheetIndex(0);
		$phpexcel->getActiveSheet()->setTitle('Sheet1');
		$phpexcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('宋体');
		//仅设置H列为文本
// 		$phpexcel->getActiveSheet()->getStyle('H')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
		//设置为文本格式
		if($stringCol != null){
			$stringColArray = explode('/',$stringCol);
		    for($i=0; $i<count($stringColArray); $i++){
    			$col = 64 + intval($stringColArray[$i]);
    			$phpexcel->getActiveSheet()->getStyle(chr($col))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
    		}
		}
		$phpexcel->getActiveSheet()->fromArray($data);
		//检查列数$stringCol
//		if($stringCol != null){
//		    $stringColArray = explode('/',$stringCol);
//  		//设置空格
//  		for($m=0; $m<count($stringColArray); $m++){
//  		    $col = 64 + intval($stringColArray[$m]);
//  		    for($j=2; $j<=count($data); $j++){
//  		        $blackCol = chr($col).$j;
//  		        $dataCol = $stringColArray[$m]-1;
//  		        $phpexcel->getActiveSheet()->setCellValue($blackCol, $data[$j-1][$dataCol].' ');
//  		    }
//  		}
//		}
		header('Content-Type: application/vnd.ms-excel');
		header("Content-Disposition: attachment;filename=$filename");
		header('Cache-Control: max-age=0');
		header('Cache-Control: max-age=1');
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		$objwriter = \PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
		$objwriter->save('php://output');
// 		exit;
	}
	