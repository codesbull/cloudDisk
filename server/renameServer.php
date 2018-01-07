<?php 


	$newName = $_POST["newName"];
	$renamePath = $_POST["renamePath"];
	
	//文件路径拆分处理
	$fileArr = explode("/",$renamePath);
	$file_name = array_pop($fileArr);
	$file_path = implode("/",$fileArr);
	
	
	//重命名对象为文件夹
	if(is_dir(renamePath)){
		$ds=opendir($file_path);
		while($file=readdir($ds)){
			if(is_dir($file) && $file == $newName){
				echo "hasSameFile";
				exit();
			}
		}
		rename($renamePath,$file_path."/".$newName);
	}else{	//重命名对象为文件
	
		$file_name_Arr = explode(".",$file_name);
		$file_name = $newName.".".$file_name_Arr[1];
		//文件名查重处理
		$ds=opendir($file_path);
		while($file=readdir($ds)){
			if($file == $file_name){
				echo "hasSameFile";
				exit();	
			}
		}
		rename($renamePath,$file_path."/".$newName);
	}
	

?>