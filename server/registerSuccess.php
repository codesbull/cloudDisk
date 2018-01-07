<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>注册成功页面</title>
<style>
	body{
		background-color:#CCC;
	}
	
	div{
		width:700px;
		height:300px;
		background-color:#CF3;
		text-align:center;
		margin-left:auto;
		margin-right:auto;	
		margin-top:130px;
		padding-top:50px;
	}
</style>
</head>
<body>
	<div>
    	<h1>恭喜您，<span id="insertUsername"><?php echo $username?></span>成功注册在线聊天室账号</h1>
        <h3>现在，你可以使用在线聊天室账号愉快的玩耍了！</h3>
        <script type="application/javascript">
        	var time = 5;
			setInterval(timeSub,1000);
			function timeSub(){
				if(time == 0){
					location = "../login.php";	
				}
				document.getElementById("showLeftTime").innerHTML = time;
				time--;
			}
        </script>
        <h4>倒计时 <span id="showLeftTime">6</span> 秒后自动跳转至登陆界面</h4>
    </div>
</body>
</html>








