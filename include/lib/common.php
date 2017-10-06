<?php
function is_login() {
	session_start();
	if(!isset($_SESSION['user']) || $_SESSION['user'] == null) {
		Header("Location: index.html");
	}
}