<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public $data;
	public $viewsConfig;

	function __construct() {
        parent::__construct();
		$this->data = array();
		$this->viewsConfig = $this->config->item('views');
    }


	public function index()
	{
		//ini_set('display_errors', 1);

		if($this->session->userdata('user')){
			$this->load->model('utility');
			$countries = $this->utility->getCountries();
			$user = $this->session->user;

			$data = array(
				'user' => $user['details'],
				'countries' => $countries['countries']
			);
			//var_dump($countries);die;
			$worldData = $this->utility->getCountryData();
			$worldData['title'] = "World";
			$worldData['deletable'] = false;

			$indiaData = $this->utility->getCountryData('india');
			$indiaData['title'] = "India";
			$indiaData['deletable'] = false;
			
			$data['infoCards'] = array(
				$this->load->view('dashboard/infocard', $worldData, true),
				$this->load->view('dashboard/infocard', $indiaData, true));

			$userCountryPreferences = $this->user->getCountryPreferences($user['details']['id']);
			if(!empty($userCountryPreferences)){

				$countries = str_getcsv($userCountryPreferences['countries']);
				foreach($countries as $country){
					$infoCardsData = $this->utility->getCountryData($country);
					$infoCardsData['title'] = $country;
					$infoCardsData['deletable'] = true;
					$data['infoCards'][] = $this->load->view('dashboard/infocard', $infoCardsData, true);
				}
				


			}	
			
			
			$this->data['view'] = loadTemplateConfig($this->viewsConfig, 'dashboard', $data);
			$this->load->view('common/template', $this->data);
		}else{
			echo "You need to login to view this section";
		}
		
	}

	public function getIndiaData(){
		$result = array();
		$data = json_decode(file_get_contents("https://data.covid19india.org/state_district_wise.json"),true);
		foreach($data as $state){
			if(isset($state['districtData'])){
				$active = 0; 
				$deceased = 0; 
				$confirmed = 0;
				$recovered = 0;
				foreach($state['districtData'] as $district){
					$active += $district['active'];
					$deceased += $district['deceased'];
					$confirmed += $district['confirmed'];
					$recovered += $district['recovered'];
				}

				$result[] = array(
					'state' => $state['statecode'],
					'active' => $active,
					'deceased'  => $deceased,
					'confirmed' => $confirmed,
					'recovered'  => $recovered
				);
			}
		}
		echo json_encode($result);
	}

	public function getCountries(){
		$result = array();
		$data = json_decode(file_get_contents("https://covid19.mathdro.id/api/countries/"),true);
		var_dump($data);
	}

	public function test(){
		if($this->session->userdata('user')){
			$user = $this->session->user;
			//var_dump($user['details']['id']);die;	
			var_dump($this->user->saveCountryPreference($user['details']['id'],'IND'));
		}

	}

	public function addCountryPreference(){
		$country = $this->input->post('country');
		//store it to user preferences
		if($this->session->userdata('user')){
			if($country){
				$user = $this->session->user;
				$result = $this->user->saveCountryPreference($user['details']['id'],$country);
				$message = ($result)?"Country preferences have been updated" : "This country already exists in user's preferences";
				
				$this->load->model('utility');
				$infoCardsData = $this->utility->getCountryData($country);
				$infoCardsData['title'] = $country;
				$infoCardsData['deletable'] = true;
				$render = $this->load->view('dashboard/infocard', $infoCardsData, true);
				
				echo json_encode(array("success" => $result,"message"=> $message, "render" => $render));
			} else{
				echo json_encode(array("success" => false,"message"=> "No country param received"));
			}
		}else{
			echo json_encode(array("success" => false,"message"=> "User session had timed out, please log in", "redirect" => site_url('login')));

		}


	}

	public function removeCountryPreference(){
		$country = $this->input->post('country');
		//store it to user preferences
		if($this->session->userdata('user')){
			if($country){
				$user = $this->session->user;
				$result = $this->user->removeCountryPreference($user['details']['id'],$country);
				$message = ($result)?"Country preferences have been updated" : "This country is already removed from / doesn't exists user's preferences";	
				echo json_encode(array("success" => $result,"message"=> $message));
			} else{
				echo json_encode(array("success" => false,"message"=> "No country param received"));
			}
		}else{
			echo json_encode(array("success" => false,"message"=> "User session had timed out, please log in", "redirect" => site_url('login')));

		}
	}

}
