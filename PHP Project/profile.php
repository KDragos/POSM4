<?php
// Initialize Code
require('initialize.php');

try { 
	// Creates the new customer.
	if (isset($_GET['create'])) {
		$createStmt = 'INSERT INTO invoice (
			customer_id, created_at
			) VALUES (:cust_id, NOW()
			)';
		
		$createValues[':cust_id'] = $_GET["id"];

		$create = DB::prepare($createStmt);
		DB::execute($create, $createValues);
		$custId = $_GET['id'];
	}

	// The default code to show the customer details.
	$sql = "
		SELECT *
		FROM customer
		JOIN invoice USING (customer_id)
		WHERE customer_id = :id
		";

	// Make a PDO statement
	$statement = DB::prepare($sql);

	$prepare_values = [
		':id' => $_GET['id']
	];

	// Execute , $prepare_values
	DB::execute($statement, $prepare_values);

	// Get all the results of the statement into an array
	$results = $statement->fetchAll();

	// Get the first result as a row
	$row = $results[0];
	$fullName = $row['first_name'] . ' ' . $row['last_name'];

	$invoices = "";
	foreach ($results as $i => $result) {
		$invoices .= "<tr><td><a href=\"invoiceDetail.php?invId={$results[$i]["invoice_id"]}\">
			{$results[$i]["invoice_id"]}</a></td><td>{$results[$i]["created_at"]}</td></tr>";
	}
} catch (PDOException $e) {
	die($e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Profile Page</title>
</head>
<body>
	<h1>This is the profile for <?php echo $fullName; ?>. </h1>
	<div>
		<h4>Contact Information</h4>
		<table>
			<tr>
				<td>Name:</td>
				<td><?php echo $fullName; ?></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><?php echo $row['email']; ?></td>
			</tr>
			<tr>
				<td>Gender</td>
				<td><?php echo $row['gender']; ?></td>
			</tr>
			<tr>
				<td>Customer Since:</td>
				<td><?php echo $row['customer_since']; ?></td>
			</tr>
		</table>
	</div>
	<div>
		<h4><a href="profile.php?id=<?php echo $_GET['id']; ?>&create=true">Create new invoice.</a></h4> 
	</div>
	<div>
		<h4>Previous Invoices</h4>
		<table border="1">
			<tr><td>Invoice</td><td>Created At</td></tr>
			<?php echo $invoices; ?>
		</table>
	</div>
	<a href="main.php">Home</a>
</body>
</html>