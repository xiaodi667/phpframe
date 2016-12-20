<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of remote_fetch
 *
 * @author jtg
 */
class remote_fetch
{
	public static function getResultByGet($url='',$type='默认时间')
	{
		$url = trim($url);
		$ch = curl_init() ;
		$timeout = 5;
		$starttime = microtime(true);
		//curl_setopt($ch,CURLOPT_TIMEOUT,$timeout);
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true) ;
		$errno = curl_errno($ch);
		app_logic_log::log('请求错误','error',array('errno'=>$errno));
		if($errno){
			$error = curl_error($ch);
			throw new Exception($error);
		}
		$result = curl_exec($ch);
		curl_close($ch);
                
                if($result == '')
                {
                    if(function_exists('file_get_contents'))
                    {
                        $ctx = stream_context_create(array('http' => array('timeout' => $timeout)));
                        $result = file_get_contents($url,FALSE,$ctx);
                    }
                    
                }
		$endtime = microtime(true);		
		$result = json_tool::decode(trim($result));		
		app_logic_log::log($type,'timer',array('timer'=>$endtime-$starttime,'$url'=>$url));
		return $result;
	}
	

	public static function getRemoteResultByPost($url='',$fields='')
	{
		$user_agent ="Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)";
		$ch = curl_init() ;
		curl_setopt($ch, CURLOPT_URL, $url); //设置请求的URL
                //curl_setopt($ch, CURLOPT_FAILONERROR, 1); // 启用时显示HTTP状态码，默认行为是忽略编号小于等于400的HTTP信息
                //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);//启用时会将服务器服务器返回的“Location:”放在header中递归的返回给服务器
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);// 设为TRUE把curl_exec()结果转化为字串，而不是直接输出
                curl_setopt($ch, CURLOPT_POST, 1);//启用POST提交
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields); //设置POST提交的字符串
                //curl_setopt($ch, CURLOPT_PORT, 80); //设置端口
                curl_setopt($ch, CURLOPT_TIMEOUT, 23); // 超时时间
                curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);//HTTP请求User-Agent:头
                //curl_setopt($ch,CURLOPT_HEADER,1);//设为TRUE在输出中包含头信息
                //$fp = fopen("example_homepage.txt", "w");//输出文件
                //curl_setopt($ch, CURLOPT_FILE, $fp);//设置输出文件的位置，值是一个资源类型，默认为STDOUT (浏览器)。
                curl_setopt($ch,CURLOPT_HTTPHEADER,array(
                'Accept-Language: zh-cn',
                'Connection: Keep-Alive',
                'Cache-Control: no-cache'
                ));//设置HTTP头信息
                $result = curl_exec($ch); //执行预定义的CURL
                $info = curl_getinfo($ch); //得到返回信息的特性
		return $result;
	}

	

}
?>
