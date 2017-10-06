<?php
require_once 'lib/NewInit.php';
require_once 'lib/CommonFuncs.php';
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination
$targetFolder = '/uploads/' . date('Y-m-d') . '/'; // Relative to the root

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES)) {// && $_POST['token'] == $verifyToken) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = BASE_DIR . $targetFolder;
	MkFolder($targetPath);
	

	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	$r_targetFile = rtrim($targetFolder,'/') . '/' . CommonFuncs::getRandom(10) . md5($_FILES['Filedata']['name']) . '.' . $fileParts['extension'];
	
	$targetFile = rtrim(BASE_DIR, '/') . $r_targetFile;
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo $r_targetFile;
	} else {
		echo 'Invalid file type.';
	}
}

function MkFolder($path){
	if(!is_readable($path)){
		MkFolder( dirname($path) );
		if(!is_file($path)) mkdir($path,0777);
	}
}
?>