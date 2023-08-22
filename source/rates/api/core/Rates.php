<?php
class Rates
{
    public $unitName;
    public $arrival;
    public $departure;
    public $occupants;
    public $ages = array();

    public function getRates()
    {
        $this->unitName = htmlspecialchars(strip_tags($this->unitName));
        $this->arrival  = htmlspecialchars(strip_tags($this->arrival));
        $this->departure = htmlspecialchars(strip_tags($this->departure));
        $this->occupants = htmlspecialchars(strip_tags($this->occupants));

        // map data reieved to the external api request
        $data = [
            "Unit Type ID" => -2147483456,
            "Arrival" => $this->arrival,
            "Departure" => $this->departure,
            "Guests" => array_map(function ($age) {
                $agegroup = "";
                if($age > 18)
                  $agegroup = "Adult";
                else
                  $agegroup = "Child";
                return ["Age Group" => $agegroup];
            }, $this->ages)
        ];

        $url = "https://dev.gondwana-collection.com/Web-Store/Rates/Rates.php";
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Accept: application/json",
            "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

        $resp = curl_exec($curl);
        curl_close($curl);

        // Return the external API response
        return $resp;
    }
}
?>
