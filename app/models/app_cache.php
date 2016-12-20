<?php
/**
 * 缓存
 *
 */
class app_cache{

    /**
     * 本地缓存读写
     *
     * @param unknown_type $key
     * @return unknown
     */

    public static  function  local_cache_get($key)
    {
        $memcache = self::get_memcache();
        if($memcache)
        {
            $key = md5($key);
            $d = $memcache->get($key);
            return $d;
        }
        else
        {
            return false;
        }
        
    }
    public static function  local_cache_set($key,$value,$time=120)
    {
        
        $memcache =  self::get_memcache();
        if($memcache)
        {
            $key = md5($key);
            $d = $memcache->set($key, $value, 0, $time);
            return $value;
        }else{
            return false;
        }
    }
    public static function local_cache_clear($key)
    {
        $m = md5($key);
        $dir=self::gettmp().'/datacache/'.substr($m,0,2);
        $file=$dir.'/'.substr($m,2).'.cache';
        if(file_exists($file)){
            unlink($file);
            return true;
        }
        return false;
    }
    public static function gettmp()
    {
        if(defined('TMP')){
            $tmp=TMP;
        }else{
            $tmp='/tmp';
        }
        return $tmp;
    }
    /*
    public static function local_cache_clear_all()
    {
        $config=app_config::load('cache');
        $memcache = new Memcache;
        foreach ($config['memcache'] as $c)
        {
            $s=explode(':',$c,2);
            if(!isset($s[1])){
                $s[1]=11211;
            }
            $memcache->addServer($s[0], $s[1],1);
            $fp = fsockopen($s[0], $s[1], &$errno, &$errstr, 100);
            fputs($fp,"flush_all\n\n");
            fclose($fp);
        }
        return;

        $dir = self::gettmp().'/datacache/';
        $result = system("rm -rf " .$dir);

    }
     * 
     */
    public static function getMemcacheHosts()
    {
        $cache_key = (WP_ENV == 'local') ? 'cache' : 'cache_'.WP_ENV;
        $config = app_config::load($cache_key);
        if(isset($config['memcache'])&&!empty($config['memcache']))
        {
            return $config['memcache'];
        }
    }
    static $memcache=array();
    /**
     * Enter description here...
     *
     * @return Memcache
     */
    public static function  get_memcache(){
        if(self::$memcache)
        {
            return self::$memcache;
        }
        $cache_key = (WP_ENV == 'local') ? 'cache' : 'cache_'.WP_ENV;
        $config = app_config::load($cache_key);
        if($config['cache_status'] === 1)
        {
            $memcache = new Memcache;
            foreach ($config['memcache'] as $c)
            {
                $s = explode(':',$c,2);
                if(!isset($s[1]))
                {
                    $s[1]=11211;
                }
                $memcache->addServer($s[0], $s[1],1);
            }
            self::$memcache=$memcache;
        }
        else
        {
            $memcache = false;
        }
        return $memcache;
    }

    public static function destroy($key)
    {
        $cache_key = (WP_ENV == 'local') ? 'cache' : 'cache_'.WP_ENV;
        $config = app_config::load($cache_key);
        if($config['cache_status'] === 1)
        {
            foreach ($config['memcache'] as $c)
            {
                $s = explode(':',$c,2);
                if(!isset($s[1]))
                {
                    $s[1]=11211;
                }
                $key = md5($key);
                $res = self::sendMemcacheCommand($s[0],$s[1],'delete '.$key);
                return $res;
            }
            
        }
        else
        {
            return false;
        }

    }



    public static function sendMemcacheCommands($command)
    {
        $cache_key = (WP_ENV == 'local') ? 'cache' : 'cache_'.WP_ENV;
        $config = app_config::load($cache_key);
        $MEMCACHE_SERVERS = $config['memcache'];
	$result = array();
	foreach($MEMCACHE_SERVERS as $server){
		$strs = explode(':',$server);
		$host = $strs[0];
		$port = $strs[1];
		$result[$server] = self::sendMemcacheCommand($host,$port,$command);
	}
	return $result;
    }
    public static function getCacheItems()
    {
        $items = app_cache::sendMemcacheCommands('stats items');
        $serverItems = array();
        $totalItems = array();
        foreach ($items as $server=>$itemlist)
        {
            $serverItems[$server] = array();
            $totalItems[$server]=0;
            if (!isset($itemlist['STAT'])){
                continue;
            }
            $iteminfo = $itemlist['STAT'];
            foreach($iteminfo as $keyinfo=>$value)
            {
                if (preg_match('/items\:(\d+?)\:(.+?)$/',$keyinfo,$matches))
                {
                    $serverItems[$server][$matches[1]][$matches[2]] = $value;
                    if ($matches[2] == 'number')
                    {
                        $totalItems[$server] +=$value;
                    }
                }
            }
        }
        return array('items'=>$serverItems,'counts'=>$totalItems);
    }
    public static function dumpCacheSlab($server,$slabId,$limit)
    {
        list($host,$port) = explode(':',$server);
        $resp = app_cache::sendMemcacheCommand($host,$port,'stats cachedump '.$slabId.' '.$limit);
        return $resp;
    }
    /**
     *
     * @param <type> $host
     * @param <type> $port
     * @param <type> $command
     * @return <type>
     * @desc 命令执行函数
     */
    public static function sendMemcacheCommand($host,$port,$command)
    {
        $s = @fsockopen($host,$port);
	if (!$s){
		die("Can't connect to:".$host.':'.$port);
	}
	fwrite($s, $command."\r\n");
	$buf='';
	while ((!feof($s))) {
		$buf .= fgets($s, 256);
		if (strpos($buf,"END\r\n")!==false){ // stat says end
		    break;
		}
		if (strpos($buf,"DELETED\r\n")!==false || strpos($buf,"NOT_FOUND\r\n")!==false){ // delete says these
		    break;
		}
		if (strpos($buf,"OK\r\n")!==false){ // flush_all says ok
		    break;
		}
	}
    fclose($s);
    $res = array();
	$lines = explode("\r\n",$buf);
	$cnt = count($lines);
	for($i=0; $i< $cnt; $i++){
	    $line = $lines[$i];
		$l = explode(' ',$line,3);
		if (count($l)==3){
			$res[$l[0]][$l[1]]=$l[2];
			if ($l[0]=='VALUE'){ // next line is the value
			    $res[$l[0]][$l[1]] = array();
			    list ($flag,$size) = explode(' ',$l[2]);
			    $res[$l[0]][$l[1]]['stat'] = array('flag'=>$flag,'size'=>$size);
			    $res[$l[0]][$l[1]]['value'] = $lines[++$i];
			}
		}elseif($line=='DELETED' || $line=='NOT_FOUND' || $line=='OK'){
		    return $line;
		}
	}
	return $res;
    }

    public static function getMemcacheStats($total=true)
    {
	$resp = self::sendMemcacheCommands('stats');
	if($total):
            $res = array();
            foreach($resp as $server=>$r)
            {
                foreach($r['STAT'] as $key=>$row)
                {
                    if (!isset($res[$key]))
                    {
                        $res[$key]=null;
                    }
                    switch ($key){
                            case 'pid':
                                    $res['pid'][$server]=$row;
                                    break;
                            case 'uptime':
                                    $res['uptime'][$server]=$row;
                                    break;
                            case 'time':
                                    $res['time'][$server]=$row;
                                    break;
                            case 'version':
                                    $res['version'][$server]=$row;
                                    break;
                            case 'pointer_size':
                                    $res['pointer_size'][$server]=$row;
                                    break;
                            case 'rusage_user':
                                    $res['rusage_user'][$server]=$row;
                                    break;
                            case 'rusage_system':
                                    $res['rusage_system'][$server]=$row;
                                    break;
                            case 'curr_items':
                                    $res['curr_items']+=$row;
                                    break;
                            case 'total_items':
                                    $res['total_items']+=$row;
                                    break;
                            case 'bytes':
                                    $res['bytes']+=$row;
                                    break;
                            case 'curr_connections':
                                    $res['curr_connections']+=$row;
                                    break;
                            case 'total_connections':
                                    $res['total_connections']+=$row;
                                    break;
                            case 'connection_structures':
                                    $res['connection_structures']+=$row;
                                    break;
                            case 'cmd_get':
                                    $res['cmd_get']+=$row;
                                    break;
                            case 'cmd_set':
                                    $res['cmd_set']+=$row;
                                    break;
                            case 'get_hits':
                                    $res['get_hits']+=$row;
                                    break;
                            case 'get_misses':
                                    $res['get_misses']+=$row;
                                    break;
                            case 'evictions':
                                    $res['evictions']+=$row;
                                    break;
                            case 'bytes_read':
                                    $res['bytes_read']+=$row;
                                    break;
                            case 'bytes_written':
                                    $res['bytes_written']+=$row;
                                    break;
                            case 'limit_maxbytes':
                                    $res['limit_maxbytes']+=$row;
                                    break;
                            case 'threads':
                                    $res['rusage_system'][$server]=$row;
                                    break;
                    }
                }
            }
            return $res;
	endif;
	return $resp;
    }
    /**
     *
     * @param <type> $server
     * @return <type> 执行flash all命令
     */
    public static function flushServer($server){
        list($host,$port) = explode(':',$server);
        $resp = app_cache::sendMemcacheCommand($host,$port,'flush_all');
        return $resp;
    }

    /**
     *
     * @param <type> $array
     * @desc 通过xml文件获取host
     */
    public static function getMemFromXml($array=array())
    {
        //print_r($array);
        $memcache = new Memcache;
        //$memcache->addServer("10.0.0.20", "11211",1);
//        $memcache->addServer("10.0.0.21", "11211",1);
        //foreach ($array as $ks)
        //{
//            if($value['name'] == $name)
//            {
                $memcache->addServer("10.0.0.22", "11211",1);
//            }else{
//                $memcache = self::get_memcache();
//            }
            //$memcache->addServer("10.0.0.20", "11211",1);
        //}
        return $memcache;
    }
    /**
     *
     * @param <type> $dao_config
     * @param <type> $cache_config
     * @param <type> $data
     * @desc delete方法没解决！
     */

    public static function updateCache($dao_config,$cache_config,$data=array ())
    {
    	//echo "1";
        app_logic_log::log("data", "timer", $data);
        $xml = new util_XmlAssoc();
        $dao_configs = $xml->parseFile($dao_config); //解析表的配置文件
        $cache_configs = $xml->parseFile($cache_config); //解析缓存的配置文件
        //app_logic_log::log("cache_configs", "timer", $cache_configs);
        //app_logic_log::log("dao_configs", "timer", $dao_configs);
        foreach($dao_configs['dal']['route']['object'][0] as $k=>$v)
        {
        	//echo "2";
            if($k=='map')
            {
                app_logic_log::log("dao_configs", "timer", array("7"=>$k));
                foreach($v as $key=>$value)
                {
                    if(!is_array($value))continue;
                    $reson_name = $value['name'];
                    $key_property = strpos($value['keyProperty'],',') ? explode(',', $value['keyColumn']) : $value['keyColumn'];
                    foreach($cache_configs['root']['regions']['region'] as $keys=>$values)
                    {
                        if($values['name']==$reson_name)
                        {
                            if(count($values['keyPattern'])>0)//这里不通用需要修改
                            {
                                $m_name = $values['keyPattern'][0]['datasource'];
                                //echo $m_name;
                                foreach($cache_configs['root']['cache']['datasource'] as $as)
                                {
                                    if($as['name'] == $m_name)
                                    {
                                        if(is_array($key_property))
                                        {
                                            $real_key = $value['name'];
                                            foreach ($key_property as $ve)
                                            {
                                                $real_key.='_'.$data[$ve];
                                            }
                                        }else{
                                            $real_key = $value['name'].'_'.$data[$key_property];
                                        }
                                        
                                        $real_key = str_replace(' ', '', $real_key);
                                        app_logic_log::log("real_key", "timer", array("8"=>$real_key));
                                        app_logic_log::log('更新缓存','cache',array('map_key'=>$real_key));
                                        $r = app_cache::sendMemcacheCommand($as['server'],$as['port'],'delete '.$real_key);
                                    }
                                }
                            }
                        }
                    }

                }
            }
            //echo "3";
            if($k=='list')
            {
                app_logic_log::log("debug", "timer", array("9"=>$k));
                foreach($v as $key=>$value)
                {
                    if(!is_array($value))continue;
                    $reson_name = $value['name'];
                    $key_property = strpos($value['keyProperty'],',') ? explode(',', $value['keyColumn']) : $value['keyColumn'];
                    foreach($cache_configs['root']['regions']['region'] as $keys=>$values)
                    {
                        if($values['name']==$reson_name)
                        {
                            if(count($values['keyPattern'])>0)//这里不通用需要修改
                            {
                                $m_name = $values['keyPattern'][0]['datasource'];
                                foreach($cache_configs['root']['cache']['datasource'] as $as)
                                {
                                    if($as['name'] == $m_name)
                                    {
                                        //print_r($as);
                                        //$mem = app_cache::getMemFromXml($as);
                                        if(is_array($key_property))
                                        {
                                            $real_key = $value['name'];
                                            foreach ($key_property as $ve)
                                            {
                                                $real_key.='_'.$data[$ve];
                                            }
                                        }else{
                                            $real_key = $value['name'].'_'.$data[$key_property];
                                        }
                                        $list_count_key = $real_key.'#C';//删除count缓存
                                        $list_count_key = str_replace(' ', '', $list_count_key);
                                        app_logic_log::log("real_key", "timer", array("10"=>$real_key));
                                        app_logic_log::log('更新缓存','cache',array('list_key'=>$list_count_key));
                                        app_logic_log::log("list_count_key", "timer", array("16"=>$list_count_key));
                                        $r = app_cache::sendMemcacheCommand($as['server'],$as['port'],'delete '.$list_count_key);
                                        app_logic_log::log("real_key", "timer", array("12"=>"删除list_count结束"));
                                        app_logic_log::log("real_key", "timer", array("13"=>"开始删除list_rezon"));
                                        //$list_region_key = $real_key.'#M';//删除分区缓存
                                        //app_logic_log::log('list_region_key', "timer", array("14"=>$list_region_key));
                                        //$r = app_cache::sendMemcacheCommand($as['server'],$as['port'],'delete '.$list_region_key);
                                        //app_logic_log::log("real_key", "timer", array("15"=>"结束删除list_rezon"));
                                    }
                                }
                            }
                        }
                    }

                }
            }
            //object 独立更新缓存
			//echo "4";
            if($k=='name')
            {
                app_logic_log::log("debug", "timer", array("11"=>$k));
            	 //echo "5";
                //print_r($cache_configs);
                foreach($cache_configs['root']['regions']['region'] as $keys=>$values)
                {
                    if($values['name']==$v)
                    {
                        if(count($values['keyPattern'])>0)//这里不通用需要修改
                        {
                            $m_name = $values['keyPattern'][0]['datasource'];
                            foreach($cache_configs['root']['cache']['datasource'] as $as)
                            {
                                if($as['name'] == $m_name)
                                {
                                    $real_keys = array_pop(explode('.', $v)).'_'.$data['id'];
//                                    print_r($v);
//                                    echo $real_keys;
//                                    die();
                                    $real_keys = str_replace(' ', '', $real_keys);
                                    app_logic_log::log('更新缓存','cache',array('obj_key'=>$real_keys));
                                    $r = app_cache::sendMemcacheCommand($as['server'],$as['port'],'delete '.$real_keys);
                                    app_logic_log::log('更新缓存','cache',array('obj_key_result'=>$r));
                                }
                            }
                        }
                    }
                }
            }

        }
    }

    // create graphics
    //
    public static function graphics_avail()
    {
        return extension_loaded('gd');
    }

    function bsize($s)
    {
        foreach (array('','K','M','G') as $i => $k)
        {
            if ($s < 1024) break;
            $s/=1024;
        }
        return sprintf("%5.1f %sBytes",$s,$k);
    }









}
