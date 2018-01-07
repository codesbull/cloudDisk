<?php 
	session_start();
	$username = $_SESSION["username"];
	
	$userUsed = calTol($_SESSION["userUsed"]);
	$docs_size = calTol($_SESSION["DOCS_SIZE"]);
    $pics_size = calTol($_SESSION["PICS_SIZE"]);
    $videos_size = calTol($_SESSION["VIDEOS_SIZE"]);
    $musics_size = calTol($_SESSION["MUSICS_SIZE"]);
	
	
	function calTol($val){
		//获取并计算用户空间使用量
		$Used = intval($val);
		if($Used > 1048576){
			$Used = round(($Used / 1048576),1)."MB";
		}else if($Used > 1024){
			$Used = round(($Used / 1024),1)."KB";
		}else{
			$Used .= "Byte";
		}
		return $Used;
	}
	
//遍历找到用户头像
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
		background:#CF0;
		margin-bottom:20px;
	}
	.baseInfo{
		height:30px;
		line-height:30px;
		font-size:15px;
		margin:0px 0px 12px 70px;
	}
	/*用户头像*/
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
	/*用户文件表格*/
	#userfileTable{
		height:200px;
	}
	#userfileTable span{
		display:block;
		width:inherit;
		font-size:15px;
		margin:10px 0px 10px 70px;	
	}
	#userfileTable table{
		margin-left:200px;	
	}
	#userfileTable td{
		width:100px;
		height:40px;
		border:1px solid black;
		text-align:center;	
	}
	
</style>
</head>

<body>
	 <div id="title">个人资料</div>
     <div class="baseInfo">用户ID:&nbsp;&nbsp;<?php echo $_SESSION["username"]?></div>
     <div class="baseInfo">用户空间总量:&nbsp;&nbsp;1G</div>
     <div class="baseInfo">用户空间已使用总量:&nbsp;&nbsp;<?php echo $_SESSION["userUsed"]." Byte";?>&nbsp;&nbsp;&nbsp;约为:&nbsp;<?php echo $userUsed;?></div>
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
     <div id="userfileTable">
     	<span>用户当前文件情况：</span>
        <table>
        	<tr>
            	<td>全部文件</td>
                <td>文档</td>
                <td>图片</td>
                <td>视频</td>
                <td>音乐</td>
            </tr>
            <tr>
            	<td><?php echo $_SESSION["ALLFILES"]." 个" ?></td>
                <td><?php echo $_SESSION["DOCS"]." 个" ?></td>
                <td><?php echo $_SESSION["PICS"]." 个" ?></td>
                <td><?php echo $_SESSION["VIDEOS"]." 个" ?></td>
                <td><?php echo $_SESSION["MUSICS"]." 个" ?></td>
            </tr>
            <tr>
            	<td><?php echo $userUsed;?></td>
                <td><?php echo $docs_size?></td>
                <td><?php echo $pics_size?></td>
                <td><?php echo $videos_size?></td>
                <td><?php echo $musics_size?></td>
            </tr>
        </table>
     </div>
</body>
</html>