<?php 

require_once('initialize.php');

$item_id = $_GET['id'];
try {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		$update = DB::prepare('
			UPDATE item
			SET name= :name,
			price= :price
			WHERE item_id= :item_id
			');

		$update_values = [
			":name" => $_POST["name"],
			":price" => $_POST["price"],
			":item_id" => $_POST["item_id"]
		];

		DB::execute($update, $update_values);

		header('refresh:0.25;url=items.php');
		exit();
	}
	$statement = DB::prepare('SELECT * FROM item WHERE item_id = ' . $item_id);
	$results = DB::execute($statement);
	
	// binding method
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$itemName = $result[0]['name'];
	// $fullName = $results[0]['first_name'] . ' ' . $results[0]['last_name'];

} catch (PDOException $e) {
	die($e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit Item</title>
</head>
<body>
	
	<h2>Update <?php echo $itemName; ?>? </h2>
<form action="" method="POST">
	<input type="hidden" name="item_id" value="<?php echo $_GET['id']; ?>">
	<div>Item Name: <input type="text" name="name" value="<?php echo $result[0]['name']; ?>"></div>
	<div>Price: <input type="text" name="price" value="<?php echo $result[0]['price'] ?>" ></div>
	<button>Update</button>
</form>
	<a href="items.php">Back</a>

</body>
</html>