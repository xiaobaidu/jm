<?
/**
 * 数据过滤
 * @param array $data
 * @return array
 */
function filterstr($data, $htmlspecialchars = false){
	if(!empty($data)) {
		foreach($data as $_key => $_value) {
			if(!is_array($_value)){
				//$_value = urldecode($_value);
				$_value = preg_replace ("'<script[^>]*?>.*?</script>'si", "",$_value);
				//$_value = strip_tags($_value);
				$_value = trim($_value);
				
				$data[$_key] = stripslashes($_value);
                if($htmlspecialchars == true){
                    $data[$_key] = htmlspecialchars($_value);
                }
//				$data[$_key] = addslashes($_value);
            }
			else{
				$data[$_key] = filterstr($_value, $htmlspecialchars);
			}
		}
	}
	return $data;
}