<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model
 *
 * @author jtg
 */
class model {
    

    function  __construct() {
       
    }
    //__get()方法用来获取私有属性
    private function __get($property_name)
    {
        if (isset($this->$property_name))
        {
            return($this->$property_name);
        } else {
            return(NULL);
        }
    }
    //__set()方法用来设置私有属性
    private function __set($property_name, $value)
    {
        $this->$property_name = $value;
    }
    //echo "当在类外部使用isset()函数测定私有成员$nm时，自动调用<br>";
    private function __isset($property_name)
    {
        return isset($this->$property_name);
    }
    //echo "当在类外部使用unset()函数来删除私有成员时自动调用的<br>";
    private function __unset($property_name)
    {  
        unset($this->$property_name);
    }
    
}
?>
