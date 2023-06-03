<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	// Database configuration
	$host = 'localhost';
	$username = 'root';
	$password = '';
	$database = 'vanilla-php';

	// Create a database connection
	$connection = mysqli_connect($host, $username, $password, $database);

	// Check if the connection was successful
	if (!$connection) {
		die("Connection failed: " . mysqli_connect_error());
	}

