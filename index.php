<?php
$HOST = "127.0.0.1";
$USERNAME = "root";
$PASSWORD = "";
$DATABASE = "organization";

$dbConnection = mysqli_connect ( $HOST, $USERNAME, $PASSWORD, $DATABASE );

if (mysqli_connect_errno ()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error ();
}

if (isset ( $_POST ['submit'] )) {
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Csv Import</title>
</head>
<body>
	<form action="index.php" method="post"
		enctype="application/x-www-form-urlencoded">
		<input type="file" name="file"> <input type="submit" name="submit"
			value="Submit">
	</form>
</body>
</html>