<?php
	require 'config.php';
	global $connection;
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	include ('header.php');
?>

<div class="container mt-4">
	<?php if (isset($_SESSION['flash_message'])): ?>
		<div class="alert alert-info">
			<?php echo $_SESSION['flash_message']; ?>
		</div>
		<?php unset($_SESSION['flash_message']); ?>
	<?php endif; ?>

	<!-- Rest of the code -->

	</div>

	<div class="container mt-4">

<?php if (!isset($_GET['tab']) || $_GET['tab'] === 'home'): ?>
		<?php
			// Pagination configuration
			$itemsPerPage = 10; // Number of items to display per page

			// Calculate the total number of items
			$totalItemsQuery = "SELECT COUNT(*) as total FROM items";
			$totalItemsResult = mysqli_query($connection, $totalItemsQuery);
			$totalItems = mysqli_fetch_assoc($totalItemsResult)['total'];

			// Calculate the total number of pages
			$totalPages = ceil($totalItems / $itemsPerPage);

			// Get the current page from the query parameter
			$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

			// Calculate the offset for the query
			$offset = ($page - 1) * $itemsPerPage;

			// Fetch items for the current page
			$query = "SELECT *, items.id as item_id FROM items LEFT JOIN categories ON items.category_id = categories.id LIMIT $offset, $itemsPerPage";
			$result = mysqli_query($connection, $query);
		?>
		<div class="card mt-4">
			<div class="card-header">
				Item List
			</div>
			<div class="card-body">
				<form action="delete_items.php" method="POST">
					<button type="submit" class="btn btn-danger">Delete Checked Items</button>
				</form>
				<table class="table">
					<thead>
					<tr>
						<th></th>
						<th>Name</th>
						<th>Description</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Date Entered</th>
						<th>Category</th>
						<th>Edit</th>
					</tr>
					</thead>
					<tbody>
					<?php
						while ($row = mysqli_fetch_assoc($result)) {
							echo '<tr>';
							echo '<td><input type="checkbox" name="item_ids[]" value="' . $row['item_id'] . '"></td>';
							echo '<td>' . $row['name'] . '</td>';
							echo '<td>' . $row['description'] . '</td>';
							echo '<td>' . $row['price'] . '</td>';
							echo '<td>' . $row['quantity'] . '</td>';
							echo '<td>' . $row['date_entered'] . '</td>';
							echo '<td>' . $row['name'] . '</td>';
							echo '<td><a href="edit_item.php?id=' . $row['item_id'] . '" class="btn btn-primary">Edit</a></td>'; // Edit button added
							echo '</tr>';
						}
					?>
					</tbody>
				</table>

				<!-- Pagination links -->
				<div class="pagination mt-4">
					<?php
						for ($i = 1; $i <= $totalPages; $i++) {
							$activeClass = ($i === $page) ? 'active' : '';
							echo '<a class="btn btn-primary ' . $activeClass . '" href="index.php?tab=home&page=' . $i . '">' . $i . '</a>';
						}
					?>
				</div>
			</div>
		</div>
	</div>

	<?php elseif ($_GET['tab'] === 'categories'): ?>
		<div class="mt-4">
			<div class="card">
				<div class="card-header">
					Add Category
				</div>
				<div class="card-body">
					<form action="add_category.php" method="POST">
						<div class="form-group">
							<label for="category_name">Category Name:</label>
							<input type="text" id="category_name" name="category_name" class="form-control" required>
						</div>
						<button type="submit" class="btn btn-primary">Add Category</button>
					</form>
				</div>
			</div>
		</div>
	<?php elseif ($_GET['tab'] === 'items'): ?>
		<div class="mt-4">
			<div class="card">
				<div class="card-header">
					Add Item
				</div>
				<div class="card-body">
					<form action="add_item.php" method="POST">
						<div class="form-group">
							<label for="name">Name:</label>
							<input type="text" id="name" name="name" class="form-control" required>
						</div>

						<div class="form-group">
							<label for="description">Description:</label>
							<textarea id="description" name="description" class="form-control"></textarea>
						</div>

						<div class="form-group">
							<label for="price">Price:</label>
							<input type="number" id="price" name="price" class="form-control" required>
						</div>

						<div class="form-group">
							<label for="quantity">Quantity:</label>
							<input type="number" id="quantity" name="quantity" class="form-control" required>
						</div>

						<div class="form-group">
							<label for="date_entered">Date Entered:</label>
							<input type="date" id="date_entered" name="date_entered" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="category">Category:</label>
							<select id="category" name="category" class="form-control">
								<?php
									// Fetch categories from the database
									$query = "SELECT * FROM categories";
									$result = mysqli_query($connection, $query);

									while ($row = mysqli_fetch_assoc($result)) {
										echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
									}
								?>
							</select>
						</div>
						<div class="form-group">

							<button type="submit" class="btn btn-primary">Add Item</button>
						</div>

					</form>
				</div>
			</div>
		</div>

	<?php endif; ?>
</div>

<?php include('footer.php') ?>