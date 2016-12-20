<?php
/**
 * 类的自动加载的实现
 */
global $include_path_list;
$include_path_list = explode(PATH_SEPARATOR,get_include_path());
array_push($include_path_list,MODELS);
array_push($include_path_list,CACHES);
array_push($include_path_list,LIBS);
array_push($include_path_list,DAOS);
//cake 兼容
//require LIBS . 'model' . DS . 'model.php';

/**
 * @todo 需要把加载的类缓存起来,就不需要查找一遍了
 *
 * @param unknown_type $class
 */
function __autoload($class){

    global $include_path_list;
    $new_class= strtolower(preg_replace('/(?<=\\w)([A-Z])/', '_\\1', $class));
    foreach ($include_path_list as $path){  	
        $file=$path.'/'.$new_class.'.php';
        if(file_exists($file)){
            include($file);
            if(class_exists($class)){
                return ;
            }

        }
    }
    $zend_class=str_replace('_','/',$class);
    foreach ($include_path_list as $path){
        $file=$path.'/'.$zend_class.'.php';
        if(file_exists($file)){
            include($file);
            if(class_exists($class)){
                return true;
            }
        }
    }
    return false;
    //zend 风格的类
}
