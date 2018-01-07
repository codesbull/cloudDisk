// JavaScript Document
var time = 60;


/*点击验证码图像，刷新验证码*/

function refreshChkImg(){
	document.getElementById('checkCodeImg').src = "server/checkCode.php";
	location.reload();
	time = 60;
	$("#checkCodeTime").html(time+"s");
}







/*倒计时刷新验证码*/
$(function(){
	setInterval(checkCodeJudge,1000);
	function checkCodeJudge(){
		if(time <= 0){
			refreshChkImg();
			time = 60;
		}
		$("#checkCodeTime").html(time+"s");
		time--;
	}
});

/*点击注册按钮定向跳转至注册界面*/
$(function(){
	$("#registerBtn").click(function(){
		window.location.href = "register.php";
	});
})

/*点击登陆按钮，对注册信息进行初步检查，
 通过初步检查，才发往后台进一步检查*/
$(function(){
	$("#loginBtn").click(function(){
		var userString = $("#username").val();
		var pwdString = $("#password").val();
		var checkString = $("#checkCode").val();
		if(!userString){
			$("#errorSpan").html("用户名不能为空");
		}else if(!pwdString){
			$("#errorSpan").html("密码不能为空");
		}else if(!checkString){
			$("#errorSpan").html("验证码不能为空");
		}else{
			/*使用ajax将用户字符串传输到后台进一步验证*/
			$.ajax({
				type:'POST',
				url:"server/loginServer.php",
				dataType:"html",
				data:{"username":userString,"password":pwdString,"checkCode":checkString},
				success: function(data){
					if(data === "NoThisUser"){
						$("#errorSpan").html("用户名不存在");
						$("#username").val("");
						$("#password").val("");
					}else if(data === "passwordError"){
						$("#errorSpan").html("密码错误");
						$("#password").val("");
					}else if(data === "checkCodeError"){
						$("#errorSpan").html("验证码不正确");
						$("#checkCode").val("");
						$("#password").val("");
					}else if(data === "allRight"){
						$("#loginForm").submit();
						$("#username").val("");
						$("#password").val("");
						$("#checkCode").val("");
					}else{
						$("#errorSpan").html("未知错误，请重试");
						$("#username").val("");
						$("#password").val("");
						$("#checkCode").val("");
					}	
				}
			})
			//end success
		}
		//end ajax
	});	
});

/*载入页面，用户名输入框获得焦点*/
$(document).ready(function(){
	$("#username").focus();
});





