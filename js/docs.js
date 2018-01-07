// JavaScript Document

//文件搜索
$(function(){
	$.ajax({
		type:'POST',
		url:"../server/search-itemServer.php?Item=DOCS",
		success: function(data){
					var BoxInnerHTML = "";
					var fileArr = data.split("|");
					fileArr.pop();
					//begin for loop
					for(var i=0; i<fileArr.length; i++){
	
						var boxhtml = "<div onMouseOver='fileBoxHoverIn(this)' onMouseOut='fileBoxHoverOut(this)'><em class='selectedbox'></em><span class='is_file'></span><a class='file_name'>"+fileArr[i].split(">")[0]+"</a><p class='downloadFile' onClick='searchDownload(this);' title='"+fileArr[i].split(">")[3]+"'>下载</p><span class='fileModiTime'>"+fileArr[i].split(">")[2]+"</span><span class='filesize'>"+fileArr[i].split(">")[1]+"</span></div>";
						BoxInnerHTML += boxhtml;
					}//end for loop
					$("#showFileBox").html(BoxInnerHTML);
					$("#left-countsFile").html("已全部加载，共"+fileArr.length+"个");	
		}//end success
	});//end ajax
})


//用于搜索文件进行的下载
function searchDownload(obj){
	var filepath = $(obj).attr("title");
	$("#downloadInput").val(filepath);
	$("#downloadForm").submit();
}

//设置鼠标hover文件上
function fileBoxHoverIn(obj){
	obj.style.background = "rgba(102,144,255,0.1)";
	$(obj).children("p").css("display","block");
}
function fileBoxHoverOut(obj){
	obj.style.background = "none";
	$(obj).children("p").css("display","none");
}
// JavaScript Document