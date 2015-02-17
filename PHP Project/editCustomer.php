<?php 
require_once('initialize.php');

$cust_id = $_GET['id'];
try {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		$update = DB::prepare('
			UPDATE customer
			SET first_name= :first_name,
			last_name= :last_name,
			email= :email,
			gender= :gender
			WHERE customer_id= :customer_id
			');

		$update_values = [
			":first_name" => $_POST['firstName'],
			":last_name" => $_POST['lastName'],
			":email" => $_POST['email'],
			":gender" => $_POST['gender'],
			":customer_id" => $_POST['cust_id']
		];

		DB::execute($update, $update_values);

		header('refresh:2;url=profile.php?id=' . $_POST['cust_id']);
		exit();
	}
	$statement = DB::prepare('SELECT * FROM customer WHERE customer_id = ' . $cust_id);
	$results = DB::execute($statement);
	
	// binding method
	$results = $statement->fetchAll(PDO::FETCH_ASSOC);
	$fullName = $results[0]['first_name'] . ' ' . $results[0]['last_name'];

} catch (PDOException $e) {
	die($e->getMessage());
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h2>Update <?php echo $fullName; ?>'s profile? </h2>
<form action="" method="POST">
	<input type="hidden" name="cust_id" value="<?php echo $_GET['id']; ?>">
	<div>First Name:<input type="text" name="firstName" value="<?php echo $results[0]['first_name']; ?>"></div>
	<div>Last Name:<input type="text" name="lastName" value="<?php echo $results[0]['last_name'] ?>" ></div>
	<div>Email:<input type="email" name="email" value="<?php echo $results[0]['email'] ?>"></div>
	<div>Gender:
		<select name="gender">
			<option value="male" <?php if ($results[0]['gender'] === 'male') { echo "checked"; ?>>male</option>
			<option value="female" <?php } else { echo "checked"; }?>>female </option> 
		</select>
	</div>
	<button>Update</button>
</form>
	<a href="customers.php">Back</a>
</body>
</html>