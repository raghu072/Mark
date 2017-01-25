<?php
/**
* This class is to read the csv files of the OAS entity objects
*/
class CSVReader {
 public function objectCsvReader($oasObject) {
 $array = $fields = array(); $i = 0;
 $columns = "";
 $sql = "";
$handle = @fopen("csv/".$oasObject.".csv", "r");
// $con = mysqli_connect("127.0.0.1","root","","migration");
$con = mysqli_connect("172.19.18.98","root","root","migration");
if ($handle) {
	$insertrecorddata = '';
    while (($row = fgetcsv($handle, 4096)) !== false) {
        if (empty($fields)) {
            $fields = $row;
            continue;
        }
		echo "<pre>";
		$data = ""; 
        foreach ($row as $k=>$value) {
		if($i == 0) {
			$columns.= $fields[$k].',';
		}
		$value = str_replace("'",'',$value);
		$value = str_replace(",",'-',$value);
		$data .= "'".$value."',";
		}		
		$data= substr($data,0,strlen($data)-1);
		if($data!="") {
		$insertrecorddata.= '('.$data.'),';
		}
		$i++;
		//exit;
	   }
	   $insertrecorddata = substr($insertrecorddata,0,strlen($insertrecorddata)-1);
	   //echo $insertrecorddata;
	 $header = substr($columns,0,strlen($columns)-1);
	// echo $header;
			$sql="insert into `campaignlist` (".$header.") values".$insertrecorddata.";";
		// echo $sql;
		if(mysqli_query($con,$sql)) {
			echo "imported";
		}
		else {
			//die(mysqli_error());
		}
		$i++;
    }
	

	//echo $record;
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}
}

$objectCsvReader = new CSVReader();
$objectCsvReader->objectCsvReader('secondun');
?>