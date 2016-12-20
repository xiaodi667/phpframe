<?php
/**
 * 用户
 *
 */
class app_admin{


    static $session_key='USERADMIN';
    public static  function get_current_user()
    {
        if(!isset($_SESSION[self::$session_key])){
            return false;
        }
        return $_SESSION[self::$session_key];
    }

    /**
     * 管理员登录
     *
     * @param unknown_type $username
     * @param unknown_type $password
     * @param 是否过期  $exp
     */
    public static  function  login($username,$password){
        $db_name = util::getConfigValuesByKeys("BASIC_MASTER_NAME");
        $db=db_manager::getPdo($db_name);
        $sth=$db->prepare('select * from wp_admins where username=:username');
        $sth->execute(array('username'=>$username));
        $arr=$sth->fetchAll(2);
        $sth = null;
        if(!isset($arr[0])){
            throw new Exception("用户不存在");
        }
        $info=$arr[0];
        $group_info=array();
        if($info['gid']){
            try{
                $group_info=admin_power::get_group($info['gid']);
                $group_info['power']=explode(',',$group_info['power']);
            }catch (Exception $e){

            }
        }
        $info['group']=$group_info;
        if($password!=$info['password'] && md5($password)!=$info['password']){
            throw new Exception("用户密码错误");
        }
        
        $_SESSION[self::$session_key] = $info;
        //$_SESSION['auth_username'] = $info['username'];
        
        return $info;
    }

    public static function  logout(){
        @session_destroy();
    }
    public static function check_login(){
        $info=self::get_current_user();
        if(!isset($info['username'])){
            header('location:/?page=admins&action=login');
            die();
        }
        return true;
    }

    /**
     * 重新加载当前用户的权限
     *
     */
    public static function reload($username=''){
        $db_name = util::getConfigValuesByKeys("BASIC_MASTER_NAME");
        $db = db_manager::getPdo($db_name);
        $sth=$db->prepare('select * from wp_admins where username=:username');
        $sth->execute(array('username'=>$username));
        $arr=$sth->fetchAll(2);
        if(!isset($arr[0])){
            throw new Exception("用户不存在");
        }
        $info=$arr[0];
        if($info['gid']){
            $sql='select * from wp_admins_group where id='.$info['gid'];
            $arr=$db->query($sql)->fetchAll(2);
            $group_info=$arr[0];
            $group_info['power']=explode(',',$group_info['power']);
        }
        $_SESSION[self::$session_key]['group']=$group_info;
    }
    /**
     * 添加管理员
     *
     * @param unknown_type $info
     */
    public static function add_user($info){
        $db_name = util::getConfigValuesByKeys("BASIC_MASTER_NAME");
        $db=db_manager::getPdo($db_name);
        $sth=$db->prepare('insert into wp_admins (username,password,gid,group_name,power,remark,addtime)
        values(:username,:password,:gid,:group_name,:power,:remark,:addtime)');
        $group=admin_power::get_group($info['gid']);
        $info['power']=$group['power'];
        $info['group_name']=$group['name'];
        $param=array(
        'username'=>$info['username'],
        'password'=>md5($info['password']),
        'gid'=>$info['gid'],
        'group_name'=>$info['group_name'],
        'power'=>$info['power'],
        'remark'=>$info['remark'],
        'addtime'=>time()
        );

        $sth->execute($param);

    }
    /**
     * 查看管理员列表
     *
     * @param unknown_type $page
     * @param unknown_type $pagesize
     * @param unknown_type $option
     */
    public static  function  get_list($page=1,$pagesize=10,$option=array()){
        $db_name = util::getConfigValuesByKeys("BASIC_MASTER_NAME");
        $db = db_manager::getPdo($db_name);
//        /print_r($db);
        $sth=$db->query('select count(*) as c from wp_admins');
        $arr=$sth->fetchAll(2);
        $sth = null;
        $count=$arr[0]['c'];
        $start=($page-1 )* $pagesize;
        if($start<0){
            $start=0;
        }
        $sth = $db->query('select * from wp_admins limit '.$start.','.$pagesize);
        $list=$sth->fetchAll(2);
        //print_r($list);
        return array('list'=>$list,'count'=>$count);
    }
    public static function  get_user($id)
    {
        $db_name = util::getConfigValuesByKeys("BASIC_MASTER_NAME");
        $db=db_manager::getPdo($db_name);
        $sth=$db->prepare('select * from wp_admins where id=:id');
        $sth->execute(array('id'=>$id));
        $arr=$sth->fetchAll(2);
        /*
        if(!isset($arr[0]))
        
        {
            throw new Exception("用户不存在");
        }
         *
         */
        return isset($arr[0]) ? $arr[0] : array();
    }
    public static function edit_user($id,$info){
        $sql='update wp_admins set ';
        $param=array();
        if(isset($info['username']) && $info['username']!=''){
            $param['username'] = $info['username'];
        }
        if(isset($info['password']) && $info['password']!=''){
            $param['password']=md5($info['password']);
        }
        if(isset($info['remark'])){
            $param['remark']=$info['remark'];
        }
        if(isset($info['gid']) && $info['gid']!=0){
            $group=admin_power::get_group($info['gid']);
            $param['gid']=$info['gid'];
            $param['group_name']=$group['name'];
            $param['power']=$group['power'];
        }
        $p='';
        foreach ($param as $k=>$v){
            $sql=$sql.$p.$k.'=:'.$k;
            $p=' , ';
        }
        $sql.=' where id = :id';
        $param['id']= $id;
        $db_name = util::getConfigValuesByKeys("BASIC_MASTER_NAME");
        $db=db_manager::getPdo($db_name);
        return $db->prepare($sql)->execute($param);
    }
    public static function  del_user($id){
        db_manager::getPdo("BASIC_MASTER_NAME")->exec('delete from wp_admins where id='.intval($id));
    }
    /**
     *
     * @param <type> $username
     * @param <type> $password
     * @param <type> $new_password 
     */
    public static function  change_password($username,$password,$new_password)
    {
        $db = db_manager::getPdo("BASIC_MASTER_NAME");
        $sth = $db->prepare('select * from wp_admins where username=:username');
        $sth->execute(array('username'=>$username));
        $arr = $sth->fetchAll(2);
        if(!isset($arr[0])){
            throw new Exception("用户不存在");
        }
        $info=$arr[0];
        if(md5($password)!=$info['password'] && $password!=$info['password']){
            throw new Exception("原始密码错误");
        }
        self::edit_user($info['id'],array('password'=>$new_password));
    }
    /**
     *
     * @param <type> $uid
     * @param <type> $last_ip
     * @param <type> $last_time
     * @desc 更新最后登录时间
     */
    public static function updateIpAndLastTimeByUid($uid,$last_ip,$last_time)
    {
        $db_name = util::getConfigValuesByKeys("BASIC_MASTER_NAME");
        $db=db_manager::getPdo($db_name);
        $sth=$db->prepare('update wp_admins set lastloginip=:lastloginip,lastlogintime=:lastlogintime where id=:id');
        $sth->execute(array('id'=>$uid,'lastloginip'=>$last_ip,'lastlogintime'=>$last_time));
    }

    public static function updateLoginTimesByUid($uid)
    {
        $db_name = util::getConfigValuesByKeys("BASIC_MASTER_NAME");
        $db=db_manager::getPdo($db_name);
        $sth=$db->prepare('update wp_admins set logintimes = logintimes + 1 where id=:id');
        $sth->execute(array('id'=>$uid));
    }

    /**
     *  渠道列表
     *
     */
    public  static  function get_channel_list($page=1,$pagesize=10,$option=array()){
        $db_name = util::getConfigValuesByKeys("DZG_DB_CHANNELS");
        $db = db_manager::getPdo($db_name);
//        /print_r($db);
        $sth=$db->query('select count(*) as c from channels');
        $arr=$sth->fetchAll(2);
        $sth = null;
        $count=$arr[0]['c'];
        $start=($page-1 )* $pagesize;
        if($start<0){
            $start=0;
        }
        $sth = $db->query('select * from channels order by friend_id asc limit '.$start.','.$pagesize);
        $list=$sth->fetchAll(2);
        //print_r($list);
        return array('list'=>$list,'count'=>$count);
    }
    /**
     *  渠道种类添加
     *
     */
    public  static function  get_channel_add($info){
        $db_name = util::getConfigValuesByKeys("DZG_DB_CHANNELS");
        $db=db_manager::getPdo($db_name);
        $sth=$db->prepare("insert into channels (friend_id,`desc`,is_use)
        values(:friend_id,:desc,:is_use)");
        $sth->execute(array('friend_id'=>$info['friend_id'],'desc'=>$info['desc'],'is_use'=>$info['is_use']));
       return $db->lastInsertId();//返回添加的ID
    }
    /**
     *  渠道种类查询
     *
     */
    public  static function  get_channel_select($info){
        $db_name = util::getConfigValuesByKeys("DZG_DB_CHANNELS");
        $db=db_manager::getPdo($db_name);
        $sth=$db->query('select * from channels where friend_id = '.$info);
        $arr=$sth->fetchAll(2);
        return $arr;//返回添加的ID
    }
    /**
     *  渠道种类删除
     *
     */
    public  static function  get_channel_del($id){
        $db_name = util::getConfigValuesByKeys("DZG_DB_CHANNELS");
        $db=db_manager::getPdo($db_name);
        return $db->exec('delete from channels where id ='.$id.'');
    }




    

    public static function userList($page, $pagesize,$option)
    {
        
    }
    /**
     *  stat_logs_dzg 优化
     *
     */
    public  static function stat_logs_optimize()
    {
        $db_name = util::getConfigValuesByKeys("DB_CLIENT_DOWNLOAD");
        $db=db_manager::getPdo($db_name);
        $sth=$db->query('select * from  download  WHERE path LIKE "http://%"' );
        $arr=$sth->fetchAll(2);
        return $arr;

    }
    /**
     *  stat_logs_dzg 优化修改
     *
     */
    public  static function stat_logs_optimize_eidt($uid,$path)
    {
        $db_name = util::getConfigValuesByKeys("DB_CLIENT_DOWNLOAD");
        $db=db_manager::getPdo($db_name);
        $sth=$db->prepare('update download set path = :path where id=:id');
        $sth->execute(array('id'=>$uid,'path'=>$path));

    }
    /**
     * 字符串截取，支持中文和其他编码
     *
     * @param string $str 需要转换的字符串
     * @param string $start 开始位置
     * @param string $length 截取长度
     * @param string $charset 编码格式
     * @param string $suffix 截断字符串后缀
     * @return string
     */
    function substr_ext($str, $start=0, $length, $charset="utf-8", $suffix="")
    {
        if(function_exists("mb_substr")){
            return mb_substr($str, $start, $length, $charset).$suffix;
        }
        elseif(function_exists('iconv_substr')){
            return iconv_substr($str,$start,$length,$charset).$suffix;
        }
        $re['utf-8']  = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
        return $slice.$suffix;
    }
}
