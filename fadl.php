<?php 
$latitude=3.0878311;
$longitude=101.5816646;
function getAddress($latitude,$longitude){
    if(!empty($latitude) && !empty($longitude)){
        //Send request and receive json data by address
       $geocodeFromLatLong = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&sensor=true_or_false&key=AIzaSyAPYt7STfCIcPneYQeAfJIpyhQ-LSbC51k'); 
        $output = json_decode($geocodeFromLatLong);
        $status = $output->status;
        //Get address from json data
        $address = ($status=="OK")?$output->results[1]->formatted_address:'';
        //Return address of the given latitude and longitude
        if(!empty($address)){
            return $address;
        }else{
            return false;
        }
    }else{
        return false;   
    }
}

$data = getAddress($latitude,$longitude);
printf($data);
echo $data;
?>