<?php
  //常用工具 tools
  class tools{
  //邮箱验证
  	function isEmail($email){
  		return (!empty($email) && (int)preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/", $email) > 0) ? true : false;
  	}
  //手机验证
  	function isMobile($mobile){
  		return (!empty($mobile) && (int)preg_match("/^1[3|4|5|7|8][0-9]{9}$/ ", $mobile) > 0) ? true : false;
  	}
  //昵称验证
  	function checkNickname($nickname){
  		return (!empty($nickname) && (int)preg_match("/^[0-9a-zA-Z_\x{4e00}-\x{9fa5}]+$/u",$nickname) > 0 && mb_strlen($nickname,'utf8') >= 2 && mb_strlen($nickname,'utf8') <= 12) ? true : false;
  	}
  
  	
  //获取ip地址
  	function getIp(){
  		if(!empty($_SERVER['HTTP_X_REAL_FORWARDED_FOR'])){
  			$ip = $_SERVER['HTTP_X_REAL_FORWARDED_FOR'];
  		}elseif(!empty($_SERVER['HTTP_CDN_SRC_IP'])){
  			$ip = $_SERVER['HTTP_CDN_SRC_IP'];
  		}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != 'unknown') {
  			$ips = $_SERVER['HTTP_X_FORWARDED_FOR'];
  			$ipArr = explode(',', $ips);
  			$ip = $ipArr[0];
  		}elseif(!empty($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] != 'unknown') {
  			$ip = $_SERVER['REMOTE_ADDR'];
  		}else{
  			$ip = '0.0.0.0';
  		}
  		return $ip;
  	}
  }
?>
