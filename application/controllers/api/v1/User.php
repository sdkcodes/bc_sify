<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("user_model");
		$this->load->model("interest_model");
		$this->load->model("post_model");
	}

	public function getUser($user_id){
		$data['posts'] = $this->post_model->postsByUser($user_id);
		$data["user"] = $this->user_model->getUser($user_id);
		$data["user_data"] = $this->user_model->getUserData($user_id);
		
	}

	public function getTargetUsers($data){

	}