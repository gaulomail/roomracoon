<?php

	require 'config.php';
	global $connection;


	if (!isset($_GET['id'])) {
		// No item ID specified, redirect to index.php
		header('Location: index.php?tab=home');
		exit();
	}
	$itemId = isset($_GET['id']) ? $_GET['id'] : null;

	// Validate and sanitize the item ID
	if (!is_numeric($itemId)) {
		// Invalid item ID, redirect to index.php
		header('Location: index.php');
		exit();
	}

	$itemId = isset($_GET['id']) ? $_GET['id'] : null;

	// Validate and sanitize the item ID
	if (!is_numeric($itemId)) {
		// Invalid item ID, redirect to index.php
		header('Location: index.php');
		exit();
	}

	$itemId = mysqli_real_escape_string($connection, $itemId);

	// Retrieve the item information from the database
	$query = "SELECT * FROM items WHERE id = $itemId";
	$result = mysqli_query($connection, $query);
	if (!$result) {
		die('Database query error: ' . mysqli_error($connection));
	}
	$item = mysqli_fetch_assoc($result);

	if (!$item) {
		// Item not found, redirect to index.php
		header('Location: index.php');
		exit();
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// Update the item in the database
		$name = $_POST['name'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$quantity = $_POST['quantity'];
		$dateEntered = $_POST['date_entered'];
		$category = $_POST['category'];

		$query = "UPDATE items SET name='$name', description='$description', price='$price', quantity='$quantity', date_entered='$dateEntered', category_id='$category' WHERE id='$itemId'";
		mysqli_query($connection, $query);

		// Redirect to index.php after updating
		header('Location: index.php');

	}
?>


<?php include ('header.php') ?>

<div class="container mt-4">
	<div class="card">
		<div class="card-header">
			Edit Item
		</div>
		<div class="card-body">
			<form action="" method="POST">
				<div class="form-group">
					<label for="name">Name:</label>
					<input type="text" id="name" name="name" class="form-control" value="<?php echo $item['name']; ?>" required>
				</div>

				<div class="form-group">
					<label for="description">Description:</label>
					<textarea id="description" name="description" class="form-control"><?php echo $item['description']; ?></textarea>
				</div>

				<div class="form-group">
					<label for="price">Price:</label>
					<input type="number" id="price" name="price" class="form-control" value="<?php echo $item['price']; ?>" required>
				</div>

				<div class="form-group">
					<label for="quantity">Quantity:</label>
					<input type="number" id="quantity" name="quantity" class="form-control" value="<?php echo $item['quantity']; ?>" required>
				</div>

				<div class="form-group">
					<label for="date_entered">Date Entered:</label>
					<input type="date" id="date_entered" name="date_entered" class="form-control" value="<?php echo $item['date_entered']; ?>" required>
				</div>
				<div class="form-group">
					<label for="category">Category:</label>
					<select id="category" name="category" class="form-control">
						<?php
							// Fetch categories from the database
							$query = "SELECT * FROM categories";
							$result = mysqli_query($connection, $query);

							while ($row = mysqli_fetch_assoc($result)) {
								$selected = ($row['id'] == $item['category_id']) ? 'selected' : '';
								echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['name'] . '</option>';
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Update Item</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php include('footer.php') ?>
