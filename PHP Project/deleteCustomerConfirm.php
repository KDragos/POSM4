<?php 
// Initialize Code
require('initialize.php');

try { 
	$sql = "
		DELETE FROM customer
		WHERE customer_id=:id";

	$sql_values = [
		':id' => $_GET['id']
	];

	// Make a PDO statement
	$statement = DB::prepare($sql);

	// Execute
	DB::execute($statement, $sql_values);
	// Redirect
	header('Location: customers.php');
	exit();

} catch (PDOException $e) {
	die($e->getMessage());
}
