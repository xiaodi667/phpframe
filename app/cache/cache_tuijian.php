<?php
/**
 * 推荐 模块显示
 *
 */
class cache_tuijian
{
    public static function getHuanDengDatas($name,$num)
    {
        $key = md5($name);
        $cache = app_cache::local_cache_get($key);
        if($cache)
        {
            return $cache;
        }
        else
        {
            $data = tuijian::get_data_by_name($name,$num);
            app_cache::local_cache_set($key, $data, 120);
            return $data;
        }
    }

    
}
?>