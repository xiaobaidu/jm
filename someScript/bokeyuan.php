<?php
//定时抓取博客园文章内容，做本地数据库。 phpcms部分表没有处理。大部分处理，内容存储内容格式urlencode
exit;
header("Content-type: text/html; charset=utf-8"); 
$connect = mysqli_connect("localhost","root","","phpcmsv9");//连接数据库
mysqli_query($connect,"SET NAMES 'UTF8'");//统一编码
//php :         106882   catid : 83
//java :        106876   catid : 84
//javascript :  106893   catid : 75
//linux :       108726   catid : 85
//jquery :      108731   catid : 78
//go :          108748   catid : 89
//mysql :       108715   catid : 96
//python :      108696   catid : 86
//安卓 :        108706   catid : 92
//html5 :       108737   catid : 77
//ios :         108707   catid : 93
//html/css :    106883   catid : 82

$myArray = array(
	'106882'=>'83',
	'106876'=>'84',
	'106893'=>'75',
	'108726'=>'85',
	'108731'=>'78',
	'108748'=>'89',
	'108715'=>'96',
	'108696'=>'86',
	'108706'=>'92',
	'108737'=>'77',
	'108707'=>'93',
	'106883'=>'82',
);

foreach($myArray as $kk=>$vv){
	for($i = 2;$i<6;$i++){
		$data = array(
			'CategoryId'=>$kk,
			'PageIndex'=>$i,
			'ParentCategoryId'=>2,
		);
		$catid = $vv;
		$url = "http://www.cnblogs.com/mvc/AggSite/PostList.aspx";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120 );
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data );
		$fileContent = curl_exec($ch);
		//匹配博客title  class="titlelnk"
		preg_match_all('/class\=\"titlelnk\" href=\"(.*?)\>(.*?)<\/a>/si',$fileContent,$articleTitles); 
		$titleTitleResult = $articleTitles[2];
		//匹配博客描述
		preg_match_all('/class\=\"post_item_summary\"\>(.*?)<\/p>/si',$fileContent,$articleDescs);
		$titleDescResult = $articleDescs[1];
		$titleDescResult = preg_replace("/<a.*?\/><\/a>/si","",$titleDescResult);
		//匹配博客title作者
		preg_match_all('/class\=\"lightblue\"\>(.*?)<\/a>/si',$fileContent,$articleAuthors);
		$articleAuthorResult = $articleAuthors[1];
		//匹配博客列表标题链接
		preg_match_all('/class\=\"titlelnk\" href=\"(.*?)\" target\=\"_blank\"/si',$fileContent,$articleLinks);
		$articleLinkResult = $articleLinks[1];
		//匹配博客发布时间
		preg_match_all('/class\=\"post_item_foot\"\>(.*?)2016-(.*?)<span class\=\"article_comment\"\>/si',$fileContent,$articlePublishTimes);
		$articlePublishTimeResult = $articlePublishTimes[2];

		foreach($titleTitleResult as $key=>$title){
			$pTime = '2016-'.$articlePublishTimeResult[$key];
			$pTimeRes = strtotime($pTime);
			$lastTime = "1465298708";
			if($pTimeRes > $lastTime){
				$timeNow = time();
			$desc = $titleDescResult[$key];
			$author = $articleAuthorResult[$key];
			$insertRes=mysqli_query($connect,"insert into v9_news (catid,title,description,username,inputtime,updatetime,status,sysadd) values ($catid,'$title','$desc','$author',$timeNow,$timeNow,'99','1');");//插入文章
			$query="SELECT LAST_INSERT_ID()";
			$result=mysqli_query($connect,$query);
			$rows=mysqli_fetch_row($result);
			$aid = $rows[0];
			$updateUrlSql = "update v9_news set url='http://www.qishuai.com/index.php?m=content&c=index&a=show&catid=$catid&id=$aid' where id = $aid;";
			$updateMysql = mysqli_query($connect,$updateUrlSql);//修改链接地址
			$articleContents = file_get_contents($articleLinkResult[$key]);
			//var_dump($articleContents);
			preg_match('/id\=\"cnblogs_post_body\"\>(.*?)<\/div><div id\=\"MySignature\"/si',$articleContents,$articleContent);//匹配博客详情
			//id="cnblogs_post_body">
			$arrticleContentRes = urlencode($articleContent[1]);
			$newsDataSql = "insert into v9_news_data (id,content,paginationtype,maxcharperpage) values ($aid,'$arrticleContentRes',0,10000);";
			$res=mysqli_query($connect,$newsDataSql);
			$hitsid = "c-1-$rows[0]";
			$insertHitsSql = "insert into v9_hits (hitsid,catid,updatetime) values ('$hitsid','$catid',$timeNow);";
			//echo $insertHitsSql;
			$res=mysqli_query($connect,$insertHitsSql);
			}
			
		}
	}
	//TODO search 储存
}
	
?>

