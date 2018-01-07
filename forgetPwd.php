<!DOCTYPE html>
<html>
<head>
<title>找回密码·在线云盘系统</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/yahooInitial.css">
<style>
	body{
		background:#EEE;	
	}
	#container{
		width:600px;
		height:400px;
		margin:100px auto 0px auto;
		background:white;
		border-radius:4px;	
	}
	#title{
		width:inherit;
		height:40px;
		line-height:40px;
		font-size:18px;
		text-align:center;
		background:#6C6;
		border-top-left-radius:4px;	
		border-top-right-radius:4px;
		margin-bottom:35px;
	}
	/*用户输入ID部分*/
	#IDinputBox{
		width:520px;
		height:50px;
		margin:0px 0px 0px 50px;
	}
	
	/*查询密码问题、输入密码问题部分*/
	#inputQuesAn{
		width:520px;
		height:90px;
		margin:30px 0px 0px 50px;
		display:none;
	}
	#Ques{
		display:block;
		width:inherit;
		height:40px;
		font-size:14px;
	}
	
	/*显示查询到的用户密码部分*/
	#userPwdBox{
		width:520px;
		height:120px;
		margin:20px 0px 0px 50px;
		display:none;
	}
	#yourPwd{
		display:block;
		width:inherit;
		height:20px;
		line-height:20px;
		font-size:14px;	
	}
	#timeJump{
		display:block;
		width:inherit;
		height:20px;
		line-height:20px;
		font-size:13px;
		text-align:center;
		margin:70px 0px 0px 0px;
	}
	
	.inputbox{
		display:block;
		float:left;
		width:300px;
		height:22px;
		font-size:14px;
		outline:none;
	}
	.btn{
		width:160px;
		height:28px;
		background:#6C6;
		margin-left:30px;
		border-radius:4px;
		outline:none;
		cursor:pointer;
		font-size:13px;
	}
	.error{
		display:block;
		width:500px;
		height:15px;
		line-height:15px;
		font-size:12px;
		color:red;
		margin:5px 0px 0px 0px;
	}

</style>
</head>
<body>
	<div id="container">
    	<div id="title">找回密码面板</div>
        
        <div id="IDinputBox">
        	<input type="text" id="user_id" class="inputbox" value="" placeholder="请输入用户ID">
            <input type="button" id="id_btn" class="btn" value="点击获取查询问题">
            <span id="id_error" class="error"></span>
        </div>
 
        <div id="inputQuesAn">
        	<span id="Ques"></span>
        	<input type="text" id="QuesAninput" class="inputbox" value="" placeholder="请输入以上问题答案">
            <input type="button" id="pwd_btn" class="btn" value="点击获取密码">
            <span id="QuesAn_error" class="error"></span>
        </div>
        
        <div id="userPwdBox">
        	<span id="yourPwd"></span>
            <span id="timeJump"></span>
        </div>
    </div>
</body>
</html>
<script src="js/jquery-1.11.2.js"></script>
<script>
	//全局变量
	var id_val = "";
	//点击获取查询问题按钮，验证ID是否存在
	$(function(){
		$("#id_btn").click(function(){
			id_val = $("#user_id").val();
			if(id_val){
				$.ajax({
					type:'POST',
					url:"server/forgetPwdServer.php?item=USER_ID",
					data:{"user_id":id_val},
					success: function(data){
						var dataArr = data.split("|");
						if(dataArr[0] == "NoFoundUser"){
							$("#id_error").html("没有此用户！");	
						}else if(dataArr[0] == "hasUser"){
							$("#inputQuesAn").css("display","block");
							$("#id_error").html("");
							$("#Ques").html("您的查询密码问题为："+dataArr[1]);
						}//end if
					}//end success
				});//end ajax
			}else{
				$("#id_error").html("用户id不能为空！");	
			}//end if
		});
	});
	
	
	//点击获取密码按钮
	$(function(){
		$("#pwd_btn").click(function(){
			var QuesAn_val = $("#QuesAninput").val();
			if(QuesAn_val){
				$.ajax({
					type:'POST',
					url:"server/forgetPwdServer.php?item=QuesAnInput",
					data:{"QuesAn_input":QuesAn_val,"user_id":id_val},
					success: function(data){
						var dataArr = data.split("|");
						if(dataArr[0] == "AnQuesRight"){
							$("#QuesAn_error").html();
							$("#yourPwd").html("恭喜您，成功找回密码，您的密码为："+dataArr[1]);
							$("#userPwdBox").css("display","block");
							setInterval(timeSub,1000);
						}else if(dataArr[1] == "AnQuesFalse"){
							$("#QuesAn_error").html("查询问题答案错误！");
						}
					}// end success	
				});//end ajax
			}else{
				$("#QuesAn_error").html("查询问题答案输入不能为空！");
			}
		});
	});
	
	//显示剩余跳转时间函数
	var time = 12;
	function timeSub(){
		if(time == 0){
			location = "login.php";	
		}
		//document.getElementById("showLeftTime").innerHTML = time;
		$("#timeJump").html("即将在"+time+"秒后自动跳转至登陆页面");
		time--;
	}

</script>









