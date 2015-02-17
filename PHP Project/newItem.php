<?php 
require('initialize.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	try { 
		$sql = "
			INSERT INTO item (
				name, price
			) VALUES (
				:name, :price
			)
			";

		$sql_values = [
			':name' => $_POST['name'],
			':price' => $_POST['price']
		];

		// Make a PDO statement
		$statement = DB::prepare($sql);

		// Execute
		DB::execute($statement, $sql_values);
		// Redirect
		header('Location: items.php');
		exit();

	} catch (PDOException $e) {
		die($e->getMessage());
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>New Item</title>
</head>
<body>
	<h2>New Item</h2>
	<form action="" method="POST">
		<div>Name: <input type="text" name="name"></div>
		<div>Price: <input type="text" name="price"></div>
		<button>Create</button>
	</form>
	<a href="items.php">Go Back</a>
</body>
</html>