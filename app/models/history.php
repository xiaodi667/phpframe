<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of history
 *
 * @author jtg
 */
class history
{
    public $name;
    public $size=15;
    public $_cookie_path='/';
    
    /**
     * cookie过期时间
     *
     * @var unknown_type
     */
    public $_cookie_exp=864000;

    public function __construct($name,$size=15){
        $this->name='ch_'.strtolower(trim($name));
        $this->size=$size;
    }
    public function push($data)
    {
        $arr=$this->get_list();
        foreach ($arr as $k=>$v){
            if($v==$data){
                unset($arr[$k]);
            }
        }

        array_push($arr,$data);

        $len=count($arr)-$this->size;
        if($len>0){
            for ($i=0;$i<$len;$i++){
                unset($arr[$i]);
            }
        }
        $str=implode(',',$arr);
        $r=setcookie($this->name,$str,time()+$this->_cookie_exp,$this->_cookie_path);
    }
    public function get_list()
    {
        $str = isset($_COOKIE[$this->name]) ? $_COOKIE[$this->name]:'';
        if($str==''){
            return array();
        }
        $arr=explode(',',$str);
        return $arr;
    }
}
?>
