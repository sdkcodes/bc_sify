<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model("location_model");
	}

	public function getStatesByCountry($country_id){
		$states = $this->location_model->getStatesByCountryId($country_id);
		echo json_encode($states);
	}

	public function getCitiesByState($state_id){
		$cities = $this->location_model->getCitiesByStateId($state_id);
		echo json_encode($cities);
	}
}