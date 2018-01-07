<?php 

	session_start();
	$user = $_SESSION["username"];
	$userPath = "../userArea/".$user;
	
	//定义回传字符串
	$data = "";
	
	//记录匹配到的文件个数、以及该类型文件总大小
	$recordNumber = 0;
	$recordSizes = 0;

	//定义后缀数组
	$suffixArr = array();
	
	
	if(@$_GET["Item"] == "MUSICS"){
		$suffixArr = array("cd","ogg","mp3","asf","wma","wav","mp3pro","rm","real","module","midi","vqf");
		searchAll($userPath);   //调用
		$_SESSION["MUSICS"] = $recordNumber;
		$_SESSION["MUSICS_SIZE"] = $recordSizes;
		echo $data;  //回传数据
	}else if(@$_GET["Item"] == "PICS"){
		$suffixArr = array("bmp","pcx","png","jpeg","jpg","gif","tiff","dxf","cgm","cdr","wmf","eps","emf","pict","ico","icon");
		searchAll($userPath);   //调用
		$_SESSION["PICS"] = $recordNumber;
		$_SESSION["PICS_SIZE"] = $recordSizes;
		echo $data;  //回传数据
		
	}else if(@$_GET["Item"] == "VIDEOS"){
		$suffixArr = array("avi","rmvb","rm","asf","divx","mpg","mpeg","mpe","wmv","mp4","mkv","vob","mov","flv","qt");
		searchAll($userPath);   //调用
		$_SESSION["VIDEOS"] = $recordNumber;
		$_SESSION["VIDEOS_SIZE"] = $recordSizes;
		echo $data;  //回传数据
		
	}else if(@$_GET["Item"] == "DOCS"){
		$suffixArr = array("doc","txt","docx","rtf","html","htm","pdf","rar","zip","wri","z","css");
		searchAll($userPath);   //调用
		$_SESSION["DOCS"] = $recordNumber;
		$_SESSION["DOCS_SIZE"] = $recordSizes;
		echo $data;  //回传数据
	}
	
	//遍历文件目录
	function searchAll($dirname){
		global $suffixArr;
		$ds=opendir($dirname);
		while($file=readdir($ds)){
			if(!preg_match("/^\./",$file)){
				$path=$dirname."/".$file;
				if(is_dir($path)){
					searchAll($path);
				}else{
					//拆分$file
					$fileArr = explode(".",$file);
					$suffix = array_pop($fileArr);
					for($i=0; $i<count($suffixArr); $i++){
						if($suffixArr[$i] == strtolower($suffix)){
							global $data;
							global $recordNumber;
							global $recordSizes;
							$data .= $file.">".filesize($path)." Byte>".date("Y-m-d H:i:s",filemtime($path)).">".$path."|";
							$recordNumber++;
							$recordSizes += filesize($path);
							break;
						}
					}//end for loop
				}//end else
			}//end if
		}//end while
 	}
	
?>