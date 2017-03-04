<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

	public function __construct(){
		parent::__construct();
		if (!isUserLoggedIn()){
			doBootstrapAlert("Please log in to continue", "warning");
			redirect(site_url("auth/login"));
		}
		$this->load->model("user_model");
		$this->load->model("interest_model");
		$this->load->model("post_model");
		$this->load->model("location_model");
	}

	public function index(){
		
		$data['interests'] = $this->interest_model->getAllInterests();
		$data['posts'] = $this->post_model->postsByUser($this->session->userdata("user_id"));
		$data["user"] = $this->user_model->getUser($this->session->userdata("user_id"));
		$data['target_posts'] = $this->post_model->getPostsForUser($this->session->userdata("user_id"));
		if (empty($data['user'])){
			echo "User does not exist";
			exit();
		}
		$data['title'] = "BCAPP";
		
		$this->load->view("header", $data);
		$data['main_content'] = $this->load->view('posts-list', $data, TRUE);
		
		$this->load->view("index", $data);

		$this->load->view("footer");
	}

	public function view($username=""){
		$username = $username === "" ? $this->input->post_get("username") : $username;
		$data['interests'] = $this->interest_model->getAllInterests();
		
		$data["user"] = $this->user_model->getUserByUsername($username);
		if (empty($data['user'])){
			echo "User does not exist";
			exit();
		}
		$data['posts'] = $this->post_model->postsByUser($data['user']->id);
		$data['title'] = "BCAPP | " . $data['user']->username;

		$this->load->view("header", $data);
		$data['main_content'] = $this->load->view('posts-list', $data, TRUE);
		$this->load->view("index", $data);
		$this->load->view("footer");
	}

	public function getTargetUsers(){
		$age = $this->input->post("age");
		
		$gender = $this->input->post("gender[]");
		$country = $this->input->post("country");
		$state = $this->input->post("state[]");
		$interests = $this->input->post("interests[]");
		// $age = array(18, 30, 50);
		$users_count = $this->user_model->getMatchedUsers($age, $country, $gender, $interests, $state);
		echo json_encode(array("users_count" => $users_count));

	}
	public function settings(){
		$data['interests'] = $this->interest_model->getAllInterests();
		$this->load->view("settings", $data);
	}

	public function editProfile(){
		$data["user"] = $this->user_model->getUser($this->session->userdata("user_id"));
		$data['countries'] = $this->location_model->getCountries();
		$data['title'] = "BCAPP | Edit profile";
		$this->load->view('header', $data);
		$data['main_content'] = $this->load->view("edit-profile", $data, TRUE);
		$this->load->view('index',$data);
		$this->load->view('footer');
	}

	public function updateProfile(){
		
		$data['gender'] = $this->input->post("gender");
		$data['dob'] = $this->input->post("dob");
		$data['name'] = $this->input->post('name');
		$data['country'] = $this->input->post("country");
		$data['state'] = $this->input->post("state");
		$data['city'] = $this->input->post('city');
		$data = array_filter($data);
		echo json_encode($data);
		exit();
		if ($this->user_model->updateUser($this->session->userdata("user_id"), $data)){
			echo json_encode(["status" => "success"]);
		}
		else{
			echo json_encode(["status" => "fail"]);
		}
	}

	public function getUserLikes($user_id=""){
		// if ($user_id === ""){
		// 	$user_id = $this->session->userdata("user_id");
		// }
		$user_id = $user_id === "" ? $this->input->post_get("user_id") : $user_id;

		$data['interests'] = $this->interest_model->getAllInterests();
		$data['posts'] = $this->user_model->getLikesByUser($user_id);
		
		$data["user"] = $this->user_model->getUser($user_id);
		
		$data['title'] = "BCAPP";
		$data['section_title'] = "Likes";
		$this->load->view("header", $data);
		$data['main_content'] = $this->load->view('posts-list', $data, TRUE);
		
		$this->load->view("index", $data);

		$this->load->view("footer");
		

		// echo json_encode(array("data" => $posts));
	}

	public function ajaxUploadPic(){
		$user = $this->user_model->getUser($this->session->userdata('user_id'));
		$date = date("Y-m-d H:i:s");
		$config['upload_path'] = './uploads/profilepics';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = 0;
		$config['max_width'] = 0;
		$config['max_height'] = 0;
		
		$config['file_name'] = $user->id . "_" . $user->username . ".jpg";
		$config['overwrite'] = TRUE;
		

		$this->load->library('upload', $config);
		if (! $this->upload->do_upload()){
			$error = array('error' => $this->upload->display_errors("<div class='alert alert-danger'>", "</div>"));
			// echo json_encode($this->upload->data());
			echo json_encode($error);
		}
		else{
			/* upload the image to a directory and save its name to database */
			$data = $this->upload->data();
			$userData['userID'] = $user->id;
			
			$file_name = $data['file_name'];
			$full_path = base_url('uploads/profilepics/' . $file_name);
			$config_resize['image_library'] = 'gd2';
			$config_resize['source_image'] = 'uploads/profilepics/'.$file_name;
			
			// $config_resize['create_thumb'] = TRUE;
			$config_resize['maintain_ratio'] = TRUE;
			$config_resize['width']         = 300;
			$config_resize['height']       = 300;
			$this->load->library("image_lib", $config_resize);
			if (!$this->image_lib->resize()){
				echo $this->image_lib->display_errors();
				exit();
			}
			
			$this->db->where('id', $user->id);
			$this->db->set('image', $file_name);
			$this->db->update('user');

			echo json_encode(array("message" => "Successfully uploaded your pic", "file_name" => $file_name));
		}
	}
}