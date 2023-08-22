<?php


class Controller
{


    function getRates($arrival_date, $departure_date, $ages, $unit_name, $occupants)
    {
        //Create Empty age group array
        $ages_group_array = array();

        for ($i = 0; $i < sizeof($ages); $i++) {
            array_push($ages_group_array, $this->mutateAges($ages[$i]));
        }

        //Setup request to send json via POST
        $data = array(
            'Unit Type ID' => $this->mutateUnitName($unit_name),
            'Arrival' => $arrival_date,
            'Departure' => $departure_date,
            'Guests' => $ages_group_array
        );

        $payload = json_encode($data);

        return $this->queryRemoteApi('https://dev.gondwana-collection.com/Web-Store/Rates/Rates.php', $payload);
    }



    function queryRemoteApi($url, $payload)
    {

        //Create a new cURL resource
        $ch = curl_init($url);

        //Append  JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        // Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //Send  POST request
        $result = curl_exec($ch);

        // Close cURL
        curl_close($ch);

        return $result;
    }



    function mutateAges($age)
    {

        // Create Adult array
        $group_adult_array = array(
            'Age Group' => 'Adult'
        );

        //Create Child Array
        $group_child_array = array(
            'Age Group' => 'Child'
        );


        if ($age > 18) {
            return $group_adult_array;
        } else {
            return $group_child_array;
        }
    }



    function mutateUnitName($name)
    {
        switch ($name) {
            case 'Kalahari Farmhouse':
                return -2147483637;
                break;
            case 'Klipspringer Camps':
                return -2147483456;
                break;
        }
    }
}
