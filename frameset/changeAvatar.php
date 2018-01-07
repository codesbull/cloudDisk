<?php
header("content-type:text/html;charset=utf-8");

	session_start();
	$username = $_SESSION["username"];
	$ds=opendir("../userArea/user-icon");
	$user_icon_path = "";
	//循环遍历该目录下所有目录及文件
	while($file=readdir($ds)){
		//过滤无关文件
		if(!preg_match("/^\./",$file)){
			$fileArr = explode(".",$file);
			if($fileArr[0] == $username){
				$user_icon_path = "../userArea/user-icon/".$file;	
			}
		}
	}//end while
	

//接收并处理用户上传到此的文件
	if(@$_GET["SIGN"] == "UPLOADICON"){

		//临时上传路径、目的路径
		$tmpfile=$_FILES[$username]["tmp_name"];
		$iconfile = $_FILES[$username]["name"];
		
		//判断用户上传的文件是否为图片文件，若不是，报错，退出执行
		$iconfileArr = explode(".",$iconfile);
		$suffixArr = array("bmp","pcx","png","jpeg","jpg","gif","tiff","dxf","cgm","cdr","wmf","eps","emf","pict","ico","icon");
		for($i=0; $i<count($suffixArr); $i++){
			if($suffixArr[$i] == $iconfileArr[1]){
				//如果存在之前用户上传头像，删除
				if($user_icon_path){
					unlink($user_icon_path);
				}
				//移动上传文件至正确目录下
				move_uploaded_file($tmpfile,"../userArea/user-icon/".$iconfile);
				//$user_icon_path = "../userArea/user-icon/".$iconfile;
				//将上传的头像文件改名为用户名
				rename("../userArea/user-icon/".$iconfile,"../userArea/user-icon/".$username.".".$iconfileArr[1]);
				//刷新当前页面
				echo "<script language=JavaScript> location.replace(location.href);</script>";
				exit();   //退出程序执行	
			}
		}//end for loop
		echo "alert('您上传的文件不是图像文件，上传失败！')";
	}//end if
	
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>personInfo</title>
<link rel="stylesheet" href="../css/yahooInitial.css">
<style>
	#title{
		height:80px;
		line-height:80px;
		font-size:18px;
		letter-spacing:3px;
		text-align:center;
		margin-bottom:20px;
		background:#6CC;
	}
	#iconPrompt{
		height:150px;
		font-size:15px;
		margin-left:70px;
	}
	#iconPrompt span{
		font-size:13px;
		color:gray;	
	}
	.userIcon{
		display:block;
		width:120px;
		height:120px;
		margin-left:160px;
	}
	
	/*更改头像*/
	#changeIcon{
		height:50px;
		margin:20px 0px 0px 70px;
		font-size:15px;
	}
	#uploadFileForm{
		margin-left:70px;	
	}
	
</style>
</head>

<body>
	 <div id="title">更换头像</div>
     <div id="iconPrompt">
     	您当前正使用的头像为:
        <?php 
			if($user_icon_path){
				echo "<span> 用户自定义头像</span>";
				echo "<img class='userIcon' src='".$user_icon_path."'>";	
			}else{
				echo "<span> 系统默认头像</span>";
				echo "<div class='userIcon' style='background:orange;'></div>";
			}
		?>
     </div>
     <div id="changeIcon">
     	更改头像:
         <form id="uploadFileForm" action="changeAvatar.php?SIGN=UPLOADICON" method="post" enctype="multipart/form-data" target="nm_iframe">
            <input type="file" id="chooseFileBtn" name=<?php echo $_SESSION["username"]?>><br/>
            <input type="submit" id="submitBtn" value="上传">
    	</form>
        <iframe id="nm_iframe" name="nm_iframe" style="display:none;"></iframe>
     </div>
</body>
</html>