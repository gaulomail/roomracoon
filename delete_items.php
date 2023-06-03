<?php
	// delete_items.php

	require 'config.php';
	global $connection;
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	if (isset($_POST['item_ids'])) {
		$itemIds = $_POST['item_ids'];

		// Convert the item IDs to a comma-separated string for the SQL query
		$itemIdsString = implode(',', $itemIds);

		// Delete items from the database
		$query = "DELETE FROM items WHERE id IN ($itemIdsString)";
		$result = mysqli_query($connection, $query);

		if ($result) {
			// Deletion successful
			header('Location: index.php?tab=home');
		} else {
			// Deletion failed
			echo "Error deleting items: " . mysqli_error($connection);
		}
	}
