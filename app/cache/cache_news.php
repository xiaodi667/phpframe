<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cache_news
 *
 * @author jtg
 */
class cache_news
{
    public static function getNavs()
    {
        $key = md5("分类导航production");
        $cache = app_cache::local_cache_get($key);
        if($cache)
        {
            return $cache;
        }
        else
        {
            $data = news_category::getNavs();
            app_cache::local_cache_set($key, $data,86400*7);
            return $data;
        }
    }

    public static function getlists($page, $pagesize, $condition)
    {
        //$key = md5($page.$pagesize.serialize($condition));
        //$cache = app_cache::local_cache_get($key);
        //if($cache)
        //{
        //    return $cache;
        //}
        //else
        //{
            $data = news::frontGetLists($page, $pagesize, $condition);
            //app_cache::local_cache_set($key, $data,240);
            return $data;
        //}
    }

    public static function getLastNewsByNums($num)
    {
        $key = md5("最新资讯sproduction".$num);
        $cache = app_cache::local_cache_get($key);
        if($cache)
        {
            return $cache;
        }
        else
        {
            //$data = news::getLastNewsByNums($num);
            $data = news::getLatestByNums($num);
            if(!empty($data))
            {
                app_cache::local_cache_set($key, $data,180);
            }
            return $data;
        }
    }
    
    //put your code here
}
?>
