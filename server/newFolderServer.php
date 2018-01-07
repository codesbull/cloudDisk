<?php 

	session_start();
	$path = "../userArea/".$_SESSION["username"]."/".$_POST["path"]."/".$_POST["folderName"];

	mkdir($path);
	chmod($path,0777);

?>