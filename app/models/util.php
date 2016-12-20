<?php
// 说明：比较两个时间的差别并且显示为易于读取的格式
class util
{
    public static function timeDiff($from,$to = '')
    {
        if($from==0)return '';
        $from = $from/1000;
        $to = ($to == '') ? time() : $to;
        $diff = (int) abs($to - $from);
        if($diff <= 3600)
        {
            $mins = floor($diff / 60);
            $since = ($mins <= 1) ? '1 分钟前' : sprintf('%s 分钟前', $mins);
        }
        elseif(($diff <= 86400) && ($diff > 3600))
        {
            $hours = floor($diff / 3600);
            $since = ($hours <= 1) ? '1 小时前' : sprintf( '%s 小时前', $hours );
        }
        elseif ($diff >= 86400)
        {
            //$days = round($diff / 86400);
            $days = floor($diff / 86400);
            if ($days <= 1)
            {
                $since = '1天前';
            }
            elseif(($days > 1) && ($days <=7))
            {
                $since = sprintf( '%s 天前', $days );
            }
            elseif(($days > 7) && ($days < 14))
            {
                //$since = sprintf( '%s days', $days );
                $since = '1周前';
            }
            elseif(($days >= 14) && ($days < 21))
            {
                //$since = sprintf( '%s days', $days );
                $since = '2周前';
            }
            elseif(($days >= 21) && ($days < 30))
            {
                //$since = sprintf( '%s days', $days );
                $since = '3周前';
            }
            else
            {
                $since = date('Y-m-d H:i',$from);
            }
        }
        return $since;
    }

    public static function get_domain(){
		return strtolower($_SERVER['HTTP_HOST']);
	}
    public static function get_current_goto(){
        $ref='';
                if(isset($_GET['forward'])){
            $ref=$_GET['forward'];
        }

        if(!$ref && isset($_REQUEST['goto'])){
            $ref=$_REQUEST['goto'];
        }
         if(!$ref && isset($_SERVER['REQUEST_URI'])){
            $ref='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        }
        return $ref;
    }

    public static function get_goto_url($url = '')
    {
	$ref='';
	if(isset($_GET['forward'])){
            $ref=$_GET['forward'];
        }

        if(!$ref && isset($_REQUEST['goto'])){
            $ref=$_REQUEST['goto'];
        }
         if(!$ref ){
            $ref=isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'/';
        }

        $info = parse_url($ref);
        $default_ref = $url;
        //检测来源的代码
        if(!isset($info['host'])){
        	if($ref){
        		return $ref;
        	}
            return '/';
        }
        $host=explode('.',$info['host']);
        if(count($host)>=2){
            $host_str=$host[count($host)-2].'.'.$host[count($host)-1];
            if(!in_array($host_str,array('gemantic.com'))){
                $ref=$default_ref;
            }
        }else{
            $ref=$default_ref;
        }
        return $ref;
    }

    public static function gb2312ToUtf8($con)
    {
        $con = iconv("utf-8","gb2312",$con);
        return  $con;
    }
    

    public static function utf8_substr($str,$position,$length,$tail=false)
    {
	$start_position = strlen($str);
	$start_byte = 0;
	$end_position = strlen($str);
	$count = 0;
	for($i = 0; $i <strlen($str); $i++)
	{
            if($count>= $position && $start_position> $i)
            {
                    $start_position = $i;
                    $start_byte = $count;
            }
            if(($count-$start_byte)>=$length)
            {
                    $end_position = $i;
                    break;
            }
            $value = ord($str[$i]);
            if($value> 127)
            {
                    $count++;
                    if($value>= 192 && $value <= 223) $i++;
                    elseif($value>= 224 && $value <= 239) $i = $i + 2;
                    elseif($value>= 240 && $value <= 247) $i = $i + 3;
                    else die('Not a UTF-8 string');
            }
            $count++;
	}
        if($tail==true):
            if(($end_position-$start_position)>$length):
                $str_tail ='...';
            else:
                $str_tail = '';
            endif;
            return(substr($str,$start_position,$end_position-$start_position).$str_tail);
        else:
            return(substr($str,$start_position,$end_position-$start_position));
        endif;

    }

    
    public static function getConfigValuesByKeys($key)
    {
        return $key;
    }
    /**
     *
     * @return <type>
     * 获取ip
     */
    public static function getIP()
    {
        if ($_SERVER["HTTP_X_FORWARDED_FOR"])
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        else if ($_SERVER["HTTP_CLIENT_IP"])
        $ip = $_SERVER["HTTP_CLIENT_IP"];
        else if ($_SERVER["REMOTE_ADDR"])
        $ip = $_SERVER["REMOTE_ADDR"];
        else if (getenv("HTTP_X_FORWARDED_FOR"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if (getenv("HTTP_CLIENT_IP"))
        $ip = getenv("HTTP_CLIENT_IP");
        else if (getenv("REMOTE_ADDR"))
        $ip = getenv("REMOTE_ADDR");
        else
        $ip = "Unknown";
        return $ip;
    }

    /**
     * //获取一对html标记间的html字符串
     * //例: echo get_innerhtml("<tr><td height=20>something</td></tr>", "td"); //will print "something".
     * @param <type> $html
     * @param <type> $label
     * @return <type>
     */
    public static function get_innerhtml($html,$label)
    { 
        $result_arr = preg_split("/<\/".$label.">/i",$html);
        $pattern = "/<".$label.".*?>/i";
        for ($i = 0; $i < count($result_arr); $i++) {
        list($left, $right) = preg_split($pattern,$result_arr[$i],2);
        $result_arr[$i] = $right;
        }
        return $result_arr;
    }
    
    public static function get_input_value($input)
    { //获取Input的HTML代码中的Value值
        $pos = stripos($input, "value=") + 6;
        if ($pos !== false)
        {
        $input = substr($input, $pos);
        if (substr($input, 0, 1) == "\"")
        return substr($input, 1, strpos($input, "\"", 1) - 1);
        else
        return substr($input, 0, strpos($input, " ") - 1);
        }
        return false;
    }
    function getcontentbetween($a, $b, $str) { //获取字符串$str中,字符串$a与字符串$b之间的字符串
    if ($str!=="" && $a!=="" && $b!=="") {
    $start = strpos($str, $a) + strlen($a);
    return substr($str, $start, strpos($str, $b, $start + 1) - $start);
    }
    return false;
    }
    /**
     *
     * @return <type> 获取访问者浏览器 
     */
    public static function browse_infor()
    {
        $browser="";
        $browserver="";
        $Browsers =array("Lynx","MOSAIC","AOL","Opera","JAVA","MacWeb","WebExplorer","OmniWeb");
        $Agent = $GLOBALS["HTTP_USER_AGENT"];
        for ($i=0; $i<=7; $i++)
        {
            if (strpos($Agent,$Browsers[$i]))
            {
                $browser = $Browsers[$i];
                $browserver ="";
            }
        }
        if (ereg("Mozilla",$Agent) && !ereg("MSIE",$Agent))
        {
            $temp =explode("(", $Agent); $Part=$temp[0];
            $temp =explode("/", $Part); $browserver=$temp[1];
            $temp =explode(" ",$browserver); $browserver=$temp[0];
            $browserver =preg_replace("/([d.]+)/","1",$browserver);
            $browserver = " $browserver";
            $browser = "Netscape Navigator";
        }
        if (ereg("Mozilla",$Agent) && ereg("Opera",$Agent))
        {
            $temp =explode("(", $Agent); $Part=$temp[1];
            $temp =explode(")", $Part); $browserver=$temp[1];
            $temp =explode(" ",$browserver);$browserver=$temp[2];
            $browserver =preg_replace("/([d.]+)/","1",$browserver);
            $browserver = " $browserver";
            $browser = "Opera";
        }
        if (ereg("Mozilla",$Agent) && ereg("MSIE",$Agent))
        {
            $temp = explode("(", $Agent); $Part=$temp[1];
            $temp = explode(";",$Part); $Part=$temp[1];
            $temp = explode(" ",$Part);$browserver=$temp[2];
            $browserver =preg_replace("/([d.]+)/","1",$browserver);
            $browserver = " $browserver";
            $browser = "Internet Explorer";
        }
        if ($browser!="")
        {
            $browseinfo = "$browser$browserver";
        }
        else
        {
            $browseinfo = "Unknown";
        }
        return $browseinfo;
    }
    //调用方法$browser=browseinfo() ;直接返回结果

    /**
     *
     * @return <type> 获取访问者操作系统 
     */
    public static function osinfo()
    {
        $os="";
        $Agent = $GLOBALS["HTTP_USER_AGENT"];
        if (eregi('win',$Agent) && strpos($Agent, '95')) {
        $os="Windows 95";
        }
        elseif (eregi('win 9x',$Agent) && strpos($Agent, '4.90')) {
        $os="Windows ME";
        }
        elseif (eregi('win',$Agent) && ereg('98',$Agent)) {
        $os="Windows 98";
        }
        elseif (eregi('win',$Agent) && eregi('nt 5.0',$Agent)) {
        $os="Windows 2000";
        }
        elseif (eregi('win',$Agent) && eregi('nt',$Agent)) {
        $os="Windows NT";
        }
        elseif (eregi('win',$Agent) && eregi('nt 5.1',$Agent)) {
        $os="Windows XP";
        }
        elseif (eregi('win',$Agent) && ereg('32',$Agent)) {
        $os="Windows 32";
        }
        elseif (eregi('linux',$Agent)) {
        $os="Linux";
        }
        elseif (eregi('unix',$Agent)) {
        $os="Unix";
        }
        elseif (eregi('sun',$Agent) && eregi('os',$Agent)) {
        $os="SunOS";
        }
        elseif (eregi('ibm',$Agent) && eregi('os',$Agent)) {
        $os="IBM OS/2";
        }
        elseif (eregi('Mac',$Agent) && eregi('PC',$Agent)) {
        $os="Macintosh";
        }
        elseif (eregi('PowerPC',$Agent)) {
        $os="PowerPC";
        }
        elseif (eregi('AIX',$Agent)) {
        $os="AIX";
        }
        elseif (eregi('HPUX',$Agent)) {
        $os="HPUX";
        }
        elseif (eregi('NetBSD',$Agent)) {
        $os="NetBSD";
        }
        elseif (eregi('BSD',$Agent)) {
        $os="BSD";
        }
        elseif (ereg('OSF1',$Agent)) {
        $os="OSF1";
        }
        elseif (ereg('IRIX',$Agent)) {
        $os="IRIX";
        }
        elseif (eregi('FreeBSD',$Agent)) {
        $os="FreeBSD";
        }
        if ($os=='') $os = "Unknown";
        return $os;
    }
//调用方法$os=os_infor() ;

    function DateAdd($date, $int, $unit = "d") { //时间的增加（还可以改进成时分秒都可以增加，有时间再补上）
    $dateArr = explode("-", $date);
    $value[$unit] = $int;
    return date("Y-m-d", mktime(0,0,0, $dateArr[1] + $value['m'], $dateArr[2] + $value['d'], $dateArr[0] + $value['y']));
    }
    function GetWeekDay($date) { //计算出给出的日期是星期几
    $dateArr = explode("-", $date);
    return date("w", mktime(0,0,0,$dateArr[1],$dateArr[2],$dateArr[0]));
    }


    function check_date($date)
    { //检查日期是否合法日期
        $dateArr = explode("-", $date);
        if (is_numeric($dateArr[0]) && is_numeric($dateArr[1]) && is_numeric($dateArr[2]))
        {
            return checkdate($dateArr[1],$dateArr[2],$dateArr[0]);
        }
        return false;
    }
    function check_time($time)
    { //检查时间是否合法时间
        $timeArr = explode(":", $time);
        if (is_numeric($timeArr[0]) && is_numeric($timeArr[1]) && is_numeric($timeArr[2]))
        {
            if (($timeArr[0] >= 0 && $timeArr[0] <= 23) && ($timeArr[1] >= 0 && $timeArr[1] <= 59) && ($timeArr[2] >= 0 && $timeArr[2] <= 59))
                return true;
            else
                return false;
        }
        return false;
    }


    /*
    * This function will change an array to a string with the seperator--"#**#".
    */
    function mappingDescrip($descriptionArry)
    {
        $Description_Separator="~#**#~";
        $Description_Field_Separator="~=~";
        $result = "";
        $arrayKeys = array_keys($descriptionArry);
        $arrayValues= array_values($descriptionArry);

        for($i=0;$i<count($descriptionArry) ; $i++)
        {
             $result = $result. $Description_Separator.$arrayKeys[$i].$Description_Field_Separator.$arrayValues[$i];
        }
        return $result;
    }

    /*
    *If a string contains the sub_string--~#**#~,
    *the function will seperate as the sub_string and return an array whose elements are the seprator.
    */
    function gerArrByDescrip($description)
    {
        $Description_Separator="~#**#~";
        $Description_Field_Separator="~=~";
        if(strlen($description) > 0 )
        {
            $arr=@explode($Description_Separator,$description);
            foreach($arr as $k=>$v)
            {
                if(!$v)continue;
                $data=@explode($Description_Field_Separator,$v);
                $new_arr[$data[0]]=$data[1];
            }
            return $new_arr;
        }
    }

    public static function mkdir_session($session_save_path)
    {
        $string = '0123456789abcdefghijklmnopqrstuvwxyz';
        $length = strlen($string);
        for($i = 0;$i<$length;$i++) {
          for($j = 0; $j<$length; $j++) {
           self::func_mkDir($session_save_path,$string[$i].'/'.$string[$j]);
          }
        }
    }
    /**
     * 自动创建文件夹
     *
     * @param unknown_type $sBasePath
     * @param unknown_type $sNewDir
     */
    public static function func_mkdir($sBasePath,$sNewDir)
    {
        $sBasePath=rtrim($sBasePath,'/');
        $sBasePath .= '/';
        $sTempPath = $sBasePath;
        $aNewDir=explode('/',$sNewDir);
        foreach ($aNewDir as $sDir)
        {
            if ($sDir!='.' and $sDir!='')
            {
                if (!file_exists($sTempPath.$sDir.'/'))
                {
                    @mkdir($sTempPath.$sDir.'/');
                    @chmod($sTempPath.$sDir.'/',0755);
                }
                $sTempPath=$sTempPath.$sDir.'/';
            }
        }
    }

    public static function catBstr($str,$start=0,$length=20)
    {
        $txt = (isset($str)&&($str!='')) ? strip_tags(html_entity_decode($str)):'';
        preg_match_all("~<B>([\s\S]+?)</B>~",html_entity_decode($str),$r);
        //print_r($r);
        $link=array();
        $map=array();
        if(!empty($r)) {
        foreach($r[0] as  $k=>$v){
            preg_match('~<B>([\s\S]+?)</B>~', $r[1][$k],$r2);
            $k2='<B>'.strip_tags($r[1][$k]).'</B>';
            $link[$k2]=strip_tags($r[1][$k]);
        }
        }
        $txt=str_replace('&nbsp;', ' ', $txt);
        $txt = self::utf8_substr($txt, $start, $length, true);
        $txt=str_replace(array_values($link),array_keys($link), $txt);
        return $txt;
    }

    public static function getUrl($key,$value){
        $url = $_SERVER['REQUEST_URI'];
        $url_info = parse_url($url);
        $url = $url_info['path'];

        $param = array();
        if(isset($url_info['query']))
        {
            parse_str($url_info['query'],$param);
        }
        $is_exit = 0;
        foreach ($param as $k=>&$v){
            if($k==$key){
                $is_exit = 1;
                $v=$value;
            }
        }
        if($is_exit==0){
            $param[$key]=$value;
        }
        return $url.'?'.http_build_query($param);
    }
    /**
      * Generates an UUID
      *
      * @author     jtg
      * @param      string  an optional prefix
      * @return     string  the formatted uuid
      */
    public static function uuid($prefix = '')
    {
        $chars = md5(uniqid(mt_rand(), true));
        $uuid  = substr($chars,0,8) . '-';
        $uuid .= substr($chars,8,4) . '-';
        $uuid .= substr($chars,12,4) . '-';
        $uuid .= substr($chars,16,4) . '-';
        $uuid .= substr($chars,20,12);
        return $prefix . $uuid;
    }

    public static function fillArc($im, $centerX, $centerY, $diameter, $start, $end, $color1,$color2,$text='',$placeindex=0)
    {
        $r=$diameter/2;
        $w=deg2rad((360+$start+($end-$start)/2)%360);
        if (function_exists("imagefilledarc")) {
                // exists only if GD 2.0.1 is avaliable
                imagefilledarc($im, $centerX+1, $centerY+1, $diameter, $diameter, $start, $end, $color1, IMG_ARC_PIE);
                imagefilledarc($im, $centerX, $centerY, $diameter, $diameter, $start, $end, $color2, IMG_ARC_PIE);
                imagefilledarc($im, $centerX, $centerY, $diameter, $diameter, $start, $end, $color1, IMG_ARC_NOFILL|IMG_ARC_EDGED);
        } else {
                imagearc($im, $centerX, $centerY, $diameter, $diameter, $start, $end, $color2);
                imageline($im, $centerX, $centerY, $centerX + cos(deg2rad($start)) * $r, $centerY + sin(deg2rad($start)) * $r, $color2);
                imageline($im, $centerX, $centerY, $centerX + cos(deg2rad($start+1)) * $r, $centerY + sin(deg2rad($start)) * $r, $color2);
                imageline($im, $centerX, $centerY, $centerX + cos(deg2rad($end-1))   * $r, $centerY + sin(deg2rad($end))   * $r, $color2);
                imageline($im, $centerX, $centerY, $centerX + cos(deg2rad($end))   * $r, $centerY + sin(deg2rad($end))   * $r, $color2);
                imagefill($im,$centerX + $r*cos($w)/2, $centerY + $r*sin($w)/2, $color2);
        }
        if ($text) {
                if ($placeindex>0) {
                        imageline($im,$centerX + $r*cos($w)/2, $centerY + $r*sin($w)/2,$diameter, $placeindex*12,$color1);
                        imagestring($im,4,$diameter, $placeindex*12,$text,$color1);

                } else {
                        imagestring($im,4,$centerX + $r*cos($w)/2, $centerY + $r*sin($w)/2,$text,$color1);
                }
        }
   }

   public static function duration($ts) {
    $time = time();
    $years = (int)((($time - $ts)/(7*86400))/52.177457);
    $rem = (int)(($time-$ts)-($years * 52.177457 * 7 * 86400));
    $weeks = (int)(($rem)/(7*86400));
    $days = (int)(($rem)/86400) - $weeks*7;
    $hours = (int)(($rem)/3600) - $days*24 - $weeks*7*24;
    $mins = (int)(($rem)/60) - $hours*60 - $days*24*60 - $weeks*7*24*60;
    $str = '';
    if($years==1) $str .= "$years year, ";
    if($years>1) $str .= "$years years, ";
    if($weeks==1) $str .= "$weeks week, ";
    if($weeks>1) $str .= "$weeks weeks, ";
    if($days==1) $str .= "$days day,";
    if($days>1) $str .= "$days days,";
    if($hours == 1) $str .= " $hours hour and";
    if($hours>1) $str .= " $hours hours and";
    if($mins == 1) $str .= " 1 minute";
    else $str .= " $mins minutes";
    return $str;
}
    /**
     *
     * @param <type> $days
     * @param <type> $time
     * @return string
     * @desc 转换excel里的时间列为php格式
     */
    public static function exceltimtetophp($days,$time=false)
    {
        if(is_numeric($days))
        {
            $jd = GregorianToJD(1, 1, 1970);
            $gregorian = JDToGregorian($jd+intval($days)-25569);
            $myDate = explode('/',$gregorian);
            $myDateStr= str_pad($myDate[2],4,'0', STR_PAD_LEFT)."-".str_pad($myDate[0],2,'0',STR_PAD_LEFT)."-".str_pad($myDate[1],2,'0', STR_PAD_LEFT).($time?"00:00:00":'');
            return $myDateStr;
        }
        return $time;
    }
    /**
     *
     * @param <type> $array
     * @return <type>
     * @desc 给数组按照由大到小的顺序排列
     */
    public static function sortarray($array)
    {
         $tmp = array();
         foreach ($array as $key=>$value)
         {
             foreach($array as $k=>$v)
             {
                 if($value > $v)$tmp[$key]=$value;
             }
         }
         return $tmp;
    }
    /**
     *
     * @param <type> $value
     * @return <type>
     * @desc 获得数据的分类类型
     */
    public static function getValueType($value)
    {
       $value = str_replace(' ', '', $value);
       if(preg_match('/hc_/', $value))
       {
           return 1;
       }else if(preg_match('/sha_000001/', $value))
       {
           return 4;
       }else if(preg_match('/world/', $value))
       {
           return 3;
       }else{
           return 2;
       }

    }
    /**
     *
     * @param <type> $value
     * @return <type>
     * @desc 获得数据的分类类型
     */
    public static function getStockCatByStockCode($stock)
    {
       $value = str_replace(' ', '', $stock);
       $pre = substr($stock, 0, 3);
       if($pre == '000')
       {
           return '深圳A股';
       }else if($pre == '001')
       {
           return '深圳A股';
       }else if($pre == '002')
       {
           return '中小企业板';
       }else if($pre == '300'){
           return '创业板';
       }else if($pre == '600'){
           return '上海A股';
       }else if($pre == '601'){
           return '上海A股';
       }else{
           return '未知类型';
       }

    }
    //仿js的escape函数
    function escape($str) {
        //匹配utf-8字符，
        preg_match_all("/[\xc2-\xdf][\x80-\xbf]+|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}|[\x01-\x7f]+/e", $str, $r);
        $str = $r[0];
        $l = count($str);
        for ($i = 0; $i < $l; $i++) {
            $value = ord($str[$i][0]);
            if ($value < 223) {
                //先将utf8编码转换为ISO-8859-1编码的单字节字符，urlencode单字节字符.
                //utf8_decode()的作用相当于iconv("UTF-8","CP1252",$v)。
                $str[$i] = rawurlencode(utf8_decode($str[$i]));
            } else {
                $str[$i] = "%u" . strtoupper(bin2hex(iconv("UTF-8", "UCS-2", $str[$i])));
            }
        }
        return join("", $str);
    }

    //仿js的unescape函数
    function unescape($str) {
        $ret = '';
        $len = strlen($str);
        for ($i = 0; $i < $len; $i++) {
            if ($str[$i] == '%' && $str[$i + 1] == 'u') {
                $val = hexdec(substr($str, $i + 2, 4));
                if ($val < 0x7f)
                    $ret .= chr($val);
                else if ($val < 0x800)
                    $ret .= chr(0xc0 | ($val >> 6)) . chr(0x80 | ($val & 0x3f));
                else
                    $ret .= chr(0xe0 | ($val >> 12)) . chr(0x80 | (($val >> 6) & 0x3f)) . chr(0x80 | ($val & 0x3f));
                $i += 5;
            }
            else if ($str[$i] == '%') {
                $ret .= urldecode(substr($str, $i, 3));
                $i += 2;
            }
            else
                $ret .= $str[$i];
        }
        return $ret;
    }

    /**
     *
     * @param <type> $str
     * @param <type> $args2
     * @desc 半角和全角转换函数，第二个参数如果是0,则是半角到全角；如果是1，则是全角到半角
     * @return <type>
     */
    public static function SBC_DBC($str, $args2) {
        $DBC = array(
            '０', '１', '２', '３', '４',
            '５', '６', '７', '８', '９',
            'Ａ', 'Ｂ', 'Ｃ', 'Ｄ', 'Ｅ',
            'Ｆ', 'Ｇ', 'Ｈ', 'Ｉ', 'Ｊ',
            'Ｋ', 'Ｌ', 'Ｍ', 'Ｎ', 'Ｏ',
            'Ｐ', 'Ｑ', 'Ｒ', 'Ｓ', 'Ｔ',
            'Ｕ', 'Ｖ', 'Ｗ', 'Ｘ', 'Ｙ',
            'Ｚ', 'ａ', 'ｂ', 'ｃ', 'ｄ',
            'ｅ', 'ｆ', 'ｇ', 'ｈ', 'ｉ',
            'ｊ', 'ｋ', 'ｌ', 'ｍ', 'ｎ',
            'ｏ', 'ｐ', 'ｑ', 'ｒ', 'ｓ',
            'ｔ', 'ｕ', 'ｖ', 'ｗ', 'ｘ',
            'ｙ', 'ｚ', '－', '　', '：',
            '．', '，', '／', '％', '＃',
            '！', '＠', '＆', '（', '）',
            '＜', '＞', '＂', '＇', '？',
            '［', '］', '｛', '｝', '＼',
            '｜', '＋', '＝', '＿', '＾',
            '￥', '￣', '｀'
        );
        $SBC = array(//半角
            '0', '1', '2', '3', '4',
            '5', '6', '7', '8', '9',
            'A', 'B', 'C', 'D', 'E',
            'F', 'G', 'H', 'I', 'J',
            'K', 'L', 'M', 'N', 'O',
            'P', 'Q', 'R', 'S', 'T',
            'U', 'V', 'W', 'X', 'Y',
            'Z', 'a', 'b', 'c', 'd',
            'e', 'f', 'g', 'h', 'i',
            'j', 'k', 'l', 'm', 'n',
            'o', 'p', 'q', 'r', 's',
            't', 'u', 'v', 'w', 'x',
            'y', 'z', '-', ' ', ':',
            '.', ',', '/', '%', '#',
            '!', '@', '&', '(', ')',
            '<', '>', '"', '\'', '?',
            '[', ']', '{', '}', '\\',
            '|', ' ', '=', '_', '^',
            '$', '~', '`'
        );
        if ($args2 == 0)
            return str_replace($SBC, $DBC, $str);  //半角到全角
        if ($args2 == 1)
            return str_replace($DBC, $SBC, $str);  //全角到半角
        else
            return false;
    }
    
    public static function microtime_float() {
        list($usec, $sec) = explode(" ", microtime());
        return ((float) $usec + (float) $sec);
    }

    public static function mkfile($file,$content)
    {
        $fp = fopen($file, "w"); //写方式打开文件
        fwrite($fp, $content); //存入内容
        fclose($fp); //关闭文件
        chmod($file, 0777);
        //print("文件不存在");  //文件不存在
    }
    public static function sendMail($from= "tjiang@gemantic.cn",$to = "tjiang@gemantic.cn",$title='主题',$content="<p>内容</p>")
    {
        try {
            $mail = new PHPMailer(true); //New instance, with exceptions enabled

            $body             = $content;
            $body             = preg_replace('/\\\\/','', $body); //Strip backslashes
            $mail->CharSet = "UTF-8";
            $mail->IsSMTP();                           // tell the class to use SMTP
            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->Port       = 25;                    // set the SMTP server port
            $mail->Host       = "mail.gemantic.cn"; // SMTP server
            $mail->Username   = "monitor";     // SMTP server username
            $mail->Password   = "gemantic";            // SMTP server password

            $mail->IsSendmail();  // tell the class to use Sendmail

            $mail->AddReplyTo("tjiang@gemantic.cn","出错报告！");

            $mail->From       = $from;
            $mail->FromName   = "xiaodi667";

            //$to = "tjiang@gemantic.cn"; //发送给谁

            $mail->AddAddress($to);
            $mail->AddCC("tjiang@gemantic.cn");//抄送给谁
            //$subject="测试邮件撒旦发苏打粉";
            //$mail->Subject  = "=?utf-8?B?" . base64_encode($subject) . "?=";
            $mail->Subject  = $title;
            $mail->AltBody    = "出错报告！"; // optional, comment out and test
            $mail->WordWrap   = 80; // set word wrap

            $mail->MsgHTML($body);

            $mail->IsHTML(true); // send as HTML

            $mail->Send();
            echo 'Message has been sent.';
        } catch (phpmailerException $e) {
                echo $e->errorMessage();
        }
    }
    public static $local_file = array();
    public static function showList($path)
    {
        if(is_dir($path))
        {
                $dp = dir($path);
                while($file=$dp->read())
                        if($file!='.'&&$file!='..')
                            self::showList($path.'/'.$file);
                $dp->close();
        }
        array_push(self::$local_file, $path);
        return self::$local_file;
    }
    public static function resizeImage($im,$maxwidth,$maxheight,$name,$filetype)
    {

        $pic_width = imagesx($im);
        $pic_height = imagesy($im);

        if(($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight))
        {
            if($maxwidth && $pic_width>$maxwidth)
            {
                $widthratio = $maxwidth/$pic_width;
                $resizewidth_tag = true;
            }

            if($maxheight && $pic_height>$maxheight)
            {
                $heightratio = $maxheight/$pic_height;
                $resizeheight_tag = true;
            }

            if($resizewidth_tag && $resizeheight_tag)
            {
                if($widthratio<$heightratio)
                {
                    $ratio = $widthratio;
                }
                else
                {
                    $ratio = $heightratio;
                }
            }

            if($resizewidth_tag && !$resizeheight_tag)
            {
                $ratio = $widthratio;
            }
            if($resizeheight_tag && !$resizewidth_tag)
            {
                $ratio = $heightratio;
            }

            $newwidth = $pic_width * $ratio;
            $newheight = $pic_height * $ratio;

            if(function_exists("imagecopyresampled"))
            {
                $newim = imagecreatetruecolor($newwidth,$newheight);
               imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
            }
            else
            {
                $newim = imagecreate($newwidth,$newheight);
               imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
            }
            $name = $name.$filetype;
            if($filetype == '.png' || $filetype == '.PNG')
            {
                imagepng($newim,$name);
            }
            else if($filetype == '.gif' || $filetype == '.GIF')
            {
                imagegif($newim,$name);
            }
            else
            {
                imagejpeg($newim,$name);
            }
            imagedestroy($newim);
        }
        else
        {
            $name = $name.$filetype;
            if($filetype == '.png' || $filetype == '.PNG')
            {
                imagepng($newim,$name);
            }
            else if($filetype == '.gif' || $filetype == '.GIF')
            {
                imagegif($newim,$name);
            }
            else
            {
                imagejpeg($im,$name);
            }

        }
    } 
     public static function quickSort($array)
    {

        if (count($array) <= 1) return $array;

        $key = $array[0];
        $left_arr = array();
        $right_arr = array();
        for ($i=1; $i<count($array); $i++)
        {
            if ($array[$i] <= $key)
            {
                $left_arr[] = $array[$i];
            }
            else
            {
                $right_arr[] = $array[$i];
            }
        }
        $left_arr = util::quickSort($left_arr);
        $right_arr = util::quickSort($right_arr);

        return array_merge($left_arr, array($key), $right_arr);
    }

    


}


