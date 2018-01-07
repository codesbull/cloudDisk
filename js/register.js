// JavaScript Document

// JavaScript Document
// 主要负责检查用户注册信息填写格式是否正确
var user_OK = false;
var psd_OK = false;
var rePsd_OK = false;
var Ques_OK = false;
var AnQues_OK = false;


/* username失去焦点时，对其检测 */
$(function(){
	$("#username").blur(function(){
		var user_val = $("#username").val();
		//字符串长度判断
		if(user_val.length < 6){
			$("#userError").css("color","red");
			$("#userError").html("用户名长度少于6位");
			user_OK = false;
		}else if(user_val.length > 10){
			$("#userError").css("color","red");
			$("#userError").html("用户名长多于10位");
			user_OK = false;
		}else if(/^[0-9]/.test(user_val)){	//检查开头是否为数字
			$("#userError").css("color","red");
			$("#userError").html("开头为数字");
			user_OK = false;
		}else{
			var user_pattern = new RegExp("^[a-zA-Z0-9_]{"+user_val.length+"}");
			if(!user_pattern.test(user_val)){
				$("#userError").css("color","red");
				$("#userError").html("包含非法字符");	
				user_OK = false;
			}else{
				//验证通过，接下来验证用户名是否可用
				$.ajax({
					type:'POST',
					url:"server/userEnableServer.php",
					data:{"username":user_val},
					dataType:"html",
					success: function(data){
						if(data === "enable"){
							$("#userError").css("color","blue");
							$("#userError").html("正确");	
							user_OK = true;
						}else{
							$("#userError").css("color","red");
							$("#userError").html("该名称已被注册");	
							user_OK = false;	
						}
					}
				});
				//结束验证
			}
		}
	});
});


/* password 失去焦点时，对其进行检测 */
$(function(){
	$("#password").blur(function(){
		var psd_val = $("#password").val();
		if(psd_val.length < 6){
			$("#psdError").css("color","red");
			$("#psdError").html("密码长度少于6位");
			psd_OK = false;
		}else if(psd_val.length > 15){
			$("#psdError").css("color","red");
			$("#psdError").html("密码长度多于15位");
			psd_OK = false;
		}else{
			var psd_pattern = new RegExp("^[a-zA-Z0-9_\@\#\$\%\^\&\*]+$");
			if(psd_pattern.test(psd_val)){
				$("#psdError").css("color","blue");
				$("#psdError").html("正确");
				psd_OK = true;
			}else{
				$("#psdError").css("color","red");
				$("#psdError").html("包含非法字符");
				psd_OK = false;	
			}
		}
	});
});

/* RePassword失去焦点时，对其进行检测 */
$(function(){
	$("#RePassword").blur(function(){
		if($("#RePassword").val() === $("#password").val()){
			$("#RePsdError").css("color","blue");
			$("#RePsdError").html("密码一致");
			rePsd_OK = true;
		}else{
			$("#RePsdError").css("color","red");
			$("#RePsdError").html("两次密码不一致");
			rePsd_OK = false;
		}
	});
});

/* Ques失去焦点时，对其进行检测 */
$(function(){
	$("#Question").blur(function(){
		if($("#Question").val()){
			$("#QuesError").css("color","blue");
			$("#QuesError").html("正确");
			Ques_OK = true;
		}else{
			$("#QuesError").css("color","red");
			$("#QuesError").html("找回密码问题为空");
			Ques_OK = false;
		}
		
	});
});

/* AnQues失去焦点时，对其进行检测 */
$(function(){
	$("#AnQuestion").blur(function(){
		var AnQues_val = $("#AnQuestion").val();
		if(!AnQues_val){
			$("#AnQuesError").css("color","red");
			$("#AnQuesError").html("找回密码问题答案为空");
			AnQues_OK = false;
		}else if(AnQues_val.length < 8){
			$("#AnQuesError").css("color","red");
			$("#AnQuesError").html("长度少于8位");
			AnQues_OK = false;
		}else{
			$("#AnQuesError").css("color","blue");
			$("#AnQuesError").html("正确");
			AnQues_OK = true;
		}
	});
});

/* 点击RESET按钮，清空所有错误提醒、信号标记 */
$(function(){
	$("#restInfoBtn").click(function(){
		$("#userError").html("");
		$("#psdError").html("");
		$("#RePsdError").html("");
		$("#QuesError").html("");
		$("#AnQuesError").html("");
		user_OK = false;
		psd_OK = false;
		rePsd_OK = false;
		Ques_OK = false;
		AnQues_OK = false;
	});
});

/* 点击submit按钮，对填写内容检查，通过则发送至server*/
$(function(){
	$("#submitBtn").click(function(){
		if(user_OK && psd_OK && rePsd_OK && Ques_OK && AnQues_OK){
			document.getElementById("registerForm").submit();
			$("#username").val("");
			$("#password").val("");
			$("#RePassword").val("");
			$("#Question").val("");
			$("#AnQuestion").val("");
		}
	});
});


















