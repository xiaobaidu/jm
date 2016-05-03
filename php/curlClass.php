<?
class curl{
	/**
	 * get方法
	 *
	 * @param string 接口地址
	 * @param string endpoint 
	 * @param string model名
	 * @param string 方法名
	 * @param array 参数
	 * @return json
	 */
    static public function sendByGet($host,$data){
		$fields_string = '';
		if(!empty($data)){
			ksort($data);
			$fuhao = '';
			foreach($data as $k=>$v){
				$fields_string .=$fuhao.$v;
				$fuhao = '/';
			}
		}
        if(!empty($fields_string)){
            $url = $host.'/'.$fields_string;
        } else {
            $url = $host;
        }
		$ch = curl_init() ;
		curl_setopt($ch, CURLOPT_URL,$url) ;
		curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		$str = curl_exec($ch);

        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE );
        curl_close($ch);
   		if ($status == 200) {
			return $str;
		} else {
			return false;
		}
	}
	
    /**
     * post方法
     *
     * @param string 接口地址
     * @param array 参数
     * @return json
     */
	public function sendByPost($url,$data,$cookie=''){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		if($cookie){
			curl_setopt($ch, CURLOPT_COOKIE, $cookie);
		}
		
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120 );
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data );
		$str = curl_exec($ch);
		if (curl_errno($ch)) {
		     $error = "Curl error: " . curl_error($ch)."\n时间：".date('Y-m-d H:i:s',time())."\r\n";
			 file_put_contents('curl_post_error.txt',$error,FILE_APPEND);
		}
		curl_close($ch) ;
		return $str;
	}
}