<?php
	session_start();
	$user = $_SESSION["username"];
	$searchKey = $_POST["searchFile"];
	$userPath = "../userArea/".$user;
	
	//定义回传字符串
	$data = "";
	
	//定义搜索样式
	$pat = "/".$searchKey."/";
	
	//遍历文件目录
	function searchAll($dirname,$pat){
		$ds=opendir($dirname);
		while($file=readdir($ds)){
			if(!preg_match("/^\./",$file)){
				$path=$dirname."/".$file;
				if(is_dir($path)){
					searchAll($path,$pat);
				}else if(preg_match($pat,$file)){
					global $data;
					$data .= $file.">".filesize($path)." Byte>".date("Y-m-d H:i:s",filemtime($path)).">".$path."|";
				}
			}//end if
		}//end while
 	}

	//调用
	searchAll($userPath,$pat);
	
	//回传数据
	echo $data;
?>