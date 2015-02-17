<?php 
// Initialize Code
require('initialize.php');

try { 
	$sql = "
		DELETE FROM item
		WHERE item_id=:id";

	$sql_values = [
		':id' => $_GET['id']
	];

	// Make a PDO statement
	$statement = DB::prepare($sql);

	// // Bind Parameters individually instead of using sql_values array
	// $statement->bindValue(':first_name', $_POST['first_name']);
	// $statement->bindValue(':last_name', $_POST['last_name']);
	// $statement->bindValue(':email', $_POST['email']);

	// Execute
	DB::execute($statement, $sql_values);
	// Redirect
	header('Location: items.php');
	exit();

} catch (PDOException $e) {
	die($e->getMessage());
}
