<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'core/rates.php';

// Assuming 'Rates' class is defined in rates.php
$rates = new Rates();

// Read and decode the JSON data from the request body
$requestBody = file_get_contents('php://input');
$data = json_decode($requestBody, true);

if ($data === null) {
    http_response_code(400); // Bad Request
    echo json_encode(array("message" => "Invalid request. Please make sure you are passing the data in the correct format."));
    exit();
}

// Perform validation 
if(!isset($data['Unit Name']))
{
    echo json_encode("Error : Unit Name field not provided");
    return;
}
if(!isset($data['Arrival']))
{
    echo json_encode("Error : Arrival field not provided");
    return;
}
if(!isset($data['Departure']))
{
    echo json_encode("Error : Departure field not provided");
    return;
}
if(!isset($data['Occupants']))
{
    echo json_encode("Error : Occupants field not provided");
    return;
}
if(!isset($data['Ages']))
{
    echo json_encode("Error : Ages field not provided");
    return;
}

$rates->unitName = $data['Unit Name'];
$rates->arrival = $data['Arrival'];
$rates->departure = $data['Departure'];
$rates->occupants = $data['Occupants'];
$rates->ages = $data['Ages'];

$responseData = $rates->getRates();

echo $responseData;
?>