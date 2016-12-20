<?php
//递归方式的对变量中的特殊字符进行转义
function addslashes_deep($value){
    if (empty($value)){
        return $value;
    }else{
        return is_array($value) ? array_map('addslashes_deep', $value) : addslashes($value);
    }
}

//递归方式对对变量进行htmlspecialchars转义
function htmlchars($value)
{
    if (empty($value))
    {
        return $value;
    }
    else
    {
        return is_array($value) ? array_map('htmlchars', $value) : converchars(htmlspecialchars(trim($value),ENT_QUOTES));
        //return is_array($value) ? array_map('htmlchars', $value) : (htmlspecialchars(trim($value),ENT_QUOTES));
    }
}

function converchars($value)
{
    $value = str_replace('&lt;', '<', $value);
    $value = str_replace('&gt;', '>', $value);
    $value = str_replace('&amp;', '&', $value);
    $value = str_replace('&middot;','·',$value);
    $value = str_replace('&rsquo;',"'",$value);
    $value = str_replace('&lsquo;',"'",$value);
    $value = str_replace('&quot;',"\"",$value);
    $value = str_replace('&ldquo;',"“",$value);
    $value = str_replace('&rdquo;',"”",$value);
    $value = str_replace('&bull;','•',$value);
    $value = str_replace('&mdash;','—',$value);
    $value = str_replace('&nbsp;',' ',$value);
    $value = str_replace('&hellip;','...',$value);
    return $value;
}

/**
 +----------------------------------------------------------
 * 字符串截取，支持中文和其他编码
 +----------------------------------------------------------
 * @param $fStr 需要转换的字符串
 * @param $fStart 开始位置
 * @param $fLen 截取长度
 * @param $fCode 编码格式
 * @param $show 截断显示字符
 * @version 1.0
 +----------------------------------------------------------
 */
function msubstr (&$fStr, $fStart, $fLen, $fCode = "utf-8",$show='...')
{
        if(function_exists('mb_substr'))
        {
                if(mb_strlen($fStr,$fCode)>$fLen)
                {
                        return mb_substr ($fStr,$fStart,$fLen,$fCode).$show;
                }
                return mb_substr ($fStr,$fStart,$fLen,$fCode);
        }else if(function_exists('iconv_substr')) {
                if(iconv_strlen($fStr,$fCode)>$fLen) {
                        return iconv_substr ($fStr,$fStart,$fLen,$fCode).$show;
                }
                return iconv_substr ($fStr,$fStart,$fLen,$fCode);
        }

        $fCode = strtolower($fCode);
        switch ($fCode) {
                case "utf-8" :
                        preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $fStr, $ar);
                        if(func_num_args() >= 3)
                        {
                                if (count($ar[0])>$fLen)
                                {
                                        return join("",array_slice($ar[0],$fStart,$fLen)).$show;
                                }
                                return join("",array_slice($ar[0],$fStart,$fLen));
                        } else {
                                return join("",array_slice($ar[0],$fStart));
                        }
                        break;
                default:
                        $fStart = $fStart*2;
                        $fLen   = $fLen*2;
                        $strlen = strlen($fStr);
                        for ( $i = 0; $i < $strlen; $i++ )
                        {
                                if ( $i >= $fStart && $i < ( $fStart+$fLen ) )
                                {
                                        if ( ord(substr($fStr, $i, 1)) > 129 ) $tmpstr .= substr($fStr, $i, 2);
                                        else $tmpstr .= substr($fStr, $i, 1);
                                }
                                if ( ord(substr($fStr, $i, 1)) > 129 ) $i++;
                        }
                        if ( strlen($tmpstr) < $strlen ) $tmpstr .= $show;
                        Return $tmpstr;
        }
}





function shorturl($url='', $prefix='', $suffix='')
{
	$base32 = array (
	'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
	'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p',
	'q', 'r', 's', 't', 'u', 'v', 'w', 'x',
	'y', 'z', '0', '1', '2', '3', '4', '5');

	$hex = md5($prefix.$url.$suffix);
	$hexLen = strlen($hex);
	$subHexLen = $hexLen / 8;
	$output = array();

	for ($i = 0; $i < $subHexLen; $i++)
	{
		$subHex = substr ($hex, $i * 8, 8);
		$int = 0x3FFFFFFF & (1 * ('0x'.$subHex));
		$out = '';
		for ($j = 0; $j < 6; $j++)
		{
			$val = 0x0000001F & $int;
			$out .= $base32[$val];
			$int = $int >> 5;
		}
		$output[] = $out;
	}
	return $output;
}


/**
* PHP 年龄计算函数
*
* 参数支持数组传参和标准的 Mysql date 类型传参
* params sample
* --------------------------------------------------
$birthArr = array(
'year' => '2000',
'month' => '11',
'day' => '3'
);
$birthStr = '2000-11-03';
* --------------------------------------------------
* );
* @author jtg
* @param string|array $birthday
* @return number $age
*/
function get_age($birthday)
{
    $age = 0;
    $year = $month = $day = 0;
    if (is_array($birthday))
    {
        extract($birthday);
    }
    else
    {
        if (strpos($birthday, '-') !== false)
        {
            list($year, $month, $day) = explode('-', $birthday);
            $day = substr($day, 0, 2); //get the first two chars in case of '2000-11-03 12:12:00'
        }
    }
    $age = date('Y') - $year;
    if (date('m') < $month || (date('m') == $month && date('d') < $day)) $age--;
    return $age;
}


    /* 函数 listDirTree( $dirName = null )
** 功能 列出目录下所有文件及子目录
** 参数 $dirName 目录名称
** 返回 目录结构数组 false为失败
*/
function listDirTree( $dirName = null )
{
    if( empty( $dirName ) )
    {
        exit( "IBFileSystem: directory is empty." );
    }
    if( is_dir( $dirName ) )
    {
        if( $dh = opendir( $dirName ) )
        {
            $tree = array();
            while( ( $file = readdir( $dh ) ) !== false )
            {
                if( $file != "." && $file != ".." )
                {
                    $filePath = $dirName . "/" . $file;
                    if( is_dir( $filePath ) ) //为目录,递归
                    {
                        $tree[$file] = listDirTree( $filePath );
                    }
                    else //为文件,添加到当前数组
                    {
                        $tree[] = $file;
                    }
                }
            }
            closedir( $dh );
        }
        else
        {
            exit( "IBFileSystem: can not open directory $dirName.");
        }
        //返回当前的$tree
        return $tree;
    }
    else
    {
        exit( "IBFileSystem: $dirName is not a directory.");
    }
}

function read_all_dir ( $dir )
    {
        $result = array();
        $handle = opendir($dir);
        if ( $handle )
        {
            while ( ( $file = readdir ( $handle ) ) !== false )
            {
                if ( $file != '.' && $file != '..')
                {
                    $cur_path = $dir . DIRECTORY_SEPARATOR . $file;
                    if ( is_dir ( $cur_path ) )
                    {
                        $result['dir'][$cur_path] = read_all_dir ( $cur_path );
                    }
                    else
                    {
                        $result['file'][] = $cur_path;
                    }
                }
            }
            closedir($handle);
        }
        return $result;
    }

    function dir_path($path) {
$path = str_replace('\\', '/', $path);
if (substr($path, -1) != '/') $path = $path . '/';
return $path;
}
/**
* 列出目录下的所有文件
*
* @param str $path 目录
* @param str $exts 后缀
* @param array $list 路径数组
* @return array 返回路径数组
*/
function dir_list($path, $exts = '', $list = array())
{
    $path = dir_path($path);
    $files = glob($path . '*');
    foreach($files as $v)
    {
        if (!$exts || preg_match("/\.($exts)/i", $v))
        {
            $list[] = $v;
            if (is_dir($v))
            {
                $list = dir_list($v, $exts, $list);
            }
        }
    }
    return $list;
}
function get_extension($file)
{
    return substr(strrchr($file, '.'), 1);
}
function traverse($path = '.')
{
    $current_dir = opendir($path);    //opendir()返回一个目录句柄,失败返回false
    while(($file = readdir($current_dir)) !== false) {    //readdir()返回打开目录句柄中的一个条目
        $sub_dir = $path . DIRECTORY_SEPARATOR . $file;    //构建子目录路径
        echo "<tr class='h1'>";
        if($file == '.' || $file == '..' || $file == '.svn') {
            //echo '<a href="/?page=dirs&path='.$path.'/'.$file.'">..</a>';
            continue;
        } else if(is_dir($sub_dir)) {    //如果是目录,进行递归
           
            
            echo '<td>'.'目录:'.'<a href="/?page=dirs&path='.$path.'/'.$file.'" target="_self">'.$file.'</a></td>';

            //traverse($sub_dir);
        } 
        else
        {    //如果是文件,直接输出
            $ext = get_extension($file);
            if($ext == 'jpg' || $ext == 'png' || $ext == 'gif' || $ext == 'jpeg')
            {
                $tmpKey = (WP_ENV == 'local') ? 'remote' : 'remote_' . WP_ENV;
                if($tmpKey == 'remote_staginga')
                {
                    $realpath = str_replace('/data/staging.res.jinhui365.com','http://staging.res.jinhui365.com',$path.'/'.$file);
                    
                }
                else if($tmpKey == 'remote_productiona')
                {
                    $realpath = str_replace('/data/res.jinhui365.com','http://res.jinhui365.com',$path.'/'.$file);
                }
                else
                {
                    $realpath = $path.'/'.$file;
                }
                    echo '<td>'.'<img src=' .$realpath." width='100px' height='80px'  /img> ". $file ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".'</td>'.'<td>'.'扩展名:'.$ext."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".'</td>'.'<td>'."<a href='/?page=dirs&action=replacefile&file=".$file."&path=".$path.'/'.$file."' target='_blank'>替换</a>".'</td>';
            }
            else if($ext == 'php')
            {
                    
            }
            else if ($ext == 'css' || $ext == 'js')
            {
                echo '<td>' . $file ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".'</td>'.'<td>'."扩展名:'.$ext"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."</td>".'<td>'."<a href='/?page=dirs&action=editfile&file=".$file."&path=".$path.'/'.$file."'>修改</a>".'</td>';
            }
            else
            {
                echo '<td>' . $file ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".'</td>'.'<td>'.'扩展名:'.$ext."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".'</td>';
            }
        }
        echo "</tr>";   
    }

}
/**
 *
 * @desc xss过滤
 * @time 20150228
 * @param <type> $val
 * @return <type>
 */
function removeXss($val)
{
   // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
   // this prevents some character re-spacing such as <java\0script>
   // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
   $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);

   // straight replacements, the user should never need these since they're normal characters
   // this prevents like <IMG SRC=@avascript:alert('XSS')>
   $search = 'abcdefghijklmnopqrstuvwxyz';
   $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $search .= '1234567890!@#$%^&*()';
   $search .= '~`";:?+/={}[]-_|\'\\';
   for ($i = 0; $i < strlen($search); $i++)
   {
      // ;? matches the ;, which is optional
      // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars

      // @ @ search for the hex values
      $val = preg_replace('/(&#[xX]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ;
      // @ @ 0{0,7} matches '0' zero to seven times
      $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ;
   }

   // now the only remaining whitespace attacks are \t, \n, and \r
   $ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
   $ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
   $ra = array_merge($ra1, $ra2);

   $found = true; // keep replacing as long as the previous round replaced something
   while ($found == true)
   {
      $val_before = $val;
      for ($i = 0; $i < sizeof($ra); $i++)
      {
         $pattern = '/';
         for ($j = 0; $j < strlen($ra[$i]); $j++)
         {
            if ($j > 0)
            {
               $pattern .= '(';
               $pattern .= '(&#[xX]0{0,8}([9ab]);)';
               $pattern .= '|';
               $pattern .= '|(&#0{0,8}([9|10|13]);)';
               $pattern .= ')*';
            }
            $pattern .= $ra[$i][$j];
         }
         $pattern .= '/i';
         $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag
         $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
         if ($val_before == $val)
         {
            // no replacements were made, so exit the loop
            $found = false;
         }
      }
   }
   return $val;
}  


