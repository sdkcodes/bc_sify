<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location_model extends CI_Model{

	public function getCountries(){
		return $this->db->get("countries")->result();
	}

	public function getStatesByCountryId($country_id){
		$this->db->where("country_id", $country_id);
		return $this->db->get("states")->result();
	}

	public function getCitiesByStateId($state_id){
		$this->db->where("state_id", $state_id);
		return $this->db->get("cities")->result();
	}
}