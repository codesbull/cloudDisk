<?php 
	session_start();
	$deleteString = $_POST["deleteString"];
	
	//将待删除字符串分割成数组
	$deleteArr = explode(">",$deleteString);
	
	//递归函数，递归删除目录内所有文件	
	function deldir($dirname){
		$ds=opendir($dirname);
		while($file=readdir($ds)){
			$path=$dirname."/".$file;
			if(!preg_match("/^\./",$file)){
				if(is_dir($path)){
					deldir($path);
				}else{
					unlink($path);//删除文件
				}
			}
		}
		closedir($ds);
		rmdir($dirname);
	}
	
	//循环数组，删除所有待删除字符串
	for($i=0; $i<count($deleteArr); $i++){
		if(is_dir($deleteArr[$i])){
			//递归删除该目录
			deldir($deleteArr[$i]);	
		}else{
			//删除文件
			unlink($deleteArr[$i]);
		}
	}
	
?>