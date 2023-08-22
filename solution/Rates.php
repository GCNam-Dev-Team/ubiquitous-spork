<?php
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
include 'controller.php';


class Rates {
    
function listenPostRequest(){
    
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
  $controller = new Controller();
  
  $data = json_decode(file_get_contents("php://input"));
  
 echo (json_encode($controller->getRates($data->arrival,$data->departure,$data->ages,$data->unit_name,$data->occupants)));

}
    }
}

$rates = new Rates();
$rates->listenPostRequest();
