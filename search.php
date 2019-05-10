<?php

$from = $_POST['from'];
$return = $_POST['return'];
$depTime = $_POST['depTime'];
$depTimeBetweenArr = explode("-", $depTime);
$fromTime = $depTimeBetweenArr[0];
$toTime = $depTimeBetweenArr[1];
$stoppages = isset($_POST['stoppages']) ? $_POST['stoppages'] : '';

$jsonData = file_get_contents ("data.json");
$data = json_decode($jsonData);

if ($from == 'MAA') 
{
	$flights = $data->from;
}
else
{
	$flights = $data->return;
}

$timeFilteredFlights = array_filter($flights, function($arr) use ($fromTime,$toTime){
	$flightDepTime = date("H:i",strtotime($arr->flights[0]->departure_date_time));
	if($flightDepTime >= $fromTime && $flightDepTime <= $toTime)
	{
		return true;
	}
});

$nonStopFlights = array_filter($timeFilteredFlights, function($arr){
	if(count($arr->flights)==1)
	{
		return true;
	}
});

$filteredFlights = $nonStopFlights;

if(empty($nonStopFlights))
{
	$stopFlights = array_filter($timeFilteredFlights, function($arr)
	{
		if(count($arr->flights)>1)
		{
			return true;
		}
	});
	$filteredFlights = $stopFlights;
}

if($stoppages == 'with-stop')
{
	$filteredFlights = $timeFilteredFlights;
}


$tempSortArr = array_column($filteredFlights, 'total_duration');

array_multisort($tempSortArr, SORT_ASC, $filteredFlights);

$rtnData = (Object)$filteredFlights;

echo json_encode($rtnData);

?>