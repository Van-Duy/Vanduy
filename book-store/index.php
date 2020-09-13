<?php
	error_reporting(E_ALL & ~E_NOTICE);
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	require_once 'define.php';
	require_once 'define_notice.php';
	function __autoload($clasName){
		$fileName = LIBRARY_PATH . "{$clasName}.php";
		if(file_exists($fileName))require_once $fileName;
	}
	Session::init();
	$bootstrap = new Bootstrap();
	$bootstrap->init();
?>