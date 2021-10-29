<?php

class Utility extends CI_Model{

    public $table_name = 'user';

    public function getCountries(){
        $data = json_decode(file_get_contents("https://covid19.mathdro.id/api/countries/"),true);
        return $data;
    }

    public function getCountryData($country=null){

        $endpoint = "https://covid19.mathdro.id/api/";
        if($country){
            $endpoint = "https://covid19.mathdro.id/api/countries/".$country;
        }
        $data = json_decode(file_get_contents($endpoint),true);
        return $data;
    }


}