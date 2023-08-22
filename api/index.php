<?php

// Load dependencies from Composer
require_once __DIR__ . '/vendor/autoload.php';

// Set headers for CORS and content type
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

// Fetch the raw POST input and decode it
$data = json_decode(file_get_contents("php://input"));

// Ensure all required input fields are present
if (isset($data->{"Unit Name"}) && isset($data->Arrival) && isset($data->Departure) && isset($data->Occupants) && isset($data->Ages)) {

    // Mapping of Unit Names to their respective IDs
    $unitTypeIDMap = [
        "UnitA" => -2147483637,
        "UnitB" => -2147483456,
    ];

    // Fetch unit type ID, defaulting to UnitA's ID if the unit name is not found
    $unitTypeID = $unitTypeIDMap[$data->{"Unit Name"}] ?? -2147483637;

    // Process the age data to determine age groups (Adult/Child)
    $guests = array_map(function ($age) {
        return ["Age Group" => ($age >= 18 ? "Adult" : "Child")];
    }, $data->Ages);

    // Construct the payload to send to the remote API
    $apiPayload = [
        "Unit Type ID" => $unitTypeID,
        "Arrival" => DateTime::createFromFormat('d-m-Y', $data->Arrival)->format('Y-m-d'),
        "Departure" => DateTime::createFromFormat('d-m-Y', $data->Departure)->format('Y-m-d'),
        "Guests" => $guests
    ];

    // Initialize the Guzzle client and send the request
    $client = new \GuzzleHttp\Client();
    $response = $client->post('https://dev.gondwana-collection.com/Web-Store/Rates/Rates.php', [
        'json' => $apiPayload
    ]);

    // Decode the response from the remote API
    $remoteApiResponse = json_decode($response->getBody(), true);

    // Process and format specific rate-related fields in the response
    if (isset($remoteApiResponse['Total Charge'])) {
        $remoteApiResponse['Total Charge'] = 'N$ ' . number_format($remoteApiResponse['Total Charge'] / 100, 2);
    }

    if (isset($remoteApiResponse['Legs'][0]['Total Charge'])) {
        $remoteApiResponse['Legs'][0]['Total Charge'] = 'N$ ' . number_format($remoteApiResponse['Legs'][0]['Total Charge'] / 100, 2);
    }

    if (isset($remoteApiResponse['Legs'][0]['Effective Average Daily Rate'])) {
        $remoteApiResponse['Legs'][0]['Effective Average Daily Rate'] = 'N$ ' . number_format($remoteApiResponse['Legs'][0]['Effective Average Daily Rate'] / 100, 2);
    }

    // Add date range details to the response
    $remoteApiResponse['DateRange'] = [
        "Arrival" => $data->Arrival,
        "Departure" => $data->Departure
    ];

    // Output the final processed response
    echo json_encode($remoteApiResponse);

} else {
    // Output an error message if any required field is missing
    echo json_encode(['message' => 'Invalid input']);
}

?>