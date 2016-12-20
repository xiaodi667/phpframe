<?php

class upload
{ 
	public $length; //限定文件大小 false=>不限制
	public $file; //判断此类是用于图片上传还是文件上传 
	public $fileName; //文件名 
	public $fileTemp; //上传临时文件 
	public $fileSize; //上传文件大小 
	public $error; //上传文件是否有错,php4没有 
	public $fileType; //上传文件类型 
	public $directory; // 
	public $maxLen; 
	public $errormsg;
	public $is_fastdfs;//是否上传到fastdfs
 
	function __construct($length = 1024,$file = true,$directory = '/',$is_fastdfs = true) 
	{ 
		$this->maxLen     = $length; 
		$this->length     = $length * 1024; 
		$this->file       = $file; //true为一般文件，false为图片的判断 
		$this->directory  = $directory; 
		$this->is_fastdfs = $is_fastdfs;
	} 
	public function upLoadFile($fileField) 
	{ 
		$this->fileName = $fileField['name']; 
		$this->fileTemp = $fileField['tmp_name']; 
		$this->error    = $fileField['error']; 
		$this->fileType = $fileField['type']; 
		$this->fileSize = $fileField['size']; 
                $pathSign       = DIRECTORY_SEPARATOR; // / 
                if($this->file) //一般文件上传 
                { 
                	$path = $this->isCreatedDir($this->directory);//取得路径 
			if($path)
			{ 
				$createFileType = $this->getFileType($this->fileName);//设置文件类别 
				//$createFileName = uniqid(rand()); //随机产生文件名 
				$createFileName = md5($this->fileName); //随机产生文件名 
				$thisDir        = $this->directory . $pathSign . $createFileName . "." . $createFileType; 
				if(@move_uploaded_file($this->fileTemp,$thisDir)) //把临时文件移动到规定的路径下 
				{       
					if($this->is_fastdfs)
					{ 
						$fdfs = new FastDFS();
        					//$tracker = $fdfs->tracker_get_connection();
						$file_info = $fdfs->storage_upload_by_filename($thisDir);
                				$new_url = $file_info['group_name'] . DIRECTORY_SEPARATOR . $file_info['filename'];
						$download = array();
               					$download['name']      = $this->fileName;
                				$download['crc_md5']   = md5_file($thisDir);
                				$download['create_at'] = time()*1000;
                				$download['type']      = $this->fileType;
               					$download['size']      = $this->fileSize;
                				$download['path']      = $new_url;                
                				$file_infos = $fdfs->get_file_info1($new_url);
                				$download['crc']      = $file_infos['crc32'];
                				app_download::add($download);
                				$fdfs->tracker_close_all_connections();
						return $new_url;	
					}
					else
					{
						return $thisDir; 
					}
				} 
			} 
		}
		else
		{ //图片上传 
			$path = $this->isCreatedDir($this->directory);//取得路径 
			if($path)//路径存在 
			{ 
				$createFileType = $this->getFileType($this->fileName);//设置文件类别 
				$createFileName=uniqid(rand()); 
				return @move_uploaded_file($this->fileTemp,$this->directory.$pathSign.$createFileName.".".$createFileType) ? true : false; 
			} 
		} 
	} 
	public function _isBig($length,$fsize) //返回文件是否超过规定大小 
	{ 
		return $fsize>$length ? true : false; 
	} 
	public function getFileType($fileName) //获得文件的后缀 
	{ 
		return end(explode(".",$fileName)); 
	} 
	public function isImg($fileType) //上传图片类型是否允许 
	{ 
		$type=array("jpeg","gif","jpg","bmp"); 
		$fileType=strtolower($fileType); 
		$fileArray=explode("/",$fileType); 
		$file_type=end($fileArray); 
		return in_array($file_type,$type); 
	} 
	public function isCreatedDir($path) //路径是否存在，不存在就创建 
	{ 
		if(!file_exists($path)) 
		{ 
			return @mkdir($path,0755) ? true : false; //权限755// 
		} 
		else 
		{ 
			return true; 
		} 
	}
        /**
         * 压缩图片不失真
         * @param <type> $im
         * @param <type> $maxwidth
         * @param <type> $maxheight
         * @param <type> $name
         * @param <type> $filetype
         */
        public function resizeImage($im,$maxwidth,$maxheight,$name,$filetype)
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
                imagejpeg($newim,$name);
                imagedestroy($newim);
            }
            else
            {
                $name = $name.$filetype;
                imagejpeg($im,$name);
            }
        }
	/**
	* 错误信息处理
	* 
	*/
	public function showError() //显示错误信息 
	{
		throw new Exception($this->errormsg);
	} 
} 
