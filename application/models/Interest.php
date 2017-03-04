<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Interest_model extends CI_Model{

	public function getAllInterests(){
		return $this->db->get("interest")->result();
	}
}