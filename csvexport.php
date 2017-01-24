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
	$fileName = 'uploads/' . strtotime ( "now" ) . ".csv";
	
	$sqlQuery = mysqli_query ( $dbConnection, "SELECT * FROM employee" );
	
	$numberOfRecords = mysqli_num_rows ( $sqlQuery );
	
	if ($numberOfRecords >= 1) {
		
		mysqli_data_seek ( $sqlQuery, 0 );
		$records = mysqli_fetch_assoc ( $sqlQuery );
		$open = fopen ( $fileName, "w" );
		
		$seperator = "";
		$comma = "";
		
		foreach ( $records as $name => $value ) {
			$seperator .= $comma . '' . str_replace ( '', '""', $value );
			$comma = ",";
		}
		$seperator .= "\n";
		fputs ( $open, $seperator );
		
		while ( $records = mysqli_fetch_assoc ( $sqlQuery ) ) {
			
			$seperator = "";
			$comma = "";
			
			foreach ( $records as $name => $value ) {
				$seperator .= $comma . '' . str_replace ( '', '""', $value );
				$comma = ",";
			}
			$seperator .= "\n";
			fputs ( $open, $seperator );
		}
		fclose ( $open );
	} else {
		echo "No records found";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Export CSV</title>
</head>
<body>
	<form method="post" action="csvexport.php">
		<input type="submit" name="submit" value="Submit">
	</form>
</body>
</html>