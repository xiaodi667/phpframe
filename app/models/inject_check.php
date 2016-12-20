<?php
/***
 * sql 注入检查
 */
class inject_check{
    static function filter2()
    {
        //合并$_POST 和 $_GET
        if(function_exists('array_merge')){
          $ArrPostAndGet=array_merge($_POST,$_GET);
        }else{
          foreach($_POST as $key=>$value){
            $ArrPostAndGet[]=$value;
          }
          foreach($_GET as $key=>$value){
            $ArrPostAndGet[]=$value;
          }
        }
        
        
        $str_go_url = '/';
        $arr_filtrate=array("'"," union "," and "," true "," select "," or ");
        //print_r($ArrPostAndGet);
        foreach($ArrPostAndGet as $key=>$value)
        {
            if(self::funStringExist($value,$arr_filtrate))
            {
                echo "<script language=\"javascript\">alert(\"非法字符\");</script>";
                if(empty($str_go_url))
                {
                    echo "<script language=\"javascript\">history.go(-1);</script>";
                }else{
                    echo "<script language=\"javascript\">window.location=\"".$str_go_url."\";</script>";
                }
                exit;
            }
        }
    }
    static function funStringExist($StrFiltrate,$ArrFiltrate)
    {
        foreach ($ArrFiltrate as $key=>$value)
        {
            if (preg_match("/$value/i",$StrFiltrate))
            {
                //echo "您提交的数据含有非法字符!";
                return true;
            }
        }
        return false;
    }

    /**
     *
     * @return <type>
     * @todo 原过滤函数
     */
    static function filter(){
            
            $a=self::filter_str($_GET);
            $b=self::filter_str($_POST);
            $c=$a+$b;
            if($c){
                app_logic_log::log("inject_check :get:$a,post:$b");
                self::log_user();
            }
            //return;

            //警告
            if($c>0 && $c <2){
                
               //echo '<script > window.setTimeout(function(){alert("请不要提交非法字符")},100);</script>';
               //return ;
            }
            //严重
            if($c>1){
               //echo '<script>window.setTimeout(function(){alert("请不要提交非法字符");location="/";},100);</script><noscript>请不要提交非法字符</noscript>';
                //die;
            }
            return ;
        
    }
    /**
     * @todo 记录用户ip地址 等信息
     */
    static function log_user(){

    }
    /**
     * 返回非法字符出现的数量
     * @param <type> $str
     * @return <type>
     */
    static private function filter_str($str){
        $c=0;
        if(is_array($str)){
            foreach($str as $v){
                $c+=self::filter_str($v);
            }
            return $c;
        }
        $bad_word=array('\'',' and ',' or ' ,' union ',' select ');
        //搜索字符串里面是否有这些字符
        
        foreach($bad_word as $w){
            //echo $w." ".$str;
            if(false!==stripos($str,$w)){
                $c++;
                app_logic_log::log("inject_check : str:$str,w:$w");
            }
        } 
        return $c;
    }
}
