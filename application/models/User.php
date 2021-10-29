<?php

class User extends CI_Model{

    public $table_name = 'user';
    public $preference_table = 'user_pre';

    public function get() {
        $results = $this->db->get($this->table_name);
        return $results;
    }

    public function validateUser($email, $password){
        $results = $this->db->get_where($this->table_name, array(
            'email' => $email,
            'password' => md5($password)
        ));

        $result = $results->first_row('array');
        unset($result['password']);
        return $result;
    }

    public function update($update, $userCondition){
        /*
            $update = array ( 
                'first_name' => 'Shridatt',
                'last_name' => 'Z',
            )

            $userCondition = array ( 
                'email' => 'shridattz@gmail.com'
            )

        */
        
        $result = $this->db->update($this->table_name, $update, $userCondition);
    }

    public function create($user){
        /*
            $user = array ( 
                'first_name' => 'Shridatt',
                'last_name' => 'Z',
                'email' => 'shridattz@gmail.com',
                'password' => 'password123'
            )
        */
        return $this->db->insert($this->table_name, $user);

    }

    public function delete($userCondition){
        /*
            $userCondition = array ( 
                'email' => 'shridattz@gmail.com'
            )
        */
        $result = $this->db->delete($this->table_name, $userCondition);
    }


    public function saveCountryPreference($userId, $country){

        $result = $this->getCountryPreferences($userId);

        if(empty($result)){
            $result = $this->db->insert($this->preference_table, array(
                'countries' => $country,
                'user_id' => $userId
            ));

        }else{
            //get the countries
            $countries = str_getcsv($result['countries']);
            if(in_array($country, $countries)){
                $result = false;
            }else{
                $countries[]=$country;
                
                $result = $this->db->update($this->preference_table, array(
                    'countries' => str_putcsv($countries)
                ), array(
                    'user_id' => $userId
                ));
            }
        }

        return $result;

    }

    public function getCountryPreferences($userId){
        $result = $this->db->get_where($this->preference_table, array(
            'user_id' => $userId
        ))->first_row('array');

        return $result;
    }

    public function removeCountryPreference($userId,$country){
        $result = $this->getCountryPreferences($userId);

        if(empty($result)){
            $result = false;
        }else{
            //get the countries
            $countries = str_getcsv($result['countries']);
            if(in_array($country, $countries)){
                if (($key = array_search($country, $countries)) !== false) {
                    unset($countries[$key]);
                }

                $result = $this->db->update($this->preference_table, array(
                    'countries' => str_putcsv($countries)
                ), array(
                    'user_id' => $userId
                ));
            }else{
                $result = false;
            }
        }

        return $result;
    }


}