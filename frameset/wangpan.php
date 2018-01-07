<?php session_start()?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>wangpan</title>
<link rel="stylesheet" href="../css/yahooInitial.css">
<link rel="stylesheet" href="../css/wangpan.css">
<script src="../js/jquery-1.11.2.js"></script>
<script src="../js/wangpan.js"></script>
</head>

<body>
	<!--顶部用户操作区-->
	<div id="operateBox">
    	<input type="button" id="upload" value="上传" class="operator-item">
        <input type="button" id="rename" value="重命名" class="operator-item">
        <input type="button" id="delete" value="删除" class="operator-item">
        <input type="button" id="newFolder" value="新建文件夹" class="operator-item">
        <div>
        	<input type="text" id="search" value="" placeholder="搜索文件...">
            <input type="button" id="searchBtn" value="search">
        </div>
    </div>
    
    <!--显示目录层级关系区-->
    <div id="showDir">
    	<div id="left-dirRank">
        	<a href="wangpan.php">全部文件</a>
        </div>
        <div id="left-countsFile"></div>
    </div>
    
    <!--文件标题区-->
    <div id="fileTitle">
    	<div id="title-filename">
        	<div id="title-selectAll"></div>文件名
        </div>
        <div id="title-fileTime">最后修改时间</div>
        <div id="title-fileSize">大小</div>
    </div>

  	<!--主文件面板区-->
    <div id="showFileBox">
    	<div onMouseOver="" onMouseOut=""></div>
    </div>
    
    
    <!--上传文件，选择文件区-->
    <div id="uploadPromptLayer">
    	<div id="msgShut">关闭</div>
        <form id="uploadFileForm" action="../server/wangpanServer.php" method="post" enctype="multipart/form-data" target="nm_iframe">
            <input type="file" id="chooseFileBtn" name=<?php echo $_SESSION["username"]?>>
            <input type="hidden" id="uploadPath" name="uploadPath" value="">
            <input type="submit" id="submitBtn" value="上传">
    	</form>
        <iframe id="nm_iframe" name="nm_iframe" style="display:none;"></iframe>
    </div>
    
    <!--下载专用-->
    <form id="downloadForm" action="../server/downloadServer.php" method="post" style="display:none;">
    	<input id="downloadInput" type="hidden" name="downloadString" value="">
    </form>
   
</body>
</html>









