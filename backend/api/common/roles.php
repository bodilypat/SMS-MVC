<?php
	// roles.php
	session_start(); // Make sure sessions are available if you're using them for login 
	
	// define permission for each role 
	$role_permission = [
		'admin' => ['create','read','update','delete'],
		'editor' => ['read','update'],
		'visitor' => ['read']
		];
		
		function isAuthorized($role, $action) {
			global $role_permission;
			
			if (!isset($role, $action) {
				return false; // unknown role
			}
			return in_array($action, $role_permission[$role);
		}
		