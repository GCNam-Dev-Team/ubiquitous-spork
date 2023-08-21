<?php 
// API endpoint 
$apiUrl = "https://dev.gondwana-collection.com/Web-Store/Rates/Rates.php";

// Validate and sanitize input
$input = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

if($input['Unit Name'] && $input['Arrival'] && $input['Departure'] && $input['Occupants']) {

  // Transform input to match API specs
  $unitTypeId = getUnitTypeId($input['Unit Name']);
  $arrival = formatDate($input['Arrival']); 
  $departure = formatDate($input['Departure']);

  $guests = array();
  foreach ($input['Ages'] as $age) {
    $guests[] = array('Age Group' => getAgeGroup($age));
  }

  // API payload
  $apiPayload = array(
    'Unit Type ID' => $unitTypeId,
    'Arrival' => $arrival,
    'Departure' => $departure,
    'Guests' => $guests
  );

  // Call API  
  $apiResult = callApi($apiUrl, $apiPayload);
  
  // Return API response
  return $apiResult;

} else {
  // Handle invalid input
  http_response_code(400);
  echo json_encode(array('error' => 'Invalid input'));
}

// Helper functions

function getUnitTypeId($unitName) {
  // Map unit name to ID
  if ($unitName == 'Luxury Suite') {
    return -2147483637;
  } else if ($unitName == 'Family Suite') { 
    return -2147483456;
  }

  // Default 
  return -2147483637;
}

function formatDate($dateString) {
  // Format YYYY-MM-DD
  return date('Y-m-d', strtotime($dateString)); 
}

function getAgeGroup($age) {
  if ($age <= 18) {
    return 'Child';
  } else {
    return 'Adult';
  }
}

 // Make API request and return response
 function callApi($apiUrl, $apiPayload){
     $ch = curl_init($apiUrl);
     curl_setopt($ch, CURLOPT_POST, true);
     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($apiPayload)); // Send JSON payload
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $response = curl_exec($ch);
 
     // Check for cURL errors
     if (curl_errno($ch)) {
         echo 'Curl error: ' . curl_error($ch);
     } else {
         // Display the response
         header('Content-Type: application/json');
         return $response;
     }
 
     // Close the cURL handle
     curl_close($ch);
 }
 ?>