<?php 
require_once('initialize.php');

try {
	$statement = DB::prepare('SELECT first_name, last_name, customer_id FROM customer Order BY last_name DESC');
	$results = DB::execute($statement);
	
	// binding method
	$results = $statement->fetchAll(PDO::FETCH_ASSOC);
	$trows = '<table border="2">';
	foreach($results as $row) {
		$trows .= '<tr><td>' . $row['first_name'] . '</td><td>' . $row['last_name'] .
		 '</td><td><a href="editCustomer.php?id=' . $row['customer_id'] . '">Edit</a></td>
		 <td><a href="profile.php?id=' . $row['customer_id'] . '">View Details</a></td>
		 <td><a href="deleteCustomerConfirm.php?id=' . $row['customer_id'] . '">Remove</a></td></tr>';
	}
	$trows .= '</table>';

} catch (PDOException $e) {
	die($e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Customers</title>
</head>
<body>
	<header><a href="main.php">Home</a></header>
	<div>
		<h2>Customers</h2>
		<?php echo $trows; ?>
	</div>
	<div>
		<a href="newCustomer.php">New Customer</a>
	</div>
</body>
</html>