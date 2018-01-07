<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>登陆·在线云盘系统</title>
    <script src="js/jquery-1.11.2.js"></script>
    <script src="js/login.js"></script>
	<style>
		#container{
			width: 380px;
			height: 290px;
			background: #EEE;
			margin:100px auto 0 auto;
			border-top-left-radius: 10px;
			border-top-right-radius: 10px;
		}
		#title{
			width: inherit;
			height: 40px;
			line-height: 40px;
			text-align: center;
			letter-spacing: 4px;
			background: orange;
			font-size: 24px;
			font-weight: bold;
			border-top-left-radius: 10px;
			border-top-right-radius: 10px;
			margin-bottom: 30px;
		}

		.inputBox{
			width: inherit;
			height: 30px;
			margin-bottom: 10px;
		}
		.inputBox span{
			display: block;
			width: 60px;
			height: 30px;
			line-height: 30px;
			text-align: center;
			font-size: 16px;
			float:left;
			margin-left: 30px;
		}
		.inputBox input{
			display: block;
			width:240px;
			height: 24px;
			float:left;
			margin-left:7px;
			border-width: thin;
			background:rgba(204,204,204,0.6);
			font-size: 14px;
		}
		/*验证码区*/
		#checkCode{
			width:100px;
			font-size: 14px;
		}
		#checkCodeImg{
			display: block;
			width: 95px;
			height: 28px;
			background:rgba(204,204,204,0.6);
			margin-left: 5px;
			float: left;
		}
		#checkCodeTime{
			display: block;
			height: inherit;
			width: 32px;
			float:left;
			margin-left:5px;
			background: yellow;

		}
		/*忘记密码、错误提示*/
		.promptSpan{
			display: block;
			width:inherit;
			height: 15px;
			line-height: 15px;
			text-align: right;
			padding-right: 30px;
			font-size: 10px;
			color:black;
		}
		#errorSpan{
			margin-top:2px;
			margin-bottom: 15px;
			text-align: left;
			padding-left: 50px;
			color: red;
		}
		/*按钮区*/
		#registerBtn{
			width:160px;
			height: 30px;
			margin-left:30px;
			background: orange;
			border-radius: 5px;
			cursor: pointer;
		}
		#loginBtn{
			width:160px;
			height: 30px;
			background: green;
			border-radius: 5px;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<div id="container">
		<div id="title">云盘登陆入口</div>
		<form id="loginForm" action="mainPanel.php" method="post">
			<div class="inputBox">
				<span>用户名:</span>
				<input type="text" id="username" name="username" placeholder="请输入用户名">
			</div>
			<div class="inputBox">
				<span>密&nbsp;&nbsp;&nbsp;码:</span>
				<input type="password" id="password" name="password" placeholder="请输入密码">
			</div>
			<div class="inputBox">
				<span>验证码:</span>
				<input type="text" id="checkCode" name="checkCode" placeholder="请输入验证码">
				<img id="checkCodeImg" src="server/checkCode.php" onClick="refreshChkImg();">
				<span id="checkCodeTime">60s</span>
			</div>
			<a class="promptSpan" href="forgetPwd.php">忘记密码？点我找回</a>
			<span class="promptSpan" id="errorSpan"></span>
			<div class="inputBox">
				<input type="button" id="registerBtn" name="registerBtn" value="SIGN UP">
				<input type="button" id="loginBtn" name="loginBtn" value="LOG IN">
			</div>
		</form>
	</div>
</body>
</html>

