<?php

// Initialize Code
require('initialize.php');

try { 
	$sql = "
		INSERT INTO customer (
			first_name, last_name, email, gender, customer_since
		) VALUES (
			:first_name, :last_name, :email, :gender, CURDATE()
		)
		";

	$sql_values = [
		'first_name' => $_POST['firstName'],
		'last_name' => $_POST['lastName'],
		'email' => $_POST['email'],
		'gender' => $_POST['gender']
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
	header('Location: customers.php');
	exit();

} catch (PDOException $e) {
	die($e->getMessage());
}
