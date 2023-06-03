<?php
	global $connection;
	require 'config.php';

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// Retrieve the category name from the form
		$categoryName = $_POST['category_name'];

		// Insert the category into the database
		$query = "INSERT INTO categories (name) VALUES ('$categoryName')";
		$result = mysqli_query($connection, $query);

		if ($result) {
			// Item added successfully
			$_SESSION['flash_message'] = "Item added successfully.";
		} else {
			// Error adding item
			$_SESSION['flash_message'] = "Error adding item: " . mysqli_error($connection);
		}
		header('Location: index.php?tab=home&result=');
		exit();
	}

	mysqli_close($connection);
?>
