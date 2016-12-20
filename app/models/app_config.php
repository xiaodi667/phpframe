<?php
class app_config {

    static $config_cache = array();
    /**
     * 加载配置文件
     *
     * @param unknown_type $file
     */
    public static function  load($name)
    {
        if(isset(self::$config_cache[$name]))return self::$config_cache[$name];
        $dir = dirname(dirname(__FILE__)).'/config';
        $full_file = $dir.'/config_'.$name.'.php';
        if(!file_exists($full_file))
        {
            throw new  Exception("配置[$name]不存在");
        }
        $var_name = 'config_'.$name;
        include($full_file);
        $tmp = $$var_name;
        self::$config_cache[$name] = $tmp;
        return $tmp;
    }
    /**
     * 得到某个配置文件的配置项目
     *
     * @param 配置文件名 $name
     * @param 配置的key $key
     * @return unknown
     */
    public static function  get_config($name,$key)
    {
        $config = self::load($name);
        if(isset($config[$key]))
        {
            return $config[$key];
        }
        return '';
    }
}
?>