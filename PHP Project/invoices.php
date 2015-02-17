<?php 

require('initialize.php');

try {
	//Delete query. 
	if (isset($_GET['d'])) {
		$delStmt = 'DELETE FROM invoice
			WHERE invoice_id = :invId';
			
		$delValues[':invId'] = $_GET["invId"];

		$del = DB::prepare($delStmt);
		DB::execute($del, $delValues);
	}

	// Populate the table. 
	$sql = "
		SELECT *
		FROM invoice
		JOIN customer USING (customer_id)
		GROUP BY invoice_id
	";

	$statement = DB::prepare($sql);

	DB::execute($statement);
	$results = $statement->fetchAll();

	// Create table.
	$table = "";
	foreach ($results as $i => $result) {
		$table .= '<tr><td><a href=invoiceDetail.php?invId=' 
		. $result["invoice_id"] .'>' . $result["invoice_id"] 
		. "</a></td><td>" . $result["first_name"] . "</td><td>" 
		. $result["last_name"] . "</td><td><a href=\"invoices.php?d=y&invId=" . 
		$result["invoice_id"] . "\">Delete</a>" .  // Something that shows the invoice total here.  
		"</td><td>" . $result["created_at"] 
		. "</td></tr>";
	};
} catch (PDOException $e) {
	die($e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Invoices</title>
</head>
<body>
	<h3>Invoices</h3>
	<table border="1">
		<tr>
			<td>Invoice</td>
			<td>First Name</td>
			<td>Last Name</td>
			<td>Delete</td>
			<td>Created At</td>
		</tr>
		<?php echo $table; ?>
	</table>
	<a href="main.php">Home</a>

</body>
</html>