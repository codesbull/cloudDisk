// JavaScript Document
//全局变量
var currentPath = new Array();
var deleteFileArray = new Array();

//用户登陆时，向后台发送请求，回传用户目录情况
function showFile(path){
	$.ajax({
		type:'POST',
		url:"../server/showFileServer.php",
		data:{"path":path},
		success: function(data){
			var BoxInnerHTML = "";
			var fileArr = data.split("|");
			fileArr.pop();
			//begin for loop
			for(var i=0; i<fileArr.length; i++){
				var boxhtml = "<div onMouseOver='fileBoxHoverIn(this)' onMouseOut='fileBoxHoverOut(this)'><em class='selectedbox' onClick='fileSelected(this)'></em><span class='is_file'></span><a class='file_name' title='F'>"+fileArr[i].split(">")[1]+"</a><p class='downloadFile' onClick='downloadNow(this);'>下载</p><span class='fileModiTime'>"+fileArr[i].split(">")[3]+"</span><span class='filesize'>"+fileArr[i].split(">")[2]+"</span></div>";
		
				if(fileArr[i].split(">")[0] == "D"){
					boxhtml = "<div onMouseOver='fileBoxHoverIn(this)' onMouseOut='fileBoxHoverOut(this)'><em class='selectedbox' onClick='fileSelected(this)'></em><span class='is_directory'></span><a class='directory_name' onClick='goToFolder(this)'>"+fileArr[i].split(">")[1]+"</a><span class='fileModiTime'>"+fileArr[i].split(">")[3]+"</span><span class='filesize'>"+fileArr[i].split(">")[2]+"</span></div>";
				}
				BoxInnerHTML += boxhtml;
			}//end for loop
			$("#showFileBox").html(BoxInnerHTML);
			$("#left-countsFile").html("已全部加载，共"+fileArr.length+"个");
		}//end success
	});//end ajax
}
//调用函数
showFile("isUser");

//所有文件全选
$(function(){
	$("#title-selectAll").click(function(){
		if($("#title-selectAll").css("background-image") == "none"){
			//显示盒子内小勾样式
			$("#title-selectAll").css("background-image","url(../images/selectedGou.png)");
			$(".selectedbox").css("background-image","url(../images/selectedGou.png)");
			//首先清空待删除数组
			deleteFileArray.splice(0,deleteFileArray.length);
			//将当前目录所有文件、文件夹加入待删除数组
			var all_files = document.getElementsByClassName("selectedbox");
			for(var j=0; j<all_files.length; j++){
				var file_name = $(all_files[j].parentNode).children("a").html();
				var file_path = "../userArea/" + $("#chooseFileBtn").attr("name") +"/"+ currentPath.join("/")+"/"+ file_name;
				deleteFileArray.push(file_path);
			}
		}else{
			$("#title-selectAll").css("background-image","none");
			$(".selectedbox").css("background-image","none");
			//清空待删除数组
			deleteFileArray.splice(0,deleteFileArray.length);
		}
	});
});


//设置鼠标hover文件上
function fileBoxHoverIn(obj){
	obj.style.background = "rgba(102,144,255,0.1)";
	$(obj).children("p").css("display","block");
}
function fileBoxHoverOut(obj){
	obj.style.background = "none";
	$(obj).children("p").css("display","none");
}

//由文件路径名得出文件在数组中的索引
function findIndex(filePath){
	for(var i=0; i<deleteFileArray.length; i++){
		if(deleteFileArray[i] == filePath){
			return i;	
		}
	}
	return -1;
}


//点击打勾框，为该文件框打勾
function fileSelected(obj){
	//选勾的获取当前文件路径
	var user_folder = "../userArea/" + $("#chooseFileBtn").attr("name");
	var file_path = user_folder+"/"+ $(obj.parentNode).children("a").html();
	if(currentPath.join("/")){
		file_path = user_folder+"/"+ currentPath.join("/") +"/"+ $(obj.parentNode).children("a").html();
	}
	//打勾或者取消打勾
	if($(obj).css("background-image") == "none"){
		$(obj).css("background-image","url(../images/selectedGou.png)");
		//将该文件选中加入待删除数组
		deleteFileArray.push(file_path);
	}else{
		$(obj).css("background-image","none");
		//将该文件从待删除数组中删除
		var file_index = findIndex(file_path);
		deleteFileArray.splice(file_index,1);
	}
}



//用户点击上传按钮，弹出选择文件提示层，背景变黑
$(function(){
	$("#upload").click(function(){
		//更改背景
		$("body").css("background","rgba(149,149,149,0.5)");
	    $("#uploadPromptLayer").css("display","block");
		//点击关闭按钮，更改背景
	    $("#msgShut").click(function(){
			$("body").css("background","none");
			$("#uploadPromptLayer").css("display","none");
	    });
	});
});

//用户点击上传按钮，提交form，改变背景样式
$(function(){
	var is_click = false;
	$("#submitBtn").click(function(){
		$("body").css("background","none");
		$("#uploadPromptLayer").css("display","none");
		//如果当前目录不在user目录，则改变路径
		if(currentPath.join("/")){
			$("#uploadPath").attr("value",currentPath.join("/"));
		}
		is_click = true;
	});
	//刷新当前页面
	setInterval(is_click_refresh,500);
	function is_click_refresh(){
		if(is_click){
			showFile(currentPath.join("/"));
			is_click = false;
		}
	}
});


//用户点击某个目录，进入到该目录内部
function goToFolder(obj){
	//显示所进入目录的文件情况
	currentPath.push(obj.innerHTML);
	showFile(currentPath.join("/"));
	//显示当前所处的目录路径
	var dirRankHtml = "<a onClick='goBack();'>返回上一级</a><a>|</a>";
	for(var i=0; i<currentPath.length; i++){
		dirRankHtml += "<a>"+currentPath[i]+"</a>";
		if(i != currentPath.length-1){
			dirRankHtml += "<a>></a>";
		}
	}
	$("#left-dirRank").html(dirRankHtml);
}


//点击返回至上一级
function goBack(){
	//当前目录所有打勾选项被清除
	deleteFileArray.splice(0,deleteFileArray.length);
	//路径数组弹出最后一级目录
	currentPath.pop();
	showFile(currentPath.join("/"));
	
	if(!currentPath.length){
		$("#left-dirRank").html("全部文件");
	}else{
		//显示当前所处的目录路径
		var dirRankHtml = "<a onClick='goBack();'>返回上一级</a><a>|</a>";
		for(var i=0; i<currentPath.length; i++){
			dirRankHtml += "<a>"+currentPath[i]+"</a>";
			if(i != currentPath.length-1){
				dirRankHtml += "<a>></a>"
			}
		}
		$("#left-dirRank").html(dirRankHtml);
	}
}


//用户点击新建文件夹按钮
$(function(){
	$("#newFolder").click(function(){
		var newFname = prompt("请输入文件夹名称");
		if(newFname){
			$.ajax({
				type:'POST',
				url:"../server/newFolderServer.php",
				data:{"folderName":newFname,"path":currentPath.join("/")},
				success: function(data){
					showFile(currentPath.join("/"));
				}
			});
		}
	});
});


//用户点击删除文件夹
$(function(){
	$("#delete").click(function(){
		$.ajax({
			type:'POST',
			url:"../server/deleteFolderServer.php",
			data:{"deleteString":deleteFileArray.join(">")},
			success: function(data){
				showFile(currentPath.join("/"));
			}
		});
	});
});


//文件下载
function downloadNow(obj){
	var filepath = "../userArea/"+$("#chooseFileBtn").attr("name")+"/"+$(obj.parentNode).children("a").html();
	if(currentPath.join("/")){
		filepath = "../userArea/"+$("#chooseFileBtn").attr("name")+"/"+currentPath.join("/")+"/"+$(obj.parentNode).children("a").html();
	}
	$("#downloadInput").val(filepath);
	$("#downloadForm").submit();
}


//文件重命名
$(function(){
	var is_renamed = false;
	$("#rename").click(function(){
		if(deleteFileArray.length == 0){
			alert("你还没有选择要命名的文件夹!");
		}else if(deleteFileArray.length > 1){	
			alert("一次只能重命名一个文件或文件夹!");
			$("#title-selectAll").css("background-image","none");
			$(".selectedbox").css("background-image","none");
			//清空待删除数组
			deleteFileArray.splice(0,deleteFileArray.length);
		}else{
			var newName = prompt("请输入新的命名:");
			//判断用户输入的文件名是否合法
			while(/\.{1}/.test(newName) && newName){
				newName = prompt("您输入的新命名不合法，请重新输入:");
			}
			//发送重命名数据至后台处理
			$.ajax({
				type:'POST',
				url:"../server/renameServer.php",
				data:{
					"newName":newName,
					"renamePath":deleteFileArray[0]
				},
				success: function(data){
					//出现更改后，文件名重名现象
					if(data == "hasSameFile"){
						alert("操作失败，你输入新的命名与已存在文件冲突");
					}
				}
			});//end ajax
			
			//清空待删除数组
			$("#title-selectAll").css("background-image","none");
			$(".selectedbox").css("background-image","none");
			deleteFileArray.splice(0,deleteFileArray.length);
			is_renamed = true;
		}
	});//end click()
	
	//刷新当前页面
	setInterval(is_rename_refresh,500);
	function is_rename_refresh(){
		if(is_renamed){
			showFile(currentPath.join("/"));
			is_renamed = false;
		}
	}
});



//文件搜索
$(function(){
	$("#searchBtn").click(function(){
		if($("#search").val()){
			$.ajax({
				type:'POST',
				url:"../server/searchServer.php",
				data:{"searchFile":$("#search").val()},
				success: function(data){
					var BoxInnerHTML = "";
					var fileArr = data.split("|");
					fileArr.pop();
					//begin for loop
					for(var i=0; i<fileArr.length; i++){
						
						var boxhtml = "<div onMouseOver='fileBoxHoverIn(this)' onMouseOut='fileBoxHoverOut(this)'><em class='selectedbox' onClick='fileSelected(this)'></em><span class='is_file'></span><a class='file_name' title='F'>"+fileArr[i].split(">")[0]+"</a><p class='downloadFile' onClick='searchDownload(this);' title='"+fileArr[i].split(">")[3]+"'>下载</p><span class='fileModiTime'>"+fileArr[i].split(">")[2]+"</span><span class='filesize'>"+fileArr[i].split(">")[1]+"</span></div>";
						
						BoxInnerHTML += boxhtml;	
					}//end for loop
					
					$("#showFileBox").html(BoxInnerHTML);
					$("#left-countsFile").html("已全部加载，共"+fileArr.length+"个");
					$(".operator-item").css("display","none");
					
				}//end success
			});//end ajax
		}//end if
	});//end click
})

//用于搜索文件进行的下载
function searchDownload(obj){
	var filepath = $(obj).attr("title");
	$("#downloadInput").val(filepath);
	$("#downloadForm").submit();
}






