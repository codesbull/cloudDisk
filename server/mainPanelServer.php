<?php 

	session_start();
	$userFolder = "../userArea/".$_SESSION["username"];
	$filesNumber = 0;
	
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
					 global $filesNumber;
					 $filesNumber++;
					$tot += filesize($path);
				 }
			}
	  	}
	  	return $tot;
	}
	
	//调用执行,回传结果
	$_SESSION["userUsed"] = totdir($userFolder);
	$_SESSION["ALLFILES"] = $filesNumber;
	echo $_SESSION["userUsed"];
	
?>