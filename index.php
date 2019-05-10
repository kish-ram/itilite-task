<?php
$jsonData = file_get_contents ("data.json");
$data = json_decode($jsonData);
// print_r($data->from);
echo "from MAA";
echo "<br>";
$from = $data->from;
foreach ($from as $key => $value) {
	// echo $key;
	// print_r($from[$key]);
	// echo $from[$key]->sale_price;
	// print_r($from[$key]->flights);
	// count($from[$key]->flights);
	$fromFlights = $from[$key]->flights;
	foreach ($fromFlights as $k => $v) {
		print_r($fromFlights[$k]->from);
		echo " to ";
		print_r($fromFlights[$k]->to);
	}
	echo "<br>";
}

echo "to MAA";
echo "<br>";
$return = $data->return;
foreach ($return as $key => $value) {
	// echo $key;
	// print_r($return[$key]);
	// echo $return[$key]->sale_price;
	// print_r($return[$key]->flights);
	// count($return[$key]->flights);
	$returnFlights = $return[$key]->flights;
	foreach ($returnFlights as $k => $v) {
		print_r($returnFlights[$k]->from);
		echo " to ";
		print_r($returnFlights[$k]->to);
	}
	echo "<br>";
}
?>