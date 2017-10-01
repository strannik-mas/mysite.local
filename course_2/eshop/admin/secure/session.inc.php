<?php
	session_start();
	if(!isset($_SESSION['admin'])){
		header("Location: /course_2/eshop/admin/secure/login.php?ref=".$_SERVER['REQUEST_URI']);
		exit;
	}
