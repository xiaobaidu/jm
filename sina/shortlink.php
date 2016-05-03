<?
$statuses = $ms['statuses'];
$byShortUrl = array();
//处理界面微博列表的短链接
foreach ($statuses as $key => $value) {
    if (strstr($value['text'], "http://t.cn/")) {
        $shortLink = $value['text'];
        $weiBoMId = $value['mid'];
        $weiBoId = $value['id'];
        //$explodeLink = explode("http://t.cn/", $shortLink);
        preg_match("/http\:\/\/t\.cn\/([a-zA-Z0-9]+)/ms",$shortLink,$matches); //正则表达式匹配短链接
        $shortString = $matches[1];
       // $shortString = array_pop($explodeLink);// TODO 短链接截取存在缺陷 协调发布微博可否统一格式
        $byShortUrl[$key] = $c->byShortUrl($shortString);//根据短链接获取长链接
        $byShortUrl[$key]['mid'] = $weiBoMId;//组装数组，追加微博评论id
        $byShortUrl[$key]['weiboId'] = $weiBoId;//组装数组，追加微博id
    }
}