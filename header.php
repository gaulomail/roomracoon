<?php
	require 'config.php';
	global $connection;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Item Management System</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
	</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="#">
		<img width="167" height="50" src="assets/image/logo.svg" class="attachment-full size-full wp-image-146087" alt="" loading="lazy">
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
		<ul class="navbar-nav">
			<li class="nav-item <?php if (!isset($_GET['tab']) || $_GET['tab'] === 'home') echo 'active'; ?>">
				<a class="nav-link" href="index.php?tab=home">Home</a>
			</li>
			<li class="nav-item <?php if (!isset($_GET['tab']) || $_GET['tab'] === 'categories') echo 'active'; ?>">
				<a class="nav-link" href="index.php?tab=categories">Add Categories</a>
			</li>
			<li class="nav-item <?php if (isset($_GET['tab']) && $_GET['tab'] === 'items') echo 'active'; ?>">
				<a class="nav-link" href="index.php?tab=items">Add Items</a>
			</li>
		</ul>
	</div>
</nav>
