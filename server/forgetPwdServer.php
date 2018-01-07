<?php

	//设置数据库连接变量
	$host = "localhost";
	$user = "root";
	$pwd = "123456";
	$database = "yunpan";
	
	//连接数据库
	$conn = mysqli_connect($host,$user,$pwd);
	mysqli_select_db($conn,$database);
	
	
	//查询用户ID是否存在
	if(@$_GET["item"] == "USER_ID"){
		$userString = $_POST["user_id"];
		$sql1 = "SELECT * FROM `userinfo` WHERE(username = '$userString')";
		if(!mysqli_query($conn,$sql1)->num_rows){
			echo "NoFoundUser|";
		}else{
			$user_obj = mysqli_fetch_array(mysqli_query($conn,$sql1));
			echo "hasUser|".$user_obj["Question"];	
		}
	}
	
	if(@$_GET["item"] == "QuesAnInput"){
		$user_id = $_POST["user_id"];
		$QuesAn_String = $_POST["QuesAn_input"];
		$sql2 = "SELECT * FROM `userinfo` WHERE(username = '$user_id')";
		$user_obj = mysqli_fetch_array(mysqli_query($conn,$sql2));
		if($user_obj["AnQues"] == $QuesAn_String){
			echo "AnQuesRight|".$user_obj["password"];	
		}else{
			echo "AnQuesFalse|";	
		}
	}
	
	
	
	

?>