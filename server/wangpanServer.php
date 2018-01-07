<?php
	header("content-type:text/html;charset=utf-8");
	session_start();
	$user = $_SESSION["username"];
	$not_inUser = $_POST["uploadPath"];
	
	
	//临时上传路径、目的路径
	$tmpfile=$_FILES[$user]["tmp_name"];
	$dstpath="../userArea/".$user;
	$dstname = $_FILES[$user]["name"];
	
	
	//判断用户是否存储空间已满,如满，终止本次上传，回传错误
	$userUsed = $_SESSION["userUsed"] + filesize($tmpfile);
	

	//判断是否在用户根目录
	if($not_inUser){
		$dstpath="../userArea/".$user."/".$not_inUser;
	}

	//文件名查重处理
	$ds1=opendir($dstpath);
	$dstnameArr = explode(".",$dstname);
	
	while($file1=readdir($ds1)){
		if($dstname == $file1){
			$dstname = $dstnameArr[0]."(1).".$dstnameArr[1];
			break;
		}
	}
	
	//多个文件重名处理
	$ds2=opendir($dstpath);
	static $number = 0;
  	while($file=readdir($ds2)){
		$pat = "/".$dstnameArr[0]."\((.*?)\)/";
		$fileArr = explode(".",$file);
		if($fileArr[1] == $dstnameArr[1] && preg_match($pat,$fileArr[0],$matches)){
			if($matches[1] > $number){
				$number = $matches[1];
			}
		}
	}
	
	//判断是否存在多个文件重名
	if($number){
		$number += 1;
		$dstname = $dstnameArr[0]."(".$number.").".$dstnameArr[1];	
	}

	//目的路径
	$dst = $dstpath."/".$dstname;

	//移动上传文件至正确目录下
	move_uploaded_file($tmpfile,$dst);
	
	//$number 重置为0，便于下次使用
	$number = 0;


?>