<?php
	session_start();
	$userPath = $_POST["path"];
	//设置为中国时区,其中PRC为“中华人民共和国”
	date_default_timezone_set('PRC');
	
	//判断用户需要查看的目录为用户根目录还是子目录
	if($userPath == "isUser"){
		$userPath = $_SESSION["username"];
	}else{
		$userPath = $_SESSION["username"]."/".$userPath;
	}

	//待遍历的文件目录
	$dirname="../userArea/".$userPath;
	
	//递归函数，迭代计算文件夹大小
	 function totdir($dirname){
	 	static $tot=0;//静态变量
	 	$ds=opendir($dirname);
	 	while($file=readdir($ds)){
			$path=$dirname."/".$file;
			if(!preg_match("/^\./",$file)){
				if(is_dir($path)){
					totdir($path);
				 }else{
					$tot += filesize($path);
				 }
			}
	  	}
	  	return $tot." Byte";
	}
	//计算机文件大小函数
	function file_size($filename){
		if(filesize($filename)){
			return filesize($filename)." Byte";	
		}else{
			return "0 Byte";	
		}
	}
	
	
	//遍历文件目录
	function listDir($dirname){
		$data = "";
		$ds=opendir($dirname);
		//循环遍历该目录下所有目录及文件
		while($file=readdir($ds)){
			$path=$dirname."/".$file;
			//过滤无关文件
			if(!preg_match("/^\./",$file)){
				if(is_dir($path)){
					$data .= "D>".$file.">".totdir($path).">".date("Y-m-d H:i:s",filemtime($path))."|";
				 }else{
					$data .= "F>".$file.">".file_size($path).">".date("Y-m-d H:i:s",filemtime($path))."|";
				 }
			}
		}//end while
		echo $data;
 	}
	
	listDir($dirname);
?>