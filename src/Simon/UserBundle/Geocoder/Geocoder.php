<?php 

namespace Simon\UserBundle\Geocoder;

class Geocoder
{
   public function geocode($address)
    {
       $address = urlencode($address);
       
       $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyDLa5-VqaUHDErODU00fUHo_rkI-6n4m7U";
       $resp_json = file_get_contents($url);
        $resp = json_decode($resp_json, true);
        if($resp['status']=='OK'){
 
        // get the important data
        $lati = $resp['results'][0]['geometry']['location']['lat'];
        $longi = $resp['results'][0]['geometry']['location']['lng'];
        
         
        // verify if data is complete
        if($lati && $longi){
         
            // put the data in the array
            $data_arr = array();            
    
            array_push(
                $data_arr, 
                    $lati, 
                    $longi 
                );
             
            return $data_arr;
             
        }else{
            return false;
        }
    }
    }
}