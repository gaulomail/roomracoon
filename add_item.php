<?php
	require 'config.php';

	// Get the form data
	$name = $_POST['name'];
	$description = $_POST['description'];
	$price = $_POST['price'];
	$quantity = $_POST['quantity'];
	$dateEntered = $_POST['date_entered'];
	$categoryID = $_POST['category'];

	// Insert the item into the database
	$query = "INSERT INTO items (name, description, price, quantity, date_entered, category_id)
          VALUES ('$name', '$description', '$price', '$quantity', '$dateEntered', '$categoryID')";
	$result = mysqli_query($connection, $query);

	// Check if the item was inserted successfully
	if ($result) {
		// Item added successfully
		$_SESSION['flash_message'] = "Item added successfully.";
	} else {
		// Error adding item
		$_SESSION['flash_message'] = "Error adding item: " . mysqli_error($connection);
	}
	header('Location: index.php?tab=home');

	// Close the database connection
	mysqli_close($connection);

