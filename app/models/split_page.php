<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of split_page
 *
 * @author jtg
 */
class split_page {
    public $max_page;
    public $max_count;
    public $page;
    public $show_page_num;
    public $pagesize=10;
    public $current_url='';
    public $page_param_name='';
    function __construct($type='p'){
        $this->current_url=$_SERVER['REQUEST_URI'];
        $this->page_param_name = $type;
    }

    /**
     * 设置记录数
     *
     * @param unknown_type $count
     * @param unknown_type $pagesize
     */
    public function set_count($count,$pagesize=10)
    {
        $this->max_page=ceil($count/$pagesize);
        $this->max_count=$count;
        $this->pagesize=$pagesize;
    }
    /**
     * 设置当前页
     *
     * @param unknown_type $current_page
     */
    public function  set_page($current_page){
        $current_page=intval($current_page);
        if($current_page<1){
            $current_page=1;
        }
        $this->page=$current_page;
    }
    /**
     * Enter description here...
     *
     */
    public function get_page_list($n=10){
        $info=array();
       // $first
       $info['first']=$this->mkurl(1);
       $info['last']=$this->mkurl($this->max_page);
       $page=$this->page;
       if($page>1){
           $info['front']=$this->mkurl($page-1);
       }else {
           $info['front']='';
       }
       if($page<$this->max_page){
           $info['next']=$this->mkurl($page+1);
       }else{
           $info['next']='';
       }
       $info['page']=$this->page;
       $info['max_page']=$this->max_page;
       //中间列表页
       $list=array();
       //当前页的前后N页
       if($this->max_page-$page<$n/2){
           //向左靠齐

           for ($i=$this->max_page-$n > 0 ? $this->max_page-$n:1;$i<=$this->max_page;$i++){
               $list[$i]=$this->mkurl($i);
           }
       }
       if($page<$n/2){
          $max=$this->max_page;
           $j=0;
           for ($i=1;$i<($max);$i++){
               if(++$j>$n){
                   break;
               }
               $list[$i]=$this->mkurl($i);
           }
       }
       if($page>=$n/2 && $page<=$this->max_page-ceil($n/2)){
           for ($i=$page-ceil($n/2)>0?$page-ceil($n/2):1;$i<$page+ceil($n/2);$i++){
               $list[$i]=$this->mkurl($i);
           }
       }
       $info['list']=$list;
       return $info;

    }
    private function mkurl($page){

        $url_info=parse_url($this->current_url);
        $url=$url_info['path'];
        $param=array();
        if(isset($url_info['query'])){
            parse_str($url_info['query'],$param);
        }
        $param[$this->page_param_name] = $page;
        return $url.'?'.http_build_query($param);
    }
    /**
     * 一个简单的分页显示函数
     *
     *
     * @param 记录数 $count
     * @param  每页的数目 $pagesize
     * @param 当前页 $page
     * @param 分页列表显示的数目 $show_item
     * @return unknown
     */
    public static function quick_list($count,$pagesize,$page=1,$show_item=10,$type='p'){
        $split = new split_page($type);
        $split->set_count($count,$pagesize);
        $split->set_page($page);
        return $split->get_page_list($show_item);
    }
}
?>
