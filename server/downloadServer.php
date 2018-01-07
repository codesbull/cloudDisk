<?php
	
	$downloadString = $_POST["downloadString"];
	
	//判断下载对象是否为目录，如是，退出，以下不执行
	if(is_dir($downloadString)){
		exit();
	}
	
	//获得待下载文件的文件名、大小、文件类型
	$file_type = filetype($downloadString); 
	$file_size = filesize($downloadString);
	$fileArr = explode("/",$downloadString);
	$file_name = array_pop($fileArr);

	//下载文件
	header("Content-type: $file_type");
	header("Content-Disposition: attachment;filename=$file_name");
	//header("content-length:$file_size");
	
	echo readfile($downloadString);

?>