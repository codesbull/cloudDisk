<?php 
	$userString = $_POST["username"];
	
	//设置数据库连接变量
	$host = "localhost";
	$user = "root";
	$pwd = "123456";
	$database = "yunpan";
	
	//连接数据库
	$conn = mysqli_connect($host,$user,$pwd);
	mysqli_select_db($conn,$database);
	
	//在数据库中查询该用户名是否被注册
	$sql1 = "SELECT * FROM `userinfo` WHERE(username = '$userString')";
	if($result = mysqli_query($conn,$sql1)){
		$rowCounts = $result->num_rows;
		if($rowCounts){
			echo "disable";	
			exit();
		}else{
			echo "enable";
			exit();	
		}
	}
?>