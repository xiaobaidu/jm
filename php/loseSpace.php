<?
//过滤所有空格，回车，换行
function loseSpace($pcon){
	 $pcon = preg_replace("/ /","",$pcon);
	 $pcon = preg_replace("/&nbsp;/","",$pcon);
	 $pcon = preg_replace("/　/","",$pcon);
	 $pcon = preg_replace("/\r\n/","",$pcon);
	 $pcon = str_replace(chr(13),"",$pcon);
	 $pcon = str_replace(chr(10),"",$pcon);
	 $pcon = str_replace(chr(9),"",$pcon);
	 return $pcon;
}