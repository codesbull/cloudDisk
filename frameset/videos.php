<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>videos</title>
<link rel="stylesheet" href="../css/yahooInitial.css">
<link rel="stylesheet" href="../css/search-item.css">
<script src="../js/jquery-1.11.2.js"></script>
<script src="../js/videos.js"></script>
</head>

<body>
	<!--顶部用户操作区-->
	<div id="operateBox">显示您的所有视频文件</div>
    
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
    
   
    <!--下载专用-->
    <form id="downloadForm" action="../server/downloadServer.php" method="post" style="display:none;">
    	<input id="downloadInput" type="hidden" name="downloadString" value="">
    </form>
   
</body>
</html>









