<?php
	session_start(); 
	$_SESSION["username"] = $_POST["username"];
	$username = $_SESSION["username"];

//查找用户是否已经上传了自己的头像
	$ds=opendir("userArea/user-icon");
	$user_icon_path = "";
	//循环遍历该目录下所有目录及文件
	while($file=readdir($ds)){
		//过滤无关文件
		if(!preg_match("/^\./",$file)){
			$fileArr = explode(".",$file);
			if($fileArr[0] == $username){
				$user_icon_path = "userArea/user-icon/".$file;	
			}
		}
	}//end while
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>主页·在线云盘系统</title>
<link rel="stylesheet" href="css/yahooInitial.css">
<link rel="stylesheet" href="css/mainPanel.css">
<script src="js/jquery-1.11.2.js"></script>
<script src="js/mainPanel.js"></script>
</head>
<body>
<!--顶部功能区-->
	<div id="main-item">
    	<div id="logo">
        	<img src="images/logo.png" alt="logo">
        </div>
        <div id="wangpan" class="itemBox">
        	<a href="#">网盘</a>
            <span></span>
        </div>
        <div id="guanyu" class="itemBox">
        	<a href="#">关于</a>
            <span></span>
        </div>
        <div id="user">
        	<div id="touxiang">
            	<?php
                	if($user_icon_path){
						echo "<img class='usersmallIcon' src='".$user_icon_path."'>";	
					}
				?>
            </div>
            <span>欢迎您,<?php echo $_SESSION['username'] ?></span>
        </div>
    </div>
    <!--用户资料卡-->
    <div id="userProfile">
    	<div id="smallTriangle"></div>
    	<div id="userPfile-head">
        	<div>
            	<?php
                	if($user_icon_path){
						echo "<img class='userIcon' src='".$user_icon_path."'>";	
					}
				?>
            </div>
            <span><?php echo $_SESSION['username'] ?></span>
        </div>
        <a id="personInfo">个人资料</a>
        <a id="changeAvatar">更换头像</a>
        <a id="helpCenter">帮助中心</a>
        <a id="logout">退出登陆</a>
    </div>
    
<!--左侧功能区-->
    <div id="left-side">
    	<a class="left-item" id="allfile" style="background:rgba(128,128,128,0.2);">
        	<img src="images/allfile.png" alt="allfile"/>
        	<span>全部文件</span>
        </a>
        <a class="left-item" id="docs">
        	<img src="images/doc.png" alt="doc"/>
        	<span>文档</span>
        </a>
        <a class="left-item" id="pics">
        	<img src="images/pic.png" alt="pic"/>
        	<span>图片</span>
        </a>
        <a class="left-item" id="videos">
        	<img src="images/vedio.png" alt="vedio"/>
        	<span>视频</span>
        </a>
        <a class="left-item" id="musics">
        	<img src="images/music.png" alt="music"/>
        	<span>音乐</span>
        </a>
        
        <!--显示当前用户存储用量-->
        <div id="DiskUsage">
        	<div title="hello">
            	<a id="percentage" title="hello"></a>
            </div>
            <span id="used"></span>
            <span id="allVolume">总量:1G</span>
        </div>
    </div>


<!--右侧框架区-->
	<div id="right-side">
    	<iframe src="frameset/wangpan.php" width="100%" height="100%" frameborder="0" noresize="noresize" scrolling="no"></iframe>
    </div>

</body>
</html>