<?php 

require_once('initialize.php');

try {
	$statement = DB::prepare('SELECT * FROM item');
	$results = DB::execute($statement);
	
	// binding method
	$results = $statement->fetchAll(PDO::FETCH_ASSOC);

	$trows = '';
	// <td><a href="profile.php?id=' . $row['customer_id'] . '">View Details</a></td>
	foreach($results as $row) {
		$trows .= '<tr><td>' . $row['name'] . '</td><td>' . $row['price'] .
		 '</td><td><a href="editItem.php?id=' . $row['item_id'] . '">Edit</a></td><td><a href="deleteConfirm.php?id=' . $row['item_id'] . '">Remove</a></td></tr>';
	}
	

} catch (PDOException $e) {
	die($e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inventory</title>
</head>
<body>
	<h2>Our Inventory</h2>
	<table border="1">
		<tr>
			<td>Item Name</td>
			<td>Price</td>
			<td>Edit</td>
			<td>Remove</td>
		</tr>
		<?php echo $trows; ?>
	</table>
	<a href="newItem.php">Insert New Item</a>
	<a href="main.php">Home</a>
</body>
</html>