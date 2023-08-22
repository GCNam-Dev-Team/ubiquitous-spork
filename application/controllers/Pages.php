<?php
class Pages extends CI_Controller
{
	public function view()
	{
		$this->load->view('home');
	}
    
	public function rates()
	{
        if($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $id = 0;

            if($this->input->post('unit') == "Kalahari Farmhouse")
            {
                $id = -2147483637;
            }
            if($this->input->post('unit') == "Klipspringer Camps")
            {
                $id = -2147483456;
            }
    
            $arrivalDate = date('Y-m-d', strtotime($this->input->post('arrival')));
            $departureDate = date('Y-m-d', strtotime($this->input->post('departure')));
    
            $guests = array();
    
            foreach ($this->input->post('ages') as $age) {
                array_push($guests, array("Age Group" => ($age > 20 ? "Adult" : "Child")));
            }
    
            $data = array(
                "Unit Type ID" => $id, 
                "Arrival" => $arrivalDate, 
                "Departure" => $departureDate, 
                "Guests" => $guests
            );
    
            $ch = curl_init("https://dev.gondwana-collection.com/Web-Store/Rates/Rates.php");
    
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
    
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
            curl_close($ch);
            echo $response;
        }
	}
}
