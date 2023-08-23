<?php

// Include necessary files, classes, or autoloaders

// Handle incoming POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming the incoming payload is in JSON format
    $inputJSON = file_get_contents('php://input');
    $data = json_decode($inputJSON, true);

    // Convert the payload to the desired format
    function convertPayload($data) {
        $convertedData = array(
            "Unit Type ID" => -2147483637,
            "Arrival" => date("Y-m-d", strtotime($data['Arrival'])),
            "Departure" => date("Y-m-d", strtotime($data['Departure'])),
            "Guests" => array()
        );

        foreach ($data['Ages'] as $age) {
            $ageGroup = ($age >= 18) ? "Adult" : "Child"; // Assuming anyone below 18 is a child
            $convertedData['Guests'][] = array("Age Group" => $ageGroup);
        }

        return $convertedData;
    }

    // Simulate sending the converted payload to a remote API
    function sendToRemoteAPI($convertedData, $remoteAddress) {
        // In a real scenario, you would use cURL or an HTTP library to send the POST request
        // This is a simplified example
        $response = json_encode(array("rate" => 150.00)); // Simulated response from remote API
        return $response;
    }

    // Convert the payload
    $convertedPayload = convertPayload($data);

    // Send the converted payload to the remote API
    $remoteAPIAddress = "https://dev.gondwana-collection.com/Web-Store/Rates/Rates.php"; // Replace with the actual remote API address
    $response = sendToRemoteAPI($convertedPayload, $remoteAPIAddress);

    // Return the response to the frontend
    header('Content-Type: application/json');
    echo $response;
} else {
    header("HTTP/1.0 405 Method Not Allowed");
    echo "Method not allowed.";
}

?>
