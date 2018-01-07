<?php
	//获取用户登陆字符串
	$userString = $_POST['username'];
	$pwdString = $_POST['password'];
	$checkString = $_POST['checkCode'];
	
	//获取后台验证码
	session_start();
	$checkCode = $_SESSION['checkCode'];
	$checkCode = str_replace(" ","",$checkCode);
	
	//设置数据库连接变量
	$host = "localhost";
	$user = "root";
	$pwd = "123456";
	$database = "yunpan";
	
	//连接数据库
	$conn = mysqli_connect($host,$user,$pwd);
	mysqli_select_db($conn,$database);
	
	//判断用户名是否存在
	$sql1 = "SELECT * FROM `userinfo` WHERE(username = '$userString')";
	if(!mysqli_query($conn,$sql1)->num_rows){
		echo "NoThisUser";
		exit();
	}
	
	//判断密码是否正确
	$sql2 = "SELECT * FROM `userinfo` WHERE(username = '$userString')";
	$user_obj = mysqli_fetch_array(mysqli_query($conn,$sql2));
	if($pwdString != $user_obj["password"]){
		echo "passwordError";
		exit();
	}
	
	//判断验证码是否正确
	if($checkString != $checkCode){
		echo "checkCodeError";
		exit();
	}
	
	//到这里全部正确，返回信号
	echo "allRight";

?>