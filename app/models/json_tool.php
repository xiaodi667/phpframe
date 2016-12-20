<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of json_tool
 *
 * @author jtg
 */
class json_tool {
	public static function decode($str){
		$obj = json_decode($str);
		return self::obj2arr($obj);
	}

	/**
	 *
	 * @param <type> $obj
	 * @return <type>
	 */
	public static function obj2arr($obj){
		if(!is_object($obj) && !is_array($obj) ){
			return $obj;
		}
		$arr=array();
		foreach ($obj as $k=>$v){
			$arr[$k]=self::obj2arr($v);
		}
		return $arr;
	}
	public static function array2object($array){
		if (is_array($array)){
			$obj = new StdClass();
			foreach ($array as $key => $val)
			{
				$obj->$key = $val;
			}
		}else{
			$obj = $array;
		}
		return $obj;
	}
	/**
	 *
	 * @param <type> $arr
	 * @return <type> 返回数组
	 */
	public static function encode($arr){
		return json_encode($arr);
	}
}
?>
