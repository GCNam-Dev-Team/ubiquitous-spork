<?php

// Set headers for CORS and content type
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

// Decode the incoming JSON data
$data = json_decode(file_get_contents("php://input"));

// Check if all required fields are present in the JSON data
if (
    isset($data->{"Unit Name"}) &&
    isset($data->Arrival) &&
    isset($data->Departure) &&
    isset($data->Occupants) &&
    isset($data->{"Ages"})
) {
    // Mapping of unit names to unit type IDs
    $unitTypeIDMap = [
        "Unit 1" => -2147483637,
        "Unit 2" => -2147483456,
    ];

    // Determine unit type ID based on the provided unit name, defaulting to a fallback value
    $unitTypeID = $unitTypeIDMap[$data->{"Unit Name"}] ?? -2147483637;

    // Create an array of guests with age groups
    $guests = [];
    foreach ($data->{"Ages"} as $age) {
        for ($i = 0; $i < $data->Occupants; $i++) {
            $ageGroup = "Child";
            if ($age >= 18 && $age <= 59) {
                $ageGroup = "Adult";
            } elseif ($age >= 60) {
                $ageGroup = "Senior Citizen";
            }
            $guests[] = ["Age Group" => $ageGroup];
        }
    }

    // Create the API payload with formatted dates and guest data
    $apiPayload = [
        "Unit Type ID" => $unitTypeID,
        "Arrival" => date('Y-m-d', strtotime($data->Arrival)),
        "Departure" => date('Y-m-d', strtotime($data->Departure)),
        "Guests" => $guests,
    ];

    // Create a stream context to handle HTTP POST request
    $options = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => json_encode($apiPayload),
        ],
    ];

    $context = stream_context_create($options);

    // Send HTTP POST request and capture the response
    $response = file_get_contents('https://dev.gondwana-collection.com/Web-Store/Rates/Rates.php', false, $context);

    // Decode the response from the remote API
    $remoteApiResponse = json_decode($response, true);

    // Format specific numeric values into currency format
    if (isset($remoteApiResponse['Total Charge'])) {
        $remoteApiResponse['Total Charge'] = 'N$ ' . number_format($remoteApiResponse['Total Charge'] / 100, 2);
    }

    if (isset($remoteApiResponse['Legs'][0]['Total Charge'])) {
        $remoteApiResponse['Legs'][0]['Total Charge'] = 'N$ ' . number_format($remoteApiResponse['Legs'][0]['Total Charge'] / 100, 2);
    }

    if (isset($remoteApiResponse['Legs'][0]['Effective Average Daily Rate'])) {
        $remoteApiResponse['Legs'][0]['Effective Average Daily Rate'] = 'N$ ' . number_format($remoteApiResponse['Legs'][0]['Effective Average Daily Rate'] / 100, 2);
    }

    // Add the original date range to the response
    $remoteApiResponse['DateRange'] = [
        "Arrival" => $data->Arrival,
        "Departure" => $data->Departure,
    ];

    // Respond with the formatted JSON response
    echo json_encode($remoteApiResponse);
} else {
    // Respond with an error message for invalid input
    echo json_encode(['message' => 'Invalid input']);
}
?>
