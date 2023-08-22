<?php
header("Content-Type: application/json");

function calculateAgeGroup($age) {
    return ($age >= 18) ? "Adult" : "Child";
}

// Ingested Payload
$payload = json_decode(file_get_contents("php://input"), true);

// Validate dates
$arrivalDate = strtotime($payload["Arrival"]);
$departureDate = strtotime($payload["Departure"]);

if ($arrivalDate === false || $departureDate === false || $arrivalDate > $departureDate) {
    $errorMessage = "Invalid date range. Departure date must be on or after the arrival date.";
    echo json_encode(["error" => $errorMessage]);
    exit;
}

// Convert the payload to the desired format
$convertedPayload = [
    "Unit Type ID" => -2147483637,
    "Arrival" => date("Y-m-d", $arrivalDate),
    "Departure" => date("Y-m-d", $departureDate),
    "Guests" => array_map("calculateAgeGroup", $payload["Ages"])
];

// Simulate obtaining rates (replace with actual API call)
$obtainedRates = [
    "Unit Name" => $payload["Unit Name"],
    "Rate" => 150, // Sample rate
    "Date Range" => $convertedPayload["Arrival"] . " - " . $convertedPayload["Departure"],
    "Availability" => "Available"
];

// Output JSON response
echo json_encode($obtainedRates);
?>
