<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if (!isUserLoggedIn()){
			doBootstrapAlert("Please log in to continue", "warning");
			redirect(site_url("auth/login"));
		}
		$this->load->model('post_model');
		$this->load->model("interest_model");
		$this->load->model("user_model");

	}

	public function postsByUser(){
		$data['posts'] = $this->post_model->postsByUser($this->session->userdata("user_id"));
		$this->load->view('posts-list', $data);
	}

	public function newPost(){
		$this->form_validation->set_rules("body", "Post Content", "trim|required");
		if ($this->form_validation->run() === FALSE){

		}
		else{
			
			$user_id = $this->session->userdata('user_id');
			$data["body"] = $this->input->post("body");
			if (!is_null($this->input->post("country"))){
				if (is_array($this->input->post("country"))){
					$data['target_country'] = implode(",", $this->input->post("country"));
				}
				else{
					$data['target_country'] = $this->input->post("country");
				}
			}
			if (is_array($this->input->post("gender"))){
				$data['target_gender'] = implode(",", $this->input->post("gender"));
			}
			else{
				$data['target_gender'] = $this->input->post("gender");
			}

			if (is_array($this->input->post("interests"))){
				$data['tags'] = implode(",", $this->input->post("interests"));
			}
			else{
				$data['tags'] = $this->input->post("interests");
			}


			$data['user_id'] = $this->session->userdata("user_id");
			$user = $this->user_model->getUser($user_id);
			$data['screen_name'] = $user->name;
			$data['username'] = $user->username;
			
			$this->post_model->insertPost($data);
			echo json_encode(array("data" => $data));
		}
	}

	public function comment(){
		$this->form_validation->set_rules("body", "Post Content", "trim|required|max_length[1000]");
		$this->form_validation->set_rules("post_id", "Post Id", "trim|required");
		if (!$this->form_validation->run() === FALSE){
			$post_id = $this->input->post("post_id");
			$user_id = $this->session->userdata('user_id');
			$data['parent_id'] = $post_id;
			$data["body"] = $this->input->post("body");
			$data['user_id'] = $this->session->userdata("user_id");
			$user = $this->user_model->getUser($user_id);
			$data['screen_name'] = $user->name;
			$data['username'] = $user->username;
			$this->post_model->insertPost($data);
			echo json_encode(array("data" => $data));
		}
		// $post_id = ($post_id === "" ? $this->input->post_get("id") : $post_id) ;
		
	}

	public function likePost(){
		$post_id = $this->input->post("post_id");
		if (!$this->post_model->checkLike($this->session->userdata("user_id"), $post_id) > 0){
			$this->db->insert("post_like", ["user_id" => $this->session->userdata("user_id"), "post_id" => $post_id]);
			if ($this->db->affected_rows() > 0){
				echo json_encode(['status' => 'success'] );
			}
			else{
				echo json_encode(['status' => 'fail']);
			}
		}
	}

	public function unlikePost(){
		$post_id = $this->input->post("post_id");
		if ($this->post_model->checkLike($this->session->userdata("user_id"), $post_id) > 0){
			$this->db->where("user_id", $this->session->userdata("user_id"));
			$this->db->where("post_id", $post_id);
			$this->db->delete("post_like");
			if ($this->db->affected_rows() > 0){
				echo json_encode(['status' => 'success']);
			}
			else{
				echo json_encode(['status' => 'fail']);
			}
		}
		else{
			echo json_encode(['status' => 'already liked']);
		}
	}

	public function viewPost($post_id=""){

		$post_id = ($post_id === "" ? $this->input->post_get("id") : $post_id) ;
		$data['post'] = $this->post_model->getPostById($post_id);
		$data['interests'] = $this->interest_model->getAllInterests();
		
		$data["user"] = $this->user_model->getUser($this->session->userdata("user_id"));
		
		$data['title'] = "BCAPP | View Post";
		$data['section_title'] = "View Post";
		$this->load->view("header", $data);
		$data['main_content'] = $this->load->view('view-post', $data, TRUE);
		
		$this->load->view("index", $data);

		$this->load->view("footer");
	}



	public function countPostLikes($post_id=""){
		$post_id = ($post_id === "" ? $this->input->post_get("id") : $post_id) ;
		$likes_count = $this->post_model->countLikesForPost($post_id);
		echo json_encode(array("likes_count" => $likes_count));
	}
	public function countPostComments($post_id=""){
		$post_id = ($post_id === "" ? $this->input->post_get("id") : $post_id) ;
		$likes_count = $this->post_model->countCommentsForPost($post_id);
		echo json_encode(array("comments_count" => $comments_count));
	}
}