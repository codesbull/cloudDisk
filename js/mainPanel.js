// JavaScript Document


////////////////////top-Area////////////////////
//网盘选项卡
$(function(){
	$("#wangpan a").click(function(){
		$(".itemBox span").css("display","none");
		$(this).next("span").css("display","block");
		$("#left-side a").css("background","none");
		$("#allfile").css("background","rgba(128,128,128,0.2)");
		$("#right-side iframe").attr("src","frameset/wangpan.php");
		is_click = true;
	});
});

//关于选项卡
$(function(){
	$("#guanyu a").click(function(){
		$(".itemBox span").css("display","none");
		$(this).next("span").css("display","block");
		$("#left-side a").css("background","none");
		$("#allfile").css("background","rgba(128,128,128,0.2)");
		$("#right-side iframe").attr("src","frameset/guanyu.php");
	});
});


////////////////////left-side////////////////////
//左侧选项卡样式
$(function(){
	$("#left-side a").click(function(){
		$("#left-side a").css("background","none");
		$(this).css("background","rgba(128,128,128,0.2)");
	});
});

//所有文件
$(function(){
	$("#allfile").click(function(){
		$(".itemBox span").css("display","none");
		$("#wangpan a").next("span").css("display","block");
		$("#right-side iframe").attr("src","frameset/wangpan.php");
	});
});

//文档
$(function(){
	$("#docs").click(function(){
		$("#right-side iframe").attr("src","frameset/docs.php");
	});
});

//图片
$(function(){
	$("#pics").click(function(){
		$("#right-side iframe").attr("src","frameset/pics.php");
	});
});

//视频
$(function(){
	$("#videos").click(function(){
		$("#right-side iframe").attr("src","frameset/videos.php");
	});
});

//音乐
$(function(){
	$("#musics").click(function(){
		$("#right-side iframe").attr("src","frameset/musics.php");
	});
});


///////////////////userProfile/////////////////////
//鼠标覆盖用户名，hidden/show用户资料卡
$(function(){
	$("#user").mouseover(function(){
		$("#userProfile").css("display","block");
	});
	$("#user").mouseout(function(){
		$("#userProfile").css("display","none");
	});
	$("#userProfile").mouseover(function(){
		$("#userProfile").css("display","block");
	});
	$("#userProfile").mouseout(function(){
		$("#userProfile").css("display","none");
	});
});

//用户资料
$(function(){
	$("#personInfo").click(function(){
		$("#right-side iframe").attr("src","frameset/personInfo.php");
	});
});

//更换头像
$(function(){
	$("#changeAvatar").click(function(){
		$("#right-side iframe").attr("src","frameset/changeAvatar.php");
	});
});

//帮助中心
$(function(){
	$("#helpCenter").click(function(){
		$("#right-side iframe").attr("src","frameset/helpCenter.php");
	});
});

//退出登陆
$(function(){
	$("#logout").click(function(){
		window.location.href = "login.php";
	});
});

//从后台获取已用磁盘量，并写入<a id="percentage">中
$(function(){
	$.ajax({
		type:'POST',
		url:"server/mainPanelServer.php",
		success: function(data){
			$("#DiskUsage div").attr("title",data);	
		}
	});
});



function showDiskUsed(){
	var used = $("#DiskUsage div").attr("title");  //获得已用磁盘量
	
	var total = Math.pow(1024,3);  //将存储总量1G换算为KB
	var used = Number(used); 
	//计算已用空间所占百分比  
	var width = Math.round((used / total) * 160) + "px";
	
	if(used > 1048576){
		used = (used / 1048576).toFixed(1);
		$("#used").html("已用:"+used+"M");
		$("#DiskUsage div").html("<a class='percentage' style='width:"+width+";'></a>");
	}else if(used > 1024){
		used = (used / 1024).toFixed(1);
		$("#used").html("已用:"+used+"K");
		$("#DiskUsage div").html("<a class='percentage' style='width:"+width+";'></a>");
	}else{
		$("#used").html("已用:"+used+"B");
		$("#DiskUsage div").html("<a class='percentage' style='width:"+width+";'></a>");
	}

}

//重复刷新显示用户当前存储空间
setInterval(showDiskUsed,1000);


//预先访问一遍栏目，使得能统计出用户各种文件对应数据
$(function(){
	var requestArr = new Array("MUSICS","DOCS","VIDEOS","PICS");
	for(var i=0 ; i<requestArr.length; i++){
		$.ajax({
			type:'POST',
			url:"server/search-itemServer.php?Item="+requestArr[i],
		});
	}
});
