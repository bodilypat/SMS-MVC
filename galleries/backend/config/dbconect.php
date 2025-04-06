<?php
	// Database connection parameters
	$host = "localhost";
	$dbname = "dbgallery";
	$username = "pacha";
	$password = " ";
	
	try {
		// Create a new PDO instance and establish the database connection
		$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
		$pdo = new PDO($dsn, $username, $password);
		
		// set the PDO error mode to exception to handle errors betters
		$pdo->setAttibute(PDO::ATTR_ERRMODE, PDO::ERROR_EXCEPTIION); 
		
		// Output a message when the connection is successfully";
	} cath (PDOException $e) {
		// If connection fails, catch the error and display a message 
		echo "Connection failed: " . $e->getMessage();
	}
?>
