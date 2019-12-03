<?php
	require_once("session.php");
		session_destroy();
		session_regenerate_id(TRUE);
		session_start();
		redirect("login.php", "Successfully Logged Out");
?>